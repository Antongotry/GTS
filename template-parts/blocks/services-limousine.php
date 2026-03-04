<?php
/**
 * Services Block — вариант для страницы Limousine Service (только 2 карточки + Show more)
 *
 * @package GTS
 */

$services = array(
	array(
		'title'       => __( 'Luxury Wedding & Event Chauffeur Service', 'gts-theme' ),
		'description' => __( 'From elegant bridal arrivals to seamless guest transfers — GTS ensures your celebration runs perfectly on time and in perfect style.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-1_result.webp',
		'url'         => home_url('/services/wedding/'),
	),
	array(
		'title'       => __( 'Cultural & Sport Events Chauffeur Service', 'gts-theme' ),
		'description' => __( 'Seamless VIP chauffeur service for sports, cultural, and corporate events — available in 100+ countries. From tournaments to galas, GTS ensures every guest arrives on time and with ease.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-2_result.webp',
		'url'         => home_url('/services/cultural-sport-events/'),
	),
	array(
		'title'       => __( 'Family Travel Chauffeur Service', 'gts-theme' ),
		'description' => __( 'Premium comfort and safety for every generation. From airport pickups to family getaways — GTS ensures smooth, secure, and perfectly coordinated travel for you and your loved ones.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-3_result.webp',
		'url'         => home_url('/services/family-travel-chauffeur-service/'),
	),
	array(
		'title'       => __( 'Medical Transportation', 'gts-theme' ),
		'description' => __( 'Coordinated travel for patients and medical delegations. Equipped vehicles, professional care, and assistance from pick-up to hospital arrival.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-4_result.webp',
		'url'         => home_url('/services/medical-transportation/'),
	),
	array(
		'title'       => __( 'Travel Personal Interpreter', 'gts-theme' ),
		'description' => __( 'Certified interpreters accompanying you during business meetings, negotiations, or tours. Available in major languages and coordinated with your schedule.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-5_result.webp',
		'url'         => home_url('/services/travel-personal-interpreter/'),
	),
	array(
		'title'       => __( 'Travel Planning', 'gts-theme' ),
		'description' => __( 'Complete itinerary creation — from transfers to flights, accommodations, and route timing. Our planners ensure everything runs like clockwork.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-6_result.webp',
		'url'         => home_url('/services/travel-planninig/'),
	),
	array(
		'title'       => __( 'Shopping Chauffeur Service', 'gts-theme' ),
		'description' => __( 'From luxury boutiques to private showrooms, GTS ensures seamless movement and discreet comfort — wherever you shop. Shopping should be a pleasure, not a schedule.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-7_result.webp',
		'url'         => home_url('/services/shoping/'),
	),
	array(
		'title'       => __( 'Corporate Events Chauffeur Service', 'gts-theme' ),
		'description' => __( 'From executive conferences and corporate meetings to product launches and gala receptions, GTS ensures every arrival, transfer, and departure runs exactly as planned — quietly, professionally, and on time.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-8_result.webp',
		'url'         => home_url('/services/corporate-events-chauffeur-service/'),
	),
	array(
		'title'       => __( 'Private Tours Chauffeur Service', 'gts-theme' ),
		'description' => __( 'From iconic landmarks to hidden destinations, GTS designs private chauffeur tours around your interests, pace, and itinerary — with seamless transfers, professional drivers, and complete flexibility throughout the journey.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-9_result.webp',
		'url'         => home_url('/services/private-tours/'),
	),
	array(
		'title'       => __( 'Travel Agencies', 'gts-theme' ),
		'description' => __( 'Reliable ground transportation partner for agencies and DMCs. Instant confirmations, transparent rates, 24/7 coordination, and seamless integration with your client itineraries.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-10_result.webp',
		'url'         => home_url('/services/travel-agencies/'),
	),
	array(
		'title'       => __( 'Mobility Partnerships', 'gts-theme' ),
		'description' => __( 'Long-term cooperation for hospitality, aviation, hotels and event industries. From VIP airport transfers to full guest logistics — seamlessly integrated with your brand and standards.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-11_result.webp',
		'url'         => home_url('/services/mobility-partnership/'),
	),
	array(
		'title'       => __( 'Airport Transfers for Events', 'gts-theme' ),
		'description' => __( 'GTS provides event airport transfers with precise scheduling and coordinated execution — ensuring smooth arrivals and departures for all guests.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-12_result.webp',
		'url'         => home_url('/services/airport-transfer-service/'),
	),
	array(
		'title'       => __( 'Chauffeur & Mobility Solutions for Corporations', 'gts-theme' ),
		'description' => __( 'GTS provides chauffeur and mobility solutions for corporations that need consistent, well-managed transportation across executive travel and ongoing operations.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-13_result.webp',
		'url'         => home_url('/services/corporations/'),
	),
);
$related_block = function_exists( 'gts_is_service_style_page' ) && gts_is_service_style_page() && function_exists( 'gts_get_page_service_block' )
	? gts_get_page_service_block( 'related_services' )
	: array();
$section_pill = 'Every journey, perfectly organized.';
$section_title = 'From executive roadshows to private celebrations —<br>GTS provides end-to-end transport solutions worldwide.';
if ( ! empty( $related_block ) ) {
	if ( ! empty( $related_block['pill_text'] ) ) {
		$section_pill = (string) $related_block['pill_text'];
	}
	if ( ! empty( $related_block['title'] ) ) {
		$section_title = (string) $related_block['title'];
	}
	if ( ! empty( $related_block['services'] ) && is_array( $related_block['services'] ) ) {
		$custom_services = array_values(
			array_filter(
				array_map(
					static function ( $item ) {
						if ( ! is_array( $item ) ) {
							return null;
						}
						$title = isset( $item['title'] ) ? trim( (string) $item['title'] ) : '';
						$description = isset( $item['description'] ) ? trim( (string) $item['description'] ) : '';
						$image = isset( $item['image'] ) ? trim( (string) $item['image'] ) : '';
						$url = isset( $item['link'] ) ? trim( (string) $item['link'] ) : '';
						if ( '' === $title || '' === $description || '' === $image || '' === $url ) {
							return null;
						}
						return array(
							'title'       => $title,
							'description' => $description,
							'image'       => $image,
							'url'         => $url,
						);
					},
					$related_block['services']
				)
			)
		);
		if ( ! empty( $custom_services ) ) {
			$services = $custom_services;
		}
	}
}
$initial_visible = 2;
$total_services  = count( $services );
?>

<section class="services-block services-block--limousine">
	<div class="services-container">
		<div class="services-pill">
			<span class="services-pill-text"><?php echo esc_html( $section_pill ); ?></span>
		</div>
		<h2 class="services-title">
			<?php echo wp_kses_post( $section_title ); ?>
		</h2>

		<div class="services-grid">
			<?php foreach ( $services as $index => $service ) : ?>
				<?php $hidden_class = $index >= $initial_visible ? ' services-card--hidden' : ''; ?>
				<div class="services-card<?php echo esc_attr( $hidden_class ); ?>">
					<div class="services-card-content">
						<h3 class="services-card-title"><?php echo esc_html( $service['title'] ); ?></h3>
						<p class="services-card-description"><?php echo esc_html( $service['description'] ); ?></p>
						<a href="<?php echo esc_url( $service['url'] ); ?>" class="services-card-link"><?php echo esc_html__( 'Read more', 'gts-theme' ); ?></a>
					</div>
					<div class="services-card-image">
						<a href="<?php echo esc_url( $service['url'] ); ?>" aria-label="<?php echo esc_attr( $service['title'] ); ?>">
							<img src="<?php echo esc_url( $service['image'] ); ?>" alt="<?php echo esc_attr( $service['title'] ); ?>" class="services-image" loading="lazy" width="300" height="200">
						</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ( $total_services > $initial_visible ) : ?>
			<a href="#" class="services-show-more"><?php echo esc_html__( 'Show more services', 'gts-theme' ); ?></a>
		<?php endif; ?>
	</div>
</section>
