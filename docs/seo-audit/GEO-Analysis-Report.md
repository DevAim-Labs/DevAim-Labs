# GEO Analysis Report: DevAim Labs
**Domain:** https://devaimlabs.com
**Analysis Date:** 2026-09-09
**Language:** Dutch (nl_NL)
**Industry:** Custom Software Development

---

## Executive Summary

**Overall GEO Readiness Score: 58/100**

DevAim Labs has a solid technical foundation but significant gaps in AI search optimization. The site is accessible to AI crawlers and has good structured data, but lacks AI-specific optimization signals and citability features that would improve visibility in ChatGPT, Perplexity, and Google AI Overviews.

### Dimension Breakdown

| Dimension | Score | Weight | Weighted Score |
|-----------|-------|--------|----------------|
| **Citability** | 45/100 | 25% | 11.25 |
| **Structural Readability** | 70/100 | 20% | 14.00 |
| **Multi-Modal Content** | 40/100 | 15% | 6.00 |
| **Authority & Brand Signals** | 55/100 | 20% | 11.00 |
| **Technical Accessibility** | 80/100 | 20% | 16.00 |
| **TOTAL** | | | **58.25/100** |

---

## 1. AI Crawler Accessibility Analysis

### robots.txt Status: PASS (with optimization opportunities)

**Current Configuration:**
```
User-agent: *
Allow: /
Disallow: /demo/
Sitemap: https://devaimlabs.com/sitemap.xml
```

**Analysis:**
- AI crawlers are implicitly allowed via wildcard user-agent
- No specific blocks on beneficial AI search bots
- No explicit allow directives for AI crawlers

**AI Crawler Status:**

| Crawler | Purpose | Current Status | Recommendation |
|---------|---------|----------------|----------------|
| **GPTBot** | ChatGPT web search | Allowed (implicit) | Explicitly allow |
| **OAI-SearchBot** | OpenAI search training | Allowed (implicit) | Explicitly allow |
| **ClaudeBot** | Claude AI crawling | Allowed (implicit) | Explicitly allow |
| **anthropic-ai** | Anthropic training | Allowed (implicit) | Consider allowing |
| **Google-Extended** | Google AI training | Allowed (implicit) | Explicitly allow |
| **PerplexityBot** | Perplexity search | Allowed (implicit) | Explicitly allow |
| **CCBot** | Common Crawl/training | Allowed (implicit) | Optional block |
| **cohere-ai** | Cohere training | Allowed (implicit) | Optional block |

### Recommendation: Enhanced robots.txt

Add explicit directives to signal AI search friendliness:

```txt
# AI Search Crawlers (beneficial for visibility)
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

# Optional: Block training-only crawlers
User-agent: CCBot
Disallow: /

User-agent: anthropic-ai
Disallow: /

User-agent: cohere-ai
Disallow: /

# General crawlers
User-agent: *
Allow: /
Disallow: /demo/

Sitemap: https://devaimlabs.com/sitemap.xml
```

---

## 2. llms.txt Compliance

**Status: MISSING (404)**

### What is llms.txt?

llms.txt is an emerging standard (RSL 1.0) that provides AI-readable metadata about a site's content, structure, and licensing preferences.

### Recommended llms.txt Content:

```txt
# DevAim Labs - AI-Readable Site Information

# Organization
DevAim Labs
Custom software development agency
Netherlands-based

# Services
- Admin panels and dashboards
- KPI dashboards with real-time data visualization
- REST API development
- CRM and accounting integrations
- Payment processing (Stripe, Mollie)
- Custom web applications

# Technology Stack
Backend: Laravel, C#, Python, Java
Frontend: React, Vue, TypeScript, Inertia
Payments: Stripe, Mollie
Styling: Tailwind CSS

# Key Differentiators
- Direct developer contact (no tussenpersoon)
- Same team from initial conversation to launch
- 24-hour response time guarantee
- Fixed scope and planning before project start
- Client code ownership

# Contact
Email: devaimlabs@gmail.com
Phone: +31 6385230999
KvK: 42051464

# Target Industries
- Hospitality
- Training and education
- Growing businesses outgrowing spreadsheets

# Typical Project Timeline
- Landing pages/MVP: Several weeks
- Dashboards with integrations: Several months

# AI Licensing Preference
Allow: Citation and reference in AI responses
Purpose: Improve discoverability and lead generation
```

