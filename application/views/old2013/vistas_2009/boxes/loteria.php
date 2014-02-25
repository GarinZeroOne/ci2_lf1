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
	
	<div id=textinfo>
		<div id=texto>
			<h3>Loteria Liga Formula 1</h3>
			Compra tantos numeros como quieras, cuantos mas compres mas  posibilidades tendras de que te toque el bote!. Cada semana se generará 
			un numero aleatorio del 1 al 200. El numero generado sera el ganador y se llevará todo el bote que haya acumulado hasta el momento.
			Si en una semana no hay usuarios que hayan comprado el numero ganador, todo el bote se acumulará para la siguiente semana. El bote lo generan los usuarios
			al comprar la loteria. ¡Suerte!
		</div>
		<div id=imagen>
			<img width="230" src="imgs/loteria.jpg">
		</div>
	</div>
	
	<div align=center id="bote">
		<b>BOTE EN JUEGO:</b>  <span><?=$bote?> €</span>
	</div>
	
	<div id="area-quiniela">
		<?=$loteriaMsg?>
		<h2> Mis numeros </h2>
		<?php
		if ($mis_numeros){
			
			echo "<div id='seleccionados'>";
			
			foreach($mis_numeros as $n)
			{
				echo $n->numero_loteria." | ";				
			}
			echo "</div>";
			if ($boxes){
				echo anchor('boxes/loteria_comprar','Comprar mas loteria')." Precio: 5.000 €";	
			}
			else{
				echo "El domingo se anunciará el número Ganador, suerte!";
			}
			
		}
		else{
			echo "No has comprado ningun numero de loteria para el siguiente Gran Premio.<br>";
			echo anchor('boxes/loteria_comprar','Comprar loteria')." Precio: 5.000 €";
		}
		?>
	</div>
	
</div>