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

// Hero feature icons from theme assets (your icons) — inline for reliable display on all devices
$hero_icon_1 = file_get_contents( get_template_directory() . '/assets/icons/icon-1-l.svg' );
$hero_icon_2 = file_get_contents( get_template_directory() . '/assets/icons/icon-2-l.svg' );
$hero_icon_3 = file_get_contents( get_template_directory() . '/assets/icons/icon-3-l.svg' );
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
						<div class="hero-feature-icon" role="img" aria-label="<?php echo esc_attr( __( 'Available in 100+ countries', 'gts-theme' ) ); ?>">
							<?php echo $hero_icon_1 ? wp_kses( $hero_icon_1, gts_allowed_svg_hero() ) : ''; ?>
						</div>
						<p class="hero-feature-text">Available in 100+ countries</p>
					</div>

					<div class="hero-feature hero-feature-top-right"></div>

					<div class="hero-feature hero-feature-bottom-left">
						<div class="hero-feature-icon" role="img" aria-label="<?php echo esc_attr( __( 'Operated by licensed chauffeurs', 'gts-theme' ) ); ?>">
							<?php echo $hero_icon_2 ? wp_kses( $hero_icon_2, gts_allowed_svg_hero() ) : ''; ?>
						</div>
						<p class="hero-feature-text">Operated by licensed chauffeurs<br>with 24/7 support</p>
					</div>

					<div class="hero-feature hero-feature-bottom-right">
						<div class="hero-feature-icon" role="img" aria-label="<?php echo esc_attr( __( 'Licensed & insured, premium fleet', 'gts-theme' ) ); ?>">
							<?php echo $hero_icon_3 ? wp_kses( $hero_icon_3, gts_allowed_svg_hero() ) : ''; ?>
						</div>
						<p class="hero-feature-text">Licensed & insured, premium fleet</p>
					</div>
				</div>

				<div class="hero-features hero-features--mobile hero-features--mobile-in-hero">
					<div class="hero-feature hero-feature-top-left">
						<div class="hero-feature-icon" role="img" aria-label="<?php echo esc_attr( __( 'Available in 100+ countries', 'gts-theme' ) ); ?>">
							<?php echo $hero_icon_1 ? wp_kses( $hero_icon_1, gts_allowed_svg_hero() ) : ''; ?>
						</div>
						<p class="hero-feature-text">Available in 100+ countries</p>
					</div>

					<div class="hero-feature hero-feature-top-right hero-feature-map">
						<div class="world-map-image">
							<img src="<?php echo esc_url(get_site_url() . '/wp-content/uploads/2026/01/noun-world-17688-1_result.webp'); ?>" alt="World Map" width="100" height="100" loading="lazy">
						</div>
						<div class="world-map-text">
							<p class="world-map-label world-map-label-top">clients in</p>
							<div class="world-map-bottom">
								<p class="world-map-number">100+</p>
								<p class="world-map-label world-map-label-bottom">countries</p>
							</div>
						</div>
					</div>

					<div class="hero-feature hero-feature-bottom-left">
						<div class="hero-feature-icon" role="img" aria-label="<?php echo esc_attr( __( 'Operated by licensed chauffeurs', 'gts-theme' ) ); ?>">
							<?php echo $hero_icon_2 ? wp_kses( $hero_icon_2, gts_allowed_svg_hero() ) : ''; ?>
						</div>
						<p class="hero-feature-text">Operated by licensed chauffeurs<br>with 24/7 support</p>
					</div>

					<div class="hero-feature hero-feature-bottom-right">
						<div class="hero-feature-icon" role="img" aria-label="<?php echo esc_attr( __( 'Licensed & insured, premium fleet', 'gts-theme' ) ); ?>">
							<?php echo $hero_icon_3 ? wp_kses( $hero_icon_3, gts_allowed_svg_hero() ) : ''; ?>
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

				<!-- Row 4: Pick-up time и Pick-up location с Add Stop -->
				<div class="form-row">
					<div class="form-group form-group-datetime">
						<input type="datetime-local" id="pickup-time" name="pickup_time" placeholder="Pick-up time" required>
						<span class="datetime-placeholder">Pick-up time</span>
					</div>
					<div class="form-group form-group-with-add-stop">
						<input type="text" id="pickup-location" name="pickup_location" placeholder="Pick-up location" required>
						<a href="#" class="add-stop-link">
							<svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.5 0V9M0 4.5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
							</svg>
							Add Stop
						</a>
					</div>
				</div>

				<!-- Row 5: Drop-off location и Additional Notes -->
				<div class="form-row form-row-dropoff-notes">
					<div class="form-group">
						<input type="text" id="dropoff-location" name="dropoff_location" placeholder="Drop-off location" required>
					</div>
					<div class="form-group">
						<textarea id="additional-notes" name="additional_notes" placeholder="Additional Notes" rows="1"></textarea>
					</div>
				</div>

				<!-- Consent -->
				<div class="form-group checkbox-group checkbox-consent">
					<label>
						<input type="checkbox" name="email_consent" value="1" class="consent-checkbox" checked>
						<span>I agree to receive email communication regarding my quote request.</span>
					</label>
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
