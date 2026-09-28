# Klanten toevoegen (`clients.json`)

`clients.json` is de lijst met klantprojecten. Die lijst verschijnt op drie plekken:
- de sectie "Werk" op de homepage (NL en EN);
- de logostrook "Gewerkt met" onder de hero;
- de dienstpagina's die u bij `services` opgeeft.

De volgorde in het bestand is de volgorde op de site. De eerste 3 zijn direct zichtbaar. Zijn er meer, dan verschijnt de knop "Toon alle klanten".

## Een klant toevoegen

1. Zet het logo in `public/`, bijvoorbeeld in `public/clients/bakkerij-jansen.webp`.
   - Gebruik een logo op een lichte of transparante achtergrond, zo'n 200–400 px breed.
   - De afmetingen worden automatisch uit het bestand gelezen.
2. Kopieer een bestaand blok in `clients.json`, zet een komma achter het vorige blok en vul de velden in:

```json
{
    "name": "Bakkerij Jansen",
    "url": "https://bakkerijjansen.nl",
    "logo": "/clients/bakkerij-jansen.webp",
    "services": ["websites"],
    "tags": { "nl": ["Bakkerij", "Website"], "en": ["Bakery", "Website"] },
    "problem": { "nl": "Wat de klant wilde…", "en": "What the client wanted…" },
    "built": { "nl": "Wat u bouwde…", "en": "What you built…" },
    "results": { "nl": [], "en": [] }
}
```

3. Controleer het bestand met `php artisan test --filter=ClientCases`. Een typfout in de JSON (bijvoorbeeld een vergeten komma) geeft daar een duidelijke melding.
4. Upload het bestand en het logo. De site leest `clients.json` bij elk verzoek, dus u hoeft geen cache te legen.

## Velden

| Veld | Verplicht | Uitleg |
|---|---|---|
| `name` | ja | Naam van de klant |
| `url` | ja | Live site, met `https://`. Het domein onder de naam komt hieruit. |
| `logo` | ja | Pad vanaf `public/`, beginnend met `/` |
| `services` | nee | Op welke dienstpagina's de klant ook staat: `websites`, `adminpanelen`, `dashboards`, `betalingen`, `api-integraties` (de Engelse namen `admin-panels`, `payments` en `api-integrations` werken ook) |
| `tags` | nee | Korte labels per taal |
| `problem` | ja | "De vraag": wat de klant wilde |
| `built` | ja | "Wat ik bouwde" |
| `results` | nee | Alleen echte, controleerbare resultaten, bijvoorbeeld uit Analytics. Een lege lijst betekent dat er niets wordt getoond. |

Ontbreekt een Engelse tekst, dan valt de site terug op de Nederlandse. Een blok zonder `name`, `url`, `logo`, `problem` of `built` wordt overgeslagen en in de log gemeld, zodat de site nooit stukgaat door één onvolledige klant.
