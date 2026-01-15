(function () {
	if (typeof Swiper === 'undefined') {
		return;
	}

	const slider = document.querySelector('.trusted-by-slider');
	if (!slider) {
		return;
	}

	/* eslint-disable no-new */
	new Swiper(slider, {
		slidesPerView: 3,
		spaceBetween: 20,
		loop: false,
		navigation: {
			nextEl: '.trusted-by-next',
			prevEl: '.trusted-by-prev',
		},
		breakpoints: {
			1024: {
				slidesPerView: 3,
			},
			768: {
				slidesPerView: 2,
			},
			0: {
				slidesPerView: 1,
			},
		},
	});
	/* eslint-enable no-new */
}());
