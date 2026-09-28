<?php

namespace App\Http\Requests;

use App\Support\FormTimer;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * POST /contact (rate limiter "contact", see AppServiceProvider).
 *
 * The site forms (resources/views/v2/components/form-shell.blade.php) post
 * `type` (contact | website_check), `locale`, name/email/message,
 * `scan_url`, `project_type`, `budget`, the `website_url` honeypot and the
 * signed `form_started` time (App\Support\FormTimer). A payload with only
 * name/email/message gets type "contact". Error messages follow `locale`
 * (nl by default).
 *
 * Input is cleaned before validation: control characters (CR/LF included,
 * so nothing can reach a mail header) are removed from name and email,
 * and from the message except for line breaks and tabs.
 */
class ContactRequest extends FormRequest
{
    public function isWebsiteCheck(): bool
    {
        return $this->input('type') === 'website_check';
    }

    public function isEnglish(): bool
    {
        return $this->input('locale') === 'en';
    }

    /** At most this many links in a message. */
    private const MAX_LINKS = 3;

    private const LINK_PATTERN = '~(?:https?://|www\.)\S+~iu';

    /**
     * Null for a real visitor. Otherwise why the submission counts as a
     * bot: 'honeypot' (a field no person sees was filled) or a FormTimer
     * verdict (sent too fast, a replayed or forged page).
     */
    public function spamReason(): ?string
    {
        if ($this->filled('website_url')) {
            return 'honeypot';
        }

        return FormTimer::verdict($this->input(FormTimer::FIELD));
    }

    /** The validated lead, without the bot traps and with a default type. */
    public function lead(): array
    {
        $data = $this->safe()->except(['website_url', FormTimer::FIELD]);
        $data['type'] ??= 'contact';

        return $data;
    }

    /**
     * Clean the free-text fields (see the class comment). Visitors type
     * "mijnzaak.nl", not "https://mijnzaak.nl": add the scheme when none
     * is given; the `url:http,https` rule then rejects every other scheme
     * (ftp://, javascript:, ...).
     */
    protected function prepareForValidation(): void
    {
        $clean = [
            'name' => self::singleLine($this->input('name')),
            'email' => self::singleLine($this->input('email')),
            'message' => self::multiLine($this->input('message')),
            'scan_url' => self::singleLine($this->input('scan_url')),
        ];

        $url = $clean['scan_url'];

        if (is_string($url) && $url !== '' && ! str_contains($url, '://')) {
            $clean['scan_url'] = 'https://'.$url;
        }

        $this->merge(array_filter($clean, fn ($value) => $value !== null));
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

    /** A message that is mostly links is spam: at most MAX_LINKS, and words besides them. */
    private function linkLimit(): Closure
    {
        return function (string $attribute, mixed $value, Closure $fail) {
            if (! is_string($value)) {
                return; // the `string` rule reports it
            }

            $links = preg_match_all(self::LINK_PATTERN, $value);
            $rest = (string) preg_replace(self::LINK_PATTERN, '', $value);

            if ($links > self::MAX_LINKS) {
                $fail($this->isEnglish()
                    ? 'Your message may contain at most '.self::MAX_LINKS.' links.'
                    : 'Uw bericht mag maximaal '.self::MAX_LINKS.' links bevatten.');
            } elseif ($links > 0 && ! preg_match('/\p{L}{2,}/u', $rest)) {
                $fail($this->isEnglish()
                    ? 'Please describe your question in words, not only with links.'
                    : 'Beschrijf uw vraag in woorden, niet alleen met links.');
            }
        };
    }

    public function rules(): array
    {
        $check = $this->isWebsiteCheck();
        $contact = config('site-v2.nl.contact');

        return [
            'type' => ['nullable', 'string', 'in:contact,website_check'],
            'locale' => ['nullable', 'string', 'in:nl,en'],
            // No links in a name: a favourite spot for spam.
            'name' => [$check ? 'nullable' : 'required', 'string', 'max:100', 'not_regex:'.self::LINK_PATTERN],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => $check
                ? ['nullable', 'string', 'max:2000', $this->linkLimit()]
                : ['required', 'string', 'min:20', 'max:2000', $this->linkLimit()],
            'scan_url' => [$check ? 'required' : 'nullable', 'url:http,https', 'max:255'],
            // Only the options the form offers (same keys in every locale).
            'project_type' => ['nullable', 'string', Rule::in(array_keys($contact['project_types']))],
            'budget' => ['nullable', 'string', Rule::in(array_keys($contact['budgets']))],
            // Bot traps: checked after validation (see spamReason()).
            'website_url' => ['nullable', 'string', 'max:255'],
            FormTimer::FIELD => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return $this->isEnglish() ? [
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
}
