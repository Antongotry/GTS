<?php

/**
 * Template for displaying single Service posts
 *
 * All blocks read from ACF fields with fallback to original content.
 * Each block can be enabled/disabled via ACF toggle.
 *
 * @package GTS
 */

get_header();

// Get ACF blocks for this service
$blocks_data = array();
$block_enabled = array(
	'hero' => true,
	'service_context' => false,
	'service_intro' => true,
	'booking_form' => true,
	'why_us' => true,
	'fleet' => true,
	'occasions' => true,
	'how_it_works' => true,
	'testimonials' => true,
	'faq' => true,
	'cta' => true,
	'related_services' => true,
	'bottom_text' => true,
);

if (function_exists('get_field')) {
	$blocks = get_field('service_blocks');
	if ($blocks && is_array($blocks)) {
		foreach ($blocks as $block) {
			$layout = isset($block['acf_fc_layout']) ? $block['acf_fc_layout'] : '';
			if ($layout) {
				$blocks_data[$layout] = $block;
				$block_enabled[$layout] = isset($block['enabled']) ? (bool)$block['enabled'] : true;
				// Store blocks in order for dynamic rendering
				$blocks_ordered[] = array(
					'layout' => $layout,
					'data'   => $block,
					'enabled' => isset($block['enabled']) ? (bool)$block['enabled'] : true,
				);
			}
		}
	}
}
// Initialize empty ordered blocks if not set
if (!isset($blocks_ordered)) {
	$blocks_ordered = array();
}

$site_url = get_site_url();
$current_service_slug = '';
if (is_singular('service')) {
	$current_service_slug = (string) get_post_field('post_name', get_the_ID());
}
$is_airport_transfer_service = ('airport-transfer-service' === $current_service_slug);
$is_professional_chauffeur_service = ('professional-chauffeur-service' === $current_service_slug);
$is_special_transfers_service = ('special-transfers' === $current_service_slug);
$is_wedding_service = ('wedding' === $current_service_slug);
$is_cultural_sport_events_service = ('cultural-sport-events' === $current_service_slug);
$is_corporate_events_chauffeur_service = ('corporate-events-chauffeur-service' === $current_service_slug);
$is_private_tours_service = ('private-tours' === $current_service_slug);
$is_travel_agencies_service = ('travel-agencies' === $current_service_slug);
$is_family_travel_chauffeur_service = ('family-travel-chauffeur-service' === $current_service_slug);
$is_medical_transportation_service = ('medical-transportation' === $current_service_slug);
$is_travel_personal_interpreter_service = ('travel-personal-interpreter' === $current_service_slug);
$is_travel_planninig_service = ('travel-planninig' === $current_service_slug);
$is_shoping_service = ('shoping' === $current_service_slug);

// Fill empty media fields in existing repeater rows with defaults by index.
// This keeps custom admin content untouched and prevents empty icons/images in templates.
$fill_missing_media = static function (array $items, array $defaults, array $media_keys): array {
	foreach ($items as $index => $item) {
		if (! is_array($item)) {
			continue;
		}
		$default_item = isset($defaults[$index]) && is_array($defaults[$index]) ? $defaults[$index] : array();
		if (empty($default_item)) {
			continue;
		}
		foreach ($media_keys as $media_key) {
			$current_value = isset($item[$media_key]) ? trim((string) $item[$media_key]) : '';
			$default_value = isset($default_item[$media_key]) ? trim((string) $default_item[$media_key]) : '';
			if ('' === $current_value && '' !== $default_value) {
				$items[$index][$media_key] = $default_item[$media_key];
			}
		}
	}

	return $items;
};

// =====================
// DEFAULT DATA
// =====================

// Hero defaults
$hero = isset($blocks_data['hero']) ? $blocks_data['hero'] : array();
$hero_pretitle_enabled = ! empty($hero['pretitle_enabled']);
$hero_pretitle = ! empty($hero['pretitle']) ? $hero['pretitle'] : '';
$hero_title = ! empty($hero['title']) ? $hero['title'] : 'City-to-City premium transfers';
$hero_subtitle = ! empty($hero['subtitle']) ? $hero['subtitle'] : 'for corporate and private clients who need reliable long-distance travel with full coordination.';
$hero_bg_mobile = ! empty($hero['background_mobile']) ? $hero['background_mobile'] : 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-of-city-375_result.webp';
$hero_bg_tablet = ! empty($hero['background_tablet']) ? $hero['background_tablet'] : 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-of-city-1024_result.webp';
$hero_bg_desktop = ! empty($hero['background_desktop']) ? $hero['background_desktop'] : 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-of-city-1920_result-scaled.webp';
$hero_cta_text = ! empty($hero['cta_text']) ? $hero['cta_text'] : 'Book a transfer';
$hero_cta_link = ! empty($hero['cta_link']) ? $hero['cta_link'] : '#';
$hero_features_enabled = ! isset($hero['features_enabled']) || (bool) $hero['features_enabled'];
$hero_icon_1 = file_get_contents(get_template_directory() . '/assets/icons/icon-1-l.svg');
$hero_icon_2 = file_get_contents(get_template_directory() . '/assets/icons/icon-2-l.svg');
$hero_icon_3 = file_get_contents(get_template_directory() . '/assets/icons/icon-3-l.svg');
$hero_icon_2_markup = $hero_icon_2;
$hero_icon_3_markup = $hero_icon_3;
$hero_airport_meet_icon_markup = '';
$hero_airport_flight_icon_markup = '';
$hero_airport_meet_text = '';
$hero_airport_flight_text = '';
$hero_icon_allowed_tags = gts_allowed_svg_hero();
$hero_icon_allowed_tags['img'] = array(
	'src' => true,
	'alt' => true,
	'width' => true,
	'height' => true,
	'loading' => true,
	'decoding' => true,
);
$hero_feature_2_text = 'Operated by licensed chauffeurs<br>with 24/7 support';
$hero_feature_3_text = 'Licensed & insured, premium fleet';
if ('hourly-hire' === $current_service_slug) {
	$hero_title = 'Hourly Car Hire with<br>Private Chauffeur';
	$hero_subtitle = 'Enjoy the freedom to travel on your schedule — with<br>a dedicated driver and premium vehicle at your disposal.';
	$hero_feature_2_text = 'Operated by&nbsp;licensed<br>chauffeurs&nbsp;with&nbsp;24/7 support';
}
if ($is_professional_chauffeur_service) {
	$hero_title = 'Professional Chauffeur<br>Service — Worldwide';
	$hero_subtitle = 'GTS provides&nbsp;executive and luxury chauffeur services&nbsp;in over<br>100 countries — ensuring every journey is discreet, punctual,<br>and tailored to you.';
	$hero_feature_2_text = 'Operated by&nbsp;licensed<br>chauffeurs&nbsp;with&nbsp;24/7 support';
	$hero_feature_3_text = 'Business &amp; luxury fleet';
}
if ($is_special_transfers_service) {
	$hero_title = 'Special Transfers — Air,<br>Sea &amp; VIP Transport';
	$hero_subtitle = 'Private jets, helicopters, yachts, and luxury ground transfers — all<br>coordinated through one trusted service. Wherever your destination,<br>GTS ensures seamless movement across air, sea, and land with<br>absolute precision and discretion.';
	$hero_icon_1 = '';
	$hero_icon_2_markup = '<img src="https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Special-Transfers-2.svg" alt="" width="32" height="32" loading="lazy" decoding="async">';
	$hero_icon_3_markup = file_get_contents(get_template_directory() . '/assets/icons/icon-2-l.svg');
	$hero_feature_2_text = '24/7 coordination';
	$hero_feature_3_text = 'Business &amp; luxury fleet';
}
if ($is_wedding_service) {
	$hero_subtitle = 'From elegant bridal arrivals to seamless guest transfers — GTS<br>ensures your celebration runs perfectly on time and in perfect style.';
	$hero_feature_2_text = 'Experienced chauffeurs';
	$hero_feature_3_text = 'Licensed &amp; insured, premium fleet';
}
if ($is_cultural_sport_events_service) {
	$hero_subtitle = 'Seamless&nbsp;VIP chauffeur service&nbsp;for sports, cultural, and corporate<br>events — available in 100+ countries. From tournaments to galas, GTS<br>ensures every guest arrives&nbsp;on time and with ease.';
	$hero_feature_2_text = 'Licensed chauffeurs';
}
if ($is_family_travel_chauffeur_service) {
	$hero_title = 'Family Travel<br>Chauffeur Service';
	$hero_subtitle = 'Premium comfort and safety for every generation. From airport<br>pickups to family getaways — GTS ensures smooth, secure, and<br>perfectly coordinated travel for you and your loved ones.';
	$hero_feature_2_text = 'Operated by&nbsp;licensed<br>chauffeurs&nbsp;with&nbsp;24/7 support';
	$hero_feature_3_text = 'Business &amp; luxury vehicles';
}
if ($is_medical_transportation_service) {
	$hero_subtitle = 'For medical appointments, post-surgery transfers, or travel requiring<br>special attention —&nbsp;GTS Medical Transportation Service&nbsp;provides safe,<br>comfortable, and fully coordinated journeys.';
	$hero_feature_2_text = 'Operated by&nbsp;licensed<br>chauffeurs&nbsp;with&nbsp;24/7 support';
	$hero_feature_3_text = 'Premium&nbsp;&nbsp;vehicles';
}
if ($is_travel_personal_interpreter_service) {
	$hero_title = 'Travel Personal<br>Interpreter';
	$hero_subtitle = 'GTS offers a&nbsp;Travel Personal Interpreter&nbsp;for travelers who<br>need accurate, in-person language support during<br>international travel — ensuring clarity, confidence, and<br>cultural understanding in every interaction.';
	$hero_cta_text = 'Request Interpreter Support';
	$hero_icon_2_markup = '<img src="https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Travel-Personal-Interpreter-2.svg" alt="" width="32" height="32" loading="lazy" decoding="async">';
	$hero_icon_3_markup = '<img src="https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Travel-Personal-Interpreter-3.svg" alt="" width="32" height="32" loading="lazy" decoding="async">';
	$hero_feature_2_text = 'Suitable for business<br>and private needs';
	$hero_feature_3_text = 'Seamless, professional presence';
}
if ($is_travel_planninig_service) {
	$hero_title = 'Travel Planning<br>Service';
}
if ($is_shoping_service) {
	$hero_title = 'Shopping Chauffeur<br>Service. Shop at your<br>pace. Travel in comfort.';
	$hero_subtitle = 'From luxury boutiques to private showrooms, GTS<br>ensures seamless movement and discreet comfort<br>— wherever you shop. Shopping should be a<br>pleasure, not a schedule.';
	$hero_feature_2_text = 'Coordination in 100+ countries.';
	$hero_feature_3_text = 'Business &amp; luxury fleet';
	$hero_icon_1_original = $hero_icon_1;
	$hero_icon_1 = $hero_icon_2;
	$hero_icon_2_markup = $hero_icon_1_original;
}
if ($is_corporate_events_chauffeur_service) {
	$hero_title = 'Corporate Events<br>Chauffeur Service';
	$hero_subtitle = 'From executive conferences and corporate<br>meetings to product launches and gala<br>receptions, GTS ensures every arrival, transfer,<br>and departure runs exactly as planned — quietly,<br>professionally, and on time.';
	$hero_feature_2_text = 'Coordination in 100+ countries.';
	$hero_feature_3_text = 'Business &amp; luxury fleet';
	$hero_icon_1_original = $hero_icon_1;
	$hero_icon_1 = $hero_icon_2;
	$hero_icon_2_markup = $hero_icon_1_original;
}
if ($is_private_tours_service) {
	$hero_title = 'Private Tours<br>Chauffeur Service';
	$hero_subtitle = 'From iconic landmarks to hidden destinations,<br>GTS designs&nbsp;private chauffeur tours&nbsp;around your<br>interests, pace, and itinerary — with seamless<br>transfers, professional drivers, and complete<br>flexibility throughout the journey.';
	$hero_feature_2_text = 'Coordination in 100+ countries.';
	$hero_feature_3_text = 'Business &amp; luxury fleet';
	$hero_icon_1_original = $hero_icon_1;
	$hero_icon_1 = $hero_icon_2;
	$hero_icon_2_markup = $hero_icon_1_original;
}
if ($is_travel_agencies_service) {
	$hero_pretitle_enabled = true;
	$hero_pretitle = 'A reliable transportation partner for your clients worldwide.';
	$hero_title = 'Private Tours<br>Chauffeur Service';
	$hero_subtitle = 'From private tours to airport transfers, GTS<br>ensures every client journey reflects the quality<br>and professionalism of your brand.';
	$hero_feature_2_text = 'Coordination in 100+ countries.';
	$hero_feature_3_text = 'Business &amp; luxury fleet';
	$hero_icon_1_original = $hero_icon_1;
	$hero_icon_1 = $hero_icon_2;
	$hero_icon_2_markup = $hero_icon_1_original;
}
if ($is_airport_transfer_service) {
	$hero_title = 'Airport Transfer Service — Where<br>Every Arrival Feels Effortless';
	$hero_subtitle = 'for business leaders and private clients who expect<br>comfort, style, and flawless coordination.';
	$hero_feature_2_text = 'Licensed Chauffeurs';
	$hero_feature_3_text = 'Business &amp; luxury fleet';
	$hero_airport_meet_text = 'Meet &amp; Greet';
	$hero_airport_flight_text = 'Flight Tracking | 24/7 Coordination';
	$hero_airport_meet_icon_markup = '<img src="https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/meet.svg" alt="" width="32" height="32" loading="lazy" decoding="async">';
	$hero_airport_flight_icon_markup = '<img src="https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/ic_baseline-done-all.svg" alt="" width="32" height="32" loading="lazy" decoding="async">';
}

