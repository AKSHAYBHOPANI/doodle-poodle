<?php
/**
 * Single post template.
 *
 * @package Doodle_Poodle
 */

get_header();
?>

<div class="dp-container dp-blog-layout">
	<div class="dp-blog-main">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'dp-single-post' ); ?>>
				<header class="dp-page-head">
					<div class="dp-post-meta">
						<span class="dp-post-date"><?php echo esc_html( get_the_date() ); ?></span>
						<span class="dp-dot">•</span>
						<span class="dp-post-read"><?php echo esc_html( doodle_poodle_reading_time() ); ?></span>
					</div>
					<h1 class="dp-page-title"><?php the_title(); ?></h1>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="dp-page-thumb"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>

				<div class="dp-entry-content">
					<?php
					the_content();
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'doodle-poodle' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>

				<footer class="dp-post-footer">
					<?php the_tags( '<span class="dp-tags">', '', '</span>' ); ?>
				</footer>
			</article>

			<nav class="dp-post-nav">
				<div class="dp-post-nav__prev"><?php previous_post_link( '%link', '&larr; %title' ); ?></div>
				<div class="dp-post-nav__next"><?php next_post_link( '%link', '%title &rarr;' ); ?></div>
			</nav>

			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</div>

	<?php get_sidebar(); ?>
</div>

<?php
get_footer();
