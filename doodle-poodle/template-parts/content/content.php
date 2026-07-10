<?php
/**
 * Template part: blog post card.
 *
 * @package Doodle_Poodle
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'dp-card dp-post-card' ); ?>>
	<a class="dp-post-card__thumb" href="<?php the_permalink(); ?>">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'large' );
		} else {
			echo '<span class="dp-post-card__placeholder" aria-hidden="true">🎨</span>';
		}
		?>
	</a>
	<div class="dp-post-card__body">
		<div class="dp-post-meta">
			<span class="dp-post-date"><?php echo esc_html( get_the_date() ); ?></span>
			<span class="dp-dot">•</span>
			<span class="dp-post-read"><?php echo esc_html( doodle_poodle_reading_time() ); ?></span>
		</div>
		<h2 class="dp-post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p class="dp-post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
		<a class="dp-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'doodle-poodle' ); ?> &rarr;</a>
	</div>
</article>
