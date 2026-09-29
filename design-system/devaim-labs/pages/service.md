# Service Page Overrides

> **PROJECT:** DevAim Labs
> **Generated:** 2026-09-28 19:50:12
> **Page Type:** Product Detail

> ⚠️ **IMPORTANT:** Rules in this file **override** the Master file (`design-system/MASTER.md`).
> Only deviations from the Master are documented here. For all other rules, refer to the Master.

---

## Page-Specific Rules

### Layout Overrides

- **Max Width:** 1200px (standard)
- **Layout:** Full-width sections, centered content
- **Sections:** Hero (product + live preview or status) > Key metrics/indicators > How it works > CTA (Start trial / Contact)

### Spacing Overrides

- No overrides — use Master spacing

### Typography Overrides

- No overrides — use Master typography

### Color Overrides

- **Strategy:** Dark or neutral. Status colors (green/amber/red). Data-dense but scannable.

### Component Overrides

- Avoid: Unoptimized full-size images
- Avoid: No visual feedback on current location
- Avoid: Announce a bare number or make every badge a competing live region

---

## Page-Specific Components

- No unique components for this page

---

## Recommendations

- Effects: Film grain overlay, VHS tracking effect, polaroid shake, fade-in transitions, light leak animations
- Performance: Use appropriate size and format (WebP)
- Navigation: Highlight active nav item with color/underline
- Accessibility: Use one appropriate atomic status message such as 3 items in cart
- CTA Placement: Primary CTA in nav + After metrics

---

## Verification notes (added manually, 2026-09-28)

The generator matched this page to a generic "Product Detail" profile. Parts of the output do not fit DevAim's light, warm, editorial Master and are **not** adopted:

- **Color strategy "Dark or neutral, data-dense":** rejected. Keep the Master light palette. Only the embedded demos themselves may be data-dense.
- **Effects "film grain, VHS tracking, polaroid shake, light leaks":** rejected. They are off-brand and clash with Motion 3/10. Use the Master's subtle fades only, and respect `prefers-reduced-motion`.
- **Sections / CTA placement:** superseded by the blueprint in `docs/research/service-pages.md` ("Recommended section blueprint for DevAim service pages").

Adopted from the generator and the `landing`/`ux` searches:
- Pattern "Product Demo + Features": the demo is the centrepiece, and the CTA sits beside or directly below it. Use an interactive demo only where it explains value better than static media, and keep a static fallback.
- Lazy-load below-fold embeds and reserve their space (aspect-ratio box) so there is no CLS. Show a stable skeleton with `aria-busy` while an iframe loads.
- `overscroll-behavior: contain` on scrollable demo frames, to avoid scroll-chaining on mobile.
- Mobile-first breakpoints: 375 / 768 / 1024 / 1440.
