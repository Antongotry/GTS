<?php

/**
 * Template Name: Book a Transfer
 * Multi-step calculator form for booking transfers
 *
 * @package GTS
 */

get_header();

$categories = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'orderby'    => 'name',
	)
);
?>

<main id="primary" class="site-main">
	<div class="transfer-page">
		<div class="transfer-container">

			<header class="transfer-header">
				<h1 class="transfer-title"><?php esc_html_e( 'Book a Transfer', 'gts-theme' ); ?></h1>
				<p class="transfer-subtitle"><?php esc_html_e( 'Instant estimate for standard routes. For complex trips — we\'ll confirm the exact price within 30 minutes.', 'gts-theme' ); ?></p>
			</header>

			<div class="transfer-layout">
				<div class="transfer-form-card">
					<form id="transfer-form" novalidate>
						<div class="transfer-section">
							<h2 class="transfer-section-title"><?php esc_html_e( '1. Route & timing', 'gts-theme' ); ?></h2>

							<div class="transfer-row location">
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'From country*', 'gts-theme' ); ?></label>
									<input type="text" class="transfer-input" placeholder="e.g. Switzerland" name="from_country" required>
								</div>
								<div class="transfer-swap-wrap">
									<button type="button" class="swap-btn" title="Swap route" aria-label="Swap route"></button>
								</div>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'To country*', 'gts-theme' ); ?></label>
									<input type="text" class="transfer-input" placeholder="e.g. France" name="to_country" required>
								</div>
							</div>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'From city*', 'gts-theme' ); ?></label>
									<input type="text" class="transfer-input" placeholder="e.g. Zurich" name="from_city" required>
								</div>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'To city*', 'gts-theme' ); ?></label>
									<input type="text" class="transfer-input" placeholder="e.g. Geneva" name="to_city" required>
								</div>
							</div>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'From address*', 'gts-theme' ); ?></label>
									<input type="text" class="transfer-input" placeholder="Street, terminal, hotel" name="from_address" required>
								</div>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'To address*', 'gts-theme' ); ?></label>
									<input type="text" class="transfer-input" placeholder="Street, terminal, hotel" name="to_address" required>
								</div>
							</div>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Date*', 'gts-theme' ); ?></label>
									<input type="date" class="transfer-input" name="date" required>
								</div>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Time*', 'gts-theme' ); ?></label>
									<input type="time" class="transfer-input" name="time" required>
								</div>
							</div>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Transfer type*', 'gts-theme' ); ?></label>
									<select class="transfer-select" name="transfer_type" required>
										<option value=""><?php esc_html_e( 'Select transfer type', 'gts-theme' ); ?></option>
										<option value="airport_hotel"><?php esc_html_e( 'Airport → Hotel', 'gts-theme' ); ?></option>
										<option value="hotel_event"><?php esc_html_e( 'Hotel → Event/Meeting', 'gts-theme' ); ?></option>
										<option value="intercity"><?php esc_html_e( 'Intercity', 'gts-theme' ); ?></option>
										<option value="hourly"><?php esc_html_e( 'Hourly rental', 'gts-theme' ); ?></option>
									</select>
								</div>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Round trip', 'gts-theme' ); ?></label>
									<label class="transfer-checkbox">
										<input type="checkbox" name="is_return" value="1">
										<span><?php esc_html_e( 'Add return transfer', 'gts-theme' ); ?></span>
									</label>
								</div>
							</div>

							<div class="transfer-row transfer-return-row" hidden>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Return date*', 'gts-theme' ); ?></label>
									<input type="date" class="transfer-input" name="return_date">
								</div>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Return time*', 'gts-theme' ); ?></label>
									<input type="time" class="transfer-input" name="return_time">
								</div>
							</div>
						</div>

						<div class="transfer-section">
							<h2 class="transfer-section-title"><?php esc_html_e( '2. Vehicle & preferences', 'gts-theme' ); ?></h2>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Passengers*', 'gts-theme' ); ?></label>
									<select class="transfer-select" name="passengers_group" required>
										<option value=""><?php esc_html_e( 'Select passengers', 'gts-theme' ); ?></option>
										<option value="1-2">1-2</option>
										<option value="3-4">3-4</option>
										<option value="5-7">5-7</option>
										<option value="8-20">8-20+</option>
									</select>
								</div>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Luggage*', 'gts-theme' ); ?></label>
									<select class="transfer-select" name="luggage" required>
										<option value=""><?php esc_html_e( 'Select luggage', 'gts-theme' ); ?></option>
										<option value="2_suitcases_2_hand"><?php esc_html_e( '2 suitcases, 2 hand bags', 'gts-theme' ); ?></option>
										<option value="4_suitcases_4_hand"><?php esc_html_e( '4 suitcases, 4 hand bags', 'gts-theme' ); ?></option>
										<option value="oversized"><?php esc_html_e( 'Oversized luggage', 'gts-theme' ); ?></option>
									</select>
								</div>
							</div>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Vehicle class*', 'gts-theme' ); ?></label>
									<select class="transfer-select" name="vehicle_class" required>
										<option value=""><?php esc_html_e( 'Select class', 'gts-theme' ); ?></option>
										<option value="business">Business</option>
										<option value="premium">Premium</option>
										<option value="vip">VIP</option>
										<option value="minivan">Minivan</option>
										<option value="limousine">Limousine</option>
										<option value="special_request"><?php esc_html_e( 'Special request', 'gts-theme' ); ?></option>
									</select>
								</div>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Vehicle type (category)*', 'gts-theme' ); ?></label>
									<select class="transfer-select" name="vehicle_type" id="vehicle-type-select" required>
										<option value=""><?php esc_html_e( 'Select category', 'gts-theme' ); ?></option>
										<?php if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) : ?>
											<?php foreach ( $categories as $cat ) : ?>
												<?php if ( 'uncategorized' === $cat->slug ) { continue; } ?>
												<option value="<?php echo esc_attr( $cat->term_id ); ?>"><?php echo esc_html( $cat->name ); ?></option>
											<?php endforeach; ?>
										<?php endif; ?>
									</select>
								</div>
							</div>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Vehicle*', 'gts-theme' ); ?></label>
									<select class="transfer-select" name="vehicle_id" id="vehicle-select" required>
										<option value=""><?php esc_html_e( 'Select vehicle type first', 'gts-theme' ); ?></option>
									</select>
								</div>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Driver language*', 'gts-theme' ); ?></label>
									<select class="transfer-select" name="driver_language" required>
										<option value="en">EN</option>
										<option value="fr">FR</option>
										<option value="it">IT</option>
										<option value="de">DE</option>
										<option value="ua">UA</option>
									</select>
								</div>
							</div>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Driver gender', 'gts-theme' ); ?></label>
									<select class="transfer-select" name="driver_gender">
										<option value="any"><?php esc_html_e( 'No preference', 'gts-theme' ); ?></option>
										<option value="female"><?php esc_html_e( 'Female', 'gts-theme' ); ?></option>
										<option value="male"><?php esc_html_e( 'Male', 'gts-theme' ); ?></option>
									</select>
								</div>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Waiting time', 'gts-theme' ); ?></label>
									<select class="transfer-select" name="waiting_minutes">
										<option value="0"><?php esc_html_e( 'No waiting', 'gts-theme' ); ?></option>
										<option value="15">15 min</option>
										<option value="30">30 min</option>
										<option value="60">60 min</option>
										<option value="120">120 min</option>
									</select>
								</div>
							</div>

							<p class="transfer-requests-label"><?php esc_html_e( 'Additional services', 'gts-theme' ); ?></p>
							<div class="transfer-checkbox-group transfer-extras-grid">
								<label class="transfer-checkbox"><input type="checkbox" name="extras[]" value="child_seat"><span><?php esc_html_e( 'Child seat', 'gts-theme' ); ?></span></label>
								<label class="transfer-checkbox"><input type="checkbox" name="extras[]" value="assistant"><span><?php esc_html_e( 'Assistant / translator', 'gts-theme' ); ?></span></label>
								<label class="transfer-checkbox"><input type="checkbox" name="extras[]" value="name_sign"><span><?php esc_html_e( 'Airport name sign', 'gts-theme' ); ?></span></label>
								<label class="transfer-checkbox"><input type="checkbox" name="extras[]" value="security"><span><?php esc_html_e( 'Security escort', 'gts-theme' ); ?></span></label>
								<label class="transfer-checkbox"><input type="checkbox" name="extras[]" value="flowers"><span><?php esc_html_e( 'Flowers / champagne', 'gts-theme' ); ?></span></label>
							</div>

							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Promo code', 'gts-theme' ); ?></label>
									<input type="text" class="transfer-input" name="promo_code" placeholder="e.g. GTS10">
								</div>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Other notes', 'gts-theme' ); ?></label>
									<input type="text" class="transfer-input" name="other_notes" placeholder="Any special instructions">
								</div>
							</div>
						</div>

						<div class="transfer-section">
							<h2 class="transfer-section-title"><?php esc_html_e( '3. Contact details', 'gts-theme' ); ?></h2>
							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Full name*', 'gts-theme' ); ?></label>
									<input type="text" class="transfer-input" placeholder="First and Last name *" name="full_name" required>
								</div>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Phone*', 'gts-theme' ); ?></label>
									<input type="tel" class="transfer-input" placeholder="+44 00 1111 2222" name="phone" required>
								</div>
							</div>
							<div class="transfer-row">
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Email*', 'gts-theme' ); ?></label>
									<input type="email" class="transfer-input" placeholder="info@gmail.com" name="email" required>
								</div>
								<div class="transfer-field">
									<label class="transfer-label"><?php esc_html_e( 'Client notes', 'gts-theme' ); ?></label>
									<input type="text" class="transfer-input" placeholder="Optional message" name="notes">
								</div>
							</div>
						</div>
					</form>
				</div>

				<aside class="transfer-summary">
					<h3 class="transfer-summary-title"><?php esc_html_e( 'Summary', 'gts-theme' ); ?></h3>

					<div class="transfer-summary-row">
						<span class="transfer-summary-label"><?php esc_html_e( 'Route:', 'gts-theme' ); ?></span>
						<span class="transfer-summary-value" id="summary-route">—</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label"><?php esc_html_e( 'Transfer type:', 'gts-theme' ); ?></span>
						<span class="transfer-summary-value" id="summary-transfer-type">—</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label"><?php esc_html_e( 'Date & time:', 'gts-theme' ); ?></span>
						<span class="transfer-summary-value" id="summary-datetime">—</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label"><?php esc_html_e( 'Passengers / luggage:', 'gts-theme' ); ?></span>
						<span class="transfer-summary-value" id="summary-passengers">—</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label"><?php esc_html_e( 'Class / vehicle:', 'gts-theme' ); ?></span>
						<span class="transfer-summary-value" id="summary-vehicle">—</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label"><?php esc_html_e( 'Driver:', 'gts-theme' ); ?></span>
						<span class="transfer-summary-value" id="summary-language">—</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label"><?php esc_html_e( 'Extras:', 'gts-theme' ); ?></span>
						<span class="transfer-summary-value" id="summary-extras">—</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label"><?php esc_html_e( 'Distance / duration:', 'gts-theme' ); ?></span>
						<span class="transfer-summary-value" id="summary-distance">—</span>
					</div>

					<div class="transfer-summary-divider"></div>

					<div class="transfer-summary-price-row">
						<span class="transfer-summary-label"><?php esc_html_e( 'Estimated price:', 'gts-theme' ); ?></span>
						<span class="transfer-summary-price" id="summary-price">—</span>
					</div>
					<div class="transfer-summary-row">
						<span class="transfer-summary-label"><?php esc_html_e( 'Calculation mode:', 'gts-theme' ); ?></span>
						<span class="transfer-summary-value" id="summary-mode">—</span>
					</div>
					<ul class="transfer-summary-breakdown" id="summary-breakdown"></ul>
					<p class="transfer-summary-note" id="summary-note"><?php esc_html_e( 'Final price confirmed by manager. No online payments.', 'gts-theme' ); ?></p>

					<div class="transfer-summary-divider"></div>

					<div class="transfer-consent">
						<label>
							<input type="checkbox" name="consent" form="transfer-form" required>
							<span><?php esc_html_e( 'I agree to receive communication regarding my request.', 'gts-theme' ); ?></span>
						</label>
					</div>

					<button type="submit" form="transfer-form" class="transfer-submit" id="transfer-submit"><?php esc_html_e( 'Send request', 'gts-theme' ); ?></button>
					<p class="transfer-confirm" id="transfer-confirm"><?php esc_html_e( 'We\'ll confirm within 15 minutes.', 'gts-theme' ); ?></p>
				</aside>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
