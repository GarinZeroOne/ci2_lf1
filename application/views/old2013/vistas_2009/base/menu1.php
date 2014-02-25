<body>
<div align="center" id="contenedor_web">
	<div id="cabecera">
		
	</div>
	
	<?php 
	if( $_SESSION['id_usuario']):
	?>
		<div id="menu">
			<ul class="kwicks">
			
			     <li id="kwick1"><? echo anchor('/inicio','Inicio');?></li>
			     <li id="kwick2"><? echo anchor('/ranking/general','Ranking General');?> </li>
			     <li id="kwick3"><? echo anchor('/ranking/gp','Ranking GP');?> </li>
			     <li id="kwick4"><? echo anchor('/boxes','Boxes');?></li>
				 <li id="kwick5"><? echo anchor('/calendario','Calendario');?> </li>
			     <li id="kwick6"><? echo anchor('/inicio/reglas','Reglas');?></li>
			     <li id="kwick7"><? echo anchor('http://www.oigan.es/index.php#4','Foro');?></li>
			     <li id="kwick8"><? echo anchor('/inicio/logout','Salir');?> </li>
	 		</ul>
		</div>
		
	<?php
	else:	
	?>
		<div id="menu">
			<div class="boton_menu">
				<? echo anchor('/inicio','Inicio');?>
			</div>
			<div class="boton_menu">
				<? echo anchor('/alta','Date de alta');?> 
			</div>
			<div class="boton_menu">
				<? echo anchor('/inicio/reglas','Reglas');?> 
			</div>
			<div class="boton_menu">
				<? echo anchor('/inicio/login','Login');?> 
			</div>
		</div>
	<?php
	endif;
	?>
	<div id=submenu>
	</div>
	<div id="cuerpo">