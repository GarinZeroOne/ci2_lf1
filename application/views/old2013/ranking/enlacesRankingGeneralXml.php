<?php	
		$sitio = site_url();
		//Se genran los enlaces de la paginacion
		for ($i=0;$i<=$numEnlaces;$i++){
			echo "<numEnlace>";
			$numeroMostrar = $i + 1;
			if($i==$enlaceActual){
				echo htmlentities("<b style=\"color:#ff0000;\">");
				echo htmlentities("<a onclick=\"doAjax('".$sitio."ranking/clasificacionGeneral','numEnlace=".$i."',
											  'clasificacionGeneral','post',1)\">".$numeroMostrar."</a>");
				echo htmlentities("</b>");							  
			}else{
				echo htmlentities("<a onclick=\"doAjax('".$sitio."ranking/clasificacionGeneral','numEnlace=".$i."',
											  'clasificacionGeneral','post',1)\">".$numeroMostrar."</a>");	
			}
			
			echo "</numEnlace>";								  
		}
		
 ?>