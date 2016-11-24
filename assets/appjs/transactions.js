$(document).ready(function() {
  //alert('hello');

  var dt = $('#transactions_table').DataTable();
  var infoBox = $('#infoBox');

  $('#receipts_table').on('click', 'td, tr', function()
  {
      var cell = dt.cell( this );
      var row = dt.row( this );

      if(cell.data()[0] != '<') //gledamo ako polje ne sadrzi html kod gdje se nalaze gumbi
      {
          //alert(cell.data());
          //Radimo AJAX prema kontroleru sa poljem ID-eva označenih artikala
            var BASE_URL = $("#base_url").text();
            var ID = row.data()[1];
            $.ajax({
                type: "GET",
                url: BASE_URL + "index.php/Receipts/getReceiptInfo", //url: "http://localhost:8080/LogTrack/index.php/transactions/getTransactionInfo",
                data: { "transaction_id": ID },
                dataType: "text",
                success:
                    function(result){
                        infoBox.children().remove();          //brisemo sve elemente iz infoboxa
                        var obj = JSON.parse(result);
                        infoBox.append('<p>'+ID+'</p>');
                        for(i = 0; i < obj.length; i++)
                        {
                            var item = obj[i];
                            infoBox.append(
                            '<p>Artikl: ' + item.name + '  -- Tip: ' + item.type + '</p>'
                            );
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(textStatus + errorThrown);
                    }
                });
      }

  });

});
