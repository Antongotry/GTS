<?php
/**
 * Custom Itinerary Block Template
 * Ready to Travel with GTS? — Book Now or contact via
 *
 * @package GTS
 */

$phone_icon_url = get_template_directory_uri() . '/assets/icons/phone-icon.svg';
$mail_icon_url  = get_template_directory_uri() . '/assets/icons/mail-icon.svg';
?>

<section class="custom-itinerary-block">
	<div class="custom-itinerary-container">
		<span class="custom-itinerary-line custom-itinerary-line--top-left"></span>
		<span class="custom-itinerary-line custom-itinerary-line--top-right"></span>
		<span class="custom-itinerary-line custom-itinerary-line--bottom-left"></span>
		<span class="custom-itinerary-line custom-itinerary-line--bottom-right"></span>
		<h2 class="custom-itinerary-title"><?php echo esc_html__( 'Ready to Travel with GTS?', 'gts-theme' ); ?></h2>
		<p class="custom-itinerary-description">
			<?php echo esc_html__( "Our team is available 24/7 to organize your limousine or executive transfer anywhere in the world.", 'gts-theme' ); ?>
		</p>
		<div class="custom-itinerary-actions">
			<a href="#" class="btn btn-secondary custom-itinerary-button"><?php echo esc_html__( 'Book Now', 'gts-theme' ); ?></a>
			<span class="custom-itinerary-contact-label"><?php echo esc_html__( 'or contact via', 'gts-theme' ); ?></span>
			<div class="custom-itinerary-icons">
				<a href="#" class="custom-itinerary-icon custom-itinerary-icon--phone" aria-label="<?php esc_attr_e( 'Contact via phone or WhatsApp', 'gts-theme' ); ?>">
					<img src="<?php echo esc_url( $phone_icon_url ); ?>" alt="" width="24" height="24" aria-hidden="true">
				</a>
				<a href="#" class="custom-itinerary-icon custom-itinerary-icon--mail" aria-label="<?php esc_attr_e( 'Contact via email', 'gts-theme' ); ?>">
					<img src="<?php echo esc_url( $mail_icon_url ); ?>" alt="" width="24" height="24" aria-hidden="true">
				</a>
			</div>
		</div>
	</div>
</section>
