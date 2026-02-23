(() => {
	const FORM_SELECTORS = '.booking-form, .fleet-booking-form';
	const NAME_SELECTORS = 'input[name="full_name"], input[name="name"]';
	const PHONE_SELECTORS = 'input[name="phone"]';

	const normalizeText = (value) => (value || '').replace(/\s+/g, ' ').trim();
	const digitsOnly = (value) => (value || '').replace(/\D+/g, '');

	const isNameValid = (value) => normalizeText(value).length >= 2;
	const isPhoneValid = (value) => digitsOnly(value).length >= 6;

	function validateNameField(field) {
		if (!field || field.disabled) {
			return true;
		}
		const value = normalizeText(field.value);
		if (!value) {
			field.setCustomValidity('Name is required.');
			return false;
		}
		if (!isNameValid(value)) {
			field.setCustomValidity('Please enter your full name.');
			return false;
		}
		field.setCustomValidity('');
		return true;
	}

	function validatePhoneField(field) {
		if (!field || field.disabled) {
			return true;
		}
		const value = normalizeText(field.value);
		if (!value) {
			field.setCustomValidity('Phone is required.');
			return false;
		}
		if (!isPhoneValid(value)) {
			field.setCustomValidity('Please enter a valid phone number.');
			return false;
		}
		field.setCustomValidity('');
		return true;
	}

	function bindFieldLiveValidation(field, validator) {
		if (!field || field.dataset.gtsValidationBound === '1') {
			return;
		}
		field.dataset.gtsValidationBound = '1';
		const onUpdate = () => validator(field);
		field.addEventListener('input', onUpdate);
		field.addEventListener('change', onUpdate);
		field.addEventListener('blur', onUpdate);
	}

	function bindForm(form) {
		if (!form || form.dataset.gtsValidationFormBound === '1') {
			return;
		}
		form.dataset.gtsValidationFormBound = '1';

		const nameField = form.querySelector(NAME_SELECTORS);
		const phoneField = form.querySelector(PHONE_SELECTORS);

		bindFieldLiveValidation(nameField, validateNameField);
		bindFieldLiveValidation(phoneField, validatePhoneField);

		form.addEventListener('submit', (event) => {
			const isNameOk = validateNameField(nameField);
			const isPhoneOk = validatePhoneField(phoneField);
			if (!isNameOk || !isPhoneOk) {
				event.preventDefault();
				form.reportValidity();
			}
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
