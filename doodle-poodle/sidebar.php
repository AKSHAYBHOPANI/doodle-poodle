<?php
/**
 * Sidebar template.
 *
 * @package Doodle_Poodle
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside id="secondary" class="dp-sidebar widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
