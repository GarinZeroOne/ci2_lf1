
<div id="formulario_alta">
	<div id=formulario>
		Rellene el siguiente formulario para darse de alta en Ligaformula1.com y poder participar en la liga.
		<br><br>
		<span>
		<?php echo $this->validation->error_string; ?>
		</span>
		<table>
				<form method="post" action="<?=site_url()?>/alta/nuevo_usuario">
					<tr>
					<td  width="47">Nick:</td>
					<td  width="46"><input type="text" name="usuario" /></td>
					</tr>
					<tr>
					<td width="69">Password:</td>
					<td  width="46"><input type="password" name="passwd"/></td>
					</tr>
					<td width="69">Confirmar password:</td>
					<td  width="46"><input type="password" name="passconf"/></td>
					</tr>
					<td width="69">Email:</td>
					<td  width="46"><input type="text" name="email"/></td>
					</tr>
					<tr>
					<td width="51" colspan="2" align="center"><input type="submit" value="Crear" /></td>
					</tr>
				</form>
		</table>
	</div>
</div>
	