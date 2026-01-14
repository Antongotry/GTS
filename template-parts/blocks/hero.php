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
					<div class="hero-feature">
						<div class="hero-feature-icon">
							<!-- Icon will be added here -->
						</div>
						<p class="hero-feature-text">Licensed & insured, premium fleet</p>
					</div>

					<div class="hero-feature">
						<div class="hero-feature-icon">
							<!-- Icon will be added here -->
						</div>
						<p class="hero-feature-text">Since 2010, trusted by corporate & VIP clients</p>
					</div>

					<div class="hero-feature">
						<div class="hero-feature-icon">
							<!-- Icon will be added here -->
						</div>
						<p class="hero-feature-text">From simple rides to complex itineraries</p>
					</div>
				</div>
			</div>
		</div>

		<!-- Right side with form -->
		<div class="hero-right">
			<form class="booking-form" id="booking-form">
				<div class="form-columns">
					<!-- Left Column -->
					<div class="form-column form-column-left">
						<div class="form-group">
							<input type="text" id="full-name" name="full_name" placeholder="First and Last name" required>
						</div>

						<div class="form-group">
							<input type="email" id="email" name="email" placeholder="E-mail" required>
						</div>

						<div class="form-group">
							<select id="vehicle" name="vehicle" required>
								<option value="">Select vehicle</option>
							</select>
						</div>

						<div class="form-group">
							<input type="datetime-local" id="pickup-time" name="pickup_time" placeholder="Pick-up time" required>
						</div>

						<div class="form-group">
							<input type="text" id="dropoff-location" name="dropoff_location" placeholder="Drop-off location" required>
						</div>
					</div>

					<!-- Right Column -->
					<div class="form-column form-column-right">
						<div class="form-group">
							<input type="tel" id="phone" name="phone" placeholder="Phone" required>
						</div>

						<div class="form-group">
							<select id="service-type" name="service_type" required>
								<option value="">Select service type</option>
							</select>
						</div>

						<div class="form-group">
							<select id="passengers" name="passengers" required>
								<option value="">Number of passengers</option>
							</select>
						</div>

						<div class="form-group">
							<input type="text" id="pickup-location" name="pickup_location" placeholder="Pick-up location" required>
						</div>

						<div class="form-group">
							<a href="#" class="add-stop-link">+ Add Stop</a>
						</div>

						<div class="form-group">
							<textarea id="additional-notes" name="additional_notes" placeholder="Additional Notes" rows="4"></textarea>
						</div>
					</div>
				</div>

				<!-- Checkboxes -->
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

				<!-- Consent -->
				<div class="form-group checkbox-group checkbox-consent">
					<label>
						<input type="checkbox" name="email_consent" value="1" class="consent-checkbox" checked>
						<span>I agree to receive email communication regarding my quote request.</span>
					</label>
				</div>

				<!-- Submit Button -->
				<button type="submit" class="booking-submit-btn">Get My Quote</button>
			</form>

			<!-- World map section -->
			<div class="world-map-section">
				<div class="world-map-image">
					<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/01/noun-world-17688-1_result.webp' ); ?>" alt="World Map">
				</div>
				<div class="world-map-text">
					<p class="world-map-label">clients in</p>
					<p class="world-map-number">100+</p>
					<p class="world-map-label">countries</p>
				</div>
			</div>
		</div>
	</div>
</section>
