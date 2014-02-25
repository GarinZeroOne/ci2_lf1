<?php
class Dinero_pole extends CI_Model
{
	function Dinero_pole(){
		parent::__construct();	
	}
	
	// HAY QUE INTRODUCIR PRIMERO EL ID DEL PILOTO QUE HA HECHO
	// LA POLE, Y DEJAR EL CAMPO 'POLEMAN_PROCESADO=0'.
	// UNA VEZ QUE SE EJECUTE EL SCRIPT  PONEMOS EL CAMPO A 1
	
	function procesar_pole(){
		$sql = "SELECT id_poleman FROM 
								  	resultados_pilotos 
								  WHERE
								  	poleman_procesado = 0";
		$query = $this->db->query($sql);
		
		if($query->num_rows()){		// SE EJECUTA SOLO 1 VEZ
			
			$ganador = $query->row();
			
			// Obtener todos los pilotos activos
			// de los usuarios
			$sql_usu_pilotos = "SELECT * FROM usuarios_pilotos WHERE activo=1";	
			$usuarios        = $this->db->query($sql_usu_pilotos)->result();
			//Contador para saber cuantos usuarios han sido premiados
			$i = 0;
			foreach($usuarios as $usuario){
				if($usuario->id_piloto == $ganador->id_poleman){
					
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 18000
															WHERE id_usuario = {$usuario->id_usuario}");
					$i++;
				}
			}
			
			// Establecer LA POLE como procesada
			$sql_procesado = "UPDATE resultados_pilotos SET poleman_procesado = 1";
			$this->db->query($sql_procesado);
			echo "Pole procesada.<br>";
			echo $i." premiados";
			
		}
		else{
			echo "No hay datos a procesar";
		}
		
		
	}
}
