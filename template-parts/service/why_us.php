<?php

/**
 * Service Block: Why Us Section
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

$pill_text = ! empty($block['pill_text']) ? $block['pill_text'] : __('Why us?', 'gts-theme');
$cards     = ! empty($block['cards']) ? $block['cards'] : array();

if (empty($cards)) {
	return;
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
