function modificarPorcentaje(){
	var valorPorc = $('#porcentaje').val();
	$('#valorPorcentaje').empty();
	$('#valorPorcentaje').append(valorPorc+"%");
	
	

	if( $('input[name=tipoStiki]:checked').val() == 'dinero')
	{
		var mjdinero = parseInt($('#mj-dinero').attr('data-val'));
		var p = (valorPorc/100) * mjdinero;
		//alert(p);
		$('#calc-dinero-sd').text('( '+p+' €)');
		$('#calc-dinero-sp').text('');	
	}
	else
	{
		var mjpuntos = parseInt($('#mj-puntos').attr('data-val'));
		var p = (valorPorc/100) * mjpuntos;
		//alert(p);
		$('#calc-dinero-sp').text('( '+p+' €)');	
		$('#calc-dinero-sd').text('');
	}
}

$(document).ready(function() {
})