<?php

/**
 * Service Block: Fleet/Vehicles Slider
 *
 * Displays vehicles selected for this service, or all products if none selected.
 *
 * @package GTS
 */

if (! class_exists('WooCommerce')) {
	return;
}

$block = isset($args['block']) ? $args['block'] : array();

$pill_text        = ! empty($block['pill_text']) ? $block['pill_text'] : __('Fleet & Chauffeurs', 'gts-theme');
$title            = ! empty($block['title']) ? $block['title'] : '';
$subtitle         = ! empty($block['subtitle']) ? $block['subtitle'] : '';
$selected_vehicle_ids = ! empty($block['vehicles']) ? $block['vehicles'] : array();

// Get products - either selected ones or all
if (! empty($selected_vehicle_ids)) {
	$products = wc_get_products(
		array(
			'status'  => 'publish',
			'include' => $selected_vehicle_ids,
			'limit'   => 20,
			'orderby' => 'menu_order',
			'order'   => 'ASC',
		)
	);
} else {
	// No vehicles selected - show all
	$products = wc_get_products(
		array(
			'status'  => 'publish',
			'limit'   => 10,
			'orderby' => 'menu_order',
			'order'   => 'ASC',
		)
	);
}

if (empty($products)) {
	return;
}
?>

<section class="fleet-slider-block">
	<div class="fleet-slider-grid">
		<div class="fleet-slider-container">
			<div class="why-us-heading">
				<div class="why-us-heading-pill">
					<span class="why-us-heading-text"><?php echo esc_html($pill_text); ?></span>
				</div>
				<div class="why-us-heading-line" aria-hidden="true"></div>
			</div>

			<div class="fleet-slider-title-row">
				<?php if ($title) : ?>
					<h2 class="fleet-slider-title"><?php echo esc_html($title); ?></h2>
				<?php endif; ?>
				<?php if ($subtitle) : ?>
					<p class="fleet-slider-lead"><?php echo esc_html($subtitle); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<div class="fleet-slider-wrapper">
			<div class="fleet-slider swiper">
				<div class="swiper-wrapper">
					<?php foreach ($products as $product) : ?>
						<?php
						get_template_part(
							'template-parts/parts/fleet-card',
							null,
							array('product' => $product)
						);
						?>
					<?php endforeach; ?>
				</div>
			</div>
			<?php echo gts_nav_arrows('fleet-slider-prev', 'fleet-slider-next', 'Previous vehicle', 'Next vehicle'); ?>
		</div>
	</div>
</section>
