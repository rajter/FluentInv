$(document).ready(function(){

    /*
    *   DELETES THE ITEM
    */
    $("#modal_delete_item").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data("id");
        alert(id);
    });

    /*
    *   DELETES THE ITEM TYPE
    */
    $(".item_type_modal_delete").on("click", function (event) {
        var id = $(this).attr("id").substr(5); // id="type-id" - treba nam samo id
        var name = $(this).data('name');

        alertify.confirm(
            'Brisanje primke',
            'Jeste li sigurni da želite obrisati Tip - <strong>' + name + '</strong> ?',
            function()
            {
                var BASE_URL = $("#base_url").text();
                // alert(BASE_URL);
                //
                var _form = $("#ajaxform").serializeArray();
                var obj = {name:"id", value:id};
                _form.push(obj);

                $.ajax({
                  type: "POST",
                  url: BASE_URL + "index.php/ItemTypes/delete",
                  data: _form,
                  dataType: "text",
                  success:
                    function(result){

                        var obj = JSON.parse(result);                   //parsira text u polje objekata
                        // alertify.success('RESULT: ' + obj);
                        if(obj==="TRUE")
                        {
                            alertify.success('Uspješno obrisan TIP sa id-em ' + id + '.');
                            $("#item-type-" + id).remove();
                        }
                        else {
                            alertify.error('Tip sa id-em ' + id + ' se ne može obrisati jer barem jedan artikl ima pridružem taj TIP artikla.');
                        }

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " - " +thrownError);
                    }
                });
            },
            function()
            {
                //alertify.error('Prekid brisanja izdatnice!');
            }
        );
    });

});
