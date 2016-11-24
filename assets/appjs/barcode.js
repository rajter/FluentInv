$(document).ready(function() {
    //alert("barcode");

    var inputCode = $("#input-code");

    $("#modal_code").on("show.bs.modal", function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      //$("#code").val('ddd');

      inputCode.val('');
      setTimeout(function(){inputCode.focus();}, 500);
      //alert('hello');
    });

    $("#modal_code").on("hide.bs.modal", function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      //$("#code").val('ddd');
      //alert(inputCode.val());
    });

    inputCode.keypress(function(e){
        if(e.which == 13) {
            //alert('You pressed enter!');

            // Radimo AJAX prema kontroleru za provjeru postojanja istog koda artikla
            var BASE_URL = $("#base_url").text();
            var duplicate = true;
            $.ajax({
                type: "GET",
                url: BASE_URL + "index.php/items/checkCode", //url: "http://localhost:8080/LogTrack/index.php/transactions/addItem",
                data: { "code": inputCode.val()},
                dataType: "text",
                success:
                function(result){
                    var obj = JSON.parse(result);                   //parsira text u polje objekata
                    if(obj !== null)
                    {
                        setTimeout(
                            function(){
                                var code = inputCode.val();
                                alert('Artikl sa istim kodom vec postoji. ' + obj.name + ' Unesite novi kod.');
                                $("#input-code").val('');
                            }, 1000
                        );
                    }
                    else {
                        setTimeout(
                            function(){
                                var code = inputCode.val();
                                $("#modal_code").modal('toggle');
                                $("#item_code").val(code);
                            }, 1000
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
