# Design — Lapin Negotiation Services

A locked design system for this site. Every page redesign reads this file before
emitting code. Do not regenerate per page — extend or amend this file when the
system needs to grow.

Implementation home: `wp-content/plugins/lapin/` (self-contained PHP page
templates served via `template_include`, all CSS inline — legalia architecture).
Brand assets are the live site's own: logo, navy/gold palette, treaty-signing
oil painting, portraits, client logos.

## Genre

editorial — institutional gravitas. Harvard-trained negotiation firm; the hero
image is a 19th-century treaty-signing oil painting. Quiet motion, hairlines,
asymmetric layouts, no glassmorphism, no gradients.

## Macrostructure family

- Home (marketing):            **Marquee Hero** — painting as full-bleed fold background,
                               display statement over navy scrim. Below-fold: credentials
                               strip, founder diptych, media wall, qualifications, CTA band.
- Service pages (negotiation,
  dispute-resolution,
  mediation):                  **Split Studio** — alternating text/proof diptychs,
                               one module per existing content section.
- Content pages (overview,
  practice-areas):             **Long Document** — continuous editorial prose with
                               inline section heads; practice areas closes with a
                               two-column index list.
- Contact:                     split utility — form left, contact facts right.

## Theme

Custom, brand-anchored. Brand hexes are kept exact; neutrals are OKLCH-tinted
toward the brand hues (warm paper toward gold h85, cool inks toward navy h230).

- `--color-paper`      `oklch(97.5% 0.008 85)`   warm near-white
- `--color-paper-2`    `oklch(94.8% 0.012 85)`   elevation step
- `--color-navy`       `#023047`                 brand navy — dark band surface + accent-ink
- `--color-navy-2`     `oklch(36% 0.055 230)`    elevation step on navy
- `--color-ink`        `oklch(25% 0.045 230)`    primary text (navy-tinted)
- `--color-ink-2`      `oklch(40% 0.03 230)`     secondary text
- `--color-ink-inverse` `oklch(96% 0.012 85)`    text on navy
- `--color-muted`      `oklch(48% 0.02 230)`     de-emphasised text
- `--color-rule`       `oklch(86% 0.015 85)`     hairlines on paper
- `--color-rule-navy`  `oklch(42% 0.045 230)`    hairlines on navy
- `--color-accent`     `#ffb703`                 brand gold — CTAs, underlines, small squares. ≤5% of any viewport.
- `--color-accent-ink` `#023047`                 text on gold
- `--color-focus`      `oklch(64% 0.155 78)`     dark amber focus ring (≥3:1 on paper)

Slate blue lives only inside the logo mark — never promoted to a UI token.

## Typography

- Display: **Fraunces** (variable, opsz+wght), weight 650, style normal (roman only — italic headers banned)
- Body:    **IBM Plex Sans** (variable), weight 400
- No third family. Logo is an image; no wordmark face needed.
- Display tracking: -0.02em
- Label tracking (small caps rows): 0.08em
- Type scale: 1.25 ratio — `--text-display: clamp(2.5rem, 4.5vw + 1rem, 4.75rem)`
- Body 1.0625rem / 1.6. Measure ≤ 65ch.
- Self-hosted latin-subset variable WOFF2 in `assets/fonts/`, `font-display: swap`, preloaded.

## Spacing

4-point named scale (`--space-3xs` … `--space-4xl`, 2px→144px). Pages use named
tokens only, never raw px. Section rhythm deliberately uneven: navy bands
tighter (`--space-2xl`), paper sections generous (`--space-3xl`).

## Motion

- Easings: `--ease-out: cubic-bezier(0.16,1,0.3,1)` · `--ease-in: cubic-bezier(0.7,0,0.84,0)` · `--ease-in-out: cubic-bezier(0.65,0,0.35,1)`
- Durations: `--dur-micro: 120ms` · `--dur-short: 220ms` · `--dur-long: 420ms`
- Reveal pattern: one orchestrated hero entrance on home only (fade + 8px rise, staggered ≤300ms). Everything else is static.
- Allowed primitives (max 2 per page): hero entrance · CTA hover lift.
- Reduced-motion fallback: opacity-only, ≤150ms.

## Microinteractions stance

- Silent success; celebratory toasts: never.
- Focus rings instant, 2px `--color-focus`, offset 3px.
- Hover tooltip delay 800ms · focus delay 0ms (no tooltips currently shipped).
- Contact form validates on blur-after-touch; error = icon + text + border (never colour alone).
- Media embeds are click-to-load facades (YouTube thumbnail + play button; SoundCloud link cards). No third-party JS until the visitor asks for it.

## CTA voice

