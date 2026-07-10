<?php
/**
 * Home section: Shop by Collection.
 *
 * @package Doodle_Poodle
 */

?>
<section id="collections" class="dp-section dp-collections">
	<div class="dp-container">
		<?php
		doodle_poodle_section_heading(
			__( 'Explore', 'doodle-poodle' ),
			__( 'Shop by Collection', 'doodle-poodle' ),
			__( 'Find the perfect creative companion from our colourful range.', 'doodle-poodle' )
		);
		doodle_poodle_collection_grid( 6 );
		?>
	</div>
</section>
