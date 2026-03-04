(function () {
	function initTrustedBySlider(slider) {
		if (!slider || slider.dataset.trustedByInited === '1') {
			return true;
		}

		if (typeof Swiper === 'undefined') {
			return false;
		}

		var section = slider.closest('.trusted-by-block');
		var nextEl = section ? section.querySelector('.trusted-by-next') : document.querySelector('.trusted-by-next');
		var prevEl = section ? section.querySelector('.trusted-by-prev') : document.querySelector('.trusted-by-prev');

		/* eslint-disable no-new */
		new Swiper(slider, {
			slidesPerView: 4,
			slidesPerGroup: 1,
			spaceBetween: 20,
			loop: false,
			navigation: {
				nextEl: nextEl,
				prevEl: prevEl,
			},
			breakpoints: {
				320: { slidesPerView: 1, spaceBetween: 10 },
				768: { slidesPerView: 2, spaceBetween: 15 },
				1024: { slidesPerView: 3, spaceBetween: 20 },
				1441: { slidesPerView: 4, spaceBetween: 20 },
			},
		});
		/* eslint-enable no-new */

		slider.dataset.trustedByInited = '1';
		slider.classList.remove('trusted-by-slider--fallback');
		return true;
	}

	function enableFallback(slider) {
		if (!slider || slider.dataset.trustedByInited === '1') {
			return;
		}
		slider.classList.add('trusted-by-slider--fallback');
	}

	function initAllTrustedBySliders() {
		var sliders = document.querySelectorAll('.trusted-by-slider');
		if (!sliders.length) {
			return true;
		}

		var allReady = true;
		sliders.forEach(function (slider) {
			if (!initTrustedBySlider(slider)) {
				allReady = false;
			}
		});

		return allReady;
	}

	function setupTrustedBySliders() {
		var attempts = 0;
		var maxAttempts = 40;
		var timer = null;

		function tick() {
			attempts += 1;
			if (initAllTrustedBySliders()) {
				if (timer) {
					window.clearInterval(timer);
				}
				return;
			}

			if (attempts >= maxAttempts) {
				window.clearInterval(timer);
				document.querySelectorAll('.trusted-by-slider').forEach(enableFallback);
			}
		}

		tick();
		timer = window.setInterval(tick, 250);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', setupTrustedBySliders);
	} else {
		setupTrustedBySliders();
	}

	window.addEventListener('load', initAllTrustedBySliders, { once: true });
}());
