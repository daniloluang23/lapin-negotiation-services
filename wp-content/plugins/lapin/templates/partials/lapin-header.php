<?php
/**
 * Masthead — the shared header on every page (client direction: same header
 * site-wide). One onyx canvas carries the contact topbar, the N1b nav with a
 * prominent logo + "Call Now" CTA, and the page hero, all over a hand-built
 * cable-stayed-bridge inline SVG (glowing pylon + cable fan + sweeping deck,
 * drawn to the client's 2026-07-19 reference; ~3KB, zero requests). Home
 * anchors the art to the right edge for the split hero; subpages center it.
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
	'contact' => array( home_url( '/contact/' ), 'Contact' ),
);
$lapin_aria = static function ( string $key ) use ( $lapin_nav_current ): string {
	return $key === $lapin_nav_current ? ' aria-current="page"' : '';
};
?>
<a class="skip-link" href="#main">Skip to content</a>
<div class="masthead">
	<svg class="masthead__art" viewBox="0 0 1600 900" preserveAspectRatio="<?php echo esc_attr( 'home' === $lapin_nav_current ? 'xMaxYMax' : 'xMidYMax' ); ?> slice" aria-hidden="true" focusable="false">
		<defs>
			<radialGradient id="lapin-glow" cx="0.5" cy="0.5" r="0.5">
				<stop offset="0" stop-color="#D1BFA7" stop-opacity="0.22"/>
				<stop offset="0.55" stop-color="#AA7F3D" stop-opacity="0.09"/>
				<stop offset="1" stop-color="#AA7F3D" stop-opacity="0"/>
			</radialGradient>
			<radialGradient id="lapin-glow-core" cx="0.5" cy="0.5" r="0.5">
				<stop offset="0" stop-color="#F3ECE1" stop-opacity="0.5"/>
				<stop offset="0.45" stop-color="#E8D9B8" stop-opacity="0.22"/>
				<stop offset="1" stop-color="#E8D9B8" stop-opacity="0"/>
			</radialGradient>
			<linearGradient id="lapin-fan" x1="0" y1="1" x2="1" y2="0">
				<stop offset="0" stop-color="#AA7F3D" stop-opacity="0"/>
				<stop offset="0.5" stop-color="#E8D9B8" stop-opacity="0.55"/>
				<stop offset="1" stop-color="#AA7F3D" stop-opacity="0"/>
			</linearGradient>
		</defs>
		<!-- warm light: radiant pool at the deck bend + horizon haze
		     (v2.1 — cable-stayed bridge per the client's reference image) -->
		<ellipse cx="1000" cy="620" rx="660" ry="380" fill="url(#lapin-glow)"/>
		<ellipse cx="1150" cy="700" rx="370" ry="210" fill="url(#lapin-glow-core)"/>
		<ellipse cx="600" cy="612" rx="430" ry="62" fill="url(#lapin-glow-core)" opacity="0.5"/>
		<!-- light trails arcing from the left toward the mast top -->
		<g class="art-arcs" opacity="0.28">
			<path d="M -80 560 C 300 380, 700 180, 1120 -80 L 1072 -80 C 676 160, 284 348, -80 516 Z" fill="url(#lapin-fan)" opacity="0.5"/>
			<path d="M -80 560 C 300 380, 700 180, 1120 -80" fill="none" stroke="#E8D9B8" stroke-width="1.3" opacity="0.5"/>
			<path d="M -80 760 C 420 620, 900 420, 1380 -80 L 1330 -80 C 866 396, 396 588, -80 716 Z" fill="url(#lapin-fan)" opacity="0.3"/>
			<path d="M -80 760 C 420 620, 900 420, 1380 -80" fill="none" stroke="#AA7F3D" stroke-width="1" opacity="0.35"/>
		</g>
		<!-- the bridge; kept quiet by the 0.28 group opacity — the home page
		     raises it via .page-home CSS -->
		<g class="art-bridge" opacity="0.28">
		<!-- faint skyline at the horizon, tucked behind the deck band -->
		<g fill="#000000" opacity="0.3">
			<rect x="300" y="592" width="26" height="26"/><rect x="338" y="600" width="18" height="18"/>
			<rect x="368" y="586" width="30" height="32"/><rect x="410" y="598" width="22" height="20"/>
			<rect x="444" y="592" width="16" height="26"/><rect x="472" y="602" width="28" height="16"/>
			<rect x="512" y="594" width="20" height="24"/><rect x="544" y="588" width="14" height="30"/>
			<rect x="570" y="600" width="24" height="18"/><rect x="606" y="592" width="18" height="26"/>
			<rect x="636" y="598" width="26" height="20"/><rect x="674" y="590" width="16" height="28"/>
		</g>
		<g fill="#E8D9B8" opacity="0.55">
			<circle cx="380" cy="596" r="1.2"/><circle cx="452" cy="600" r="1.1"/><circle cx="550" cy="595" r="1.1"/>
			<circle cx="330" cy="603" r="1"/><circle cx="614" cy="600" r="1.1"/><circle cx="682" cy="597" r="1.1"/>
		</g>
		<!-- deck: sweeping curve into the foreground, twin lit edges -->
		<path d="M 240 620 C 640 600, 980 630, 1230 730 C 1380 790, 1500 852, 1600 918 L 1600 968 C 1494 894, 1372 826, 1214 762 C 968 664, 634 634, 240 648 Z" fill="#000000" opacity="0.55"/>
		<path d="M 240 620 C 640 600, 980 630, 1230 730 C 1380 790, 1500 852, 1600 918" fill="none" stroke="#E8D9B8" stroke-width="12" opacity="0.2"/>
		<path d="M 240 620 C 640 600, 980 630, 1230 730 C 1380 790, 1500 852, 1600 918" fill="none" stroke="#F3ECE1" stroke-width="3" opacity="1"/>
		<path d="M 252 608 C 648 588, 984 618, 1226 716 C 1372 778, 1484 840, 1580 902" fill="none" stroke="#D1BFA7" stroke-width="1.3" opacity="0.55"/>
		<path d="M 240 648 C 634 634, 968 664, 1214 762 C 1372 826, 1494 894, 1600 968" fill="none" stroke="#AA7F3D" stroke-width="1.5" opacity="0.55"/>
		<!-- pylon: continues below the deck into the foreground, gold rim light -->
		<polygon points="1132,-80 1164,-80 1276,900 1198,900" fill="#000000" opacity="0.62"/>
		<path d="M 1132 -80 L 1198 900" fill="none" stroke="#F3ECE1" stroke-width="3" opacity="0.95"/>
		<path d="M 1164 -80 L 1276 900" fill="none" stroke="#AA7F3D" stroke-width="1.6" opacity="0.6"/>
		<path d="M 1148 -80 L 1236 900" fill="none" stroke="#D1BFA7" stroke-width="1" opacity="0.25"/>
		<!-- stay cables fanning left to the deck, brighter near the mast -->
		<g fill="none" stroke="#E8D9B8" stroke-width="1.2">
			<path d="M 1138 -60 L 340 612" opacity="0.35"/>
			<path d="M 1141 -15 L 420 607" opacity="0.4"/>
			<path d="M 1144 30 L 500 604" opacity="0.45"/>
			<path d="M 1147 78 L 580 602" opacity="0.5"/>
			<path d="M 1151 128 L 660 603" opacity="0.55"/>
			<path d="M 1155 180 L 740 606" opacity="0.6"/>
			<path d="M 1159 234 L 820 612" opacity="0.65"/>
			<path d="M 1163 290 L 900 620" opacity="0.7"/>
			<path d="M 1168 350 L 975 630" opacity="0.75"/>
			<path d="M 1173 412 L 1045 644" opacity="0.8"/>
			<path d="M 1178 478 L 1105 660" opacity="0.85"/>
			<path d="M 1184 548 L 1155 680" opacity="0.9"/>
		</g>
		<!-- backstays to the right -->
		<g fill="none" stroke="#D1BFA7" stroke-width="1.2">
			<path d="M 1146 -20 L 1450 838" opacity="0.55"/>
			<path d="M 1152 60 L 1500 862" opacity="0.45"/>
			<path d="M 1158 145 L 1548 888" opacity="0.38"/>
		</g>
		<!-- warm reflection pooling under the deck bend -->
		<ellipse cx="1310" cy="822" rx="270" ry="80" fill="url(#lapin-glow-core)" opacity="0.35"/>
		<!-- lower-left corner hairline -->
		<path d="M -80 700 L 240 900" fill="none" stroke="#AA7F3D" stroke-width="1.2" opacity="0.3"/>
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
