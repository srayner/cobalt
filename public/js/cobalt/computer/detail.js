$(document).ready(function() {

    $.get("/computer/ping/4", function(data, status){
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