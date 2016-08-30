function updateOfficeSelect(data)
{
    $("select[name='office']").find('option').remove();
    $("select[name='office']").append('<option value>None</option>');
    data['offices'].forEach(function(item, index){
       $("select[name='office']").append('<option value="' + item.id + '">' + item.name + '</option>');
    });
}

function updateDepartmentSelect(data)
{
    $("select[name='department']").find('option').remove();
    $("select[name='department']").append('<option value>None</option>');
    data['departments'].forEach(function(item, index){
       $("select[name='department']").append('<option value="' + item.id + '">' + item.name + '</option>');
    });
}

function updateSelects(companyId)
{
    if (companyId === '') {
        $("select[name='office']").find('option').remove();
        $("select[name='office']").append('<option value>None</option>');
        $("select[name='department']").find('option').remove();
        $("select[name='department']").append('<option value>None</option>');
    } else {
    
        $.ajax({
            url: '/company/offices/' + companyId,
            success: updateOfficeSelect,
            dataType: 'json'
        });
        $.ajax({
            url: '/company/departments/' + companyId,
            success: updateDepartmentSelect,
            dataType: 'json'
        });
    }
}

$(document).ready(function() {
  
    var companyId = $("select[name='company'] option:selected").val();
    updateSelects(companyId);

    $("select[name='company'").change(function(e) {
        var companyId = this.options[e.target.selectedIndex].value;
        updateSelects(companyId);
    });
    

    $('form').areYouSure();
    
});


