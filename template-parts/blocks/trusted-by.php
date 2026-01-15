<?php
/**
 * Trusted By Block Template
 *
 * @package GTS
 */

$avatar_url = get_site_url() . '/wp-content/uploads/2026/01/rewievs-ic_result.webp';

$testimonials = array(
	array(
		'text' => '"Convallis interdum mattis morbi ullamcorper. Felis, elementum et, in est fringilla viverra vitae interdum. Facilisis aliquet hac vestibulum pulvinar. Ultrices velit a gravida condimentum lectus."',
		'name' => 'Вікторія',
	),
	array(
		'text' => '"Convallis interdum mattis morbi ullamcorper. Felis, elementum et, in est fringilla viverra vitae interdum. Facilisis aliquet hac vestibulum pulvinar."',
		'name' => 'Вікторія',
	),
	array(
		'text' => '"Convallis interdum mattis morbi ullamcorper. Felis, elementum et, in est fringilla viverra vitae interdum. Facilisis aliquet hac vestibulum pulvinar. Ultrices velit a gravida condimentum lectus. Morbi et magna."',
		'name' => 'Вікторія',
	),
	array(
		'text' => '"Convallis interdum mattis morbi ullamcorper. Felis, elementum et, in est fringilla viverra vitae interdum."',
		'name' => 'Вікторія',
	),
	array(
		'text' => '"Convallis interdum mattis morbi ullamcorper. Felis, elementum et, in est fringilla viverra vitae interdum. Facilisis aliquet hac vestibulum pulvinar. Ultrices velit a gravida."',
		'name' => 'Вікторія',
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
						<img src="<?php echo esc_url( $avatar_url ); ?>" alt="" class="trusted-by-avatar" width="56" height="56">
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
