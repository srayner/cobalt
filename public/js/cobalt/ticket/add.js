$(document).ready(function() {
    $('input[name="subject"]').focus();
    $('form').areYouSure();
    
    $('input[name="requestor"]').keyup(function(){
        var txt = this.value;
        var requestors = $('#requestors');
        requestors.html('');
        $.ajax('/user/find/' + txt).done(function(data) {
            data.users.forEach(function(item, index){
                console.log(item.displayName);
                
                var h5 = document.createElement("h5");
                h5.innerHTML = item.displayName;
                requestors.append(h5);
                var p = document.createElement("p");
                p.innerHTML = item.department;
                requestors.append(p);
            });
        });
    });
    
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