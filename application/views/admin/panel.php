<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
		<title>Panel de Administracion</title>
		
		<STYLE type="text/css">
		 table
		 {
		 	width:    400px;
			background-color:	#afab8f;
		 }
		 table th
		 {
			background-color:	#000000;
			color:				#c0c0c0;
		 }
		 table tr td
		 {
		 	border: 1px solid;
			padding: 2px;
			text-align:center;
		 }
		 
		 form table tr td select
		 {
		 	width:		40px;
		 }
		 
		 .apuesta
		 {
		 	padding:		3px;
			margin-top:		4px;
			border:			1px solid;
			background-color:	#ffaeff;
			
		 }
		 .apuesta span
		 {
		 	display:			block;
			background-color:	#c0c0c0;
			color:			    #000000;
			
		 }
		 .apuesta b
		 {
		 	font-size:			20px;
		 }
		 </STYLE>
	</head>
	<body>
		
		<h2>Panel Administracion (v0.422)</h2>
		
		<table>
			<tr>
				<td> Usuarios Registrados:</td>
				<td><?=$usuarios_registrados;?></td>
			</tr>
			<tr>
				<td>Gp a Procesar:</td>
				<td><?=$gp?></td>
			</tr>
		</table>
		
		<h2>Buscar apuestas sospechosas</h2>
		<? foreach( $info_apuestas as $apuesta): ?>
		<div class="apuesta">
			
			<?=$apuesta['textoApuesta'];?> , <b><?=$apuesta['nickReceptor'];?></b> acepta!. Id apuesta: <?=$apuesta['id_apuesta'];?>
			<span>
				<?=$apuesta['nickEmisor'];?> es de <?=$apuesta['ubicacion_emisor'];?> registrado en <?=$apuesta['alta_emisor'];?> con ip <?=$apuesta['ip_emisor'];?>
			</span>
			<span>
				<?=$apuesta['nickReceptor'];?> es de <?=$apuesta['ubicacion_receptor'];?> registrado en <?=$apuesta['alta_receptor'];?> con ip <?=$apuesta['ip_receptor'];?>
			</span>
			
		</div>
		<? endforeach;?>
		
		
		<h3>1º - Introduce los resultados del GP </h3>
		<p> <a href="http://www.thef1.com" target="_blank">Ver resultados Online en TheF1.com</a></a></p>
		<div>
			<? if ($resultados_metidos):?>
				<span>Los resultados de los pilotos y equipos YA ESTAN INTRODUCIDOS.</span>
			<? else: ?>
				<?=$formulario_resultados;?>
			<?endif;?>
		</div>
		
		<h3>2º - Haz una copia de la base de datos, por si algo peta y mandala al correo de gestionlf1@gmail.com. **** NO SALTARSE ESTE PASO NUNCA!!! **</h3>
		<h3>3º - Ejecutar el SCRIPT y seguir los pasos hasta que salga el mensaje. 'TODOS LOS DATOS ACTUALIZADOS'</h3>
		<h3> <?=$link_pole?></h3>
	</body>
</html>