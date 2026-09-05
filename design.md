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
                               divider + single service lead in a left ~60%
                               column, bridge art right at raised presence;
                               then creds strip (five-star Google item),
                               practice areas, founder diptych, reviews grid +
                               40+ band, client-logo marquee, icon
                               qualification cards (paper), media wall (cream,
                               bridge-motif audio facades), CTA band.
                               (Quals before media per client, 2026-07-22.)
- Service pages:               **Split Studio** — 65/35 text/icon diptychs;
                               may extend to **Stepped Studio** (v2.8) when the
                               page carries a process: split opener → cream band
                               of ordinal step cards → two rule-topped columns →
                               CTA band.
- Content pages:               **Long Document** — editorial prose, inline heads.
- Contact:                     split utility — form left, contact facts right.
- Blog:                        index = card grid; posts = Long Document.
                               (Revived 2026-07-22; see content-law v2.5.)
- SEO landing pages:           Split Studio + FAQ (service/location).

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
Logo colorway (client "option 2", 2026-07-21): header, footer and favicons
all use rosewood #A97968 (pieces + LAPIN + subtext + rule) with deep russet
#764236 pieces — replaces the soft-gold/rose-gold mixes. `logo-on-light`
(option-1 onyx/rose) is unchanged for OG/schema. Favicons regenerate from
`logo-on-dark.png` via tasks/tools/favicon-gen.php.

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
- Service pages: inline Lucide icons, no icon-tile grids. Ordinal step cards
  (`.neg-step`) may carry a 3px rose top edge, a stage word in
  `--color-accent-strong` (label voice; v2.9 — was an `01`–`04` numeral), a
  hairline lead-out rule and a small line icon at
  0.75 opacity; the bottom note aligns across the row (`margin-top: auto`).
  A service page MAY replace the shared CTA band with client-supplied closing
  copy, rendered in the same `.cta-band .band` voice and button pair.
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
rose gold (`--color-accent` #BD8C7D, matching the hero CTA fill — client
first asked for gold, then revised to "the same darker gold as the Schedule
block"; the display-size line is a client-directed exception to the ≤5%
rose-gold budget). "Building Bridges." stays light. Creds sub-line reads
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
Client final pre-launch revisions (2026-07-22): the hero sub is a single
lead line "Trusted Mediation and Negotiation Services for Individuals,
Businesses, Families, and Organizations" (the old lead + "Delivering
practical…" body pair is retired). Reviews H2 is "Client Experiences"
(eyebrow "Our Testimonials" dropped). Home section order: qualification
cards (paper band, paper-2 discs) before Media Appearances (cream band).
Call FAB is rosewood `--color-rosewood` #A97968 (logo gold) with a solid
`--color-hero-onyx` phone glyph. Contact page: old-site handshake photo
removed; the masthead bridge renders as a fixed whole-page watermark at
0.07 opacity (`.contact-watermark`, reuses the preloaded asset).
Client-directed revisions (2026-07-21, later): home hero CTA reads "Schedule
a Free Consultation". Footer newsletter column removed entirely (UI + the
Lapin_Contact newsletter handler; foot__cols is 3 columns now — client: "we
don't need that"). Mobile hero bridge un-muted: the art ramps in vertically
(faint behind the headline, ~full behind the CTA row) instead of a flat
0.55 opacity, so the bridge pops on mobile without costing text contrast.
Phones 310-984-6952 / 888-964-8884, email info@LapinNegotiationServices.com,
address The Tower, 10940 Wilshire Blvd, Suite 1600, Los Angeles, CA 90024.
The live footer's injected casino spam is NOT carried over.

