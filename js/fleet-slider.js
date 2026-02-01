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

	// Modals are not in initial DOM — fetch on first open, inject, remove on close
	let modalsCache = null;
	const modalsUrl = (typeof wpApiSettings !== 'undefined' && wpApiSettings.root)
		? wpApiSettings.root + 'gts/v1/fleet-modals'
		: window.location.origin + '/wp-json/gts/v1/fleet-modals';

	function getModals() {
		if (modalsCache) {
			return Promise.resolve(modalsCache);
		}
		return fetch(modalsUrl)
			.then((r) => r.json())
			.then((data) => {
				modalsCache = data;
				return data;
			});
	}

	function openBooking(vehicleName) {
		getModals().then((data) => {
			let bookingEl = document.querySelector('.fleet-booking-modal');
			if (!bookingEl) {
				const wrap = document.createElement('div');
				wrap.innerHTML = data.booking;
				bookingEl = wrap.firstElementChild;
				document.body.appendChild(bookingEl);

				const vehicleField = bookingEl.querySelector('#fleet-vehicle-field');
				const bookingTitle = bookingEl.querySelector('#fleet-booking-title');
				const bookingForm = bookingEl.querySelector('#fleet-booking-form');

				bookingEl.querySelectorAll('[data-modal-close]').forEach((trigger) => {
					trigger.addEventListener('click', () => closeBooking());
				});

				if (bookingForm) {
					bookingForm.addEventListener('submit', (e) => {
						e.preventDefault();
						closeBooking();
						openSuccess();
						bookingForm.reset();
					});
				}

				initBookingInteractions(bookingEl);
				document.addEventListener('keydown', handleEscape);
			}

			if (bookingEl.querySelector('#fleet-vehicle-field')) {
				bookingEl.querySelector('#fleet-vehicle-field').value = vehicleName || '';
			}
			if (bookingEl.querySelector('#fleet-booking-title') && vehicleName) {
				bookingEl.querySelector('#fleet-booking-title').textContent = 'Book ' + vehicleName;
			}

			bookingEl.setAttribute('aria-hidden', 'false');
			bookingEl.classList.add('is-open');
			document.body.classList.add('modal-open');
		});
	}

	function closeBooking() {
		const bookingEl = document.querySelector('.fleet-booking-modal');
		if (bookingEl) {
			bookingEl.setAttribute('aria-hidden', 'true');
			bookingEl.classList.remove('is-open');
			document.body.classList.remove('modal-open');
			bookingEl.remove();
		}
		document.removeEventListener('keydown', handleEscape);
	}

	function openSuccess() {
		getModals().then((data) => {
			let successEl = document.querySelector('.fleet-success-modal');
			if (!successEl) {
				const wrap = document.createElement('div');
				wrap.innerHTML = data.success;
				successEl = wrap.firstElementChild;
				document.body.appendChild(successEl);

				successEl.querySelectorAll('[data-success-close]').forEach((trigger) => {
					trigger.addEventListener('click', () => closeSuccess());
				});

				document.addEventListener('keydown', handleEscape);
			}

			successEl.setAttribute('aria-hidden', 'false');
			successEl.classList.add('is-open');
			document.body.classList.add('modal-open');
		});
	}

	function closeSuccess() {
		const successEl = document.querySelector('.fleet-success-modal');
		if (successEl) {
			successEl.setAttribute('aria-hidden', 'true');
			successEl.classList.remove('is-open');
			document.body.classList.remove('modal-open');
			successEl.remove();
		}
		document.removeEventListener('keydown', handleEscape);
	}

	function handleEscape(e) {
		if (e.key === 'Escape') {
			closeBooking();
			closeSuccess();
		}
	}

	function initBookingInteractions(bookingEl) {
		const datetimeRow = bookingEl.querySelector('.fleet-form-row--datetime');
		if (!datetimeRow) {
			return;
		}
		const datetimeInput = datetimeRow.querySelector('input[type="datetime-local"]');
		if (!datetimeInput) {
			return;
		}

		const syncDatetimeState = () => {
			if (datetimeInput.value) {
				datetimeInput.classList.add('has-value');
			} else {
				datetimeInput.classList.remove('has-value');
			}
		};

		syncDatetimeState();
		datetimeInput.addEventListener('input', syncDatetimeState);
		datetimeInput.addEventListener('change', syncDatetimeState);

		const openPicker = () => {
			datetimeInput.focus();
			if (typeof datetimeInput.showPicker === 'function') {
				try {
					datetimeInput.showPicker();
				} catch (error) {
					// Ignore if browser blocks programmatic picker.
				}
			}
		};

		// Клик по строке (placeholder/область) — открыть пикер
		datetimeRow.addEventListener('click', (event) => {
			if (event.target === datetimeInput) {
				return;
			}
			event.preventDefault();
			openPicker();
		});

		// Клик по полю ввода — открыть пикер и на десктопе
		datetimeInput.addEventListener('click', () => {
			openPicker();
		});
	}

	document.querySelectorAll('.fleet-book-trigger').forEach((button) => {
		button.addEventListener('click', (e) => {
			e.preventDefault();
			openBooking(button.dataset.vehicle || '');
		});
	});
})();
