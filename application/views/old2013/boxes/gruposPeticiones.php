		<div id="peticiones" class="oculto">
			<div id="listaGruposPeticiones" class="mitadizq">
				<div id="tablaGrupos" class="tablacentrada">
					<?
					echo "Desde aqui puedes realizar peticiones para ingresar en otros grupos";
					echo "<table class=\"tabla\">";
							echo "<th>#</th><th>Grupo</th><th>Propietario</th><th>Peticion</th>";
							echo "<tr>";
							$j=1;
					foreach ($listaGruposNoPropios as $linea){
						echo "<td>";
						echo $j ;
						echo "</td>";
						echo "<td>";
						echo $linea->nombre ;
						echo "</td>";
						echo "<td>";
						echo $linea->nick ;
						echo "</td>";	
						echo "<td>";
						echo "<a class='btn btn-success' onclick=\"doAjax('".$sitio."grupos/nuevaPeticion','idGrupo=".$linea->id."',
													  'nuevaPeticion','post',1)\">Realizar peticion</a>";
						echo "</td>"; 
						echo "</tr>";		
						$j++;
					}
					echo "</table>";
					?>
				</div>
			</div>
			<div id="peticionesRealizadas" class="mitaddch">
				<? echo "</table>";
						echo "<br><br><b>";
						echo "Peticiones realizadas :";
						echo "</b><table class=\"tabla\">";
						echo "<th>#</th><th>Grupo</th>";
						echo "<tr>";
						$j=1;
						foreach ($listaPeticionesRealizadas as $linea){
							echo "<td>";
							echo $j ;
							echo "</td>";
							echo "<td>";
							echo $linea->nombre ;
							echo "</td>";	 
							echo "</tr>";		
							$j++;
						}
						
							
					echo "</table>";
			echo "</div>";
			echo "<div id=\"peticionesRecibidas\" class=\"mitaddch\">";
					echo "<br><b>";
					echo "Peticiones recibidas :";
					echo "</b><br>";
					if (count($listaPeticionesRecibidas) == 0){
						echo "No tienes nuevas peticiones";
					}
					else{
						echo "<ol>";
						foreach ($listaPeticionesRecibidas as $linea){
						echo "<li>";
						echo $linea->nick.
							 " quiere entrar en tu grupo ".$linea->nombre."<br>
							 <a onclick=\"doAjax('".$sitio."grupos/aceptaPeticion','idPeticion=".$linea->id."',
													  'aceptaPeticion','post',1)\">Aceptar</a>
							  - 
							 <a onclick=\"doAjax('".$sitio."grupos/rechazaPeticion','idPeticion=".$linea->id."',
													  'aceptaPeticion','post',1)\">Rechazar</a>";
						echo "</li>";
					}
					echo "</ol>";
					}
			echo "</div>"		
					?>
			</div>
		</div>
		