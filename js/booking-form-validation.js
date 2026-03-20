(() => {
	const FORM_SELECTORS = '.booking-form, .fleet-booking-form, .gts-contact-form';
	const NAME_SELECTORS = 'input[name="full_name"], input[name="name"], input[name="gts_first_name"]';
	const PHONE_SELECTORS = 'input[name="phone"], input[name="gts_phone"]';

	const normalizeText = (value) => (value || '').replace(/\s+/g, ' ').trim();
	const digitsOnly = (value) => (value || '').replace(/\D+/g, '');

	const isNameValid = (value) => normalizeText(value).length >= 2;
	const isPhoneFormatValid = (value) => /^[+()\-\s\d]+$/.test(value || '');
	const isPhoneLengthValid = (value) => {
		const digits = digitsOnly(value);
		return digits.length >= 8 && digits.length <= 15;
	};
	const isPhoneValid = (value) => isPhoneFormatValid(value) && isPhoneLengthValid(value);

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
			field.setCustomValidity('Please enter a valid phone number (8-15 digits).');
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

		if (phoneField) {
			phoneField.setAttribute('inputmode', 'tel');
			phoneField.setAttribute('autocomplete', 'tel');
			phoneField.setAttribute('maxlength', '25');
			phoneField.setAttribute('pattern', '[+()\\-\\s\\d]{8,25}');
			phoneField.setAttribute('title', 'Phone number must contain 8-15 digits.');
		}

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
