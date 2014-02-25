<body>
	
<div id="container" align="center">
	
	<!-- Web -->
	<div id="cont_web">
		
		<!-- Cabecera -->
		<div id="cabecera">
		</div>
		<!-- Fin Cabecera -->
		
		<!-- Menu Horinzontal-->
		<div id="menuH" align="center">
			
			
			<?php 
			if( $_SESSION['id_usuario']):
			?>
					<ul>
					
					     <li><? echo anchor('/inicio','Inicio');?></li>
					     <li><? echo anchor('/ranking/general','Ranking General');?></li>
					     <li><? echo anchor('/ranking/gp','Ranking GP');?></li>
					     <li><? echo anchor('/boxes','Boxes');?></li>
						 <li><? echo anchor('/calendario','Calendario');?> </li>
					     <li><? echo anchor('/inicio/reglas','Reglas');?></li>
					     <li><? echo anchor('/foro','Foro');?></li>
					     <li><? echo anchor('/inicio/logout','Salir');?> </li>
			 		</ul>
				
			<?php
			else:	
			?>
					<ul>
						<li><? echo anchor('/inicio','Inicio');?></li>
						<li><? echo anchor('/alta','Date de alta');?> </li>
						<li><? echo anchor('/inicio/reglas','Reglas');?> </li>
						<li><? echo anchor('/inicio/login','Login');?> </li>
					</ul>	
			<?php
			endif;
	?>
			
			
		</div>
		<!-- Fin Menu Horinzontal-->
		
		
		<!-- Contenidos -->
		<div id="contenidos">
			
			
				
			
