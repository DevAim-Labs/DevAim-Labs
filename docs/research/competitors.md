# Competitor & Benchmark Research — DevAim Labs

**Question:** Which competitor and benchmark websites should DevAim Labs learn from, and what makes them convert?
**Date:** 2026-09-28
**Scope:** 6 Dutch freelance developers / small studios + 4 international best-in-class studios or solo portfolios.

## Method and source notes

- Each site's homepage was read directly (primary source) on 2026-09-28. Section order, hero copy, proof and pricing come from the live page text.
- Visual theme data (fonts, hex colours, stack, motion libraries) was taken from each site's own HTML and linked CSS, fetched with `curl` and grepped for `font-family`, `@font-face` files, hex values, `theme-color`, and script names (GSAP, Lenis, Swiper, Lottie, Three.js, etc.). Colour frequency tells you roughly which colours dominate but is not a rendered screenshot. Anything marked *(inferred)* is a reasonable reading of the code, not something observed visually.
- Motion descriptions come from the libraries each page loads. The exact choreography was **not** observed in a browser.
- Hero copy is quoted as it appeared on the page. English glosses are in brackets.

---

## Part 1 — Dutch freelancers and small studios

### 1. Stefan Timmer — https://www.stefantimmer.nl/
- **Targets:** Dutch SMBs that need a web application, webshop or website built by a solo freelancer (16+ years of experience, active since 2008).
- **Section order:** Nav → availability notice banner → 4 service cards (Webapplicaties, Webshops, Websites, Advies) → maintenance/support cards → about Stefan (photo and credentials) → long service descriptions → portfolio (8 client projects) → integration diagram → services list → contact/footer.
- **Hero:** "Webapplicatie laten ontwikkelen?" — CTAs "Offerte opvragen" / "Meer info".
- **Proof:** 8 named portfolio projects (e.g. Technico Pharma, Volt4U) and "meer dan 16 jaar ervaring". No reviews and no metrics.
- **Pricing:** None; quote requests only.
- **Lead magnet:** None.
- **Visual:** Light theme on stock Bootstrap 4 (colours `#007bff` blue, `#212529`, `#6c757d`), Open Sans, headshot plus project screenshots. It looks dated and template-like.
- **Motion:** Essentially none. WordPress site with Bootstrap.
- **Works:** The question-style headline matches search intent word for word, which is good for SEO. The availability banner creates scarcity and honesty. The founder's face builds trust.
- **Doesn't:** There's no social proof beyond logos-as-names. The visuals are generic Bootstrap. The page is long and repeats itself with no clear single path.

