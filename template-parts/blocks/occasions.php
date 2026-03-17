<?php
/**
 * Occasions Block Template
 * "Perfect for Every Occasion" - uses same structure and styles as why-us
 *
 * @package GTS
 */

$site_url = get_site_url();
$block = isset( $args['block'] ) && is_array( $args['block'] ) ? $args['block'] : array();
if ( empty( $block ) && function_exists( 'gts_is_service_style_page' ) && gts_is_service_style_page() && function_exists( 'gts_get_page_service_block' ) ) {
	$block = gts_get_page_service_block( 'occasions' );
}
$current_service_slug = is_singular( 'service' ) ? (string) get_post_field( 'post_name', get_the_ID() ) : '';
$is_hourly_hire = ( 'hourly-hire' === $current_service_slug );
$is_airport_transfer_service = ( 'airport-transfer-service' === $current_service_slug );
$is_professional_chauffeur_service = ( 'professional-chauffeur-service' === $current_service_slug );
$is_cultural_sport_events_service = ( 'cultural-sport-events' === $current_service_slug );
$is_wedding_service = ( 'wedding' === $current_service_slug );
$image_airport_url = $site_url . '/wp-content/uploads/2026/02/photo-l-1_result.webp';
$image_events_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/03/Frame-2087325440_result.webp';
$is_city_to_city = is_page_template( 'page-city-to-city.php' ) || is_page( 'city-to-city' );
if ( $is_city_to_city ) {
	$image_events_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/city-55_result.webp';
}
$icon_executive_url = $site_url . '/wp-content/uploads/2026/02/icon-l-1.svg';
$icon_airport_url = $site_url . '/wp-content/uploads/2026/02/icon-l-2.svg';
$icon_multi_day_url = $site_url . '/wp-content/uploads/2026/02/icon-l-3.svg';
$icon_private_url = $site_url . '/wp-content/uploads/2026/02/icon-l-4.svg';
$icon_events_url = $site_url . '/wp-content/uploads/2026/02/icon-l-5.svg';

$item_1_title = $is_city_to_city ? 'Business Travel' : 'Executive Travel';
$item_1_description = $is_city_to_city
	? 'private, quiet space to work or rest between meetings and cities.'
	: 'ensure a seamless experience for board members,<br>CEOs, or international guests.';
$item_2_title = $is_city_to_city ? 'Airport Transfers Between Cities' : 'Airport Limousine Service';
$item_2_description = $is_city_to_city
	? 'connecting airports made easy and comfortable.'
	: 'punctual, monitored, and stress-free – from arrival gate<br>to final destination.';
$item_3_title = $is_city_to_city ? 'Delegations & VIP Guests' : 'Multi-Day Itineraries';
$item_3_description = $is_city_to_city
	? 'punctual, discreet service for important clients.'
	: 'extended or multi-city travel managed with real-time<br>coordination and dedicated support.';
$item_4_title = $is_city_to_city ? 'Weekend Getaways & Vacations' : 'Private Occasions';
$item_4_description = $is_city_to_city
	? 'personalized itineraries and flexible returns.'
	: 'weddings, galas, proms, birthday and personal<br>celebrations with impeccable service.';
$item_5_title = $is_city_to_city ? 'Family Journeys' : 'Events & Conferences';
$item_5_description = $is_city_to_city
	? 'child seats and flexible stops on request.'
	: 'coordinated logistics for delegations, summits, and VIP gatherings.';
$section_pill = ! empty( $block['pill_text'] ) ? $block['pill_text'] : 'Full Service';
$section_title = ! empty( $block['title'] ) ? $block['title'] : 'Perfect for Every Occasion';
$footer_text = $is_city_to_city
	? 'Whether it’s a business meeting, an exclusive event, or a long-distance journey — GTS adapts to your agenda with flawless precision and discretion.'
	: 'Whether it\'s a business meeting, an exclusive event, or a long-distance journey – GTS Limousine Service adapts to your agenda with flawless precision and discretion.';
$footer_text = ! empty( $block['footer_text'] ) ? $block['footer_text'] : $footer_text;
$footer_text_enabled = ! isset( $block['footer_text_enabled'] ) || (bool) $block['footer_text_enabled'];
$admin_cards = array();

