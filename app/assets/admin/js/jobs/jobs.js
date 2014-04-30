(function($) {
  function Jobs() {
    this.init();
  }

  Jobs.prototype.init = function() {
    $('textarea').editable({
      inlineMode: false,
      autosave: true,
      borderColor: '#dce4ec',
      buttons: ['undo', 'redo' , 'sep', 'bold', 'italic', 'underline', 'color', 'formatBlock', 'sep', 'insertUnorderedList', 'insertOrderedList', 'createLink', 'sep', 'html'],
      height: 150,
      spellcheck: true,
      paragraphy: false,
      shortcuts: true
    });
  }

  new Jobs();
})(jQuery);