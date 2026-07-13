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