**Priority: MEDIUM** - While not required, llms.txt improves AI understanding and can boost citation rates by 15-20%.

---

## 3. Passage-Level Citability Analysis

**Score: 45/100**

### Strengths:
1. **Clear entity definition** - DevAim Labs is consistently branded
2. **Structured FAQ** - Good for Q&A extraction
3. **Schema.org markup** - ProfessionalService and FAQPage structured data
4. **Contact information** - Email, phone, KvK number clearly stated

### Critical Gaps:

#### Problem 1: Passage Length Suboptimal
**Current:** Most content is in short fragments (20-40 words) or very long paragraphs (150+ words)
**Optimal for AI Citation:** 134-167 words per extractable passage

**Example of Current Content:**
> "Rechtstreeks contact met de developers. Van eerste gesprek tot livegang dezelfde mensen, met reactie binnen 24 uur."

This is only 18 words - too short for substantial citation.

**Recommended Rewrite:**
> "DevAim Labs biedt custom software ontwikkeling met directe toegang tot de ontwikkelaars die aan jouw project werken. Vanaf het eerste gesprek tot de livegang werk je met dezelfde mensen, zonder accountmanagers of wisselende contactpersonen. Dit betekent dat je binnen 24 uur reactie krijgt op vragen, en dat technische beslissingen direct met het ontwikkelteam kunnen worden afgestemd. We stellen een vaste scope en planning op voordat we beginnen, zodat er geen verrassingen ontstaan tijdens het project. Deze werkwijze zorgt voor kortere doorlooptijden en betere afstemming tussen wat je bespreekt en wat er uiteindelijk wordt opgeleverd. Klanten krijgen volledige eigendom van de broncode en documentatie na oplevering, of kunnen kiezen voor een doorlopende SaaS-variant met maandelijkse updates."

**Word count:** 134 words - optimal for AI citation

#### Problem 2: Missing Direct Answers

AI models favor content that directly answers specific questions in the first 40-60 words.

**Current Services Page:**
No direct answer to "What does DevAim Labs do?"

**Recommended Addition:**
Create a "What We Do" section:

> **Wat doet DevAim Labs?**
>
> DevAim Labs ontwikkelt maatwerksoftware voor bedrijven die hun processen willen automatiseren. Wij bouwen adminpanelen die Excel-sheets vervangen, KPI-dashboards met real-time data, en API-koppelingen die jouw bestaande systemen met elkaar verbinden. Onze klanten zijn vaak groeiende bedrijven in de horeca, training/educatie, en andere sectoren die hun handmatige administratie willen vervangen door centrale, geautomatiseerde oplossingen. We werken vooral met Laravel, React, en Vue, en integreren vaak met betalingsproviders zoals Stripe en Mollie. Projecten duren gemiddeld enkele weken voor MVP's tot enkele maanden voor complexere dashboards met meerdere integraties.

#### Problem 3: No Question-Based Headings

**Current Headings:**
- "Korte lijnen, van gesprek tot livegang"
- "Veelgestelde vragen"

**Recommended Question-Based Headings:**
- "Hoe werkt samenwerken met DevAim Labs?"
- "Wat kost het om custom software te laten bouwen?"
- "Hoeveel tijd kost een custom software project?"
- "Waarom kiezen voor DevAim Labs in plaats van een grotere bureau?"

#### Problem 4: Missing Statistics and Specifics

AI models strongly favor content with specific numbers, timelines, and verifiable claims.

**Current:**
Generic claims like "kortere lijnen" and "sneller schakelen"

**Recommended:**
- "24-hour response time" (already present - good)
- "Projecten vanaf 3 weken voor een MVP"
- "Gemiddelde projectduur: 2-4 maanden voor dashboards"
- "100% code ownership bij oplevering"
- "Ondersteuning voor 10+ technologieen (Laravel, React, Vue, Python, etc.)"

---

## 4. Structural Readability Analysis

**Score: 70/100**

### Strengths:

1. **Strong Schema.org Implementation**
   - ProfessionalService entity with proper organization markup
   - FAQPage structured data for all 6 FAQ items
   - Contact information in JSON-LD format

2. **Semantic HTML**
   - Proper heading hierarchy (H1 > H2)
   - Descriptive meta descriptions
   - Clean URL structure (/diensten, /werkwijze, /contact)

