<?php	
		$sitio = site_url();
		$i = 0;
		//Grupo
		echo "<nombreGrupo>";
			echo $nombreGrupo;
		echo "</nombreGrupo>";
		//Ranking
		echo "<rankingGeneral>";
		foreach ($rankingGeneral as $linea){
                    	echo "<datosUsuario>";
				echo "<avatarPath>";
					echo $linea['avatar'];
				echo "</avatarPath>";
				echo "<nick>";
					echo $linea['nick'];
				echo "</nick>";
				echo"<puntos>";
					echo $linea['puntos'];
				echo"</puntos>";
                        echo "</datosUsuario>";
		}
		echo "</rankingGeneral>";

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