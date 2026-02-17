/**
 * Header language selector stub behavior.
 */
(function () {
	const selector = document.querySelector('.language-selector');
	if (!selector) {
		return;
	}

	const toggle = selector.querySelector('.language-selector__toggle');
	const label = selector.querySelector('.language-text');
	const items = selector.querySelectorAll('.language-selector__item');
	const options = selector.querySelectorAll('.language-selector__option');

	if (!toggle || !label || !items.length || !options.length) {
		return;
	}

	const closeMenu = () => {
		selector.classList.remove('is-open');
		toggle.setAttribute('aria-expanded', 'false');
	};

	const openMenu = () => {
		selector.classList.add('is-open');
		toggle.setAttribute('aria-expanded', 'true');
	};

	toggle.addEventListener('click', () => {
		if (selector.classList.contains('is-open')) {
			closeMenu();
			return;
		}

		openMenu();
	});

	options.forEach((option) => {
		option.addEventListener('click', (event) => {
			event.preventDefault();

			const nextLang = option.getAttribute('data-lang');
			if (!nextLang) {
				closeMenu();
				return;
			}

			label.textContent = nextLang;
			items.forEach((item) => item.classList.remove('is-active'));
			const item = option.closest('.language-selector__item');
			if (item) {
				item.classList.add('is-active');
			}

			closeMenu();
		});
	});

	document.addEventListener('click', (event) => {
		if (!selector.contains(event.target)) {
			closeMenu();
		}
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape') {
			closeMenu();
		}
	});
})();