// Service Intro defaults (under Hero, no background image / no blur)
$service_context = isset($blocks_data['service_context']) ? $blocks_data['service_context'] : array();
if ($is_travel_personal_interpreter_service) {
	$service_context = array(
		'pill_text' => 'Full Service',
		'title' => 'Where accuracy, tone, and context truly matter.',
		'variant' => 'context',
		'top_image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Full-Service1_result.webp',
		'bottom_image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Full-Service2_result.webp',
		'cards' => array(
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Full-Service-1.svg',
				'text' => 'Business meetings and<br>negotiations',
				'col_start' => 1, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'image',
				'image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Full-Service1_result.webp',
				'col_start' => 2, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Full-Service-2.svg',
				'text' => 'Corporate travel and<br>executive visits',
				'col_start' => 3, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'light',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Full-Service-3.svg',
				'text' => 'Medical appointments and<br>consultations',
				'col_start' => 4, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Full-Service-4.svg',
				'text' => 'Legal, administrative, or<br>official procedures',
				'col_start' => 5, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'light',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Full-Service-5.svg',
				'text' => 'Property viewings and real<br>estate transactions',
				'col_start' => 1, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Full-Service-6.svg',
				'text' => 'Private travel, events, and<br>high-level appointments',
				'col_start' => 2, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Full-Service-7.svg',
				'text' => 'Multi-day or multi-location<br>travel programs',
				'col_start' => 3, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'image',
				'image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Full-Service2_result.webp',
				'col_start' => 4, 'col_span' => 2, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 2,
			),
		),
	);
}
if ($is_travel_planninig_service) {
	$service_context = array(
		'pill_text' => 'Full Service',
		'title' => 'When Professional Travel Planning Matters',
		'subtitle' => 'Where planning quality directly impacts the travel experience.',
		'variant' => 'context',
		'top_image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325458_result.webp',
		'bottom_image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325476_result.webp',
		'cards' => array(
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/When-1.svg',
				'text' => 'Multi-destination or multi-<br>country travel',
				'col_start' => 1, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'image',
				'image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325458_result.webp',
				'col_start' => 2, 'col_span' => 2, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 2,
			),
			array(
				'card_type' => 'text',
				'theme' => 'light',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/When-2.svg',
				'text' => 'Business travel combined<br>with leisure',
				'col_start' => 4, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/When-3.svg',
				'text' => 'Time-sensitive or high-<br>responsibility trips',
				'col_start' => 5, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'light',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/When-4.svg',
				'text' => 'Private travel requiring<br>coordination of multiple<br>services',
				'col_start' => 1, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/When-5.svg',
				'text' => 'Complex itineraries where<br>efficiency is essential',
				'col_start' => 2, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/When-6.svg',
				'text' => 'Travel involving meetings,<br>appointments, or events',
				'col_start' => 3, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'image',
				'image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325476_result.webp',
				'col_start' => 4, 'col_span' => 2, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 2,
			),
		),
	);
}
if ($is_corporate_events_chauffeur_service) {
	$service_context = array(
		'pill_text' => 'Full Service',
		'title' => 'Where accuracy, tone, and context truly matter.',
		'subtitle' => 'From intimate executive gatherings to large-scale multi-day events with complex logistics.',
		'variant' => 'context',
		'top_image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Full-Service1_result.webp',
		'bottom_image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325466_result.webp',
		'cards' => array(
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Any-1.svg',
				'text' => 'Conferences &amp; business<br>forums',
				'col_start' => 1, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'image',
				'image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Full-Service1_result.webp',
				'col_start' => 2, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Any-2.svg',
				'text' => 'Corporate meetings &amp;<br>roadshows',
				'col_start' => 3, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'light',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Any-3.svg',
				'text' => 'Product launches &amp;<br>brand events',
				'col_start' => 4, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Any-4.svg',
				'text' => 'Executive summits &amp;<br>board meetings',
				'col_start' => 5, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'light',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Any-5.svg',
				'text' => 'Gala dinners &amp; award<br>ceremonies',
				'col_start' => 1, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Any-6.svg',
				'text' => 'International corporate<br>delegations',
				'col_start' => 2, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Any-7.svg',
				'text' => 'Investor meetings &amp; partner<br>events',
				'col_start' => 3, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'image',
				'image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325466_result.webp',
				'col_start' => 4, 'col_span' => 2, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 2,
			),
		),
	);
}
if ($is_private_tours_service) {
	$service_context = array(
		'pill_text' => 'Full Service',
		'title' => 'Perfect for Private Travel Experiences',
		'subtitle' => 'From half-day explorations to multi-day private journeys.',
		'variant' => 'context',
		'top_image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/213124_result.webp',
		'bottom_image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/12551212_result.webp',
		'cards' => array(
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/for-1.svg',
				'text' => 'City sightseeing and<br>cultural tours',
				'col_start' => 1, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'image',
				'image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/213124_result.webp',
				'col_start' => 2, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/for-2.svg',
				'text' => 'Scenic drives and<br>countryside routes',
				'col_start' => 3, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'light',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/for-3.svg',
				'text' => 'Coastal, mountain, or<br>wine region tours',
				'col_start' => 4, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/for-4.svg',
				'text' => 'Historical and<br>architectural routes',
				'col_start' => 5, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'light',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/for-5.svg',
				'text' => 'Multi-city or cross-border<br>private tours',
				'col_start' => 1, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/for-6.svg',
				'text' => 'Custom itineraries and off-<br>the-beaten-path<br>experiences',
				'col_start' => 2, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/for-7.svg',
				'text' => 'Leisure travel during<br>business trips or holidays',
				'col_start' => 3, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'image',
				'image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/12551212_result.webp',
				'col_start' => 4, 'col_span' => 2, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 2,
			),
		),
	);
}
if ($is_travel_agencies_service) {
	$service_context = array(
		'pill_text' => 'Full Service',
		'title' => 'One partner. One standard. Long-term reliability.',
		'subtitle' => 'Mobility Partnership is built for organisations that need more than individual rides or one-off bookings.',
		'variant' => 'partnership',
		'top_image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/11234_result.webp',
		'bottom_image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/5125_result.webp',
		'cards' => array(
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Long-1.svg',
				'text' => 'Private tours and<br>sightseeing programs',
				'col_start' => 1, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'image',
				'image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/11234_result.webp',
				'col_start' => 2, 'col_span' => 2, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 2,
			),
			array(
				'card_type' => 'text',
				'theme' => 'light',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Long-2.svg',
				'text' => 'Airport transfers and meet &amp;<br>greet',
				'col_start' => 4, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Long-3.svg',
				'text' => 'Multi-day itineraries and<br>custom routes',
				'col_start' => 5, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'light',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Long-4.svg',
				'text' => 'VIP and luxury travel<br>services',
				'col_start' => 1, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Long-5.svg',
				'text' => 'Corporate and leisure client<br>support',
				'col_start' => 2, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Long-6.svg',
				'text' => 'Individual bookings and<br>group coordination',
				'col_start' => 3, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'image',
				'image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/5125_result.webp',
				'col_start' => 4, 'col_span' => 2, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 2,
			),
		),
	);
}
if ($is_shoping_service) {
	$service_context = array(
		'pill_text' => 'Full Service',
		'title' => 'Perfect for Every Purpose',
		'variant' => 'purpose',
		'top_image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325492_result.webp',
		'bottom_image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/23124515_result.webp',
		'cards' => array(
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Purpose-1.svg',
				'text' => 'Boutique shopping across<br>multiple districts',
				'col_start' => 1, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'image',
				'image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325492_result.webp',
				'col_start' => 2, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Purpose-2.svg',
				'text' => 'Designer outlets and<br>premium shopping malls',
				'col_start' => 3, 'col_span' => 1, 'row_start' => 1, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'image',
				'image' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/23124515_result.webp',
				'col_start' => 4, 'col_span' => 2, 'row_start' => 1, 'row_span' => 2, 'mobile_span' => 2,
			),
			array(
				'card_type' => 'text',
				'theme' => 'light',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Purpose-3.svg',
				'text' => 'Personal shopping sessions<br>and private appointments',
				'col_start' => 1, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Purpose-4.svg',
				'text' => 'Multi-location shopping<br>itineraries in one or several<br>cities',
				'col_start' => 2, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
			array(
				'card_type' => 'text',
				'theme' => 'dark',
				'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Purpose-5.svg',
				'text' => 'Shopping during business<br>trips or travel',
				'col_start' => 3, 'col_span' => 1, 'row_start' => 2, 'row_span' => 1, 'mobile_span' => 1,
			),
		),
	);
}

if ($is_shoping_service && ! empty($service_context['cards']) && is_array($service_context['cards'])) {
	foreach ($service_context['cards'] as $card_index => $card) {
		if (! is_array($card)) {
			continue;
		}
		$card_text = isset($card['text']) ? wp_strip_all_tags((string) $card['text']) : '';
		if (false !== stripos($card_text, 'Personal shopping sessions')) {
			$service_context['cards'][$card_index]['theme'] = 'light';
		}
	}
}

// Service Intro defaults (under Hero, no background image / no blur)
$service_intro = isset($blocks_data['service_intro']) ? $blocks_data['service_intro'] : array();
$has_service_intro_block = isset($blocks_data['service_intro']);
$service_intro_pill = ! empty($service_intro['pill_text']) ? $service_intro['pill_text'] : 'Preferences';
$service_intro_title = ! empty($service_intro['title']) ? $service_intro['title'] : 'A Better Way to Travel Between Cities';
$service_intro_description = ! empty($service_intro['description']) ? $service_intro['description'] : 'Airports, trains, rentals — they all take time, coordination, and patience. GTS offers a more refined way to move between cities: effortless, private, and precisely managed.';
$service_intro_button_text = ! empty($service_intro['button_text']) ? $service_intro['button_text'] : 'Book a transfer';
$service_intro_button_link = ! empty($service_intro['button_link']) ? $service_intro['button_link'] : '#';
$service_intro_items = ! empty($service_intro['items']) ? $service_intro['items'] : array();
$default_service_intro_items = array(
	array(
		'icon'        => $site_url . '/wp-content/uploads/2026/02/city-icon-1.svg',
		'title'       => 'Time is your real luxury',
		'description' => 'Skip queues and transfers — travel door-to-door, without waiting or interruptions.',
	),
	array(
		'icon'        => $site_url . '/wp-content/uploads/2026/02/city-icon-2.svg',
		'title'       => 'Confidence in every journey',
		'description' => 'No crowds, delays, or cancellations — just punctual, licensed chauffeurs and global coordination.',
	),
	array(
		'icon'        => $site_url . '/wp-content/uploads/2026/02/city-icon-3.svg',
		'title'       => 'Your schedule, your rules',
		'description' => 'Choose departure times and stops. Plans change? We adjust instantly, 24/7.',
	),
	array(
		'icon'        => $site_url . '/wp-content/uploads/2026/02/city-icon-4.svg',
		'title'       => 'Transparent, all-inclusive pricing',
		'description' => 'Pay per car, not per seat. Taxes, tolls, and waiting time are always included.',
	),
	array(
		'icon'        => $site_url . '/wp-content/uploads/2026/02/city-icon-5.svg',
		'title'       => 'Quiet comfort on every route',
		'description' => 'Relax in a premium car with a professional chauffeur, bottled water, and Wi-Fi on request.',
	),
	array(
		'icon'        => $site_url . '/wp-content/uploads/2026/02/city-icon-6.svg',
		'title'       => 'Flexible routes',
		'description' => 'Stop for meetings, meals, or sightseeing anytime.',
	),
);

if (empty($service_intro_items)) {
		$service_intro_items = $default_service_intro_items;
} else {
	$service_intro_items = $fill_missing_media($service_intro_items, $default_service_intro_items, array('icon'));
}

