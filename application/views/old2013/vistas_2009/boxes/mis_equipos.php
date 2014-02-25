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
	<br>Aqui puedes ver el dinero que has conseguido tus equipos.<br>
<h3>Mis Equipos</h3>
	<div id=zonaIzq>
		<form method=post action="<?=site_url()?>/boxes/mis_equipos">
		<table cellspacing=2>
			<th></th>
			<th>Escuderia</th>
			<th>Precio Venta</th>
			<th>Dinero ganado</th>
			<?php foreach($info_equipos as $equipo): 
				// color precio
				$color = ' style="color:#008080;"';
			?>
			
				<tr>
					<td>
						<input <?=$permitir?> type=checkbox name=equipo[] value="<?=$equipo->id_equipo?>"  >
					</td>
					<td>
						<?echo $equipo->escuderia;?>
					</td>
					
					<td>
						<span <?=$color;?>><?echo number_format($equipo->precio_venta, 0, ",", ".")?> €</span>
					</td>
					<td>
						<?echo $equipo->puntos?> €
					</td>
				</tr>
				
			<?php endforeach?>
			
		</table>
	</div>
	<div id=zonaDrc>
		<input type=submit value=Vender>
		
		</form>
		
		<?php echo $ventaTxt;
		?>
	</div>
	
	
</div>