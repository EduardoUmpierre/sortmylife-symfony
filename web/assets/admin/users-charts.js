$.get('/admin/usuarios/data', function (dados) {
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Usuários'
        },
        subtitle: {
            text: 'Clique nas colunas para ver mais detalhes.'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total de usuários em cada módulo'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.0f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> do total<br/>'
        },

        series: [{
            name: 'Usuários',
            colorByPoint: true,
            data: dados.series
        }],
        drilldown: {
            series: dados.drilldown
        }
    });
});