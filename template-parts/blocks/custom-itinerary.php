<?php
/**
 * Custom Itinerary Block Template (вариант для главной и общий)
 * Didn't find your format? — Request a custom itinerary
 *
 * @package GTS
 */
?>

<section class="custom-itinerary-block">
	<div class="custom-itinerary-container">
		<span class="custom-itinerary-line custom-itinerary-line--top-left"></span>
		<span class="custom-itinerary-line custom-itinerary-line--top-right"></span>
		<span class="custom-itinerary-line custom-itinerary-line--bottom-left"></span>
		<span class="custom-itinerary-line custom-itinerary-line--bottom-right"></span>
		<h2 class="custom-itinerary-title"><?php echo esc_html__( "Didn't find your format?", 'gts-theme' ); ?></h2>
		<p class="custom-itinerary-description">
			<?php echo esc_html__( "We'll tailor the journey to your exact needs — any vehicle, any destination, any time.", 'gts-theme' ); ?>
		</p>
		<a href="#" class="btn btn-secondary custom-itinerary-button"><?php echo esc_html__( 'Request a custom itinerary', 'gts-theme' ); ?></a>
	</div>
</section>
