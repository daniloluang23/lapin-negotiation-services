# Design — Lapin Negotiation Services

A locked design system for this site. Every page redesign reads this file before
emitting code. Do not regenerate per page — extend or amend this file when the
system needs to grow.

**v2 (2026-07-14):** system re-anchored to the client-approved redesign — the
DNA of the SULTIN/Elementor staging site (stg-lapinnegotiationservices-staging.
kinsta.cloud) rebuilt as hand-authored templates, plus the approved option-1
logo palette. `studied: yes · DNA-source: url (client's own staging site)`.
The v1 navy/gold "treaty painting" system is retired.

**v2.1 (2026-07-19):** client-directed home revision — split tagline hero
(copy left / bridge art right at raised presence), reviews slider → 6-card
grid + "40+ Five-Star Google Reviews" band, five-star creds item, "Practice
Areas" H2, new bio lead, bridge-motif audio facades, numeral qualification
marks, blog removed site-wide. Header artwork recreated in-house as inline
SVG (cable-stayed bridge per the client's reference images); their raster
file remains a fallback if the literal image is wanted.

**v2.4 (2026-07-20):** subpage mastheads switched from the drawn inline SVG to
the home hero's recolored bridge raster (`bridge-theme-*.webp`), full-bleed and
dimmed — one artwork site-wide (client direction after the v2.3 home hero).
The inline SVG is retired; `lapin-bridge-mini` (facades) keeps the drawn motif.

Implementation home: `wp-content/plugins/lapin/` (self-contained PHP page
templates served via `template_include`, all CSS inline — legalia architecture).

## Genre

editorial-corporate — warm, composed consulting voice. Bridge metaphor
throughout (brand tagline "Building Bridges. Resolving Differences.").
Quiet motion, generous negative space, warm metallic accents on deep onyx.

## Macrostructure family

- Every page:                  **shared masthead** — onyx band carrying topbar,
                               nav (prominent logo), and a hero on the recolored
                               bridge raster (home: right 66% per the
                               claude-design handoff; subpages: full-bleed,
                               dimmed). Home gets the full tagline hero +
                               CTAs; subpages a compact title hero.
- Home (marketing):            **Marquee Hero, split** — tagline H1 + diamond
                               divider + service lead in a left ~60% column,
                               bridge art right at raised presence; then creds
                               strip (five-star Google item), practice areas,
                               founder diptych, reviews grid + 40+ band,
                               client-logo marquee, media wall (bridge-motif
                               audio facades), numeral qualification cards,
                               CTA band.
- Service pages:               **Split Studio** — 65/35 text/icon diptychs.
- Content pages:               **Long Document** — editorial prose, inline heads.
- Contact:                     split utility — form left, contact facts right.
- No blog anywhere (client direction 2026-07-19).

## Theme

Custom, brand-anchored (approved logo option 1). Brand hexes exact; neutrals
OKLCH-tinted warm (~hue 40–80). Onyx is the dark surface, not navy.

- `--color-paper`        `oklch(98.2% 0.005 80)`  warm near-white
- `--color-paper-2`      `#F3ECE1`                cream band (from staging kit)
- `--color-onyx`         `#49494B`                brand onyx — masthead/bands/footer
- `--color-onyx-2`       `oklch(30% 0.006 300)`   elevation step on onyx
- `--color-ink`          `oklch(28% 0.01 300)`    primary text (near-onyx)
- `--color-ink-2`        `oklch(42% 0.01 300)`    secondary text
- `--color-ink-inverse`  `oklch(96.5% 0.008 80)`  text on onyx
- `--color-ink-inverse-2` `#D1BFA7`               secondary text on onyx (soft gold)
- `--color-muted`        `#8E8E90`                brand silver — labels/captions only (≥ semibold or large; 3.4:1 on paper)
- `--color-rule`         `oklch(88% 0.015 80)`    hairlines on paper
- `--color-rule-onyx`    `oklch(42% 0.012 300)`   hairlines on onyx
- `--color-accent`       `#BD8C7D`                brand rose gold — eyebrows, underlines, marks. ≤5% of any viewport.
- `--color-accent-strong` `oklch(44% 0.075 35)`   deep rose — primary button fill on paper, eyebrows (≥4.5:1 with white text; ≥4.5:1 as small text on cream)
- `--color-gold`         `#D1BFA7`                brand soft gold — primary button fill on onyx (5:1 with onyx text)
- `--color-focus`        `oklch(55% 0.1 40)`      focus ring on paper (≥3:1); on onyx bands the ring inverts to soft gold

Contrast law: rose gold never carries body text. On paper it appears only as
decorative accents ≥3px or ≥18px semibold text. Buttons: deep rose + cream on
paper; soft gold + onyx on dark bands. Silver only for large/bold secondaries.

## Typography

- Display: **DM Sans** (variable opsz+wght, self-hosted latin), weight 700,
  style normal (roman only — italic headers banned), tracking -0.015em
- Body:    **Poppins** 400 (static latin woff2); strong/labels Poppins 600
- No third family. Logo is an image.
- Label rows (eyebrows): Poppins 600, 0.8rem, uppercase, tracking 0.14em,
  rose gold. Always stacked above the heading, same column. Staging-DNA voice:
  major home sections may carry one; inner pages sparingly.
- Type scale 1.25 — `--text-display: clamp(2.5rem, 4vw + 1rem, 4.25rem)` (sized so the home hero + primary CTA fit a 1280×800 fold)
- Body 1.0313rem / 1.7 (Poppins runs wide; body size a notch under 17px).
- Three self-hosted font files, all preloaded except Poppins 600
  (dmsans-latin-var 63KB · poppins-latin-400 8KB · poppins-latin-600 8KB).

## Spacing

4-point named scale (`--space-3xs` … `--space-4xl`, 2px→144px). Named tokens
only, never raw px. Rhythm: dark bands tighter (`--space-2xl`), paper sections
generous (`--space-3xl`).

## Signature: the bridge masthead

One `.masthead` block opens every page: onyx gradient + the recolored bridge
raster. Topbar, nav and hero all sit on it. (v2.1's hand-drawn inline SVG is
retired as of v2.4 — the raster is the one artwork site-wide.)
Home variant (v2.3, claude-design handoff 2026-07-20, `claude-design/`): the
home masthead recreates the handoff prototype. Canvas: `linear-gradient(to
right, --color-hero-deep #161418, --color-hero-mid #241D21 55%,
--color-hero-warm #2F262B)`, no border-bottom (the stats strip's 1px rose rule
replaces it). Bridge: the handoff's recolored 2560×1707 `bridge-theme.png`
(luminance→palette gradient map of the client's render) exported as
`bridge-theme-{960,1600,2560}.webp` (9/17/33KB), rendered as
`<img class="hero__bridge">` inside `.hero--home` — right 66%, `object-fit:
cover` at 60%/45%, left-fade mask intersected with a top fade so neither edge
seams (mobile: full-bleed at 0.55 under a to-bottom scrim). LCP image:
preloaded with imagesrcset/imagesizes + `fetchpriority="high"`, never lazy.
Hero type per handoff mapped to the two-font law (Archivo → DM Sans var):
H1 `--text-display` 800/1.02, lead DM Sans 700 `--text-lg`, body
`--color-hero-muted`, 640px copy column; primary CTA filled `--color-accent`
on `--color-hero-onyx` (hover `--color-accent-hover`), secondary outline
`#6F6F72`. Stats strip: `--color-strip` bg, accent-35% top rule, muted-20%
dividers. Fold law (client, 2026-07-20): hero padding compressed from the
handoff's 96/120px to `--space-2xl`/`--space-2xl` and the H1 capped at
`--text-display` so hero + stats strip fit a 1080p first viewport
(verified at 1920×907: strip fully visible). Subpage variant (v2.4): the same
`bridge-theme-*.webp` set as `<img class="masthead__art">` — full-bleed behind
topbar/nav/hero, `object-fit: cover` at 60%/45%, opacity 0.55 over the onyx
gradient, to-bottom mask (transparent → solid by 40%) so the topbar stays on
clean onyx; the existing `.hero::before` radial scrim keeps the text zone
readable. Preload for the set is emitted site-wide by `lapin-head.php`
(imagesizes 66vw-pattern on home, 100vw on subpages). Subpages keep the 3px
accent masthead border. The `lapin-bridge-mini` facade symbol keeps the drawn
tied-arch motif (arch + hangers + deck + V piers).
Logo `logo-on-dark.webp` at 260×92 desktop (header must feature the logo
prominently — client direction), `logo-on-light.*` for schema/OG use.

## Motion (staging DNA, hand-rolled — no AOS/animate.css)

- Easings: `--ease-out: cubic-bezier(0.16,1,0.3,1)` · `--ease-in: cubic-bezier(0.7,0,0.84,0)` · `--ease-in-out: cubic-bezier(0.65,0,0.35,1)`
- Durations: `--dur-micro: 120ms` · `--dur-short: 220ms` · `--dur-long: 480ms`
- Hero entrance: staggered fade + 10px rise on masthead hero lines (every page,
  load-time, ≤400ms total).
- Scroll reveals: `.rv` fade-up 20px via one IntersectionObserver (~12 lines,
  footer). No JS → content stays visible (observer adds the hidden state).
- Client-logo marquee (home): infinite CSS `translateX` keyframe loop, duplicated
  track, pauses on hover/focus.
- CTA hover lift `translateY(-1.5px)`; card hover lift `translateY(-4px)` + shadow.
- Reduced-motion: all of the above collapse to ≤150ms opacity or none; marquee stops.
- Max 3 primitives per page (hero entrance + reveals + one page-specific).

## Microinteractions stance

- Silent success; celebratory toasts: never.
- Focus rings instant, 2px, offset 3px; soft gold on dark bands.
- Contact + newsletter forms validate on blur-after-touch; error = icon + text +
  border (never colour alone). Honeypot + nonce + per-IP rate limit.
- Media embeds stay click-to-load facades. No third-party JS until asked.

## CTA voice (client-directed labels)

- Primary on paper: `.btn--rose` deep-rose fill, cream text — "Schedule a Consultation".
- Primary on onyx:  `.btn--gold` soft-gold fill, onyx text — "Call Now" / "Schedule a Consultation".
- Secondary: outlined chip, 1px currentColor — "Request an Assessment" / "Contact Us".
- Nav CTA: "Call Now" (tel:). CTA band: "Call Now — 310-984-6952" + "Request an Assessment".
- 2px radius, hover lift, never two-line (`white-space: nowrap`).

## Per-page allowances

- Home: creds strip (real facts only: Harvard trained, 25+ years, 1,000+
  disputes; Google item carries five stars), client-logo marquee (the eight
  real logos as the staging site's rose-tint monochrome art —
  `client-*-tint.webp`, uniform 150×70, alpha; marquee is contained in the
  content column with a soft edge fade, never full-bleed — client direction),
  reviews grid (first 6 Google reviews via Trustindex sync, bundled snapshot
  fallback) + centered 40+ five-star band, bridge-motif audio facades on the
  media wall, numeral marks (no photos) on the qualification cards.
- Service pages: inline Lucide icons, no icon-tile grids.
- Blog cards: featured image (WebP, width/height, lazy), date, title, excerpt.
- No page invents metrics, testimonials, or logos.

## What pages MUST share

- The masthead (bridge SVG, logo, nav: Home · About Us · Practice Areas ·
  Services▾ · Contact · "Call Now" CTA) and the footer.
- Onyx/rose-gold/soft-gold/silver token set; rose gold ≤5% per viewport.
- DM Sans + Poppins. CTA voice above.
- Footer Ft-index: logo mast + tagline "Building Bridges. Resolving Differences."
  + 4 columns (Reach us / Explore / Services / Newsletter) + social + legal.
  No Unlitigation anywhere (client direction).
- Head pattern: self-emitted title/meta/OG/canonical/JSON-LD, preloaded fonts,
  inline CSS, zero external render-blocking requests.

## Content law

All copy from lapinnegotiationservices.com is retained verbatim (client
requirement) except client-directed removals: the "Negotiation Mediation
Unlitigation™" kicker, the About "What is Unlitigation™" section, and the
footer Unlitigation line. Client-directed revision (2026-07-19): the home H1
IS the tagline "Building Bridges. Resolving Differences." (two lines;
"Experienced. Strategic. Results-Focused." removed); the sub splits into lead
"Professional Mediation and Negotiation Services" + body "Delivering
practical, durable solutions for businesses, families, and organizations."
(sentence case). Bio lead replaced with client copy: "Whether you're involved
in a business dispute, family conflict, trust litigation or high stakes
negotiation, we help parties reach durable agreements while preserving
relationships wherever possible." Practice-areas H2 is "Practice Areas"
(eyebrow dropped). Reviews H2 is "What Clients Are Saying"; the band metric
"40+ Five-Star Google Reviews" is client-supplied — verify against the
listing before launch. Blog removed site-wide (nav, footer, home section,
routes, templates, seeding, sitemap).
Client-directed revisions (2026-07-21): hero line "Resolving Differences." is
gold (`--color-gold`; "Building Bridges." stays light). Creds sub-line reads
"Negotiation, Mediation and Dispute Resolution" (title case). Bio heading is
"Meet Raphael E. Lapin" (eyebrow "Our Introduction" dropped). The "uniquely
qualified" cards use thin-stroke rose-gold Lucide icons in the discs
(award / network / lightbulb / book-open) instead of the 01–04 numerals. The
creds "Top rated" item opens a first-party Google-reviews `<dialog>` modal
(replicates the old Trustindex popup; data via Lapin_Reviews, no third-party
JS; href to Google kept as no-JS fallback). A floating gold tap-to-call
button (`.call-fab`, black phone glyph) shows bottom-right at collapsed-nav
widths on every page. The "Difficult People" video plays from 0:00 — the
host re-edited it in place, retiring the 6:26 skip.
Client-supplied copy replacement (2026-07-21, from the client's Word doc,
verbatim incl. unhyphenated "Harvard trained" / "high stakes" / "cross
disciplinary"): the founder section is now "Meet Raphael Lapin" + role line
"Negotiator. Mediator. Problem Solver." + four new shorter paragraphs; the
quals section drops the "Why Choose Us" eyebrow, H2 is title-case "What
Makes Us Uniquely Qualified", and all four card titles + bodies are the
client's new shortened versions. Client typo fix: "Insights on Dispute
Resolution" blurb reads "A lot of us forget about the cost of conflict"
(stray "is" deleted).
Client-directed revisions (2026-07-21, later): home hero CTA reads "Schedule
a Free Consultation". Footer newsletter column removed entirely (UI + the
Lapin_Contact newsletter handler; foot__cols is 3 columns now — client: "we
don't need that"). Mobile hero bridge un-muted: the art ramps in vertically
(faint behind the headline, ~full behind the CTA row) instead of a flat
0.55 opacity, so the bridge pops on mobile without costing text contrast.
Phones 310-984-6952 / 888-964-8884, email info@LapinNegotiationServices.com,
address The Tower, 10940 Wilshire Blvd, Suite 1600, Los Angeles, CA 90024.
The live footer's injected casino spam is NOT carried over.

## Performance law (95+ mobile/desktop, 100 SEO)

- Zero builder CSS/JS; theme styles dequeued; WP head cruft stripped.
- All CSS inline; three font files max (two preloaded); the masthead bridge
  raster is the LCP image on every page — preloaded with imagesrcset +
  `fetchpriority="high"`, never lazy; images WebP with width/height, lazy
  below fold.
- Third-party embeds behind click-to-load facades.
- JSON-LD: ProfessionalService + WebPage per page; Article + BreadcrumbList on
  posts; Blog on the index. Unique title/description/canonical per URL.
- /sitemap.xml lists home and the routed pages (no blog, no posts).

## Exports

### tokens.css

```css
:root {
  --color-paper:         oklch(98.2% 0.005 80);
  --color-paper-2:       #F3ECE1;
  --color-onyx:          #49494B;
  --color-onyx-2:        oklch(30% 0.006 300);
  --color-ink:           oklch(28% 0.01 300);
  --color-ink-2:         oklch(42% 0.01 300);
  --color-ink-inverse:   oklch(96.5% 0.008 80);
  --color-ink-inverse-2: #D1BFA7;
  --color-muted:         #8E8E90;
  --color-rule:          oklch(88% 0.015 80);
  --color-rule-onyx:     oklch(42% 0.012 300);
  --color-accent:        #BD8C7D;
  --color-accent-strong: oklch(44% 0.075 35);
  --color-gold:          #D1BFA7;
  --color-focus:         oklch(55% 0.1 40);

  --font-display: 'DM Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
  --font-body:    'Poppins', system-ui, -apple-system, 'Segoe UI', sans-serif;

  --space-3xs: 0.125rem; --space-2xs: 0.25rem; --space-xs: 0.5rem;
  --space-sm: 0.75rem;   --space-md: 1rem;     --space-lg: 1.5rem;
  --space-xl: 2.5rem;    --space-2xl: 4rem;    --space-3xl: 6rem;
  --space-4xl: 9rem;

  --text-sm: 0.8rem;    --text-base: 1rem;    --text-body: 1.0313rem;
  --text-md: 1.25rem;   --text-lg: 1.5625rem; --text-xl: 1.9531rem;
  --text-2xl: 2.4414rem; --text-3xl: 3.0518rem;
  --text-display: clamp(2.5rem, 4vw + 1rem, 4.25rem);
  --text-display-s: clamp(2rem, 3vw + 1rem, 3.25rem);

  --tracking-display: -0.015em;
  --tracking-label: 0.14em;

  --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
  --ease-in: cubic-bezier(0.7, 0, 0.84, 0);
  --ease-in-out: cubic-bezier(0.65, 0, 0.35, 1);
  --dur-micro: 120ms; --dur-short: 220ms; --dur-long: 480ms;

  --radius-btn: 2px; --radius-card: 4px; --radius-input: 3px;

  --z-base: 1; --z-raised: 10; --z-dropdown: 100;
  --z-sticky: 200; --z-modal: 400; --z-toast: 500; --z-tooltip: 600;
}
```
