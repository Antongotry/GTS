(() => {
	if (typeof Swiper === 'undefined') {
		return;
	}

	const gallery = document.querySelector('.js-single-fleet-gallery');
	if (!gallery) {
		return;
	}

	new Swiper(gallery, {
		slidesPerView: 1,
		spaceBetween: 0,
		watchOverflow: true,
		loop: gallery.querySelectorAll('.swiper-slide').length > 1,
		navigation: {
			nextEl: '.single-fleet-gallery-next',
			prevEl: '.single-fleet-gallery-prev',
		},
	});
})();
