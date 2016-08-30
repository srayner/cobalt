function updateSelects(data)
{
    $("select[name='office']").find('option').remove();
    data['offices'].forEach(function(item, index){
       $("select[name='office']").append('<option value="' + item.id + '">' + item.name + '</option>');
    });
}

$(document).ready(function() {
  
    var input = $("input[name='username']");
    var len = input.val().length;
    input[0].focus();
    input[0].setSelectionRange(len, len);

    $("select[name='company'").change(function(e) {
        var companyId = this.options[e.target.selectedIndex].value;
        $.ajax({
            url: '/company/offices/' + companyId,
            success: updateSelects,
            dataType: 'json'
        });
    });

    $('form').areYouSure();
    
});


