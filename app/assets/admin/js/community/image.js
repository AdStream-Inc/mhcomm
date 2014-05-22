(function($) {
  $('#main-image-remove').on('click', function(e) {
    e.preventDefault();

    $(this).hide().parent().addClass('faded');
    $('#main-image-hidden').val('').removeAttr('disabled');
  });

  $('input[name="main_image_file"]').on('click', function() {
    $('#main-image-hidden').prop('disabled', true);
  });
})(jQuery);