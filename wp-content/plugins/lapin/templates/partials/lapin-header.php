<?php
/**
 * Masthead — the shared header on every page (client direction: same header
 * site-wide). One onyx canvas carries the contact topbar, the N1b nav with a
 * prominent logo + "Call Now" CTA, and the page hero, all over the recolored
 * bridge artwork (bridge-theme-*.webp — the same layer as the home hero).
 * Home skips the full-bleed art: its hero renders the image itself
 * (hero__bridge, right 66%); subpages get it dimmed behind the whole masthead.
 *
 * Expects $lapin['nav'] to mark the current item and $lapin['hero'] for the
 * hero block (see lapin-page-hero.php).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin_nav_current = $lapin['nav'] ?? '';
$lapin_nav_items   = array(
	'home'           => array( home_url( '/' ), 'Home' ),
	'overview'       => array( home_url( '/overview/' ), 'About Us' ),
	'practice-areas' => array( home_url( '/practice-areas/' ), 'Practice Areas' ),
);
$lapin_nav_services = array(
	'negotiation'        => array( home_url( '/negotiation/' ), 'Negotiation' ),
	'dispute-resolution' => array( home_url( '/dispute-resolution/' ), 'Dispute Resolution' ),
	'mediation'          => array( home_url( '/mediation/' ), 'Mediation' ),
);
// Client 2026-07-22: "Blog" → "Insights", placed after Services, before Contact.
// The 'blog' key + /blog/ URL are kept (drive aria-current + breadcrumbs/schema).
$lapin_nav_after = array(
	'blog'    => array( home_url( '/blog/' ), 'Insights' ),
	'contact' => array( home_url( '/contact/' ), 'Contact' ),
);
$lapin_aria = static function ( string $key ) use ( $lapin_nav_current ): string {
	return $key === $lapin_nav_current ? ' aria-current="page"' : '';
};
?>
<a class="skip-link" href="#main">Skip to content</a>
<div class="masthead">
	<?php if ( 'home' !== $lapin_nav_current ) : ?>
	<?php // Subpage masthead art = the home hero's recolored bridge layer, full-bleed and dimmed in CSS. Likely LCP image — preloaded in lapin-head.php, never lazy. ?>
	<img class="masthead__art"
	     src="<?php echo esc_url( Lapin::asset( 'images/bridge-theme-1600.webp' ) ); ?>"
	     srcset="<?php echo esc_attr( Lapin::asset( 'images/bridge-theme-960.webp' ) . ' 960w, ' . Lapin::asset( 'images/bridge-theme-1600.webp' ) . ' 1600w, ' . Lapin::asset( 'images/bridge-theme-2560.webp' ) . ' 2560w' ); ?>"
	     sizes="100vw"
	     alt="" width="2560" height="1707" fetchpriority="high" decoding="async">
	<?php endif; ?>

	<div class="topbar">
		<div class="wrap">
			<a href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
			<a href="tel:<?php echo esc_attr( Lapin::PHONE_FREE_TEL ); ?>">Toll-free <?php echo esc_html( Lapin::PHONE_FREE ); ?></a>
			<a class="topbar__email" href="mailto:<?php echo esc_attr( Lapin::EMAIL ); ?>"><?php echo esc_html( Lapin::EMAIL ); ?></a>
		</div>
	</div>
	<header class="site-head">
		<div class="wrap">
			<a class="site-head__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( Lapin::NAME ); ?> — home">
				<img src="<?php echo esc_url( Lapin::asset( 'images/logo-on-dark.webp' ) ); ?>" alt="<?php echo esc_attr( Lapin::NAME ); ?>" width="260" height="92" fetchpriority="high">
			</a>
			<nav class="nav" aria-label="Primary">
				<ul class="nav__links">
					<?php foreach ( $lapin_nav_items as $lapin_key => $lapin_item ) : ?>
					<li><a href="<?php echo esc_url( $lapin_item[0] ); ?>"<?php echo $lapin_aria( $lapin_key ); // phpcs:ignore ?>><?php echo esc_html( $lapin_item[1] ); ?></a></li>
					<?php endforeach; ?>
					<li>
						<a href="<?php echo esc_url( home_url( '/negotiation/' ) ); ?>" aria-haspopup="true">Services<span class="nav__caret" aria-hidden="true">▾</span></a>
						<ul class="nav__sub">
							<?php foreach ( $lapin_nav_services as $lapin_key => $lapin_item ) : ?>
							<li><a href="<?php echo esc_url( $lapin_item[0] ); ?>"<?php echo $lapin_aria( $lapin_key ); // phpcs:ignore ?>><?php echo esc_html( $lapin_item[1] ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</li>
					<?php foreach ( $lapin_nav_after as $lapin_key => $lapin_item ) : ?>
					<li><a href="<?php echo esc_url( $lapin_item[0] ); ?>"<?php echo $lapin_aria( $lapin_key ); // phpcs:ignore ?>><?php echo esc_html( $lapin_item[1] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
				<a class="btn btn--gold-line" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Schedule a Consultation</a>
				<button class="nav__burger" type="button" aria-expanded="false" aria-controls="nav-panel" aria-label="Open menu">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M2 5h16M2 10h16M2 15h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
				</button>
			</nav>
		</div>
	</header>
	<div class="nav-panel" id="nav-panel" hidden>
		<ul>
			<li class="nav-panel__cta"><a class="btn btn--rose" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Schedule a Consultation</a></li>
			<?php foreach ( $lapin_nav_items as $lapin_key => $lapin_item ) : ?>
			<li><a href="<?php echo esc_url( $lapin_item[0] ); ?>"<?php echo $lapin_aria( $lapin_key ); // phpcs:ignore ?>><?php echo esc_html( $lapin_item[1] ); ?></a></li>
			<?php endforeach; ?>
			<li class="nav-panel__group">
				<span class="nav-panel__label">Services</span>
				<ul class="nav-panel__sub">
					<?php foreach ( $lapin_nav_services as $lapin_key => $lapin_item ) : ?>
					<li><a href="<?php echo esc_url( $lapin_item[0] ); ?>"<?php echo $lapin_aria( $lapin_key ); // phpcs:ignore ?>><?php echo esc_html( $lapin_item[1] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</li>
			<li class="nav-panel__group">
				<?php foreach ( $lapin_nav_after as $lapin_key => $lapin_item ) : ?>
				<a href="<?php echo esc_url( $lapin_item[0] ); ?>"<?php echo $lapin_aria( $lapin_key ); // phpcs:ignore ?>><?php echo esc_html( $lapin_item[1] ); ?></a>
				<?php endforeach; ?>
			</li>
			<li><a href="tel:<?php echo esc_attr( Lapin::PHONE_FREE_TEL ); ?>">Toll-free <?php echo esc_html( Lapin::PHONE_FREE ); ?></a></li>
		</ul>
	</div>
	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-page-hero.php'; ?>
</div>
