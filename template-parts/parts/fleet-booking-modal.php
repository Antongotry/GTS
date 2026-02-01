<?php

/**
 * Fleet booking modal (form) — partial for fleet-slider block
 *
 * @package GTS
 */
?>
<div class="fleet-booking-modal" aria-hidden="true">
	<div class="fleet-booking-overlay" data-modal-close></div>
	<div class="fleet-booking-dialog" role="dialog" aria-modal="true" aria-labelledby="fleet-booking-title">
		<button class="fleet-booking-close" type="button" aria-label="<?php echo esc_attr__('Close', 'gts-theme'); ?>" data-modal-close>×</button>
		<div class="fleet-booking-content">
			<h3 class="fleet-booking-title" id="fleet-booking-title"><?php echo esc_html__('Book this vehicle', 'gts-theme'); ?></h3>
			<p class="fleet-booking-subtitle">
				<?php echo esc_html__('We will confirm availability and get back to you shortly.', 'gts-theme'); ?>
			</p>
			<form class="fleet-booking-form" id="fleet-booking-form">
				<input type="hidden" name="vehicle" id="fleet-vehicle-field" value="">
				<div class="fleet-form-row fleet-form-row--full">
					<label for="fleet-name"><?php echo esc_html__('Name', 'gts-theme'); ?></label>
					<input type="text" id="fleet-name" name="name" placeholder="<?php echo esc_attr__('Your name', 'gts-theme'); ?>" required>
				</div>
				<div class="fleet-form-row">
					<label for="fleet-phone"><?php echo esc_html__('Phone', 'gts-theme'); ?></label>
					<input type="tel" id="fleet-phone" name="phone" placeholder="<?php echo esc_attr__('Phone number', 'gts-theme'); ?>" required>
				</div>
				<div class="fleet-form-row">
					<label for="fleet-email"><?php echo esc_html__('Email', 'gts-theme'); ?></label>
					<input type="email" id="fleet-email" name="email" placeholder="<?php echo esc_attr__('Email address', 'gts-theme'); ?>" required>
				</div>
				<div class="fleet-form-row">
					<label for="fleet-passengers"><?php echo esc_html__('Number of passengers', 'gts-theme'); ?></label>
					<input type="number" id="fleet-passengers" name="passengers" min="1" placeholder="<?php echo esc_attr__('Passengers', 'gts-theme'); ?>">
				</div>
				<div class="fleet-form-row">
					<label for="fleet-pickup"><?php echo esc_html__('Pick-up time', 'gts-theme'); ?></label>
					<input type="datetime-local" id="fleet-pickup" name="pickup_time">
				</div>
				<div class="fleet-form-row fleet-form-row--full">
					<label for="fleet-comment"><?php echo esc_html__('Comment', 'gts-theme'); ?></label>
					<textarea id="fleet-comment" name="comment" rows="3" placeholder="<?php echo esc_attr__('Additional details', 'gts-theme'); ?>"></textarea>
				</div>
				<button class="btn btn-primary fleet-form-submit" type="submit"><?php echo esc_html__('Send request', 'gts-theme'); ?></button>
			</form>
		</div>
	</div>
</div>
