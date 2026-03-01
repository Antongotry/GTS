<?php

/**
 * GTS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GTS
 */

// ---------------------------------------------------------------------------
// GTS Settings – top-level admin menu (header phone, etc.)
// ---------------------------------------------------------------------------

function gts_settings_menu_register() {
	add_menu_page(
		__( 'GTS Settings', 'gts-theme' ),
		__( 'GTS', 'gts-theme' ),
		'manage_options',
		'gts-settings',
		'gts_settings_page_render',
		'dashicons-admin-generic',
		30
	);
}
add_action( 'admin_menu', 'gts_settings_menu_register', 20 );

function gts_settings_register_options() {
	register_setting( 'gts_settings_group', 'gts_header_phone', array(
		'type'              => 'string',
		'default'           => '+44 00 1111 2222',
		'sanitize_callback' => 'gts_sanitize_header_phone',
	) );
}
add_action( 'admin_init', 'gts_settings_register_options' );

function gts_sanitize_header_phone( $value ) {
	$value = is_string( $value ) ? $value : '';
	$value = preg_replace( '/[^\d\s+\-()]/', '', $value );
	return trim( $value );
}

function gts_header_phone_tel_digits( $display_phone ) {
	$display_phone = is_string( $display_phone ) ? $display_phone : '';
	return preg_replace( '/\D/', '', $display_phone );
}

function gts_settings_page_render() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$header_phone = get_option( 'gts_header_phone', '+44 00 1111 2222' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'GTS Settings', 'gts-theme' ); ?></h1>
		<form method="post" action="options.php">
			<?php settings_fields( 'gts_settings_group' ); ?>
			<table class="form-table">
				<tr>
					<th><label for="gts_header_phone"><?php esc_html_e( 'Header phone number', 'gts-theme' ); ?></label></th>
					<td>
						<input type="text" id="gts_header_phone" name="gts_header_phone" value="<?php echo esc_attr( $header_phone ); ?>" class="regular-text" placeholder="+44 00 1111 2222">
						<p class="description"><?php esc_html_e( 'Shown in the header on all screen sizes.', 'gts-theme' ); ?></p>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

// ==========================================================================
// DEVELOPMENT MODE - CACHE DISABLED
// TODO: Remove this section before production deployment
// ==========================================================================

if (! defined('_S_VERSION')) {
	// Use timestamp for cache busting during development
	define('_S_VERSION', time());
}

/**
 * Disable all caching during development
 * TODO: Remove this function before production
 */
function gts_disable_caching()
{
	// Disable browser caching
	header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
	header('Pragma: no-cache');
	header('Expires: 0');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	header('ETag: ' . md5(time()));
}
add_action('send_headers', 'gts_disable_caching');

// Disable WordPress caching
define('DONOTCACHEPAGE', true);
define('DONOTCACHEOBJECT', true);
define('DONOTCACHEDB', true);
define('WP_CACHE', false);

// Disable caching plugins
if (! defined('DONOTCACHEPAGE')) {
	define('DONOTCACHEPAGE', true);
}

// Disable object cache
if (function_exists('wp_cache_flush')) {
	wp_cache_flush();
}

/**
 * Disable caching plugins (WP Super Cache, W3 Total Cache, etc.)
 * TODO: Remove before production
 */
add_filter('do_rocket_generate_caching_files', '__return_false', 999);
add_filter('rocket_cache_reject_uri', '__return_true', 999);
add_filter('wp_cache_ob_callback_filter', '__return_false');
add_filter('w3tc_can_print_comment', '__return_false');

/**
 * Disable browser caching for CSS/JS files
 * TODO: Remove before production
 */
function gts_disable_asset_caching($src)
{
	if (strpos($src, '.css') !== false || strpos($src, '.js') !== false) {
		$src = add_query_arg('v', time(), $src);
	}
	return $src;
}
add_filter('style_loader_src', 'gts_disable_asset_caching', 10, 1);
add_filter('script_loader_src', 'gts_disable_asset_caching', 10, 1);

// ==========================================================================
// END DEVELOPMENT MODE
// ==========================================================================

/**
 * Enqueue custom admin styles for ACF
 */
function gts_admin_styles()
{
	$screen = get_current_screen();
	// Only load on service edit page
	if ($screen && ($screen->post_type === 'service' || $screen->id === 'service')) {
		wp_enqueue_style(
			'gts-admin-acf',
			get_template_directory_uri() . '/assets/css/admin-acf.css',
			array(),
			filemtime(get_template_directory() . '/assets/css/admin-acf.css')
		);
	}
}
add_action('admin_enqueue_scripts', 'gts_admin_styles');


/**
 * Allowed HTML for inline SVG in hero (theme icons).
 *
 * @return array Allowed tags and attributes for wp_kses.
 */
