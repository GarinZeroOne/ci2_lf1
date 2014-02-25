


<!-- <div id="ranking" align="center">-->

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

	<h1 class="rankingh"><?php echo $this->lang->line('ran_general_usuarios');?> </h1>
	<table class="table table-striped table-bordered" >

		<?php if($miPosicion->puesto_general): ?>
		<tr>
			<td class="posicion"><? echo $miPosicion->puesto_general; ?>º</td>
			 <td class="cavat"><img class="avatar" src= "<?=base_url()?>img/avatares/<? echo $miPosicion->avatar; ?>" /></td>
			<td class="nick"><b style="color:#ff0000;"><? echo anchor('/usuarios/perfil/'.$miPosicion->nick,$miPosicion->nick); ?></b></td>
			<td class="puntos"><? echo $miPosicion->puntos;?></td>
		</tr>
		<?php else: ?>
		<tr>
			<td class="posicion">xº</td>
			 <td class="cavat"><img class="avatar" src= "<?=base_url()?>img/avatares/<? echo $miPosicion->avatar; ?>" /></td>
			<td class="nick"><b style="color:#ff0000;"><? echo anchor('/usuarios/perfil/'.$_SESSION['usuario'],$_SESSION['usuario']); ?></b> (no has clasificado todavia en ningún Gran Premio)</td>
			<td class="puntos"><? echo $miPosicion->puntos;?></td>
		</tr>

	<?php endif; ?>

		<th>#</th><th><?php echo $this->lang->line('ran_avatar');?></th><th><?php echo $this->lang->line('ran_usuario');?></th><th><?php echo $this->lang->line('ran_puntos');?></th>
		<?php

		 $i = 1;
		 foreach($ranking as $linea): ?>
		 <? if(strtolower($_SESSION['id_usuario'])==strtolower($linea->nick)): ?>
			<tr>
				<td class="posicion"><? echo $i; /*echo $linea->puesto_general;*/?>º</td>
				<td class="avatar"><img class="avatar" src="<?=base_url()?>img/avatares/<?=$linea->avatar;?>" /></td>
				<td class="nick"><b style="color:#ff0000;"><? echo anchor('/usuarios/perfil/'.$linea->nick,$linea->nick); ?></b></td>
				<td class="puntos"><? echo $linea->puntos;?></td>
				<?php $i++; ?>
			</tr>
		<? else: ?>
			<tr>
				<td class="posicion"><? echo $i; /*echo $linea->puesto_general;*/?>º</td>
				 <td class="avatar"><img class="avatar" src="<?=base_url()?>img/avatares/<?=$linea->avatar;?>" /></td>
				<td class="nick"><? echo anchor('/usuarios/perfil/'.$linea->nick,$linea->nick);?></td>
				<td class="puntos"><? echo $linea->puntos;?></td>
				<?php $i++; ?>
			</tr>
		<? endif;?>
		<?php endforeach; ?>
	</table>
</div>



<!--
<div id="enlaces">
	/*<?php
		$sitio = site_url();
		for ($i=0;$i<=$numEnlaces;$i++){
			$numeroMostrar = $i + 1;
			if($i==$enlaceActual){
				echo "<b style=\"color:#ff0000;\">";
				echo "<a onclick=\"doAjax('".$sitio."ranking/clasificacionGeneral','numEnlace=".$i."',
												  'clasificacionGeneral','post',1)\">".$numeroMostrar."</a>";
				echo "</b>";
			}
			else{
				echo "<a onclick=\"doAjax('".$sitio."ranking/clasificacionGeneral','numEnlace=".$i."',
												  'clasificacionGeneral','post',1)\">".$numeroMostrar."</a>";
			}
			if($numeroMostrar != $numEnlaces+1){
				echo "-";
			}
		}
	?>*/
</div>
-->