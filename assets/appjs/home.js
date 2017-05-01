/*jshint esversion: 6 */

function loadChartData(){

    MonthlyData = [];
    chartData =[];
    // alert("jebena funkcija");
    var BASE_URL = $("#base_url").text();
    var _form = $("#ajaxform").serializeArray();
    // var data = {name:"id", value:ID};
    // _form.push(data);

    $.ajax({
        type: "POST",
        url: BASE_URL + "index.php/home/getChartData",
        data: _form,
        dataType: "text",
        success:
        function(result){
            MonthlyData = JSON.parse(result);                   //parsira text u polje objekata
            for (var key in MonthlyData) {
                if (MonthlyData.hasOwnProperty(key)) {
                    // alert(key + " -> " + MonthlyData[key]);
                    var year =  MonthlyData[key][0].year;
                    var month =  MonthlyData[key][0].month;
                    var Nprimke =  MonthlyData[key][0].totalTransactions;
                    var Nizdatnice =  MonthlyData[key][1].totalTransactions;
                    var Nmedjuskladisnice =  MonthlyData[key][2].totalTransactions;
                    chartData.push({mjesec: year+'-'+month, primke: Nprimke, izdatnice: Nizdatnice, medjuskladisnice: Nmedjuskladisnice});

                }
            }
            home_chart = Morris.Area({
                element: 'items-chart',
                data: chartData,
                xkey: 'mjesec',
                ykeys: ['primke', 'izdatnice', 'medjuskladisnice'],
                labels: ['Primke', 'Izdatnice', 'Međuskladišnice'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });
            // alert(JSON.stringify(chartData));
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(textStatus + errorThrown);
        }
    });
}

$(document).ready(function(){
    $("#calendar").datepicker();
    loadChartData();
    // alert(chartData);
});
