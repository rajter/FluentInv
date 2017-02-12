$(document).ready(function() {

    var currentLocation = $("#current-location").text();
    var selectedLocation = $("#stocks-warehouse-select").children("option[value="+currentLocation+"]").prop("selected", "true");        // selektira trenutno skladiste

    $("#stocks-refresh-btn").click(function(){
        window.location.href = $("#stocks-warehouse-select").val();
    });
});

//alert("hello!");
// $("#change-warehouse-btn").click(function(){
//     //alertify.alert('Alert Title', 'Alert Message!', function(){ alertify.success('Ok'); });
//     if(!alertify.myAlert){
//       //define a new dialog
//         alertify.dialog('myAlert',function factory(){
//             return{
//                 main:function(content){
//                     this.setContent(content);
//                 }
//             }
//         });
//     }
//
//     var dialogContent = $("#hidden-locations-select").html(); //pokupimo skriti select sa lokacijama te gumbima i uvrstimo unutar dialoga
//     alertify.myAlert(dialogContent);
// });
