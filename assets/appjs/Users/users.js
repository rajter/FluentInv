$(document).ready(function(){

    //-------------------------
    //  Odabir slike avatara
    //-------------------------
    $(".avatar").on('click', function(){

        // Uzima ime iz slike u dialogu za odabir
        var imgName = $(this).attr("data-name");
        // Postavlja novo ime avataru u input element
        $("#input-avatar").val(imgName);

        // Pormjena slike u odabranu sliku
        var imgPath = $("#image-avatar").attr("src");
        var base = imgPath.substring(0,imgPath.lastIndexOf('/'));

        var newImgPath = base + "/" + imgName;
        $("#image-avatar").attr("src", newImgPath);

        // Skriva modalni dialog
        $('#modal_choose_image').modal('hide');
    });
    
    //-----------------------
    //  Resetiranje lozinke
    //-----------------------
    var inputPassword = $("#input-password");

    $("#modal_password").on("show.bs.modal", function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      inputPassword.val('');
      setTimeout(function(){inputPassword.focus();}, 500);
    });

    $("#btn-change-password").on('click', function(){
        $("#modal_password").modal('toggle');
        // var userId = $("#user-id").val(); // Nije potrebno jer je user id u formi input elementa name='user-id'
        var password = inputPassword.val();
        if(password !== '')
        {
            // Radimo AJAX prema kontroleru za reset lozinke
            var BASE_URL = $("#base_url").text();
            var _form = $("#ajaxform").serializeArray();
            var data = {name:"password", value:password};
            _form.push(data);

            $.ajax({
                type: "POST",
                url: BASE_URL + "index.php/users/resetPassword", //url: "http://localhost:8080/LogTrack/index.php/user/resetPassword
                data: _form,
                dataType: "text",
                success:
                function(result){
                    if(result !== 'null')
                    {
                        var obj = JSON.parse(result);                   //parsira text u polje objekata
                        if(obj === 'TRUE')
                        {
                            alertify.success("Uspjesno resetirana lozinka!");
                        }
                    }
                    else {
                        inputPassword.val('');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + errorThrown);
                }
            });
        }
        else
        {
            alertify.error('Prazna lozinka!');
        }
    });
});
  