if ( ! empty( $block['cards'] ) && is_array( $block['cards'] ) ) {
	$cards = array_values(
		array_filter(
			array_map(
				static function ( $card ) {
					if ( ! is_array( $card ) ) {
						return null;
					}
					return array(
						'card_type'   => ! empty( $card['card_type'] ) ? (string) $card['card_type'] : 'icon',
						'image'       => ! empty( $card['image'] ) ? (string) $card['image'] : '',
						'icon'        => ! empty( $card['icon'] ) ? (string) $card['icon'] : '',
						'title'       => isset( $card['title'] ) ? (string) $card['title'] : '',
						'description' => isset( $card['description'] ) ? (string) $card['description'] : '',
					);
				},
				$block['cards']
			)
		)
	);
	if ( isset( $cards[0] ) ) {
		$icon_executive_url = '' !== $cards[0]['icon'] ? $cards[0]['icon'] : $icon_executive_url;
		$item_1_title = '' !== $cards[0]['title'] ? $cards[0]['title'] : $item_1_title;
		$item_1_description = '' !== $cards[0]['description'] ? $cards[0]['description'] : $item_1_description;
	}
	if ( isset( $cards[1] ) ) {
		$icon_airport_url = '' !== $cards[1]['icon'] ? $cards[1]['icon'] : $icon_airport_url;
		$item_2_title = '' !== $cards[1]['title'] ? $cards[1]['title'] : $item_2_title;
		$item_2_description = '' !== $cards[1]['description'] ? $cards[1]['description'] : $item_2_description;
	}
	if ( isset( $cards[2] ) ) {
		$image_airport_url = '' !== $cards[2]['image'] ? $cards[2]['image'] : $image_airport_url;
	}
	if ( isset( $cards[3] ) ) {
		$icon_multi_day_url = '' !== $cards[3]['icon'] ? $cards[3]['icon'] : $icon_multi_day_url;
		$item_3_title = '' !== $cards[3]['title'] ? $cards[3]['title'] : $item_3_title;
		$item_3_description = '' !== $cards[3]['description'] ? $cards[3]['description'] : $item_3_description;
	}
	if ( isset( $cards[4] ) ) {
		$icon_private_url = '' !== $cards[4]['icon'] ? $cards[4]['icon'] : $icon_private_url;
		$item_4_title = '' !== $cards[4]['title'] ? $cards[4]['title'] : $item_4_title;
		$item_4_description = '' !== $cards[4]['description'] ? $cards[4]['description'] : $item_4_description;
	}
	if ( isset( $cards[5] ) ) {
		$image_events_url = '' !== $cards[5]['image'] ? $cards[5]['image'] : $image_events_url;
	}
		if ( isset( $cards[6] ) ) {
			$icon_events_url = '' !== $cards[6]['icon'] ? $cards[6]['icon'] : $icon_events_url;
			$item_5_title = '' !== $cards[6]['title'] ? $cards[6]['title'] : $item_5_title;
			$item_5_description = '' !== $cards[6]['description'] ? $cards[6]['description'] : $item_5_description;
		}
		$admin_cards = $cards;
	}

if ( $is_hourly_hire ) {
	$image_airport_url = $site_url . '/wp-content/uploads/2026/02/photo-l-2_result.webp';
	$image_events_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/1_result.webp';

	$item_1_title = 'Business Days & Meetings';
	$item_1_description = 'private, quiet space to work or rest between<br>meetings and cities.';

	$icon_airport_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/healthicons_i-groups-perspective-crowd.svg';
	$item_2_title = 'Events & Conferences';
	$item_2_description = 'connecting airports made easy and<br>comfortable.';

	$icon_multi_day_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/mdi_film-open.svg';
	$item_3_title = 'Film, Production & Media Crews';
	$item_3_description = 'flexible hours and reliable<br>coordination.';

	$icon_private_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/fluent_premium-12-filled.svg';
	$item_4_title = 'Delegations & VIP Guests';
	$item_4_description = 'continuous support and absolute discretion.';

	$icon_events_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/icon-park-solid_calendar.svg';
	$item_5_title = 'Private Errands & Leisure';
	$item_5_description = 'shopping, family visits, sightseeing —<br>all on your schedule.';

	$footer_text_enabled = false;
}