function gts_allowed_svg_hero()
{
	return array(
		'svg'       => array(
			'xmlns'       => true,
			'viewbox'     => true,
			'viewBox'     => true,
			'width'       => true,
			'height'      => true,
			'fill'        => true,
			'aria-hidden' => true,
		),
		'g'         => array(
			'clip-path' => true,
		),
		'defs'      => array(),
		'clipPath'  => array(
			'id' => true,
			'clipPathUnits' => true,
		),
		'rect'      => array(
			'width' => true,
			'height' => true,
			'fill' => true,
		),
		'path'      => array(
			'd'     => true,
			'fill'  => true,
			'stroke' => true,
			'stroke-width' => true,
		),
		'circle'    => array(
			'cx' => true,
			'cy' => true,
			'r'  => true,
			'fill' => true,
			'stroke' => true,
			'stroke-width' => true,
		),
	);
}

/**
 * Hide admin bar on frontend (keep it in admin panel)
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gts_theme_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on GTS, use a find and replace
		* to change 'gts-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('gts-theme', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'gts-theme'),
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
	add_theme_support('customize-selective-refresh-widgets');

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
add_action('after_setup_theme', 'gts_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gts_theme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('gts_theme_content_width', 640);
}
add_action('after_setup_theme', 'gts_theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gts_theme_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'gts-theme'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'gts-theme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'gts_theme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function gts_theme_scripts()
{
	// DEVELOPMENT MODE: Use timestamp for cache busting
	// TODO: Change to static version before production
	$version = time(); // Development: always new version

	// Google Fonts are preloaded in header.php - no need to enqueue here
	// This prevents render-blocking

	// Main stylesheet - critical CSS is inlined in header.php
	wp_enqueue_style('gts-theme-style', get_stylesheet_uri(), array(), $version);
	wp_style_add_data('gts-theme-style', 'rtl', 'replace');

	// Essential scripts - loaded with defer
	wp_enqueue_script('gts-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $version, true);
	wp_enqueue_script('gts-form-selects', get_template_directory_uri() . '/js/form-selects.js', array(), $version, true);
	wp_enqueue_script('gts-datetime-placeholder', get_template_directory_uri() . '/js/datetime-placeholder.js', array(), $version, true);
	wp_enqueue_script('gts-mobile-menu', get_template_directory_uri() . '/js/mobile-menu.js', array(), $version, true);
	wp_enqueue_script('gts-faq-accordion', get_template_directory_uri() . '/js/faq-accordion.js', array(), $version, true);
	wp_enqueue_script('gts-booking-form-validation', get_template_directory_uri() . '/js/booking-form-validation.js', array(), $version, true);

	// Swiper for sliders - lower priority, deferred
	wp_enqueue_style('gts-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0');
	wp_enqueue_script('gts-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true);
	wp_enqueue_script('gts-trusted-by-slider', get_template_directory_uri() . '/js/trusted-by-slider.js', array('gts-swiper'), $version, true);

	$is_product_page = function_exists( 'is_product' ) && is_product();

	if (is_page_template('page-limousine-service.php') || is_page_template('page-city-to-city.php') || is_page('limousine-service') || is_page('city-to-city') || is_page('Limousine Service') || is_page('City-to-City') || is_singular('service') || $is_product_page) {
		wp_enqueue_script('gts-fleet-slider', get_template_directory_uri() . '/js/fleet-slider.js', array('gts-swiper'), $version, true);
	}

	if ( $is_product_page ) {
		wp_enqueue_script( 'gts-single-fleet-product-gallery', get_template_directory_uri() . '/js/single-fleet-product-gallery.js', array( 'gts-swiper' ), $version, true );
	}

	if ( is_page_template( 'page-fleet.php' ) || is_page( 'fleet' ) ) {
		wp_enqueue_script( 'gts-fleet-ground-sliders', get_template_directory_uri() . '/js/fleet-ground-sliders.js', array( 'gts-swiper' ), $version, true );
		wp_enqueue_script( 'gts-fleet-slider', get_template_directory_uri() . '/js/fleet-slider.js', array( 'gts-swiper' ), $version, true );
	}

	if (is_page_template('page-book-a-transfer.php') || is_page('book-a-transfer')) {
		wp_enqueue_script('gts-transfer-form', get_template_directory_uri() . '/js/transfer-form.js', array(), $version, true);
		wp_enqueue_script('gts-transfer-autocomplete', get_template_directory_uri() . '/js/transfer-autocomplete.js', array('gts-transfer-form'), $version, true);
		wp_localize_script(
			'gts-transfer-form',
			'gtsTransferConfig',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'gts_transfer_nonce' ),
			)
		);
	}

	// Lenis - smooth scrolling for entire site (only desktop, loaded via JS check)
	wp_enqueue_script('lenis', 'https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.42/dist/lenis.min.js', array(), '1.0.42', true);
	wp_enqueue_script('gts-lenis-init', get_template_directory_uri() . '/js/lenis-init.js', array('lenis'), $version, true);

	// GSAP and ScrollTrigger - on front page, Limousine Service page, and Service CPT pages for animations
	if (is_front_page() || is_page_template('page-limousine-service.php') || is_page_template('page-city-to-city.php') || is_page('limousine-service') || is_page('city-to-city') || is_page('Limousine Service') || is_page('City-to-City') || is_singular('service')) {
		wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', array(), '3.12.5', true);
		wp_enqueue_script('gsap-scrolltrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', array('gsap'), '3.12.5', true);
		wp_enqueue_script('gts-how-it-works-scroll', get_template_directory_uri() . '/js/how-it-works-scroll.js', array('lenis', 'gsap', 'gsap-scrolltrigger'), $version, true);
	}

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'gts_theme_scripts');

/**
 * Add defer attribute to heavy scripts for non-blocking loading
 */
