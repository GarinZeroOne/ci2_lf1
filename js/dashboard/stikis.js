function aumentarPorcentaje() {
	var valorPorc = $('#porcentajeField').val();
	valorPorc = parseInt(valorPorc) + 10;
	alert(valorPorc);
}

function disminuirPorcentaje() {
	var valorPorc = $('#porcentajeField').val();
	valorPorc = parseInt(valorPorc) - 10;
	alert(valorPorc);
}

$(document).ready(function() {
	$('#aumentarPorc').click(aumentarPorcentaje);
	$('#disminuirPorc').click(disminuirPorcentaje);
})