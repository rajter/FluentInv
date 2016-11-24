$(document).ready(function(){

    /*
    *   DELETES THE ITEM
    */
    $("#modal_delete_item").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data("id");
        alert(id);
    });
});
