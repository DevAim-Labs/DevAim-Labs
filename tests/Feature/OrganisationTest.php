<?php

namespace Tests\Feature;

use App\Support\Organisation;
use Tests\TestCase;

/**
 * The Organisation: one config block, the values derived from it, and the
 * schema.org node every page carries.
 */
class OrganisationTest extends TestCase
{
    public function test_phone_is_derived_for_display_and_for_the_tel_link(): void
    {
        config(['organisation.phone' => '+31638523099']);
        $org = Organisation::details();

        $this->assertSame('+31638523099', $org['phone']);
        $this->assertSame('+31 6 3852 3099', $org['phone_display']);
        $this->assertSame('tel:+31638523099', $org['phone_href']);

        // Not a Dutch mobile number: shown as configured.
        config(['organisation.phone' => '+44 20 7946 0000']);
        $this->assertSame('+44 20 7946 0000', Organisation::details()['phone_display']);
        $this->assertSame('tel:+442079460000', Organisation::details()['phone_href']);
    }

    public function test_schema_node_is_the_professional_service_with_contact_point_and_kvk(): void
    {
        $node = Organisation::schemaNode('Beschrijving');

        $this->assertSame('ProfessionalService', $node['@type']);
        $this->assertSame(url('/').'#organization', $node['@id']);
        $this->assertSame(Organisation::id(), $node['@id']);
        $this->assertSame('Beschrijving', $node['description']);
        $this->assertSame(config('organisation.phone'), $node['telephone']);
        $this->assertSame(config('organisation.email'), $node['contactPoint']['email']);
        $this->assertSame(config('organisation.btw'), $node['vatID']);
        $this->assertSame(['@type' => 'PropertyValue', 'propertyID' => 'KvK', 'value' => config('organisation.kvk')], $node['identifier']);
        $this->assertSame(asset('DevAim_IMG.png'), $node['logo']['url']);
        $this->assertIsInt($node['logo']['width']);

        // Service-area business: no street, no empty sameAs.
        $this->assertSame(['@type' => 'PostalAddress', 'addressCountry' => 'NL'], $node['address']);
        $this->assertArrayNotHasKey('sameAs', $node);
    }

    public function test_optional_same_as_and_address_appear_only_when_set(): void
    {
        config([
            'organisation.same_as' => ['https://www.linkedin.com/company/example'],
            'organisation.address' => ['street' => 'Straat 1', 'postal_code' => '1234 AB', 'city' => 'Plaats'],
        ]);

        $node = Organisation::schemaNode('x');

        $this->assertSame(['https://www.linkedin.com/company/example'], $node['sameAs']);
        $this->assertSame([
            '@type' => 'PostalAddress',
            'streetAddress' => 'Straat 1',
            'postalCode' => '1234 AB',
            'addressLocality' => 'Plaats',
            'addressCountry' => 'NL',
        ], $node['address']);
    }

    public function test_the_facts_live_in_one_config_block(): void
    {
        $this->assertNull(config('site.organization'));
        $this->assertNull(config('site-en.organization'));
        $this->assertNull(config('site-v2.company'));

        // config:cache runs without a request: plain values only.
        $calls = array_filter(
            token_get_all((string) file_get_contents(config_path('organisation.php'))),
            fn ($token) => is_array($token) && $token[0] === T_STRING && ! in_array(strtolower($token[1]), ['null', 'true', 'false'], true),
        );
        $this->assertSame([], array_values(array_map(fn (array $token) => $token[1], $calls)), 'config/organisation.php calls a function');
    }

    public function test_pages_render_the_organisation_from_the_module(): void
    {
        $org = Organisation::details();

        foreach (['/', '/en/contact', '/privacyverklaring'] as $path) {
            $this->get($path)
                ->assertOk()
                ->assertSee('<a href="'.$org['phone_href'].'">'.$org['phone_display'].'</a>', false)
                ->assertSee('mailto:'.$org['email'], false)
                ->assertSee('<span class="mono">'.$org['kvk'].'</span>', false)
                ->assertSee('<span class="mono">'.$org['btw'].'</span>', false);
        }
    }
}