### 2. Carlo Kop — https://carlokop.nl/
- **Targets:** Dutch businesses that want a freelance developer for WordPress sites or custom apps, plus GA4/GTM analytics.
- **Section order:** Nav → hero (freelancer intro) → **contact form high on the page** → 6 specialisation cards → consult CTA → 3 case studies → data/analytics stats → testimonial → 4 blog posts → FAQ accordion → quote form → contact/footer.
- **Hero:** "Ik ben een freelancer" [I'm a freelancer] — CTAs "Huur mij in" [Hire me] / "Over mij" [About me].
- **Proof:** EPNederland logo, 3 case studies (Daily Workspaces, Reallitytrainingen, Mauk.nu), a "5 / 5" rating with the quote "Snel en technisch zeer bekwaam." and a niche metric ("200+ GTM and Google Analytics accounts configured").
- **Pricing:** None. Offers "vrijblijvend advies" [no-obligation advice] and promises a reply within one working day.
- **Lead magnet:** Free no-obligation advice, a blog and an FAQ.
- **Visual:** Light, neutral Tailwind-style greys (`#171717`, `#101828`, `#e5e7eb`) with **Instrument Sans**. Modern, clean and restrained. Headless WordPress with a Next.js front end.
- **Motion:** Light; the page respects `prefers-reduced-motion`.
- **Works:** A form above the fold removes friction. The specific metric makes a strong niche claim. The FAQ handles objections before they're raised. The one-day reply promise sets expectations.
- **Doesn't:** "Ik ben een freelancer" is weak as a headline because it says what he is, not what the client gets. Blue and grey are forgettable and there's no strong accent.

### 3. Studio Brabo — https://studiobrabo.nl/
- **Targets:** "Ambitieuze marketingteams" [ambitious marketing teams] at organisations that want a self-managed website focused on results.
- **Section order:** Nav → hero → client logo wall → value proposition → stats → team imagery → services grid → case-study carousel → "matching criteria" (is this a fit?) → insights/blog → CTA → footer.
- **Hero:** "Slimme websites die marketing sterker maken 🤘" [Smart websites that make marketing stronger]. Sub: "Voor ambitieuze marketingteams die zelfstandig vooruit willen. Eenvoudig te beheren, gericht op resultaat en klaar om mee te groeien." CTA "Plan kennismaking" [Book an intro].
- **Proof:** 30+ client logos, 5 case studies with industry tags, "5/5 Beoordeeld op Google" with 40+ reviews, and "150+ Websites gebouwd" / "20+ Jaar online ervaring".
- **Pricing:** None.
- **Lead magnet:** None. Conversion runs entirely through the intro call.
- **Visual:** Light **sage/off-white ground `#edf0e7`**, near-black `#111111` text, **acid-lime accent `#e6ff65`**. Typography pairs **Gustavo** (display, with character) and **TT Commons Pro** (body). Team photos and mockups, with occasional emoji.
- **Motion:** Swiper carousels and Lottie micro-animations. Subtle.
- **Works:** The strongest Dutch brand in this set. It has a distinctive palette, a clear ICP in the subheading, stacked proof (logos + Google rating + numbers), and a "fit" section that qualifies leads. The CTA is one repeated verb.
- **Doesn't:** It's aimed at marketing teams, not small owners. With no pricing, very small businesses may bounce.

### 4. De Webteur — https://www.webteur.nl/
- **Targets:** Small SMBs, ZZP'ers, non-profits, healthcare and churches, mostly in the Apeldoorn region.
- **Section order:** Nav → hero image and headline → 4 pillars (Webdesign, Service, Onderhoud, Hosting) → intro → "complete service" → 6 feature cards (price, completeness, quality, maintenance, Joomla, hosting) → portfolio (6) → blog → CTA → footer.
- **Hero:** "Voor mooi en betaalbaar webdesign met complete service" [For beautiful, affordable web design with complete service]. Sub "Uw website in vertrouwde handen" [Your website in trusted hands]. CTAs "Offerte aanvragen" / "Contact".
- **Proof:** 6 named portfolio projects (including Restaurant Kootwijkerduin) and "Meer dan 15 jaar ervaring". No reviews and no logos.
- **Pricing:** None, although the copy says "betaalbaar" [affordable].
- **Lead magnet:** None.
- **Visual:** Light. Raleway + Lato, with **Bubblegum Sans** as a playful display face. Muted terracotta `#c14136`, olive `#84a162` and ochre `#e9ab54` on grey. Font Awesome icons and an animated scroll-mouse cue.
- **Motion:** Scroll cue only.
- **Works:** Uses the formal "u" register (as DevAim now does). The "complete service / trusted hands" promise fits non-technical owners.
- **Doesn't:** Dated look, no social proof, and "affordable" is never backed by a number.

### 5. In Your Face Media — https://inyourfacemedia.nl/
- **Targets:** Ambitious SMBs in and around Amersfoort that want WordPress sites, webshops and SEO.
- **Section order (longest page in the set):** Header with contact info → hero → stats bar → service overview → founder intro → 6 service cards → **pricing (4 tiers)** → benefits → portfolio carousel (9) → long-form results copy → logo wall → testimonials (4.8/5) → FAQ → CTA with founder photo → contact form → footer.
- **Hero:** "SEO & webdesign Amersfoort voor ambitieuze bedrijven" (read in English as "SEO & webdesign Amersfoort for ambitious businesses"). Sub: a fast website, solid technology and better Google positions. Hero CTA is a soft "Scroll"; "Plan een call" [Book a call] sits in the nav.
- **Proof:** "150+ websites", "12+ jaar", "100+ bedrijven geholpen" [100+ businesses helped], 10+ client logos, 9 cases with service tags, and a 4.8 rating with 4 named testimonials.
- **Pricing:** **Yes.** Website from €1,250, webshop from €1,750, SEO from €150/mo, hosting from €15/mo ("prijsindicatie" [price indication]).
- **Lead magnets:** **Free SEO analysis / free SEO quick scan** and a free growth consult.
- **Visual:** Deep navy `#062d52` dominant with signal red `#cb151a` and pink tint `#facccc`. **Mona Sans + Cal Sans** display, Montserrat/Inter. Founder photo, mockups. Built on Elementor.
- **Motion:** **Lenis** smooth scroll, Swiper carousels, Lottie.
- **Works:** The most complete conversion machine in the set. It combines local SEO in the H1, "from" pricing to qualify leads, a free-scan lead magnet, stacked proof and repeated founder-face CTAs.
- **Doesn't:** Very long and heavy (about 930 KB of HTML). A hero CTA of "Scroll" wastes the most valuable click, and the Elementor bloat hurts performance.

### 6. CL Web — https://www.clweb.nl/
- **Targets:** Businesses that need Laravel web apps, process automation and API integrations (including Mollie). **This is the closest functional competitor to DevAim.**
- **Section order:** Nav → hero → 6 service sections → "wat u kunt verwachten" [what you can expect] (6 value props) → CTA → client logos → testimonials → team → contact CTA → footer.
- **Hero:** "CL Web: Laravel specialisten met meer dan 15 jaar ervaring" [Laravel specialists with 15+ years' experience] — CTAs "Bel ons" [Call us] (phone link) / "Ons werk" [Our work].
- **Proof:** 6 client logos (e.g. Boatauction, ServicePlanner, DTC Lease), 2 attributed testimonials, Laravel certification badges and "15+ jaar".
- **Pricing:** None; offers a "vrijblijvend een voorstel" [no-obligation proposal].
- **Lead magnet:** Free consultation only.
- **Visual:** Light, cool grey-blue ground (`#f0f4f7`, `#e9eff4`) with slate text `#2a323c`/`#4a5563` and a coral-red accent `#ff404b`. Nunito + Roboto. Team photos.
- **Motion:** Minimal.
- **Works:** Certification badges and a phone-first CTA suit a B2B software buyer. The "what to expect" section lowers perceived risk.
- **Doesn't:** The H1 is about them, not the customer outcome. The design is generic, and there are no metrics or case results.

---

## Part 2 — International best-in-class (design benchmarks)

### 7. Designjoy — https://www.designjoy.co/
- **Targets:** Startups and small businesses that want ongoing design from a solo designer (Brett Williams), sold as a subscription.
- **Section order:** Nav → hero → intro-call card → 3-step process (Subscribe → Request → Receive) → founder/background → 6 membership benefits → testimonials → awards → recent work → **pricing** → FAQ → book-a-call → footer.
- **Hero:** "Design subscriptions for everyone" / "Pause or cancel anytime" — CTAs "Start today" / "Join Designjoy".
- **Proof:** Client logos, celebrity and brand testimonials (Kevin O'Leary, Webflow), and Product Hunt awards.
- **Pricing:** **Yes.** $4,995/mo (struck through from $5,995).
- **Lead magnet:** 15-minute intro call and a 7-day trial with 75% money-back.
- **Visual:** Light warm off-white with **hot pink `#ff0084` / orange `#ff5a00`** accents on dark slate `#232a37`. Sharp Grotesk and Colfax/Graphik, with playful illustrations and smileys. Built on Webflow.
- **Motion:** Lottie illustrations and small playful loops.
- **Works:** The best example of **productising a one-person service**. It has a clear offer, a 3-step process, a public price, risk reversal and an FAQ. A solo founder comes across as a feature, not a limitation.
- **Doesn't:** The illustrated, playful tone would undersell technical software work. The subscription model doesn't map 1:1 onto project work.

### 8. darkroom.engineering — https://darkroom.engineering/
- **Targets:** Brands and product teams that want high-craft, performant interactive sites and products. The studio was formerly Studio Freight and maintains the Lenis library.
- **Section order:** Hero statement → capabilities → selected work → links. Short and confident.
- **Hero:** "Darkroom is a development studio that turns ambitious products, complicated roadmaps, and demanding digital experiences into work that ships." CTA "Start a project".
- **Proof:** Work speaks for itself: OREO × BTS, PolyAI Looped, Bad Omens, Lightfield CRM, VITURE. No testimonials or metrics on the homepage.
- **Pricing / lead magnet:** None.
- **Visual:** **Pure black** (`theme-color: oklch(0 0 0)`) with **signal red `#e71419`**, custom display faces (Therma, Sauce) plus a mono face. Next.js.
- **Motion:** **Lenis smooth scroll + GSAP + Three.js**, with reduced-motion handled. Motion is the brand here.
- **Works:** A "development studio that ships" positioning stated in one sentence, with engineering credibility shown through craft. Mono type signals "engineers".
- **Doesn't:** This is built for enterprise buyers. With no pricing, process or reassurance, it would lose a small-business owner.

### 9. basement.studio — https://basement.studio/
- **Targets:** Ambitious startups and scale-ups (clients include Vercel, Linear, Cursor, MrBeast).
- **Section order:** Hero → value proposition → selected work (4 cases) → 4 service categories → large logo wall → about → contact.
- **Hero:** "A digital studio & branding powerhouse making cool shit that performs". CTAs are service-category links plus contact.
- **Proof:** 50+ logos, 4 flagship cases, and Awwwards, FWA and Webby awards.
- **Pricing / lead magnet:** None.
- **Visual:** Dark with **one hot orange accent `#ff4d00`**, greys `#1a1a1a`–`#e6e6e6`. **Geist + Geist Mono**. Next.js.
- **Motion:** GSAP-driven reveals and WebGL moments, with reduced-motion handled.
- **Works:** A disciplined palette (black, grey and one accent) and technical mono typography. Logos carry the social proof.
- **Doesn't:** The irreverent tone and absence of process don't suit risk-averse Dutch SMB owners.

### 10. Brittany Chiang — https://brittanychiang.com/
- **Targets:** Recruiters and hiring managers. This is a solo frontend-engineer portfolio and one of the most copied developer sites.
- **Section order:** Sticky left column (name, role, nav, socials) → About → Experience timeline → Projects → Writing → footer.
- **Hero:** "Frontend Engineer" / "I build accessible, pixel-perfect experiences for the web." CTA "View Full Résumé".
- **Proof:** Employer names (Klaviyo, Apple, Harvard Business School) and project metrics ("100k+ Installs", "6k+ stars").
- **Pricing / lead magnet:** None (it's a hiring portfolio).
- **Visual:** **Dark slate `#0f172a`** with a teal accent *(inferred from the known palette)*, Inter, Tailwind. No imagery beyond project thumbnails.
- **Motion:** Minimal. A cursor spotlight glow and hover lifts on cards, with reduced-motion handled.
- **Works:** A one-page, two-column layout with excellent clarity and readability. Metrics on projects make a strong proof pattern.
- **Doesn't:** It isn't a sales page: there's no offer, CTA or pricing. Borrow the craft, not the structure.

---

## Part 3 — Cross-site patterns: what converts

| Pattern | Seen on | Takeaway for DevAim |
|---|---|---|
| Customer-outcome H1 (not "who we are") | Studio Brabo, In Your Face | Lead with what the client gets: more leads, their first website, working payments. |
| Question H1 matching search intent | Stefan Timmer | Use for service pages ("Webapplicatie laten maken?"). |
| Stacked proof (logos + Google rating + numbers) | Brabo, In Your Face | Collect Google reviews early and show project numbers, even small ones. |
| Public "from" pricing | In Your Face, Designjoy | The strongest differentiator in the NL freelance market, since 4 of the 6 Dutch sites hide price. |
| Free scan / quick-scan lead magnet | In Your Face | "Gratis website-scan" is a natural fit for SMBs that already have a site. |
| Form or call CTA above the fold, reply-time promise | Carlo Kop | Promise "reactie binnen 1 werkdag" [reply within one working day]. |
| 3-step process + FAQ + risk reversal | Designjoy, CL Web | Reduces fear for first-time website buyers. |
| Founder face next to CTAs | Stefan Timmer, In Your Face, Designjoy | A one-person studio should make the person the brand. |
| "Is this a fit?" qualifier | Studio Brabo | Filters leads and increases perceived expertise. |
| One accent colour on a disciplined neutral base | basement, darkroom, Brabo | Distinctiveness comes from restraint plus one signature colour. |

Gaps no Dutch competitor fills: **live demos** (DevAim already has demos), **transparent pricing combined with a modern high-craft design**, and **KPI/dashboard work** shown as screenshots or interactive previews.

---

## Part 4 — Top 5 sites for design-token extraction

1. **https://studiobrabo.nl/** — The best Dutch reference. It shows how an off-white sage ground, near-black text and one acid accent, with a characterful display face, make an SMB studio look premium.
2. **https://basement.studio/** — The textbook case of a restrained dark palette plus one accent, with Geist/Geist Mono type tokens that suit a software studio.
3. **https://darkroom.engineering/** — The benchmark for motion tokens (Lenis + GSAP easing and duration) and a black-and-signal-red "engineering studio" system.
4. **https://www.designjoy.co/** — The reference for conversion-component tokens: pricing card, process steps, FAQ, CTA styles and a warm-light palette for a one-person offer.
5. **https://carlokop.nl/** — A Dutch solo-freelancer site with a clean, modern light system (Instrument Sans, neutral greys). Good for spacing and form tokens at SMB scale.

(The runner-up is https://inyourfacemedia.nl/, which is valuable for its pricing and lead-magnet structure but heavy and Elementor-based, so its tokens are noisy.)

---

## Part 5 — Candidate visual directions for DevAim Labs

### A. "Warm Precision" — light, editorial, one bold accent *(recommended default)*
- Off-white warm or sage ground (in the style of Brabo's `#edf0e7`), near-black ink, and **one saturated signature accent** (e.g. electric lime or a vivid cobalt) used only for CTAs and highlights. A characterful grotesk display face with a clean sans body, plus a mono face for small technical labels (prices, stack, metrics).
- Motion: subtle and fast (150–300 ms fades and translates), with hover lift on cards and no scroll-jacking.
- **Rationale:** SMB owners and first-time website buyers trust light, readable pages. The accent and display type give the distinctiveness that Stefan Timmer, De Webteur and CL Web lack. It works well with public pricing cards and demo screenshots.

### B. "Engineered Dark" — dark studio with code-flavoured type
- Near-black ground, grey scale, one hot accent (orange like basement's `#ff4d00` or signal red), and Geist/Geist Mono-style pairing. KPI dashboards and demo UIs look native on dark.
- Motion: Lenis smooth scroll and GSAP reveals kept short and restrained, with a mandatory reduced-motion fallback.
- **Rationale:** It signals technical depth for dashboards, API and payment integrations, and sets DevAim apart from every light Dutch competitor. The risk is that it feels "not for me" to restaurant and clothing-store owners, so it needs warm copy, a founder photo and pricing to compensate.

### C. "Hybrid: Light sales, dark product"
- A light, friendly marketing shell (as in A) with **dark "product" panels** for demos, dashboard showcases and the tech stack (as in B). The Designjoy-style conversion kit (3-step process, "vanaf" pricing, FAQ, reply-time promise, free website-scan lead magnet) runs throughout.
- **Rationale:** DevAim sells to two audiences: SMBs that want a website and businesses that want software or dashboards. Dark panels frame the software work as premium without scaring off the website buyers. This is probably the best fit for the current service mix.
