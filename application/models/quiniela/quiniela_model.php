<?php
class Quiniela_model extends CI_Model{
	
	function Quiniela_model(){
		parent::__construct();
	}
	
	function obtenerPilotos(){
		
		$sql = "SELECT id,nombre,apellido FROM pilotos";
		$pilotos = $this->db->query($sql)->result();
		return $pilotos;
	}
	
	function insertQuiniela($datos){
		$sql = "SELECT id FROM circuitos WHERE fecha > ? limit 0,1";
		$idGp = $this->db->query($sql,array(date('Y-m-d')))->row()->id;
		
		$sql = "INSERT INTO quiniela VALUES (?,?,?,?,?,?,?,?,?)";
		$this->db->query($sql,array('',$idGp,$_SESSION['id_usuario'],$datos['uno'],
		$datos['dos'],$datos['tres'],$datos['cuatro'],$datos['cinco'],0));
	}
	
	function getQuinielasActivas(){
		
		// Obtener id del GP
		$hoy = date('Y-m-d');
		
		$sql   = "SELECT id FROM circuitos WHERE fecha > '{$hoy}' ORDER BY fecha ASC LIMIT 0,1";
		$id_gp = $this->db->query($sql)->row()->id;
		
		$sql = "SELECT * FROM 
							quiniela 
						 WHERE
						 	id_usuario = ?
						 AND
						 	id_gp = ?
						 AND 
						 	caducada = 0
						 LIMIT 0,1	
						 ";		
		$query = $this->db->query($sql,array($_SESSION['id_usuario'],$id_gp));
		
		if( $query->num_rows() ){
			$datosMiQuiniela = array();
			// Guardar nombres de pilotos para mostrarlos
			// #1
			$query_p1  = $this->db->query("SELECT nombre,apellido FROM pilotos WHERE id = ?",array($query->row()->id_p_1))->row();
			$nombre_p1 = $query_p1->nombre." ".$query_p1->apellido;
			
			$datosMiQuiniela['nombre_piloto_p1'] = $nombre_p1;
			// #2
			$query_p2  = $this->db->query("SELECT nombre,apellido FROM pilotos WHERE id = ?",array($query->row()->id_p_2))->row();
			$nombre_p2 = $query_p2->nombre." ".$query_p2->apellido;
			
			$datosMiQuiniela['nombre_piloto_p2'] = $nombre_p2;
			// #3
			$query_p3  = $this->db->query("SELECT nombre,apellido FROM pilotos WHERE id = ?",array($query->row()->id_p_3))->row();
			$nombre_p3 = $query_p3->nombre." ".$query_p3->apellido;
			
			$datosMiQuiniela['nombre_piloto_p3'] = $nombre_p3;
			// #4
			$query_p4  = $this->db->query("SELECT nombre,apellido FROM pilotos WHERE id = ?",array($query->row()->id_p_4))->row();
			$nombre_p4 = $query_p4->nombre." ".$query_p4->apellido;
			
			$datosMiQuiniela['nombre_piloto_p4'] = $nombre_p4;
			// #5
			$query_p5  = $this->db->query("SELECT nombre,apellido FROM pilotos WHERE id = ?",array($query->row()->id_p_5))->row();
			$nombre_p5 = $query_p5->nombre." ".$query_p5->apellido;
			
			$datosMiQuiniela['nombre_piloto_p5'] = $nombre_p5;
			
			return $datosMiQuiniela;
		}
		else{
			return false;
		}
	}
}