**v2.5 — Blog revived + SEO landing pages (2026-07-22, client-directed).**
Reverses the 2026-07-19 "blog removed site-wide" direction: the blog is back
(index card grid at /blog/ = Long Document macrostructure; posts at root-level
slugs; Article + BreadcrumbList JSON-LD on posts, Blog on the index). Nav gains
a "Blog" item; footer Explore gains Blog; the home page gets a "From the Blog"
teaser (3 latest posts) between the qualification/media bands and the CTA band.
Three SEO service/location landing pages added (Split Studio + FAQ): Negotiation
Services in Los Angeles, ADR & Dispute Resolution in Santa Monica, Divorce
Mediation in Los Angeles — targeting the site's highest-impression Search Console
queries; each carries Service + FAQPage JSON-LD and links from the footer Services
column (not the top nav). Blog posts are **original editorial authored from
Raphael Lapin's own recorded interviews** (public/tasks/data-source/), not live-site
copy — the verbatim rule does not apply, but the invented-metrics/testimonials rule
does: facts are drawn only from what Raphael states on the transcripts (Harvard-
trained under Roger Fisher; author of *Working with Difficult People*; 1,000+
mediated cases; Los Angeles based). Landing-page copy is adapted from the verbatim
service pages + transcripts. Santa Monica page states "West LA office serving Santa
Monica and the Westside" — never a Santa Monica address. All new copy is DRAFT
pending client audit. CTAs (Schedule a Free Consultation / Call Now) are woven
through every post and landing page via the `.post-cta` callout.

**v2.6 — Punch-list revisions (2026-07-22, client-directed).**
- **Insights rename:** the "Blog" label is now **"Insights"** everywhere user-facing
  (nav, footer, page H1, `<title>`, Blog schema name). The `/blog/` URL + `'blog'`
  route key are kept. Nav order changed: Insights now sits **after Services, before
  Contact** (moved into `$lapin_nav_after`).
- **Home hero:** the decorative diamond divider (`.hero__divider`) is removed; the
  hero lead gains top margin to keep the H1↔subheading spacing. The "Some of our
  clients" logo marquee section is removed from the home page (client: reads as
  "corporate-only"; Client Experiences carries credibility). The shared `.marquee`
  CSS is retired if unused.
- **About Us:** the Founder, "Some of our clients", and Headquarters sections are
  removed (Founder duplicates the home page). The now text-only page is warmed to
  pale gold (`--color-paper-2`) with the cable-line **watermark** behind it for visual
  interest.
