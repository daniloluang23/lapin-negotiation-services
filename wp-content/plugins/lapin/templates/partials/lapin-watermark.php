<?php
/**
 * Whole-page corner-sweep watermark — fans of thin, smooth quadratic curves
 * sweeping up from the bottom-left and bottom-right corners, fading toward the
 * outer curves. Ported verbatim from the design handoff
 * (claude-design/design_handoff_watermark/ — buildFan() is the source of truth).
 *
 * Hand-drawn as an INLINE SVG: no image request. Fixed behind the whole page;
 * onyx bands / CTA / footer cover it. Reused on Contact, About and Practice
 * Areas. Line strength tunable per page via --watermark-opacity. Decorative.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * A fan of nested quadratic sweeps hugging one bottom corner, fading outward.
 * Canvas is the handoff's 1900×630; the SVG stretches to fill (preserveAspectRatio="none").
 */
$lapin_wm_fan = static function ( string $corner, int $count, float $spread, float $reach, float $opacity ): string {
	$w   = 1900.0;
	$h   = 630.0;
	$den = max( $count - 1, 1 );
	$out = '';
	for ( $i = 0; $i < $count; $i++ ) {
		$t = $i / $den;
		// Spacing widens slightly toward the outer curves.
		$k = 0.06 + 0.94 * pow( $t, 1.15 );
		$s = $spread * $k; // height up the side edge
		$x = $reach * $k;  // distance along the bottom edge
		if ( 'left' === $corner ) {
			$d = sprintf( 'M 0 %.1f Q %.1f %.1f %.1f 630', $h - $s, $x * 0.18, $h - $s * 0.16, $x );
		} else {
			$d = sprintf( 'M 1900 %.1f Q %.1f %.1f %.1f 630', $h - $s, $w - $x * 0.18, $h - $s * 0.16, $w - $x );
		}
		$o    = $opacity * ( 1 - 0.55 * $t ); // outer lines fade
		$out .= sprintf( '<path d="%s" opacity="%.3f"/>', $d, $o );
	}
	return $out;
};

// Desktop fans — handoff buildFan geometry verbatim: left 26 / spread 560 / reach
// 620; right 1.15× count / spread 660 / reach 900. Per-line base opacity kept at
// 1.0 (handoff is 0.5; raised for the client's "more visible" request 2026-07-23).
$lapin_wm_left  = $lapin_wm_fan( 'left', 26, 560.0, 620.0, 1.0 );
$lapin_wm_right = $lapin_wm_fan( 'right', (int) round( 26 * 1.15 ), 660.0, 900.0, 1.0 );

/**
 * Mobile fan — a single bottom-right sweep on its own tall 390×840 canvas
 * (design handoff `buildMobileFan`). Drawn for a narrow, tall viewport so the
 * curves stay a shallow corner sweep instead of the wide desktop fan stretching
 * into vertical slivers. Count is 0.7× the desktop count, per the handoff.
 */
$lapin_wm_mobile_fan = static function ( int $count, float $opacity ): string {
	$den = max( $count - 1, 1 );
	$out = '';
	for ( $i = 0; $i < $count; $i++ ) {
		$t = $i / $den;
		$k = 0.06 + 0.94 * pow( $t, 1.15 );
		$s = 300.0 * $k; // height up the right edge (canvas H = 840)
		$x = 360.0 * $k; // reach along the bottom edge (canvas W = 390)
		$d = sprintf( 'M 390 %.1f Q %.1f %.1f %.1f 840', 840 - $s, 390 - $x * 0.18, 840 - $s * 0.16, 390 - $x );
		$out .= sprintf( '<path d="%s" opacity="%.3f"/>', $d, $opacity * ( 1 - 0.55 * $t ) );
	}
	return $out;
};
$lapin_wm_mobile = $lapin_wm_mobile_fan( (int) round( 26 * 0.7 ), 1.0 );
?>
<div class="watermark" aria-hidden="true">
	<?php // Desktop: the full two-fan sweep, stretched across the wide band. ?>
	<svg class="watermark__art watermark__art--wide" viewBox="0 0 1900 630" preserveAspectRatio="none" focusable="false" aria-hidden="true"><?php echo $lapin_wm_left . $lapin_wm_right; // phpcs:ignore WordPress.Security.EscapeOutput ?></svg>
	<?php // Mobile: a single bottom-right fan on its own tall 390×840 canvas (design handoff), so the sweep stays clean on a narrow screen. ?>
	<svg class="watermark__art watermark__art--mobile" viewBox="0 0 390 840" preserveAspectRatio="none" focusable="false" aria-hidden="true"><?php echo $lapin_wm_mobile; // phpcs:ignore WordPress.Security.EscapeOutput ?></svg>
</div>
