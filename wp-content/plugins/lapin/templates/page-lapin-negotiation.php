<?php
/**
 * Negotiation (/negotiation/) — client copy revision 2 + design notes, 2026-09-05
 * (Raphael's second "NEGOTIATION SERVICES PAGE Revision" doc, used verbatim per
 * the content law; his three design notes are folded in — see design.md v2.9).
 *
 * The service family's Split Studio opens the page (Why work with a specialist),
 * then the rhythm breaks: a cream band of four stage cards for "How We Help"
 * (ASSESS · DESIGN · ADVISE · REPRESENT), a two-column rule-topped pair for the
 * types we handle, and the client's own CTA copy in the shared onyx band voice.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'Negotiation Services | Strategy, Advice & Representation | Lapin Negotiation Services',
	'desc'       => 'Strategic negotiation advice, support and representation for transactional negotiations and the resolution of conflicts and disputes. Assess leverage, design strategy, negotiate from a stronger position. Free consultation.',
	'path'       => 'negotiation/',
	'nav'        => 'negotiation',
	'body_class' => 'page-negotiation',
	'hero'       => array(
		'eyebrow'   => 'Negotiation Services',
		'title'     => 'Strategic Negotiation Support for High-Stakes Matters',
		'statement' => 'Clear Strategy. Creative Solutions. Stronger Outcomes.',
		'lede'      => 'Strategic negotiation advice, support, and representation for transactional negotiations and the resolution of conflicts and disputes.',
		'cta'       => 'Free Consultation',
	),
	'schema'     => array(
		array(
			'@type'       => 'Service',
			'name'        => 'Negotiation Services',
			'provider'    => array( '@id' => home_url( '/' ) . '#organization' ),
			'serviceType' => 'Negotiation strategy, advice, support and representation',
			'areaServed'  => 'Southern California',
		),
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';

// "How We Help" — the client's four stages. 'label' is the copper stage word
// (client 2026-09-05: word headings replace the 01–04 numerals, same position,
// same colour, accent rule kept). 'intro2' carries a second lead paragraph.
$lapin_steps = array(
	array(
		'label'   => 'Assess',
		'icon'    => 'target',
		'title'   => 'Assess Risks, Leverage & Objectives',
		'intro'   => 'We begin by mapping the negotiation landscape:',
		'intro2'  => '',
		'bullets' => array(
			'Your goals, priorities, and constraints',
			'The other party’s interests and pressures',
			'Sources of leverage and areas of risk',
			'Relationship dynamics and communication challenges',
		),
		'note'    => 'This provides a clear strategic foundation for the negotiation.',
	),
	array(
		'label'   => 'Design',
		'icon'    => 'lightbulb',
		'title'   => 'Design a Tailored Strategy & Creative Solutions',
		'intro'   => 'We develop a structured negotiation strategy designed around your circumstances and objectives.',
		'intro2'  => 'A central part of our approach is identifying creative, interest-based solutions that can expand available options and create pathways that might otherwise be overlooked, including:',
		'bullets' => array(
			'Innovative deal structures',
			'Alternative concessions and trade-offs',
			'Non-financial sources of value',
			'Strategic reframing of difficult issues',
		),
		'note'    => 'The objective is not simply to compromise, but to identify solutions that advance your interests while creating an agreement the other side can accept.',
	),
	array(
		'label'   => 'Advise',
		'icon'    => 'messages-square',
		'title'   => 'Strategic Advice & Support Throughout the Negotiation',
		'intro'   => 'We provide ongoing support as the negotiation develops, including:',
		'intro2'  => '',
		'bullets' => array(
			'Preparation for meetings and calls',
			'Guidance on messaging and communication',
			'Strategic advice as circumstances change',
			'Debriefs and strategy adjustments',
			'Assistance evaluating proposals and counterproposals',
		),
		'note'    => 'You have experienced strategic counsel from preparation through resolution.',
	),
	array(
		'label'   => 'Represent',
		'icon'    => 'user-round-check',
		'title'   => 'Representation When Needed',
		'intro'   => 'For complex, sensitive, or high-stakes matters, we can represent you directly in the negotiation.',
		'intro2'  => 'Professional representation brings seasoned expertise and disciplined strategy to negotiations where experience, credibility, and presence can make a measurable difference.',
		'bullets' => array(),
		'note'    => 'Whether working behind the scenes or directly at the negotiating table, our role is to strengthen your position, manage the process, and pursue the best achievable outcome.',
	),
);

// "Types of Negotiations We Handle Include:" — the client's two-column split.
$lapin_types = array(
	array(
		'icon'  => 'handshake',
		'title' => 'Transactional Negotiations',
		'items' => array(
			'Business deals and commercial agreements',
			'Contract renewals and renegotiations',
			'Partnership agreements',
			'Vendor and supplier negotiations',
			'Real estate and transactional matters',
			'Senior-level employment and compensation agreements',
		),
	),
	array(
		'icon'  => 'scale',
		'title' => 'Settlement Negotiations in Conflicts & Disputes',
		'items' => array(
			'Business, partnership, and shareholder disputes',
			'Trust and Estate disputes',
			'Judgement Settlements',
			'Workplace conflicts',
			'Family business and interpersonal disputes',
			'Contract and commercial disputes',
			'Sensitive personal matters requiring discretion',
		),
	),
);
?>
<style>
	/* Hallmark · macrostructure: Split Studio → stepped studio (service family, design.md v2.9)
	 * theme: locked Lapin system · genre: editorial-corporate · nav/footer: shared
	 * pre-emit critique: P5 H5 E5 S5 R5 V4
	 */

	/* Hero: the client's H1 runs long — hold it to three lines on desktop. Its
	   size now comes from --text-hero-page, which floors at the home hero's
	   mobile size so no subpage title outgrows it on a phone. */
	.page-negotiation .hero--page h1 { max-width: 20ch; }

	/* ── 1 · Why work with a specialist (retained Split Studio voice) ───
	   Both paragraphs share the opening paragraph's size (client 2026-09-05). */
	.neg-why .prose p { font-size: var(--text-md); line-height: 1.55; }
	.neg-why .prose p:last-child { margin-bottom: 0; }

	/* ── 2 · How we help — four stage cards on the cream band ────────── */
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
	/* Stage word in the copper the 01–04 numerals used to carry. */
	.neg-step__label {
		font-family: var(--font-display); font-weight: 700;
		font-size: var(--text-sm); line-height: 1;
		letter-spacing: var(--tracking-label); text-transform: uppercase;
		color: var(--color-accent-strong); white-space: nowrap;
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

	/* ── 4 · CTA — the client's closing ask, above the button row ────── */
	.neg-cta__ask {
		font-family: var(--font-display); font-weight: 700;
		font-size: var(--text-md); line-height: 1.4;
		letter-spacing: var(--tracking-display);
		color: var(--color-gold); margin-bottom: var(--space-lg);
	}
</style>

<main id="main">

	<section class="sec neg-why" id="negotiation-why" aria-labelledby="neg-why-title">
		<div class="wrap">
			<div class="split">
				<div>
					<div class="sec-head rv">
						<h2 id="neg-why-title">Why Work with a Negotiation Specialist</h2>
					</div>
					<div class="prose">
						<p class="rv" style="--i:1">Important negotiations can be complex, high-pressure, and consequential. Without a structured strategy or a clear understanding of leverage, parties can concede unnecessarily, overlook opportunities, or accept terms that fail to serve their broader interests.</p>
						<p class="rv" style="--i:2">We bring objectivity, disciplined strategy, and creative problem-solving to help you pursue stronger, more advantageous, and more durable agreements, while protecting relationships and managing risk.</p>
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
						<?php // Stage word duplicates the heading below it — hidden from screen readers. ?>
						<span class="neg-step__label" aria-hidden="true"><?php echo esc_html( $lapin_step['label'] ); ?></span>
						<span class="neg-step__rule" aria-hidden="true"></span>
						<?php echo Lapin::icon( $lapin_step['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					</div>
					<h3><?php echo esc_html( $lapin_step['title'] ); ?></h3>
					<p class="neg-step__intro"><?php echo esc_html( $lapin_step['intro'] ); ?></p>
					<?php if ( $lapin_step['intro2'] ) : ?>
					<p class="neg-step__intro"><?php echo esc_html( $lapin_step['intro2'] ); ?></p>
					<?php endif; ?>
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
				<h2 id="neg-types-title">Types of Negotiations We Handle Include:</h2>
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
			<p class="neg-close rv">Whether negotiating a deal or resolving a dispute, we help you approach consequential negotiations with clarity, confidence, and disciplined strategy.</p>
		</div>
	</section>

	<?php // Page-specific CTA band — the client's own closing copy in the shared onyx band voice (design.md content law v2.9). ?>
	<section class="cta-band band" aria-labelledby="neg-cta-title">
		<div class="wrap">
			<h2 id="neg-cta-title" class="rv">Approach Your Next Negotiation Strategically</h2>
			<p class="rv" style="--i:1">If you are preparing for an important negotiation &mdash; transactional or dispute-related &mdash; we can help you assess your position, develop your strategy, and determine the most effective path forward.</p>
			<p class="neg-cta__ask rv" style="--i:2">Schedule a consultation to discuss your matter.</p>
			<div class="cta-band__actions rv" style="--i:3">
				<a class="btn btn--gold" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Schedule a Consultation</a>
				<a class="btn btn--light" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call Now &mdash; <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
			</div>
		</div>
	</section>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
