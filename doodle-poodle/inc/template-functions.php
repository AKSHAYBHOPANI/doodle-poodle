<?php
/**
 * Template helper functions.
 *
 * @package Doodle_Poodle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output the site logo (custom logo or styled text fallback).
 */
function doodle_poodle_site_branding() {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}

	$logo = DOODLE_POODLE_URI . '/assets/images/logo.png';
	printf(
		'<a class="dp-logo" href="%1$s" rel="home"><img src="%2$s" alt="%3$s" width="120" height="120" /></a>',
		esc_url( home_url( '/' ) ),
		esc_url( $logo ),
		esc_attr( get_bloginfo( 'name' ) )
	);
}

/**
 * Mini cart count for the header.
 */
function doodle_poodle_cart_count() {
	if ( ! function_exists( 'WC' ) || is_null( WC()->cart ) ) {
		return 0;
	}
	return WC()->cart->get_cart_contents_count();
}

/**
 * Header cart link (only when WooCommerce is active).
 */
function doodle_poodle_header_cart() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	$count = doodle_poodle_cart_count();
	printf(
		'<a class="dp-cart-link" href="%1$s" aria-label="%2$s">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
			<span class="dp-cart-count">%3$s</span>
		</a>',
		esc_url( wc_get_cart_url() ),
		esc_attr__( 'View cart', 'doodle-poodle' ),
		esc_html( $count )
	);
}

/**
 * AJAX-friendly cart count fragment.
 */
function doodle_poodle_cart_fragment( $fragments ) {
	$count = doodle_poodle_cart_count();
	$fragments['span.dp-cart-count'] = '<span class="dp-cart-count">' . esc_html( $count ) . '</span>';
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'doodle_poodle_cart_fragment' );

/**
 * Render a section heading block.
 *
 * @param string $eyebrow Small label above title.
 * @param string $title   Main heading.
 * @param string $subtitle Optional subtitle.
 */
function doodle_poodle_section_heading( $eyebrow, $title, $subtitle = '' ) {
	echo '<div class="dp-section-head">';
	if ( $eyebrow ) {
		echo '<span class="dp-eyebrow">' . esc_html( $eyebrow ) . '</span>';
	}
	echo '<h2 class="dp-section-title">' . wp_kses_post( $title ) . '</h2>';
	if ( $subtitle ) {
		echo '<p class="dp-section-sub">' . wp_kses_post( $subtitle ) . '</p>';
	}
	echo '</div>';
}

/**
 * Estimated reading time for posts.
 */
function doodle_poodle_reading_time() {
	$content    = get_post_field( 'post_content', get_the_ID() );
	$word_count = str_word_count( wp_strip_all_tags( $content ) );
	$minutes    = max( 1, (int) ceil( $word_count / 200 ) );
	/* translators: %d: number of minutes */
	return sprintf( _n( '%d min read', '%d min read', $minutes, 'doodle-poodle' ), $minutes );
}

/**
 * Fallback menu when no primary menu is set.
 */
function doodle_poodle_default_menu() {
	echo '<ul id="primary-menu" class="dp-menu">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'doodle-poodle' ) . '</a></li>';
	if ( class_exists( 'WooCommerce' ) ) {
		echo '<li><a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '">' . esc_html__( 'Shop', 'doodle-poodle' ) . '</a></li>';
	}
	echo '<li><a href="' . esc_url( home_url( '/about/' ) ) . '">' . esc_html__( 'About Us', 'doodle-poodle' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/blog/' ) ) . '">' . esc_html__( 'Blog', 'doodle-poodle' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">' . esc_html__( 'Contact', 'doodle-poodle' ) . '</a></li>';
	echo '</ul>';
}
