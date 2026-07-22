<?php
/**
 * Landing page — "Negotiation Services in Los Angeles" (SEO).
 * Targets the site's top-converting + highest-impression query cluster
 * (negotiation services los angeles / negotiation consultant california).
 * Copy adapted from the verbatim /negotiation/ service page + Raphael's
 * transcripts; no invented metrics. DRAFT for client audit.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin_faqs = array(
	array(
		'q' => 'What negotiation services do you offer in Los Angeles?',
		'a' => 'We provide negotiation training, one-on-one advice and coaching, behind-the-scenes strategy support, and direct representation at the table — for individuals, families, businesses, and organizations across Los Angeles and Southern California.',
	),
	array(
		'q' => 'Do you work with individuals, or only businesses?',
		'a' => 'Both. We represent and coach individuals on personal, salary, real estate, and family negotiations, and we advise businesses and organizations on complex commercial and contract negotiations.',
	),
	array(
		'q' => 'What is your approach to negotiation?',
		'a' => 'We use principled, interest-based negotiation — the approach developed at the Harvard Negotiation Project. Rather than adversarial haggling, we work to understand the underlying interests of all parties and craft durable agreements that preserve relationships wherever possible.',
	),
	array(
		'q' => 'Do you offer a free consultation?',
		'a' => 'Yes. Your first consultation with a specialist is free — call ' . Lapin::PHONE_LOCAL . ' or toll-free ' . Lapin::PHONE_FREE . ', or request an assessment online.',
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
	'title'      => 'Negotiation Services in Los Angeles | Training, Advice & Representation | Lapin Negotiation Services',
	'desc'       => 'Harvard-trained negotiation services in Los Angeles — training, advice, strategy support, and representation for individuals, families, and businesses. Free consultation.',
	'path'       => 'negotiation-services-los-angeles/',
	'nav'        => '',
	'body_class' => 'page-landing page-negotiation-la',
	'breadcrumb' => array(
		array( 'Negotiation', home_url( '/negotiation/' ) ),
		array( 'Negotiation Services in Los Angeles', home_url( '/negotiation-services-los-angeles/' ) ),
	),
	'hero'       => array(
		'eyebrow' => 'Los Angeles',
		'title'   => 'Negotiation Services in Los Angeles',
		'lede'    => 'Harvard-trained negotiation training, advice, and representation. Free consultation — call ' . Lapin::PHONE_LOCAL . '.',
	),
	'schema'     => array(
		array(
			'@type'       => 'Service',
			'name'        => 'Negotiation Services in Los Angeles',
			'provider'    => array( '@id' => home_url( '/' ) . '#organization' ),
			'serviceType' => 'Negotiation training, advice, support and representation',
			'areaServed'  => array( '@type' => 'City', 'name' => 'Los Angeles' ),
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
	<section class="sec" id="la-negotiation-intro">
		<div class="wrap">
			<div class="split">
				<div>
					<div class="sec-head">
						<h2>Negotiation specialists serving Los Angeles</h2>
					</div>
					<div class="prose">
						<p class="lead">Are you tired of negotiations turning into stressful, adversarial haggling, leading to frustrating compromises and suboptimal outcomes?</p>
						<p>From our office on Wilshire Boulevard in West Los Angeles, we help clients across the city and throughout Southern California negotiate with confidence — whether that is a business deal, a contract, a real estate transaction, a partnership dispute, or a personal matter.</p>
						<p>Our approach is built on principled, interest-based negotiation: understanding the underlying interests, priorities, and values of everyone at the table, then crafting agreements that are efficient, profitable, and durable — while building strong, trusting relationships with your counterparts.</p>
					</div>
				</div>
				<figure class="split__media" aria-hidden="true">
					<?php echo Lapin::icon( 'handshake' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</figure>
			</div>
		</div>
	</section>

	<section class="sec" id="la-negotiation-services">
		<div class="wrap">
			<div class="sec-head">
				<h2>How we can help</h2>
			</div>
			<div class="prose">
				<ul class="svc-list">
					<li><strong>Negotiation training:</strong> practical, hands-on programs — one-on-one, in teams, or for larger groups — with a proven track record of delivering transformative results for organizations, including Fortune 100 companies.</li>
					<li><strong>Advice &amp; support:</strong> expert guidance and coaching from preparation through post-negotiation, whether you are negotiating a salary, closing a deal, or resolving a conflict.</li>
					<li><strong>Representation:</strong> an experienced agent at the table — bringing expertise and objectivity to negotiations that are complex, high-stakes, or beyond your experience level.</li>
				</ul>
				<p>New to how we work? Start with our overview of <a href="/negotiation-strategies-that-work/">negotiation strategies that actually work</a>, or explore our full <a href="/negotiation/">negotiation services</a>.</p>
			</div>

			<div class="post-cta">
				<p>Ready to negotiate with a specialist in your corner? Your first consultation is free.</p>
				<div class="post-cta__actions">
					<a class="btn btn--rose" href="/contact/">Schedule a Free Consultation</a>
					<a class="btn btn--outline" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call Now — <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section class="sec" id="la-negotiation-faq">
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
