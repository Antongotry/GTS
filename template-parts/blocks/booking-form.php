<?php
/**
 * Booking Form Block Template
 * 
 * @package GTS
 */
?>

<section class="booking-form-block">
	<div class="booking-form-container">
		<!-- Left side -->
		<div class="booking-form-left">
			<!-- Left content will be added here -->
		</div>

		<!-- Right side with form -->
		<div class="booking-form-right">
			<form class="booking-form" id="booking-form">
				<!-- Contact Information -->
				<div class="form-section">
					<h3 class="form-section-title">Contact Information</h3>
					
					<div class="form-group">
						<label for="full-name">First and Last name</label>
						<input type="text" id="full-name" name="full_name" required>
					</div>

					<div class="form-group">
						<label for="phone">Phone</label>
						<input type="tel" id="phone" name="phone" required>
					</div>

					<div class="form-group">
						<label for="email">E-mail</label>
						<input type="email" id="email" name="email" required>
					</div>

					<div class="form-group">
						<label for="service-type">Select service type</label>
						<select id="service-type" name="service_type" required>
							<option value="">Select...</option>
						</select>
					</div>
				</div>

				<!-- Service Selection -->
				<div class="form-section">
					<h3 class="form-section-title">Service Selection</h3>
					
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

				<!-- Travel Details -->
				<div class="form-section">
					<h3 class="form-section-title">Travel Details</h3>
					
					<div class="form-group">
						<label for="vehicle">Select vehicle</label>
						<select id="vehicle" name="vehicle" required>
							<option value="">Select...</option>
						</select>
					</div>

					<div class="form-group">
						<label for="passengers">Number of passengers</label>
						<select id="passengers" name="passengers" required>
							<option value="">Select...</option>
						</select>
					</div>

					<div class="form-group">
						<label for="pickup-time">Pick-up time</label>
						<input type="datetime-local" id="pickup-time" name="pickup_time" required>
					</div>

					<div class="form-group">
						<label for="pickup-location">Pick-up location</label>
						<input type="text" id="pickup-location" name="pickup_location" required>
					</div>

					<div class="form-group">
						<a href="#" class="add-stop-link">+ Add Stop</a>
					</div>

					<div class="form-group">
						<label for="dropoff-location">Drop-off location</label>
						<input type="text" id="dropoff-location" name="dropoff_location" required>
					</div>

					<div class="form-group">
						<label for="additional-notes">Additional Notes</label>
						<textarea id="additional-notes" name="additional_notes" rows="4"></textarea>
					</div>
				</div>

				<!-- Consent -->
				<div class="form-section">
					<div class="form-group checkbox-group checkbox-consent">
						<label>
							<input type="checkbox" name="email_consent" value="1" class="consent-checkbox">
							<span>I agree to receive email communication regarding my quote request.</span>
						</label>
					</div>
				</div>

				<!-- Submit Button -->
				<div class="form-section">
					<button type="submit" class="booking-submit-btn">Get My Quote</button>
				</div>
			</form>
		</div>
	</div>
</section>
