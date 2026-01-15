<?php
/**
 * Trusted By Block Template
 *
 * @package GTS
 */

$testimonials = array(
	array(
		'text' => '“Convallis interdum mattis morbi ullamcorper. Felis, elementum et, in est fringilla viverra vitae interdum.”',
		'name' => 'Victoria',
	),
	array(
		'text' => '“Convallis interdum mattis morbi ullamcorper. Felis, elementum et, in est fringilla viverra vitae interdum.”',
		'name' => 'Victoria',
	),
	array(
		'text' => '“Convallis interdum mattis morbi ullamcorper. Felis, elementum et, in est fringilla viverra vitae interdum.”',
		'name' => 'Victoria',
	),
	array(
		'text' => '“Convallis interdum mattis morbi ullamcorper. Felis, elementum et, in est fringilla viverra vitae interdum.”',
		'name' => 'Victoria',
	),
	array(
		'text' => '“Convallis interdum mattis morbi ullamcorper. Felis, elementum et, in est fringilla viverra vitae interdum.”',
		'name' => 'Victoria',
	),
);
?>

<section class="trusted-by-block">
	<div class="trusted-by-container">
		<div class="trusted-by-pill">
			<span class="trusted-by-pill-text"><?php echo esc_html( 'Trusted by clients worldwide' ); ?></span>
		</div>
		<h2 class="trusted-by-title">
			<?php echo esc_html( 'Corporations, executives and private travellers rely on GTS for punctuality, comfort and flawless service.' ); ?>
		</h2>

		<div class="trusted-by-slider swiper">
			<div class="swiper-wrapper">
				<?php foreach ( $testimonials as $testimonial ) : ?>
					<div class="swiper-slide trusted-by-card">
						<div class="trusted-by-stars">★★★★★</div>
						<p class="trusted-by-card-text"><?php echo esc_html( $testimonial['text'] ); ?></p>
						<div class="trusted-by-author">
							<span class="trusted-by-avatar" aria-hidden="true"></span>
							<span class="trusted-by-name"><?php echo esc_html( $testimonial['name'] ); ?></span>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="trusted-by-controls">
			<button class="trusted-by-button trusted-by-prev" type="button" aria-label="<?php echo esc_attr( 'Previous' ); ?>">←</button>
			<button class="trusted-by-button trusted-by-next" type="button" aria-label="<?php echo esc_attr( 'Next' ); ?>">→</button>
		</div>
	</div>
</section>
