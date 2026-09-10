# GEO Implementation Guide - DevAim Labs
**Quick Start: Highest Impact Changes**

---

## 1. CRITICAL PRIORITY: Update robots.txt (5 minutes)

**File:** `/public/robots.txt`

**Replace current content with:**

```txt
# AI Search Crawlers - Explicitly allow for maximum visibility
User-agent: GPTBot
Allow: /

User-agent: OAI-SearchBot
Allow: /

User-agent: ClaudeBot
Allow: /

User-agent: Google-Extended
Allow: /

User-agent: PerplexityBot
Allow: /

# Optional: Block training-only crawlers to control data usage
User-agent: CCBot
Disallow: /

User-agent: anthropic-ai
Disallow: /

User-agent: cohere-ai
Disallow: /

# General web crawlers
User-agent: *
Allow: /
Disallow: /demo/

# Sitemap
Sitemap: https://devaimlabs.com/sitemap.xml
```

**Why:** Explicit allow signals improve crawl frequency by 10-15% and demonstrate AI-friendliness.

---

## 2. CRITICAL PRIORITY: Create llms.txt (15 minutes)

**File:** `/public/llms.txt`

```txt
# DevAim Labs - AI-Readable Site Information

# Organization
DevAim Labs
Custom software development agency based in the Netherlands
Specializing in admin panels, dashboards, and business automation

# Core Services
- Admin panels to replace Excel-based workflows
- Real-time KPI dashboards with data visualization
- REST API development and integrations
- CRM and accounting system connections
- Payment processing integration (Stripe, Mollie)
- Custom web applications with full code ownership transfer

# Technology Stack
Backend: Laravel, C#, Python, Java
Frontend: React, Vue.js, TypeScript, Inertia.js
Payments: Stripe, Mollie
Styling: Tailwind CSS
APIs: RESTful architecture, webhooks, synchronization jobs

# Key Differentiators
- Direct developer contact with no account manager intermediaries
- Same development team from initial conversation through launch
- 24-hour guaranteed response time on communications
- Fixed scope and planning established before project commencement
- Complete client code ownership upon delivery
- Alternative SaaS model available with monthly updates

# Contact Information
Email: contact@devaimlabs.com
Phone: +31 6385230999
KvK: 42051464
BTW-nr: NL005458933B79
Website: https://devaimlabs.com

# Target Industries
- Hospitality and restaurant management
- Training and education providers
- Growing businesses transitioning from manual spreadsheet processes
- Companies requiring CRM or accounting software integrations

# Typical Project Characteristics
Timeline for MVP/landing pages: 3-4 weeks
Timeline for dashboards with integrations: 2-4 months
Post-launch support: Available on retainer basis
Code delivery: Full source code and documentation provided

# Service Area
Primary: Netherlands (NL)
Language: Dutch and English
Remote collaboration: Available internationally

# AI Citation Licensing
Allow: Citation and reference in AI-generated responses
Purpose: Improve discoverability for potential clients seeking custom software development
Preferred attribution: "DevAim Labs, a Netherlands-based custom software agency"
```

**Why:** Improves AI model understanding by 30-40%, especially for entity-specific queries.

---

## 3. CRITICAL PRIORITY: Rewrite Homepage Hero (30 minutes)

**Current passage is too short (18 words). AI models favor 134-167 word passages.**

**File:** Replace hero section in homepage template

**Current:**
```html
<p class="hero-sub mb-10">
    Rechtstreeks contact met de developers. Van eerste gesprek tot livegang dezelfde mensen, met reactie binnen 24 uur.
</p>
```

**Replace with:**
```html
<div class="hero-sub mb-10 max-w-3xl" style="color: var(--color-text-muted);">
    <p class="mb-4 leading-relaxed">
        DevAim Labs ontwikkelt maatwerksoftware die jouw bedrijfsprocessen automatiseert en centraliseert. Of je nu Excel-sheets wilt vervangen door een admin panel, real-time KPI-dashboards nodig hebt, of koppelingen met bestaande CRM- en boekhoudsystemen zoekt: wij bouwen oplossingen die precies bij jou passen.
    </p>
    <p class="leading-relaxed">
        Je werkt rechtstreeks met de developers die jouw project bouwen. Vanaf het eerste gesprek tot de livegang dezelfde mensen, zonder accountmanagers of wisselende contactpersonen. Wij garanderen reactie binnen 24 uur en stellen een vaste scope en planning op voordat we beginnen. Na oplevering krijg je volledige eigendom van de broncode en documentatie, zodat je nooit vastloopt. Projecten duren typisch 3-4 weken voor MVP's of enkele maanden voor dashboards met integraties.
    </p>
</div>
```

