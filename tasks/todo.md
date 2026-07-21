# Repo + Child Theme + SFTP Deploy Setup

## Plan
- [x] Create block child theme `lapin-negotiation-services` (parent: twentytwentyfive)
- [x] Scaffold custom plugin `lapin-core` (site functionality plugin, so /plugins has a deployable custom plugin)
- [x] Init git repo at `app/public` with whitelist .gitignore (only child theme, custom plugins, workflow, docs tracked â€” WP core excluded)
- [x] GitHub Actions workflow: push to `main` â†’ SFTP deploy of wp-content (uses `production` GitHub environment secrets)
- [x] README documenting required secrets
- [x] Commit + push to https://github.com/daniloluang23/lapin-negotiation-services.git

## Review
- Pushed as `main` (commit 411cdf2), 8 files. Verified via `git status` that the whitelist
  .gitignore tracks only custom code â€” no WP core, no third-party plugins.
- Child theme is a block child theme: style.css (Template: twentytwentyfive), functions.php
  (enqueues style.css â€” block themes don't load it automatically), minimal theme.json v3.
- Deploy uses wlixcc/SFTP-Deploy-Action with `sftp_only: true` (works on shared hosts with
  no shell access). Password OR SSH key auth, port defaults to 22.
- Pending (user): create `production` environment + secrets on GitHub (see README table);
  activate theme + plugin in wp-admin. First workflow run will fail until secrets exist.
- Assumption: parent theme is Twenty Twenty-Five (fresh install, no other theme present).
  If a different theme gets installed later, update `Template:` in the child style.css.

---

# Lapin full-site redesign (2026-07-13)

## Plan (all complete)
- [x] Extract full content, brand assets, and structure from lapinnegotiationservices.com
- [x] Lock design system into `design.md` (+ `.hallmark/log.json`)
- [x] Optimize assets: images â†’ WebP (about-us 1.26MB â†’ 100KB; client logos 57â€“101KB â†’ 1â€“2KB each); self-host Fraunces + IBM Plex Sans variable WOFF2 (113KB total)
- [x] Build `wp-content/plugins/lapin/` (legalia architecture): bootstrap, Pages router (template_include + head cleanup), Contact form handler, 5 partials, 7 page templates
- [x] SEO: unique title/description/canonical per page, OG/Twitter, JSON-LD (ProfessionalService, WebPage, BreadcrumbList, Service, ContactPage)
- [x] Client feedback: "WAY to WOW Showson" typo fixed; auto-rotating media carousel replaced with a spaced static grid (fixes overlap + rotation-timing complaints)
- [x] Verify: PHP lint clean; all 7 pages HTTP 200; single title/canonical/viewport; zero horizontal overflow at 320/375/414/768 (puppeteer emulation); Hallmark 58-gate slop test passed after fixes

## Review
- Plugin `lapin` active on local; pages auto-created on activation (slug-matched, non-destructive); front page set to Home.
- Live-site footer spam (casino links) NOT carried over â€” the live install is likely compromised; client should change passwords / audit.
- `wp-content/media/podcasts/Bullies.mp3` (40MB) downloaded locally to mirror the live path; left untracked in git.
- lapin-core plugin and child theme untouched.

## Lessons
- Headless Chrome via CLI clamps window width to ~500px â€” mobile verification needs puppeteer(-core) viewport emulation, not `--window-size`.
- Block themes add `_block_template_render_title_tag` / `_block_template_viewport_meta_tag` inside `locate_block_template()`, which runs after the `wp` hook â€” remove them inside the `template_include` filter.

---

# Sitemap (2026-07-13)

## Plan (complete)
- [x] Serve `/sitemap.xml` dynamically from the lapin plugin (new `includes/class-lapin-sitemap.php`) â€” home + the 6 `Lapin_Pages::ROUTES` slugs, `lastmod` from each page's `post_modified_gmt`
- [x] Intercept in `parse_request` (no rewrite rule â†’ no flush needed); URLs mirror the canonical style (`home_url('/') . 'slug/'`)
- [x] Disable core `/wp-sitemap.xml` (`wp_sitemaps_enabled` â†’ false) so there's one exact sitemap, not two competing ones
- [x] Append `Sitemap:` line to the virtual robots.txt via `robots_txt` filter

## Review
- Chose dynamic over a static root file: a static sitemap.xml would go stale on edits and
  sits outside wp-content, so the SFTP deploy would never ship it.
- Verified via curl on local: `/sitemap.xml` 200 with all 7 URLs + lastmod; `/robots.txt`
  contains the Sitemap line; `/wp-sitemap.xml` 404 (core disabled); home + contact still 200.
- Missing pages (deleted from wp-admin) are skipped automatically â€” no 404s in the sitemap.

---

# Redesign to approved staging DNA + blog (2026-07-14)

Client approved a new design (staging: stg-lapinnegotiationservices-staging.kinsta.cloud,
SULTIN theme + Elementor). Goal: carry that design's DNA into the hand-built lapin
plugin (keep 95+ Lighthouse mobile/desktop, 100 SEO), plus client art direction:

- Palette: Rose Gold `#BD8C7D` Â· Soft Gold `#D1BFA7` Â· Silver `#8E8E90` Â· Onyx `#49494B`
  (matches staging's Elementor kit globals; client's exact values win)
- Fonts (from staging): DM Sans (display) + Poppins (body)
- Logo option 1, bigger and prominent in the header (regenerated from official 1980Ã—700
  art via GD recolor: on-light = onyx/rose-gold/silver; on-dark = rose-gold/soft-gold)
- New hero tagline as H1: "Building Bridges. Resolving Differences." with subheading
  "Professional Mediation and Negotiation Services Delivering Practical, Durable
  Solutions for Businesses, Families, and Organizations."
- Same header on ALL pages: abstract-bridge masthead (hand-built inline SVG, no image)
- Drop "Negotiation Mediation Unlitigationâ„¢" kicker; remove Unlitigation section/definition
  from About; drop the footer Unlitigation line
- Stronger CTAs: "Schedule a Consultation" / "Call Now" / "Request an Assessment"
- Blog: index at /blog/ + 6 posts at root-level slugs (URLs identical to staging),
  content migrated verbatim by script; sitemap updated with blog URLs

## Plan (all complete)
- [x] hallmark study (URL mode) on staging: fonts, kit colors, structure, motion
- [x] Download + recolor official logo art to option-1 palette (both variants)
- [x] Self-host DM Sans var + Poppins 400/600 (79KB total, latin subsets)
- [x] Extract 6 blog posts (title/date/desc/image/body) via DOM script â†’ posts-clean.json
- [x] Blog featured images â†’ WebP 1200w + 640w in plugin assets
- [x] Amend design.md to the new locked system
- [x] Rebuild tokens partial (palette/type/motion + shared chrome CSS)
- [x] Masthead: topbar + nav (big logo, Blog link, Schedule a Consultation) + bridge hero on every page
- [x] Home: hero â†’ creds â†’ practice-area teaser â†’ founder â†’ client-logo marquee â†’
      media wall â†’ qualifications â†’ latest blog posts â†’ CTA band (mid-task client
      concept mock adopted: eyebrow tagline + "Experienced. Strategic. Results-Focused."
      display + stats strip + centered practice icons)
- [x] Footer: 4 columns (contact / explore / services / newsletter) + social + legal
- [x] Newsletter handler (admin-post, honeypot+nonce+rate-limit â†’ wp_mail)
- [x] Blog: 'blog' route + single-post routing, posts seeded on activation (slug-matched,
      non-destructive), permalink structure /%postname%/ for root-level post URLs
- [x] Sitemap: add /blog/ + post URLs
- [x] About: remove #unlitigation section; site-wide tagline swap
- [x] Verify: lint (23 files clean), smoke (15 URLs 200), mobile 320/375/414/768 no
      overflow, 1280Ã—800 hero-fold check, hallmark slop test

## Review
- All copy retained verbatim except client-directed removals (Unlitigation kicker/section/
  footer line) and client-supplied new hero copy. Concept-mock placeholders NOT carried
  over (39 reviews / 30 years / CBS-FOX logos / (949) phone / anonymous testimonial) â€”
  real facts kept: Harvard trained, 25+ years, 1,000+ disputes, real Google Reviews link.
  If the "Attorney, Los Angeles" quote is a real review the client wants featured, it's a
  one-edit add to the home page.
- Blog posts migrated byte-for-byte by script (DOM-extracted â†’ lapin-posts-data.php,
  generated file). URLs identical to staging (root-level slugs). Seeding is slug-matched,
  non-destructive; future posts can be authored in wp-admin (blog index + sitemap pick
  them up automatically; featured images for new posts go in assets/images/blog/{slug}.webp
  or the card renders text-only).
- Old navy/gold assets (hero-painting, old logos, Fraunces/Plex fonts) left in place â€”
  ?fonts=editorial preview switch still works; deleting them is a follow-up decision.
- Default WP "Hello world!" post trashed (was polluting blog index + sitemap).
- Bridge masthead is a hand-built inline SVG (~2.5KB) â€” no hero raster, LCP is the H1.
- Slop-test fixes shipped: post-card date + eyebrow contrast (accent-strong darkened to
  oklch(44%...)), masthead gradient tokenized, hero display resized to fit 1280Ã—800 fold,
  newsletter placeholder contrast.

## Lessons
- Local's site services can be started headless when the Local GUI won't: mysqld at
  lightning-services/mysql-8.4.0/bin/win64/bin/mysqld.exe (note doubled bin) with
  --defaults-file=%APPDATA%\Local\run\<siteId>\conf\mysql\my.cnf; php-cgi.exe -b
  127.0.0.1:10002/10003 -c <run>\conf\php\php.ini; nginx -p <run>\nginx -c
  <run>\conf\nginx\nginx.conf. Site ID from %APPDATA%\Local\sites.json.
- CLI PHP can bootstrap wp-load.php (for activation/seeding) only with the site's
  rendered php.ini (-c <run>\conf\php\php.ini) â€” it carries the mysqld socket that
  DB_HOST 'localhost' resolves to.
- A masthead with overflow:hidden is programmatically scrollable â€” a focus jump to an
  overflowing header button scrolled the whole canvas sideways. Use overflow:clip on
  decorative canvases, and never let the header row exceed the viewport.
- Full-page screenshots of scroll-reveal pages need a slow (~400px/150ms) pre-scroll
  or armed .rv elements read as blank sections.

---

# Client home revision â€” split hero, reviews grid, blog removal (2026-07-19)

## Plan (code + docs complete; site-up steps pending)
- [x] Hero: H1 = brand tagline (two lines) + diamond divider + SUBLINE split into
      lead/body; "Experienced. Strategic. Results-Focused." removed; copy in a left
      ~60% column, masthead bridge SVG right-shifted (58% box, raised opacity,
      .page-home scoped â€” subpage mastheads untouched)
- [x] Creds: Google-reviews item icon â†’ five gold stars (text + link unchanged)
- [x] "Targeted Practice Areas" â†’ "Practice Areas" (redundant eyebrow dropped)
- [x] Bio lead swapped to the client-supplied sentence
- [x] Reviews: scroll-snap slider + autoplay/arrows JS removed â†’ static 6-card grid
      (3/2/1 cols) + centered "40+ Five-Star Google Reviews" band + Google link +
      Trustindex badge; H2 "What Clients Are Saying"; read-more clamp kept
- [x] Media: the 4 audio cards get 16:9 bridge-motif facades (inline
      lapin-bridge-mini symbol); click-to-load attributes unchanged
- [x] Quals: stock photos removed â†’ 190px numeral marks (paper disc, hairline +
      inner rose-gold ring, accent-strong numeral)
- [x] Blog fully removed: home section/query + CSS, nav + footer links, /blog/
      route, single-post routing, activation seeding, sitemap posts loop; deleted
      page-lapin-blog.php, single-lapin-post.php, class-lapin-posts.php,
      lapin-posts-data.php, assets/images/blog/ (12), qual-1..4.webp (git rm)
- [x] design.md v2.1 amendments; CLAUDE.md staleness fixes (DM Sans + Poppins,
      content-law exception); .hallmark/log.json entry; tokens stamp updated
- [x] php -l: 9 edited files clean
- [x] DB cleanup: trashed the `blog` page (23) + the 6 seeded posts
      (14/18/19/20/21/22) via WP-CLI (trash, reversible); page_for_posts unset
- [x] Trustindex installed + activated (wp-reviews-plugin-for-google). REMAINS
      MANUAL: connect the Google listing (place id ChIJCcA3BH67woARJ5tpawFYfUI)
      in Trustindex admin â†’ server-rendered list/grid widget â†’ then
      `wp transient delete lapin_reviews_v1`. Snapshot fallback renders 6 cards
      meanwhile (verified).
- [x] Verification: 7 pages 200; old post slugs 404; /blog/ resolves 404 (after
      one canonical bounce); sitemap = home + 6 pages only; home has zero
      "blog" strings; 6 review cards + 40+ band + Trustindex badge render;
      audio facades show the cable-stayed motif; quals numerals render;
      responsive 320/375/414/768 no horizontal scroll (puppeteer-core + Edge);
      mobile hero/creds stack verified. Not exercised headless: facade
      click-to-load embeds and a manual keyboard tab-through â€” spot-check by
      hand.
- [x] Creds Google item restacked per client: stars on top, then "Top rated in
      Southern California", then "Read our Google Reviews" (creds__item--stack)
- [x] Header artwork recreated in-house as inline SVG (cable-stayed bridge per
      the client's reference images, 2026-07-19): glowing pylon + cable fan +
      sweeping deck + skyline; home right-anchored via per-page
      preserveAspectRatio (xMaxYMax slice), subpages centered; audio-facade
      mini symbol redrawn to match. Raster Phase B kept only as a fallback if
      the client wants the literal image (needs original â‰¥1600px + perf-law
      amendment).

## Review
- Every copy change is client-directed and recorded in design.md's content law.
  "40+ Five-Star Google Reviews" is client-supplied â€” verify the live listing
  count before launch.
- Reviews pipeline untouched (Lapin_Reviews::get() â†’ first 6); renders the bundled
  snapshot until Trustindex is installed/configured â€” and production needs its own
  Trustindex install (third-party plugins untracked; deploy is upload-only).
- Deploy is upload-only: the 16 deleted files must be removed from the server
  manually at launch; the old post slugs are the live site's article URLs â€” 404 vs
  410/redirect needs client sign-off.
- Work sits on branch feat/home-revision (pushing main auto-deploys â€” merge only
  after verification + explicit go-ahead).

## Lessons
- The whitelist .gitignore blinds ripgrep-backed tools (Grep/Glob): repo-root
  searches return false "no matches" for files that exist (SUBLINE, .hallmark/).
  Plain grep -r / ls are the reliable fallback in this repo.
- Lightning-services binaries now live under %APPDATA%\Roaming\Local\
  lightning-services (not Programs\Local\...\extraResources); this site's ports:
  site nginx 10022, php-cgi upstream 10020/10021, mysql 10023 (socket
  run/<id>/mysql/mysqld.sock). nginx.exe is under bin/win32/ (not win64);
  mysqld.exe under bin/win64/bin/. A headless mysqld start can be blocked by
  tool-permission policy â€” starting the site in the Local app is the dependable
  route.


# Client bridge artwork in the home hero (2026-07-20)

## Plan (complete)
- [x] Feather the client's bridge image (Downloads/image0.png, 640Ã—427) so all
      four edges fade to transparent â€” GD smoothstep alpha fade (110px sides,
      90px top, 80px bottom) â†’ `assets/images/hero-bridge.webp` (17KB alpha WebP).
- [x] Home masthead: hide the drawn SVG (`.page-home .masthead__art`), render
      `<img class="masthead__bridge">` home-only in lapin-header.php, anchored
      bottom-right `min(56%, 46rem)` (mobile `min(100%, 30rem)`, 0.85 opacity).
- [x] Perf law: preload via `$lapin['preload']` + `fetchpriority="high"` (home
      LCP image). Subpages keep the quiet SVG art untouched.
- [x] design.md amended to v2.2 (signature section + macrostructure).

## Review
- Verified: PHP lint clean; all 7 pages 200; home HTML has preload + img, no
  bridge img on subpages; Playwright screenshots at 1440px and 390px show
  seamless blending â€” no crop lines on any edge (matches the client's mock).
- Source is only 640Ã—427 (upscaled to ~736px CSS on desktop). Acceptable for
  soft abstract art, but ask the client for a â‰¥1280px export to re-feather at
  2Ã— with the same recipe.

## Lessons
- Local's PHP has GD (with WebP+alpha) as an ext dll: run with
  `-d extension_dir=<php>\ext -d extension=php_gd.dll`. sharp/ImageMagick are
  not installed; GD covers image work.
- Playwright chromium is cached in %LOCALAPPDATA%\ms-playwright â€” `npm i
  playwright-core` in the scratchpad + executablePath gives screenshots
  without any browser download.

# Claude-design hero handoff recreation (2026-07-20, supersedes the feathered-image hero above)

## Plan (complete)
- [x] Convert the handoff's recolored `bridge-theme.png` (2560Ã—1707) to
      `bridge-theme-{960,1600,2560}.webp` (9/17/33KB); delete hero-bridge.webp.
- [x] Home masthead â†’ handoff gradient (#161418â†’#241D21â†’#2F262B, tokens
      --color-hero-*), border-bottom off; bridge as `<img.hero__bridge>` inside
      .hero--home (right 66%, cover 60%/45%, left-fade mask âˆ© top fade; mobile
      full-bleed 0.55 under to-bottom scrim). Scrim ::before z-flip above layer.
- [x] Hero type per handoff (Archivoâ†’DM Sans var): H1 --text-display-l 800/1.02,
      lead DM Sans 700, muted body, 40rem column; CTA rose fill #BD8C7D on
      #17171A (hover #A97968), outline #6F6F72; radius 4px, 17/30px padding.
- [x] Stats strip: #141416 bg, accent-35% top rule, muted-20% dividers.
- [x] Preload with imagesrcset/imagesizes + fetchpriority=high (home LCP).
- [x] Redrew `lapin-bridge-mini` facade symbol as the tied-arch motif (user
      mid-task request: "replace this bridge with the new bridge").
- [x] design.md â†’ v2.3; tokens header comment updated.

## Review
- Lint clean; all 7 pages 200; subpages keep SVG art + 3px accent border.
- Screenshots 1600/1280/390: matches the prototype (3-line H1 at â‰¤1600 matches
  the handoff's own screenshot); no visible layer seams after the top-fade mask.
- mask-composite:intersect needs Chrome 120+/FF/Safari 15.4+; -webkit fallback
  gets left fade only (acceptable â€” top edge is dark).

## Lessons
- Design handoffs land in claude-design/ (dc.html prototype + README + assets);
  the README's "recreate in your codebase" means map fonts/tokens to the locked
  design system (Archivo â†’ DM Sans), not import new families.

## Addendum (2026-07-20, later)
- Hero image replaced with the client's crisper copper re-render (same
  2560Ã—1707 â†’ regenerated bridge-theme-{960,1600,2560}.webp at 13/24/46KB;
  untracked claude-design/ copies refreshed too).
- Fold fix (client: stats strip must be visible on first load at 1080p): hero
  padding 96/120 â†’ --space-2xl/--space-2xl, H1 --text-display-l â†’ --text-display
  (token removed), divider top margin --space-xl â†’ --space-lg. Verified at
  1920Ã—907: creds strip fully above the fold (y751â€“875). At 1920/DPR1 the layer
  renders 1267px CSS from the 1600w asset (downscale = no srcset pixelation;
  remaining softness is inherent to the 4Ã—-upscaled source).

## Subpage masthead: raster bridge site-wide (2026-07-20, later)
User: subpage SVG art looked off next to the new home banner â†’ "replace it and
use the homepage background".
- [x] lapin-header.php: inline SVG removed; subpages render the home hero's
      bridge-theme-{960,1600,2560}.webp as `<img class="masthead__art">`
      (full-bleed, sizes=100vw, fetchpriority=high; skipped on home â€” its hero
      renders the layer itself).
- [x] lapin-tokens.php: .masthead__art â†’ object-fit cover 60%/45%, opacity .55,
      to-bottom mask (solid by 40%) so the topbar stays on clean onyx; dead
      `.page-home .masthead__art{display:none}` removed.
- [x] lapin-head.php: bridge preload now emitted site-wide (imagesizes 100vw on
      subpages, 66vw-pattern on home); home template's per-page preload removed.
- [x] design.md â†’ v2.4 note + signature/macrostructure/perf-law sections updated.

### Review
- Lint clean; all 7 pages 200; preload + img verified in rendered HTML (home:
  no masthead__art img, keeps hero__bridge).
- Screenshots (puppeteer 1600Ã—900 + 390Ã—844): About/Negotiation masthead now
  matches home's artwork; H1/lede contrast fine over the dimmed layer; home
  unchanged.

## Client change batch (2026-07-21)
Seven client-directed changes, all in the lapin plugin (plan:
~/.claude/plans/changes-request-from-client-jazzy-globe.md).
- [x] Video "Difficult People": start=385 removed - host re-edited the video
      in place (same ID), so it plays from 0:00 including the intro.
- [x] Creds sub-line title case: "Negotiation, Mediation and Dispute Resolution".
- [x] Bio: eyebrow "Our Introduction" dropped; H2 now "Meet Raphael E. Lapin".
- [x] Hero: "Resolving Differences." in gold (hero__line--gold, --color-gold).
- [x] Quals: 01-04 numerals replaced with thin-stroke (1.5) rose-gold Lucide
      icons in the discs (award / network[new svg] / lightbulb / book-open);
      disc 190->160px.
- [x] Floating tap-to-call FAB (.call-fab in lapin-footer.php + tokens): gold
      disc, onyx phone glyph (new phone.svg), fixed bottom-right, shown at
      <=63.9375rem, safe-area aware, all pages.
- [x] Reviews modal: creds "Top rated" opens a first-party <dialog>
      (#reviews-modal, home template) mirroring the old Trustindex popup -
      summary (5.0 stars, See all reviews / Review us on Google via new
      Lapin::GOOGLE_WRITE_REVIEW) + ALL Lapin_Reviews::get() cards via new
      shared partial lapin-review-card.php (grid dedup'd to use it too).
      Generic [data-modal]/[data-modal-close] JS in lapin-footer.php; href
      kept as no-JS fallback; modal cards un-clamped via CSS.
- [x] design.md content law updated (2026-07-21 block).

## Client change batch 2 (2026-07-21, later)
Client is polishing home for go-live; other pages refined after.
- [x] Hero CTA: "Schedule a Free Consultation" (lapin-page-hero.php, home hero only).
- [x] Newsletter removed: footer column deleted, foot__cols 4->3, foot__news*
      CSS dropped, Lapin_Contact newsletter action/handler removed
      (Lapin_Submissions::log_newsletter kept - admin history stays viewable).
- [x] Mobile hero bridge pop: opacity .55 -> .85 with a vertical ramp mask
      (transparent -> 40% at 35% -> full at 72%) + scrim eased at the bottom
      (.8 -> .5 -> .12), so the arch shows behind the CTA row while the
      headline zone stays dark. Verified 390px screenshot: text contrast held.
- [x] Reviews modal: "View all" button added at the bottom (btn--rose, same
      Google link as the top "See all reviews").
- [x] Client's shortened copy applied (pasted in chat 2026-07-21): founder
      section (new heading + role line + 4 paragraphs), quals section (eyebrow
      dropped, title-case H2, 4 new card titles/bodies), 'Insights on Dispute
      Resolution' typo fix (stray 'is'). design.md content law updated.

### Review
- Lint clean (footer/tokens/hero/contact class); all 7 pages 200; contact
  Turnstile slot unaffected; desktop footer screenshot: 3 balanced columns.

## Logo option-2 recolor (2026-07-21, later)
Client picked "option 2" from a colorway mock: soft gold #D1BFA7 replaced by
rosewood #A97968, deep russet pieces kept.
- [x] logo-gen.php: new $rosewood; logo-on-dark + logo-footer both set to the
      option-2 map (white group -> rosewood, slate mark -> russet, rule ->
      rosewood); logo-on-light (OG/schema) untouched. Regenerated png+webp.
- [x] favicon-gen.php: source switched logo-on-light.png -> logo-on-dark.png
      so browser icons match; regenerated favicon-{32,192,270}.png.
- [x] Hero "Resolving Differences." switched --color-gold -> --color-accent
      #BD8C7D to match the hero CTA (client: "same darker gold as the
      Schedule block"); class renamed hero__line--accent.
- [x] Verified: header/footer screenshots + favicon render; both hero line and
      CTA compute rgb(189,140,125); design.md updated.

## Client-logo stacking fix (2026-07-21, later)
Client report: "mobile view for some of our clients are stacked on top of
each other." Cause: the prefers-reduced-motion static-wrap fallback for the
marquee uses a 64px column gap, so a phone column fits one 150px logo per
row. Fix: reduced-motion + <=40rem override - gap --space-lg, img width
calc(50% - gap/2) capped at 150px -> always >=2 per row. Verified 390px with
reduced-motion emulation (8 logos = 4 rows x 2); animated marquee unchanged.

## Final pre-launch batch (2026-07-22)
Client: "final edits before going live" + SEO checklist sent.
- [x] Hero sub: single lead "Trusted Mediation and Negotiation Services for
      Individuals, Businesses, Families, and Organizations" (SUBLINE_LEAD);
      SUBLINE_BODY const + hero__sub line removed; reveal indices reflowed.
- [x] Home order: #qualified moved above #media; bands flipped to keep rhythm
      (qualified -> paper + discs paper-2; media -> band--cream).
- [x] Reviews H2 "Client Experiences"; eyebrow "Our Testimonials" removed.
- [x] FAB: bg --color-rosewood #A97968 (new token, logo gold), solid black
      glyph (svg fill:currentColor, color --color-hero-onyx), hover accent.
- [x] Contact: contact-us.webp figure removed; fixed whole-page bridge
      watermark (.contact-watermark, bridge-theme-1600.webp @ 0.07, z -1 -
      zero extra bytes, asset already preloaded).
- [x] Verified: lint clean; 7x200; 1920x907 fold holds (creds bottom 833);
      FAB rgb(169,121,104)/rgb(23,23,26); watermark + section flow shots.
- NOTE: Local GUI was closed mid-verify - services started headless per
      memory (mysqld/php-cgi/nginx) + temp node proxy on :80 (kill before
      starting Local GUI). SEO checklist audit = next task.
