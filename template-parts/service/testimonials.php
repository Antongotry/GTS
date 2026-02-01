<?php

/**
 * Service Block: Testimonials Section
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

// Default values
$pill_text = ! empty($block['pill_text']) ? $block['pill_text'] : __('Testimonials', 'gts-theme');
$title     = ! empty($block['title']) ? $block['title'] : __("What our clients say", 'gts-theme');

// Get testimonials from ACF or use defaults
$testimonials = ! empty($block['testimonials']) ? $block['testimonials'] : array();

// Default testimonials
if (empty($testimonials)) {
	$testimonials = array(
		array(
			'rating' => 5,
			'text' => 'Exceptional service from start to finish. The chauffeur was punctual, professional, and the vehicle was immaculate.',
			'author' => 'Michael R.',
			'role' => 'CEO, Tech Company',
			'avatar' => '',
		),
		array(
			'rating' => 5,
			'text' => 'We use GTS for all our executive travel. Consistent quality across multiple countries — highly recommended.',
			'author' => 'Sarah L.',
			'role' => 'Travel Manager',
			'avatar' => '',
		),
		array(
			'rating' => 5,
			'text' => 'Perfect airport transfer. Driver tracked my flight and was waiting when I arrived. Seamless experience.',
			'author' => 'James K.',
			'role' => 'Business Traveler',
			'avatar' => '',
		),
	);
}
?>

<section class="testimonials-block">
	<div class="testimonials-container">
		<div class="testimonials-heading">
			<div class="testimonials-pill">
				<span class="testimonials-pill-text"><?php echo esc_html($pill_text); ?></span>
			</div>
			<h2 class="testimonials-title"><?php echo esc_html($title); ?></h2>
		</div>
		<div class="testimonials-slider swiper">
			<div class="swiper-wrapper">
				<?php foreach ($testimonials as $testimonial) :
					$rating = ! empty($testimonial['rating']) ? intval($testimonial['rating']) : 5;
					$text = ! empty($testimonial['text']) ? $testimonial['text'] : '';
					$author = ! empty($testimonial['author']) ? $testimonial['author'] : '';
					$role = ! empty($testimonial['role']) ? $testimonial['role'] : '';
					$avatar = ! empty($testimonial['avatar']) ? $testimonial['avatar'] : '';
				?>
					<div class="swiper-slide">
						<div class="testimonial-card">
							<div class="testimonial-rating">
								<?php for ($i = 1; $i <= 5; $i++) : ?>
									<span class="testimonial-star <?php echo $i <= $rating ? 'filled' : ''; ?>">★</span>
								<?php endfor; ?>
							</div>
							<p class="testimonial-text"><?php echo esc_html($text); ?></p>
							<div class="testimonial-author">
								<?php if ($avatar) : ?>
									<img src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr($author); ?>" class="testimonial-avatar" width="48" height="48" loading="lazy">
								<?php else : ?>
									<div class="testimonial-avatar testimonial-avatar--placeholder"></div>
								<?php endif; ?>
								<div class="testimonial-author-info">
									<span class="testimonial-author-name"><?php echo esc_html($author); ?></span>
									<?php if ($role) : ?>
										<span class="testimonial-author-role"><?php echo esc_html($role); ?></span>
									<?php endif; ?>
								</div>
							</div>
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
