<?php
/**
 * Home section: Available At (online stores).
 *
 * @package Doodle_Poodle
 */

$online_raw = doodle_poodle_mod( 'dp_online_stores', "Amazon\nFlipkart\nBlinkit\nWOL3D Store" );
$online     = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $online_raw ) ) );
?>
<section class="dp-section dp-availability">
	<div class="dp-container">
		<div class="dp-availability__head">
			<span class="dp-rating-badge">⭐ 4.5+ <?php esc_html_e( 'rated on all platforms', 'doodle-poodle' ); ?></span>
			<?php
			doodle_poodle_section_heading(
				__( 'Find Us', 'doodle-poodle' ),
				__( 'We Are Available At', 'doodle-poodle' ),
				__( 'Thoughtfully designed hand-crafted creative play figurines, now accessible across leading online platforms.', 'doodle-poodle' )
			);
			?>
		</div>

		<div class="dp-availability__grid dp-availability__grid--single">
			<div class="dp-availability__col">
				<h3 class="dp-availability__label">🛒 <?php esc_html_e( 'Online Stores', 'doodle-poodle' ); ?></h3>
				<ul class="dp-chip-list">
					<?php foreach ( $online as $store ) : ?>
						<li class="dp-chip"><?php echo esc_html( $store ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</section>
