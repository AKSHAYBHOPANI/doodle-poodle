<?php
/**
 * Doodle Poodle Theme Customizer.
 *
 * @package Doodle_Poodle
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper to fetch a theme mod with a default.
 */
function doodle_poodle_mod( $key, $default = '' ) {
	return get_theme_mod( $key, $default );
}

/**
 * One-time cleanup: remove retired WIGGLE10 promo from saved announcement messages.
 */
function doodle_poodle_clear_wiggle10_promo() {
	if ( get_option( 'doodle_poodle_cleared_wiggle10' ) ) {
		return;
	}

	$defaults = array(
		'dp_topbar_msg_1' => '🚚 Free shipping on orders above ₹999',
		'dp_topbar_msg_2' => '🇮🇳 Proudly Made in India by Doodle Poodle',
		'dp_topbar_msg_3' => '',
	);

	foreach ( $defaults as $key => $fallback ) {
		$val = get_theme_mod( $key, null );
		if ( null === $val || '' === $val ) {
			continue;
		}
		if ( preg_match( '/wiggle\s*10|use\s+code\s+wiggle/i', $val ) ) {
			set_theme_mod( $key, $fallback );
		}
	}

	update_option( 'doodle_poodle_cleared_wiggle10', 1, false );
}
add_action( 'after_setup_theme', 'doodle_poodle_clear_wiggle10_promo', 20 );

/**
 * Register Customizer settings.
 */
