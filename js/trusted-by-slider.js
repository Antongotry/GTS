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
		slidesPerView: 'auto',
		slidesPerGroup: 1,
		spaceBetween: 20,
		loop: false,
		navigation: {
			nextEl: '.trusted-by-next',
			prevEl: '.trusted-by-prev',
		},
	});
	/* eslint-enable no-new */
}());
