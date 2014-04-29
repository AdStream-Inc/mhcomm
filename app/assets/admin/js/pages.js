(function($) {
  function setActiveTemplate(id) {
    var sections = $('.template-sections');
    var active = $('#' + id);

    sections.removeClass('active').find('.template-section-content').attr('disabled', 'disabled');
    active.addClass('active').find('.template-section-content').removeAttr('disabled');
  }

  setActiveTemplate($('#template').val());

  $('#template').on('change', function() {
    setActiveTemplate($(this).val());
  });

  // reminder to add this to individual file
  $(document).on('click', '.jstree-anchor', function() {
    var url = URL.current + '/' + $(this).attr('data-id');

    $('select[name="parent_id"] option').removeAttr('disabled');
    $('select[name="parent_id"] option[value="' + $(this).attr('data-id') + '"]').attr('disabled', 'disabled');

    $.get(url, function(res) {
      loadPageData(res.page);
      loadSectionData(res.page.template, res.sections);
      makeUpdateForm(res.page.id);
    });
  });

  function loadPageData(data) {
    var inputs = {
      'name': 'input[name="name"]',
      'parent_id': 'select[name="parent_id"]',
      'enabled': 'select[name="enabled"]',
      'auth_only': 'select[name="auth_only"]',
      'template': 'select[name="template"]'
    }

    $.each(inputs, function(key, selector) {
      $(selector).val(data[key]);
    });
  }

  function resetPageData() {
    var inputs = {
      'input[name="name"]': '',
      'select[name="parent_id"]': 0,
      'select[name="enabled"]': 1,
      'select[name="auth_only"]': 0,
      'select[name="template"]': '1-col'
    }


    $.each(inputs, function(selector, value) {
      $(selector).val(value);
    });
  }

  function loadSectionData(template, data) {
    $('select[name="template"]').trigger('change');

    $.each(data, function() {
      $('textarea[name="templates[' + this.slug + ']"]', $('#' + template)).val(this.content);
    });
  }

  function resetSectionData() {
    $('.template-sections textarea').val('');
  }

  function makeUpdateForm(id) {
    $('#form-save').hide();
    $('#form-update, .page-create').show();
    var method = '<input type="hidden" id="form-method" name="_method" value="PUT" />';

    $('#pages-form')
      .attr('action', URL.current + '/' + id);

    if (!$('#form-method').length) {
      $('#pages-form').append(method);
    }
  }

  function makeCreateForm() {
    $('#form-save').show();
    $('#form-update, .page-create').hide();
    $('#form-method').remove();
    $('select[name="parent_id"] option').removeAttr('disabled');

    $('#pages-form')
      .attr('action', URL.current);
  }

  $('.page-create').on('click', function() {
    $('.jstree-wholerow-clicked').removeClass('jstree-wholerow-clicked');
    makeCreateForm();
    resetPageData();
    resetSectionData();
  });
})(jQuery);