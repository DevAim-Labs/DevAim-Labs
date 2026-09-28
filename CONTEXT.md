# Domain language

The words this codebase uses for its own concepts. Code comments, tests and
commit messages use these names.

**Locale**: a language of the site, `nl` (default, no URL prefix) or `en`
(under `/en`). Every string in `config/site-v2.php` and
`config/site-v2-services.php` exists once per locale.

**Page**: a live page in one locale: a URL that answers 200, is indexable and
appears in the sitemap. Home, contact and privacy (Dutch only) are the fixed
Pages; each Service adds one Page per locale. Error pages and redirects are not
Pages.

**Page registry**: `App\Support\PageRegistry`, the one list of Pages: their
paths, absolute URLs, hreflang alternates and sitemap metadata. Routes,
`SitePage`, the sitemap, `robots.txt`, `llms.txt` and `LegacyRedirects` read it;
nothing else writes a page path.

**Service**: one thing DevAim Labs builds (websites, admin panels, ...), with a
detail Page per locale. A Service has a stable **key** (`admin-panels`), used in
config and code, and a localized **slug** per locale (`adminpanelen`,
`admin-panels`), used only in URLs. `App\Support\ServiceCatalog` maps between
them; `config/site-v2-services.php` holds the content.

**Client case**: a real client project in `resources/data/clients.json`, edited
by the owner and read through `App\Support\ClientCases`. Lists the Services it
belongs to by key (or Dutch slug).
