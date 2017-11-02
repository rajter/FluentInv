$(document).ready(function() {

    $(".item").click(function(){
        var id = $(this).attr("id").substr(5); // id="item-id" - treba nam samo id
        var itemName = $(this).attr("data-item");
        // alert(id);

        alertify.confirm("Brisanje artikala", "Jeste li sigurni da želite obrisati artikl sa id-em " + id + " ["+ itemName +"].?",
            function(){

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
                        var r = result;
                        var obj = JSON.parse(result);                   //parsira text u polje objekata
                        if(obj==="TRUE")
                        {
                            alertify.success('Uspješno obrisan artikl sa id-em: ' + id);
                            $("#item-row-"+id).remove();
                        }
                        else {
                            alertify.error('Nije moguće brisanje artikla sa id-em: ' + id + ' jer se nalazi u nekim transakcijama. Status artikla postavljeno na otpisan.');
                            $("#item-status-"+id).text('Otpisan');
                            $("#item-status-"+id).attr('class', 'label label-danger');
                        }

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log("Error:", thrownError);
                        console.log("xhr:", xhr);
                        console.log("AjaxOptions:", ajaxOptions);
                    }
                });
            },
            function(){
                // alertify.error('Cancel');
            }
        );


    });

});
