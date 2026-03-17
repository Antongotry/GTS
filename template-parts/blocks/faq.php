<?php
/**
 * FAQ Block Template
 * Clear answers to help you book with confidence.
 *
 * @package GTS
 */

$is_city_to_city = is_page_template( 'page-city-to-city.php' ) || is_page( 'city-to-city' );
$page_id = get_queried_object_id();
$service_faq = function_exists( 'gts_get_page_service_block' ) ? gts_get_page_service_block( 'faq', $page_id ) : array();

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

if ( $is_city_to_city ) {
	$faq_column_1 = array(
		array(
			'question' => __( 'Can I book a transfer between different countries?', 'gts-theme' ),
			'answer'   => $faq_column_1[0]['answer'],
		),
		array(
			'question' => __( 'How far in advance should I book?', 'gts-theme' ),
			'answer'   => $faq_column_1[1]['answer'],
		),
		array(
			'question' => __( 'What types of vehicles are used for long-distance transfers?', 'gts-theme' ),
			'answer'   => $faq_column_1[2]['answer'],
		),
		array(
			'question' => __( 'Are your chauffeurs available for long-distance trips?', 'gts-theme' ),
			'answer'   => $faq_column_1[3]['answer'],
		),
	);

	$faq_column_2 = array(
		array(
			'question' => __( 'Can I request multiple stops or sightseeing along the way?', 'gts-theme' ),
			'answer'   => $faq_column_2[0]['answer'],
		),
		array(
			'question' => __( 'Do you provide overnight service or multi-day routes?', 'gts-theme' ),
			'answer'   => $faq_column_2[1]['answer'],
		),
		array(
			'question' => __( 'What if I need to cancel?', 'gts-theme' ),
			'answer'   => $faq_column_2[2]['answer'],
		),
		array(
			'question' => __( 'How do I book a city-to-city transfer?', 'gts-theme' ),
			'answer'   => $faq_column_2[3]['answer'],
		),
	);
}

$faq_pill = __( 'FAQ', 'gts-theme' );
$faq_title = __( 'Clear answers to help you book<br>with confidence', 'gts-theme' );

if ( function_exists( 'get_field' ) && $page_id ) {
	$custom_faq_items = get_field( 'gts_page_faq_items', $page_id );
	$custom_faq_pill = (string) get_field( 'gts_page_faq_pill', $page_id );
	$custom_faq_title = (string) get_field( 'gts_page_faq_title', $page_id );

	if ( '' !== trim( $custom_faq_pill ) ) {
		$faq_pill = $custom_faq_pill;
	}
	if ( '' !== trim( $custom_faq_title ) ) {
		$faq_title = $custom_faq_title;
	}
	if ( is_array( $custom_faq_items ) && ! empty( $custom_faq_items ) ) {
		$normalized = array_values(
			array_filter(
				array_map(
					static function ( $row ) {
						if ( ! is_array( $row ) ) {
							return null;
						}
						$question = isset( $row['question'] ) ? trim( (string) $row['question'] ) : '';
						$answer = isset( $row['answer'] ) ? trim( (string) $row['answer'] ) : '';
						if ( '' === $question || '' === $answer ) {
							return null;
						}
						return array(
							'question' => $question,
							'answer'   => $answer,
						);
					},
					$custom_faq_items
				)
			)
		);

		if ( ! empty( $normalized ) ) {
			$half = (int) ceil( count( $normalized ) / 2 );
			$faq_column_1 = array_slice( $normalized, 0, $half );
			$faq_column_2 = array_slice( $normalized, $half );
		}
	}
}

if ( ! empty( $service_faq ) ) {
	if ( ! empty( $service_faq['pill_text'] ) ) {
		$faq_pill = (string) $service_faq['pill_text'];
	}
	if ( ! empty( $service_faq['title'] ) ) {
		$faq_title = (string) $service_faq['title'];
	}
	if ( ! empty( $service_faq['items'] ) && is_array( $service_faq['items'] ) ) {
		$normalized = array_values(
			array_filter(
				array_map(
					static function ( $row ) {
						$question = isset( $row['question'] ) ? trim( (string) $row['question'] ) : '';
						$answer = isset( $row['answer'] ) ? trim( (string) $row['answer'] ) : '';
						if ( '' === $question || '' === $answer ) {
							return null;
						}
						return array(
							'question' => $question,
							'answer'   => $answer,
						);
					},
					$service_faq['items']
				)
			)
		);
		if ( ! empty( $normalized ) ) {
			$half = (int) ceil( count( $normalized ) / 2 );
			$faq_column_1 = array_slice( $normalized, 0, $half );
			$faq_column_2 = array_slice( $normalized, $half );
		}
	}
}
?>

<section class="faq-block">
	<div class="faq-container">
		<div class="faq-pill">
			<span class="faq-pill-text"><?php echo esc_html( $faq_pill ); ?></span>
		</div>
		<div class="faq-title"><?php echo wp_kses_post( $faq_title ); ?></div>

		<div class="faq-accordions">
			<div class="faq-accordion-col">
				<?php foreach ( $faq_column_1 as $i => $item ) :
					$id = 'faq-content-1-' . $i;
					?>
						<div class="faq-item" data-faq-item>
							<button type="button" class="faq-item__summary" aria-expanded="false" aria-controls="<?php echo esc_attr( $id ); ?>" id="faq-trigger-1-<?php echo esc_attr( $i ); ?>">
								<span class="faq-item__question"><?php echo esc_html( $item['question'] ); ?></span>
								<span class="faq-item__icon" aria-hidden="true"><svg viewBox="0 0 20 20" width="20" height="20" focusable="false" aria-hidden="true"><path d="M6 8.5l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
							</button>
						<div class="faq-item__content-wrapper" id="<?php echo esc_attr( $id ); ?>" role="region" aria-labelledby="faq-trigger-1-<?php echo esc_attr( $i ); ?>">
							<div class="faq-item__content">
								<p><?php echo wp_kses_post( nl2br( esc_html( $item['answer'] ) ) ); ?></p>
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
								<span class="faq-item__icon" aria-hidden="true"><svg viewBox="0 0 20 20" width="20" height="20" focusable="false" aria-hidden="true"><path d="M6 8.5l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
							</button>
						<div class="faq-item__content-wrapper" id="<?php echo esc_attr( $id ); ?>" role="region" aria-labelledby="faq-trigger-2-<?php echo esc_attr( $i ); ?>">
							<div class="faq-item__content">
								<p><?php echo wp_kses_post( nl2br( esc_html( $item['answer'] ) ) ); ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
