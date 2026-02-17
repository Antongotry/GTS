<?php

/**
 * Service Block: Inline Booking Form
 *
 * This is the form that appears in the hero section.
 * Includes hidden fields for service source tagging.
 *
 * @package GTS
 */

// Get current service info for hidden fields
$service_title = get_the_title();
$service_slug  = get_post_field('post_name', get_the_ID());
$service_url   = get_permalink();
?>

<form class="booking-form" id="booking-form" method="post" action="">
	<?php wp_nonce_field('gts_service_booking', 'gts_booking_nonce'); ?>

	<!-- Hidden service metadata for form submissions -->
	<input type="hidden" name="service_title" value="<?php echo esc_attr($service_title); ?>">
	<input type="hidden" name="service_slug" value="<?php echo esc_attr($service_slug); ?>">
	<input type="hidden" name="service_url" value="<?php echo esc_url($service_url); ?>">

	<!-- Row 1: First and Last name и Phone -->
	<div class="form-row">
		<div class="form-group">
			<input type="text" id="full-name" name="full_name" placeholder="<?php esc_attr_e('First and Last name', 'gts-theme'); ?>" required>
		</div>
		<div class="form-group">
			<input type="tel" id="phone" name="phone" placeholder="<?php esc_attr_e('Phone', 'gts-theme'); ?>" required>
		</div>
	</div>

	<!-- Row 2: E-mail и Select service type -->
	<div class="form-row">
		<div class="form-group">
			<input type="email" id="email" name="email" placeholder="<?php esc_attr_e('E-mail', 'gts-theme'); ?>" required>
		</div>
		<div class="form-group">
			<select id="service-type" name="service_type" required>
				<option value=""><?php esc_html_e('Select service type', 'gts-theme'); ?></option>
			</select>
		</div>
	</div>

	<!-- Checkboxes: Book a Jet и Book a Helicopter -->
	<div class="form-checkboxes">
		<div class="form-group checkbox-group">
			<label>
				<input type="checkbox" name="book_jet" value="jet" checked>
				<span><?php esc_html_e('Book a Jet', 'gts-theme'); ?></span>
			</label>
		</div>
		<div class="form-group checkbox-group">
			<label>
				<input type="checkbox" name="book_helicopter" value="helicopter">
				<span><?php esc_html_e('Book a Helicopter', 'gts-theme'); ?></span>
			</label>
		</div>
	</div>

	<!-- Row 3: Select vehicle и Number of passengers -->
	<div class="form-row form-row-after-checkboxes">
		<div class="form-group">
			<select id="vehicle" name="vehicle" required>
				<option value=""><?php esc_html_e('Select vehicle', 'gts-theme'); ?></option>
			</select>
		</div>
		<div class="form-group">
			<select id="passengers" name="passengers" required>
				<option value=""><?php esc_html_e('Number of passengers', 'gts-theme'); ?></option>
			</select>
		</div>
	</div>

	<!-- Row 4: Pick-up time и Pick-up location с Add Stop -->
	<div class="form-row">
		<div class="form-group form-group-datetime">
			<input type="datetime-local" id="pickup-time" name="pickup_time" placeholder="<?php esc_attr_e('Pick-up time', 'gts-theme'); ?>" required>
			<span class="datetime-placeholder"><?php esc_html_e('Pick-up time', 'gts-theme'); ?></span>
		</div>
		<div class="form-group form-group-with-add-stop">
			<input type="text" id="pickup-location" name="pickup_location" placeholder="<?php esc_attr_e('Pick-up location', 'gts-theme'); ?>" required>
			<a href="#" class="add-stop-link">
				<svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4.5 0V9M0 4.5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
				</svg>
				<?php esc_html_e('Add Stop', 'gts-theme'); ?>
			</a>
		</div>
	</div>

	<!-- Row 5: Drop-off location и Additional Notes -->
	<div class="form-row form-row-dropoff-notes">
		<div class="form-group">
			<input type="text" id="dropoff-location" name="dropoff_location" placeholder="<?php esc_attr_e('Drop-off location', 'gts-theme'); ?>" required>
		</div>
		<div class="form-group">
			<textarea id="additional-notes" name="additional_notes" placeholder="<?php esc_attr_e('Additional Notes', 'gts-theme'); ?>" rows="1"></textarea>
		</div>
	</div>

	<!-- Consent -->
	<div class="form-group checkbox-group checkbox-consent">
		<label>
			<input type="checkbox" name="email_consent" value="1" class="consent-checkbox" checked>
			<span><?php esc_html_e('I agree to receive email communication regarding my quote request.', 'gts-theme'); ?></span>
		</label>
	</div>

	<!-- Submit button -->
	<button type="submit" class="booking-submit-btn"><?php esc_html_e('Get My Quote', 'gts-theme'); ?></button>
</form>
