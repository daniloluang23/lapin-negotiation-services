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
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';

$lapin_hero = array(
	'title' => 'Targeted Practice Areas',
	'lede'  => 'We provide both online and in-person negotiation and mediation services in these targeted practice areas.',
);

$lapin_areas = array(
	'Commercial Disputes',
	'Contract Negotiations and Disputes',
	'Civil Disputes',
	'Contractor and Construction',
	'Divorce',
	'Elder Care',
	'Family & Family Business Disputes',
	'Homeowner Association Issues',
	'Landlord/Tenant Disputes',
	'Malpractice',
	'Contested Probate Disputes',
	'Real Estate',
	'Union Negotiations',
	'Wills and Trusts',
	'Workplace Issues',
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
		padding: var(--space-md) 0; display: flex; gap: var(--space-sm); align-items: baseline;
	}
	.areas h2::before { content: ""; width: 0.5rem; height: 0.5rem; background: var(--color-accent); flex-shrink: 0; transform: translateY(-2px); }
	@media (max-width: 40rem) { .areas { columns: 1; } }
	.areas-figure {
		margin: var(--space-2xl) 0 0;
		background: var(--color-navy); border-radius: var(--radius-card);
		padding: var(--space-xl) var(--space-lg);
	}
</style>

<main id="main">
	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-page-hero.php'; ?>

	<section class="sec">
		<div class="wrap">
			<ul class="areas">
				<?php foreach ( $lapin_areas as $lapin_area ) : ?>
				<li><h2><?php echo esc_html( $lapin_area ); ?></h2></li>
				<?php endforeach; ?>
			</ul>
			<figure class="areas-figure">
				<img src="<?php echo esc_url( Lapin::asset( 'images/professions.webp' ) ); ?>" alt="Illustration of the professions and industries Lapin Negotiation Services works with" width="1600" height="501" loading="lazy">
			</figure>
		</div>
	</section>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
