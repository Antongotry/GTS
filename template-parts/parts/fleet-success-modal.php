<?php

/**
 * Fleet success modal (thank you) — partial for fleet-slider block
 *
 * @package GTS
 */
?>
<div class="fleet-success-modal" aria-hidden="true">
	<div class="fleet-booking-overlay" data-success-close></div>
	<div class="fleet-booking-dialog fleet-success-dialog" role="dialog" aria-modal="true" aria-labelledby="fleet-success-title">
		<button class="fleet-booking-close" type="button" aria-label="<?php echo esc_attr__('Close', 'gts-theme'); ?>" data-success-close>×</button>
		<div class="fleet-success-content">
			<div class="fleet-success-icon" aria-hidden="true">✓</div>
			<h3 class="fleet-booking-title" id="fleet-success-title"><?php echo esc_html__('Thank you!', 'gts-theme'); ?></h3>
			<p class="fleet-booking-subtitle">
				<?php echo esc_html__('We have received your request and will contact you shortly.', 'gts-theme'); ?>
			</p>
			<button class="btn btn-secondary fleet-success-button" type="button" data-success-close><?php echo esc_html__('Great', 'gts-theme'); ?></button>
		</div>
	</div>
</div>
