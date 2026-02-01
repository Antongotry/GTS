<?php

/**
 * Service Block: How It Works Section
 *
 * Matches the exact structure of the original how-it-works.php template
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

// Default values
$site_url = get_site_url();
$default_background = $site_url . '/wp-content/uploads/2026/01/home-3-block-banner_result-scaled.webp';
$default_icon_1 = $site_url . '/wp-content/uploads/2026/01/block-3-icon-1.svg';
$default_icon_2 = $site_url . '/wp-content/uploads/2026/01/block-3-icon-2.svg';
$default_icon_3 = $site_url . '/wp-content/uploads/2026/01/block-3-icon-3.svg';
$default_icon_4 = $site_url . '/wp-content/uploads/2026/01/block-3-icon-4.svg';

// Extract fields with defaults
$pill_text  = ! empty($block['pill_text']) ? $block['pill_text'] : __('How it works', 'gts-theme');
$title      = ! empty($block['title']) ? $block['title'] : __('We handle the details —<br>you enjoy the moments', 'gts-theme');
$background = ! empty($block['background']) ? $block['background'] : $default_background;
$steps      = ! empty($block['steps']) ? $block['steps'] : array();

// If no steps, use default structure matching original template
if (empty($steps)) {
	$steps = array(
		array(
			'number' => '01',
			'icon' => $default_icon_1,
			'title' => 'Book the way<br>you prefer',
			'description' => 'Reserve instantly on our website or send a<br>request directly to our support team.',
		),
		array(
			'number' => '02',
			'icon' => $default_icon_2,
			'title' => 'Receive confirmation',
			'description' => 'All details arrive by email — your itinerary, photo of the<br>car, driver info and contacts.',
		),
		array(
			'number' => '03',
			'icon' => $default_icon_3,
			'title' => 'Meet your driver',
			'description' => 'A professional chauffeur arrives on time, helps<br>with luggage and ensures comfort.',
		),
		array(
			'number' => '04',
			'icon' => $default_icon_4,
			'title' => 'Travel with<br>confidence',
			'description' => 'Transparent pricing, insured rides and real<br>24/7 assistance worldwide.',
		),
	);
}
?>

<section class="how-it-works-block" style="background-image: url('<?php echo esc_url($background); ?>');">
	<div class="how-it-works-container">
		<div class="how-it-works-left">
			<div class="how-it-works-pill">
				<span class="how-it-works-pill-text"><?php echo esc_html($pill_text); ?></span>
			</div>
			<h2 class="how-it-works-title">
				<?php echo wp_kses_post($title); ?>
			</h2>
		</div>
		<div class="how-it-works-right">
			<div class="how-it-works-steps">
				<?php foreach ($steps as $step) :
					$step_number = ! empty($step['number']) ? $step['number'] : '';
					$step_icon = ! empty($step['icon']) ? $step['icon'] : '';
					$step_title = ! empty($step['title']) ? $step['title'] : '';
					$step_description = ! empty($step['description']) ? $step['description'] : '';
				?>
					<div class="how-it-works-step">
						<div class="how-it-works-step-header">
							<h3 class="how-it-works-step-title"><?php echo wp_kses_post($step_title); ?></h3>
							<div class="how-it-works-step-badge">
								<span class="how-it-works-step-number"><?php echo esc_html($step_number); ?></span>
								<span class="how-it-works-step-icon">
									<img src="<?php echo esc_url($step_icon); ?>" alt="" aria-hidden="true" loading="lazy" width="24" height="24">
								</span>
							</div>
						</div>
						<p class="how-it-works-step-description"><?php echo wp_kses_post($step_description); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
