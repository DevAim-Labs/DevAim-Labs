# DevAim Labs — Design System

Dit document beschrijft het volledige design system van de DevAim Labs website.

---

## Typography

### Font Families

| Type | Font | Fallbacks | Gebruik |
|------|------|-----------|---------|
| **Display/Sans** | `Geist` | Inter, system-ui, sans-serif | Headlines, UI elementen |
| **Body** | `Inter` | system-ui, sans-serif | Lopende tekst, paragraphs |
| **Monospace** | `Geist Mono` | JetBrains Mono, monospace | Code snippets, technische labels |

### Typography Scale (Fluid)

| Token | Size | Gebruik |
|-------|------|---------|
| `--text-hero` | `clamp(2.5rem, 8vw, 5rem)` | Hero headlines |
| `--text-h1` | `clamp(2rem, 5vw, 3.5rem)` | Page titles |
| `--text-h2` | `clamp(1.5rem, 4vw, 2.5rem)` | Section headings |
| `--text-h3` | `clamp(1.25rem, 3vw, 1.75rem)` | Card titles |
| `--text-body` | `1rem` (16px) | Body text |
| `--text-small` | `0.875rem` (14px) | Secondary text |
| `--text-tiny` | `0.75rem` (12px) | Captions, labels |

### Letter Spacing

| Token | Value | Gebruik |
|-------|-------|---------|
| `--tracking-tight` | `-0.02em` | Headlines |
| `--tracking-tighter` | `-0.04em` | Hero text |

---

## Color Palette — "Midnight Aurora"

### Dark Theme (Default)

#### Surfaces

| Token | Hex | Gebruik |
|-------|-----|---------|
| `--color-surface` | `#0A0A0F` | Page background |
| `--color-surface-1` | `#12121A` | Cards, elevated elements |
| `--color-surface-2` | `#1A1A24` | Hover states, headers |
| `--color-surface-3` | `#22222E` | Tertiary backgrounds |
| `--color-surface-glass` | `rgba(18, 18, 26, 0.8)` | Glassmorphism |

#### Borders

| Token | Hex | Gebruik |
|-------|-----|---------|
| `--color-border` | `#2D2D3A` | Default borders |
| `--color-border-dim` | `#1E1E28` | Subtle borders |
| `--color-border-glow` | `rgba(23, 199, 188, 0.25)` | Hover glow effect |

#### Text

| Token | Hex | Gebruik |
|-------|-----|---------|
| `--color-text` | `#FAFAFA` | Primary text |
| `--color-text-muted` | `#A1A1AA` | Secondary text |
| `--color-text-dim` | `#71717A` | Tertiary/disabled |

#### Primary Accent: Cyan

| Token | Hex | Gebruik |
|-------|-----|---------|
| `--color-accent` | `#17C7BC` | Primary buttons, links |
| `--color-accent-dim` | `#0E9B92` | Darker variant |
| `--color-accent-bright` | `#6FF5EA` | Highlights, gradients |
| `--color-accent-glow` | `rgba(23, 199, 188, 0.18)` | Glow effects |
| `--color-on-accent` | `#07090D` | Text on accent bg |

#### Secondary Accent: Violet

| Token | Hex | Gebruik |
|-------|-----|---------|
| `--color-violet` | `#8B5CF6` | Secondary actions |
| `--color-violet-dim` | `#7C3AED` | Darker variant |
| `--color-violet-bright` | `#A78BFA` | Highlights |
| `--color-violet-glow` | `rgba(139, 92, 246, 0.18)` | Glow effects |

#### Warm Accent: Amber

| Token | Hex | Gebruik |
|-------|-----|---------|
| `--color-warm` | `#F5A623` | Warnings, highlights |
| `--color-warm-dim` | `#D4890E` | Darker variant |
| `--color-warm-bright` | `#FFC857` | Bright variant |
| `--color-warm-glow` | `rgba(245, 166, 35, 0.18)` | Glow effects |

---

### Light Theme

#### Surfaces

