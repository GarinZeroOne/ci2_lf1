<div id="contenBox">
	<div id=formulario_quiniela>
		<?php if ($boxes):?>
		<div id=formulario>
			Selecciona un piloto para cada puesto:
			<?php echo $this->validation->error_string; ?>
		<table>
				  <form method="post" action="<?=site_url()?>/quiniela/nueva_quiniela" >
					<tr>
					<td  width="47">1º Puesto</td>
					<td  width="46">
						<select name="uno">
						<option ></option> 
						<?php foreach ($pilotos as $linea):?>
							<option value="<? echo $linea->id;?>" >
								<? echo $linea->nombre;?>
								<? echo $linea->apellido;?>
							</option> 
						<?php endforeach;?> 
						
						</select>
					</td>
					</tr>
					<tr>
					<td width="69">2º Puesto</td>
					<td  width="46">
						<select name="dos"/>
							<option ></option>
							<?php foreach ($pilotos as $linea):?>
							<option value="<? echo $linea->id;?>" >
								<? echo $linea->nombre;?>
								<? echo $linea->apellido;?>
							</option> 
						<?php endforeach;?> 
						</select>
					</td>
					</tr>
					<tr>
					<td width="69">3º Puesto</td>
					<td  width="46">
						<select name="tres"/>
							<option ></option>
							<?php foreach ($pilotos as $linea):?>
							<option value="<? echo $linea->id;?>" >
								<? echo $linea->nombre;?>
								<? echo $linea->apellido;?>
							</option> 
							<?php endforeach;?> 
						</select>
					</td>
					</tr>
					<tr>
					<td width="69">4º Puesto</td>
					<td  width="46">
						<select name="cuatro"/>
							<option ></option>
							<?php foreach ($pilotos as $linea):?>
							<option value="<? echo $linea->id;?>" >
								<? echo $linea->nombre;?>
								<? echo $linea->apellido;?>
							</option> 
							<?php endforeach;?> 
						</select>
					</td>
					</tr>
					<tr>
					<td width="69">5º Puesto</td>
					<td  width="46">
						<select name="cinco"/>
							<option ></option>
							<?php foreach ($pilotos as $linea):?>
							<option value="<? echo $linea->id;?>" >
								<? echo $linea->nombre;?>
								<? echo $linea->apellido;?>
							</option> 
							<?php endforeach;?> 
						</select>
					</td>
					</tr>
					<tr>
					<td width="51" colspan="2" align="center"><input type="submit" value="Comprar" /></td>
					</tr>
				</form> 
		</table>
		</div>
		<!-- BOXES CERRADOS -->
	<?php else: ?>
		<h3>Se ha cerrado el quiosco de las quinielas. Recuerda que abrimos de Lunes a Viernes!!. Debes comprar y rellenar tu quiniela durante esos dias. ¡Suerte!</h3>
	<?php endif;?>
	</div>
	
</div>