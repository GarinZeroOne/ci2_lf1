<?php	

	for($i = 0; $i < $numGruposPropios; $i++ ){
		echo "<gruposFuncion>";
			echo htmlentities("<div id=\"menuPropio".$i."\" class=\"mitadRanking\">");
			echo htmlentities("<b>");
			echo htmlentities("<a onclick=\"doAjax('".$sitio."grupos/miembrosGrupo','idGrupo=".$idGrupoPropio[$i]."',
									  'miembrosGrupo','post',1)\">".$nombreGrupoPropio[$i]."</a>");
			echo htmlentities("</b>");
			echo htmlentities("</div>");			
		echo "</gruposFuncion>";
	}
		
		
 ?>