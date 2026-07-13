<?php
/**
 * Dispute Resolution — Split Studio. Copy retained verbatim; the live
 * page's ◆ bullet paragraphs become a proper list.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'Dispute Resolution Services | Avoid the Costs of Court | Lapin Negotiation Services',
	'desc'       => 'Resolve disputes without costly litigation. Settlement negotiation advice, coaching and agent representation from trained mediators with years of dispute resolution experience.',
	'path'       => 'dispute-resolution/',
	'nav'        => 'dispute-resolution',
	'body_class' => 'page-dispute-resolution',
	'schema'     => array(
		array(
			'@type'       => 'Service',
			'name'        => 'Dispute Resolution Services',
			'provider'    => array( '@id' => home_url( '/' ) . '#organization' ),
			'serviceType' => 'Alternative dispute resolution, settlement negotiation advice and representation',
			'areaServed'  => 'Southern California',
		),
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';

$lapin_hero = array(
	'title' => 'Dispute Resolution Services',
	'lede'  => 'Free consultation with a specialist — call ' . Lapin::PHONE_LOCAL . ' or toll-free ' . Lapin::PHONE_FREE . '.',
);
?>
<style>
	.svc-list { list-style: none; margin: 0 0 var(--space-md); padding: 0; }
	.svc-list li { position: relative; padding-left: 1.5rem; margin-bottom: var(--space-sm); color: var(--color-ink-2); }
	.svc-list li::before { content: ""; position: absolute; left: 0; top: 0.55em; width: 0.5rem; height: 0.5rem; background: var(--color-accent); }
	.sec + .sec { border-top: 1px solid var(--color-rule); }
	/* Text-only sections: match the 65% text column of the split sections. */
	@media (min-width: 60rem) {
		#dispute-resolution-settlement-advice .sec-head,
		#dispute-resolution-settlement-advice .prose,
		#dispute-resolution-why-a-specialist .sec-head,
		#dispute-resolution-why-a-specialist .svc-list { max-width: calc(65% - 2.6rem); }
	}
</style>

<main id="main">
	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-page-hero.php'; ?>

	<section class="sec" id="dispute-resolution-out-of-court">
		<div class="wrap">
			<div class="split">
				<div>
					<div class="sec-head">
						<h2>Avoid the costs of court</h2>
					</div>
					<div class="prose">
						<p class="lead">Are you involved in a dispute and considering taking legal action?</p>
						<p>Litigation can be costly, time-consuming, and emotionally draining, and the outcome is often uncertain.</p>
						<p>Consider alternative dispute resolution (ADR) methods, which can be faster, cheaper, and less stressful, and can also help preserve relationships between the parties.</p>
						<p>A dispute resolution specialist can facilitate communication and assist in finding a fair and satisfactory resolution, especially in cases where the parties need to continue interacting after the dispute is resolved.</p>
						<p>Our specialists are trained mediators with years of experience in dispute resolution.</p>
					</div>
				</div>
				<figure class="split__media" aria-hidden="true">
					<?php echo Lapin::icon( 'messages-square' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</figure>
			</div>
		</div>
	</section>

	<section class="sec" id="dispute-resolution-settlement-advice">
		<div class="wrap">
			<div class="sec-head">
				<h2>Settlement negotiation advice and coaching</h2>
			</div>
			<div class="prose">
				<p class="lead">If you choose to use direct negotiation to resolve your dispute, it may be helpful to seek behind-the-scenes guidance from one of our dispute resolution specialists.</p>
				<p>They can help you prepare for the negotiation, design a negotiation strategy, communicate effectively with the other side, handle aggressive behavior, explore settlement options, and support you throughout the process.</p>
				<p>With the help of a specialist, you can increase your chances of reaching a successful resolution and minimize the time and effort required to resolve the dispute.</p>
				<p>Contact us today to schedule a free consultation and learn more about how we can help you.</p>
			</div>
		</div>
	</section>

	<section class="sec" id="dispute-resolution-settlement-agent">
		<div class="wrap">
			<div class="split split--flip">
				<figure class="split__media" aria-hidden="true">
					<?php echo Lapin::icon( 'users' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</figure>
				<div>
					<div class="sec-head">
						<h2>Settlement negotiation agent</h2>
					</div>
					<div class="prose">
						<p class="lead">Are you struggling to negotiate a resolution to a dispute because you’re too emotionally invested or don’t want to communicate with the other party due to past negativity or harmful dynamics in the relationship?</p>
						<p>A dispute resolution specialist can help. By retaining an agent to represent you and handle the negotiations, you can maintain a healthy distance from the process while still having control over the settlement decisions. Avoid costly and time-consuming litigation by seeking the expertise of a dispute resolution specialist to act as your agent and negotiate on your behalf.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="sec" id="dispute-resolution-why-a-specialist">
		<div class="wrap">
			<div class="sec-head">
				<h2>Why a dispute resolution specialist?</h2>
			</div>
			<ul class="svc-list">
				<li>A dispute resolution specialist can help you generate innovative solutions that create value, while a lawyer will typically only approach the dispute from a legal perspective.</li>
				<li>They are trained to address all dimensions of the dispute, including legal, emotional, and psychological aspects.</li>
				<li>They are more cost-effective than ongoing legal fees and court costs.</li>
				<li>They work hard to resolve disputes through negotiation, which leads to more compliant and durable agreements than court-ordered stipulations.</li>
				<li>If negotiation with a dispute resolution specialist fails, mediation, arbitration, or litigation are still options for resolving the dispute.</li>
				<li>By hiring a dispute resolution specialist, you can start with less costly and contentious options and escalate to more expensive and adversarial methods if needed. When you hire a lawyer, you immediately launch the most costly and contentious process, which is difficult to de-escalate.</li>
			</ul>
		</div>
	</section>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
