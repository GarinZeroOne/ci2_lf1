<script>

   

    var fvalores = new Array();
    cont = 0;
    <?php foreach($fechas_valores as $fechav): ?>

        fvalores[cont] = '<?php echo $fechav; ?>';
        cont++;

        
    <?php endforeach; ?>
    
    Highcharts.setOptions({
        chart: {
            style: {
                fontFamily: 'Tahoma, Arial'
            }
        }
    });
    
    $(function() { 
        $('#grafica3').highcharts({
            chart: {
                type: 'area',
                spacingTop: 0,
                spacingLeft: 0,
                spacingRight: 0,
                spacingBottom: 0,
                height: 165
            },
            title: {
                text: 'Valor mercado Equipos',
            },
            xAxis: {
                labels: {
                    enabled: false,
                                            
                },
                showFirstLabel: true,
                tickInterval: 14,
                reversed: true,
                tickWidth: 0,
                lineColor: '#ccc',
                lineWidth: 0,
                minPadding: 0,
                maxPadding: 0
            },
            yAxis: {
                title: {
                    text: null
                },
                tickWidth: 0,
                labels: {
                    enabled: false,
                    formatter: function() {
                        return Highcharts.numberFormat(this.value / 1000000, 0, ",", ".") + " M";
                    }
                },
                gridLineColor: '#DDD',
                gridLineWidth: 0,
                tickColor: '#DDD',
            },
            tooltip: {
                hideDelay: 0,
                formatter: function() {
                    return fvalores[this.x] + '<br/><strong>' +
                    Highcharts.numberFormat(this.y, 0, ',', '.') + ' €</strong>';
                },
                style: {
                    fontSize: '11px',
                },
                borderRadius: 0
            },
            legend: {
                enabled: false
            },
            series: [<?php echo $valores_dinero; ?>],
            credits: {
                enabled: false
            },
            plotOptions: {
                series: {
                    animation: false,
                    marker: {
                        enabled: false,
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    },
                    color: '#1FB5AD'
                },
                area: {
                    shadow: false
                }
            }
        });
    });

/*
$(function () { 
    $('#grafica2').highcharts({
        chart: {
            type: 'bar',
            spacingTop: 0,
            spacingLeft: 0,
            spacingRight: 0,
            spacingBottom: 0,
            height: 165
        },
        title: {
            text: 'Movimiento dinero Fichajes / Ventas'
        },
        subtitle:{
            text: "<?php echo date('d.m.Y',strtotime('-1 days')) ?>"
        },
        xAxis: {

                showFirstLabel: true,
                tickInterval: 14,
                reversed: true,
                tickWidth: 0,
                lineColor: '#ccc',
                lineWidth: 0,
                minPadding: 0,
                maxPadding: 0
        },
        credits: {
                enabled: false
        },
        legend: {
                enabled: false
            },
        yAxis: {
            title: {
                text: false
            }
        },
        series: <?php echo $series_data; ?>
    });
});
*/
</script>