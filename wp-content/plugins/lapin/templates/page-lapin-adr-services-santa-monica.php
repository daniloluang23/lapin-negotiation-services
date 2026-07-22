<?php
/**
 * Landing page — "ADR & Dispute Resolution in Santa Monica" (SEO).
 * Targets the ADR / alternative dispute resolution Santa Monica cluster.
 * Honesty guardrail: the office is in West Los Angeles — this page serves
 * Santa Monica and the Westside, never claims a Santa Monica address.
 * Copy adapted from the verbatim /dispute-resolution/ page + transcripts.
 * DRAFT for client audit.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin_faqs = array(
	array(
		'q' => 'What is alternative dispute resolution (ADR)?',
		'a' => 'ADR is any method of resolving a dispute without a full court trial — principally direct negotiation, mediation, and arbitration. It is typically faster, less expensive, more private, and more predictable than litigation.',
	),
	array(
		'q' => 'Do you have an office in Santa Monica?',
		'a' => 'Our office is on Wilshire Boulevard in West Los Angeles, a short drive from Santa Monica, and we serve clients throughout Santa Monica and the Westside. Sessions can also be held remotely.',
	),
	array(
		'q' => 'What is the difference between mediation and arbitration?',
		'a' => 'In mediation, a neutral mediator facilitates a negotiated agreement but has no power to impose a decision. In arbitration, the arbitrator acts as a private judge and issues a binding decision. Mediation preserves your control over the outcome; arbitration does not.',
	),
	array(
		'q' => 'Can you help before a lawsuit is filed?',
		'a' => 'Yes — pre-litigation dispute resolution is often the best time to act. Resolving a matter before positions harden and legal costs mount protects both your finances and, where it matters, the underlying relationship.',
	),
);

$lapin_faq_schema = array();
foreach ( $lapin_faqs as $lapin_faq ) {
	$lapin_faq_schema[] = array(
		'@type'          => 'Question',
		'name'           => $lapin_faq['q'],
		'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $lapin_faq['a'] ),
	);
}

$lapin = array(
	'title'      => 'ADR & Dispute Resolution in Santa Monica | Mediation & Arbitration | Lapin Negotiation Services',
	'desc'       => 'Alternative dispute resolution serving Santa Monica and the Westside — mediation, arbitration support, and pre-litigation dispute resolution from a Harvard-trained specialist. Free consultation.',
	'path'       => 'adr-services-santa-monica/',
	'nav'        => '',
	'body_class' => 'page-landing page-adr-santa-monica',
	'breadcrumb' => array(
		array( 'Dispute Resolution', home_url( '/dispute-resolution/' ) ),
		array( 'ADR in Santa Monica', home_url( '/adr-services-santa-monica/' ) ),
	),
	'hero'       => array(
		'eyebrow' => 'Santa Monica & the Westside',
		'title'   => 'ADR & Dispute Resolution in Santa Monica',
		'lede'    => 'Mediation, arbitration support, and pre-litigation resolution — without the cost of court. Free consultation.',
	),
	'schema'     => array(
		array(
			'@type'       => 'Service',
			'name'        => 'Alternative Dispute Resolution — Santa Monica',
			'provider'    => array( '@id' => home_url( '/' ) . '#organization' ),
			'serviceType' => 'Alternative dispute resolution, mediation, arbitration support',
			'areaServed'  => array( '@type' => 'City', 'name' => 'Santa Monica' ),
		),
		array(
			'@type'      => 'FAQPage',
			'mainEntity' => $lapin_faq_schema,
		),
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';
?>
<style>
	.svc-list { list-style: none; margin: 0 0 var(--space-md); padding: 0; }
	.svc-list li { position: relative; padding-left: 1.5rem; margin-bottom: var(--space-sm); color: var(--color-ink-2); }
	.svc-list li::before { content: ""; position: absolute; left: 0; top: 0.55em; width: 0.5rem; height: 0.5rem; background: var(--color-accent); }
	.sec + .sec { border-top: 1px solid var(--color-rule); }
	.faq { max-width: 52rem; }
	.faq__item { border-top: 1px solid var(--color-rule); padding: var(--space-lg) 0; }
	.faq__item h3 { font-size: var(--text-md); margin: 0 0 var(--space-xs); }
	.faq__item p { color: var(--color-ink-2); margin: 0; }
</style>

<main id="main">
	<section class="sec" id="adr-intro">
		<div class="wrap">
			<div class="split">
				<div>
					<div class="sec-head">
						<h2>Resolve disputes without the cost of court</h2>
					</div>
					<div class="prose">
						<p class="lead">Litigation is expensive, slow, and unpredictable. For most disputes, there is a better way.</p>
						<p>From our office on Wilshire Boulevard in West Los Angeles — minutes from Santa Monica — we help individuals and businesses across the Westside resolve conflict through alternative dispute resolution: direct negotiation, mediation, and arbitration support. The best and cheapest way to resolve a dispute is through direct negotiation; when that stalls, mediation brings in a neutral specialist to facilitate a resolution the parties design themselves.</p>
						<p>Not sure which path fits your situation? Read our explainer on <a href="/mediation-vs-arbitration-vs-litigation/">mediation vs. arbitration vs. litigation</a>.</p>
					</div>
				</div>
				<figure class="split__media" aria-hidden="true">
					<?php echo Lapin::icon( 'messages-square' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</figure>
			</div>
		</div>
	</section>

	<section class="sec" id="adr-services">
		<div class="wrap">
			<div class="sec-head">
				<h2>How we help resolve disputes</h2>
			</div>
			<div class="prose">
				<ul class="svc-list">
					<li><strong>Mediation:</strong> as a neutral mediator, we facilitate productive dialogue and help both sides reach a durable, voluntary agreement.</li>
					<li><strong>Negotiation &amp; representation:</strong> when you need an advocate, we open channels of communication and negotiate settlement on your behalf.</li>
					<li><strong>Pre-litigation dispute resolution:</strong> we step in early — before positions harden and costs escalate — to keep matters out of court wherever possible.</li>
					<li><strong>Conflict coaching:</strong> strategy and support for individuals and organizations managing a difficult dispute.</li>
				</ul>
			</div>

			<div class="post-cta">
				<p>Facing a dispute in Santa Monica or the Westside? Let's find the fastest, least costly path to resolution.</p>
				<div class="post-cta__actions">
					<a class="btn btn--rose" href="/contact/">Schedule a Free Consultation</a>
					<a class="btn btn--outline" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call Now — <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section class="sec" id="adr-faq">
		<div class="wrap">
			<div class="sec-head">
				<h2>Frequently asked questions</h2>
			</div>
			<div class="faq">
				<?php foreach ( $lapin_faqs as $lapin_faq ) : ?>
				<div class="faq__item">
					<h3><?php echo esc_html( $lapin_faq['q'] ); ?></h3>
					<p><?php echo esc_html( $lapin_faq['a'] ); ?></p>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
