<?php
/**
 * How It Works Block Template
 *
 * @package GTS
 */

$background_url = get_site_url() . '/wp-content/uploads/2026/01/home-3-block-banner_result-scaled.webp';
?>

<section class="how-it-works-block" style="background-image: url('<?php echo esc_url( $background_url ); ?>');">
	<div class="how-it-works-container">
		<div class="how-it-works-left">
			<div class="how-it-works-pill">
				<span class="how-it-works-pill-text"><?php echo esc_html( 'How it works' ); ?></span>
			</div>
			<h2 class="how-it-works-title">
				<?php echo wp_kses_post( 'We handle the details —<br>you enjoy the moments' ); ?>
			</h2>
		</div>
		<div class="how-it-works-right" aria-hidden="true"></div>
	</div>
</section>
