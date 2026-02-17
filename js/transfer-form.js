/**
 * Book a Transfer calculator (route + pricing + request submission)
 */
(function () {
	'use strict';

	function debounce(fn, wait) {
		var timer = null;
		return function () {
			var args = arguments;
			clearTimeout(timer);
			timer = setTimeout(function () {
				fn.apply(null, args);
			}, wait);
		};
	}

	function init() {
		var form = document.getElementById('transfer-form');
		if (!form) {
			return;
		}

		var config = window.gtsTransferConfig || {};
		var ajaxUrl = config.ajaxUrl || '';
		var nonce = config.nonce || '';

		var submitBtn = document.getElementById('transfer-submit');
		var confirmEl = document.getElementById('transfer-confirm');
		var returnCheckbox = form.querySelector('input[name="is_return"]');
		var returnRow = form.querySelector('.transfer-return-row');
		var vehicleTypeSelect = document.getElementById('vehicle-type-select');
		var vehicleSelect = document.getElementById('vehicle-select');
		var summaryBreakdown = document.getElementById('summary-breakdown');

		var state = {
			route: {
				distanceKm: 0,
				durationMin: 0,
				mode: 'pending',
				message: ''
			},
			pricing: {
				total: 0,
				formattedTotal: '—',
				mode: 'pending',
				breakdown: [],
				note: ''
			}
		};

		function text(el, value) {
			if (el) {
				el.textContent = value;
			}
		}

		function normalizePriceText(value) {
			var raw = String(value || '');
			var decoded = raw;
			if (raw.indexOf('&') !== -1) {
				var textarea = document.createElement('textarea');
				textarea.innerHTML = raw;
				decoded = textarea.value;
			}
			return decoded
				.replace(/&nbsp;?|&#160;?|&#xA0;?/gi, ' ')
				.replace(/\u00a0/g, ' ')
				.replace(/\s{2,}/g, ' ')
				.trim();
		}

		function val(name) {
			var field = form.querySelector('[name="' + name + '"]');
			return field ? String(field.value || '').trim() : '';
		}

		function selectedText(name) {
			var field = form.querySelector('select[name="' + name + '"]');
			if (!field || field.selectedIndex < 0) {
				return '';
			}
			return (field.options[field.selectedIndex] || {}).text || '';
		}

		function checked(name) {
			var field = form.querySelector('[name="' + name + '"]');
			return !!(field && field.checked);
		}

		function checkedExtras() {
			return Array.prototype.slice.call(form.querySelectorAll('input[name="extras[]"]:checked')).map(function (el) {
				return el.value;
			});
		}

		function checkedExtrasLabels() {
			return Array.prototype.slice.call(form.querySelectorAll('input[name="extras[]"]:checked')).map(function (el) {
				var span = el.closest('label') ? el.closest('label').querySelector('span') : null;
				return span ? span.textContent.trim() : el.value;
			});
		}

		function formatDate(dateRaw, timeRaw) {
			if (!dateRaw) {
				return '—';
			}
			var d = new Date(dateRaw + 'T00:00:00');
			if (isNaN(d.getTime())) {
				return dateRaw + (timeRaw ? ' ' + timeRaw : '');
			}
			var textDate = d.toLocaleDateString('en-US', {
				year: 'numeric',
				month: 'short',
				day: '2-digit'
			});
			return textDate + (timeRaw ? ' ' + timeRaw : '');
		}

		function setReturnVisibility() {
			var enabled = checked('is_return');
			if (returnRow) {
				returnRow.hidden = !enabled;
			}
			['return_date', 'return_time'].forEach(function (name) {
				var field = form.querySelector('[name="' + name + '"]');
				if (field) {
					field.required = enabled;
				}
			});
		}

		function setLoadingPrice() {
			text(document.getElementById('summary-price'), '...');
			text(document.getElementById('summary-mode'), 'Calculating');
		}

		function renderBreakdown(items) {
			if (!summaryBreakdown) {
				return;
			}
			summaryBreakdown.innerHTML = '';
			(items || []).forEach(function (item) {
				var li = document.createElement('li');
				li.className = 'transfer-summary-breakdown-item';
				li.textContent = item;
				summaryBreakdown.appendChild(li);
			});
		}

		function updateSummary() {
			var from = [val('from_country'), val('from_city'), val('from_address')].filter(Boolean).join(', ');
			var to = [val('to_country'), val('to_city'), val('to_address')].filter(Boolean).join(', ');

			text(document.getElementById('summary-route'), (from || 'From') + ' → ' + (to || 'To'));
			text(document.getElementById('summary-transfer-type'), selectedText('transfer_type') || '—');
			text(document.getElementById('summary-datetime'), formatDate(val('date'), val('time')));

			var paxLuggage = (selectedText('passengers_group') || '—') + ' / ' + (selectedText('luggage') || '—');
			text(document.getElementById('summary-passengers'), paxLuggage);

			var vehicleText = (selectedText('vehicle_class') || '—') + ' / ' + (selectedText('vehicle_id') || selectedText('vehicle_type') || '—');
			text(document.getElementById('summary-vehicle'), vehicleText);

			var driverInfo = (selectedText('driver_language') || '—') + ' / ' + (selectedText('driver_gender') || '—');
			text(document.getElementById('summary-language'), driverInfo);

			var extras = checkedExtrasLabels();
			text(document.getElementById('summary-extras'), extras.length ? extras.join(', ') : '—');

			if (state.route.distanceKm > 0) {
				text(document.getElementById('summary-distance'), state.route.distanceKm + ' km / ' + state.route.durationMin + ' min');
			} else {
				text(document.getElementById('summary-distance'), state.route.message || '—');
			}

			text(document.getElementById('summary-price'), normalizePriceText(state.pricing.formattedTotal) || '—');
			text(document.getElementById('summary-mode'), state.pricing.mode === 'manual' ? 'Manual quote' : (state.pricing.mode === 'auto' ? 'Automatic' : '—'));
			renderBreakdown(state.pricing.breakdown || []);
			text(document.getElementById('summary-note'), state.pricing.note || 'Final price confirmed by manager. No online payments.');
		}

		function swapRoute() {
			[
				['from_country', 'to_country'],
				['from_city', 'to_city'],
				['from_address', 'to_address']
			].forEach(function (pair) {
				var a = form.querySelector('[name="' + pair[0] + '"]');
				var b = form.querySelector('[name="' + pair[1] + '"]');
				if (a && b) {
					var temp = a.value;
					a.value = b.value;
					b.value = temp;
				}
			});
			triggerRecalc();
		}

		function loadVehicles() {
			if (!vehicleTypeSelect || !vehicleSelect || !ajaxUrl) {
				return;
			}

			var categoryId = vehicleTypeSelect.value;
			if (!categoryId) {
				vehicleSelect.innerHTML = '<option value="">Select vehicle type first</option>';
				vehicleSelect.disabled = true;
				return;
			}

			vehicleSelect.disabled = true;
			vehicleSelect.innerHTML = '<option value="">Loading...</option>';

			var formData = new FormData();
			formData.append('action', 'gts_get_vehicles_by_category');
			formData.append('nonce', nonce);
			formData.append('category_id', categoryId);

			fetch(ajaxUrl, {
				method: 'POST',
				body: formData
			})
				.then(function (r) { return r.json(); })
				.then(function (res) {
					if (!res.success || !res.data || !res.data.vehicles) {
						throw new Error('No vehicles found');
					}
					vehicleSelect.innerHTML = '<option value="">Select vehicle</option>';
					res.data.vehicles.forEach(function (v) {
						var option = document.createElement('option');
						option.value = v.id;
						option.textContent = v.name;
						vehicleSelect.appendChild(option);
					});
					vehicleSelect.disabled = false;
				})
				.catch(function () {
					vehicleSelect.innerHTML = '<option value="">Unable to load vehicles</option>';
					vehicleSelect.disabled = true;
				});
		}

		function estimateRoute() {
			if (!ajaxUrl) {
				return Promise.resolve();
			}

			var from = [val('from_country'), val('from_city'), val('from_address')].filter(Boolean).join(', ');
			var to = [val('to_country'), val('to_city'), val('to_address')].filter(Boolean).join(', ');

			if (!from || !to) {
				state.route = {
					distanceKm: 0,
					durationMin: 0,
					mode: 'pending',
					message: 'Fill route to estimate'
				};
				return Promise.resolve();
			}

			var formData = new FormData();
			formData.append('action', 'gts_estimate_route');
			formData.append('nonce', nonce);
			formData.append('from', from);
			formData.append('to', to);

			return fetch(ajaxUrl, {
				method: 'POST',
				body: formData
			})
				.then(function (r) { return r.json(); })
				.then(function (res) {
					if (!res.success || !res.data) {
						throw new Error('Route unavailable');
					}

					state.route = {
						distanceKm: Number(res.data.distance_km || 0),
						durationMin: Number(res.data.duration_min || 0),
						mode: res.data.mode || 'manual',
						message: res.data.message || ''
					};
				})
				.catch(function () {
					state.route = {
						distanceKm: 0,
						durationMin: 0,
						mode: 'manual',
						message: 'Complex route: manager will confirm exact price in 30 min'
					};
				});
		}

		function calculatePrice() {
			if (!ajaxUrl) {
				return Promise.resolve();
			}

			var vehicleId = val('vehicle_id');
			if (!vehicleId) {
				state.pricing = {
					total: 0,
					formattedTotal: '—',
					mode: 'pending',
					breakdown: [],
					note: 'Select vehicle to estimate price.'
				};
				return Promise.resolve();
			}

			setLoadingPrice();

			var formData = new FormData();
			formData.append('action', 'gts_calculate_price');
			formData.append('nonce', nonce);
			formData.append('vehicle_id', vehicleId);
			formData.append('distance_km', state.route.distanceKm || 0);
			formData.append('duration_min', state.route.durationMin || 0);
			formData.append('route_mode', state.route.mode || 'manual');
			formData.append('transfer_type', val('transfer_type'));
			formData.append('vehicle_class', val('vehicle_class'));
			formData.append('passengers_group', val('passengers_group'));
			formData.append('luggage', val('luggage'));
			formData.append('driver_gender', val('driver_gender'));
			formData.append('waiting_minutes', val('waiting_minutes') || '0');
			formData.append('is_return', checked('is_return') ? '1' : '0');
			formData.append('trip_date', val('date'));
			formData.append('trip_time', val('time'));
			formData.append('promo_code', val('promo_code'));
			checkedExtras().forEach(function (extra) {
				formData.append('extras[]', extra);
			});

			return fetch(ajaxUrl, {
				method: 'POST',
				body: formData
			})
				.then(function (r) { return r.json(); })
				.then(function (res) {
					if (!res.success || !res.data) {
						throw new Error('Price unavailable');
					}
					state.pricing = {
						total: Number(res.data.total || 0),
						formattedTotal: normalizePriceText(res.data.formatted_total) || '—',
						mode: res.data.mode || 'manual',
						breakdown: res.data.breakdown || [],
						note: res.data.note || ''
					};
				})
				.catch(function () {
					state.pricing = {
						total: 0,
						formattedTotal: 'Manual quote',
						mode: 'manual',
						breakdown: ['Exact price will be confirmed by manager within 30 minutes'],
						note: 'Complex route or missing data: manager will provide exact quote.'
					};
				});
		}

		var triggerRecalc = debounce(function () {
			estimateRoute().then(function () {
				return calculatePrice();
			}).then(function () {
				updateSummary();
			});
		}, 350);

		function submitRequest(e) {
			e.preventDefault();
			if (!ajaxUrl) {
				return;
			}

			if (!form.reportValidity()) {
				return;
			}

			submitBtn.disabled = true;
			submitBtn.textContent = 'Sending...';

			var data = new FormData(form);
			data.append('action', 'gts_submit_transfer_request');
			data.append('nonce', nonce);
			data.append('route_distance_km', String(state.route.distanceKm || 0));
			data.append('route_duration_min', String(state.route.durationMin || 0));
			data.append('route_mode', state.route.mode || 'manual');
			data.append('estimated_price', String(state.pricing.total || 0));
			data.append('estimated_price_text', normalizePriceText(state.pricing.formattedTotal) || 'Manual quote');
			data.append('price_mode', state.pricing.mode || 'manual');

			fetch(ajaxUrl, {
				method: 'POST',
				body: data
			})
				.then(function (r) { return r.json(); })
				.then(function (res) {
					if (!res.success || !res.data) {
						throw new Error('Request failed');
					}
					if (confirmEl) {
						confirmEl.textContent = res.data.message || 'Thank you! We will confirm within 15 minutes.';
					}
					form.reset();
					setReturnVisibility();
					state.route = { distanceKm: 0, durationMin: 0, mode: 'pending', message: 'Fill route to estimate' };
					state.pricing = { total: 0, formattedTotal: '—', mode: 'pending', breakdown: [], note: 'Final price confirmed by manager. No online payments.' };
					updateSummary();
				})
				.catch(function () {
					if (confirmEl) {
						confirmEl.textContent = 'Unable to send request now. Please try again in a few minutes.';
					}
				})
				.finally(function () {
					submitBtn.disabled = false;
					submitBtn.textContent = 'Send request';
				});
		}

		form.addEventListener('input', triggerRecalc);
		form.addEventListener('change', function (e) {
			if (e.target && e.target.name === 'is_return') {
				setReturnVisibility();
			}
			triggerRecalc();
		});
		form.addEventListener('submit', submitRequest);

		if (vehicleTypeSelect) {
			vehicleTypeSelect.addEventListener('change', loadVehicles);
		}
		if (vehicleSelect) {
			vehicleSelect.addEventListener('change', triggerRecalc);
		}

		var swapBtn = form.querySelector('.swap-btn');
		if (swapBtn) {
			swapBtn.addEventListener('click', swapRoute);
		}

		setReturnVisibility();
		updateSummary();
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
