
<script src="yshout/js/yshout.js" type="text/javascript"></script>
<link rel="stylesheet" href="yshout/example/css/dark.yshout.css" />
<script type="text/javascript">
   new YShout({
      yPath: 'http://www.ligaformula1.com/yshout/'
   });
</script>

<div id="yshout"></div>

<div id=noticias>
	
	<div>
	
	</div>
	
	<div align="center" id=cabecera_portada>
		<img src="<?=base_url()?>/imgs/podio_final.png" border="0" />
	</div>
	
	<div id=novedades>
		
		<?php
		foreach($noticias as $noticia):
		?>
		<div id=titulo><?=$noticia->titulo;?><span><?=$noticia->fecha?></span></div>
		
		<div id=contenido><?=$noticia->cuerpo?></div>
		
		<?php
		endforeach;
		?>
	</div>
	
</div>
<div id=destacados>
	<?php if(isset($_SESSION['usuario'])): ?>
		Logeado como <span> <?=$_SESSION['usuario'];?> </span> <br><br>
	<?endif;?>	
    
	Proximo Gran Premio<br>
<div id=cartel>
	<script>

	//cambia este texto para indicar el acontecimiento que desees
	var before="<span>el GP de  <?php echo $paisGP;?></span>"
	var current="Hoy GP de <?php echo $paisGP;?>. ¡Suerte!"
	var montharray=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")
	
	function countdown(yr,m,d){
	var today=new Date()
	var todayy=today.getYear()
	if (todayy < 1000)
	todayy+=1900
	var todaym=today.getMonth()
	var todayd=today.getDate()
	var todaystring=montharray[todaym]+" "+todayd+", "+todayy
	var futurestring=montharray[m-1]+" "+d+", "+yr
	var difference=(Math.round((Date.parse(futurestring)-Date.parse(todaystring))/(24*60*60*1000))*1)
	if (difference==0)
	document.write(current)
	else if (difference>0)
	document.write("<b style='font-size:14px;color:#ffffff;'><span>Quedan</span> "+difference+"  días <span> para </span>"+before+"</b>")
	}
	//usa la fecha del evento que quieres señalar en el formato año/mes/día
	countdown("<?=$anioGP?>","<?=$mesGP?>","<?=$diaGP?>")
	</script>
</div>

<div id=stats>
	<span>Pilotos comprados:</span> <?=$pilotosComprados;?><br>
	<span>Pilotos vendidos:</span> <?=$pilotosVendidos;?><br>
	<span>Equipos comprados:</span> <?=$equiposComprados;?><br>
	<span>Equipos vendidos:</span> <?=$equiposVendidos;?><br> <br>
	<span> nº STIKIS <?=$paisGP?></span><br>
	<span><img src="./imgs/stikidinero.jpg" /> :</span> <?=$stikisDineroComprados;?><br>
	<span><img src="./imgs/stikipuntos.jpg" /> :</span> <?=$stikisPuntosComprados;?><br>
</div>

</div>
	