<?php

/**
 * Service Block: Testimonials Section
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

$pill_text    = ! empty($block['pill_text']) ? $block['pill_text'] : __('Trusted by clients worldwide', 'gts-theme');
$title        = ! empty($block['title']) ? $block['title'] : '';
$testimonials = ! empty($block['testimonials']) ? $block['testimonials'] : array();

if (empty($testimonials)) {
	return;
}

// Heights cycle for testimonial cards
$heights = array(348, 326, 392);
?>

<section class="trusted-by-block">
	<div class="trusted-by-container">
		<div class="trusted-by-pill">
			<span class="trusted-by-pill-text"><?php echo esc_html($pill_text); ?></span>
		</div>
		<?php if ($title) : ?>
			<h2 class="trusted-by-title"><?php echo esc_html($title); ?></h2>
		<?php endif; ?>
	</div>

	<div class="trusted-by-slider swiper">
		<div class="swiper-wrapper">
			<?php foreach ($testimonials as $index => $testimonial) :
				$text          = ! empty($testimonial['text']) ? $testimonial['text'] : '';
				$author_name   = ! empty($testimonial['author_name']) ? $testimonial['author_name'] : '';
				$author_avatar = ! empty($testimonial['author_avatar']) ? $testimonial['author_avatar'] : get_site_url() . '/wp-content/uploads/2026/01/rewievs-ic_result.webp';
				$rating        = ! empty($testimonial['rating']) ? intval($testimonial['rating']) : 5;
				$card_height   = $heights[$index % count($heights)];
			?>
				<div class="swiper-slide trusted-by-card" style="height: <?php echo esc_attr($card_height); ?>px;">
					<div class="trusted-by-card-content">
						<div class="trusted-by-stars">
							<?php for ($i = 0; $i < $rating; $i++) : ?>
								<span class="trusted-by-star">★</span>
							<?php endfor; ?>
						</div>
						<?php if ($text) : ?>
							<p class="trusted-by-card-text"><?php echo esc_html($text); ?></p>
						<?php endif; ?>
					</div>
					<div class="trusted-by-author">
						<img src="<?php echo esc_url($author_avatar); ?>" alt="" class="trusted-by-avatar" width="56" height="56" loading="lazy">
						<?php if ($author_name) : ?>
							<span class="trusted-by-name"><?php echo esc_html($author_name); ?></span>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="trusted-by-container">
		<?php echo gts_nav_arrows('trusted-by-prev', 'trusted-by-next'); ?>
	</div>
</section>
