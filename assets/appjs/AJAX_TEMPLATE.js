//
//  Genericki AJAX call jQuery
//
$(".jQuery Selector npr. Button").on("click", function(){
    var ID = $(this).attr("id");

    var BASE_URL = $("#base_url").text();
    var _form = $("#ajaxform").serializeArray();
    var data = {name:"id", value:ID};
    _form.push(data);

    $.ajax({
        type: "POST",
        url: BASE_URL + "index.php/controller",
        data: _form,
        dataType: "text",
        success:
        function(result){
                var obj = JSON.parse(result);                   //parsira text u polje objekata
                if(obj==="TRUE")
                {
                    alertify.success('Uspješno obrisan sa id-em: ' + id);
                }
                else {
                    alertify.error('Nije moguće brisanje sa id-em: ' + id + ' jer se nalazi u nekim od dokumenata.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus + errorThrown);
        }
    });
    //alert(boxName);
});
