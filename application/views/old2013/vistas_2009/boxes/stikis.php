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
	<?php if ($boxes):?>
	<br>Aumenta tus posibilidades duplicando los puntos y el dinero de tu piloto estrella! 
	El piloto que lleve un stiki en su monoplaza duplicara los puntos o el dinero ganado, dependiendo del tipo de stiki que lleve.
	<ul>
		<li> Solo se pueden llevar dos STIKIS por carrera.</li>
		<li> Un corredor solo puede llevar un STIKI.</li>
	</ul><br><br>
	<table>
		<th>Stikis</th><th>Descripcion</th><th>Precio</th>
		<tr>
			<td><img src="./imgs/stikidinero.jpg" /></td><td> STIKI multiplicador de dinero.</td><td> 30.000 €</td>
		</tr>
		<tr>
			<td><img src="./imgs/stikipuntos.jpg" /></td><td>  STIKI multiplicador de puntos.</td><td> 400.000 €</td>
		</tr>
	</table>
	
	
	<h3>Gestion STIKIS </h3>
	
	<div id=zonaIzq>
		<div style="margin-top:10px;margin-bottom:10px;">
		<form method="post" action="<?=site_url()?>/boxes/stikis_comprar">
			Comprar un STIKI multiplicador de 
			<select name="tipoStiki">
				<option value="dinero"> dinero</option>
				<option value="puntos"> puntos</option>
			</select>
			para el piloto 
			<select name="selPiloto">
			
				<?php foreach($info_pilotos as $piloto):?>
					
					<option value="<?=$piloto->id?>"><?=$piloto->nombre." ".$piloto->apellido;?></option>
					
				<?endforeach; ?>		
				
			</select>	
						
			
			
		
		</div>
		
		
		
		
	</div>
	<div id=zonaDrc>
		<input type="submit" value="Comprar">	
		
		</form>
		
		<?php echo $info_txt;
		?>
	</div>
	
	<div>
			<h3>Pilotos con STIKI para <?=$paisGP?></h3>
			
			<? foreach($info_stikis as $stiki): ?>
			
				<strong>Piloto: </strong> <?=$stiki->nombre." ".$stiki->apellido?> 
				<? if($stiki->stiki == 'puntos'): ?>
					<img src="./imgs/stikipuntos.jpg" />
				<? else: ?>
					<img src="./imgs/stikidinero.jpg" />
				<? endif;?>
				<br />
				
			<? endforeach;?>
	</div>
		<!-- BOXES CERRADOS -->
	<?php else: ?>
		<h3>Se han cerrado los Boxes. Recuerda que abrimos de Lunes a Viernes aprox.!!. Debes comprar los Stikis esos dias. ¡Suerte!</h3>
	<?php endif;?>
</div>