<?php
/**
 * The header for our theme
 *
 * @package GTS
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

<div id="page" class="site">

<header class="site-header">
	<div class="header-container">
		<button class="hamburger-button" aria-label="<?php esc_attr_e( 'Menu', 'gts-theme' ); ?>">
			<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/hamb.svg' ); ?>" alt="" class="hamburger-icon" width="28" height="15">
		</button>

		<div class="site-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/GTS.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
			</a>
		</div>

		<nav class="main-navigation">
			<ul class="menu">
				<li class="menu-item menu-item-has-children">
					<a href="#" class="menu-link">
						Services
						<span class="dropdown-icon">
							<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/Vector-2.svg' ); ?>" alt="">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="sub-menu-item"><a href="#" class="sub-menu-link">Services 1</a></li>
						<li class="sub-menu-item"><a href="#" class="sub-menu-link">Services 2</a></li>
						<li class="sub-menu-item"><a href="#" class="sub-menu-link">Services 3</a></li>
						<li class="sub-menu-item"><a href="#" class="sub-menu-link">Services 4</a></li>
						<li class="sub-menu-item"><a href="#" class="sub-menu-link">Services 5</a></li>
					</ul>
				</li>
				<li class="menu-item"><a href="#" class="menu-link">Events</a></li>
				<li class="menu-item"><a href="#" class="menu-link">For Business</a></li>
				<li class="menu-item"><a href="#" class="menu-link">Fleet</a></li>
				<li class="menu-item"><a href="#" class="menu-link">Blog</a></li>
				<li class="menu-item"><a href="#" class="menu-link">Contacts</a></li>
				<li class="menu-item"><a href="#" class="menu-link">About Us</a></li>
			</ul>
		</nav>

		<div class="header-right">
			<div class="language-selector">
				<span class="language-text">EN</span>
				<span class="dropdown-icon">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/Vector-2.svg' ); ?>" alt="">
				</span>
			</div>
			<a href="mailto:info@gmail.com" class="header-email">info@gmail.com</a>
			<div class="header-buttons">
				<a href="#" class="whatsapp-button" aria-label="WhatsApp">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/Whatsapp1.svg' ); ?>" alt="WhatsApp" width="24" height="24">
				</a>
				<a href="tel:+440011112222" class="phone-button">+44 00 1111 2222</a>
			</div>
		</div>
	</div>
</header>

<!-- Mobile Menu Drawer -->
<div class="mobile-menu-overlay" aria-hidden="true"></div>
<nav class="mobile-menu-drawer" aria-hidden="true">
	<div class="mobile-menu-handle"></div>

	<!-- Main Menu Panel -->
	<div class="mobile-menu-panel mobile-menu-main">
		<ul class="mobile-menu-list">
			<li class="mobile-menu-item mobile-menu-item-has-submenu">
				<button class="mobile-menu-link mobile-submenu-trigger" data-submenu="services">
					Services
					<svg class="mobile-menu-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<path d="M9 18l6-6-6-6"/>
					</svg>
				</button>
			</li>
			<li class="mobile-menu-item">
				<a href="#" class="mobile-menu-link">Events</a>
			</li>
			<li class="mobile-menu-item">
				<a href="#" class="mobile-menu-link">For Business</a>
			</li>
			<li class="mobile-menu-item">
				<a href="#" class="mobile-menu-link">Fleet</a>
			</li>
			<li class="mobile-menu-item">
				<a href="#" class="mobile-menu-link">Blog</a>
			</li>
			<li class="mobile-menu-item">
				<a href="#" class="mobile-menu-link">Contacts</a>
			</li>
			<li class="mobile-menu-item">
				<a href="#" class="mobile-menu-link">About Us</a>
			</li>
		</ul>
		<div class="mobile-menu-socials">
			<a href="#" class="mobile-social-link" aria-label="Facebook">
				<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/fb.svg' ); ?>" alt="Facebook">
			</a>
			<a href="#" class="mobile-social-link" aria-label="Instagram">
				<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/inst.svg' ); ?>" alt="Instagram">
			</a>
			<a href="#" class="mobile-social-link" aria-label="Telegram">
				<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/telegram.svg' ); ?>" alt="Telegram">
			</a>
			<a href="#" class="mobile-social-link" aria-label="Viber">
				<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/viber.svg' ); ?>" alt="Viber">
			</a>
			<a href="#" class="mobile-social-link" aria-label="WhatsApp">
				<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/wahts-footr.svg' ); ?>" alt="WhatsApp">
			</a>
		</div>
	</div>

	<!-- Services Submenu Panel (comes from top) -->
	<div class="mobile-menu-panel mobile-menu-submenu" data-submenu-id="services">
		<button class="mobile-submenu-back">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
				<path d="M15 18l-6-6 6-6"/>
			</svg>
			Back
		</button>
		<h3 class="mobile-submenu-title">Services</h3>
		<ul class="mobile-menu-list mobile-submenu-list">
			<li class="mobile-menu-item"><a href="#" class="mobile-menu-link">Book a Flight</a></li>
			<li class="mobile-menu-item"><a href="#" class="mobile-menu-link">City-to-City Rides</a></li>
			<li class="mobile-menu-item"><a href="#" class="mobile-menu-link">Airport Transfers</a></li>
			<li class="mobile-menu-item"><a href="#" class="mobile-menu-link">Hourly Hire</a></li>
			<li class="mobile-menu-item"><a href="#" class="mobile-menu-link">Chauffeur Service</a></li>
			<li class="mobile-menu-item"><a href="#" class="mobile-menu-link">Limousine Service</a></li>
			<li class="mobile-menu-item"><a href="#" class="mobile-menu-link">Medical Transportation</a></li>
			<li class="mobile-menu-item"><a href="#" class="mobile-menu-link">Travel Planning</a></li>
		</ul>
	</div>
</nav>
