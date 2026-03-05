<?php

/**
 * Fleet Slider Block Template
 *
 * @package GTS
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$args = isset( $args ) && is_array( $args ) ? $args : array();
$fleet_block = array();
if ( function_exists( 'gts_is_service_style_page' ) && gts_is_service_style_page() && function_exists( 'gts_get_page_service_block' ) ) {
	$fleet_block = gts_get_page_service_block( 'fleet' );
}

if ( ! empty( $fleet_block ) ) {
	if ( ! empty( $fleet_block['title'] ) && empty( $args['title'] ) ) {
		$args['title'] = (string) $fleet_block['title'];
	}
	if ( ! empty( $fleet_block['subtitle'] ) && empty( $args['lead'] ) ) {
		$args['lead'] = (string) $fleet_block['subtitle'];
	}
	if ( ! empty( $fleet_block['pill_text'] ) && empty( $args['pill_text'] ) ) {
		$args['pill_text'] = (string) $fleet_block['pill_text'];
	}
}

$current_service_slug = '';
if ( is_singular( 'service' ) ) {
	$current_service_slug = (string) get_post_field( 'post_name', get_the_ID() );
}

// Private Tours: keep a stable default copy, but let admin fields override it.
if ( 'private-tours' === $current_service_slug ) {
	if ( empty( $args['title'] ) ) {
		$args['title'] = 'Every detail matters on a private journey — from vehicle comfort to the chauffeur’s experience.';
	}
	if ( empty( $args['lead'] ) ) {
		$args['lead'] = 'Every GTS car meets high standards of safety, comfort, and presentation for a smooth, relaxed ride.';
	}
}

$query_args = array(
	'status'  => 'publish',
	'limit'   => 20,
	'orderby' => 'menu_order',
	'order'   => 'ASC',
);

if ( ! empty( $args['category_slugs'] ) && is_array( $args['category_slugs'] ) ) {
	$query_args['category'] = array_values(
		array_filter(
			array_map( 'sanitize_title', $args['category_slugs'] )
		)
	);
}

if ( ! empty( $fleet_block['vehicles'] ) && is_array( $fleet_block['vehicles'] ) ) {
	$vehicle_ids = array_values( array_filter( array_map( 'absint', $fleet_block['vehicles'] ) ) );
	if ( ! empty( $vehicle_ids ) ) {
		$query_args['include'] = $vehicle_ids;
		$query_args['orderby'] = 'post__in';
		$query_args['limit'] = count( $vehicle_ids );
		unset( $query_args['category'] );
	}
}

$products = wc_get_products( $query_args );

if ( empty( $products ) ) {
	return;
}

$title = ! empty( $args['title'] ) ? $args['title'] : 'Every detail matters – from the car you travel in to the person behind the wheel';
$lead  = ! empty( $args['lead'] ) ? $args['lead'] : 'That’s why every GTS limousine meets strict standards of comfort, safety, and presentation.';
$hide_lead = ! empty( $args['hide_lead'] );
$section_mod = ! empty( $args['section_modifier'] ) ? sanitize_html_class( (string) $args['section_modifier'] ) : '';
$section_class = 'fleet-slider-block' . ( $section_mod ? ' ' . $section_mod : '' );
$pill_text = ! empty( $args['pill_text'] ) ? $args['pill_text'] : 'Fleet & Chauffeurs';
?>

<section class="<?php echo esc_attr( $section_class ); ?>">
	<div class="fleet-slider-grid">
		<div class="fleet-slider-container">
			<div class="why-us-heading">
				<div class="why-us-heading-pill">
					<span class="why-us-heading-text"><?php echo esc_html( $pill_text ); ?></span>
				</div>
				<div class="why-us-heading-line" aria-hidden="true"></div>
			</div>

			<div class="fleet-slider-title-row">
				<h2 class="fleet-slider-title">
					<?php echo wp_kses( $title, array( 'br' => array() ) ); ?>
				</h2>
				<?php if ( ! $hide_lead ) : ?>
					<p class="fleet-slider-lead">
						<?php echo wp_kses( $lead, array( 'br' => array() ) ); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>

		<div class="fleet-slider-wrapper">
			<div class="fleet-slider swiper">
				<div class="swiper-wrapper">
				<?php foreach ( $products as $product ) : ?>
					<?php
					get_template_part(
						'template-parts/parts/fleet-card',
						null,
						array(
							'product' => $product,
						)
					);
					?>
				<?php endforeach; ?>
			</div>
			</div>
			<?php echo gts_nav_arrows( 'fleet-slider-prev', 'fleet-slider-next', 'Previous vehicle', 'Next vehicle' ); ?>
		</div>

		<div class="fleet-slider-footer">
			<a class="fleet-slider-all-link" href="<?php echo esc_url( home_url( '/fleet/' ) ); ?>">
				<?php echo esc_html__( 'See all fleet', 'gts-theme' ); ?>
			</a>
		</div>
	</div>

	<?php /* Modals injected by JS on open, removed on close — not in initial DOM */ ?>
</section>
