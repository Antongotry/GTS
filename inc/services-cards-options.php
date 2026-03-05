<?php
/**
 * Global Services Cards options (ACF)
 *
 * @package GTS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default services cards used as fallback when options are empty.
 *
 * @return array<int, array<string, string>>
 */
function gts_get_default_services_cards() {
	return array(
		array(
			'title'       => 'Book a Flight',
			'description' => 'Private aviation coordination with trusted partners worldwide. Helicopters, charter jets, or business flights – synchronized with ground transport for smooth connections.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/01/home-5-1_result.webp',
			'url'         => home_url( '/services/special-transfers/' ),
		),
		array(
			'title'       => 'City-to-City Rides',
			'description' => 'Comfortable long-distance rides across borders and regions. Luxury vehicles, experienced chauffeurs, flexible stops – your itinerary, our responsibility.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/01/home-5-2_result.webp',
			'url'         => home_url( '/city-to-city/' ),
		),
		array(
			'title'       => 'Airport Transfers',
			'description' => 'Meet-and-greet service, flight tracking, luggage assistance, and smooth arrivals at any airport worldwide.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/01/home-5-3_result.webp',
			'url'         => home_url( '/services/airport-transfer/' ),
		),
		array(
			'title'       => 'Hourly Hire',
			'description' => 'Your personal driver – whenever and wherever you need. Ideal for business meetings, events or day-to-day mobility with total flexibility.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/01/home-5-4_result.webp',
			'url'         => home_url( '/services/hourly-hire/' ),
		),
		array(
			'title'       => 'Chauffeur Service',
			'description' => 'Personal chauffeur service for executives and private clients. Discreet, multilingual, impeccably trained professionals ensuring comfort, safety, and style.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/01/home-5-5_result.webp',
			'url'         => home_url( '/services/professional-chauffeur-service/' ),
		),
		array(
			'title'       => 'Limousine Service',
			'description' => 'Luxury sedans and limousines for high-profile travel. Ideal for official visits, ceremonies, or special occasions – elegance without compromise.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/01/home-5-6_result.webp',
			'url'         => home_url( '/limousine-service/' ),
		),
		array(
			'title'       => 'Luxury Wedding & Event Chauffeur Service',
			'description' => 'From elegant bridal arrivals to seamless guest transfers — GTS ensures your celebration runs perfectly on time and in perfect style.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-1_result.webp',
			'url'         => home_url( '/services/wedding/' ),
		),
		array(
			'title'       => 'Cultural & Sport Events Chauffeur Service',
			'description' => 'Seamless VIP chauffeur service for sports, cultural, and corporate events — available in 100+ countries. From tournaments to galas, GTS ensures every guest arrives on time and with ease.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-2_result.webp',
			'url'         => home_url( '/services/cultural-sport-events/' ),
		),
		array(
			'title'       => 'Family Travel Chauffeur Service',
			'description' => 'Premium comfort and safety for every generation. From airport pickups to family getaways — GTS ensures smooth, secure, and perfectly coordinated travel for you and your loved ones.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-3_result.webp',
			'url'         => home_url( '/services/family-travel-chauffeur-service/' ),
		),
		array(
			'title'       => 'Medical Transportation',
			'description' => 'Coordinated travel for patients and medical delegations. Equipped vehicles, professional care, and assistance from pick-up to hospital arrival.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-4_result.webp',
			'url'         => home_url( '/services/medical-transportation/' ),
		),
		array(
			'title'       => 'Travel Personal Interpreter',
			'description' => 'Certified interpreters accompanying you during business meetings, negotiations, or tours. Available in major languages and coordinated with your schedule.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-5_result.webp',
			'url'         => home_url( '/services/travel-personal-interpreter/' ),
		),
		array(
			'title'       => 'Travel Planning',
			'description' => 'Complete itinerary creation — from transfers to flights, accommodations, and route timing. Our planners ensure everything runs like clockwork.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-6_result.webp',
			'url'         => home_url( '/services/travel-planninig/' ),
		),
		array(
			'title'       => 'Shopping Chauffeur Service',
			'description' => 'From luxury boutiques to private showrooms, GTS ensures seamless movement and discreet comfort — wherever you shop. Shopping should be a pleasure, not a schedule.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-7_result.webp',
			'url'         => home_url( '/services/shoping/' ),
		),
		array(
			'title'       => 'Corporate Events Chauffeur Service',
			'description' => 'From executive conferences and corporate meetings to product launches and gala receptions, GTS ensures every arrival, transfer, and departure runs exactly as planned — quietly, professionally, and on time.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-8_result.webp',
			'url'         => home_url( '/services/corporate-events-chauffeur-service/' ),
		),
		array(
			'title'       => 'Private Tours',
			'description' => 'From iconic landmarks to hidden destinations, GTS designs private chauffeur tours around your interests, pace, and itinerary — with seamless transfers, professional drivers, and complete flexibility throughout the journey.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-9_result.webp',
			'url'         => home_url( '/services/private-tours/' ),
		),
		array(
			'title'       => 'Travel Agencies',
			'description' => 'Reliable ground transportation partner for agencies and DMCs. Instant confirmations, transparent rates, 24/7 coordination, and seamless integration with your client itineraries.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-10_result.webp',
			'url'         => home_url( '/services/travel-agencies/' ),
		),
		array(
			'title'       => 'Mobility Partnerships',
			'description' => 'Long-term cooperation for hospitality, aviation, hotels and event industries. From VIP airport transfers to full guest logistics — seamlessly integrated with your brand and standards.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-11_result.webp',
			'url'         => home_url( '/services/mobility-partnership/' ),
		),
		array(
			'title'       => 'Airport Transfers for Events',
			'description' => 'GTS provides event airport transfers with precise scheduling and coordinated execution — ensuring smooth arrivals and departures for all guests.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-12_result.webp',
			'url'         => home_url( '/services/airport-transfer-service/' ),
		),
		array(
			'title'       => 'Chauffeur & Mobility Solutions for Corporations',
			'description' => 'GTS provides chauffeur and mobility solutions for corporations that need consistent, well-managed transportation across executive travel and ongoing operations.',
			'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-13_result.webp',
			'url'         => home_url( '/services/corporations/' ),
		),
	);
}

