<div id="mainAdmin">
	<h3>ADMINISTRADOR</h3>
	
	<form method="post" action="<?=site_url()?>admin/guardar_datos_gp">
		
	<table>
		<tr>
			<td>Sel.Circuito:</td>
			<td>
				<select name="circuito">
					<?php foreach($circuitos as $gp):?>
						<option value="<?=$gp->id?>"> <?=$gp->circuito." (".$gp->pais.")";?></option>
					<? endforeach;?>
					
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Poleman :</td>
			<td>
				<select name="poleman">
					<option value=""></option>
					<?php foreach($pilotos as $piloto):?>
						<option value="<?=$piloto->id?>"> <?=$piloto->nombre." ".$piloto->apellido." (".$piloto->escuderia.")";?></option>
					<? endforeach;?>
				</select>
			</td>
		</tr>
		<tr><td colspan="2"> <hr></td></tr>
		<tr>
			<td>Primero :</td>
			<td>
				<select name="primero">
					<option value=""></option>
					<?php foreach($pilotos as $piloto):?>
						<option value="<?=$piloto->id?>"> <?=$piloto->nombre." ".$piloto->apellido." (".$piloto->escuderia.")";?></option>
					<? endforeach;?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Segundo :</td>
			<td>
				<select name="segundo">
					<option value=""></option>
					<?php foreach($pilotos as $piloto):?>
						<option value="<?=$piloto->id?>"> <?=$piloto->nombre." ".$piloto->apellido." (".$piloto->escuderia.")";?></option>
					<? endforeach;?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Tercero :</td>
			<td>
				<select name="tercero">
					<option value=""></option>
					<?php foreach($pilotos as $piloto):?>
						<option value="<?=$piloto->id?>"> <?=$piloto->nombre." ".$piloto->apellido." (".$piloto->escuderia.")";?></option>
					<? endforeach;?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Cuarto :</td>
			<td>
				<select name="cuarto">
					<option value=""></option>
					<?php foreach($pilotos as $piloto):?>
						<option value="<?=$piloto->id?>"> <?=$piloto->nombre." ".$piloto->apellido." (".$piloto->escuderia.")";?></option>
					<? endforeach;?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Quinto :</td>
			<td>
				<select name="quinto">
					<option value=""></option>
					<?php foreach($pilotos as $piloto):?>
						<option value="<?=$piloto->id?>"> <?=$piloto->nombre." ".$piloto->apellido." (".$piloto->escuderia.")";?></option>
					<? endforeach;?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Sexto :</td>
			<td>
				<select name="sexto">
					<option value=""></option>
					<?php foreach($pilotos as $piloto):?>
						<option value="<?=$piloto->id?>"> <?=$piloto->nombre." ".$piloto->apellido." (".$piloto->escuderia.")";?></option>
					<? endforeach;?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Septimo :</td>
			<td>
				<select name="septimo">
					<option value=""></option>
					<?php foreach($pilotos as $piloto):?>
						<option value="<?=$piloto->id?>"> <?=$piloto->nombre." ".$piloto->apellido." (".$piloto->escuderia.")";?></option>
					<? endforeach;?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Octavo :</td>
			<td>
				<select name="octavo">
					<option value=""></option>
					<?php foreach($pilotos as $piloto):?>
						<option value="<?=$piloto->id?>"> <?=$piloto->nombre." ".$piloto->apellido." (".$piloto->escuderia.")";?></option>
					<? endforeach;?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Noveno :</td>
			<td>
				<select name="noveno">
					<option value=""></option>
					<?php foreach($pilotos as $piloto):?>
						<option value="<?=$piloto->id?>"> <?=$piloto->nombre." ".$piloto->apellido." (".$piloto->escuderia.")";?></option>
					<? endforeach;?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Decimo :</td>
			<td>
				<select name="decimo">
					<option value=""></option>
					<?php foreach($pilotos as $piloto):?>
						<option value="<?=$piloto->id?>"> <?=$piloto->nombre." ".$piloto->apellido." (".$piloto->escuderia.")";?></option>
					<? endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"> <input type="submit" value="Guardar resultados"></td>
		</tr>
	</table>
	
	</form>
	
	
	
</div>
