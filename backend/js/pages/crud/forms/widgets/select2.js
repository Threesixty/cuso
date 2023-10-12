// Class definition
var Select2 = function() {
    // Private functions
    var init = function() {
        // basic
        $('.select2').select2({
            placeholder: 'Selectionner un élément',
            allowClear: true
        });
        $('.select2-tags').select2({
            placeholder: 'Selectionner un élément',
            tags: true
        });

        var colorsHtml = [];
        $('.select2-color option').each(function() {
            var html = $(this).val() == '' ? '<span class="select2-selection__placeholder">Selectionner un élément</span>' : '<div class="d-flex flex-center w-90px h-50px mr-5" style="background-color: ' + $(this).val() + '"></div>';
            colorsHtml.push({
              id: $(this).val(),
              html: html,
            })
        });

        $('.select2-color').select2({
            placeholder: 'Selectionner un élément',
            tags: true,
            data: colorsHtml,
            escapeMarkup: function(markup) {
                return markup;
            },
            templateResult: function(colorsHtml) {
                return colorsHtml.html;
            },
            templateSelection: function(colorsHtml) {
                return colorsHtml.html;
            },
            createTag: function (params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: '<div class="d-flex flex-center w-100px h-50px mr-5" style="background-color: ' + term + '"></div>',
                    html: '<div class="d-flex flex-center w-100px h-50px mr-5" style="background-color: ' + term + '"></div>',
                    newTag: true // add additional parameters
                }
            }
        });
    }

    // Public functions
    return {
        init: function() {
            init();
        }
    };
}();

// Initialization
jQuery(document).ready(function() {
    Select2.init();
});
