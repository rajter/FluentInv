$(document).ready(function() {

    $('#employee_table').DataTable();
    $('#items_table').DataTable({
        "pageLength": 50
    });
    $('#add_items_table').DataTable();
    $('#stocks_table').DataTable({
        "pageLength": 25
    });

    $('#entrance_table').DataTable({
        "pageLength": 25
    });



    // var receiptsTable = $('#receipts_table').DataTable();
    // receiptsTable     // Sortira tablicu po prvoj vidljivoj koloni
    //     .column( '0:visible' )
    //     .order( 'desc' )
    //     .draw();

    // var issuesTable = $('#issues_table').DataTable();
    // issuesTable     // Sortira tablicu po prvoj vidljivoj koloni
    //   .column( '0:visible' )
    //   .order( 'desc' )
    //   .draw();
});
