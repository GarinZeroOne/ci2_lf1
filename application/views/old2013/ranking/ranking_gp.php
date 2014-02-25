<!-- <div id="ranking" align="center">-->

	<?php
	/*
	<!--  ADVERTISEMENT TAG 728 x 90, DO NOT MODIFY THIS CODE -->
	<script type="text/javascript" src="http://performance-by.simply.com/simply.js?code=25639;3;0&amp;v=2"></script>
	<script type="text/javascript">
	<!--
	document.write('<iframe marginheight="0px" marginwidth="0px" frameborder="0" scrolling="no" width="728" height="90" src="http://optimized-by.simply.com/play.html?code=119589;25503;26987;0&from='+escape(document.referrer)+'"></iframe>');
	// -->
	</script>
	*/
	?>
	<!--
	<a href="http://www.playtheguru.com/beta911/es/circuit.php?id_circuit=5">
      <img src="<?php echo base_url();?>/img/banners/playtheguru_a.png" alt="Gana premios con PlaytheGuru.com"/>
    </a>
	-->

<div id="topgeneral" class="row">

	<div class="ads" style="margin-top:0px;margin-bottom:10px;">

        <script type="text/javascript"><!--
        google_ad_client = "ca-pub-2361705659034560";
        /* Box_horizontal */
        google_ad_slot = "1297942735";
        google_ad_width = 728;
        google_ad_height = 90;
        //-->
        </script>
        <script type="text/javascript"
        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>

      </div>


	<h1 class="rankingh"><?php echo $this->lang->line('ran_ranking_gp'); ?>
	<br><? echo $datosGP->circuito.' ('.$datosGP->pais.')';?></h1>
	<table class="table table-striped table-bordered">
		<?php
		//Si estoy logeado, primero muestro mi posicion
		 if($_SESSION && $miPosicion->puesto_gp):?>
		 	<tr>
				<td class="posicion"><? echo $miPosicion->puesto_gp; ?>º</td>
				<td class="cavat"><img class="avatar" src= "<?=base_url()?>img/avatares/<? echo $miPosicion->avatar; ?>" /></td>
				<td class="nick"><b style="color:#ff0000;"><? echo anchor('/usuarios/perfil/'.$miPosicion->nick,$miPosicion->nick);?></b></td>
				<td class="puntos"><? echo $miPosicion->puntos_manager_gp;?></td>
			</tr>
		<?php else: ?>
			<tr><td colspan="4"> Datos del gran premio aún sin actualizar...</td></tr>
		 <? endif;?>
		<th>#</th><th><?php echo $this->lang->line('ran_avatar');?></th><th><?php echo $this->lang->line('ran_usuario');?></th><th><?php echo $this->lang->line('ran_puntos');?></th>

		<?php
		 foreach($rankingGp as $linea):?>
		 	<? if(strtolower($_SESSION['usuario']) == strtolower($linea->nick)): ?>
				<tr>
					<td class="posicion"><?=$linea->puesto_gp?>º</td>
					<td><img class="avatar" src= "<?=base_url()?>img/avatares/<? echo $linea->avatar; ?>" /></td>
					<td class="nick"><b style="color:#ff0000;"><? echo anchor('/usuarios/perfil/'.$linea->nick,$linea->nick);?></b></td>
					<td class="puntos"><? echo $linea->puntos_manager_gp;?> </td>
				</tr>
			<? else: ?>
				<tr>
					<td class="posicion"><?=$linea->puesto_gp?>º</td>
					<td><img class="avatar" src="<?=base_url()?>img/avatares/<? echo $linea->avatar; ?>" /></td>
                                        <td class="nick"><? echo anchor('/usuarios/perfil/'.$linea->nick,$linea->nick);?></td>
					<td class="puntos"><?=$linea->puntos_manager_gp?></td>
				</tr>
			<? endif;?>
		<?php endforeach; ?>

	</table>
</div>



<!--<div id="enlaces">
	<?php
		$sitio = site_url();
		for ($i=0;$i<=$numEnlaces;$i++){
			$numeroMostrar = $i + 1;
			if($i==$enlaceActual){
				echo "<b style=\"color:#ff0000;\">";
				echo "<a onclick=\"doAjax('".$sitio."ranking/clasificacionGp','numEnlace=".$i."',
												  'clasificacionGp','post',1)\">".$numeroMostrar."</a>";
				echo "</b>";
			}
			else{
				echo "<a onclick=\"doAjax('".$sitio."ranking/clasificacionGp','numEnlace=".$i."',
												  'clasificacionGp','post',1)\">".$numeroMostrar."</a>";
			}
			if($numeroMostrar != $numEnlaces+1){
				echo "-";
			}
		}
	?>


<div id="clasificacion_gp">
	<h3>Clasificacion Pilotos
	<br><? echo $datosGP->circuito.' ('.$datosGP->pais.')';?></h3>
	<table id="tabla_pilotos">
		<th>#</th><th>Piloto</th><th>Puntos</th>
		<?php
		 $i = 1;
		 foreach($pilotos as $linea):?>
				<tr>
					<td><?=$i?>º</td>
					<td class="nick"><? echo $linea['nombrePiloto']?></td>
					<td><? echo $linea['puntosPiloto']?> </td>
					<?php $i++; ?>
				</tr>
		<?php endforeach; ?>
	</table>
</div>
	</div>-->
