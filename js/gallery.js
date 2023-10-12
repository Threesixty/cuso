$(document).ready(function(){
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

   	grid.imagesLoaded().progress( function() {
	  grid.isotope('layout');
	});

    // Class
    var normalClass = 'gray-text', activeClass = 'darkgray-text bold-text', hiddenClass = 'display-none', hasSublistClass = 'has-sublist';

    // Primary
    var galleryFilterPrimary = $('.gallery-filter--primary'), galleryFilterSublist = $('.gallery-filter--sublist');
    if (galleryFilterPrimary.length) {
      galleryFilterSublist.addClass(hiddenClass);
      galleryFilterPrimary.click(function(e) {
        var I = $(this), myFilter = I.attr('data-filter');
        galleryGrid.isotope({filter: myFilter});
        I.closest('.gallery-filter--list').find('.gallery-filter--primary').addClass(normalClass).removeClass(activeClass);
        I.removeClass(normalClass).addClass(activeClass);
        galleryFilterSublist.addClass(hiddenClass);
        if (I.hasClass(hasSublistClass)) {
          var mySublist = $(I.attr('data-sublist'));
          if (mySublist.length) {
            mySublist.find('.gallery-filter--secondary').addClass(normalClass).removeClass(activeClass);
            mySublist.find('.gallery-filter--secondary:eq(0)').removeClass(normalClass).addClass(activeClass);
            mySublist.removeClass(hiddenClass);
          }
        }

        // Previous Code
        var sectionId = $(this).attr('href');
        if (sectionId !== '#' && $(sectionId).length) {
          var sectionPos = $(sectionId).position();
          if ($(window).outerWidth() > 1081) {
            $(window).scrollTop(sectionPos.top - 188);
          }
          else {
            $(window).scrollTop(sectionPos.top - 151);
          }
        }

        e.preventDefault();
      });
    }

    // Secondary
    var galleryFilterSecondary = $('.gallery-filter--secondary');
    if (galleryFilterSecondary.length) {
      galleryFilterSecondary.click(function(e) {
        var I = $(this), myFilter = I.attr('data-filter');
        galleryGrid.isotope({filter: myFilter});
        I.closest('.gallery-filter--sublist').find('.gallery-filter--secondary').addClass(normalClass).removeClass(activeClass);
        I.removeClass(normalClass).addClass(activeClass);

        // Previous Code
        var sectionId = $(this).attr('href');
        if (sectionId !== '#' && $(sectionId).length) {
          var sectionPos = $(sectionId).position();
          if ($(window).outerWidth() > 1081) {
            $(window).scrollTop(sectionPos.top - 188);
          }
          else {
            $(window).scrollTop(sectionPos.top - 151);
          }
        }

        e.preventDefault();
      });
    }
  }
});