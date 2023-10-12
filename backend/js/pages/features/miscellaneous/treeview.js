"use strict";

var KTTreeview = function () {

    var treeVariation = function() {

        var treeObj = JSON.parse($('.tree-variation').prev().val());
        $(".tree-variation").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                },
                "check_callback" : function(operation, node, parent, position, more) {
                    if (operation == 'move_node') {
                        if (parent.id != '#') {
                            return true
                        } else {
                            return false;
                        }
                    }
                },
                'data': [
                    {
                        "text": treeObj[0] != undefined ? JSON.parse($('.tree-variation').prev().val())[0].text : 'Option',
                        "state": {
                            "opened": true
                        },
                        "children": treeObj[0] != undefined ? JSON.parse($('.tree-variation').prev().val())[0].children : [],
                    }
                ]
            },
            "plugins" : ["dnd", "contextmenu", "types", "languages"],
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder text-primary"
                },
            },
            "languages" : ["fr"],
            "contextmenu": {
                "items": function($node) {
                    if ($node.parent != '#') {
                        return {
                            "create" : {
                                "separator_before"  : false,
                                "icon"              : false,
                                "separator_after"   : false,
                                "label"             : "Créer",
                                "icon"              : "glyphicon glyphicon-leaf",
                                "action"            : function (data) {
                                    var inst = $.jstree.reference(data.reference),
                                        obj = inst.get_node(data.reference);
                                    inst.create_node(obj, {}, "last", function (new_node) {
                                        try {
                                            inst.edit(new_node);
                                        } catch (ex) {
                                            setTimeout(function () { inst.edit(new_node); },0);
                                        }
                                    });
                                }
                            },
                            "rename" : {
                                "separator_before"  : false,
                                "icon"              : false,
                                "separator_after"   : false,
                                "_disabled"         : false,
                                "label"             : "Renommer",
                                "icon"              : "glyphicon glyphicon-leaf",
                                "action"            : function (data) {
                                    var inst = $.jstree.reference(data.reference),
                                        obj = inst.get_node(data.reference);
                                    inst.edit(obj);
                                }
                            },
                            "remove" : {
                                "separator_before"  : false,
                                "icon"              : false,
                                "separator_after"   : false,
                                "_disabled"         : false,
                                "label"             : "Supprimer",
                                "action"            : function (data) {
                                    var inst = $.jstree.reference(data.reference),
                                        obj = inst.get_node(data.reference);
                                    if(inst.is_selected(obj)) {
                                        inst.delete_node(inst.get_selected());
                                    }
                                    else {
                                        inst.delete_node(obj);
                                    }
                                }
                            },
                            "ccp" : {
                                "separator_before"  : true,
                                "icon"              : false,
                                "separator_after"   : false,
                                "label"             : "Éditer",
                                "action"            : false,
                                "submenu" : {
                                    "cut" : {
                                        "separator_before"  : false,
                                        "icon"              : false,
                                        "separator_after"   : false,
                                        "label"             : "Couper",
                                        "action"            : function (data) {
                                            var inst = $.jstree.reference(data.reference),
                                                obj = inst.get_node(data.reference);
                                            if(inst.is_selected(obj)) {
                                                inst.cut(inst.get_top_selected());
                                            }
                                            else {
                                                inst.cut(obj);
                                            }
                                        }
                                    },
                                    "copy" : {
                                        "separator_before"  : false,
                                        "icon"              : false,
                                        "separator_after"   : false,
                                        "label"             : "Copier",
                                        "action"            : function (data) {
                                            var inst = $.jstree.reference(data.reference),
                                                obj = inst.get_node(data.reference);
                                            if(inst.is_selected(obj)) {
                                                inst.copy(inst.get_top_selected());
                                            }
                                            else {
                                                inst.copy(obj);
                                            }
                                        }
                                    },
                                    "paste" : {
                                        "separator_before"  : false,
                                        "icon"              : false,
                                        "_disabled"         : function (data) {
                                            return !$.jstree.reference(data.reference).can_paste();
                                        },
                                        "separator_after"   : false,
                                        "label"             : "Coller",
                                        "action"            : function (data) {
                                            var inst = $.jstree.reference(data.reference),
                                                obj = inst.get_node(data.reference);
                                            inst.paste(obj);
                                        }
                                    }
                                }
                            },
                            "attributes" : {
                                "separator_before"  : true,
                                "icon"              : false,
                                "separator_after"   : false,
                                "label"             : "Attributs",
                                "action"            : false,
                                "submenu" : {
                                    "add" : {
                                        "separator_before"  : false,
                                        "icon"              : false,
                                        "separator_after"   : false,
                                        "label"             : "Ajouter",
                                        "action"            : function (data) {
                                            var obj = data.reference.prevObject[0];
                                            $('.variation-container > .variation-item').not('.d-none').hide();
                                            if ($('.variation-' + obj.id).length) {
                                                $('.variation-' + obj.id).show();
                                            } else {
                                                $('.variation-container .d-none').clone().appendTo('.variation-container').removeClass('d-none').addClass('variation-' + obj.id).attr('data-id', obj.id).attr('data-name', obj.innerText).find('h3 > span').html(obj.innerText);

                                                KTCardDraggable.destroy();
                                                swappable = KTCardDraggable.init();
                                            }
                                        }
                                    },
                                    "delete" : {
                                        "separator_before"  : false,
                                        "icon"              : false,
                                        "_disabled"         : function (data) {
                                            return !$('.variation-' + data.reference.prevObject[0].id).length;
                                        },
                                        "separator_after"   : false,
                                        "label"             : "Supprimer",
                                        "action"            : function (data) {

                                            var obj = data.reference.prevObject[0];
                                            if ($('.variation-' + obj.id).length) {
                                                $('.variation-' + obj.id).remove();

                                                var jsonContent = JSON.parse($('input[name="variations_content').val());
                                                for (var idx=0; idx < jsonContent.length; idx++) {

                                                    let key;
                                                    for (key in jsonContent[idx]) {
                                                        if (key == 'id' && jsonContent[idx][key] == obj.id) {
                                                            delete jsonContent[idx];
                                                        }
                                                    }
                                                }
                                                jsonContent = jsonContent.filter(function(data) { return data !== null }); 

                                                $('input[name="variations_content').val(JSON.stringify(jsonContent));
                                                $('#code2').html(JSON.stringify(jsonContent, undefined, 4));

                                            }
                                        }
                                    },
                                }
                            },
                        };
                    } else {
                        return {
                            "create" : {
                                "separator_before"  : false,
                                "separator_after"   : true,
                                "label"             : "Créer",
                                "action"            : function (data) {
                                    var inst = $.jstree.reference(data.reference),
                                        obj = inst.get_node(data.reference);
                                    inst.create_node(obj, {}, "last", function (new_node) {
                                        try {
                                            inst.edit(new_node);
                                        } catch (ex) {
                                            setTimeout(function () { inst.edit(new_node); },0);
                                        }
                                    });
                                }
                            },
                            "ccp" : {
                                "separator_before"  : true,
                                "icon"              : false,
                                "separator_after"   : false,
                                "label"             : "Éditer",
                                "action"            : false,
                                "submenu" : {
                                    "paste" : {
                                        "separator_before"  : false,
                                        "icon"              : false,
                                        "_disabled"         : function (data) {
                                            return !$.jstree.reference(data.reference).can_paste();
                                        },
                                        "separator_after"   : false,
                                        "label"             : "Coller",
                                        "action"            : function (data) {
                                            var inst = $.jstree.reference(data.reference),
                                                obj = inst.get_node(data.reference);
                                            inst.paste(obj);
                                        }
                                    }
                                }
                            }
                        };
                    }
                }
            }
        });


        $('.tree-variation').on('select_node.jstree', function(e, data) {
            console.log('select_node');
            var jsonData = data.instance.get_json()[0];

            jsonData = stripJSON(jsonData);
            $('#code').html(JSON.stringify([jsonData], undefined, 4));

            $('.variation-container > .variation-item').not('.d-none').hide();
            if ($('.variation-' + data.selected[0]).length) {
                $('.variation-' + data.selected[0]).show();
            }
        });
        $('.tree-variation').on('create_node.jstree rename_node.jstree delete_node.jstree move_node.jstree copy_node.jstree cut.jstree copy.jstree paste.jstree redraw.jstree', function(e, data) {
            console.log(e.type);
            switch (e.type) {
                case 'create_node':
                    $('.variation-container > .variation-item').not('.d-none').hide();
                    data.node.text = 'Nom du noeud';
                    break;
                case 'delete_node':
                    $('.variation-container > .variation-item').not('.d-none').hide();

                    // Remove variation attributes
                    if ($('.variation-' + data.node.id).length) {
                        $('.variation-' + data.node.id).remove();

                        var jsonContent = JSON.parse($('.variation-container > input').val());

                        for (var idx=0; idx < jsonContent.length; idx++) {

                            let key;
                            for (key in jsonContent[idx]) {
                                if (key == 'id' && jsonContent[idx][key] == data.node.id) {
                                    delete jsonContent[idx];
                                }
                            }
                        }
                        jsonContent = jsonContent.filter(function(data) { return data !== null }); 

                        $('.variation-container > input').val(JSON.stringify(jsonContent));
                        $('#code2').html(JSON.stringify(jsonContent, undefined, 4));

                    }
                    break;
                case 'rename_node':
                    if ($('.variation-' + data.node.id).length)
                        $('.variation-' + data.node.id).find('h3 > span').html(data.text)
                    break;

                default:
                    break;
            }

            var jsonData = data.instance.get_json()[0];

            jsonData = stripJSON(jsonData);
            $('.tree-variation').prev().val(JSON.stringify([jsonData]));
            $('#code').html(JSON.stringify([jsonData], undefined, 4));
        });

        function stripJSON(jsonData) {

            let keys = ['icon', 'li_attr', 'a_attr', 'data', 'type', 'loaded', 'selected', 'disabled'], key;
            for (key in jsonData) {
                let inside = keys.indexOf(key);
                if (inside !== -1) {
                    delete jsonData[key];
                } else {
                    if (typeof jsonData[key] === 'object')
                        stripJSON(jsonData[key]);
                    if (key == 'opened')
                        jsonData[key] = true;
                }
            }
            return jsonData;
        }

        $(document).on('click', '.save-variation-content', function() {

            KTApp.block('.blockui_card', {
                overlayColor: '#000000',
                state: 'primary',
                message: 'Enregistrement...'
            });

            var variationId = $(this).closest('.variation-item').attr('data-id');

            var jsonContent = JSON.parse($('.variation-container > input').val());
            jsonContent = addContentJSON(jsonContent, variationId, $(this).closest('.variation-item'));

            $('.variation-container > input').val(JSON.stringify(jsonContent));
            $('#code2').html(JSON.stringify(jsonContent, undefined, 4));

            setTimeout(function() {
                KTApp.block('.blockui_card', {
                    overlayColor: '#000000',
                    state: 'dnone',
                    message: 'Ok !'
                });
                setTimeout(function() {
                    KTApp.unblock('.blockui_card');
                }, 1000);
            }, 1000);

        });

        function addContentJSON(jsonContent, variationId, variationItem) {
            var inputContents = [];
            variationItem.find('input').each(function() {
                    inputContents.push({
                            slug: $(this).attr('name'), 
                            value: $(this).val(),
                        });
                });

            let found = false;
            for (var idx=0; idx < jsonContent.length; idx++) {

                let key;
                for (key in jsonContent[idx]) {
                    if (key == 'id' && jsonContent[idx][key] == variationId) {
                        jsonContent[idx]['content'] = inputContents;
                        found = true;
                    }
                }
            }

            if (!found) {
                var content = {
                        id: variationId, 
                        name: variationItem.attr('data-name'), 
                        content: inputContents
                    };
                jsonContent.push(content);
            }

            return jsonContent;
        }
    }

    var treeContent = function() {

        $(".tree-content").each(function() {

            $(this).jstree({
                "core" : {
                    "themes" : {
                        "responsive": false
                    },
                    "check_callback" : function(operation, node, parent, position, more) {
                        if (more !== undefined && more.ref != undefined) {
                            if (operation == 'move_node') {
                                if (parent.id != '#' && more.ref.type != 'file' && more.ref.parent != '#' && more.pos == 'i' && (node.type == 'file' || node.parent != 'j1_1')) {
                                    return true
                                } else {
                                    return false;
                                }
                            }
                        }
                    },
                    'data': [
                        {
                            "text": $(this).attr('data-name'),
                            "state": {
                                "opened": true
                            },
                            "children": JSON.parse($(this).attr('data-children')),
                        }
                    ]
                },
                "plugins" : ["dnd", "contextmenu", "types", "languages"],
                "types" : {
                    "default" : {
                        "icon" : "fa fa-folder text-success"
                    },
                    "file" : {
                        "icon" : "fa fa-file text-light-success"
                    },
                },
                "languages" : ["fr"],
                "contextmenu": {
                    "items": function($node) {
                        if ($node.parent != '#' && $node.parent != 'j1_1' && $node.type != 'file') {
                            return {
                                "create" : {
                                    "separator_before"  : false,
                                    "icon"              : false,
                                    "separator_after"   : false,
                                    "label"             : "Créer",
                                    "icon"              : "glyphicon glyphicon-leaf",
                                    "action"            : function (data) {
                                        var inst = $.jstree.reference(data.reference),
                                            obj = inst.get_node(data.reference);
                                        inst.create_node(obj, {}, "last", function (new_node) {
                                            try {
                                                inst.edit(new_node);
                                            } catch (ex) {
                                                setTimeout(function () { inst.edit(new_node); },0);
                                            }
                                        });
                                    }
                                },
                                "rename" : {
                                    "separator_before"  : false,
                                    "icon"              : false,
                                    "separator_after"   : false,
                                    "_disabled"         : false,
                                    "label"             : "Renommer",
                                    "icon"              : "glyphicon glyphicon-leaf",
                                    "action"            : function (data) {
                                        var inst = $.jstree.reference(data.reference),
                                            obj = inst.get_node(data.reference);
                                        inst.edit(obj);
                                    }
                                },
                                "remove" : {
                                    "separator_before"  : false,
                                    "icon"              : false,
                                    "separator_after"   : false,
                                    "_disabled"         : false,
                                    "label"             : "Supprimer",
                                    "action"            : function (data) {
                                        var inst = $.jstree.reference(data.reference),
                                            obj = inst.get_node(data.reference);
                                        if(inst.is_selected(obj)) {
                                            inst.delete_node(inst.get_selected());
                                        }
                                        else {
                                            inst.delete_node(obj);
                                        }
                                    }
                                },
                                "ccp" : {
                                    "separator_before"  : true,
                                    "icon"              : false,
                                    "separator_after"   : false,
                                    "label"             : "Éditer",
                                    "action"            : false,
                                    "submenu" : {
                                        "cut" : {
                                            "separator_before"  : false,
                                            "icon"              : false,
                                            "separator_after"   : false,
                                            "label"             : "Couper",
                                            "action"            : function (data) {
                                                var inst = $.jstree.reference(data.reference),
                                                    obj = inst.get_node(data.reference);
                                                if(inst.is_selected(obj)) {
                                                    inst.cut(inst.get_top_selected());
                                                }
                                                else {
                                                    inst.cut(obj);
                                                }
                                            }
                                        },
                                        "copy" : {
                                            "separator_before"  : false,
                                            "icon"              : false,
                                            "separator_after"   : false,
                                            "label"             : "Copier",
                                            "action"            : function (data) {
                                                var inst = $.jstree.reference(data.reference),
                                                    obj = inst.get_node(data.reference);
                                                if(inst.is_selected(obj)) {
                                                    inst.copy(inst.get_top_selected());
                                                }
                                                else {
                                                    inst.copy(obj);
                                                }
                                            }
                                        },
                                        "paste" : {
                                            "separator_before"  : false,
                                            "icon"              : false,
                                            "_disabled"         : function (data) {
                                                return !$.jstree.reference(data.reference).can_paste();
                                            },
                                            "separator_after"   : false,
                                            "label"             : "Coller",
                                            "action"            : function (data) {
                                                var inst = $.jstree.reference(data.reference),
                                                    obj = inst.get_node(data.reference);
                                                inst.paste(obj);
                                            }
                                        }
                                    }
                                },
                            };
                        } else if ($node.parent == 'j1_1' && $node.type != 'file') {
                            return {
                                "create" : {
                                    "separator_before"  : false,
                                    "separator_after"   : true,
                                    "label"             : "Créer",
                                    "action"            : function (data) {
                                        var inst = $.jstree.reference(data.reference),
                                            obj = inst.get_node(data.reference);
                                        inst.create_node(obj, {}, "last", function (new_node) {
                                            try {
                                                inst.edit(new_node);
                                            } catch (ex) {
                                                setTimeout(function () { inst.edit(new_node); },0);
                                            }
                                        });
                                    }
                                },
                                "ccp" : {
                                    "separator_before"  : true,
                                    "icon"              : false,
                                    "separator_after"   : false,
                                    "label"             : "Éditer",
                                    "action"            : false,
                                    "submenu" : {
                                        "paste" : {
                                            "separator_before"  : false,
                                            "icon"              : false,
                                            "_disabled"         : function (data) {
                                                return !$.jstree.reference(data.reference).can_paste();
                                            },
                                            "separator_after"   : false,
                                            "label"             : "Coller",
                                            "action"            : function (data) {
                                                var inst = $.jstree.reference(data.reference),
                                                    obj = inst.get_node(data.reference);
                                                inst.paste(obj);
                                            }
                                        }
                                    }
                                }
                            };
                        } else if ($node.type == 'file') {
                            return {
                                "rename" : {
                                    "separator_before"  : false,
                                    "icon"              : false,
                                    "separator_after"   : false,
                                    "_disabled"         : false,
                                    "label"             : "Renommer",
                                    "icon"              : "glyphicon glyphicon-leaf",
                                    "action"            : function (data) {
                                        var inst = $.jstree.reference(data.reference),
                                            obj = inst.get_node(data.reference);
                                        inst.edit(obj);
                                    }
                                },
                                "remove" : {
                                    "separator_before"  : false,
                                    "icon"              : false,
                                    "separator_after"   : false,
                                    "_disabled"         : false,
                                    "label"             : "Supprimer",
                                    "action"            : function (data) {
                                        var inst = $.jstree.reference(data.reference),
                                            obj = inst.get_node(data.reference);
                                        if(inst.is_selected(obj)) {
                                            inst.delete_node(inst.get_selected());
                                        }
                                        else {
                                            inst.delete_node(obj);
                                        }
                                    }
                                },
                            };
                        }
                    }
                }
            });
        });

        $('.tree-content').on('create_node.jstree rename_node.jstree delete_node.jstree move_node.jstree copy_node.jstree cut.jstree copy.jstree paste.jstree redraw.jstree', function(e, data) {
            console.log(e.type);
            switch (e.type) {
                case 'create_node':
                    break;

                default:
                    break;
            }

            var jsonData = data.instance.get_json()[0];

            jsonData = stripJSON(jsonData);
            $('.tree-content').prev().val(JSON.stringify([jsonData]));
            $('#code').html(JSON.stringify([jsonData], undefined, 4));
        });

        function stripJSON(jsonData) {

            let keys = ['icon', 'li_attr', 'a_attr', 'loaded', 'selected', 'disabled'], key;
            for (key in jsonData) {
                let inside = keys.indexOf(key);
                if (inside !== -1) {
                    delete jsonData[key];
                } else {
                    if (typeof jsonData[key] === 'object')
                        stripJSON(jsonData[key]);
                    if (key == 'opened')
                        jsonData[key] = true;
                }
            }
            return jsonData;
        }

        $('.add-to-menu').on('click', function() {

            var obj = {
                    'text': $(this).closest('tr').find('.h6 strong').text(),
                    'type': 'file',
                    "data": {
                        'id': $(this).closest('tr').find('td:first-child').text(),
                    }
                };

            $("#tmpTree").jstree('create_node', '#j1_1', obj, 'first', function (node) {

                console.log('callback');

            });

        });

    }

    return {
        //main function to initiate the module
        init: function () {
            treeVariation();
            treeContent();
        }
    };
}();

jQuery(document).ready(function() {
    KTTreeview.init();
});
