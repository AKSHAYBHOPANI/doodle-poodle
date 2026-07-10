<?php
/**
 * Home section: Product grid with tabs.
 *
 * @package Doodle_Poodle
 */

$count = (int) doodle_poodle_mod( 'dp_products_count', 8 );
?>
<section id="shop" class="dp-section dp-products">
	<div class="dp-container">
		<?php
		doodle_poodle_section_heading(
			__( 'Best Sellers', 'doodle-poodle' ),
			__( 'Shop Our Doodle Poodle', 'doodle-poodle' ),
			__( 'Creative play figurines, paint kits & collectibles loved by little hands.', 'doodle-poodle' )
		);
		?>

		<div class="dp-tabs" data-dp-tabs>
			<div class="dp-tabs__nav" role="tablist">
				<button class="dp-tab is-active" data-tab="featured" role="tab" aria-selected="true"><?php esc_html_e( 'Best Selling', 'doodle-poodle' ); ?></button>
				<button class="dp-tab" data-tab="new" role="tab" aria-selected="false"><?php esc_html_e( 'Newly Launched', 'doodle-poodle' ); ?></button>
				<button class="dp-tab" data-tab="all" role="tab" aria-selected="false"><?php esc_html_e( 'All Products', 'doodle-poodle' ); ?></button>
			</div>

			<div class="dp-tabs__panel is-active" data-panel="featured">
				<?php doodle_poodle_product_grid( array( 'orderby' => 'popularity', 'limit' => $count ) ); ?>
			</div>
			<div class="dp-tabs__panel" data-panel="new">
				<?php doodle_poodle_product_grid( array( 'orderby' => 'date', 'order' => 'DESC', 'limit' => $count ) ); ?>
			</div>
			<div class="dp-tabs__panel" data-panel="all">
				<?php doodle_poodle_product_grid( array( 'orderby' => 'title', 'order' => 'ASC', 'limit' => $count ) ); ?>
			</div>
		</div>

		<div class="dp-products__cta">
			<a class="dp-btn dp-btn--primary" href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php esc_html_e( 'View All Products', 'doodle-poodle' ); ?></a>
		</div>
	</div>
</section>
