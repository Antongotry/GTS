<?php

/**
 * GTS Transfer Calculator AJAX Handlers
 * Dynamic vehicle selection from WooCommerce
 *
 * @package GTS
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Get WooCommerce Product Categories for Vehicle Type dropdown
 */
function gts_get_vehicle_categories()
{
	$categories = get_terms(array(
		'taxonomy' => 'product_cat',
		'hide_empty' => true,
		'orderby' => 'name',
		'order' => 'ASC',
	));

	$result = array();

	if (!is_wp_error($categories) && !empty($categories)) {
		foreach ($categories as $cat) {
			// Skip "Uncategorized" category
			if ($cat->slug === 'uncategorized') {
				continue;
			}

			$result[] = array(
				'id' => $cat->term_id,
				'name' => $cat->name,
				'slug' => $cat->slug,
				'count' => $cat->count,
			);
		}
	}

	return $result;
}

/**
 * AJAX: Get Vehicle Categories
 */
function gts_ajax_get_vehicle_categories()
{
	$categories = gts_get_vehicle_categories();

	wp_send_json_success(array(
		'categories' => $categories,
	));
}
add_action('wp_ajax_gts_get_vehicle_categories', 'gts_ajax_get_vehicle_categories');
add_action('wp_ajax_nopriv_gts_get_vehicle_categories', 'gts_ajax_get_vehicle_categories');

/**
 * AJAX: Get Vehicles by Category
 */
function gts_ajax_get_vehicles_by_category()
{
	$category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;

	if (!$category_id) {
		wp_send_json_error(array('message' => 'Category ID required'));
	}

	$args = array(
		'post_type' => 'product',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'term_id',
				'terms' => $category_id,
			),
		),
		'orderby' => 'title',
		'order' => 'ASC',
	);

	$products = get_posts($args);
	$vehicles = array();

	foreach ($products as $product_post) {
		$product = wc_get_product($product_post->ID);

		if (!$product) {
			continue;
		}

		// Get custom meta for passengers and bags
		$max_passengers = get_post_meta($product_post->ID, '_max_passengers', true);
		$max_bags = get_post_meta($product_post->ID, '_max_bags', true);

		$vehicles[] = array(
			'id' => $product_post->ID,
			'name' => $product->get_name(),
			'price' => $product->get_price(),
			'formatted_price' => wc_price($product->get_price()),
			'image' => wp_get_attachment_url($product->get_image_id()),
			'max_passengers' => $max_passengers ? intval($max_passengers) : 4,
			'max_bags' => $max_bags ? intval($max_bags) : 3,
		);
	}

	wp_send_json_success(array(
		'vehicles' => $vehicles,
	));
}
add_action('wp_ajax_gts_get_vehicles_by_category', 'gts_ajax_get_vehicles_by_category');
add_action('wp_ajax_nopriv_gts_get_vehicles_by_category', 'gts_ajax_get_vehicles_by_category');

/**
 * AJAX: Calculate Transfer Price
 */
