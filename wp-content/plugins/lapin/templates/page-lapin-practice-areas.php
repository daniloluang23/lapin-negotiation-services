<?php
/**
 * Practice Areas — editorial intro + two-column hairline index of the 15
 * practice areas. (Fixes the live site's "practic areas" typo.)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'Practice Areas | Negotiation & Mediation for 15 Dispute Types | Lapin Negotiation Services',
	'desc'       => 'Online and in-person negotiation and mediation across commercial, contract, construction, divorce, elder care, family business, HOA, landlord/tenant, probate, real estate, union and workplace disputes.',
	'path'       => 'practice-areas/',
	'nav'        => 'practice-areas',
	'body_class' => 'page-practice-areas',
	'hero'       => array(
		'title' => 'Practice Areas',
		'lede'  => 'We provide both online and in-person negotiation and mediation services in these practice areas.',
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';

// [ label, Lucide icon ] — client 2026-07-22: a small icon beside each area
// (matches the client's supplied mockup). Icons live in assets/icons/.
$lapin_areas = array(
	array( 'Commercial Disputes', 'building-2' ),
	array( 'Contract Negotiations and Disputes', 'handshake' ),
	array( 'Civil Disputes', 'scale' ),
	array( 'Contractor and Construction', 'hard-hat' ),
	array( 'Divorce', 'heart-crack' ),
	array( 'Elder Care', 'hand-heart' ),
	array( 'Family & Family Business Disputes', 'users' ),
	array( 'Homeowner Association Issues', 'house' ),
	array( 'Landlord/Tenant Disputes', 'building' ),
	array( 'Malpractice', 'briefcase-medical' ),
	array( 'Contested Probate Disputes', 'scroll-text' ),
	array( 'Real Estate', 'key-round' ),
	array( 'Union Negotiations', 'users-round' ),
	array( 'Wills and Trusts', 'feather' ),
	array( 'Workplace Issues', 'briefcase-business' ),
);
?>
<style>
	.areas {
		list-style: none; margin: 0; padding: 0;
		columns: 2; column-gap: var(--space-3xl); max-width: 56rem;
	}
	.areas li { break-inside: avoid; border-bottom: 1px solid var(--color-rule); }
	.areas h2 {
		font-size: var(--text-md); font-weight: 650; margin: 0;
		padding: var(--space-md) 0; display: flex; gap: var(--space-md); align-items: center;
	}
	/* Small, subtle per-area icon (client mockup 2026-07-22). */
	.areas h2 svg { width: 1.35rem; height: 1.35rem; flex-shrink: 0; color: var(--color-accent); stroke-width: 1.75; opacity: 0.85; }
	@media (max-width: 40rem) { .areas { columns: 1; } }
</style>

<main id="main">
	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-watermark.php'; ?>
	<section class="sec">
		<div class="wrap">
			<ul class="areas">
				<?php foreach ( $lapin_areas as $lapin_area ) : ?>
				<li><h2><?php echo Lapin::icon( $lapin_area[1] ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( $lapin_area[0] ); ?></h2></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
