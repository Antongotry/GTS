<?php

/**
 * GTS Calculator Admin - Price Settings
 * ACF Options Page for managing calculator prices and settings
 * With WooCommerce product price sync
 *
 * @package GTS
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Register Calculator Options Page
 */
function gts_register_calculator_options_page()
{
	if (!function_exists('acf_add_options_page')) {
		return;
	}

	// Main Calculator Settings Page
	acf_add_options_page(array(
		'page_title'    => 'Calculator Settings',
		'menu_title'    => 'Calculator',
		'menu_slug'     => 'gts-calculator',
		'capability'    => 'manage_options',
		'redirect'      => false,
		'icon_url'      => 'dashicons-calculator',
		'position'      => 30,
	));

	// Sub-pages
	acf_add_options_sub_page(array(
		'page_title'    => 'Vehicle Pricing',
		'menu_title'    => 'Vehicle Pricing',
		'parent_slug'   => 'gts-calculator',
	));

	acf_add_options_sub_page(array(
		'page_title'    => 'Extra Services',
		'menu_title'    => 'Extra Services',
		'parent_slug'   => 'gts-calculator',
	));

	acf_add_options_sub_page(array(
		'page_title'    => 'Distance Rates',
		'menu_title'    => 'Distance Rates',
		'parent_slug'   => 'gts-calculator',
	));
}
add_action('acf/init', 'gts_register_calculator_options_page');

/**
 * Register ACF Fields for Calculator
 */
