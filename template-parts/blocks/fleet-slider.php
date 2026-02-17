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

$products = wc_get_products( $query_args );

if ( empty( $products ) ) {
	return;
}

$title = ! empty( $args['title'] ) ? $args['title'] : 'Every detail matters – from the car you travel in to the person behind the wheel';
$lead  = ! empty( $args['lead'] ) ? $args['lead'] : 'That’s why every GTS limousine meets strict standards of comfort, safety, and presentation.';
?>

<section class="fleet-slider-block">
	<div class="fleet-slider-grid">
		<div class="fleet-slider-container">
			<div class="why-us-heading">
				<div class="why-us-heading-pill">
					<span class="why-us-heading-text"><?php echo esc_html__( 'Fleet & Chauffeurs', 'gts-theme' ); ?></span>
				</div>
				<div class="why-us-heading-line" aria-hidden="true"></div>
			</div>

			<div class="fleet-slider-title-row">
			<h2 class="fleet-slider-title">
				<?php echo esc_html( $title ); ?>
			</h2>
			<p class="fleet-slider-lead">
				<?php echo esc_html( $lead ); ?>
			</p>
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
	</div>

	<?php /* Modals injected by JS on open, removed on close — not in initial DOM */ ?>
</section>
