$(document).ready(function() {

    //--------------------------------------------------
    // Dodavanje artikala putem modalnog dialoga artikala
    // gumb - Izaberi Artikl
    //--------------------------------------------------
    $('#add_items_table').on('click', 'tr', function()
    {
        id = $(this).children().first().html();
        $("#modal_add_item").modal("toggle");

        data = $(this).children();
        item_id = data.eq(0).html();
        item_image = data.eq(1).html().trim();
        item_name = data.eq(2).html();
        item_description = data.eq(3).html();
        item_type = data.eq(4).html();
        item_code = data.eq(5).html();
        item_price = data.eq(6).html();

        //Dodajemo artikl u formu
        $('#item-taken-row').show();
        var imgSrc = data.eq(1)[0].children[0].src;
        $('#item-img').attr('src', imgSrc);
        $('#item-taken').val(item_id);
        $('#item-name').text(item_name);
        $('#item-price').text(item_price);
        $('#item-description').text(item_description);
        $('#item-type').text(item_type);
        $('#item-code').text(item_code);
    });

    //---------------------------------
    //  Pruduzivanje deadline artikla
    //---------------------------------
    $('#modal-postpone').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);
        $("#trans-id").val(id);
    });

    //----------------------------------------
    // Dodavanje artikala putem citanja kodom
    //----------------------------------------
    var inputCode = $("#input-code");

    $("#modal_code").on("show.bs.modal", function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      inputCode.val('');
      setTimeout(function(){inputCode.focus();}, 500);
    });

    $("#modal_code").on("hide.bs.modal", function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
    });

    inputCode.keypress(function(e){
        if(e.which == 13) {
            // alert(inputCode.val());
            var code = inputCode.val();

            // Radimo AJAX prema kontroleru za provjeru postojanja istog koda artikla
            var BASE_URL = $("#base_url").text();
            var _form = $("#ajaxform").serializeArray();
            var data = {name:"code", value:code};
            _form.push(data);

            // alert(data);

            $.ajax({
                type: "POST",
                url: BASE_URL + "index.php/transactions/getItemFromCode", //url: "http://localhost:8080/LogTrack/index.php/transactions/addItem",
                data: _form,
                dataType: "text",
                success:
                function(result){
                    if(result !== 'null')
                    {
                        var obj = JSON.parse(result);                   //parsira text u polje objekata
                        // alert(JSON.stringify(obj));
                        if(obj.item_status_id == '2')
                        {
                            alert("Artikl " + obj.name + " je zauzet!");
                            $("#input-code").val('');
                        }
                        else
                        {
                            setTimeout(
                                function(){

                                    baseUrlImages = $("#base-url-images").html().trim();

                                    item_id = obj.id;
                                    item_image = baseUrlImages + obj.image;
                                    item_name = obj.name;
                                    item_description = obj.description;
                                    item_code = obj.code;
                                    item_price = obj.price;


                                    //Dodajemo artikl u formu
                                    $('#item-taken-row').show();
                                    var imgSrc = item_image;
                                    $('#item-img').attr('src', imgSrc);
                                    $('#item-taken').val(item_id);

                                    $('#item-name').html(item_name + ' (KOD: '+ item_code + ')');
                                    $('#item-description').html(item_description);
                                    $('#item-price').html(item_price + ' kn');

                                    $("#input-code").val('');
                                    $("#modal_code").modal('toggle');
                                }, 10
                            );
                        }
                    }
                    else {
                        alert("Artikl sam unesenim kodom ne postoji u bazi podataka!");
                        $("#input-code").val('');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus + errorThrown);
                }
            });

        }

    });

    //----------------------------------------
    // Vracanje artikala putem citanja kodom
    //----------------------------------------
    var inputReturnCode = $("#input-return-code");

    $("#modal-code").on("show.bs.modal", function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      inputReturnCode.val('');
      setTimeout(function(){inputReturnCode.focus();}, 500);
    });

    $("#modal-code").on("hide.bs.modal", function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
    });

    inputReturnCode.keypress(function(e){
        if(e.which == 13) {
            // alert(inputReturnCode.val());
            var code = inputReturnCode.val();

            // Radimo AJAX prema kontroleru za provjeru postojanja istog koda artikla
            var BASE_URL = $("#base_url").text();
            var _form = $("#ajaxform").serializeArray();
            var data = {name:"code", value:code};
            _form.push(data);

            // alert(JSON.stringify(data));

            $.ajax({
                type: "POST",
                url: BASE_URL + "index.php/transactions/returnItemFromCode",
                data: _form,
                dataType: "text",
                success:
                function(result){
                    var r = result;
                    if(result !== 'null')
                    {
                        var obj = JSON.parse(result); //parsira text u polje objekata

                        setTimeout(
                            function(){
                                trans_id = obj.id;
                                item_name = obj.name;

                                alertify.success('Uspješno vraćen artikl ' + item_name);
                                $("#transaction-box-"+trans_id).remove();

                                $("#input-return-code").val('');
                                $("#modal-code").modal('toggle');
                            }, 10
                        );
                    }
                    else {
                        alertify.warning("Artikl sam kodom "+ code +" nije zadužen.");
                        $("#input-return-code").val('');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus + errorThrown);
                }
            });

        }

    });


    //---------------------------------------------
    //     Modalni dialog za brisanje zaduzenja
    //---------------------------------------------
    var transID; // ID zaduzenja -> Globalna varijabla za brisanje zaduzenja
    var itemName;

    $("#modal-delete").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        transID = button.data('id'); // Extract info from data-* attributes
        itemName = button.data('name'); // Extract info from data-* attributes
        var modal = $(this);

        $("#modal-zaduzenje").text(itemName);

    });

    $('#btn-delete').on('click', function (event) {
        // Radimo AJAX prema kontroleru za provjeru postojanja istog koda artikla
        var BASE_URL = $("#base_url").text();
        var _form = $("#ajaxform").serializeArray();
        var data = {name:"transaction-id", value:transID};
        _form.push(data);

        $.ajax({
            type: "POST",
            url: BASE_URL + "index.php/transactions/delete", //url: "http://localhost:8080/LogTrack/index.php/transactions/addItem",
            data: _form,
            dataType: "text",
            success:
            function(result){
                if(result !== 'null')
                {
                    var obj = JSON.parse(result);                   //parsira text u polje objekata
                    alertify.success('Uspješno obrisano zaduženje za artikl ' + itemName);
                    $("#transaction-box-"+transID).remove();
                }
                else {
                    alertify.error('Greška!');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alertify.error('Greška!');
            }
        });

        $("#modal-delete").modal('toggle');
    });

    //---------------------------------------------
    //     Modalni dialog za brisanje transakcija
    //---------------------------------------------
    $('#transactions_table').on('click', '#btn-delete-transaction', function()
    {
        var BASE_URL = $("#base_url").text();

        var transID = $(this).attr("data-transactionID");
        var imageName = $(this).attr("data-item-image");
        var itemName = $(this).attr("data-item-name");

        var image = "<img class='media-object' data-toggle='tooltip' data-placement='bottom' title='' src='"+ BASE_URL + "assets/dropzone/uploads/" + imageName +"' alt='slika artikla' style='width: 100px; height:100px;' >";
        alertify.confirm("Brisanje transakcije", "Jeste li sigurni da želite obrisati transakciju za artikl <strong>" + itemName + "</strong> ?" + image,
            function(){

                var _form = $("#ajaxform").serializeArray();
                var obj = {name:"transaction-id", value:transID};
                _form.push(obj);

                $.ajax({
                    type: "POST",
                    url: BASE_URL + "index.php/transactions/delete", //url: "http://localhost:8080/LogTrack/index.php/transactions/addItem",
                    data: _form,
                    dataType: "text",
                    success:
                    function(result){
                        if(result !== 'null')
                        {
                            var obj = JSON.parse(result);                   //parsira text u polje objekata
                            alertify.success('Uspješno obrisano zaduženje za artikl ' + itemName);
                            $("#transaction-row-"+transID).remove();
                        }
                        else {
                            alertify.error('Greška!');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alertify.error('Greška!');
                    }
                });
            },
            function(){
                // alertify.error('Cancel');
            }
        ).set('labels', {ok:'OK', cancel:'Cancel'});
    });

});
