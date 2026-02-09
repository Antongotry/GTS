<?php

/**
 * Contacts Main Block: WhatsApp, Email, Contact Form
 *
 * @package GTS
 */

$whatsapp_number = '+44 00 1111 2222';
$whatsapp_url   = 'https://wa.me/' . preg_replace('/[\s+]/', '', $whatsapp_number);
$contact_email  = 'info@gmail.com';
$mail_icon_url  = get_template_directory_uri() . '/assets/icons/mail-icon.svg';
?>

<section class="contacts-main" id="contacts-main">
	<div class="contacts-main__container">

		<div class="contacts-main__card contacts-main__card--whatsapp">
			<div class="contacts-main__card-header">
				<h3 class="contacts-main__channel"><?php esc_html_e('WhatsApp', 'gts-theme'); ?></h3>
				<div class="contacts-main__icon-wrap contacts-main__icon-wrap--whatsapp">
					<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/Whatsapp1.svg?v=2'); ?>" alt="" width="24" height="24" loading="lazy">
				</div>
			</div>
			<p class="contacts-main__desc"><?php esc_html_e('For quick questions, urgent requests, and real-time coordination.', 'gts-theme'); ?></p>
			<a href="<?php echo esc_url($whatsapp_url); ?>" class="contacts-main__link contacts-main__link--underline" target="_blank" rel="noopener noreferrer"><?php echo esc_html($whatsapp_number); ?></a>
		</div>

		<div class="contacts-main__card contacts-main__card--email">
			<div class="contacts-main__card-header">
				<h3 class="contacts-main__channel"><?php esc_html_e('Email', 'gts-theme'); ?></h3>
				<div class="contacts-main__icon-wrap contacts-main__icon-wrap--email">
					<img src="<?php echo esc_url($mail_icon_url); ?>" alt="" width="24" height="24" aria-hidden="true">
				</div>
			</div>
			<p class="contacts-main__desc"><?php esc_html_e('For detailed enquiries, proposals, and documentation.', 'gts-theme'); ?></p>
			<a href="<?php echo esc_url('mailto:' . $contact_email); ?>" class="contacts-main__link contacts-main__link--underline"><?php echo esc_html($contact_email); ?></a>
		</div>

		<div class="contacts-main__card contacts-main__card--form">
			<div class="contacts-main__form-wrap">
				<p class="contacts-main__form-intro"><?php esc_html_e('Share a few details, and our team will get back to you with clear next steps.', 'gts-theme'); ?></p>
				<?php if (isset($_GET['gts_contact_sent']) && '1' === $_GET['gts_contact_sent']) : ?>
					<p class="contacts-main__form-success"><?php esc_html_e('Thank you. We will get back to you shortly.', 'gts-theme'); ?></p>
				<?php else : ?>
					<form class="contacts-form gts-contact-form" action="" method="post">
						<?php wp_nonce_field('gts_contact_form', 'gts_contact_nonce'); ?>
						<div class="contacts-form__row">
							<div class="contacts-form__group">
								<input type="text" name="gts_first_name" placeholder="<?php esc_attr_e('First name', 'gts-theme'); ?>" required>
							</div>
							<div class="contacts-form__group">
								<input type="text" name="gts_last_name" placeholder="<?php esc_attr_e('Last name', 'gts-theme'); ?>" required>
							</div>
						</div>
						<div class="contacts-form__row">
							<div class="contacts-form__group">
								<input type="tel" name="gts_phone" placeholder="<?php esc_attr_e('Phone', 'gts-theme'); ?>" required>
							</div>
							<div class="contacts-form__group">
								<input type="email" name="gts_email" placeholder="<?php esc_attr_e('E-mail', 'gts-theme'); ?>" required>
							</div>
						</div>
						<div class="contacts-form__row">
							<div class="contacts-form__group contacts-form__group--full">
								<textarea name="gts_details" placeholder="<?php esc_attr_e('Details', 'gts-theme'); ?>" rows="1"></textarea>
							</div>
						</div>
						<div class="contacts-form__consent">
							<label>
								<input type="checkbox" name="gts_consent" required>
								<span><?php esc_html_e('I agree to receive ', 'gts-theme'); ?><span class="contacts-form__consent-link"><?php esc_html_e('email communication regarding my quote request.', 'gts-theme'); ?></span></span>
							</label>
						</div>
						<button type="submit" class="contacts-form__submit"><?php esc_html_e('Get My Quote', 'gts-theme'); ?></button>
					</form>
				<?php endif; ?>
			</div>
		</div>

	</div>
</section>
