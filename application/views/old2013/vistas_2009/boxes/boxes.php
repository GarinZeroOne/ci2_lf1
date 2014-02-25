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
	Esta es tu zona de Boxes. Desde aqui podras gestionar tus pilotos y tus equipos. <br><br>
	Si no tienes pilotos, tendras que comprarlos. El sistema proporciona a todos los usuarios nuevos una cantidad de <b>200.000 €</b>(+20k por GP)
	para poder empezar a fichar pilotos o equipos.
	
	Hay unas cuantas cosas que tienes que tener en cuenta antes de empezar con la gestion de los pilotos:<br><br>
	<ul>
		<li><b>Ganas dinero y puntos</b> con los pilotos que te entren en los puntos de cada carrera.</li> 
		<li><b>Ganas dinero</b> si un piloto tuyo no acaba la carrera.</li>
		<li><b>Ganas dinero</b> si un equipo tuyo entra entre los 5 primeros</li> 
		<li>Puedes vender algun piloto si no te esta dando buenos resultados. La venta de un piloto al sistema, hara que pierdas un 35% de su valor inicial. 
		Es decir si en su dia pagaste 100.000 € por un piloto , al venderlo el sistema te pagara 65.000€. Para los equipos se aplica un 25% de perdida sobre el valor inicial</li> 
		<li>Cada semana reciviras 20.000 € , independientemente de los resultados.</li>
		<li>Puedes fichar un maximo de <b>6 pilotos</b> y <b>5 equipos</b>.</li>
		<li>Leete bien las <?=anchor('inicio/reglas','reglas','style="color:#FF0000"')?> antes de empezar a comprar! Para unos buenos resultados es importante saberse bien las normas de puntuacion
		 asi como las opciones de cada piloto y cada equipo en un circuito determinado.
		</li>

	</ul>
	
	
 
	
</div>