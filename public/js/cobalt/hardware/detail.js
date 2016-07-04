$(document).ready(function() {

    // Sticky tabs
    $('#tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    
    $('#tabs').stickyTabs();
    
    // Monitoring checkboxes
    $('input[type=checkbox]').change(function() {

        var id = $(this).val();
        var check = $(this).prop('checked');
        console.log(check);
        var url = '/network-adapter/monitor/' + id;
        data = {
            'id': id,
            'monitor' : check
        };
        $.post(url, data);
    });

});