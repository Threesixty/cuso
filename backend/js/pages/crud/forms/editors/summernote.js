"use strict";
// Class definition

var Summernote = function () {
    // Private functions
    var initSummernote = function (selector) {
        selector.summernote({
            disableDragAndDrop: true,
            lang: 'fr-FR',
            height: 200,
            tabsize: 2,
            toolbar: [
                ['misc', ['undo', 'redo']],
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'table', 'hr']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ]
        });
        $('.note-editor .note-dropdown-menu .note-btn').tooltip('disable');
    }
    var destroySummernote = function () {
        $('.summernote').summernote('destroy');
    }

    return {
        // public functions
        init: function(selector) {
            initSummernote(selector);
        },
        destroy: function() {
            destroySummernote();
        },
    };
}();

// Initialization
jQuery(document).ready(function() {
    //Summernote.init('.summernote');
});
