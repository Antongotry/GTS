/**
 * Form Selects Handler
 * Updates select dropdown icons based on selection state
 */
(function() {
	const selects = document.querySelectorAll('select');
	const defaultIcon = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/01/Vector-2-gre.svg';
	const selectedIcon = 'https://lightslategray-mantis-304191.hostingersite.com/wp-content/uploads/2026/01/Vector-2.svg';

	function updateSelectIcon(select) {
		if (select.value === '') {
			select.style.backgroundImage = `url("${defaultIcon}")`;
			select.style.color = 'rgba(0, 0, 0, 0.56)';
		} else {
			select.style.backgroundImage = `url("${selectedIcon}")`;
			select.style.color = '#000000';
		}
	}

	// Initialize all selects
	selects.forEach(function(select) {
		updateSelectIcon(select);

		// Update on change
		select.addEventListener('change', function() {
			updateSelectIcon(select);
		});

		// Update on focus/blur
		select.addEventListener('focus', function() {
			if (select.value === '') {
				select.style.backgroundImage = `url("${selectedIcon}")`;
			}
		});

		select.addEventListener('blur', function() {
			updateSelectIcon(select);
		});
	});
})();
