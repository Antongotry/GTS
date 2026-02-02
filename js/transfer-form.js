/**
 * Book a Transfer form – swap From/To locations
 */
(function () {
	'use strict';

	function init() {
		var form = document.getElementById('transfer-form');
		var swapBtn = form && form.querySelector('.swap-btn');
		var fromInput = form && form.querySelector('input[name="from"]');
		var toInput = form && form.querySelector('input[name="to"]');

		if (!swapBtn || !fromInput || !toInput) {
			return;
		}

		swapBtn.addEventListener('click', function () {
			var fromVal = fromInput.value;
			var toVal = toInput.value;
			fromInput.value = toVal;
			toInput.value = fromVal;
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
