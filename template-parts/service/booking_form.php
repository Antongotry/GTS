<?php

/**
 * Service Block: Booking Form
 *
 * Displays the booking form section for service pages.
 *
 * @package GTS
 */

// Get block data passed from single-service.php
$block = isset($args['block']) ? $args['block'] : array();

// Extract fields with defaults
$form_type      = ! empty($block['form_type']) ? $block['form_type'] : 'default';
$form_shortcode = ! empty($block['form_shortcode']) ? $block['form_shortcode'] : '';

// Get current service info for hidden fields
$service_title = get_the_title();
$service_slug  = get_post_field('post_name', get_the_ID());
$service_url   = get_permalink();
?>

<?php if ('shortcode' === $form_type && $form_shortcode) : ?>
	<!-- Custom form via shortcode -->
	<section class="booking-form-block">
		<div class="booking-form-container">
			<?php echo do_shortcode($form_shortcode); ?>
		</div>
	</section>
<?php elseif ('simple' === $form_type) : ?>
	<!-- Simple contact form -->
	<section class="booking-form-block booking-form-block--simple">
		<div class="booking-form-container">
			<form class="booking-form booking-form--simple" method="post" action="">
				<?php wp_nonce_field('gts_service_form', 'gts_service_nonce'); ?>

				<!-- Hidden service metadata -->
				<input type="hidden" name="service_title" value="<?php echo esc_attr($service_title); ?>">
				<input type="hidden" name="service_slug" value="<?php echo esc_attr($service_slug); ?>">
				<input type="hidden" name="service_url" value="<?php echo esc_url($service_url); ?>">

				<div class="form-row">
					<div class="form-group">
						<input type="text" name="full_name" placeholder="<?php esc_attr_e('Full Name *', 'gts-theme'); ?>" required>
					</div>
					<div class="form-group">
						<input type="email" name="email" placeholder="<?php esc_attr_e('Email', 'gts-theme'); ?>" required>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group">
						<input type="tel" name="phone" placeholder="<?php esc_attr_e('Phone *', 'gts-theme'); ?>" required>
					</div>
					<div class="form-group">
						<textarea name="message" rows="3" placeholder="<?php esc_attr_e('Your message', 'gts-theme'); ?>"></textarea>
					</div>
				</div>

				<button type="submit" class="booking-submit-btn"><?php esc_html_e('Send Request', 'gts-theme'); ?></button>
			</form>
		</div>
	</section>
<?php else : ?>
	<!-- Default full booking form -->
	<?php get_template_part('template-parts/blocks/booking-form-limousine-service'); ?>
<?php endif; ?>