function doodle_poodle_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	/* ---------------------------------------------------------
	 * PANEL: Doodle Poodle Options
	 * ------------------------------------------------------- */
	$wp_customize->add_panel(
		'doodle_poodle_options',
		array(
			'title'    => __( 'Doodle Poodle Options', 'doodle-poodle' ),
			'priority' => 5,
		)
	);

	/* ---- Topbar / Announcement ---- */
	$wp_customize->add_section(
		'dp_topbar',
		array(
			'title' => __( 'Announcement Bar', 'doodle-poodle' ),
			'panel' => 'doodle_poodle_options',
		)
	);
	$topbar_defaults = array(
		'dp_topbar_msg_1' => '🚚 Free shipping on orders above ₹999',
		'dp_topbar_msg_2' => '🇮🇳 Proudly Made in India by Doodle Poodle',
		'dp_topbar_msg_3' => '',
	);
	foreach ( $topbar_defaults as $key => $val ) {
		$wp_customize->add_setting( $key, array( 'default' => $val, 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control(
			$key,
			array(
				'label'   => sprintf( __( 'Message %s', 'doodle-poodle' ), substr( $key, -1 ) ),
				'section' => 'dp_topbar',
				'type'    => 'text',
			)
		);
	}

	/* ---- Brand colors ---- */
	$wp_customize->add_section(
		'dp_colors',
		array(
			'title' => __( 'Brand Colors', 'doodle-poodle' ),
			'panel' => 'doodle_poodle_options',
		)
	);
	$color_defaults = array(
		'dp_color_primary'   => '#1ca9e0',
		'dp_color_secondary' => '#e8312a',
		'dp_color_accent'    => '#ffc20e',
	);
	foreach ( $color_defaults as $key => $val ) {
		$wp_customize->add_setting( $key, array( 'default' => $val, 'sanitize_callback' => 'sanitize_hex_color' ) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$key,
				array(
					'label'   => ucwords( str_replace( array( 'dp_color_', '_' ), array( '', ' ' ), $key ) ),
					'section' => 'dp_colors',
				)
			)
		);
	}

	/* ---- Hero ---- */
	$wp_customize->add_section(
		'dp_hero',
		array(
			'title' => __( 'Home: Hero', 'doodle-poodle' ),
			'panel' => 'doodle_poodle_options',
		)
	);
	$hero = array(
		'dp_hero_eyebrow' => array( 'Creative Colour & Play Kit', 'text' ),
		'dp_hero_title'   => array( 'Paint, Play, Repeat!', 'text' ),
		'dp_hero_text'    => array( 'India\'s first Made-in-India hand-crafted creative play figurine & collectible brand. Reusable, repaintable sensory creative play figurines that inspire creativity, exploration & endless fun.', 'textarea' ),
		'dp_hero_btn_1'   => array( 'Shop Now', 'text' ),
		'dp_hero_btn_1_url' => array( '#shop', 'url' ),
		'dp_hero_btn_2'   => array( 'Create a Bundle', 'text' ),
		'dp_hero_btn_2_url' => array( '#collections', 'url' ),
	);
	foreach ( $hero as $key => $cfg ) {
		$sanitize = 'url' === $cfg[1] ? 'esc_url_raw' : ( 'textarea' === $cfg[1] ? 'sanitize_textarea_field' : 'sanitize_text_field' );
		$wp_customize->add_setting( $key, array( 'default' => $cfg[0], 'sanitize_callback' => $sanitize ) );
		$wp_customize->add_control(
			$key,
			array(
				'label'   => ucwords( str_replace( array( 'dp_hero_', '_' ), array( '', ' ' ), $key ) ),
				'section' => 'dp_hero',
				'type'    => 'textarea' === $cfg[1] ? 'textarea' : 'text',
			)
		);
	}
	$wp_customize->add_setting( 'dp_hero_image', array( 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'dp_hero_image',
			array(
				'label'     => __( 'Hero Image', 'doodle-poodle' ),
				'section'   => 'dp_hero',
				'mime_type' => 'image',
			)
		)
	);

	/* ---- Home sections toggle ---- */
	$wp_customize->add_section(
		'dp_sections',
		array(
			'title' => __( 'Home: Sections', 'doodle-poodle' ),
			'panel' => 'doodle_poodle_options',
		)
	);
	$sections = array(
		'dp_show_features'     => __( 'Show Features strip', 'doodle-poodle' ),
		'dp_show_collections'  => __( 'Show Shop by Collection', 'doodle-poodle' ),
		'dp_show_products'     => __( 'Show Product grid', 'doodle-poodle' ),
		'dp_show_availability' => __( 'Show "Available At"', 'doodle-poodle' ),
		'dp_show_testimonials' => __( 'Show Testimonials', 'doodle-poodle' ),
		'dp_show_blog'         => __( 'Show Latest Blog', 'doodle-poodle' ),
		'dp_show_instagram'    => __( 'Show Instagram strip', 'doodle-poodle' ),
	);
	foreach ( $sections as $key => $label ) {
		$wp_customize->add_setting( $key, array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
		$wp_customize->add_control( $key, array( 'label' => $label, 'section' => 'dp_sections', 'type' => 'checkbox' ) );
	}

	/* ---- Products section ---- */
	$wp_customize->add_setting( 'dp_products_count', array( 'default' => 8, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'dp_products_count', array(
		'label'   => __( 'Number of products to show', 'doodle-poodle' ),
		'section' => 'dp_sections',
		'type'    => 'number',
	) );

	/* ---- Availability ---- */
	$wp_customize->add_section(
		'dp_availability',
		array(
			'title' => __( 'Home: Available At', 'doodle-poodle' ),
			'panel' => 'doodle_poodle_options',
		)
	);
	$wp_customize->add_setting( 'dp_online_stores', array(
		'default'           => "Amazon\nFlipkart\nBlinkit\nWOL3D Store",
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'dp_online_stores', array(
		'label'       => __( 'Online stores (one per line)', 'doodle-poodle' ),
		'section'     => 'dp_availability',
		'type'        => 'textarea',
	) );

	/* ---- Contact / Footer ---- */
	$wp_customize->add_section(
		'dp_contact',
		array(
			'title' => __( 'Contact & Social', 'doodle-poodle' ),
			'panel' => 'doodle_poodle_options',
		)
	);
	$contact = array(
		'dp_phone'     => array( '7208657200', __( 'Phone', 'doodle-poodle' ) ),
		'dp_email'     => array( 'hello@doodlepoodle.in', __( 'Email', 'doodle-poodle' ) ),
		'dp_address'   => array( 'House of WOL3D, Mumbai, Maharashtra, India', __( 'Address', 'doodle-poodle' ) ),
		'dp_instagram' => array( 'https://instagram.com/doodlepoodle.in', __( 'Instagram URL', 'doodle-poodle' ) ),
		'dp_facebook'  => array( '', __( 'Facebook URL', 'doodle-poodle' ) ),
		'dp_youtube'   => array( '', __( 'YouTube URL', 'doodle-poodle' ) ),
		'dp_whatsapp'  => array( '917208657200', __( 'WhatsApp number (with country code)', 'doodle-poodle' ) ),
	);
	foreach ( $contact as $key => $cfg ) {
		$wp_customize->add_setting( $key, array( 'default' => $cfg[0], 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( $key, array( 'label' => $cfg[1], 'section' => 'dp_contact', 'type' => 'text' ) );
	}
	$wp_customize->add_setting( 'dp_footer_about', array(
		'default'           => 'Doodle Poodle - Where Imagination Takes Shape. India\'s first Made-in-India hand-crafted creative play figurine & collectible brand. A proud brand from the House of WOL3D.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'dp_footer_about', array(
		'label'   => __( 'Footer about text', 'doodle-poodle' ),
		'section' => 'dp_contact',
		'type'    => 'textarea',
	) );
}
add_action( 'customize_register', 'doodle_poodle_customize_register' );

/**
 * Output dynamic brand colors as CSS variables.
 */
function doodle_poodle_customizer_css() {
	$primary   = doodle_poodle_mod( 'dp_color_primary', '#1ca9e0' );
	$secondary = doodle_poodle_mod( 'dp_color_secondary', '#e8312a' );
	$accent    = doodle_poodle_mod( 'dp_color_accent', '#ffc20e' );
	?>
	<style id="doodle-poodle-customizer-css">
		:root{
			--dp-primary: <?php echo esc_html( $primary ); ?>;
			--dp-secondary: <?php echo esc_html( $secondary ); ?>;
			--dp-accent: <?php echo esc_html( $accent ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'doodle_poodle_customizer_css' );

/**
 * Live preview JS.
 */
function doodle_poodle_customize_preview_js() {
	wp_enqueue_script( 'doodle-poodle-customizer', DOODLE_POODLE_URI . '/assets/js/customizer.js', array( 'customize-preview' ), DOODLE_POODLE_VERSION, true );
}
add_action( 'customize_preview_init', 'doodle_poodle_customize_preview_js' );
