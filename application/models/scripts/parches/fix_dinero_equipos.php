<?php
class Fix_dinero_equipos extends CI_Model{
	
	function Fix_dinero_equipos(){
		parent::__construct();
	}
	
	function deudas_australia(){
		// Pagar a los pilotos que tenian a Brawn GP
		// 12.000€ correspondientes al segundo puesto
		// conseguido por el equipo  que no se pago
		
		$sql_usuarios_sin_pagar  = " SELECT * FROM 
													usuarios_equipos 
											  WHERE
											  		fecha_compra <= '2009-03-27'
											  AND
											  		id_equipo = '9'		
											";
		$query = $this->db->query($sql_usuarios_sin_pagar);
		$i = 0;
		foreach($query->result() as $usuario){
			
			// Actualizar informacion de dinero conseguido por la escuderia
			$sql_update_info = "UPDATE usuarios_equipos SET puntos=puntos+12000 WHERE id_usuario= ? AND id_equipo=9";
			
			// Actualizar fondos del usuario
			$sql_update_banco = "UPDATE usuarios_banco SET fondos=fondos + 12000 WHERE id_usuario = ?";
			
			$this->db->query($sql_update_info,array($usuario->id_usuario));
			$this->db->query($sql_update_banco,array($usuario->id_usuario));
			
			$i++;
		}
		
		echo "Numero de registros actualizados:".$i;
	}
	
	
	function error_calculo_equipos(){
		
		$sql = "SELECT * FROM usuarios_equipos WHERE id_equipo = 9";
		
		$query = $this->db->query($sql);
		$i = 0;
		foreach ($query->result() as $usuario){
			$sql_actualizar_info  = "UPDATE usuarios_equipos SET puntos=puntos+5000 WHERE id_usuario = ? AND id_equipo=9";
			//$sql_actualizar_banco = "UPDATE usuarios_banco SET fondos=fondos+5000 WHERE id_usuario = ?";
			
			$this->db->query($sql_actualizar_info,array($usuario->id_usuario));
			//$this->db->query($sql_actualizar_banco,array($usuario->id_usuario));
			
			$i++;	
		}
		
		echo "Numero de registros actualizados:".$i;
	}
}
