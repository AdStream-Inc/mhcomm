(function($) {
    $('.wysiwyg').editable({
        inlineMode: false,
        autosave: true,
        borderColor: '#dce4ec',
        buttons: ['undo', 'redo', 'sep', 'bold', 'italic', 'underline', 'color', 'formatBlock', 'sep', 'table', 'insertUnorderedList', 'insertOrderedList', 'createLink', 'sep', 'html'],
        height: 200,
        spellcheck: true,
        paragraphy: false
    });

     $('.wysiwyg-image').editable({
        inlineMode: false,
        autosave: true,
        borderColor: '#dce4ec',
        buttons: ['undo', 'redo', 'sep', 'bold', 'italic', 'underline', 'color', 'formatBlock', 'sep', 'table', 'insertUnorderedList', 'insertOrderedList', 'createLink', 'insertImage', 'sep', 'html'],
        height: 200,
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
})(jQuery);