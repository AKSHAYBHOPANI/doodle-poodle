<?php
/**
 * Template part: no content found.
 *
 * @package Doodle_Poodle
 */

?>
<section class="dp-no-results">
	<span class="dp-no-results__emoji" aria-hidden="true">🐾</span>
	<h2><?php esc_html_e( 'Nothing here yet', 'doodle-poodle' ); ?></h2>
	<?php if ( is_search() ) : ?>
		<p><?php esc_html_e( 'Sorry, no results matched your search. Try a different keyword.', 'doodle-poodle' ); ?></p>
		<?php get_search_form(); ?>
	<?php else : ?>
		<p><?php esc_html_e( "We're busy doodling new things. Check back soon!", 'doodle-poodle' ); ?></p>
	<?php endif; ?>
</section>