function gts_ajax_calculate_price()
{
	$vehicle_id = isset($_POST['vehicle_id']) ? intval($_POST['vehicle_id']) : 0;
	$distance_km = isset($_POST['distance_km']) ? floatval($_POST['distance_km']) : 0;
	$is_night = isset($_POST['is_night']) ? filter_var($_POST['is_night'], FILTER_VALIDATE_BOOLEAN) : false;
	$is_weekend = isset($_POST['is_weekend']) ? filter_var($_POST['is_weekend'], FILTER_VALIDATE_BOOLEAN) : false;
	$extras = isset($_POST['extras']) ? (array) $_POST['extras'] : array();
	$is_return = isset($_POST['is_return']) ? filter_var($_POST['is_return'], FILTER_VALIDATE_BOOLEAN) : false;

	// Get vehicle base price
	$base_price = 0;
	$price_per_km = 0;

	// First check calculator settings for this vehicle
	$calc_vehicles = get_field('calc_vehicles', 'option');
	if ($calc_vehicles && is_array($calc_vehicles)) {
		foreach ($calc_vehicles as $v) {
			if (isset($v['wc_product']) && $v['wc_product'] == $vehicle_id) {
				$base_price = floatval($v['base_price']);
				$price_per_km = floatval($v['price_per_km']);
				break;
			}
		}
	}

	// If not found in calculator, get from WooCommerce product
	if ($base_price <= 0 && $vehicle_id > 0) {
		$product = wc_get_product($vehicle_id);
		if ($product) {
			$base_price = floatval($product->get_price());
		}
	}

	// Default price per km if not set
	if ($price_per_km <= 0) {
		$price_per_km = 1.5;
	}

	// Calculate distance component
	$distance_price = $distance_km * $price_per_km;

	// Apply distance tier multiplier
	$distance_tiers = get_field('calc_distance_tiers', 'option');
	$tier_multiplier = 1;
	if ($distance_tiers && is_array($distance_tiers)) {
		foreach ($distance_tiers as $tier) {
			$from = floatval($tier['from_km']);
			$to = floatval($tier['to_km']);
			if ($distance_km >= $from && $distance_km <= $to) {
				$tier_multiplier = floatval($tier['multiplier']);
				break;
			}
		}
	}
	$distance_price *= $tier_multiplier;

	// Total before surcharges
	$total = $base_price + $distance_price;

	// Apply night surcharge
	$night_surcharge = get_field('calc_night_surcharge', 'option');
	if ($is_night && $night_surcharge) {
		$total *= (1 + floatval($night_surcharge) / 100);
	}

	// Apply weekend surcharge
	$weekend_surcharge = get_field('calc_weekend_surcharge', 'option');
	if ($is_weekend && $weekend_surcharge) {
		$total *= (1 + floatval($weekend_surcharge) / 100);
	}

	// Add extras
	$extras_total = 0;
	$calc_extras = get_field('calc_extras', 'option');
	if ($calc_extras && is_array($calc_extras) && !empty($extras)) {
		foreach ($calc_extras as $extra) {
			if (in_array($extra['service_name'], $extras) && isset($extra['price'])) {
				$extras_total += floatval($extra['price']);
			}
		}
	}
	$total += $extras_total;

	// Double for return trip
	if ($is_return) {
		$total *= 2;
	}

	// Apply minimum price
	$min_price = get_field('calc_min_price', 'option');
	if ($min_price && $total < floatval($min_price)) {
		$total = floatval($min_price);
	}

	// Get currency symbol (decode HTML entities)
	$currency = html_entity_decode(get_woocommerce_currency_symbol());

	wp_send_json_success(array(
		'base_price' => $base_price,
		'distance_price' => round($distance_price, 2),
		'tier_multiplier' => $tier_multiplier,
		'extras_total' => $extras_total,
		'total' => round($total, 2),
		'formatted_total' => $currency . ' ' . number_format($total, 0, ',', ' '),
		'currency' => $currency,
	));
}
add_action('wp_ajax_gts_calculate_price', 'gts_ajax_calculate_price');
add_action('wp_ajax_nopriv_gts_calculate_price', 'gts_ajax_calculate_price');

/**
 * Get Extra Services from settings
 */
function gts_get_extra_services()
{
	$extras = get_field('calc_extras', 'option');
	$result = array();

	if ($extras && is_array($extras)) {
		foreach ($extras as $extra) {
			if (!empty($extra['enabled'])) {
				$result[] = array(
					'name' => $extra['service_name'],
					'price' => floatval($extra['price']),
					'per_trip' => !empty($extra['per_trip']),
				);
			}
		}
	}

	return $result;
}

/**
 * AJAX: Get Extra Services
 */
function gts_ajax_get_extra_services()
{
	$extras = gts_get_extra_services();

	wp_send_json_success(array(
		'extras' => $extras,
		'currency' => get_woocommerce_currency_symbol(),
	));
}
add_action('wp_ajax_gts_get_extra_services', 'gts_ajax_get_extra_services');
add_action('wp_ajax_nopriv_gts_get_extra_services', 'gts_ajax_get_extra_services');
