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

// Handoff geometry, scaled up for presence (a tall band clears the dark CTA band):
// left fan 26 lines; right fan 1.15× denser + wider.
$lapin_wm_left  = $lapin_wm_fan( 'left', 28, 610.0, 720.0, 0.5 );
$lapin_wm_right = $lapin_wm_fan( 'right', (int) round( 28 * 1.15 ), 700.0, 1040.0, 0.5 );
?>
<div class="watermark" aria-hidden="true">
	<svg viewBox="0 0 1900 630" preserveAspectRatio="none" focusable="false" aria-hidden="true"><?php echo $lapin_wm_left . $lapin_wm_right; // phpcs:ignore WordPress.Security.EscapeOutput ?></svg>
</div>