if ($is_special_transfers_service) {
	$service_intro_title = 'Tailored air &amp; ground solutions';
	$service_intro_description = 'Our team manages complex, high-profile itineraries — combining aviation, ground,<br>and maritime transport into one flawless plan. Each request is handled with<br>confidentiality, professionalism, and global expertise.';
	$service_intro_items = array(
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Special-Transfers1-1.svg',
			'title'       => 'Private & business aviation',
			'description' => 'jets, helicopters, and charter flights.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Special-Transfers1-2.svg',
			'title'       => 'Luxury sea transfers',
			'description' => 'yachts, catamarans, or private boats on demand.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Special-Transfers1-3.svg',
			'title'       => 'Integrated logistics',
			'description' => 'ground-air-sea connections, coordinated end-to-end.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Special-Transfers1-4.svg',
			'title'       => 'Discreet service',
			'description' => 'trusted by executives, diplomats, and VIP clients worldwide.',
		),
	);
}
if ($is_wedding_service) {
	$service_intro_title = 'Your Day, Perfectly Orchestrated';
	$service_intro_description = 'From intimate ceremonies to large-scale events, GTS delivers premium&nbsp;wedding and<br>private event chauffeur servicesdesigned to match your schedule, theme, and<br>expectations.';
	$service_intro_items = array(
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Wedding-1.svg',
			'title'       => 'Elegant Arrivals',
			'description' => 'arrive gracefully in a spotless luxury car driven by a professional chauffeur.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Wedding-2.svg',
			'title'       => 'Flawless Timing',
			'description' => 'seamless coordination between planners, photographers, and venues.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Wedding-3.svg',
			'title'       => 'Flexible Scheduling',
			'description' => 'we adapt to your pace, even if the day runs longer than planned.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Wedding-4.svg',
			'title'       => 'Discreet Presence',
			'description' => 'uniformed chauffeurs trained in etiquette and event protocol.',
		),
	);
}
if ($is_cultural_sport_events_service) {
	$service_intro_title = 'Tailored solutions for large-scale events';
	$service_intro_description = 'Whether it’s a film premiere, art fair, business congress, or international sports<br>competition — GTS provides premium&nbsp;chauffeur-driven logistics&nbsp;for guests,<br>performers, media teams, and VIP delegations.';
	$service_intro_items = array(
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Cultural-Sport-Events-1.svg',
			'title'       => 'Perfect timing',
			'description' => 'transfers coordinated with your event agenda, venue logistics, and security requirements.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Cultural-Sport-Events-2.svg',
			'title'       => 'Multi-location coverage',
			'description' => 'transfers between airports, venues, hotels, and receptions.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Cultural-Sport-Events-3.svg',
			'title'       => 'Professional coordination',
			'description' => 'live communication with event staff and planners.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Cultural-Sport-Events-4.svg',
			'title'       => 'Discreet service',
			'description' => 'trusted by public figures, artists, and high-level guests.',
		),
	);
}
if ($is_corporate_events_chauffeur_service) {
	$service_intro_title = 'Precision is what<br>separates smooth events<br>from stressful ones';
	$service_intro_description = 'We align vehicles, chauffeurs, and timing<br>with your agenda to ensure seamless<br>movement at every stage of the event';
	$service_intro_items = array(
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Flawless-1.svg',
			'title'       => 'Flawless timing',
			'description' => 'Arrivals and departures synchronised with agendas, speakers, venues, and protocol — no delays, no confusion.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Flawless-2.svg',
			'title'       => 'Flexible scheduling',
			'description' => 'Your program can evolve — routes, timings, or guest movements can be adjusted on the day.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Flawless-3.svg',
			'title'       => 'Centralised coordination',
			'description' => 'One point of contact for all vehicles, chauffeurs, routes, and real-time adjustments.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Flawless-4.svg',
			'title'       => 'Discreet, professional presence',
			'description' => 'Uniformed chauffeurs trained for corporate etiquette, protocol, and high-level clients.',
		),
	);
}
if ($is_private_tours_service) {
	$service_intro_title = 'Designed Around<br>Your Journey';
	$service_intro_description = 'Your private tour adapts to you — your<br>interests, your timing, and the moments<br>you choose to linger';
	$service_intro_items = array(
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Fully-1.svg',
			'title'       => 'Fully personalised itineraries',
			'description' => 'Routes, stops, and timing designed around your interests — not preset tour schedules.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Fully-2.svg',
			'title'       => 'Comfortable, uninterrupted travel',
			'description' => 'No crowds, no waiting, no fixed pickup times — just smooth, private movement.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Fully-3.svg',
			'title'       => 'Flexible pace',
			'description' => 'Stay longer where you wish, skip what doesn’t interest you, or adjust plans on the go.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Fully-4.svg',
			'title'       => 'Discreet, professional chauffeurs',
			'description' => 'Experienced drivers who ensure comfort, safety, and a calm travel experience throughout your tour.',
		),
	);
}
if ($is_travel_agencies_service) {
	$service_intro_title = 'A Transportation Partner<br>You Can Rely On';
	$service_intro_description = 'We work as a trusted extension of your agency,<br>delivering consistent service standards and smooth<br>coordination for every itinerary.';
	$service_intro_items = array(
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Consistent-1.svg',
			'title'       => 'Consistent global standards',
			'description' => 'The same service quality in every destination, regardless of country or city.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Consistent-2.svg',
			'title'       => 'Flexible coordination',
			'description' => 'Last-minute changes, flight delays, or itinerary updates handled in real time.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Consistent-3.svg',
			'title'       => 'White-label friendly',
			'description' => 'We operate as your trusted partner — your client sees a seamless travel experience.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Consistent-4.svg',
			'title'       => 'Scalable solutions',
			'description' => 'From individual travelers to large groups and complex itineraries.',
		),
	);
}
if ($is_family_travel_chauffeur_service) {
	$service_intro_title = 'Tailored transfers for family comfort';
	$service_intro_description = 'Whether it’s a family vacation, weekend getaway, or visiting relatives — GTS<br>offers&nbsp;premium family transfers&nbsp;that combine safety, space, and serenity.';
	$service_intro_items = array(
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Preferences-1.svg',
			'title'       => 'Spacious vehicles',
			'description' => 'Business vans, SUVs, and VIP cars for all luggage, strollers and comfort needs.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Preferences-2.svg',
			'title'       => 'Child-friendly setup',
			'description' => 'baby and booster seats available upon request.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Preferences-3.svg',
			'title'       => 'Door-to-door service',
			'description' => 'no stress, no waiting lines, no navigating public transport.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Preferences-4.svg',
			'title'       => 'Safe & trusted chauffeurs',
			'description' => 'professional, patient, and attentive to family needs.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Preferences-5.svg',
			'title'       => 'Available worldwide',
			'description' => 'Plan family trips confidently — across cities or countries — with one trusted service and consistent comfort everywhere.',
		),
	);
}
if ($is_medical_transportation_service) {
	$service_intro_title = 'A trusted service for patients<br>and families';
	$service_intro_description = 'We support individuals, families, and medical institutions with professional logistics<br>— whether it’s a hospital discharge, rehabilitation transfer, or patient relocation<br>between countries.';
	$service_intro_items = array(
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/A-trusted-1.svg',
			'title'       => 'Non-emergency medical transfers',
			'description' => 'safe and comfortable transport for patients and relatives.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/A-trusted-2.svg',
			'title'       => 'International coordination',
			'description' => 'ground, air, or multimodal transfers across 100+ countries.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/A-trusted-3.svg',
			'title'       => 'Professional chauffeurs',
			'description' => 'patient, discreet, and trained in special care handling.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/A-trusted-4.svg',
			'title'       => 'Adapted vehicles',
			'description' => 'Available for patients, seniors, and individuals with reduced mobility.',
		),
	);
}
if ($is_travel_personal_interpreter_service) {
	$service_intro_title = 'Designed Around Your<br>Travel Needs';
	$service_intro_description = '';
	$service_intro_button_text = '';
	$service_intro_items = array(
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Designed-1.svg',
			'title'       => 'In-person language support',
			'description' => 'Professional interpreters accompany you on-site — not remotely or via apps.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Designed-2.svg',
			'title'       => 'Flexible scheduling',
			'description' => 'Hourly, daily, or multi-day interpreter support aligned with your itinerary.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Designed-3.svg',
			'title'       => 'Context-aware interpretation',
			'description' => 'We interpret not only words, but intent, cultural nuances, and professional tone.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Designed-4.svg',
			'title'       => 'Discreet professional presence',
			'description' => 'Our interpreters work quietly in the background, supporting communication without drawing attention.',
		),
	);
}
if ($is_travel_planninig_service) {
	$service_intro_title = 'Designed Around Your<br>Travel Needs';
	$service_intro_description = '';
	$service_intro_button_text = '';
	$service_intro_items = array(
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Around-1.svg',
			'title'       => 'Personalised itineraries',
			'description' => 'Each travel plan is built around your goals, timing, and preferences — not templates.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Around-2.svg',
			'title'       => 'Logical flow and timing',
			'description' => 'Routes, transfers, stays, and appointments aligned to minimise friction and wasted time.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Around-3.svg',
			'title'       => 'Integrated services',
			'description' => 'Chauffeur, interpreter, mobility, and on-the-ground support coordinated within one plan.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Around-4.svg',
			'title'       => 'Flexibility built in',
			'description' => 'Plans adapt easily as schedules change or new priorities emerge.',
		),
	);
}
if ($is_shoping_service) {
	$service_intro_title = 'Designed around your<br>shopping plans';
	$service_intro_description = '';
	$service_intro_button_text = '';
	$service_intro_items = array(
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/your-1.svg',
			'title'       => 'Freedom to change plans on the go',
			'description' => 'Your itinerary can evolve in real time — add stops, change districts, or extend your shopping without rebooking.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/your-2.svg',
			'title'       => 'Your chauffeur always on standby',
			'description' => 'Your driver remains close throughout the booking, ready whenever you are — no waiting, no coordination stress.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/your-3.svg',
			'title'       => 'Smooth movement between locations',
			'description' => 'Routes, traffic, and timing are handled quietly in the background, so your day flows without interruptions.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/your-4.svg',
			'title'       => 'Discreet, practical assistance',
			'description' => 'Help with bags, doors, and logistics — always attentive, never intrusive.',
		),
		array(
			'icon'        => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/your-5.svg',
			'title'       => 'A shopping day without rushing',
			'description' => 'No fixed schedules or pressure to move on — take your time and enjoy each stop.',
		),
	);
}

// Booking Form - unified block with desktop and mobile sections
$booking = isset($blocks_data['booking_form']) ? $blocks_data['booking_form'] : array();
$has_booking_block = isset($blocks_data['booking_form']);

// Desktop form settings
$desktop_form_enabled = isset($booking['desktop_enabled']) ? (bool)$booking['desktop_enabled'] : true;
$desktop_form_submit = ! empty($booking['desktop_submit_text']) ? $booking['desktop_submit_text'] : 'Get My Quote';
$desktop_form_checkbox1 = ! empty($booking['desktop_checkbox1_text']) ? $booking['desktop_checkbox1_text'] : 'Book a Jet';
$desktop_form_checkbox2 = ! empty($booking['desktop_checkbox2_text']) ? $booking['desktop_checkbox2_text'] : 'Book a Helicopter';
$desktop_form_stats_number = ! empty($booking['desktop_stats_number']) ? $booking['desktop_stats_number'] : '100+';
$desktop_form_stats_label = ! empty($booking['desktop_stats_label']) ? $booking['desktop_stats_label'] : 'countries';

// Mobile form settings
$mobile_form_enabled = isset($booking['mobile_enabled']) ? (bool)$booking['mobile_enabled'] : true;
$mobile_form_submit = ! empty($booking['mobile_submit_text']) ? $booking['mobile_submit_text'] : 'Get My Quote';
$mobile_form_checkbox1 = ! empty($booking['mobile_checkbox1_text']) ? $booking['mobile_checkbox1_text'] : 'Book a Jet';
$mobile_form_checkbox2 = ! empty($booking['mobile_checkbox2_text']) ? $booking['mobile_checkbox2_text'] : 'Book a Helicopter';
$mobile_form_stats_number = ! empty($booking['mobile_stats_number']) ? $booking['mobile_stats_number'] : '100+';
$mobile_form_stats_label = ! empty($booking['mobile_stats_label']) ? $booking['mobile_stats_label'] : 'countries';


// Why Us defaults
$why_us = isset($blocks_data['why_us']) ? $blocks_data['why_us'] : array();
$why_us_pill = ! empty($why_us['pill_text']) ? $why_us['pill_text'] : 'Why us?';
$default_why_us_intro_title = 'GTS Limousine Service was created for those who expect every moment to reflect precision and class.';
$default_why_us_intro_text = 'Every journey is coordinated by professionals who understand that timing, presentation, and reliability are not extras — they are essentials.';
$why_us_intro_title = ! empty($why_us['intro_title']) ? $why_us['intro_title'] : $default_why_us_intro_title;
$why_us_intro_text = ! empty($why_us['intro_text']) ? $why_us['intro_text'] : $default_why_us_intro_text;
$why_us_cards = ! empty($why_us['cards']) ? $why_us['cards'] : array();
$default_why_us_cards = array(
	array('card_type' => 'image', 'image' => $site_url . '/wp-content/uploads/2026/01/home-2-block-1-_result.webp', 'title' => 'Available worldwide', 'description' => 'Consistent excellence in executive<br>and luxury transfers — wherever<br>your journey takes you.'),
	array('card_type' => 'icon', 'icon' => $site_url . '/wp-content/uploads/2026/01/icon-block-2-1.svg', 'title' => 'World-class fleet', 'description' => 'Late-model business, premium and<br>VIP vehicles, perfectly maintained for<br>comfort, style and safety.'),
	array('card_type' => 'icon', 'icon' => $site_url . '/wp-content/uploads/2026/01/icon-block-2-2.svg', 'title' => 'Qualified chauffeurs', 'description' => 'Licensed, experienced and discreet<br>professionals trained to meet the<br>highest service standards.'),
	array('card_type' => 'icon', 'icon' => $site_url . '/wp-content/uploads/2026/01/icon-block-2-3.svg', 'title' => 'Security & discretion', 'description' => 'Strict safety protocols, discreet<br>coordination, and confidential service for<br>corporate & VIP clients.'),
	array('card_type' => 'icon', 'icon' => $site_url . '/wp-content/uploads/2026/01/icon-block-2-4.svg', 'title' => '24/7 Human Support', 'description' => 'Book directly on the website or through<br>your personal manager — 24/7 via<br>messenger, email or phone.'),
	array('card_type' => 'image', 'image' => $site_url . '/wp-content/uploads/2026/01/home-2-block-2_result.webp', 'title' => 'Seamless coordination', 'description' => 'We work directly with your planner or venue to<br>synchronise every detail — from arrivals to final<br>departures.'),
);

if (empty($why_us_cards)) {
	$why_us_cards = $default_why_us_cards;
} else {
	$why_us_cards = $fill_missing_media($why_us_cards, $default_why_us_cards, array('icon', 'image'));
}

// Page-specific Why Us presets for existing services.
// Admin values always have priority. Preset fills defaults and missing media only.
if ('hourly-hire' === $current_service_slug) {
	$hourly_intro_title = 'GTS Hourly&nbsp;Hire was designed for those<br>who value control, comfort, and<br>impeccable timing.';
	$hourly_intro_text = 'Every ride is managed by professionals who treat flexibility<br>and precision not as a luxury — but as a standard.';
	$hourly_image_1 = $site_url . '/wp-content/uploads/2026/01/home-2-block-1-_result.webp';
	$hourly_image_6 = $site_url . '/wp-content/uploads/2026/01/home-2-block-2_result.webp';

	if ($why_us_intro_title === $default_why_us_intro_title || '' === trim((string) $why_us_intro_title)) {
		$why_us_intro_title = $hourly_intro_title;
	}
	if ($why_us_intro_text === $default_why_us_intro_text || '' === trim((string) $why_us_intro_text)) {
		$why_us_intro_text = $hourly_intro_text;
	}

	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$card_1_image = isset($why_us_cards[0]['image']) ? trim((string) $why_us_cards[0]['image']) : '';
		$card_1_icon = isset($why_us_cards[0]['icon']) ? trim((string) $why_us_cards[0]['icon']) : '';
		if ('' === $card_1_image && '' === $card_1_icon) {
			$why_us_cards[0]['card_type'] = 'image';
			$why_us_cards[0]['image'] = $hourly_image_1;
		}
		$why_us_cards[0]['description'] = 'Consistent excellence in executive<br>and luxury transfers — wherever<br>your journey takes you.';
	}

	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$card_6_image = isset($why_us_cards[5]['image']) ? trim((string) $why_us_cards[5]['image']) : '';
		$card_6_icon = isset($why_us_cards[5]['icon']) ? trim((string) $why_us_cards[5]['icon']) : '';
		if ('' === $card_6_image && '' === $card_6_icon) {
			$why_us_cards[5]['card_type'] = 'image';
			$why_us_cards[5]['image'] = $hourly_image_6;
		}
		$why_us_cards[5]['title'] = 'Guaranteed punctuality';
		$why_us_cards[5]['description'] = 'Our chauffeurs track flights and traffic in real<br>time to ensure every pickup happens precisely<br>on schedule.';
	}
}

if ($is_airport_transfer_service) {
	$why_us_intro_title = 'GTS Limousine Service was created for<br>those who expect every moment to reflect<br>precision and class.';
	$why_us_intro_text = 'Every journey is coordinated by professionals who<br>understand that timing, presentation, and reliability are not<br>extras — they are essentials.';

	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$why_us_cards[0]['description'] = 'Seamless&nbsp;airport transfers in 100+<br>countries&nbsp;— the same precision<br>and comfort, no matter where you<br>land.';
	}
	if (isset($why_us_cards[1]) && is_array($why_us_cards[1])) {
		$why_us_cards[1]['description'] = 'Business, premium, and VIP vehicles — late-<br>model, immaculate, and designed for comfort,<br>safety, and style.';
	}
	if (isset($why_us_cards[2]) && is_array($why_us_cards[2])) {
		$why_us_cards[2]['description'] = 'Licensed, experienced and discreet<br>professionals trained in executive protocol and<br>airport procedures to ensure smooth arrivals and<br>departures.';
	}
	if (isset($why_us_cards[3]) && is_array($why_us_cards[3])) {
		$why_us_cards[3]['description'] = 'Trusted by corporate and VIP travellers —<br>confidential coordination, safety-first standards,<br>and calm professionalism.';
	}
	if (isset($why_us_cards[4]) && is_array($why_us_cards[4])) {
		$why_us_cards[4]['description'] = 'A personal manager or live agent<br>always available — by website,<br>WhatsApp, or email, in any time zone.';
	}
	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$why_us_cards[5]['title'] = 'Guaranteed punctuality';
		$why_us_cards[5]['description'] = 'Real-time flight and traffic tracking — every<br>pickup and drop-off timed to perfection.';
	}
}

