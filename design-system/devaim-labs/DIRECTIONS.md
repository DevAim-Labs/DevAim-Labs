# DevAim Labs: Visual Directions

Three candidate directions for the DevAim Labs site (NL with formal "u", plus EN). The audience is SMB owners (restaurants, clothing stores, local businesses) and individuals who want more leads or a better website. Services are websites, admin/KPI dashboards, Stripe/Mollie payments and API integrations.

**Source:** `ui-ux-pro-max --design-system` (3 runs plus 2 retries), `--domain landing "hero social-proof pricing lead"` and `--domain ux "form lead conversion"`. Raw database output was curated. Where a value differs from the tool output, the reason is noted.

**Persisted:** Direction B, as `MASTER.md` (query `"warm editorial serif cream local business"`, variance 4, motion 3, density 3).

**Banner concepts:** `banners/a-dark-premium-tech.html`, `banners/b-light-warm-editorial.html` and `banners/c-bold-conversion-agency.html`. Each contains a live CSS mock of the 1200×630 OG image and the site hero, plus a spec. No paid image generation was used; all visuals are CSS or SVG.

Contrast values are WCAG 2.x ratios computed for each pair. AA requires 4.5:1 for body text and 3:1 for large text and UI.

---

## Shared rules (all directions)

These come from the landing and UX queries:
- **Page structure:** Hero, then proof (stats or real cases), then services, then testimonials, then CTA (pattern `hero-testimonials-cta` / `trust-authority-conversion`). Social proof comes before the second CTA. Use only verified testimonials with name and role.
- **Pricing:** show "vanaf" (from) prices or a fixed-price promise. Transparent pricing is a trust lever for SMBs.
- **Lead form:** 2 to 4 fields, each with a visible `<label>` (never placeholder-only). The submit button shows loading, then a success or error state. The error message sits next to the field. Show the response promise ("reactie binnen 1 werkdag") beside the button.
- **Accessibility and motion:** 44px minimum touch targets, visible focus rings and `prefers-reduced-motion` support (render the final state). Motion lasts 150–450ms. Use SVG icons (Lucide), never emoji.
- **Fonts:** all fonts are open-licence Google Fonts. Self-host them as woff2 with `font-display: swap`, subset to latin plus latin-ext (for Dutch diacritics), and preload only the heading weight.

---

## A · Dark Premium Tech

The tool first returned "HUD / Sci-Fi FUI" with Share Tech Mono and Fira Code, which was rejected as too niche for SMBs. The retry returned Liquid Glass with gold and Cormorant, which was rejected as a luxury-fashion fit. The kept pieces are the background #0B0B10 base, the blue accent and the "dark background for focus, highlight interactive elements" strategy. The rest is curated.

**Palette**

| Role | Hex | Contrast |
|---|---|---|
| Background | `#0B0D12` | n/a |
| Surface / card | `#151922` | n/a |
| Border | `#2A3140` | 1.49:1 on bg (decorative only; use a 3:1 ring for inputs) |
| Text | `#F4F6FA` | 17.96:1 on bg |
| Muted text | `#9AA3B2` | 7.64:1 on bg, 6.91:1 on surface |
| Accent / CTA | `#4F8CFF` | 6.04:1 on bg; CTA label `#0B0D12` on accent is 6.04:1 |
| Secondary accent (mint) | `#5EEAD4` | 13.1:1 on bg (tags and positive deltas) |

Notes: do not put white text on the accent (it fails at 3.22:1); use the dark label. Avoid pure #000 and #FFF to reduce halation.

**Fonts:** Geist (headings and UI, 500/600) with JetBrains Mono (labels and numbers, 400/500).

**Radius / shadow / spacing:** radius 10px for buttons, 16px for cards and 999px for chips. Shadows are replaced by 1px borders plus a faint accent ring (`0 0 0 1px rgba(79,140,255,.15), 0 24px 60px rgba(0,0,0,.5)`). Spacing scale 4/8/12/16/24/32/48/64/96, with 128px between sections.

