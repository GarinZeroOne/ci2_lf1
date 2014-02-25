<div id=menuv>
	<div id=saldo><img src="<?=base_url()?>imgs/money.png" /> <span><?php echo $saldo;?> €</span> </div>
	<h2>Gestion</h2>
	<ul>
		<li><?php echo anchor('boxes/fichar_pilotos','Fichar pilotos') ?></li>
		<li><?php echo  anchor('boxes/mis_pilotos','Mis pilotos') ?></li>
		<li><?php echo  anchor('boxes/fichar_equipos','Fichar equipos') ?></li>
		<li><?php echo  anchor('boxes/mis_equipos','Mis equipos') ?></li>
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
			<h3>Gestion de grupos</h3>
			Desde aqui podras crear tus grupos, realizar invitaciones a otros usuarios
			 o consultar las clasificaciones de tus grupos.
		</div>
	</div>
	<div id="menu_grupo" class="menuGrupo">
		<div id="crear_grupo" class="menu">Grupos</div>
		<div id="invitacion" class="menu">Invitaciones</div>
		<div id="peticion" class="menu">Peticiones</div>
		<div id="clasificaciongp" class="menu">Clas.GP</div>
		<div id="clasificaciongen" class="menu">Clas.General</div>
	</div>
	<div id="content">
		<div id="formulario_grupo" class="oculto">
			<br>
			<div id="menuGruposPropios" class="menuRanking">
				<div id="seleccionaGrupoPropio" class="seleccionaGrupo">
					<? echo "Grupos";
					$numeroGruposPosibles =5; ?>
				</div>
				<div id="listaGruposPropios" class="listaGrupos">		
					<?php
					for($i = 0; $i < $numGruposPropios; $i++ ){ 
						echo "<div id=\"menuPropio".$i."\" class=\"mitadRanking\">";
						echo "<b>";
						echo $nombreGrupoPropio[$i];
						echo "</b>";
						echo "</div>";
					}		
						
						//Si no se han creado mas de 4 grupos se pueden generar mas
						$crearGrupo = false;
						if ($i < $numeroGruposPosibles){
							if ($i != 0){
							$i++;
							}
							$valorI =$i;
							echo "<div id=\"menuPropio".$i."\" class=\"mitadRanking\">";
							echo "<b>";
							echo "Crear grupo";
							echo "</b>";
							echo "</div>";	
							$crearGrupo = true;
						}
					?>
				</div>
				<div id="grupoSeleccionadoPropio" class="grupoSeleccionado">
				</div>
			</div>
			<div id="contenidoGruposPropios">
				<?php 
				for($i = 0; $i < $numGruposPropios; $i++ ){
					echo "<div id=\"grupoPropio".$i."\" class=\"centrado\">";
					echo '<b>';
					echo $nombreGrupoPropio[$i];
					echo '</b>';
					echo '<br>';
					
					
					echo "Miembros del grupo:";
					echo "<table class=\"tabla\">";
						echo "<th>#</th><th>Usuario</th>";
						
						$j = 1;
						foreach ($miembrosGrupo [$i] as $linea){
							echo "<tr>";
							echo "<td>";
							echo $j;
							echo "</td>";
							echo "<td>";
							echo $linea->nick ;
							echo "</td>";	 
							echo "</tr>";
							$j++;
					}
					echo "</table>"; 
					echo "<br>";
					echo anchor('/grupos/borrarGrupo/'.$idGrupoPropio[$i],'Borrar Grupo');
					echo "</div>";
				}
				if ($crearGrupo):
					echo "<div id=\"grupoPropio".$valorI."\" class=\"centrado\">";
					echo "<br>"; 
					echo "<br>";
					?>	
				<table>
					  <form id="form_crear_grupo" method="post" action="<?=site_url()?>/grupos/nuevoGrupo" >
						<tr>
						<td  width="47">Nombre</td>
						<td  width="46">
							<input type="text" name="nombre" maxlength=20>
						</td>
						</tr>
						<tr>
						<td width="51" colspan="2" align="center"><input type="submit" value="Crear" /></td>
						</tr>
					</form> 
				</table>
				<?php
					echo "</div>"; 
				endif;?>
			</div>
		</div>
		<div id="invitaciones" class="oculto">
			<div id="realizarInvitacion" class="mitadizq">
				<div id="menuGruposInvitaciones" class="menuInvitacionesClass">
					<div id="seleccionaGruposInvitaciones" class="seleccionaGrupo">
						<? echo "Grupos";
						$numeroGruposPosibles =5; ?>
					</div>
					<div id="listaGruposInvitaciones" class="listaGrupos">		
						<?php
						for($i = 0; $i < $numGruposPropios; $i++ ){ 
							echo "<div id=\"menuInvitaciones".$i."\" class=\"mitadRanking\">";
							echo "<b>";
							echo $nombreGrupoPropio[$i];
							echo "</b>";
							echo "</div>";
						}		
						?>
					</div>
					<div id="grupoSeleccionadoInvitaciones" class="grupoSeleccionado">
					</div>
				</div>
				<div id="contenidoInvitaciones" class="contenidoInvitacionesClass" >
					<?php 	
						for($i = 0; $i < $numGruposPropios; $i++ ){
						echo "<div id=\"crearInvitacion".$i."\" >";
						echo "<br>";
						echo $msgText ;
						echo "<br>";
						echo "Introduce el nick del usuario a invitar:";
						echo "<table>";?>
						<form method="post" action="<?=site_url()?>/grupos/nuevaInvitacion/" >
						<tr>
							<td  width="47">nick</td>
							<td  width="46">
								<input type="text" name="nick" maxlength=50>
								<input type = "hidden" name = "grupo" value = "<? echo $idGrupoPropio[$i]; ?>">
							</td>
							</tr>
							<tr>
							<td width="51" colspan="2" align="center"><input type="submit" value="Invitar" /></td>
							</tr>
						</form> 
						<? echo "</table>";
						echo "<br><b>";
						echo "Listado de invitaciones No aceptadas:";
						echo "</b><table class=\"tabla\">";
						echo "<th>#</th><th>Usuario</th>";
						echo "<tr>";
						$j=1;
						foreach ($invitacionesNoAceptadas [$i] as $linea){
							echo "<td>";
							echo $j ;
							echo "</td>";
							echo "<td>";
							echo $linea->nick ;
							echo "</td>";	 
							echo "</tr>";		
							$j++;
						}
						
							
					echo "</table>";
					echo "</div>";
					}	
					
					//Si no tiene grupos creados se muestra un mensaje
					if ($numGruposPropios == 0){
						echo "<div id=\"crearInvitacion0\" >";
						echo "<br>";
						echo "No puedes realizar invitaciones, no tienes ningun grupo creado.";
						echo "</div>";
					}
					
					echo "<br>";?>
				</div>		
			</div>
			<div id="listaInvitacionesRecibidas" class="mitaddch">
				<?
				echo "<br><b>";
				echo "Invitaciones recibidas :";
				echo "</b><br>";
				if (count($invitacionesRecibidas) == 0){
					echo "No tienes nuevas invitaciones";
				}
				else{
					echo "<ol>";
					foreach ($invitacionesRecibidas as $linea){
					echo "<li>";
					echo $linea->nick.
						 " te invita a su grupo ".$linea->nombre."<br>"
						 .anchor('/grupos/aceptaInvitacion/'.$linea->id,'Aceptar').  
						 " - " 
						 .anchor('/grupos/rechazaInvitacion/'.$linea->id,'Rechazar');
					echo "</li>";	 
				}
				echo "</ol>";
				}
				?>
			</div>
		</div>
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
						echo anchor('/grupos/nuevaPeticion/'.$linea->id,'Realizar peticion');
						echo "</td>"; 
						echo "</tr>";		
						$j++;
					}
					echo "</table>";
					?>
				</div>
			</div>
			<div id="peticionesRecibidas" class="mitaddch">
				<? echo "</table>";
						echo "<br><b>";
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
							 " quiere entrar en tu grupo ".$linea->nombre."<br>"
							 .anchor('/grupos/aceptaPeticion/'.$linea->id,'Aceptar').  
							 " - " 
							 .anchor('/grupos/rechazaPeticion/'.$linea->id,'Rechazar');
						echo "</li>";
					}
					echo "</ol>";
					}
					?>
			</div>
		</div>
		<div id="clasgp" class="oculto">
			<div id="menuRankingGP" class="menuRanking">
				<div id="seleccionaGrupo" class="seleccionaGrupo">
					<? echo "Grupos";?>
				</div>
				<div id="listaGrupos" class="listaGrupos">		
					<?php
					for($i = 0; $i < $numGrupos; $i++ ){ 
						echo "<div id=\"rankingGP".$i."\" class=\"mitadRanking\">";
						echo "<b>";
						echo "$grupo[$i]";
						echo "</b>";
						echo "</div>";
					}				
					?>
				</div>
				<div id="grupoSeleccionado" class="grupoSeleccionado">
				</div>
			</div>
			<div id="contenidoRankingGP" >
				<?php
					for($i = 0; $i < $numGrupos; $i++ ){ 
						echo "<div id=\"grupo".$i."\" class=\"centrado\">";
						echo "<table class=\"tabla\">";
						echo "<th>#</th><th>Usuario</th><th>Puntos</th>";
						$j = 1;
					 	foreach($rankingGP[$i] as $linea ){
								if(strtolower($_SESSION['usuario'])==strtolower($linea['usuario'])):?>
								<tr>
									<td><?echo $j;?>º</td>
									<td><b style="color:#ff0000;"><? echo $linea['usuario']?></b></td>
									<td><? echo $linea['puntosPiloto']?></td>
									<?php $j++; ?>
								</tr>
								<? else: ?>
								<tr>
									<td><?=$j;?>º</td>
									<td><?=$linea['usuario']?></td>
									<td><?=$linea['puntosPiloto']?><? if($linea['puntosStikis']){echo "+".$linea['puntosStikis'];} ?></td>
									<?php $j++; ?>
								</tr>
								<? endif;		
						}
						echo "</table>";	
						echo "</div>";	
					}
				 ?>
			</div>	 
		</div>
		<div id="clasgen" class="oculto">
			<div id="menuRankingGen" class="menuRanking">
				<div id="seleccionaGrupoGen" class="seleccionaGrupo">
					<? echo "Grupos";?>
				</div>
				<div id="listaGruposGen" class="listaGrupos">		
					<?php
					for($i = 0; $i < $numGrupos; $i++ ){ 
						echo "<div id=\"rankingGen".$i."\" class=\"mitadRanking\">";
						echo "<b>";
						echo "$grupo[$i]";
						echo "</b>";
						echo "</div>";
					}				
					?>
				</div>
				<div id="grupoSeleccionadoGen" class="grupoSeleccionado">
				</div>
			</div>
			<div id="contenidoRankingGen" >
				<?php
					for($i = 0; $i < $numGrupos; $i++ ){ 
						echo "<div id=\"rankingGenGrupo".$i."\" class=\"centrado\">";
						echo "<table class=\"tabla\">";
						echo "<th>#</th><th>Avatar</th><th>Usuario</th><th>Puntos</th>";
						$j = 1;
					 	foreach($rankingGen[$i] as $linea ){
								if(strtolower($_SESSION['usuario'])==strtolower($linea->nick)):?>
								<tr>
									<td class="posicion"><? echo $j?>º</td>
									<td><img src="http://www.ligaformula1.com/imgs/avatares/thumbs/<? echo $linea->avatar?>" /></td>
									<td class="nick"><b style="color:#ff0000;"><? echo $linea->nick?></b></td>
									<td class="puntos"><? echo $linea->puntos?></td>
									<?php $j++; ?>
								</tr>
								<? else: ?>
								<tr>
									<td class="posicion"><?=$j?>º</td>
									<td><img src="http://www.ligaformula1.com/imgs/avatares/thumbs/<?=$linea->avatar?>" /></td>
									<td class="nick"><?=$linea->nick?></td>
									<td class="puntos"><?=$linea->puntos?></td>
									<?php $j++; ?>
								</tr>
								<? endif;		
						}
						echo "</table>";	
						echo "</div>";	
					}
				 ?>
			</div>
		</div>
	</div>
</div>