$(document).ready(function(){

    //****************************************
    //  POSTAVLJE DEFAULTNE VRIJEDNOSTI PRIMKE

    var locationID = $("#current-location").html();
    var clientID = $("#current-client").html();

    var locationFilter = "[value='" + locationID + "']";
    var currentLocationSelect = $("#location-select").children(locationFilter);
    currentLocationSelect.attr("selected", "selected");

    var clientFilter = "[value='" + clientID + "']";
    var currentClientSelect = $("#client-select").children(clientFilter);
    currentClientSelect.attr("selected", "selected");

    //************************************************

});
