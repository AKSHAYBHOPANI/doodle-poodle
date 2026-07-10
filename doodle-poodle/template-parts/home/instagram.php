<?php
/**
 * Home section: Instagram / community strip.
 *
 * @package Doodle_Poodle
 */

$instagram = doodle_poodle_mod( 'dp_instagram', 'https://instagram.com/doodlepoodle.in' );
$tones     = array( 'red', 'orange', 'yellow', 'green', 'blue', 'purple' );
$emojis    = array( '🐶', '🐳', '🎨', '⭐', '🦄', '🐾' );
?>
<section class="dp-section dp-instagram">
	<div class="dp-container">
		<?php
		doodle_poodle_section_heading(
			__( '#DoodlePoodle', 'doodle-poodle' ),
			__( 'Join the Movement', 'doodle-poodle' ),
			__( 'From fun collectibles to creative kits — explore creative play figurines designed to move, inspire and engage.', 'doodle-poodle' )
		);
		?>
		<div class="dp-instagram__grid">
			<?php foreach ( $tones as $i => $tone ) : ?>
				<a class="dp-ig-tile tone-<?php echo esc_attr( $tone ); ?>" href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'View on Instagram', 'doodle-poodle' ); ?>">
					<span aria-hidden="true"><?php echo esc_html( $emojis[ $i ] ); ?></span>
				</a>
			<?php endforeach; ?>
		</div>
		<div class="dp-products__cta">
			<a class="dp-btn dp-btn--primary" href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Follow on Instagram', 'doodle-poodle' ); ?></a>
		</div>
	</div>
</section>
