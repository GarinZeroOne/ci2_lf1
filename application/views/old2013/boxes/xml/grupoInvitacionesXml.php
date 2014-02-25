<?php	
	
	echo "<idGrupo>";
		echo $idGrupo;			
	echo "</idGrupo>";
	echo "<nombreGrupo>";
		echo $nombreGrupo;			
	echo "</nombreGrupo>";
	foreach($invitacionesNoAceptadas as $linea ){
		echo "<usuarioInvitacion>";
			echo $linea->nick;			
		echo "</usuarioInvitacion>";
	}
		
		
 ?>