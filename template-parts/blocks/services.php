<?php
/**
 * Services Block Template
 *
 * @package GTS
 */

$services = array(
	array(
		'title' => 'Book a Flight',
		'description' => 'Private aviation coordination with trusted partners worldwide. Helicopters, charter jets, or business flights – synchronized with ground transport for smooth connections.',
		'image' => get_site_url() . '/wp-content/uploads/2026/01/home-5-1_result.webp',
	),
	array(
		'title' => 'City-to-City Rides',
		'description' => 'Comfortable long-distance rides across borders and regions. Luxury vehicles, experienced chauffeurs, flexible stops – your itinerary, our responsibility.',
		'image' => get_site_url() . '/wp-content/uploads/2026/01/home-5-2_result.webp',
	),
	array(
		'title' => 'Airport Transfers',
		'description' => 'Meet-and-greet service, flight tracking, luggage assistance, and smooth arrivals at any airport worldwide.',
		'image' => get_site_url() . '/wp-content/uploads/2026/01/home-5-3_result.webp',
	),
	array(
		'title' => 'Hourly Hire',
		'description' => 'Your personal driver – whenever and wherever you need. Ideal for business meetings, events or day-to-day mobility with total flexibility.',
		'image' => get_site_url() . '/wp-content/uploads/2026/01/home-5-4_result.webp',
	),
	array(
		'title' => 'Chauffeur Service',
		'description' => 'Personal chauffeur service for executives and private clients. Discreet, multilingual, impeccably trained professionals ensuring comfort, safety, and style.',
		'image' => get_site_url() . '/wp-content/uploads/2026/01/home-5-5_result.webp',
	),
	array(
		'title' => 'Limousine Service',
		'description' => 'Luxury sedans and limousines for high-profile travel. Ideal for official visits, ceremonies, or special occasions – elegance without compromise.',
		'image' => get_site_url() . '/wp-content/uploads/2026/01/home-5-6_result.webp',
	),
);
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
			<?php foreach ( $services as $service ) : ?>
				<div class="services-card">
					<div class="services-card-content">
						<h3 class="services-card-title"><?php echo esc_html( $service['title'] ); ?></h3>
						<p class="services-card-description"><?php echo esc_html( $service['description'] ); ?></p>
						<a href="#" class="services-card-link">Read more</a>
					</div>
					<div class="services-card-image">
						<img src="<?php echo esc_url( $service['image'] ); ?>" alt="<?php echo esc_attr( $service['title'] ); ?>" class="services-image" loading="lazy" width="300" height="200">
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<a href="#" class="services-show-more">Show more services</a>
	</div>
</section>
