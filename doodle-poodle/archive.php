<?php
/**
 * Archive template.
 *
 * @package Doodle_Poodle
 */

get_header();
?>

<div class="dp-container dp-blog-layout">
	<div class="dp-blog-main">
		<header class="dp-page-head">
			<?php
			the_archive_title( '<h1 class="dp-page-title">', '</h1>' );
			the_archive_description( '<div class="dp-archive-desc">', '</div>' );
			?>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="dp-post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', get_post_type() );
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
