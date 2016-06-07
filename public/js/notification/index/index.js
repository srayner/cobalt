$(document).ready(function() {

    $('input[type=checkbox]').change(function() {

        var id = $(this).val();
        var check = $(this).prop('checked');
        console.log(check);
        var url = 'enable/' + id;
        data = {
            'id': id,
            'active' : check
        };
        $.post(url, data);
    });
} );