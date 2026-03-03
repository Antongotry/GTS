(() => {
	'use strict';

	const FORM_SELECTORS = '.booking-form, .fleet-booking-form';
	const SUCCESS_TEXT = 'Thank you! Your request was sent. We will contact you shortly.';

	function getConfig() {
		const config = window.gtsBookingFormConfig || {};
		return {
			ajaxUrl: config.ajaxUrl || '',
			nonce: config.nonce || ''
		};
	}

	function shouldHandleForm(form) {
		if (!form) {
			return false;
		}
		if (form.id === 'transfer-form') {
			return false;
		}
		if (form.classList.contains('gts-contact-form')) {
			return false;
		}
		return true;
	}

	function ensureSelectOptions(form) {
		const serviceType = form.querySelector('select[name="service_type"]');
		const vehicle = form.querySelector('select[name="vehicle"]');
		const passengers = form.querySelector('select[name="passengers"]');

		if (serviceType && serviceType.options.length <= 1) {
			[
				['airport_transfer', 'Airport transfer'],
				['city_to_city', 'City-to-city transfer'],
				['hourly_hire', 'Hourly hire'],
				['business_transfer', 'Business transfer'],
				['special_event', 'Special event transfer']
			].forEach((optionData) => {
				const option = document.createElement('option');
				option.value = optionData[0];
				option.textContent = optionData[1];
				serviceType.appendChild(option);
			});
		}

		if (vehicle && vehicle.options.length <= 1) {
			[
				['sedan', 'Sedan'],
				['suv', 'SUV'],
				['van', 'Van'],
				['minibus', 'Minibus'],
				['bus', 'Bus'],
				['limousine', 'Limousine']
			].forEach((optionData) => {
				const option = document.createElement('option');
				option.value = optionData[0];
				option.textContent = optionData[1];
				vehicle.appendChild(option);
			});
		}

		if (passengers && passengers.options.length <= 1) {
			for (let i = 1; i <= 20; i += 1) {
				const option = document.createElement('option');
				option.value = String(i);
				option.textContent = i === 1 ? '1 passenger' : `${i} passengers`;
				passengers.appendChild(option);
			}
		}
	}

	function ensureStatusElement(form) {
		let status = form.querySelector('.booking-form-status');
		if (status) {
			return status;
		}
		status = document.createElement('p');
		status.className = 'booking-form-status';
		status.setAttribute('aria-live', 'polite');
		form.appendChild(status);
		return status;
	}

	function setStatus(form, message, isError) {
		const status = ensureStatusElement(form);
		status.textContent = message || '';
		status.style.color = isError ? '#b42318' : '#067647';
	}

	function toggleSubmitting(form, isSubmitting) {
		const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
		if (!submitButton) {
			return;
		}
		if (isSubmitting) {
			if (!submitButton.dataset.defaultText) {
				submitButton.dataset.defaultText = submitButton.textContent.trim() || 'Submit';
			}
			submitButton.disabled = true;
			submitButton.textContent = 'Sending...';
			return;
		}
		submitButton.disabled = false;
		submitButton.textContent = submitButton.dataset.defaultText || 'Submit';
	}

	function validateConsent(form) {
		const consent = form.querySelector('input[name="email_consent"], input[name="consent"], input[name="gts_consent"]');
		if (!consent) {
			return true;
		}
		if (consent.checked) {
			consent.setCustomValidity('');
			return true;
		}
		consent.setCustomValidity('Consent is required.');
		consent.reportValidity();
		consent.addEventListener('change', () => {
			consent.setCustomValidity('');
		}, { once: true });
		return false;
	}

	function collectPayload(form, nonce) {
		const formData = new FormData(form);
		formData.append('action', 'gts_submit_booking_request');
		formData.append('nonce', nonce);
		formData.append('page_url', window.location.href);
		formData.append('page_title', document.title || '');
		formData.append('form_id', form.id || '');
		formData.append('form_classes', form.className || '');
		return formData;
	}

	function bindAddStop(form) {
		form.querySelectorAll('.add-stop-link').forEach((link) => {
			if (link.dataset.gtsAddStopBound === '1') {
				return;
			}
			link.dataset.gtsAddStopBound = '1';

			link.addEventListener('click', (event) => {
				event.preventDefault();
				const holder = link.closest('.form-group-with-add-stop');
				if (!holder) {
					return;
				}
				const currentStops = holder.querySelectorAll('input[name="stops[]"]').length;
				if (currentStops >= 3) {
					return;
				}
				const stopInput = document.createElement('input');
				stopInput.type = 'text';
				stopInput.name = 'stops[]';
				stopInput.placeholder = `Stop ${currentStops + 1}`;
				holder.appendChild(stopInput);
			});
		});
	}

	function bindForm(form) {
		if (!shouldHandleForm(form) || form.dataset.gtsSubmitBound === '1') {
			return;
		}
		form.dataset.gtsSubmitBound = '1';

		ensureSelectOptions(form);
		bindAddStop(form);

		form.addEventListener('submit', (event) => {
			event.preventDefault();
			const config = getConfig();
			if (!config.ajaxUrl || !config.nonce) {
				setStatus(form, 'Form configuration error. Please refresh the page.', true);
				return;
			}
			if (!form.reportValidity()) {
				return;
			}
			if (!validateConsent(form)) {
				return;
			}

			setStatus(form, '');
			toggleSubmitting(form, true);

			fetch(config.ajaxUrl, {
				method: 'POST',
				body: collectPayload(form, config.nonce)
			})
				.then((response) => response.json())
				.then((response) => {
					if (!response.success) {
						throw new Error((response.data && response.data.message) || 'Request failed');
					}

					setStatus(form, (response.data && response.data.message) || SUCCESS_TEXT, false);
					form.reset();
					form.dispatchEvent(new CustomEvent('gts:booking-form:sent', {
						bubbles: true,
						detail: response.data || {}
					}));
				})
				.catch((error) => {
					setStatus(form, error.message || 'Could not send request. Please try again.', true);
				})
				.finally(() => {
					toggleSubmitting(form, false);
				});
		});
	}

	function bindAllForms() {
		document.querySelectorAll(FORM_SELECTORS).forEach(bindForm);
	}

	bindAllForms();

	const observer = new MutationObserver(() => {
		bindAllForms();
	});
	observer.observe(document.body, { childList: true, subtree: true });
})();
