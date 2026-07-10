<?php
/**
 * Search results template.
 *
 * @package Doodle_Poodle
 */

get_header();
?>

<div class="dp-container dp-blog-layout">
	<div class="dp-blog-main">
		<header class="dp-page-head">
			<h1 class="dp-page-title">
				<?php
				/* translators: %s: search query */
				printf( esc_html__( 'Search results for: %s', 'doodle-poodle' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
				?>
			</h1>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="dp-post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', 'search' );
				endwhile;
				?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
		<?php endif; ?>
	</div>

	<?php get_sidebar(); ?>
</div>

<?php
get_footer();
