<script>
$(function () { 
    $('#grafica').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Movimiento dinero Fichajes / Ventas'
        },
        subtitle:{
            text: "<?php echo date('d.m.Y',strtotime('-1 days')) ?>"
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