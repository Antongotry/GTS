<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package GTS
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function gts_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'gts_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function gts_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'gts_theme_pingback_header' );

/**
 * Generate navigation arrows HTML
 *
 * @param string $prev_class CSS class for previous button (e.g., 'swiper-prev').
 * @param string $next_class CSS class for next button (e.g., 'swiper-next').
 * @param string $prev_label Aria label for previous button.
 * @param string $next_label Aria label for next button.
 * @return string HTML markup for navigation arrows.
 */
function gts_nav_arrows( $prev_class = '', $next_class = '', $prev_label = 'Previous', $next_label = 'Next' ) {
	$arrow_left_url  = get_site_url() . '/wp-content/uploads/2026/01/left.svg';
	$arrow_right_url = get_site_url() . '/wp-content/uploads/2026/01/right.svg';

	$prev_class = ! empty( $prev_class ) ? ' ' . esc_attr( $prev_class ) : '';
	$next_class = ! empty( $next_class ) ? ' ' . esc_attr( $next_class ) : '';

	ob_start();
	?>
	<div class="nav-arrows">
		<button class="nav-arrow<?php echo esc_attr( $prev_class ); ?>" type="button" aria-label="<?php echo esc_attr( $prev_label ); ?>">
			<img src="<?php echo esc_url( $arrow_left_url ); ?>" alt="" width="11" height="12" class="nav-arrow-icon">
		</button>
		<button class="nav-arrow<?php echo esc_attr( $next_class ); ?>" type="button" aria-label="<?php echo esc_attr( $next_label ); ?>">
			<img src="<?php echo esc_url( $arrow_right_url ); ?>" alt="" width="11" height="12" class="nav-arrow-icon">
		</button>
	</div>
	<?php
	return ob_get_clean();
}
