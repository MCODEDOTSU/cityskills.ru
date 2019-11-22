(function() {
    tinymce.PluginManager.add( 'swpbtn', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('swpbtn', {
            title: 'Цветная цитата',
            cmd: 'swpbtn',
            icon: 'blockquote',
            classes: 'primary',
        });
        editor.addCommand('swpbtn', function() {
            let selected = editor.selection.getContent({
                'format': 'html'
            });
            editor.execCommand('mceReplaceContent', false, `<blockquote class="color">${selected}</blockquote>`);
            return;
        });
    });
})();