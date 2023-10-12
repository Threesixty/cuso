// Class definition

var Autosize = function () {

    // Private functions
    var autosizeTextarea = function () {

        var textarea = $('.textarea-autosize');

        autosize(textarea);
        autosize.update(textarea);
    }

    return {
        // public functions
        init: function() {
            autosizeTextarea();
        }
    };
}();

jQuery(document).ready(function() {
    Autosize.init();
});