**Motion personality (tier 6, "engineered"):** stagger reveals of 300–450ms, KPI count-ups and a slow glow drift. Use the precise curve `cubic-bezier(.2,.8,.2,1)`, and no bounce on data.

**Hero concept:** "Een website die klanten oplevert, niet alleen bezoekers." Copy sits on the left with a CTA "Plan een gratis gesprek". On the right, floating real-HTML UI cards (a reservations KPI and an iDEAL/Mollie "betaald" chip) sit over a fading grid and a blue-to-mint glow.

**Banner concept (OG):** dark canvas with a mono tag "// websites · dashboards · betalingen", the headline "Software die voor uw bedrijf blijft werken." and a revenue KPI card with bars on the right.

**Pros:** strongest signal for dashboards, API and payments work. It feels premium and modern and differentiates from template agencies. Dark cards make product mockups look strong.

**Cons:** can feel cold or "too techy" to a restaurant or boutique owner. Dark mode reads as developer-oriented and less warm and local. Showcasing light client sites inside a dark shell needs care. Glow and blur add paint cost on low-end phones.

---

## B · Light Warm Editorial (persisted to MASTER.md)

The tool's first run returned pure black with Archivo, which was rejected as not warm or light. The retry is the persisted run: Funnel (3-step conversion) pattern, Minimalism & Swiss style, green and orange palette, and Calistoga with Inter.

**Deltas vs MASTER.md:** these are intentional refinements. Apply them to MASTER.md or a page override once the direction is approved.
- Background: MASTER `#ECFDF5` (mint) becomes cream `#FBF7F0`. Border: `#A7F3D0` becomes `#E7DED0`.
- Primary: MASTER `#059669` becomes the deeper `#0F5F46` (body-safe; 7.16:1 as text). MASTER's "On Primary #000" becomes `#FFFFFF` (7.65:1).
- Accent: MASTER `#EA580C` becomes `#C2410C`, so white CTA labels pass at 5.18:1 (MASTER used black on orange).
- Heading font: Calistoga becomes Fraunces, which reads more editorial and less retro, has variable weight and optical size, and sets well in Dutch compounds. Calistoga is an acceptable fallback if a friendlier tone is wanted.

**Palette**

| Role | Hex | Contrast |
|---|---|---|
| Background | `#FBF7F0` | n/a |
| Card | `#FFFFFF` | n/a |
| Sand (sections, illustration) | `#F1E7D6` | n/a |
| Ink (text) | `#1F1A14` | 16.17:1 on bg |
| Muted text | `#5E5548` | 6.85:1 on bg |
| Primary (forest) | `#0F5F46` | 7.16:1 on bg; white on it is 7.65:1 |
| Accent / CTA (terracotta) | `#C2410C` | white label is 5.18:1; as text on bg 4.85:1 (AA, but prefer it for large text) |
| Border / hairline | `#E7DED0` | decorative; input borders use `#8C7F6C` (3.66:1) |

**Fonts:** Fraunces (headings, 400/600, opsz axis) with Inter (body and UI, 400/500/600).

**Radius / shadow / spacing:** radius 12px for cards, 999px pill CTAs and 150px arches for image plates. Shadows are soft and warm-tinted: `0 1px 2px rgba(31,26,20,.06), 0 12px 32px rgba(31,26,20,.08)`. Use 1px ink rules as editorial dividers. Spacing is density 3 (spacious): 8/16/24/32/48/64/96, with 96–128px between sections.

**Motion personality (tier 3, "calm"):** a single 350ms scroll-reveal fade with 12px rise and `power1.out`. Hover transitions run 200–250ms. There is no parallax and nothing loops.

**Hero concept:** eyebrow "Websites & software op maat", serif H1 "Meer reserveringen, meer bestellingen, *minder gedoe*." The terracotta pill CTA "Plan een gratis kennismaking" is followed by a trust line (response within 1 working day, fixed price, one developer). On the right, a framed case card and a pull quote, so proof is visible above the fold.

