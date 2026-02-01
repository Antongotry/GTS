<?php

/**
 * Service Block: Why Us Section
 *
 * Matches the exact structure of the original why-us.php template
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

// Default values
$pill_text = ! empty($block['pill_text']) ? $block['pill_text'] : __('Why us?', 'gts-theme');

// Default images and icons from original template
$site_url = get_site_url();
$default_image_1 = $site_url . '/wp-content/uploads/2026/01/home-2-block-1-_result.webp';
$default_icon_2 = $site_url . '/wp-content/uploads/2026/01/icon-block-2-1.svg';
$default_icon_3 = $site_url . '/wp-content/uploads/2026/01/icon-block-2-2.svg';
$default_icon_4 = $site_url . '/wp-content/uploads/2026/01/icon-block-2-3.svg';
$default_icon_5 = $site_url . '/wp-content/uploads/2026/01/icon-block-2-4.svg';
$default_image_6 = $site_url . '/wp-content/uploads/2026/01/home-2-block-2_result.webp';

// Get cards from ACF or use defaults
$cards = ! empty($block['cards']) ? $block['cards'] : array();

// If no cards, use default structure matching original template
if (empty($cards)) {
	$cards = array(
		array('card_type' => 'image', 'image' => $default_image_1, 'icon' => '', 'title' => 'Available worldwide', 'description' => 'Consistent excellence in executive<br>and luxury transfers — wherever<br>your journey takes you.'),
		array('card_type' => 'icon', 'image' => '', 'icon' => $default_icon_2, 'title' => 'World-class fleet', 'description' => 'Late-model business, premium and<br>VIP vehicles, perfectly maintained for<br>comfort, style and safety.'),
		array('card_type' => 'icon', 'image' => '', 'icon' => $default_icon_3, 'title' => 'Qualified chauffeurs', 'description' => 'Licensed, experienced and discreet<br>professionals trained to meet the<br>highest service standards.'),
		array('card_type' => 'icon', 'image' => '', 'icon' => $default_icon_4, 'title' => 'Security & discretion', 'description' => 'Strict safety protocols, discreet<br>coordination, and confidential service for<br>corporate & VIP clients.'),
		array('card_type' => 'icon', 'image' => '', 'icon' => $default_icon_5, 'title' => '24/7 Human Support', 'description' => 'Book directly on the website or through<br>your personal manager — 24/7 via<br>messenger, email or phone.'),
		array('card_type' => 'image', 'image' => $default_image_6, 'icon' => '', 'title' => 'Seamless coordination', 'description' => 'We work directly with your planner or venue to<br>synchronise every detail — from arrivals to final<br>departures.'),
	);
}
?>

<section class="why-us-block">
	<div class="why-us-container">
		<div class="why-us-heading">
			<div class="why-us-heading-pill">
				<span class="why-us-heading-text"><?php echo esc_html($pill_text); ?></span>
			</div>
			<div class="why-us-heading-line" aria-hidden="true"></div>
		</div>
		<div class="why-us-grid">
			<?php
			$item_index = 1;
			foreach ($cards as $card) :
				$card_type   = ! empty($card['card_type']) ? $card['card_type'] : 'icon';
				$image       = ! empty($card['image']) ? $card['image'] : '';
				$icon        = ! empty($card['icon']) ? $card['icon'] : '';
				$title       = ! empty($card['title']) ? $card['title'] : '';
				$description = ! empty($card['description']) ? $card['description'] : '';
			?>

				<?php if ('image' === $card_type && $image) : ?>
					<!-- Image card -->
					<div class="why-us-item why-us-item-<?php echo esc_attr($item_index); ?>" style="background-image: url('<?php echo esc_url($image); ?>');">
						<?php if ($title) : ?>
							<h3 class="why-us-item-title"><?php echo esc_html($title); ?></h3>
						<?php endif; ?>
						<?php if ($description) : ?>
							<p class="why-us-item-description"><?php echo wp_kses_post($description); ?></p>
						<?php endif; ?>
					</div>
				<?php else : ?>
					<!-- Icon card -->
					<div class="why-us-item why-us-item-<?php echo esc_attr($item_index); ?>">
						<?php if ($icon) : ?>
							<div class="why-us-item-icon-wrapper">
								<img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>" class="why-us-item-icon" loading="lazy" width="48" height="48">
							</div>
						<?php endif; ?>
						<?php if ($title) : ?>
							<h3 class="why-us-item-title"><?php echo esc_html($title); ?></h3>
						<?php endif; ?>
						<?php if ($description) : ?>
							<p class="why-us-item-description"><?php echo wp_kses_post($description); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			<?php
				$item_index++;
			endforeach;
			?>
		</div>
	</div>
</section>
