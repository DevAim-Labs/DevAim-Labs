# Service Detail Pages & Live Demo Embedding — DevAim Labs

**Question:** What makes a high-converting service detail page for a small web/software studio, and how do the best sites embed live product demos on a service page?
**Date:** 2026-09-28
**Scope:** 6 Dutch agency/freelancer service ("dienst") pages, 5 SaaS/product pages that show off a product, 3 integration-platform pages (for the API-integrations page, which has no demo), plus the web-platform docs (MDN, WHATWG, web.dev, W3C WAI, WebKit) that cover the technical embedding questions. The four demos in `public/demo/` were also checked for the constraints they impose.

## Method and source notes

- Each page was read directly on 2026-09-28 with WebFetch (HTML turned into Markdown, then summarised). For key claims I also ran `curl` and grepped the raw HTML: CL Web's price, In Your Face's pricing block and FAQ heading, Stripe's demo links and whether any `<iframe>`/`<video>` is present, and Zapier's page text. **None of the pages was seen rendered in a browser.** Descriptions like "animated", "interactive" or "screenshot" come from markup, alt text and copy, not from watching the page. Anything marked *(inferred)* is a reading of the code.
- Some WebFetch summaries come from a small model. Where the raw HTML contradicted or narrowed a summary, the raw HTML wins, and the entry says so.
- Technical claims cite primary sources only: MDN, WHATWG HTML, web.dev / developer.chrome.com, W3C WAI, and the WebKit blog.
- The DevAim demo facts (sizes, labels, APIs used) come from grepping `public/demo/*.html` in this repo.
- Dutch copy is quoted as it appears. English glosses are in brackets.

---

## Part 1 — Dutch agency and freelancer service pages

### 1. Studio Brabo, "Lead website laten maken" — https://studiobrabo.nl/wat-we-doen/lead-websites/
- **Section order:** H1 "Lead website laten maken", sub "zonder te schreeuwen 💬" → 4 feature blocks (speed, SEO, marketing dashboard, conversion forms) → "Een lead website die aansluit op je doelgroep" with a mobile screenshot of the Boxtom case and "Bekijk case" → grid of other services (Branding, Corporate, Webshops, AI, Social…) → measurement/tracking explanation → "Zij gingen je voor" (5 case cards with industry tags) → "Leads succesvol opvolgen met koppelingen en integraties" (15+ CRM logos: HubSpot, Salesforce, AFAS, Pipedrive…) → CTA "Plan adviesgesprek" → 3 insight articles → FAQ (6 questions) → "Wat maakt een lead website succesvol?" → "Voor wie is een lead website interessant?" → footer with "5.0 [40+ reviews]".
- **Visual proof:** Static case screenshots (a phone mockup) and case cards. No live demo.
- **CTA:** One verb only ("Plan adviesgesprek"), placed after the value and proof sections. Contact details in the footer.
- **Pricing / FAQ / process:** No price. The FAQ is extensive. There is no process block on this page; process lives in a separate "Aanpak" section of the site.
- **Cross-links:** A full service grid in the middle of the page, plus inline links to related pages ("marketingdashboard", "SEO").
- **Borrow:** An integrations logo strip on a *non-integration* service page tells the reader "your leads go into your CRM". The "Voor wie is dit?" block qualifies leads. Case cards carry industry tags.

### 2. CL Web, "API koppeling laten maken" — https://www.clweb.nl/maatwerk-api-koppeling-laten-maken
- **Section order:** H1 "API koppeling laten maken", with a problem-first sub: "Werk je met twee systemen die niets van elkaar weten? Dan typ je gegevens twee keer in…" [Using two systems that don't know about each other? Then you type data in twice…] → **"Wat kost een API koppeling?" as the first section, "vanaf € 2.500" excl. VAT** (confirmed in raw HTML) plus the cost drivers → "Wat is een API koppeling?" → "Systemen waarmee we koppelen" (grouped by category: e-commerce, logistics, accounting/ERP such as Exact Online, AFAS and SnelStart, marketplaces) → 2 named cases (Hexon at RoyaalLease; 17 webshop and 12 carrier integrations in Kolibri's CloudWMS) → benefits (Toekomstproof / Veilig / Schaalbaar) → "Van idee tot oplevering: onze aanpak" (3 steps: Intake → Ontwikkeling en testen → Onderhoud) → "Bestaande API koppelen" (fixing broken integrations) → FAQ (6: price, lead time "twee tot drie weken" for simple ones, systems without an API, source-code ownership, API version changes, WordPress) → testimonial → founder contact card.
- **Visual proof:** **None.** The raw HTML contains only icon SVGs and a few `<img>` tags (headshot, certification badges). No diagram, screenshot or video. The integration is explained entirely in words and logo/category lists.
- **CTA:** "Bel ons" (phone) and "Ons werk" at the top. A founder card with phone at the bottom.
- **Cross-links:** Web application, custom software, customer portal, hosting, security, and taking over an application, plus blog posts.
- **Borrow:** Price first, answering the question the searcher actually typed. Concrete numbers in the cases ("17 webshop-koppelingen"). FAQ on ownership and on "what if the API changes". The "systemen waarmee we koppelen" grouping. **Gap to exploit:** there is no visual at all. An illustrated data flow would beat this page outright.

