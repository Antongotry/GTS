<?php

/**
 * Service Block: Occasions Section
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

$pill_text   = ! empty($block['pill_text']) ? $block['pill_text'] : __('Full Service', 'gts-theme');
$title       = ! empty($block['title']) ? $block['title'] : '';
$cards       = ! empty($block['cards']) ? $block['cards'] : array();
$footer_text = ! empty($block['footer_text']) ? $block['footer_text'] : '';

if (empty($cards)) {
	return;
}
?>

<section class="why-us-block occasions-block">
	<div class="why-us-container">
		<div class="why-us-heading">
			<div class="why-us-heading-pill">
				<span class="why-us-heading-text"><?php echo esc_html($pill_text); ?></span>
			</div>
			<div class="why-us-heading-line" aria-hidden="true"></div>
			<?php if ($title) : ?>
				<div class="occasions-title-wrapper">
					<h2 class="occasions-title"><?php echo esc_html($title); ?></h2>
				</div>
			<?php endif; ?>
			<?php if ($footer_text) : ?>
				<p class="why-us-item-description occasions-footer-text occasions-footer-text-mobile"><?php echo esc_html($footer_text); ?></p>
			<?php endif; ?>
		</div>
		<div class="why-us-grid">
			<?php
			$item_index = 1;
			foreach ($cards as $card) :
				$card_type   = ! empty($card['card_type']) ? $card['card_type'] : 'icon';
				$image       = ! empty($card['image']) ? $card['image'] : '';
				$icon        = ! empty($card['icon']) ? $card['icon'] : '';
				$title_card  = ! empty($card['title']) ? $card['title'] : '';
				$description = ! empty($card['description']) ? $card['description'] : '';
			?>

				<?php if ('image' === $card_type && $image) : ?>
					<!-- Image only card -->
					<div class="why-us-item occasions-item-image" style="background-image: url('<?php echo esc_url($image); ?>');" role="img" aria-label="<?php echo esc_attr($title_card); ?>"></div>
				<?php else : ?>
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
				<?php endif; ?>

			<?php
				$item_index++;
			endforeach;
			?>

			<?php if ($footer_text) : ?>
				<div class="why-us-item why-us-item-6 occasions-footer-item">
					<p class="why-us-item-description occasions-footer-text"><?php echo esc_html($footer_text); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
