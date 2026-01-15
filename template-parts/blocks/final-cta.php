<?php
/**
 * Final CTA Block Template
 *
 * @package GTS
 */

$background_image = get_site_url() . '/wp-content/uploads/2026/01/last-banner-home_result-scaled.webp';
?>

<section class="final-cta-block" style="background-image: url('<?php echo esc_url( $background_image ); ?>');">
	<div class="final-cta-container">
		<div class="final-cta-left">
			<h2 class="final-cta-title"><?php echo esc_html( 'Most transfer companies offer cars.' ); ?></h2>
			<p class="final-cta-description">
				<?php echo esc_html( 'We offer peace of mind — through control, consistency, and a truly global standard.' ); ?>
			</p>
			<a href="#" class="btn btn-primary final-cta-button">Book a transfer</a>
		</div>
		<div class="final-cta-right">
			<!-- Правая часть будет добавлена позже -->
		</div>
	</div>
</section>
