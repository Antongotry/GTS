<?php

/**
 * Service Block: CTA Section
 *
 * @package GTS
 */

$block = isset($args['block']) ? $args['block'] : array();

$title              = ! empty($block['title']) ? $block['title'] : '';
$description        = ! empty($block['description']) ? $block['description'] : '';
$button_text        = ! empty($block['button_text']) ? $block['button_text'] : __('Book Now', 'gts-theme');
$button_link        = ! empty($block['button_link']) ? $block['button_link'] : '#';
$show_contact_icons = isset($block['show_contact_icons']) ? $block['show_contact_icons'] : true;

$phone_icon_url = get_template_directory_uri() . '/assets/icons/phone-icon.svg';
$mail_icon_url  = get_template_directory_uri() . '/assets/icons/mail-icon.svg';
?>

<section class="custom-itinerary-block custom-itinerary-block--limousine">
	<div class="custom-itinerary-container">
		<span class="custom-itinerary-line custom-itinerary-line--top-left"></span>
		<span class="custom-itinerary-line custom-itinerary-line--top-right"></span>
		<span class="custom-itinerary-line custom-itinerary-line--bottom-left"></span>
		<span class="custom-itinerary-line custom-itinerary-line--bottom-right"></span>

		<?php if ($title) : ?>
			<h2 class="custom-itinerary-title"><?php echo esc_html($title); ?></h2>
		<?php endif; ?>

		<?php if ($description) : ?>
			<p class="custom-itinerary-description"><?php echo esc_html($description); ?></p>
		<?php endif; ?>

		<div class="custom-itinerary-actions">
			<a href="<?php echo esc_url($button_link); ?>" class="btn btn-secondary custom-itinerary-button"><?php echo esc_html($button_text); ?></a>

			<?php if ($show_contact_icons) : ?>
				<span class="custom-itinerary-contact-label"><?php esc_html_e('or contact via', 'gts-theme'); ?></span>
				<div class="custom-itinerary-icons">
					<a href="#" class="custom-itinerary-icon custom-itinerary-icon--phone" aria-label="<?php esc_attr_e('Contact via phone or WhatsApp', 'gts-theme'); ?>">
						<img src="<?php echo esc_url($phone_icon_url); ?>" alt="" width="24" height="24" aria-hidden="true">
					</a>
					<a href="#" class="custom-itinerary-icon custom-itinerary-icon--mail" aria-label="<?php esc_attr_e('Contact via email', 'gts-theme'); ?>">
						<img src="<?php echo esc_url($mail_icon_url); ?>" alt="" width="24" height="24" aria-hidden="true">
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
