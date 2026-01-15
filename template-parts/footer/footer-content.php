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
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/GTS-white.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="70" height="auto">
				</a>
			</div>
			<div class="footer-bottom-links">
				<a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>">Privacy policy</a>
				<span class="footer-bottom-separator">•</span>
				<a href="<?php echo esc_url( home_url( '/terms' ) ); ?>">Terms</a>
				<span class="footer-bottom-separator">•</span>
				<span class="footer-copyright">© <?php echo esc_html( date( 'Y' ) ); ?> GTS</span>
			</div>
		</div>

		<div class="footer-menu">
			<h3 class="footer-title">Menu</h3>
			<nav class="footer-navigation">
				<?php
				if ( has_nav_menu( 'footer-menu' ) ) {
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
						<li><a href="<?php echo esc_url( home_url( '/events' ) ); ?>">Events</a></li>
						<li><a href="<?php echo esc_url( home_url( '/for-business' ) ); ?>">For Business</a></li>
						<li><a href="<?php echo esc_url( home_url( '/fleet' ) ); ?>">Fleet</a></li>
						<li><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Blog</a></li>
						<li><a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>">Contacts</a></li>
						<li><a href="<?php echo esc_url( home_url( '/about-us' ) ); ?>">About Us</a></li>
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
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/check.svg' ); ?>" alt="Selected" class="footer-language-check" width="20" height="20">
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
				<li><a href="#">Book a Flight</a></li>
				<li><a href="#">City-to-City Rides</a></li>
				<li><a href="#">Airport Transfers</a></li>
				<li><a href="#">Hourly Hire</a></li>
				<li><a href="#">Chauffeur Service</a></li>
				<li><a href="#">Limousine Service</a></li>
				<li><a href="#">Corporations</a></li>
				<li><a href="#">Travel Agencies</a></li>
				<li><a href="#">Mobility Partnerships</a></li>
			</ul>
			<ul class="footer-services-list footer-services-list-right">
				<li><a href="#">Medical Transportation</a></li>
				<li><a href="#">Concierge Support</a></li>
				<li><a href="#">Travel Personal Interpreter</a></li>
				<li><a href="#">Travel Planning</a></li>
			</ul>
		</div>

		<div class="footer-right">
			<a href="#" class="footer-button footer-button-primary">Book a transfer</a>
			<div class="footer-phone">
				<a href="tel:+440011112222">+44 00 1111 2222</a>
			</div>
			<div class="footer-social">
				<h4 class="footer-social-title">Social networks:</h4>
				<div class="footer-social-icons">
					<a href="#" class="footer-social-icon" aria-label="Telegram">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/telegram-icon.svg' ); ?>" alt="Telegram" width="24" height="24">
					</a>
					<a href="#" class="footer-social-icon" aria-label="Call">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/call-icon.svg' ); ?>" alt="Call" width="24" height="24">
					</a>
					<a href="#" class="footer-social-icon" aria-label="WhatsApp">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/whatsapp-icon.svg' ); ?>" alt="WhatsApp" width="24" height="24">
					</a>
					<a href="#" class="footer-social-icon" aria-label="Facebook">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/facebook-icon.svg' ); ?>" alt="Facebook" width="24" height="24">
					</a>
					<a href="#" class="footer-social-icon" aria-label="Instagram">
						<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/instagram-icon.svg' ); ?>" alt="Instagram" width="24" height="24">
					</a>
				</div>
			</div>
			<div class="footer-email">
				<h4 class="footer-email-title">E-mail</h4>
				<a href="mailto:info@gmail.com" class="footer-email-link">info@gmail.com</a>
			</div>
			<div class="footer-developed">
				<span>Developed by Artko</span>
			</div>
		</div>
	</div>
</footer>
