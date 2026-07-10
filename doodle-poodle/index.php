<?php
/**
 * Main template (blog index / fallback).
 *
 * @package Doodle_Poodle
 */

get_header();
?>

<div class="dp-container dp-blog-layout">

	<div class="dp-blog-main">
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header class="dp-page-head">
				<h1 class="dp-page-title"><?php single_post_title(); ?></h1>
			</header>
		<?php elseif ( is_home() ) : ?>
			<header class="dp-page-head">
				<h1 class="dp-page-title"><?php esc_html_e( 'From the Doodle Poodle Blog', 'doodle-poodle' ); ?></h1>
			</header>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<div class="dp-post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', get_post_type() );
				endwhile;
				?>
			</div>

			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 2,
					'prev_text' => __( '&larr; Newer', 'doodle-poodle' ),
					'next_text' => __( 'Older &rarr;', 'doodle-poodle' ),
				)
			);
			?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
		<?php endif; ?>
	</div>

	<?php get_sidebar(); ?>

</div>

<?php
get_footer();
