new Swiper('.ah-swiper-header', {
	lazy: true,
	pagination: {
		el: '.swiper-pagination',
		clickable: true,
		type: 'bullets',
	},
	slidesPerView: 1,
	spaceBetween: 1,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	}
});

new Swiper('.ah-tripadvisor-header-1', {
	lazy: true,
	slidesPerView: 1,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev'
	}
});
new Swiper('.ah-tripadvisor-header-2', {
	lazy: true,
	slidesPerView: 1,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev'
	}
});
new Swiper('.ah-tripadvisor-header-3', {
	lazy: true,
	slidesPerView: 1,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev'
	}
});


new Swiper('.ah-cross-swiper', {
	lazy: true,
	direction: 'horizontal',
	slidesPerView: 3,
	spaceBetween: 16,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
	breakpoints: {
		320: {
			slidesPerView: 1,
		},
		650: {
			slidesPerView: 2,
		},
		900: {
			slidesPerView: 2,
		},
		1400: {
			slidesPerView: 2,
			spaceBetween: 16,
		}
	}
});


new Swiper('.ah-swiper', {
	lazy: true,
	direction: 'horizontal',
	slidesPerView: 3,
	spaceBetween: 16,
	observer: true,
	observeParents: true,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
	breakpoints: {
		320: {
			slidesPerView: 1,
		},
		650: {
			slidesPerView: 2,
		},
		900: {
			slidesPerView: 3,
		},
		1400: {
			slidesPerView: 3,
			spaceBetween: 16,
		}
	}
});

new Swiper('.ah-package-swiper', {
	lazy: true,
	direction: 'horizontal',
	slidesPerView: 4,
	spaceBetween: 16,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
	breakpoints: {
		320: {
			slidesPerView: 1,
		},
		650: {
			slidesPerView: 2,
		},
		900: {
			slidesPerView: 4,
		},
		1400: {
			slidesPerView: 4,
			spaceBetween: 16,
		}
	}
});

new Swiper('.ah-result-swiper', {
	lazy: true,
	pagination: {
		el: '.swiper-pagination',
		clickable: true,
		type: 'bullets',
	},
	slidesPerView: 1,
	spaceBetween: 1,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	}
});