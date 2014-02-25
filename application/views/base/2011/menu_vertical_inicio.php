<!-- Menu Vertical -->
			<div id="menuV">
				
				<div id="panelPodcast">
					<span>Resumen GP Monaco</span>
					<object width="190" height="24" type="application/x-shockwave-flash" name="audioplayer_1" style="outline: none" data="http://www.desdeboxespodcast.com/wp-content/plugins/audio-player/assets/player.swf?ver=2.0.4.1" id="audioplayer_1"><param name="bgcolor" value="#FFFFFF"><param name="wmode" value="transparent"><param name="menu" value="false"><param name="flashvars" value="animation=yes&amp;encode=yes&amp;initialvolume=100&amp;remaining=yes&amp;noinfo=yes&amp;buffer=5&amp;checkpolicy=no&amp;rtl=no&amp;bg=e5102f&amp;text=ffffff&amp;leftbg=050505&amp;lefticon=ffffff&amp;volslider=ffffff&amp;voltrack=666666&amp;rightbg=000000&amp;rightbghover=e5102f&amp;righticon=ffffff&amp;righticonhover=CCCCCC&amp;track=992626&amp;loader=000000&amp;border=9c2b2b&amp;tracker=000000&amp;skip=ffffff&amp;soundFile=aHR0cDovL3d3dy5pdm9veC5jb20vZGVzZGUtYm94ZXMtcG9kY2FzdC0yMDExLTg0LXJlc3VtZW4tZ3AtbW9uYWNvX21kXzY3NTI0M18xLm1wMw&amp;playerID=audioplayer_1"></object>
					<a href="http://www.desdeboxespodcast.com/" target="_blank"><img title="Desde boxes podcast" border="0" src="<?=site_url()?>/img/dsdboxes.jpg" /></a>
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
					<span>Proximo GP: <?php echo $paisGP;?></span>
					<span id="hora"><script>calcula("<?=$anioGP?>","<?=$mesGP?>","<?=$diaGP?>")</script></span>
					<span id="msgInfo"> Se cerraran los boxes al terminar la cuenta atras.</span>
				</div>
				
				<div id="panelPremios">
					<img src="<?php echo base_url().'img/premiolf1.jpg'; ?>" />
				</div>

				<div id="panelUltimosPosts">
						<h1> Ultimos Posts </h1>
						<ul>
						<? foreach($lastPost as $post):?>
							<li><?=anchor(site_url()."/foro/ver/".$post->id, substr($post->titulo,0,25) )."... <span>por ".$post->autor."</span>";?></li>
						<? endforeach;?>
						</ul>
				</div>
				
				
				<!--  ADVERTISEMENT TAG 200 x 200, DO NOT MODIFY THIS CODE -->
				<script type="text/javascript" src="http://performance-by.simply.com/simply.js?code=25639;3;0&amp;v=2"></script>
				<script type="text/javascript">
				<!--
				document.write('<iframe marginheight="0px" marginwidth="0px" frameborder="0" scrolling="no" width="200" height="200" src="http://optimized-by.simply.com/play.html?code=67195;25503;26987;0&amp;from='+escape(document.referrer)+'"></iframe>');
				// -->
				</script>
				
				
				
				<div id="panelEstadisticas">
					<? if ( $estadisticas ):?>
					<h1> Estadisticas </h1>
					<table>
						<tr>
							<td>Pilotos comprados:</td> <td> <span><?=$pilotosComprados;?></span> </td>
						</tr>
						<tr>
							<td> Pilotos vendidos: </td> <td> <span><?=$pilotosVendidos;?> </span></td>
						</tr>
						<tr>
							<td> Equipos comprados:</td> <td><span> <?=$equiposComprados;?></span></td>
						</tr>
						<tr>
							<td> Equipos vendidos:</td> <td><span> <?=$equiposVendidos;?></span></td>
						</tr>
						<tr>
							<td colspan="2"> Nº Stikis: <?=$paisGP?></td> 
						</tr>
						<tr>
							<td> <img src="<?=site_url()?>/img/stikidinero.png" /> </td><td> <?=$stikisDineroComprados;?> </td>
						</tr>
						<tr>
							<td> <img src="<?=site_url()?>/img/stikipuntos.png" /> </td><td> <?=$stikisPuntosComprados;?> </td>
						</tr>
					</table>
					<? else:?>
						<h1>Gestion</h1>
						<ul>
							<li><?php echo 	anchor('boxes/fichar_pilotos','Fichar pilotos') ?></li>
							<li><?php echo  anchor('boxes/mis_pilotos','Mis pilotos') ?></li>
							<li><?php echo  anchor('boxes/fichar_equipos','Fichar equipos') ?></li>
							<li><?php echo  anchor('boxes/mis_equipos','Mis equipos') ?></li>
							<li><?php echo  anchor('boxes/stikis','Stikis') ?></li>
							<li><?php echo  anchor('grupos/grupos_entrada','Grupos') ?></li>
							<li><?php echo  anchor('boxes/datos_personales','Datos personales') ?></li>
						</ul>
					<? endif;?>
					
				</div>
				
				<div style="margin-top:10px;">
				<!--  ADVERTISEMENT TAG 234 x 60, DO NOT MODIFY THIS CODE -->
				<script type="text/javascript" src="http://performance-by.simply.com/simply.js?code=25639;3;0&amp;v=2"></script>
				<script type="text/javascript">
				<!--
				document.write('<iframe marginheight="0px" marginwidth="0px" frameborder="0" scrolling="no" width="234" height="60" src="http://optimized-by.simply.com/play.html?code=70287;25503;26987;0&amp;from='+escape(document.referrer)+'"></iframe>');
				// -->
				</script>
				</div>
				
					
			</div>
			<!-- Fin Menu Vertical -->
			
			<!--  ADVERTISEMENT TAG 468 x 60, DO NOT MODIFY THIS CODE -->
			<script type="text/javascript" src="http://performance-by.simply.com/simply.js?code=25639;3;0&amp;v=2"></script>
			<script type="text/javascript">
			<!--
			document.write('<iframe marginheight="0px" marginwidth="0px" frameborder="0" scrolling="no" width="468" height="60" src="http://optimized-by.simply.com/play.html?code=74155;25503;26987;0&amp;from='+escape(document.referrer)+'"></iframe>');
			// -->
			</script>

			
			<!-- Zona Contenidos -->
			<div id="zonaContenidos">
				
				<!-- Bloke Contenidos-->
				<div id="blokeContenidos">