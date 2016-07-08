$(document).ready(function() {
    $('#printers').DataTable( {
        stateSave: true
    });
    $('div.dataTables_filter input').focus();
} );