if ( $is_airport_transfer_service ) {
	$image_airport_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/airport-transfer-service-11_result-1.webp';
	$image_events_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/airport-transfer-service-22_result.webp';

	$icon_airport_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/airport-transfer-service-1.svg';
	$icon_multi_day_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/airport-transfer-service-2.svg';
	$icon_private_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/airport-transfer-service-3.svg';
	$icon_events_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/airport-transfer-service-4.svg';

	$item_1_title = 'Corporate Clients & Executives';
	$item_1_description = 'discreet, punctual service for business arrivals and<br>departures.';

	$item_2_title = 'Private & Family Trips';
	$item_2_description = 'child seats, extra luggage space, and<br>tailored comfort.';

	$item_3_title = 'Group Transfers';
	$item_3_description = 'coordinated pickups for delegations<br>or event guests.';

	$item_4_title = 'Connecting Flights';
	$item_4_description = 'transfers between airports or terminals without the<br>stress.';

	$item_5_title = 'Luxury Travelers & VIPs';
	$item_5_description = 'meet & greet with full discretion and<br>premium-class vehicles.';

	$footer_text_enabled = false;
}

if ( $is_professional_chauffeur_service ) {
	$image_events_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/professional-chauffeur-service_result.webp';

	$icon_airport_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/airport-transfer-service-1.svg';
	$icon_multi_day_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/airport-transfer-service-2.svg';
	$icon_private_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/3.svg';
	$icon_events_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/airport-transfer-service-4.svg';

	$item_1_title = 'Corporate & Executive Travel';
	$item_1_description = 'for meetings, conferences, and client visits.';

	$item_2_title = 'Airport Transfers';
	$item_2_description = 'meet & greet at arrivals, flight tracking,<br>punctual pick-ups.';

	$item_3_title = 'Delegations & Business Trips';
	$item_3_description = 'multiple passengers, single<br>coordination.';

	$item_4_title = 'Hourly Hire';
	$item_4_description = 'a chauffeur and car at your disposal for flexible daily<br>travel.';

	$item_5_title = 'Private Events';
	$item_5_description = 'weddings, galas, diplomatic visits,<br>and VIP occasions.';

	$footer_text_enabled = false;
}

if ( $is_cultural_sport_events_service ) {
	$section_title = 'Tailored for Every Event';
	$image_airport_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/4444_result.webp';
	$image_events_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/5555_result.webp';
	$icon_executive_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/Tailored-for-Every-Event-1.svg';
	$icon_airport_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/Tailored-for-Every-Event-2.svg';
	$icon_multi_day_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/Tailored-for-Every-Event-3.svg';
	$icon_private_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/Tailored-for-Every-Event-4.svg';
	$icon_events_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/Tailored-for-Every-Event-5.svg';
	$item_1_title = 'Cultural Events & Concerts';
	$item_1_description = 'Luxury car service for the couple, guests, and family';
	$item_2_title = 'International Sports Events';
	$item_2_description = 'transfers for athletes, sponsors,<br>and executive delegations.';
	$item_3_title = 'Film Festivals & Premieres';
	$item_3_description = 'coordinated arrivals for directors,<br>actors, and VIP guests with event-<br>trained chauffeurs.';
	$item_4_title = 'Corporate Receptions & Summits';
	$item_4_description = 'smooth, timely coordination for guests, speakers,<br>and executives.';
	$item_5_title = 'Private Galas & Awards Ceremonies';
	$item_5_description = 'refined, discreet service that complements<br>the elegance of your event.';
	$footer_text_enabled = false;
}

