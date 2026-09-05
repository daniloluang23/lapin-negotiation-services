<?php
/**
 * Dispute Resolution (/dispute-resolution/) — client copy replacement
 * 2026-09-05 (Raphael's "Dispute Resolution Page" doc + the matching page-design
 * brief, used verbatim per the content law).
 *
 * Matched to the /negotiation/ page's Stepped Studio: masthead hero → a cream
 * band of "How We Help" cards → the boxed mediation distinction → a three-column
 * "Who This Is For" grid → the Outcome bar → the client's own CTA copy in the
 * shared onyx band voice. The locked system (design.md) supplies every token.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'Dispute Resolution | Stabilizing Escalated Conflict | Lapin Negotiation Services',
	'desc'       => 'A structured, neutral process for escalated conflict — stabilize escalation, reopen channels of interaction, and build a workable pathway toward resolution. Free consultation.',
	'path'       => 'dispute-resolution/',
	'nav'        => 'dispute-resolution',
	'body_class' => 'page-dispute-resolution',
	'hero'       => array(
		'eyebrow' => 'Dispute Resolution',
		'title'   => 'Dispute Resolution When Conflict Escalates',
		'lede'    => 'We introduce a structured process so parties can move from impasse to resolution.',
		'cta'     => 'Free Consultation',
	),
	'schema'     => array(
		array(
			'@type'       => 'Service',
			'name'        => 'Dispute Resolution',
			'provider'    => array( '@id' => home_url( '/' ) . '#organization' ),
			'serviceType' => 'Conflict stabilization, facilitated dialogue, shuttle diplomacy and dispute resolution',
			'areaServed'  => 'Southern California',
		),
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';

// "How We Help" — the client's six capabilities; card titles exactly as briefed.
$lapin_help = array(
	array(
		'icon'  => 'shield',
		'title' => 'Stabilize Escalation',
		'body'  => 'When conflict intensifies and positions harden, we help parties regain footing. The aim is to reduce volatility, restore clarity, and create conditions where productive movement becomes possible again.',
	),
	array(
		'icon'  => 'network',
		'title' => 'Reopen Interaction Channels',
		'body'  => 'We re-establish contact, rebuild backchannels, and create structured pathways for information to flow. This includes guided exchanges, reframing, and sequencing to prevent further escalation.',
	),
	array(
		'icon'  => 'layers',
		'title' => 'Create Neutral Structure',
		'body'  => 'Conflict accelerates in ambiguity. We introduce a clear, neutral process that outlines what will happen next, how issues will be addressed, and how decisions will be made.',
	),
	array(
		'icon'  => 'messages-square',
		'title' => 'Facilitate Dialogue & Shuttle Diplomacy',
		'body'  => 'Depending on the situation, we work through joint discussions or private caucus-style communication. The goal is to reduce misinterpretation, clarify interests, and move parties toward constructive engagement.',
	),
	array(
		'icon'  => 'target',
		'title' => 'Strategic Guidance Through Impasse',
		'body'  => 'When parties feel stuck, we help identify underlying drivers, reframe issues, and explore alternative pathways forward. This includes insight into negotiation dynamics, structural barriers, and practical options.',
	),
	array(
		'icon'  => 'handshake',
		'title' => 'Durable Resolution',
		'body'  => 'Once stability and forward movement are restored, we guide parties toward agreements that are clear, workable, and sustainable.',
	),
);

// "Who This Is For" — the client copy doc's full list. The design brief's shorter
// echo drops four situations; the superset is kept per the content law.
$lapin_for = array(
	'Workplace conflict',
	'Partnership disputes',
	'Co-founder or leadership breakdowns',
	'Team or departmental friction',
	'Escalated interpersonal disputes',
	'Family business disputes',
	'Trust & Estate disputes',
	'Litigated disputes',
	'Situations where parties cannot speak directly',
	'Conflicts where mediation is not yet viable',
);

// "Outcome" — the three-part closing bar.
$lapin_outcomes = array( 'Stabilized Conflict', 'Reopened Interaction', 'Clear Path Forward' );
?>
<style>
	/* Hallmark · macrostructure: Split Studio → stepped studio (service family, design.md v2.10)
	 * theme: locked Lapin system · genre: editorial-corporate · nav/footer: shared
	 * pre-emit critique: P5 H5 E4 S5 R5 V4
	 */

	/* ── 1 · How we help — six cards on the cream band ───────────────── */
	.dr-help {
		list-style: none; margin: var(--space-xl) 0 0; padding: 0;
		display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));
		gap: var(--space-lg);
	}
	@media (max-width: 63.9375rem) { .dr-help { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
	@media (max-width: 47.9375rem) { .dr-help { grid-template-columns: minmax(0, 1fr); } }

	/* .card supplies the paper fill, hairline and hover lift; the rose top edge
	   is the only accent per card, keeping rose gold well inside the 5% budget. */
	.dr-card {
		display: flex; flex-direction: column;
		padding: var(--space-lg);
		border-top: 3px solid var(--color-accent);
	}
	/* Same head rhythm as the negotiation stage cards (icon + hairline lead-out),
	   without their stage word — these six are parallel capabilities, not stages. */
	.dr-card__top { display: flex; align-items: center; gap: var(--space-md); margin-bottom: var(--space-md); }
	.dr-card__top svg {
		width: 1.625rem; height: 1.625rem; flex-shrink: 0;
		color: var(--color-accent); stroke-width: 1.4; opacity: 0.75;
	}
	.dr-card__rule { flex: 1; height: 1px; background: var(--color-rule); }
	.dr-card h3 {
		font-size: var(--text-md); line-height: 1.25; margin-bottom: var(--space-sm);
		overflow-wrap: anywhere; min-width: 0;
	}
	.dr-card p { font-size: 0.9375rem; margin-bottom: 0; }

	/* ── 2 · How this differs from mediation — one shaded box ────────── */
	.dr-distinct {
		background: var(--color-paper-2);
		border: 1px solid var(--color-rule);
		border-top: 3px solid var(--color-accent);
		border-radius: var(--radius-card);
		padding: var(--space-xl);
	}
	.dr-distinct p {
		margin-bottom: 0; font-size: var(--text-md); line-height: 1.6;
		color: var(--color-ink-2);
	}
	@media (max-width: 47.9375rem) { .dr-distinct { padding: var(--space-lg); } }

	/* ── 3 · Who this is for — three-column bullet grid ──────────────── */
	.dr-for {
		list-style: none; margin: 0; padding: 0;
		display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));
		gap: var(--space-sm) var(--space-xl);
	}
	@media (max-width: 63.9375rem) { .dr-for { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
	@media (max-width: 40rem) { .dr-for { grid-template-columns: minmax(0, 1fr); } }
	/* Shared bullet voice — the site's small rose square mark. */
	.dr-for li {
		position: relative; padding-left: 1.4rem; min-width: 0;
		color: var(--color-ink-2); font-size: var(--text-base); line-height: 1.6;
	}
	.dr-for li::before {
		content: ""; position: absolute; left: 0; top: 0.62em;
		width: 0.375rem; height: 0.375rem; background: var(--color-accent);
	}

	/* ── 4 · Outcome — three equal blocks, thin separators ───────────── */
	.dr-outcome {
		list-style: none; margin: var(--space-xl) 0 0; padding: 0;
		display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));
		border-top: 1px solid color-mix(in srgb, var(--color-ink) 16%, transparent);
	}
	.dr-outcome li {
		padding: var(--space-lg) var(--space-md); min-width: 0;
		font-family: var(--font-display); font-weight: 700;
		font-size: var(--text-md); line-height: 1.3;
		letter-spacing: var(--tracking-display); color: var(--color-ink);
		overflow-wrap: anywhere;
	}
	.dr-outcome li:first-child { padding-left: 0; }
	.dr-outcome li + li { border-left: 1px solid color-mix(in srgb, var(--color-ink) 16%, transparent); }
	@media (max-width: 47.9375rem) {
		.dr-outcome { grid-template-columns: minmax(0, 1fr); }
		.dr-outcome li { padding-inline: 0; }
		.dr-outcome li + li {
			border-left: 0;
			border-top: 1px solid color-mix(in srgb, var(--color-ink) 16%, transparent);
		}
	}
