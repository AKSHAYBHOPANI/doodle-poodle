<?php
/**
 * 404 template.
 *
 * @package Doodle_Poodle
 */

get_header();
?>

<div class="dp-container dp-404">
	<div class="dp-404__inner">
		<span class="dp-404__emoji" aria-hidden="true">🐾</span>
		<h1 class="dp-404__code">404</h1>
		<h2 class="dp-404__title"><?php esc_html_e( 'Oops! This page wandered off.', 'doodle-poodle' ); ?></h2>
		<p class="dp-404__text"><?php esc_html_e( "The page you're looking for can't be found. Let's get you back to the fun!", 'doodle-poodle' ); ?></p>
		<div class="dp-404__actions">
			<a class="dp-btn dp-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'doodle-poodle' ); ?></a>
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<a class="dp-btn dp-btn--ghost" href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php esc_html_e( 'Shop Creative Play Figurines', 'doodle-poodle' ); ?></a>
			<?php endif; ?>
		</div>
		<div class="dp-404__search"><?php get_search_form(); ?></div>
	</div>
</div>

<?php
get_footer();
