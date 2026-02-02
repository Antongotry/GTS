<?php

/**
 * Template Name: Checkout Calculator
 * Template for Book a Transfer checkout/calculator page
 *
 * @package GTS
 */

get_header();
$site_url = get_site_url();
?>

<style>
	/* =====================================================
   CHECKOUT PAGE STYLES
   Using exact GTS design tokens
   ===================================================== */

	.checkout-page {
		background: #0C0F17;
		min-height: 100vh;
		padding: 60px 0 80px;
	}

	.checkout-container {
		max-width: 1400px;
		margin: 0 auto;
		padding: 0 40px;
	}

	/* Header */
	.checkout-header {
		display: flex;
		justify-content: space-between;
		align-items: flex-start;
		margin-bottom: 40px;
		padding-bottom: 24px;
		border-bottom: 1px solid rgba(255, 255, 255, 0.1);
	}

	.checkout-title {
		font-family: "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 40px;
		font-weight: 500;
		color: #FFFFFF;
		margin: 0;
		letter-spacing: -0.02em;
		line-height: 1.1;
	}

	.checkout-subtitle {
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 14px;
		font-weight: 400;
		color: rgba(255, 255, 255, 0.6);
		max-width: 320px;
		line-height: 1.5;
		margin: 0;
	}

	/* Main Layout */
	.checkout-layout {
		display: grid;
		grid-template-columns: 1fr 380px;
		gap: 60px;
		align-items: start;
	}

	/* Form Card */
	.checkout-form-card {
		background: rgba(255, 255, 255, 0.08);
		border-radius: 16px;
		padding: 40px;
	}

	/* Section */
	.checkout-section {
		margin-bottom: 40px;
	}

	.checkout-section:last-child {
		margin-bottom: 0;
	}

	.checkout-section-title {
		font-family: "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 24px;
		font-weight: 500;
		color: #FFFFFF;
		margin: 0 0 24px 0;
		letter-spacing: -0.02em;
		line-height: 1.1;
	}

	/* Form Row */
	.checkout-form-row {
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 24px;
		margin-bottom: 16px;
	}

	.checkout-form-row.single {
		grid-template-columns: 1fr;
	}

	/* Form Group */
	.checkout-form-group {
		display: flex;
		flex-direction: column;
		gap: 8px;
	}

	.checkout-form-group.with-swap {
		position: relative;
	}

	.checkout-form-label {
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 14px;
		font-weight: 400;
		color: #FFFFFF;
		line-height: 1;
	}

	.checkout-form-input,
	.checkout-form-select,
	.checkout-form-textarea {
		width: 100%;
		padding: 12px 0;
		border: none;
		border-bottom: 1px solid rgba(255, 255, 255, 0.32);
		border-radius: 0;
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 14px;
		font-weight: 400;
		background: transparent;
		color: #FFFFFF;
		box-sizing: border-box;
		transition: border-color 0.3s ease;
		outline: none;
	}

	.checkout-form-input::placeholder,
	.checkout-form-select::placeholder,
	.checkout-form-textarea::placeholder {
		color: rgba(255, 255, 255, 0.56);
		opacity: 1;
	}

	.checkout-form-input:focus,
	.checkout-form-select:focus,
	.checkout-form-textarea:focus {
		border-bottom-color: rgba(255, 255, 255, 0.6);
	}

	.checkout-form-select {
		appearance: none;
		-webkit-appearance: none;
		-moz-appearance: none;
		background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1.5L6 6.5L11 1.5' stroke='rgba(255,255,255,0.56)' stroke-width='1.5' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
		background-repeat: no-repeat;
		background-position: right 0 center;
		padding-right: 20px;
		cursor: pointer;
	}

	.checkout-form-select option {
		background: #1A1D26;
		color: #FFFFFF;
	}

	/* Swap Button */
	.swap-locations-btn {
		position: absolute;
		right: -36px;
		top: 50%;
		transform: translateY(-50%);
		width: 28px;
		height: 28px;
		border-radius: 50%;
		background: rgba(255, 255, 255, 0.1);
		border: 1px solid rgba(255, 255, 255, 0.2);
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		transition: all 0.2s ease;
	}

	.swap-locations-btn:hover {
		background: rgba(255, 255, 255, 0.15);
	}

	.swap-locations-btn svg {
		width: 14px;
		height: 14px;
		color: #FFFFFF;
	}

	/* Return Details */
	.checkout-return-details {
		margin-top: 8px;
		margin-bottom: 16px;
	}

	.checkout-return-label {
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 14px;
		font-weight: 400;
		color: rgba(255, 255, 255, 0.6);
		margin-bottom: 12px;
	}

	/* Checkbox Group */
	.checkout-checkbox-group {
		display: flex;
		flex-wrap: wrap;
		gap: 24px;
		margin-bottom: 16px;
	}

	.checkout-checkbox-label {
		display: flex;
		align-items: center;
		cursor: pointer;
		gap: 10px;
	}

	.checkout-checkbox-label input[type="checkbox"] {
		width: 20px;
		height: 20px;
		margin: 0;
		cursor: pointer;
		appearance: none;
		-webkit-appearance: none;
		-moz-appearance: none;
		border: 1px solid rgba(255, 255, 255, 0.32);
		border-radius: 0;
		position: relative;
		flex-shrink: 0;
		transition: all 0.2s ease;
		background: transparent;
	}

	.checkout-checkbox-label input[type="checkbox"]:checked {
		border-color: #FFFFFF;
		background: transparent;
	}

	.checkout-checkbox-label input[type="checkbox"]:checked::after {
		content: "";
		position: absolute;
		left: 50%;
		top: 50%;
		width: 20px;
		height: 20px;
		background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 20 20'%3E%3Cpath d='M5 10l3 3 7-7' stroke='%23FFFFFF' stroke-width='1.5' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
		background-size: contain;
		background-repeat: no-repeat;
		background-position: center;
		transform: translate(-50%, -50%);
	}

	.checkout-checkbox-label span {
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 14px;
		font-weight: 400;
		color: #FFFFFF;
		line-height: 1;
	}

	/* Additional Requests Label */
	.checkout-requests-label {
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 14px;
		font-weight: 400;
		color: rgba(255, 255, 255, 0.6);
		margin-bottom: 12px;
	}

	/* Summary Card */
	.checkout-summary-card {
		background: #FFFFFF;
		border-radius: 16px;
		padding: 32px;
		position: sticky;
		top: 100px;
	}

	.checkout-summary-title {
		font-family: "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 28px;
		font-weight: 500;
		color: #0C0F17;
		margin: 0 0 24px 0;
		letter-spacing: -0.02em;
		line-height: 1.1;
	}

	.checkout-summary-row {
		display: flex;
		justify-content: space-between;
		margin-bottom: 8px;
	}

	.checkout-summary-label {
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 14px;
		font-weight: 400;
		color: rgba(12, 15, 23, 0.56);
	}

	.checkout-summary-value {
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 14px;
		font-weight: 400;
		color: #0C0F17;
	}

	.checkout-summary-divider {
		height: 1px;
		background: rgba(12, 15, 23, 0.1);
		margin: 16px 0;
	}

	.checkout-summary-price-row {
		display: flex;
		justify-content: space-between;
		align-items: baseline;
		margin-bottom: 8px;
	}

	.checkout-summary-price-label {
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 14px;
		font-weight: 400;
		color: rgba(12, 15, 23, 0.56);
	}

	.checkout-summary-price {
		font-family: "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 24px;
		font-weight: 500;
		color: #0C0F17;
	}

	.checkout-summary-note {
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 13px;
		font-weight: 400;
		color: rgba(12, 15, 23, 0.56);
		margin-bottom: 24px;
	}

	/* Summary Consent */
	.checkout-summary-consent {
		margin-bottom: 16px;
	}

	.checkout-summary-consent label {
		display: flex;
		align-items: flex-start;
		gap: 12px;
		cursor: pointer;
	}

	.checkout-summary-consent input[type="checkbox"] {
		width: 20px;
		height: 20px;
		margin: 0;
		margin-top: 2px;
		cursor: pointer;
		appearance: none;
		-webkit-appearance: none;
		-moz-appearance: none;
		border: 1px solid rgba(12, 15, 23, 0.32);
		border-radius: 0;
		position: relative;
		flex-shrink: 0;
		transition: all 0.2s ease;
		background: transparent;
	}

	.checkout-summary-consent input[type="checkbox"]:checked {
		border-color: #0C0F17;
		background: #0C0F17;
	}

	.checkout-summary-consent input[type="checkbox"]:checked::after {
		content: "";
		position: absolute;
		left: 50%;
		top: 50%;
		width: 14px;
		height: 14px;
		background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 14 14'%3E%3Cpath d='M3 7l2.5 2.5 5-5' stroke='%23FFFFFF' stroke-width='1.5' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
		background-size: contain;
		background-repeat: no-repeat;
		background-position: center;
		transform: translate(-50%, -50%);
	}

	.checkout-summary-consent span {
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 13px;
		font-weight: 400;
		color: #0C0F17;
		line-height: 1.4;
	}

	/* Submit Button - Using existing btn-primary style */
	.checkout-submit-btn {
		width: 100%;
		padding: 0 24px;
		height: 56px;
		border-radius: 50px;
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 14px;
		font-weight: 400;
		color: #000000;
		border: none;
		background: linear-gradient(to right, #FDDFAE 0%, #F4C58B 50%, #F7CE95 100%);
		cursor: pointer;
		display: flex;
		align-items: center;
		justify-content: center;
		transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		position: relative;
		overflow: hidden;
		margin-bottom: 16px;
	}

	.checkout-submit-btn::before {
		content: "";
		position: absolute;
		top: 0;
		left: -100%;
		width: 100%;
		height: 100%;
		background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
		transition: left 0.5s ease;
	}

	.checkout-submit-btn:hover {
		background: linear-gradient(to right, #FEE5C0 0%, #F5CE9B 50%, #F8D5A5 100%);
	}

	.checkout-submit-btn:hover::before {
		left: 100%;
	}

	.checkout-summary-confirm {
		font-family: "Manrope", "Visby CF", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		font-size: 13px;
		font-weight: 400;
		color: rgba(12, 15, 23, 0.56);
		text-align: center;
	}

	/* =====================================================
   RESPONSIVE STYLES
   ===================================================== */

	@media (max-width: 1200px) {
		.checkout-layout {
			grid-template-columns: 1fr 340px;
			gap: 40px;
		}
	}

	@media (max-width: 1024px) {
		.checkout-layout {
			grid-template-columns: 1fr;
		}

		.checkout-summary-card {
			position: static;
		}

		.checkout-header {
			flex-direction: column;
			gap: 16px;
		}

		.checkout-container {
			padding: 0 24px;
		}
	}

	@media (max-width: 768px) {
		.checkout-page {
			padding: 40px 0 60px;
		}

		.checkout-form-card {
			padding: 24px;
		}

		.checkout-form-row {
			grid-template-columns: 1fr;
			gap: 16px;
		}

		.checkout-title {
			font-size: 32px;
		}

		.swap-locations-btn {
			position: static;
			transform: none;
			margin: 8px 0;
			align-self: center;
		}

		.checkout-form-group.with-swap {
			flex-direction: column;
		}

		.checkout-checkbox-group {
			flex-direction: column;
			gap: 16px;
		}
	}

	@media (max-width: 480px) {
		.checkout-container {
			padding: 0 16px;
		}

		.checkout-form-card {
			padding: 20px;
		}

		.checkout-summary-card {
			padding: 24px;
		}
	}
</style>

<main id="primary" class="site-main">
	<div class="checkout-page">
		<div class="checkout-container">

			<!-- Header -->
			<header class="checkout-header">
				<h1 class="checkout-title">Book a Transfer</h1>
				<p class="checkout-subtitle">Instant estimate for standard routes. For complex trips — we'll confirm the exact price within 30 minutes.</p>
			</header>

			<div class="checkout-layout">

				<!-- Form Card -->
				<div class="checkout-form-card">
					<form id="checkout-form">

						<!-- 1. Trip Details -->
						<div class="checkout-section">
							<h2 class="checkout-section-title">1. Trip details</h2>

							<div class="checkout-form-row">
								<div class="checkout-form-group with-swap">
									<label class="checkout-form-label">From*</label>
									<input type="text" class="checkout-form-input" placeholder="Enter pickup location" name="from" required>
									<button type="button" class="swap-locations-btn" title="Swap locations">
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
											<path d="M7 16V4M7 4L3 8M7 4l4 4M17 8v12M17 20l4-4M17 20l-4-4"></path>
										</svg>
									</button>
								</div>
								<div class="checkout-form-group">
									<label class="checkout-form-label">To*</label>
									<input type="text" class="checkout-form-input" placeholder="Enter drop-off location" name="to" required>
								</div>
							</div>

							<div class="checkout-form-row">
								<div class="checkout-form-group">
									<label class="checkout-form-label">Date*</label>
									<input type="date" class="checkout-form-input" name="date" required>
								</div>
								<div class="checkout-form-group">
									<label class="checkout-form-label">Time*</label>
									<input type="time" class="checkout-form-input" name="time" required>
								</div>
							</div>

							<div class="checkout-return-details">
								<p class="checkout-return-label">Return details:</p>
								<div class="checkout-checkbox-group">
									<label class="checkout-checkbox-label">
										<input type="checkbox" name="same_day" checked>
										<span>Same day</span>
									</label>
								</div>
							</div>

							<div class="checkout-form-row">
								<div class="checkout-form-group">
									<label class="checkout-form-label">Return date*</label>
									<input type="date" class="checkout-form-input" name="return_date">
								</div>
								<div class="checkout-form-group">
									<label class="checkout-form-label">Return time*</label>
									<input type="time" class="checkout-form-input" name="return_time">
								</div>
							</div>

							<div class="checkout-form-row">
								<div class="checkout-form-group">
									<label class="checkout-form-label">Passengers*</label>
									<select class="checkout-form-select" name="passengers" required>
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
								<div class="checkout-form-group">
									<label class="checkout-form-label">Luggage*</label>
									<select class="checkout-form-select" name="luggage">
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
						<div class="checkout-section">
							<h2 class="checkout-section-title">2. Vehicle & preferences</h2>

							<div class="checkout-form-row">
								<div class="checkout-form-group">
									<label class="checkout-form-label">Vehicle type*</label>
									<select class="checkout-form-select" name="vehicle_type" required>
										<option value="sedan">Sedan</option>
										<option value="suv">SUV</option>
										<option value="van">Van</option>
										<option value="limousine">Limousine</option>
										<option value="minibus">Minibus</option>
									</select>
								</div>
								<div class="checkout-form-group">
									<label class="checkout-form-label">Driver language*</label>
									<select class="checkout-form-select" name="driver_language">
										<option value="en">EN</option>
										<option value="de">DE</option>
										<option value="fr">FR</option>
										<option value="es">ES</option>
										<option value="it">IT</option>
									</select>
								</div>
							</div>

							<div class="checkout-checkbox-group">
								<label class="checkout-checkbox-label">
									<input type="checkbox" name="book_jet">
									<span>Book a Jet</span>
								</label>
								<label class="checkout-checkbox-label">
									<input type="checkbox" name="book_helicopter">
									<span>Book a Helicopter</span>
								</label>
							</div>

							<p class="checkout-requests-label">Additional requests</p>

							<div class="checkout-checkbox-group">
								<label class="checkout-checkbox-label">
									<input type="checkbox" name="child_seat">
									<span>Child seat</span>
								</label>
								<label class="checkout-checkbox-label">
									<input type="checkbox" name="meet_greet">
									<span>Meet & greet</span>
								</label>
								<label class="checkout-checkbox-label">
									<input type="checkbox" name="extra_stop">
									<span>Extra stop</span>
								</label>
								<label class="checkout-checkbox-label">
									<input type="checkbox" name="vip_protocol">
									<span>VIP protocol</span>
								</label>
							</div>

							<div class="checkout-form-row single">
								<div class="checkout-form-group">
									<input type="text" class="checkout-form-input" placeholder="Other notes" name="other_notes">
								</div>
							</div>
						</div>

						<!-- 3. Contact details -->
						<div class="checkout-section">
							<h2 class="checkout-section-title">3. Contact details</h2>

							<div class="checkout-form-row">
								<div class="checkout-form-group">
									<label class="checkout-form-label">Full name*</label>
									<input type="text" class="checkout-form-input" placeholder="First and Last name" name="full_name" required>
								</div>
								<div class="checkout-form-group">
									<label class="checkout-form-label">Phone*</label>
									<input type="tel" class="checkout-form-input" placeholder="First and Last name" name="phone" required>
								</div>
							</div>

							<div class="checkout-form-row">
								<div class="checkout-form-group">
									<label class="checkout-form-label">E-mail*</label>
									<input type="email" class="checkout-form-input" placeholder="info@gmail.com" name="email" required>
								</div>
								<div class="checkout-form-group">
									<label class="checkout-form-label">Notes</label>
									<textarea class="checkout-form-textarea checkout-form-input" placeholder="Your message" name="notes" rows="1"></textarea>
								</div>
							</div>
						</div>

					</form>
				</div>

				<!-- Summary Card -->
				<aside class="checkout-summary-card">
					<h3 class="checkout-summary-title">Summary</h3>

					<div class="checkout-summary-row">
						<span class="checkout-summary-label">Route:</span>
						<span class="checkout-summary-value" id="summary-route">From → To</span>
					</div>
					<div class="checkout-summary-row">
						<span class="checkout-summary-label">Date:</span>
						<span class="checkout-summary-value" id="summary-date">Dec. 26, 2026</span>
						<span class="checkout-summary-label" style="margin-left: 16px;">Time:</span>
						<span class="checkout-summary-value" id="summary-time">08:00</span>
					</div>
					<div class="checkout-summary-row">
						<span class="checkout-summary-label">Passengers:</span>
						<span class="checkout-summary-value" id="summary-passengers">4</span>
					</div>
					<div class="checkout-summary-row">
						<span class="checkout-summary-label">Vehicle:</span>
						<span class="checkout-summary-value" id="summary-vehicle">Sedan</span>
					</div>
					<div class="checkout-summary-row">
						<span class="checkout-summary-label">Language:</span>
						<span class="checkout-summary-value" id="summary-language">EN</span>
					</div>
					<div class="checkout-summary-row">
						<span class="checkout-summary-label">Extras:</span>
						<span class="checkout-summary-value" id="summary-extras">...</span>
					</div>
					<div class="checkout-summary-row">
						<span class="checkout-summary-label">Distance & duration:</span>
						<span class="checkout-summary-value" id="summary-distance">23 km / 35 min</span>
					</div>

					<div class="checkout-summary-divider"></div>

					<div class="checkout-summary-price-row">
						<span class="checkout-summary-price-label">Estimated price:</span>
						<span class="checkout-summary-price" id="summary-price">€ 1000</span>
					</div>
					<p class="checkout-summary-note">Final price confirmed by manager. No online payments.</p>

					<div class="checkout-summary-divider"></div>

					<div class="checkout-summary-consent">
						<label>
							<input type="checkbox" name="consent" required>
							<span>I agree to receive email communication regarding my quote request.</span>
						</label>
					</div>

					<button type="submit" form="checkout-form" class="checkout-submit-btn">Request booking</button>

					<p class="checkout-summary-confirm">We'll confirm within 15 minutes.</p>
				</aside>

			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
