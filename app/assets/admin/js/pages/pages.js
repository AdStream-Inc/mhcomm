(function($, window, document) {

  function Pages() {
    /**
     * Instantiate some of our basic selectors
     */
    this.sections = $('.template-sections');
    this.template = $('#template');
    this.activeTemplate = $('#template').val();
    this.createButton = $('#page-create');
    this.saveButton = $('#form-save');
    this.updateButton = $('#form-update');
    this.deleteButton = $('#form-delete');
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
    this.watchSubmitButton();
  }

  Pages.prototype.initWysiwyg = function() {
    this.editors = $('.template-section-content').editable({
        inlineMode: false,
        borderColor: '#dce4ec',
        buttons: ['undo', 'redo', 'sep', 'bold', 'italic', 'underline', 'color', 'formatBlock', 'sep', 'insertUnorderedList', 'insertOrderedList', 'createLink', 'insertImage', 'sep', 'html'],
        height: 150,
        spellcheck: true,
        paragraphy: false,
        imageUploadURL: URL.base + '/wysiwyg-upload',
        imageErrorCallback: function(data) {
            // Bad link.
            if (data.errorCode == 1) {
                console.log('bad link');
            }

            // No link in upload response.
            else if (data.errorCode == 2) {
                console.log('no link in upload response');
            }

            // Error during file upload.
            else if (data.errorCode == 3) {
                console.log('error during file upload');
            }

            // Parsing response failed.
            else if (data.errorCode == 4) {
                console.log('parsing response failed');
            }
        }
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
      self.clearValidation();

      $.get(url, function(res) {
        self.loadPageData(res.page);
        self.loadSectionData(res.page.template, res.sections);
        self.makeUpdateForm(res.page.id);
        self.updateDeleteForm(res.page.id);
      });
    });
  }

  Pages.prototype.watchSubmitButton = function() {
    this.saveButton.on('click', function() {
      $('.template-section-content').editable('sync');
    });

    this.updateButton.on('click', function() {
      $('.template-section-content').editable('sync');
    });
  }

  Pages.prototype.watchCreateButton = function() {
    var self = this;
    this.createButton.on('click', function() {
      $('.jstree-wholerow-clicked').removeClass('jstree-wholerow-clicked');
      self.makeCreateForm();
      self.resetPageData();
      self.resetSectionData();
      self.clearValidation();
    });
  }

  Pages.prototype.loadPageData = function(data) {
    $.each(this.pageInputs, function(selector, obj) {
      $(selector).val(data[obj.ajaxKey]);
    });
  }

  Pages.prototype.resetPageData = function() {
    var self = this;
    $.each(this.pageInputs, function(selector, obj) {
      $(selector).val(obj.defaultVal);
    });

    this.setActiveTemplate(this.activeTemplate);
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
    this.deleteButton.show();

    var method = '<input type="hidden" name="_method" value="PUT" />';

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
	this.deleteButton.hide();

    this.setActiveTemplate(this.activeTemplate);

    $('input[name="_method"]').remove();
    $('select[name="parent_id"] option').removeAttr('disabled');

    this.form
      .attr('action', URL.current)
      .addClass('fadeInRight');
  }

  Pages.prototype.clearValidation = function()
  {
    $('input[name="name"]').closest('.form-group').removeClass('has-error').find('.help-block').remove();
  }

  Pages.prototype.updateDeleteForm = function(id) {
    $('#confirm-delete-modal form').attr('action', URL.current + '/' + id);
  }

  window.Pages = Pages;

})(jQuery, window, document);