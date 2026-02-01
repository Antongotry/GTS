<?php

/**
 * Service Block: FAQ Section
 *
 * Matches the exact structure of the original faq.php template
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

// Default values
$pill_text = ! empty($block['pill_text']) ? $block['pill_text'] : __('FAQ', 'gts-theme');
$title     = ! empty($block['title']) ? $block['title'] : __('Clear answers to help you book<br>with confidence', 'gts-theme');
$chevron_url = get_template_directory_uri() . '/assets/icons/chevron-down-faq.svg';

// Get questions from ACF or use defaults
$questions = ! empty($block['questions']) ? $block['questions'] : array();

// Default FAQ matching original template
if (empty($questions)) {
	$questions = array(
		array('question' => 'Do you really operate worldwide?', 'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
		array('question' => 'How fast can I get a car?', 'answer' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
		array('question' => 'Can I book a limousine for a few hours or for a full day?', 'answer' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'),
		array('question' => 'Are your drivers professional?', 'answer' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
		array('question' => 'Do you offer airport transfers with limousines?', 'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
		array('question' => 'How can I pay?', 'answer' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
		array('question' => 'What if I need to cancel?', 'answer' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'),
		array('question' => 'Can I book directly with a manager?', 'answer' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
	);
}

// Split into two columns
$half = ceil(count($questions) / 2);
$faq_column_1 = array_slice($questions, 0, $half);
$faq_column_2 = array_slice($questions, $half);
?>

<section class="faq-block">
	<div class="faq-container">
		<div class="faq-pill">
			<span class="faq-pill-text"><?php echo esc_html($pill_text); ?></span>
		</div>
		<h2 class="faq-title"><?php echo wp_kses_post($title); ?></h2>

		<div class="faq-accordions">
			<div class="faq-accordion-col">
				<?php foreach ($faq_column_1 as $i => $item) :
					$id = 'faq-content-1-' . $i;
					$question = ! empty($item['question']) ? $item['question'] : '';
					$answer = ! empty($item['answer']) ? $item['answer'] : '';
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
					$answer = ! empty($item['answer']) ? $item['answer'] : '';
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
