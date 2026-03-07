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
		<?php
		$gts_custom_itinerary_wa = get_option( 'gts_whatsapp_number', '491702841810' );
		$gts_custom_itinerary_wa = $gts_custom_itinerary_wa ? $gts_custom_itinerary_wa : '491702841810';
		$gts_custom_itinerary_wa = preg_replace( '/\D+/', '', (string) $gts_custom_itinerary_wa );
		$gts_custom_itinerary_wa_url = 'https://wa.me/' . $gts_custom_itinerary_wa;
		?>
		<span class="custom-itinerary-line custom-itinerary-line--top-left"></span>
		<span class="custom-itinerary-line custom-itinerary-line--top-right"></span>
		<span class="custom-itinerary-line custom-itinerary-line--bottom-left"></span>
		<span class="custom-itinerary-line custom-itinerary-line--bottom-right"></span>
		<h2 class="custom-itinerary-title"><?php echo esc_html__( "Didn't find your format?", 'gts-theme' ); ?></h2>
		<p class="custom-itinerary-description">
			<?php echo esc_html__( "We'll tailor the journey to your exact needs — any vehicle, any destination, any time.", 'gts-theme' ); ?>
		</p>
		<a href="<?php echo esc_url( $gts_custom_itinerary_wa_url ); ?>" class="btn btn-secondary custom-itinerary-button" target="_blank" rel="noopener noreferrer"><?php echo esc_html__( 'Request a custom itinerary', 'gts-theme' ); ?></a>
	</div>
</section>
