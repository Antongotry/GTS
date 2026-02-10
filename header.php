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
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- DNS prefetch and preconnect for faster external resource loading -->
	<link rel="dns-prefetch" href="//fonts.googleapis.com">
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link rel="dns-prefetch" href="//cdn.jsdelivr.net">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

	<!-- Preload critical fonts -->
	<link rel="preload" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<noscript>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap">
	</noscript>

	<!-- Preload hero image for LCP optimization - mobile first -->
	<?php if (is_front_page()) : ?>
		<link rel="preload" as="image" type="image/webp" fetchpriority="high"
			href="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/hero-banner-375_result.webp'); ?>"
			media="(max-width: 767px)">
		<link rel="preload" as="image" type="image/webp"
			href="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/hero-baner-1920_result-scaled.webp'); ?>"
			media="(min-width: 768px)">
	<?php endif; ?>

	<!-- Critical CSS inline for above-the-fold content -->
	<style id="critical-css">
		/* Critical CSS for fast FCP/LCP - CLS prevention */
		*,
		*::before,
		*::after {
			box-sizing: border-box
		}

		html {
			-webkit-text-size-adjust: 100%
		}

		body {
			margin: 0;
			font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
			-webkit-font-smoothing: antialiased;
			background: #1a1a2e;
			font-size-adjust: 0.5
		}

		/* Prevent font-swap CLS */
		@font-face {
			font-family: 'Manrope';
			font-display: swap;
			size-adjust: 100%;
			ascent-override: 95%;
			descent-override: 25%;
			line-gap-override: 0%
		}

		img {
			max-width: 100%;
			height: auto;
			display: block
		}

		/* Header */
		.site-header {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			z-index: 1000;
			background: transparent;
			padding: 20px 40px
		}

		.header-container {
			display: flex;
			align-items: center;
			justify-content: space-between;
			max-width: 1440px;
			margin: 0 auto
		}

		.site-logo img {
			height: 32px;
			width: auto
		}

		/* Hero - LCP critical */
		.hero-block {
			min-height: 100vh;
			background-size: cover;
			background-position: center top;
			display: flex;
			align-items: center;
			position: relative
		}

		.hero-container {
			max-width: 1440px;
			margin: 0 auto;
			width: 100%;
			display: flex;
			justify-content: space-between;
			padding: 0 40px;
			gap: 40px
		}

		.hero-left {
			flex: 1;
			display: flex;
			flex-direction: column;
			justify-content: center;
			padding: 120px 0
		}

		.hero-title {
			font-size: clamp(28px, 4vw, 48px);
			font-weight: 700;
			color: #fff;
			line-height: 1.15;
			margin: 0 0 24px
		}

		.hero-subtitle {
			font-size: 16px;
			color: rgba(255, 255, 255, 0.8);
			margin: 0 0 16px;
			text-transform: uppercase;
			letter-spacing: 0.5px
		}

		.hero-buttons {
			display: flex;
			gap: 16px;
			flex-wrap: wrap
		}

		.btn {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			padding: 14px 28px;
			border-radius: 8px;
			font-weight: 600;
			text-decoration: none;
			transition: all 0.2s
		}

		.btn-primary {
			background: #00C853;
			color: #fff
		}

		.btn-secondary {
			background: transparent;
			color: #fff;
			border: 1px solid rgba(255, 255, 255, 0.3)
		}

		/* Mobile */
		@media(max-width:768px) {
			.site-header {
				padding: 16px 20px
			}

			.hero-container {
				flex-direction: column;
				padding: 0 20px;
				gap: 24px
			}

			.hero-left {
				padding: 100px 0 40px
			}

			.hero-right--desktop {
				display: none
			}

			.main-navigation,
			.header-right {
				display: none
			}
		}
	</style>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div id="page" class="site">

		<header class="site-header">
			<div class="header-container">
				<button class="hamburger-button" aria-label="<?php esc_attr_e('Menu', 'gts-theme'); ?>">
					<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/hamb.svg'); ?>" alt="" class="hamburger-icon" width="28" height="15" fetchpriority="low">
				</button>

				<div class="site-logo">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/GTS.svg'); ?>" alt="<?php bloginfo('name'); ?>" width="80" height="32">
					</a>
				</div>

				<?php
				$posts_page_id = (int) get_option( 'page_for_posts' );
				$blog_url      = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/' );

				$fleet_page = get_page_by_path( 'fleet' );
				$fleet_url  = ( $fleet_page instanceof WP_Post ) ? get_permalink( $fleet_page ) : home_url( '/fleet/' );
				?>

				<nav class="main-navigation">
					<ul class="menu">
						<li class="menu-item menu-item-has-children">
							<a href="#" class="menu-link">
								Services
								<span class="dropdown-icon">
									<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/Vector-2.svg'); ?>" alt="" width="10" height="6">
								</span>
							</a>
							<ul class="sub-menu">
								<li class="sub-menu-item"><a href="#" class="sub-menu-link">Book a Flight</a></li>
								<li class="sub-menu-item"><a href="#" class="sub-menu-link">City-to-City Rides</a></li>
								<li class="sub-menu-item"><a href="#" class="sub-menu-link">Airport Transfers</a></li>
								<li class="sub-menu-item"><a href="#" class="sub-menu-link">Hourly Hire</a></li>
								<li class="sub-menu-item"><a href="#" class="sub-menu-link">Chauffeur Service</a></li>
								<li class="sub-menu-item"><a href="<?php echo esc_url(get_site_url() . '/limousine-service/'); ?>" class="sub-menu-link">Limousine Service</a></li>
								<li class="sub-menu-item"><a href="#" class="sub-menu-link">Medical Transportation</a></li>
								<li class="sub-menu-item"><a href="#" class="sub-menu-link">Travel Planning</a></li>
							</ul>
						</li>
						<li class="menu-item"><a href="#" class="menu-link">Events</a></li>
						<li class="menu-item"><a href="#" class="menu-link">For Business</a></li>
						<li class="menu-item"><a href="<?php echo esc_url( $fleet_url ); ?>" class="menu-link">Fleet</a></li>
						<li class="menu-item"><a href="<?php echo esc_url( $blog_url ); ?>" class="menu-link">Blog</a></li>
						<li class="menu-item"><a href="<?php echo esc_url(home_url('/contacts/')); ?>" class="menu-link">Contacts</a></li>
						<li class="menu-item"><a href="#" class="menu-link">About Us</a></li>
						<li class="menu-item menu-item-highlight"><a href="<?php echo esc_url(home_url('/book-a-transfer/')); ?>" class="menu-link">Book a Transfer</a></li>
					</ul>
				</nav>

				<div class="header-right">
					<div class="language-selector">
						<span class="language-text">EN</span>
						<span class="dropdown-icon">
							<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/Vector-2.svg'); ?>" alt="" width="10" height="6">
						</span>
					</div>
					<a href="mailto:info@gmail.com" class="header-email">info@gmail.com</a>
					<div class="header-buttons">
						<a href="#" class="whatsapp-button" aria-label="WhatsApp">
							<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/Whatsapp1.svg?v=2'); ?>" alt="WhatsApp" width="24" height="24">
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
								<path d="M9 18l6-6-6-6" />
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
						<a href="<?php echo esc_url( $fleet_url ); ?>" class="mobile-menu-link">Fleet</a>
					</li>
					<li class="mobile-menu-item">
						<a href="<?php echo esc_url( $blog_url ); ?>" class="mobile-menu-link">Blog</a>
					</li>
					<li class="mobile-menu-item">
						<a href="<?php echo esc_url(home_url('/contacts/')); ?>" class="mobile-menu-link">Contacts</a>
					</li>
					<li class="mobile-menu-item">
						<a href="#" class="mobile-menu-link">About Us</a>
					</li>
					<li class="mobile-menu-item mobile-menu-item-highlight">
						<a href="<?php echo esc_url(home_url('/book-a-transfer/')); ?>" class="mobile-menu-link">Book a Transfer</a>
					</li>
				</ul>
				<div class="mobile-menu-socials">
					<a href="#" class="mobile-social-link" aria-label="Facebook">
						<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/fb.svg'); ?>" alt="Facebook" width="24" height="24">
					</a>
					<a href="#" class="mobile-social-link" aria-label="Instagram">
						<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/inst.svg'); ?>" alt="Instagram" width="24" height="24">
					</a>
					<a href="#" class="mobile-social-link" aria-label="Telegram">
						<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/telegram.svg'); ?>" alt="Telegram" width="24" height="24">
					</a>
					<a href="#" class="mobile-social-link" aria-label="Viber">
						<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/viber.svg'); ?>" alt="Viber" width="24" height="24">
					</a>
					<a href="#" class="mobile-social-link" aria-label="WhatsApp">
						<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/wahts-footr.svg?v=2'); ?>" alt="WhatsApp" width="24" height="24">
					</a>
				</div>
			</div>

			<!-- Services Submenu Panel (comes from top) -->
			<div class="mobile-menu-panel mobile-menu-submenu" data-submenu-id="services">
				<button class="mobile-submenu-back">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<path d="M15 18l-6-6 6-6" />
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
					<li class="mobile-menu-item"><a href="<?php echo esc_url(get_site_url() . '/limousine-service/'); ?>" class="mobile-menu-link">Limousine Service</a></li>
					<li class="mobile-menu-item"><a href="#" class="mobile-menu-link">Medical Transportation</a></li>
					<li class="mobile-menu-item"><a href="#" class="mobile-menu-link">Travel Planning</a></li>
				</ul>
			</div>
		</nav>
