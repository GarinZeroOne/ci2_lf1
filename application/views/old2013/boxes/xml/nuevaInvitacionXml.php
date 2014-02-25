<?php	
	
	echo "<mensaje>";
			echo $msg;			
	echo "</mensaje>";
	foreach($invitacionesNoAceptadas as $linea ){
		echo "<usuarioInvitacion>";
			echo $linea->nick;			
		echo "</usuarioInvitacion>";
	}
		
		
 ?>