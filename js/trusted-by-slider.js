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
		slidesPerView: 4,
		slidesPerGroup: 1,
		spaceBetween: 20,
		loop: false,
		navigation: {
			nextEl: '.trusted-by-next',
			prevEl: '.trusted-by-prev',
		},
		breakpoints: {
			// when window width is >= 320px
			320: {
				slidesPerView: 1,
				spaceBetween: 10,
			},
			// when window width is >= 768px
			768: {
				slidesPerView: 2,
				spaceBetween: 15,
			},
			// when window width is >= 1024px
			1024: {
				slidesPerView: 3,
				spaceBetween: 20,
			},
			// when window width is >= 1441px
			1441: {
				slidesPerView: 4,
				spaceBetween: 20,
			},
		},
	});
	/* eslint-enable no-new */
}());
