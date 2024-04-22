(function($) {

  'use strict';

  var App = {

    /**
     * Init
     */
    init: function() {
      App.header();
      App.slider();
      App.figure();
      App.popup();
      App.form();
      App.toggle();
      App.backstretch();
    },

    /**
     * Header
     */
    header: function() {
      var menu = $('.header-menu'), menuOpen = $('.header-menu--open'), menuClose = $('.header-menu--close');
      if (menu.length) {
        menuOpen.click(function(e) {
          menu.addClass('active');
          menuOpen.addClass('hidden');
          menuClose.removeClass('hidden');
          e.preventDefault();
        });
        menuClose.click(function(e) {
          menu.removeClass('active');
          menuOpen.removeClass('hidden');
          menuClose.addClass('hidden');
          e.preventDefault();
        });
      }

      var subnavTrigger = $('.header-subnav--trigger');
      if (subnavTrigger.length) {
        subnavTrigger.each(function() {
          var I = $(this), myParent = I.closest('li'), myParentSibs = myParent.siblings('li');
          I.bind('click', function() {
            if (!myParent.hasClass('expanded')) {
              myParent.addClass('expanded');
              myParentSibs.removeClass('expanded');
            } else {
              myParent.removeClass('expanded');
            }
          });
        });
      }

      var header = $('.header'), subnav = $('.header-subnav'), subnavToggle = $('.header-subnav--toggle'), subnavTimer;
      if (subnav.length) {
        subnavToggle.each(function() {
          var I = $(this), mySubnav = I.siblings('.header-subnav');
          I.hover(function() {
            clearTimeout(subnavTimer);
            header.addClass('highlight');
            subnav.removeClass('active');
            subnavToggle.removeClass('revealed');
            I.addClass('revealed');
            mySubnav.addClass('active');
          }, function() {
            subnavTimer = setTimeout(function() {
              header.removeClass('highlight');
              I.removeClass('revealed');
              mySubnav.removeClass('active');
            }, 200);
          });
        });
        subnav.hover(function() {
          clearTimeout(subnavTimer);
        }, function() {
          subnavTimer = setTimeout(function() {
            header.removeClass('highlight');
            subnav.removeClass('active');
            subnavToggle.removeClass('revealed');
          }, 200);
        });
      }

      var searchToggle = $('.search-toggle'), searchMask = $('.search-mask'), searchWrapper = $('.search-wrapper');
      if (searchToggle.length) {
        searchToggle.click(function(e) {
          searchMask.toggleClass('active');
          searchWrapper.toggleClass('active');
          e.preventDefault();
        });
      }

      var listContainer = $('.header-link'), listColumn = 2, listItem = 'li', listClass = 'header-list';
      if (listContainer.length) {
        listContainer.each(function() {
          var container = $(this), items = container.find(listItem), itemsPerColumn = new Array([]),
              minItemsPerColumn = Math.floor(items.length / listColumn),
              difference = items.length - (minItemsPerColumn * listColumn);
          for (var x = 0; x < listColumn; x++) {
            if (x < difference) {
              itemsPerColumn[x] = minItemsPerColumn + 1;
            } else {
              itemsPerColumn[x] = minItemsPerColumn;
            }
          }
          container.empty();
          for (var i = 0; i < listColumn; i++) {
            container.append($('<ul></ul>').addClass(listClass));
            for (var j = 0; j < itemsPerColumn[i]; j++) {
              var pointer = 0;
              for (var k = 0; k < i; k++) {
                pointer += itemsPerColumn[k];
              }
              container.find('.' + listClass).last().append(items[j + pointer]);
            }
          }
        });
      }
    },

    /**
     * Slider
     */
    slider: function() {
      var slider = $('.owl-carousel'),
          prev = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M18.4 14.1l9.9 9.9-9.9 9.9 2.1 2.1 11.9-12-11.9-12-2.1 2.1z"></path></svg>',
          next = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M29.6 33.9L19.7 24l9.9-9.9-2.1-2.1-11.9 12 11.9 12 2.1-2.1z"></path></svg>';
      if (slider.length) {
        slider.on('initialized.owl.carousel resized.owl.carousel', function() {
          $.fn.matchHeight._update();
        });
      }

      var slider1 = $('.owl-carousel.i1');
      if (slider1.length) {
        slider1.owlCarousel({
          items: 1,
          margin: 20,
          nav: false,
          dots: true,
          smartSpeed: 750,
          responsiveRefreshRate: 0
        });
      }

      var slider2 = $('.owl-carousel.i2');
      if (slider2.length) {
        slider2.owlCarousel({
          items: 1,
          margin: 20,
          nav: false,
          dots: true,
          smartSpeed: 750,
          responsiveRefreshRate: 0,
          loop: true,
          autoplay: true,
          autoplayTimeout: 5e3,
          autoplayHoverPause: true,
          animateIn: 'fadeIn',
          animateOut: 'fadeOut'
        });
      }

      var slider3 = $('.owl-carousel.i3');
      if (slider3.length) {
        slider3.owlCarousel({
          items: 1,
          margin: 20,
          nav: false,
          dots: true,
          smartSpeed: 750,
          responsiveRefreshRate: 0,
          autoWidth: true
        });
      }

      var slider4 = $('.owl-carousel.i4');
      if (slider4.length) {
        slider4.owlCarousel({
          items: 1,
          margin: 0,
          nav: true,
          navText: [next, prev],
          dots: false,
          smartSpeed: 750,
          responsiveRefreshRate: 0,
          responsive: {
            0: {
              items: 1
            },
            768: {
              items: 2
            },
            1024: {
              items: 3
            }
          }
        });
      }

      var slider5 = $('.owl-carousel.i5');
      if (slider5.length) {
        slider5.owlCarousel({
          items: 1,
          margin: 0,
          nav: false,
          dots: true,
          smartSpeed: 750,
          responsiveRefreshRate: 0
        });
      }

      var slider6 = $('.owl-carousel.i6');
      if (slider6.length) {
        slider6.owlCarousel({
          items: 1,
          slideBy: 1,
          margin: 20,
          nav: false,
          dots: true,
          smartSpeed: 750,
          responsiveRefreshRate: 0,
          responsive: {
            0: {
              items: 1
            },
            768: {
              items: 2
            },
            1024: {
              items: 3
            },
            1280: {
              items: 4
            }
          }
        });
      }

      var slider7 = $('.owl-carousel.i7');
      if (slider7.length) {
        slider7.owlCarousel({
          items: 1,
          margin: 10,
          nav: true,
          navText: [next, prev],
          dots: false,
          smartSpeed: 750,
          responsiveRefreshRate: 0
        });
      }
    },

    /**
     * Figure
     */
    figure: function() {
      var figureList = $('.figure-list');
      if (figureList) {
        App.figureSlider();
        $(window).resize(function() {
          App.figureSlider();
        });
      }
    },
    figureSlider: function() {
      var viewport = $(window), breakpoint = 768, figureList = $('.figure-list');
      if (viewport.width() >= breakpoint) {
        if (typeof figureList.data('owl.carousel') != 'undefined') {
          figureList.data('owl.carousel').destroy();
        }
        figureList.removeClass('owl-carousel');
      } else {
        figureList.addClass('owl-carousel');
        figureList.owlCarousel({
          items: 1,
          margin: 20,
          nav: false,
          dots: true,
          smartSpeed: 750,
          responsiveRefreshRate: 0
        });
      }
    },

    /**
     * Popup
     */
    popup: function() {
      var iframe = $('.popup-iframe');
      if (iframe.length) {
        iframe.magnificPopup({
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
        });
      }
    },

    /**
     * Toggle
     */
    toggle: function() {
      var filter = $('.toolbox-filter'), filterToggle = $('.toolbox-filter--toggle');
      if (filter.length) {
        filterToggle.click(function(e) {
          filter.toggleClass('hidden');
          filterToggle.toggleClass('highlight');
          e.preventDefault();
        });
      }

      var search = $('.toolbox-search'), searchToggle = $('.toolbox-search--toggle');
      if (search.length) {
        searchToggle.click(function(e) {
          search.toggleClass('hidden');
          searchToggle.toggleClass('highlight');
          e.preventDefault();
        });
      }

      var sectionToggle = $('.toolbox-section--toggle');
      if (sectionToggle.length) {
        sectionToggle.bind('click', function(e) {
          var I = $(this), mySection = I.closest('.toolbox-section');
          if (mySection.length) {
            mySection.toggleClass('active');
          }
          e.preventDefault();
        });
      }

      var faqHeader = $('.faq-header');
      if (faqHeader.length) {
        faqHeader.bind('click', function() {
          var I = $(this), myItem = I.closest('.faq-item');
          if (!myItem.hasClass('active')) {
            myItem.addClass('active');
            myItem.siblings('.faq-item.active').removeClass('active');
          } else {
            myItem.removeClass('active');
          }
        });
      }

      var centerBlockHeader = $('.center-block--header');
      if (centerBlockHeader.length) {
        centerBlockHeader.bind('click', function() {
          var I = $(this), mySection = I.closest('.center-block');
          if (mySection.length) {
            mySection.toggleClass('active');
          }
        });
      }

      var centerLegendToggle = $('.center-legend--toggle');
      if (centerLegendToggle.length) {
        centerLegendToggle.click(function(e) {
          var I = $(this), myLegend = I.closest('.center-legend');
          if (myLegend.length) {
            myLegend.toggleClass('active');
          }
          e.preventDefault();
        });
      }
    },

    /**
     * Form
     */
    form: function() {
      var formSelect = $('.form-select');
      if (formSelect.length) {
        formSelect.each(function() {
          var I = $(this), mySelect = I.find('select'), myOption = mySelect.find('option:selected'), myInput = I.find('input');
          if (myOption.index() !== 0) {
            myInput.val(myOption.html());
          }
          mySelect.change(function() {
            myOption = mySelect.find('option:selected');
            if (myOption.index() !== 0) {
              myInput.val(myOption.html());
            } else {
              myInput.val('');
            }
          });
        });
      }

      var formUpload = $('.form-upload');
      if (formUpload.length) {
        formUpload.each(function() {
          var I = $(this), myFile = I.find('.form-upload--file'), myInput = I.find('.form-upload--input'), myReset = I.find('.form-upload--reset');
          myFile.change(function() {
            myInput.val(myFile.val().replace(/.*(\/|\\)/, ''));
            myReset.addClass('active');
          });
          myReset.click(function(e) {
            myFile.val('');
            myInput.val('');
            myReset.removeClass('active');
            e.preventDefault();
          });
        });
      }
    },

    /**
     * Backstretch
     */
    backstretch: function() {
      var backstretch = $('.backstretch');
      if (backstretch.length) {
        backstretch.each(function() {
          var I = $(this), myImage = I.children('img');
          if (myImage.length) {
            I.css('background-image', 'url(' + myImage.attr('src') + ')');
          }
        });
      }
    }

  };

  $(function() {
    App.init();
  });

})(jQuery);
