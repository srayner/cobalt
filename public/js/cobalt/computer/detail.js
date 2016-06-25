$(document).ready(function() {

    $.get("/computer/ping/4", function(data, status){
        alert("result: " + data.status);
    });
    
});