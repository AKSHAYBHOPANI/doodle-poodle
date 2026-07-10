<?php
/**
 * Home section: Hero.
 *
 * @package Doodle_Poodle
 */

$eyebrow  = doodle_poodle_mod( 'dp_hero_eyebrow', 'Creative Colour & Play Kit' );
$title    = doodle_poodle_mod( 'dp_hero_title', 'Paint, Play, Repeat!' );
$text     = doodle_poodle_mod( 'dp_hero_text', "India's first Made-in-India hand-crafted creative play figurine & collectible brand. Reusable, repaintable sensory creative play figurines that inspire creativity, exploration & endless fun." );
$btn1     = doodle_poodle_mod( 'dp_hero_btn_1', 'Shop Now' );
$btn1_url = doodle_poodle_mod( 'dp_hero_btn_1_url', '#shop' );
$btn2     = doodle_poodle_mod( 'dp_hero_btn_2', 'Create a Bundle' );
$btn2_url = doodle_poodle_mod( 'dp_hero_btn_2_url', '#collections' );

/**
 * Carousel slides. A Customizer hero image (if set) becomes the first slide,
 * followed by the bundled product banners.
 */
$slides      = array();
$hero_img_id = doodle_poodle_mod( 'dp_hero_image' );
if ( $hero_img_id ) {
	$slides[] = wp_get_attachment_image_url( $hero_img_id, 'full' );
}
$slides[] = DOODLE_POODLE_URI . '/assets/images/hero-1.png';
$slides[] = DOODLE_POODLE_URI . '/assets/images/hero-2.png';
$slides[] = DOODLE_POODLE_URI . '/assets/images/hero-3.png';
$slides[] = DOODLE_POODLE_URI . '/assets/images/hero-4.png';
?>
<section class="dp-hero">
	<span class="dp-blob dp-blob--1" aria-hidden="true"></span>
	<span class="dp-blob dp-blob--2" aria-hidden="true"></span>
	<div class="dp-container dp-hero__inner">
		<div class="dp-hero__content">
			<?php if ( $eyebrow ) : ?>
				<span class="dp-hero__eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
			<?php endif; ?>
			<h1 class="dp-hero__title"><?php echo wp_kses_post( $title ); ?></h1>
			<p class="dp-hero__text"><?php echo esc_html( $text ); ?></p>
			<div class="dp-hero__actions">
				<?php if ( $btn1 ) : ?>
					<a class="dp-btn dp-btn--primary dp-btn--lg" href="<?php echo esc_url( $btn1_url ); ?>"><?php echo esc_html( $btn1 ); ?></a>
				<?php endif; ?>
				<?php if ( $btn2 ) : ?>
					<a class="dp-btn dp-btn--ghost dp-btn--lg" href="<?php echo esc_url( $btn2_url ); ?>"><?php echo esc_html( $btn2 ); ?></a>
				<?php endif; ?>
			</div>
			<ul class="dp-hero__pills">
				<li>♻️ <?php esc_html_e( 'Reusable & Eco-Friendly', 'doodle-poodle' ); ?></li>
				<li>🎨 <?php esc_html_e( 'Screen-Free Creative Play', 'doodle-poodle' ); ?></li>
				<li>🇮🇳 <?php esc_html_e( 'Made in India', 'doodle-poodle' ); ?></li>
			</ul>
		</div>
		<div class="dp-hero__media">
			<div class="dp-carousel" data-dp-carousel data-autoplay="5000">
				<div class="dp-carousel__viewport">
					<div class="dp-carousel__track">
						<?php foreach ( $slides as $i => $slide ) : ?>
							<div class="dp-carousel__slide<?php echo 0 === $i ? ' is-active' : ''; ?>">
								<div class="dp-hero__card">
									<img src="<?php echo esc_url( $slide ); ?>" alt="<?php echo esc_attr( sprintf( __( 'Doodle Poodle creative play kit %d', 'doodle-poodle' ), $i + 1 ) ); ?>"<?php echo 0 === $i ? '' : ' loading="lazy"'; ?> />
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<button class="dp-carousel__btn dp-carousel__btn--prev" type="button" aria-label="<?php esc_attr_e( 'Previous slide', 'doodle-poodle' ); ?>">
					<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
				</button>
				<button class="dp-carousel__btn dp-carousel__btn--next" type="button" aria-label="<?php esc_attr_e( 'Next slide', 'doodle-poodle' ); ?>">
					<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
				</button>

				<div class="dp-carousel__dots" role="tablist">
					<?php foreach ( $slides as $i => $slide ) : ?>
						<button class="dp-carousel__dot<?php echo 0 === $i ? ' is-active' : ''; ?>" type="button" data-index="<?php echo (int) $i; ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Go to slide %d', 'doodle-poodle' ), $i + 1 ) ); ?>"></button>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
