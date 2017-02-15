$(document).ready(function() {

    /*
        TABLICA MODALNOG DIJALOGA ZA ODABIR ARTIKALA
        ---------------------------------------------
        |ID|Ime     |Opis   |Tip    |Kod    |Kol    |
        ---------------------------------------------
    */
    var dt = $('#receipts_table').DataTable();  //Inicijalizacija tablice i spremanje reference u varijablu
    dt     // Sortira tablicu po prvoj vidljivoj koloni
        .column( '0:visible' )
        .order( 'desc' )
        .draw();

    //------------------------------------------
    //   Prikazuje dialog sa pregledom primke
    //------------------------------------------
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
                        alertify.minimalDialog || alertify.dialog('minimalDialog',function(){
                            return {
                                main:function(content){
                                    this.setContent(content);
                                },
                                setup:function(){
                                    return {
                                        buttons:[{text: "Prekid", key:27/*Esc*/}],
                                        focus: { element:0 },
                                        options:{
                                            startMaximized:true
                                        }
                                    };
                                }
                            };
                        });
                        var r = result;
                        //  REZULTAT - vraca cijeli view
                        alertify.minimalDialog(result);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(textStatus + errorThrown);
                    }
            });
      }

    });

    //--------------------------------------------
    //  Uvecavanje i smanjivanje kolicine artikala
    //  sa gumbima + i - te micanje artikala sa x
    //--------------------------------------------

    $('#selected_items_table_body').on('click', '.btn-minus', function()
    {
        id = $(this).attr("id");
        newQuantity = parseInt($("#qnt-"+id).html()) - 1;
        if(newQuantity>0)
        {
            $("#qnt-"+id).html(newQuantity);
            $("#hidden-item-qnt-"+id).val(newQuantity);
        }
    });

    $('#selected_items_table_body').on('click', '.btn-plus', function()
    {
        id = $(this).attr("id");
        newQuantity = parseInt($("#qnt-"+id).html()) + 1;
        if(newQuantity<10000)
        {
            $("#qnt-"+id).html(newQuantity);
            $("#hidden-item-qnt-"+id).val(newQuantity);
        }
    });

    $('#selected_items_table_body').on('click', '.btn-remove', function()
    {
        id = $(this).attr("id");
        $("#row-"+id).remove();
        $("#hidden-item-id-"+id).remove();
        $("#hidden-item-qnt-"+id).remove();
    });


    //--------------------------------------------------
    // Dodavanje artikala putem modalnog dialoga artikala
    // gumb - Dodaj Artikl
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
        item_code = data.eq(5).html();
        item_price = data.eq(6).html();

        // Provjeravamo ako je vec dodan isti artikl
        addedItems = $("#selected_items_table_body").children();
        for(i = 0; i < addedItems.length; i++)
        {
            currentId = addedItems[i].children[0].innerHTML;
            if(currentId === id)
            {
                alertify.warning("Artikl <b>" + item_name + "</b> je vec odabran!");
                return;
            }
        }

        // Dodajemo artikla u tablicu
        $('#selected_items_table_body').append('<tr id=row-'+ item_id + '><td>'+ item_id +'</td>' +
            '<td>'+ item_image +
            '<td class="item_quantity">' +
                '<strong id="qnt-'+ item_id +'" style="padding-left:5px; color:blue;">1</strong>' +
                '<div class="btn-group btn-group-sm pull-right" role="group" aria-label="..." style="margin:0px;">' +
                    '<button type="button" class="btn btn-default btn-minus" id='+ item_id +'> - </button>' +
                    '<button type="button" class="btn btn-default btn-plus" id='+ item_id +'> + </button>' +
                '</div>' +
            '</td>' +
            '<td>'+ item_name +'</td>' +
            '<td>'+ item_description +'</td>' +
            '<td>'+ item_code +'</td>' +
            '<td>' + item_price +'</td>' +
            '<td><button class="btn btn-danger btn-xs btn-remove" type="button" name="button" id='+ item_id + '><i class="fa fa-times"></i></button></td></tr>');

        // Dodajemo artikl u hidden div za slanje sa formom
        $('#hidden_id').append("<input class='' id='hidden-item-id-" + item_id + "' name='item_id[]' value='" + item_id + "'/>");
        $('#hidden_id').append("<input class='' id='hidden-item-qnt-" + item_id + "' name='item_qnt[]' value='" + 1 + "'/>");
        $('#hidden_id').append("<br>");
    });


    // provjeravamo ako element postoji jer se isti .js dokument poziva za razlicite stranice
    var footnoteEditor = $('#footnote');
    if(footnoteEditor.length)
    {
        $('#footnote').wysihtml5({locale: "hr-HR"});
    }

    //---------------------------------------------
    //     Modalni dialog za brisanje primki
    //---------------------------------------------
    $("#receipts_table").on("click", ".receipt_modal_delete", function(){

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

    // -----------------------------------------------------
    // Zapis napomene dodaje u skriti element za submitanje
    // -----------------------------------------------------
    $('#kreiraj_btn').click(function(){
        var footnote = $('#footnote').val();
        $("#hidden-footnote").val(footnote);
    });


    // **************************************
    // Dodavanje artikala putem citanja kodom
    // **************************************
    var inputCode = $("#input-code");

    $("#modal_code").on("show.bs.modal", function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal

      inputCode.val('');
      setTimeout(function(){inputCode.focus();}, 500);
    });

    $("#modal_code").on("hide.bs.modal", function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
    });

    // $.fn.blink = function (count) {
    // var $this = $(this);
    //
    // count = count - 1 || 0;
    //
    // $this.animate({opacity: 0.25}, 100, function () {
    //     $this.animate({opacity: 1}, 100, function () {
    //         if (count > 0) {
    //             $this.blink(count);
    //         }
    //     });
    // });
    // };

    // $.fn.blink = function(e) {
    //     var $this = $(this);
    //     e.preventDefault();
    //     for (var i = 0; i < 3; i++ ) {
    //             $this.animate( { backgroundColor: "#f00" }, 2000 );
    //             $this.animate( { backgroundColor: "transparent" }, 2000 );
    //     }
    // };

    inputCode.keypress(function(e){
        if(e.which == 13) {
            // alert(inputCode.val());
            var code = inputCode.val();

            // Radimo AJAX prema kontroleru za provjeru postojanja istog koda artikla
            var BASE_URL = $("#base_url").text();
            var _form = $("#ajaxform").serializeArray();
            var data = {name:"code", value:code};
            _form.push(data);

            $.ajax({
                type: "POST",
                url: BASE_URL + "index.php/items/getItemFromCode", //url: "http://localhost:8080/LogTrack/index.php/transactions/addItem",
                data: _form,
                dataType: "text",
                success:
                function(result){
                    if(result !== 'null')
                    {
                        var obj = JSON.parse(result);                   //parsira text u polje objekata
                        setTimeout(
                            function(){

                                item_id = obj.id;
                                item_image = obj.image;
                                item_name = obj.name;
                                item_description = obj.description;
                                item_code = obj.code;
                                item_price = obj.price;

                                // Provjeravamo ako je vec dodan isti artikl
                                addedItems = $("#selected_items_table_body").children();
                                for(i = 0; i < addedItems.length; i++)
                                {
                                    currentId = addedItems[i].children[0].innerHTML;
                                    if(currentId === item_id)
                                    {
                                        var x = parseInt($("#selected_items_table_body > tr > td.item_quantity > strong#qnt-"+ item_id).text()) + 1;

                                        $("#selected_items_table_body > tr > td.item_quantity > strong#qnt-"+ item_id).text(x);
                                        $("#hidden_id > input#hidden-item-qnt-"+item_id).val(x);

                                        $("#input-code").val('');
                                        $("#modal_code").modal('toggle');

                                        //Animacija promjene
                                        // $("#selected_items_table_body > tr > td.item_quantity > strong#qnt-"+ item_id).parent().css({"background-color":"red", "-webkit-animation-duration":"4s"});
                                        // $("#selected_items_table_body > tr > td.item_quantity > strong#qnt-"+ item_id).parent().blink(3);
                                        return;
                                    }
                                }

                                // Dodajemo artikla u tablicu
                                $('#selected_items_table_body').append('<tr id=row-'+ item_id + '><td>'+ item_id +'</td>' +
                                    '<td class="text-center">' +
                                        '<img class="img img-responsive center-block" style="width: 40px; " id="image" src="' + BASE_URL + 'assets/dropzone/uploads/' + item_image + '"> ' +
                                    '</td>' +
                                    '<td class="item_quantity">' +
                                        '<strong id="qnt-'+ item_id +'" style="padding-left:5px; color:blue;">1</strong>' +
                                        '<div class="btn-group btn-group-sm pull-right" role="group" aria-label="..." style="margin:0px;">' +
                                            '<button type="button" class="btn btn-default btn-minus" id='+ item_id +'> - </button>' +
                                            '<button type="button" class="btn btn-default btn-plus" id='+ item_id +'> + </button>' +
                                        '</div>' +
                                    '</td>' +
                                    '<td>'+ item_name +'</td>' +
                                    '<td>'+ item_description +'</td>' +
                                    '<td>'+ item_code +'</td>' +
                                    '<td>' + item_price +'</td>' +
                                    '<td><button class="btn btn-danger btn-xs btn-remove" type="button" name="button" id='+ item_id + '><i class="fa fa-times"></i></button></td></tr>');

                                // Dodajemo artikl u hidden div za slanje sa formom
                                $('#hidden_id').append("<input class='' id='hidden-item-id-" + item_id + "' name='item_id[]' value='" + item_id + "'/>");
                                $('#hidden_id').append("<input class='' id='hidden-item-qnt-" + item_id + "' name='item_qnt[]' value='" + 1 + "'/>");
                                $('#hidden_id').append("<br>");

                                $("#input-code").val('');
                                $("#modal_code").modal('toggle');
                            }, 10
                        );
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


});
