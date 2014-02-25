<div id=contenBox>
	<!-- CONTROL DE APERTURA Y CIERRE DE BOXES -->
	<?php if($boxes):?>
	<div id=textinfo>
		<div id=texto>
			<h3>¡Adivina los 5 primeros puestos!</h3>
			Si aciertas el nombre y el orden de los 5 primeros pilotos, ganarás un premio de 150.000 €. Participar
			en la quiniela cuesta 10.000 €. Solo puedes hacer una quiniela por cada GP.
		</div>
		<div id=imagen>
			<img src="imgs/money-bag.jpg">
		</div>
	</div>
	
	<div id="area-quiniela">
		<h2> Mi quiniela </h2>
		<?php
		if ($mis_quinielas):?>
			<table>
				<tr class="tablaquiniela">
					<td>Gran Premio</td>
					<td>1º</td>
					<td>2º</td>
					<td>3º</td>
					<td>4º</td>
					<td>5º</td>
				</tr>
				<tr>
					<td>
						<?php echo $granPremio->pais; ?>
					</td>
					<td>
						<?php echo $mis_quinielas['nombre_piloto_p1']; ?>
					</td>
					<td>
						<?php echo $mis_quinielas['nombre_piloto_p2']; ?>
					</td>
					<td>
						<?php echo $mis_quinielas['nombre_piloto_p3']; ?>
					</td>
					<td>
						<?php echo $mis_quinielas['nombre_piloto_p4']; ?>
					</td>
					<td>
						<?php echo $mis_quinielas['nombre_piloto_p5']; ?>
					</td>
				</tr>
			</table>
		
		<?php else:?>
			<?php
			//Si no hay pasta para comprar una quiniela se muestra un mensaje
			//y no se muestra el link
			if ($saldoNum < 10000){
				echo "No tienes dinero suficiente para comprar una quiniela."; 	
			}
			else{
				echo "No has comprado ninguna quiniela para el siguiente Gran Premio.<br>";
				echo anchor('quiniela/comprarQuiniela','Comprar quiniela')." Precio: 10.000 €";	
			}			
			?>
		<?php
		 endif;
		?>
	</div>
	
	<!-- BOXES CERRADOS -->
	<?php else: ?>
	<h3>Se ha cerrado el quiosco de las quinielas. Recuerda que abrimos de Lunes a Viernes!!. Debes comprar y rellenar tu quiniela durante esos dias. ¡Suerte!</h3>
	
	<?php endif;?>
</div>