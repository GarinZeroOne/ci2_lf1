<div id=ranking>
	<h3>General Usuarios </h3>
	<table>
		<th>#</th><th>Avatar</th><th>Usuario</th><th>Puntos</th>
		<?php
		 $i = 1;
		 foreach($ranking as $linea):?>
		 <? if(strtolower($_SESSION['usuario'])==strtolower($linea->nick)): ?>
			<tr>
				<td class="posicion"><?=$i?>º</td>
				<td><img src="http://www.ligaformula1.com/imgs/avatares/thumbs/<?=$linea->avatar?>" /></td>
				<td class="nick"><b style="color:#ff0000;"><?=$linea->nick?></b></td>
				<td class="puntos"><?=$linea->puntos?></td>
				<?php $i++; ?>
			</tr>
		<? else: ?>	
			<tr>
				<td class="posicion"><?=$i?>º</td>
				<td><img src="http://www.ligaformula1.com/imgs/avatares/thumbs/<?=$linea->avatar?>" /></td>
				<td class="nick"><?=$linea->nick?></td>
				<td class="puntos"><?=$linea->puntos?></td>
				<?php $i++; ?>
			</tr>
		<? endif;?>
		<?php endforeach; ?>
	</table>
</div>
