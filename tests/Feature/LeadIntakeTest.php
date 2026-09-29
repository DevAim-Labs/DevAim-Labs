<?php

namespace Tests\Feature;

use App\Support\FormTimer;
use App\Support\LeadIntake;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

/**
 * LeadIntake through its own interface, without HTTP: the spam verdict,
 * the rate-limit keys, the outcome messages and the project-type
 * vocabulary. The HTTP behaviour of POST /contact: ContactFormTest.
 */
class LeadIntakeTest extends TestCase
{
    public function test_spam_verdict(): void
    {
        $this->travel(-30)->seconds();
        $human = FormTimer::token();
        $this->travelBack();

        $this->assertNull(LeadIntake::spamReason([FormTimer::FIELD => $human, 'website_url' => '']));
        $this->assertSame('honeypot', LeadIntake::spamReason([FormTimer::FIELD => $human, 'website_url' => 'https://spam.example']));
        $this->assertNull(LeadIntake::spamReason([FormTimer::FIELD => $human, 'website_url' => '   ']));
        $this->assertSame('missing', LeadIntake::spamReason([]));
        $this->assertSame('invalid', LeadIntake::spamReason([FormTimer::FIELD => 'nonsense']));
        $this->assertSame('too_fast', LeadIntake::spamReason([FormTimer::FIELD => FormTimer::token()]));
    }

    public function test_limits_per_ip_email_and_checked_site(): void
    {
        $limits = $this->limits(['type' => 'website_check', 'email' => '  Sanne@Example.com ', 'scan_url' => ' WWW.UwZaak.nl/over '], '10.0.0.1');

        $this->assertSame([
            'ip-minute:10.0.0.1' => [5, 60],
            'ip-day:10.0.0.1' => [20, 86400],
            'email:'.hash('sha256', 'sanne@example.com') => [3, 3600],
            'scan-host:uwzaak.nl' => [3, 86400],
        ], $limits);
    }

    public function test_limits_without_email_or_for_a_plain_contact_form(): void
    {
        $this->assertSame(['ip-minute:1.2.3.4', 'ip-day:1.2.3.4'], array_keys($this->limits(['email' => ' '], '1.2.3.4')));

        // scan_url on a contact form is not a website check: no per-site limit.
        $keys = array_keys($this->limits(['type' => 'contact', 'email' => 'a@example.com', 'scan_url' => 'uwzaak.nl'], '1.2.3.4'));
        $this->assertCount(3, $keys);
        $this->assertStringStartsWith('email:', $keys[2]);
    }

    public function test_the_429_answer_follows_the_form_locale(): void
    {
        foreach (['nl', 'en'] as $locale) {
            [$limit] = LeadIntake::limits(['locale' => $locale], '1.2.3.4');
            $response = ($limit->responseCallback)(request(), ['Retry-After' => 60]);

            $this->assertSame(429, $response->getStatusCode());
            $this->assertSame('60', $response->headers->get('Retry-After'));
            $this->assertSame(config("site-v2.{$locale}.forms.too_many"), $response->getData(true)['message']);
        }
    }

    public function test_outcome_messages_come_from_the_forms_config(): void
    {
        Mail::fake();

        // A bot gets the normal success answer.
        $this->assertSame(
            ['status' => 200, 'message' => config('site-v2.en.forms.sent')],
            LeadIntake::submit($this->lead(['locale' => 'en', 'website_url' => 'https://spam.example'])),
        );
        Mail::assertNothingSent();

        Mail::shouldReceive('to')->andThrow(new \RuntimeException('mail down'));
        $this->assertSame(
            ['status' => 500, 'message' => config('site-v2.nl.forms.error_generic')],
            LeadIntake::submit($this->lead()),
        );
    }

    public function test_invalid_input_throws_with_messages_in_the_form_locale(): void
    {
        try {
            LeadIntake::submit(['locale' => 'en', 'type' => 'website_check', 'email' => 'owner@example.com']);
            $this->fail('No ValidationException');
        } catch (ValidationException $e) {
            $this->assertSame(['scan_url' => ['Please enter your website address.']], $e->errors());
        }
    }

    public function test_every_project_type_in_use_is_in_the_vocabulary(): void
    {
        $vocabulary = array_keys(LeadIntake::projectTypes('nl'));

        $this->assertSame($vocabulary, array_keys(LeadIntake::projectTypes('en')), 'same keys in every locale');

        foreach (config('site-v2-services.services') as $key => $service) {
            $this->assertContains($service['project_type'], $vocabulary, "service {$key}");
        }

        foreach (['nl', 'en'] as $locale) {
            foreach (config("site-v2.{$locale}.pricing.packages") as $package) {
                $this->assertContains($package['project_type'], $vocabulary, "{$locale} pricing package {$package['key']}");
            }
        }
    }

    public function test_the_form_select_offers_the_vocabulary(): void
    {
        foreach (['/contact' => 'nl', '/en/contact' => 'en'] as $path => $locale) {
            $html = $this->get($path)->assertOk()->getContent();
            preg_match('#<select[^>]*name="project_type".*?</select>#s', $html, $select);
            preg_match_all('#<option value="([^"]+)"[^>]*>\s*([^<]*?)\s*</option>#', $select[0], $options);

            $this->assertSame(LeadIntake::projectTypes($locale), array_combine($options[1], array_map('html_entity_decode', $options[2])), $path);
        }
    }

    /** @return array<string, array{int, int}> key => [max attempts, decay seconds] */
    private function limits(array $input, string $ip): array
    {
        $out = [];
        foreach (LeadIntake::limits($input, $ip) as $limit) {
            $this->assertInstanceOf(Limit::class, $limit);
            $out[$limit->key] = [$limit->maxAttempts, $limit->decaySeconds];
        }

        return $out;
    }

    private function lead(array $overrides = []): array
    {
        $this->travel(-30)->seconds();
        $token = FormTimer::token();
        $this->travelBack();

        return $overrides + [
            'name' => 'Sanne de Vries',
            'email' => 'sanne@example.com',
            'message' => 'Ik zoek een nieuwe website voor mijn restaurant.',
            'website_url' => '',
            FormTimer::FIELD => $token,
        ];
    }
}
