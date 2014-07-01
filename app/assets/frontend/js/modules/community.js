(function($) {
  $("#gallery").owlCarousel({
    items: 1,
    margin: 15,
    loop: false,
    dots: false,
    mobileBoost: true,
    responsive: {
      480: {
        items: 2,
      },
      650: {
        items: 3,
      },
      768: {
        items: 5
      }
    }
  });

  $('.gallery-image').magnificPopup({
    type: 'image',
    gallery: {
      enabled: true,
      navigateByImgClick: true
    }
  });

  $('.gallery-image-hidden').magnificPopup({
    type: 'image',
    gallery: {
      enabled: true,
      navigateByImgClick: true
    }
  });
  $('#state-filter').on('change', function() {
    var val = $(this).val();

    if (!val || val === 0) {
      window.location = URL.base + '/communities';
    } else {
      window.location.href = URL.current + '?state_filter=' + val;
    }
  });

  $('.gallery-toggle').on('click', function(e) {
    e.preventDefault();

    $('#gallery').toggleClass('active');
  });

  $('#community-list tbody tr').on('click', function() {
    window.location = $(this).attr('data-url');
  });
})(jQuery);