# Design Research — Software Development Websites

Analyse van leading software development websites voor DevAim Labs redesign inspiratie.

---

## 1. Cube.nl (Nederlandse software partner)

### Hero Section
- **Structuur:** Bold headline met value proposition + lokale aanwezigheid (kantoor Oldenzaal)
- **CTA Plaatsing:** Prominent "Maak een afspraak" direct in hero + secundaire navigatie
- **Copy Style:** Direct, benefit-focused, conversationeel maar professioneel

### Belangrijke Patterns
- Vraagformat headlines: "Welke software oplossing zoek jij?"
- Korte, punchy zinnen: "Tech builds. Business."
- Floating appointment overlay altijd bereikbaar
- Team member cards met directe contact opties (bellen/berichten)
- Mega-menu navigatie met categorieën

### Contact Approach
- Meerdere touchpoints: floating overlay, team cards, footer newsletter
- Appointment modal met dropdown velden (project topic, how did you hear about us)

### Takeaways voor DevAim
- ✅ Vraagformat headlines overwegen
- ✅ Lokale aanwezigheid/persoonlijke touch benadrukken
- ✅ Multiple contact touchpoints
- ✅ Team visibility (gezichten achter het bedrijf)

---

## 2. Bintime.com (Directory Landing)

### Hero Section
- **Structuur:** Two-column grid — links: headline + benefits, rechts: quote form
- **CTA Plaatsing:** Dual CTAs in hero + form als primaire conversie
- **Typography:** Plus Jakarta Sans (display) + Inter (body)

### Belangrijke Patterns
- Business outcomes boven features: "ships months earlier", "30-50% lower cost"
- Quote form direct in hero (niet verstopt)
- Floating labels met coral error states
- Teal/amber accent kleuren op navy basis

### Layout
- 1140px max-width
- Consistent vertical spacing (3.5-5.5rem)
- Gradient overlays voor visuele diepte

### Takeaways voor DevAim
- ✅ Benefits/outcomes in hero benadrukken
- ✅ Contact form prominenter maken (niet alleen onderaan)
- ✅ Specifieke resultaten noemen (%, tijdsbesparing)

---

## 3. ELEKS.com (Enterprise Software)

### Hero Section
- **Structuur:** Fixed nav met "Get in Touch" CTAs, ruime padding (110px)
- **Typography:** Proxima Nova (body) + Signifier (headings)
- **Animations:** Button arrows die schalen/translaten op hover

### Belangrijke Patterns
- Animated arrow icons op CTAs
- Gravity Forms met custom styling
- Input fields: transparant + white bottom border
- Floating labels die schalen bij focus
- Slick carousel voor testimonials

### Kleurenpalet
- Deep navy (#1e1d28)
- Electric blue (#0045e6)
- Soft grays voor muted content
- Light en dark section variants

### Animations
- `.3s` duration standaard
- `fadeIn`, `fadeInUp` keyframes
- Header button gradient animations

### Takeaways voor DevAim
- ✅ Animated icons op CTAs
- ✅ Section variants (light/dark afwisseling)
- ✅ Mega-menu voor services/industries

---

## 4. ProbeyServices.com

### Hero Section
- **Structuur:** Bold headline "From Idea to Launch!" met dual taglines (UK/India teams)
- **CTAs:** "Get project estimate" + "Schedule free Consultation"
- **Copy Style:** Conversational, transformation-focused

### Belangrijke Patterns
- Contact forms als popups (triggered by multiple CTAs)
- Calendly integratie voor discovery calls (two-step engagement funnel)
- Client logos carousel (marquee)
- Services accordion
- Regional contact popups (location-specific phone/WhatsApp)

### Kleurenpalet
- Dark navy (#021b2d, #032945)
- Gold accents (#f8ae1f)
- Professioneel + energiek

### Animations
- Scroll-triggered reveals
- Marquee voor client logos
- Hover gradients op buttons

### Layout Flow
Hero → Services Accordion → Client Logos → Team Grid → Testimonials → Awards

### Takeaways voor DevAim
- ✅ "From Idea to Launch" messaging style
- ✅ Calendly/booking integratie
- ✅ Client logos carousel
- ✅ Two-step engagement (form → call booking)

---

## Gemeenschappelijke Best Practices

### 1. Hero Section
| Element | Best Practice |
|---------|---------------|
| Headline | Benefit-focused, niet feature-focused |
| Subheadline | Specifieke outcomes (%, tijd, kosten) |
| CTA Primary | "Start een project", "Get a quote", "Schedule consultation" |
| CTA Secondary | "Bekijk werkwijze", "View our work" |
| Form | Prominent in hero OF floating/sticky |

### 2. Typography
| Type | Fonts |
|------|-------|
| Display | Plus Jakarta Sans, Proxima Nova, Signifier |
| Body | Inter |
| Code | Monospace voor technische elementen |

### 3. Color Patterns
| Role | Colors |
|------|--------|
| Primary Dark | Navy (#1e1d28, #021b2d, #0e2b2a) |
| Primary Accent | Blue/Teal/Cyan |
| Secondary Accent | Gold/Amber voor warmte |
| Error States | Coral/Orange |

### 4. CTAs
- Animated arrow icons
- Hover: translate-y, scale, gradient shifts
- Multiple touchpoints door de page
- Floating/sticky contact options

### 5. Social Proof
- Client logos carousel (infinite scroll)
- Testimonials met foto's
- Case studies met metrics
- Team member visibility

### 6. Contact Forms
- Floating labels
- Multi-step funnels (form → calendar booking)
- Regional/localized options
- Error states in accent color

---

## Aanbevelingen voor DevAim Labs

### Immediate Actions
1. **Hero verbeteren:**
   - Outcome-focused copy: "Software die 2x sneller live gaat"
   - Specifieke benefits: "Direct contact met developers, geen tussenpersoon"
   - Secundaire CTA toevoegen: "Bekijk werkwijze"

2. **Contact form prominenter:**
   - Floating "Plan een gesprek" button
   - Contact form ook in hero area (desktop)
   - Cal.com booking integratie uitbreiden

3. **Client logos carousel:**
   - Infinite scroll marquee
   - Logo's van bestaande klanten

4. **Animations toevoegen:**
   - Arrow icons op CTAs die bewegen
   - Scroll-triggered reveals
   - Hover states met translate-y

### Future Considerations
- Team page met developer profiles
- Case studies met specifieke metrics
- Services mega-menu
- Regional targeting (NL focus)

---

## Motion-Primitives Components

Bekijk [motion-primitives.com](https://motion-primitives.com/docs/infinite-slider) voor:
- **Infinite Slider** — Smooth infinite scrolling voor logos
- **Text Effects** — Reveal animations voor headlines
- **Magnetic Buttons** — Cursor-following button effects
- **Blur Fade** — Elegant content reveals

Sources:
- [Cube.nl](https://cube.nl/)
- [Bintime](https://bintime.com/directory-landing/)
- [ELEKS](https://eleks.com/)
- [Probey Services](https://probeyservices.com/)
- [Motion-Primitives](https://motion-primitives.com/docs/infinite-slider)
