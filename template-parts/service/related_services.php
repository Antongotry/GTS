<?php

/**
 * Service Block: Related Services Section
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

// Default values
$pill_text = ! empty($block['pill_text']) ? $block['pill_text'] : __('Related Services', 'gts-theme');
$title     = ! empty($block['title']) ? $block['title'] : __("Explore our other services", 'gts-theme');

// Get services from ACF or auto-fetch related services
$services = ! empty($block['services']) ? $block['services'] : array();

// If no services set, get other services from the CPT (excluding current)
if (empty($services)) {
	$current_id = get_the_ID();
	$args_query = array(
		'post_type'      => 'service',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
		'post__not_in'   => array($current_id),
	);
	$related_posts = get_posts($args_query);

	foreach ($related_posts as $post) {
		$services[] = array(
			'title' => $post->post_title,
			'description' => wp_trim_words($post->post_excerpt, 15, '...'),
			'link' => get_permalink($post->ID),
			'image' => get_the_post_thumbnail_url($post->ID, 'medium'),
		);
	}
}

// Return if no services
if (empty($services)) {
	return;
}
?>

<section class="related-services-block">
	<div class="related-services-container">
		<div class="related-services-heading">
			<div class="related-services-pill">
				<span class="related-services-pill-text"><?php echo esc_html($pill_text); ?></span>
			</div>
			<h2 class="related-services-title"><?php echo esc_html($title); ?></h2>
		</div>
		<div class="related-services-grid">
			<?php foreach ($services as $service) :
				$service_title = ! empty($service['title']) ? $service['title'] : '';
				$service_desc = ! empty($service['description']) ? $service['description'] : '';
				$service_link = ! empty($service['link']) ? $service['link'] : '#';
				$service_image = ! empty($service['image']) ? $service['image'] : '';
			?>
				<div class="related-services-card">
					<a href="<?php echo esc_url($service_link); ?>" class="related-services-card-link">
						<?php if ($service_image) : ?>
							<div class="related-services-card-image-wrapper">
								<img src="<?php echo esc_url($service_image); ?>" alt="<?php echo esc_attr($service_title); ?>" class="related-services-card-image" loading="lazy">
							</div>
						<?php endif; ?>
						<div class="related-services-card-content">
							<h3 class="related-services-card-title"><?php echo esc_html($service_title); ?></h3>
							<?php if ($service_desc) : ?>
								<p class="related-services-card-description"><?php echo esc_html($service_desc); ?></p>
							<?php endif; ?>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
