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
})(jQuery, window, document);