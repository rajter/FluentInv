$(document).ready(function() {
    // alert('hello');
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData("#modal_add_item");
    });

    $("#modal_delete").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data("id");
        var userName = button.data("name");
        var surname = button.data("surname");
        var role = button.data("role");
        var modal = $(this);

        $("#id").attr("value", id); //postavlja hidden input field value na id korisnika
        modal.find(".modal-zaposlenik").text(userName + " " + surname + " [" +  role + "]");
        $("#delete_form").attr("action", document.location.href + "/delete/" + id);
    });


    $("#modal_view").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data("id");
        var userName = button.data("name");
        var surname = button.data("surname");
        var role = button.data("role");
        var modal = $(this);

        modal.find(".modal-name").text(userName);
        modal.find(".modal-surname").text(surname);
        modal.find(".modal-role").text(role);
    });

    var items;
    var quantities;

    $(".item_row").click(function(){
      var t = $(this).find("#item_selected").first().children().first().prop("checked");
      var kol =  $(this).find("#item_qnt").first().find(".cQnt").first().val();
    });

  //Add items to new transaction
    $("#modal_add_item").one("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data("id");
    var modal = $(this);


    $("#dodaj_btn").click(function(){
        //Provjeravamo koji artikli su chekirani te stavljamo ID u array
        items = [];
        quantities = [];

        // Radimo AJAX prema kontroleru sa poljem ID-eva označenih artikala
        var BASE_URL = $("#base_url").text();
        $.ajax({
          type: "GET",
          url: BASE_URL + "index.php/transactions/addItem", //url: "http://localhost:8080/LogTrack/index.php/transactions/addItem",
          data: { "items": items },
          dataType: "text",
          success:
            function(result){
                $('#selected_items_table_body > tr').remove();  //brišemo sve tr elemente iz tablice jer bi ponovnim dodavanje duplirali
                $('#hidden_id > input').remove();               //brišemo sve hidden input elemente jer bi ponovnim dodavanje duplirali
                var obj = JSON.parse(result);                   //parsira text u polje objekata
                for(i = 0; i < obj.length; i++)
                {
                    var item = obj[i];
                    var n = $('#quantity');
                    $('#selected_items_table_body').append('<tr><td>'+ item.id +'</td>' +
                        '<td>'+ item.name +'</td>' +
                        '<td>'+ item.description +'</td>' +
                        '<td>'+ item.type +'</td>' +
                        '<td>'+ item.code +'</td>' +
                        '<td>' + quantities[i] +'</td></tr>');

                    $('#hidden_id').append("<input class='hidden' name='item_id[]' value='" + item.id + "'/>");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus + errorThrown);
            }
        });


    }); // dodaj btn click event

    }); // modal add item

}); // on ready function
