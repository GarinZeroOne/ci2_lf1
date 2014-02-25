/**
 * @author gorka
 */
$(document).ready(function(){
var cadena = "";
var i=0;
var precio = 0;

$('.num').click(
	function()
	{
		cadena = "";
		i = 0;
		$('.num').each(function(){
			  if ($(this).attr('checked')) 
			  {
			  	cadena = cadena + $(this).attr("value")+" | ";
				i++;
			  }
		})
		//alert(cadena);
		$('#seleccionados').text(cadena);
		precio =  i * 5000;
		$('#precioLoteria').html("Precio:<span>"+precio+"</span> €");
	}
);

})
