<?php
/**
 * Template Name: City-to-City
 * Template for displaying City-to-City service page
 *
 * @package GTS
 */

get_header();
$page_id = get_queried_object_id();

$city_benefits = array(
	array(
		'icon'  => get_site_url() . '/wp-content/uploads/2026/02/city-icon-1.svg',
		'title' => 'Time is your real luxury',
		'text'  => 'Skip queues and transfers — travel door-to-door, without waiting or interruptions.',
	),
	array(
		'icon'  => get_site_url() . '/wp-content/uploads/2026/02/city-icon-2.svg',
		'title' => 'Confidence in every journey',
		'text'  => 'No crowds, delays, or cancellations — just punctual, licensed chauffeurs and global coordination.',
	),
	array(
		'icon'  => get_site_url() . '/wp-content/uploads/2026/02/city-icon-3.svg',
		'title' => 'Your schedule, your rules',
		'text'  => 'Choose departure times and stops. Plans change? We adjust instantly, 24/7.',
	),
	array(
		'icon'  => get_site_url() . '/wp-content/uploads/2026/02/city-icon-4.svg',
		'title' => 'Transparent, all-inclusive pricing',
		'text'  => 'Pay per car, not per seat. Taxes, tolls, and waiting time are always included.',
	),
	array(
		'icon'  => get_site_url() . '/wp-content/uploads/2026/02/city-icon-5.svg',
		'title' => 'Quiet comfort on every route',
		'text'  => 'Relax in a premium car with a professional chauffeur, bottled water, and Wi-Fi on request.',
	),
	array(
		'icon'  => get_site_url() . '/wp-content/uploads/2026/02/city-icon-6.svg',
		'title' => 'Flexible routes',
		'text'  => 'Stop for meetings, meals, or sightseeing anytime.',
	),
);

$page_id = get_queried_object_id();
$city_cta_pill = function_exists( 'get_field' ) ? (string) get_field( 'gts_city_cta_pill', $page_id ) : '';
$city_cta_title = function_exists( 'get_field' ) ? (string) get_field( 'gts_city_cta_title', $page_id ) : '';
$city_cta_description = function_exists( 'get_field' ) ? (string) get_field( 'gts_city_cta_description', $page_id ) : '';
$city_cta_button_text = function_exists( 'get_field' ) ? (string) get_field( 'gts_city_cta_button_text', $page_id ) : '';
$city_cta_button_link = function_exists( 'get_field' ) ? (string) get_field( 'gts_city_cta_button_link', $page_id ) : '';
$city_benefits_custom = function_exists( 'get_field' ) ? get_field( 'gts_city_cta_benefits', $page_id ) : array();

if ( is_array( $city_benefits_custom ) && ! empty( $city_benefits_custom ) ) {
	$city_benefits = $city_benefits_custom;
}
if ( '' === trim( $city_cta_pill ) ) {
	$city_cta_pill = 'Preferences';
}
if ( '' === trim( $city_cta_title ) ) {
	$city_cta_title = 'A Better Way to Travel<br>Between Cities';
}
if ( '' === trim( $city_cta_description ) ) {
	$city_cta_description = 'Airports, trains, rentals — they all take time, coordination, and patience. GTS offers a more refined way to move between cities: effortless, private, and precisely managed.';
}
if ( '' === trim( $city_cta_button_text ) ) {
	$city_cta_button_text = 'Book a transfer';
}
if ( '' === trim( $city_cta_button_link ) ) {
	$city_cta_button_link = home_url( '/book-a-transfer/' );
}
$service_cta = function_exists( 'gts_get_page_service_block' ) ? gts_get_page_service_block( 'cta', $page_id ) : array();
if ( ! empty( $service_cta ) ) {
	if ( ! empty( $service_cta['title'] ) ) {
		$city_cta_title = (string) $service_cta['title'];
	}
	if ( ! empty( $service_cta['description'] ) ) {
		$city_cta_description = (string) $service_cta['description'];
	}
	if ( ! empty( $service_cta['button_text'] ) ) {
		$city_cta_button_text = (string) $service_cta['button_text'];
	}
	if ( ! empty( $service_cta['button_link'] ) ) {
		$city_cta_button_link = (string) $service_cta['button_link'];
	}
}
?>

