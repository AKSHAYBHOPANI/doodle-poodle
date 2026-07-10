<?php
/**
 * Home section: Latest Blog.
 *
 * @package Doodle_Poodle
 */

$blog_q = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);

if ( ! $blog_q->have_posts() ) {
	wp_reset_postdata();
	return;
}
?>
<section class="dp-section dp-blog">
	<div class="dp-container">
		<?php
		doodle_poodle_section_heading(
			__( 'Stories', 'doodle-poodle' ),
			__( 'From the Doodle Poodle Blog', 'doodle-poodle' ),
			__( 'Ideas, behind-the-scenes and creative playtime inspiration.', 'doodle-poodle' )
		);
		?>
		<div class="dp-post-grid dp-post-grid--3">
			<?php
			while ( $blog_q->have_posts() ) :
				$blog_q->the_post();
				get_template_part( 'template-parts/content/content', get_post_type() );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		<div class="dp-products__cta">
			<a class="dp-btn dp-btn--ghost" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Read the Blog', 'doodle-poodle' ); ?></a>
		</div>
	</div>
</section>