/**
 * Resolve global services cards list from ACF options with default fallback.
 *
 * @return array<int, array<string, string>>
 */
function gts_get_global_services_cards() {
	$defaults = gts_get_default_services_cards();

	if ( ! function_exists( 'get_field' ) ) {
		return $defaults;
	}

	$rows = get_field( 'gts_global_services_cards', 'option' );
	if ( ! is_array( $rows ) || empty( $rows ) ) {
		return $defaults;
	}

	$cards = array();
	foreach ( $rows as $row ) {
		if ( ! is_array( $row ) ) {
			continue;
		}

		$title = isset( $row['title'] ) ? trim( (string) $row['title'] ) : '';
		$description = isset( $row['description'] ) ? trim( (string) $row['description'] ) : '';
		$image_raw = isset( $row['image'] ) ? $row['image'] : '';
		$image = '';
		if ( is_numeric( $image_raw ) ) {
			$image_id = (int) $image_raw;
			$image = $image_id > 0 ? (string) wp_get_attachment_url( $image_id ) : '';
		} elseif ( is_array( $image_raw ) && ! empty( $image_raw['url'] ) ) {
			$image = trim( (string) $image_raw['url'] );
		} else {
			$image = trim( (string) $image_raw );
		}
		$url = isset( $row['url'] ) ? trim( (string) $row['url'] ) : '';

		if ( '' === $title || '' === $description || '' === $image || '' === $url ) {
			continue;
		}

		$cards[] = array(
			'title'       => $title,
			'description' => $description,
			'image'       => $image,
			'url'         => $url,
		);
	}

	return ! empty( $cards ) ? $cards : $defaults;
}

/**
 * Register Services Cards options page.
 */
function gts_register_services_cards_options_page() {
	if ( ! function_exists( 'acf_add_options_sub_page' ) ) {
		return;
	}

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Services Cards',
			'menu_title'  => 'Services Cards',
			'menu_slug'   => 'gts-services-cards',
			'parent_slug' => 'gts-settings',
			'capability'  => 'manage_options',
		)
	);
}
add_action( 'acf/init', 'gts_register_services_cards_options_page' );

/**
 * Register Services Cards ACF fields.
 */