- Primary CTA: gold fill (`--color-accent`), navy text, 2px radius, `translateY(-1.5px)` hover lift, label "Talk direct" (tel:) — specific verbs, never "Submit".
- Secondary CTA: outlined chip, 1px `currentColor` border, transparent fill, label "Contact us".
- On navy bands the secondary inverts to light outline.
- Buttons never wrap to two lines (`white-space: nowrap`).

## Per-page allowances

- Home MAY use the painting as fold background + one stat strip (real numbers only: 25+ years, 1,000+ disputes — both from existing site copy).
- Service pages: icons inline with headings (existing brand icons), no icon-tile grids.
- Content pages: typography only.
- No page invents metrics, testimonials, or logos. Client logos are the eight real ones (Microsoft, AT&T, Yahoo, BT, Booz Allen, US Air Force, Qatar, UAE).

## What pages MUST share

- The logo (dark on paper header, light on navy footer).
- Navy/gold token set and accent discipline (gold ≤5% per viewport).
- Fraunces + IBM Plex Sans.
- CTA voice (labels, shapes, radius, hover).
- Nav N1b (logo · Home/About/Practice Areas/Services▾/Contact · phone CTA) and footer Ft1 (light logo mast + tagline "Building Bridges by Resolving Differences" + inline links + address/phones + social + copyright).
- Head pattern: self-emitted title/meta/OG/JSON-LD, preloaded LCP + font, inline CSS, no external render-blocking requests.

## What pages MAY differ on

- Macrostructure within the declared family.
- Which brand image anchors the page (painting / portrait / HQ / graphic).
- Section rhythm and diptych direction.

## Content law

All copy from lapinnegotiationservices.com is retained verbatim (user
requirement). Headings may change case presentation (no all-caps walls) but not
wording. Phones 310-984-6952 / 888-964-8884, email
info@LapinNegotiationServices.com, address The Tower, 10940 Wilshire Blvd,
Suite 1600, Los Angeles, CA 90024. The live footer's injected casino spam is
NOT carried over.

## Performance law (95+ mobile/desktop, 100 SEO)

- Zero builder CSS/JS; theme styles dequeued on lapin templates; WP head cruft stripped (emoji, oEmbed, REST link, global styles).
- All CSS inline; two font files max, preloaded; LCP image preloaded `fetchpriority="high"`, never lazy.
- Images: WebP with width/height attrs, `srcset` where useful, lazy below fold.
- Third-party embeds behind click-to-load facades.
- JSON-LD: ProfessionalService + WebPage per page; unique title/description/canonical per page.

## Exports

### tokens.css

```css
:root {
  --color-paper:       oklch(97.5% 0.008 85);
  --color-paper-2:     oklch(94.8% 0.012 85);
  --color-navy:        #023047;
  --color-navy-2:      oklch(36% 0.055 230);
  --color-ink:         oklch(25% 0.045 230);
  --color-ink-2:       oklch(40% 0.03 230);
  --color-ink-inverse: oklch(96% 0.012 85);
  --color-muted:       oklch(48% 0.02 230);
  --color-rule:        oklch(86% 0.015 85);
  --color-rule-navy:   oklch(42% 0.045 230);
  --color-accent:      #ffb703;
  --color-accent-ink:  #023047;
  --color-focus:       oklch(64% 0.155 78);

  --font-display: 'Fraunces', Georgia, 'Times New Roman', serif;
  --font-body:    'IBM Plex Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;

  --space-3xs: 0.125rem; --space-2xs: 0.25rem; --space-xs: 0.5rem;
  --space-sm: 0.75rem;   --space-md: 1rem;     --space-lg: 1.5rem;
  --space-xl: 2.5rem;    --space-2xl: 4rem;    --space-3xl: 6rem;
  --space-4xl: 9rem;

  --text-sm: 0.8rem;    --text-base: 1rem;    --text-body: 1.0625rem;
  --text-md: 1.25rem;   --text-lg: 1.5625rem; --text-xl: 1.9531rem;
  --text-2xl: 2.4414rem; --text-3xl: 3.0518rem;
  --text-display: clamp(2.5rem, 4.5vw + 1rem, 4.75rem);
  --text-display-s: clamp(2rem, 3vw + 1rem, 3.25rem);

  --tracking-display: -0.02em;
  --tracking-label: 0.08em;

  --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
  --ease-in: cubic-bezier(0.7, 0, 0.84, 0);
  --ease-in-out: cubic-bezier(0.65, 0, 0.35, 1);
  --dur-micro: 120ms; --dur-short: 220ms; --dur-long: 420ms;

  --radius-btn: 2px; --radius-card: 4px; --radius-input: 3px;

  --z-base: 1; --z-raised: 10; --z-dropdown: 100;
  --z-sticky: 200; --z-modal: 400; --z-toast: 500; --z-tooltip: 600;
}
```
