<?php

namespace App\Support;

use App\Mail\ContactFormSubmission;
use Closure;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

/**
 * Lead intake (see CONTEXT.md): one form submission, from arrival to outcome.
 *
 * Every site form (resources/views/v2/components/form-shell.blade.php)
 * posts `type` (contact | website_check), `locale`, name/email/message,
 * `scan_url`, `project_type`, `budget`, the `website_url` honeypot and the
 * signed `form_started` time (FormTimer). A payload with only
 * name/email/message is a "contact" Lead.
 *
 * Interface:
 * - submit(): clean, validate (throws ValidationException, messages in the
 *   form's locale), spam verdict, mail the Lead; returns the outcome
 *   (HTTP status + localized message from config `forms.*`).
 * - limits(): the rate limits for one submission (used by the "contact"
 *   limiter in AppServiceProvider), with their localized 429 answer.
 * - spamReason(): why a submission is a bot, or null.
 * - projectTypes(): the project-type vocabulary.
 *
 * Mail goes through Laravel's Mail facade; tests use Mail::fake()
 * (docs/adr/0001-lead-intake-without-a-mail-port.md).
 */
final class LeadIntake
{
    /** At most this many links in a message. */
    private const MAX_LINKS = 3;

    private const LINK_PATTERN = '~(?:https?://|www\.)\S+~iu';

    private const HONEYPOT = 'website_url';

    /**
     * Handle one submission. A bot (honeypot, FormTimer) gets the same
     * success answer as a person, so it doesn't learn it was caught; only
     * the reason is logged, without personal data.
     *
     * @param  array<string, mixed>  $input  the raw request input
     * @return array{status: int, message: string}
     *
     * @throws ValidationException
     */
    public static function submit(array $input): array
    {
        $locale = self::locale($input);
        $data = self::clean($input);

        $validated = Validator::make($data, self::rules($data, $locale), self::messages($locale))->validate();

        $lead = array_diff_key($validated, array_flip([self::HONEYPOT, FormTimer::FIELD]));
        $lead['type'] ??= 'contact';

        if ($reason = self::spamReason($input)) {
            Log::info('Contact form submission blocked', ['reason' => $reason, 'type' => $lead['type']]);

            return self::outcome(200, 'sent', $locale);
        }

        // Mail goes out via Resend's HTTP API (fast, no blocking SMTP
        // round-trip), so we can wait for the actual result and report a
        // real failure instead of always answering 200.
        try {
            Mail::to(config('mail.from.address'))->send(new ContactFormSubmission($lead));
        } catch (\Throwable $e) {
            report($e);

            return self::outcome(500, 'error_generic', $locale);
        }

        return self::outcome(200, 'sent', $locale);
    }

    /**
     * Null for a real visitor. Otherwise why the submission counts as a
     * bot: 'honeypot' (a field no person sees was filled) or a FormTimer
     * verdict ('missing', 'invalid', 'too_fast', 'expired').
     *
     * @param  array<string, mixed>  $input
     */
    public static function spamReason(array $input): ?string
    {
        $honeypot = $input[self::HONEYPOT] ?? null;

        if ($honeypot !== null && (is_array($honeypot) || trim((string) $honeypot) !== '')) {
            return 'honeypot';
        }

        return FormTimer::verdict($input[FormTimer::FIELD] ?? null);
    }

    /**
     * The limits for one submission: 5 per minute and 20 per day per IP,
     * 3 per hour per e-mail address (hashed: the cache holds no readable
     * addresses) and, for a website check, 3 per day per checked site.
     * Each limit has its own key: limits that share a key share a counter.
     * Over a limit: 429 with Retry-After and the localized message.
     *
     * @param  array<string, mixed>  $input  the raw request input
     * @return list<Limit>
     */
    public static function limits(array $input, ?string $ip): array
    {
        $limits = [
            Limit::perMinute(5)->by('ip-minute:'.$ip),
            Limit::perDay(20)->by('ip-day:'.$ip),
        ];

        $email = $input['email'] ?? null;

        if (is_string($email) && trim($email) !== '') {
            $limits[] = Limit::perHour(3)->by('email:'.hash('sha256', Str::lower(trim($email))));
        }

        if ($host = self::scanHost($input)) {
            $limits[] = Limit::perDay(3)->by('scan-host:'.$host);
        }

        $message = self::message('too_many', self::locale($input));
        $tooMany = fn (Request $request, array $headers) => response()->json(['message' => $message], 429, $headers);

        return array_map(fn (Limit $limit) => $limit->response($tooMany), $limits);
    }