if ( $is_wedding_service ) {
	$section_title = 'Perfect for Any Traveller';
	$image_airport_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/professional-chauffeur-service_result.webp';
	$image_events_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/345_result.webp';
	$icon_executive_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/Wedding1-1-2.svg';
	$icon_airport_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/Wedding1-2-2.svg';
	$icon_multi_day_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/1123.svg';
	$icon_private_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/Wedding1-3-2.svg';
	$icon_events_url = 'https://global-travelsolutions.com/wp-content/uploads/2026/02/Wedding1-5-1.svg';

	$item_1_title = 'Weddings & Engagements';
	$item_1_description = 'Luxury car service for the couple, guests, and family';

	$item_2_title = 'Anniversaries & Private Parties';
	$item_2_description = 'premium cars and attentive service<br>for every guest.';

	$item_3_title = 'Corporate Receptions & Galas';
	$item_3_description = 'reliable logistics for high-profile<br>attendees.';

	$item_4_title = 'Diplomatic & Red-Carpet Events';
	$item_4_description = 'protocol-compliant transfers with full discretion.';

	$item_5_title = 'Destination Weddings';
	$item_5_description = 'seamless coordination in 100+ countries,<br>from resorts to private estates.';

	$footer_text_enabled = false;
}

// Keep service presets as fallback only: if admin filled cards, they always win.
if ( ! empty( $admin_cards ) && is_array( $admin_cards ) ) {
	if ( isset( $admin_cards[0] ) ) {
		$icon_executive_url = '' !== $admin_cards[0]['icon'] ? $admin_cards[0]['icon'] : $icon_executive_url;
		$item_1_title = '' !== $admin_cards[0]['title'] ? $admin_cards[0]['title'] : $item_1_title;
		$item_1_description = '' !== $admin_cards[0]['description'] ? $admin_cards[0]['description'] : $item_1_description;
	}
	if ( isset( $admin_cards[1] ) ) {
		$icon_airport_url = '' !== $admin_cards[1]['icon'] ? $admin_cards[1]['icon'] : $icon_airport_url;
		$item_2_title = '' !== $admin_cards[1]['title'] ? $admin_cards[1]['title'] : $item_2_title;
		$item_2_description = '' !== $admin_cards[1]['description'] ? $admin_cards[1]['description'] : $item_2_description;
	}
	if ( isset( $admin_cards[2] ) ) {
		$image_airport_url = '' !== $admin_cards[2]['image'] ? $admin_cards[2]['image'] : $image_airport_url;
	}
	if ( isset( $admin_cards[3] ) ) {
		$icon_multi_day_url = '' !== $admin_cards[3]['icon'] ? $admin_cards[3]['icon'] : $icon_multi_day_url;
		$item_3_title = '' !== $admin_cards[3]['title'] ? $admin_cards[3]['title'] : $item_3_title;
		$item_3_description = '' !== $admin_cards[3]['description'] ? $admin_cards[3]['description'] : $item_3_description;
	}
	if ( isset( $admin_cards[4] ) ) {
		$icon_private_url = '' !== $admin_cards[4]['icon'] ? $admin_cards[4]['icon'] : $icon_private_url;
		$item_4_title = '' !== $admin_cards[4]['title'] ? $admin_cards[4]['title'] : $item_4_title;
		$item_4_description = '' !== $admin_cards[4]['description'] ? $admin_cards[4]['description'] : $item_4_description;
	}
	if ( isset( $admin_cards[5] ) ) {
		$image_events_url = '' !== $admin_cards[5]['image'] ? $admin_cards[5]['image'] : $image_events_url;
	}
	if ( isset( $admin_cards[6] ) ) {
		$icon_events_url = '' !== $admin_cards[6]['icon'] ? $admin_cards[6]['icon'] : $icon_events_url;
		$item_5_title = '' !== $admin_cards[6]['title'] ? $admin_cards[6]['title'] : $item_5_title;
		$item_5_description = '' !== $admin_cards[6]['description'] ? $admin_cards[6]['description'] : $item_5_description;
	}
}

$footer_hidden_class = $footer_text_enabled ? '' : ' occasions-footer-text--hidden';
?>

