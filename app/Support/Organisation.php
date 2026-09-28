<?php

namespace App\Support;

/**
 * The Organisation (see CONTEXT.md): who runs the site, with the values
 * derived from its facts in config('organisation').
 *
 * - details(): the facts plus phone_display ("+31 6 3852 3099"),
 *   phone_href ("tel:+31638523099") and logo (absolute URL, size). The
 *   views get this array as `$org` through SitePage.
 * - schemaNode(): the ProfessionalService node for JSON-LD, on every page.
 * - id(): the node's @id, for provider / about / publisher references.
 */
final class Organisation
{
    /**
     * @return array{name: string, email: string, phone: string, phone_display: string, phone_href: string, kvk: ?string, btw: ?string, url: string, logo: array{url: string, width: ?int, height: ?int}, same_as: list<string>, address: ?array}
     */
    public static function details(): array
    {
        $facts = config('organisation');

        return [
            'name' => $facts['name'],
            'email' => $facts['email'],
            'phone' => $facts['phone'],
            'phone_display' => self::displayPhone($facts['phone']),
            'phone_href' => 'tel:'.preg_replace('/[^0-9+]/', '', $facts['phone']),
            'kvk' => $facts['kvk'] ?? null,
            'btw' => $facts['btw'] ?? null,
            'url' => url('/'),
            'logo' => self::logo($facts['logo']),
            'same_as' => array_values($facts['same_as'] ?? []),
            'address' => $facts['address'] ?? null,
        ];
    }

    public static function id(): string
    {
        return url('/').'#organization';
    }

    /**
     * The business as a schema.org ProfessionalService. Service-area
     * business: country only, unless config('organisation.address') is set.
     * Empty values are left out.
     *
     * @param  string  $description  the page locale's site description
     */
    public static function schemaNode(string $description): array
    {
        $org = self::details();
        $address = $org['address'];

        return array_filter([
            '@type' => 'ProfessionalService',
            '@id' => self::id(),
            'name' => $org['name'],
            'url' => $org['url'],
            'logo' => array_filter(['@type' => 'ImageObject'] + $org['logo']),
            'image' => asset('og-image.png'),
            'description' => $description,
            'email' => $org['email'],
            'telephone' => $org['phone'],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'contactType' => 'customer service',
                'email' => $org['email'],
                'telephone' => $org['phone'],
                'availableLanguage' => ['nl', 'en'],
            ],
            'vatID' => $org['btw'],
            // Dutch Chamber of Commerce number (KvK), as shown in the footer.
            'identifier' => empty($org['kvk']) ? null : [
                '@type' => 'PropertyValue',
                'propertyID' => 'KvK',
                'value' => $org['kvk'],
            ],
            'areaServed' => ['@type' => 'Country', 'name' => 'Nederland'],
            'address' => array_filter([
                '@type' => 'PostalAddress',
                'streetAddress' => $address['street'] ?? null,
                'postalCode' => $address['postal_code'] ?? null,
                'addressLocality' => $address['city'] ?? null,
                'addressCountry' => 'NL',
            ]),
            'knowsLanguage' => ['nl', 'en'],
            'sameAs' => $org['same_as'],
        ], fn ($value) => $value !== null && $value !== []);
    }

    /**
     * "+31638523099" => "+31 6 3852 3099". A Dutch mobile number is grouped
     * as people write it; any other number is shown as configured.
     */
    private static function displayPhone(string $phone): string
    {
        $digits = preg_replace('/[^0-9+]/', '', $phone);

        if (preg_match('/^\+316(\d{4})(\d{4})$/', $digits, $m)) {
            return "+31 6 {$m[1]} {$m[2]}";
        }

        return $phone;
    }

    /** @return array{url: string, width: ?int, height: ?int} */
    private static function logo(string $path): array
    {
        $file = public_path(ltrim($path, '/'));
        $size = is_file($file) ? @getimagesize($file) : false;

        return [
            'url' => asset(ltrim($path, '/')),
            'width' => $size[0] ?? null,
            'height' => $size[1] ?? null,
        ];
    }
}
