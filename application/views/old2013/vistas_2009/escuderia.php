<div id="formulario_escuderia">
	<div id="formulario">
		<? echo $msgtxt; ?>
		<br><br>
		<span>
		<?php echo $this->validation->error_string; ?>
		</span>
		<? if (!$alta): ?>
		<table>
				<form method="post" action="<?=site_url()?>/escuderia">
					<tr>
					<td  width="47">Piloto 1</td>
					<td>
						<select type="text" name="piloto1" />
						<? foreach ($pilotos as $linea):?>
						<option value="<? echo $linea->id;?>" ><? echo $linea->nombre;echo " "; echo $linea->apellido;?></option>
						<? endforeach;?>
						</select>
					</td>
					</tr>
					<td width="69">Piloto 2</td>
					<td>
						<select type="text" name="piloto2" />
						<? foreach ($pilotos as $linea):?>
						<option value="<? echo $linea->id;?>" ><? echo $linea->nombre;echo " "; echo $linea->apellido;?></option>
						<? endforeach;?>
						</select>
					</td>
					</tr>
					<tr>
					<td width="51" colspan="2" align="center"><input type="submit" value="Crear" /></td>
					</tr>
				</form>
		</table>
		<? endif ;?>
	</div>
</div>