<?php
if ( ! function_exists('es_dinero'))
{
	function es_dinero($cantidad)
	{
		return number_format($cantidad, 0, ",", ".");
	}	
}
?>
