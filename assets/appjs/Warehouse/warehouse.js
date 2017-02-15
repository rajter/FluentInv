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
    $(".warehouse_modal_delete").on("click", function (event) {
        var id = $(this).attr("id").substr(3); // id="type-id" - treba nam samo id
        // alert(id);

        var BASE_URL = $("#base_url").text();
        // alert(BASE_URL);
        //
        var _form = $("#ajaxform").serializeArray();
        var obj = {name:"id", value:id};
        _form.push(obj);

        $.ajax({
          type: "POST",
          url: BASE_URL + "index.php/warehouses/delete",
          data: _form,
          dataType: "text",
          success:
            function(result){

                var obj = JSON.parse(result);                   //parsira text u polje objekata
                // alertify.success(result);
                // alertify.success('RESULT: ' + obj);
                if(obj==="TRUE")
                {
                    alertify.success('Uspješno obrisano skladište sa id-em ' + id + '.');
                    $("#warehouse-" + id).remove();
                }
                else {
                    alertify.error('Skladište sa id-em ' + id + ' se ne može obrisati jer barem jedna transakcija ima zapis tog skladišta.');
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " - " +thrownError);
            }
        });
    });
});
