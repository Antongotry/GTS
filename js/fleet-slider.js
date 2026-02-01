(() => {
	const slider = document.querySelector('.fleet-slider');
	if (!slider || typeof Swiper === 'undefined') {
		return;
	}

	const slideCount = slider.querySelectorAll('.swiper-slide').length;

	new Swiper(slider, {
		slidesPerView: 1,
		spaceBetween: 0,
		watchOverflow: true,
		loop: slideCount > 3,
		navigation: {
			nextEl: '.fleet-slider-next',
			prevEl: '.fleet-slider-prev',
		},
		breakpoints: {
			640: {
				slidesPerView: 1.1,
				spaceBetween: 12,
			},
			768: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
			1024: {
				slidesPerView: 3,
				spaceBetween: 20,
			},
			1440: {
				slidesPerView: 3,
				spaceBetween: 20,
			},
		},
	});
})();
