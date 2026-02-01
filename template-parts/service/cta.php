<?php

/**
 * Service Block: CTA Section
 *
 * Matches the exact structure of the original final-cta.php template
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

// Default values
$site_url = get_site_url();
$default_background = $site_url . '/wp-content/uploads/2026/01/last-banner-home_result-scaled.webp';
$default_icon_1 = $site_url . '/wp-content/uploads/2026/01/last-i-1.svg';
$default_icon_2 = $site_url . '/wp-content/uploads/2026/01/last-i-2.svg';
$default_icon_3 = $site_url . '/wp-content/uploads/2026/01/last-i-3.svg';
$default_icon_4 = $site_url . '/wp-content/uploads/2026/01/last-i-4.svg';
$default_icon_5 = $site_url . '/wp-content/uploads/2026/01/last-i-5.svg';

// Extract fields with defaults
$title       = ! empty($block['title']) ? $block['title'] : __('Most transfer<br>companies offer cars.', 'gts-theme');
$description = ! empty($block['description']) ? $block['description'] : __('We offer peace of mind — through control,<br>consistency, and a truly global standard.', 'gts-theme');
$button_text = ! empty($block['button_text']) ? $block['button_text'] : __('Book a transfer', 'gts-theme');
$button_link = ! empty($block['button_link']) ? $block['button_link'] : '#';
$background  = ! empty($block['background']) ? $block['background'] : $default_background;
$items       = ! empty($block['items']) ? $block['items'] : array();

// Default items matching original template
if (empty($items)) {
	$items = array(
		array('icon' => $default_icon_1, 'title' => 'Precision logistics', 'description' => 'Every transfer is planned with accuracy — routes, timing, and coordination handled<br>seamlessly, no matter the complexity.'),
		array('icon' => $default_icon_2, 'title' => 'Human-first service', 'description' => 'Behind every booking is a personal coordinator who knows your preferences and<br>ensures everything runs to plan.', 'extra' => 'Technology supports the process — people create the experience.'),
		array('icon' => $default_icon_3, 'title' => 'Consistency across the globe', 'description' => 'The same GTS standard in every destination — from major capitals to remote<br>regions. One global system, one quality of service.'),
		array('icon' => $default_icon_4, 'title' => 'True premium fleet', 'description' => 'Business, premium and VIP-class vehicles, regularly renewed and immaculately<br>maintained.'),
		array('icon' => $default_icon_5, 'title' => 'Tailored logistics', 'description' => 'No templates — every trip is planned to match your timing, priorities and comfort<br>preferences. From a single airport pickup to a week-long corporate tour.'),
	);
}
?>

<section class="final-cta-block" style="background-image: url('<?php echo esc_url($background); ?>');">
	<div class="final-cta-container">
		<div class="final-cta-left">
			<h2 class="final-cta-title"><?php echo wp_kses_post($title); ?></h2>
			<p class="final-cta-description">
				<?php echo wp_kses_post($description); ?>
			</p>
			<a href="<?php echo esc_url($button_link); ?>" class="btn btn-primary final-cta-button"><?php echo esc_html($button_text); ?></a>
		</div>
		<div class="final-cta-right final-cta-right--desktop">
			<?php foreach ($items as $item) :
				$item_icon = ! empty($item['icon']) ? $item['icon'] : '';
				$item_title = ! empty($item['title']) ? $item['title'] : '';
				$item_desc = ! empty($item['description']) ? $item['description'] : '';
				$item_extra = ! empty($item['extra']) ? $item['extra'] : '';
			?>
				<div class="final-cta-item">
					<div class="final-cta-item-header">
						<img src="<?php echo esc_url($item_icon); ?>" alt="<?php echo esc_attr($item_title); ?>" class="final-cta-icon" width="26" height="26" loading="lazy">
						<h3 class="final-cta-item-title"><?php echo esc_html($item_title); ?></h3>
					</div>
					<p class="final-cta-item-description"><?php echo wp_kses_post($item_desc); ?></p>
					<?php if ($item_extra) : ?>
						<p class="final-cta-item-description final-cta-item-description-extra"><?php echo esc_html($item_extra); ?></p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<div class="final-cta-right-wrapper">
	<div class="final-cta-right final-cta-right--mobile">
		<?php foreach ($items as $item) :
			$item_icon = ! empty($item['icon']) ? $item['icon'] : '';
			$item_title = ! empty($item['title']) ? $item['title'] : '';
			$item_desc = ! empty($item['description']) ? $item['description'] : '';
			$item_extra = ! empty($item['extra']) ? $item['extra'] : '';
		?>
			<div class="final-cta-item">
				<div class="final-cta-item-header">
					<img src="<?php echo esc_url($item_icon); ?>" alt="<?php echo esc_attr($item_title); ?>" class="final-cta-icon" width="26" height="26" loading="lazy">
					<h3 class="final-cta-item-title"><?php echo esc_html($item_title); ?></h3>
				</div>
				<p class="final-cta-item-description"><?php echo wp_kses_post($item_desc); ?></p>
				<?php if ($item_extra) : ?>
					<p class="final-cta-item-description final-cta-item-description-extra"><?php echo esc_html($item_extra); ?></p>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
