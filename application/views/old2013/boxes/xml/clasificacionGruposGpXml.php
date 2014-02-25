<?php	
		$sitio = site_url();
		$i = 0;
		//Grupo
		echo "<nombreGrupo>";
			echo $nombreGrupo;
		echo "</nombreGrupo>";
		//Circuito		
		echo "<circuito>";
			echo $datosGP->circuito;
		echo "</circuito>";
		echo "<pais>";
			echo $datosGP->pais;
		echo "</pais>";
		//Ranking
		echo "<rankingGp>";
                $i = 0;
		foreach ($rankingGP as $linea){
                    $i = $i + 1;
				echo "<posicion>";
					echo $i;
				echo "</posicion>";
				echo "<avatarPath>";
					echo $linea->avatar;
				echo "</avatarPath>";
				echo "<nick>";
					echo $linea->nick;
				echo "</nick>";
				echo"<puntos>";
					echo $linea->puntos_manager_gp;
				echo"</puntos>";
				echo"<puntosStiki>";
					echo "0";//echo $linea['puntos_stiki'];
				echo"</puntosStiki>";
		}
		echo "</rankingGp>";

		 echo "<idGrupo>";
                echo $idGrupo;
                echo "</idGrupo>";
                echo "<mensajes>";
                $i = 0;
                foreach ($ultMensajes as $linea) {
                    echo "<mensaje>";
                    echo "<nick>";
                    echo $linea->nick;
                    echo "</nick>";
                    echo "<fechaMensaje>";
                    echo $linea->fecha_mensaje;
                    echo "</fechaMensaje>";
                    echo "<contenido>";
                    echo htmlspecialchars($linea->contenido);
                    echo "</contenido>";
                    echo"<avatar>";
                    echo $linea->avatar;
                    echo"</avatar>";
                    echo "</mensaje>";
                    $i = 1;
                }
                echo "</mensajes>";
		
 ?>