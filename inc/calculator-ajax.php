<?php

/**
 * GTS Transfer Calculator AJAX Handlers
 *
 * @package GTS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Verify calculator nonce for public AJAX endpoints.
 *
 * @return bool
 */
function gts_calculator_verify_nonce() {
	$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
	return wp_verify_nonce( $nonce, 'gts_transfer_nonce' );
}

/**
 * Get WooCommerce Product Categories for Vehicle Type dropdown.
 *
 * @return array
 */
function gts_get_vehicle_categories() {
	$categories = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);

	$result = array();

	if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
		foreach ( $categories as $cat ) {
			if ( 'uncategorized' === $cat->slug ) {
				continue;
			}

			$result[] = array(
				'id'    => $cat->term_id,
				'name'  => $cat->name,
				'slug'  => $cat->slug,
				'count' => $cat->count,
			);
		}
	}

	return $result;
}

/**
 * AJAX: Get Vehicle Categories.
 */
function gts_ajax_get_vehicle_categories() {
	if ( ! gts_calculator_verify_nonce() ) {
		wp_send_json_error( array( 'message' => 'Security validation failed.' ), 403 );
	}

	wp_send_json_success(
		array(
			'categories' => gts_get_vehicle_categories(),
		)
	);
}
add_action( 'wp_ajax_gts_get_vehicle_categories', 'gts_ajax_get_vehicle_categories' );
add_action( 'wp_ajax_nopriv_gts_get_vehicle_categories', 'gts_ajax_get_vehicle_categories' );

/**
 * AJAX: Get Vehicles by Category.
 */
function gts_ajax_get_vehicles_by_category() {
	if ( ! gts_calculator_verify_nonce() ) {
		wp_send_json_error( array( 'message' => 'Security validation failed.' ), 403 );
	}

	$category_id = isset( $_POST['category_id'] ) ? intval( $_POST['category_id'] ) : 0;
	if ( ! $category_id ) {
		wp_send_json_error( array( 'message' => 'Category ID required.' ) );
	}

	$products = get_posts(
		array(
			'post_type'      => 'product',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $category_id,
				),
			),
			'orderby'        => 'title',
			'order'          => 'ASC',
		)
	);

	$vehicles = array();

	foreach ( $products as $product_post ) {
		$product = wc_get_product( $product_post->ID );
		if ( ! $product ) {
			continue;
		}

		$max_passengers = get_post_meta( $product_post->ID, '_gts_max_passengers', true );
		if ( ! $max_passengers ) {
			$max_passengers = get_post_meta( $product_post->ID, 'max_passengers', true );
		}

		$max_bags = get_post_meta( $product_post->ID, '_gts_max_bags', true );
		if ( ! $max_bags ) {
			$max_bags = get_post_meta( $product_post->ID, 'max_bags', true );
		}

		$vehicles[] = array(
			'id'             => $product_post->ID,
			'name'           => $product->get_name(),
			'price'          => (float) $product->get_price(),
			'formatted_price'=> wp_strip_all_tags( wc_price( $product->get_price() ) ),
			'image'          => wp_get_attachment_url( $product->get_image_id() ),
			'max_passengers' => $max_passengers ? intval( $max_passengers ) : 4,
			'max_bags'       => $max_bags ? intval( $max_bags ) : 3,
		);
	}

	wp_send_json_success( array( 'vehicles' => $vehicles ) );
}
add_action( 'wp_ajax_gts_get_vehicles_by_category', 'gts_ajax_get_vehicles_by_category' );
add_action( 'wp_ajax_nopriv_gts_get_vehicles_by_category', 'gts_ajax_get_vehicles_by_category' );

/**
 * Resolve text address to coordinates via OSM Nominatim.
 *
 * @param string $address Address string.
 * @return array|null
 */
