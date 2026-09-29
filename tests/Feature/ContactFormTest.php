<?php

namespace Tests\Feature;

use App\Mail\ContactFormSubmission;
use App\Support\FormTimer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * POST /contact: the site's contact form and website-check form.
 * Page rendering is covered in SitePagesTest.
 */
class ContactFormTest extends TestCase
{
    /** A signed form_started value for a form rendered $seconds ago. */
    private function startedAgo(int $seconds = 30): string
    {
        $this->travel(-$seconds)->seconds();
        $token = FormTimer::token();
        $this->travelBack();

        return $token;
    }

    /** A valid contact form submission, filled in by a person. */
    private function contact(array $overrides = []): array
    {
        return $overrides + [
            'name' => 'Sanne de Vries',
            'email' => 'sanne@example.com',
            'message' => 'Ik zoek een nieuwe website voor mijn restaurant.',
            'website_url' => '',
            FormTimer::FIELD => $this->startedAgo(),
        ];
    }

    public function test_website_check_without_scan_url_is_rejected(): void
    {
        Mail::fake();

        $this->postJson('/contact', [
            'type' => 'website_check',
            'email' => 'owner@example.com',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['scan_url'])
            ->assertJsonMissingValidationErrors(['name', 'message']);

        Mail::assertNothingSent();
    }

    public function test_valid_website_check_sends_mail(): void
    {
        Mail::fake();

        $this->postJson('/contact', [
            'type' => 'website_check',
            'locale' => 'nl',
            'scan_url' => 'uwzaak.nl', // scheme is added server-side
            'email' => 'owner@example.com',
            'website_url' => '',
            FormTimer::FIELD => $this->startedAgo(),
        ])->assertOk();

        Mail::assertSent(ContactFormSubmission::class, function (ContactFormSubmission $mail) {
            return $mail->data['type'] === 'website_check'
                && $mail->data['scan_url'] === 'https://uwzaak.nl';
        });
    }

    public function test_minimal_contact_payload_works(): void
    {
        Mail::fake();

        $this->postJson('/contact', $this->contact())->assertOk();

        Mail::assertSent(ContactFormSubmission::class, fn ($mail) => $mail->data['type'] === 'contact'
            && $mail->data['name'] === 'Sanne de Vries');
    }

    public function test_legacy_contact_payload_still_requires_message(): void
    {
        $this->postJson('/contact', [
            'name' => 'Sanne',
            'email' => 'sanne@example.com',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['message']);
    }

    public function test_english_locale_returns_english_messages(): void
    {
        $this->postJson('/contact', [
            'type' => 'website_check',
            'locale' => 'en',
            'email' => 'owner@example.com',
        ])
            ->assertStatus(422)
            ->assertJsonPath('errors.scan_url.0', 'Please enter your website address.');
    }

    public function test_filled_honeypot_pretends_success_without_sending(): void
    {
        Mail::fake();

        $this->postJson('/contact', [
            'name' => 'Bot',
            'email' => 'bot@example.com',
            'message' => 'Buy cheap things at my website right now please.',
            'website_url' => 'https://spam.example',
        ])->assertOk()->assertJsonPath('message', 'Verzonden.');

        Mail::assertNothingSent();
    }

    public function test_scan_url_with_another_scheme_is_rejected(): void
    {
        Mail::fake();

        foreach (['javascript:alert(1)', 'javascript://example.com/%0Aalert(1)', 'ftp://example.com', 'data:text/html,hi'] as $i => $url) {
            $this->postJson('/contact', [
                'type' => 'website_check',
                'scan_url' => $url,
                'email' => "owner{$i}@example.com", // stay under the per-address limit
            ])->assertStatus(422)->assertJsonValidationErrors(['scan_url']);
        }

        Mail::assertNothingSent();
    }

    public function test_scan_url_longer_than_255_characters_is_rejected(): void
    {
        $this->postJson('/contact', [
            'type' => 'website_check',
            'scan_url' => 'example.com/'.str_repeat('a', 260),
            'email' => 'owner@example.com',
        ])->assertStatus(422)->assertJsonValidationErrors(['scan_url']);
    }

    public function test_every_error_message_follows_the_form_locale(): void
    {
        $payload = [
            'name' => str_repeat('a', 101),
            'email' => 'owner@example.com',
            'message' => 'A message that is long enough to pass.',
        ];

        $this->postJson('/contact', $payload + ['locale' => 'en'])
            ->assertStatus(422)
            ->assertJsonPath('errors.name.0', 'This field may be at most 100 characters.');

        $this->postJson('/contact', $payload)
            ->assertStatus(422)
            ->assertJsonPath('errors.name.0', 'Dit veld mag maximaal 100 tekens bevatten.');
    }

    public function test_contact_endpoint_is_throttled_per_ip(): void
    {
        Mail::fake();

        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/contact', ['email' => "x{$i}"])->assertStatus(422);
        }

        $this->postJson('/contact', ['email' => 'x9', 'locale' => 'en'])
            ->assertStatus(429)
            ->assertHeader('Retry-After')
            ->assertJsonPath('message', 'Too many attempts. Please try again later.');
    }

    public function test_contact_endpoint_is_throttled_per_email_address_across_ips(): void
    {
        Mail::fake();

        // Three different IPs, same address (in different case): all accepted.
        foreach (['10.0.0.1', '10.0.0.2', '10.0.0.3'] as $ip) {
            $this->withServerVariables(['REMOTE_ADDR' => $ip])
                ->postJson('/contact', $this->contact(['email' => $ip === '10.0.0.2' ? 'Sanne@Example.com' : 'sanne@example.com']))
                ->assertOk();
        }

        // A fourth IP with the same address is refused ...
        $this->withServerVariables(['REMOTE_ADDR' => '10.0.0.4'])
            ->postJson('/contact', $this->contact())
            ->assertStatus(429)
            ->assertHeader('Retry-After');

        // ... while another address from that IP still goes through.
        $this->withServerVariables(['REMOTE_ADDR' => '10.0.0.4'])
            ->postJson('/contact', $this->contact(['email' => 'other@example.com']))
            ->assertOk();

        Mail::assertSentCount(4);
    }

    public function test_website_check_is_throttled_per_checked_site(): void
    {
        Mail::fake();

        foreach (['a', 'b', 'c'] as $who) {
            $this->postJson('/contact', [
                'type' => 'website_check',
                'scan_url' => $who === 'b' ? 'https://www.uwzaak.nl/over' : 'uwzaak.nl',
                'email' => "{$who}@example.com",
                FormTimer::FIELD => $this->startedAgo(),
            ])->assertOk();
            $this->travel(1)->minutes(); // stay under the per-minute IP limit
        }

        $this->postJson('/contact', [
            'type' => 'website_check',
            'scan_url' => 'UWZAAK.nl',
            'email' => 'd@example.com',
            FormTimer::FIELD => $this->startedAgo(),
        ])->assertStatus(429);
    }

    public function test_form_sent_too_fast_pretends_success_without_sending(): void
    {
        Mail::fake();
        Log::spy();

        $this->postJson('/contact', $this->contact([FormTimer::FIELD => FormTimer::token()]))
            ->assertOk()
            ->assertJsonPath('message', 'Verzonden.');

        Mail::assertNothingSent();
        Log::shouldHaveReceived('info')->withArgs(fn ($message, $context) => $context === ['reason' => 'too_fast', 'type' => 'contact']);
    }

    public function test_missing_forged_or_stale_form_time_pretends_success_without_sending(): void
    {
        Mail::fake();

        $stale = $this->startedAgo(FormTimer::MAX_SECONDS + 60);
        [$time] = explode('.', $this->startedAgo());

        foreach ([null, 'nonsense', $time.'.'.str_repeat('0', 64), $stale] as $i => $token) {
            $this->postJson('/contact', $this->contact([
                'email' => "bot{$i}@example.com",
                FormTimer::FIELD => $token,
            ]))->assertOk();
        }

        Mail::assertNothingSent();
    }

    public function test_line_breaks_are_stripped_from_name_and_email(): void
    {
        Mail::fake();

        $this->postJson('/contact', $this->contact([
            'name' => "Sanne\r\nBcc: victim@example.com",
        ]))->assertOk();

        Mail::assertSent(ContactFormSubmission::class, fn ($mail) => $mail->data['name'] === 'Sanne Bcc: victim@example.com');

        // An address with an injected header line is no address at all.
        $this->postJson('/contact', $this->contact([
            'email' => "sanne@example.com\r\nBcc: victim@example.com",
        ]))->assertStatus(422)->assertJsonValidationErrors(['email']);
    }

    public function test_message_that_is_mostly_links_is_rejected(): void
    {
        Mail::fake();

        $this->postJson('/contact', $this->contact([
            'message' => 'https://a.example https://b.example https://c.example https://d.example',
            'email' => 'a@example.com',
        ]))->assertStatus(422)->assertJsonPath('errors.message.0', 'Uw bericht mag maximaal 3 links bevatten.');

        $this->postJson('/contact', $this->contact([
            'message' => 'https://cheap-pills.example/buy-now-1234567',
            'email' => 'b@example.com',
            'locale' => 'en',
        ]))->assertStatus(422)->assertJsonPath('errors.message.0', 'Please describe your question in words, not only with links.');

        $this->postJson('/contact', $this->contact([
            'name' => 'Visit www.spam.example',
            'email' => 'c@example.com',
        ]))->assertStatus(422)->assertJsonValidationErrors(['name']);

        // A normal message with one link is fine.
        $this->postJson('/contact', $this->contact([
            'message' => 'Mijn huidige site is https://uwzaak.nl en die wil ik vernieuwen.',
            'email' => 'd@example.com',
        ]))->assertOk();

        Mail::assertSentCount(1);
    }

    public function test_select_fields_only_accept_the_offered_options(): void
    {
        $this->postJson('/contact', $this->contact(['project_type' => '<b>x</b>', 'budget' => 'lots']))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['project_type', 'budget']);
    }

