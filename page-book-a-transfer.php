<?php

/**
 * Template Name: Book a Transfer
 * Multi-step calculator form for booking transfers
 *
 * @package GTS
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="transfer-page">
		<div class="transfer-container">

			<!-- Header -->
			<header class="transfer-header">
				<h1 class="transfer-title">Book a Transfer</h1>
				<p class="transfer-subtitle">Instant estimate for standard routes. For complex trips — we'll confirm the exact price within 30 minutes.</p>
			</header>

			<div class="transfer-layout">

				<!-- Form Card -->
				<div class="transfer-form-card">
					<form id="transfer-form">

						<!-- 1. Trip Details -->
						<div class="transfer-section">
							<h2 class="transfer-section-title">1. Trip details</h2>

							<div class="transfer-row location">
								<div class="transfer-field">
									<label class="transfer-label">From*</label>
									<input type="text" class="transfer-input" placeholder="Enter pickup location" name="from" required>
								</div>
								<button type="button" class="swap-btn" title="Swap locations">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
										<path d="M7 16V4M7 4L3 8M7 4l4 4M17 8v12M17 20l4-4M17 20l-4-4"></path>
									</svg>
								</button>
								<div class="transfer-field">
									<label class="transfer-label">To*</label>
									<input type="text" class="transfer-input" placeholder="Enter drop-off location" name="to" required>
								</div>
							</div>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label">Date*</label>
									<input type="date" class="transfer-input" name="date" required>
								</div>
								<div class="transfer-field">
									<label class="transfer-label">Time*</label>
									<input type="time" class="transfer-input" name="time" required>
								</div>
							</div>

							<p class="transfer-return-label">Return details:</p>
							<div class="transfer-checkbox-group">
								<label class="transfer-checkbox">
									<input type="checkbox" name="same_day" checked>
									<span>Same day</span>
								</label>
							</div>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label">Return date*</label>
									<input type="date" class="transfer-input" name="return_date">
								</div>
								<div class="transfer-field">
									<label class="transfer-label">Return time*</label>
									<input type="time" class="transfer-input" name="return_time">
								</div>
							</div>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label">Passengers*</label>
									<select class="transfer-select" name="passengers" required>
										<option value="">Number of passengers</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7+</option>
									</select>
								</div>
								<div class="transfer-field">
									<label class="transfer-label">Luggage*</label>
									<select class="transfer-select" name="luggage">
										<option value="">Hand luggage (0-x)</option>
										<option value="0">No luggage</option>
										<option value="1">1 bag</option>
										<option value="2">2 bags</option>
										<option value="3">3 bags</option>
										<option value="4">4+ bags</option>
									</select>
								</div>
							</div>
						</div>

						<!-- 2. Vehicle & preferences -->
						<div class="transfer-section">
							<h2 class="transfer-section-title">2. Vehicle & preferences</h2>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label">Vehicle type*</label>
									<select class="transfer-select" name="vehicle_type" required>
										<option value="sedan">Sedan</option>
										<option value="suv">SUV</option>
										<option value="van">Van</option>
										<option value="limousine">Limousine</option>
										<option value="minibus">Minibus</option>
									</select>
								</div>
								<div class="transfer-field">
									<label class="transfer-label">Driver language*</label>
									<select class="transfer-select" name="driver_language">
										<option value="en">EN</option>
										<option value="de">DE</option>
										<option value="fr">FR</option>
										<option value="es">ES</option>
										<option value="it">IT</option>
									</select>
								</div>
							</div>

							<div class="transfer-checkbox-group">
								<label class="transfer-checkbox">
									<input type="checkbox" name="book_jet">
									<span>Book a Jet</span>
								</label>
								<label class="transfer-checkbox">
									<input type="checkbox" name="book_helicopter">
									<span>Book a Helicopter</span>
								</label>
							</div>

							<p class="transfer-requests-label">Additional requests</p>

							<div class="transfer-checkbox-group">
								<label class="transfer-checkbox">
									<input type="checkbox" name="child_seat">
									<span>Child seat</span>
								</label>
								<label class="transfer-checkbox">
									<input type="checkbox" name="meet_greet">
									<span>Meet & greet</span>
								</label>
								<label class="transfer-checkbox">
									<input type="checkbox" name="extra_stop">
									<span>Extra stop</span>
								</label>
								<label class="transfer-checkbox">
									<input type="checkbox" name="vip_protocol">
									<span>VIP protocol</span>
								</label>
							</div>

							<div class="transfer-field">
								<input type="text" class="transfer-input" placeholder="Other notes" name="other_notes">
							</div>
						</div>

						<!-- 3. Contact details -->
						<div class="transfer-section">
							<h2 class="transfer-section-title">3. Contact details</h2>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label">Full name*</label>
									<input type="text" class="transfer-input" placeholder="First and Last name" name="full_name" required>
								</div>
								<div class="transfer-field">
									<label class="transfer-label">Phone*</label>
									<input type="tel" class="transfer-input" placeholder="+44 00 1111 2222" name="phone" required>
								</div>
							</div>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label">E-mail*</label>
									<input type="email" class="transfer-input" placeholder="info@gmail.com" name="email" required>
								</div>
								<div class="transfer-field">
									<label class="transfer-label">Notes</label>
									<input type="text" class="transfer-input" placeholder="Your message" name="notes">
								</div>
							</div>
						</div>

					</form>
				</div>

				<!-- Summary Card -->
				<aside class="transfer-summary">
					<h3 class="transfer-summary-title">Summary</h3>

					<div class="transfer-summary-row">
						<span class="transfer-summary-label">Route:</span>
						<span class="transfer-summary-value" id="summary-route">From → To</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label">Date:</span>
						<span class="transfer-summary-value" id="summary-date">Dec. 26, 2026</span>
						<span class="transfer-summary-label" style="margin-left: 16px;">Time:</span>
						<span class="transfer-summary-value" id="summary-time">08:00</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label">Passengers:</span>
						<span class="transfer-summary-value" id="summary-passengers">4</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label">Vehicle:</span>
						<span class="transfer-summary-value" id="summary-vehicle">Sedan</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label">Language:</span>
						<span class="transfer-summary-value" id="summary-language">EN</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label">Extras:</span>
						<span class="transfer-summary-value" id="summary-extras">...</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label">Distance & duration:</span>
						<span class="transfer-summary-value" id="summary-distance">23 km / 35 min</span>
					</div>

					<div class="transfer-summary-divider"></div>

					<div class="transfer-summary-price-row">
						<span class="transfer-summary-label">Estimated price:</span>
						<span class="transfer-summary-price" id="summary-price">€ 1000</span>
					</div>
					<p class="transfer-summary-note">Final price confirmed by manager. No online payments.</p>

					<div class="transfer-summary-divider"></div>

					<div class="transfer-consent">
						<label>
							<input type="checkbox" name="consent" required>
							<span>I agree to receive email communication regarding my quote request.</span>
						</label>
					</div>

					<button type="submit" form="transfer-form" class="transfer-submit">Request booking</button>

					<p class="transfer-confirm">We'll confirm within 15 minutes.</p>
				</aside>

			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
