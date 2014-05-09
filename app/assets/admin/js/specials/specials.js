(function($) {
  $('.select-all').on('click', function(e) {
    var el = $(this);
    var select = el.closest('.form-group').find('select');
    var options = $('option', select);

    if (options.attr('selected')) {
      select.blur();
      el.text('Select All');
      options.removeAttr('selected');
    } else {
      select.focus();
      el.text('Unselect All');
      options.attr('selected', 1);
    }
  });
})(jQuery);