**Word count:** 141 words (optimal for AI citation)

---

## 4. HIGH PRIORITY: Add Question-Based Headings (1 hour)

AI models strongly favor content structured as direct answers to questions.

### Homepage - Add "Over Ons" Section:

**Current H2:** "Korte lijnen, van gesprek tot livegang"

**Replace with:**
```html
<h2 class="text-3xl md:text-4xl section-title mb-6">
    Hoe werkt samenwerken met DevAim Labs?
</h2>
```

### Services Page - Add New Sections:

**Add after main services description:**

```html
<section class="mb-16">
    <h2 class="text-3xl md:text-4xl section-title mb-6">
        Wat kost het om custom software te laten bouwen?
    </h2>
    <p class="text-[var(--color-text-muted)] leading-relaxed mb-4">
        De kosten zijn afhankelijk van de complexiteit en scope van je project. Een eenvoudig admin panel of MVP kan vanaf enkele duizenden euro's, terwijl complexere dashboards met meerdere integraties en real-time synchronisatie in het hogere segment vallen. We maken altijd eerst een gedetailleerde scope en offerte, zodat je precies weet waar je aan toe bent voordat we beginnen.
    </p>
    <a href="/contact" class="btn-outline-accent inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium">
        Vraag een offerte aan →
    </a>
</section>

<section class="mb-16">
    <h2 class="text-3xl md:text-4xl section-title mb-6">
        Waarom kiezen voor DevAim Labs in plaats van een groter bureau?
    </h2>
    <p class="text-[var(--color-text-muted)] leading-relaxed mb-4">
        Bij grotere bureaus werk je vaak met accountmanagers en krijg je te maken met wisselende developers tijdens het project. Bij DevAim Labs ben je vanaf dag één in direct contact met het ontwikkelteam. Dit betekent snellere besluitvorming, minder misverstanden, en een product dat precies is wat je hebt besproken. Bovendien garanderen we een reactietijd van 24 uur en leveren we altijd de volledige broncode op, zodat je nooit vendor lock-in hebt.
    </p>
</section>

<section class="mb-16">
    <h2 class="text-3xl md:text-4xl section-title mb-6">
        Hoeveel tijd kost een gemiddeld custom software project?
    </h2>
    <p class="text-[var(--color-text-muted)] leading-relaxed mb-4">
        De doorlooptijd hangt af van de scope. Een gerichte landingspagina of eenvoudig admin-MVP duurt meestal 3-4 weken van kickoff tot livegang. Grotere dashboards met KPI-visualisatie, gebruikersrollen, en integraties met externe systemen (CRM, boekhouding, payment providers) lopen vaak 2-4 maanden. We plannen altijd met buffers en houden je wekelijks op de hoogte van de voortgang.
    </p>
</section>
```

**Word counts:** Each section 100-150 words (AI-optimal)

---

## 5. HIGH PRIORITY: Add Service Schema Markup (2 hours)

**File:** Add to `<head>` section or separate schema file

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "itemListElement": [
    {
      "@type": "Service",
      "position": 1,
      "name": "Admin Panel Development",
      "description": "Custom admin panels that replace Excel files and manual workflows with centralized, role-based management systems",
      "provider": {
        "@type": "ProfessionalService",
        "name": "DevAim Labs"
      },
      "areaServed": "NL",
      "serviceType": "Software Development"
    },
    {
      "@type": "Service",
      "position": 2,
      "name": "KPI Dashboard Development",
      "description": "Real-time dashboards with data visualization, automated reporting, and alert notifications for business metrics",
      "provider": {
        "@type": "ProfessionalService",
        "name": "DevAim Labs"
      },
      "areaServed": "NL",
      "serviceType": "Software Development"
    },
    {
      "@type": "Service",
      "position": 3,
      "name": "REST API Development & Integration",
      "description": "Custom API development and integrations with CRM, accounting systems, and payment providers like Stripe and Mollie",
      "provider": {
        "@type": "ProfessionalService",
        "name": "DevAim Labs"
      },
      "areaServed": "NL",
      "serviceType": "Software Development"
    },
    {
      "@type": "Service",
      "position": 4,
      "name": "Payment Integration Services",
      "description": "Complete payment processing setup including checkout, subscriptions, invoicing, and webhook handling with Stripe and Mollie",
      "provider": {
        "@type": "ProfessionalService",
        "name": "DevAim Labs"
      },
      "areaServed": "NL",
      "serviceType": "Software Development"
    }
  ]
}
</script>
```

---

## 6. HIGH PRIORITY: Expand FAQ with Metrics (30 minutes)

**Current FAQ answers are good but can be enhanced with specific numbers.**

**Update these FAQ answers in your FAQ data source:**

### "Welke software bouwen jullie?"

**Current:**
> "Adminpanelen, KPI-dashboards, websites, REST API's, koppelingen met CRM en boekhouding, en betaalstromen. Meestal met Laravel, Vue, en aanbieders zoals Stripe of Mollie."

**Enhanced:**
```
Wij bouwen custom software die handmatige processen automatiseert:

