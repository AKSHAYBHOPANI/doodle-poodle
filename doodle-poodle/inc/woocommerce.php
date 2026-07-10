<?php
/**
 * WooCommerce compatibility & tweaks.
 *
 * @package Doodle_Poodle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Products per row & per page.
 */
add_filter( 'loop_shop_columns', function () { return 4; }, 999 );
add_filter( 'loop_shop_per_page', function () { return 12; }, 999 );

/**
 * Related products count.
 */
add_filter(
	'woocommerce_output_related_products_args',
	function ( $args ) {
		$args['posts_per_page'] = 4;
		$args['columns']        = 4;
		return $args;
	}
);

/**
 * Wrap WooCommerce content in theme container.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'doodle_poodle_wc_wrapper_start', 10 );
function doodle_poodle_wc_wrapper_start() {
	echo '<div class="dp-shop-wrap"><div class="dp-container">';
}

add_action( 'woocommerce_after_main_content', 'doodle_poodle_wc_wrapper_end', 10 );
function doodle_poodle_wc_wrapper_end() {
	echo '</div></div>';
}

/**
 * Replace default sale flash with a friendly badge.
 */
add_filter(
	'woocommerce_sale_flash',
	function () {
		return '<span class="dp-badge dp-badge--sale">' . esc_html__( 'Sale!', 'doodle-poodle' ) . '</span>';
	}
);

/**
 * Customise add-to-cart button text on archives.
 */
add_filter(
	'woocommerce_product_add_to_cart_text',
	function ( $text, $product = null ) {
		if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() ) {
			return __( 'Add to Cart', 'doodle-poodle' );
		}
		return $text;
	},
	10,
	2
);

/**
 * Reorder single product summary tweaks: nothing aggressive, keep defaults.
 * Adjust sidebar: remove default WC sidebar (theme uses full width shop).
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Render a WooCommerce product grid for the home page.
 *
 * @param array $args Query args overrides.
 */
function doodle_poodle_product_grid( $args = array() ) {
	$defaults = array(
		'limit'   => doodle_poodle_mod( 'dp_products_count', 8 ),
		'columns' => 4,
		'orderby' => 'date',
		'order'   => 'DESC',
	);
	$args = wp_parse_args( $args, $defaults );

	$shortcode = sprintf(
		'[products limit="%1$d" columns="%2$d" orderby="%3$s" order="%4$s"]',
		(int) $args['limit'],
		(int) $args['columns'],
		esc_attr( $args['orderby'] ),
		esc_attr( $args['order'] )
	);

	echo do_shortcode( $shortcode );
}

/**
 * Output a grid of product categories for "Shop by Collection".
 */
function doodle_poodle_collection_grid( $limit = 6 ) {
	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'number'     => $limit,
			'orderby'    => 'count',
			'order'      => 'DESC',
			'exclude'    => array( get_option( 'default_product_cat', 0 ) ),
		)
	);

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		echo '<p class="dp-empty">' . esc_html__( 'Add product categories in WooCommerce to populate this section.', 'doodle-poodle' ) . '</p>';
		return;
	}

	$palette = array( 'red', 'orange', 'yellow', 'green', 'blue', 'purple' );

	echo '<div class="dp-collection-grid">';
	$i = 0;
	foreach ( $terms as $term ) {
		$thumb_id  = get_term_meta( $term->term_id, 'thumbnail_id', true );
		$image_url = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium' ) : wc_placeholder_img_src( 'medium' );
		$tone      = $palette[ $i % count( $palette ) ];
		printf(
			'<a class="dp-collection-card tone-%1$s" href="%2$s">
				<span class="dp-collection-thumb"><img src="%3$s" alt="%4$s" loading="lazy" /></span>
				<span class="dp-collection-name">%4$s</span>
				<span class="dp-collection-count">%5$s</span>
			</a>',
			esc_attr( $tone ),
			esc_url( get_term_link( $term ) ),
			esc_url( $image_url ),
			esc_html( $term->name ),
			/* translators: %d: product count */
			esc_html( sprintf( _n( '%d item', '%d items', $term->count, 'doodle-poodle' ), $term->count ) )
		);
		$i++;
	}
	echo '</div>';
}
