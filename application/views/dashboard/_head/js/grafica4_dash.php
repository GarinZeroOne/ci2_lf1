<script>

$(function () {
    $('#grafica4').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            marginTop:-10,
            spacingTop: 0,
            spacingLeft: 0,
            spacingRight: 0,
            spacingBottom: 0,
            height: 280
        },
        credits: {
                enabled: false
            },
        title: {
            align: 'left',
            text: 'Fondos por comunidad',
            x:0,
            y:20
            },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                <?php foreach ($comunidades_dinero as $key => $value) {
                        # ['Shanghai', 23.7]
                    echo "['".$key."' ,".$value."],";
                } ?>
                
            ]
        }]
    });
});

/*   
$(function () {
    $('#grafica4').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Progresión económica por comunidades'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -90,
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Millones'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Fondos totales: <b>{point.y} €</b>'
        },
        credits: {
                enabled: false
        },
        series: [{
            name: 'Population',
            data: [
                <?php foreach ($comunidades_dinero as $key => $value) {
                        # ['Shanghai', 23.7]
                    echo "['".$key."' ,".$value."],";
                } ?>
                
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
*/

</script>