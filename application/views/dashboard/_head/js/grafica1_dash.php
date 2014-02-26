<script>
$(function () { 
    $('#grafica').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Movimiento dinero Fichajes / Ventas'
        },
        xAxis: {
        },
        yAxis: {
            title: {
                text: 'Precio'
            }
        },
        series: <?php echo $series_data; ?>
    });
});
</script>