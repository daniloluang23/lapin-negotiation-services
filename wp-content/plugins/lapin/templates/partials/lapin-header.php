<?php
/**
 * Site header — N1b three-section nav (logo · links + Services dropdown ·
 * phone CTA) with a slim contact top bar above and a disclosure panel on
 * mobile. Expects $lapin['nav'] to mark the current item.
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
$lapin_aria = static function ( string $key ) use ( $lapin_nav_current ): string {
	return $key === $lapin_nav_current ? ' aria-current="page"' : '';
};
?>
<a class="skip-link" href="#main">Skip to content</a>
<div class="topbar">
	<div class="wrap">
		<a href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
		<a href="tel:<?php echo esc_attr( Lapin::PHONE_FREE_TEL ); ?>">Toll-free <?php echo esc_html( Lapin::PHONE_FREE ); ?></a>
		<a href="mailto:<?php echo esc_attr( Lapin::EMAIL ); ?>"><?php echo esc_html( Lapin::EMAIL ); ?></a>
	</div>
</div>
<header class="site-head">
	<div class="wrap">
		<a class="site-head__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( Lapin::NAME ); ?> — home">
			<img src="<?php echo esc_url( Lapin::asset( 'images/logo-dark.png' ) ); ?>" alt="<?php echo esc_attr( Lapin::NAME ); ?>" width="170" height="60">
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
				<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"<?php echo $lapin_aria( 'contact' ); // phpcs:ignore ?>>Contact</a></li>
			</ul>
			<a class="btn btn--gold" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Talk direct</a>
			<button class="nav__burger" type="button" aria-expanded="false" aria-controls="nav-panel" aria-label="Open menu">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M2 5h16M2 10h16M2 15h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
			</button>
		</nav>
	</div>
	<div class="nav-panel" id="nav-panel" hidden>
		<ul>
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
			<li class="nav-panel__group"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"<?php echo $lapin_aria( 'contact' ); // phpcs:ignore ?>>Contact</a></li>
			<li><a href="tel:<?php echo esc_attr( Lapin::PHONE_FREE_TEL ); ?>">Toll-free <?php echo esc_html( Lapin::PHONE_FREE ); ?></a></li>
		</ul>
	</div>
</header>
