<?php
/**
 * Mediation — Split Studio plus the mediation-vs-litigation comparison,
 * rebuilt as an accessible two-column definition grid (9 verbatim pairs).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'Mediation Services | An Alternative to Litigation | Lapin Negotiation Services',
	'desc'       => 'Confidential, non-confrontational mediation that resolves most disputes within a day — typically $1,500–$5,000 per party instead of years in court. We don’t just settle the case, we resolve the dispute.',
	'path'       => 'mediation/',
	'nav'        => 'mediation',
	'body_class' => 'page-mediation',
	'schema'     => array(
		array(
			'@type'       => 'Service',
			'name'        => 'Mediation Services',
			'provider'    => array( '@id' => home_url( '/' ) . '#organization' ),
			'serviceType' => 'Mediation, mediation preparation, support and coaching',
			'areaServed'  => 'Southern California',
		),
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';

$lapin_hero = array(
	'title' => 'Mediation Services',
	'lede'  => 'Free consultation with a specialist — call ' . Lapin::PHONE_LOCAL . ' or toll-free ' . Lapin::PHONE_FREE . '.',
);

$lapin_pairs = array(
	array( 'Most disputes can be resolved within a day.', 'Can take years before case comes before a judge or jury.' ),
	array( 'Dispute is resolved.', 'Case often goes on to appeal.' ),
	array( 'Cases are usually settled for between $1,500 and $5,000 per party.', 'Costs can quickly accumulate to tens of thousands of dollars &amp; sometimes more.' ),
	array( 'A collaborative problem-solving approach.', 'A confrontational and adversarial fight.' ),
	array( 'Allows for creative and innovative solutions designed by the parties.', 'Limited by legal code, principles and doctrine as applied by the judge.' ),
	array( 'Maintains privacy and confidentiality.', 'On public record for all to access and see.' ),
	array( 'Parties themselves are in control of the decision and outcomes.', 'Judge or jury decides and outcomes are unpredictable.' ),
	array( 'Parties resolve the dispute with dignity intact.', 'Court proceedings are commonly ignominious.' ),
	array( 'Not uncommon for relationships to be salvaged and repaired if so desired.', 'Disputants typically remain sworn enemies.' ),
);
?>
<style>
	.sec + .sec { border-top: 1px solid var(--color-rule); }
	/* Text-only section: match the 65% text column of the split sections. */
	@media (min-width: 60rem) {
		#mediation-mediation-preparation .sec-head,
		#mediation-mediation-preparation .prose { max-width: calc(65% - 2.6rem); }
	}
	.pull { font-family: var(--font-display); font-weight: 650; font-size: var(--text-lg); color: var(--color-ink); max-width: 24ch; }
	.pull::after { content: ""; display: block; width: 3.5rem; height: 3px; background: var(--color-accent); margin-top: var(--space-sm); }
	.vs { border-collapse: collapse; width: 100%; }
	.vs caption { text-align: left; }
	.vs th {
		font-family: var(--font-body); font-size: var(--text-sm); font-weight: 600;
		letter-spacing: var(--tracking-label); text-transform: uppercase;
		text-align: left; padding: var(--space-sm) var(--space-lg) var(--space-sm) 0;
		border-bottom: 2px solid var(--color-ink);
	}
	.vs th.vs__med { color: var(--color-ink); border-bottom-color: var(--color-accent); }
	.vs th.vs__lit { color: var(--color-muted); }
	.vs td {
		vertical-align: top; width: 50%;
		padding: var(--space-md) var(--space-lg) var(--space-md) 0;
		border-bottom: 1px solid var(--color-rule); color: var(--color-ink-2);
	}
	.vs td:first-child { color: var(--color-ink); }
	@media (max-width: 40rem) {
		.vs, .vs tbody, .vs tr, .vs td { display: block; width: 100%; }
		.vs thead { display: none; }
		.vs tr { border-bottom: 1px solid var(--color-rule); padding-block: var(--space-sm); }
		.vs td { border: 0; padding: var(--space-2xs) 0; }
		.vs td::before {
			display: block; font-size: var(--text-sm); font-weight: 600;
			letter-spacing: var(--tracking-label); text-transform: uppercase;
		}
		.vs td:first-child::before { content: "Mediation"; color: var(--color-focus); }
		.vs td:last-child::before { content: "Litigation"; color: var(--color-muted); }
	}
