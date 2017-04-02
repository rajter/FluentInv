$(document).ready(function(){

    $('#clients_table').DataTable({
        "pageLength": 50,
        "language": {
            "sEmptyTable":      "Nema podataka u tablici",
            "sInfo":            "Prikazano _START_ do _END_ od _TOTAL_ rezultata",
            "sInfoEmpty":       "Prikazano 0 do 0 od 0 rezultata",
            "sInfoFiltered":    "(filtrirano iz _MAX_ ukupnih rezultata)",
            "sInfoPostFix":     "",
            "sInfoThousands":   ",",
            "sLengthMenu":      "Prikaži _MENU_ rezultata po stranici",
            "sLoadingRecords":  "Dohvaćam...",
            "sProcessing":      "Obrađujem...",
            "sSearch":          "Pretraži:",
            "sZeroRecords":     "Ništa nije pronađeno",
            "oPaginate": {
                "sFirst":       "Prva",
                "sPrevious":    "Nazad",
                "sNext":        "Naprijed",
                "sLast":        "Zadnja"
            },
            "oAria": {
                "sSortAscending":  ": aktiviraj za rastući poredak",
                "sSortDescending": ": aktiviraj za padajući poredak"
            }
        }
    });
    /*
    *   DELETES THE CLIENT
    */
    // $(".client_modal_delete").on("click", function (event) {
    $("#clients_table").on("click", ".client_modal_delete", function(){
        var id = $(this).attr("id").substr(3); // id="type-id" - treba nam samo id
        var name = $(this).data('name');

        alertify.confirm(
            'Brisanje Klijenta',
            'Jeste li sigurni da želite obrisati Klijenta - <strong>' + name + '</strong> ?',
            function()
            {
                var BASE_URL = $("#base_url").text();
                // alert(BASE_URL);
                //
                var _form = $("#ajaxform").serializeArray();
                var obj = {name:"id", value:id};
                _form.push(obj);
                // alert(id);
                $.ajax({
                  type: "POST",
                  url: BASE_URL + "index.php/clients/delete",
                  data: _form,
                  dataType: "text",
                  success:
                    function(result){

                        var obj = JSON.parse(result);                   //parsira text u polje objekata
                        // alertify.success(result);
                        // alertify.success('RESULT: ' + obj);
                        if(obj==="TRUE")
                        {
                            alertify.success('Uspješno obrisan klijent <strong>' + name + '</strong> .');
                            $("#client-" + id).remove();
                        }
                        else {
                            alertify.error('Klijent sa id-em ' + id + ' se ne može obrisati jer barem jedna transakcija ima zapis tog klijenta.');
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
});