**Banner concept (OG):** magazine masthead rule, a 76px Fraunces headline "Uw zaak verdient een website die klanten oplevert." with the key phrase in green, and an arched plate with a flat sun and hills illustration.

**Pros:** the closest fit for the core buyers (restaurants and fashion boutiques) because it feels local, crafted and trustworthy. It has the best contrast margins and the lowest performance cost. It flatters client screenshots, and the formal "u" copy sits naturally in the editorial voice.

**Cons:** it signals the dashboards, API and payments offer less strongly; that is solved by using mono numerals and real dashboard screenshots on those service pages. It can drift into looking like a "design blog" if CTAs are not kept loud, so keep terracotta reserved for actions only. The serif H1 needs care on narrow mobile screens with long Dutch words (`hyphens: auto` with `lang="nl"`).

---

## C · Bold Conversion Agency

The tool returned Brutalism with pink and cyan, and Inter headings over Playfair body text. The kept pieces are Brutalism's hard borders, bold 700+ type and visible structure, plus the "type-as-hero" mood. The pink, the serif body and the "no transitions" rule were rejected.

**Palette**

| Role | Hex | Contrast |
|---|---|---|
| Paper (bg) | `#F3F1EC` | n/a |
| White (cards, forms) | `#FFFFFF` | n/a |
| Ink | `#0A0A0A` | 19.8:1 on white |
| Muted text | `#4A4A4A` | 7.85:1 on paper |
| CTA orange | `#FF5A1F` | ink label on it is 6.35:1. **White on it is 3.12:1 and fails**; never use orange as a text colour on light backgrounds |
| Electric blue | `#1E3AFF` | 6.76:1 on white; white on it is 6.76:1 (links, offset shadows) |
| Highlighter lime | `#E6FF3F` | only behind ink text (17.7:1) or as text on ink |

**Fonts:** Bricolage Grotesque (display, 800, opsz) with Inter (body and UI, 400–700).

**Radius / shadow / spacing:** radius 8px for buttons and inputs and 12px for cards. Borders are 2px ink. Shadows are hard offsets: `4px 4px 0 #0A0A0A` on buttons and `8px 8px 0 #1E3AFF` on the lead form. Spacing is density 4 (standard): 8/12/16/24/32/48/64, with 80–96px between sections.

**Motion personality (tier 6, "punchy"):** the highlighter wipes in over 400ms, cards drop in with `back.out(1.4)`, buttons press into their shadow in 120ms, and the service ticker pauses on hover, focus and reduced motion.

**Hero concept:** ticker bar listing the services, a 96px H1 "Een website die **klanten** binnenhaalt." with a lime highlight on "klanten", CTA "Vraag een offerte aan", and an **inline 2-field lead form** in the hero. A stat row (1-dag reactie · vaste prijs · NL/EN) stands in until real logos exist.

**Banner concept (OG):** black canvas with a 128px stack "Meer / aanvragen. / Minder gedoe." (lime highlighter), a rotated orange "1 werkdag reactie" sticker, and a footer bar with services and URL.

**Pros:** highest expected conversion, with the offer and form visible immediately. The most memorable of the three, and it scales well to ads and social posts. It is cheap to build and fast.

**Cons:** it can read as loud or "salesy" for premium boutiques and upscale restaurants, and may undercut perceived craftsmanship. It needs strong, real proof to avoid feeling like a hard sell. It is less suited to showing refined client designs, and it needs discipline with orange contrast.

---

## Recommendation

**B** was persisted as the base because it fits the core buyers and the formal Dutch tone best, with the lowest accessibility and performance risk. The recommended evolution is to borrow C's conversion mechanics (inline 2-field form in the hero, stat row, sticky mobile CTA) and A's mono numerals and UI cards on the dashboards and payments service pages, implemented as `pages/*.md` overrides.
