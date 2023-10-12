"use strict";

var KTCardDraggable = function() {

    return {
        //main function to initiate the module
        init: function() {
            var containers = document.querySelectorAll('.draggable-zone');

            if (containers.length === 0) {
                return false;
            }

            var swappable = new Sortable.default(containers, {
                draggable: '.draggable',
                handle: '.draggable .draggable-handle',
                mirror: {
                    //appendTo: selector,
                    appendTo: 'body',
                    constrainDimensions: true
                }
            });

            swappable.on('drag:stop', function(e) {
                var sourceContainer = e.data.sourceContainer;
                var source = e.data.source;
                var originalSource = e.data.originalSource;
                var destZone = source.closest('.draggable-zone');

                // Duplicate source
                if (!$(destZone).hasClass('medias-evenodd') && $(destZone).closest('.content-media').length != $(sourceContainer).closest('.content-media').length) {
                    $(source).clone().prependTo('.medias-evenodd').removeClass('draggable-source--is-dragging');
                }

                $('[data-toggle="tooltip"]').tooltip({
                    trigger: 'hover',
                    template: '<div class="tooltip tooltip-dark" role="tooltip">\
                            <div class="arrow"></div>\
                            <div class="tooltip-inner"></div>\
                        </div>',
                });

                if ($(destZone).closest('.content-media').length && sourceContainer != destZone) {

                    var draggableMax = parseInt($(destZone).data('draggable-max'));
                    // Add new to hidden input
                    var hiddenInput = $(destZone).prev();
                    var inputValArr = JSON.parse(hiddenInput.val())
                    inputValArr.push($(source).data('id'));
                    hiddenInput.val(JSON.stringify(inputValArr));

                    // Get child nodes
                    var destZoneChildren = Array.from(destZone.children);

                    // Get & hide msg if not empty
                    var msg = destZoneChildren.splice(0, 1);
                    if (destZoneChildren.length > 0) {
                        $(msg).hide();
                    }

                    if (destZoneChildren.length > draggableMax) {
                        // Extract source
                        var newChildren = destZoneChildren.splice(destZoneChildren.indexOf(source), 1);
                        for (var i=0; i < destZoneChildren.length; i++) {
                            if (i >= destZoneChildren.length - 1) {

                                // Remove removed id from hidden input
                                var inputValArr = JSON.parse(hiddenInput.val())
                                inputValArr.splice(inputValArr.indexOf($(destZoneChildren[i]).data('id')), 1);
                                hiddenInput.val(JSON.stringify(inputValArr));

                                destZoneChildren[i].remove();
                            }
                        } 
                    }

                    // Wainting for draggable lib end
                    setTimeout(function() {

                        var imgIdArr = [];
                        $(destZone).children().each(function() {
                            if ($(this).hasClass('draggable'))
                                imgIdArr.push(parseInt($(this).attr('data-id')));
                        });

                        hiddenInput.val(JSON.stringify(imgIdArr));

                    }, 1000);
                }

                if ($(sourceContainer).closest('.content-media').length && sourceContainer != destZone) {
                    var hiddenInput = $(sourceContainer).prev();

                    // Remove removed id hidden input
                    var inputValArr = JSON.parse(hiddenInput.val())
                    inputValArr.splice(inputValArr.indexOf($(source).data('id')), 1);
                    hiddenInput.val(JSON.stringify(inputValArr));

                    var sourceContainerChildren = Array.from($(sourceContainer).children());

                    // Extract source
                    sourceContainerChildren.splice(sourceContainerChildren.indexOf(source), 1);
                    // Get & show msg if empty
                    var msg = sourceContainerChildren.splice(0, 1);
                    if (sourceContainerChildren.length == 0) {
                        $(msg).show();
                    }

                    if ($(destZone).hasClass('medias-evenodd'))
                        $(originalSource).addClass('d-none');
                } else if ($(sourceContainer).closest('.content-media').length && sourceContainer == destZone) {

                    // Wainting for draggable lib end
                    setTimeout(function() {

                        var sourceContainerChildren = Array.from(sourceContainer.children);

                        var imgIdArr = [];
                        $(sourceContainer).children().each(function() {
                            if ($(this).hasClass('draggable'))
                                imgIdArr.push(parseInt($(this).attr('data-id')));
                        });

                        var hiddenInput = $(sourceContainer).prev();
                        hiddenInput.val(JSON.stringify(imgIdArr));
                        console.log($(source));

                    }, 200);
                }

            });

            $(document).on('click', '.remove-media', function() {

                var dragZone = $(this).closest('.content-media .draggable-zone');

                var hiddenInput = dragZone.prev();
                if (hiddenInput.length > 0) {
                    var inputValArr = JSON.parse(hiddenInput.val())
                    inputValArr.splice(inputValArr.indexOf($(this).data('media-id')), 1);
                    hiddenInput.val(JSON.stringify(inputValArr));

                    $(this).closest('.draggable').remove();

                    // Get & show msg if empty
                    if (dragZone.children().length == 1) {
                        dragZone.children().first().show();
                    }

                    $('.tooltip').remove();
                }

            });

            return swappable;

        },

        destroy: function() {
            swappable.destroy();
        }
    };
}();

let swappable;
jQuery(document).ready(function() {
    swappable = KTCardDraggable.init();
});
