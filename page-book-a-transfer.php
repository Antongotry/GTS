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
								<div class="transfer-swap-wrap">
									<button type="button" class="swap-btn" title="Swap locations" aria-label="Swap From and To"></button>
								</div>
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
									<select class="transfer-select" name="vehicle_type" id="vehicle-type-select" required>
										<option value="">Select category</option>
										<?php
										$categories = get_terms(array(
											'taxonomy' => 'product_cat',
											'hide_empty' => true,
											'orderby' => 'name',
										));
										if (!is_wp_error($categories) && !empty($categories)) {
											foreach ($categories as $cat) {
												if ($cat->slug === 'uncategorized') continue;
												echo '<option value="' . esc_attr($cat->term_id) . '">' . esc_html($cat->name) . '</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="transfer-field">
									<label class="transfer-label">Vehicle*</label>
									<select class="transfer-select" name="vehicle_id" id="vehicle-select" required>
										<option value="">Select vehicle type first</option>
									</select>
								</div>
							</div>

							<div class="transfer-row">
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

<script>
	(function() {
		function run() {
			var form = document.getElementById('transfer-form');
			if (!form) return;

			function getFromInput() {
				return form.querySelector('input[name="from"]');
			}

			function getToInput() {
				return form.querySelector('input[name="to"]');
			}

			// Swap: click on button -> swap values in the two inputs (use form that contains the button)
			form.addEventListener('click', function(e) {
				if (!e.target || !e.target.closest) return;
				var btn = e.target.closest('button.swap-btn');
				if (!btn) return;
				e.preventDefault();
				e.stopPropagation();
				var f = btn.closest('form');
				if (!f) return;
				var fromInput = f.querySelector('input[name="from"]');
				var toInput = f.querySelector('input[name="to"]');
				if (!fromInput || !toInput) return;
				var a = fromInput.value;
				var b = toInput.value;
				fromInput.setAttribute('value', b);
				fromInput.value = b;
				toInput.setAttribute('value', a);
				toInput.value = a;
				fromInput.dispatchEvent(new Event('input', {
					bubbles: true
				}));
				toInput.dispatchEvent(new Event('input', {
					bubbles: true
				}));
				updateSummary();
			});

			// Dynamic vehicle loading by category
			var vehicleTypeSelect = document.getElementById('vehicle-type-select');
			var vehicleSelect = document.getElementById('vehicle-select');

			if (vehicleTypeSelect && vehicleSelect) {
				vehicleTypeSelect.addEventListener('change', function() {
					var categoryId = this.value;

					if (!categoryId) {
						vehicleSelect.innerHTML = '<option value="">Select vehicle type first</option>';
						vehicleSelect.disabled = true;
						return;
					}

					vehicleSelect.innerHTML = '<option value="">Loading...</option>';
					vehicleSelect.disabled = true;

					// AJAX request to get vehicles by category
					var formData = new FormData();
					formData.append('action', 'gts_get_vehicles_by_category');
					formData.append('category_id', categoryId);

					fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
							method: 'POST',
							body: formData
						})
						.then(function(response) {
							return response.json();
						})
						.then(function(response) {
							if (response.success && response.data.vehicles) {
								var vehicles = response.data.vehicles;
								vehicleSelect.innerHTML = '<option value="">Select vehicle</option>';

								vehicles.forEach(function(v) {
									var opt = document.createElement('option');
									opt.value = v.id;
									opt.textContent = v.name + ' (€' + v.price + ')';
									opt.dataset.passengers = v.max_passengers;
									opt.dataset.bags = v.max_bags;
									vehicleSelect.appendChild(opt);
								});

								vehicleSelect.disabled = false;
							} else {
								vehicleSelect.innerHTML = '<option value="">No vehicles found</option>';
							}
						})
						.catch(function(err) {
							console.error('Error loading vehicles:', err);
							vehicleSelect.innerHTML = '<option value="">Error loading</option>';
						});
				});

				// Update summary when vehicle changes
				vehicleSelect.addEventListener('change', function() {
					updateSummary();
				});
			}

			function formatDate(val) {
				if (!val) return '—';
				var d = new Date(val + 'T00:00:00');
				if (isNaN(d.getTime())) return val;
				var months = ['Jan.', 'Feb.', 'Mar.', 'Apr.', 'May', 'Jun.', 'Jul.', 'Aug.', 'Sep.', 'Oct.', 'Nov.', 'Dec.'];
				return months[d.getMonth()] + ' ' + d.getDate() + ', ' + d.getFullYear();
			}

			function updateSummary() {
				var fromInput = getFromInput();
				var toInput = getToInput();
				var from = (fromInput && String(fromInput.value).trim()) || 'From';
				var to = (toInput && String(toInput.value).trim()) || 'To';

				var el = document.getElementById('summary-route');
				if (el) el.textContent = from + ' → ' + to;

				var dateEl = form.querySelector('input[name="date"]');
				el = document.getElementById('summary-date');
				if (el) el.textContent = dateEl ? formatDate(dateEl.value) : '—';

				var timeEl = form.querySelector('input[name="time"]');
				el = document.getElementById('summary-time');
				if (el) el.textContent = (timeEl && timeEl.value) ? timeEl.value : '—';

				var passEl = form.querySelector('select[name="passengers"]');
				el = document.getElementById('summary-passengers');
				if (el) el.textContent = (passEl && passEl.value) ? passEl.value : '—';

				var vehicleEl = form.querySelector('select[name="vehicle_id"]');
				var vehicleTypeEl = form.querySelector('select[name="vehicle_type"]');
				el = document.getElementById('summary-vehicle');
				if (el) {
					if (vehicleEl && vehicleEl.value) {
						var opt = vehicleEl.options[vehicleEl.selectedIndex];
						el.textContent = opt ? opt.text : '—';
					} else if (vehicleTypeEl && vehicleTypeEl.value) {
						var typeOpt = vehicleTypeEl.options[vehicleTypeEl.selectedIndex];
						el.textContent = typeOpt ? typeOpt.text + ' (select vehicle)' : '—';
					} else {
						el.textContent = '—';
					}
				}

				var langEl = form.querySelector('select[name="driver_language"]');
				el = document.getElementById('summary-language');
				if (el && langEl) {
					var langOpt = langEl.options[langEl.selectedIndex];
					el.textContent = langOpt ? langOpt.text.toUpperCase() : '—';
				}

				var extras = [];
				['book_jet', 'book_helicopter', 'child_seat', 'meet_greet', 'extra_stop', 'vip_protocol'].forEach(function(name) {
					var cb = form.querySelector('input[name="' + name + '"]');
					if (cb && cb.checked) {
						var label = cb.closest('label');
						var span = label ? label.querySelector('span') : null;
						extras.push(span ? span.textContent.trim() : name);
					}
				});
				el = document.getElementById('summary-extras');
				if (el) el.textContent = extras.length ? extras.join(', ') : '—';

				// Calculate price via AJAX
				calculatePrice();
			}

			// Debounce for price calculation
			var priceTimeout = null;

			function calculatePrice() {
				if (priceTimeout) clearTimeout(priceTimeout);
				priceTimeout = setTimeout(doCalculatePrice, 300);
			}

			function doCalculatePrice() {
				var vehicleId = form.querySelector('select[name="vehicle_id"]');
				var distanceEl = document.getElementById('summary-distance');
				var priceEl = document.getElementById('summary-price');

				// If no vehicle selected yet, show placeholder
				if (!vehicleId || !vehicleId.value) {
					if (distanceEl) distanceEl.textContent = '—';
					if (priceEl) priceEl.textContent = '—';
					return;
				}

				// Collect extras
				var extras = [];
				['book_jet', 'book_helicopter', 'child_seat', 'meet_greet', 'extra_stop', 'vip_protocol'].forEach(function(name) {
					var cb = form.querySelector('input[name="' + name + '"]');
					if (cb && cb.checked) {
						var label = cb.closest('label');
						var span = label ? label.querySelector('span') : null;
						extras.push(span ? span.textContent.trim() : name);
					}
				});

				// Check if night time (22:00 - 06:00)
				var timeInput = form.querySelector('input[name="time"]');
				var isNight = false;
				if (timeInput && timeInput.value) {
					var hour = parseInt(timeInput.value.split(':')[0], 10);
					isNight = (hour >= 22 || hour < 6);
				}

				// Check if weekend
				var dateInput = form.querySelector('input[name="date"]');
				var isWeekend = false;
				if (dateInput && dateInput.value) {
					var day = new Date(dateInput.value).getDay();
					isWeekend = (day === 0 || day === 6);
				}

				// Check if return trip
				var returnRadio = form.querySelector('input[name="trip_type"][value="return"]:checked');
				var isReturn = !!returnRadio;

				// For now, use simulated distance (in production this would come from Maps API)
				var distanceKm = 50; // Default simulation

				// Show loading
				if (priceEl) priceEl.textContent = '...';
				if (distanceEl) distanceEl.textContent = distanceKm + ' km';

				// AJAX request to calculate price
				var formData = new FormData();
				formData.append('action', 'gts_calculate_price');
				formData.append('vehicle_id', vehicleId.value);
				formData.append('distance_km', distanceKm);
				formData.append('is_night', isNight ? '1' : '0');
				formData.append('is_weekend', isWeekend ? '1' : '0');
				formData.append('is_return', isReturn ? '1' : '0');
				extras.forEach(function(e) {
					formData.append('extras[]', e);
				});

				fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
						method: 'POST',
						body: formData
					})
					.then(function(response) {
						return response.json();
					})
					.then(function(response) {
						if (response.success && response.data) {
							if (priceEl) priceEl.textContent = response.data.formatted_total;
							// Show distance with estimated time (2 min per km average)
							var estimatedMin = Math.round(distanceKm * 1.2);
							if (distanceEl) distanceEl.textContent = distanceKm + ' km / ' + estimatedMin + ' min';
						} else {
							if (priceEl) priceEl.textContent = '—';
						}
					})
					.catch(function(err) {
						console.error('Price calculation error:', err);
						if (priceEl) priceEl.textContent = '—';
					});
			}

			function toggleDateTimeValueClass() {
				form.querySelectorAll('input[type="date"], input[type="time"]').forEach(function(el) {
					if (el.value && el.value.trim() !== '') {
						el.classList.add('has-value');
					} else {
						el.classList.remove('has-value');
					}
				});
			}

			form.addEventListener('input', function() {
				toggleDateTimeValueClass();
				updateSummary();
			});
			form.addEventListener('change', function() {
				toggleDateTimeValueClass();
				updateSummary();
			});
			toggleDateTimeValueClass();
			updateSummary();
		}

		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', run);
		} else {
			run();
		}
	})();
</script>

<?php get_footer(); ?>
