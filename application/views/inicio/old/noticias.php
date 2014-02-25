			
			
			<div class='tweet'></div>
			
			
			
			<?php
			foreach($noticias as $noticia):
			?>
			<div id=titulo><?=$noticia->titulo;?><span> <?=$noticia->fecha?> </span></div>
			
			<div id=contenido><?=$noticia->cuerpo?></div>
			
			<div align="center">
							<!--  ADVERTISEMENT TAG 468 x 60, DO NOT MODIFY THIS CODE -->
						<script type="text/javascript" src="http://performance-by.simply.com/simply.js?code=25639;3;0&amp;v=2"></script>
						<script type="text/javascript">
						<!--
						document.write('<iframe marginheight="0px" marginwidth="0px" frameborder="0" scrolling="no" width="468" height="60" src="http://optimized-by.simply.com/play.html?code=74155;25503;26987;0&amp;from='+escape(document.referrer)+'"></iframe>');
						// -->
						</script>
			</div>
			
			<?php
			endforeach;
			?>
			
