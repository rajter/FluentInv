$(document).ready(function() {

    $(".item").click(function(){
        var id = $(this).attr("id").substr(5); // id="item-id" - treba nam samo id
        // alert(id);

        var BASE_URL = $("#base_url").text();

        var _form = $("#ajaxform").serializeArray();
        var obj = {name:"id", value:id};
        _form.push(obj);

        $.ajax({
          type: "POST",
          url: BASE_URL + "index.php/Items/delete",
          data: _form,
          dataType: "text",
          success:
            function(result){

                var obj = JSON.parse(result);                   //parsira text u polje objekata
                if(obj==="TRUE")
                {
                    alertify.success('Uspješno obrisan artikl sa id-em: ' + id);
                }
                else {
                    alertify.error('Nije moguće brisanje artikla sa id-em: ' + id + ' jer se nalazi u nekim od dokumenata.');
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " - " +thrownError);
            }
        });
    });

});
