$(document).ready(function(){

  // Class
  var active = 'active', expanded = 'expanded';

  // Search
  var faqSearch = $('.faq-search');
  if (faqSearch.length) {
    faqSearch.each(function() {
      var I = $(this), myInput = I.find('input'), myValue = myInput.val();
      if (myValue) {
        I.addClass(active);
      }
      myInput.focus(function() {
        I.addClass(active);
      }).blur(function() {
        myValue = myInput.val();
        if (!myValue) {
          I.removeClass(active);
        }
      });
    });
  }

  // Dropdown
  var faqDropdown = $('.faq-dropdown');
  if (faqDropdown.length) {
    faqDropdown.each(function() {
      var I = $(this), myToggle = I.find('.faq-dropdown--toggle');
      myToggle.bind('click', function(e) {
        if (!I.hasClass(expanded)) {
          faqDropdown.removeClass(expanded);
          I.addClass(expanded);
          myToggle.attr('aria-expanded', true);
        } else {
          I.removeClass(expanded);
          myToggle.attr('aria-expanded', false);
        }
        //e.preventDefault();
      });
    });
  }

  // Accordion
  var faqAccordion = $('.faq-accordion');
  if (faqAccordion.length) {
    faqAccordion.each(function() {
      var I1 = $(this), myToggle = I1.find('.faq-accordion--toggle');
      myToggle.bind('click', function(e) {
        var I2 = $(this), myItem = I2.closest('.faq-accordion--item'), mySiblings = myItem.siblings('.' + expanded);
        if (!myItem.hasClass(expanded)) {
          if (mySiblings.length) {
            mySiblings.removeClass(expanded);
            mySiblings.find('.faq-accordion--toggle').attr('aria-expanded', false);
          }
          myItem.addClass(expanded);
          I2.attr('aria-expanded', true);
        } else {
          myItem.removeClass(expanded);
          I2.attr('aria-expanded', false);
        }
        e.preventDefault();
      });
    });
  }

  // Viewport
  var viewport = $(document);
  viewport.bind('click', function(e) {
    var target = $(e.target);

    // Dropdown
    var isDropdown = target.closest('.faq-dropdown'), expandedDropdown = $('.faq-dropdown.expanded');
    if (!isDropdown.length && expandedDropdown.length) {
      expandedDropdown.removeClass(expanded);
      expandedDropdown.find('.faq-dropdown--toggle').attr('aria-expanded', false);
    }
  });

});