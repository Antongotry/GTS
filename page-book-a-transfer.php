<?php

/**
 * Template Name: Book a Transfer
 * Multi-step calculator form for booking transfers
 *
 * @package GTS
 */

get_header();
?>

<style>
	/* =====================================================
	   BOOK A TRANSFER PAGE
	   Uses same grid as header
	   ===================================================== */

	.transfer-page {
		background: #0C0F17;
		min-height: 100vh;
		padding: 100px 0 80px;
	}

	/* Same width as header-container */
	.transfer-container {
		max-width: min(1840px, 100vw - var(--scrollbar-width, 0px) - 40px);
		width: 100%;
		margin: 0 auto;
		padding: 0 20px;
		box-sizing: border-box;
		overflow: hidden;
	}

	/* Header Section */
	.transfer-header {
		display: flex;
		justify-content: space-between;
		align-items: flex-start;
		margin-bottom: 40px;
		padding-bottom: 24px;
		border-bottom: 1px solid rgba(255, 255, 255, 0.1);
	}

	.transfer-title {
		font-family: "Visby CF", sans-serif;
		font-size: 40px;
		font-weight: 500;
		color: #FFFFFF;
		margin: 0;
		letter-spacing: -0.02em;
	}

	.transfer-subtitle {
		font-family: "Manrope", sans-serif;
		font-size: 14px;
		color: rgba(255, 255, 255, 0.6);
		max-width: 320px;
		line-height: 1.5;
		margin: 0;
	}

	/* Main Layout: Form + Summary */
	.transfer-layout {
		display: grid;
		grid-template-columns: 1fr 380px;
		gap: 60px;
		align-items: start;
	}

	/* Form Card */
	.transfer-form-card {
		background: rgba(255, 255, 255, 0.05);
		padding: 40px;
	}

	/* Section */
	.transfer-section {
		margin-bottom: 40px;
	}

	.transfer-section:last-child {
		margin-bottom: 0;
	}

	.transfer-section-title {
		font-family: "Visby CF", sans-serif;
		font-size: 24px;
		font-weight: 500;
		color: #FFFFFF;
		margin: 0 0 24px 0;
		letter-spacing: -0.02em;
	}

	/* Form Row - 2 columns */
	.transfer-row {
		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 40px;
		margin-bottom: 20px;
	}

	/* Location Row - with swap button in middle */
	.transfer-row.location {
		grid-template-columns: 1fr 40px 1fr;
		gap: 20px;
		align-items: end;
	}

	/* Form Field */
	.transfer-field {
		display: flex;
		flex-direction: column;
		gap: 8px;
	}

	.transfer-label {
		font-family: "Manrope", sans-serif;
		font-size: 14px;
		font-weight: 400;
		color: #FFFFFF;
	}

	/* Input with only bottom border */
	.transfer-input,
	.transfer-select {
		width: 100%;
		height: 44px;
		padding: 10px 0;
		border: none !important;
		border-top: none !important;
		border-left: none !important;
		border-right: none !important;
		border-bottom: 1px solid rgba(255, 255, 255, 0.3) !important;
		border-radius: 0;
		background: transparent;
		font-family: "Manrope", sans-serif;
		font-size: 14px;
		color: #FFFFFF;
		outline: none !important;
		box-shadow: none !important;
		box-sizing: border-box;
		transition: border-color 0.2s ease;
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
	}

	.transfer-input::placeholder {
		color: rgba(255, 255, 255, 0.5);
	}

	.transfer-input:focus,
	.transfer-select:focus {
		border-bottom-color: rgba(255, 255, 255, 0.6);
	}

	.transfer-select {
		appearance: none;
		-webkit-appearance: none;
		background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1.5L6 6.5L11 1.5' stroke='rgba(255,255,255,0.5)' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");
		background-repeat: no-repeat;
		background-position: right 0 center;
		padding-right: 20px;
		cursor: pointer;
	}

	.transfer-select option {
		background: #1A1D26;
		color: #FFFFFF;
	}

	/* Swap Button - Blue Circle */
	.swap-btn {
		width: 40px;
		height: 40px;
		border-radius: 50%;
		background: transparent;
		border: 2px solid #4A90D9;
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		transition: all 0.2s ease;
		align-self: end;
		margin-bottom: 2px;
	}

	.swap-btn:hover {
		background: rgba(74, 144, 217, 0.1);
	}

	.swap-btn svg {
		width: 18px;
		height: 18px;
		color: #4A90D9;
	}

	/* Return Details */
	.transfer-return-label {
		font-family: "Manrope", sans-serif;
		font-size: 14px;
		color: rgba(255, 255, 255, 0.6);
		margin-bottom: 12px;
	}

	/* Checkbox */
	.transfer-checkbox-group {
		display: flex;
		flex-wrap: wrap;
		gap: 24px;
		margin-bottom: 16px;
	}

	.transfer-checkbox {
		display: flex;
		align-items: center;
		gap: 10px;
		cursor: pointer;
	}

	.transfer-checkbox input[type="checkbox"] {
		width: 20px;
		height: 20px;
		margin: 0;
		appearance: none;
		-webkit-appearance: none;
		border: 1px solid rgba(255, 255, 255, 0.3);
		background: transparent;
		cursor: pointer;
		position: relative;
	}

	.transfer-checkbox input[type="checkbox"]:checked {
		border-color: #FFFFFF;
	}

	.transfer-checkbox input[type="checkbox"]:checked::after {
		content: "";
		position: absolute;
		left: 4px;
		top: 1px;
		width: 6px;
		height: 10px;
		border: solid white;
		border-width: 0 2px 2px 0;
		transform: rotate(45deg);
	}

	.transfer-checkbox span {
		font-family: "Manrope", sans-serif;
		font-size: 14px;
		color: #FFFFFF;
	}

	/* Additional Requests */
	.transfer-requests-label {
		font-family: "Manrope", sans-serif;
		font-size: 14px;
		color: rgba(255, 255, 255, 0.6);
		margin-bottom: 12px;
	}

	/* Summary Card */
	.transfer-summary {
		background: #FFFFFF;
		padding: 32px;
		position: sticky;
		top: 100px;
	}

	.transfer-summary-title {
		font-family: "Visby CF", sans-serif;
		font-size: 28px;
		font-weight: 500;
		color: #0C0F17;
		margin: 0 0 24px 0;
	}

	.transfer-summary-row {
		display: flex;
		justify-content: space-between;
		margin-bottom: 8px;
	}

	.transfer-summary-label {
		font-family: "Manrope", sans-serif;
		font-size: 14px;
		color: rgba(12, 15, 23, 0.56);
	}

	.transfer-summary-value {
		font-family: "Manrope", sans-serif;
		font-size: 14px;
		color: #0C0F17;
	}

	.transfer-summary-divider {
		height: 1px;
		background: rgba(12, 15, 23, 0.1);
		margin: 16px 0;
	}

	.transfer-summary-price-row {
		display: flex;
		justify-content: space-between;
		align-items: baseline;
		margin-bottom: 8px;
	}

	.transfer-summary-price {
		font-family: "Visby CF", sans-serif;
		font-size: 24px;
		font-weight: 500;
		color: #0C0F17;
	}

	.transfer-summary-note {
		font-family: "Manrope", sans-serif;
		font-size: 13px;
		color: rgba(12, 15, 23, 0.56);
		margin-bottom: 24px;
	}

	/* Consent */
	.transfer-consent {
		margin-bottom: 16px;
	}

	.transfer-consent label {
		display: flex;
		align-items: flex-start;
		gap: 12px;
		cursor: pointer;
	}

	.transfer-consent input[type="checkbox"] {
		width: 20px;
		height: 20px;
		margin: 0;
		margin-top: 2px;
		appearance: none;
		-webkit-appearance: none;
		border: 1px solid rgba(12, 15, 23, 0.3);
		background: #0C0F17;
		cursor: pointer;
		position: relative;
		flex-shrink: 0;
	}

	.transfer-consent input[type="checkbox"]:checked::after {
		content: "";
		position: absolute;
		left: 5px;
		top: 2px;
		width: 6px;
		height: 10px;
		border: solid white;
		border-width: 0 2px 2px 0;
		transform: rotate(45deg);
	}

	.transfer-consent span {
		font-family: "Manrope", sans-serif;
		font-size: 13px;
		color: #0C0F17;
		line-height: 1.4;
	}

	/* Submit Button */
	.transfer-submit {
		width: 100%;
		height: 56px;
		border-radius: 50px;
		border: none;
		background: linear-gradient(to right, #FDDFAE 0%, #F4C58B 50%, #F7CE95 100%);
		font-family: "Manrope", sans-serif;
		font-size: 14px;
		color: #000000;
		cursor: pointer;
		transition: all 0.3s ease;
		margin-bottom: 16px;
	}

	.transfer-submit:hover {
		background: linear-gradient(to right, #FEE5C0 0%, #F5CE9B 50%, #F8D5A5 100%);
	}

	.transfer-confirm {
		font-family: "Manrope", sans-serif;
		font-size: 13px;
		color: rgba(12, 15, 23, 0.56);
		text-align: center;
	}

	/* =====================================================
	   RESPONSIVE
	   ===================================================== */

	@media (max-width: 1200px) {
		.transfer-layout {
			grid-template-columns: 1fr 340px;
			gap: 40px;
		}
	}

	@media (max-width: 1024px) {
		.transfer-layout {
			grid-template-columns: 1fr;
		}

		.transfer-summary {
			position: static;
		}

		.transfer-header {
			flex-direction: column;
			gap: 16px;
		}

		.transfer-container {
			padding: 0 24px;
		}
	}

	@media (max-width: 768px) {
		.transfer-page {
			padding: 40px 0 60px;
		}

		.transfer-form-card {
			padding: 24px;
		}

		.transfer-row {
			grid-template-columns: 1fr;
			gap: 20px;
		}

		.transfer-row.location {
			grid-template-columns: 1fr;
		}

		.swap-btn {
			display: none;
		}

		.transfer-title {
			font-size: 32px;
		}

		.transfer-checkbox-group {
			flex-direction: column;
			gap: 12px;
		}
	}

	@media (max-width: 480px) {
		.transfer-container {
			padding: 0 16px;
		}

		.transfer-form-card {
			padding: 20px;
		}

		.transfer-summary {
			padding: 24px;
		}
	}
</style>

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