function gts_register_calculator_fields()
{
	if (!function_exists('acf_add_local_field_group')) {
		return;
	}

	// Vehicle Pricing Fields - with WooCommerce Product Selector
	acf_add_local_field_group(array(
		'key' => 'group_calculator_vehicles',
		'title' => 'Vehicle Base Prices',
		'fields' => array(
			array(
				'key' => 'field_calc_vehicles',
				'label' => 'Vehicles',
				'name' => 'calc_vehicles',
				'type' => 'repeater',
				'instructions' => 'Select WooCommerce products. Prices sync automatically!',
				'layout' => 'table',
				'button_label' => 'Add Vehicle',
				'sub_fields' => array(
					array(
						'key' => 'field_vehicle_product',
						'label' => 'WooCommerce Product',
						'name' => 'wc_product',
						'type' => 'post_object',
						'post_type' => array('product'),
						'return_format' => 'id',
						'ui' => 1,
						'wrapper' => array('width' => '30'),
					),
					array(
						'key' => 'field_vehicle_base_price',
						'label' => 'Base Price',
						'name' => 'base_price',
						'type' => 'number',
						'instructions' => 'Syncs with WooCommerce',
						'wrapper' => array('width' => '20'),
					),
					array(
						'key' => 'field_vehicle_price_per_km',
						'label' => 'Price per KM',
						'name' => 'price_per_km',
						'type' => 'number',
						'step' => '0.01',
						'wrapper' => array('width' => '20'),
					),
					array(
						'key' => 'field_vehicle_max_passengers',
						'label' => 'Passengers',
						'name' => 'max_passengers',
						'type' => 'number',
						'instructions' => 'Syncs with WC',
						'wrapper' => array('width' => '12'),
					),
					array(
						'key' => 'field_vehicle_max_bags',
						'label' => 'Bags',
						'name' => 'max_bags',
						'type' => 'number',
						'instructions' => 'Syncs with WC',
						'wrapper' => array('width' => '12'),
					),
					array(
						'key' => 'field_vehicle_enabled',
						'label' => 'Active',
						'name' => 'enabled',
						'type' => 'true_false',
						'default_value' => 1,
						'ui' => 1,
						'wrapper' => array('width' => '10'),
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-vehicle-pricing',
				),
			),
		),
		'style' => 'default',
	));

	// Extra Services Fields
	acf_add_local_field_group(array(
		'key' => 'group_calculator_extras',
		'title' => 'Extra Services Pricing',
		'fields' => array(
			array(
				'key' => 'field_calc_extras',
				'label' => 'Services',
				'name' => 'calc_extras',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => 'Add Service',
				'sub_fields' => array(
					array(
						'key' => 'field_extra_name',
						'label' => 'Service Name',
						'name' => 'service_name',
						'type' => 'text',
						'wrapper' => array('width' => '35'),
					),
					array(
						'key' => 'field_extra_price',
						'label' => 'Price',
						'name' => 'price',
						'type' => 'number',
						'wrapper' => array('width' => '20'),
					),
					array(
						'key' => 'field_extra_type',
						'label' => 'Type',
						'name' => 'price_type',
						'type' => 'select',
						'choices' => array(
							'fixed' => 'Fixed',
							'per_trip' => 'Per Trip',
							'per_hour' => 'Per Hour',
						),
						'wrapper' => array('width' => '20'),
					),
					array(
						'key' => 'field_extra_enabled',
						'label' => 'Active',
						'name' => 'enabled',
						'type' => 'true_false',
						'default_value' => 1,
						'ui' => 1,
						'wrapper' => array('width' => '15'),
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-extra-services',
				),
			),
		),
		'style' => 'default',
	));

	// Distance Rates Fields
	acf_add_local_field_group(array(
		'key' => 'group_calculator_distance',
		'title' => 'Distance & Time Rates',
		'fields' => array(
			array(
				'key' => 'field_calc_min_price',
				'label' => 'Minimum Order Price',
				'name' => 'calc_min_price',
				'type' => 'number',
				'default_value' => 50,
				'wrapper' => array('width' => '33'),
			),
			array(
				'key' => 'field_calc_night_surcharge',
				'label' => 'Night Surcharge (%)',
				'name' => 'calc_night_surcharge',
				'type' => 'number',
				'append' => '%',
				'default_value' => 20,
				'instructions' => 'Applied between 22:00 - 06:00',
				'wrapper' => array('width' => '33'),
			),
			array(
				'key' => 'field_calc_weekend_surcharge',
				'label' => 'Weekend Surcharge (%)',
				'name' => 'calc_weekend_surcharge',
				'type' => 'number',
				'append' => '%',
				'default_value' => 15,
				'wrapper' => array('width' => '33'),
			),
			array(
				'key' => 'field_calc_waiting_price_per_hour',
				'label' => 'Waiting Time Price (per hour)',
				'name' => 'calc_waiting_price_per_hour',
				'type' => 'number',
				'default_value' => 40,
				'wrapper' => array('width' => '33'),
			),
			array(
				'key' => 'field_calc_manual_distance_threshold',
				'label' => 'Manual Quote Threshold (km)',
				'name' => 'calc_manual_distance_threshold',
				'type' => 'number',
				'default_value' => 350,
				'instructions' => 'Routes longer than this value switch to manual quote mode.',
				'wrapper' => array('width' => '33'),
			),
			array(
				'key' => 'field_calc_manual_route_message',
				'label' => 'Manual Quote Message',
				'name' => 'calc_manual_route_message',
				'type' => 'textarea',
				'default_value' => 'For complex route conditions the exact amount is confirmed by manager within 30 minutes.',
				'rows' => 2,
			),
			array(
				'key' => 'field_calc_vehicle_class_multipliers',
				'label' => 'Vehicle Class Multipliers',
				'name' => 'calc_vehicle_class_multipliers',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => 'Add Class Multiplier',
				'sub_fields' => array(
					array(
						'key' => 'field_calc_vehicle_class_key',
						'label' => 'Class Key',
						'name' => 'class_key',
						'type' => 'select',
						'choices' => array(
							'business' => 'Business',
							'premium' => 'Premium',
							'vip' => 'VIP',
							'minivan' => 'Minivan',
							'limousine' => 'Limousine',
							'special_request' => 'Special Request',
						),
						'wrapper' => array('width' => '45'),
					),
					array(
						'key' => 'field_calc_vehicle_class_multiplier',
						'label' => 'Multiplier',
						'name' => 'multiplier',
						'type' => 'number',
						'step' => '0.01',
						'default_value' => 1,
						'wrapper' => array('width' => '35'),
					),
					array(
						'key' => 'field_calc_vehicle_class_enabled',
						'label' => 'Active',
						'name' => 'enabled',
						'type' => 'true_false',
						'default_value' => 1,
						'ui' => 1,
						'wrapper' => array('width' => '20'),
					),
				),
			),
			array(
				'key' => 'field_calc_transfer_type_multipliers',
				'label' => 'Transfer Type Multipliers',
				'name' => 'calc_transfer_type_multipliers',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => 'Add Type Multiplier',
				'sub_fields' => array(
					array(
						'key' => 'field_calc_transfer_type_key',
						'label' => 'Type Key',
						'name' => 'type_key',
						'type' => 'select',
						'choices' => array(
							'airport_hotel' => 'Airport → Hotel',
							'hotel_event' => 'Hotel → Event/Meeting',
							'intercity' => 'Intercity',
							'hourly' => 'Hourly rental',
						),
						'wrapper' => array('width' => '45'),
					),
					array(
						'key' => 'field_calc_transfer_type_multiplier',
						'label' => 'Multiplier',
						'name' => 'multiplier',
						'type' => 'number',
						'step' => '0.01',
						'default_value' => 1,
						'wrapper' => array('width' => '35'),
					),
					array(
						'key' => 'field_calc_transfer_type_enabled',
						'label' => 'Active',
						'name' => 'enabled',
						'type' => 'true_false',
						'default_value' => 1,
						'ui' => 1,
						'wrapper' => array('width' => '20'),
					),
				),
			),
			array(
				'key' => 'field_calc_distance_tiers',
				'label' => 'Distance Pricing Tiers',
				'name' => 'calc_distance_tiers',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => 'Add Tier',
				'sub_fields' => array(
					array(
						'key' => 'field_tier_from',
						'label' => 'From (km)',
						'name' => 'from_km',
						'type' => 'number',
						'wrapper' => array('width' => '25'),
					),
					array(
						'key' => 'field_tier_to',
						'label' => 'To (km)',
						'name' => 'to_km',
						'type' => 'number',
						'wrapper' => array('width' => '25'),
					),
					array(
						'key' => 'field_tier_multiplier',
						'label' => 'Price Multiplier',
						'name' => 'multiplier',
						'type' => 'number',
						'step' => '0.01',
						'default_value' => 1,
						'wrapper' => array('width' => '25'),
					),
					array(
						'key' => 'field_tier_note',
						'label' => 'Note',
						'name' => 'note',
						'type' => 'text',
						'placeholder' => 'e.g. City transfers',
						'wrapper' => array('width' => '25'),
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-distance-rates',
				),
			),
		),
		'style' => 'default',
	));

	// Main Settings Page Fields
	acf_add_local_field_group(array(
		'key' => 'group_calculator_main',
		'title' => 'Calculator General Settings',
		'fields' => array(
			array(
				'key' => 'field_calc_enabled',
				'label' => 'Enable Calculator',
				'name' => 'calc_enabled',
				'type' => 'true_false',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => 'Active',
				'ui_off_text' => 'Disabled',
			),
			array(
				'key' => 'field_calc_email',
				'label' => 'Notification Email',
				'name' => 'calc_email',
				'type' => 'email',
				'instructions' => 'Where to send booking requests',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_calc_confirmation_time',
				'label' => 'Confirmation Time',
				'name' => 'calc_confirmation_time',
				'type' => 'text',
				'default_value' => '15 minutes',
				'instructions' => 'Displayed to customer after booking',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_calc_disclaimer',
				'label' => 'Price Disclaimer',
				'name' => 'calc_disclaimer',
				'type' => 'textarea',
				'default_value' => 'Final price confirmed by manager. No online payments.',
				'rows' => 2,
			),
			array(
				'key' => 'field_calc_promo_codes',
				'label' => 'Promo Codes',
				'name' => 'calc_promo_codes',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => 'Add Promo Code',
				'sub_fields' => array(
					array(
						'key' => 'field_calc_promo_code',
						'label' => 'Code',
						'name' => 'code',
						'type' => 'text',
						'wrapper' => array('width' => '35'),
					),
					array(
						'key' => 'field_calc_promo_discount_percent',
						'label' => 'Discount (%)',
						'name' => 'discount_percent',
						'type' => 'number',
						'default_value' => 10,
						'append' => '%',
						'wrapper' => array('width' => '25'),
					),
					array(
						'key' => 'field_calc_promo_enabled',
						'label' => 'Active',
						'name' => 'enabled',
						'type' => 'true_false',
						'default_value' => 1,
						'ui' => 1,
						'wrapper' => array('width' => '20'),
					),
				),
			),
			array(
				'key' => 'field_calc_recaptcha_site_key',
				'label' => 'reCAPTCHA v3 Site Key',
				'name' => 'calc_recaptcha_site_key',
				'type' => 'text',
				'instructions' => 'Optional. Keep empty to disable captcha check on frontend.',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_calc_recaptcha_secret_key',
				'label' => 'reCAPTCHA v3 Secret Key',
				'name' => 'calc_recaptcha_secret_key',
				'type' => 'text',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_calc_telegram_webhook',
				'label' => 'Telegram Webhook URL',
				'name' => 'calc_telegram_webhook',
				'type' => 'url',
				'instructions' => 'Optional endpoint for integration. Data is available in action hook gts_transfer_request_submitted.',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_calc_google_sheet_webhook',
				'label' => 'Google Sheets Webhook URL',
				'name' => 'calc_google_sheet_webhook',
				'type' => 'url',
				'instructions' => 'Optional endpoint for integration. Data is available in action hook gts_transfer_request_submitted.',
				'wrapper' => array('width' => '50'),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'gts-calculator',
				),
			),
		),
		'style' => 'default',
	));
}
add_action('acf/init', 'gts_register_calculator_fields');

/**
 * Enqueue Calculator Admin Styles
 */
function gts_calculator_admin_styles($hook)
{
	// Apply styles to main calculator page and all sub-pages
	if (
		strpos($hook, 'gts-calculator') === false &&
		strpos($hook, 'vehicle-pricing') === false &&
		strpos($hook, 'extra-services') === false &&
		strpos($hook, 'distance-rates') === false
	) {
		return;
	}

	wp_enqueue_style(
		'gts-calculator-admin',
		get_template_directory_uri() . '/assets/css/admin-calculator.css',
		array(),
		filemtime(get_template_directory() . '/assets/css/admin-calculator.css')
	);
}
add_action('admin_enqueue_scripts', 'gts_calculator_admin_styles');

/**
 * =====================================================
 * WOOCOMMERCE PRICE SYNC
 * =====================================================
 */

/**
 * Sync Calculator prices TO WooCommerce when ACF options are saved
 */
function gts_sync_calculator_to_woocommerce($post_id)
{
	// Only run on options page save
	if ($post_id !== 'options') {
		return;
	}

	// Check if we're on the vehicle pricing page
	$screen = get_current_screen();
	if (!$screen || strpos($screen->id, 'vehicle-pricing') === false) {
		return;
	}

	// Prevent infinite loop
	if (defined('GTS_SYNCING_PRICES')) {
		return;
	}
	define('GTS_SYNCING_PRICES', true);

	$vehicles = get_field('calc_vehicles', 'option');

	if (!$vehicles || !is_array($vehicles)) {
		return;
	}

	foreach ($vehicles as $vehicle) {
		$product_id = isset($vehicle['wc_product']) ? intval($vehicle['wc_product']) : 0;
		$base_price = isset($vehicle['base_price']) ? floatval($vehicle['base_price']) : 0;
		$max_passengers = isset($vehicle['max_passengers']) ? intval($vehicle['max_passengers']) : 0;
		$max_bags = isset($vehicle['max_bags']) ? intval($vehicle['max_bags']) : 0;

		if ($product_id && $base_price > 0) {
			$product = wc_get_product($product_id);
			if ($product) {
				$updated = false;

				// Sync price
				$current_price = floatval($product->get_regular_price());
				if ($current_price !== $base_price) {
					$product->set_regular_price($base_price);
					$product->set_price($base_price);
					$updated = true;
				}

				// Sync passengers
				if ($max_passengers > 0) {
					update_post_meta($product_id, '_gts_max_passengers', $max_passengers);
					update_post_meta($product_id, 'max_passengers', $max_passengers);
				}

				// Sync bags
				if ($max_bags > 0) {
					update_post_meta($product_id, '_gts_max_bags', $max_bags);
					update_post_meta($product_id, 'max_bags', $max_bags);
				}

				if ($updated) {
					$product->save();
				}
			}
		}
	}
}
add_action('acf/save_post', 'gts_sync_calculator_to_woocommerce', 20);

/**
 * Sync WooCommerce product price TO Calculator when product is saved
 */
function gts_sync_woocommerce_to_calculator($product_id, $product)
{
	// Prevent infinite loop
	if (defined('GTS_SYNCING_PRICES')) {
		return;
	}

	// Only for simple products
	if (!$product instanceof WC_Product || $product->is_type('variable')) {
		return;
	}

	$new_price = floatval($product->get_regular_price());
	$new_passengers = intval(get_post_meta($product_id, 'max_passengers', true));
	$new_bags = intval(get_post_meta($product_id, 'max_bags', true));

	$vehicles = get_field('calc_vehicles', 'option');
	if (!$vehicles || !is_array($vehicles)) {
		return;
	}

	$updated = false;
	foreach ($vehicles as $index => $vehicle) {
		$linked_product_id = isset($vehicle['wc_product']) ? intval($vehicle['wc_product']) : 0;

		if ($linked_product_id === $product_id) {
			// Sync price
			$current_price = isset($vehicle['base_price']) ? floatval($vehicle['base_price']) : 0;
			if ($new_price > 0 && $current_price !== $new_price) {
				$vehicles[$index]['base_price'] = $new_price;
				$updated = true;
			}

			// Sync passengers
			$current_passengers = isset($vehicle['max_passengers']) ? intval($vehicle['max_passengers']) : 0;
			if ($new_passengers > 0 && $current_passengers !== $new_passengers) {
				$vehicles[$index]['max_passengers'] = $new_passengers;
				$updated = true;
			}

			// Sync bags
			$current_bags = isset($vehicle['max_bags']) ? intval($vehicle['max_bags']) : 0;
			if ($new_bags > 0 && $current_bags !== $new_bags) {
				$vehicles[$index]['max_bags'] = $new_bags;
				$updated = true;
			}
		}
	}

	if ($updated) {
		define('GTS_SYNCING_PRICES', true);
		update_field('calc_vehicles', $vehicles, 'option');
	}
}
add_action('woocommerce_update_product', 'gts_sync_woocommerce_to_calculator', 10, 2);

/**
 * Pre-fill base price from WooCommerce when selecting a product
 */
function gts_prefill_price_from_woocommerce($value, $post_id, $field)
{
	// Only on vehicle pricing options page
	if ($post_id !== 'options') {
		return $value;
	}

	// Check if this is for vehicle base price
	if ($field['name'] !== 'base_price') {
		return $value;
	}

	// If value is already set, don't override
	if (!empty($value)) {
		return $value;
	}

	return $value;
}
add_filter('acf/load_value/name=base_price', 'gts_prefill_price_from_woocommerce', 10, 3);

/**
 * Add admin notice showing sync status
 */
function gts_calculator_sync_notice()
{
	$screen = get_current_screen();
	if (!$screen || strpos($screen->id, 'vehicle-pricing') === false) {
		return;
	}

	if (isset($_GET['settings-updated']) && $_GET['settings-updated'] === 'true') {
		echo '<div class="notice notice-success is-dismissible" style="border-left-color: #c9a962;">';
		echo '<p><strong>✓ Prices synced!</strong> WooCommerce product prices have been updated.</p>';
		echo '</div>';
	}
}
add_action('admin_notices', 'gts_calculator_sync_notice');

/**
 * Populate Calculator with Test Data
 * Run once to add sample data for testing
 */
function gts_populate_test_calculator_data()
{
	// Only run if explicitly requested via URL parameter
	if (!isset($_GET['gts_populate_test_data']) || $_GET['gts_populate_test_data'] !== 'yes') {
		return;
	}

	// Check admin permissions
	if (!current_user_can('manage_options')) {
		return;
	}

	// Prevent running twice
	if (get_option('gts_test_data_populated')) {
		echo '<div class="notice notice-warning"><p>Test data already populated. Delete option "gts_test_data_populated" to run again.</p></div>';
		return;
	}

	// ========== EXTRA SERVICES ==========
	$extras = array(
		array(
			'service_name' => 'Child Seat',
			'price' => 15,
			'per_trip' => 1,
			'enabled' => 1,
		),
		array(
			'service_name' => 'Meet & Greet',
			'price' => 25,
			'per_trip' => 1,
			'enabled' => 1,
		),
		array(
			'service_name' => 'Extra Stop',
			'price' => 20,
			'per_trip' => 0,
			'enabled' => 1,
		),
		array(
			'service_name' => 'VIP Protocol',
			'price' => 100,
			'per_trip' => 1,
			'enabled' => 1,
		),
		array(
			'service_name' => 'Waiting Time (per hour)',
			'price' => 50,
			'per_trip' => 0,
			'enabled' => 1,
		),
		array(
			'service_name' => 'Champagne on board',
			'price' => 75,
			'per_trip' => 1,
			'enabled' => 1,
		),
		array(
			'service_name' => 'Wi-Fi Hotspot',
			'price' => 10,
			'per_trip' => 1,
			'enabled' => 1,
		),
		array(
			'service_name' => 'Newspaper/Magazine',
			'price' => 5,
			'per_trip' => 1,
			'enabled' => 1,
		),
	);
	update_field('calc_extras', $extras, 'option');

	// ========== DISTANCE RATES ==========
	update_field('calc_min_price', 50, 'option');
	update_field('calc_night_surcharge', 25, 'option');
	update_field('calc_weekend_surcharge', 15, 'option');

	$distance_tiers = array(
		array(
			'from_km' => 0,
			'to_km' => 20,
			'multiplier' => 1.5,
			'note' => 'City transfers',
		),
		array(
			'from_km' => 21,
			'to_km' => 50,
			'multiplier' => 1.2,
			'note' => 'Suburban',
		),
		array(
			'from_km' => 51,
			'to_km' => 100,
			'multiplier' => 1.0,
			'note' => 'Standard',
		),
		array(
			'from_km' => 101,
			'to_km' => 200,
			'multiplier' => 0.9,
			'note' => 'Long distance discount',
		),
		array(
			'from_km' => 201,
			'to_km' => 9999,
			'multiplier' => 0.8,
			'note' => 'Extra long discount',
		),
	);
	update_field('calc_distance_tiers', $distance_tiers, 'option');

	// ========== VEHICLES (without WooCommerce) ==========
	$vehicles = array(
		array(
			'wc_product' => 0,
			'base_price' => 45,
			'price_per_km' => 1.50,
			'max_passengers' => 3,
			'max_bags' => 2,
			'enabled' => 1,
		),
		array(
			'wc_product' => 0,
			'base_price' => 65,
			'price_per_km' => 1.80,
			'max_passengers' => 4,
			'max_bags' => 3,
			'enabled' => 1,
		),
		array(
			'wc_product' => 0,
			'base_price' => 85,
			'price_per_km' => 2.20,
			'max_passengers' => 6,
			'max_bags' => 5,
			'enabled' => 1,
		),
		array(
			'wc_product' => 0,
			'base_price' => 150,
			'price_per_km' => 3.50,
			'max_passengers' => 3,
			'max_bags' => 2,
			'enabled' => 1,
		),
		array(
			'wc_product' => 0,
			'base_price' => 120,
			'price_per_km' => 2.80,
			'max_passengers' => 7,
			'max_bags' => 7,
			'enabled' => 1,
		),
	);
	update_field('calc_vehicles', $vehicles, 'option');

	// Mark as populated
	update_option('gts_test_data_populated', true);

	// Show success notice
	add_action('admin_notices', function () {
		echo '<div class="notice notice-success is-dismissible" style="border-left-color: #c9a962;">';
		echo '<p><strong>✓ Test data populated!</strong></p>';
		echo '<p><strong>Vehicles:</strong> 5 test vehicles (Sedan, Business, SUV, Limousine, Van)</p>';
		echo '<p><strong>Extras:</strong> 8 services (Child Seat, Meet & Greet, VIP Protocol, etc.)</p>';
		echo '<p><strong>Distance Tiers:</strong> 5 tiers with different multipliers</p>';
		echo '<p><strong>Surcharges:</strong> Night +25%, Weekend +15%, Min order €50</p>';
		echo '</div>';
	});
}
add_action('admin_init', 'gts_populate_test_calculator_data');

/**
 * Add button to populate test data in Calculator settings
 */
function gts_add_populate_test_data_button()
{
	$screen = get_current_screen();
	if (!$screen || strpos($screen->id, 'gts-calculator') === false) {
		return;
	}

	$url = admin_url('admin.php?page=gts-calculator&gts_populate_test_data=yes');
	$already_populated = get_option('gts_test_data_populated');

	echo '<div class="notice notice-info" style="border-left-color: #c9a962;">';
	echo '<p><strong>🧪 Test Data Generator</strong></p>';
	if ($already_populated) {
		echo '<p>Test data already loaded. To reload, delete option <code>gts_test_data_populated</code> from database.</p>';
	} else {
		echo '<p>Click the button below to populate all calculator settings with test data for transfer business:</p>';
		echo '<p><a href="' . esc_url($url) . '" class="button button-primary" style="background: #c9a962; border-color: #b8944d;">Populate Test Data</a></p>';
	}
	echo '</div>';
}
add_action('admin_notices', 'gts_add_populate_test_data_button');
