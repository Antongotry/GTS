<?php
/**
 * Trusted By Block Template
 *
 * @package GTS
 */

$testimonials = array(
	array(
		'text' => '"We used transfer services in Hannover during the exhibition. The driver arrived in advance, the vehicle was in good condition, and all details were confirmed the day before. Everything ran smoothly and on time."',
		'name' => 'James',
	),
	array(
		'text' => '"We booked transfers in Milan with waiting time and a return trip. Everything went according to plan, and the driver was careful and professional."',
		'name' => 'Sarah',
	),
	array(
		'text' => '"Transport was arranged for a group in Riyadh. With a tight schedule, all pickups were on time and locations were handled without confusion. Reliable service."',
		'name' => 'Michael',
	),
	array(
		'text' => '"The route Przemyśl – Vilnius – Berlin involved multiple dates and pickups. The logistics were well organised and the price remained exactly as agreed."',
		'name' => 'Emma',
	),
	array(
		'text' => '"We booked a comfort transfer in Nice for a trip with a child. The car arrived on time and the journey was calm, without any organisational issues."',
		'name' => 'David',
	),
);
$section_pill = 'Trusted by clients worldwide';
$section_title = 'Corporations, executives and private travellers rely on GTS for punctuality, comfort and flawless service.';
$testimonials_block = array();

if ( function_exists( 'gts_is_service_style_page' ) && gts_is_service_style_page() && function_exists( 'gts_get_page_service_block' ) ) {
	$testimonials_block = gts_get_page_service_block( 'testimonials' );
} elseif ( is_singular( 'service' ) && function_exists( 'get_field' ) ) {
	$service_blocks = get_field( 'service_blocks', get_the_ID() );
	if ( is_array( $service_blocks ) ) {
		foreach ( $service_blocks as $block ) {
			if ( is_array( $block ) && ! empty( $block['acf_fc_layout'] ) && 'testimonials' === (string) $block['acf_fc_layout'] ) {
				$testimonials_block = $block;
				break;
			}
		}
	}
}

if ( ! empty( $testimonials_block ) ) {
	if ( ! empty( $testimonials_block['pill_text'] ) ) {
		$section_pill = (string) $testimonials_block['pill_text'];
	}
	if ( ! empty( $testimonials_block['title'] ) ) {
		$section_title = (string) $testimonials_block['title'];
	}
	if ( ! empty( $testimonials_block['testimonials'] ) && is_array( $testimonials_block['testimonials'] ) ) {
		$custom_testimonials = array_values(
			array_filter(
				array_map(
					static function ( $item ) {
						if ( ! is_array( $item ) ) {
							return null;
						}
						$text = isset( $item['text'] ) ? trim( (string) $item['text'] ) : '';
						$name = isset( $item['name'] ) ? trim( (string) $item['name'] ) : '';
						if ( '' === $text || '' === $name ) {
							return null;
						}
						$avatar = '';
						if ( ! empty( $item['avatar'] ) ) {
							if ( is_array( $item['avatar'] ) && ! empty( $item['avatar']['url'] ) ) {
								$avatar = (string) $item['avatar']['url'];
							} elseif ( is_numeric( $item['avatar'] ) ) {
								$avatar = (string) wp_get_attachment_image_url( (int) $item['avatar'], 'thumbnail' );
							} else {
								$avatar = (string) $item['avatar'];
							}
						}
						return array(
							'text'   => $text,
							'name'   => $name,
							'avatar' => $avatar,
						);
					},
					$testimonials_block['testimonials']
				)
			)
		);
		if ( ! empty( $custom_testimonials ) ) {
			$testimonials = $custom_testimonials;
		}
	}
}

// Heights cycle: 348, 326, 392
$heights = array( 348, 326, 392 );
?>

<section class="trusted-by-block">
	<div class="trusted-by-container">
		<div class="trusted-by-pill">
			<span class="trusted-by-pill-text"><?php echo esc_html( $section_pill ); ?></span>
		</div>
		<div class="trusted-by-title">
			<?php echo esc_html( $section_title ); ?>
		</div>
	</div>

	<div class="trusted-by-slider swiper">
		<div class="swiper-wrapper">
			<?php foreach ( $testimonials as $index => $testimonial ) : ?>
				<?php $card_height = $heights[ $index % count( $heights ) ]; ?>
				<div class="swiper-slide trusted-by-card" style="height: <?php echo esc_attr( $card_height ); ?>px;">
					<div class="trusted-by-card-content">
						<div class="trusted-by-stars">
							<span class="trusted-by-star">★</span>
							<span class="trusted-by-star">★</span>
							<span class="trusted-by-star">★</span>
							<span class="trusted-by-star">★</span>
							<span class="trusted-by-star">★</span>
						</div>
						<p class="trusted-by-card-text"><?php echo esc_html( $testimonial['text'] ); ?></p>
					</div>
					<div class="trusted-by-author">
						<?php if ( ! empty( $testimonial['avatar'] ) ) : ?>
							<img class="trusted-by-avatar" src="<?php echo esc_url( $testimonial['avatar'] ); ?>" alt="" loading="lazy" width="56" height="56">
						<?php else : ?>
							<span class="trusted-by-avatar trusted-by-avatar-icon" aria-hidden="true">
								<svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
									<circle cx="28" cy="28" r="28" fill="rgba(0,0,0,0.06)"/>
									<circle cx="28" cy="22" r="8" stroke="currentColor" stroke-width="1.5" fill="none"/>
									<path d="M14 46c0-8 6.5-14 14-14s14 6 14 14" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"/>
								</svg>
							</span>
						<?php endif; ?>
						<span class="trusted-by-name"><?php echo esc_html( $testimonial['name'] ); ?></span>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="trusted-by-container">
		<?php echo gts_nav_arrows( 'trusted-by-prev', 'trusted-by-next' ); ?>
	</div>
</section>
