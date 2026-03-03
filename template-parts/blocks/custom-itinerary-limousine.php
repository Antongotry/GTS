<?php
/**
 * Custom Itinerary Block — вариант для страницы Limousine Service
 * Ready to Travel with GTS? — Book Now or contact via
 *
 * @package GTS
 */

$phone_icon_url = get_template_directory_uri() . '/assets/icons/phone-icon.svg';
$mail_icon_url  = get_template_directory_uri() . '/assets/icons/mail-icon.svg';
$cta_block = function_exists( 'gts_is_service_style_page' ) && gts_is_service_style_page() && function_exists( 'gts_get_page_service_block' )
	? gts_get_page_service_block( 'cta' )
	: array();
$cta_title = ! empty( $cta_block['title'] ) ? (string) $cta_block['title'] : 'Ready to Travel with GTS?';
$cta_description = ! empty( $cta_block['description'] ) ? (string) $cta_block['description'] : 'Our team is available 24/7 to organize your limousine or executive transfer anywhere in the world.';
$cta_button_text = ! empty( $cta_block['button_text'] ) ? (string) $cta_block['button_text'] : 'Book Now';
$cta_button_link = ! empty( $cta_block['button_link'] ) ? (string) $cta_block['button_link'] : home_url( '/book-a-transfer/' );
$show_contact_icons = ! isset( $cta_block['show_contact_icons'] ) || (bool) $cta_block['show_contact_icons'];
?>

<section class="custom-itinerary-block custom-itinerary-block--limousine">
	<div class="custom-itinerary-container">
		<span class="custom-itinerary-line custom-itinerary-line--top-left"></span>
		<span class="custom-itinerary-line custom-itinerary-line--top-right"></span>
		<span class="custom-itinerary-line custom-itinerary-line--bottom-left"></span>
		<span class="custom-itinerary-line custom-itinerary-line--bottom-right"></span>
		<h2 class="custom-itinerary-title"><?php echo esc_html( $cta_title ); ?></h2>
		<p class="custom-itinerary-description">
			<?php echo esc_html( $cta_description ); ?>
		</p>
		<div class="custom-itinerary-actions">
			<a href="<?php echo esc_url( $cta_button_link ); ?>" class="btn btn-secondary custom-itinerary-button"><?php echo esc_html( $cta_button_text ); ?></a>
			<?php if ( $show_contact_icons ) : ?>
				<span class="custom-itinerary-contact-label"><?php echo esc_html__( 'or contact via', 'gts-theme' ); ?></span>
				<div class="custom-itinerary-icons">
					<a href="#" class="custom-itinerary-icon custom-itinerary-icon--phone" aria-label="<?php esc_attr_e( 'Contact via phone or WhatsApp', 'gts-theme' ); ?>">
						<img src="<?php echo esc_url( $phone_icon_url ); ?>" alt="" width="24" height="24" aria-hidden="true">
					</a>
					<a href="#" class="custom-itinerary-icon custom-itinerary-icon--mail" aria-label="<?php esc_attr_e( 'Contact via email', 'gts-theme' ); ?>">
						<img src="<?php echo esc_url( $mail_icon_url ); ?>" alt="" width="24" height="24" aria-hidden="true">
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
