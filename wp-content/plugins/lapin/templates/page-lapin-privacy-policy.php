<?php
/**
 * Privacy Policy (/privacy-policy/) — Long Document. Discloses the site's data
 * practices (contact form + Google Analytics 4) and the California CCPA/CPRA
 * rights, including the opt-out honored by the cookie banner. The
 * #your-privacy-choices anchor is the target of the footer "Your Privacy
 * Choices" control.
 *
 * This is a good-faith baseline; it should be reviewed by counsel before
 * launch. Business facts are pulled from the Lapin class so they stay in sync.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'Privacy Policy | Lapin Negotiation Services',
	'desc'       => 'How Lapin Negotiation Services collects, uses, and protects your information, and the privacy rights available to California residents.',
	'path'       => 'privacy-policy/',
	'nav'        => '',
	'body_class' => 'page-legal',
	'hero'       => array(
		'eyebrow' => 'Legal',
		'title'   => 'Privacy Policy',
		'lede'    => 'How we handle the information you share with us, and the choices you have.',
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';
?>
<style>
	.legal section { padding-block: var(--space-2xl) 0; scroll-margin-top: 6rem; }
	.legal section:first-child { padding-top: var(--space-3xl); }
	.legal .legal-meta { color: var(--color-muted); font-size: var(--text-sm); margin-bottom: 0; }
	.legal h2 { font-size: var(--text-xl); margin-bottom: var(--space-sm); }
	.legal h3 { font-size: var(--text-md); margin: var(--space-lg) 0 var(--space-xs); }
	.legal p, .legal li { color: var(--color-ink-2); }
	.legal ul { padding-left: 1.25rem; margin: 0 0 var(--space-md); }
	.legal li { margin-bottom: var(--space-xs); }
	.legal a { text-decoration: underline; text-underline-offset: 2px; text-decoration-color: var(--color-accent); }
	.legal table { width: 100%; border-collapse: collapse; margin: 0 0 var(--space-md); font-size: 0.9375rem; }
	.legal th, .legal td { text-align: left; vertical-align: top; padding: var(--space-sm); border: 1px solid var(--color-rule); }
	.legal th { background: var(--color-paper-2); color: var(--color-ink); font-weight: 600; }
	.legal .table-scroll { overflow-x: auto; }
</style>

<main id="main">
	<div class="wrap wrap--narrow">
		<div class="legal prose">
			<section>
				<p class="legal-meta">Last updated: July 22, 2026</p>
				<p><?php echo esc_html( Lapin::NAME ); ?> (&ldquo;we,&rdquo; &ldquo;us,&rdquo; or &ldquo;our&rdquo;) respects your privacy. This Privacy Policy explains what information we collect when you visit <?php echo esc_html( wp_parse_url( home_url(), PHP_URL_HOST ) ); ?> or contact us, how we use it, and the rights and choices you have — including the rights of California residents under the California Consumer Privacy Act (CCPA), as amended by the California Privacy Rights Act (CPRA).</p>
			</section>

			<section id="information-we-collect">
				<h2>Information we collect</h2>
				<h3>Information you give us</h3>
				<p>When you submit our contact form or email us, we collect the details you choose to provide — typically your name, email address, phone number, and the contents of your message. You control what you send us.</p>
				<h3>Information collected automatically</h3>
				<p>When you visit the site, our analytics provider automatically collects standard technical and usage information through cookies and similar technologies, such as your IP address (often truncated), device and browser type, pages viewed, referring pages, and general location inferred from your IP. We use Google Analytics 4 for this purpose.</p>
			</section>

			<section id="cookies-and-analytics">
				<h2>Cookies and analytics</h2>
				<p>Cookies are small files stored on your device. We use them only to measure and improve how the site performs. We do not use cookies for cross-site advertising.</p>
				<ul>
					<li><strong>Essential:</strong> required for the site and its forms to work. These are always on.</li>
					<li><strong>Analytics (Google Analytics 4):</strong> help us understand which pages are useful. These are optional.</li>
				</ul>
				<p>You can accept or reject analytics cookies at any time using the banner on your first visit or the <a href="#your-privacy-choices">Your Privacy Choices</a> control in the footer. If you reject, we disable Google Analytics for your visit and do not set analytics cookies. We also honor Global Privacy Control (GPC) browser signals as a valid opt-out (see <a href="#your-privacy-choices">Your Privacy Choices</a>). You can learn how Google uses data at <a href="https://policies.google.com/technologies/partner-sites" rel="noopener" target="_blank">policies.google.com/technologies/partner-sites</a>.</p>
			</section>

			<section id="how-we-use">
				<h2>How we use your information</h2>
				<ul>
					<li>To respond to your inquiries and provide our services.</li>
					<li>To operate, maintain, and improve the site.</li>
					<li>To understand aggregate usage through analytics.</li>
					<li>To protect against spam, fraud, and abuse.</li>
					<li>To comply with legal obligations.</li>
				</ul>
			</section>

			<section id="how-we-share">
				<h2>How we share information</h2>
				<p>We do <strong>not</strong> sell your personal information, and we do not share it for cross-context behavioral advertising. We disclose information only to:</p>
				<ul>
					<li><strong>Service providers</strong> who act on our behalf — for example, Google (analytics) and our web hosting and email providers — bound to use it only to provide their service to us.</li>
					<li><strong>Legal and safety</strong> recipients when required by law or to protect our rights, safety, or property.</li>
				</ul>
			</section>

			<section id="retention">
				<h2>Data retention</h2>
				<p>We keep contact-form messages only as long as needed to respond to and administer your inquiry, then delete or archive them. Analytics data is retained according to our Google Analytics configuration and Google&rsquo;s retention settings.</p>
			</section>

			<section id="your-privacy-choices">
				<h2>Your privacy choices &amp; California rights</h2>
				<p>If you are a California resident, the CCPA/CPRA gives you the right to:</p>
				<ul>
					<li><strong>Know</strong> what personal information we collect, use, and disclose.</li>
					<li><strong>Access</strong> and obtain a copy of your personal information.</li>
					<li><strong>Delete</strong> personal information we hold about you.</li>
					<li><strong>Correct</strong> inaccurate personal information.</li>
					<li><strong>Opt out</strong> of the &ldquo;sale&rdquo; or &ldquo;sharing&rdquo; of personal information.</li>
					<li><strong>Non-discrimination</strong> for exercising any of these rights.</li>
				</ul>
				<p>We do not sell your personal information. Because analytics may be considered &ldquo;sharing&rdquo; under California law, you can opt out at any time by selecting <strong>Reject</strong> in the cookie banner, which you can reopen with the <a href="#your-privacy-choices" data-lapin-privacy-choices>Your Privacy Choices</a> link in the footer. We also treat an enabled <strong>Global Privacy Control</strong> signal as a request to opt out.</p>
				<div class="table-scroll">
					<table>
						<thead>
							<tr><th scope="col">Category</th><th scope="col">Examples</th><th scope="col">Collected</th></tr>
						</thead>
						<tbody>
							<tr><td>Identifiers</td><td>Name, email, phone, IP address</td><td>Yes</td></tr>
							<tr><td>Internet / network activity</td><td>Pages viewed, referring pages, device and browser</td><td>Yes</td></tr>
							<tr><td>Geolocation</td><td>General location inferred from IP</td><td>Yes</td></tr>
							<tr><td>Sensitive personal information</td><td>&mdash;</td><td>No</td></tr>
						</tbody>
					</table>
				</div>
				<p>To exercise your rights to know, access, delete, or correct, contact us using the details below. We will verify your request and respond within the timeframes required by law. You may use an authorized agent to submit a request on your behalf.</p>
			</section>

			<section id="children">
				<h2>Children&rsquo;s privacy</h2>
				<p>This site is intended for adults and is not directed to children under 16. We do not knowingly collect personal information from children under 16.</p>
			</section>

			<section id="third-party-links">
				<h2>Third-party links</h2>
				<p>Our site may link to third-party websites (for example, media interviews or social profiles). We are not responsible for the privacy practices of those sites; please review their policies.</p>
			</section>

			<section id="security">
				<h2>Security</h2>
				<p>We use reasonable administrative and technical measures to protect your information. No method of transmission or storage is completely secure, so we cannot guarantee absolute security.</p>
			</section>

			<section id="changes">
				<h2>Changes to this policy</h2>
				<p>We may update this Privacy Policy from time to time. When we do, we will revise the &ldquo;Last updated&rdquo; date above.</p>
			</section>

			<section id="contact">
				<h2>Contact us</h2>
				<p>Questions or requests about this policy or your personal information:</p>
				<ul>
					<li>Email: <a href="mailto:<?php echo esc_attr( Lapin::EMAIL ); ?>"><?php echo esc_html( Lapin::EMAIL ); ?></a></li>
					<li>Phone: <a href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>"><?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a> &middot; Toll-free <a href="tel:<?php echo esc_attr( Lapin::PHONE_FREE_TEL ); ?>"><?php echo esc_html( Lapin::PHONE_FREE ); ?></a></li>
					<li>Mail: <?php echo esc_html( Lapin::address_line() ); ?></li>
				</ul>
			</section>
		</div>
	</div>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
