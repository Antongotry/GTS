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
						<li><a href="<?php echo esc_url(home_url('/events')); ?>">Events</a></li>
						<li><a href="<?php echo esc_url(home_url('/for-business')); ?>">For Business</a></li>
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
			<ul class="footer-language-list">
				<li class="footer-language-item footer-language-item-active">
					<span>English</span>
					<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/check.svg'); ?>" alt="Selected" class="footer-language-check" width="20" height="20">
				</li>
				<li class="footer-language-item"><a href="#">French</a></li>
				<li class="footer-language-item"><a href="#">German</a></li>
				<li class="footer-language-item"><a href="#">Italian</a></li>
				<li class="footer-language-item"><a href="#">Spanish</a></li>
				<li class="footer-language-item"><a href="#">Arabic</a></li>
				<li class="footer-language-item"><a href="#">Chinese</a></li>
			</ul>
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
				<li><a href="<?php echo esc_url(home_url('/services/shoping/')); ?>">Shoping</a></li>
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
			<a href="#" class="footer-button footer-button-secondary">Explore services</a>
			<div class="footer-phone">
				<a href="tel:+440011112222">+44 00 1111 2222</a>
			</div>
			<div class="footer-social">
				<h4 class="footer-social-title">Social networks:</h4>
				<div class="footer-social-icons">
					<a href="#" class="footer-social-icon" aria-label="Telegram">
						<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/telegram.svg'); ?>" alt="Telegram" width="25" height="25">
					</a>
					<a href="#" class="footer-social-icon" aria-label="Viber">
						<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/viber.svg'); ?>" alt="Viber" width="25" height="25">
					</a>
					<a href="#" class="footer-social-icon" aria-label="WhatsApp">
						<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/wahts-footr.svg?v=2'); ?>" alt="WhatsApp" width="25" height="25">
					</a>
					<a href="#" class="footer-social-icon" aria-label="Facebook">
						<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/fb.svg'); ?>" alt="Facebook" width="25" height="25">
					</a>
					<a href="#" class="footer-social-icon" aria-label="Instagram">
						<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/inst.svg'); ?>" alt="Instagram" width="25" height="25">
					</a>
				</div>
			</div>
			<div class="footer-email">
				<h4 class="footer-email-title">E-mail</h4>
				<a href="mailto:info@gmail.com" class="footer-email-link">info@gmail.com</a>
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

	<a href="#" class="whatsapp-float" aria-label="WhatsApp">
		<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/Whatsapp1.svg?v=2'); ?>" alt="WhatsApp" width="22" height="22">
	</a>
</footer>
