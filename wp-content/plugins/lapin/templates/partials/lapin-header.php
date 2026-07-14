<?php
/**
 * Masthead — the shared header on every page (client direction: same header
 * site-wide). One onyx canvas carries the contact topbar, the N1b nav with a
 * prominent logo + "Call Now" CTA, and the page hero, all over a hand-built
 * abstract-bridge inline SVG (brand tagline made visual; ~2KB, zero requests).
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
$lapin_nav_after = array(
	'blog'    => array( home_url( '/blog/' ), 'Blog' ),
	'contact' => array( home_url( '/contact/' ), 'Contact' ),
);
$lapin_aria = static function ( string $key ) use ( $lapin_nav_current ): string {
	return $key === $lapin_nav_current ? ' aria-current="page"' : '';
};
?>
<a class="skip-link" href="#main">Skip to content</a>
<div class="masthead">
	<svg class="masthead__art" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice" aria-hidden="true" focusable="false">
		<defs>
			<linearGradient id="lapin-arc" x1="0" y1="0" x2="1" y2="0">
				<stop offset="0" stop-color="#AA7F3D" stop-opacity="0.3"/>
				<stop offset="0.5" stop-color="#E8D9B8"/>
				<stop offset="1" stop-color="#AA7F3D" stop-opacity="0.3"/>
			</linearGradient>
			<linearGradient id="lapin-ribbon" x1="0" y1="0" x2="0" y2="1">
				<stop offset="0" stop-color="#D1BFA7" stop-opacity="0.3"/>
				<stop offset="1" stop-color="#AA7F3D" stop-opacity="0.05"/>
			</linearGradient>
			<radialGradient id="lapin-glow" cx="0.5" cy="0.5" r="0.5">
				<stop offset="0" stop-color="#D1BFA7" stop-opacity="0.22"/>
				<stop offset="0.55" stop-color="#AA7F3D" stop-opacity="0.1"/>
				<stop offset="1" stop-color="#AA7F3D" stop-opacity="0"/>
			</radialGradient>
			<radialGradient id="lapin-glow-core" cx="0.5" cy="0.5" r="0.5">
				<stop offset="0" stop-color="#F3ECE1" stop-opacity="0.17"/>
				<stop offset="1" stop-color="#F3ECE1" stop-opacity="0"/>
			</radialGradient>
		</defs>
		<!-- warm light behind the span: broad haze + bright core under the arch -->
		<ellipse cx="800" cy="500" rx="820" ry="460" fill="url(#lapin-glow)"/>
		<ellipse cx="800" cy="640" rx="430" ry="260" fill="url(#lapin-glow-core)"/>
		<!-- layered fan arcs, both upper corners (kept quiet — ambient texture) -->
		<g fill="none" stroke="#D1BFA7" stroke-width="1.2" opacity="0.28">
			<path d="M -80 560 Q 420 380 980 -80" opacity="0.18" stroke="#AA7F3D" stroke-width="1.5"/>
			<path d="M -80 470 Q 400 300 880 -80" opacity="0.13"/>
			<path d="M -80 380 Q 380 240 780 -80" opacity="0.09"/>
			<path d="M -80 290 Q 350 190 680 -80" opacity="0.06"/>
			<path d="M 1680 560 Q 1180 380 620 -80" opacity="0.18" stroke="#AA7F3D" stroke-width="1.5"/>
			<path d="M 1680 470 Q 1200 300 720 -80" opacity="0.13"/>
			<path d="M 1680 380 Q 1220 240 820 -80" opacity="0.09"/>
			<path d="M 1680 290 Q 1250 190 920 -80" opacity="0.06"/>
		</g>
		<!-- bridge span, dropped below the hero text zone; whole group kept
		     quiet so the logo and headline carry the fold -->
		<g transform="translate(0 80)" opacity="0.28">
		<!-- arch ribbon: filled band between outer and inner curves, gold edges -->
		<path d="M -80 640 Q 800 140 1680 640 Q 800 195 -80 640 Z" fill="url(#lapin-ribbon)"/>
		<path d="M -80 640 Q 800 140 1680 640" fill="none" stroke="url(#lapin-arc)" stroke-width="4"/>
		<path d="M -80 640 Q 800 195 1680 640" fill="none" stroke="#D1BFA7" stroke-width="1.8" opacity="0.55"/>
		<!-- hanger cables (inner arch → deck), brighter toward the lit center -->
		<g stroke="#D1BFA7" stroke-width="1.2" opacity="0.7">
			<path d="M 480 445 V 640"/><path d="M 560 432 V 640"/><path d="M 640 422 V 640"/>
			<path d="M 720 417 V 640"/><path d="M 800 415 V 640"/><path d="M 880 417 V 640"/>
			<path d="M 960 422 V 640"/><path d="M 1040 432 V 640"/><path d="M 1120 445 V 640"/>
		</g>
		<g stroke="#D1BFA7" stroke-width="1" opacity="0.4">
			<path d="M 160 534 V 640"/><path d="M 240 506 V 640"/><path d="M 320 482 V 640"/>
			<path d="M 400 462 V 640"/>
			<path d="M 1200 462 V 640"/><path d="M 1280 482 V 640"/><path d="M 1360 506 V 640"/>
			<path d="M 1440 534 V 640"/>
		</g>
		<!-- deck: bright chord + solid band beneath -->
		<path d="M -80 640 H 1680" stroke="#E8D9B8" stroke-width="2.5" opacity="0.9"/>
		<rect x="-80" y="642" width="1760" height="30" fill="#000000" opacity="0.35"/>
		<path d="M -80 672 H 1680" stroke="#AA7F3D" stroke-width="1" opacity="0.4"/>
		<!-- piers leaning under the deck + reflected under-arch -->
		<polygon points="150,672 400,672 560,900 260,900" fill="#000000" opacity="0.4"/>
		<path d="M 400 672 L 560 900" fill="none" stroke="#E8D9B8" stroke-width="2" opacity="0.55"/>
		<path d="M 150 672 L 260 900" fill="none" stroke="#AA7F3D" stroke-width="1" opacity="0.3"/>
		<polygon points="1200,672 1450,672 1340,900 1040,900" fill="#000000" opacity="0.4"/>
		<path d="M 1200 672 L 1040 900" fill="none" stroke="#E8D9B8" stroke-width="2" opacity="0.55"/>
		<path d="M 1450 672 L 1340 900" fill="none" stroke="#AA7F3D" stroke-width="1" opacity="0.3"/>
		<path d="M 400 672 Q 800 940 1200 672" fill="none" stroke="url(#lapin-arc)" stroke-width="2.5" opacity="0.6"/>
		<path d="M 430 672 Q 800 900 1170 672" fill="none" stroke="#D1BFA7" stroke-width="1" opacity="0.3"/>
		<!-- angular corner facets with gold hairline edges -->
		<polygon points="-80,900 -80,520 300,900" fill="#FFFFFF" opacity="0.025"/>
		<path d="M -80 520 L 300 900" fill="none" stroke="#AA7F3D" stroke-width="1.2" opacity="0.32"/>
		<path d="M -80 660 L 160 900" fill="none" stroke="#D1BFA7" stroke-width="1" opacity="0.18"/>
		<polygon points="1680,900 1680,520 1300,900" fill="#FFFFFF" opacity="0.025"/>
		<path d="M 1680 520 L 1300 900" fill="none" stroke="#AA7F3D" stroke-width="1.2" opacity="0.32"/>
		<path d="M 1680 660 L 1440 900" fill="none" stroke="#D1BFA7" stroke-width="1" opacity="0.18"/>
		</g>
	</svg>

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
