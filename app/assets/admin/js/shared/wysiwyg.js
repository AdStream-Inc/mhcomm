(function($) {
    $('.wysiwyg-special').editable({
        inlineMode: false,
        autosave: true,
        borderColor: '#dce4ec',
        buttons: ['undo', 'redo', 'sep', 'bold', 'italic', 'underline', 'color', 'formatBlock', 'sep', 'insertUnorderedList', 'insertOrderedList', 'createLink', 'insertImage', 'sep', 'html'],
        height: 150,
        spellcheck: true,
        paragraphy: false,
        shortcuts: true
    });
})(jQuery);