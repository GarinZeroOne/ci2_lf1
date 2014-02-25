<?php
class Gestion_stikis extends CI_Model{
	
	private $idGp;
	function Gestion_stikis()
	{
		parent::__construct();
		// Recoger ID del GP ha procesar
		$this->idGp = $this->db->query("SELECT id_gp 
							  FROM stikis_gp 
							  WHERE procesado = 0 
							  ORDER BY id ASC 
							  LIMIT 0,1"
							 )->row()->id_gp;
	}
	
	//------------------------------------------------
	//		Ejecutar esta funcion para gestionar STIKIS,
	//		despues de meter los datos del gp y tal
	//-------------------------------------------------
	function gestionar(){
		
		$this->stikisPuntos();
		$this->stikisDinero();
		$this->setProcesado();
		echo "gestion finalizada con exito";
	}
	
	function stikisPuntos()
	{
		// Doblar los puntos conseguidos a los pilotos 
		// con stiki de puntos comprado
		
		$sql = "SELECT * FROM stikis_usuarios WHERE stiki = 'puntos' AND estado = 'sin procesar'";
		$stikis = $this->db->query($sql);
		
		// Si existen stikis sin procesar, los  procesamos!
		
		if ( $stikis->num_rows() ){
			
			// Recoger resultado de los pilotos en el GP
			$ganadores = $this->db->query("SELECT * FROM resultados_pilotos WHERE id_circuito = ?",array($this->idGp))->row();
			
			//Consulta para actualizar los puntos de los stikis por usuario y GP
			$sqlStikiGp = "UPDATE clasificacion_gp SET puntos_stiki = puntos_stiki + ? 
						  WHERE id_usuario = ?
						  AND id_gp = ?";
			// Recorrer stikis e ir sumando puntos
			foreach($stikis->result() as $stiki){
				
				if($stiki->id_piloto == $ganadores->id_primero){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 25 
															  WHERE id_usuario = {$stiki->id_usuario} 
															  AND id_piloto = {$ganadores->id_primero} ");

				//Se modifican los puntos stiki del usuario para el GP	
				$this->db->query($sqlStikiGp,array(25,$stiki->id_usuario,$this->idGp));	
					
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_segundo){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 18 
															  WHERE id_usuario = {$stiki->id_usuario} 
															  AND id_piloto = {$ganadores->id_segundo} ");
				
				//Se modifican los puntos stiki del usuario para el GP	
				$this->db->query($sqlStikiGp,array(18,$stiki->id_usuario,$this->idGp));
															  
					continue;
					
				}
				elseif($stiki->id_piloto == $ganadores->id_tercero){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 15
															  WHERE id_usuario = {$stiki->id_usuario} 
															  AND id_piloto = {$ganadores->id_tercero} ");
				
				//Se modifican los puntos stiki del usuario para el GP	
				$this->db->query($sqlStikiGp,array(15,$stiki->id_usuario,$this->idGp));
															  
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_cuarto){
																				  
					$this->db->query("UPDATE usuarios_pilotos SET puntos=puntos + 12 
															  WHERE id_usuario = {$stiki->id_usuario} 
															  AND id_piloto = {$ganadores->id_cuarto} ");
				
				//Se modifican los puntos stiki del usuario para el GP	
				$this->db->query($sqlStikiGp,array(12,$stiki->id_usuario,$this->idGp));
															  
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_quinto){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 10 
															  WHERE id_usuario = {$stiki->id_usuario} 
															  AND id_piloto = {$ganadores->id_quinto} ");
				
				//Se modifican los puntos stiki del usuario para el GP	
				$this->db->query($sqlStikiGp,array(10,$stiki->id_usuario,$this->idGp));
															  
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_sexto){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 8 
															  WHERE id_usuario = {$stiki->id_usuario} 
															  AND id_piloto = {$ganadores->id_sexto} ");
				
					//Se modifican los puntos stiki del usuario para el GP	
					$this->db->query($sqlStikiGp,array(8,$stiki->id_usuario,$this->idGp));
															  
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_septimo){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 6 
															  WHERE id_usuario = {$stiki->id_usuario} 
															  AND id_piloto = {$ganadores->id_septimo} ");
					
					//Se modifican los puntos stiki del usuario para el GP	
					$this->db->query($sqlStikiGp,array(6,$stiki->id_usuario,$this->idGp));										  
					
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_octavo){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 4
															  WHERE id_usuario = {$stiki->id_usuario} 
															  AND id_piloto = {$ganadores->id_octavo} ");

					//Se modifican los puntos stiki del usuario para el GP	
					$this->db->query($sqlStikiGp,array(4,$stiki->id_usuario,$this->idGp));
															  
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_noveno){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 2
															  WHERE id_usuario = {$stiki->id_usuario} 
															  AND id_piloto = {$ganadores->id_noveno} ");

					//Se modifican los puntos stiki del usuario para el GP	
					$this->db->query($sqlStikiGp,array(2,$stiki->id_usuario,$this->idGp));
															  
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_decimo){
					$this->db->query("UPDATE usuarios_pilotos SET puntos = puntos + 1
															  WHERE id_usuario = {$stiki->id_usuario} 
															  AND id_piloto = {$ganadores->id_decimo} ");

					//Se modifican los puntos stiki del usuario para el GP	
					$this->db->query($sqlStikiGp,array(1,$stiki->id_usuario,$this->idGp));
															  
					continue;
				}
				else{
					continue;
				}
			}
			
			
			
			
			
			echo "Gestion de STIKIS puntos ejecutada";
			
		}
		
	}
	
	function stikisDinero()
	{
		// Doblar dinero conseguidos a los pilotos 
		// con stiki de puntos comprado
		
		$sql = "SELECT * FROM stikis_usuarios WHERE stiki = 'dinero' AND estado = 'sin procesar'";
		$stikis = $this->db->query($sql);
		
		// Si existen stikis sin procesar, los  procesamos!
		
		if ( $stikis->num_rows() ){
			
			// Recoger resultado de los pilotos en el GP
			$ganadores = $this->db->query("SELECT * FROM resultados_pilotos WHERE id_circuito = ?",array($this->idGp))->row();
			
			// Recorrer stikis e ir sumando puntos
			foreach($stikis->result() as $stiki){
				
				if($stiki->id_piloto == $ganadores->id_primero){
					
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 100000
															WHERE id_usuario = {$stiki->id_usuario}");
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_segundo){
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 75000
															WHERE id_usuario = {$stiki->id_usuario}");										  
					continue;
					
				}
				elseif($stiki->id_piloto == $ganadores->id_tercero){
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 65000
															WHERE id_usuario = {$stiki->id_usuario}");
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_cuarto){
																				  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 40000
															WHERE id_usuario = {$stiki->id_usuario}");
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_quinto){
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 35000
															WHERE id_usuario = {$stiki->id_usuario}");
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_sexto){
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 20000
															WHERE id_usuario = {$stiki->id_usuario}");
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_septimo){
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 17000
															WHERE id_usuario = {$stiki->id_usuario}");
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_octavo){
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 15000
															WHERE id_usuario = {$stiki->id_usuario}");
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_noveno){
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 10000
															WHERE id_usuario = {$stiki->id_usuario}");
					continue;
				}
				elseif($stiki->id_piloto == $ganadores->id_decimo){
															  
					$this->db->query("UPDATE usuarios_banco SET fondos=fondos + 7000
															WHERE id_usuario = {$stiki->id_usuario}");
					continue;
				}
				else{
					continue;
				}
			}
			
			
			
			
			
			echo "Gestion de STIKIS dinero ejecutada";
			
		}
	}
	
	function setProcesado(){
		
		// Poner como procesados los STIKIS del gp
		$this->db->query("UPDATE stikis_usuarios set estado = 'procesado' WHERE id_gp = ?",array($this->idGp));
		
		// Poner como procesados el GP
		$this->db->query("UPDATE stikis_gp SET procesado = 1 WHERE id_gp = ?",array($this->idGp));
		
	}
}