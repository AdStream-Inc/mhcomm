(function($, webix, window, document, undefined) {

  function Datatable() {
    this.init();
  }

  Datatable.prototype.init = function() {
    var self = this;

    webix.locale.pager = {
      first: "First",
      last: "Last",
    };

    $.get(URL.current, function(res) {
      self.datatable = new webix.ui({
        view: 'datatable',
        container: 'datatable',
        columns: res.columns,
        data: res.data,
        autoheight:true,
        width: $('#main .container').width(),
        scrollX: false,
        pager: {
          container: 'datatable-pager',
          size: 20,
          template: '{common.first()} {common.pages()} {common.last()}'
        }
      });
    });
  }

  /**
   * Need to implement this still.
   */
  Datatable.prototype.saveState = function() {
    webix.storage.local.put('state', $('#datatable'));
  }

  Datatable.prototype.restoreState = function() {
    var state = webix.storage.local.get('state');

    if (state) {
      $('#datatable').setState(state);
    }
  }

  window.Datatable = Datatable;

})(jQuery, webix, window, document);