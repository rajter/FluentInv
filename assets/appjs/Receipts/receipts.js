$(document).ready(function() {

    /*
        TABLICA MODALNOG DIJALOGA ZA ODABIR ARTIKALA
        ---------------------------------------------
        |ID|Ime     |Opis   |Tip    |Kod    |Kol    |
        ---------------------------------------------
    */
    var dt = $('#receipts_table').DataTable(); //Inicijalizacija tablice i spremanje reference u varijablu
    var tbody = $("#info-table-body");

    $('#receipts_table').on('click', 'td, tr', function()
    {
      var cell = dt.cell( this );
      var row = dt.row( this );

      if(cell.data()[0] != '<') //gledamo ako polje ne sadrzi html kod gdje se nalaze gumbi
      {
          //Radimo AJAX prema kontroleru sa poljem ID-eva artikala
            var BASE_URL = $("#base_url").text();
            var TRANS_NUMBER = row.data()[0];
            $.ajax({
                type: "GET",
                url: BASE_URL + "index.php/Receipts/getReceiptInfo",
                data: { "transaction_number": TRANS_NUMBER },
                dataType: "text",
                success:
                    function(result){
                        tbody.children().remove();
                        $("#receipt-number").text("Primka: "+TRANS_NUMBER);
                        var obj = JSON.parse(result);
                        for(i = 0; i < obj.length; i++)
                        {
                            var item = obj[i];
                            tbody.append(
                                '<tr>'+
                                "<td>"+(i+1)+"</td>"+
                                "<td>"+item.name+"</td>"+
                                "<td>"+item.code+"</td>"+
                                "<td class=\"text-center\">"+item.quantity+"</td>"+
                                '</tr>'
                            );
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(textStatus + errorThrown);
                    }
                });
      }

    });

    items = new Map();

    $(".item_quantity").bind("click keyup", function(){
        var item_id = $(this).attr('id');
        var quantity = $(this).val();

        if(quantity>0){
            items.set(item_id, quantity);
        }
        else {
            items.delete(item_id);
        }

    });

    /*
    *   Dodavanje artikala
    */
    $("#modal_add_item").one("show.bs.modal", function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data("id");
        var modal = $(this);

        $("#dodaj_btn").click(function(){
            var str = "";
            if(items.size > 0)
            {
                $('#selected_items_table_body > tr').remove();  //brišemo sve tr elemente iz tablice jer bi se ponovnim dodavanje duplirali
                $('#hidden_id > input').remove();               //brišemo sve hidden input elemente jer bi se ponovnim dodavanje duplirali

                var item_array = [];
                items.forEach(function(value, key){
                    item_array.push(key);
                });
                item_array.sort();

                var BASE_URL = $("#base_url").text();

                var _form = $("#ajaxform").serializeArray();
                var obj = {name:"items", value:item_array};
                _form.push(obj);

                $.ajax({
                  type: "POST",
                  url: BASE_URL + "index.php/Receipts/addItem",
                  data: _form,
                  dataType: "text",
                  success:
                    function(result){
                        //alert(result);
                         var obj = JSON.parse(result);                   //parsira text u polje objekata
                         for(i = 0; i < obj.length; i++)
                         {
                             var item = obj[i];
                             $('#selected_items_table_body').append('<tr><td>'+ item.id +'</td>' +
                                 '<td>'+ item.name +'</td>' +
                                 '<td>'+ item.description +'</td>' +
                                 '<td>'+ item.type +'</td>' +
                                 '<td>'+ item.code +'</td>' +
                                 '<td>' + items.get(item.id) +'</td></tr>');

                             $('#hidden_id').append("<input class='hidden' name='item_id[]' value='" + item.id + "'/>");
                             $('#hidden_id').append("<input class='hidden' name='item_qnt[]' value='" + items.get(item.id) + "'/>");
                         }

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " - " +thrownError);
                    }
                });
            }else{
                $('#selected_items_table_body > tr').remove();  //brišemo sve tr elemente iz tablice jer bi se ponovnim dodavanje duplirali
                $('#hidden_id > input').remove();               //brišemo sve hidden input elemente jer bi se ponovnim dodavanje duplirali
            }

        }); // dodaj btn click event

    }); // modal add item


    var footnoteEditor = $('#footnote');
    if(footnoteEditor.length) // provjeravamo ako element postoji jer se isti .js dokument poziva za razlicite stranice
    {
        $('#footnote').wysihtml5({locale: "hr-HR"});
    }

    /*
    *     Modalni dialog za brisanje primki
    */
    $('.receipt_modal_delete').click(function(){

        var transNumber = $(this).attr('data');
        alertify.confirm(
            'Brisanje primke',
            'Jeste li sigurni da želite obrisati primku ' + transNumber + ' ?',
            function(){

                var BASE_URL = $("#base_url").text();
                var _form = $("#ajaxform").serializeArray();
                var data = {name:"transaction_number", value:transNumber};
                _form.push(data);

                $.ajax({
                  type: "POST",
                  url: BASE_URL + "index.php/Receipts/delete",
                  data: _form,
                  dataType: "text",
                  success:
                    function(result){
                        //alert(result);
                         var obj = JSON.parse(result);

                         $('#receipt-row-'+ transNumber).remove();  // brisemo redak u tablici za obrisanu primku
                         tbody.children().remove();                 // brisemo podatke ako je tablica bila oznacena
                         $("#receipt-number").text("Primka: ");

                         if(result)
                         {
                             alertify.success('Uspješno obrisana primka br: ' + transNumber);
                         }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " - " +thrownError);
                    }
                });

            },
            function(){
                alertify.error('Dogodila se greška!');
            }
        );
    });


    $('#kreiraj_btn').click(function(){
        var footnote = $('#footnote').val();
        $("#hidden-footnote").val(footnote);
    });

});
