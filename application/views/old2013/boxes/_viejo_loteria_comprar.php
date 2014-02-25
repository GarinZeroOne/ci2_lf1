<div id=contenBox>
	<?php if ($boxes):?>
	<div align=center id="numeros">
		<h3>Selecciona los numeros que deseas comprar :</h3>
		<form method="post" action="<?=site_url()?>/boxes/loteria_guardar">
			<table><tr>
		<?php
		for($i=1;$i<201;$i++)
		{?>
			<? if($i%10 == 0):?>
				</tr><tr> <td><input  class="num" type="checkbox" name="numero[]" value="<?=$i?>"> <?=$i?> </td>	
			<? else:?>
				<td><input  class="num" type="checkbox" name="numero[]" value="<?=$i?>"> <?=$i?></td>	
			<? endif;?>
		<?
		}
		?>
		</table>
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