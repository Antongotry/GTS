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
		</div>
	</div>
</section>