    public function test_plain_text_mail_is_not_html_escaped(): void
    {
        $mail = new ContactFormSubmission([
            'type' => 'contact',
            'name' => "Sinéad O'Brien",
            'email' => 'owner@example.com',
            'message' => 'Kosten < 5000 & "snel"?',
        ]);

        $text = view('emails.contact-text', ['data' => $mail->data, 'isCheck' => false])->render();

        $this->assertStringContainsString("Van: Sinéad O'Brien <owner@example.com>", $text);
        $this->assertStringContainsString('Kosten < 5000 & "snel"?', $text);
        $this->assertStringNotContainsString('&#039;', $text);
    }

    public function test_mail_escapes_user_input(): void
    {
        $mail = new ContactFormSubmission([
            'type' => 'contact',
            'name' => '<script>alert(1)</script>',
            'email' => 'owner@example.com',
            'message' => '<img src=x onerror=alert(1)>',
        ]);

        $html = $mail->render();

        $this->assertStringNotContainsString('<script>', $html);
        $this->assertStringNotContainsString('<img', $html);
        $this->assertStringContainsString('&lt;script&gt;', $html);
    }

    public function test_every_form_carries_the_time_trap_and_the_privacy_line(): void
    {
        foreach (['/' => 3, '/en' => 3, '/contact' => 1, '/diensten/websites' => 1] as $path => $forms) {
            $html = $this->get($path)->assertOk()->getContent();

            $this->assertSame($forms, substr_count($html, 'data-v2-form'), $path);
            $this->assertSame($forms, substr_count($html, 'name="'.FormTimer::FIELD.'" value="'), $path);
            $this->assertSame($forms, substr_count($html, 'class="form-note form-privacy"'), $path);
            $this->assertStringContainsString('href="'.url('/privacyverklaring').'"', $html);
        }
    }
}
