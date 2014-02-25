
<div id="loginform">
	<div id=login>
		<?php echo $msgError;?>
		<form method="post" action="<?php echo site_url()?>/inicio/login/">
			<table>
				<tr>
					<td>
						Usuario
					</td>
					<td>
						<input type=text name=usuario>
					</td>
				</tr>
				<tr>
					<td>Passwd</td>
					<td><input type=password name=passwd></td>
				</tr>
				<tr>
					<td colspan=2 align=center><input type=submit value=Entrar></td>
				</tr>
			</table>
		</form>
	</div>
</div>
	