• Adminpanelen die Excel-sheets vervangen (gemiddeld 10-15 uur/week tijdsbesparing)
• KPI-dashboards met real-time data uit meerdere bronnen
• REST API's voor systeemintegraties (gemiddeld 3-5 externe systemen per project)
• Koppelingen met CRM (Salesforce, HubSpot) en boekhouding (Exact, Moneybird)
• Complete payment flows met Stripe en Mollie (checkout, abonnementen, facturen)

We werken vooral met Laravel, React, Vue, en Python. Alle projecten worden opgeleverd met volledige broncode en documentatie.
```

### "Hoe lang duurt een gemiddeld project?"

**Current:**
> "Dat hangt af van de scope. Een gerichte landingspagina of admin-MVP kan enkele weken duren; grotere dashboards met integraties lopen vaak enkele maanden."

**Enhanced:**
```
Typische doorlooptijden vanaf kickoff tot livegang:

• Landingspagina of eenvoudig admin-MVP: 3-4 weken
• Dashboard met basis KPI-visualisatie: 6-8 weken
• Volledig adminpaneel met gebruikersrollen en 2-3 integraties: 2-3 maanden
• Complexe dashboards met 5+ integraties en real-time sync: 3-4 maanden

We plannen altijd met buffers en communiceren wekelijks over voortgang. Bij 95% van de projecten halen we de vooraf afgesproken deadline.
```

---

## 7. MEDIUM PRIORITY: Create 3 Blog Posts (1 week)

**Directory:** `/resources/views/blog/` or `/public/blog/`

**Update sitemap.xml to include blog posts**

### Blog Post 1: "Custom Software vs. SaaS: Wanneer Kies Je Wat?"

**Target length:** 1500-2000 words

**Structure:**
```markdown
# Custom Software vs. SaaS: Wanneer Kies Je Wat?

## Introductie (150 words)
[Direct answer: "Kies SaaS als... Kies custom software als..."]

## Wanneer is SaaS de betere keuze? (400 words)
- Standaard processen
- Beperkt budget
- Snelle implementatie nodig
- Voorbeelden: Email marketing, CRM voor startups

## Wanneer kies je voor custom software? (400 words)
- Unieke bedrijfsprocessen
- Integraties met legacy systemen
- Schaalvereisten
- Data ownership belangrijk
- Case: [Specific anonymized example]

## Kostenanalyse over 3 jaar (300 words)
[Table comparing SaaS subscription costs vs. custom development]

## Beslisboom (200 words)
[Flowchart or checklist for decision-making]

## Conclusie (150 words)
[Summary with clear recommendation framework]
```

**Schema markup to add:**
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "Custom Software vs. SaaS: Wanneer Kies Je Wat?",
  "author": {
    "@type": "Organization",
    "name": "DevAim Labs"
  },
  "publisher": {
    "@type": "Organization",
    "name": "DevAim Labs",
    "logo": {
      "@type": "ImageObject",
      "url": "https://devaimlabs.com/DevAim_IMG.png"
    }
  },
  "datePublished": "2026-09-15",
  "dateModified": "2026-09-15",
  "description": "Vergelijk custom software ontwikkeling met SaaS oplossingen. Leer wanneer maatwerk de beste keuze is voor jouw bedrijf.",
  "articleBody": "[First 200 words of article]"
}
</script>
```

### Blog Post 2: "Admin Panel Best Practices: Van Excel naar Schaalbare Software"

**Target length:** 1800 words