| Token | Hex | Gebruik |
|-------|-----|---------|
| `--color-surface` | `#FAFAFA` | Page background |
| `--color-surface-1` | `#FFFFFF` | Cards |
| `--color-surface-2` | `#F4F4F5` | Secondary bg |
| `--color-surface-3` | `#E4E4E7` | Tertiary bg |
| `--color-surface-glass` | `rgba(255, 255, 255, 0.8)` | Glassmorphism |

#### Borders

| Token | Hex | Gebruik |
|-------|-----|---------|
| `--color-border` | `#D4D4D8` | Default borders |
| `--color-border-dim` | `#E4E4E7` | Subtle borders |
| `--color-border-glow` | `rgba(14, 155, 146, 0.25)` | Hover glow |

#### Text

| Token | Hex | Gebruik |
|-------|-----|---------|
| `--color-text` | `#18181B` | Primary text |
| `--color-text-muted` | `#52525B` | Secondary text |
| `--color-text-dim` | `#71717A` | Tertiary/disabled |

#### Primary Accent: Cyan (aangepast voor contrast)

| Token | Hex |
|-------|-----|
| `--color-accent` | `#0E9B92` |
| `--color-accent-dim` | `#0A7A73` |
| `--color-accent-bright` | `#17C7BC` |
| `--color-on-accent` | `#FFFFFF` |

#### Secondary Accent: Violet

| Token | Hex |
|-------|-----|
| `--color-violet` | `#7C3AED` |
| `--color-violet-dim` | `#6D28D9` |
| `--color-violet-bright` | `#8B5CF6` |

#### Warm Accent: Amber

| Token | Hex |
|-------|-----|
| `--color-warm` | `#D4890E` |
| `--color-warm-dim` | `#B87308` |
| `--color-warm-bright` | `#F5A623` |

---

## Gradients

### Text Gradients

```css
/* Accent gradient (cyan) */
.text-gradient-accent {
    background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-accent-bright) 100%);
}

/* Premium gradient (cyan → violet) */
.text-gradient-premium {
    background: linear-gradient(135deg, var(--color-accent-bright) 0%, var(--color-violet) 100%);
}

/* Warm gradient (amber) */
.text-gradient-warm {
    background: linear-gradient(135deg, var(--color-warm) 0%, var(--color-warm-bright) 100%);
}
```

### Background Gradients

```css
/* Hero gradient */
.gradient-hero {
    background: linear-gradient(135deg,
        var(--color-accent) 0%,
        var(--color-accent-bright) 25%,
        var(--color-violet) 75%
    );
}

/* Mesh gradient (corners) */
.gradient-mesh {
    background:
        radial-gradient(ellipse at 20% 30%, rgba(23, 199, 188, 0.12) 0%, transparent 50%),
        radial-gradient(ellipse at 80% 70%, rgba(139, 92, 246, 0.08) 0%, transparent 50%);
}

/* Subtle mesh (very light) */
.gradient-mesh-subtle {
    background:
        radial-gradient(ellipse at 0% 0%, rgba(23, 199, 188, 0.08) 0%, transparent 50%),
        radial-gradient(ellipse at 100% 100%, rgba(139, 92, 246, 0.06) 0%, transparent 50%);
}
```

---

## Component Styles

### Glassmorphism

```css
.glass {
    background: var(--color-surface-glass);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.glass-heavy {
    background: var(--color-surface-glass);
    backdrop-filter: blur(32px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.glass-card {
    background: var(--color-surface-glass);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 1rem;
}
```

### Code Window Cards (Mac-style)

```css
.code-card {
    background: var(--color-surface-1);
    border: 1px solid var(--color-border-dim);
    border-radius: 0.75rem;
}

/* Header met traffic light dots */
.code-card-header {
    background: var(--color-surface-2);
    border-bottom: 1px solid var(--color-border-dim);
}

/* Dots: .red (#EF4444), .yellow (#F59E0B), .green (#22C55E) */
```

### Buttons

```css
/* Primary: filled → outline on hover */
.btn-primary {
    background: var(--color-accent);
    color: var(--color-on-accent);
    border: 1px solid var(--color-accent);
}
.btn-primary:hover {
    background: transparent;
    color: var(--color-accent);
}

/* Outline: border → filled on hover */
.btn-outline {
    background: transparent;
    color: var(--color-text-muted);
    border: 1px solid var(--color-border);
}
.btn-outline:hover {
    background: var(--color-accent);
    color: var(--color-surface);
}
```

