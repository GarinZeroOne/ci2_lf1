<?php	

		echo "<gruposPropios>";
			for($i = 0; $i < $numGruposPropios; $i++ ){
				echo "<gpNombreGrupo>"; 
				echo htmlentities("<div id=\"menuInvitaciones".$i."\" class=\"mitadRanking\">");
				echo htmlentities("<b>");
				echo htmlentities($nombreGrupoPropio[$i]);
				echo htmlentities("</b>");
				echo htmlentities("</div>");
				echo "</gpNombreGrupo>"; 
			}		
		echo "</gruposPropios>";						
		$sitio = site_url();
		$kLineasPantalla = 30;
		$i = 0; 
		//Miposicion
		echo "<mi_Posicion>";
			echo "<miPosicion>";
				echo $miPosicion['posicion'];
			echo "</miPosicion>";
			echo "<miAvatarPath>";
				echo $miPosicion['avatar_path'];
			echo "</miAvatarPath>";
			echo "<miNick>";
				echo $miPosicion['nick'];
			echo "</miNick>";
			echo"<miPuntos>";
				echo $miPosicion['puntos'];
			echo"</miPuntos>";
		echo "</mi_Posicion>";
		echo "<rankingGeneral>";
		foreach ($rankingGp as $linea){
			$i++;
			//Se genera la posicion puesto que esta no esta en la tabla para la clasificacion general
			$posicion = $i + $enlaceActual * $kLineasPantalla;
			echo "<posicion>";
				echo $posicion;
			echo "</posicion>";
			echo "<avatarPath>";
				echo $linea['avatar_path'];
			echo "</avatarPath>";
			echo "<nick>";
				echo $linea['nick'];
			echo "</nick>";
			echo"<puntos>";
				echo $linea['puntos'];
			echo"</puntos>";
		}
		echo "</rankingGeneral>";
		
 ?>