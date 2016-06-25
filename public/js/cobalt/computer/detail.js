$(document).ready(function() {

    var urlParts = window.location.pathname.split('/');
    var id = urlParts[urlParts.length -1];
    
    $.get("/computer/ping/" + id, function(data, status){
        //alert("result: " + data.status);
        data.class='label label-default';
        data.text = 'Offline';
        if (data.status === 'alive') {
            data.text = 'Online';
            data.class = 'label label-success';
        }
        $('#status').text(data.text)
                    .addClass(data.class);
    });
    
});