### 3. Carlo Kop, "Webapplicatie laten maken" — https://carlokop.nl/development/webapplicatie-laten-maken/
- **Section order:** H1 "Webapplicatie laten maken" → intro + "Neem contact op" → **quote form ("Offerte aanvragen") high on the page** → "Hoe bouw ik een webapplicatie" (MVP-first, iterations, team for projects over 200 hours) → second contact form → "Flexibele en toekomstbestendige webapplicaties" with a BudgetRuimte screenshot → 1 review (5/5 "Snel en technisch zeer bekwaam.") → cases link + Chalet Porleza screenshot → "Wat voor een webapplicatie heeft u nodig?" → AI-assisted development paragraph → FAQ (a link out only, no questions on the page) → third quote form → contact details.
- **Visual proof:** Responsive-device screenshots of client work and a team photo.
- **CTA:** Three forms and three "Neem contact op" buttons. Very aggressive, and it repeats itself.
- **Pricing:** None on this page. The site has a separate cost article (`/blog/wat-kost-website-laten-maken-2026/`, linked from the homepage).
- **Borrow:** An MVP framing that lowers the perceived risk. A form reachable early. **Avoid:** three identical forms, and an FAQ that is only a link, which throws away the objection handling and the FAQ rich-result content.

### 4. In Your Face Media, "Webshop Laten Ontwikkelen" — https://inyourfacemedia.nl/webshop-laten-ontwikkelen/
- **Section order:** Hero (H1, benefit bullets, "Neem vrijblijvend contact op", trust badge 4.8/5 from 120+ businesses) → long descriptive copy (payments: iDEAL, PayPal, Stripe) → "Gericht op echte resultaten" (5 case cards with tags + "Bekijk de case") → contact/WhatsApp → 4-step process (Doelstellingen & Strategie → Aan de slag → **Demo & feedback** → Oplevering & Nazorg) → contact form → "Onze specialismen" (6 cards) → pricing block → client logos → 4 named reviews → large internal-link mega-menus → FAQ → founder block with "Gratis groeigesprek" [free growth call] → footer with another form.
- **Honest oddity (checked in raw HTML):** the pricing block on this *webshop* page is **"Prijs Linkbuilding"** (€150 / €300 / €450 per month), and the FAQ heading reads **"Meest gestelde vragen marktplaats laten maken"** [FAQ about building a marketplace]. Both are template blocks reused from other pages. For an owner comparing studios this undermines trust.
- **Visual proof:** Case cards with screenshots, a logo wall, and reviews.
- **Borrow:** The rating badge in the hero, named reviews, and "Demo & feedback" as an explicit process step. **Avoid:** reusing sections across services without adapting them, and link mega-menus that bury the page's single goal.

### 5. Spaiker, "Dashboard laten maken" — https://spaiker.nl/dashboard-laten-bouwen
- **Section order:** "Een dashboard dat laat zien hoe je bedrijf draait" → "Wat je krijgt" → "Dit zit er in de MVP van je dashboard" → dashboard types → "Zo werkt het: Van idee naar beslissing in drie stappen" (Strategiesessie → **MVP op dummy data** → Jij beslist) → FAQ (price, "Is Power BI niet genoeg?", lead time, which systems, standard vs custom) → "Andere oplossingen" (cross-links) → "Een MVP van jouw dashboard zien?" with "Plan een strategiesessie" / "Bekijk onze cases".
- **Visual proof:** None embedded. The *offer itself* is a demo: "Een echte, klikbare versie van je dashboard, gevuld met voorbeelddata." [A real, clickable version of your dashboard, filled with example data.]
- **Pricing:** A fixed price is agreed after the session, with a link to a "wat kost een dashboard" page.
- **Borrow:** The wording "klikbaar" + "voorbeelddata" is exactly the language DevAim's demos can make tangible *on the page*. The "Is Power BI niet genoeg?" FAQ answers the alternative the reader is already weighing. The closing headline is phrased as the demo promise.

