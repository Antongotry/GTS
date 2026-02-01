(() => {
	const slider = document.querySelector('.fleet-slider');
	if (!slider || typeof Swiper === 'undefined') {
		return;
	}

	const slideCount = slider.querySelectorAll('.swiper-slide').length;

	new Swiper(slider, {
		slidesPerView: 1.1,
		spaceBetween: 20,
		watchOverflow: true,
		loop: slideCount > 3,
		navigation: {
			nextEl: '.fleet-slider-next',
			prevEl: '.fleet-slider-prev',
		},
		breakpoints: {
			640: {
				slidesPerView: 1.4,
			},
			768: {
				slidesPerView: 2,
			},
			1024: {
				slidesPerView: 3,
				spaceBetween: 24,
			},
			1280: {
				slidesPerView: 3,
				spaceBetween: 30,
			},
		},
	});
})();