<main id="primary" class="site-main">

	<?php if ( gts_is_page_service_block_enabled( 'hero', true, $page_id ) ) { get_template_part( 'template-parts/blocks/hero-city-to-city-service' ); } ?>

	<?php if ( gts_is_page_service_block_enabled( 'booking_form', true, $page_id ) ) { get_template_part( 'template-parts/blocks/booking-form-limousine-service' ); } ?>

	<?php if ( gts_is_page_service_block_enabled( 'cta', true, $page_id ) ) : ?>
	<section class="final-cta-block final-cta-block--service">
		<div class="final-cta-container final-cta-container--service">
			<div class="final-cta-left final-cta-left--service">
				<div class="why-us-heading-pill final-cta-service-pill">
					<span class="why-us-heading-text"><?php echo esc_html( $city_cta_pill ); ?></span>
				</div>
				<h2 class="final-cta-title"><?php echo wp_kses_post( $city_cta_title ); ?></h2>
				<p class="final-cta-description">
					<?php echo wp_kses_post( $city_cta_description ); ?>
				</p>
				<a href="<?php echo esc_url( $city_cta_button_link ); ?>" class="btn btn-primary final-cta-button"><?php echo esc_html( $city_cta_button_text ); ?></a>
			</div>

			<div class="final-cta-right final-cta-right--desktop final-cta-right--service">
				<?php foreach ( $city_benefits as $benefit ) : ?>
					<div class="final-cta-item">
						<div class="final-cta-item-header">
							<img src="<?php echo esc_url( $benefit['icon'] ); ?>" alt="<?php echo esc_attr( $benefit['title'] ); ?>" class="final-cta-icon" width="26" height="26" loading="lazy">
							<h3 class="final-cta-item-title"><?php echo esc_html( $benefit['title'] ); ?></h3>
						</div>
						<p class="final-cta-item-description"><?php echo esc_html( $benefit['text'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( gts_is_page_service_block_enabled( 'occasions', true, $page_id ) ) { get_template_part( 'template-parts/blocks/occasions' ); } ?>

	<?php if ( gts_is_page_service_block_enabled( 'fleet', true, $page_id ) ) :
		get_template_part(
			'template-parts/blocks/fleet-slider',
			null,
			array(
				'category_slugs' => array( 'sedan-suv' ),
			)
		);
	endif;
	?>

	<?php if ( gts_is_page_service_block_enabled( 'how_it_works', true, $page_id ) ) { get_template_part( 'template-parts/blocks/how-it-works' ); } ?>

	<?php if ( gts_is_page_service_block_enabled( 'why_us', true, $page_id ) ) { get_template_part( 'template-parts/blocks/why-us' ); } ?>

		<div class="white-sections-wrapper">
			<?php if ( gts_is_page_service_block_enabled( 'testimonials', true, $page_id ) ) { get_template_part( 'template-parts/blocks/trusted-by' ); } ?>
			<?php if ( gts_is_page_service_block_enabled( 'faq', true, $page_id ) ) { get_template_part( 'template-parts/blocks/faq' ); } ?>
			<?php if ( gts_is_page_service_block_enabled( 'cta', true, $page_id ) ) { get_template_part( 'template-parts/blocks/custom-itinerary', 'limousine' ); } ?>
			<?php if ( gts_is_page_service_block_enabled( 'related_services', true, $page_id ) ) { get_template_part( 'template-parts/blocks/services', 'limousine' ); } ?>
			<?php
			$bottom_text_block = function_exists( 'gts_get_page_service_block' ) ? gts_get_page_service_block( 'bottom_text', $page_id ) : array();
			if ( ! empty( $bottom_text_block ) ) {
				get_template_part( 'template-parts/blocks/service-bottom-text', null, array( 'block' => $bottom_text_block ) );
			}
			?>
		</div>

</main><!-- #primary -->

<?php
get_footer();