### 6. Appfront, "KPI dashboard op maat" — https://appfront.nl/diensten/software-ontwikkeling/kpi-dashboard-op-maat
- **Section order:** "KPI dashboard op maat." → "Een dashboard op maat is geen vervanger van Power BI." → what makes it different → "Zes typen dashboards die wij bouwen." → "Wat u krijgt aan het einde." → "Wanneer een dashboard op maat de juiste keuze is." → 4-step process (Kennismaking → KPI's en data in kaart → Bouw in sprints → Uitrol en beheer) → tech stack → FAQ (9: connectors, real-time vs scheduled, white-label, access control, ERP, hosting/security, cost drivers, phased rollout) → "Gerelateerd" (ERP op maat, **Slimme API-integraties**, Software-ontwikkeling).
- **Visual proof:** None: no screenshot, no demo, no video. Text and lists only.
- **CTA:** "Plan een kennismaking", "Bekijk ons werk", "Contact opnemen".
- **Borrow:** "Wanneer is dit de juiste keuze" (and implicitly when it isn't) as an honest qualifier. The "Wat u krijgt aan het einde" deliverables list. The dashboards → API integrations cross-link, which is a natural pairing for DevAim too.

**Dutch market take-away:** none of the six Dutch service pages embeds a working demo. The best (CL Web, Spaiker) put price or the demo-promise first, while the weakest stack forms and reuse template blocks. That confirms the gap noted in `competitors.md`: a live, clearly labelled demo on the service page is a real differentiator.

---

## Part 2 — Product pages that show the product well

### 7. Stripe Checkout — https://stripe.com/payments/checkout (served in Dutch, NL locale)
- **Section order:** Hero "De betaalpagina voor iedereen" → **in-page product demo** (a fictional "Powdur" store: product, cart, payment form, with variants for iDEAL/card/Przelewy24, several languages and mobile) → conversion benefits → design → "Geoptimaliseerd voor elk apparaat" → global → branding → "Kies wat bij je past" (integration options) → security → 4 customer stories with metrics (e.g. GroupGreeting +8% conversion) → "Wat zit er allemaal in?" feature checklist → **"Tarieven" on the page** (e.g. "1,5% + € 0,25" for standard EU cards) → closing CTA.
- **How the demo is presented (raw HTML):** the page has **no demo `<iframe>`**. The only iframe is the chat widget. The in-page checkout is native page markup with a fictional brand *(it is inferred to be a scripted, partly interactive illustration, but it was not seen running)*. The *full* demo sits on a **separate site, https://checkout.stripe.dev/**, and the "Bekijk de demo" link appears **4 times**: next to "Start nu" in the hero, under the integration-options section, in the closing section, and in the sticky nav. So the pattern is a lightweight preview in the page plus "open the real sandbox" as a first-class secondary CTA everywhere the primary CTA appears.
- **checkout.stripe.dev:** the fetch returned little. It shows a "Change demo" control and a "Start building" CTA. Controls could not be verified without rendering.
- **Borrow:** A fictional brand in the demo so no one mistakes it for a real shop. The demo CTA paired with the primary CTA in the same button group. Pricing and a "what's included" checklist on the product page itself. Customer stories with one number each.

### 8. Mollie Checkout — https://www.mollie.com/nl/products/checkout (plus the iDEAL page https://www.mollie.com/nl/payments/ideal)
- **Section order (Checkout):** "Boost je conversie met een gepersonaliseerde checkout-ervaring" → conversion-optimised checkout → "Creëer een optimale checkout-ervaring voor elke klant" → ready-made checkout vs "Bouw een checkout op maat met Components" → "Binnen no-time aan jouw webshop toegevoegd" → payment methods (40+) → "Veelgestelde vragen" (8) → closing CTA.
- **Visual proof:** Product images of checkout screens with sample orders (e.g. "Nike Air Max", "Electric bike") *(images, not interactive; no "probeer de demo" link was found)*. Secondary links go to the docs ("Bekijk de standaard checkout").
- **CTA:** "Begin meteen" top, "Nu beginnen" + "Neem contact op met sales" bottom.
- **iDEAL page:** activation CTA first ("Activeer iDEAL-Betalingen"), **"Tarieven" at €0,32 per transaction**, a 12-question FAQ, then related methods (Wero, SEPA, Bizum…). The payment flow is explained step by step in text inside the FAQ.
- **Borrow:** Two tiers side by side (ready-made vs custom build) maps well to DevAim's "Mollie/Stripe-hosted checkout vs custom-built flow". Plain Dutch copy. An FAQ that walks through the payment flow step by step.

### 9. Linear Insights — https://linear.app/insights
- **Section order:** Hero → "Instant analytics for any stream of work" → "Drill down on any data point" → "Zoom out to narrow in" → "Combine insights into dashboards" → "Fully modular" → "Built to share. Designed for privacy." → Use cases → Tech specs → footer.
- **Visual proof:** High-fidelity static product screenshots, one per capability heading. No video, no embed.
- **CTA:** "Get started" / "Contact sales" at the bottom. A mid-page "Learn how to use Dashboards".
- **Pricing:** A single line stating which plan includes the feature. No FAQ.
- **Borrow:** Headings that are verbs describing what the *user* does ("Drill down…", "Zoom out…"), each paired with one visual. A "Tech specs" section fits DevAim's technical-credibility angle (stack, hosting, AVG/GDPR).

### 10. Vercel template, Next.js Commerce — https://vercel.com/templates/next.js/nextjs-commerce
- **Layout:** A large screenshot → **"Deploy" + "View Demo"** buttons → description → providers (each with its own demo link) → integrations → local setup → metadata sidebar (Use Case, Stack, Repository) → related templates.
- **Demo presentation:** A screenshot on the page with the live demo **opening as a separate full site**. No inline iframe.
- **Borrow:** A metadata sidebar ("Use case / Stack") translates well to a small "Wat zit erin" box next to each DevAim demo (Laravel, Mollie, responsive, etc.). Related templates work as cross-links.

### 11. Retool, admin panels — https://retool.com/use-case/admin-panels
- **Section order:** "The fastest way to build an admin panel" → "Easily connect to your datasource…" → "Drag, drop, and build your admin panel" → "50+ drag and drop components" → customer logos → 1 CTO testimonial → "building blocks for any internal tool" → closing.
- **Visual proof:** Four builder screenshots. No interactive demo on this page.
- **CTA:** "Book a demo" top and bottom. A demo *meeting* replaces a demo *embed*.
- **Borrow:** Connecting the admin panel to the systems the owner already uses ("connect to your datasource") comes before the UI. **Contrast:** Retool makes you book a call to see the product, whereas DevAim can show it without a call. That is the pitch.

---

## Part 3 — Integration pages (for the API-integration service, which has no demo)

### 12. Zapier, Google Sheets + Slack — https://zapier.com/apps/google-sheets/integrations/slack
- **Section order (raw HTML text):** "Google Sheets + Slack" (two logos with a connector) → "Connect Google Sheets and Slack to power AI-driven automation" + trust bullets → **a trigger/action picker: "Choose a Trigger — When this happens…" / "Choose an Action — automatically do this!"** with "Swap apps" → "Get started free" → template cards phrased as outcomes ("Send Slack messages whenever Google Sheets rows are updated", each with "Details" / "Try it") → logos → **"How Zapier works"**, a mock editor UI rendered in the page ("1. Choose trigger event", "2. Choose action", "Setup / Test", ending in "You're connected!") → a supported triggers and actions list.
- **Proof tool:** In the product, runs show up in a **Zap history with statuses** (Successful, Errored, Filtered, Delayed…): https://help.zapier.com/hc/en-us/articles/20505304170637-Review-Zap-run-statuses. It is not shown on the marketing page, but it is the mental model users have of "an integration working".
- **Borrow:** The **"Wanneer dit gebeurt → doe automatisch dit"** sentence structure. Outcome-phrased example cards. A mock UI instead of a real embed.

### 13. Make, Google Sheets + Slack — https://www.make.com/en/integrations/google-sheets/slack
- **Section order:** Trigger selection → "Swap apps" → action selection → logos → CTA → module list → popular templates → FAQ → how it works → testimonials.
- **Visual proof:** Node-style scenario imagery ("greenhouse, facebook, twitter and linkedin integration in make app") *(images, not seen animated)*.
- **CTA:** "Get started free", "Talk to sales".
- **Borrow:** A connected-bubbles diagram as the visual shorthand for "systems talking to each other".

### 14. Twilio Segment — https://www.twilio.com/en-us/segment
- **Visual:** A **hub-and-spoke diagram**: sources (Braze, Node.js, SQL database) → "Connections" hub → destinations. Headings: "Collect real-time data in unified profiles—and so much more", "Connections — Customer data pipeline".
- **CTA:** "Explore Connections", "View pricing".
- **Borrow:** A left-to-right sources → hub → destinations layout is the most recognisable "data flow" picture. For DevAim the hub is "uw systeem / koppeling". (The old segment.com/catalog URL now redirects to twilio.com/en-us/catalog, and the connections sub-page returned 404 at fetch time.)

(n8n's pair page, https://n8n.io/integrations/google-sheets/and/slack/, was also checked. It uses template cards only, and its CTA is "See n8n in action".)

---

## Part 4 — Technical and UX practice for embedding a live HTML demo

### 4.1 Constraints from DevAim's own demos (repo facts)
- Sizes: website 149 KB, adminpaneel 188 KB, kpi-dashboard 168 KB, betaalsysteem 169 KB raw. **Gzipped: 105 / 133 / 109 / 117 KB.** Base64 `data:` fonts account for about 131–167 KB of each file, which is why gzip barely helps. Every demo inlines its own copy, so nothing is cached between demos.
- There are **no external URLs** in the four demos (all fonts are inline), so an opaque-origin sandbox won't break font loading.
- **None of the four demos uses localStorage/sessionStorage** (only `/demo/index.html` does), so dropping `allow-same-origin` is safe.
- **`betaalsysteem.html` uses a real `<form id="payForm">` with a JS `submit` listener.** It will silently stop working in a sandbox without `allow-forms` (see 4.3).
- Each demo already carries its own label, "Voorbeeld door DevAim Labs, fictief bedrijf en data…" (betaalsysteem: "…nepdata en geen echte betaling."), plus a link to `/demo/`. Each also honours `prefers-reduced-motion`. **None sets `overscroll-behavior`.** The admin and KPI demos have `min-width: 780px` / `640px` rules, so they are desktop-first.

### 4.2 Iframe vs click-to-load facade
- `loading="lazy"` defers an iframe "until it reaches a calculated distance from the visual viewport, as defined by the browser", and only when JS is enabled (https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/iframe). It is supported in Chrome 77+, Firefox 121+ and Safari 16.4+, and web.dev reports median data and FCP gains (https://web.dev/articles/iframe-lazy-loading). **Lazy still loads the whole demo as soon as the visitor scrolls near it**, whether or not they want to use it.
- A **facade** is "a static element that looks similar to the embedded third-party, but is not functional". It loads the real thing on click, and can warm up on hover (https://developer.chrome.com/docs/lighthouse/performance/third-party-facades). The documented trade-off is lost functionality until the click, which is acceptable for a demo the visitor has to choose to try.
- **Recommendation:** a facade by default. Show a screenshot (`<img loading="lazy">` with real `width`/`height`) + "Voorbeelddata" badge + button **"Start live demo"**. On click, insert the `<iframe>` and move focus into it. On desktop, where the demo *is* the hero proof (for example the dashboards page), an eager or `loading="lazy"` iframe without a facade is defensible. Never lazy-load an iframe that sits in the initial viewport (web.dev, same article).
- `fetchpriority` is documented for `link`, `img` and `script`, not iframes (https://web.dev/articles/fetch-priority), so it is only useful on the facade's poster image (`fetchpriority="low"` if below the fold).
- `preconnect` is pointless here. "Preconnecting is only effective for domains other than the origin domain" (https://web.dev/articles/preconnect-and-dns-prefetch), and `/demo/*.html` is same-origin.
- `content-visibility: auto` + `contain-intrinsic-size` on the *long sections below the demo* (FAQ, cases) skips their rendering until needed, and is now in all three engines (https://web.dev/articles/content-visibility). Don't put it on the demo wrapper itself, where a reserved-size box is enough.
- Bigger win, outside the page itself: move the demos' base64 fonts to shared cacheable `.woff2` files. **Caveat:** in an opaque-origin sandbox the font fetch counts as cross-origin, and web fonts are subject to the same-origin restriction unless CORS headers allow them (https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face). So either send `Access-Control-Allow-Origin` for `/fonts/*` or keep fonts inline.

### 4.3 `sandbox` values
- MDN and WHATWG both warn: with a **same-origin** embed, `allow-scripts` + `allow-same-origin` "allows the embedded page to simply remove the sandbox attribute and then reload itself, effectively breaking out of the sandbox altogether" (https://html.spec.whatwg.org/multipage/iframe-embed-object.html; MDN: "strongly discouraged", https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/iframe). DevAim's demos *are* same-origin, so **never combine the two**.
- Without `allow-same-origin` the frame gets an opaque origin that "always fails the same-origin policy (potentially preventing access to data storage/cookies…)" (MDN iframe). That is fine for the demos (see 4.1).
- **`allow-forms` is required for `betaalsysteem.html`.** The HTML form-submission algorithm returns *before firing the submit event* when the "sandboxed forms browsing context flag" is set (https://html.spec.whatwg.org/multipage/form-control-infrastructure.html#form-submission-algorithm). The demo's `submit` listener would never run. MDN puts it this way: "submitting it will not trigger input validation, send data to a web server, or close a dialog".
- `allow-popups` is needed only if a demo opens `target="_blank"` links. `allow-modals` is needed only for `alert/confirm/print` (MDN iframe). The demos' own "Alle voorbeelden" link to `/demo/` would navigate *inside* the frame. Either hide the in-demo banner when embedded (for example `?embed=1`, with the parent page showing the label instead), or add `allow-top-navigation-by-user-activation` (listed in MDN iframe).
- **Suggested:** `sandbox="allow-scripts allow-forms"` (+ `allow-popups` only if needed). Sandboxing first-party code is defence in depth, not a necessity. The key rule is to never add `allow-same-origin` alongside `allow-scripts`.

### 4.4 Scroll and wheel capture
- Nested scrollers chain: when the inner one hits its boundary, the parent scrolls. `overscroll-behavior` on an `<iframe>` element **has no effect**. MDN: "To control scroll chaining from an iframe, set `overscroll-behavior` on both the `<html>` and the `<body>` elements of the iframe's document" (https://developer.mozilla.org/en-US/docs/Web/CSS/overscroll-behavior). `contain` also disables pull-to-refresh and swipe navigation inside it.
- The bigger UX problem is the reverse: a visitor scrolling the *service page* whose cursor or finger passes over a scrollable demo gets "stuck" scrolling the demo. The mitigations are a fixed-height preview that is `inert` until activated, or a facade. `inert` blocks clicks and focus and removes content from the accessibility tree, but MDN warns there is "no visual way to tell" something is inert, so the inactive state must be visibly styled (overlay + button) (https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Global_attributes/inert).
- **Recommendation:** add `html, body { overscroll-behavior: contain; }` to the demo files (for the embedded case), and use click-to-activate so page scrolling never lands inside a demo by accident.

### 4.5 Keyboard and screen-reader access
- Give every iframe a `title` that describes its content, for example `title="Live voorbeeld: KPI-dashboard van fictief bedrijf Havenwerf"`. This is WCAG technique H64 (https://www.w3.org/WAI/WCAG22/Techniques/html/H64), and MDN notes that without it, AT users "have to navigate into the iframe to determine what its embedded content is" (MDN iframe).
- WCAG 2.1.2 No Keyboard Trap: focus must be able to leave via Tab/arrow/Esc, or "the user is advised of the method" (https://www.w3.org/WAI/WCAG22/Understanding/no-keyboard-trap.html). A demo with many tab stops (admin tables, dashboards) needs a **"Sla demo over" skip link** before it and a visible "Demo sluiten / terug naar pagina" control after it. If the demo opens in an overlay, **Esc closes it and returns focus to the trigger button**.
- Buttons of a scaled-down preview fall below WCAG 2.5.8's 24×24 CSS px minimum target size (https://www.w3.org/WAI/WCAG22/Understanding/target-size-minimum.html). This is one more reason not to shrink an interactive iframe on phones.

### 4.6 Fullscreen and open-in-new-tab
- `element.requestFullscreen()` needs transient user activation, and inside frames it needs `allow="fullscreen"` (`allowfullscreen` is legacy, redefined as `allow="fullscreen *"`). Users exit with Esc (https://developer.mozilla.org/en-US/docs/Web/API/Element/requestFullscreen; MDN iframe). MDN flags it as "Limited availability – not Baseline".
- WebKit shipped the unprefixed API in Safari 16.4 "on macOS and iPadOS", **not iPhone** (https://webkit.org/blog/13966/webkit-features-in-safari-16-4/). So a fullscreen button can't be the only way to enlarge the demo.
- **Recommendation:** make "Open in nieuw tabblad" (a plain link to `/demo/x.html`, which already works standalone) the universal option. Offer "Volledig scherm" as a progressive enhancement, shown only when `document.fullscreenEnabled` is true, calling `requestFullscreen()` on the wrapper, not the iframe. The same-origin parent is allowed by default ("default allowlist is self", MDN requestFullscreen).

### 4.7 Mobile behaviour
- The admin and KPI demos have desktop min-widths (780 / 640 px). A `transform: scale()`'d iframe makes text unreadable and targets too small (see 4.5).
- **Recommendation (≤ 768 px):** show a screenshot (or a short looping image) + **"Open de demo"** as a full-page link, the Vercel/Stripe pattern (#7, #10). The website and checkout demos are responsive and could be embedded at phone width, but the new-tab link keeps behaviour consistent across the four pages.

### 4.8 Honest labelling
- Everything that is a demo should say so *outside* the frame too, because the in-demo banner can be scrolled away or hidden in embed mode. A badge on the preview: **"Voorbeelddata · fictief bedrijf"**. A caption below: "Dit is een werkend voorbeeld met nepdata. Er worden geen echte betalingen of gegevens verwerkt." Spaiker uses the same word, "voorbeelddata", in its offer (#5), and Stripe uses a fictional brand ("Powdur", #7).
- The demo `<title>`s already end in "(voorbeeld)", which is good for tab titles when the demo is opened in a new tab.

### 4.9 Sketch (for implementation reference)
```html
<figure class="demo" aria-labelledby="demo-cap">
  <a class="skip" href="#na-demo">Sla demo over</a>
  <div class="demo-stage" data-src="/demo/kpi-dashboard.html?embed=1">
    <img src="/img/demo/kpi-dashboard.webp" width="1280" height="800" alt="Schermafbeelding van het KPI-dashboard-voorbeeld" loading="lazy">
    <span class="badge">Voorbeelddata · fictief bedrijf</span>
    <button type="button" class="demo-start">Start live demo</button>
  </div>
  <!-- on click: replace <img> with
  <iframe src="…" title="Live voorbeeld: KPI-dashboard van fictief bedrijf Havenwerf"
          sandbox="allow-scripts allow-forms" allow="fullscreen" width="1280" height="800"></iframe> -->
  <figcaption id="demo-cap">Werkend voorbeeld met nepdata. <a href="/demo/kpi-dashboard.html" target="_blank" rel="noopener">Open in nieuw tabblad</a></figcaption>
</figure>
<div id="na-demo" tabindex="-1"></div>
```

---

## Part 5 — API integrations: what to show instead of a demo

**Options considered**

| Option | Real-world precedent | Fit for an SMB owner |
|---|---|---|
| Animated data-flow diagram (System A → koppeling → System B) | Segment hub-and-spoke (#14); Make bubbles (#13) | High. Instantly readable, no jargon. |
| "Wanneer dit gebeurt → doe automatisch dit" recipe cards | Zapier trigger/action picker and templates (#12) | High. It is written in the owner's language, about outcomes. |
| Before/after ("nu: 2× overtypen" vs "straks: automatisch") | CL Web's problem-first H1 (#2); the same pain but in words only | High. It states the pain directly. |
| Mini "sync log" (rows: time · event · status ✓ / opnieuw geprobeerd) | Zapier Zap history statuses (help.zapier.com, #12); Stripe Workbench event destinations/health (https://docs.stripe.com/workbench) | Medium-high. It proves reliability and monitoring, which CL Web only claims. |
| Logo wall of systems you connect to | CL Web (#2), Studio Brabo (#1) | Medium. It is recognition, not explanation. |

**Recommendation:** one combined visual, an **illustrated flow with a live-looking sync log underneath**.
1. At the top, 3 nodes left to right: e.g. *Webshop (Mollie-betaling)* → *DevAim-koppeling* → *Boekhouding (Exact Online / Moneybird)*, with a dot travelling along the connectors (CSS/SVG).
2. Underneath, a 4–6 row "sync log" that appends a row every few seconds: `09:14 · Nieuwe bestelling #1042 → factuur aangemaakt · ✓`, one row showing `Tijdelijke fout → automatisch opnieuw geprobeerd · ✓`, labelled **"Voorbeeld · fictieve data"**. That row demonstrates error handling and retries, which is the real value of a custom integration over copy-pasting.
3. Beside it, a before/after strip ("Nu: gegevens 2× invoeren" / "Straks: één keer, automatisch").
4. Below it, Zapier-style recipe cards for common SMB integrations ("Wanneer een klant betaalt → zet de factuur in de boekhouding").

**Accessibility of the animation:** stop it and show a static final state under `prefers-reduced-motion: reduce` (https://developer.mozilla.org/en-US/docs/Web/CSS/@media/prefers-reduced-motion). Because the log auto-updates and runs longer than 5 s, it needs a **pause button** (WCAG 2.2.2, https://www.w3.org/WAI/WCAG22/Understanding/pause-stop-hide.html). The log should not be an `aria-live` region (constant announcements). Instead, give the figure a text alternative that describes the flow.

**Why this beats a full demo:** an integration has no UI of its own, so a fake admin screen would mislead. The flow shows *what moves where*, and the log shows *that it's monitored and self-healing*, the two objections owners have ("werkt het?" and "wat als het misgaat?"). It is also tiny (inline SVG + a few KB of JS), compared with a 150–190 KB demo.

---

## Part 6 — Synthesis: what converts on a service detail page

**Common section pattern across the strongest pages** (CL Web, Spaiker, Stripe, Studio Brabo):
1. **Search-intent H1** ("X laten maken") + a problem- or outcome-first sub (CL Web #2, Brabo #1).
2. **Show it early**: the demo or product visual directly under the hero (Stripe #7). For Dutch pages this slot is empty (Part 1 take-away).
3. **Price anchor early**: "vanaf €…" or a clear "waar de prijs van afhangt" (CL Web puts it first, Stripe and Mollie have "Tarieven" on the page). Hiding price is the norm in NL (4 of 6 here), so showing it stands out.
4. **What you get / what's inside**: a deliverables list (Appfront "Wat u krijgt", Stripe "Wat zit er allemaal in?", Vercel metadata).
5. **Fit qualifier**: "Voor wie / wanneer is dit de juiste keuze" (Brabo, Appfront).
6. **Proof**: 1–2 named cases with one number each, plus a rating badge (CL Web "17 koppelingen", Stripe "+8%", IYFM 4.8/5).
7. **Process in 3–4 steps**, ideally with a demo/MVP step (Spaiker "MVP op dummy data", IYFM "Demo & feedback", CL Web intake → build → maintain).
8. **FAQ of 5–9 real objections**, including price, lead time, ownership, "is tool X niet genoeg?", and "wat als het misgaat" (CL Web, Spaiker, Appfront). It has to be on the page, not linked (Carlo Kop is the anti-pattern).
9. **Cross-links to 2–3 related services** that pair naturally (Appfront dashboards → API; Stripe → related products). Not a mega-menu (IYFM is the anti-pattern).
10. **One closing CTA**, the same verb as the hero, and a secondary "open the demo" CTA wherever the primary appears (Stripe's four "Bekijk de demo" links).

**Demo presentation patterns seen:**
- *Inline preview + "open full demo" link* (Stripe, Vercel). This is the dominant pattern for real interactive demos. No major site found here drops a full interactive app iframe mid-page.
- *High-fidelity screenshots per capability* (Linear, Retool, Mollie).
- *Scripted mock UI* explaining a process (Zapier "How Zapier works").
- *Demo as a meeting* (Retool "Book a demo") or *demo as the offer* (Spaiker). DevAim can go one better by showing it without a call.

**Anti-patterns:** reused template blocks that don't match the service (IYFM pricing and FAQ heading), three identical forms (Carlo Kop), an FAQ that is only a link, pages with no visual at all (CL Web API, Appfront).

## Recommended section blueprint for DevAim service pages

This blueprint synthesises Parts 1–6 with the `ui-ux-pro-max` outputs: the landing pattern "Product Demo + Features" and the page override `design-system/devaim-labs/pages/service.md`, including its verification notes. It applies to all five `/diensten/{slug}` pages. The page keeps the Master's light, warm, editorial style. Only the demo itself is data-dense.

| # | Section | Purpose | Notes |
|---|---------|---------|-------|
| 1 | **Hero**: search-intent H1 ("Adminpaneel laten maken"), a problem-first subheading, the primary CTA "Plan een gratis gesprek", a secondary CTA "Bekijk de live demo ↓" (anchor link), and a small price anchor ("vanaf € …") | Match what the visitor searched for, say who the service is for, and give a price early so they can qualify themselves | Price anchor as CL Web, Stripe and Mollie do (Part 1 §2, Part 2) |
| 2 | **Live demo stage**: the demo facade with a "Voorbeelddata · fictief bedrijf" badge, a 2–3 line caption ("Probeer: voeg een klant toe…"), and the actions "Start live demo" and "Open in nieuw tabblad" | Proof before promises. None of the Dutch competitors has a demo, so this is the differentiator | See the per-breakpoint table below. The API page uses the flow diagram and sync log from Part 5 here instead |
| 3 | **What you get**: 4–6 outcome-phrased deliverables, each tied to a part of the demo where possible ("Rollen en rechten: zie tab Gebruikers in de demo") | Turn the demo into concrete scope | Bento or two-column list; keep to Master spacing |
| 4 | **Voor wie / wanneer**: a fit check with 3 "past bij u als…" items and 1–2 "niet nodig als…" items | Build honesty and trust, and filter out bad-fit leads | Borrowed from Spaiker and Appfront |
| 5 | **Proof**: 1–2 named cases, each with one number, plus a rating or quote | Social proof beyond the demo | Leave this section out rather than invent anything. Fictional demo businesses must never appear as cases |
| 6 | **Process**: 4 steps (kennismaking → demo/MVP → bouwen → live en onderhoud), each with a time indication | Lower perceived risk; the demo/MVP step fits the demo story | CTA under the steps |
| 7 | **Pricing**: "vanaf" price, what drives the cost, and optional maintenance per month | Anchor expectations and cut unqualified requests | Short and specific to each service. Don't reuse a block from another service (IYFM anti-pattern) |
| 8 | **FAQ**: 5–9 real objections written out on the page, using `<details>` markup plus FAQPage JSON-LD | Handle objections and win long-tail SEO | Never just a link to a general FAQ page (Carlo Kop anti-pattern) |
| 9 | **Related services**: 2–3 cards, e.g. Dashboards → "Adminpanelen", "API-integraties"; Betalingen → "Websites", "API-integraties" | Cross-sell and internal linking | Each card gets a thumbnail of its own demo |
| 10 | **Final CTA and short form** (one form only) | Convert | The same CTA wording is repeated in the hero, after the demo and after the process. Only one actual form (Carlo Kop anti-pattern) |

### Demo presentation per breakpoint

| Breakpoint | Presentation |
|---|---|
| **≥ 1024px** | A browser-chrome frame with a reserved `aspect-ratio` of about 16:10 and a width of up to 1200px. On load it shows a static WebP screenshot (the facade) with a "Voorbeelddata · fictief bedrijf" badge, a "Start live demo" button and an "Open in nieuw tabblad" link. On click it swaps to `<iframe src="/demo/x.html" title="Live demo: adminpaneel (voorbeelddata)" sandbox="allow-scripts allow-forms">`. It shows a skeleton with `aria-busy` while loading, and focus moves into the frame. A "Sla demo over" skip link sits before the frame. Fullscreen is an optional extra through `requestFullscreen` on the wrapper, with feature detection. |
| **768–1023px** | Same facade. The iframe loads only on click and fills the frame's full width. Admin and KPI demos have desktop minimum widths, so for those, "Open in nieuw tabblad" is the main action and inline start is secondary. |
| **< 768px** | No inline iframe. Show a screenshot, cropped to the most telling part, plus a full-width button "Open de demo" that opens the demo in a new tab. Add the line "Werkt het best op een groter scherm" for the admin and KPI demos. The website and checkout demos are mobile-friendly and can open directly. |
| **All sizes** | The label appears outside the frame and inside the demo. The demo's own `html` and `body` get `overscroll-behavior: contain`. No autoplay. Under `prefers-reduced-motion` the page does no animation (on the API page the flow is static and has a pause button). No iframe loads until the visitor clicks, which keeps 105–133 KB gzipped per demo off the initial page weight. |
