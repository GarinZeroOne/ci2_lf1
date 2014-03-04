<script>

 /*   
    var meses = new Array();
        meses['ene'] = 'enero';
        meses['feb'] = 'febrero';
        meses['mar'] = 'marzo';
        meses['abr'] = 'abril';
        meses['may'] = 'mayo';
        meses['jun'] = 'junio';
        meses['jul'] = 'julio';
        meses['ago'] = 'agosto';
        meses['sep'] = 'septiembre';
        meses['oct'] = 'octubre';
        meses['nov'] = 'noviembre';
        meses['dic'] = 'diciembre';
        
    var categories = ['3<br/>mar','2<br/>mar','1<br/>mar','28<br/>feb','27<br/>feb','26<br/>feb','25<br/>feb','24<br/>feb','23<br/>feb','22<br/>feb','21<br/>feb','20<br/>feb','19<br/>feb','18<br/>feb','17<br/>feb','16<br/>feb','15<br/>feb','14<br/>feb','13<br/>feb','12<br/>feb','11<br/>feb','10<br/>feb','9<br/>feb','8<br/>feb','7<br/>feb','6<br/>feb','5<br/>feb','4<br/>feb','3<br/>feb','2<br/>feb','1<br/>feb','31<br/>ene','30<br/>ene','29<br/>ene','28<br/>ene','27<br/>ene','26<br/>ene','25<br/>ene','24<br/>ene','23<br/>ene','22<br/>ene','21<br/>ene','20<br/>ene','19<br/>ene','18<br/>ene','17<br/>ene','16<br/>ene','15<br/>ene','14<br/>ene','13<br/>ene','12<br/>ene','11<br/>ene','10<br/>ene','9<br/>ene','8<br/>ene','7<br/>ene','6<br/>ene','5<br/>ene','4<br/>ene','3<br/>ene','2<br/>ene','1<br/>ene','31<br/>dic','30<br/>dic','29<br/>dic','28<br/>dic','27<br/>dic','26<br/>dic','25<br/>dic','24<br/>dic','23<br/>dic','22<br/>dic','21<br/>dic','20<br/>dic','19<br/>dic','18<br/>dic','17<br/>dic','16<br/>dic','15<br/>dic','14<br/>dic','13<br/>dic','12<br/>dic','11<br/>dic','10<br/>dic','9<br/>dic','8<br/>dic','7<br/>dic','6<br/>dic','5<br/>dic','4<br/>dic'];
    
    Highcharts.setOptions({
        chart: {
            style: {
                fontFamily: 'Tahoma, Arial'
            }
        }
    });
    
    $(function() { 
        $('#grafica').highcharts({
            chart: {
                type: 'area',
                spacingTop: 0,
                spacingLeft: 0,
                spacingRight: 0,
                spacingBottom: 0,
                height: 165
            },
            title: {
                text: null,
            },
            xAxis: {
                labels: {
                    enabled: false,
                    formatter: function(){
                        return categories[this.value];
                    }                            
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
                    var dia = categories[this.x].split('<br/>');
                    return dia[0] + ' de ' + meses[dia[1]] + '<br/><strong>' +
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
            series: [{
                name: 'Valor',
                data: [568200000,577530000,569800000,572290000,580980000,580890000,594300000,586620000,599630000,583500000,590820000,598370000,591720000,602240000,597170000,609040000,608930000,618880000,616220000,626480000,621440000,629840000,625380000,625860000,624590000,632350000,621490000,634210000,619120000,636360000,619880000,610140000,620180000,610500000,619720000,602380000,614880000,609730000,623250000,617760000,626640000,608690000,615770000,590610000,601060000,574570000,576090000,548840000,553960000,534430000,541040000,486860000,494170000,480310000,487460000,479480000,485210000,476650000,486630000,482670000,490350000,482430000,492970000,481670000,486050000,480450000,486080000,476430000,485480000,480540000,489760000,461070000,467340000,480020000,477950000,485240000,485940000,495410000,492850000,501880000,501690000,507270000,502790000,509340000,503380000,512510000,512290000,520840000,520510000,528880000]
            }],
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
                    color: '#FF6000'
                },
                area: {
                    shadow: false
                }
            }
        });
    });
*/
$(function () { 
    $('#grafica').highcharts({
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
            text: "<?php echo date('d.m.Y') ?>"
        },
        xAxis: {
            labels: {
                    enabled: false,
                                            
                },
                title: false,
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
        tooltip: {
                hideDelay: 0,
                formatter: function() {
                    return this.series.name+' <strong>'+Highcharts.numberFormat(this.y, 0, ',', '.') + ' €</strong>';
                }
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

</script>