if ($is_professional_chauffeur_service) {
	$why_us_intro_title = 'Your Personal Driver —<br>Anywhere in the World';
	$why_us_intro_text = 'Every journey is coordinated by professionals who<br>understand that timing, presentation, and reliability are not<br>extras — they are essentials.';

	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$why_us_cards[0]['description'] = 'Seamless&nbsp;airport transfers in 100+<br>countries&nbsp;— the same precision<br>and comfort, no matter where you<br>land.';
	}
	if (isset($why_us_cards[1]) && is_array($why_us_cards[1])) {
		$why_us_cards[1]['description'] = 'Business, premium, and VIP vehicles — late-<br>model, immaculate, and designed for comfort,<br>safety, and style.';
	}
	if (isset($why_us_cards[2]) && is_array($why_us_cards[2])) {
		$why_us_cards[2]['description'] = 'Licensed, experienced and discreet<br>professionals trained in executive protocol and<br>airport procedures to ensure smooth arrivals and<br>departures.';
	}
	if (isset($why_us_cards[3]) && is_array($why_us_cards[3])) {
		$why_us_cards[3]['description'] = 'Trusted by corporate and VIP travellers —<br>confidential coordination, safety-first standards,<br>and calm professionalism.';
	}
	if (isset($why_us_cards[4]) && is_array($why_us_cards[4])) {
		$why_us_cards[4]['description'] = 'A personal manager or live agent<br>always available — by website,<br>WhatsApp, or email, in any time zone.';
	}
	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$why_us_cards[5]['title'] = 'Guaranteed punctuality';
		$why_us_cards[5]['description'] = 'Real-time flight and traffic tracking — every<br>pickup and drop-off timed to perfection.';
	}
}

if ($is_special_transfers_service) {
	$why_us_intro_title = 'GTS Hourly&nbsp;Hire was designed for those<br>who value control, comfort, and<br>impeccable timing.';
	$why_us_intro_text = 'Every ride is managed by professionals who treat flexibility<br>and precision not as a luxury — but as a standard.';

	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$why_us_cards[0]['description'] = '100+ countries, private terminals,<br>heliports, and marinas — one<br>standard of comfort and precision<br>wherever you travel.';
	}
	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$why_us_cards[5]['title'] = 'Guaranteed punctuality';
		$why_us_cards[5]['description'] = 'Real-time tracking and expert coordination<br>ensure every handover — air, sea, or ground —<br>happens exactly on time.';
	}
}
if ($is_wedding_service) {
	$why_us_intro_title = 'GTS Hourly Hire&nbsp;was designed for those<br>who value control, comfort, and<br>impeccable timing.';

	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$why_us_cards[0]['description'] = '100+ countries, private terminals,<br>heliports, and marinas — one<br>standard of comfort and precision<br>wherever you travel.';
	}
	if (isset($why_us_cards[3]) && is_array($why_us_cards[3])) {
		$why_us_cards[3]['description'] = 'Strict safety protocols, discreet<br>coordination, and confidential<br>service for corporate &amp; VIP clients.';
	}
	if (isset($why_us_cards[4]) && is_array($why_us_cards[4])) {
		$why_us_cards[4]['description'] = 'Book directly on the website or<br>through your personal manager —<br>24/7 via messenger, email or phone.';
	}
	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$why_us_cards[5]['title'] = 'Guaranteed punctuality';
		$why_us_cards[5]['description'] = 'Real-time tracking and expert coordination<br>ensure every handover — air, sea, or ground —<br>happens exactly on time.';
	}
}
if ($is_cultural_sport_events_service) {
	$why_us_intro_title = 'Why Choose GTS for Your Wedding or<br>Private Event';

	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$why_us_cards[0]['description'] = '100+ countries, private terminals,<br>heliports, and marinas — one<br>standard of comfort and precision<br>wherever you travel.';
	}
	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$why_us_cards[5]['description'] = 'We work directly with your planner or venue to<br>synchronise every detail — from arrivals to final<br>departures.';
	}
}
if ($is_family_travel_chauffeur_service) {
	$why_us_intro_title = 'Why Choose GTS for Your<br>Wedding or Private Event';
	$why_us_intro_text = '';

	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$why_us_cards[0]['description'] = '100+ countries, private terminals,<br>heliports, and marinas — one<br>standard of comfort and precision<br>wherever you travel.';
	}
	if (isset($why_us_cards[3]) && is_array($why_us_cards[3])) {
		$why_us_cards[3]['description'] = 'Trusted by corporate and VIP clients —<br>confidential coordination, safety-first standards,<br>and calm professionalism.';
	}
	if (isset($why_us_cards[4]) && is_array($why_us_cards[4])) {
		$why_us_cards[4]['description'] = 'A personal manager or live agent<br>always available — by website,<br>WhatsApp, or email, in any time zone.';
	}
	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$why_us_cards[5]['description'] = 'We work directly with your planner or venue to<br>synchronise every detail — from arrivals to final<br>departures.';
	}
}
if ($is_corporate_events_chauffeur_service) {
	$why_us_intro_title = 'Why Choose GTS for Your<br>Corporate Event Chauffeur Service';
	$why_us_intro_text = '';

	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$why_us_cards[0]['description'] = '100+ countries, private terminals,<br>heliports, and marinas — one<br>standard of comfort and precision<br>wherever you travel.';
	}
	if (isset($why_us_cards[1]) && is_array($why_us_cards[1])) {
		$why_us_cards[1]['title'] = 'World-class fleet';
		$why_us_cards[1]['description'] = 'Business, premium, and VIP vehicles<br>— immaculate, late-model, and<br>presentation-ready for your day.';
	}
	if (isset($why_us_cards[2]) && is_array($why_us_cards[2])) {
		$why_us_cards[2]['title'] = 'Qualified chauffeurs';
		$why_us_cards[2]['description'] = 'Licensed, experienced and discreet<br>professionals trained to meet the<br>highest service standards.';
	}
	if (isset($why_us_cards[3]) && is_array($why_us_cards[3])) {
		$why_us_cards[3]['title'] = 'Security & discretion';
		$why_us_cards[3]['description'] = 'Trusted by corporate and VIP clients<br>— confidential coordination, safety-<br>first standards, and calm<br>professionalism.';
	}
	if (isset($why_us_cards[4]) && is_array($why_us_cards[4])) {
		$why_us_cards[4]['title'] = '24/7 Human Support';
		$why_us_cards[4]['description'] = 'A personal manager or live agent<br>always available — by website,<br>WhatsApp, or email, in any time zone.';
	}
	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$why_us_cards[5]['title'] = 'Effortless coordination';
		$why_us_cards[5]['description'] = 'Routes, timing, vehicle movements,<br>and real-time adjustments managed<br>centrally, so your event runs without<br>disruption.';
	}
}
if ($is_private_tours_service) {
	$why_us_intro_title = 'Why Choose GTS for Your<br>Corporate Event Chauffeur Service';
	$why_us_intro_text = '';

	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$why_us_cards[0]['description'] = 'Private tour chauffeur service in<br>100+ countries — consistent<br>quality and comfort wherever your<br>journey takes you.';
	}
	if (isset($why_us_cards[1]) && is_array($why_us_cards[1])) {
		$why_us_cards[1]['title'] = 'World-class fleet';
		$why_us_cards[1]['description'] = 'Business, premium, and VIP vehicles<br>— late-model, immaculate, and<br>designed for comfortable city and<br>long-distance travel.';
	}
	if (isset($why_us_cards[2]) && is_array($why_us_cards[2])) {
		$why_us_cards[2]['title'] = 'Professional chauffeurs';
		$why_us_cards[2]['description'] = 'Licensed, discreet, and experienced<br>drivers who ensure a calm, safe, and<br>comfortable travel experience<br>throughout your tour.';
	}
	if (isset($why_us_cards[3]) && is_array($why_us_cards[3])) {
		$why_us_cards[3]['title'] = 'Privacy & discretion';
		$why_us_cards[3]['description'] = 'Discreet service and private travel —<br>ideal for couples, families, and<br>travelers who value space, quiet, and<br>personal time.';
	}
	if (isset($why_us_cards[4]) && is_array($why_us_cards[4])) {
		$why_us_cards[4]['title'] = '24/7 Human Support';
		$why_us_cards[4]['description'] = 'A personal manager or live agent<br>always available — by website,<br>WhatsApp, or email, in any time zone.';
	}
	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$why_us_cards[5]['title'] = 'Effortless coordination';
		$why_us_cards[5]['description'] = 'Routes, timing, vehicle movements,<br>and real-time adjustments managed<br>centrally, so your event runs without<br>disruption.';
	}
}
if ($is_shoping_service) {
	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$why_us_cards[0]['card_type'] = 'image';
		$why_us_cards[0]['image'] = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325562_result.webp';
		$why_us_cards[0]['description'] = 'Luxury shopping chauffeur service<br>in 100+ countries — the same level<br>of comfort and discretion wherever<br>you shop.';
	}
	if (isset($why_us_cards[1]) && is_array($why_us_cards[1])) {
		$why_us_cards[1]['description'] = 'Business, premium, and VIP vehicles<br>— immaculate, late-model, and<br>presentation-ready for your day.';
	}
	if (isset($why_us_cards[2]) && is_array($why_us_cards[2])) {
		$why_us_cards[2]['title'] = 'Professional chauffeurs';
		$why_us_cards[2]['description'] = 'Licensed, discreet, and attentive<br>drivers experienced in supporting<br>private clients throughout flexible,<br>multi-stop itineraries.';
	}
	if (isset($why_us_cards[3]) && is_array($why_us_cards[3])) {
		$why_us_cards[3]['description'] = 'Confidential coordination and calm<br>professionalism — ideal for private<br>shopping, personal appointments,<br>and high-profile clients.';
	}
	if (isset($why_us_cards[4]) && is_array($why_us_cards[4])) {
		$why_us_cards[4]['description'] = 'A personal manager or live agent<br>always available — by website,<br>WhatsApp, or email, in any time zone.';
	}
	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$why_us_cards[5]['title'] = 'Effortless coordination';
		$why_us_cards[5]['description'] = 'Routes, timing, waiting, and<br>adjustments handled seamlessly, so<br>your day flows without interruptions.';
	}
}
if ($is_medical_transportation_service) {
	$why_us_intro_title = 'Why Clients Choose<br>GTS Medical Transfers';
	$why_us_intro_text = '';

	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$why_us_cards[0]['card_type'] = 'image';
		$why_us_cards[0]['image'] = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325556_result.webp';
		$why_us_cards[0]['description'] = 'Medical transfers across 100+<br>countries — coordinated with the<br>same precision, care, and<br>discretion that define every GTS<br>service.';
	}
	if (isset($why_us_cards[1]) && is_array($why_us_cards[1])) {
		$why_us_cards[1]['title'] = 'Comfort-focused fleet';
		$why_us_cards[1]['description'] = 'Late-model Business, Premium, and VIP vehicles<br>adapted for medical travel — smooth, spacious, and<br>equipped for comfort and stability.';
	}
	if (isset($why_us_cards[3]) && is_array($why_us_cards[3])) {
		$why_us_cards[3]['title'] = 'Safety & confidentiality';
		$why_us_cards[3]['description'] = 'Verified routes, secure procedures, and full<br>respect for privacy — trusted by families, clinics,<br>and diplomatic clients.';
	}
	if (isset($why_us_cards[4]) && is_array($why_us_cards[4])) {
		$why_us_cards[4]['description'] = 'A personal coordinator always available — by<br>phone, email, or WhatsApp — to assist with<br>changes, timing, or medical arrangements.';
	}
	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$why_us_cards[5]['title'] = 'Reliable timing';
		$why_us_cards[5]['description'] = 'Every pickup and arrival coordinated with<br>medical schedules and monitored in real time<br>for complete peace of mind.';
	}
}
if ($is_travel_personal_interpreter_service) {
	$why_us_intro_title = 'Why Choose GTS Travel Personal<br>Interpreter Service';
	$why_us_intro_text = '';

	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$why_us_cards[0]['card_type'] = 'image';
		$why_us_cards[0]['image'] = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325557_result.webp';
		$why_us_cards[0]['title'] = 'Experienced interpreters';
		$why_us_cards[0]['description'] = 'Professionals trained to work in<br>business, medical, legal, and<br>private settings.';
	}
	if (isset($why_us_cards[1]) && is_array($why_us_cards[1])) {
		$why_us_cards[1]['icon'] = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/mdi_bag-suitcase.svg';
		$why_us_cards[1]['title'] = 'Seamless integration<br>with travel';
		$why_us_cards[1]['description'] = 'Interpreter support coordinated<br>alongside chauffeur services and<br>schedules when required.';
	}
	if (isset($why_us_cards[2]) && is_array($why_us_cards[2])) {
		$why_us_cards[2]['icon'] = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Designed-4.svg';
		$why_us_cards[2]['title'] = 'Reliable coordination';
		$why_us_cards[2]['description'] = 'Clear planning, punctuality, and real-<br>time adjustments as your travel plans<br>evolve.';
	}
	if (isset($why_us_cards[3]) && is_array($why_us_cards[3])) {
		$why_us_cards[3]['title'] = 'Privacy & confidentiality';
		$why_us_cards[3]['description'] = 'Strict confidentiality standards<br>suitable for sensitive conversations<br>and high-profile clients.';
	}
	if (isset($why_us_cards[4]) && is_array($why_us_cards[4])) {
		$why_us_cards[4]['title'] = '24/7 Human Support';
		$why_us_cards[4]['description'] = 'Dedicated coordination and live<br>assistance before and during your<br>journey';
	}
	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$why_us_cards[5]['card_type'] = 'image';
		$why_us_cards[5]['image'] = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325558_result.webp';
		$why_us_cards[5]['title'] = 'Worldwide availability';
		$why_us_cards[5]['description'] = 'Interpreter services available<br>across key international<br>destinations.';
	}
}
if ($is_travel_planninig_service) {
	$why_us_intro_title = 'Why Choose GTS Travel Planning';
	$why_us_intro_text = '';

	if (isset($why_us_cards[0]) && is_array($why_us_cards[0])) {
		$why_us_cards[0]['card_type'] = 'image';
		$why_us_cards[0]['title'] = 'Structured travel expertise';
		$why_us_cards[0]['description'] = 'Carefully designed itineraries that<br>balance efficiency, comfort, and<br>purpose.';
	}
	if (isset($why_us_cards[1]) && is_array($why_us_cards[1])) {
		$why_us_cards[1]['icon'] = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Planning-1.svg';
		$why_us_cards[1]['title'] = 'End-to-end<br>coordination';
		$why_us_cards[1]['description'] = 'One point of contact managing all<br>travel components and adjustments.';
	}
	if (isset($why_us_cards[2]) && is_array($why_us_cards[2])) {
		$why_us_cards[2]['icon'] = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Planning-2.svg';
		$why_us_cards[2]['title'] = 'Calm execution';
		$why_us_cards[2]['description'] = 'Clear plans, realistic timing, and<br>proactive coordination throughout<br>the journey.';
	}
	if (isset($why_us_cards[3]) && is_array($why_us_cards[3])) {
		$why_us_cards[3]['icon'] = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Planning-3.svg';
		$why_us_cards[3]['title'] = 'Worldwide reach';
		$why_us_cards[3]['description'] = 'Travel planning support across key<br>international destinations.';
	}
	if (isset($why_us_cards[4]) && is_array($why_us_cards[4])) {
		$why_us_cards[4]['icon'] = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Planning-4.svg';
		$why_us_cards[4]['title'] = '24/7 Human Support';
		$why_us_cards[4]['description'] = 'Live coordination and assistance<br>before and during your journey.';
	}
	if (isset($why_us_cards[5]) && is_array($why_us_cards[5])) {
		$why_us_cards[5]['card_type'] = 'image';
		$why_us_cards[5]['image'] = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325559_result.webp';
		$why_us_cards[5]['title'] = 'Privacy-respectful<br>professional support';
		$why_us_cards[5]['description'] = 'Delivered with discretion,<br>professionalism, and respect<br>for client confidentiality.';
	}
}

