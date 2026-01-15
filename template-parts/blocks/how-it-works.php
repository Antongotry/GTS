<?php
/**
 * How It Works Block Template
 *
 * @package GTS
 */

$background_url = get_site_url() . '/wp-content/uploads/2026/01/home-3-block-banner_result-scaled.webp';
$step_icon_1 = get_site_url() . '/wp-content/uploads/2026/01/block-3-icon-1.svg';
$step_icon_2 = get_site_url() . '/wp-content/uploads/2026/01/block-3-icon-2.svg';
$step_icon_3 = get_site_url() . '/wp-content/uploads/2026/01/block-3-icon-3.svg';
$step_icon_4 = get_site_url() . '/wp-content/uploads/2026/01/block-3-icon-4.svg';

$steps = array(
	array(
		'number' => '01',
		'icon' => $step_icon_1,
		'title' => 'Book the way you prefer',
		'description' => 'Reserve instantly on our website or send a request directly to our support team.',
	),
	array(
		'number' => '02',
		'icon' => $step_icon_2,
		'title' => 'Receive confirmation',
		'description' => 'All details arrive by email — your itinerary, photo of the car, driver info and contacts.',
	),
	array(
		'number' => '03',
		'icon' => $step_icon_3,
		'title' => 'Meet your driver',
		'description' => 'Your chauffeur meets you on site and assists with arrival and coordination.',
	),
	array(
		'number' => '04',
		'icon' => $step_icon_4,
		'title' => 'Enjoy the ride',
		'description' => 'Relax in comfort while we handle timing, routes and any changes.',
	),
);
?>

<section class="how-it-works-block" style="background-image: url('<?php echo esc_url( $background_url ); ?>');">
	<div class="how-it-works-container">
		<div class="how-it-works-left">
			<div class="how-it-works-pill">
				<span class="how-it-works-pill-text"><?php echo esc_html( 'How it works' ); ?></span>
			</div>
			<h2 class="how-it-works-title">
				<?php echo wp_kses_post( 'We handle the details —<br>you enjoy the moments' ); ?>
			</h2>
		</div>
		<div class="how-it-works-right">
			<div class="how-it-works-steps">
				<?php foreach ( $steps as $step ) : ?>
					<div class="how-it-works-step">
						<div class="how-it-works-step-header">
							<h3 class="how-it-works-step-title"><?php echo esc_html( $step['title'] ); ?></h3>
							<div class="how-it-works-step-badge">
								<span class="how-it-works-step-number"><?php echo esc_html( $step['number'] ); ?></span>
								<span class="how-it-works-step-icon">
									<img src="<?php echo esc_url( $step['icon'] ); ?>" alt="" aria-hidden="true">
								</span>
							</div>
						</div>
						<p class="how-it-works-step-description"><?php echo esc_html( $step['description'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