- **Call FAB glyph** is onyx (`--color-onyx` #49494B) on the rosewood disc
  (client settled on onyx 2026-07-23, after brief white then black spells).
- **Watermark generalised + redrawn (client 2026-07-23):** `.contact-watermark` → a
  shared `.watermark` utility (tokens) + a `lapin-watermark` partial, emitted once from
  the footer partial on **every page except the home page**, absolutely anchored to the
  footer's top edge (`bottom:100%`) so it rises into the content just above the footer
  and scrolls with the page (top of page stays clean; the dark CTA band caps the densest
  lower portion). The photo bridge watermark is **replaced by the corner-sweep
  linework from the design handoff** (`claude-design/design_handoff_watermark/`): two fans
  of nested quadratic curves sweeping up from the bottom-left and bottom-right corners,
  fading toward the outer lines, centre left clear. Ported verbatim from the handoff's
  `buildFan()` (viewBox 1900×630, `preserveAspectRatio="none"`; left fan 26 lines
  spread 560 / reach 620, right fan 30 lines spread 660 / reach 900; per-line opacity
  `0.5·(1−0.55t)`; stroke `#c9a188`). Zero image request; whole-fan strength tunable per
  page via `--watermark-opacity`.
  Client tuning (2026-07-23, later): desktop band height is a **fixed `1600px`**; the fan
  keeps the handoff `buildFan` geometry verbatim (left 26/560/620, right 30/660/900) with a
  plain scaling `stroke-width: 1` so it gains organic weight variation like the handoff.
  Per-line base opacity is kept at **1.0** (handoff is 0.5; raised for the client's repeated
  "more visible" request). Mobile/tablet (`max-width: 63.9375rem`) swaps to a **separate
  portrait fan** (`.watermark__art--mobile`, viewBox 390×840, `buildMobileFan`, count 0.7×
  desktop) — a single **bottom-right** sweep per the handoff, rendering ~1:1 so it stays clean
  instead of stretching into slivers (its stroke is nudged to 1.5px for on-phone visibility).
  Each rendering is a separate SVG (`.watermark__art--wide` / `--mobile`) toggled at the
  breakpoint. The mobile band is lifted above the onyx CTA band (`bottom: calc(100% + 24rem)`;
  `20rem` on the contact page, whose CTA band is one button-row shorter) so the fan's
  convergence lands at the bottom of the light content, touching the dark band's top edge.
- **Practice Areas:** "Targeted Practice Areas" → **"Practice Areas"** (H1 + lede).
  Each of the 15 areas now shows a small, subtle Lucide icon (per the client's mockup);
  the `professions.webp` figure is replaced by the shared watermark. New icons added to
  `assets/icons/` (building-2, scale, hard-hat, heart-crack, hand-heart, house, building,
  briefcase-medical, scroll-text, key-round, users-round, feather).
- **Services pages:** the hero CTA drops "with a specialist" → **"Free Consultation"**,
  rendered as a highlighted gold-outlined box (`.hero__cta`, hero partial `cta` config)
  with the phone numbers as `tel:` links. Split-row icons are **smaller and more subtle**
  (reduced width, 0.6 opacity, thinner stroke) and forced to the **start of every
  section on mobile** (`.split__media { order: -1 }`). Negotiation page section order
  is now Why → Advice & Support → Representation → **Training (last)**.
- **Orange County landing page:** new `mediation-negotiation-orange-county` route +
  template (Split Studio + FAQ, Service City=Orange County + FAQPage JSON-LD), linked
  from the footer Services column. Honest framing: Raphael conducts mediations and
  negotiations out of Newport Beach and throughout Orange County (client-stated fact);
  no OC street address is claimed. Requires plugin reactivation to create the page.

**v2.7 — About Us headshot redesign (2026-07-24, client-directed).**
Reverses the v2.6 "text-only About" direction. The client supplied a professional
headshot of Raphael Lapin + a desktop/mobile mockup (`app/public/claude-design/
design_handoff_about_us/`) to make the text-heavy page visually engaging. The
`/overview/` template is re-fronted with a **headshot-led hero** (copy left, full-bleed
photo right, flex-wrap; eyebrow + two-line H1 "Building Bridges." / rose "Resolving
Differences." + two-paragraph lede + "Schedule a Consultation" button + "Meet Raphael
Lapin" text link), a **four-pillar floating card** (users/handshake/target/shield;
Our Approach · Commitment · Focus · Promise), and an **"Our Practice" narrative +
pull-quote card**. The retained verbatim **Media appearances** and **Our mission /
Our vision** sections stay below; the now-redundant "Introducing our firm" and "Why us?"
sections are dropped (the hero/pillars/Our Practice cover them). The shared masthead +
footer are retained; the page-title hero block is removed (`$lapin['hero']` unset →
nav-only masthead).
- **New copy is client-approved as-is** (2026-07-24): the hero lede, the four pillar
  blurbs, and the pull-quote **"The art of negotiation is not about winning or losing—it's
  about finding common ground and building a better path forward." — Raphael Lapin** are
  from the mockup and confirmed by the client as real/approved (a client-directed exception
  to the verbatim + no-invented-testimonials rules).
- **"Meet Raphael Lapin"** links to the **`#raphael` founder section on the home page**
  (client direction — the founder bio lives there); the mockup's unwired link is thus resolved.
- **Design-system adaptation:** the mockup's Playfair/Montserrat/Sacramento + warm-brown
  palette is rebuilt in the locked system — **DM Sans + Poppins, brand tokens** (paper-2,
  onyx, accent, gold) — so About reads as the same site, honoring the two-font perf budget
  and "no third family." The Sacramento cursive signature is rendered as a display-font name
  in `--color-accent-strong` (no fourth font). The shared `lapin-cta-band.php` is reused
  (its client-approved "Already in negotiation?" copy) instead of the mockup's own CTA band.
- **Headshot asset:** client JPG (landscape 4368×2912, EXIF orientation 6) baked upright into
  `assets/images/about-headshot-{800,1200}.webp` (portrait 2:3); it is the page LCP —
  preloaded with imagesrcset + `fetchpriority="high"`, `object-position: 50% 28%` (Y tunable
  via the crop comment). New Lucide icons added: `target.svg`, `shield.svg`.

**v2.8 — Negotiation page rebuilt from the client's revision doc (2026-08-30, client-directed).**
Raphael supplied a complete replacement for `/negotiation/` ("NEGOTIATION SERVICES PAGE",
Word doc) with a brief for a scannable, segmented, premium layout consistent with Home and
About. The page's four verbatim live-site sections (Why a negotiation specialist? · Negotiation
advice & support · Negotiation representation · Negotiation training) are **retired**; the new
client copy is used verbatim (a client-directed exception to the live-site verbatim rule, same
precedent as the 2026-07-21 founder/quals replacement).
- **Structure (Stepped Studio):** masthead hero (eyebrow "Negotiation Services" + H1 "Strategic
  Negotiation Support for High-Stakes Matters" + lede + the new gold statement line + the
  gold Free Consultation box) → **Why Work With a Negotiation Specialist** as the retained
  Split Studio diptych (`award` icon) → **How We Help** on the cream band as four ordinal step
  cards (`target` / `lightbulb` / `messages-square` / `user-round-check`), 2×2 on desktop,
  stacked below 1024px → **Types of Negotiations We Handle** as the client's two rule-topped
  columns (`handshake` transactional / `scale` settlement) + the closing display line →
  the client's own CTA copy in the shared onyx band voice.
- **New hero affordance:** `$lapin['hero']['statement']` renders an optional one-line
  positioning statement under the lede — DM Sans 700, `--text-md`, `--color-gold`, 34ch cap
  (`.hero__statement` in `lapin-tokens.php`). Reusable by any service page.
- **CTA band:** this page ships the client's closing copy ("Schedule a consultation to discuss
  your matter." + the "If you're preparing for a negotiation…" line) instead of the shared
  `lapin-cta-band.php`; buttons stay the standard gold/outline pair.
- **Open item:** the retired "Negotiation training" section (Fortune 100 programs, customized
  training / practical experience / measurable results) has **no home on the site** — the new
  doc drops it. Flagged for client decision; the Fortune 100 training credential still appears
  on the home creds strip.

**v2.9 — Negotiation copy revision 2 + client design notes (2026-09-05, client-directed).**
Raphael's second revision doc replaces the 2026-08-30 copy wholesale (used verbatim) and
carries three design notes, all applied:
- **Subpage hero H1 sizing (site-wide fix).** `.hero--page h1` was a fixed `--text-3xl`
  (48.8px at every width), so on a phone every subpage title rendered *larger* than the home
  hero (40px) while being smaller on desktop. New token `--text-hero-page:
  clamp(2.5rem, 2vw + 1.6rem, 3.0518rem)` floors at the home hero's mobile size and keeps the
  existing desktop size. Applies to every subpage, not just Negotiation.
- **Lede parity.** Both paragraphs under a service-page section head now share the opening
  paragraph's size (`--text-md`/1.55) — the `.lead` + body-size pairing is retired on this page.
- **Stage words replace ordinals.** The "How We Help" cards carry ASSESS · DESIGN · ADVISE ·
  REPRESENT (`.neg-step__label`) where the `01`–`04` numerals sat — same position, same
  `--color-accent-strong` copper, label voice (DM Sans 700, `--text-sm`, `--tracking-label`,
  uppercase); the hairline accent rule beside them is kept. The word duplicates the card
  heading, so it is `aria-hidden`.
- **Hero order.** `$lapin['hero']['statement']` now renders *between* the H1 and the lede
  (H1 → short gold punch line → explanatory sentence), matching the client's doc order.
- **Copy deltas:** hero punch line is "Clear strategy. Creative solutions. Stronger Outcomes."
  (client capitalisation, 2026-09-05)
  ("We help you negotiate from strength." retired); both Why-Work-With paragraphs rewritten
  (the bolded "objectivity, strategy, and creative problem-solving" run is no longer bolded);
  stages 2–4 gain second lead paragraphs and stage 4 gains a closing line; stage 3 gains a
  fifth bullet; the types lists grow (Partnership agreements · Senior-level employment and
  compensation agreements · Trust and Estate disputes · Judgement Settlements · Contract and
  commercial disputes) and the H2 is verbatim "Types of Negotiations We Handle Include:";
  the CTA gains the heading "Approach Your Next Negotiation Strategically" and keeps
  "Schedule a consultation to discuss your matter." as a gold ask line above the buttons.
- **Still open:** the retired "Negotiation training" section (v2.8) has no home on the site.

**v2.10 — Dispute Resolution page rebuilt from the client's copy doc + design brief
(2026-09-05, client-directed).**
Raphael supplied a complete replacement for `/dispute-resolution/` ("Dispute Resolution Page")
plus a "matched to Negotiation page" design brief. The page's four verbatim live-site sections
(Avoid the costs of court · Settlement negotiation advice and coaching · Settlement negotiation
agent · Why a dispute resolution specialist?) are **retired**; the new client copy is used
verbatim (same client-directed exception to the live-site verbatim rule as v2.8/v2.9).
- **Positioning shift:** the page no longer sells "ADR instead of litigation" — it sells
  stabilizing *escalated* conflict, explicitly broader than mediation and upstream of it.
  `<title>`, meta description and Service `serviceType` all re-aimed accordingly.
- **Structure (Stepped Studio, sibling of `/negotiation/`):** masthead hero (eyebrow "Dispute
  Resolution" + H1 "Dispute Resolution When Conflict Escalates" + lede + the gold Free
  Consultation box; no `statement` line — the client supplied none) → **How We Help** on the
  cream band as six capability cards (`shield` / `network` / `layers` / `messages-square` /
  `target` / `handshake`), 3-up desktop → 2-up ≤1024px → stacked ≤768px → **How This Differs
  From Mediation** as a single cream box on paper (1px rule, 3px rose top edge, `--space-xl`
  padding — the brief's "lightly shaded box") → **Who This Is For** as a three-column rose-mark
  bullet grid → **Outcome** on the cream band: lede + a three-part rule-topped bar (Stabilized
  Conflict · Reopened Interaction · Clear Path Forward, DM Sans 700, hairline separators) →
  the client's own CTA copy in the shared onyx band voice.
- **Card anatomy:** `.dr-card` reuses the v2.9 stage-card head rhythm (icon + hairline lead-out
  + 3px rose top edge) **without** the stage word — the six items are parallel capabilities, not
  an ordinal sequence, and inventing stage labels would be invented content.
- **Copy-source conflicts, resolved:** card titles follow the design brief's "exact titles"
  ("Reopen Interaction Channels", not the copy doc's "Reopen Channels of Interaction"), and the
  section header is the brief's "How This Differs From Mediation" (not "What Makes This Distinct
  From Mediation"). **Who This Is For keeps the copy doc's full 10-item list** — the brief's
  echo drops Family business / Trust & Estate / Litigated disputes, and dropping client copy is
  the worse error. The Outcome lede is the brief's longer version (…"whether through mediation,
  negotiation, or facilitated agreement-building").
- **Brief notes deliberately not followed:** the brief's "no imagery; clean white background"
  hero is overridden by the site-wide bridge masthead (v2.4 law — one artwork site-wide); the
  hero CTA stays the gold `Free Consultation` phone box (v2.6 services law) rather than a
  "Schedule a Consultation" button, which is carried by the CTA band instead.
- **Open item:** the retired live-site copy included the only on-site explanation of settlement
  *agent* representation on this page. `/negotiation/` still covers representation; flagged in
  case the client wants an agent-representation line kept here.

**v2.11 — client-directed copy corrections, 2026-09-05 (same session, later pass).**
- **`/negotiation/` hero statement:** every word now capitalized —
  "Clear Strategy. Creative Solutions. Stronger Outcomes." (was "Clear strategy. Creative
  solutions. Stronger Outcomes."). The gold statement line is title-cased in full from here on.
- **`/dispute-resolution/` How We Help, card 2:** title is now **"Open Backchannels for
  Dialogue"** (was the brief's "Reopen Interaction Channels"), superseding the v2.10
  copy-source resolution for this one card.
- **`/dispute-resolution/` Outcome lede:** the trailing qualifier is cut — reads "A stabilized
  conflict, restored channels of interaction, and a clear pathway toward resolution." The
  v2.10 decision to use the brief's longer "…whether through mediation, negotiation, or
  facilitated agreement-building" is reversed.
- **`/dispute-resolution/` Outcome bar removed:** the three-part rule-topped bar (Stabilized
  Conflict · Reopened Interaction · Clear Path Forward) is cut as repetitive of the lede it
  sat under. The Outcome section is now heading + lede only; `.dr-outcome` CSS deleted with it.
  This retires that half of the v2.10 Outcome structure.
- **`/dispute-resolution/` hero sub-headline replaced** with the client's corrected line: "We
  introduce a structured process so parties can move from impasse to **stability and
  constructive engagement**." (was "…from impasse to resolution.") This is the authoritative
  version — the v2.10 lede came from a superseded draft.

**v2.12 — Mediation page rebuilt from the client's copy doc + design brief
(2026-09-05, client-directed).**
Raphael supplied the third and last page replacement ("Mediation Services Page") plus a
six-point design brief, in the same email that re-sent the corrected Negotiation and
Dispute Resolution copy. The page's four verbatim live-site sections (Mediation — an
alternative to litigation · Mediation services · Mediation preparation, support and
coaching · The power of mediation vs. the costs of litigation) are **retired**; the new
client copy is used verbatim (same client-directed exception as v2.8/v2.9/v2.10). The
service family is now complete and consistent across all three pages.
- **Positioning:** mediation as a *neutral, facilitated process* for parties who are
  ready — or can be made ready — to engage in structured dialogue; explicitly downstream
  of Dispute Resolution and distinct from Negotiation. `<title>`, meta description and
  Service `serviceType` re-aimed accordingly (the old "alternative to litigation" and
  "$1,500–$5,000 per party" framing is gone).
- **Structure (Stepped Studio, sibling of `/negotiation/` + `/dispute-resolution/`):**
  masthead hero (eyebrow "Mediation Services" + H1 "Mediation for Complex & Contentious
  Disputes" + lede + the gold Free Consultation box; no `statement` line — the client
  supplied none) → **What Mediation Is — And Why It Matters** as the retained Split Studio
  diptych (`users-round` icon) → **How We Help** on the cream band as six capability cards
  (`scale` / `layers` / `target` / `lightbulb` / `messages-square` / `handshake`) in the
  brief's **two-column** grid, stacked ≤1024px → **What Makes This Distinct from Negotiation
  & Dispute Resolution** as three equal panels → **Who This Is For** as a three-column
  rose-mark bullet grid → **Outcome** on the cream band as heading + lede (no bar — v2.11
  law) → **Additional Advisory Services** as one wide cream callout with the icon at the
  shoulder → a CTA band in the shared onyx voice.
- **Card anatomy:** `.med-card` reuses the `.dr-card` head rhythm (icon + hairline lead-out
  + 3px rose top edge) with no stage word. The brief's two-column layout (vs. the DR page's
  three-up) gives the six cards `--space-xl` padding, matching `.neg-step`.
- **Three-way distinction, new component:** `.med-distinct` renders the client's three
  definitions as equal panels — Negotiation and Dispute Resolution on paper with a neutral
  hairline top edge, Mediation in `--color-paper-2` with the 3px rose top edge and its term
  in `--color-accent-strong`. The two sibling terms are **links** to `/negotiation/` and
  `/dispute-resolution/` (rose underline on the term only) — the site's first inline
  service-to-service cross-links, and the reason this page uses three panels rather than
  the DR page's single shaded box.
- **Copy corrections applied:** the doc's "we offer a advisory service" → "an advisory
  service"; "Partnership or cofounder disputes" → "Co-founder" and "Trust & estate matters"
  → "Trust & Estate", both to match the sibling pages' house style. The doc's `<strong>`
  runs (neutral, structured environment · high-trust, professional process · neutral,
  facilitated process · advisory service · outside) are preserved.
- **Brief notes deliberately not followed:** "Mediation Services" is the hero **eyebrow**
  and "Mediation for Complex & Contentious Disputes" the **H1**, not the reverse the brief's
  wording implies — the H1 must carry the descriptive line for SEO, and this is the exact
  relationship the client already approved on `/negotiation/` ("Negotiation Services" eyebrow
  → descriptive H1). The brief's "same call to action" is read as the hero's gold
  `Free Consultation` phone box (v2.6 services law), which is what the siblings carry.
- **Authored, pending client sign-off:** the CTA band heading "Ready to bring a neutral
  process to the table?" — the client's doc ends at Advisory Services and supplies no closing
  copy, same situation as `/dispute-resolution/` in v2.10. The body line and button pair are
  the shared band's approved copy.
- **Open item:** the retired **mediation vs. litigation comparison table** (9 verbatim pairs:
  resolved in a day vs. years, $1,500–$5,000 vs. tens of thousands, private vs. public record,
  relationships salvaged vs. sworn enemies) was the site's strongest conversion asset and has
  **no home anywhere on the site** now. The client's section list does not include it. Flagged
  for a decision — it would sit naturally as a section on this page or on `/practice-areas/`.
- **Open item:** the retired "Mediation preparation, support and coaching" section is largely
  superseded by the new Advisory Services section, but the new copy scopes that support to
  *third-party* mediations only. Preparation coaching for parties in **our own** mediations is
  no longer described anywhere.

## Performance law (95+ mobile/desktop, 100 SEO)

- Zero builder CSS/JS; theme styles dequeued; WP head cruft stripped.
- All CSS inline; three font files max (two preloaded); the masthead bridge
  raster is the LCP image on every page — preloaded with imagesrcset +
  `fetchpriority="high"`, never lazy; images WebP with width/height, lazy
  below fold.
- Third-party embeds behind click-to-load facades.
- JSON-LD: ProfessionalService + WebPage per page; Article + BreadcrumbList on
  posts; Blog on the index; Service + FAQPage on the SEO landing pages. Unique
  title/description/canonical per URL.
- /sitemap.xml lists home, the routed pages (incl. blog index + landing pages),
  and every published blog post. One sitemap only — core /wp-sitemap.xml is
  disabled. It is generated dynamically (no static file), so it never goes stale
  and ships with the plugin.
- robots.txt (virtual, via Lapin_Sitemap): default rules + explicit Allow blocks
  welcoming the major search + AI crawlers (Googlebot/Bingbot/Applebot,
  Google-Extended, GPTBot, ClaudeBot, PerplexityBot, Amazonbot, CCBot, …), plus
  the Sitemap line. Honors the "discourage search engines" setting (blog_public).

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
