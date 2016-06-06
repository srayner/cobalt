
$(document).ready(function() {

    var textArea = $("textarea[name='template']");

    $("#sel1").change(function(){
        fieldName = $(this).val()[0];
        
        var cursorPos = textArea.prop('selectionStart');
        var v = $(textArea).val();
        
        var textBefore = v.substring(0,  cursorPos);
        var textAfter  = v.substring(cursorPos, v.length);
        $(textArea).val(textBefore + fieldName + textAfter);
        
        cursorPos = cursorPos + fieldName.length;
        
        $(textArea).prop('selectionStart', cursorPos);
        $(textArea).prop('selectionEnd', cursorPos);
        $(textArea).focus();
    });

} );

