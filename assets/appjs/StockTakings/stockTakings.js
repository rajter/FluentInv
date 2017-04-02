//----------------------------------------
//  Provjerava ako je unos cijeli broje
//----------------------------------------
function isInt(value) {
  return !isNaN(value) &&
         parseInt(Number(value)) == value &&
         !isNaN(parseInt(value, 10));
}

$(document).ready(function() {

    //-----------------------------------
    //  Dialog za upis stvarne količine
    //-----------------------------------
    $('#stock-taking-table').on('click', '.btn-qnt', function()
    {
        id = $(this).attr("id");

        alertify.prompt(
            'Stvarna Količina',
            '',
            '' ,
            function(evt, value) {
                if(isInt(value) && value > -1)
                {
                    $("#real-qnt-"+id).text(value);
                }
                else
                {
                    alertify.error("Krivi unos!");
                }
            },
            function() { /*alertify.error('Prekid');*/ }
        );

        //  Styling
        $(".ajs-content").addClass("text-center");
        $(".ajs-input").addClass("text-center");
        $(".ajs-input").css("font-size", "50px");
    });

    //---------------------------------------------------
    //  Resetira vrijednost na količinu iz stanja zaliha
    //---------------------------------------------------
    $('#stock-taking-table').on('click', '.btn-reset', function()
    {
        id = $(this).attr("id");
        quantity = $("#inventory-qnt-"+id).data("qnt");

        $("#real-qnt-"+id).empty();
        $("#real-qnt-"+id).append("<strong>"+quantity+"</strong>");
    });

    //-------------------
    //  Otpisuje artikl
    //-------------------
    $('#stock-taking-table').on('click', '.btn-write-off', function()
    {
        id = $(this).attr("id");
        $("#real-qnt-"+id).empty();
        $("#real-qnt-"+id).append("<strong>/</strong>");
    });

    //-------------------
    //  Brise inventure
    //-------------------
    $("#stock_takings_table").on("click", ".stock_taking_modal_delete", function(){
        var id = $(this).data('id');
        var invNumber = $(this).data('inv-number');

        alertify.confirm(
            'Brisanje Inventure',
            'Jeste li sigurni da želite obrisati Inventuru sa brojem - <strong>' + invNumber + '</strong> ?',
            function()
            {
                var BASE_URL = $("#base_url").text();
                var _form = $("#ajaxform").serializeArray();
                var obj = {name:"id", value:id};
                _form.push(obj);

                $.ajax({
                  type: "POST",
                  url: BASE_URL + "index.php/stockTakings/delete",
                  data: _form,
                  dataType: "text",
                  success:
                    function(result){

                        var obj = JSON.parse(result);                   //parsira text u polje objekata
                        if(obj==="TRUE")
                        {
                            alertify.success('Uspješno obrisana invnetura br. <strong>' + invNumber + '</strong> .');
                            $("#stock_taking-row-" + id).remove();
                        }
                        else {
                            alertify.error('Inventura sa brojem ' + invNumber + ' se ne može obrisati jer je inventura već zaključana.');
                        }

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + " - " +thrownError);
                    }
                });
            },
            function()
            {
                //alertify.error('Prekid!');
            }
        );


    });

    //--------------------------------------------------
    //  Dodaje hidden kolicine za post UPDATE funkciju
    //--------------------------------------------------
    $("#spremi_btn").on('click', function(){

        $(".real-qnt").each(function(){
            var itemID = $(this).data('id');
            var itemQnt = $(this).text().trim();
            var hiddenQnt = "<input id='hidden-item-qnt-"+itemID+"' class='hidden' name='item_qnt[]' value='"+itemQnt+"' >";
            $(this).append(hiddenQnt);
        });
    });

    //----------------------------------------------------------------------------
    //  Dodaje hidden kolicine za post LOCK funkciju kod zakljucavanja inventure
    //----------------------------------------------------------------------------
    $("#lock_btn").on('click', function(){

        $(".real-qnt").each(function(){
            var itemID = $(this).data('id');
            var itemQnt = $(this).text().trim();
            var hiddenQnt = "<input id='hidden-item-qnt-"+itemID+"' class='hidden' name='item_qnt[]' value='"+itemQnt+"' >";
            $(this).append(hiddenQnt);
        });
    });
});
