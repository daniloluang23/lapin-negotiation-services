<?php
/**
 * Landing page — "Divorce Mediation in Los Angeles" (SEO).
 * Targets the divorce mediation LA cluster + the losing "how to find a
 * mediator for divorce" query. Copy from Raphael's family/probate transcripts
 * + the verbatim /mediation/ page; no invented metrics. DRAFT for client audit.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin_faqs = array(
	array(
		'q' => 'What is divorce mediation?',
		'a' => 'Divorce mediation is facilitated negotiation. A neutral mediator helps both spouses reach their own agreement on finances, property, support, and children — without a judge imposing the outcome. Because you design the agreement together, it tends to be more durable and far less bitter than a court fight.',
	),
	array(
		'q' => 'How do I find the right divorce mediator?',
		'a' => 'Look for genuine training in negotiation and dispute resolution (not only years of litigation), true neutrality, skill in handling emotion, and a commitment to stay with the process until there is a signed agreement everyone is comfortable with.',
	),
	array(
		'q' => 'Is mediation better than going to court?',
		'a' => 'For most families, yes. Litigation is expensive, slow, and unpredictable, and a court can settle a dispute while the underlying conflict lingers. Mediation aims to resolve the conflict itself, protecting your finances, your dignity, and your co-parenting relationship.',
	),
	array(
		'q' => 'Do we each still need our own attorney?',
		'a' => 'Many couples mediate without attorneys, but we always encourage you to have independent counsel review any agreement before you sign. This article is general information, not legal advice.',
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
	'title'      => 'Divorce Mediation in Los Angeles | Peaceful, Out-of-Court Divorce | Lapin Negotiation Services',
	'desc'       => 'Divorce mediation in Los Angeles with a Harvard-trained mediator — resolve your divorce out of court to protect your finances, dignity, and children. Free consultation.',
	'path'       => 'divorce-mediation-los-angeles/',
	'nav'        => '',
	'body_class' => 'page-landing page-divorce-la',
	'breadcrumb' => array(
		array( 'Mediation', home_url( '/mediation/' ) ),
		array( 'Divorce Mediation in Los Angeles', home_url( '/divorce-mediation-los-angeles/' ) ),
	),
	'hero'       => array(
		'eyebrow' => 'Los Angeles',
		'title'   => 'Divorce Mediation in Los Angeles',
		'lede'    => 'Resolve your divorce out of court — protecting your finances, your dignity, and your children. Free consultation.',
	),
	'schema'     => array(
		array(
			'@type'       => 'Service',
			'name'        => 'Divorce Mediation in Los Angeles',
			'provider'    => array( '@id' => home_url( '/' ) . '#organization' ),
			'serviceType' => 'Divorce and family mediation',
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
	<section class="sec" id="divorce-intro">
		<div class="wrap">
			<div class="split">
				<div>
					<div class="sec-head">
						<h2>A calmer way through divorce</h2>
					</div>
					<div class="prose">
						<p class="lead">Divorce is painful enough without turning it into a war.</p>
						<p>The litigation system is built for battle — two sides, two lawyers, and a judge who settles the dispute without ever resolving the underlying conflict. From our office in West Los Angeles, we offer a better path for most families: divorce mediation that helps both spouses reach their own durable agreement on finances, property, support, and, above all, the children.</p>
						<p>Because you design the outcome together rather than having it handed down, mediated agreements tend to hold — and they protect the co-parenting relationship you will rely on for years to come.</p>
					</div>
				</div>
				<figure class="split__media" aria-hidden="true">
					<?php echo Lapin::icon( 'users' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</figure>
			</div>
		</div>
	</section>

	<section class="sec" id="divorce-process">
		<div class="wrap">
			<div class="sec-head">
				<h2>How divorce mediation works</h2>
			</div>
			<div class="prose">
				<p>A well-run mediation moves between two modes: first, making sure each person feels genuinely heard and understood; then, turning toward the future — what would let each of you move forward, fairly and with your dignity intact. The goal is not for anyone to "win." It is for both people to leave with their most important interests met, which is exactly what makes an agreement last.</p>
				<ul class="svc-list">
					<li><strong>Neutral and confidential:</strong> we keep judgment out of the room so both spouses feel safe.</li>
					<li><strong>Built for the hard emotions:</strong> family conflict carries history; we let it be heard without letting it derail the resolution.</li>
					<li><strong>We stay with it:</strong> the work continues until there is a signed agreement you are both comfortable with.</li>
				</ul>
				<p>For more, see our guide on <a href="/divorce-mediation-how-to-find-a-mediator/">how to find the right divorce mediator</a> and our overview of <a href="/mediation/">mediation services</a>.</p>
			</div>

			<div class="post-cta">
				<p>You do not have to choose between protecting your interests and keeping the peace. Start with a confidential conversation.</p>
				<div class="post-cta__actions">
					<a class="btn btn--rose" href="/contact/">Schedule a Free Consultation</a>
					<a class="btn btn--outline" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call Now — <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section class="sec" id="divorce-faq">
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
