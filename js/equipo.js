var chart;
$(document).ready(function() {
    var options = {
        chart: {
            renderTo: 'grafica',
            defaultSeriesType: 'line',
            marginRight: 130,
            marginBottom: 25
        },
        title: {
            text: 'Valor de Mercado',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            type: 'datetime',
            tickInterval: 7 * 24 * 3600 * 1000, // one week
            tickWidth: 0,
            gridLineWidth: 1,
            labels: {
                align: 'center',
                x: -3,
                y: 20,
                /*formatter: function() {
                 return Highcharts.dateFormat('%d-%m-%Y', this.value);
                 }*/
            }
        },
        yAxis: {
            title: {
                text: 'Valor (€)'
            },
            plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
        },
        tooltip: {
            formatter: function() {
                return Highcharts.dateFormat('%d-%m-%Y', this.x) + ' : <b>' + this.y + ' €</b>';
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -10,
            y: 100,
            borderWidth: 0
        },
        credits: {
            enabled: false
        },
        series: [{
                name: 'valor',
                pointInterval: 24 * 3600 * 1000
            }]
    }

    var idEquipo = $("#grafica").attr("data");

    jQuery.get(site_url + 'mercado/valoresMercadoEquipo/' + idEquipo, null, function(data) {
        fechas = [];
        traffic = [];
        primeraVuelta = true;
        $(data).find('valorMercado').each(function() {
            if (primeraVuelta) {
                fechaInicio = $.trim($(this).find('fecha').text());
            }
            traffic.push(parseInt($.trim($(this).find('precio').text())));
            //fechas.push($.trim($(this).find('fecha').text()));
            primeraVuelta = false;
        });

        fecha = fechaInicio.split("-");

        options.series[0].data = traffic;
        options.series[0].pointStart = Date.UTC(fecha[0], fecha[1] - 1, fecha[2].split(" ")[0]);

        chart = new Highcharts.Chart(options);
    });
});


