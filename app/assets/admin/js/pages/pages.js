(function($, window, document) {

  function Pages() {
    /**
     * Instantiate some of our basic selectors
     */
    this.sections = $('.template-sections');
    this.template = $('#template');
    this.activeTemplate = $('#template').val();
    this.createButton = $('.page-create');
    this.saveButton = $('#form-save');
    this.updateButton = $('#form-update');
    this.form = $('#pages-form');

    /**
     * Default vals for some of our inputs
     */
    this.pageInputs = {
      'input[name="name"]': {
        defaultVal: '',
        ajaxKey: 'name'
      },
      'select[name="parent_id"]': {
        defaultVal: 0,
        ajaxKey: 'parent_id'
      },
      'select[name="enabled"]': {
        defaultVal: 1,
        ajaxKey: 'enabled'
      },
      'select[name="auth_only"]': {
        defaultVal: 0,
        ajaxKey: 'auth_only'
      },
      'select[name="template"]': {
        defaultVal: '1-col',
        ajaxKey: 'template'
      }
    }

    /**
     * Initialize the module
     */
    this.init();
  }

  Pages.prototype.init = function() {
    this.initWysiwyg();
    this.setActiveTemplate(this.activeTemplate);
    this.watchTemplate();
    this.watchTreeNode();
    this.watchCreateButton();
  }

  Pages.prototype.initWysiwyg = function() {
    this.editors = $('.template-section-content').editable({
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

  Pages.prototype.setActiveTemplate = function(id) {
    var active = $('#' + id);

    this.sections.removeClass('active').find('.template-section-content').attr('disabled', 'disabled');
    active.addClass('active').find('.template-section-content').removeAttr('disabled');
  }

  Pages.prototype.watchTemplate = function() {
    var self = this;
    this.template.on('change', function() {
      self.setActiveTemplate($(this).val());
    });
  }

  Pages.prototype.watchTreeNode = function() {
    var self = this;

    $(document).on('click', '.jstree-anchor', function() {
      var url = URL.current + '/' + $(this).attr('data-id');

      /**
       * Disable this specific page in the parent page dropdown
       */
      $('select[name="parent_id"] option').removeAttr('disabled');
      $('select[name="parent_id"] option[value="' + $(this).attr('data-id') + '"]').attr('disabled', 'disabled');

      $.get(url, function(res) {
        self.loadPageData(res.page);
        self.loadSectionData(res.page.template, res.sections);
        self.makeUpdateForm(res.page.id);
      });
    });
  }

  /**
   * Update the page data (does not affect sections)
   * @param  {object} data Our ajax page data
   */
  Pages.prototype.loadPageData = function(data) {
    $.each(this.pageInputs, function(selector, obj) {
      $(selector).val(data[obj.ajaxKey]);
    });
  }

  Pages.prototype.resetPageData = function() {
    $.each(this.pageInputs, function(selector, obj) {
      $(selector).val(obj.defaultVal);
    });
  }

  Pages.prototype.loadSectionData = function(template, data) {
    $('select[name="template"]').trigger('change');
    $('.template-section-content')
      .val('')
      .editable('setHTML', '');

    /**
     * Cycle through sections and update wysiwyg and textarea
     */
    $.each(data, function() {
      $('#' + this.slug)
        .val(this.content)
        .editable('setHTML', this.content);
    });
  }

  Pages.prototype.resetSectionData = function() {
    $('.template-sections textarea')
      .val('')
      .editable('setHTML', '');
  }

  Pages.prototype.makeUpdateForm = function(id) {
    this.saveButton.hide();
    this.updateButton.show()
    this.createButton.show();

    var method = '<input type="hidden" id="form-method" name="_method" value="PUT" />';

    this.form
      .attr('action', URL.current + '/' + id)
      .removeClass('fadeInRight');

    if (!$('#form-method').length) {
      this.form.append(method);
    }
  }

  Pages.prototype.makeCreateForm = function() {
    this.saveButton.show();
    this.updateButton.hide()
    this.createButton.hide();

    this.setActiveTemplate(this.activeTemplate);

    $('#form-method').remove();
    $('select[name="parent_id"] option').removeAttr('disabled');

    this.form
      .attr('action', URL.current)
      .addClass('fadeInRight');
  }

  Pages.prototype.watchCreateButton = function() {
    var self = this;
    this.createButton.on('click', function() {
      $('.jstree-wholerow-clicked').removeClass('jstree-wholerow-clicked');
      self.makeCreateForm();
      self.resetPageData();
      self.resetSectionData();
    });
  }

  new Pages();

})(jQuery, window, document);