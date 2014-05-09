(function($, webix, window, document, undefined) {

  function Datatable() {
    this.init();
  }

  Datatable.prototype.init = function() {
    var self = this;

    $.get(URL.current + '/list', function(res) {
      self.datatable = new webix.ui({
        view: 'datatable',
        container: 'datatable',
        columns: res.columns,
        data: res.data,
        autoheight:true,
        autoWidth: true,
        scrollX: false,
        pager: {
          container: 'datatable-pager',
          size: 20,
          template: '{common.pages()}'
        }
      });
    });
  }

  window.Datatable = Datatable;

})(jQuery, webix, window, document);