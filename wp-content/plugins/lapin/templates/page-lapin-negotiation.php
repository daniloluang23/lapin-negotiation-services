<?php
/**
 * Negotiation (/negotiation/) — client copy replacement 2026-08-30 (Raphael's
 * "NEGOTIATION SERVICES PAGE" revision doc, used verbatim per the content law).
 *
 * The service family's Split Studio opens the page (Why work with a specialist),
 * then the rhythm breaks: a cream band of four ordinal step cards for "How We
 * Help", a two-column rule-topped pair for "Types of Negotiations We Handle",
 * and the client's own CTA copy in the shared onyx band voice. Segmentation and
 * scanning are the brief; the locked system (design.md) supplies every token.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'Negotiation Services | Strategy, Coaching & Representation | Lapin Negotiation Services',
	'desc'       => 'Strategic negotiation support for high-stakes matters — transactional deals and settlement negotiations. Risk and leverage assessment, tailored strategy, coaching and direct representation. Free consultation.',
	'path'       => 'negotiation/',
	'nav'        => 'negotiation',
	'body_class' => 'page-negotiation',
	'hero'       => array(
		'eyebrow'   => 'Negotiation Services',
		'title'     => 'Strategic Negotiation Support for High-Stakes Matters',
		'lede'      => 'Clear strategy. Creative solutions. Stronger outcomes — in both transactional negotiations and settlement negotiations in conflicts and disputes.',
		'statement' => 'We help you negotiate from strength.',
		'cta'       => 'Free Consultation',
	),
	'schema'     => array(
		array(
			'@type'       => 'Service',
			'name'        => 'Negotiation Services',
			'provider'    => array( '@id' => home_url( '/' ) . '#organization' ),
			'serviceType' => 'Negotiation strategy, coaching, support and representation',
			'areaServed'  => 'Southern California',
		),
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';

// "How We Help" — the client's four numbered stages. Each carries an icon,
// title, intro, bullets and a closing line; stage 4 is prose only, as written.
$lapin_steps = array(
	array(
		'icon'    => 'target',
		'title'   => 'Assess Risks, Leverage & Objectives',
		'intro'   => 'We begin by mapping the negotiation landscape:',
		'bullets' => array(
			'Your goals and constraints',
			'The other party’s interests and pressures',
			'Points of leverage and risk exposure',
			'Relationship dynamics and communication challenges',
		),
		'note'    => 'This gives you a clear, strategic foundation.',
	),
	array(
		'icon'    => 'lightbulb',
		'title'   => 'Design a Tailored Strategy — Including Creative Solutions',
		'intro'   => 'We develop a structured plan that positions you for success. Our hallmark is uncovering creative, interest-based options that expand value and open pathways others overlook:',
		'bullets' => array(
			'Innovative deal structures',
			'Alternative concessions',
			'Non-financial value creation',
			'Strategic reframing of issues',
		),
		'note'    => 'This is where clients often gain the most.',
	),
	array(
		'icon'    => 'messages-square',
		'title'   => 'Coaching & Support Throughout the Negotiation',
		'intro'   => 'You receive:',
		'bullets' => array(
			'Preparation for meetings and calls',
			'Guidance on messaging and communication',
			'Real-time advice as the negotiation evolves',
			'Debriefs and strategy adjustments',
		),
		'note'    => 'You’re supported from preparation through implementation.',
	),
	array(
		'icon'    => 'user-round-check',
		'title'   => 'Representation When Needed',
		'intro'   => 'For complex, sensitive, or high-stakes matters, we can represent you directly. Professional representation brings seasoned expertise and disciplined strategy to negotiations where experience, credibility and presence make a measurable difference.',
		'bullets' => array(),
		'note'    => '',
	),
);

// "Types of Negotiations We Handle" — the client's two-column split.
$lapin_types = array(
	array(
		'icon'  => 'handshake',
		'title' => 'Transactional Negotiations',
		'items' => array(
			'Business deals and commercial agreements',
			'Contract renewals and renegotiations',
			'Vendor and supplier negotiations',
			'Real estate and transactional matters',
			'Senior-level employment agreements',
		),
	),
	array(
		'icon'  => 'scale',
		'title' => 'Settlement Negotiations in Conflicts & Disputes',
		'items' => array(
			'Partnership and shareholder disputes',
			'Workplace conflicts',
			'Family business and interpersonal disputes',
			'Sensitive personal matters requiring discretion',
		),
	),
);
?>
<style>
	/* Hallmark · macrostructure: Split Studio → stepped studio (service family, design.md v2.8)
	 * theme: locked Lapin system · genre: editorial-corporate · nav/footer: shared
	 * pre-emit critique: P5 H5 E4 S5 R5 V4
	 */

	/* Hero: the client's H1 runs long — hold it to three lines on desktop. */
	.page-negotiation .hero--page h1 { max-width: 20ch; }

	/* ── 1 · Why work with a specialist (retained Split Studio voice) ─── */
	.neg-why .lead { margin-bottom: var(--space-md); }
	.neg-why .prose p:last-child { margin-bottom: 0; }
	.neg-why .prose strong { color: var(--color-ink); }

	/* ── 2 · How we help — four ordinal cards on the cream band ──────── */
	.neg-steps {
		list-style: none; margin: 0; padding: 0;
		display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));
		gap: var(--space-xl);
	}
	@media (max-width: 63.9375rem) {
		.neg-steps { grid-template-columns: minmax(0, 1fr); gap: var(--space-lg); }
	}
	/* .card supplies the paper fill, hairline and hover lift; the rose top edge
	   is the only accent per card, keeping rose gold well inside the 5% budget. */
	.neg-step {
		display: flex; flex-direction: column;
		padding: var(--space-xl);
		border-top: 3px solid var(--color-accent);
	}
	.neg-step__top { display: flex; align-items: center; gap: var(--space-md); margin-bottom: var(--space-md); }
	.neg-step__num {
		font-family: var(--font-display); font-weight: 700; font-size: var(--text-md);
		letter-spacing: var(--tracking-display); line-height: 1;
		font-variant-numeric: tabular-nums; color: var(--color-accent-strong);
	}
	.neg-step__rule { flex: 1; height: 1px; background: var(--color-rule); }
	.neg-step__top svg {
		width: 1.625rem; height: 1.625rem; flex-shrink: 0;
		color: var(--color-accent); stroke-width: 1.4; opacity: 0.75;
	}
	.neg-step h3 { font-size: var(--text-md); line-height: 1.25; margin-bottom: var(--space-sm); }
	.neg-step p { font-size: 0.9375rem; }
	.neg-step__intro { color: var(--color-ink-2); }
	.neg-step__note {
		margin: auto 0 0; padding-top: var(--space-md);
		border-top: 1px solid var(--color-rule);
		font-weight: 600; color: var(--color-ink);
	}
	.neg-step > :last-child { margin-bottom: 0; }

	/* Shared bullet voice — the site's small rose square mark. */
	.neg-list { list-style: none; margin: 0 0 var(--space-md); padding: 0; display: grid; gap: var(--space-xs); }
	.neg-list li {
		position: relative; padding-left: 1.4rem;
		color: var(--color-ink-2); font-size: 0.9375rem; line-height: 1.6;
	}
	.neg-list li::before {
		content: ""; position: absolute; left: 0; top: 0.62em;
		width: 0.375rem; height: 0.375rem; background: var(--color-accent);
	}

	/* ── 3 · Types we handle — two rule-topped columns (client brief) ── */
	.neg-types { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-2xl); }
	@media (max-width: 47.9375rem) { .neg-types { grid-template-columns: minmax(0, 1fr); gap: var(--space-xl); } }
	.neg-type { border-top: 2px solid var(--color-accent); padding-top: var(--space-md); }
	.neg-type__head { display: flex; align-items: center; gap: var(--space-sm); margin-bottom: var(--space-md); }
	.neg-type__head svg {
		width: 1.75rem; height: 1.75rem; flex-shrink: 0;
		color: var(--color-accent-strong); stroke-width: 1.4;
	}
	.neg-type h3 { font-size: var(--text-md); line-height: 1.3; margin: 0; }
	.neg-type .neg-list { margin-bottom: 0; gap: var(--space-sm); }
	.neg-type .neg-list li { font-size: var(--text-base); }

	.neg-close {
		margin: var(--space-2xl) 0 0; padding-top: var(--space-lg);
		border-top: 1px solid var(--color-rule); max-width: 46rem;
		font-family: var(--font-display); font-weight: 700;
		font-size: var(--text-md); line-height: 1.4;
		letter-spacing: var(--tracking-display); color: var(--color-ink);
	}
