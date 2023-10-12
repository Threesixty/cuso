 $(document).ready(function(){

 	// Parsley i18n
	window.ParsleyValidator.setLocale($('body').data('lang'));

	// Captcha IsHuman
	$('.is-a-human').on('focusin', function() {
		$('.text-for-a-human').show();
	});

 	// Quote form
 	$('input[name="quote-contact"]').on('click', function(){
 		if($(this).hasClass('required')) {
 			$('input[name="quote-company"]').prop('required', true);
 			$('input[name="quote-company"]').prev().find('.text-red').removeClass('hidden');
 		} else {
 			$('input[name="quote-company"]').prop('required', false);
 			$('input[name="quote-company"]').prev().find('.text-red').addClass('hidden');
 		}
 	});
	
	//for "Wish to include an airport transfer service." check in "10.6 Get A Quote_Final.html" page
	$("#show-extra-input-blocks").click(
		function() {
			if ($(this).prop('checked')) {
				$(".extra-input-blocks").show();
			}
			else {
				$(".extra-input-blocks").hide();
			}
		}
	)

	// Global quote
 	$('select.quote-hotel').on('change', function(){
 		var hotelValue = $('option:selected', this).val();
 		if (hotelValue != -1)
 			$('.no-hotel-selected').hide();
 		else 
 			$('.no-hotel-selected').show();
	})

	$('#form-global-quote input[name="hotel_id[]"]').on('change', function(e) {
		if ($(this).prop('checked')) {
			if ($(this).hasClass('first')) {
				$('input[name="hotel_id[]"]:checked').prop('checked', false);
				$(this).prop('checked', true);
			} else {
				$('input[name="hotel_id[]"].first').prop('checked', false);
			}
		}
		if ($('input[name="hotel_id[]"]:checked').length > 3) {
			var msg = $(this).closest('.ah-filter-menu').data('max-msg');
			alert(msg);
			this.checked = false;
		}
	});

 	// Event global quote
 	$('select.event-global-quote-hotel').on('change', function(){
 		var hotelId = $('option:selected', this).attr('data-id');
 		var hotelValue = $('option:selected', this).val();

 		// Events
 		$('select[name="quote-event-type"] > option').each(function() {
 			$(this).prop('hidden', true);
 			if (hotelValue == 'all-hotels' && !$(this).hasClass('doublon')) {
 				$(this).prop('hidden', false);
 			}

 			if ($(this).hasClass('event-' + hotelId) || !$(this).hasClass('hotel-event')) {
 				$(this).prop('hidden', false);
 			}
 		});

 		// Rooms
 		if (hotelValue == 'all-hotels')
 			$('select[name="quote-room-type"]').closest('div').hide();
 		else {
 			$('select[name="quote-room-type"]').closest('div').show();

	 		$('select[name="quote-room-type"] > option').each(function() {
	 			$(this).prop('hidden', true);
	 			if ($(this).hasClass('room-' + hotelId) || !$(this).hasClass('hotel-room')) {
	 				$(this).prop('hidden', false);
	 			}
	 		});
 		}
 	});


 	// Swiper next arrow issue
 	$('.header-slider .swiper-button-next').removeClass('swiper-button-disabled');

 	$('.info-icon').tooltip({
		position: { 
			my: 'top+20', 
			at: 'center', 
			duration: 100 
		},
	});

 	// Explore hotel block
 	$(document).on('click', '.tablink', function(event) {
 		event.preventDefault();

 		$('.tabpanel').hide();
 		$($(this).attr('href')).show();

 		$(this).closest('.section-tabs').find('li').removeClass('active');
 		$(this).closest('li').addClass('active');
 	});

 	// Booking bar
 	$(document).on('click', '.btn-minus', function(event) {
 		if (parseInt($(this).next().val()) > 0)
 			$(this).next().val(parseInt($(this).next().val())-1);
 		if (parseInt($(this).next().val()) == 0)
 			$(this).toggleClass('passive-ah-btn');
 	});
 	$(document).on('click', '.btn-plus', function(event) {
 		$(this).closest('div').find('.btn-minus').removeClass('passive-ah-btn');
 		$(this).prev().val(parseInt($(this).prev().val())+1);
 	});

 	$(document).on('click', '.clear-hotel', function(event) {
 		$(this).closest('.ah-filter-menu').find('input[type="radio"]').prop('checked', false);
 		$(this).closest('.ah-filter-menu').find('input[type="checkbox"]').prop('checked', false);
 		$(this).closest('.ah-filter-menu').find('input.first').prop('checked', true);

 		$(this).closest('.ah-filter-hotels').find('.hotel-selection').text($(this).data('unit'));
 	});

 	$(document).on('click', '.clear-room-category', function(event) {
 		$(this).closest('.ah-filter-menu').find('input[type="checkbox"]').prop('checked', false);
 		$(this).closest('.ah-filter-menu').find('input.first').prop('checked', true);

 		$(this).closest('.ah-filter-rooms').find('.room-selection').text($(this).data('unit'));
 	});

 	$(document).on('click', '.clear-guests', function(event) {
 		$(this).closest('.ah-filter-menu').find('input').each(function() {
 			$(this).prev().addClass('passive-ah-btn');
 			$(this).val(0);
 			if ($(this).attr("name") == 'adult')
 				$(this).val(2);
 		});

 		$(this).closest('.ah-filter-guests').find('.guests-selection').text($(this).data('unit'));
 	});

 	$(document).on('click', '.submit-option', function(event) {
		
		var target = $(this).data('target');
		switch(target) {

			case 'hotel-selection':
				var selection = '';
				var idx = 0;
				$(this).closest('.ah-filter-hotels').find('input').each(function() {
					if ($(this).prop('checked')) {
						if (idx > 1) {
							selection += ', ';
						}
						idx++;
						selection += $(this).closest('label').find('.ah-filter-menu-label').text();
						if ($(this).data('cat') == 'adult')
							$('.ah-filter-guests-age-counter.non-adult').find('input,button').addClass('disabled');
						else
							$('.ah-filter-guests-age-counter.non-adult').find('input,button').removeClass('disabled');

					}
				});
				$(this).closest('.ah-filter-hotels').find('.hotel-selection').text(selection);
				break;

			case 'guests-selection':
				var selection = 0;
				$(this).closest('.ah-filter-menu').find('input').each(function() {
					selection += parseInt($(this).val());
				});
				var unit = selection > 1 ? $(this).data('unit') + 's' : $(this).data('unit');
				$(this).closest('.ah-filter-guests').find('.guests-selection').text(selection + ' ' + unit);
				break;

			case 'form-guests-selection':
				var children = 0, teens = 0, adults = 0;
				$(this).closest('.ah-filter-menu').find('input').each(function() {
					if ($(this).hasClass('is-adult'))
						adults += parseInt($(this).val());
					else if ($(this).hasClass('is-teen'))
						teens += parseInt($(this).val());
					else
						children += parseInt($(this).val());
				});
				var text = adults + ' ' + $(this).data('unit-adults');
				text += teens > 0 ? ' / ' + teens + ' ' + $(this).data('unit-teens') : '';
				text += children > 0 ? ' / ' + children + ' ' + $(this).data('unit-children') : '';
				$(this).closest('.ah-filter-form-guests').find('.form-guests-selection').val(text);
				break;

			case 'room-selection':
				var selection = '';
				$(this).closest('.ah-filter-rooms').find('input').each(function() {
					if ($(this).prop('checked')) {
						selection += selection != '' ? ', ' : '';
						selection += $(this).closest('label').find('.ah-filter-menu-label').text();
					}
				});
				$(this).closest('.ah-filter-rooms').find('.room-selection').text(selection);
				break;

			default:
			break;
		}

 		$(this).closest('.ah-filter-hotels').find('.ah-filter-item-checkbox').prop('checked', false);
 		$(this).closest('.ah-filter-guests').find('.ah-filter-item-checkbox').prop('checked', false);
 		$(this).closest('.ah-filter-form-guests').find('.ah-filter-item-checkbox').prop('checked', false);

 	});

 	$(window).on('click', function(event) {

		var target = $(event.target);

		var filterOpened = false;
		$('input.ah-filter-item-checkbox').each(function() {
			if ($(this).prop('checked') && !filterOpened) 
				filterOpened = true;
		});
		if ($('.ui-datepicker').css('display') == 'block')
			filterOpened = true;

		if(!target.closest('.top-nav-bar, .hotel-top-bar, .booking-bar').length && !filterOpened && !$('.cover-body').length && !$('.modal-cover').length) {
			$('body').removeClass('body-covered hide-vertical-scrollbar');
			$('.top-nav-bar, .hotel-top-bar, .booking-bar').removeClass('has-higher-level');
			$('.booking-bar').removeClass('be-sticky-1 be-sticky-2 be-sticky-3');
		}     

		var activeFilter = false;
		if (target.closest('.ah-filter-hotels').length)
			activeFilter = 'hotels';
		else if (target.closest('.ah-filter-guests').length)
			activeFilter = 'guests';
		else if (target.closest('.ah-filter-form-guests').length)
			activeFilter = 'form-guests';

			$('input.ah-filter-item-checkbox').each(function() {
				if ($(this).prop('checked') && !$(this).closest('.ah-filter-'+activeFilter).length) 
					$(this).prop('checked', false);
			});
	});
 	if ($('.cover-body').length) {
 		$('body').addClass('body-covered hide-vertical-scrollbar');
 	}

 	// Tab
 	$(document).on('click', '.tab', function(event) {

 		$(this).closest('ul').find('.tab').each(function() {
 			$(this).removeClass('darkgray-text bold-text').addClass('simplegray-text');
 		});
 		$(this).removeClass('simplegray-text').addClass('darkgray-text bold-text');

 		$(this).closest('section').find('.tabpane').each(function() {
 			$(this).addClass('display-none');
 		});
 		$($(this).data('target')).removeClass('display-none');
 	});

 	// Positive Toggle block
 	$(document).on('click', '.toggle-block', function(event) {

 		$(this).closest('ul').find('li').removeClass('active');
 		$(this).closest('li').addClass('active');
 		$('.main-toggle').hide();
 		$('.toggle' + $(this).data('idx')).show();
 	});

 	// Positive background desktop/mobile
 	function getPositiveBg() {
	 	if ($('.join-the-movement-bg').length) {
	 		$('.join-the-movement-bg').each(function() {
		 		if (window.innerWidth > 812)
		 			$(this).css('background', 'url("' + $(this).data('url') + '/' + $(this).data('desktop') + '") center/contain');
		 		else
		 			$(this).css('background', 'url("' + $(this).data('url') + '/' + $(this).data('mobile') + '") center');
	 		});
	 	}
	}
	getPositiveBg();
	$(window).on('resize', function() {
		getPositiveBg();
	});

 	// Modal
 	$(document).on('click', '.ah-popup-close, .popup-close', function(event) {
 		event.preventDefault();

		var video = $(this).closest('.ah-popup-content').find('video')[0];
		if (video != undefined && video.lastChild != undefined) {
			video.removeChild(video.lastChild);
			video.load();
		}

 		$('.modal').hide(200);
 		$('body').removeClass('body-covered hide-vertical-scrollbar modal-cover');
 		$('.ah-popup-layer').removeClass('cover-body');
 	});

 	$(document).on('click', '.body-covered', function(event) {

 		var container = $('.ah-popup-content');
	    if (!container.is(event.target) && container.has(event.target).length === 0) {
	 		event.preventDefault();

			var video = $(this).closest('.ah-popup-content').find('video')[0];
			if (video != undefined && video.lastChild != undefined) {
				video.removeChild(video.lastChild);
				video.load();
			}

	 		$('.modal').hide(200);
	 		$('body').removeClass('body-covered hide-vertical-scrollbar modal-cover');
	 		$('.ah-popup-layer').removeClass('cover-body');
	    }
 	});

 	var lastForm = null;
 	$(document).on('click', '.show-modal', function(event) {
 		event.preventDefault();
 		lastForm = $(this).closest('form');

 		$('body').addClass('body-covered hide-vertical-scrollbar modal-cover');
 		$($(this).attr('href')).show();
 	});

 	$(document).on('click', '.show-media', function(event) {
 		event.preventDefault();

 		$('body').addClass('body-covered hide-vertical-scrollbar modal-cover');

		var video = $($(this).attr('href')).find('video')[0];
		if (video.lastChild != undefined)
			video.removeChild(video.lastChild);
		var source = document.createElement('source');
		source.setAttribute('src', $(this).data('full-media'));
		video.appendChild(source);
		video.load();

 		$($(this).attr('href')).show();
 	});

 	// Mega menu
 	$('.top-navigation > ul > li').hover(function(event) {

 		var menuItem = $(this).find('a');
 		var menuItemPosition = menuItem.position();

 		var megaMenu = $(this).find('.sub-nav');
 		if (megaMenu.length) {
	 		var megaMenuPosition = megaMenu.position();

	 		var menuItemRight = menuItemPosition.left + menuItem.width();
	 		var megaMenuRight = megaMenuPosition.left + megaMenu.width() + 60; // padding: 30px = 60

	 		if (megaMenuRight > $(window).width() && $(window).width() > 1080) {
	 			var offset = megaMenu.width() - 50;
				megaMenu.css('transform', 'translateX(-' + offset + 'px) translateY(-2px)');
	 		} else {
				megaMenu.css('transform', '-15px');
			}
 		}
 	});

 	// Newsletter
 	$(document).on('click', '.show-nl-modal', function(event) {

 		lastForm = $(this).closest('form');
 		var nlModal = $(this).attr('href');

		lastForm.parsley().validate();

		if (lastForm.parsley().isValid()) {
			var quoteForm = lastForm.find('input[name="quote-newsletter"]');
			if (!quoteForm.length || (quoteForm.length && quoteForm.prop('checked'))) {
		 		$('body').addClass('body-covered hide-vertical-scrollbar modal-cover');
		 		$(nlModal).show();
			} else {
				lastForm.submit();
			}
		}
 	});
 	$(document).on('click', '.next-step, .previous-step', function(event) {

 		if ($(this).hasClass('is-maurician'))
 			lastForm.find('input[name="newsletter-isMauritian"]').val($(this).data('maurician'));

 		$(this).closest('.step').removeClass('active');
 		$('#step'+$(this).data('step')).addClass('active');
 	});

 	//Prevent submit form by pressing enter (keyCode == 13)
 	$(document).on('keydown', '#form-newsletter', function(event) { 
	    return event.key != 'Enter';
	});

 	$(document).on('click', '.submit-newsletter-form', function(event) {

        var names = [];
        $('#step2 input:checked').each(function() {
            names.push(this.value);
        });
		lastForm.find('input[name="newsletter-type"]').val(JSON.stringify(names));
		lastForm.submit();
	});

 	
 	// Booking Engine
 	$(document).on('click', '.submit-booking-form', function(event) {

 		$('.booking-form').find('input[name="isMauritian"]').val($(this).data('maurician'));

 		lastForm.submit();
	});

 	$(document).on('submit', '.booking-form', function(event) {

 		event.preventDefault();

 		var synxis = 'https://booking.hotels-attitude.com/?';
 		var params = {
 				'chain': '14463',
 				'dest': 'ATTITUDE',
 				'level': 'chain',
 				'locale': $(this).data('locale'),
 				'currency': 'EUR',
 			};
 		var hotelCategory = undefined;

 		// Mauritian citizen
 		if ($(this).find('input[name="isMauritian"]').val() == 'yes') {
 			params.promo = 'Local Rates';
 			params.currency = 'MUR';
 		} else {
 			params.theme = 'INTER';
 		}

 		// Hotel
 		$(this).find('input[name="hotel_id"]').each(function() {
 			if ($(this).prop('checked') || $(this).hasClass('hotel-booking')) {
 				if (isNaN($(this).val())) {
 					params.dest = $(this).val();
 					params.configcode = 'ATTITUDE';
 					params.themecode = 'ATTITUDE';
 					hotelCategory = $(this).val();
 				} else {
 					params.hotel = $(this).val();
 					params.level = 'hotel';
 					hotelCategory = $(this).attr('data-hotel-category');
 				}
 			}

 		});

 		// Dates
 		var arrive = $(this).find('input[name="arrive"]');
 		if (arrive.val() != '') {
 			params.arrive = arrive.val();
 		}
 		var departure = $(this).find('input[name="departure"]');
 		if (departure.val() != '') {
 			params.depart = departure.val();
 		}

 		// Adults
 		var adult = $(this).find('input[name="adult"]');
 		if (adult.val() != 0)
 			params.adult = adult.val();

 		// Teens
 		var teen = $(this).find('input[name="teen"]');
 		if (teen.val() != 0)
 			params.teen = teen.val();
 		else
 			delete params.teen;

 		// Children
 		params.child = 0;
 		params.childages = '';
 		var teen = $(this).find('input[name="teen"]');
 		if (teen.val() != 0) {
 			params.child += parseInt(teen.val());
 			for (var i=0; i < parseInt(teen.val()); i++) {
 				params.childages += i > 0 ? '|17' : '17';
 			} 
 		}
 		var children12 = $(this).find('input[name="children_12"]');
 		if (children12.val() != 0) {
 			params.child += parseInt(children12.val());
 			for (var i=0; i < parseInt(children12.val()); i++) {
 				params.childages += i > 0 ? '|12' : '12';
 			} 
 		}
 		var children6 = $(this).find('input[name="children_6"]');
 		if (children6.val() != 0) {
 			params.child += parseInt(children6.val());
 			for (var i=0; i < parseInt(children6.val()); i++) {
 				params.childages += i > 0 || params.childages.length > 0 ? '|6' : '6';
 			} 
 		}
 		if (params.child == 0) {
 			delete params.child;
 			delete params.childages;
 		}

 		// Room
 		$(this).find('input[name="room_id"]').each(function() {
 			if ($(this).prop('checked')) {
 				if (isNaN($(this).val())) {
 					params.room = $(this).val();
 				}
 			}
 		});

 		// GTM
 		gtmBookingEngine(params, hotelCategory);

 		var queryString = jQuery.param(params);
 		window.location.replace(synxis+queryString);

 	});


 	// Google Tag Manager
 	$(document).on('click', '.gtm-clic', function(event) {

 		var dataArr = {
 				'event': $(this).data('event'),
 			};

 		if ($(this).data('maurician') != undefined)
 			dataArr.maurician = $(this).data('maurician');

 		if ($(this).data('chat') != undefined)
 			dataArr.chat = $(this).data('chat');

 		dataLayer.push(dataArr);
 		console.log(dataLayer);
 	});

 	if ($('.gtm-view').length) {
 		$('.gtm-view').each(function (){

	 		var dataArr = {
	 				'event': $(this).data('event'),
	 			};

	 		if ($(this).data('page_path') != undefined)
	 			dataArr.page_path = $(this).data('page_path');
	 		if ($(this).data('page_title') != undefined)
	 			dataArr.page_title = $(this).data('page_title');
	 		if ($(this).data('language') != undefined)
	 			dataArr.language = $(this).data('language');
	 		if ($(this).data('page_type') != undefined)
	 			dataArr.page_type = $(this).data('page_type');

	 		if ($(this).data('hotel_name') != undefined)
	 			dataArr.hotel_name = $(this).data('hotel_name');
	 		if ($(this).data('meal_plan') != undefined)
	 			dataArr.meal_plan = $(this).data('meal_plan');
	 		if ($(this).data('stay_duration') != undefined)
	 			dataArr.stay_duration = $(this).data('stay_duration');
	 		if ($(this).data('guest_number') != undefined)
	 			dataArr.guest_number = $(this).data('guest_number');
	 		if ($(this).data('company_name') != undefined)
	 			dataArr.company_name = $(this).data('company_name');
	 		if ($(this).data('event_type') != undefined)
	 			dataArr.event_type = $(this).data('event_type');

	 		dataLayer.push(dataArr);
	 		console.log(dataLayer);
 		});
 	}

 	function gtmBookingEngine(params, hotelCategory) {

 		var dataArr = {
 				'event': 'search',
 			};

 		var hotelsInput = $('input[name="hotel-list"]');
 		if (params.hotel != undefined && hotelsInput.length) {
 			hotelList = JSON.parse(hotelsInput.val());
 			dataArr.destination = hotelList[params.hotel];
 		} else {
 			dataArr.destination = 'empty';
 		}
 		if (hotelCategory != undefined)
 			dataArr.hotel_category = hotelCategory;
 		if (params.adult != undefined)
 			dataArr.number_of_passengers = parseInt(params.adult);
 		if (params.teen != undefined)
 			dataArr.number_of_passengers += parseInt(params.teen);
 		if (params.child != undefined)
 			dataArr.number_of_passengers += parseInt(params.child);

 		dataArr.start_date = params.arrive != undefined ? params.arrive : 'empty';
 		dataArr.end_date = params.depart != undefined ? params.depart : 'empty';

 		if (params.arrive != undefined && params.depart != undefined) {

			var dateArriveParts = params.arrive.split("/");
			var arrive = new Date(+dateArriveParts[2], dateArriveParts[1] - 1, +dateArriveParts[0]); 
			var dateDepartParts = params.depart.split("/");
			var depart = new Date(+dateDepartParts[2], dateDepartParts[1] - 1, +dateDepartParts[0]); 
			var timeDiff = Math.abs(depart.getTime() - arrive.getTime());
			var numberOfNights = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
 			dataArr.number_of_nights = numberOfNights;
 		} else {
 			dataArr.number_of_nights = 'empty';
 		}

 		dataArr.hotel_searched = params.room != undefined && params.room != 'on' ? params.room : 'empty';

 		dataLayer.push(dataArr);
 		console.log(dataLayer);
 	}
});


