<?php
/**
 * Footer template.
 *
 * @package Doodle_Poodle
 */

$phone     = doodle_poodle_mod( 'dp_phone', '7208657200' );
$email     = doodle_poodle_mod( 'dp_email', 'hello@doodlepoodle.in' );
$address   = doodle_poodle_mod( 'dp_address', 'House of WOL3D, Mumbai, Maharashtra, India' );
$instagram = doodle_poodle_mod( 'dp_instagram', 'https://instagram.com/doodlepoodle.in' );
$facebook  = doodle_poodle_mod( 'dp_facebook', '' );
$youtube   = doodle_poodle_mod( 'dp_youtube', '' );
$whatsapp  = doodle_poodle_mod( 'dp_whatsapp', '917208657200' );
$about     = doodle_poodle_mod( 'dp_footer_about', 'Doodle Poodle - Where Imagination Takes Shape.' );
?>
	</main><!-- #dp-content -->

	<footer id="colophon" class="dp-footer">
		<div class="dp-footer__rainbow" aria-hidden="true"></div>
		<div class="dp-container dp-footer__grid">

			<div class="dp-footer__col dp-footer__brand">
				<?php doodle_poodle_site_branding(); ?>
				<p class="dp-footer__about"><?php echo esc_html( $about ); ?></p>
				<div class="dp-social">
					<?php if ( $instagram ) : ?>
						<a href="<?php echo esc_url( $instagram ); ?>" aria-label="Instagram" target="_blank" rel="noopener">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"></rect><circle cx="12" cy="12" r="4"></circle><line x1="17.5" y1="6.5" x2="17.5" y2="6.5"></line></svg>
						</a>
					<?php endif; ?>
					<?php if ( $facebook ) : ?>
						<a href="<?php echo esc_url( $facebook ); ?>" aria-label="Facebook" target="_blank" rel="noopener">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
						</a>
					<?php endif; ?>
					<?php if ( $youtube ) : ?>
						<a href="<?php echo esc_url( $youtube ); ?>" aria-label="YouTube" target="_blank" rel="noopener">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="dp-footer__col">
				<h3 class="widget-title"><?php esc_html_e( 'Shop', 'doodle-poodle' ); ?></h3>
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'dp-footer__menu', 'container' => false, 'depth' => 1 ) );
				} elseif ( is_active_sidebar( 'footer-2' ) ) {
					dynamic_sidebar( 'footer-2' );
				} else {
					echo '<ul class="dp-footer__menu">';
					if ( class_exists( 'WooCommerce' ) ) {
						echo '<li><a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '">' . esc_html__( 'All Products', 'doodle-poodle' ) . '</a></li>';
					}
					echo '<li><a href="' . esc_url( home_url( '/about/' ) ) . '">' . esc_html__( 'About Us', 'doodle-poodle' ) . '</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/blog/' ) ) . '">' . esc_html__( 'Blog', 'doodle-poodle' ) . '</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">' . esc_html__( 'Contact', 'doodle-poodle' ) . '</a></li>';
					echo '</ul>';
				}
				?>
			</div>

			<div class="dp-footer__col">
				<h3 class="widget-title"><?php esc_html_e( 'Help', 'doodle-poodle' ); ?></h3>
				<?php if ( is_active_sidebar( 'footer-3' ) ) : dynamic_sidebar( 'footer-3' ); else : ?>
					<ul class="dp-footer__menu">
						<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'FAQs', 'doodle-poodle' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/shipping/' ) ); ?>"><?php esc_html_e( 'Shipping', 'doodle-poodle' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/refund-policy/' ) ); ?>"><?php esc_html_e( 'Refund Policy', 'doodle-poodle' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'doodle-poodle' ); ?></a></li>
					</ul>
				<?php endif; ?>
			</div>

			<div class="dp-footer__col">
				<h3 class="widget-title"><?php esc_html_e( 'Get in Touch', 'doodle-poodle' ); ?></h3>
				<ul class="dp-contact-list">
					<?php if ( $address ) : ?><li><?php echo esc_html( $address ); ?></li><?php endif; ?>
					<?php if ( $phone ) : ?><li><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li><?php endif; ?>
					<?php if ( $email ) : ?><li><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li><?php endif; ?>
				</ul>
				<span class="dp-made-in">🇮🇳 <?php esc_html_e( 'Made in India · VISHVAKRIT', 'doodle-poodle' ); ?></span>
			</div>

		</div>

		<div class="dp-footer__bottom">
			<div class="dp-container dp-footer__bottom-inner">
				<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. <?php esc_html_e( 'All rights reserved. A brand by VISHVAKRIT.', 'doodle-poodle' ); ?></p>
				<p class="dp-footer__tag"><?php esc_html_e( "Let's Create, Colour & Connect!", 'doodle-poodle' ); ?></p>
			</div>
		</div>
	</footer>

</div><!-- #page -->

<?php if ( $whatsapp ) : ?>
	<a class="dp-whatsapp-float" href="https://wa.me/<?php echo esc_attr( preg_replace( '/\D+/', '', $whatsapp ) ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Chat on WhatsApp', 'doodle-poodle' ); ?>">
		<svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163a11.867 11.867 0 0 1-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.82 11.82 0 0 1 8.413 3.488 11.82 11.82 0 0 1 3.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 0 1-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 0 0 1.523 5.276l-.999 3.648 3.744-.982zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
	</a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