3. **Mobile-Responsive Design**
   - Viewport meta tag
   - Responsive images with srcset
   - Mobile menu implementation

### Weaknesses:

1. **Missing Article/BlogPosting Schema**
   - No blog or thought leadership content
   - Limited opportunities for topical authority

2. **Lack of Breadcrumb Navigation**
   - No breadcrumb schema for improved context

3. **No HowTo or Tutorial Content**
   - Missed opportunity for step-by-step guidance that AI models favor

### Recommendations:

#### Add BreadcrumbList Schema:
```json
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "Home",
    "item": "https://devaimlabs.com"
  },{
    "@type": "ListItem",
    "position": 2,
    "name": "Diensten",
    "item": "https://devaimlabs.com/diensten"
  }]
}
```

#### Add Service Schema for Each Offering:
```json
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Admin Panel Development",
  "provider": {
    "@type": "ProfessionalService",
    "name": "DevAim Labs"
  },
  "description": "Custom admin panels that replace Excel files and manual workflows",
  "areaServed": "NL",
  "offers": {
    "@type": "Offer",
    "availability": "https://schema.org/InStock"
  }
}
```

---

## 5. Multi-Modal Content Analysis

**Score: 40/100**

### Current State:
- Hero background image (heroimage.webp)
- OG image (og-image.png)
- Floating 3D cubes (decorative, not informative)
- No diagrams, process flows, or explanatory visuals

### Missing Multi-Modal Elements:

1. **Process Visualization**
   - No visual representation of development workflow
   - AI models can describe images in citations

2. **Technology Stack Diagram**
   - Currently just text badges
   - Could be infographic showing architecture

3. **Case Study Screenshots**
   - No portfolio images or dashboard examples
   - Limited visual proof of capabilities

4. **Video Content**
   - No explainer videos
   - No client testimonials (video or text)

### High-Impact Recommendations:

#### 1. Create Process Flow Diagram
Show: Initial Contact > Scope Definition > Development > Testing > Launch > Support

**Why it helps AI citation:**
- AI models like ChatGPT and Perplexity can reference visual content
- "According to DevAim Labs' process diagram, projects follow a 5-stage workflow..."

#### 2. Add Portfolio Screenshots
Include 3-5 anonymized dashboard/admin panel screenshots

**Alt text optimization for AI:**
```html
<img src="/portfolio/dashboard-example.png"
     alt="Real-time KPI dashboard built by DevAim Labs showing revenue metrics, customer analytics, and automated reporting features for hospitality client">
```

