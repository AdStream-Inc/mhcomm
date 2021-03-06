(function($, window, document, undefined) {
    function Uploader() {
        this.init();
    }

    Uploader.prototype.init = function() {
        this.watchAddButton();
        this.watchCloseButton();
        this.watchPreviewButton();
    }

    Uploader.prototype.addFileRow = function() {
        var html = '<tr class="file-row">';
        html += '<td class="col-sm-1 text-center">';
        html += '<input "file-input" type="file" name="images[]" />';
        html += '</td>';
        html += '<td><input type="text" placeholder="File name..." class="form-control input-sm" name="image_titles[]" /></td>';
        html += '<td class="col-sm-1 text-center"><button data-toggle="modal" data-target="#close-modal" type="button" class="close" aria-hidden="true">&times;</button></td>';
        html += '</tr>';

        $('#upload-files').append(html);
    };

    Uploader.prototype.watchAddButton = function() {
        var self = this;
        $('#file-add').on('click', function(e) {
            e.preventDefault();
            self.addFileRow();
        });
    }

    Uploader.prototype.watchCloseButton = function() {
		
		var self = this;
		
        $(document).on('click', '#upload-files .close', function(e) {
            e.preventDefault();
            self.el = $(this);
            self.parent = self.el.closest('.file-row');
            self.oldInput = $('.old-input', self.parent);
        });
		
		$(document).on('click', '#close-modal .delete-button', function() {
			
			$('#close-modal').modal('hide');

			self.el.hide();
			self.parent.addClass('faded');
			self.oldInput.prop('disabled', true);
			self.parent.find('.form-control').prop('disabled', true);

			var html = '<input type="hidden" name="delete_images[]" value="' + self.oldInput.attr('data-id') + '" />';
			$('#upload-form').append(html);

		});
		
    }

    Uploader.prototype.watchPreviewButton = function() {
        $(document).on('click', '.img-preview', function(e) { 
            var el = $(this);

            $('#preview-img').attr('src', el.attr('src'));
        });
    }

    window.Uploader = Uploader;

})(jQuery, window, document);