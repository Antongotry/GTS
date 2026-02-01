<?php

/**
 * Service Block: Occasions Section
 *
 * Matches the exact structure of the original occasions.php template
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

$pill_text   = ! empty($block['pill_text']) ? $block['pill_text'] : __('Full Service', 'gts-theme');
$title       = ! empty($block['title']) ? $block['title'] : __('Perfect for Every Occasion', 'gts-theme');
$footer_text = ! empty($block['footer_text']) ? $block['footer_text'] : __("Whether it's a business meeting, an exclusive event, or a long-distance journey – GTS Limousine Service adapts to your agenda with flawless precision and discretion.", 'gts-theme');

// Default icons and images from original template
$site_url = get_site_url();
$default_image_airport = $site_url . '/wp-content/uploads/2026/02/photo-l-1_result.webp';
$default_image_events = $site_url . '/wp-content/uploads/2026/02/photo-l-2_result.webp';
$default_icon_executive = $site_url . '/wp-content/uploads/2026/02/icon-l-1.svg';
$default_icon_airport = $site_url . '/wp-content/uploads/2026/02/icon-l-2.svg';
$default_icon_multi_day = $site_url . '/wp-content/uploads/2026/02/icon-l-3.svg';
$default_icon_private = $site_url . '/wp-content/uploads/2026/02/icon-l-4.svg';
$default_icon_events = $site_url . '/wp-content/uploads/2026/02/icon-l-5.svg';

// Get cards from ACF or use defaults
$cards = ! empty($block['cards']) ? $block['cards'] : array();

// If no cards, use default structure
if (empty($cards)) {
	$cards = array(
		array('card_type' => 'icon', 'icon' => $default_icon_executive, 'title' => 'Executive Travel', 'description' => 'ensure a seamless experience for board members,<br>CEOs, or international guests.'),
		array('card_type' => 'icon', 'icon' => $default_icon_airport, 'title' => 'Airport Limousine Service', 'description' => 'punctual, monitored, and stress-free – from arrival gate<br>to final destination.'),
		array('card_type' => 'image', 'image' => $default_image_airport, 'title' => ''),
		array('card_type' => 'icon', 'icon' => $default_icon_multi_day, 'title' => 'Multi-Day Itineraries', 'description' => 'extended or multi-city travel managed with real-time<br>coordination and dedicated support.'),
		array('card_type' => 'icon', 'icon' => $default_icon_private, 'title' => 'Private Occasions', 'description' => 'weddings, galas, proms, birthday and personal<br>celebrations with impeccable service.'),
		array('card_type' => 'split_image', 'image' => $default_image_events, 'title' => ''),
		array('card_type' => 'icon', 'icon' => $default_icon_events, 'title' => 'Events & Conferences', 'description' => 'coordinated logistics for delegations, summits, and VIP gatherings.'),
	);
}
?>

<section class="why-us-block occasions-block">
	<div class="why-us-container">
		<div class="why-us-heading">
			<div class="why-us-heading-pill">
				<span class="why-us-heading-text"><?php echo esc_html($pill_text); ?></span>
			</div>
			<div class="why-us-heading-line" aria-hidden="true"></div>
			<div class="occasions-title-wrapper">
				<h2 class="occasions-title"><?php echo esc_html($title); ?></h2>
			</div>
			<p class="why-us-item-description occasions-footer-text occasions-footer-text-mobile"><?php echo esc_html($footer_text); ?></p>
		</div>
		<div class="why-us-grid">
			<?php
			$item_index = 1;
			$has_split = false;

			foreach ($cards as $card) :
				$card_type   = ! empty($card['card_type']) ? $card['card_type'] : 'icon';
				$image       = ! empty($card['image']) ? $card['image'] : '';
				$icon        = ! empty($card['icon']) ? $card['icon'] : '';
				$title_card  = ! empty($card['title']) ? $card['title'] : '';
				$description = ! empty($card['description']) ? $card['description'] : '';

				// Check for split layout (image + light card)
				if ('split_image' === $card_type && $image) :
					$has_split = true;
					// Get next card for split layout
					$next_key = key($cards);
					next($cards);
					$next_card = current($cards);
					$next_icon = ! empty($next_card['icon']) ? $next_card['icon'] : $default_icon_events;
					$next_title = ! empty($next_card['title']) ? $next_card['title'] : '';
					$next_desc = ! empty($next_card['description']) ? $next_card['description'] : '';
			?>
					<!-- Split layout: Conference image + Events card -->
					<div class="occasions-split-image occasions-row3-image" style="background-image: url('<?php echo esc_url($image); ?>');" role="img" aria-label="<?php echo esc_attr($title_card); ?>"></div>
					<div class="occasions-split-card occasions-split-card--light occasions-row3-card">
						<?php if ($next_icon) : ?>
							<div class="why-us-item-icon-wrapper">
								<img src="<?php echo esc_url($next_icon); ?>" alt="" class="why-us-item-icon" loading="lazy" width="48" height="48">
							</div>
						<?php endif; ?>
						<?php if ($next_title) : ?>
							<h3 class="why-us-item-title occasions-card-title--dark"><?php echo esc_html($next_title); ?></h3>
						<?php endif; ?>
						<?php if ($next_desc) : ?>
							<p class="why-us-item-description occasions-card-description--dark"><?php echo wp_kses_post($next_desc); ?></p>
						<?php endif; ?>
					</div>
				<?php
				elseif ('image' === $card_type && $image) :
				?>
					<!-- Image only card -->
					<div class="why-us-item occasions-item-image" style="background-image: url('<?php echo esc_url($image); ?>');" role="img" aria-label="<?php echo esc_attr($title_card); ?>"></div>
				<?php
				elseif ('icon' === $card_type && !$has_split) :
				?>
					<!-- Icon card -->
					<div class="why-us-item why-us-item-<?php echo esc_attr($item_index); ?>">
						<?php if ($icon) : ?>
							<div class="why-us-item-icon-wrapper">
								<img src="<?php echo esc_url($icon); ?>" alt="" class="why-us-item-icon" loading="lazy" width="48" height="48">
							</div>
						<?php endif; ?>
						<?php if ($title_card) : ?>
							<h3 class="why-us-item-title"><?php echo esc_html($title_card); ?></h3>
						<?php endif; ?>
						<?php if ($description) : ?>
							<p class="why-us-item-description"><?php echo wp_kses_post($description); ?></p>
						<?php endif; ?>
					</div>
			<?php
					$item_index++;
				endif;
			endforeach;
			?>

			<!-- Footer text item -->
			<div class="why-us-item why-us-item-6 occasions-footer-item">
				<p class="why-us-item-description occasions-footer-text"><?php echo esc_html($footer_text); ?></p>
			</div>
		</div>
	</div>
</section>
