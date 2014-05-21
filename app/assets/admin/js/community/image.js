(function($) {
  $('#main-image-remove').on('click', function(e) {
    e.preventDefault();

    $(this).parent().addClass('faded');
    $('#main-image-hidden').val('').removeAttr('disabled');
  });
})(jQuery);