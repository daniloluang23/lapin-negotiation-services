# Repo + Child Theme + SFTP Deploy Setup

## Plan
- [x] Create block child theme `lapin-negotiation-services` (parent: twentytwentyfive)
- [x] Scaffold custom plugin `lapin-core` (site functionality plugin, so /plugins has a deployable custom plugin)
- [x] Init git repo at `app/public` with whitelist .gitignore (only child theme, custom plugins, workflow, docs tracked — WP core excluded)
- [x] GitHub Actions workflow: push to `main` → SFTP deploy of wp-content (uses `production` GitHub environment secrets)
- [x] README documenting required secrets
- [x] Commit + push to https://github.com/daniloluang23/lapin-negotiation-services.git

## Review
- Pushed as `main` (commit 411cdf2), 8 files. Verified via `git status` that the whitelist
  .gitignore tracks only custom code — no WP core, no third-party plugins.
- Child theme is a block child theme: style.css (Template: twentytwentyfive), functions.php
  (enqueues style.css — block themes don't load it automatically), minimal theme.json v3.
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
- [x] Optimize assets: images → WebP (about-us 1.26MB → 100KB; client logos 57–101KB → 1–2KB each); self-host Fraunces + IBM Plex Sans variable WOFF2 (113KB total)
- [x] Build `wp-content/plugins/lapin/` (legalia architecture): bootstrap, Pages router (template_include + head cleanup), Contact form handler, 5 partials, 7 page templates
- [x] SEO: unique title/description/canonical per page, OG/Twitter, JSON-LD (ProfessionalService, WebPage, BreadcrumbList, Service, ContactPage)
- [x] Client feedback: "WAY to WOW Showson" typo fixed; auto-rotating media carousel replaced with a spaced static grid (fixes overlap + rotation-timing complaints)
- [x] Verify: PHP lint clean; all 7 pages HTTP 200; single title/canonical/viewport; zero horizontal overflow at 320/375/414/768 (puppeteer emulation); Hallmark 58-gate slop test passed after fixes

## Review
- Plugin `lapin` active on local; pages auto-created on activation (slug-matched, non-destructive); front page set to Home.
- Live-site footer spam (casino links) NOT carried over — the live install is likely compromised; client should change passwords / audit.
- `wp-content/media/podcasts/Bullies.mp3` (40MB) downloaded locally to mirror the live path; left untracked in git.
- lapin-core plugin and child theme untouched.

## Lessons
- Headless Chrome via CLI clamps window width to ~500px — mobile verification needs puppeteer(-core) viewport emulation, not `--window-size`.
- Block themes add `_block_template_render_title_tag` / `_block_template_viewport_meta_tag` inside `locate_block_template()`, which runs after the `wp` hook — remove them inside the `template_include` filter.

---

# Sitemap (2026-07-13)

## Plan (complete)
- [x] Serve `/sitemap.xml` dynamically from the lapin plugin (new `includes/class-lapin-sitemap.php`) — home + the 6 `Lapin_Pages::ROUTES` slugs, `lastmod` from each page's `post_modified_gmt`
- [x] Intercept in `parse_request` (no rewrite rule → no flush needed); URLs mirror the canonical style (`home_url('/') . 'slug/'`)
- [x] Disable core `/wp-sitemap.xml` (`wp_sitemaps_enabled` → false) so there's one exact sitemap, not two competing ones
- [x] Append `Sitemap:` line to the virtual robots.txt via `robots_txt` filter

## Review
- Chose dynamic over a static root file: a static sitemap.xml would go stale on edits and
  sits outside wp-content, so the SFTP deploy would never ship it.
- Verified via curl on local: `/sitemap.xml` 200 with all 7 URLs + lastmod; `/robots.txt`
  contains the Sitemap line; `/wp-sitemap.xml` 404 (core disabled); home + contact still 200.
- Missing pages (deleted from wp-admin) are skipped automatically — no 404s in the sitemap.

---

# Redesign to approved staging DNA + blog (2026-07-14)

Client approved a new design (staging: stg-lapinnegotiationservices-staging.kinsta.cloud,
SULTIN theme + Elementor). Goal: carry that design's DNA into the hand-built lapin
plugin (keep 95+ Lighthouse mobile/desktop, 100 SEO), plus client art direction:

- Palette: Rose Gold `#BD8C7D` · Soft Gold `#D1BFA7` · Silver `#8E8E90` · Onyx `#49494B`
  (matches staging's Elementor kit globals; client's exact values win)
- Fonts (from staging): DM Sans (display) + Poppins (body)
- Logo option 1, bigger and prominent in the header (regenerated from official 1980×700
  art via GD recolor: on-light = onyx/rose-gold/silver; on-dark = rose-gold/soft-gold)
- New hero tagline as H1: "Building Bridges. Resolving Differences." with subheading
  "Professional Mediation and Negotiation Services Delivering Practical, Durable
  Solutions for Businesses, Families, and Organizations."
- Same header on ALL pages: abstract-bridge masthead (hand-built inline SVG, no image)
- Drop "Negotiation Mediation Unlitigation™" kicker; remove Unlitigation section/definition
  from About; drop the footer Unlitigation line
- Stronger CTAs: "Schedule a Consultation" / "Call Now" / "Request an Assessment"
- Blog: index at /blog/ + 6 posts at root-level slugs (URLs identical to staging),
  content migrated verbatim by script; sitemap updated with blog URLs

## Plan (all complete)
- [x] hallmark study (URL mode) on staging: fonts, kit colors, structure, motion
- [x] Download + recolor official logo art to option-1 palette (both variants)
- [x] Self-host DM Sans var + Poppins 400/600 (79KB total, latin subsets)
- [x] Extract 6 blog posts (title/date/desc/image/body) via DOM script → posts-clean.json
- [x] Blog featured images → WebP 1200w + 640w in plugin assets
- [x] Amend design.md to the new locked system
- [x] Rebuild tokens partial (palette/type/motion + shared chrome CSS)
- [x] Masthead: topbar + nav (big logo, Blog link, Schedule a Consultation) + bridge hero on every page
- [x] Home: hero → creds → practice-area teaser → founder → client-logo marquee →
      media wall → qualifications → latest blog posts → CTA band (mid-task client
      concept mock adopted: eyebrow tagline + "Experienced. Strategic. Results-Focused."
      display + stats strip + centered practice icons)
- [x] Footer: 4 columns (contact / explore / services / newsletter) + social + legal
- [x] Newsletter handler (admin-post, honeypot+nonce+rate-limit → wp_mail)
- [x] Blog: 'blog' route + single-post routing, posts seeded on activation (slug-matched,
      non-destructive), permalink structure /%postname%/ for root-level post URLs
- [x] Sitemap: add /blog/ + post URLs
- [x] About: remove #unlitigation section; site-wide tagline swap
- [x] Verify: lint (23 files clean), smoke (15 URLs 200), mobile 320/375/414/768 no
      overflow, 1280×800 hero-fold check, hallmark slop test

## Review
- All copy retained verbatim except client-directed removals (Unlitigation kicker/section/
  footer line) and client-supplied new hero copy. Concept-mock placeholders NOT carried
  over (39 reviews / 30 years / CBS-FOX logos / (949) phone / anonymous testimonial) —
  real facts kept: Harvard trained, 25+ years, 1,000+ disputes, real Google Reviews link.
  If the "Attorney, Los Angeles" quote is a real review the client wants featured, it's a
  one-edit add to the home page.
- Blog posts migrated byte-for-byte by script (DOM-extracted → lapin-posts-data.php,
  generated file). URLs identical to staging (root-level slugs). Seeding is slug-matched,
  non-destructive; future posts can be authored in wp-admin (blog index + sitemap pick
  them up automatically; featured images for new posts go in assets/images/blog/{slug}.webp
  or the card renders text-only).
- Old navy/gold assets (hero-painting, old logos, Fraunces/Plex fonts) left in place —
  ?fonts=editorial preview switch still works; deleting them is a follow-up decision.
- Default WP "Hello world!" post trashed (was polluting blog index + sitemap).
- Bridge masthead is a hand-built inline SVG (~2.5KB) — no hero raster, LCP is the H1.
- Slop-test fixes shipped: post-card date + eyebrow contrast (accent-strong darkened to
  oklch(44%...)), masthead gradient tokenized, hero display resized to fit 1280×800 fold,
  newsletter placeholder contrast.

## Lessons
- Local's site services can be started headless when the Local GUI won't: mysqld at
  lightning-services/mysql-8.4.0/bin/win64/bin/mysqld.exe (note doubled bin) with
  --defaults-file=%APPDATA%\Local\run\<siteId>\conf\mysql\my.cnf; php-cgi.exe -b
  127.0.0.1:10002/10003 -c <run>\conf\php\php.ini; nginx -p <run>\nginx -c
  <run>\conf\nginx\nginx.conf. Site ID from %APPDATA%\Local\sites.json.
- CLI PHP can bootstrap wp-load.php (for activation/seeding) only with the site's
  rendered php.ini (-c <run>\conf\php\php.ini) — it carries the mysqld socket that
  DB_HOST 'localhost' resolves to.
- A masthead with overflow:hidden is programmatically scrollable — a focus jump to an
  overflowing header button scrolled the whole canvas sideways. Use overflow:clip on
  decorative canvases, and never let the header row exceed the viewport.
- Full-page screenshots of scroll-reveal pages need a slow (~400px/150ms) pre-scroll
  or armed .rv elements read as blank sections.

---

# Client home revision — split hero, reviews grid, blog removal (2026-07-19)

## Plan (code + docs complete; site-up steps pending)
- [x] Hero: H1 = brand tagline (two lines) + diamond divider + SUBLINE split into
      lead/body; "Experienced. Strategic. Results-Focused." removed; copy in a left
      ~60% column, masthead bridge SVG right-shifted (58% box, raised opacity,
      .page-home scoped — subpage mastheads untouched)
- [x] Creds: Google-reviews item icon → five gold stars (text + link unchanged)
- [x] "Targeted Practice Areas" → "Practice Areas" (redundant eyebrow dropped)
- [x] Bio lead swapped to the client-supplied sentence
- [x] Reviews: scroll-snap slider + autoplay/arrows JS removed → static 6-card grid
      (3/2/1 cols) + centered "40+ Five-Star Google Reviews" band + Google link +
      Trustindex badge; H2 "What Clients Are Saying"; read-more clamp kept
- [x] Media: the 4 audio cards get 16:9 bridge-motif facades (inline
      lapin-bridge-mini symbol); click-to-load attributes unchanged
- [x] Quals: stock photos removed → 190px numeral marks (paper disc, hairline +
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
      in Trustindex admin → server-rendered list/grid widget → then
      `wp transient delete lapin_reviews_v1`. Snapshot fallback renders 6 cards
      meanwhile (verified).
- [x] Verification: 7 pages 200; old post slugs 404; /blog/ resolves 404 (after
      one canonical bounce); sitemap = home + 6 pages only; home has zero
      "blog" strings; 6 review cards + 40+ band + Trustindex badge render;
      audio facades show the cable-stayed motif; quals numerals render;
      responsive 320/375/414/768 no horizontal scroll (puppeteer-core + Edge);
      mobile hero/creds stack verified. Not exercised headless: facade
      click-to-load embeds and a manual keyboard tab-through — spot-check by
      hand.
- [x] Creds Google item restacked per client: stars on top, then "Top rated in
      Southern California", then "Read our Google Reviews" (creds__item--stack)
- [x] Header artwork recreated in-house as inline SVG (cable-stayed bridge per
      the client's reference images, 2026-07-19): glowing pylon + cable fan +
      sweeping deck + skyline; home right-anchored via per-page
      preserveAspectRatio (xMaxYMax slice), subpages centered; audio-facade
      mini symbol redrawn to match. Raster Phase B kept only as a fallback if
      the client wants the literal image (needs original ≥1600px + perf-law
      amendment).

## Review
- Every copy change is client-directed and recorded in design.md's content law.
  "40+ Five-Star Google Reviews" is client-supplied — verify the live listing
  count before launch.
- Reviews pipeline untouched (Lapin_Reviews::get() → first 6); renders the bundled
  snapshot until Trustindex is installed/configured — and production needs its own
  Trustindex install (third-party plugins untracked; deploy is upload-only).
- Deploy is upload-only: the 16 deleted files must be removed from the server
  manually at launch; the old post slugs are the live site's article URLs — 404 vs
  410/redirect needs client sign-off.
- Work sits on branch feat/home-revision (pushing main auto-deploys — merge only
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
  tool-permission policy — starting the site in the Local app is the dependable
  route.