</style>

<main id="main">

	<section class="sec band--cream" id="dispute-resolution-how" aria-labelledby="dr-how-title">
		<div class="wrap">
			<div class="sec-head rv">
				<h2 id="dr-how-title">How We Help</h2>
			</div>
			<p class="lead rv" style="--i:1">A structured, neutral process designed to stabilize escalation and restore forward movement.</p>
			<ul class="dr-help" role="list">
				<?php foreach ( $lapin_help as $lapin_i => $lapin_item ) : ?>
				<li class="dr-card card rv" style="--i:<?php echo esc_attr( $lapin_i % 3 ); ?>">
					<div class="dr-card__top">
						<?php echo Lapin::icon( $lapin_item['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<span class="dr-card__rule" aria-hidden="true"></span>
					</div>
					<h3><?php echo esc_html( $lapin_item['title'] ); ?></h3>
					<p><?php echo esc_html( $lapin_item['body'] ); ?></p>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="sec" id="dispute-resolution-distinct" aria-labelledby="dr-distinct-title">
		<div class="wrap">
			<div class="sec-head rv">
				<h2 id="dr-distinct-title">How This Differs From Mediation</h2>
			</div>
			<div class="dr-distinct rv" style="--i:1">
				<p>This service focuses on stabilizing escalation, rebuilding communication, and creating the structure needed for productive engagement. It is broader than mediation and is designed for situations where parties are not yet ready, able, or willing to participate in a mediated process.</p>
			</div>
		</div>
	</section>

	<section class="sec sec--tight" id="dispute-resolution-who" aria-labelledby="dr-who-title">
		<div class="wrap">
			<div class="sec-head rv">
				<h2 id="dr-who-title">Who This Is For</h2>
			</div>
			<ul class="dr-for rv" style="--i:1" role="list">
				<?php foreach ( $lapin_for as $lapin_item ) : ?>
				<li><?php echo esc_html( $lapin_item ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="sec sec--tight band--cream" id="dispute-resolution-outcome" aria-labelledby="dr-outcome-title">
		<div class="wrap">
			<div class="sec-head rv">
				<h2 id="dr-outcome-title">Outcome</h2>
			</div>
			<p class="lead rv" style="--i:1">A stabilized conflict, restored channels of interaction, and a clear pathway toward resolution — whether through mediation, negotiation, or facilitated agreement-building.</p>
			<ul class="dr-outcome rv" style="--i:2" role="list">
				<?php foreach ( $lapin_outcomes as $lapin_item ) : ?>
				<li><?php echo esc_html( $lapin_item ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<?php // Page-specific CTA band — the client's own closing copy in the shared onyx band voice (design.md content law v2.9). ?>
	<section class="cta-band band" aria-labelledby="dr-cta-title">
		<div class="wrap">
			<h2 id="dr-cta-title" class="rv">Ready to stabilize the conflict and move it forward?</h2>
			<div class="cta-band__actions rv" style="--i:1">
				<a class="btn btn--gold" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Schedule a Consultation</a>
				<a class="btn btn--light" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call Now — <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
			</div>
		</div>
	</section>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