</style>

<main id="main">

	<section class="sec neg-why" id="negotiation-why" aria-labelledby="neg-why-title">
		<div class="wrap">
			<div class="split">
				<div>
					<div class="sec-head rv">
						<h2 id="neg-why-title">Why Work With a Negotiation Specialist</h2>
					</div>
					<div class="prose">
						<p class="lead rv" style="--i:1">Negotiations can be stressful, high-pressure, and easy to mishandle. Without a structured approach or clear understanding of leverage, people often concede too much or miss opportunities for better terms.</p>
						<p class="rv" style="--i:2">We bring <strong>objectivity, strategy, and creative problem-solving</strong> to help you secure agreements that are stronger, more profitable, and more durable — while protecting relationships and reducing risk.</p>
					</div>
				</div>
				<figure class="split__media" aria-hidden="true">
					<?php echo Lapin::icon( 'award' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</figure>
			</div>
		</div>
	</section>

	<section class="sec band--cream" id="negotiation-how" aria-labelledby="neg-how-title">
		<div class="wrap">
			<div class="sec-head rv">
				<h2 id="neg-how-title">How We Help</h2>
			</div>
			<ol class="neg-steps" role="list">
				<?php foreach ( $lapin_steps as $lapin_i => $lapin_step ) : ?>
				<li class="neg-step card rv" style="--i:<?php echo esc_attr( $lapin_i % 2 ); ?>">
					<div class="neg-step__top">
						<span class="neg-step__num" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $lapin_i + 1 ) ); ?></span>
						<span class="neg-step__rule" aria-hidden="true"></span>
						<?php echo Lapin::icon( $lapin_step['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</div>
					<h3><?php echo esc_html( $lapin_step['title'] ); ?></h3>
					<p class="neg-step__intro"><?php echo esc_html( $lapin_step['intro'] ); ?></p>
					<?php if ( $lapin_step['bullets'] ) : ?>
					<ul class="neg-list" role="list">
						<?php foreach ( $lapin_step['bullets'] as $lapin_bullet ) : ?>
						<li><?php echo esc_html( $lapin_bullet ); ?></li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
					<?php if ( $lapin_step['note'] ) : ?>
					<p class="neg-step__note"><?php echo esc_html( $lapin_step['note'] ); ?></p>
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<section class="sec sec--tight" id="negotiation-types" aria-labelledby="neg-types-title">
		<div class="wrap">
			<div class="sec-head rv">
				<h2 id="neg-types-title">Types of Negotiations We Handle</h2>
			</div>
			<div class="neg-types">
				<?php foreach ( $lapin_types as $lapin_i => $lapin_type ) : ?>
				<article class="neg-type rv" style="--i:<?php echo esc_attr( $lapin_i ); ?>">
					<div class="neg-type__head">
						<?php echo Lapin::icon( $lapin_type['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<h3><?php echo esc_html( $lapin_type['title'] ); ?></h3>
					</div>
					<ul class="neg-list" role="list">
						<?php foreach ( $lapin_type['items'] as $lapin_item ) : ?>
						<li><?php echo esc_html( $lapin_item ); ?></li>
						<?php endforeach; ?>
					</ul>
				</article>
				<?php endforeach; ?>
			</div>
			<p class="neg-close rv">Whether deal-making or dispute resolution, we help you negotiate with clarity, confidence, and creativity.</p>
		</div>
	</section>

	<?php // Page-specific CTA band — the client's own closing copy in the shared onyx band voice (design.md content law v2.8). ?>
	<section class="cta-band band" aria-labelledby="neg-cta-title">
		<div class="wrap">
			<h2 id="neg-cta-title" class="rv">Schedule a consultation to discuss your matter.</h2>
			<p class="rv" style="--i:1">If you’re preparing for a negotiation — transactional or dispute-related — we can help you approach it with clarity, confidence, and a strategic advantage.</p>
			<div class="cta-band__actions rv" style="--i:2">
				<a class="btn btn--gold" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Schedule a Consultation</a>
				<a class="btn btn--light" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call Now — <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
			</div>
		</div>
	</section>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
