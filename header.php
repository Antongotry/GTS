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
						<!-- Dropdown items will be added here -->
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
	</div>
</header>
