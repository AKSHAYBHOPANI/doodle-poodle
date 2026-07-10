<?php
/**
 * Front page template - the Doodle Poodle home page.
 *
 * @package Doodle_Poodle
 */

get_header();
?>

<div class="dp-home">

	<?php get_template_part( 'template-parts/home/hero' ); ?>

	<?php if ( doodle_poodle_mod( 'dp_show_features', true ) ) : ?>
		<?php get_template_part( 'template-parts/home/features' ); ?>
	<?php endif; ?>

	<?php if ( doodle_poodle_mod( 'dp_show_collections', true ) && class_exists( 'WooCommerce' ) ) : ?>
		<?php get_template_part( 'template-parts/home/collections' ); ?>
	<?php endif; ?>

	<?php if ( doodle_poodle_mod( 'dp_show_products', true ) && class_exists( 'WooCommerce' ) ) : ?>
		<?php get_template_part( 'template-parts/home/products' ); ?>
	<?php endif; ?>

	<?php if ( doodle_poodle_mod( 'dp_show_availability', true ) ) : ?>
		<?php get_template_part( 'template-parts/home/availability' ); ?>
	<?php endif; ?>

	<?php if ( doodle_poodle_mod( 'dp_show_testimonials', true ) ) : ?>
		<?php get_template_part( 'template-parts/home/testimonials' ); ?>
	<?php endif; ?>

	<?php if ( doodle_poodle_mod( 'dp_show_blog', true ) ) : ?>
		<?php get_template_part( 'template-parts/home/blog' ); ?>
	<?php endif; ?>

	<?php if ( doodle_poodle_mod( 'dp_show_instagram', true ) ) : ?>
		<?php get_template_part( 'template-parts/home/instagram' ); ?>
	<?php endif; ?>

</div>

<?php
get_footer();
