<?php

namespace App\Support;

use Illuminate\Support\Facades\Log;
use JsonException;

/**
 * Real client projects, edited by the owner in resources/data/clients.json
 * (see resources/data/README.md). Used by the home "Werk" section, the
 * "Gewerkt met" logo strip and the service pages listed under `services`.
 *
 * Never throws for bad content: an invalid file or an incomplete entry is
 * logged and skipped, so a typo can't take the site (or an error page) down.
 * The tests validate the real file strictly.
 */
final class ClientCases
{
    private const REQUIRED = ['name', 'url', 'logo', 'problem', 'built'];

    /** @var array<string, list<array>> resolved cases per locale, per request */
    private static array $memo = [];

    public static function path(): string
    {
        return config('site-v2.clients_file') ?? resource_path('data/clients.json');
    }

    /** @return list<array> every valid case, in file order, resolved for one locale */
    public static function all(string $locale): array
    {
        $key = self::path().'|'.$locale;
        if (isset(self::$memo[$key])) {
            return self::$memo[$key];
        }

        $raw = self::raw();

        return self::$memo[$key] = array_values(array_filter(array_map(
            fn (mixed $entry, int $index) => self::resolve($entry, $locale, $index),
            $raw,
            array_keys($raw),
        )));
    }

    /** @return list<array> the cases that list this service key (or its NL slug) */
    public static function forService(string $serviceKey, string $locale): array
    {
        return array_values(array_filter(
            self::all($locale),
            fn (array $case) => in_array($serviceKey, $case['services'], true),
        ));
    }

    /** Forget the per-request memo (tests swap the file). */
    public static function flush(): void
    {
        self::$memo = [];
    }

    /**
     * The decoded file, strictly: throws on unreadable or invalid JSON.
     * Only the tests call this directly.
     *
     * @return list<array>
     *
     * @throws JsonException
     */
    public static function decode(): array
    {
        $json = @file_get_contents(self::path());
        if ($json === false) {
            throw new JsonException('Cannot read '.self::path());
        }

        $data = json_decode($json, true, 16, JSON_THROW_ON_ERROR);
        if (! is_array($data) || ! array_is_list($data)) {
            throw new JsonException('clients.json must be a list: [ {...}, {...} ]');
        }

        return $data;
    }

    /** @return list<string> problems per entry, empty when the entry is valid */
    public static function problems(array $raw, int $index): array
    {
        $label = 'Client #'.($index + 1).(isset($raw['name']) ? ' ('.$raw['name'].')' : '');
        $problems = [];

        foreach (self::REQUIRED as $field) {
            if (empty($raw[$field])) {
                $problems[] = "{$label}: missing \"{$field}\"";
            }
        }
        if (! empty($raw['url']) && ! preg_match('#^https?://#i', (string) $raw['url'])) {
            $problems[] = "{$label}: \"url\" must start with https://";
        }
        if (! empty($raw['logo']) && ! is_file(public_path(ltrim((string) $raw['logo'], '/')))) {
            $problems[] = "{$label}: logo file not found in public/: {$raw['logo']}";
        }
        foreach ((array) ($raw['services'] ?? []) as $service) {
            if (self::serviceKey((string) $service) === null) {
                $problems[] = "{$label}: unknown service \"{$service}\"";
            }
        }

        return $problems;
    }

    /** @return list<array> */
    private static function raw(): array
    {
        try {
            return self::decode();
        } catch (JsonException $e) {
            Log::warning('clients.json could not be loaded: '.$e->getMessage());

            return [];
        }
    }

    private static function resolve(mixed $raw, string $locale, int $index): ?array
    {
        if (! is_array($raw)) {
            Log::warning('clients.json entry #'.($index + 1).' skipped: not an object');

            return null;
        }

        if ($problems = self::problems($raw, $index)) {
            Log::warning('clients.json entry skipped: '.implode('; ', $problems));

            return null;
        }

        $logo = '/'.ltrim((string) $raw['logo'], '/');
        [$width, $height] = @getimagesize(public_path(ltrim($logo, '/'))) ?: [200, 80];
        $host = (string) parse_url((string) $raw['url'], PHP_URL_HOST);

        return [
            'name' => (string) $raw['name'],
            'url' => (string) $raw['url'],
            'domain' => preg_replace('/^www\./i', '', $host),
            'image' => $logo,
            'width' => $width,
            'height' => $height,
            'alt' => $locale === 'en' ? "{$raw['name']} logo" : "Logo van {$raw['name']}",
            'tags' => array_values((array) self::localized($raw['tags'] ?? [], $locale, [])),
            'problem' => (string) self::localized($raw['problem'], $locale, ''),
            'built' => (string) self::localized($raw['built'], $locale, ''),
            'results' => array_values((array) self::localized($raw['results'] ?? [], $locale, [])),
            'services' => array_values(array_filter(array_map(
                fn ($service) => self::serviceKey((string) $service),
                (array) ($raw['services'] ?? []),
            ))),
        ];
    }

    /** A plain value, or {"nl": ..., "en": ...} with Dutch as the fallback. */
    private static function localized(mixed $value, string $locale, mixed $default): mixed
    {
        if (is_array($value) && (array_key_exists('nl', $value) || array_key_exists('en', $value))) {
            $picked = $value[$locale] ?? null;

            return ($picked === null || $picked === '' || $picked === []) ? ($value['nl'] ?? $default) : $picked;
        }

        return $value ?? $default;
    }

    /** Accepts the stable key ("payments") or the Dutch slug ("betalingen"). */
    private static function serviceKey(string $service): ?string
    {
        if (in_array($service, ServiceCatalog::keys(), true)) {
            return $service;
        }

        return ServiceCatalog::keyForSlug('nl', $service) ?? ServiceCatalog::keyForSlug('en', $service);
    }
}
