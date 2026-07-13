# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

The WordPress site for Lapin Negotiation Services (lapinnegotiationservices.com), running locally in [Local](https://localwp.com/). The repo root is the full WP install, but a **whitelist `.gitignore` tracks only custom code** — WordPress core and third-party plugins/themes are ignored. Never edit untracked files: only tracked files are deployed (the GitHub Action checks out the repo, so untracked changes silently never reach the server).

Tracked code:

| Path | Purpose |
|------|---------|
| `wp-content/plugins/lapin/` | **The entire public site** — hand-built PHP page templates, design system, SEO. This is where almost all work happens. |
| `wp-content/plugins/lapin-core/` | Scaffold functionality plugin (CPTs/shortcodes/integrations). Auto-loads every `includes/*.php`; currently empty. |
| `wp-content/themes/lapin-negotiation-services/` | Block child theme of Twenty Twenty-Five. Mostly inert — the lapin plugin dequeues its styles on every routed page. |
| `design.md` | **Locked design system.** Read it before any page or styling work. Extend/amend it; never regenerate per page. |
| `tasks/todo.md` | Task log with plans, reviews, and lessons from past sessions. |
| `.github/workflows/deploy.yml` | SFTP deploy of `wp-content/` on push to `main`. |

To track a new custom plugin, add `!/wp-content/plugins/<name>/` to `.gitignore`.

## Commands

There is no build step, package manager, or test suite — templates are plain PHP with all CSS inline.

- **Local site**: http://lapin-negotiation-services.local/ (start the site in the Local app first). PHP edits apply on refresh.
- **PHP lint** — PHP is not on PATH; use Local's bundled binary (version dir changes when Local updates — glob for it):
  ```powershell
  & (Get-ChildItem "$env:LOCALAPPDATA\Programs\Local\resources\extraResources\lightning-services\php-*\bin\win64\php.exe")[0] -l <file.php>
  ```
- **Smoke test** all seven pages return 200:
  ```sh
  for p in "" overview/ practice-areas/ negotiation/ dispute-resolution/ mediation/ contact/; do curl -s -o /dev/null -w "$p %{http_code}\n" "http://lapin-negotiation-services.local/$p"; done
  ```
- **Mobile verification**: headless Chrome via CLI clamps window width to ~500px — use puppeteer(-core) viewport emulation, not `--window-size`.
- **Deploy**: push to `main` (or manual Actions run) → SFTP upload of `wp-content/` using secrets in the `production` GitHub environment. Upload-only: it never deletes remote files and does not touch the database.

## Architecture: the lapin plugin

The plugin bypasses the theme entirely ("legalia architecture" — self-contained templates, no page builder):

1. **Routing** — `Lapin_Pages` (`includes/class-lapin-pages.php`) hooks `template_include` and maps page slugs to template files via the `ROUTES` const; the static front page maps to `page-lapin-home.php`. On activation it creates missing pages by slug (non-destructive) and sets the front page.
2. **Head hygiene** — theme stylesheets are dequeued at `wp_enqueue_scripts` priority 99, and WP head cruft (emoji, oEmbed, REST link, canonical, title, global styles…) is stripped on the `wp` hook. Gotcha: block themes queue `_block_template_render_title_tag` / `_block_template_viewport_meta_tag` inside `locate_block_template()`, which runs *after* `wp` — those two must be removed inside the `template_include` filter (already done in `load_template()`).
3. **Templates** (`templates/page-lapin-*.php`) — each defines a `$lapin` config array (`title`, `desc`, `path`, `nav`, `body_class`, `og_image`, `preload`, `schema` JSON-LD nodes), then requires partials in order: `lapin-head.php` (emits full `<head>`: meta/OG/canonical/JSON-LD @graph, fonts, design tokens) → `lapin-header.php` → page sections → `lapin-cta-band.php` → `lapin-footer.php`. Page-specific CSS goes in an inline `<style>` block in the template.
4. **Business facts** — phone numbers, email, address, tagline, and social URLs live as constants on the `Lapin` class (`includes/class-lapin.php`) and are read everywhere from there. Never hardcode them in templates. `Lapin::asset()` builds asset URLs; `Lapin::icon()` inlines Lucide SVGs from `assets/icons/`.
5. **Contact form** — `Lapin_Contact` handles a plain `admin-post.php` POST: nonce + honeypot (`company` field) + one-per-IP-per-minute rate limit, then `wp_mail()`. Redirects back to `/contact/` with `?sent=1` or `?contact_error=<code>`; failed input is stashed in a transient for repopulation.

**Adding a page**: add the slug to `Lapin_Pages::ROUTES`, create the template following the `$lapin` + partials pattern, then either reactivate the plugin or create the page manually in wp-admin with a matching slug. Add the nav entry in `lapin-header.php`.

## Hard constraints

- **Content law**: all copy from lapinnegotiationservices.com is retained verbatim (client requirement). Heading case may change; wording may not. Never invent metrics, testimonials, or client logos. The live site's injected footer casino spam must never be carried over (the live install is likely compromised).
- **Performance law** (targets: Lighthouse 95+ mobile/desktop, 100 SEO): all CSS inline, no external render-blocking requests, two self-hosted font files max (preloaded), LCP image preloaded with `fetchpriority="high"` and never lazy, third-party embeds behind click-to-load facades, WebP images with width/height attrs.
- **Design system**: use the named tokens from `design.md` / `partials/lapin-tokens.php` only — never raw px spacing or off-token colors. Gold accent ≤5% of any viewport. Fraunces (roman only, no italic headers) + IBM Plex Sans, no third family.
- `wp-content/media/podcasts/Bullies.mp3` (40MB) is deliberately untracked; the live server already hosts it at the same path.
