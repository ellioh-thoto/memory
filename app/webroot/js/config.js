/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.skin = 'office2013';
//    config.contentsCss = '* {overflow:hidden;}';
//    config.toolbar = 'MyToolbar';
    config.removePlugins = 'elementspath';
    config.resize_enabled = false;

    // Toolbar configuration generated automatically by the editor based on config.toolbarGroups.
    config.toolbar = [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Save', 'Print', '-' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: ['Replace', '-', 'SelectAll' ] },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',  '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'links', items: [ 'Link', 'Unlink'] },
        { name: 'insert', items: [ 'Image',  'Table', 'HorizontalRule', 'Smiley'] },

        '/',
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },

    ];


};

(function($) {
    jQuery.fn.cke_resize = function() {
        return this.each(function() {
            var $this = $(this);
            var rows = $this.attr('rows');
            var height = rows *10;
            $this.next("div.cke").find(".cke_contents").css("height", height);
        });
    };
})(jQuery);

CKEDITOR.on( 'instanceReady', function(){
    $("textarea.ckeditor").cke_resize();
});

