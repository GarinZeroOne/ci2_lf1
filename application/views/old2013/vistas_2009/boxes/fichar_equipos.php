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
	<!-- CONTROL DE APERTURA Y CIERRE DE BOXES -->
	<?php if($boxes):?>
	
	
	<h3>Fichar equipos</h3>
	<div id=zonaIzq>
		<form method=post action="<?=site_url()?>/boxes/fichar_equipos">
		<table cellspacing=2>
			<th></th>
			<th>Escuderia</th>
			<th>Precio</th>
			
			<?php foreach($info_equipos as $equipo): 
				// Desactivar casillas de pilotos  que no podemos pagar
				if($saldoNum < $equipo->precio_compra):
					$permitir = 'disabled=disabled';
					$color = ' style="color:#ff0000;"';
				else:
					$permitir = ' ';
					$color = ' style="color:#008080;"';
				endif;
				
			?>
			
				<tr>
					<td>
						<input <?=$permitir?> type=checkbox name=equipo[] value="<?=$equipo->id?>"  >
					</td>
					<td>
						<?echo $equipo->escuderia;?>
					</td>
					<td>
						<span <?=$color;?>><?echo number_format($equipo->precio_compra, 0, ",", ".")?> €</span>
					</td>
					
				</tr>
				
			<?php endforeach?>
			
		</table>
	</div>
	<div id=zonaDrc>
		<input type=submit value=Comprar>
		
		</form>
		
		<div id=msg>
		<?php echo $fichajeTxt;
		?>
		</div>
	</div>
	
	<!-- BOXES CERRADOS -->
	<?php else: ?>
	<h3>Boxes cerrados!!. No se permite realizar fichajes antes ni durante el gran premio. 
	Los boxes permanecen cerrados un dia antes del GP y se abren un dia despues.</h3>
	
	<?php endif;?></i>

	
</div>