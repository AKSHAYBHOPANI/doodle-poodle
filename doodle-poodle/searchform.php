<?php
/**
 * Search form.
 *
 * @package Doodle_Poodle
 */

?>
<form role="search" method="get" class="dp-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="dp-search-field"><?php esc_html_e( 'Search for:', 'doodle-poodle' ); ?></label>
	<input type="search" id="dp-search-field" class="dp-search-form__input" placeholder="<?php esc_attr_e( 'Search creative play figurines, kits, blog…', 'doodle-poodle' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="dp-search-form__btn"><?php esc_html_e( 'Search', 'doodle-poodle' ); ?></button>
</form>
