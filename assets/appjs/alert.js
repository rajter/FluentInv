$(document).ready(function() {

    var alert = $("#alertData").attr("data-alert");
    var alertType = $("#alertData").attr("data-alerttype");

    if(alert)
    {
        switch (alertType) {
            case 'succes':
                alertify.success(alert);
                break;
            case 'error':
                alertify.success(alert);
                break;
            default:
                alertify.success(alert);
        }
    }

});
