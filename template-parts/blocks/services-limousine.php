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
		'url'         => home_url('/services/special-transfers/'),
	),
	array(
		'title'       => __( 'City-to-City Rides', 'gts-theme' ),
		'description' => __( 'Comfortable long-distance rides across borders and regions. Luxury vehicles, experienced chauffeurs, flexible stops – your itinerary, our responsibility.', 'gts-theme' ),
		'image'       => get_site_url() . '/wp-content/uploads/2026/01/home-5-2_result.webp',
		'url'         => home_url('/city-to-city/'),
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
			<?php foreach ( $services as $service ) : ?>
				<div class="services-card">
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

		<a href="#" class="services-show-more"><?php echo esc_html__( 'Show more services', 'gts-theme' ); ?></a>
	</div>
</section>
