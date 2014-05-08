(function($) {
  var minHeight = $(window).height() - ($('#header').outerHeight() + $('#footer').outerHeight());

  $('#main').css('min-height', minHeight);
})(jQuery);