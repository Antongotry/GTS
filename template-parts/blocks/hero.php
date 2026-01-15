<?php
/**
 * Hero Block Template
 *
 * @package GTS
 */

// Get image URL from WordPress media library
$image_url = get_site_url() . '/wp-content/uploads/2026/01/26_result-scaled.webp';
?>

<section class="hero-block" style="background-image: url('<?php echo esc_url( $image_url ); ?>');">
	<div class="hero-container">
		<!-- Left side -->
		<div class="hero-left">
			<div class="hero-content">
				<p class="hero-subtitle">Your route. Our responsibility.</p>
				<h1 class="hero-title">Premium transfers for corporate and private clients – 24/7 coordination</h1>

				<div class="hero-buttons">
					<a href="#" class="btn btn-primary">Book a transfer</a>
					<a href="#" class="btn btn-secondary">Explore services</a>
				</div>

				<div class="hero-features">
					<div class="hero-feature hero-feature-top-left">
						<div class="hero-feature-icon">
							<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/icon-1-home.svg' ); ?>" alt="Premium fleet">
						</div>
						<p class="hero-feature-text">Licensed & insured, premium fleet</p>
					</div>

					<div class="hero-feature hero-feature-top-right"></div>

					<div class="hero-feature hero-feature-bottom-left">
						<div class="hero-feature-icon">
							<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/icon-2-home.svg' ); ?>" alt="Trusted since 2010">
						</div>
						<p class="hero-feature-text">Since 2010, trusted by corporate & VIP clients</p>
					</div>

					<div class="hero-feature hero-feature-bottom-right">
						<div class="hero-feature-icon">
							<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/icon-3-home.svg' ); ?>" alt="Complex itineraries">
						</div>
						<p class="hero-feature-text">From simple rides to complex itineraries</p>
					</div>

					<div class="hero-feature-divider hero-feature-divider-center"></div>
					<div class="hero-feature-divider hero-feature-divider-vertical"></div>
					<div class="hero-feature-divider hero-feature-divider-horizontal"></div>
				</div>
			</div>
		</div>

		<!-- Right side with form -->
		<div class="hero-right">
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
					<div class="form-group">
						<input type="datetime-local" id="pickup-time" name="pickup_time" placeholder="Pick-up time" required>
					</div>
					<div class="form-group form-group-with-add-stop">
						<input type="text" id="pickup-location" name="pickup_location" placeholder="Pick-up location" required>
						<a href="#" class="add-stop-link">
							<svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.5 0V9M0 4.5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
							</svg>
							Add Stop
						</a>
					</div>
				</div>

				<!-- Row 5: Drop-off location и Additional Notes (24px после предыдущего ряда) -->
				<div class="form-row form-row-dropoff-notes">
					<div class="form-group">
						<input type="text" id="dropoff-location" name="dropoff_location" placeholder="Drop-off location" required>
					</div>
					<div class="form-group">
						<textarea id="additional-notes" name="additional_notes" placeholder="Additional Notes" rows="1"></textarea>
					</div>
				</div>

				<!-- Consent (24px после предыдущего ряда) -->
				<div class="form-group checkbox-group checkbox-consent">
					<label>
						<input type="checkbox" name="email_consent" value="1" class="consent-checkbox" checked>
						<span>I agree to receive email communication regarding my quote request.</span>
					</label>
				</div>

				<!-- Submit Button (24px после consent) -->
				<button type="submit" class="booking-submit-btn">Get My Quote</button>
			</form>

			<!-- World map section -->
			<div class="world-map-section">
				<div class="world-map-image">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/noun-world-17688-1_result.webp' ); ?>" alt="World Map">
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
