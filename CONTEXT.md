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

**Organisation**: DevAim Labs itself as the site presents it: name, e-mail,
phone, logo, KvK and BTW numbers, optional `same_as` profiles and address. The
facts live only in `config/organisation.php`; `App\Support\Organisation`
derives the display phone, the `tel:` link, the logo URL and size, and the
schema.org business node. Views get it as `$org` through `SitePage`.

**Lead**: one person's request that reached the business through a site form:
a contact message (`type` contact) or a free website check (`type`
website_check), with name, e-mail, message, and optionally `scan_url`, Project
type and budget. A bot submission is not a Lead: it gets the same answer but is
dropped.

**Lead intake**: `App\Support\LeadIntake`, one submission from arrival to
outcome: locale, cleaning and validation, spam verdict (honeypot and
`FormTimer`), rate-limit keys, mail, and the localized answer from config
`forms.*`. `ContactController` is its HTTP adapter. See
`docs/adr/0001-lead-intake-without-a-mail-port.md`.

**Project type**: the kind of project a Lead is about (`website`,
`adminpaneel`, `maatwerk`, ...). A fixed vocabulary of keys, the same in every
Locale, with localized labels in `site-v2.{locale}.contact.project_types`, read
through `LeadIntake::projectTypes()`. Services and pricing packages name one by
key to preselect it in the form.

**Service**: one thing DevAim Labs builds (websites, admin panels, ...), with a
detail Page per locale. A Service has a stable **key** (`admin-panels`), used in
config and code, and a localized **slug** per locale (`adminpanelen`,
`admin-panels`), used only in URLs. `App\Support\ServiceCatalog` maps between
them; `config/site-v2-services.php` holds the content.

**Client case**: a real client project in `resources/data/clients.json`, edited
by the owner and read through `App\Support\ClientCases`. Lists the Services it
belongs to by key (or Dutch slug).
