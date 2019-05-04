
Ext.define('User', {
    extend: 'Ext.data.Model',
    fields: [ 'maker','model','code','memory','freqgpu','freqmem','directx', 'monitor','interface','resolution','connection']
});

Ext.onReady(function () {


    Highcharts.chart('highcharts-maker', {
        chart: {
            type: 'pie',
            width: 400,
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Количсетво видеокарт в зависимости от производителя'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Кол-во видеокарт',
            data: data_maker,
        }]
    });
});