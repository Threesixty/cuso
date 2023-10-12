$( function() {
	
	//prevents the vertical scrollbar
	$("#open-burger-menu").click (
		function() {
			if ($('#open-burger-menu').prop('checked')) {
				$("body").addClass("hide-vertical-scrollbar");
			} else {
				$("body").removeClass("hide-vertical-scrollbar");
			}
		}
	)
	
	//
	$("#activate-ah-filter, #activate-ah-filter-alt, #activate-features-list, #activate-features-list-alt").click (
		function() {
			$("body").addClass("hide-vertical-scrollbar");
		}
	)
	$("#toggle-filter, #toggle-features").click (
		function() {
			if (!$('#open-burger-menu').prop('checked')) {
				$("body").removeClass("hide-vertical-scrollbar");
			}
		}
	)
	
	//toggles the dropdown sub-menus
	$('.has-child').click (
		function() {
			$(this).find('.sub-nav').addClass('show-sub-nav');
		}
	);
	$('.sub-nav-close').click (
		function(e) {
			e.stopPropagation();
			$(this).parent("div").removeClass('show-sub-nav');
		}
	);
	
	
	//toggles the filter & the features lists on mobile
	$('#activate-ah-filter').click (
		function() {
			$("body.hotel-selected .booking-bar:not(.book-now-bar) .ah-filter-wrapper, body:not(.hotel-selected) .ah-filter-wrapper").addClass('activate-ah-filter');
		}
	);
	$('#activate-ah-filter-alt').click (
		function() {
			$("body.hotel-selected .booking-bar.book-now-bar .ah-filter-wrapper").addClass('activate-ah-filter');
		}
	);
	
	$('#toggle-filter').click (
		function() {
			$(".ah-filter-wrapper").removeClass('activate-ah-filter');
			$(".ah-features-wrapper:not(.alt)").removeClass('activate-features-list');
			$(".ah-features-wrapper.alt").removeClass('activate-features-list');
		}
	);
	
	$('#activate-features-list').click (
		function() {
			$(".ah-features-wrapper:not(.alt)").addClass('activate-features-list');
		}
	);
	
	$('#activate-features-list-alt').click (
		function() {
			$(".ah-features-wrapper.alt").addClass('activate-features-list');
		}
	);
	
	
	//prevents filter's "All Hotels" and "Add guests" popups
	$('#datepicker-from').click (
		function() {
			$('#ah-filter-item-checkbox').prop('checked', false);
			$('#ah-filter-item-checkbox4').prop('checked', false);
		}
	)
	$('#datepicker-to').click (
		function() {
			$('#ah-filter-item-checkbox').prop('checked', false);
			$('#ah-filter-item-checkbox4').prop('checked', false);
		}
	)
	//prevents filter's "All rooms" and "Add guests" popups
	$('#datepicker-from-bn').click (
		function() {
			$('#ah-filter-item-checkbox_2').prop('checked', false);
			$('#ah-filter-item-checkbox4_2').prop('checked', false);
		}
	)
	$('#datepicker-to-bn').click (
		function() {
			$('#ah-filter-item-checkbox_2').prop('checked', false);
			$('#ah-filter-item-checkbox4_2').prop('checked', false);
		}
	)
	
	
	//toggles the filter in hotel results page's body
	$('#search-details-show').click (
		function() {
			$(".hotel-results .ah-filter-wrapper").toggleClass('hotel-results-filter');
			$(".search-details-icon").toggleClass('rotated');
		}
	)
	
	//toggles the booking bar and makes some blocks to have higher level
	$('.show-booking-bar').click (
		function(e) {
			//$(".booking-bar.book-now-bar").toggle(); 
			function localToggleFunc() {
				$('body').toggleClass('body-covered');
				$('body').toggleClass('hide-vertical-scrollbar');
				$('.hotel-top-bar, .booking-bar.book-now-bar').toggleClass('has-higher-level');
			}
			
			var scrollTop = $(window).scrollTop();
			if (scrollTop > 102) {
				e.preventDefault();
				$(".booking-bar.book-now-bar").toggleClass("be-sticky-2");
				localToggleFunc();
			}
			else {
				$(".booking-bar.book-now-bar").toggleClass("be-sticky-3");
				localToggleFunc();
			}
		}
	)
	//toggles the filter bar and makes some blocks to have higher level
	$('.show-filter-bar').click (
		function(e) {
			//$(".booking-bar:not(.book-now-bar)").toggle(); 
			e.preventDefault();
			$(".booking-bar:not(.book-now-bar)").toggleClass("be-sticky-1");
			$('body').toggleClass('body-covered');
			$('body').toggleClass('hide-vertical-scrollbar');
			$('.top-nav-bar, .booking-bar:not(.book-now-bar)').toggleClass('has-higher-level');
		}
	)
	
	//right placing of calling section after an appropriate link click from the fixed positioned tabs in some Individual Hotels pages
	$('.hotel-selected-tabs li a').click(
		function (e) {
			if (!$(this).closest('.hotel-selected-tabs').hasClass('positive-impact') && $(this).attr('href') != '#') {
	            e.preventDefault();
	            //e.stopPropagation();

	            var sectionId = $(this).attr('href');
	            var sectionPos = $(sectionId).position();
				if ($(window).outerWidth() > 1081) {
					if ($(this).closest('body').hasClass('hotel-selected'))
						$(window).scrollTop(sectionPos.top - 188);
					else
						$(window).scrollTop(sectionPos.top - 100);
				}
				else {
					if ($(this).closest('body').hasClass('hotel-selected'))
						$(window).scrollTop(sectionPos.top - 151);
					else
						$(window).scrollTop(sectionPos.top - 100);
				}
			}
        }
	)
	
	
	$(window).bind("scroll", function() {
		var scrollTop = $(this).scrollTop();

		// checks the measure of the current scroll step to make sticky and to level up the selected hotels' top nav 
		if ($(window).outerWidth() > 1081) {
			if (scrollTop > 1) {
				$(".hotel-top-bar").addClass('level-up');
				$("body.hotel-selected .top-nav-bar").addClass("no-pointer-events");
			} else {
				$(".hotel-top-bar").removeClass('level-up');
				$("body.hotel-selected .top-nav-bar").removeClass("no-pointer-events");
			}
			
			if (scrollTop > 66) {
				$(".positive-impact.hotel-selected-tabs").addClass("has-border-top");
			}
			else {
				$(".positive-impact.hotel-selected-tabs").removeClass("has-border-top");
			}
		}
		else {
			if (scrollTop > 1) {
				$(".hotel-top-bar").addClass('level-up');
			} else {
				$(".hotel-top-bar").removeClass('level-up');
			}
		}
	})
});