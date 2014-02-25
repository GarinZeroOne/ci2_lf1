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
						echo "<a onclick=\"doAjax('".$sitio."grupos/clasificacionGPXml','idGrupo=".$idGrupo[$i]."',
													  'clasificacionGrupos','post',1)\">".$nombreGrupo[$i]."</a>";
						echo "</b>";
						echo "</div>";
					}				
					?>
				</div>
				<div id="grupoSeleccionado" class="grupoSeleccionado">
					<? echo $nombreGrupo[0]; ?>
				</div>
			</div>
			<div id="contenidoRankingGP" >
				
				<div id="clasificacionGrupo" class="centrado">
					<h3>Resultado GP 
						<br><? echo $datosGP->circuito.' ('.$datosGP->pais.')';?>
					</h3>
					<table>
					<th>#</th><th>Avatar</th><th>Usuario</th><th>Puntos</th>
				<?php
					$i = 0;
				 	foreach($rankingGP as $linea):
					$i++;
				 	 if(strtolower($_SESSION['usuario']) == strtolower($linea->nick)): ?>
						<tr>
							<td class="posicion"><b style="color:#ff0000;"><? echo $i; ?>º</b></td>
							<td><img class="avatar" src= "<?=base_url()?>img/avatares/<? echo $linea->avatar; ?>" /></td>
							<td class="nick"><b style="color:#ff0000;"><? echo $linea->nick;?></b></td>
							<td class="puntos"><b style="color:#ff0000;"><? echo $linea->puntos_manager_gp?></b></td>
						</tr>
					<? else: ?>
						<tr>
							<td class="posicion"><? echo $i; ?>º</td>
							<td><img class="avatar" src="<?=base_url()?>img/avatares/<? echo $linea->avatar; ?>" /></td>
							<td class="nick"><?=$linea->nick?></td>
							<td class="puntos"><?=$linea->puntos_manager_gp?></td>
						</tr>
					<? endif;
					endforeach; ?>
					</table>	
				</div>	
					
			</div>	 
		</div>
		