$(document).ready(function() {
    tinymce.init({
        selector:'textarea',
        plugins: 'textcolor',
        content_css : "/css/editor_content.css",
        statusbar: false,
        menubar: false,
        toolbar: 'undo redo | styleselect | bold italic | alignleft | alignright | aligncenter alignjustify | bullist numlist | forecolor'
    });
} );