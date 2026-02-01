<?php

/**
 * Service Block: FAQ Section
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

$pill_text = ! empty($block['pill_text']) ? $block['pill_text'] : __('FAQ', 'gts-theme');
$title     = ! empty($block['title']) ? $block['title'] : '';
$items     = ! empty($block['items']) ? $block['items'] : array();

if (empty($items)) {
	return;
}

$chevron_url = get_template_directory_uri() . '/assets/icons/chevron-down-faq.svg';

// Split items into two columns
$half        = ceil(count($items) / 2);
$faq_column_1 = array_slice($items, 0, $half);
$faq_column_2 = array_slice($items, $half);
?>

<section class="faq-block">
	<div class="faq-container">
		<div class="faq-pill">
			<span class="faq-pill-text"><?php echo esc_html($pill_text); ?></span>
		</div>
		<?php if ($title) : ?>
			<h2 class="faq-title"><?php echo wp_kses_post($title); ?></h2>
		<?php endif; ?>

		<div class="faq-accordions">
			<div class="faq-accordion-col">
				<?php foreach ($faq_column_1 as $i => $item) :
					$id = 'faq-content-1-' . $i;
					$question = ! empty($item['question']) ? $item['question'] : '';
					$answer   = ! empty($item['answer']) ? $item['answer'] : '';
				?>
					<div class="faq-item" data-faq-item>
						<button type="button" class="faq-item__summary" aria-expanded="false" aria-controls="<?php echo esc_attr($id); ?>" id="faq-trigger-1-<?php echo esc_attr($i); ?>">
							<span class="faq-item__question"><?php echo esc_html($question); ?></span>
							<img src="<?php echo esc_url($chevron_url); ?>" alt="" class="faq-item__icon" width="20" height="20" aria-hidden="true">
						</button>
						<div class="faq-item__content-wrapper" id="<?php echo esc_attr($id); ?>" role="region" aria-labelledby="faq-trigger-1-<?php echo esc_attr($i); ?>">
							<div class="faq-item__content">
								<p><?php echo esc_html($answer); ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="faq-accordion-col">
				<?php foreach ($faq_column_2 as $i => $item) :
					$id = 'faq-content-2-' . $i;
					$question = ! empty($item['question']) ? $item['question'] : '';
					$answer   = ! empty($item['answer']) ? $item['answer'] : '';
				?>
					<div class="faq-item" data-faq-item>
						<button type="button" class="faq-item__summary" aria-expanded="false" aria-controls="<?php echo esc_attr($id); ?>" id="faq-trigger-2-<?php echo esc_attr($i); ?>">
							<span class="faq-item__question"><?php echo esc_html($question); ?></span>
							<img src="<?php echo esc_url($chevron_url); ?>" alt="" class="faq-item__icon" width="20" height="20" aria-hidden="true">
						</button>
						<div class="faq-item__content-wrapper" id="<?php echo esc_attr($id); ?>" role="region" aria-labelledby="faq-trigger-2-<?php echo esc_attr($i); ?>">
							<div class="faq-item__content">
								<p><?php echo esc_html($answer); ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
