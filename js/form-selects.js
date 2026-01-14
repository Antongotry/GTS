/**
 * Form Selects Handler
 * Updates select dropdown icons based on selection state
 */
(function() {
	const selects = document.querySelectorAll('select');

	function updateSelectState(select) {
		if (select.value === '') {
			select.style.color = 'rgba(0, 0, 0, 0.56)';
			select.classList.remove('selected');
		} else {
			select.style.color = '#000000';
			select.classList.add('selected');
		}
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
			if (select.value === '') {
				select.style.color = '#000000';
			}
		});

		// Update on blur
		select.addEventListener('blur', function() {
			updateSelectState(select);
		});
	});
})();