</style>

<main id="main">
	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-page-hero.php'; ?>

	<section class="sec" id="mediation-alternative-to-litigation">
		<div class="wrap">
			<div class="split">
				<div>
					<div class="sec-head">
						<h2>Mediation — an alternative to litigation</h2>
					</div>
					<div class="prose">
						<p class="lead">Mediation is an effective alternative to legal proceedings for resolving disputes. It is faster, more affordable, and less stressful than going to court, and it allows parties to craft their own resolution rather than having a judge or jury impose a decision.</p>
						<p>Our mediation specialists are skilled at handling complex disputes. They consider all aspects of the dispute including emotional, psychological, historical, and cultural ones, beyond just the legal issues. With their well-honed skills, they facilitate deep, meaningful and productive dialogue which helps parties reach mutually satisfactory resolutions that can even repair relationships. We take a holistic approach to disputes and aim for lasting agreements that address all dimensions of the conflict.</p>
					</div>
				</div>
				<p class="pull">We don’t just settle the case — we resolve the dispute.</p>
			</div>
		</div>
	</section>

	<section class="sec" id="mediation-services">
		<div class="wrap">
			<div class="split split--flip">
				<figure class="split__media" aria-hidden="true">
					<?php echo Lapin::icon( 'users' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</figure>
				<div>
					<div class="sec-head">
						<h2>Mediation services</h2>
					</div>
					<div class="prose">
						<p class="lead">Do you feel like a conflict or disagreement is causing stress, costing you money and damaging your relationships?</p>
						<p>Our experienced mediators can help you find a resolution that works for everyone. We’ll delve into the true underlying issues and work with you to find practical solutions that meet the needs and concerns of all parties involved.</p>
						<p>Mediation is a confidential and non-confrontational way to resolve disputes and can lead to more satisfactory outcomes, save you time and money, and even help repair relationships. It will also help you avoid the stress and uncertainty of going to court. Let us help you find a resolution that works for you.</p>
						<p>Don’t let conflict or disagreement ruin your relationships or drain your resources. Contact us today to learn more about how mediation can help you find a peaceful and effective resolution.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="sec" id="mediation-mediation-preparation">
		<div class="wrap">
			<div class="sec-head">
				<h2>Mediation preparation, support and coaching</h2>
			</div>
			<div class="prose">
				<p class="lead">Are you facing an upcoming mediation and feeling uncertain about how to prepare?</p>
				<p>Don’t worry, you’re not alone. Mediation can be a confusing and emotional process, but with the right support and guidance, you can increase your chances of a successful outcome. By working with a skilled mediator, you’ll gain the tools you need to understand the process, clarify your goals, communicate effectively, make compelling arguments, and manage your emotions.</p>
				<p>Don’t go into your mediation unprepared — invest in the support you need to feel confident and ready for the process. Contact us today to learn more about how we can help you succeed in your upcoming mediation.</p>
			</div>
		</div>
	</section>

	<section class="sec" id="mediation-vs-litigation">
		<div class="wrap">
			<div class="sec-head">
				<h2>The power of mediation vs. the costs of litigation</h2>
			</div>
			<table class="vs">
				<thead>
					<tr>
						<th scope="col" class="vs__med">Mediation</th>
						<th scope="col" class="vs__lit">Litigation</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $lapin_pairs as $lapin_pair ) : ?>
					<tr>
						<td><?php echo wp_kses_post( $lapin_pair[0] ); ?></td>
						<td><?php echo wp_kses_post( $lapin_pair[1] ); ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</section>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