function gts_calculator_geocode( $address ) {
	$query = rawurlencode( $address );
	$url   = 'https://nominatim.openstreetmap.org/search?format=jsonv2&limit=1&q=' . $query;

	$response = wp_remote_get(
		$url,
		array(
			'timeout' => 8,
			'headers' => array(
				'User-Agent' => 'GTS Transfer Calculator/1.0',
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		return null;
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( empty( $body ) || empty( $body[0]['lat'] ) || empty( $body[0]['lon'] ) ) {
		return null;
	}

	return array(
		'lat' => (float) $body[0]['lat'],
		'lon' => (float) $body[0]['lon'],
	);
}

/**
 * AJAX: Address autocomplete suggestions (OSM Nominatim).
 */
function gts_ajax_address_suggestions() {
	if ( ! gts_calculator_verify_nonce() ) {
		wp_send_json_error( array( 'message' => 'Security validation failed.' ), 403 );
	}

	$query = isset( $_POST['q'] ) ? sanitize_text_field( wp_unslash( $_POST['q'] ) ) : '';
	$type  = isset( $_POST['type'] ) ? sanitize_key( wp_unslash( $_POST['type'] ) ) : 'address';

	if ( mb_strlen( $query ) < 2 ) {
		wp_send_json_success( array( 'suggestions' => array() ) );
	}

	$url = 'https://nominatim.openstreetmap.org/search?format=jsonv2&addressdetails=1&limit=6&accept-language=en&q=' . rawurlencode( $query );

	$response = wp_remote_get(
		$url,
		array(
			'timeout' => 8,
			'headers' => array(
				'User-Agent' => 'GTS Transfer Calculator/1.0',
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		wp_send_json_success( array( 'suggestions' => array() ) );
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( ! is_array( $body ) ) {
		wp_send_json_success( array( 'suggestions' => array() ) );
	}

	$suggestions = array();
	$seen        = array();

	foreach ( $body as $item ) {
		if ( empty( $item['display_name'] ) ) {
			continue;
		}

		$address = isset( $item['address'] ) && is_array( $item['address'] ) ? $item['address'] : array();
		$value   = '';

		if ( 'country' === $type ) {
			$value = isset( $address['country'] ) ? (string) $address['country'] : '';
		} elseif ( 'city' === $type ) {
			if ( ! empty( $address['city'] ) ) {
				$value = (string) $address['city'];
			} elseif ( ! empty( $address['town'] ) ) {
				$value = (string) $address['town'];
			} elseif ( ! empty( $address['village'] ) ) {
				$value = (string) $address['village'];
			} elseif ( ! empty( $address['municipality'] ) ) {
				$value = (string) $address['municipality'];
			} elseif ( ! empty( $address['state'] ) ) {
				$value = (string) $address['state'];
			}
		} else {
			$value = (string) $item['display_name'];
		}

		$value = trim( wp_strip_all_tags( $value ) );
		if ( '' === $value ) {
			continue;
		}

		$key = mb_strtolower( $value );
		if ( isset( $seen[ $key ] ) ) {
			continue;
		}
		$seen[ $key ] = true;

		$suggestions[] = array(
			'value' => $value,
			'label' => (string) $item['display_name'],
		);

		if ( count( $suggestions ) >= 6 ) {
			break;
		}
	}

	wp_send_json_success( array( 'suggestions' => $suggestions ) );
}
add_action( 'wp_ajax_gts_address_suggestions', 'gts_ajax_address_suggestions' );
add_action( 'wp_ajax_nopriv_gts_address_suggestions', 'gts_ajax_address_suggestions' );

/**
 * Estimate route via OSRM.
 *
 * @param array $from From coordinates.
 * @param array $to To coordinates.
 * @return array|null
 */
function gts_calculator_route_osrm( $from, $to ) {
	$url = sprintf(
		'https://router.project-osrm.org/route/v1/driving/%1$s,%2$s;%3$s,%4$s?overview=false',
		rawurlencode( (string) $from['lon'] ),
		rawurlencode( (string) $from['lat'] ),
		rawurlencode( (string) $to['lon'] ),
		rawurlencode( (string) $to['lat'] )
	);

	$response = wp_remote_get( $url, array( 'timeout' => 8 ) );
	if ( is_wp_error( $response ) ) {
		return null;
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( empty( $body['routes'][0] ) ) {
		return null;
	}

	$route = $body['routes'][0];
	return array(
		'distance_km' => round( (float) $route['distance'] / 1000, 1 ),
		'duration_min'=> (int) round( (float) $route['duration'] / 60 ),
	);
}

/**
 * AJAX: Estimate route distance and duration.
 */
function gts_ajax_estimate_route() {
	if ( ! gts_calculator_verify_nonce() ) {
		wp_send_json_error( array( 'message' => 'Security validation failed.' ), 403 );
	}

	$from = isset( $_POST['from'] ) ? sanitize_text_field( wp_unslash( $_POST['from'] ) ) : '';
	$to   = isset( $_POST['to'] ) ? sanitize_text_field( wp_unslash( $_POST['to'] ) ) : '';

	if ( '' === $from || '' === $to ) {
		wp_send_json_error( array( 'message' => 'Route points are required.' ), 422 );
	}

	$from_coords = gts_calculator_geocode( $from );
	$to_coords   = gts_calculator_geocode( $to );

	if ( ! $from_coords || ! $to_coords ) {
		wp_send_json_success(
			array(
				'mode'        => 'manual',
				'distance_km' => 0,
				'duration_min'=> 0,
				'message'     => 'Complex route: manager will confirm exact price in 30 min',
			)
		);
	}

	$route = gts_calculator_route_osrm( $from_coords, $to_coords );
	if ( ! $route ) {
		wp_send_json_success(
			array(
				'mode'        => 'manual',
				'distance_km' => 0,
				'duration_min'=> 0,
				'message'     => 'Complex route: manager will confirm exact price in 30 min',
			)
		);
	}

	$manual_threshold = (float) get_field( 'calc_manual_distance_threshold', 'option' );
	if ( $manual_threshold <= 0 ) {
		$manual_threshold = 350;
	}

	$mode = $route['distance_km'] > $manual_threshold ? 'manual' : 'auto';
	wp_send_json_success(
		array(
			'mode'        => $mode,
			'distance_km' => $route['distance_km'],
			'duration_min'=> $route['duration_min'],
			'message'     => 'manual' === $mode ? 'Long route: manager will confirm exact price.' : '',
		)
	);
}
add_action( 'wp_ajax_gts_estimate_route', 'gts_ajax_estimate_route' );
add_action( 'wp_ajax_nopriv_gts_estimate_route', 'gts_ajax_estimate_route' );

/**
 * Normalize extras catalog from options.
 *
 * @return array
 */
function gts_calculator_get_extras_catalog() {
	$extras   = get_field( 'calc_extras', 'option' );
	$catalog  = array(
		'child_seat' => array( 'label' => 'Child seat', 'price' => 0 ),
		'assistant'  => array( 'label' => 'Assistant / translator', 'price' => 45 ),
		'name_sign'  => array( 'label' => 'Airport name sign', 'price' => 10 ),
		'security'   => array( 'label' => 'Security escort', 'price' => 120 ),
		'flowers'    => array( 'label' => 'Flowers / champagne', 'price' => 50 ),
	);

	if ( $extras && is_array( $extras ) ) {
		foreach ( $extras as $extra ) {
			if ( empty( $extra['enabled'] ) || empty( $extra['service_name'] ) ) {
				continue;
			}
			$key = sanitize_title( $extra['service_name'] );
			$catalog[ $key ] = array(
				'label' => $extra['service_name'],
				'price' => isset( $extra['price'] ) ? (float) $extra['price'] : 0,
			);

			// Support common alias keys from frontend values.
			$aliases = array();
			if ( false !== stripos( $key, 'child' ) ) {
				$aliases[] = 'child_seat';
			}
			if ( false !== stripos( $key, 'assistant' ) || false !== stripos( $key, 'translator' ) ) {
				$aliases[] = 'assistant';
			}
			if ( false !== stripos( $key, 'meet' ) || false !== stripos( $key, 'sign' ) ) {
				$aliases[] = 'name_sign';
			}
			if ( false !== stripos( $key, 'vip' ) || false !== stripos( $key, 'security' ) ) {
				$aliases[] = 'security';
			}
			if ( false !== stripos( $key, 'champagne' ) || false !== stripos( $key, 'flower' ) ) {
				$aliases[] = 'flowers';
			}

			foreach ( $aliases as $alias_key ) {
				$catalog[ $alias_key ] = array(
					'label' => $extra['service_name'],
					'price' => isset( $extra['price'] ) ? (float) $extra['price'] : 0,
				);
			}
		}
	}

	return $catalog;
}

/**
 * Build night flag by trip time.
 *
 * @param string $time Trip time HH:MM.
 * @return bool
 */
function gts_calculator_is_night_trip( $time ) {
	if ( ! preg_match( '/^(\d{2}):(\d{2})$/', $time, $m ) ) {
		return false;
	}
	$hour = (int) $m[1];
	return ( $hour >= 22 || $hour < 6 );
}

/**
 * Get promo discount value.
 *
 * @param string $promo Promo code.
 * @return float
 */
function gts_calculator_promo_discount_percent( $promo ) {
	if ( '' === $promo ) {
		return 0;
	}
	$promo_codes = get_field( 'calc_promo_codes', 'option' );
	if ( ! $promo_codes || ! is_array( $promo_codes ) ) {
		return 0;
	}

	$promo_upper = strtoupper( $promo );
	foreach ( $promo_codes as $row ) {
		if ( empty( $row['code'] ) || empty( $row['enabled'] ) ) {
			continue;
		}
		if ( strtoupper( trim( (string) $row['code'] ) ) === $promo_upper ) {
			return isset( $row['discount_percent'] ) ? (float) $row['discount_percent'] : 0;
		}
	}

	return 0;
}

/**
 * AJAX: Calculate Transfer Price.
 */
function gts_ajax_calculate_price() {
	if ( ! gts_calculator_verify_nonce() ) {
		wp_send_json_error( array( 'message' => 'Security validation failed.' ), 403 );
	}

	$vehicle_id       = isset( $_POST['vehicle_id'] ) ? intval( $_POST['vehicle_id'] ) : 0;
	$distance_km      = isset( $_POST['distance_km'] ) ? (float) $_POST['distance_km'] : 0;
	$duration_min     = isset( $_POST['duration_min'] ) ? (int) $_POST['duration_min'] : 0;
	$route_mode       = isset( $_POST['route_mode'] ) ? sanitize_text_field( wp_unslash( $_POST['route_mode'] ) ) : 'manual';
	$transfer_type    = isset( $_POST['transfer_type'] ) ? sanitize_text_field( wp_unslash( $_POST['transfer_type'] ) ) : '';
	$vehicle_class    = isset( $_POST['vehicle_class'] ) ? sanitize_text_field( wp_unslash( $_POST['vehicle_class'] ) ) : '';
	$passengers_group = isset( $_POST['passengers_group'] ) ? sanitize_text_field( wp_unslash( $_POST['passengers_group'] ) ) : '';
	$waiting_minutes  = isset( $_POST['waiting_minutes'] ) ? intval( $_POST['waiting_minutes'] ) : 0;
	$is_return        = ! empty( $_POST['is_return'] );
	$trip_date        = isset( $_POST['trip_date'] ) ? sanitize_text_field( wp_unslash( $_POST['trip_date'] ) ) : '';
	$trip_time        = isset( $_POST['trip_time'] ) ? sanitize_text_field( wp_unslash( $_POST['trip_time'] ) ) : '';
	$promo_code       = isset( $_POST['promo_code'] ) ? sanitize_text_field( wp_unslash( $_POST['promo_code'] ) ) : '';
	$extras           = isset( $_POST['extras'] ) ? array_map( 'sanitize_text_field', (array) wp_unslash( $_POST['extras'] ) ) : array();

	if ( ! $vehicle_id ) {
		wp_send_json_error( array( 'message' => 'Vehicle is required.' ), 422 );
	}

	$calc_vehicles = get_field( 'calc_vehicles', 'option' );
	$base_price    = 0;
	$price_per_km  = 0;
	if ( $calc_vehicles && is_array( $calc_vehicles ) ) {
		foreach ( $calc_vehicles as $vehicle ) {
			if ( isset( $vehicle['wc_product'] ) && intval( $vehicle['wc_product'] ) === $vehicle_id ) {
				$base_price   = isset( $vehicle['base_price'] ) ? (float) $vehicle['base_price'] : 0;
				$price_per_km = isset( $vehicle['price_per_km'] ) ? (float) $vehicle['price_per_km'] : 0;
				break;
			}
		}
	}

	if ( $base_price <= 0 ) {
		$product = wc_get_product( $vehicle_id );
		$base_price = $product ? (float) $product->get_price() : 0;
	}
	if ( $price_per_km <= 0 ) {
		$price_per_km = 1.7;
	}

	$breakdown = array();
	$breakdown[] = sprintf( '%.0f € — base vehicle rate', $base_price );

	$distance_price = 0;
	if ( $distance_km > 0 ) {
		$distance_price = $distance_km * $price_per_km;
		$breakdown[] = sprintf( '%.0f € — distance (%s km × %.2f €/km)', $distance_price, number_format_i18n( $distance_km, 1 ), $price_per_km );
	}

	$distance_tiers = get_field( 'calc_distance_tiers', 'option' );
	if ( $distance_tiers && is_array( $distance_tiers ) && $distance_km > 0 ) {
		foreach ( $distance_tiers as $tier ) {
			$from = isset( $tier['from_km'] ) ? (float) $tier['from_km'] : 0;
			$to   = isset( $tier['to_km'] ) ? (float) $tier['to_km'] : 0;
			if ( $distance_km >= $from && $distance_km <= $to ) {
				$multiplier = isset( $tier['multiplier'] ) ? (float) $tier['multiplier'] : 1;
				if ( $multiplier > 0 && 1 !== $multiplier ) {
					$distance_price *= $multiplier;
					$breakdown[] = sprintf( '× %.2f distance tier multiplier', $multiplier );
				}
				break;
			}
		}
	}

	$total = $base_price + $distance_price;

	$night_surcharge = (float) get_field( 'calc_night_surcharge', 'option' );
	if ( gts_calculator_is_night_trip( $trip_time ) && $night_surcharge > 0 ) {
		$night_amount = $total * $night_surcharge / 100;
		$total += $night_amount;
		$breakdown[] = sprintf( '+ %.0f € — night surcharge (%s%%)', $night_amount, $night_surcharge );
	}

	$weekend_surcharge = (float) get_field( 'calc_weekend_surcharge', 'option' );
	if ( $trip_date ) {
		$timestamp = strtotime( $trip_date );
		$is_weekend = $timestamp ? in_array( (int) gmdate( 'w', $timestamp ), array( 0, 6 ), true ) : false;
		if ( $is_weekend && $weekend_surcharge > 0 ) {
			$weekend_amount = $total * $weekend_surcharge / 100;
			$total += $weekend_amount;
			$breakdown[] = sprintf( '+ %.0f € — weekend surcharge (%s%%)', $weekend_amount, $weekend_surcharge );
		}
	}

	$waiting_rate_per_hour = (float) get_field( 'calc_waiting_price_per_hour', 'option' );
	if ( $waiting_rate_per_hour <= 0 ) {
		$waiting_rate_per_hour = 40;
	}
	if ( $waiting_minutes > 0 ) {
		$waiting_amount = $waiting_rate_per_hour * ( $waiting_minutes / 60 );
		$total += $waiting_amount;
		$breakdown[] = sprintf( '+ %.0f € — waiting time (%s min)', $waiting_amount, $waiting_minutes );
	}

	$route_type_multipliers = get_field( 'calc_transfer_type_multipliers', 'option' );
	if ( $route_type_multipliers && is_array( $route_type_multipliers ) && $transfer_type ) {
		foreach ( $route_type_multipliers as $row ) {
			if ( empty( $row['type_key'] ) || $row['type_key'] !== $transfer_type || empty( $row['enabled'] ) ) {
				continue;
			}
			$mul = isset( $row['multiplier'] ) ? (float) $row['multiplier'] : 1;
			if ( $mul > 0 && 1 !== $mul ) {
				$total *= $mul;
				$breakdown[] = sprintf( '× %.2f transfer type multiplier', $mul );
			}
			break;
		}
	}

	$class_multipliers = get_field( 'calc_vehicle_class_multipliers', 'option' );
	if ( $class_multipliers && is_array( $class_multipliers ) && $vehicle_class ) {
		foreach ( $class_multipliers as $row ) {
			if ( empty( $row['class_key'] ) || $row['class_key'] !== $vehicle_class || empty( $row['enabled'] ) ) {
				continue;
			}
			$mul = isset( $row['multiplier'] ) ? (float) $row['multiplier'] : 1;
			if ( $mul > 0 && 1 !== $mul ) {
				$total *= $mul;
				$breakdown[] = sprintf( '× %.2f class multiplier', $mul );
			}
			break;
		}
	}

	$extras_total = 0;
	$catalog = gts_calculator_get_extras_catalog();
	foreach ( $extras as $extra_key ) {
		if ( isset( $catalog[ $extra_key ] ) ) {
			$extra_amount = (float) $catalog[ $extra_key ]['price'];
			$extras_total += $extra_amount;
			$breakdown[] = sprintf( '+ %.0f € — %s', $extra_amount, $catalog[ $extra_key ]['label'] );
		}
	}
	$total += $extras_total;

	if ( $is_return ) {
		$total *= 2;
		$breakdown[] = '× 2 — return transfer';
	}

	$promo_discount_percent = gts_calculator_promo_discount_percent( $promo_code );
	if ( $promo_discount_percent > 0 ) {
		$discount_amount = $total * $promo_discount_percent / 100;
		$total -= $discount_amount;
		$breakdown[] = sprintf( '- %.0f € — promo (%s%%)', $discount_amount, $promo_discount_percent );
	}

	$min_price = (float) get_field( 'calc_min_price', 'option' );
	if ( $min_price > 0 && $total < $min_price ) {
		$total = $min_price;
		$breakdown[] = sprintf( 'Minimum order applied: %.0f €', $min_price );
	}

	$mode = 'auto';
	if ( 'manual' === $route_mode || $distance_km <= 0 ) {
		$mode = 'manual';
	}

	$manual_message = (string) get_field( 'calc_manual_route_message', 'option' );
	if ( '' === trim( $manual_message ) ) {
		$manual_message = 'For complex route conditions the exact amount is confirmed by manager within 30 minutes.';
	}

	$note = 'manual' === $mode
		? $manual_message
		: 'Final price confirmed by manager. No online payments.';

	$currency = html_entity_decode( get_woocommerce_currency_symbol() );
	$formatted_total = 'manual' === $mode
		? sprintf( 'from %s %s', $currency, number_format_i18n( $total, 0 ) )
		: sprintf( '%s %s', $currency, number_format_i18n( $total, 0 ) );

	wp_send_json_success(
		array(
			'total'          => round( $total, 2 ),
			'formatted_total'=> $formatted_total,
			'mode'           => $mode,
			'breakdown'      => $breakdown,
			'note'           => $note,
		)
	);
}
add_action( 'wp_ajax_gts_calculate_price', 'gts_ajax_calculate_price' );
add_action( 'wp_ajax_nopriv_gts_calculate_price', 'gts_ajax_calculate_price' );

/**
 * AJAX: Submit transfer request.
 */
function gts_ajax_submit_transfer_request() {
	if ( ! gts_calculator_verify_nonce() ) {
		wp_send_json_error( array( 'message' => 'Security validation failed.' ), 403 );
	}

	$required = array(
		'from_country', 'from_city', 'from_address',
		'to_country', 'to_city', 'to_address',
		'date', 'time', 'transfer_type',
		'vehicle_type', 'vehicle_id', 'full_name', 'phone', 'email'
	);

	foreach ( $required as $key ) {
		if ( empty( $_POST[ $key ] ) ) {
			wp_send_json_error( array( 'message' => sprintf( 'Required field missing: %s', $key ) ), 422 );
		}
	}
	if ( empty( $_POST['consent'] ) ) {
		wp_send_json_error( array( 'message' => 'Consent is required.' ), 422 );
	}

	$email = sanitize_email( wp_unslash( $_POST['email'] ) );
	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => 'Invalid email address.' ), 422 );
	}

	$request_id = 'GTS-' . gmdate( 'Ymd-His' ) . '-' . wp_rand( 100, 999 );
	$manager_email = get_field( 'calc_email', 'option' );
	if ( ! $manager_email || ! is_email( $manager_email ) ) {
		$manager_email = get_option( 'admin_email' );
	}

	$vehicle_id = intval( $_POST['vehicle_id'] );
	$vehicle = wc_get_product( $vehicle_id );
	$vehicle_name = $vehicle ? $vehicle->get_name() : 'N/A';

	$lines = array(
		'Request ID: ' . $request_id,
		'Name: ' . sanitize_text_field( wp_unslash( $_POST['full_name'] ) ),
		'Phone: ' . sanitize_text_field( wp_unslash( $_POST['phone'] ) ),
		'Email: ' . $email,
		'',
		'Route:',
		'From: ' . sanitize_text_field( wp_unslash( $_POST['from_country'] ) ) . ', ' . sanitize_text_field( wp_unslash( $_POST['from_city'] ) ) . ', ' . sanitize_text_field( wp_unslash( $_POST['from_address'] ) ),
		'To: ' . sanitize_text_field( wp_unslash( $_POST['to_country'] ) ) . ', ' . sanitize_text_field( wp_unslash( $_POST['to_city'] ) ) . ', ' . sanitize_text_field( wp_unslash( $_POST['to_address'] ) ),
		'Date & time: ' . sanitize_text_field( wp_unslash( $_POST['date'] ) ) . ' ' . sanitize_text_field( wp_unslash( $_POST['time'] ) ),
		'',
		'Trip details:',
		'Transfer type: ' . sanitize_text_field( wp_unslash( $_POST['transfer_type'] ) ),
		'Passengers: ' . sanitize_text_field( wp_unslash( $_POST['passengers_group'] ?? '' ) ),
		'Luggage: ' . sanitize_text_field( wp_unslash( $_POST['luggage'] ?? '' ) ),
		'Vehicle class: ' . sanitize_text_field( wp_unslash( $_POST['vehicle_class'] ?? '' ) ),
		'Vehicle: ' . $vehicle_name,
		'Driver language: ' . sanitize_text_field( wp_unslash( $_POST['driver_language'] ?? '' ) ),
		'Driver gender: ' . sanitize_text_field( wp_unslash( $_POST['driver_gender'] ?? '' ) ),
		'Waiting time: ' . sanitize_text_field( wp_unslash( $_POST['waiting_minutes'] ?? '0' ) ) . ' min',
		'Round trip: ' . ( ! empty( $_POST['is_return'] ) ? 'Yes' : 'No' ),
		'Extras: ' . ( isset( $_POST['extras'] ) ? implode( ', ', array_map( 'sanitize_text_field', (array) wp_unslash( $_POST['extras'] ) ) ) : 'None' ),
		'Promo code: ' . sanitize_text_field( wp_unslash( $_POST['promo_code'] ?? '' ) ),
		'',
		'Estimated:',
		'Route distance: ' . sanitize_text_field( wp_unslash( $_POST['route_distance_km'] ?? '0' ) ) . ' km',
		'Route duration: ' . sanitize_text_field( wp_unslash( $_POST['route_duration_min'] ?? '0' ) ) . ' min',
		'Price mode: ' . sanitize_text_field( wp_unslash( $_POST['price_mode'] ?? 'manual' ) ),
		'Estimated price: ' . sanitize_text_field( wp_unslash( $_POST['estimated_price_text'] ?? '' ) ),
		'',
		'Additional notes: ' . sanitize_text_field( wp_unslash( $_POST['other_notes'] ?? '' ) ),
		'Client notes: ' . sanitize_text_field( wp_unslash( $_POST['notes'] ?? '' ) ),
	);

	$subject = sprintf( '[%s] Transfer request from %s', $request_id, sanitize_text_field( wp_unslash( $_POST['full_name'] ) ) );
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email );
	$sent = wp_mail( $manager_email, $subject, implode( "\n", $lines ), $headers );

	/**
	 * Hook for external integrations (Google Sheets / Telegram / CRM).
	 */
	do_action( 'gts_transfer_request_submitted', $_POST, array( 'request_id' => $request_id, 'email_sent' => $sent ) );

	if ( ! $sent ) {
		wp_send_json_error( array( 'message' => 'Could not send request. Please try again later.' ), 500 );
	}

	$confirmation_time = get_field( 'calc_confirmation_time', 'option' );
	if ( '' === trim( (string) $confirmation_time ) ) {
		$confirmation_time = '15 minutes';
	}

	wp_send_json_success(
		array(
			'request_id' => $request_id,
			'message'    => sprintf( 'Thank you! Request %s received. We will confirm within %s.', $request_id, $confirmation_time ),
		)
	);
}
add_action( 'wp_ajax_gts_submit_transfer_request', 'gts_ajax_submit_transfer_request' );
add_action( 'wp_ajax_nopriv_gts_submit_transfer_request', 'gts_ajax_submit_transfer_request' );
