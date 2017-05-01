$(document).ready(function() {
    // alert('hello');
    
});

new Morris.Line({
    // ID of the element in which to draw the chart.
    element: 'borrowchart',
    resize: true,
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [
      { year: '2012', value: 20 },
      { year: '2013', value: 10 },
      { year: '2014', value: 5 },
      { year: '2015', value: 5 },
      { year: '2016', value: 20 }
    ],
    // The name of the data record attribute that contains x-values.
    xkey: 'year',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['value'],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Value']
    });
    //
    Morris.Donut({
    element: 'typechart',
    resize: true,
    colors: ["#008f57", "#f56954", "#dba400"],
    data: [
      {label: "Slobodni uređaji", value: 10},
      {label: "Posuđeni uređaji", value: 50},
      {label: "Nedostupni uređaji", value: 100}
    ],
    hideHover: 'auto'
});
