(function() {
    if (document.querySelector('#chart') !== null) {
        var chart = Highcharts.chart('chart', {
            chart: {
                type: 'heatmap',
                marginTop: 40,
                marginBottom: 80,
                plotBorderWidth: 1
            },
            title: { text: series_title + ' - IMDb rating per season/episode' },
            xAxis: {
                title: {text: 'Season'},
                tickInterval: 1,
            },
            yAxis: {
                title: {text: 'Episode'},
                tickInterval: 1,
                reversed: true,
            },
            colorAxis: {
                stops: [
                [0, '#df0000'],
                [0.5, '#dfdf00'],
                [1, '#00df00'],
                ]
            },
            legend: {
                align: 'right',
                layout: 'vertical',
                margin: 0,
                verticalAlign: 'top',
                y: 25,
                symbolHeight: 280,
            },
            tooltip: {
                formatter: function () {
                    return '<b>S' + this.point.x + 'E' + this.point.y +
                    '</b>: '+data[this.point.index][3]+'<br>Rating: ' + this.point.value;
                }
            },
            series: [{
                name: 'IMDb Rating',
                borderWidth: 1,
                data: data,
                dataLabels: {
                    enabled: true,
                    color: '#000000'
                }
            }]
        });
    }
})();