(function() {
	'use strict';

	function initServicesShowMore() {
		var blocks = document.querySelectorAll('.services-block');
		if (!blocks.length) {
			return;
		}

		blocks.forEach(function(block) {
			var button = block.querySelector('.services-show-more');
			if (!button) {
				return;
			}

			var hiddenCards = block.querySelectorAll('.services-card--hidden');
			if (!hiddenCards.length) {
				button.style.display = 'none';
				return;
			}

			button.addEventListener('click', function(event) {
				event.preventDefault();

				block.querySelectorAll('.services-card--hidden').forEach(function(card) {
					card.classList.remove('services-card--hidden');
				});

				button.style.display = 'none';
			});
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initServicesShowMore);
	} else {
		initServicesShowMore();
	}
})();
