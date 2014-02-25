<?php
class abrir_cerrar_boxes extends CI_Model
{
	function abrir_cerrar_boxes(){
		parent::__construct();
	}	
	
	function cargar_tabla(){
		/*
		 * YA SE HA GENERADO CORRECTAMENTO, COMENTO EL CODIGO
		 */
		/*
		$sql = "SELECT id,circuito,subdate(fecha,1) fecha_cerrar,adddate(fecha,1) fecha_abrir FROM circuitos WHERE 1";
		$boxes = $this->db->query($sql)->result();
		
		// Guardar en tabla las fechas de apertura y cierre de boxes
		foreach($boxes as $box){
			$sql = "INSERT INTO boxes VALUES('',?,?,?)";
			$this->db->query($sql,array($box->id,$box->fecha_cerrar,$box->fecha_abrir));
		}
		
		echo "Tabla generada";
		*/
	}
}
