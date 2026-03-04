<?php
/**
 * Services Block Template
 *
 * @package GTS
 */

$services = array(
	array(
		'title'       => 'Luxury Wedding & Event Chauffeur Service',
		'description' => 'From elegant bridal arrivals to seamless guest transfers — GTS ensures your celebration runs perfectly on time and in perfect style.',
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-1_result.webp',
		'url'         => home_url('/services/wedding/'),
	),
	array(
		'title'       => 'Cultural & Sport Events Chauffeur Service',
		'description' => 'Seamless VIP chauffeur service for sports, cultural, and corporate events — available in 100+ countries. From tournaments to galas, GTS ensures every guest arrives on time and with ease.',
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-2_result.webp',
		'url'         => home_url('/services/cultural-sport-events/'),
	),
	array(
		'title'       => 'Family Travel Chauffeur Service',
		'description' => 'Premium comfort and safety for every generation. From airport pickups to family getaways — GTS ensures smooth, secure, and perfectly coordinated travel for you and your loved ones.',
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-3_result.webp',
		'url'         => home_url('/services/family-travel-chauffeur-service/'),
	),
	array(
		'title'       => 'Medical Transportation',
		'description' => 'Coordinated travel for patients and medical delegations. Equipped vehicles, professional care, and assistance from pick-up to hospital arrival.',
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-4_result.webp',
		'url'         => home_url('/services/medical-transportation/'),
	),
	array(
		'title'       => 'Travel Personal Interpreter',
		'description' => 'Certified interpreters accompanying you during business meetings, negotiations, or tours. Available in major languages and coordinated with your schedule.',
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-5_result.webp',
		'url'         => home_url('/services/travel-personal-interpreter/'),
	),
	array(
		'title'       => 'Travel Planning',
		'description' => 'Complete itinerary creation — from transfers to flights, accommodations, and route timing. Our planners ensure everything runs like clockwork.',
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-6_result.webp',
		'url'         => home_url('/services/travel-planninig/'),
	),
	array(
		'title'       => 'Shopping Chauffeur Service',
		'description' => 'From luxury boutiques to private showrooms, GTS ensures seamless movement and discreet comfort — wherever you shop. Shopping should be a pleasure, not a schedule.',
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-7_result.webp',
		'url'         => home_url('/services/shoping/'),
	),
	array(
		'title'       => 'Corporate Events Chauffeur Service',
		'description' => 'From executive conferences and corporate meetings to product launches and gala receptions, GTS ensures every arrival, transfer, and departure runs exactly as planned — quietly, professionally, and on time.',
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-8_result.webp',
		'url'         => home_url('/services/corporate-events-chauffeur-service/'),
	),
	array(
		'title'       => 'Private Tours Chauffeur Service',
		'description' => 'From iconic landmarks to hidden destinations, GTS designs private chauffeur tours around your interests, pace, and itinerary — with seamless transfers, professional drivers, and complete flexibility throughout the journey.',
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-9_result.webp',
		'url'         => home_url('/services/private-tours/'),
	),
	array(
		'title'       => 'Travel Agencies',
		'description' => 'Reliable ground transportation partner for agencies and DMCs. Instant confirmations, transparent rates, 24/7 coordination, and seamless integration with your client itineraries.',
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-10_result.webp',
		'url'         => home_url('/services/travel-agencies/'),
	),
	array(
		'title'       => 'Mobility Partnerships',
		'description' => 'Long-term cooperation for hospitality, aviation, hotels and event industries. From VIP airport transfers to full guest logistics — seamlessly integrated with your brand and standards.',
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-11_result.webp',
		'url'         => home_url('/services/mobility-partnership/'),
	),
	array(
		'title'       => 'Airport Transfers for Events',
		'description' => 'GTS provides event airport transfers with precise scheduling and coordinated execution — ensuring smooth arrivals and departures for all guests.',
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-12_result.webp',
		'url'         => home_url('/services/airport-transfer-service/'),
	),
	array(
		'title'       => 'Chauffeur & Mobility Solutions for Corporations',
		'description' => 'GTS provides chauffeur and mobility solutions for corporations that need consistent, well-managed transportation across executive travel and ongoing operations.',
		'image'       => get_site_url() . '/wp-content/uploads/2026/03/servnew-13_result.webp',
		'url'         => home_url('/services/corporations/'),
	),
);
$initial_visible = 6;
$total_services  = count( $services );
?>

<section class="services-block">
	<div class="services-container">
		<div class="services-pill">
			<span class="services-pill-text"><?php echo esc_html( 'Every journey, perfectly organized.' ); ?></span>
		</div>
		<h2 class="services-title">
			<?php echo wp_kses_post( 'From executive roadshows to private celebrations —<br>GTS provides end-to-end transport solutions worldwide.' ); ?>
		</h2>

		<div class="services-grid">
			<?php foreach ( $services as $index => $service ) : ?>
				<?php $hidden_class = $index >= $initial_visible ? ' services-card--hidden' : ''; ?>
				<div class="services-card<?php echo esc_attr( $hidden_class ); ?>">
					<div class="services-card-content">
						<h3 class="services-card-title"><?php echo esc_html( $service['title'] ); ?></h3>
						<p class="services-card-description"><?php echo esc_html( $service['description'] ); ?></p>
						<a href="<?php echo esc_url( $service['url'] ); ?>" class="services-card-link">Read more</a>
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
			<a href="#" class="services-show-more">Show more services</a>
		<?php endif; ?>
	</div>
</section>
