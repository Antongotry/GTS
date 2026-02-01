<?php

/**
 * Hero Block Template for Limousine Service Page
 *
 * @package GTS
 */

// Responsive hero images - different sizes for different devices
$image_mobile = get_site_url() . '/wp-content/uploads/2026/01/375-lm-1_result.webp';
$image_tablet = get_site_url() . '/wp-content/uploads/2026/01/1024-lm-1_result.webp';
$image_desktop = get_site_url() . '/wp-content/uploads/2026/01/1920-lm-1_result-scaled.webp';
?>
<style id="hero-limousine-service-bg">
/* Hero responsive backgrounds for Limousine Service page - optimized for LCP */
/* Mobile: 375px */
.hero-block {
	background-image: url('<?php echo esc_url($image_mobile); ?>') !important;
}
/* Tablet: 1024px */
@media (min-width: 769px) {
	.hero-block {
		background-image: url('<?php echo esc_url($image_tablet); ?>') !important;
	}
}
/* Desktop: 1440px and 1920px - same image */
@media (min-width: 1025px) {
	.hero-block {
		background-image: url('<?php echo esc_url($image_desktop); ?>') !important;
	}
}
</style>

<section class="hero-block">
	<div class="hero-container">
		<!-- Left side -->
		<div class="hero-left">
			<div class="hero-content">
				<h1 class="hero-title">Chauffeur-driven<br>luxury limousine service</h1>

				<p class="hero-description">for business leaders and private clients who expect<br>comfort, style, and flawless coordination.</p>

				<div class="hero-buttons">
					<a href="#" class="btn btn-primary">Book a transfer</a>
				</div>

				<div class="hero-features">
					<div class="hero-feature hero-feature-top-left">
						<div class="hero-feature-icon">
							<img src="<?php echo esc_url( content_url( 'uploads/2026/01/icon-1-l.svg' ) ); ?>" alt="<?php esc_attr_e( 'Available in 100+ countries', 'gts-theme' ); ?>" width="24" height="24" loading="eager">
						</div>
						<p class="hero-feature-text">Available in 100+ countries</p>
					</div>

					<div class="hero-feature hero-feature-top-right"></div>

					<div class="hero-feature hero-feature-bottom-left">
						<div class="hero-feature-icon">
							<img src="<?php echo esc_url( content_url( 'uploads/2026/01/icon-2-home.svg' ) ); ?>" alt="<?php esc_attr_e( 'Operated by licensed chauffeurs', 'gts-theme' ); ?>" width="24" height="24" loading="eager">
						</div>
						<p class="hero-feature-text">Operated by licensed chauffeurs<br>with 24/7 support</p>
					</div>

					<div class="hero-feature hero-feature-bottom-right">
						<div class="hero-feature-icon">
							<img src="<?php echo esc_url( content_url( 'uploads/2026/01/icon-3-l.svg' ) ); ?>" alt="<?php esc_attr_e( 'Licensed & insured, premium fleet', 'gts-theme' ); ?>" width="24" height="24" loading="eager">
						</div>
						<p class="hero-feature-text">Licensed & insured, premium fleet</p>
					</div>
				</div>
			</div>
		</div>

		<!-- Right side with form -->
		<div class="hero-right hero-right--desktop">
			<form class="booking-form" id="booking-form">
				<!-- Row 1: First and Last name и Phone -->
				<div class="form-row">
					<div class="form-group">
						<input type="text" id="full-name" name="full_name" placeholder="First and Last name" required>
					</div>
					<div class="form-group">
						<input type="tel" id="phone" name="phone" placeholder="Phone" required>
					</div>
				</div>

				<!-- Row 2: E-mail и Select service type -->
				<div class="form-row">
					<div class="form-group">
						<input type="email" id="email" name="email" placeholder="E-mail" required>
					</div>
					<div class="form-group">
						<select id="service-type" name="service_type" required>
							<option value="">Select service type</option>
						</select>
					</div>
				</div>

				<!-- Checkboxes: Book a Jet и Book a Helicopter -->
				<div class="form-checkboxes">
					<div class="form-group checkbox-group">
						<label>
							<input type="checkbox" name="book_jet" value="jet" checked>
							<span>Book a Jet</span>
						</label>
					</div>
					<div class="form-group checkbox-group">
						<label>
							<input type="checkbox" name="book_helicopter" value="helicopter">
							<span>Book a Helicopter</span>
						</label>
					</div>
				</div>

				<!-- Row 3: Select vehicle и Number of passengers (32px после чекбоксов) -->
				<div class="form-row form-row-after-checkboxes">
					<div class="form-group">
						<select id="vehicle" name="vehicle" required>
							<option value="">Select vehicle</option>
						</select>
					</div>
					<div class="form-group">
						<select id="passengers" name="passengers" required>
							<option value="">Number of passengers</option>
						</select>
					</div>
				</div>

				<!-- Row 4: Pick-up time и Destination -->
				<div class="form-row">
					<div class="form-group form-group-datetime">
						<input type="datetime-local" id="pickup-time" name="pickup_time" placeholder="Pick-up time" required>
						<span class="datetime-placeholder">Pick-up time</span>
					</div>
					<div class="form-group">
						<input type="text" id="destination" name="destination" placeholder="Destination" required>
					</div>
				</div>

				<!-- Row 5: Comments -->
				<div class="form-row">
					<div class="form-group">
						<textarea id="comments" name="comments" placeholder="Comments" rows="3"></textarea>
					</div>
				</div>

				<!-- Submit button -->
				<button type="submit" class="booking-submit-btn">Get My Quote</button>
			</form>

			<!-- World map section (same as main page) -->
			<div class="world-map-section">
				<div class="world-map-image">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/noun-world-17688-1_result.webp' ); ?>" alt="World Map" loading="lazy" width="100" height="100">
				</div>
				<div class="world-map-divider"></div>
				<div class="world-map-text">
					<p class="world-map-label world-map-label-top">clients in</p>
					<div class="world-map-bottom">
						<p class="world-map-number">100+</p>
						<p class="world-map-label world-map-label-bottom">countries</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
