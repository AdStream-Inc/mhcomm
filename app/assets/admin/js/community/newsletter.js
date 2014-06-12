(function($) {
  function Newsletter() {

    this.watchDeleteToggle();
    this.watchDeleteConfirm();
  }

  Newsletter.prototype.watchDeleteToggle = function() {
    var self = this;
    $('#newsletters .table .close').on('click', function() {
      self.selectedNewsletter = $(this).attr('data-path');
      self.selectedRow = $(this).closest('tr');
    });
  }

  Newsletter.prototype.watchDeleteConfirm = function() {
    var self = this;
    $('#newsletter-delete-button').on('click', function(e) {
      var html = '<input type="hidden" name="delete_newsletters[]" value="' + self.selectedNewsletter + '" />';
      $('#newsletters').append(html);
      $('#newsletter-delete-modal').modal('hide');

      self.selectedRow.addClass('faded').find('.close').remove();
    });
  }

  new Newsletter();

})(jQuery);