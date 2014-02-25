<!-- Menu Vertical -->
			<div id="menuV">
				
				<div id="panelFondos">
				<b><?=$saldo?> €</b>
					
				</div>
				
								
				<div id="panelTiempoGp">
					<script>
						function calcula(anio,mes,dia)
						{
						var montharray=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")
						 hoy = new Date()
						 hasta = new Date(montharray[mes-1]+" "+ (dia-1) +","+anio+" 00:00") // Cambiar aquí el valor de la fecha y hora elegida.
						 DD = (hasta - hoy) / 86400000
						 
						 hh = (DD - Math.floor(DD)) * 24
						 mm = (hh - Math.floor(hh)) * 60
						 ss = (mm - Math.floor(mm)) * 60
						 document.getElementById('hora').innerHTML ="<div id='countDown'><span>" +  Math.floor(DD) + "</span>D, <span>" + Math.floor(hh) + "</span>H, <span>" + Math.floor(mm) + "</span>min <span> " + Math.floor(ss) + "</span>seg. "+"</div>"
						 if (hasta < hoy)
						 {
						  document.getElementById('hora').innerHTML = "Fin de semana de GP"
						  cleartimeout(tictac)
						 }
						 else tictac = setTimeout("calcula("+anio+","+mes+","+dia+")",1000)
						}
					</script> 
					<span>Proximo Gran Premio: <?php echo $paisGP;?></span>
					<span id="hora"><script>calcula("<?=$anioGP?>","<?=$mesGP?>","<?=$diaGP?>")</script></span>
					<span id="msgInfo"> Se cerraran los boxes al terminar la cuenta atras.</span>
				</div>
				
				<div id="panelGestion">
					<h1><img src="<?=site_url()?>/img/gestion_icon.png"></h1>
						<ul>
							<li><?php echo 	anchor('mi_oficina','Mi oficina') ?></li>
							<li><?php echo 	anchor('boxes/fichar_pilotos','Fichar pilotos') ?></li>
							<li><?php echo  anchor('boxes/mis_pilotos','Mis pilotos') ?></li>
							<li><?php echo  anchor('boxes/fichar_equipos','Fichar equipos') ?></li>
							<li><?php echo  anchor('boxes/mis_equipos','Mis equipos') ?></li>
							<li><?php echo  anchor('boxes/stikis','Stikis') ?></li>
							<li><?php echo  anchor('grupos/grupos_general','Grupos') ?></li>
							<li><?php echo  anchor('boxes/mi_perfil','Mi perfil') ?></li>
						</ul>
					
					
				</div>
				
				
				<div id="panelDinero">
					
						<h1><img src="<?=site_url()?>/img/apuestas_icon.png"></h1>
						<ul>
							<li>
								<li><?php echo  anchor('apuestas','Zona apuestas') ?></li>
							</li>
						</ul>
				</div>
				
				<!--  ADVERTISEMENT TAG 234 x 60, DO NOT MODIFY THIS CODE -->
				<script type="text/javascript" src="http://performance-by.simply.com/simply.js?code=25639;3;0&amp;v=2"></script>
				<script type="text/javascript">
				<!--
				document.write('<iframe marginheight="0px" marginwidth="0px" frameborder="0" scrolling="no" width="234" height="60" src="http://optimized-by.simply.com/play.html?code=70287;25503;26987;0&amp;from='+escape(document.referrer)+'"></iframe>');
				// -->
				</script>
					
			</div>
			
			<!-- Fin Menu Vertical -->
			
			<!--  ADVERTISEMENT TAG 468 x 60, DO NOT MODIFY THIS CODE -->
			<script type="text/javascript" src="http://performance-by.simply.com/simply.js?code=25639;3;0&amp;v=2"></script>
			<script type="text/javascript">
			<!--
			document.write('<iframe marginheight="0px" marginwidth="0px" frameborder="0" scrolling="no" width="468" height="60" src="http://optimized-by.simply.com/play.html?code=67193;25503;26987;0&amp;from='+escape(document.referrer)+'"></iframe>');
			// -->
			</script>


			
			
			<!-- Zona Contenidos -->
			<div id="zonaContenidos">
				
				<!-- Bloke Contenidos-->
				<div id="blokeContenidos">