// Occasions defaults
$occasions = isset($blocks_data['occasions']) ? $blocks_data['occasions'] : array();
$occasions_pill = ! empty($occasions['pill_text']) ? $occasions['pill_text'] : 'Full Service';
$occasions_title = ! empty($occasions['title']) ? $occasions['title'] : 'Perfect for Every Occasion';
$occasions_footer = ! empty($occasions['footer_text']) ? $occasions['footer_text'] : "Whether it's a business meeting, an exclusive event, or a long-distance journey – GTS Limousine Service adapts to your agenda with flawless precision and discretion.";
if ($is_airport_transfer_service) {
	$occasions['title'] = 'Perfect for Any Traveller';
}
if ($is_professional_chauffeur_service) {
	$occasions['title'] = 'Perfect for Any Traveller';
}

// How It Works defaults
$hiw = isset($blocks_data['how_it_works']) ? $blocks_data['how_it_works'] : array();
$hiw_pill = ! empty($hiw['pill_text']) ? $hiw['pill_text'] : 'How it works';
$hiw_title = ! empty($hiw['title']) ? $hiw['title'] : 'We handle the details —<br>you enjoy the moments';
$hiw_bg = ! empty($hiw['background']) ? $hiw['background'] : $site_url . '/wp-content/uploads/2026/01/home-3-block-banner_result-scaled.webp';
$hiw_steps = ! empty($hiw['steps']) ? $hiw['steps'] : array();
if ('hourly-hire' === $current_service_slug) {
	$hiw_title = 'Booking with GTS is<br>straightforward — one clear<br>process from request to ride,<br>backed by 24/7 support.';
}
if ($is_airport_transfer_service) {
	$hiw_title = 'Booking with GTS is<br>straightforward — one clear<br>process from request to ride,<br>backed by 24/7 support.';
}
if ($is_professional_chauffeur_service) {
	$hiw_title = 'Booking with GTS is<br>straightforward — one clear<br>process from request to ride,<br>backed by 24/7 support.';
}
if ($is_special_transfers_service) {
	$hiw_title = 'Booking with GTS is<br>straightforward — one clear<br>process from request to ride,<br>backed by 24/7 support.';
}
if ($is_wedding_service) {
	$hiw_title = 'You focus on the celebration —<br>we take care of the logistics.';
}
if ($is_cultural_sport_events_service) {
	$hiw_title = 'You focus on the celebration —<br>we take care of the logistics.';
}
if ($is_medical_transportation_service) {
	$hiw_title = 'We handle the details —<br>you enjoy the moments';
}
if ($is_travel_personal_interpreter_service) {
	$hiw_bg = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-1000002275_result-scaled.webp';
	$hiw_title = 'You focus on your meetings<br>and plans. We ensure clear<br>communication.';
	$hiw_steps = array(
		array(
			'number' => '01',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-1.svg',
			'title' => 'Share your<br>requirements',
			'description' => 'Languages needed, locations, schedule, and<br>context of interpretation.',
		),
		array(
			'number' => '02',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-2.svg',
			'title' => 'Receive a tailored<br>proposal',
			'description' => 'Clear scope of services, availability, and<br>transparent pricing.',
		),
		array(
			'number' => '03',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-3.svg',
			'title' => 'Confirm &amp;<br>coordinate',
			'description' => 'We assign a qualified interpreter aligned with<br>your needs.',
		),
		array(
			'number' => '04',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-4.svg',
			'title' => 'Travel with<br>confidence',
			'description' => 'Communication handled professionally<br>wherever you go.',
		),
	);
}
if ($is_travel_planninig_service) {
	$hiw_bg = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Frame-2087325560_result-scaled.webp';
	$hiw_steps = array(
		array(
			'number' => '01',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-1.svg',
			'title' => 'Share your travel<br>objectives',
			'description' => 'Destinations, timing, priorities, and any<br>specific requirements.',
		),
		array(
			'number' => '02',
			'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/solar_document-add-bold.svg',
			'title' => 'Receive a tailored<br>travel plan',
			'description' => 'A clear, structured itinerary with coordinated<br>services and recommendations.',
		),
		array(
			'number' => '03',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-2.svg',
			'title' => 'Review &amp; confirm',
			'description' => 'Adjust details and confirm the plan aligned<br>with your expectations.',
		),
		array(
			'number' => '04',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-4.svg',
			'title' => 'Travel with<br>confidence',
			'description' => 'Your journey unfolds smoothly, supported by<br>proactive coordination.',
		),
	);
}
if ($is_shoping_service) {
	$hiw_title = 'You enjoy the shopping.<br>We handle the rest.';
	$hiw_steps = array(
		array(
			'number' => '01',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-1.svg',
			'title' => 'Share your<br>travel plans',
			'description' => 'Destinations, interests, preferred pace, and<br>travel dates.',
		),
		array(
			'number' => '02',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-2.svg',
			'title' => 'Receive your<br>tailored quote',
			'description' => 'Clear, transparent pricing based on duration<br>and vehicle class.',
		),
		array(
			'number' => '03',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-3.svg',
			'title' => 'Confirm &amp; delegate',
			'description' => 'We assign your chauffeur and vehicle, ready<br>for your journey.',
		),
		array(
			'number' => '04',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-4.svg',
			'title' => 'Enjoy the tour',
			'description' => 'Every route, stop, and transition handled<br>smoothly and effortlessly.',
		),
	);
}
if ($is_corporate_events_chauffeur_service) {
	$hiw_title = 'You focus on what matters —<br>we ensure seamless logistics<br>throughout the event.';
	$hiw_steps = array(
		array(
			'number' => '01',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-1.svg',
			'title' => 'Share your<br>event details',
			'description' => 'Event locations, agenda, guest movements,<br>and vehicle requirements.',
		),
		array(
			'number' => '02',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-2.svg',
			'title' => 'Receive your<br>tailored quote',
			'description' => 'Clear, transparent pricing based on your event<br>structure',
		),
		array(
			'number' => '03',
			'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/execution-3.svg',
			'title' => 'Confirm &amp; delegate',
			'description' => 'We assign your chauffeur team and a<br>dedicated event coordinator.',
		),
		array(
			'number' => '04',
			'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/execution-4.svg',
			'title' => 'Enjoy flawless<br>execution',
			'description' => 'every pickup and drop-off precisely on time.',
		),
	);
}
if ($is_private_tours_service) {
	$hiw_title = 'You focus on the<br>experience — we take<br>care of the journey.';
	$hiw_steps = array(
		array(
			'number' => '01',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-1.svg',
			'title' => 'Share your<br>travel plans',
			'description' => 'Destinations, interests, preferred pace, and<br>travel dates.',
		),
		array(
			'number' => '02',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-2.svg',
			'title' => 'Receive your<br>tailored quote',
			'description' => 'Clear, transparent pricing based on duration<br>and vehicle class.',
		),
		array(
			'number' => '03',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-3.svg',
			'title' => 'Confirm &amp; delegate',
			'description' => 'We assign your chauffeur and vehicle, ready<br>for your journey.',
		),
		array(
			'number' => '04',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-4.svg',
			'title' => 'Enjoy the tour',
			'description' => 'Every route, stop, and transition handled<br>smoothly and effortlessly.',
		),
	);
}
if ($is_travel_agencies_service) {
	$hiw_pill = 'How Partnership Works';
	$hiw_title = 'You focus on your clients<br>and programs — we<br>handle transportation and<br>coordination.';
	$hiw_steps = array(
		array(
			'number' => '01',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-1.svg',
			'title' => 'Share client or<br>itinerary details',
			'description' => 'Routes, dates, flight details, destinations, and<br>service requirements.',
		),
		array(
			'number' => '02',
			'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/solar_document-add-bold.svg',
			'title' => 'Receive a tailored<br>proposal',
			'description' => 'Clear pricing and transport planning aligned<br>with your itinerary.',
		),
		array(
			'number' => '03',
			'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-2.svg',
			'title' => 'Confirm &amp;<br>coordinate',
			'description' => 'We assign chauffeurs and manage all<br>operational details.',
		),
		array(
			'number' => '04',
			'icon' => 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Long-4.svg',
			'title' => 'Deliver a seamless<br>experience',
			'description' => 'Your clients travel comfortably while we<br>handle the logistics.',
		),
	);
}
$default_hiw_steps = array(
	array('number' => '01', 'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-1.svg', 'title' => 'Book the way<br>you prefer', 'description' => 'Reserve instantly on our website or send a<br>request directly to our support team.'),
	array('number' => '02', 'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-2.svg', 'title' => 'Receive confirmation', 'description' => 'All details arrive by email — your itinerary, photo of the<br>car, driver info and contacts.'),
	array('number' => '03', 'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-3.svg', 'title' => 'Meet your driver', 'description' => 'A professional chauffeur arrives on time, helps<br>with luggage and ensures comfort.'),
	array('number' => '04', 'icon' => $site_url . '/wp-content/uploads/2026/01/block-3-icon-4.svg', 'title' => 'Travel with<br>confidence', 'description' => 'Transparent pricing, insured rides and real<br>24/7 assistance worldwide.'),
);

if (empty($hiw_steps)) {
	$hiw_steps = $default_hiw_steps;
} else {
	$hiw_steps = $fill_missing_media($hiw_steps, $default_hiw_steps, array('icon'));
}

// FAQ defaults
$faq = isset($blocks_data['faq']) ? $blocks_data['faq'] : array();
$faq_pill = ! empty($faq['pill_text']) ? $faq['pill_text'] : 'FAQ';
$faq_title = ! empty($faq['title']) ? $faq['title'] : 'Clear answers to help you book<br>with confidence';
$faq_items = ! empty($faq['items']) ? $faq['items'] : array();

// Bottom Text defaults (optional bottom block)
$bottom_text = isset($blocks_data['bottom_text']) ? $blocks_data['bottom_text'] : array();
$has_bottom_text_block = isset($blocks_data['bottom_text']);
$bottom_text_title = ! empty($bottom_text['title']) ? $bottom_text['title'] : '';
$bottom_text_description = ! empty($bottom_text['description']) ? $bottom_text['description'] : '';
$bottom_text_link_text = ! empty($bottom_text['link_text']) ? $bottom_text['link_text'] : 'Read more';
$bottom_text_link_url = ! empty($bottom_text['link_url']) ? $bottom_text['link_url'] : '#';

