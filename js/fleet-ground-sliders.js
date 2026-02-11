(() => {
	if (typeof Swiper === 'undefined') {
		return;
	}

	document.querySelectorAll('.fleet-ground__slider-wrap').forEach((wrap) => {
		const slider = wrap.querySelector('.fleet-cat-slider');
		if (!slider) {
			return;
		}

		const slideCount = slider.querySelectorAll('.swiper-slide').length;
		const prevEl = wrap.querySelector('.fleet-cat-prev');
		const nextEl = wrap.querySelector('.fleet-cat-next');

		new Swiper(slider, {
			slidesPerView: 1,
			spaceBetween: 12,
			watchOverflow: true,
			loop: slideCount > 2,
			preventClicks: false,
			preventClicksPropagation: false,
			navigation: {
				nextEl,
				prevEl,
			},
			breakpoints: {
				768: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				1024: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				1440: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
			},
		});
	});
})();
