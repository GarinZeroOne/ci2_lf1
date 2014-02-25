<div id=menuv>
	<div id=saldo><img src="<?=base_url()?>imgs/money.png" /> <span><?php echo $saldo;?> €</span> </div>
	<h2>Gestion</h2>
	<ul>
		<li><?php echo anchor('boxes/fichar_pilotos','Fichar pilotos') ?></li>
		<li><?php echo  anchor('boxes/mis_pilotos','Mis pilotos') ?></li>
		<li><?php echo  anchor('boxes/fichar_equipos','Fichar equipos') ?></li>
		<li><?php echo  anchor('boxes/mis_equipos','Mis equipos') ?></li>
		<li><?php echo  anchor('boxes/stikis','Stikis') ?></li>
	</ul>
	<h2>Gana dinero</h2>
	<ul>
		<li>
			<li><?php echo  anchor('grupos/grupos_entrada','Grupos') ?></li>
			<li><?php echo  anchor('boxes/quiniela','Quiniela') ?></li>
			<li><?php echo  anchor('boxes/apuestas','Apuestas') ?></li>
			<li><?php echo  anchor('boxes/loteria','Loteria') ?></li>
		</li>
	</ul>
	<h2>Configuracion</h2>
	<ul>
		<li><?php echo  anchor('boxes/datos_personales','Datos personales') ?></li>
	</ul>
</div>

<div id=contenBox>
	<?php if ($boxes):?>
	<div align=center id="numeros">
		<h3>Selecciona los numeros que deseas comprar :</h3>
		<form method="post" action="<?=site_url()?>/boxes/loteria_guardar">
		<?php
		for($i=1;$i<101;$i++)
		{?>
			<input  class="num" type="checkbox" name="numero[]" value="<?=$i?>"> <?=$i?>	
		<?
		}
		?>
		
	</div>
	<div align=center>
		<input type="submit" value="comprar">
		</form>
	</div>
	<div id="seleccionados">
		
	</div>
	<div id="precioLoteria">
		
	</div>
	
	<!-- BOXES CERRADOS -->
	<?php else: ?>
		<h3>Se ha cerrado el quiosco de la loteria. Recuerda que abrimos de Lunes a Viernes!!. Debes comprar y rellenar tu quiniela durante esos dias. ¡Suerte!</h3>
	<?php endif;?>
</div>