<div id=ranking_gp>
	<h3>Resultado GP 
	<br><? echo $GP->circuito.' ('.$GP->pais.')';?></h3>
		
	
	<table>
		<th>#</th><th>Usuario</th><th>Puntos</th>
		<?php
		 $i = 1;
		 foreach($ranking_gp as $linea):?>
		 	<? if(strtolower($_SESSION['usuario'])==strtolower($linea['usuario'])): ?>
				<tr>
					<td><?=$i?>º</td>
					<td><b style="color:#ff0000;"><?echo $linea['usuario']?></b></td>
					<td><? echo $linea['puntosPiloto']?> <? if($linea['puntosStikis']){echo "+".$linea['puntosStikis'];} ?></td>
					<?php $i++; ?>
				</tr>
			<? else: ?>
				<tr>
					<td><?=$i?>º</td>
					<td><?=$linea['usuario']?></td>
					<td><?=$linea['puntosPiloto']?>  <? if($linea['puntosStikis']){echo "+".$linea['puntosStikis'];} ?></td>
					<?php $i++; ?>
				</tr>
			<? endif;?>
		<?php endforeach; ?>
	</table>
	
</div>
<div id="clasificacion_gp">
	<h2>Clasificacion Pilotos
	<br><? echo $GP->circuito.' ('.$GP->pais.')';?></h2>	
	<table id="tabla_pilotos">
		<th>#</th><th>Piloto</th><th>Puntos</th>
		<?php
		 $i = 1;
		 foreach($pilotos as $linea):?>
				<tr>
					<td><?=$i?>º</td>
					<td><? echo $linea['nombrePiloto']?></td>
					<td><? echo $linea['puntosPiloto']?> </td>
					<?php $i++; ?>
				</tr>
		<?php endforeach; ?>
	</table>
</div>
	
