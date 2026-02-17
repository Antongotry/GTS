/**
 * Form Selects Handler
 * Updates select dropdown icons based on selection state
 */
(function() {
	const selects = document.querySelectorAll('select');

	function isTransferSelect(select) {
		return select.classList.contains('transfer-select') || !!select.closest('.transfer-page');
	}

	function updateSelectState(select) {
		const transferSelect = isTransferSelect(select);
		const placeholderColor = transferSelect ? 'rgba(255, 255, 255, 0.5)' : 'rgba(0, 0, 0, 0.56)';
		const selectedColor = transferSelect ? '#ffffff' : '#000000';

		if (select.value === '') {
			select.style.color = placeholderColor;
			select.classList.remove('selected');
			return;
		}

		select.style.color = selectedColor;
		select.classList.add('selected');
	}

	// Initialize all selects
	selects.forEach(function(select) {
		updateSelectState(select);

		// Update on change
		select.addEventListener('change', function() {
			updateSelectState(select);
		});

		// Update on focus
		select.addEventListener('focus', function() {
			if (!isTransferSelect(select) && select.value === '') {
				select.style.color = '#000000';
			}
		});

		// Update on blur
		select.addEventListener('blur', function() {
			updateSelectState(select);
		});
	});
})();
