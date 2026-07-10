<?php
/**
 * Doodle Poodle functions and definitions.
 *
 * @package Doodle_Poodle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DOODLE_POODLE_VERSION', '1.0.11' );
define( 'DOODLE_POODLE_DIR', get_template_directory() );
define( 'DOODLE_POODLE_URI', get_template_directory_uri() );

/**
 * Theme setup.
 */
function doodle_poodle_setup() {
	load_theme_textdomain( 'doodle-poodle', DOODLE_POODLE_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 120,
			'width'       => 120,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// WooCommerce support + features.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'doodle-poodle' ),
			'footer'  => __( 'Footer Menu', 'doodle-poodle' ),
		)
	);

	add_editor_style( 'assets/css/theme.css' );
}
add_action( 'after_setup_theme', 'doodle_poodle_setup' );

/**
 * Content width.
 */
function doodle_poodle_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'doodle_poodle_content_width', 1240 );
}
add_action( 'after_setup_theme', 'doodle_poodle_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function doodle_poodle_assets() {
	// Google Fonts: Baloo 2 (headings) + Poppins (body).
	wp_enqueue_style(
		'doodle-poodle-fonts',
		'https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	// Required theme header file.
	wp_enqueue_style( 'doodle-poodle-style', get_stylesheet_uri(), array(), DOODLE_POODLE_VERSION );

	// Main theme stylesheet.
	wp_enqueue_style( 'doodle-poodle-main', DOODLE_POODLE_URI . '/assets/css/theme.css', array( 'doodle-poodle-style' ), DOODLE_POODLE_VERSION );

	wp_enqueue_script( 'doodle-poodle-main', DOODLE_POODLE_URI . '/assets/js/main.js', array(), DOODLE_POODLE_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'doodle_poodle_assets' );

/**
 * Register widget areas.
 */
function doodle_poodle_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'doodle-poodle' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here.', 'doodle-poodle' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	for ( $i = 1; $i <= 4; $i++ ) {
		register_sidebar(
			array(
				/* translators: %d: footer column number */
				'name'          => sprintf( __( 'Footer Column %d', 'doodle-poodle' ), $i ),
				'id'            => 'footer-' . $i,
				'description'   => __( 'Footer widget area.', 'doodle-poodle' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}
}
add_action( 'widgets_init', 'doodle_poodle_widgets_init' );

/**
 * Body classes.
 */
function doodle_poodle_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		$classes[] = 'dp-woocommerce';
	}
	return $classes;
}
add_filter( 'body_class', 'doodle_poodle_body_classes' );

require DOODLE_POODLE_DIR . '/inc/template-functions.php';
require DOODLE_POODLE_DIR . '/inc/customizer.php';

if ( class_exists( 'WooCommerce' ) ) {
	require DOODLE_POODLE_DIR . '/inc/woocommerce.php';
}
