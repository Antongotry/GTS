<?php
/**
 * Services Block — вариант для страницы Limousine Service (только 2 карточки + Show more)
 *
 * @package GTS
 */

$services = array(
	array(
		'title'       => __( 'Book a Flight', 'gts-theme' ),
		'description' => __( 'Private aviation coordination with trusted partners worldwide. Helicopters, charter jets, or business flights – synchronized with ground transport for smooth connections.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/01/home-5-1_result.webp',
	),
	array(
		'title'       => __( 'City-to-City Rides', 'gts-theme' ),
		'description' => __( 'Comfortable long-distance rides across borders and regions. Luxury vehicles, experienced chauffeurs, flexible stops – your itinerary, our responsibility.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/01/home-5-2_result.webp',
	),
);
?>

<section class="services-block services-block--limousine">
	<div class="services-container">
		<div class="services-pill">
			<span class="services-pill-text"><?php echo esc_html__( 'Every journey, perfectly organized.', 'gts-theme' ); ?></span>
		</div>
		<h2 class="services-title">
			<?php echo wp_kses_post( __( 'From executive roadshows to private celebrations —<br>GTS provides end-to-end transport solutions worldwide.', 'gts-theme' ) ); ?>
		</h2>

		<div class="services-grid">
			<?php foreach ( $services as $service ) : ?>
				<div class="services-card">
					<div class="services-card-content">
						<h3 class="services-card-title"><?php echo esc_html( $service['title'] ); ?></h3>
						<p class="services-card-description"><?php echo esc_html( $service['description'] ); ?></p>
						<a href="#" class="services-card-link"><?php echo esc_html__( 'Read more', 'gts-theme' ); ?></a>
					</div>
					<div class="services-card-image">
						<img src="<?php echo esc_url( $service['image'] ); ?>" alt="<?php echo esc_attr( $service['title'] ); ?>" class="services-image" loading="lazy" width="300" height="200">
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<a href="#" class="services-show-more"><?php echo esc_html__( 'Show more services', 'gts-theme' ); ?></a>
	</div>
</section>
