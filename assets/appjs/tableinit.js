$(document).ready(function() {

  $('#employee_table').DataTable();
  $('#items_table').DataTable({
      "pageLength": 50
  });
  $('#add_items_table').DataTable();
  $('#receipts_table').DataTable();
  $('#stocks_table').DataTable();
});
