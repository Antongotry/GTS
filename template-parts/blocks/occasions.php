<?php
/**
 * Occasions Block Template
 * "Perfect for Every Occasion" - uses same structure and styles as why-us
 *
 * @package GTS
 */

$site_url = get_site_url();
$block = isset( $args['block'] ) && is_array( $args['block'] ) ? $args['block'] : array();
$current_service_slug = is_singular( 'service' ) ? (string) get_post_field( 'post_name', get_the_ID() ) : '';
$is_hourly_hire = ( 'hourly-hire' === $current_service_slug );
$is_airport_transfer_service = ( 'airport-transfer-service' === $current_service_slug );
$is_professional_chauffeur_service = ( 'professional-chauffeur-service' === $current_service_slug );
$image_airport_url = $site_url . '/wp-content/uploads/2026/02/photo-l-1_result.webp';
$image_events_url = $site_url . '/wp-content/uploads/2026/02/photo-l-2_result.webp';
$is_city_to_city = is_page_template( 'page-city-to-city.php' ) || is_page( 'city-to-city' );
if ( $is_city_to_city ) {
	$image_events_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-55_result.webp';
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

if ( $is_hourly_hire ) {
	$image_airport_url = $site_url . '/wp-content/uploads/2026/02/photo-l-2_result.webp';
	$image_events_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/1_result.webp';

	$item_1_title = 'Business Days & Meetings';
	$item_1_description = 'private, quiet space to work or rest between<br>meetings and cities.';

	$icon_airport_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/healthicons_i-groups-perspective-crowd.svg';
	$item_2_title = 'Events & Conferences';
	$item_2_description = 'connecting airports made easy and<br>comfortable.';

	$icon_multi_day_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/mdi_film-open.svg';
	$item_3_title = 'Film, Production & Media Crews';
	$item_3_description = 'flexible hours and reliable<br>coordination.';

	$icon_private_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/fluent_premium-12-filled.svg';
	$item_4_title = 'Delegations & VIP Guests';
	$item_4_description = 'continuous support and absolute discretion.';

	$icon_events_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/icon-park-solid_calendar.svg';
	$item_5_title = 'Private Errands & Leisure';
	$item_5_description = 'shopping, family visits, sightseeing —<br>all on your schedule.';

	$footer_text_enabled = false;
}

if ( $is_airport_transfer_service ) {
	$image_airport_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/airport-transfer-service-11_result-1.webp';
	$image_events_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/airport-transfer-service-22_result.webp';

	$icon_airport_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/airport-transfer-service-1.svg';
	$icon_multi_day_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/airport-transfer-service-2.svg';
	$icon_private_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/airport-transfer-service-3.svg';
	$icon_events_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/airport-transfer-service-4.svg';

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
	$image_events_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/professional-chauffeur-service_result.webp';

	$icon_airport_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/airport-transfer-service-1.svg';
	$icon_multi_day_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/airport-transfer-service-2.svg';
	$icon_private_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/3.svg';
	$icon_events_url = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/airport-transfer-service-4.svg';

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
				<h2 class="occasions-title"><?php echo esc_html( $section_title ); ?></h2>
			</div>
			<p class="why-us-item-description occasions-footer-text occasions-footer-text-mobile<?php echo esc_attr( $footer_hidden_class ); ?>"<?php echo $footer_text_enabled ? '' : ' aria-hidden="true"'; ?>><?php echo esc_html( $footer_text ); ?></p>
		</div>
		<div class="why-us-grid">
			<!-- Row 1: Executive (wide), Airport text, Airport image -->
			<div class="why-us-item why-us-item-1">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_executive_url ); ?>" alt="" class="why-us-item-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html( $item_1_title ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( $item_1_description ); ?></p>
			</div>

			<div class="why-us-item why-us-item-2">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_airport_url ); ?>" alt="" class="why-us-item-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html( $item_2_title ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( $item_2_description ); ?></p>
			</div>

			<div class="why-us-item occasions-item-image" style="background-image: url('<?php echo esc_url( $image_airport_url ); ?>');" role="img" aria-label="<?php esc_attr_e( 'Airport limousine', 'gts-theme' ); ?>"></div>

			<!-- Row 2: Multi-Day, Private Occasions -->
			<div class="why-us-item why-us-item-3">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_multi_day_url ); ?>" alt="" class="why-us-item-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html( $item_3_title ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( $item_3_description ); ?></p>
			</div>

			<div class="why-us-item why-us-item-4">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_private_url ); ?>" alt="" class="why-us-item-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="why-us-item-title"><?php echo esc_html( $item_4_title ); ?></h3>
				<p class="why-us-item-description"><?php echo wp_kses_post( $item_4_description ); ?></p>
			</div>

			<!-- Row 3: Conference image (wide), Events & Conferences, footer text -->
			<div class="occasions-split-image occasions-row3-image" style="background-image: url('<?php echo esc_url( $image_events_url ); ?>');" role="img" aria-label="<?php esc_attr_e( 'Conference audience', 'gts-theme' ); ?>"></div>
			<div class="occasions-split-card occasions-split-card--light occasions-row3-card">
				<div class="why-us-item-icon-wrapper">
					<img src="<?php echo esc_url( $icon_events_url ); ?>" alt="" class="why-us-item-icon" loading="lazy" width="48" height="48">
				</div>
				<h3 class="why-us-item-title occasions-card-title--dark"><?php echo esc_html( $item_5_title ); ?></h3>
				<p class="why-us-item-description occasions-card-description--dark"><?php echo esc_html( $item_5_description ); ?></p>
			</div>

			<div class="why-us-item why-us-item-6 occasions-footer-item">
				<p class="why-us-item-description occasions-footer-text<?php echo esc_attr( $footer_hidden_class ); ?>"<?php echo $footer_text_enabled ? '' : ' aria-hidden="true"'; ?>><?php echo esc_html( $footer_text ); ?></p>
			</div>
		</div>
	</div>
</section>