function gts_register_services_cards_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_gts_services_cards_options',
			'title'  => 'Global Services Cards',
			'fields' => array(
				array(
					'key'           => 'field_gts_global_services_cards',
					'label'         => 'Cards',
					'name'          => 'gts_global_services_cards',
					'type'          => 'repeater',
					'instructions'  => 'These cards are used on homepage and on service pages. Keep all required fields filled.',
					'layout'        => 'block',
					'button_label'  => 'Add card',
					'collapsed'     => 'field_gts_global_services_cards_title',
					'sub_fields'    => array(
						array(
							'key'      => 'field_gts_global_services_cards_title',
							'label'    => 'Title',
							'name'     => 'title',
							'type'     => 'text',
							'required' => 1,
							'wrapper'  => array(
								'width' => '50',
							),
						),
						array(
							'key'      => 'field_gts_global_services_cards_url',
							'label'    => 'Link URL',
							'name'     => 'url',
							'type'     => 'url',
							'required' => 1,
							'wrapper'  => array(
								'width' => '50',
							),
						),
						array(
							'key'      => 'field_gts_global_services_cards_description',
							'label'    => 'Description',
							'name'     => 'description',
							'type'     => 'textarea',
							'required' => 1,
							'rows'     => 4,
						),
						array(
							'key'           => 'field_gts_global_services_cards_image',
							'label'         => 'Image',
							'name'          => 'image',
							'type'          => 'image',
							'required'      => 1,
							'return_format' => 'url',
							'preview_size'  => 'medium',
							'library'       => 'all',
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'gts-services-cards',
					),
				),
			),
			'style'    => 'default',
		)
	);
}
add_action( 'acf/init', 'gts_register_services_cards_fields' );

/**
 * Seed Services Cards options with defaults when options are empty.
 * Runs once and does not overwrite existing admin data.
 */
function gts_seed_services_cards_options() {
	if ( ! function_exists( 'get_field' ) || ! function_exists( 'update_field' ) ) {
		return;
	}

	$current_rows = get_field( 'gts_global_services_cards', 'option' );
	if ( is_array( $current_rows ) && ! empty( $current_rows ) ) {
		return;
	}

	$defaults = gts_get_default_services_cards();
	if ( empty( $defaults ) ) {
		return;
	}

	$seed_rows = array();
	foreach ( $defaults as $card ) {
		if ( ! is_array( $card ) ) {
			continue;
		}

		$image_url = isset( $card['image'] ) ? trim( (string) $card['image'] ) : '';
		$image_id  = $image_url !== '' ? (int) attachment_url_to_postid( $image_url ) : 0;

		$seed_rows[] = array(
			'title'       => isset( $card['title'] ) ? (string) $card['title'] : '',
			'description' => isset( $card['description'] ) ? (string) $card['description'] : '',
			'url'         => isset( $card['url'] ) ? (string) $card['url'] : '',
			'image'       => $image_id > 0 ? $image_id : $image_url,
		);
	}

	update_field( 'gts_global_services_cards', $seed_rows, 'option' );
}
add_action( 'acf/init', 'gts_seed_services_cards_options', 30 );

/**
 * Upgrade existing cards image values from URL to attachment ID when possible.
 */
function gts_upgrade_services_cards_images_to_ids() {
	if ( ! function_exists( 'get_field' ) || ! function_exists( 'update_field' ) ) {
		return;
	}

	$rows = get_field( 'gts_global_services_cards', 'option' );
	if ( ! is_array( $rows ) || empty( $rows ) ) {
		return;
	}

	$changed = false;
	foreach ( $rows as $index => $row ) {
		if ( ! is_array( $row ) || ! isset( $row['image'] ) ) {
			continue;
		}

		if ( is_numeric( $row['image'] ) ) {
			continue;
		}

		$image_url = '';
		if ( is_array( $row['image'] ) && ! empty( $row['image']['url'] ) ) {
			$image_url = trim( (string) $row['image']['url'] );
		} else {
			$image_url = trim( (string) $row['image'] );
		}

		if ( '' === $image_url ) {
			continue;
		}

		$image_id = (int) attachment_url_to_postid( $image_url );
		if ( $image_id > 0 ) {
			$rows[ $index ]['image'] = $image_id;
			$changed = true;
		}
	}

	if ( $changed ) {
		update_field( 'gts_global_services_cards', $rows, 'option' );
	}
}
add_action( 'acf/init', 'gts_upgrade_services_cards_images_to_ids', 40 );