if (empty($faq_items)) {
	$faq_items = array(
		array('question' => 'Do you really operate worldwide?', 'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
		array('question' => 'How fast can I get a car?', 'answer' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.'),
		array('question' => 'Can I book a limousine for a few hours or for a full day?', 'answer' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.'),
		array('question' => 'Are your drivers professional?', 'answer' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.'),
		array('question' => 'Do you offer airport transfers with limousines?', 'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
		array('question' => 'How can I pay?', 'answer' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.'),
		array('question' => 'What if I need to cancel?', 'answer' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.'),
		array('question' => 'Can I book directly with a manager?', 'answer' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.'),
	);
}

$chevron_url = get_template_directory_uri() . '/assets/icons/chevron-down-faq.svg';
?>

<main id="primary" class="site-main">
	<?php if ('hourly-hire' === $current_service_slug) : ?>
		<style id="hourly-hire-why-us-gap">
			.why-us-block.why-us-block--hourly-hire-gap {
				padding-bottom: clamp(56px, 8vw, 120px);
			}
		</style>
		<style id="hourly-hire-fleet-lead-width">
			.fleet-slider-block.fleet-slider-block--hourly-hire .fleet-slider-title-row {
				flex-direction: row;
				align-items: center;
				justify-content: space-between;
			}

			.fleet-slider-block.fleet-slider-block--hourly-hire .fleet-slider-lead {
				max-width: 520px;
				width: 100%;
				margin-top: 8px;
			}
		</style>
	<?php endif; ?>
	<?php if ($is_airport_transfer_service) : ?>
		<style id="airport-transfer-hero-title-width">
			@media (min-width: 1025px) {
				.hero-block--airport-transfer .hero-container {
					gap: 24px;
				}

				.hero-block--airport-transfer .hero-left {
					width: clamp(760px, 58vw, 868px);
					flex: 0 0 clamp(760px, 58vw, 868px);
				}

				.hero-block--airport-transfer .hero-right {
					width: clamp(410px, 28vw, 468px);
					flex: 0 0 clamp(410px, 28vw, 468px);
				}

				.hero-block--airport-transfer .hero-title {
					max-width: 868px;
				}

				.hero-block--airport-transfer .hero-features.hero-features--airport {
					grid-template-rows: repeat(3, minmax(0, auto));
				}

				.hero-block--airport-transfer .hero-features.hero-features--airport::after {
					display: none;
				}

				.hero-block--airport-transfer .hero-features.hero-features--airport .hero-feature {
					padding: 28px 30px;
					gap: 18px;
				}

				.hero-block--airport-transfer .hero-features.hero-features--airport .hero-feature-airport-top-left {
					grid-column: 1;
					grid-row: 1;
					padding-top: 6px;
					padding-left: 0;
				}

				.hero-block--airport-transfer .hero-features.hero-features--airport .hero-feature-airport-top-right {
					grid-column: 2;
					grid-row: 1;
					padding-top: 6px;
				}

				.hero-block--airport-transfer .hero-features.hero-features--airport .hero-feature-airport-top-right.hero-feature-map {
					display: flex;
					align-items: center;
					gap: 14px;
				}

				.hero-block--airport-transfer .hero-features.hero-features--airport .hero-feature-airport-top-right.hero-feature-map .world-map-image {
					padding: 0;
				}

				.hero-block--airport-transfer .hero-features.hero-features--airport .hero-feature-airport-top-right.hero-feature-map .world-map-image img {
					width: 110px;
					height: auto;
				}

				.hero-block--airport-transfer .hero-features.hero-features--airport .hero-feature-airport-top-right.hero-feature-map .world-map-text {
					display: flex;
					flex-direction: column;
					gap: 2px;
				}

				.hero-block--airport-transfer .hero-features.hero-features--airport .hero-feature-airport-mid-left {
					grid-column: 1;
					grid-row: 2;
					border-top: 1px solid rgba(255, 255, 255, 0.16);
					padding-left: 0;
				}

				.hero-block--airport-transfer .hero-features.hero-features--airport .hero-feature-airport-mid-right {
					grid-column: 2;
					grid-row: 2;
					border-top: 1px solid rgba(255, 255, 255, 0.16);
				}

				.hero-block--airport-transfer .hero-features.hero-features--airport .hero-feature-airport-bottom-left {
					grid-column: 1;
					grid-row: 3;
					border-top: 1px solid rgba(255, 255, 255, 0.16);
					padding-bottom: 6px;
					padding-left: 0;
				}

				.hero-block--airport-transfer .hero-features.hero-features--airport .hero-feature-airport-bottom-right {
					grid-column: 2;
					grid-row: 3;
					border-top: 1px solid rgba(255, 255, 255, 0.16);
					padding-bottom: 6px;
				}
			}

			@media (max-width: 768px) {
				.hero-block--airport-transfer .hero-features.hero-features--mobile-airport {
					grid-template-rows: repeat(3, minmax(0, auto));
				}

				.hero-block--airport-transfer .hero-features.hero-features--mobile-airport::after {
					display: none;
				}

				.hero-block--airport-transfer .hero-features.hero-features--mobile-airport .hero-feature {
					padding: 12px 8px;
					gap: 12px;
				}

				.hero-block--airport-transfer .hero-features.hero-features--mobile-airport .hero-feature-airport-top-left {
					grid-column: 1;
					grid-row: 1;
					padding-left: 0;
					padding-top: 8px;
				}

				.hero-block--airport-transfer .hero-features.hero-features--mobile-airport .hero-feature-airport-top-right {
					grid-column: 2;
					grid-row: 1;
					padding-top: 8px;
				}

				.hero-block--airport-transfer .hero-features.hero-features--mobile-airport .hero-feature-airport-mid-left {
					grid-column: 1;
					grid-row: 2;
					border-top: 1px solid rgba(255, 255, 255, 0.16);
					padding-left: 0;
				}

				.hero-block--airport-transfer .hero-features.hero-features--mobile-airport .hero-feature-airport-mid-right {
					grid-column: 2;
					grid-row: 2;
					border-top: 1px solid rgba(255, 255, 255, 0.16);
				}

				.hero-block--airport-transfer .hero-features.hero-features--mobile-airport .hero-feature-airport-bottom-left {
					grid-column: 1;
					grid-row: 3;
					border-top: 1px solid rgba(255, 255, 255, 0.16);
					padding-left: 0;
					padding-bottom: 8px;
				}

				.hero-block--airport-transfer .hero-features.hero-features--mobile-airport .hero-feature-airport-bottom-right {
					grid-column: 2;
					grid-row: 3;
					border-top: 1px solid rgba(255, 255, 255, 0.16);
					padding-bottom: 8px;
				}
			}

			.fleet-slider-block.fleet-slider-block--airport-transfer .fleet-slider-lead {
				max-width: 440px;
			}
		</style>
	<?php endif; ?>
	<?php if ($is_professional_chauffeur_service) : ?>
		<style id="professional-chauffeur-fleet-lead-width">
			.fleet-slider-block.fleet-slider-block--professional-chauffeur .fleet-slider-lead {
				max-width: 460px;
			}

			@media (min-width: 1025px) {
				.hero-block--professional-chauffeur .hero-container {
					gap: 24px;
				}

				.hero-block--professional-chauffeur .hero-left {
					width: clamp(760px, 58vw, 868px);
					flex: 0 0 clamp(760px, 58vw, 868px);
				}

				.hero-block--professional-chauffeur .hero-right {
					width: clamp(410px, 28vw, 468px);
					flex: 0 0 clamp(410px, 28vw, 468px);
				}

				.hero-block--professional-chauffeur .hero-title {
					max-width: 868px;
				}

				.hero-block--professional-chauffeur .hero-features .hero-feature {
					padding-left: 24px;
					padding-right: 24px;
					gap: 18px;
				}

				.hero-block--professional-chauffeur .hero-features .hero-feature-top-left,
				.hero-block--professional-chauffeur .hero-features .hero-feature-bottom-left {
					padding-left: 0;
				}
			}

			@media (max-width: 768px) {
				.hero-block--professional-chauffeur .hero-features--mobile .hero-feature {
					padding-left: 16px;
					padding-right: 16px;
					gap: 14px;
				}

				.hero-block--professional-chauffeur .hero-features--mobile .hero-feature-top-left,
				.hero-block--professional-chauffeur .hero-features--mobile .hero-feature-bottom-left {
					padding-left: 0;
				}
			}
		</style>
	<?php endif; ?>
		<?php if ($is_special_transfers_service) : ?>
			<style id="special-transfers-fleet-lead-width">
				.fleet-slider-block.fleet-slider-block--special-transfers .fleet-slider-lead {
					max-width: 560px;
				}
			</style>
		<?php endif; ?>
		<?php if ($is_wedding_service) : ?>
			<style id="wedding-fleet-lead-width">
				.fleet-slider-block.fleet-slider-block--wedding .fleet-slider-lead {
					max-width: 440px;
				}
			</style>
		<?php endif; ?>
		<?php if ($is_cultural_sport_events_service) : ?>
			<style id="cultural-sport-events-fleet-lead-width">
				.fleet-slider-block.fleet-slider-block--cultural-sport-events .fleet-slider-lead {
					max-width: 440px;
				}
			</style>
		<?php endif; ?>
		<?php if ($is_family_travel_chauffeur_service) : ?>
			<style id="family-travel-fleet-lead-width">
				.fleet-slider-block.fleet-slider-block--family-travel .fleet-slider-lead {
					max-width: 440px;
				}
			</style>
		<?php endif; ?>
		<?php if ($is_travel_agencies_service) : ?>
			<style id="travel-agencies-fleet-title-width">
				.fleet-slider-block.fleet-slider-block--travel-agencies .fleet-slider-title {
					max-width: 1040px;
				}
			</style>
			<style id="travel-agencies-why-us-gap">
				.why-us-block.why-us-block--travel-agencies-gap {
					padding-bottom: clamp(56px, 8vw, 120px);
				}
			</style>
		<?php endif; ?>

	<?php // ======================== HERO BLOCK ========================
	?>
	<?php if ($block_enabled['hero']) : ?>
		<style id="hero-limousine-service-bg">
			.hero-block {
				background-image: url('<?php echo esc_url($hero_bg_mobile); ?>') !important;
			}

			@media (min-width: 769px) {
				.hero-block {
					background-image: url('<?php echo esc_url($hero_bg_tablet); ?>') !important;
				}
			}

			@media (min-width: 1025px) {
				.hero-block {
					background-image: url('<?php echo esc_url($hero_bg_desktop); ?>') !important;
				}
			}
		</style>
		<section class="hero-block<?php echo $is_airport_transfer_service ? ' hero-block--airport-transfer' : ''; ?><?php echo $is_professional_chauffeur_service ? ' hero-block--professional-chauffeur' : ''; ?>">
			<div class="hero-container">
				<div class="hero-left">
					<div class="hero-content<?php echo $hero_features_enabled ? '' : ' hero-content--no-features'; ?>">
						<?php if ( $hero_pretitle_enabled && ! empty( $hero_pretitle ) ) : ?>
							<p class="hero-subtitle"<?php echo $is_travel_agencies_service ? ' style="text-transform:none;letter-spacing:0;"' : ''; ?>><?php echo esc_html( $hero_pretitle ); ?></p>
						<?php endif; ?>
						<h1 class="hero-title"><?php echo wp_kses_post($hero_title); ?></h1>
						<p class="hero-description"><?php echo wp_kses_post($hero_subtitle); ?></p>
						<div class="hero-buttons">
							<a href="<?php echo esc_url($hero_cta_link); ?>" class="btn btn-primary"><?php echo esc_html($hero_cta_text); ?></a>
						</div>
						<?php if ( $hero_features_enabled ) : ?>
							<?php if ($is_airport_transfer_service) : ?>
								<div class="hero-features hero-features--airport">
									<div class="hero-feature hero-feature-airport-top-left">
										<div class="hero-feature-icon"><?php echo $hero_icon_1 ? wp_kses($hero_icon_1, gts_allowed_svg_hero()) : ''; ?></div>
										<p class="hero-feature-text">Available in 100+ countries</p>
									</div>
									<div class="hero-feature hero-feature-airport-top-right" aria-hidden="true"></div>
									<div class="hero-feature hero-feature-airport-mid-left">
										<div class="hero-feature-icon"><?php echo $hero_icon_2_markup ? wp_kses($hero_icon_2_markup, $hero_icon_allowed_tags) : ''; ?></div>
										<p class="hero-feature-text"><?php echo wp_kses_post($hero_feature_2_text); ?></p>
									</div>
									<div class="hero-feature hero-feature-airport-mid-right">
										<div class="hero-feature-icon"><?php echo $hero_airport_meet_icon_markup ? wp_kses($hero_airport_meet_icon_markup, $hero_icon_allowed_tags) : ''; ?></div>
										<p class="hero-feature-text"><?php echo wp_kses_post($hero_airport_meet_text); ?></p>
									</div>
									<div class="hero-feature hero-feature-airport-bottom-left">
										<div class="hero-feature-icon"><?php echo $hero_airport_flight_icon_markup ? wp_kses($hero_airport_flight_icon_markup, $hero_icon_allowed_tags) : ''; ?></div>
										<p class="hero-feature-text"><?php echo wp_kses_post($hero_airport_flight_text); ?></p>
									</div>
									<div class="hero-feature hero-feature-airport-bottom-right">
										<div class="hero-feature-icon"><?php echo $hero_icon_3_markup ? wp_kses($hero_icon_3_markup, $hero_icon_allowed_tags) : ''; ?></div>
										<p class="hero-feature-text"><?php echo wp_kses_post($hero_feature_3_text); ?></p>
									</div>
								</div>
							<?php else : ?>
								<div class="hero-features">
									<div class="hero-feature hero-feature-top-left">
										<div class="hero-feature-icon">
											<?php if ($is_special_transfers_service) : ?>
												<img src="https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Special-Transfers-1.svg" alt="" width="32" height="32" loading="lazy" decoding="async">
											<?php elseif ($is_family_travel_chauffeur_service) : ?>
												<img src="https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/mdi_car-child-seat.svg" alt="" width="32" height="32" loading="lazy" decoding="async">
											<?php elseif ($is_medical_transportation_service) : ?>
												<img src="https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Medical-Transportation-1.svg" alt="" width="32" height="32" loading="lazy" decoding="async">
											<?php elseif ($is_travel_personal_interpreter_service) : ?>
												<img src="https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Travel-Personal-Interpreter-1.svg" alt="" width="32" height="32" loading="lazy" decoding="async">
											<?php else : ?>
												<?php echo $hero_icon_1 ? wp_kses($hero_icon_1, gts_allowed_svg_hero()) : ''; ?>
											<?php endif; ?>
										</div>
											<p class="hero-feature-text"><?php echo $is_special_transfers_service ? 'Private aviation' : ($is_wedding_service ? 'Discreet coordination in 100+<br>countries' : ($is_cultural_sport_events_service ? '24/7 support' : ($is_family_travel_chauffeur_service ? 'Child seats | Multi-stop trips' : ($is_medical_transportation_service ? 'Non-emergency medical<br>transfers' : ($is_travel_personal_interpreter_service ? 'Aligned with your schedule<br>and itinerary' : (($is_shoping_service || $is_corporate_events_chauffeur_service || $is_private_tours_service || $is_travel_agencies_service) ? 'Professional chauffeur' : 'Available in 100+ countries')))))); ?></p>
									</div>
									<div class="hero-feature hero-feature-top-right"></div>
									<div class="hero-feature hero-feature-bottom-left">
										<div class="hero-feature-icon"><?php echo $hero_icon_2_markup ? wp_kses($hero_icon_2_markup, $hero_icon_allowed_tags) : ''; ?></div>
										<p class="hero-feature-text"><?php echo wp_kses_post($hero_feature_2_text); ?></p>
									</div>
									<div class="hero-feature hero-feature-bottom-right">
										<div class="hero-feature-icon"><?php echo $hero_icon_3_markup ? wp_kses($hero_icon_3_markup, $hero_icon_allowed_tags) : ''; ?></div>
										<p class="hero-feature-text"><?php echo wp_kses_post($hero_feature_3_text); ?></p>
									</div>
								</div>
							<?php endif; ?>
							<?php if ($is_airport_transfer_service) : ?>
								<div class="hero-features hero-features--mobile hero-features--mobile-in-hero hero-features--mobile-airport">
									<div class="hero-feature hero-feature-airport-top-left">
										<div class="hero-feature-icon"><?php echo $hero_icon_1 ? wp_kses($hero_icon_1, gts_allowed_svg_hero()) : ''; ?></div>
										<p class="hero-feature-text">Available in 100+ countries</p>
									</div>
									<div class="hero-feature hero-feature-airport-top-right hero-feature-map">
										<div class="world-map-image"><img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/01/noun-world-17688-1_result.webp'); ?>" alt="World Map" width="100" height="100" loading="lazy"></div>
										<div class="world-map-text">
											<p class="world-map-label world-map-label-top">clients in</p>
											<div class="world-map-bottom">
												<p class="world-map-number"><?php echo esc_html($mobile_form_stats_number); ?></p>
												<p class="world-map-label world-map-label-bottom"><?php echo esc_html($mobile_form_stats_label); ?></p>
											</div>
										</div>
									</div>
									<div class="hero-feature hero-feature-airport-mid-left">
										<div class="hero-feature-icon"><?php echo $hero_icon_2_markup ? wp_kses($hero_icon_2_markup, $hero_icon_allowed_tags) : ''; ?></div>
										<p class="hero-feature-text"><?php echo wp_kses_post($hero_feature_2_text); ?></p>
									</div>
									<div class="hero-feature hero-feature-airport-mid-right">
										<div class="hero-feature-icon"><?php echo $hero_airport_meet_icon_markup ? wp_kses($hero_airport_meet_icon_markup, $hero_icon_allowed_tags) : ''; ?></div>
										<p class="hero-feature-text"><?php echo wp_kses_post($hero_airport_meet_text); ?></p>
									</div>
									<div class="hero-feature hero-feature-airport-bottom-left">
										<div class="hero-feature-icon"><?php echo $hero_airport_flight_icon_markup ? wp_kses($hero_airport_flight_icon_markup, $hero_icon_allowed_tags) : ''; ?></div>
										<p class="hero-feature-text"><?php echo wp_kses_post($hero_airport_flight_text); ?></p>
									</div>
									<div class="hero-feature hero-feature-airport-bottom-right">
										<div class="hero-feature-icon"><?php echo $hero_icon_3_markup ? wp_kses($hero_icon_3_markup, $hero_icon_allowed_tags) : ''; ?></div>
										<p class="hero-feature-text"><?php echo wp_kses_post($hero_feature_3_text); ?></p>
									</div>
								</div>
							<?php else : ?>
								<div class="hero-features hero-features--mobile hero-features--mobile-in-hero">
									<div class="hero-feature hero-feature-top-left">
										<div class="hero-feature-icon">
											<?php if ($is_special_transfers_service) : ?>
												<img src="https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Special-Transfers-1.svg" alt="" width="32" height="32" loading="lazy" decoding="async">
											<?php elseif ($is_family_travel_chauffeur_service) : ?>
												<img src="https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/mdi_car-child-seat.svg" alt="" width="32" height="32" loading="lazy" decoding="async">
											<?php elseif ($is_medical_transportation_service) : ?>
												<img src="https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Medical-Transportation-1.svg" alt="" width="32" height="32" loading="lazy" decoding="async">
											<?php elseif ($is_travel_personal_interpreter_service) : ?>
												<img src="https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/Travel-Personal-Interpreter-1.svg" alt="" width="32" height="32" loading="lazy" decoding="async">
											<?php else : ?>
												<?php echo $hero_icon_1 ? wp_kses($hero_icon_1, gts_allowed_svg_hero()) : ''; ?>
											<?php endif; ?>
										</div>
										<p class="hero-feature-text"><?php echo $is_special_transfers_service ? 'Private aviation' : ($is_wedding_service ? 'Discreet coordination in 100+<br>countries' : ($is_cultural_sport_events_service ? '24/7 support' : ($is_family_travel_chauffeur_service ? 'Child seats | Multi-stop trips' : ($is_medical_transportation_service ? 'Non-emergency medical<br>transfers' : ($is_travel_personal_interpreter_service ? 'Aligned with your schedule<br>and itinerary' : (($is_shoping_service || $is_corporate_events_chauffeur_service || $is_private_tours_service || $is_travel_agencies_service) ? 'Professional chauffeur' : 'Available in 100+ countries')))))); ?></p>
									</div>
									<div class="hero-feature hero-feature-top-right hero-feature-map">
										<div class="world-map-image"><img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/01/noun-world-17688-1_result.webp'); ?>" alt="World Map" width="100" height="100" loading="lazy"></div>
										<div class="world-map-text">
											<p class="world-map-label world-map-label-top">clients in</p>
											<div class="world-map-bottom">
												<p class="world-map-number"><?php echo esc_html($mobile_form_stats_number); ?></p>
												<p class="world-map-label world-map-label-bottom"><?php echo esc_html($mobile_form_stats_label); ?></p>
											</div>
										</div>
									</div>
									<div class="hero-feature hero-feature-bottom-left">
										<div class="hero-feature-icon"><?php echo $hero_icon_2_markup ? wp_kses($hero_icon_2_markup, $hero_icon_allowed_tags) : ''; ?></div>
										<p class="hero-feature-text"><?php echo wp_kses_post($hero_feature_2_text); ?></p>
									</div>
									<div class="hero-feature hero-feature-bottom-right">
										<div class="hero-feature-icon"><?php echo $hero_icon_3_markup ? wp_kses($hero_icon_3_markup, $hero_icon_allowed_tags) : ''; ?></div>
										<p class="hero-feature-text"><?php echo wp_kses_post($hero_feature_3_text); ?></p>
									</div>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="hero-right hero-right--desktop">
					<?php if ($desktop_form_enabled): ?>
						<form class="booking-form" id="booking-form">
							<div class="form-row">
								<div class="form-group"><input type="text" id="full-name" name="full_name" placeholder="First and Last name *" required></div>
								<div class="form-group"><input type="tel" id="phone" name="phone" placeholder="Phone *" required></div>
							</div>
							<div class="form-row">
								<div class="form-group"><input type="email" id="email" name="email" placeholder="E-mail" required></div>
								<div class="form-group"><select id="service-type" name="service_type" required>
										<option value="">Select service type</option>
									</select></div>
							</div>
							<div class="form-checkboxes">
								<div class="form-group checkbox-group"><label><input type="checkbox" name="book_jet" value="jet" checked><span><?php echo esc_html($desktop_form_checkbox1); ?></span></label></div>
								<div class="form-group checkbox-group"><label><input type="checkbox" name="book_helicopter" value="helicopter"><span><?php echo esc_html($desktop_form_checkbox2); ?></span></label></div>
							</div>
							<div class="form-row form-row-after-checkboxes">
								<div class="form-group"><select id="vehicle" name="vehicle" required>
										<option value="">Select vehicle</option>
									</select></div>
								<div class="form-group"><select id="passengers" name="passengers" required>
										<option value="">Number of passengers</option>
									</select></div>
							</div>
							<div class="form-row">
								<div class="form-group form-group-datetime"><input type="datetime-local" id="pickup-time" name="pickup_time" required><span class="datetime-placeholder">Pick-up time</span></div>
								<div class="form-group form-group-with-add-stop">
									<input type="text" id="pickup-location" name="pickup_location" placeholder="Pick-up location" required>
									<a href="#" class="add-stop-link"><svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 0V9M0 4.5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
										</svg>Add Stop</a>
								</div>
							</div>
							<div class="form-row form-row-dropoff-notes">
								<div class="form-group"><input type="text" id="dropoff-location" name="dropoff_location" placeholder="Drop-off location" required></div>
								<div class="form-group"><textarea id="additional-notes" name="additional_notes" placeholder="Additional Notes" rows="1"></textarea></div>
							</div>
							<div class="form-group checkbox-group checkbox-consent">
								<label><input type="checkbox" name="email_consent" value="1" class="consent-checkbox" checked><span>I agree to receive email communication regarding my quote request.</span></label>
							</div>
							<button type="submit" class="booking-submit-btn"><?php echo esc_html($desktop_form_submit); ?></button>
						</form>
					<?php endif; ?>
					<div class="world-map-section">
						<div class="world-map-image"><img src="<?php echo esc_url($site_url . '/wp-content/uploads/2026/01/noun-world-17688-1_result.webp'); ?>" alt="World Map" loading="lazy" width="100" height="100"></div>
						<div class="world-map-divider"></div>
						<div class="world-map-text">
							<p class="world-map-label world-map-label-top">clients in</p>
							<div class="world-map-bottom">
								<p class="world-map-number"><?php echo esc_html($desktop_form_stats_number); ?></p>
								<p class="world-map-label world-map-label-bottom"><?php echo esc_html($desktop_form_stats_label); ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

		<?php // ======================== BOOKING FORM BLOCK (MOBILE) ========================
		?>
		<?php if ($has_booking_block && $block_enabled['booking_form'] && $mobile_form_enabled) : ?>
		<section class="booking-form-block booking-form-block--mobile">
				<div class="booking-form-container">
					<div class="booking-form-left"></div>
					<div class="booking-form-right">
						<?php if ($mobile_form_enabled): ?>
						<form class="booking-form" id="booking-form-mobile">
							<div class="form-row">
								<div class="form-group"><input type="text" id="full-name-m" name="full_name" placeholder="First and Last name *" required></div>
								<div class="form-group"><input type="tel" id="phone-m" name="phone" placeholder="Phone *" required></div>
							</div>
							<div class="form-row">
								<div class="form-group"><input type="email" id="email-m" name="email" placeholder="E-mail" required></div>
								<div class="form-group"><select id="service-type-m" name="service_type" required>
										<option value="">Select service type</option>
									</select></div>
							</div>
							<div class="form-checkboxes">
								<div class="form-group checkbox-group"><label><input type="checkbox" name="book_jet" value="jet" checked><span><?php echo esc_html($mobile_form_checkbox1); ?></span></label></div>
								<div class="form-group checkbox-group"><label><input type="checkbox" name="book_helicopter" value="helicopter"><span><?php echo esc_html($mobile_form_checkbox2); ?></span></label></div>
							</div>
							<div class="form-row form-row-after-checkboxes">
								<div class="form-group"><select id="vehicle-m" name="vehicle" required>
										<option value="">Select vehicle</option>
									</select></div>
								<div class="form-group"><select id="passengers-m" name="passengers" required>
										<option value="">Number of passengers</option>
									</select></div>
							</div>
							<div class="form-row">
								<div class="form-group form-group-datetime"><input type="datetime-local" id="pickup-time-m" name="pickup_time" required><span class="datetime-placeholder">Pick-up time</span></div>
								<div class="form-group form-group-with-add-stop">
									<input type="text" id="pickup-location-m" name="pickup_location" placeholder="Pick-up location" required>
									<a href="#" class="add-stop-link"><svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M4.5 0V9M0 4.5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
										</svg>Add Stop</a>
								</div>
							</div>
							<div class="form-row form-row-dropoff-notes">
								<div class="form-group"><input type="text" id="dropoff-location-m" name="dropoff_location" placeholder="Drop-off location" required></div>
								<div class="form-group"><textarea id="additional-notes-m" name="additional_notes" placeholder="Additional Notes" rows="1"></textarea></div>
							</div>
							<div class="form-group checkbox-group checkbox-consent">
								<label><input type="checkbox" name="email_consent" value="1" class="consent-checkbox" checked><span>I agree to receive email communication regarding my quote request.</span></label>
							</div>
							<button type="submit" class="booking-submit-btn"><?php echo esc_html($mobile_form_submit); ?></button>
						</form>
					<?php endif; ?>
				</div>
			</div>
			</section>
		<?php endif; ?>

			<?php if ($block_enabled['service_context'] && ! $is_shoping_service && ! $is_corporate_events_chauffeur_service && ! $is_private_tours_service && ! $is_travel_agencies_service) : ?>
				<?php
				get_template_part(
					'template-parts/service/service-context',
				null,
				array(
					'block' => $service_context,
				)
			);
			?>
		<?php endif; ?>

		<?php // ======================== SERVICE INTRO BLOCK (UNDER HERO) ========================
		?>
		<?php if ($has_service_intro_block && $block_enabled['service_intro']) : ?>
			<section class="final-cta-block final-cta-block--service">
			<div class="final-cta-container final-cta-container--service">
				<div class="final-cta-left final-cta-left--service">
					<?php if ( ! empty( $service_intro_pill ) ) : ?>
						<div class="why-us-heading-pill final-cta-service-pill">
							<span class="why-us-heading-text"><?php echo esc_html( $service_intro_pill ); ?></span>
						</div>
					<?php endif; ?>
						<h2 class="final-cta-title"><?php echo wp_kses_post($service_intro_title); ?></h2>
						<?php if (!empty($service_intro_description)) : ?>
							<p class="final-cta-description"><?php echo wp_kses_post($service_intro_description); ?></p>
						<?php endif; ?>
						<?php if (!empty($service_intro_button_text)) : ?>
							<a href="<?php echo esc_url($service_intro_button_link); ?>" class="btn btn-primary final-cta-button"><?php echo esc_html($service_intro_button_text); ?></a>
						<?php endif; ?>
					</div>

				<div class="final-cta-right final-cta-right--desktop final-cta-right--service">
					<?php foreach ($service_intro_items as $intro_item) :
						$item_icon = ! empty($intro_item['icon']) ? $intro_item['icon'] : '';
						$item_title = ! empty($intro_item['title']) ? $intro_item['title'] : '';
						$item_description = ! empty($intro_item['description']) ? $intro_item['description'] : '';
					?>
						<div class="final-cta-item">
							<div class="final-cta-item-header">
								<?php if ($item_icon) : ?>
									<img src="<?php echo esc_url($item_icon); ?>" alt="<?php echo esc_attr($item_title); ?>" class="final-cta-icon" width="26" height="26" loading="lazy">
								<?php endif; ?>
								<h3 class="final-cta-item-title"><?php echo esc_html($item_title); ?></h3>
							</div>
							<p class="final-cta-item-description"><?php echo wp_kses_post($item_description); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php endif; ?>

			<?php if ($block_enabled['service_context'] && ($is_shoping_service || $is_corporate_events_chauffeur_service || $is_private_tours_service || $is_travel_agencies_service)) : ?>
				<?php
				get_template_part(
					'template-parts/service/service-context',
					null,
					array(
						'block' => $service_context,
					)
				);
				?>
			<?php endif; ?>

		<?php if ('hourly-hire' === $current_service_slug && $block_enabled['occasions']) : ?>
		<?php
		get_template_part(
			'template-parts/blocks/occasions',
			null,
			array(
				'block' => $occasions,
			)
		);
		?>
	<?php endif; ?>

	<?php if ($is_cultural_sport_events_service && $block_enabled['occasions']) : ?>
		<?php
		get_template_part(
			'template-parts/blocks/occasions',
			null,
			array(
				'block' => $occasions,
			)
		);
		?>
	<?php endif; ?>

	<?php if ($is_wedding_service) : ?>
		<?php
		get_template_part(
			'template-parts/blocks/occasions',
			null,
			array(
				'block' => $occasions,
			)
		);
		?>
	<?php endif; ?>

	<?php if ($is_wedding_service && $block_enabled['fleet']) : ?>
		<?php
		get_template_part(
			'template-parts/blocks/fleet-slider',
			null,
			array(
				'section_modifier' => 'fleet-slider-block--wedding',
			)
		);
		?>
	<?php endif; ?>

	<?php if ($is_cultural_sport_events_service && $block_enabled['fleet']) : ?>
		<?php
		get_template_part(
			'template-parts/blocks/fleet-slider',
			null,
			array(
				'section_modifier' => 'fleet-slider-block--cultural-sport-events',
			)
		);
		?>
	<?php endif; ?>

	<?php if ($is_family_travel_chauffeur_service && $block_enabled['fleet']) : ?>
		<?php
		get_template_part(
			'template-parts/blocks/fleet-slider',
			null,
			array(
				'title' => 'Every family ride is managed with the same<br>precision as our corporate transfers — with<br>extra attention to safety and comfort.',
				'lead' => 'Premium vehicles offer space for luggage and child seats,<br>while professional chauffeurs ensure a calm, seamless<br>journey.',
				'section_modifier' => 'fleet-slider-block--family-travel',
			)
		);
		?>
	<?php endif; ?>

	<?php if ($is_medical_transportation_service && $block_enabled['fleet']) : ?>
		<?php
		get_template_part(
			'template-parts/blocks/fleet-slider',
			null,
			array(
				'title' => 'Licensed, insured, and fully confidential',
				'hide_lead' => true,
			)
		);
		?>
	<?php endif; ?>

		<?php if ($is_special_transfers_service && $block_enabled['fleet']) : ?>
			<?php
			get_template_part(
				'template-parts/blocks/fleet-slider',
			null,
			array(
				'title' => 'A single standard of excellence —<br>in the air, on land, and at sea.',
				'lead' => 'GTS partners only with licensed and insured aviation and maritime<br>operators, ensuring world-class safety and service standards.',
				'category_slugs' => array('light-jets', 'mid-jets', 'super-mid-jets'),
				'section_modifier' => 'fleet-slider-block--special-transfers',
			)
			);
			?>
		<?php endif; ?>

		<?php if ($is_shoping_service && $block_enabled['fleet']) : ?>
			<?php
			get_template_part(
				'template-parts/blocks/fleet-slider',
				null,
				array(
					'title' => 'Late-model luxury vehicles and discreet,<br>experienced drivers ensure comfort, privacy,<br>and consistency from the first stop to the last.',
					'hide_lead' => true,
				)
			);
			?>
		<?php endif; ?>

		<?php // ======================== FLEET BLOCK ========================
	?>
	<?php if ($block_enabled['occasions'] && ($is_airport_transfer_service || $is_professional_chauffeur_service)) : ?>
		<?php
		get_template_part(
			'template-parts/blocks/occasions',
			null,
			array(
				'block' => $occasions,
			)
		);
		?>
	<?php endif; ?>

		<?php if ($block_enabled['fleet'] && ! $is_special_transfers_service && ! $is_wedding_service && ! $is_cultural_sport_events_service && ! $is_family_travel_chauffeur_service && ! $is_medical_transportation_service && ! $is_shoping_service) : ?>
		<?php
		$fleet_slider_args = array();
		if ('hourly-hire' === $current_service_slug) {
			$fleet_slider_args['lead'] = 'That’s why every&nbsp;GTS limousine&nbsp;meets strict standards of<br>comfort, safety, and presentation.';
			$fleet_slider_args['section_modifier'] = 'fleet-slider-block--hourly-hire';
		}
		if ($is_airport_transfer_service) {
			$fleet_slider_args['lead'] = 'That’s why every&nbsp;GTS limousine&nbsp;meets strict standards of<br>comfort, safety, and presentation.';
			$fleet_slider_args['section_modifier'] = 'fleet-slider-block--airport-transfer';
		}
		if ($is_professional_chauffeur_service) {
			$fleet_slider_args['lead'] = 'That’s why every&nbsp;GTS limousine&nbsp;meets strict standards of<br>comfort, safety, and presentation.';
			$fleet_slider_args['section_modifier'] = 'fleet-slider-block--professional-chauffeur';
		}
		if ($is_corporate_events_chauffeur_service) {
			$fleet_slider_args['title'] = 'Every detail matters — from the car you travel in to the<br>person behind the wheel. That’s why every&nbsp;GTS car&nbsp;meets<br>strict standards of comfort, safety, and presentation.';
			$fleet_slider_args['hide_lead'] = true;
		}
		if ($is_private_tours_service) {
			$fleet_slider_args['title'] = 'Every detail matters on a private journey — from the comfort<br>of the vehicle to the experience of the chauffeur. Every GTS<br>car meets high standards of safety, comfort, and<br>presentation, ensuring a smooth and relaxed journey.';
			$fleet_slider_args['hide_lead'] = true;
		}
		if ($is_travel_agencies_service) {
			$fleet_slider_args['title'] = 'Every GTS vehicle meets high standards of safety, comfort,<br>and presentation, supported by chauffeurs experienced in<br>structured, long-term transportation programs.';
			$fleet_slider_args['hide_lead'] = true;
			$fleet_slider_args['section_modifier'] = 'fleet-slider-block--travel-agencies';
		}
		get_template_part('template-parts/blocks/fleet-slider', null, $fleet_slider_args);
		?>
	<?php endif; ?>

	<?php // ======================== HOW IT WORKS BLOCK ========================
	?>
	<?php if ($block_enabled['how_it_works']) : ?>
		<section class="how-it-works-block" style="background-image: url('<?php echo esc_url($hiw_bg); ?>');">
			<div class="how-it-works-container">
				<div class="how-it-works-left">
					<div class="how-it-works-pill"><span class="how-it-works-pill-text"><?php echo esc_html($hiw_pill); ?></span></div>
					<h2 class="how-it-works-title"><?php echo wp_kses_post($hiw_title); ?></h2>
				</div>
				<div class="how-it-works-right">
					<div class="how-it-works-steps">
						<?php foreach ($hiw_steps as $step) :
							$num = ! empty($step['number']) ? $step['number'] : '';
							$icon = ! empty($step['icon']) ? $step['icon'] : '';
							$title = ! empty($step['title']) ? $step['title'] : '';
							$desc = ! empty($step['description']) ? $step['description'] : '';
						?>
							<div class="how-it-works-step">
								<div class="how-it-works-step-header">
									<h3 class="how-it-works-step-title"><?php echo wp_kses_post($title); ?></h3>
									<div class="how-it-works-step-badge">
										<span class="how-it-works-step-number"><?php echo esc_html($num); ?></span>
										<span class="how-it-works-step-icon"><img src="<?php echo esc_url($icon); ?>" alt="" aria-hidden="true" loading="lazy" width="24" height="24"></span>
									</div>
								</div>
								<p class="how-it-works-step-description"><?php echo wp_kses_post($desc); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php // ======================== WHY US BLOCK ========================
	?>
	<?php if (($block_enabled['why_us'] || $is_family_travel_chauffeur_service) && 'hourly-hire' !== $current_service_slug && ! $is_corporate_events_chauffeur_service && ! $is_private_tours_service && ! $is_travel_agencies_service) : ?>
		<section class="why-us-block" style="padding-bottom: clamp(56px, 8vw, 120px);">
			<div class="why-us-container">
				<div class="why-us-heading">
					<div class="why-us-heading-pill">
						<span class="why-us-heading-text"><?php echo esc_html($why_us_pill); ?></span>
					</div>
					<div class="why-us-heading-line" aria-hidden="true"></div>
				</div>
					<div class="why-us-intro">
						<h2 class="why-us-intro-title"><?php echo wp_kses_post($why_us_intro_title); ?></h2>
						<?php if (!empty($why_us_intro_text)) : ?>
							<p class="why-us-intro-description"><?php echo wp_kses_post($why_us_intro_text); ?></p>
						<?php endif; ?>
					</div>
				<div class="why-us-grid">
					<?php $i = 1;
					foreach ($why_us_cards as $card) :
						$card_type = ! empty($card['card_type']) ? $card['card_type'] : 'icon';
						$image = ! empty($card['image']) ? $card['image'] : '';
						$icon = ! empty($card['icon']) ? $card['icon'] : '';
						$title = ! empty($card['title']) ? $card['title'] : '';
						$desc = ! empty($card['description']) ? $card['description'] : '';
					?>
						<?php if ('image' === $card_type && $image) : ?>
							<div class="why-us-item why-us-item-<?php echo $i; ?>" style="background-image: url('<?php echo esc_url($image); ?>');">
								<h3 class="why-us-item-title"><?php echo esc_html($title); ?></h3>
								<p class="why-us-item-description"><?php echo wp_kses_post($desc); ?></p>
							</div>
						<?php else : ?>
							<div class="why-us-item why-us-item-<?php echo $i; ?>">
								<?php if ($icon) : ?><div class="why-us-item-icon-wrapper"><img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>" class="why-us-item-icon" loading="lazy" width="48" height="48"></div><?php endif; ?>
								<h3 class="why-us-item-title"><?php echo esc_html($title); ?></h3>
								<p class="why-us-item-description"><?php echo wp_kses_post($desc); ?></p>
							</div>
						<?php endif; ?>
					<?php $i++;
					endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ($block_enabled['why_us'] && ($is_corporate_events_chauffeur_service || $is_private_tours_service || $is_travel_agencies_service)) : ?>
		<section class="why-us-block<?php echo $is_travel_agencies_service ? ' why-us-block--travel-agencies-gap' : ''; ?>">
			<div class="why-us-container">
				<div class="why-us-heading">
					<div class="why-us-heading-pill">
						<span class="why-us-heading-text"><?php echo esc_html($why_us_pill); ?></span>
					</div>
					<div class="why-us-heading-line" aria-hidden="true"></div>
				</div>
					<div class="why-us-intro">
						<h2 class="why-us-intro-title"><?php echo wp_kses_post($why_us_intro_title); ?></h2>
						<?php if (!empty($why_us_intro_text)) : ?>
							<p class="why-us-intro-description"><?php echo wp_kses_post($why_us_intro_text); ?></p>
						<?php endif; ?>
					</div>
				<div class="why-us-grid">
					<?php $i = 1;
					foreach ($why_us_cards as $card) :
						$card_type = ! empty($card['card_type']) ? $card['card_type'] : 'icon';
						$image = ! empty($card['image']) ? $card['image'] : '';
						$icon = ! empty($card['icon']) ? $card['icon'] : '';
						$title = ! empty($card['title']) ? $card['title'] : '';
						$desc = ! empty($card['description']) ? $card['description'] : '';
					?>
						<?php if ('image' === $card_type && $image) : ?>
							<div class="why-us-item why-us-item-<?php echo $i; ?>" style="background-image: url('<?php echo esc_url($image); ?>');">
								<h3 class="why-us-item-title"><?php echo esc_html($title); ?></h3>
								<p class="why-us-item-description"><?php echo wp_kses_post($desc); ?></p>
							</div>
						<?php else : ?>
							<div class="why-us-item why-us-item-<?php echo $i; ?>">
								<?php if ($icon) : ?><div class="why-us-item-icon-wrapper"><img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>" class="why-us-item-icon" loading="lazy" width="48" height="48"></div><?php endif; ?>
								<h3 class="why-us-item-title"><?php echo esc_html($title); ?></h3>
								<p class="why-us-item-description"><?php echo wp_kses_post($desc); ?></p>
							</div>
						<?php endif; ?>
					<?php $i++;
					endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if ($block_enabled['why_us'] && 'hourly-hire' === $current_service_slug) : ?>
		<section class="why-us-block why-us-block--hourly-hire-gap">
			<div class="why-us-container">
				<div class="why-us-heading">
					<div class="why-us-heading-pill">
						<span class="why-us-heading-text"><?php echo esc_html($why_us_pill); ?></span>
					</div>
					<div class="why-us-heading-line" aria-hidden="true"></div>
				</div>
					<div class="why-us-intro">
						<h2 class="why-us-intro-title"><?php echo wp_kses_post($why_us_intro_title); ?></h2>
						<?php if (!empty($why_us_intro_text)) : ?>
							<p class="why-us-intro-description"><?php echo wp_kses_post($why_us_intro_text); ?></p>
						<?php endif; ?>
					</div>
				<div class="why-us-grid">
					<?php $i = 1;
					foreach ($why_us_cards as $card) :
						$card_type = ! empty($card['card_type']) ? $card['card_type'] : 'icon';
						$image = ! empty($card['image']) ? $card['image'] : '';
						$icon = ! empty($card['icon']) ? $card['icon'] : '';
						$title = ! empty($card['title']) ? $card['title'] : '';
						$desc = ! empty($card['description']) ? $card['description'] : '';
					?>
						<?php if ('image' === $card_type && $image) : ?>
							<div class="why-us-item why-us-item-<?php echo $i; ?>" style="background-image: url('<?php echo esc_url($image); ?>');">
								<h3 class="why-us-item-title"><?php echo esc_html($title); ?></h3>
								<p class="why-us-item-description"><?php echo wp_kses_post($desc); ?></p>
							</div>
						<?php else : ?>
							<div class="why-us-item why-us-item-<?php echo $i; ?>">
								<?php if ($icon) : ?><div class="why-us-item-icon-wrapper"><img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>" class="why-us-item-icon" loading="lazy" width="48" height="48"></div><?php endif; ?>
								<h3 class="why-us-item-title"><?php echo esc_html($title); ?></h3>
								<p class="why-us-item-description"><?php echo wp_kses_post($desc); ?></p>
							</div>
						<?php endif; ?>
					<?php $i++;
					endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<div class="white-sections-wrapper">
		<?php get_template_part('template-parts/blocks/trusted-by'); ?>

		<?php // ======================== FAQ BLOCK ========================
		?>
		<?php if ($block_enabled['faq']) : ?>
			<?php
			$half = ceil(count($faq_items) / 2);
			$faq_col1 = array_slice($faq_items, 0, $half);
			$faq_col2 = array_slice($faq_items, $half);
			?>
			<section class="faq-block">
				<div class="faq-container">
					<div class="faq-pill"><span class="faq-pill-text"><?php echo esc_html($faq_pill); ?></span></div>
					<h2 class="faq-title"><?php echo wp_kses_post($faq_title); ?></h2>
					<div class="faq-accordions">
						<div class="faq-accordion-col">
							<?php foreach ($faq_col1 as $idx => $item) : $id = 'faq-content-1-' . $idx; ?>
								<div class="faq-item" data-faq-item>
									<button type="button" class="faq-item__summary" aria-expanded="false" aria-controls="<?php echo esc_attr($id); ?>">
										<span class="faq-item__question"><?php echo esc_html($item['question']); ?></span>
										<img src="<?php echo esc_url($chevron_url); ?>" alt="" class="faq-item__icon" width="20" height="20" aria-hidden="true">
									</button>
									<div class="faq-item__content-wrapper" id="<?php echo esc_attr($id); ?>">
										<div class="faq-item__content">
											<p><?php echo esc_html($item['answer']); ?></p>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="faq-accordion-col">
							<?php foreach ($faq_col2 as $idx => $item) : $id = 'faq-content-2-' . $idx; ?>
								<div class="faq-item" data-faq-item>
									<button type="button" class="faq-item__summary" aria-expanded="false" aria-controls="<?php echo esc_attr($id); ?>">
										<span class="faq-item__question"><?php echo esc_html($item['question']); ?></span>
										<img src="<?php echo esc_url($chevron_url); ?>" alt="" class="faq-item__icon" width="20" height="20" aria-hidden="true">
									</button>
									<div class="faq-item__content-wrapper" id="<?php echo esc_attr($id); ?>">
										<div class="faq-item__content">
											<p><?php echo esc_html($item['answer']); ?></p>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>

			<?php get_template_part('template-parts/blocks/custom-itinerary', 'limousine'); ?>
		<?php get_template_part('template-parts/blocks/services', 'limousine'); ?>
	</div>

	<?php if ($has_bottom_text_block && $block_enabled['bottom_text']) : ?>
		<section class="service-bottom-text">
			<div class="service-bottom-text__container">
				<?php if ( ! empty( $bottom_text_title ) ) : ?>
					<p class="service-bottom-text__title"><?php echo esc_html( $bottom_text_title ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $bottom_text_description ) ) : ?>
					<p class="service-bottom-text__description"><?php echo esc_html( $bottom_text_description ); ?></p>
				<?php endif; ?>

				<a class="service-bottom-text__link" href="<?php echo esc_url( $bottom_text_link_url ); ?>">
					<?php echo esc_html( $bottom_text_link_text ); ?>
				</a>
			</div>
		</section>
	<?php endif; ?>

</main>

<?php get_footer(); ?>
