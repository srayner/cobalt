$(document).ready(function() {
  
    var input = $("input[name='username']");
    var len = input.val().length;
    input[0].focus();
    input[0].setSelectionRange(len, len);

});
