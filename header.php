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
				<span class="language-arrow">▼</span>
			</div>
			<a href="mailto:info@gmail.com" class="header-email">info@gmail.com</a>
			<a href="#" class="whatsapp-button" aria-label="WhatsApp">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" fill="white"/>
				</svg>
			</a>
			<a href="tel:+440011112222" class="phone-button">+44 00 1111 2222</a>
		</div>
	</div>
</header>