function gts_defer_scripts($tag, $handle, $src)
{
	// Only defer heavy/non-critical scripts
	$defer_scripts = array(
		'gts-swiper',
		'gts-trusted-by-slider',
		'gts-fleet-ground-sliders',
		'gts-fleet-slider',
		'gts-single-fleet-product-gallery',
		'lenis',
		'gts-lenis-init',
		'gsap',
		'gsap-scrolltrigger',
		'gts-how-it-works-scroll',
	);

	if (in_array($handle, $defer_scripts, true)) {
		return str_replace(' src', ' defer src', $tag);
	}

	return $tag;
}
add_filter('script_loader_tag', 'gts_defer_scripts', 10, 3);

/**
 * Add media="print" onload trick for non-critical CSS
 * NOTE: Main stylesheet loads normally - async breaks rendering!
 */
function gts_optimize_styles($html, $handle, $href, $media)
{
	// Only Swiper CSS is non-critical - load asynchronously
	if ('gts-swiper' === $handle) {
		return '<link rel="stylesheet" id="' . esc_attr($handle) . '-css" href="' . esc_url($href) . '" media="print" onload="this.media=\'all\'">' . "\n" .
			'<noscript><link rel="stylesheet" href="' . esc_url($href) . '"></noscript>' . "\n";
	}

	return $html;
}
add_filter('style_loader_tag', 'gts_optimize_styles', 10, 4);

/**
 * Remove WordPress emoji scripts - they add to TBT
 */
function gts_disable_emojis()
{
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'gts_disable_emojis');

/**
 * Remove unnecessary WordPress head items
 */
function gts_cleanup_head()
{
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_shortlink_wp_head');
	remove_action('wp_head', 'rest_output_link_wp_head');
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
}
add_action('init', 'gts_cleanup_head');

/**
 * Handle Contacts page form submission.
 */
function gts_handle_contact_form()
{
	if (! is_page_template('page-contacts.php') || empty($_SERVER['REQUEST_METHOD']) || 'POST' !== $_SERVER['REQUEST_METHOD']) {
		return;
	}
	if (empty($_POST['gts_contact_nonce']) || ! wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['gts_contact_nonce'])), 'gts_contact_form')) {
		return;
	}
	$first = isset($_POST['gts_first_name']) ? sanitize_text_field(wp_unslash($_POST['gts_first_name'])) : '';
	$last  = isset($_POST['gts_last_name']) ? sanitize_text_field(wp_unslash($_POST['gts_last_name'])) : '';
	$phone = isset($_POST['gts_phone']) ? sanitize_text_field(wp_unslash($_POST['gts_phone'])) : '';
	$email = isset($_POST['gts_email']) ? sanitize_email(wp_unslash($_POST['gts_email'])) : '';
	$details = isset($_POST['gts_details']) ? sanitize_textarea_field(wp_unslash($_POST['gts_details'])) : '';
	if (! $first || ! $last || ! $phone || ! $email || ! is_email($email)) {
		return;
	}
	$to      = get_option('admin_email');
	$subject = sprintf( /* translators: 1: site name */__('[%1$s] New contact request', 'gts-theme'), get_bloginfo('name'));
	$body    = sprintf(
		"First name: %s\nLast name: %s\nPhone: %s\nEmail: %s\n\nDetails:\n%s",
		$first,
		$last,
		$phone,
		$email,
		$details
	);
	$headers = array('Content-Type: text/plain; charset=UTF-8');
	wp_mail($to, $subject, $body, $headers);
	$redirect = add_query_arg('gts_contact_sent', '1', get_permalink());
	wp_safe_redirect($redirect);
	exit;
}
add_action('template_redirect', 'gts_handle_contact_form');

/**
 * Temporary: redirect all pages to home except front page and 404.
 * TODO: Remove when all pages are ready.
 */
function gts_restrict_pages() {
	if ( is_admin() || is_front_page() || is_404() || wp_doing_ajax() ) {
		return;
	}
	wp_safe_redirect( home_url( '/' ), 302 );
	exit;
}
add_action( 'template_redirect', 'gts_restrict_pages' );

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
 * REST API: fleet modals HTML (inject on open, remove on close).
 */
require get_template_directory() . '/inc/fleet-modals-api.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Service CPT and ACF fields
 */
require get_template_directory() . '/inc/cpt-service.php';
require get_template_directory() . '/inc/acf-fields-service.php';
require get_template_directory() . '/inc/service-defaults.php';
require get_template_directory() . '/inc/calculator-options.php';
require get_template_directory() . '/inc/calculator-ajax.php';