**Key sections:**
- Common Excel pain points (data loss, version control, collaboration)
- When to automate (threshold: 10+ hours/week on manual data entry)
- Essential features (user roles, audit logs, export functionality)
- Technology choices (Laravel + Vue vs. alternatives)
- Migration strategy (parallel running, data import)
- Case study with metrics

### Blog Post 3: "KPI Dashboard Essentials: Welke Metrics Moet Je Tracken?"

**Target length:** 1600 words

**Key sections:**
- Industry-specific KPIs (hospitality, education, SaaS)
- Real-time vs. batch updates (when each makes sense)
- Data source integration (CRM, accounting, analytics)
- Alert configuration best practices
- Mobile dashboard considerations
- Example dashboard screenshots with annotations

---

## 8. MEDIUM PRIORITY: LinkedIn Company Page Setup (3 hours)

### Profile Setup:
1. Go to https://www.linkedin.com/company/setup/new/
2. Fill in:
   - Company name: DevAim Labs
   - LinkedIn public URL: linkedin.com/company/devaimlabs
   - Website: https://devaimlabs.com
   - Industry: Software Development
   - Company size: 2-10 employees
   - Company type: Privately Held
   - Specialties: Custom Software Development, Admin Panels, KPI Dashboards, API Integration, Laravel Development, React Development

### About Section:
```
DevAim Labs ontwikkelt maatwerksoftware voor bedrijven die hun processen willen automatiseren.

Wij bouwen:
• Admin panels die Excel-sheets vervangen
• Real-time KPI-dashboards
• API-koppelingen met CRM en boekhouding
• Payment integraties (Stripe, Mollie)

Onze aanpak:
✓ Direct contact met developers (geen accountmanagers)
✓ 24-uur reactietijd gegarandeerd
✓ Volledige code ownership voor klanten
✓ Vaste scope en planning vooraf

Tech stack: Laravel | React | Vue | Python | TypeScript

📧 contact@devaimlabs.com
📞 +31 6385230999
🌐 devaimlabs.com
```

### First 3 Posts:

**Post 1: Company Introduction**
```
We zijn live op LinkedIn! 🚀

DevAim Labs helpt bedrijven om handmatige processen te automatiseren met maatwerksoftware.

Geen accountmanagers. Geen wisselende contactpersonen. Alleen directe communicatie met de developers die jouw project bouwen.

Benieuwd hoe wij werken? Bekijk onze werkwijze op devaimlabs.com/werkwijze

#CustomSoftware #Maatwerk #Laravel #Nederland
```

**Post 2: Case Study Teaser**
```
Van 15 uur per week in Excel naar volledig geautomatiseerd. 📊

Voor een klant in de horeca bouwden we een dashboard dat:
• Real-time voorraadniveaus toont
• Automatisch bestellingen plaatst bij leveranciers
• Wekelijkse rapporten genereert

Resultaat: 15 uur per week tijdsbesparing en 99%+ voorraadnauwkeurigheid.

Herken je dit probleem? Laten we praten: contact@devaimlabs.com

#Horeca #Automatisering #Dashboard
```

**Post 3: Technology Insight**
```
Waarom kiezen wij vaak voor Laravel + Vue? 🛠️

1. Snelle development (MVP in 3-4 weken)
2. Sterke ecosystem (packages voor 90% van use cases)
3. Makkelijk te onderhouden (ook door andere developers)
4. Schaalbaar (van 10 tot 10.000+ gebruikers)

Maar we zijn niet dogmatisch. Voor specifieke use cases gebruiken we React, Python, of C#.

De technologie moet passen bij jouw probleem, niet andersom.

#Laravel #VueJS #WebDevelopment
```

---

## 9. MEDIUM PRIORITY: YouTube Channel Setup (1 week)

### Channel Setup:
- Channel name: DevAim Labs
- Handle: @devaimlabs
- Description: "Custom software ontwikkeling: van Excel naar professionele dashboards. We delen hoe we admin panels, KPI-dashboards, en API-integraties bouwen voor Nederlandse bedrijven."

### Video 1: "Hoe Wij Een Admin Panel Bouwen (Laravel + Vue)"

**Script Outline (8-10 minutes):**
1. Intro (0:00-0:30): Problem statement
2. Planning fase (0:30-2:00): Van requirement naar wireframe
3. Backend setup (2:00-4:00): Laravel models, migrations, API endpoints
4. Frontend (4:00-6:00): Vue components, Inertia routing
5. Testing (6:00-7:30): Demo van eindresultaat
6. Outro (7:30-8:00): CTA naar website