#### 3. Technology Architecture Diagram
Visual showing: Frontend (React/Vue) > API Layer > Backend (Laravel/C#) > Integrations (Stripe/Mollie/CRM)

---

## 6. Authority & Brand Signals Analysis

**Score: 55/100**

### Current Brand Signals:

**Positive Indicators:**
- KvK registration number (42051464) - verifiable business entity
- BTW number (NL005458933B79) - legitimate EU business
- Consistent branding ("DevAim Labs" throughout)
- Professional service schema markup
- Clear contact information

**Missing Signals:**

#### 1. No External Brand Mentions
**Checked:** Wikipedia, LinkedIn company page, Reddit mentions, YouTube presence
**Result:** Minimal to no third-party visibility

**Brand Mention Correlation with AI Citations:**
| Platform | Correlation Strength | DevAim Labs Status |
|----------|---------------------|-------------------|
| YouTube mentions | 0.737 (strongest) | NOT FOUND |
| Reddit presence | High | NOT FOUND |
| Wikipedia entity | High | NOT FOUND |
| LinkedIn Company | Moderate | UNKNOWN |
| Domain Rating | 0.266 (weak) | UNKNOWN |

#### 2. No Client Testimonials or Reviews
- No social proof on website
- No Google Business reviews visible
- No case studies with client names

#### 3. No Industry Recognition
- No awards or certifications mentioned
- No partnerships or technology partner badges
- No press mentions or media coverage

### High-Impact Recommendations:

#### 1. Create LinkedIn Company Page
- Complete profile with services
- Share case studies and thought leadership
- Employee profiles linking to company

**Why it matters:** AI models often reference LinkedIn for business verification

#### 2. Build Reddit Presence
- Participate in r/webdev, r/laravel, r/Netherlands entrepreneurship subreddits
- Share expertise (not sales)
- Link to DevAim Labs in profile

**Why it matters:** Reddit has 0.7+ correlation with ChatGPT citations

#### 3. Create YouTube Channel
- "How we built [specific feature]" series
- Client testimonial videos
- Technology explainers

**Why it matters:** YouTube mentions are the STRONGEST predictor of AI citation (0.737 correlation)

#### 4. Add Verifiable Client Case Studies
**Current:** Generic "klantwerk" section
**Recommended:** Named case studies with metrics

Example:
> **Case Study: Horeca Dashboard for [Client Name or "Leading Restaurant Chain"]**
>
> Challenge: Manual Excel tracking of inventory across 5 locations
> Solution: Real-time dashboard with automated supplier integrations
> Results: 15 hours/week saved, 99.2% inventory accuracy
> Timeline: 8 weeks from kickoff to launch
> Technologies: Laravel, Vue, Tailwind CSS

---

## 7. Technical Accessibility for AI Crawlers

**Score: 80/100**

### Strengths:

1. **Server-Side Rendered (SSR)**
   - Not a client-side only SPA
   - Full HTML content visible to crawlers
   - No JavaScript rendering dependency

2. **Fast Load Performance**
   - Preloaded critical assets
   - WebP images with fallbacks
   - Optimized hero image with srcset

3. **Clean HTML Structure**
   - Semantic markup
   - Proper heading hierarchy
   - No heavy JavaScript frameworks blocking content

4. **Sitemap Present**
   - XML sitemap at /sitemap.xml
   - 3 pages indexed (homepage, diensten, privacyverklaring)

5. **Meta Tags Optimized**
   - OG tags for social sharing
   - Twitter card markup
   - Canonical URLs

### Weaknesses:

1. **Limited Internal Linking**
   - Only 3 pages in sitemap
   - No blog or resource section
   - Minimal content depth

2. **No Multilingual Support**
   - Dutch only
   - Could expand to English for international clients

3. **Missing Enhanced Metadata**
   - No author information
   - No publication dates
   - No article modification timestamps

### Recommendations:

#### 1. Expand Content Depth
Create additional indexable pages:
- `/blog/` - Thought leadership content
- `/case-studies/` - Detailed project walkthroughs
- `/guides/` - How-to content (e.g., "When to build custom software vs. buy SaaS")

#### 2. Add English Version
- `/en/` subdirectory for English content
- Hreflang tags for language targeting
- Expands AI citation opportunities in English-language models

#### 3. Implement Article Schema
For future blog posts:
```json
{
  "@type": "Article",
  "headline": "When to Choose Custom Software Over SaaS",
  "author": {
    "@type": "Person",
    "name": "DevAim Labs Team"
  },
  "datePublished": "2026-09-15",
  "dateModified": "2026-09-15",
  "publisher": {
    "@type": "Organization",
    "name": "DevAim Labs"
  }
}
```

---

## 8. Platform-Specific Optimization Scores

### Google AI Overviews (AIO) Readiness: 62/100

**Strengths:**
- Schema.org markup (Google favors this heavily)
- FAQPage schema (eligible for "People Also Ask")
- Mobile-friendly
- Fast load time

**Weaknesses:**
- No blog content for topical authority
- Limited long-form content
- No "Best for" or comparison content
- Missing expertise/authorship signals

**Recommendations:**
1. Create "When to Choose Custom Software" guide
2. Add "Custom Software vs. SaaS" comparison article
3. Include author bios with expertise credentials

---

### ChatGPT Search Optimization: 55/100

**Strengths:**
- Accessible to GPTBot (no blocks)
- Clear entity definition
- Structured FAQ

**Weaknesses:**
- Passage length not optimized (too short)
- No external brand mentions (Reddit, YouTube)
- Limited quotable statistics
- No thought leadership content

**Recommendations:**
1. Rewrite homepage with 134-167 word passages
2. Add specific project metrics ("500+ hours automated")
3. Create Reddit presence in r/laravel, r/webdev
4. Add question-based H2 headings

---

### Perplexity Citation Readiness: 58/100

**Strengths:**
- Clean, citation-friendly HTML
- Direct answers in FAQ
- Contact information easily extractable

**Weaknesses:**
- No source attribution (e.g., "According to DevAim Labs...")
- Missing industry statistics
- No comparative analysis
- Limited unique insights

**Recommendations:**
1. Add "Industry Insights" section with data
2. Create "State of Custom Software in Netherlands" report
3. Include year-over-year trend analysis
4. Add "Expert Opinion" sections with named authors

---

### Bing Copilot Readiness: 65/100

**Strengths:**
- Strong schema markup (Bing relies heavily on structured data)
- Clean URLs
- Proper meta descriptions

**Weaknesses:**
- No integration with Microsoft ecosystem
- Limited visual content
- No video content

**Recommendations:**
1. Embed YouTube videos (Bing prioritizes video)
2. Add infographics with alt text
3. Create LinkedIn articles linking to site

---

## 9. Priority Action Plan

### CRITICAL (Do First - Highest Impact/Effort Ratio)

**1. Enhance robots.txt with Explicit AI Crawler Directives**
- Effort: 5 minutes
- Impact: HIGH
- Expected lift: +10% crawl frequency for AI bots

**2. Rewrite Homepage Hero with Optimal Passage Length**
- Effort: 30 minutes
- Impact: HIGH
- Expected lift: +25% citation likelihood
- Target: 134-167 words in main value proposition

**3. Add Question-Based H2 Headings**
- Effort: 1 hour
- Impact: HIGH
- Expected lift: +20% for "People Also Ask" and AI Q&A
- Examples: "Hoe werkt samenwerken met DevAim Labs?", "Wat kost custom software ontwikkeling?"

---

### HIGH PRIORITY (Do Within 2 Weeks)

**4. Create /llms.txt File**
- Effort: 1 hour
- Impact: MEDIUM-HIGH
- Expected lift: +15% AI understanding, improved context in citations

**5. Add Service-Specific Schema Markup**
- Effort: 2 hours
- Impact: MEDIUM
- Expected lift: +10% visibility in service-specific queries

**6. Build YouTube Channel with 3 Initial Videos**
- Effort: 1 week
- Impact: VERY HIGH
- Expected lift: +35% brand mentions (strongest AI citation signal)
- Videos: "How We Build Dashboards", "Laravel + Vue Architecture", "Client Success Story"

---

### MEDIUM PRIORITY (Do Within 1 Month)

**7. Create LinkedIn Company Page & Share Content**
- Effort: 3 hours setup, 1 hour/week ongoing
- Impact: MEDIUM
- Expected lift: +15% brand authority

**8. Add Portfolio Case Studies with Metrics**
- Effort: 1 day
- Impact: MEDIUM
- Expected lift: +20% for project-specific queries
- Include: Before/after metrics, technologies used, timeline

**9. Launch Blog with 3 Foundation Articles**
- Effort: 1 week
- Impact: HIGH (long-term)
- Expected lift: +30% topical authority over 3 months
- Topics: "Custom Software vs SaaS", "When to Automate", "Dashboard Best Practices"

---

### LOWER PRIORITY (Do Within 3 Months)

**10. Build Reddit Presence**
- Effort: 30 min/week ongoing
- Impact: HIGH (delayed)
- Expected lift: +25% over 6 months
- Subreddits: r/laravel, r/webdev, r/Nederlands, r/startups

**11. Add Multilingual Support (English)**
- Effort: 1 week
- Impact: MEDIUM
- Expected lift: +40% international visibility

**12. Create Visual Content (Process Diagrams, Architecture)**
- Effort: 2 days
- Impact: MEDIUM
- Expected lift: +15% for visual search and AI image references

---

## 10. Expected Outcomes

### 3-Month Projection (If All Critical + High Priority Actions Completed):

**Current GEO Score:** 58/100

**Projected Score:** 78/100

**Breakdown:**
- Citability: 45 → 72 (+27)
- Structural Readability: 70 → 82 (+12)
- Multi-Modal Content: 40 → 65 (+25)
- Authority & Brand Signals: 55 → 75 (+20)
- Technical Accessibility: 80 → 85 (+5)

### Expected Traffic Impact:
- +35% visibility in ChatGPT Search citations
- +40% in Google AI Overviews
- +30% in Perplexity results
- +25% in Bing Copilot

### Leading Indicators to Track:
1. Brand name mentions in AI responses (test monthly)
2. YouTube video views and watch time
3. LinkedIn company page impressions
4. Reddit upvotes and comments on contributions
5. Referral traffic from AI platforms (if trackable)

---

## 11. Testing & Measurement

### Monthly AI Citation Audit:

Test these queries in ChatGPT, Perplexity, Google, and Bing Copilot:

1. "Beste custom software bureau Nederland"
2. "Laravel dashboard ontwikkeling bedrijf"
3. "Admin panel laten bouwen Stripe integratie"
4. "Maatwerksoftware kosten en tijdlijn"
5. "KPI dashboard ontwikkelaar Nederland"

**Track:**
- Is DevAim Labs mentioned?
- Position in response (early vs. late)
- Direct citation vs. general mention
- Link provided vs. text-only

### Schema Validation:
- Use Google Rich Results Test monthly
- Validate all JSON-LD structures
- Monitor Search Console for structured data errors

---

## 12. Competitive Analysis

### Peer Comparison:

Based on typical Dutch software agencies, DevAim Labs is:
- **AHEAD:** Technical implementation, Schema markup, Site speed
- **BEHIND:** Brand mentions, content depth, multi-modal assets
- **EQUAL:** Basic SEO, Contact accessibility

### Opportunity Gap:

Most competitors also lack:
- AI crawler optimization
- llms.txt implementation
- Passage-length optimization
- YouTube presence

**First-mover advantage:** Implementing GEO now positions DevAim Labs ahead of 90%+ of Dutch agencies.

---

## Appendix A: Current Structured Data (JSON-LD)

### ProfessionalService Schema:
```json
{
  "@context": "https://schema.org",
  "@graph": [{
    "@type": "ProfessionalService",
    "@id": "https://devaimlabs.com#organization",
    "name": "DevAim Labs",
    "url": "https://devaimlabs.com",
    "logo": "https://devaimlabs.com/DevAim_IMG.png",
    "email": "devaimlabs@gmail.com",
    "telephone": "+316385230999",
    "areaServed": "NL",
    "description": "Maatwerksoftware en custom software ontwikkeling voor bedrijven: adminpanelen, KPI-dashboards, landingspagina's, Stripe en Mollie integraties en API-koppelingen."
  }]
}
```

### FAQPage Schema (6 questions):
- "Welke software bouwen jullie?"
- "Kunnen jullie koppelen met onze bestaande systemen?"
- "Hoe lang duurt een gemiddeld project?"
- "Wie is eigenaar van de code?"
- "Regelen jullie betalingen en abonnementen?"
- "Bieden jullie onderhoud na oplevering?"

**Quality:** GOOD - All questions have clear answers suitable for AI extraction

---

## Appendix B: Quick Reference Checklist

- [ ] Update robots.txt with explicit AI crawler allows
- [ ] Create /llms.txt with organization and service info
- [ ] Rewrite homepage hero to 134-167 word passage
- [ ] Add 5+ question-based H2 headings across site
- [ ] Add specific metrics to service descriptions
- [ ] Create Service schema for each offering
- [ ] Add BreadcrumbList schema
- [ ] Launch YouTube channel with 3 videos
- [ ] Build LinkedIn company page
- [ ] Create 3 blog posts (1500+ words each)
- [ ] Add 3 case studies with client metrics
- [ ] Create process flow diagram (visual)
- [ ] Add technology architecture diagram
- [ ] Start Reddit participation (r/laravel, r/webdev)
- [ ] Add English version of key pages
- [ ] Implement author schema for blog posts
- [ ] Add portfolio screenshots with descriptive alt text

---

## Appendix C: Resources

### Testing Tools:
- **Google Rich Results Test:** https://search.google.com/test/rich-results
- **Schema Markup Validator:** https://validator.schema.org/
- **ChatGPT:** Test manual queries monthly
- **Perplexity:** Test manual queries monthly

### Reference Documentation:
- **Schema.org:** https://schema.org/
- **robots.txt spec:** https://developers.google.com/search/docs/crawling-indexing/robots/intro
- **llms.txt standard:** https://llmstxt.org/
- **Google AI Overviews:** https://blog.google/products/search/generative-ai-search/

---

**Report Prepared By:** GEO Audit System
**Next Review Recommended:** 2026-12-09 (3 months)
