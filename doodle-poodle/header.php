<?php
/**
 * Header template.
 *
 * @package Doodle_Poodle
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#dp-content"><?php esc_html_e( 'Skip to content', 'doodle-poodle' ); ?></a>

<div id="page" class="dp-site">

	<?php
	// Build announcement ticker; never show the retired WIGGLE10 promo (even if still saved in Customizer).
	$ticker = array_filter(
		array(
			doodle_poodle_mod( 'dp_topbar_msg_1', '🚚 Free shipping on orders above ₹999' ),
			doodle_poodle_mod( 'dp_topbar_msg_2', '🇮🇳 Proudly Made in India by Doodle Poodle' ),
			doodle_poodle_mod( 'dp_topbar_msg_3', '' ),
		),
		static function ( $msg ) {
			$msg = trim( (string) $msg );
			if ( '' === $msg ) {
				return false;
			}
			return ! preg_match( '/wiggle\s*10|use\s+code\s+wiggle/i', $msg );
		}
	);
	if ( ! empty( $ticker ) ) : ?>
		<div class="dp-topbar">
			<div class="dp-ticker">
				<div class="dp-ticker__track">
					<?php for ( $r = 0; $r < 2; $r++ ) : ?>
						<?php foreach ( $ticker as $msg ) : ?>
							<span class="dp-ticker__item"><?php echo esc_html( $msg ); ?></span>
							<span class="dp-ticker__dot" aria-hidden="true">•</span>
						<?php endforeach; ?>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<header id="masthead" class="dp-header">
		<div class="dp-container dp-header__inner">

			<button class="dp-nav-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="dp-nav-toggle__bar"></span>
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'doodle-poodle' ); ?></span>
			</button>

			<div class="dp-header__brand">
				<?php doodle_poodle_site_branding(); ?>
			</div>

			<nav id="site-navigation" class="dp-nav" aria-label="<?php esc_attr_e( 'Primary', 'doodle-poodle' ); ?>">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'dp-menu',
							'container'      => false,
						)
					);
				} else {
					doodle_poodle_default_menu();
				}
				?>
			</nav>

			<div class="dp-header__actions">
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<a class="dp-icon-btn" href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" aria-label="<?php esc_attr_e( 'My account', 'doodle-poodle' ); ?>">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
					</a>
					<?php doodle_poodle_header_cart(); ?>
				<?php endif; ?>
			</div>

		</div>
	</header>

	<main id="dp-content" class="dp-main">
