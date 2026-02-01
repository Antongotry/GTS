(() => {
	const slider = document.querySelector('.fleet-slider');
	if (slider && typeof Swiper !== 'undefined') {
		const slideCount = slider.querySelectorAll('.swiper-slide').length;

		new Swiper(slider, {
			slidesPerView: 1,
			spaceBetween: 0,
			watchOverflow: true,
			loop: slideCount > 3,
			preventClicks: false,
			preventClicksPropagation: false,
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
	}

	const bookingModal = document.querySelector('.fleet-booking-modal');
	const successModal = document.querySelector('.fleet-success-modal');
	const bookingForm = document.querySelector('#fleet-booking-form');
	const vehicleField = document.querySelector('#fleet-vehicle-field');
	const bookingTitle = document.querySelector('#fleet-booking-title');

	if (!bookingModal || !successModal || !bookingForm) {
		return;
	}

	const openBooking = (vehicleName) => {
		bookingModal.setAttribute('aria-hidden', 'false');
		bookingModal.classList.add('is-open');
		document.body.classList.add('modal-open');
		if (vehicleField) {
			vehicleField.value = vehicleName || '';
		}
		if (bookingTitle && vehicleName) {
			bookingTitle.textContent = `Book ${vehicleName}`;
		}
	};

	const closeBooking = () => {
		bookingModal.setAttribute('aria-hidden', 'true');
		bookingModal.classList.remove('is-open');
		document.body.classList.remove('modal-open');
	};

	const openSuccess = () => {
		successModal.setAttribute('aria-hidden', 'false');
		successModal.classList.add('is-open');
		document.body.classList.add('modal-open');
	};

	const closeSuccess = () => {
		successModal.setAttribute('aria-hidden', 'true');
		successModal.classList.remove('is-open');
		document.body.classList.remove('modal-open');
	};

	document.querySelectorAll('.fleet-book-trigger').forEach((button) => {
		button.addEventListener('click', (event) => {
			event.preventDefault();
			const vehicleName = button.dataset.vehicle || '';
			openBooking(vehicleName);
		});
	});

	bookingModal.querySelectorAll('[data-modal-close]').forEach((trigger) => {
		trigger.addEventListener('click', closeBooking);
	});

	successModal.querySelectorAll('[data-success-close]').forEach((trigger) => {
		trigger.addEventListener('click', closeSuccess);
	});

	bookingForm.addEventListener('submit', (event) => {
		event.preventDefault();
		closeBooking();
		openSuccess();
		bookingForm.reset();
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape') {
			closeBooking();
			closeSuccess();
		}
	});
})();