### Cards

```css
/* Lift effect on hover */
.card-lift:hover {
    transform: translateY(-8px);
    box-shadow:
        0 20px 40px -15px rgba(0, 0, 0, 0.3),
        0 0 0 1px var(--color-border-glow);
}

/* Glow shadow */
.card-glow {
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3),
                0 12px 32px -14px rgba(0, 0, 0, 0.5);
}
```

---

## Layout System

### Bento Grid

```css
.bento-grid {
    display: grid;
    gap: 1rem;
    grid-template-columns: repeat(3, 1fr); /* Desktop: 3 cols */
}

/* Tablet: 2 cols */
@media (max-width: 1023px) { grid-template-columns: repeat(2, 1fr); }

/* Mobile: 1 col */
@media (max-width: 639px) { grid-template-columns: 1fr; }

/* Span utilities */
.bento-span-2 { grid-column: span 2; }
.bento-span-row-2 { grid-row: span 2; }
```

### Section Cards

```css
.section-card {
    background: var(--color-section);
    border-radius: 1.25rem;
    margin: 0.75rem clamp(0.75rem, 3vw, 2.5rem);
}
```

---

## Animation & Motion

### Principles
- **Duration:** 0.3s - 0.6s voor UI, langzamer voor decoratief
- **Easing:** `cubic-bezier(0.23, 1, 0.32, 1)` voor smooth motion
- **Reduced motion:** Altijd respecteren met `prefers-reduced-motion`

### Key Animations

```css
/* Reveal on scroll */
.reveal-hidden {
    opacity: 0;
    transform: translateY(24px);
}
.reveal-visible {
    opacity: 1;
    transform: translateY(0);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

/* Availability pulse */
@keyframes pulse-ring {
    0%, 100% { transform: translateY(-50%) scale(1); opacity: 1; }
    100% { transform: translateY(-50%) scale(2.5); opacity: 0; }
}

/* Marquee scroll */
@keyframes marquee-scroll {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}
```

### Hero Orbs (Decorative blobs)

```css
.hero-orb {
    width: 540px;
    height: 540px;
    border-radius: 50%;
    background: radial-gradient(circle,
        color-mix(in srgb, var(--color-accent) 18%, transparent) 0%,
        transparent 70%
    );
    filter: blur(72px);
}

.hero-orb-violet {
    /* Violet variant, 400x400, blur 80px */
}

.hero-orb-warm {
    /* Amber variant, 300x300, blur 60px */
}
```

---

## Utility Classes

| Class | Beschrijving |
|-------|-------------|
| `.text-gradient-accent` | Cyan gradient text |
| `.text-gradient-premium` | Cyan→Violet gradient text |
| `.gradient-mesh` | Background mesh gradient |
| `.glass` | Glassmorphism effect |
| `.glass-card` | Glass effect met border-radius |
| `.code-card` | Mac-style code window |
| `.btn-primary` | Primary CTA button |
| `.btn-outline` | Outline button |
| `.card-lift` | Lift on hover effect |
| `.card-glow` | Shadow glow effect |
| `.bento-grid` | Responsive bento layout |
| `.section-eyebrow` | Kleine uppercase label |
| `.section-title` | Section heading |
| `.pulse-available` | Green availability dot met pulse |
| `.marquee-container` | Infinite scroll container |

---

## Breakpoints

| Name | Width | Columns |
|------|-------|---------|
| Mobile | `< 640px` | 1 |
| Tablet | `640px - 1023px` | 2 |
| Desktop | `≥ 1024px` | 3 |

---

## Design Inspiratie

- **Linear** — Systematic design tokens, semantic colors
- **Vercel** — Progressive disclosure, dark theme excellence
- **CodeRabbit** — Code-centric imagery, dark theme
- **Raycast** — Glass-morphism, premium feel
- **Resend** — Clean API-centric design

---

## Toekomstige Toevoegingen (Gepland)

- [ ] Language switcher (NL/EN) met sleek popup
- [ ] Blobs/SVGs van haikei.app
