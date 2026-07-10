<?php
/**
 * Home section: Features strip.
 *
 * @package Doodle_Poodle
 */

$features = array(
	array(
		'tone'  => 'green',
		'icon'  => '♻️',
		'title' => __( 'Reusable & Eco-Friendly', 'doodle-poodle' ),
		'text'  => __( 'Repaint again and again with plant-based materials.', 'doodle-poodle' ),
	),
	array(
		'tone'  => 'blue',
		'icon'  => '💡',
		'title' => __( 'Creative Play', 'doodle-poodle' ),
		'text'  => __( 'Encourages imagination, focus & fine motor skills.', 'doodle-poodle' ),
	),
	array(
		'tone'  => 'orange',
		'icon'  => '✋',
		'title' => __( 'Sensory Fun', 'doodle-poodle' ),
		'text'  => __( 'Textured shells and smooth moving joints.', 'doodle-poodle' ),
	),
	array(
		'tone'  => 'purple',
		'icon'  => '🛡️',
		'title' => __( 'Safe & Durable', 'doodle-poodle' ),
		'text'  => __( 'Made with sturdy, child-safe materials built to last.', 'doodle-poodle' ),
	),
);
?>
<section class="dp-section dp-features">
	<div class="dp-container">
		<div class="dp-features__grid">
			<?php foreach ( $features as $f ) : ?>
				<div class="dp-feature tone-<?php echo esc_attr( $f['tone'] ); ?>">
					<span class="dp-feature__icon" aria-hidden="true"><?php echo esc_html( $f['icon'] ); ?></span>
					<h3 class="dp-feature__title"><?php echo esc_html( $f['title'] ); ?></h3>
					<p class="dp-feature__text"><?php echo esc_html( $f['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
