<?php

/**
 * Service Block: How It Works Section
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

$pill_text  = ! empty($block['pill_text']) ? $block['pill_text'] : __('How it works', 'gts-theme');
$title      = ! empty($block['title']) ? $block['title'] : '';
$background = ! empty($block['background']) ? $block['background'] : get_site_url() . '/wp-content/uploads/2026/01/home-3-block-banner_result-scaled.webp';
$steps      = ! empty($block['steps']) ? $block['steps'] : array();

if (empty($steps)) {
	return;
}
?>

<section class="how-it-works-block" style="background-image: url('<?php echo esc_url($background); ?>');">
	<div class="how-it-works-container">
		<div class="how-it-works-left">
			<div class="how-it-works-pill">
				<span class="how-it-works-pill-text"><?php echo esc_html($pill_text); ?></span>
			</div>
			<?php if ($title) : ?>
				<h2 class="how-it-works-title"><?php echo wp_kses_post($title); ?></h2>
			<?php endif; ?>
		</div>
		<div class="how-it-works-right">
			<div class="how-it-works-steps">
				<?php foreach ($steps as $step) :
					$step_number = ! empty($step['number']) ? $step['number'] : '';
					$step_icon   = ! empty($step['icon']) ? $step['icon'] : '';
					$step_title  = ! empty($step['title']) ? $step['title'] : '';
					$step_desc   = ! empty($step['description']) ? $step['description'] : '';
				?>
					<div class="how-it-works-step">
						<div class="how-it-works-step-header">
							<?php if ($step_title) : ?>
								<h3 class="how-it-works-step-title"><?php echo wp_kses_post($step_title); ?></h3>
							<?php endif; ?>
							<div class="how-it-works-step-badge">
								<?php if ($step_number) : ?>
									<span class="how-it-works-step-number"><?php echo esc_html($step_number); ?></span>
								<?php endif; ?>
								<?php if ($step_icon) : ?>
									<span class="how-it-works-step-icon">
										<img src="<?php echo esc_url($step_icon); ?>" alt="" aria-hidden="true" loading="lazy" width="24" height="24">
									</span>
								<?php endif; ?>
							</div>
						</div>
						<?php if ($step_desc) : ?>
							<p class="how-it-works-step-description"><?php echo wp_kses_post($step_desc); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
