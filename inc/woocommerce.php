<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package GTS
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function gts_theme_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'gts_theme_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function gts_theme_woocommerce_scripts() {
	wp_enqueue_style( 'gts-theme-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'gts-theme-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'gts_theme_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function gts_theme_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'gts_theme_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function gts_theme_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'gts_theme_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Breadcrumb defaults for WooCommerce.
 *
 * @param array $defaults Default breadcrumb settings.
 * @return array
 */
function gts_theme_woocommerce_breadcrumb_defaults( $defaults ) {
	$defaults['delimiter'] = ' / ';
	$defaults['home']      = 'Fleet';
	$defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb" aria-label="Breadcrumbs">';
	$defaults['wrap_after']  = '</nav>';

	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'gts_theme_woocommerce_breadcrumb_defaults' );

if ( ! function_exists( 'gts_theme_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function gts_theme_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'gts_theme_woocommerce_wrapper_before' );

if ( ! function_exists( 'gts_theme_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function gts_theme_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'gts_theme_woocommerce_wrapper_after' );

/**
 * Simplify archive/category loop UI for fleet pages.
 *
 * @return void
 */
function gts_theme_customize_product_archive_ui() {
	// Remove utility controls that break custom fleet layout style.
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

	// Remove sale badges in archive cards for cleaner UI.
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
}
add_action( 'wp', 'gts_theme_customize_product_archive_ui' );

/**
 * Get available attribute taxonomies for fleet archive filters.
 *
 * @return array
 */
function gts_theme_get_filterable_attribute_taxonomies() {
	$taxonomies = array();
	$names      = function_exists( 'wc_get_attribute_taxonomy_names' ) ? wc_get_attribute_taxonomy_names() : array();

	if ( empty( $names ) || ! is_array( $names ) ) {
		return $taxonomies;
	}

	foreach ( $names as $taxonomy ) {
		if ( taxonomy_exists( $taxonomy ) ) {
			$taxonomies[] = $taxonomy;
		}
	}

	return $taxonomies;
}

/**
 * Read selected archive filters from query string.
 *
 * @return array
 */
function gts_theme_get_archive_selected_filters() {
	$selected   = array();
	$taxonomies = gts_theme_get_filterable_attribute_taxonomies();

	foreach ( $taxonomies as $taxonomy ) {
		$key = 'gtsf_' . $taxonomy;
		if ( empty( $_GET[ $key ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			continue;
		}

		$raw = wp_unslash( $_GET[ $key ] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( ! is_array( $raw ) ) {
			$raw = array( $raw );
		}

		$values = array_values(
			array_filter(
				array_map( 'sanitize_title', $raw )
			)
		);

		if ( empty( $values ) ) {
			continue;
		}

		// Keep only slugs that exist for this taxonomy (typos / forged query args).
		$valid_slugs = get_terms(
			array(
				'taxonomy'   => $taxonomy,
				'hide_empty' => false,
				'slug'       => $values,
				'fields'     => 'slugs',
			)
		);

		if ( is_wp_error( $valid_slugs ) || empty( $valid_slugs ) ) {
			continue;
		}

		$selected[ $taxonomy ] = $valid_slugs;
	}

	return $selected;
}

/**
 * Apply attribute filters on WooCommerce archive/category pages.
 *
 * @param WP_Query $query Query object.
 * @return void
 */
function gts_theme_apply_archive_attribute_filters( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( ! ( is_shop() || is_product_taxonomy() ) ) {
		return;
	}

	$selected = gts_theme_get_archive_selected_filters();
	if ( empty( $selected ) ) {
		return;
	}

	$tax_query = (array) $query->get( 'tax_query', array() );

	foreach ( $selected as $taxonomy => $terms ) {
		$tax_query[] = array(
			'taxonomy' => $taxonomy,
			'field'    => 'slug',
			'terms'    => $terms,
			'operator' => 'IN',
		);
	}

	$query->set( 'tax_query', $tax_query );
}
add_action( 'pre_get_posts', 'gts_theme_apply_archive_attribute_filters' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'gts_theme_woocommerce_header_cart' ) ) {
			gts_theme_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'gts_theme_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function gts_theme_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		gts_theme_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'gts_theme_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'gts_theme_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function gts_theme_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'gts-theme' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'gts-theme' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'gts_theme_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function gts_theme_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php gts_theme_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}
