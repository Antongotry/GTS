<?php

/**
 * Service Block: Fleet Section
 *
 * Displays vehicle slider with per-service selection via ACF relationship field
 * Falls back to all WooCommerce products if none selected
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

// Default values
$pill_text = ! empty($block['pill_text']) ? $block['pill_text'] : __('Our Fleet', 'gts-theme');
$title     = ! empty($block['title']) ? $block['title'] : __("Choose your vehicle", 'gts-theme');
$subtitle  = ! empty($block['subtitle']) ? $block['subtitle'] : '';

// Get selected vehicles from ACF relationship field or fallback to all products
$selected_vehicles = ! empty($block['vehicles']) ? $block['vehicles'] : array();

// If no vehicles selected via ACF, get all WooCommerce products
if (empty($selected_vehicles) && class_exists('WooCommerce')) {
	$args_query = array(
		'post_type'      => 'product',
		'posts_per_page' => 12,
		'post_status'    => 'publish',
	);
	$products = get_posts($args_query);
	$selected_vehicles = $products;
}

// Check if we have vehicles
if (empty($selected_vehicles)) {
	return;
}
?>

<section class="fleet-block">
	<div class="fleet-container">
		<div class="fleet-heading">
			<div class="fleet-pill">
				<span class="fleet-pill-text"><?php echo esc_html($pill_text); ?></span>
			</div>
			<h2 class="fleet-title"><?php echo esc_html($title); ?></h2>
			<?php if ($subtitle) : ?>
				<p class="fleet-subtitle"><?php echo esc_html($subtitle); ?></p>
			<?php endif; ?>
		</div>
		<div class="fleet-slider swiper">
			<div class="swiper-wrapper">
				<?php
				foreach ($selected_vehicles as $vehicle) :
					// Handle both WP_Post objects and post IDs
					$vehicle_id = is_object($vehicle) ? $vehicle->ID : $vehicle;
					$vehicle_post = is_object($vehicle) ? $vehicle : get_post($vehicle_id);

					if (!$vehicle_post) continue;

					$vehicle_title = $vehicle_post->post_title;
					$vehicle_link = get_permalink($vehicle_id);
					$vehicle_image = get_the_post_thumbnail_url($vehicle_id, 'large');

					// Get WooCommerce product data if available
					$passengers = '';
					$luggage = '';
					if (class_exists('WC_Product')) {
						$product = wc_get_product($vehicle_id);
						if ($product) {
							// Try to get custom attributes
							$passengers = $product->get_attribute('passengers');
							$luggage = $product->get_attribute('luggage');
						}
					}
				?>
					<div class="swiper-slide">
						<div class="fleet-card">
							<a href="<?php echo esc_url($vehicle_link); ?>" class="fleet-card-link">
								<?php if ($vehicle_image) : ?>
									<img src="<?php echo esc_url($vehicle_image); ?>" alt="<?php echo esc_attr($vehicle_title); ?>" class="fleet-card-image" loading="lazy">
								<?php endif; ?>
								<h3 class="fleet-card-title"><?php echo esc_html($vehicle_title); ?></h3>
								<div class="fleet-card-meta">
									<?php if ($passengers) : ?>
										<span class="fleet-card-passengers">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
												<path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
											</svg>
											<?php echo esc_html($passengers); ?>
										</span>
									<?php endif; ?>
									<?php if ($luggage) : ?>
										<span class="fleet-card-luggage">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
												<path d="M17 6h-2V3c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v3H7c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2 0 .55.45 1 1 1s1-.45 1-1h6c0 .55.45 1 1 1s1-.45 1-1c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM10 3h4v3h-4V3z" />
											</svg>
											<?php echo esc_html($luggage); ?>
										</span>
									<?php endif; ?>
								</div>
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="swiper-pagination"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
	</div>
</section>