    /**
     * The project-type vocabulary: key => label in one locale. The keys are
     * the same in every locale; services and pricing packages name a
     * project type by key (`project_type`) to preselect it in the form.
     *
     * @return array<string, string>
     */
    public static function projectTypes(string $locale): array
    {
        return config("site-v2.{$locale}.contact.project_types");
    }

    /* ------------------------------------------------------------------ */

    /** @param  array<string, mixed>  $input */
    private static function locale(array $input): string
    {
        return ($input['locale'] ?? null) === 'en' ? 'en' : 'nl';
    }

    /** @return array{status: int, message: string} */
    private static function outcome(int $status, string $message, string $locale): array
    {
        return ['status' => $status, 'message' => self::message($message, $locale)];
    }

    /** A server answer from config `forms.*` in the form's locale. */
    private static function message(string $key, string $locale): string
    {
        return config("site-v2.{$locale}.forms.{$key}");
    }

    /**
     * Clean the free-text fields before validation: control characters
     * (CR/LF included, so nothing can reach a mail header) are removed from
     * name and email, and from the message except for line breaks and tabs.
     * Visitors type "mijnzaak.nl", not "https://mijnzaak.nl": the scheme is
     * added when none is given; the `url:http,https` rule then rejects every
     * other scheme (ftp://, javascript:, ...).
     *
     * @param  array<string, mixed>  $input
     * @return array<string, mixed>
     */
    private static function clean(array $input): array
    {
        $clean = [
            'name' => self::singleLine($input['name'] ?? null),
            'email' => self::singleLine($input['email'] ?? null),
            'message' => self::multiLine($input['message'] ?? null),
            'scan_url' => self::withScheme(self::singleLine($input['scan_url'] ?? null)),
        ];

        return array_merge($input, array_filter($clean, fn ($value) => $value !== null));
    }

    /** @param  array<string, mixed>  $data  cleaned input */
    private static function rules(array $data, string $locale): array
    {
        $check = ($data['type'] ?? null) === 'website_check';

        return [
            'type' => ['nullable', 'string', 'in:contact,website_check'],
            'locale' => ['nullable', 'string', 'in:nl,en'],
            // No links in a name: a favourite spot for spam.
            'name' => [$check ? 'nullable' : 'required', 'string', 'max:100', 'not_regex:'.self::LINK_PATTERN],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => $check
                ? ['nullable', 'string', 'max:2000', self::linkLimit($locale)]
                : ['required', 'string', 'min:20', 'max:2000', self::linkLimit($locale)],
            'scan_url' => [$check ? 'required' : 'nullable', 'url:http,https', 'max:255'],
            // Only the options the form offers (same keys in every locale).
            'project_type' => ['nullable', 'string', Rule::in(array_keys(self::projectTypes('nl')))],
            'budget' => ['nullable', 'string', Rule::in(array_keys(config('site-v2.nl.contact.budgets')))],
            // Bot traps: checked after validation (see spamReason()).
            self::HONEYPOT => ['nullable', 'string', 'max:255'],
            FormTimer::FIELD => ['nullable', 'string', 'max:100'],
        ];
    }

