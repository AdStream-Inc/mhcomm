(function($) {
  $("#gallery").owlCarousel({
    items: 5,
    margin: 15,
    loop: true,
    dots: false,
    mobileBoost: true,
  });

  $('.gallery-image').magnificPopup({
    type: 'image'
  });

  $('#state-filter').on('change', function() {
    var val = $(this).val();

    if (!val || val == 0) {
      window.location = URL.base + '/communities';
    } else {
      window.location.href = URL.current + '?state_filter=' + val;
    }
  });

  $('.gallery-toggle').on('click', function(e) {
    e.preventDefault();

    $('#gallery').toggleClass('active');
  })
})(jQuery);