(function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 54)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 54
  });

})(jQuery); // End of use strict

// more custom jscode for sliding hidden parts

jQuery(document).ready(function($) {
  //Set default open/close settings
  var divs = $('.page-content .acc_hide').hide(); //Hide/close all containers
  var bibtex = $('.cit-bibtex').hide(); //Hide/close all containers
  // var bibtexcopy = $('.cit-bibtex>pre, .cit-text').click(function() {
  //   var $temp = $("<input>");
  //   $("body").append($temp);
  //   $temp.val($(this).text()).select();
  //   document.execCommand("copy");
  //   $temp.remove();
  //   alert('Citation entry copied to clipboard');
  // });
  var h2s = $('li.info').click(function() {
    //h2s.not(this).removeClass('active')
    // $(this).toggleClass('active')
    //				thisurl = $(this).next('div').find('a')[0].href
    //divs.not($(this).parent().next('.acc_hide')).slideUp()
    var text = $(this.firstChild).text();
    $(this.firstChild).text(
      text == "More info..." ? "Less info" : "More info..."
    )
    $(this).parent().children('.acc_hide').slideToggle()
    //				$(this).next('div').load(thisurl)

    return false; //Prevent the browser jump to the link anchor
  });

  var showcit = $('.title>.acc_trigger').click(function() {
    var text2 = $(this.firstChild).text();
    $(this.firstChild).text(
        text2 == "BibTeX" ? "Text" : "BibTeX"
    );
    $(this).parent().siblings('.cit-text').slideToggle();
    $(this).parent().siblings('.cit-bibtex').slideToggle();
  });

  var filter = $('.filter').click(function() {
    var filterid = $(this)[0].id
    if (filterid=='reset') {
      $('li.post').slideDown()
    } else {
      $('li.post').slideDown(10)
      $('li.post.'+filterid).slideUp();
  }
  });

});
