$(document).ready(function() {
    $('.nav-tabs #r').on('shown.bs.tab', function(){
        resizeCanvas();
    });
    
    $('#tabs').stickyTabs();
} );

