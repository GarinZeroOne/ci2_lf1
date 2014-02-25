<?php
class Puntuar_usuarios extends CI_Model{
	
	function Puntuar_usuarios()
	{
		parent::__construct();
	}
	
	/**
	 *  EJECUTAR ESTE SCRIPT UNA VEZ INTRODUCIDOS LOS RESULTADOS DESDE MYSQL.
	 *  PONDREMOS UNA RUTA DONDE EJUTAR EL SCRIPT, Y LO EJECUTAREMOS TODOS LOS 
	 *  DOMINGOS A LA NOCHE, DESPUES DE SABER E INTRODUCIR LOS RESULTADOS.
	 *  
	 *  EL SCRIPT SUMA LOS PUNTOS CORRESPONDIENTES A TODOS LOS USUARIOS Y INGRESA EL DINERO
	 *  DE LOS PREMIOS Y EL DINERO EXTRA QUE SE INGRESA DESPUES DE TODAS LAS CARRERAS
	 *  
	 *  NOTAS: Antes de ejecutar este script, la tabla resultados_pilotos tiene que tener
	 *  todos los resultados del GP metidos  y el campo procesado puesto a 0 en el gp que se 
	 *  va a procesar y todos los demas deben de estar siempre a 1!. Es decir no puede haber dos
	 *  GPS sin procesar a la hora de ejecutar el script.
	 * @return 
	 */
	
