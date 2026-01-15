<?php
/**
 * GTS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GTS
 */

// ==========================================================================
// DEVELOPMENT MODE - CACHE DISABLED
// TODO: Remove this section before production deployment
// ==========================================================================

if ( ! defined( '_S_VERSION' ) ) {
	// Use timestamp for cache busting during development
	define( '_S_VERSION', time() );
}

/**
 * Disable all caching during development
 * TODO: Remove this function before production
 */
function gts_disable_caching() {
	// Disable browser caching
	header( 'Cache-Control: no-cache, no-store, must-revalidate, max-age=0' );
	header( 'Pragma: no-cache' );
	header( 'Expires: 0' );
	header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
	header( 'ETag: ' . md5( time() ) );
}
add_action( 'send_headers', 'gts_disable_caching' );

// Disable WordPress caching
define( 'DONOTCACHEPAGE', true );
define( 'DONOTCACHEOBJECT', true );
define( 'DONOTCACHEDB', true );
define( 'WP_CACHE', false );

// Disable caching plugins
if ( ! defined( 'DONOTCACHEPAGE' ) ) {
	define( 'DONOTCACHEPAGE', true );
}

// Disable object cache
if ( function_exists( 'wp_cache_flush' ) ) {
	wp_cache_flush();
}

/**
 * Disable caching plugins (WP Super Cache, W3 Total Cache, etc.)
 * TODO: Remove before production
 */
add_filter( 'do_rocket_generate_caching_files', '__return_false', 999 );
add_filter( 'rocket_cache_reject_uri', '__return_true', 999 );
add_filter( 'wp_cache_ob_callback_filter', '__return_false' );
add_filter( 'w3tc_can_print_comment', '__return_false' );

/**
 * Disable browser caching for CSS/JS files
 * TODO: Remove before production
 */
function gts_disable_asset_caching( $src ) {
	if ( strpos( $src, '.css' ) !== false || strpos( $src, '.js' ) !== false ) {
		$src = add_query_arg( 'v', time(), $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'gts_disable_asset_caching', 10, 1 );
add_filter( 'script_loader_src', 'gts_disable_asset_caching', 10, 1 );

// ==========================================================================
// END DEVELOPMENT MODE
// ==========================================================================

/**
 * Hide admin bar on frontend (keep it in admin panel)
 */
add_filter( 'show_admin_bar', '__return_false' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gts_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on GTS, use a find and replace
		* to change 'gts-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'gts-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'gts-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'gts_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'gts_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gts_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gts_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'gts_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gts_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'gts-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'gts-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'gts_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gts_theme_scripts() {
	// DEVELOPMENT MODE: Use timestamp for cache busting
	// TODO: Change to static version before production
	$version = time(); // Development: always new version

	// Enqueue Google Fonts (Manrope)
	wp_enqueue_style( 'gts-manrope-font', 'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'gts-onest-font', 'https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&display=swap', array(), null );

	wp_enqueue_style( 'gts-theme-style', get_stylesheet_uri(), array( 'gts-manrope-font' ), $version );
	wp_style_add_data( 'gts-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'gts-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $version, true );
	wp_enqueue_script( 'gts-form-selects', get_template_directory_uri() . '/js/form-selects.js', array(), $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gts_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
