<?php

class Fixer extends CI_model{

	function fixer()
	{
		parent::__construct();	
	}

	function test()
	{
		echo "todo ok";
	}


	/**
	 * Eliminar el dinero ingresado en el GP de belgica del 2013
	 *
	 * @return void
	 * @author 
	 **/
	/*
	function corregir_banco()
	{

		// Recoger usuarios
		$usuarios = $this->db->select('id')->from('usuarios')->order_by('id','asc')->get()->result();
		
		// Recorrer usuarios
		foreach($usuarios as $usuario)
		{


			$ganancias_gp = $this->db->select('*')
						  ->from('resultados_usuarios_desglose')
						  ->where('id_gp','12')
						  ->where('id_usuario',$usuario->id)
						  ->get()->result();

			// Resetear a 0 el dinero ganado
			$dinero_ganado = 0;

			foreach($ganancias_gp as $ganancias)
			{

				$dinero_ganado = $dinero_ganado +  $ganancias->dinero;
			}

			// Sumar la nomina LF1
			$dinero_ganado = $dinero_ganado + 100000;

			echo "Restado al usuario {$usuario->id} la cantidad de  {$dinero_ganado} euros.<br>";
			// Restarle del banco el dinero ganado
			$sql = "update usuarios_banco set fondos = (fondos - ?) where id_usuario = ?";
			$this->db->query($sql,array($dinero_ganado,$usuario->id));
		}


		echo "Datos del banco corregidos";

	}
	*/
}