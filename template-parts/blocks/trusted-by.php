<?php
/**
 * Trusted By Block Template
 *
 * @package GTS
 */

$avatar_url = get_site_url() . '/wp-content/uploads/2026/01/rewievs-ic_result.webp';

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

// Heights cycle: 348, 326, 392
$heights = array( 348, 326, 392 );
?>

<section class="trusted-by-block">
	<div class="trusted-by-container">
		<div class="trusted-by-pill">
			<span class="trusted-by-pill-text"><?php echo esc_html( 'Trusted by clients worldwide' ); ?></span>
		</div>
		<h2 class="trusted-by-title">
			<?php echo esc_html( 'Corporations, executives and private travellers rely on GTS for punctuality, comfort and flawless service.' ); ?>
		</h2>
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
						<img src="<?php echo esc_url( $avatar_url ); ?>" alt="" class="trusted-by-avatar" width="56" height="56" loading="lazy">
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
