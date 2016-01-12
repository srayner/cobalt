/*
 * Monel JS
 * 
 * A lightweight Javascript framework for web applications
*/

$(document).ready(function() {
    
    // We want dropdown menus to hide when we click away.
    $(document.body).on('click', function() {
        $('.dropdown-menu').addClass('hidden');
    });

    // Side navigation
    $('.nav-side li a').click(function(){
        var nav = $(this).parent().parent();
        $(nav).find('li').removeClass('selected');
        $(this).parent().addClass('selected');    
    });
    
    // Downdowns
    $('.dropdown-toggle').click(function(){
        var dropDown = $(this).find('.dropdown-menu');
        var hidden = $(dropDown).hasClass('hidden');
        $('.dropdown-menu').addClass('hidden');
        if (hidden) {
            $(dropDown).removeClass('hidden');
        }
        
        event.stopPropagation();
    });
});