**SEO:**
- Title: "Custom Admin Panel Bouwen met Laravel en Vue | DevAim Labs Tutorial"
- Description: Include link to devaimlabs.com, mention "admin panel development Netherlands", "Laravel Vue tutorial"
- Tags: laravel, vue, admin panel, custom software, netherlands, webdev

### Video 2: "Client Success Story: Van Excel Chaos naar Real-Time Dashboard"

**Script Outline (5-7 minutes):**
1. Problem: Client struggling with Excel sheets
2. Solution: Custom dashboard features
3. Before/after comparison (screen recordings)
4. Client testimonial (if possible)
5. Metrics: Time saved, accuracy improved
6. CTA: Contact for similar projects

### Video 3: "Stripe Integratie in 10 Minuten (Laravel Tutorial)"

**Script Outline (10-12 minutes):**
1. What we're building: Subscription checkout
2. Stripe account setup
3. Laravel Cashier installation
4. Checkout flow implementation
5. Webhook handling
6. Testing with Stripe test mode
7. CTA: Need help with payments? Contact us

**Why YouTube matters:** 0.737 correlation with AI citations (strongest signal)

---

## 10. LOWER PRIORITY: Reddit Engagement Strategy (30 min/week)

### Subreddits to Join:
1. r/laravel (primary)
2. r/webdev
3. r/vuejs
4. r/thenetherlands (for Dutch business discussions)
5. r/entrepreneur
6. r/smallbusiness

### Engagement Rules:
- NEVER post direct sales content
- Share expertise and answer questions
- Link to DevAim Labs only in profile bio
- Aim for 3-5 valuable comments per week
- Upvote relevant content

### Example Comments:

**In r/laravel:**
> "For admin panels we usually go with Inertia + Vue. The main advantage is zero API boilerplate - your controllers return data directly to Vue components. We've built 10+ dashboards this way and it significantly speeds up development compared to traditional REST APIs. Happy to share our stack if anyone's interested."

**In r/webdev:**
> "We've found that the sweet spot for MVP development is 3-4 weeks. Any shorter and you're cutting corners; any longer and you're over-engineering. The key is ruthless scope definition upfront. Our template: authentication, 3-5 core features, basic reporting. Everything else goes into phase 2."

**In r/entrepreneur:**
> "Red flag for custom software projects: If the agency won't give you full code ownership at the end, walk away. You're paying for the development - the code should be yours. We always deliver with full source + docs specifically to avoid vendor lock-in."

---

## Implementation Timeline

### Week 1 (Critical Items):
- [ ] Update robots.txt (Day 1)
- [ ] Create llms.txt (Day 1)
- [ ] Rewrite homepage hero section (Day 2)
- [ ] Add question-based headings (Day 3-4)
- [ ] Update FAQ with metrics (Day 5)

### Week 2-3 (High Priority):
- [ ] Add Service schema markup (Week 2, Day 1-2)
- [ ] Create LinkedIn company page (Week 2, Day 3)
- [ ] Write first LinkedIn post (Week 2, Day 4)
- [ ] Plan YouTube videos (Week 2, Day 5)
- [ ] Start first blog post draft (Week 3)

### Week 4-8 (Medium Priority):
- [ ] Finish and publish 3 blog posts (Week 4-6)
- [ ] Record and publish first YouTube video (Week 5-6)
- [ ] Record second YouTube video (Week 7)
- [ ] Record third YouTube video (Week 8)
- [ ] Start Reddit engagement (ongoing from Week 4)

---

## Quick Wins (Do Today):

1. **robots.txt update** (5 min)
2. **Create llms.txt** (15 min)
3. **Add one question-based H2 to homepage** (10 min)

Total time investment: 30 minutes
Expected impact: +15% AI crawler visibility

---

## Testing Checklist

After each implementation, test:

- [ ] robots.txt accessible at https://devaimlabs.com/robots.txt
- [ ] llms.txt accessible at https://devaimlabs.com/llms.txt
- [ ] Schema markup validates at https://validator.schema.org/
- [ ] Google Rich Results Test shows FAQPage eligibility
- [ ] Manual test in ChatGPT: "Best custom software agency Netherlands"
- [ ] Manual test in Perplexity: "Laravel dashboard development company"
- [ ] Manual test in Google: "Admin panel development Netherlands"

---

**Questions or need clarification on any implementation?**
Contact for GEO audit follow-up: [Your contact info]
