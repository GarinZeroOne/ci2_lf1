<?php	
	

	foreach ($invitacionesRecibidas as $linea) {
		echo "<nickInvitacion>";
			echo $linea->nick;			
		echo "</nickInvitacion>";
		echo "<nombreGrupo>";
			echo $linea->nombre;			
		echo "</nombreGrupo>";
		echo "<idInvitacion>";
			echo $linea->id;			
		echo "</idInvitacion>";
	}
		
		
 ?>