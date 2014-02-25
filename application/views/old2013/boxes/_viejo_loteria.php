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