<?php

namespace App\Http\Controllers;

use App\Support\ClientCases;
use App\Support\Organisation;
use App\Support\PageRegistry;
use Illuminate\Http\Response;

/**
 * robots.txt and llms.txt. Every URL in them comes from the PageRegistry,
 * so they never point at a page that does not exist.
 */
class CrawlerController extends Controller
{
    /**
     * A crawler obeys only the most specific group that names it, so every
     * group repeats the /demo/ rule (the demos are fictional businesses).
     * Search/answer bots (OAI-SearchBot, Claude-SearchBot, PerplexityBot, ...)
     * are what makes the site citable in AI search.
     */
    private const AGENTS = [
        '*', 'Googlebot', 'Bingbot',
        'OAI-SearchBot', 'ChatGPT-User', 'GPTBot',
        'Claude-SearchBot', 'Claude-User', 'ClaudeBot',
        'PerplexityBot', 'Perplexity-User',
        'Google-Extended', 'Applebot-Extended',
    ];

    /** llms.txt "Pagina's": label and summary per fixed Page (services have their own section). */
    private const PAGE_LINES = [
        'home' => ['Home', 'overzicht, werk, werkwijze, tarieven en veelgestelde vragen'],
        'contact' => ['Contact', 'formulier, e-mail en telefoon'],
        'privacy' => ['Privacyverklaring', null],
    ];

    public function robots(): Response
    {
        $groups = implode("\n\n", array_map(fn (string $agent) => "User-agent: {$agent}\nAllow: /\nDisallow: /demo/", self::AGENTS));

        return $this->text($groups."\n\nSitemap: ".route('sitemap')."\n");
    }

    /**
     * Built from the same config as the pages, so it never claims more than
     * the site does (llms.txt is optional; search engines do not rank on it).
     */
    public function llms(): Response
    {
        $org = Organisation::details();
        $nl = config('site-v2.nl');

        $services = $pages = [];
        foreach (PageRegistry::pages() as $page) {
            $key = PageRegistry::serviceKey($page);

            if ($key !== null) {
                $services[] = self::line(
                    config("site-v2-services.services.{$key}.nl.name"),
                    $page,
                    config("site-v2-services.services.{$key}.nl.summary"),
                );
            } else {
                [$label, $summary] = self::PAGE_LINES[$page] ?? [ucfirst($page), null];
                $pages[] = self::line($label, $page, $summary);
            }
        }

        $services = implode("\n", $services);
        $pages = implode("\n", $pages);
        $cases = collect(ClientCases::all('nl'))
            ->map(fn (array $case) => "- {$case['name']} ({$case['url']})")
            ->implode("\n");
        $about = implode(' ', $nl['about']['paragraphs']);
        $stack = implode(', ', $nl['about']['stack']);
        $steps = collect($nl['process']['steps'])->map(fn (array $step) => "- {$step['title']}: {$step['text']}")->implode("\n");

        $body = <<<LLMS
# {$org['name']}

> {$nl['meta']['description']}

{$about}

Taal: Nederlands (standaard) en Engels (/en). Prijzen: vaste prijs vooraf, op aanvraag na een gratis kennismaking.

## Diensten
{$services}

## Werkwijze
{$steps}

## Recent werk (echte klanten)
{$cases}

## Pagina's
{$pages}

## Techniek
{$stack}

## Bedrijfsgegevens
- E-mail: {$org['email']}
- Telefoon: {$org['phone']}
- KvK: {$org['kvk']}
- BTW: {$org['btw']}
LLMS;

        return $this->text($body."\n");
    }

    /** "- [Label](nl url): summary (English: en url)"; summary and English only when there are. */
    private static function line(string $label, string $page, ?string $summary): string
    {
        $line = "- [{$label}](".PageRegistry::url($page, 'nl').')';
        $en = PageRegistry::alternates($page)['en'] ?? null;

        if ($summary !== null) {
            $line .= ": {$summary}";
        }

        return $en !== null ? "{$line} (English: {$en})" : $line;
    }

    private function text(string $body): Response
    {
        return response($body, 200)->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
