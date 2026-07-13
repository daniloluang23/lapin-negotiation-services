=== Lapin ===
Contributors: daniloluang
Requires at least: 6.7
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Self-contained page templates, design system, and SEO layer for LapinNegotiationServices.com.

== Description ==

Serves seven hand-built page templates (Home, About Us, Practice Areas,
Negotiation, Dispute Resolution, Mediation, Contact) from the plugin via
`template_include` — no page builder. Each template emits its own head
(title, meta description, canonical, Open Graph, JSON-LD schema), inlines
all CSS, self-hosts two variable fonts, and loads third-party media
(YouTube/SoundCloud) behind click-to-load facades.

On activation the plugin creates the seven pages (matched by slug, existing
pages untouched) and points the site's front page at Home.

The design system is documented in `design.md` at the project root.

== Changelog ==

= 1.0.0 =
* Initial release: full redesign of the live PopularFX/Elementor site as
  native plugin templates. All content retained; footer spam removed;
  "WAY to WOW Showson" typo fixed; media carousel replaced with a static
  spaced grid per client feedback.
