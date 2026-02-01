<?php
/**
 * FAQ Block Template
 * Clear answers to help you book with confidence.
 *
 * @package GTS
 */

$chevron_url = get_template_directory_uri() . '/assets/icons/chevron-down-faq.svg';

$faq_column_1 = array(
	array(
		'question' => __( 'Do you really operate worldwide?', 'gts-theme' ),
		'answer'   => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'gts-theme' ),
	),
	array(
		'question' => __( 'How fast can I get a car?', 'gts-theme' ),
		'answer'   => __( 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'gts-theme' ),
	),
	array(
		'question' => __( 'Can I book a limousine for a few hours or for a full day?', 'gts-theme' ),
		'answer'   => __( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'gts-theme' ),
	),
	array(
		'question' => __( 'Are your drivers professional?', 'gts-theme' ),
		'answer'   => __( 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'gts-theme' ),
	),
);

$faq_column_2 = array(
	array(
		'question' => __( 'Do you offer airport transfers with limousines?', 'gts-theme' ),
		'answer'   => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'gts-theme' ),
	),
	array(
		'question' => __( 'How can I pay?', 'gts-theme' ),
		'answer'   => __( 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'gts-theme' ),
	),
	array(
		'question' => __( 'What if I need to cancel?', 'gts-theme' ),
		'answer'   => __( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'gts-theme' ),
	),
	array(
		'question' => __( 'Can I book directly with a manager?', 'gts-theme' ),
		'answer'   => __( 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'gts-theme' ),
	),
);
?>

<section class="faq-block">
	<div class="faq-container">
		<div class="faq-pill">
			<span class="faq-pill-text"><?php echo esc_html__( 'FAQ', 'gts-theme' ); ?></span>
		</div>
		<h2 class="faq-title"><?php echo wp_kses_post( __( 'Clear answers to help you book<br>with confidence', 'gts-theme' ) ); ?></h2>

		<div class="faq-accordions">
			<div class="faq-accordion-col">
				<?php foreach ( $faq_column_1 as $i => $item ) :
					$id = 'faq-content-1-' . $i;
					?>
					<div class="faq-item" data-faq-item>
						<button type="button" class="faq-item__summary" aria-expanded="false" aria-controls="<?php echo esc_attr( $id ); ?>" id="faq-trigger-1-<?php echo esc_attr( $i ); ?>">
							<span class="faq-item__question"><?php echo esc_html( $item['question'] ); ?></span>
							<img src="<?php echo esc_url( $chevron_url ); ?>" alt="" class="faq-item__icon" width="20" height="20" aria-hidden="true">
						</button>
						<div class="faq-item__content-wrapper" id="<?php echo esc_attr( $id ); ?>" role="region" aria-labelledby="faq-trigger-1-<?php echo esc_attr( $i ); ?>">
							<div class="faq-item__content">
								<p><?php echo esc_html( $item['answer'] ); ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="faq-accordion-col">
				<?php foreach ( $faq_column_2 as $i => $item ) :
					$id = 'faq-content-2-' . $i;
					?>
					<div class="faq-item" data-faq-item>
						<button type="button" class="faq-item__summary" aria-expanded="false" aria-controls="<?php echo esc_attr( $id ); ?>" id="faq-trigger-2-<?php echo esc_attr( $i ); ?>">
							<span class="faq-item__question"><?php echo esc_html( $item['question'] ); ?></span>
							<img src="<?php echo esc_url( $chevron_url ); ?>" alt="" class="faq-item__icon" width="20" height="20" aria-hidden="true">
						</button>
						<div class="faq-item__content-wrapper" id="<?php echo esc_attr( $id ); ?>" role="region" aria-labelledby="faq-trigger-2-<?php echo esc_attr( $i ); ?>">
							<div class="faq-item__content">
								<p><?php echo esc_html( $item['answer'] ); ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
