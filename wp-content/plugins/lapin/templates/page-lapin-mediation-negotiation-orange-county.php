<?php
/**
 * Landing page — "Mediation & Negotiation in Orange County" (SEO).
 * Client 2026-07-22: Raphael conducts mediations and negotiations out of
 * Newport Beach and throughout Orange County — a priority market. Copy adapted
 * from the verbatim /mediation/ + /negotiation/ service pages; no invented
 * metrics. Mirrors the sibling city landing pages (LA / Santa Monica).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin_faqs = array(
	array(
		'q' => 'Do you offer mediation and negotiation services in Orange County?',
		'a' => 'Yes. Raphael Lapin conducts mediations and negotiations out of Newport Beach and throughout Orange County — both in person and online — for individuals, families, businesses, and organizations across the county.',
	),
	array(
		'q' => 'Where in Orange County do you meet clients?',
		'a' => 'We conduct mediations and negotiations in Newport Beach and can arrange sessions across Orange County, as well as online. Our main office is on Wilshire Boulevard in West Los Angeles, a short drive from the county.',
	),
	array(
		'q' => 'What kinds of disputes do you handle?',
		'a' => 'Commercial and contract disputes, real estate and construction, divorce and family matters, probate and trust disputes, workplace and partnership conflicts, and more — the full range of our practice areas, resolved through mediation or principled negotiation rather than litigation wherever possible.',
	),
	array(
		'q' => 'Do you offer a free consultation?',
		'a' => 'Yes. Your first consultation is free — call ' . Lapin::PHONE_LOCAL . ' or toll-free ' . Lapin::PHONE_FREE . ', or request an assessment online.',
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
	'title'      => 'Mediation & Negotiation in Orange County | Newport Beach | Lapin Negotiation Services',
	'desc'       => 'Harvard-trained mediation and negotiation in Orange County — conducted out of Newport Beach for individuals, families, and businesses. Resolve disputes without litigation. Free consultation.',
	'path'       => 'mediation-negotiation-orange-county/',
	'nav'        => '',
	'body_class' => 'page-landing page-oc',
	'breadcrumb' => array(
		array( 'Mediation', home_url( '/mediation/' ) ),
		array( 'Mediation & Negotiation in Orange County', home_url( '/mediation-negotiation-orange-county/' ) ),
	),
	'hero'       => array(
		'eyebrow' => 'Orange County',
		'title'   => 'Mediation & Negotiation in Orange County',
		'lede'    => 'Harvard-trained mediation and negotiation, conducted out of Newport Beach. Free consultation — call ' . Lapin::PHONE_LOCAL . '.',
	),
	'schema'     => array(
		array(
			'@type'       => 'Service',
			'name'        => 'Mediation & Negotiation in Orange County',
			'provider'    => array( '@id' => home_url( '/' ) . '#organization' ),
			'serviceType' => 'Mediation, dispute resolution and negotiation',
			'areaServed'  => array( '@type' => 'City', 'name' => 'Orange County' ),
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
	<section class="sec" id="oc-intro">
		<div class="wrap">
			<div class="split">
				<div>
					<div class="sec-head">
						<h2>Mediation &amp; negotiation specialists serving Orange County</h2>
					</div>
					<div class="prose">
						<p class="lead">Facing a dispute or a high-stakes negotiation in Orange County — and want to resolve it without the cost, delay, and strain of litigation?</p>
						<p>Raphael Lapin conducts mediations and negotiations out of Newport Beach and throughout Orange County, helping individuals, families, businesses, and organizations reach practical, durable agreements while preserving relationships wherever possible. Sessions are available in person and online.</p>
						<p>Our approach is built on principled, interest-based mediation and negotiation: understanding the underlying interests, priorities, and values of everyone involved, then crafting resolutions that are efficient, workable, and lasting. We don’t just settle cases — we resolve disputes.</p>
					</div>
				</div>
				<figure class="split__media" aria-hidden="true">
					<?php echo Lapin::icon( 'handshake' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</figure>
			</div>
		</div>
	</section>

	<section class="sec" id="oc-services">
		<div class="wrap">
			<div class="sec-head">
				<h2>How we can help</h2>
			</div>
			<div class="prose">
				<ul class="svc-list">
					<li><strong>Mediation:</strong> a calm, structured process for resolving commercial, real estate, family, probate, workplace, and partnership disputes — addressing the emotional and practical dimensions, not just the legal ones.</li>
					<li><strong>Negotiation representation &amp; advice:</strong> an experienced agent at the table, or behind-the-scenes coaching and strategy, for negotiations that are complex, high-stakes, or beyond your experience level.</li>
					<li><strong>Dispute resolution:</strong> durable, compliant, and satisfying agreements — and, wherever possible, restored relationships — reached without the cost and uncertainty of court.</li>
				</ul>
				<p>Explore our full <a href="/mediation/">mediation services</a>, <a href="/negotiation/">negotiation services</a>, and the <a href="/practice-areas/">practice areas</a> we serve.</p>
			</div>

			<div class="post-cta">
				<p>Ready to resolve a dispute or negotiation in Orange County? Your first consultation is free.</p>
				<div class="post-cta__actions">
					<a class="btn btn--rose" href="/contact/">Schedule a Free Consultation</a>
					<a class="btn btn--outline" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call Now — <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section class="sec" id="oc-faq">
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
