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
						echo "<a onclick=\"doAjax('".$sitio."grupos/clasificacionGeneralXml','idGrupo=".$idGrupo[$i]."',
													  'clasificacionGeneralGrupos','post',1)\">".$nombreGrupo[$i]."</a>";
						echo "</b>";
						echo "</div>";
					}				
					?>
				</div>
				<div id="grupoSeleccionado" class="grupoSeleccionado">
					<? echo $nombreGrupo[0]; ?>
				</div>
			</div>
			<div id="contenidoRankingGen" >
				<div id="clasificacionGrupo" class="centrado">
					<h3>
						Clasificacion General
					</h3>
					<table>
					<th>#</th><th>Avatar</th><th>Usuario</th><th>Puntos</th>
				 	<?php 
						$j = 0 ;
						foreach($rankingGeneral as $linea ){
							$j++;
							if(strtolower($_SESSION['usuario'])==strtolower($linea->nick)):?>
							<tr>
								<td class="posicion"><b style="color:#ff0000;"><? echo $j?>º</b></td>
								<td><img src="<?=base_url()?>img/avatares/<? echo $linea->avatar;?>" class="avatar" /></td>
								<td class="nick"><b style="color:#ff0000;"><? echo $linea->nick;?></b></td>
								<td class="puntos"><b style="color:#ff0000;"><? echo $linea->puntos; ?></b></td>
							</tr>
							<? else: ?>
							<tr>
								<td class="posicion"><?=$j?>º</td>
								<td><img src="<?=base_url()?>img/avatares/<? echo $linea->avatar; ?>" class="avatar" /></td>
								<td class="nick"><? echo $linea->nick; ?></td>
								<td class="puntos"><? echo $linea->puntos; ?></td>
							</tr>
							<? endif;		
						}?>
						</table>	
				</div>	
			</div>
		</div>
