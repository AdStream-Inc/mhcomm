(function($) {
  function ApplyForm() {
    this.applicationType = 'purchasing';
    this.hasCoSigner = false;
    this.updateFields();
    this.watchCoSignToggle();
    this.watchTypeToggle();
  }

  ApplyForm.prototype.setApplicationType = function(type) {
    this.applicationType = type;
    this.updateFields();
  }

  ApplyForm.prototype.setHasCoSigner = function(bool) {
    this.hasCoSigner = bool;
    this.updateFields();
  }

  ApplyForm.prototype.updateFields = function() {
    switch (this.applicationType) {
      case 'purchasing':
        console.log('purchasing case');
        $('[data-type="renting"], [data-type="moving-in"]').hide();
        $('[data-type="purchasing"], [data-type="purchasing:renting"]').show();
        break;
      case 'renting':
        console.log('renting case');
        $('[data-type="purchasing"], [data-type="moving-in"]').hide();
        $('[data-type="renting"], [data-type="purchasing:renting"]').show();
        break;
      case 'moving in':
        console.log('moving case');
        $('[data-type="renting"], [data-type="purchasing"], [data-type="purchasing:renting"]').hide();
        $('[data-type="moving-in"]').show();
        break;
    }

    if (this.hasCoSigner) {
      $('[data-type="cosigner"]').show();
    } else {
      $('[data-type="cosigner"]').hide();
    }
  }

  ApplyForm.prototype.watchCoSignToggle = function() {
    var self = this;
    $('#co-sign-toggle').on('change', function() {
      var bool = $(this).val() == 'Yes' ? 1 : 0;
      self.setHasCoSigner(bool);
    });
  }

  ApplyForm.prototype.watchTypeToggle = function() {
    var self = this;
    $('#type-toggle').on('change', function() {
      var type = $(this).val();
      self.setApplicationType(type.toLowerCase());
    });
  }

  window.ApplyForm = ApplyForm;
})(jQuery);