<section class="why-us-block occasions-block">
	<div class="why-us-container">
		<div class="why-us-heading">
			<div class="why-us-heading-pill">
				<span class="why-us-heading-text"><?php echo esc_html( $section_pill ); ?></span>
			</div>
				<div class="why-us-heading-line" aria-hidden="true"></div>
				<div class="occasions-title-wrapper">
					<div class="occasions-title"><?php echo esc_html( $section_title ); ?></div>
				</div>
			<p class="why-us-item-description occasions-footer-text occasions-footer-text-mobile<?php echo esc_attr( $footer_hidden_class ); ?>"<?php echo $footer_text_enabled ? '' : ' aria-hidden="true"'; ?>><?php echo esc_html( $footer_text ); ?></p>
		</div>
		<div class="why-us-grid">
			<!-- Row 1: Executive (wide), Airport text, Airport image -->
				<div class="why-us-item why-us-item-1">
					<div class="why-us-item-icon-wrapper">
						<img src="<?php echo esc_url( $icon_executive_url ); ?>" alt="" aria-hidden="true" class="why-us-item-icon" loading="lazy" width="48" height="48">
					</div>
					<div class="why-us-item-title"><?php echo esc_html( gts_normalize_heading_text( $item_1_title ) ); ?></div>
					<p class="why-us-item-description"><?php echo wp_kses_post( $item_1_description ); ?></p>
				</div>

				<div class="why-us-item why-us-item-2">
					<div class="why-us-item-icon-wrapper">
						<img src="<?php echo esc_url( $icon_airport_url ); ?>" alt="" aria-hidden="true" class="why-us-item-icon" loading="lazy" width="48" height="48">
					</div>
					<div class="why-us-item-title"><?php echo esc_html( gts_normalize_heading_text( $item_2_title ) ); ?></div>
					<p class="why-us-item-description"><?php echo wp_kses_post( $item_2_description ); ?></p>
				</div>

				<div class="why-us-item occasions-item-image" style="--gts-card-bg: url('<?php echo esc_url( $image_airport_url ); ?>');" role="img" aria-label="<?php esc_attr_e( 'Airport limousine', 'gts-theme' ); ?>"></div>

			<!-- Row 2: Multi-Day, Private Occasions -->
				<div class="why-us-item why-us-item-3">
					<div class="why-us-item-icon-wrapper">
						<img src="<?php echo esc_url( $icon_multi_day_url ); ?>" alt="" aria-hidden="true" class="why-us-item-icon" loading="lazy" width="48" height="48">
					</div>
					<div class="why-us-item-title"><?php echo esc_html( gts_normalize_heading_text( $item_3_title ) ); ?></div>
					<p class="why-us-item-description"><?php echo wp_kses_post( $item_3_description ); ?></p>
				</div>

				<div class="why-us-item why-us-item-4">
					<div class="why-us-item-icon-wrapper">
						<img src="<?php echo esc_url( $icon_private_url ); ?>" alt="" aria-hidden="true" class="why-us-item-icon" loading="lazy" width="48" height="48">
					</div>
					<div class="why-us-item-title"><?php echo esc_html( gts_normalize_heading_text( $item_4_title ) ); ?></div>
					<p class="why-us-item-description"><?php echo wp_kses_post( $item_4_description ); ?></p>
				</div>

			<!-- Row 3: Conference image (wide), Events & Conferences, footer text -->
				<div class="occasions-split-image occasions-row3-image" style="--gts-bg-image: url('<?php echo esc_url( $image_events_url ); ?>');" role="img" aria-label="<?php esc_attr_e( 'Conference audience', 'gts-theme' ); ?>"></div>
				<div class="occasions-split-card occasions-split-card--light occasions-row3-card">
					<div class="why-us-item-icon-wrapper">
						<img src="<?php echo esc_url( $icon_events_url ); ?>" alt="" aria-hidden="true" class="why-us-item-icon" loading="lazy" width="48" height="48">
					</div>
					<div class="why-us-item-title occasions-card-title--dark"><?php echo esc_html( gts_normalize_heading_text( $item_5_title ) ); ?></div>
					<p class="why-us-item-description occasions-card-description--dark"><?php echo wp_kses_post( $item_5_description ); ?></p>
				</div>

			<div class="why-us-item why-us-item-6 occasions-footer-item">
				<p class="why-us-item-description occasions-footer-text<?php echo esc_attr( $footer_hidden_class ); ?>"<?php echo $footer_text_enabled ? '' : ' aria-hidden="true"'; ?>><?php echo esc_html( $footer_text ); ?></p>
			</div>
		</div>
	</div>
</section>
