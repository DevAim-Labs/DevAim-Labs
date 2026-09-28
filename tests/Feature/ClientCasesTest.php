<?php

namespace Tests\Feature;

use App\Support\ClientCases;
use Tests\TestCase;

class ClientCasesTest extends TestCase
{
    private ?string $tempFile = null;

    protected function tearDown(): void
    {
        if ($this->tempFile) {
            @unlink($this->tempFile);
        }
        ClientCases::flush();

        parent::tearDown();
    }

    /** The real resources/data/clients.json: valid JSON, every entry complete. */
    public function test_the_clients_file_is_valid(): void
    {
        $entries = ClientCases::decode();

        $this->assertNotEmpty($entries, 'clients.json has no clients.');
        foreach ($entries as $index => $entry) {
            $this->assertIsArray($entry, 'Client #'.($index + 1).' must be an object { ... }.');
            $this->assertSame([], ClientCases::problems($entry, $index));
        }
    }

    public function test_up_to_three_clients_show_no_toggle(): void
    {
        $this->useClients(3);

        $html = $this->get('/')->assertOk()->getContent();
        $this->assertSame(3, substr_count($html, 'class="case-row"'));
        $this->assertStringNotContainsString('data-case-toggle', $html);
    }

    public function test_more_than_three_clients_get_a_show_all_toggle(): void
    {
        $this->useClients(5);

        $this->get('/')
            ->assertOk()
            ->assertSee('data-case-more', false)
            ->assertSee('Toon alle 5 klanten')
            ->assertSee('Klant 5');

        $this->get('/en')->assertOk()->assertSee('Show all 5 clients');
    }

    public function test_service_pages_show_only_their_own_clients(): void
    {
        $this->useClients(2, services: ['betalingen']);

        $this->get('/diensten/betalingen')->assertOk()->assertSee('Klant 1');
        $this->get('/diensten/websites')->assertOk()->assertDontSee('Klant 1');
    }

    public function test_english_falls_back_to_dutch_and_domain_comes_from_the_url(): void
    {
        $this->useClients(1);

        $this->get('/en')
            ->assertOk()
            ->assertSee('Wat klant 1 wilde.')
            ->assertSee('klant1.example');
    }

    public function test_an_incomplete_entry_is_skipped_not_fatal(): void
    {
        $this->writeClients([
            ['name' => 'Zonder url', 'logo' => '/lokanta.webp', 'problem' => ['nl' => 'x'], 'built' => ['nl' => 'y']],
            $this->client(2),
        ]);

        $this->get('/')->assertOk()->assertDontSee('Zonder url')->assertSee('Klant 2');
    }

    public function test_broken_json_keeps_the_site_up(): void
    {
        $this->tempFile = tempnam(sys_get_temp_dir(), 'clients');
        file_put_contents($this->tempFile, '[{"name": "Kapot",}');
        config(['site-v2.clients_file' => $this->tempFile]);
        ClientCases::flush();

        $this->get('/')->assertOk()->assertDontSee('Kapot');
    }

    private function useClients(int $count, array $services = ['websites']): void
    {
        $this->writeClients(array_map(fn (int $n) => $this->client($n, $services), range(1, $count)));
    }

    private function client(int $n, array $services = ['websites']): array
    {
        return [
            'name' => "Klant {$n}",
            'url' => "https://www.klant{$n}.example",
            'logo' => '/lokanta.webp',
            'services' => $services,
            'tags' => ['nl' => ['Website']],
            'problem' => ['nl' => "Wat klant {$n} wilde."],
            'built' => ['nl' => "Wat ik voor klant {$n} bouwde."],
        ];
    }

    private function writeClients(array $clients): void
    {
        $this->tempFile = tempnam(sys_get_temp_dir(), 'clients');
        file_put_contents($this->tempFile, json_encode($clients));
        config(['site-v2.clients_file' => $this->tempFile]);
        ClientCases::flush();
    }
}
