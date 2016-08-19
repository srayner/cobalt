$(document).ready(function() {
    $('input[name="subject"]').focus();
    $('form').areYouSure();
    tinymce.init({
        selector:'textarea',
        plugins: 'textcolor',
        content_css : "/css/editor_content.css",
        statusbar: false,
        menubar: false,
        setup: function(editor) {
            editor.on('dirty', function(event) {
            editor.save();
            $('form').trigger('checkform.areYouSure');
            });
        },
        toolbar: 'undo redo | styleselect | bold italic | alignleft | alignright | aligncenter alignjustify | bullist numlist | forecolor'
    });
} );