(function($, window, document) {
  $(document).on('click', '.revision-accept', function(e) {
    e.preventDefault();

    var el = $(this);

    var url = URL.admin + '/revisions/' + $(this).attr('data-id') + '/approve';

    $.post(url, function(res) {
      window.location.reload();
    });
  });

  $(document).on('click', '.revision-deny', function(e) {
    e.preventDefault();

    var url = URL.admin + '/revisions/' + $(this).attr('data-id') + '/deny';

    $.post(url, function(res) {
      window.location.reload();
    });
  });

  $('#select-all-revisions').on('click', function() {
    // WARNING hackish

    $.each($('.btn-group'), function() {
      var approve = $(this).find('label').eq(1);

      approve.addClass('active').find('input').prop('checked', true).trigger('changed');
    });
  });
})(jQuery, window, document);