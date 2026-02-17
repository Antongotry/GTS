<?php

/**
 * Hero Block Template for City-to-City Service Page
 *
 * @package GTS
 */

$image_mobile  = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-of-city-375_result.webp';
$image_tablet  = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-of-city-1024_result.webp';
$image_desktop = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/02/city-of-city-1920_result-scaled.webp';

$hero_icon_1 = file_get_contents( get_template_directory() . '/assets/icons/icon-1-l.svg' );
$hero_icon_2 = file_get_contents( get_template_directory() . '/assets/icons/icon-2-l.svg' );
$hero_icon_3 = file_get_contents( get_template_directory() . '/assets/icons/icon-3-l.svg' );
?>
<style id="hero-city-to-city-service-bg">
.hero-block {
	background-image: url('<?php echo esc_url( $image_mobile ); ?>') !important;
}

@media (min-width: 769px) {
	.hero-block {
		background-image: url('<?php echo esc_url( $image_tablet ); ?>') !important;
	}
}

@media (min-width: 1025px) {
	.hero-block {
		background-image: url('<?php echo esc_url( $image_desktop ); ?>') !important;
	}
}
</style>

<section class="hero-block">
	<div class="hero-container">
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
			</div>
		</div>

		<div class="hero-right hero-right--desktop">
			<form class="booking-form" id="booking-form">
				<div class="form-row">
					<div class="form-group">
						<input type="text" id="full-name" name="full_name" placeholder="First and Last name" required>
					</div>
					<div class="form-group">
						<input type="tel" id="phone" name="phone" placeholder="Phone" required>
					</div>
				</div>

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

				<div class="form-row form-row-dropoff-notes">
					<div class="form-group">
						<input type="text" id="dropoff-location" name="dropoff_location" placeholder="Drop-off location" required>
					</div>
					<div class="form-group">
						<textarea id="additional-notes" name="additional_notes" placeholder="Additional Notes" rows="1"></textarea>
					</div>
				</div>

				<div class="form-group checkbox-group checkbox-consent">
					<label>
						<input type="checkbox" name="email_consent" value="1" class="consent-checkbox" checked>
						<span>I agree to receive email communication regarding my quote request.</span>
					</label>
				</div>

				<button type="submit" class="booking-submit-btn">Get My Quote</button>
			</form>

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
