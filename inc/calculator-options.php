<?php

/**
 * GTS Calculator Admin - Price Settings
 * ACF Options Page for managing calculator prices and settings
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

	// Vehicle Pricing Fields
	acf_add_local_field_group(array(
		'key' => 'group_calculator_vehicles',
		'title' => 'Vehicle Base Prices',
		'fields' => array(
			array(
				'key' => 'field_calc_currency',
				'label' => 'Currency Symbol',
				'name' => 'calc_currency',
				'type' => 'text',
				'default_value' => '€',
				'wrapper' => array('width' => '25'),
			),
			array(
				'key' => 'field_calc_vehicles',
				'label' => 'Vehicles',
				'name' => 'calc_vehicles',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => 'Add Vehicle',
				'sub_fields' => array(
					array(
						'key' => 'field_vehicle_name',
						'label' => 'Vehicle Name',
						'name' => 'vehicle_name',
						'type' => 'text',
						'wrapper' => array('width' => '30'),
					),
					array(
						'key' => 'field_vehicle_base_price',
						'label' => 'Base Price',
						'name' => 'base_price',
						'type' => 'number',
						'prepend' => '€',
						'wrapper' => array('width' => '20'),
					),
					array(
						'key' => 'field_vehicle_price_per_km',
						'label' => 'Price per KM',
						'name' => 'price_per_km',
						'type' => 'number',
						'prepend' => '€',
						'step' => '0.01',
						'wrapper' => array('width' => '20'),
					),
					array(
						'key' => 'field_vehicle_max_passengers',
						'label' => 'Max Passengers',
						'name' => 'max_passengers',
						'type' => 'number',
						'wrapper' => array('width' => '15'),
					),
					array(
						'key' => 'field_vehicle_enabled',
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
						'prepend' => '€',
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
				'prepend' => '€',
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
	if (strpos($hook, 'gts-calculator') === false) {
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
