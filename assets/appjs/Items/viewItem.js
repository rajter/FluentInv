$(document).ready(function() {

    $("#btn-change-item-status").click(function(){
        // alertify.notify("Status");

        var itemId = $(this).attr("data-item-id");

        // alert(id);

        alertify.confirm("Promjena statusa", "Jeste li sigurni da želite promjeniti status artikl iz otpisanog u dostupan?",
            function(){

                var BASE_URL = $("#base_url").text();

                var _form = $("#ajaxform").serializeArray();
                var obj = {name:"id", value:itemId};
                _form.push(obj);

                $.ajax({
                  type: "POST",
                  url: BASE_URL + "index.php/Items/changeStatus",
                  data: _form,
                  dataType: "text",
                  success:
                    function(result){
                        var obj = JSON.parse(result);                   //parsira text u polje objekata
                        if(obj==="TRUE")
                        {
                            location.reload();
                        }
                        else {
                            alertify.error('Nije moguće mjenjanje status.');
                        }

                    },
                    error: function(thrownError) {
                        alert(thrownError);
                        console.log("Error:", thrownError);
                    }
                });
            },
            function(){
                // alertify.error('Cancel');
            }
        );
    });

});
