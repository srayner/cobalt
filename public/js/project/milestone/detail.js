$(document).ready(function() {

    $('#tabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
    
    $('#tabs').stickyTabs();
} );