/**
 * Location autocomplete for transfer + booking forms (OSM via WP AJAX proxy).
 */
(function () {
	'use strict';

	function debounce(fn, wait) {
		var timer = null;
		return function () {
			var args = arguments;
			clearTimeout(timer);
			timer = setTimeout(function () {
				fn.apply(null, args);
			}, wait);
		};
	}

	function init() {
		var config = window.gtsTransferConfig || {};
		var ajaxUrl = config.ajaxUrl || '';
		var nonce = config.nonce || '';
		if (!ajaxUrl || !nonce) {
			return;
		}

		var allLists = [];
		var supportedNames = [
			'from_location',
			'to_location',
			'pickup_location',
			'dropoff_location',
			'stops[]'
		];

		function isSupportedField(input) {
			if (!input || input.tagName !== 'INPUT') {
				return false;
			}
			var name = String(input.getAttribute('name') || '').trim();
			return supportedNames.indexOf(name) !== -1;
		}

		function findFieldWrap(input) {
			var wrap = input.closest('.transfer-field, .form-group-with-add-stop, .form-group, .fleet-form-row');
			if (!wrap) {
				wrap = input.parentElement;
			}
			if (wrap && window.getComputedStyle(wrap).position === 'static') {
				wrap.style.position = 'relative';
			}
			return wrap;
		}

		function closeAllLists(exceptList) {
			allLists.forEach(function (currentList) {
				if (currentList !== exceptList) {
					currentList.hidden = true;
				}
			});
		}

		function bindInput(input) {
			if (!isSupportedField(input) || input.dataset.gtsLocationAutocompleteBound === '1') {
				return;
			}
			input.dataset.gtsLocationAutocompleteBound = '1';

			var fieldWrap = findFieldWrap(input);
			if (!fieldWrap) {
				return;
			}

			var list = document.createElement('ul');
			list.className = 'transfer-autocomplete-list';
			list.setAttribute('role', 'listbox');
			list.hidden = true;
			fieldWrap.appendChild(list);
			allLists.push(list);

			input.setAttribute('autocomplete', 'off');
			input.setAttribute('autocorrect', 'off');
			input.setAttribute('autocapitalize', 'off');
			input.setAttribute('spellcheck', 'false');

			var abortController = null;
			var requestId = 0;
			var activeIndex = -1;
			var items = [];

			function clearList() {
				if (abortController) {
					abortController.abort();
					abortController = null;
				}
				activeIndex = -1;
				items = [];
				list.innerHTML = '';
				list.hidden = true;
			}

			function highlight(index) {
				var options = list.querySelectorAll('.transfer-autocomplete-option');
				options.forEach(function (option, optionIndex) {
					option.classList.toggle('is-active', optionIndex === index);
				});
			}

			function choose(item) {
				if (!item || !item.value) {
					return;
				}

				input.value = item.label || item.value;
				input.dataset.shortLabel = item.short_label || '';
				input.dataset.country = item.country || '';
				input.dataset.city = item.city || '';
				input.dataset.address = item.address || item.label || item.value;
				input.dataset.fullLabel = item.label || item.value;
				input.dataset.lat = item.lat || '';
				input.dataset.lon = item.lon || '';
				input.dataset.selected = '1';
				clearList();
				input.dispatchEvent(new Event('change', { bubbles: true }));
			}

			function render(results) {
				items = Array.isArray(results) ? results : [];
				list.innerHTML = '';
				activeIndex = -1;

				if (!items.length) {
					list.hidden = true;
					return;
				}

				closeAllLists(list);

				items.forEach(function (item, index) {
					var li = document.createElement('li');
					li.className = 'transfer-autocomplete-item';
					li.setAttribute('role', 'option');
					li.setAttribute('aria-selected', 'false');

					var button = document.createElement('button');
					button.type = 'button';
					button.className = 'transfer-autocomplete-option';
					button.textContent = item.label || item.value;
					var chooseHandler = function (event) {
						event.preventDefault();
						choose(item);
					};
					// iOS Safari: handle touch/pointer before input blur closes list.
					button.addEventListener('pointerdown', chooseHandler);
					button.addEventListener('touchstart', chooseHandler, { passive: false });
					button.addEventListener('mousedown', function (event) {
						event.preventDefault();
						choose(item);
					});
					button.addEventListener('click', function (event) {
						event.preventDefault();
						choose(item);
					});

					button.addEventListener('mouseenter', function () {
						activeIndex = index;
						highlight(activeIndex);
					});

					li.appendChild(button);
					list.appendChild(li);
				});

				list.hidden = false;
			}

			var requestSuggestions = debounce(function (query) {
				if (abortController) {
					abortController.abort();
				}

				if (!query || query.length < 2) {
					delete input.dataset.country;
					delete input.dataset.city;
					delete input.dataset.address;
					delete input.dataset.fullLabel;
					delete input.dataset.shortLabel;
					clearList();
					return;
				}

				abortController = new AbortController();
				requestId += 1;
				var currentRequestId = requestId;

				var formData = new FormData();
				formData.append('action', 'gts_address_suggestions');
				formData.append('nonce', nonce);
				formData.append('q', query);
				formData.append('type', 'address');

				fetch(ajaxUrl, {
					method: 'POST',
					body: formData,
					signal: abortController.signal
				})
					.then(function (response) {
						return response.json();
					})
					.then(function (json) {
						if (currentRequestId !== requestId) {
							return;
						}
						if (!json || !json.success || !json.data) {
							render([]);
							return;
						}
						render(json.data.suggestions || []);
					})
					.catch(function (error) {
						if (error && error.name === 'AbortError') {
							return;
						}
						render([]);
					});
			}, 250);

			input.addEventListener('input', function () {
				if (input.dataset.selected === '1') {
					delete input.dataset.selected;
					return;
				}
				delete input.dataset.country;
				delete input.dataset.city;
				delete input.dataset.address;
				delete input.dataset.fullLabel;
				delete input.dataset.shortLabel;
				delete input.dataset.lat;
				delete input.dataset.lon;
				requestSuggestions(input.value.trim());
			});

			input.addEventListener('focus', function () {
				if (items.length) {
					closeAllLists(list);
					list.hidden = false;
				}
			});

			input.addEventListener('keydown', function (event) {
				if (list.hidden || !items.length) {
					return;
				}

				if (event.key === 'ArrowDown') {
					event.preventDefault();
					activeIndex = (activeIndex + 1) % items.length;
					highlight(activeIndex);
					return;
				}

				if (event.key === 'ArrowUp') {
					event.preventDefault();
					activeIndex = activeIndex <= 0 ? items.length - 1 : activeIndex - 1;
					highlight(activeIndex);
					return;
				}

				if (event.key === 'Enter' && activeIndex >= 0) {
					event.preventDefault();
					choose(items[activeIndex]);
					return;
				}

				if (event.key === 'Escape') {
					clearList();
				}
			});

			input.addEventListener('blur', function () {
				setTimeout(function () {
					clearList();
				}, 180);
			});
		}

		function bindAllInputs(root) {
			var scope = root || document;
			var selector = supportedNames
				.map(function (name) {
					return 'input[name="' + name.replace(/"/g, '\\"') + '"]';
				})
				.join(', ');
			scope.querySelectorAll(selector).forEach(bindInput);
		}

		bindAllInputs(document);

		var observer = new MutationObserver(function () {
			bindAllInputs(document);
		});
		observer.observe(document.body, { childList: true, subtree: true });
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
