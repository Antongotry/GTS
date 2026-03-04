<?php

/**
 * Footer Content Template
 *
 * @package GTS
 */
?>

<footer class="site-footer">
	<div class="footer-container">
		<div class="footer-left">
			<div class="footer-logo">
				<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
					<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/GTS-white.svg'); ?>" alt="<?php bloginfo('name'); ?>" width="70" height="auto">
				</a>
			</div>
		</div>

		<div class="footer-menu">
			<h3 class="footer-title">Menu</h3>
			<nav class="footer-navigation">
				<?php
				if (has_nav_menu('footer-menu')) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer-menu',
							'container'      => false,
							'menu_class'     => 'footer-menu-list',
							'fallback_cb'    => false,
						)
					);
				} else {
				?>
					<ul class="footer-menu-list">
						<li><a href="<?php echo esc_url(home_url('/book-a-transfer')); ?>">Book a Transfer</a></li>
						<li><a href="<?php echo esc_url(home_url('/fleet')); ?>">Fleet</a></li>
						<li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a></li>
						<li><a href="<?php echo esc_url(home_url('/contacts')); ?>">Contacts</a></li>
					</ul>
				<?php
				}
				?>
			</nav>
		</div>

		<div class="footer-language">
			<h3 class="footer-title">Site language</h3>
			<?php
			if ( function_exists( 'gts_language_switcher_shortcode' ) ) {
				echo gts_language_switcher_shortcode( array( 'variant' => 'footer' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} else {
				echo do_shortcode( '[language-switcher variant="footer"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
		</div>

		<div class="footer-services">
			<h3 class="footer-title footer-services-title">Services</h3>
			<ul class="footer-services-list footer-services-list-left">
				<li><a href="<?php echo esc_url(home_url('/limousine-service/')); ?>">Limousine Service</a></li>
				<li><a href="<?php echo esc_url(home_url('/city-to-city/')); ?>">City-to-City</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/corporations/')); ?>">Corporations</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/airport-transfer/')); ?>">Airport Transfer</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/mobility-partnership/')); ?>">Mobility Partnership</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/travel-agencies/')); ?>">Travel Agencies</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/private-tours/')); ?>">Private Tours</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/corporate-events-chauffeur-service/')); ?>">Corporate Events Chauffeur Service</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/shoping/')); ?>">Shopping</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/travel-planninig/')); ?>">Travel Planninig</a></li>
			</ul>
			<ul class="footer-services-list footer-services-list-right">
				<li><a href="<?php echo esc_url(home_url('/services/travel-personal-interpreter/')); ?>">Travel Personal Interpreter</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/medical-transportation/')); ?>">Medical Transportation</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/family-travel-chauffeur-service/')); ?>">Family Travel Chauffeur Service</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/cultural-sport-events/')); ?>">Cultural Sport Events</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/wedding/')); ?>">Wedding</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/special-transfers/')); ?>">Special Transfers</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/professional-chauffeur-service/')); ?>">Professional Chauffeur Service</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/airport-transfer-service/')); ?>">Airport Transfer Service</a></li>
				<li><a href="<?php echo esc_url(home_url('/services/hourly-hire/')); ?>">Hourly Hire</a></li>
			</ul>
		</div>

		<div class="footer-right">
			<a href="<?php echo esc_url(home_url('/book-a-transfer/')); ?>" class="footer-button footer-button-primary">Book a transfer</a>
			<a href="#services-block" class="footer-button footer-button-secondary">Explore services</a>
			<?php
			$gts_footer_phone   = get_option( 'gts_header_phone', '+49 170 284 1810' );
			$gts_footer_phone   = $gts_footer_phone ? $gts_footer_phone : '+49 170 284 1810';
			$gts_footer_tel     = function_exists( 'gts_header_phone_tel_digits' ) ? gts_header_phone_tel_digits( $gts_footer_phone ) : preg_replace( '/\D/', '', $gts_footer_phone );
			$gts_footer_email   = get_option( 'gts_header_email', 'info@global-travelsolutions.com' );
			$gts_footer_email   = $gts_footer_email ? $gts_footer_email : 'info@global-travelsolutions.com';
			$gts_footer_wa      = get_option( 'gts_whatsapp_number', '491702841810' );
			$gts_footer_wa      = $gts_footer_wa ? $gts_footer_wa : '491702841810';
			?>
			<div class="footer-phone">
				<a href="tel:<?php echo esc_attr( $gts_footer_tel ); ?>"><?php echo esc_html( $gts_footer_phone ); ?></a>
			</div>
			<div class="footer-social">
				<h4 class="footer-social-title">Social networks:</h4>
				<div class="footer-social-icons">
					<a href="tel:<?php echo esc_attr( $gts_footer_tel ); ?>" class="footer-social-icon" aria-label="Phone">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/icons/phone-icon.svg' ); ?>" alt="Phone" width="25" height="25">
					</a>
					<a href="https://wa.me/<?php echo esc_attr( $gts_footer_wa ); ?>" class="footer-social-icon" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer">
						<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/wahts-footr.svg?v=2'); ?>" alt="WhatsApp" width="25" height="25">
					</a>
				</div>
			</div>
			<div class="footer-email">
				<h4 class="footer-email-title">E-mail</h4>
				<a href="mailto:<?php echo esc_attr( $gts_footer_email ); ?>" class="footer-email-link"><?php echo esc_html( $gts_footer_email ); ?></a>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="footer-bottom-links">
			<a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy policy</a>
			<a href="<?php echo esc_url(home_url('/terms')); ?>">Terms</a>
			<span class="footer-copyright">© <?php echo esc_html(date('Y')); ?> GTS</span>
		</div>
		<div class="footer-developed">
			<span>Developed by Artko</span>
		</div>
	</div>

	<a href="https://wa.me/<?php echo esc_attr( $gts_footer_wa ); ?>" class="whatsapp-float" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer">
		<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/Whatsapp1.svg?v=2'); ?>" alt="WhatsApp" width="22" height="22">
	</a>
</footer>