/**
 * Lazy loading 
 **/

// Img
document.addEventListener('DOMContentLoaded', function() {
    var lazyImages = [].slice.call(document.querySelectorAll('[lazy]'));
    if ('IntersectionObserver' in window) {
        let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let lazyImage = entry.target;
                    lazyImage.classList.toggle('fade-animation');
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImageObserver.unobserve(lazyImage);

                    var img = new Image();
					img.src = lazyImage.src;
					img.onload = function() { 

						var galleryGrid = $('.gallery-grid');
						if (galleryGrid.length) {
							var grid = galleryGrid.isotope({
								itemSelector: '.gallery-grid--item',
								masonry: {
									columnWidth: '.gallery-grid--sizer',
									horizontalOrder: true,
									percentPosition: true
								}
							});
							grid.isotope('layout');
						}
					}
                }
            });
        });

        lazyImages.forEach(function(lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });
    }
});


// Background image
document.addEventListener("DOMContentLoaded", function() {
    var lazyBackgrounds = [].slice.call(document.querySelectorAll('.lazy-bg'));

    if ("IntersectionObserver" in window) {
        let lazyBackgroundObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {

                    let lazyBgImage = entry.target;
                    lazyBgImage.style = lazyBgImage.dataset.style;

                    lazyBackgroundObserver.unobserve(entry.target);
                }
            });
        });

        lazyBackgrounds.forEach(function(lazyBackground) {
            lazyBackgroundObserver.observe(lazyBackground);
        });
    }
});

// Video
document.addEventListener('DOMContentLoaded', function() {
    var lazyVideos = [].slice.call(document.querySelectorAll('[lazy-video]'));
    if ('IntersectionObserver' in window) {
        let lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {

                    let lazyVideo = entry.target;
					for (var source in lazyVideo.children) {
						var videoSource = lazyVideo.children[source];
						if (typeof videoSource.tagName === "string" && videoSource.tagName === "SOURCE") {
							videoSource.src = videoSource.dataset.src;
						}
					}
					lazyVideo.load();

					lazyVideoObserver.unobserve(lazyVideo);
                }
            });
        });

        lazyVideos.forEach(function(lazyVideo) {
            lazyVideoObserver.observe(lazyVideo);
        });
    }
});