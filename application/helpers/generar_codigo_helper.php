<?php
function generar_codigo($len = 8){
	$clave="";
	$longitud = $len;
	for ($i=1; $i<=$longitud; $i++)
	{
		$tmp = rand(1,3);
		switch ($tmp) {
			case 1:
				$letra = chr(rand(48,57));
				break;
			case 2:
				$letra = chr(rand(65,90));
				break;
			case 3:
				$letra = chr(rand(97,122));
				break;
		}
		$clave .= $letra;
	}
	return strtoupper($clave);
}