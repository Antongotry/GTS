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
				<span class="dropdown-icon">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/Vector-2.svg' ); ?>" alt="">
				</span>
			</div>
			<a href="mailto:info@gmail.com" class="header-email">info@gmail.com</a>
			<a href="#" class="whatsapp-button" aria-label="WhatsApp">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M22.2745 6.63414C21.6885 5.33944 20.8475 4.17705 19.7796 3.17531C18.7117 2.18303 17.4737 1.39865 16.094 0.85053C14.6669 0.28351 13.1549 0 11.5956 0C10.0363 0 8.52421 0.28351 7.09721 0.85053C5.71746 1.39865 4.47947 2.17358 3.41158 3.17531C2.34369 4.17705 1.50262 5.33944 0.916701 6.63414C0.31188 7.97608 0 9.41254 0 10.8868C0 13.4667 0.963925 15.9427 2.73114 17.9084L1.7861 23.0588L6.8137 20.8191C8.31631 21.4617 9.91341 21.783 11.5861 21.783C13.1454 21.783 14.6575 21.4995 16.0845 20.9325C17.4642 20.3844 18.7022 19.6094 19.7701 18.6077C20.838 17.606 21.6791 16.4436 22.265 15.1489C22.8698 13.8069 23.1817 12.3705 23.1817 10.8962C23.1912 9.41253 22.8793 7.98554 22.2745 6.63414Z" fill="white"/>
					<path d="M16.3036 13.0629C15.8122 12.8172 15.4531 12.666 15.1979 12.5715C15.0373 12.5148 14.6593 12.3447 14.527 12.4486C14.1111 12.7888 13.667 13.7528 13.1944 13.9323C12.0226 13.7055 10.9358 12.9022 10.0853 12.0801C9.70728 11.721 9.00796 10.7003 8.85675 10.4263C8.8284 10.1427 9.3387 9.76473 9.45211 9.54738C10.038 8.88585 9.59388 8.47004 9.51828 8.19598C9.38597 7.91247 9.15917 7.40215 8.96072 6.98634C8.79061 6.71228 8.75277 6.30591 8.45036 6.15471C7.16511 5.49318 6.42803 6.81623 6.12561 7.5061C4.3017 11.9005 15.2641 20.2641 17.4944 14.4994C17.6078 13.9985 17.5605 13.8095 17.3904 13.5827C17.0502 13.3464 16.6533 13.2425 16.3036 13.0629Z" fill="#25D366"/>
				</svg>
			</a>
			<a href="tel:+440011112222" class="phone-button">+44 00 1111 2222</a>
		</div>
	</div>
</header>