    private static function messages(string $locale): array
    {
        return $locale === 'en' ? [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'message.required' => 'Please write a message.',
            'message.min' => 'Your message must be at least 20 characters.',
            'message.max' => 'Your message may be at most 2000 characters.',
            'scan_url.required' => 'Please enter your website address.',
            'scan_url.url' => 'Please enter a valid website address, for example yourbusiness.com.',
            'scan_url.max' => 'The website address may be at most 255 characters.',
            'name.not_regex' => 'Please enter your name without links.',
            // Fallbacks for every other field/rule, so nothing shows the
            // framework's default wording.
            'max' => 'This field may be at most :max characters.',
            'string' => 'Please enter text.',
            'in' => 'Invalid value.',
        ] : [
            'name.required' => 'Vul uw naam in.',
            'email.required' => 'Vul uw e-mailadres in.',
            'email.email' => 'Vul een geldig e-mailadres in.',
            'message.required' => 'Schrijf een bericht.',
            'message.min' => 'Uw bericht moet minimaal 20 tekens bevatten.',
            'message.max' => 'Uw bericht mag maximaal 2000 tekens bevatten.',
            'scan_url.required' => 'Vul het adres van uw website in.',
            'scan_url.url' => 'Vul een geldig websiteadres in, bijvoorbeeld uwzaak.nl.',
            'scan_url.max' => 'Het websiteadres mag maximaal 255 tekens bevatten.',
            'name.not_regex' => 'Vul uw naam in zonder links.',
            'max' => 'Dit veld mag maximaal :max tekens bevatten.',
            'string' => 'Vul tekst in.',
            'in' => 'Ongeldige waarde.',
        ];
    }

    /** A message that is mostly links is spam: at most MAX_LINKS, and words besides them. */
    private static function linkLimit(string $locale): Closure
    {
        return function (string $attribute, mixed $value, Closure $fail) use ($locale) {
            if (! is_string($value)) {
                return; // the `string` rule reports it
            }

            $links = preg_match_all(self::LINK_PATTERN, $value);
            $rest = (string) preg_replace(self::LINK_PATTERN, '', $value);

            if ($links > self::MAX_LINKS) {
                $fail($locale === 'en'
                    ? 'Your message may contain at most '.self::MAX_LINKS.' links.'
                    : 'Uw bericht mag maximaal '.self::MAX_LINKS.' links bevatten.');
            } elseif ($links > 0 && ! preg_match('/\p{L}{2,}/u', $rest)) {
                $fail($locale === 'en'
                    ? 'Please describe your question in words, not only with links.'
                    : 'Beschrijf uw vraag in woorden, niet alleen met links.');
            }
        };
    }

    /**
     * Host of the site a website check asks about, lower case, without
     * "www.", or null (not a website check, or no usable URL).
     *
     * @param  array<string, mixed>  $input
     */
    private static function scanHost(array $input): ?string
    {
        $url = $input['scan_url'] ?? null;

        if (($input['type'] ?? null) !== 'website_check' || ! is_string($url) || trim($url) === '') {
            return null;
        }

        $host = parse_url(self::withScheme(trim($url)), PHP_URL_HOST);

        return is_string($host) && $host !== '' ? preg_replace('/^www\./', '', Str::lower($host)) : null;
    }

    /** "uwzaak.nl" => "https://uwzaak.nl"; anything with a scheme (or not a non-empty string) as is. */
    private static function withScheme(mixed $url): mixed
    {
        return is_string($url) && $url !== '' && ! str_contains($url, '://') ? 'https://'.$url : $url;
    }

    /**
     * One line of text: control characters (CR/LF, tab, NUL, ...) and the
     * Unicode line separators become a single space. Non-strings are left
     * for the `string` rule; invalid UTF-8 becomes an empty string.
     */
    private static function singleLine(mixed $value): mixed
    {
        if (! is_string($value)) {
            return $value;
        }

        return trim((string) preg_replace('/[\p{Cc}\x{2028}\x{2029}\s]+/u', ' ', $value));
    }

    /** Free text: keeps line breaks (as \n) and tabs, drops other control characters. */
    private static function multiLine(mixed $value): mixed
    {
        if (! is_string($value)) {
            return $value;
        }

        $value = str_replace(["\r\n", "\r", "\u{2028}", "\u{2029}"], "\n", $value);

        return trim((string) preg_replace('/[^\P{Cc}\n\t]/u', '', $value));
    }
}
