<?php

/**
 * Service Block: Related Services Section
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

$pill_text = ! empty($block['pill_text']) ? $block['pill_text'] : '';
$title     = ! empty($block['title']) ? $block['title'] : '';
$services  = ! empty($block['services']) ? $block['services'] : array();

if (empty($services)) {
	return;
}
?>

<section class="services-block services-block--limousine">
	<div class="services-container">
		<?php if ($pill_text) : ?>
			<div class="services-pill">
				<span class="services-pill-text"><?php echo esc_html($pill_text); ?></span>
			</div>
		<?php endif; ?>

		<?php if ($title) : ?>
			<h2 class="services-title"><?php echo wp_kses_post($title); ?></h2>
		<?php endif; ?>

		<div class="services-grid">
			<?php foreach ($services as $service) :
				$service_title = ! empty($service['title']) ? $service['title'] : '';
				$service_desc  = ! empty($service['description']) ? $service['description'] : '';
				$service_image = ! empty($service['image']) ? $service['image'] : '';
				$service_link  = ! empty($service['link']) ? $service['link'] : '#';
			?>
				<div class="services-card">
					<div class="services-card-content">
						<?php if ($service_title) : ?>
							<h3 class="services-card-title"><?php echo esc_html($service_title); ?></h3>
						<?php endif; ?>
						<?php if ($service_desc) : ?>
							<p class="services-card-description"><?php echo esc_html($service_desc); ?></p>
						<?php endif; ?>
						<a href="<?php echo esc_url($service_link); ?>" class="services-card-link"><?php esc_html_e('Read more', 'gts-theme'); ?></a>
					</div>
					<?php if ($service_image) : ?>
						<div class="services-card-image">
							<img src="<?php echo esc_url($service_image); ?>" alt="<?php echo esc_attr($service_title); ?>" class="services-image" loading="lazy" width="300" height="200">
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>

		<a href="<?php echo esc_url(home_url('/services/')); ?>" class="services-show-more"><?php esc_html_e('Show more services', 'gts-theme'); ?></a>
	</div>
</section>
