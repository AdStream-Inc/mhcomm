(function($) {
  $(document).on('click', '#main-image-remove', function(e) {
    $(this).hide().parent().addClass('faded');
    $('#main-image-hidden').val('').removeAttr('disabled');
  });

  $(document).on('click', 'input[name="main_image_file"]', function() {
    $('#main-image-hidden').prop('disabled', true);
  });
})(jQuery);