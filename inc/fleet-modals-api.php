<?php

/**
 * REST API: fleet modals HTML (booking + success)
 * Modals are not in initial DOM — JS fetches and injects on open, removes on close.
 *
 * @package GTS
 */

/**
 * Register REST route for fleet modal HTML.
 */
function gts_register_fleet_modals_route()
{
	register_rest_route('gts/v1', '/fleet-modals', array(
		'methods'             => 'GET',
		'permission_callback' => '__return_true',
		'callback'            => 'gts_fleet_modals_callback',
	));
}
add_action('rest_api_init', 'gts_register_fleet_modals_route');

/**
 * Return HTML for booking and success modals.
 *
 * @return WP_REST_Response
 */
function gts_fleet_modals_callback()
{
	ob_start();
	get_template_part('template-parts/parts/fleet-booking-modal');
	$booking = ob_get_clean();

	ob_start();
	get_template_part('template-parts/parts/fleet-success-modal');
	$success = ob_get_clean();

	return rest_ensure_response(array(
		'booking' => $booking,
		'success' => $success,
	));
}