	function procesar_puntos_gp()
	{
		
		/**  USUARIOS - Puntos y dinero por posicion
		 */ 
		
		// Obtener resultados del GP, 
		// siempre deberia devolver una linea o ninguna

		$sql_pilotos = "SELECT * FROM resultados_pilotos WHERE procesado = ?";
		$query = $this->db->query($sql_pilotos,array(0));

		if($query->num_rows()){    // SE EJECUTARA SOLO 1 VEZ
			
			$ganadores = $query->row();
			
			//Se obtiene el id GP
			$idGp = $query->row()->id_circuito;	
			echo $idGP;
			// Obtener todos los pilotos activos
			// de los usuarios
			//$sql_usu_pilotos = "SELECT * FROM usuarios_pilotos WHERE activo=1";	
			$sql_usu_pilotos   = "SELECT *
									FROM usuarios_pilotos, boxes
									WHERE boxes.id_circuito ={$idGp}
									AND usuarios_pilotos.activo =1
									AND usuarios_pilotos.fecha_fichaje < boxes.fecha_cerrar";
			$usuarios        = $this->db->query($sql_usu_pilotos)->result();
			
			// Recorremos todos los registros y vamos
			// puntuando si encontramos un piloto que haya puntuado
			// y actualizamos sus fondos en el banco
			foreach($usuarios as $usuario){
				
				$sqlClasGp = "INSERT INTO tmp_clasificacion_gp VALUES (?,?,?,?)";
				if($usuario->id_piloto == $ganadores->id_primero){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 25 
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_piloto = {$ganadores->id_primero} ");
					
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 100000
															WHERE id_usuario = {$usuario->id_usuario}");
															
					$this->db->query($sqlClasGp,array('',$usuario->id_usuario,25,$idGp));										
					
					continue;
				}
				elseif($usuario->id_piloto == $ganadores->id_segundo){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 18 
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_piloto = {$ganadores->id_segundo} ");
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 75000
															WHERE id_usuario = {$usuario->id_usuario}");										  
															
					$this->db->query($sqlClasGp,array('',$usuario->id_usuario,18,$idGp));								
					continue;
					
				}
				elseif($usuario->id_piloto == $ganadores->id_tercero){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 15
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_piloto = {$ganadores->id_tercero} ");
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 65000
															WHERE id_usuario = {$usuario->id_usuario}");
											
					$this->db->query($sqlClasGp,array('',$usuario->id_usuario,15,$idGp));										
					continue;
				}
				elseif($usuario->id_piloto == $ganadores->id_cuarto){
																				  
					$this->db->query("UPDATE usuarios_pilotos SET puntos=puntos + 12 
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_piloto = {$ganadores->id_cuarto} ");
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 40000
															WHERE id_usuario = {$usuario->id_usuario}");
					
					$this->db->query($sqlClasGp,array('',$usuario->id_usuario,12,$idGp));										
					continue;
				}
				elseif($usuario->id_piloto == $ganadores->id_quinto){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 10 
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_piloto = {$ganadores->id_quinto} ");
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 35000
															WHERE id_usuario = {$usuario->id_usuario}");
															
					$this->db->query($sqlClasGp,array('',$usuario->id_usuario,10,$idGp));										
					continue;
				}
				elseif($usuario->id_piloto == $ganadores->id_sexto){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 8 
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_piloto = {$ganadores->id_sexto} ");
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 20000
															WHERE id_usuario = {$usuario->id_usuario}");
															
					$this->db->query($sqlClasGp,array('',$usuario->id_usuario,8,$idGp));										
					continue;
				}
				elseif($usuario->id_piloto == $ganadores->id_septimo){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 6 
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_piloto = {$ganadores->id_septimo} ");
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 17000
															WHERE id_usuario = {$usuario->id_usuario}");
															
					$this->db->query($sqlClasGp,array('',$usuario->id_usuario,6,$idGp));										
					continue;
				}
				elseif($usuario->id_piloto == $ganadores->id_octavo){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 4
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_piloto = {$ganadores->id_octavo} ");
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 15000
															WHERE id_usuario = {$usuario->id_usuario}");
															
					$this->db->query($sqlClasGp,array('',$usuario->id_usuario,4,$idGp));										
					continue;
				}
				elseif($usuario->id_piloto == $ganadores->id_noveno){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 2
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_piloto = {$ganadores->id_noveno} ");
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 10000
															WHERE id_usuario = {$usuario->id_usuario}");
															
					$this->db->query($sqlClasGp,array('',$usuario->id_usuario,2,$idGp));										
					continue;
				}
				elseif($usuario->id_piloto == $ganadores->id_decimo){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 1
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_piloto = {$ganadores->id_decimo} ");
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 7000
															WHERE id_usuario = {$usuario->id_usuario}");
															
					$this->db->query($sqlClasGp,array('',$usuario->id_usuario,1,$idGp));										
					continue;
				}
				else{
					$this->db->query($sqlClasGp,array('',$usuario->id_usuario,0,$idGp));
					continue;
				}
			
			}
			
			// SUMAR A TODOS LOS USUARIOS 30000€ extra cada GP
			
			$sql_extra = "UPDATE usuarios_banco SET fondos=fondos+30000";
			$this->db->query($sql_extra);
			
			//Se rellena la tabla de clasificacion GP
			$sqlClas = "SELECT sum( puntos )as puntos , id_usuario,id_gp
					FROM tmp_clasificacion_gp
					WHERE id_gp = ?
					GROUP BY id_usuario
					ORDER BY sum( puntos ) DESC";
					
			$clasificacionGp = $this->db->query($sqlClas,array($idGp))->result();
			$i = 0;
			foreach ($clasificacionGp as $linea){
				$i = $i + 1;
				$insertClas = "INSERT INTO clasificacion_gp VALUES (?,?,?,?,?,?)";
				
				$this->db->query($insertClas,array('',$linea->id_usuario,$i,$linea->puntos,$linea->id_gp,0));
			}
			
			//Se vacia la tabla temporal
			$sqlDeleteTmp = "DELETE FROM tmp_clasificacion_gp";
			$this->db->query($sqlDeleteTmp);
					
			// Establecer el GP como procesado
			// para saber que los puntos de este GP ya se han contabilizado
			$sql_procesado = "UPDATE resultados_pilotos SET procesado = 1";
			$this->db->query($sql_procesado);
			
			echo "Script de puntos de pilotos ejecutado";	
		}
		
		
		
		/**  EQUIPOS - Dinero ganado con tus equipos
		 */ 
		 
		$sql_equipos       = "SELECT * FROM resultados_equipos WHERE procesado = 0";
		$query = $this->db->query($sql_equipos);
		
		// Procesar dinero ganado con equipos
		if($query->num_rows()){    // SE EJECUTARA SOLO 1 VEZ
			
			$ganadores = $query->row();
			
			// Obtener todos los equipos activos
			// de los usuarios
			$sql_usu_equipos = "SELECT * FROM usuarios_equipos WHERE activo=1";	
			$usuarios        = $this->db->query($sql_usu_equipos)->result();
			$i = 0 ;
			// Recorremos todos los registros y vamos
			// puntuando si encontramos un piloto que haya puntuado
			// y actualizamos sus fondos en el banco
			foreach($usuarios as $usuario){
				
				
				if($usuario->id_equipo == $ganadores->id_primero){
					$this->db->query("UPDATE usuarios_equipos SET puntos = puntos + 35000 
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_equipo = {$ganadores->id_primero} ");
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 35000
															WHERE id_usuario = {$usuario->id_usuario}");
					
				}
				
				if($usuario->id_equipo == $ganadores->id_segundo){
					
					$this->db->query("UPDATE usuarios_equipos SET puntos = puntos + 30000 
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_equipo = {$ganadores->id_segundo} ");
					
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 30000
															WHERE id_usuario = {$usuario->id_usuario}");										  
					
					
				}
				
				if($usuario->id_equipo == $ganadores->id_tercero){
					
					$this->db->query("UPDATE usuarios_equipos SET puntos = puntos + 23000 
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_equipo = {$ganadores->id_tercero} ");
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 23000
															WHERE id_usuario = {$usuario->id_usuario}");
					
				}
				
				if($usuario->id_equipo == $ganadores->id_cuarto){
					
					$this->db->query("UPDATE usuarios_equipos SET puntos = puntos + 17000 
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_equipo = {$ganadores->id_cuarto} ");
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 17000
															WHERE id_usuario = {$usuario->id_usuario}");
					
				}
				
				if($usuario->id_equipo == $ganadores->id_quinto){
					
					$this->db->query("UPDATE usuarios_equipos SET puntos = puntos + 10000 
															  WHERE id_usuario = {$usuario->id_usuario} 
															  AND id_equipo = {$ganadores->id_quinto} ");
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 10000
															WHERE id_usuario = {$usuario->id_usuario}");
					
				}
				
				
			
			}
			
			// Establecer el GP como procesado
			// para saber que los puntos de este GP ya se han contabilizado
			$sql_procesado = "UPDATE resultados_equipos SET procesado = 1";
			$this->db->query($sql_procesado);
			
			echo "Script de dinero de equipos ejecutado";	
		}
		
		
		
	}
}
