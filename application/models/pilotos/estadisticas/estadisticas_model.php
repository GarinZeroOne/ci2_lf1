<?php
class Estadisticas_model extends CI_Model
{
	
	function Estadisticas_model()
	{
		parent::__construct();
	}
	
	function totalPilotosComprados()
	{
		$sql = "SELECT * FROM usuarios_pilotos WHERE activo = 1";
		return $this->db->query($sql)->num_rows();
		
	}
	
	function totalPilotosVendidos()
	{
		$sql = "SELECT * FROM usuarios_pilotos WHERE activo = 0";
		return $this->db->query($sql)->num_rows();
		
	}
	
	function totalEquiposComprados()
	{
		$sql = "SELECT * FROM usuarios_equipos WHERE activo = 1";
		return $this->db->query($sql)->num_rows();
		
	}
	
	function totalEquiposVendidos()
	{
		$sql = "SELECT * FROM usuarios_equipos WHERE activo = 0";
		return $this->db->query($sql)->num_rows();
		
	}
	
	
}
