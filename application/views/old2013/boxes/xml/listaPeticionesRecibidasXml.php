<?php	
	

	foreach ($listaPeticionesRecibidas as $linea) {
		echo "<nickInvitacion>";
			echo $linea->nick;			
		echo "</nickInvitacion>";
		echo "<nombreGrupo>";
			echo $linea->nombre;			
		echo "</nombreGrupo>";
		echo "<idPeticion>";
			echo $linea->id;			
		echo "</idPeticion>";
	}
		
		
 ?>