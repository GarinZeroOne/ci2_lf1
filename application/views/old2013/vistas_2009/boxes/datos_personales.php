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
	
	<div id="avatar">
		<h3>Cambiar mi avatar:</h3>
		<div id="imgAvatar">
			<span>
				<img width=90 src="<?=$avatar?>"/>
			</span>
		</div>
		<div id="frmAvatar">
			<?php echo $error;?>

			<fieldset>
				<legend><b>Subir imagen</b></legend>
				<form action="<?=site_url()?>/boxes/datos_personales/subir" method="post" enctype="multipart/form-data">
					<label>Imagen</label>
			        <input type="file" name="userfile" id="userfile" />
			        <br />
			        <label></label>
			        <input type="submit" value="Subir" />
				</form>
			</fieldset>
		</div>
	</div>
	
</div>