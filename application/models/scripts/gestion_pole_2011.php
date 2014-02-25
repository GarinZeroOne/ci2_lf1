<?php

class Gestion_pole_2011 extends CI_Model
{
	private $id_gp;
	private $dinero_pole = 100000;
	private $puntos_manager = 10;

	//const DINERO_POLE = 30000;
	//const PUNTOS_MANAGER = 5;


	function Gestion_pole_2011()
	{
		parent::__construct();
		$this->load->model('estadisticas/estadisticas_model');
		$this->set_gp_a_procesar();
	}

	// Obtener el GP a procesar
	function set_gp_a_procesar()
	{

		$sql = "SELECT * FROM circuitos WHERE procesado = 0 ORDER BY id ASC limit 0,1";
		$query = $this->db->query($sql);

		if( $query->num_rows == 1)
		{
			$this->id_gp = $query->row()->id;
		}
	}

	// Script procesar pole 2011
	function procesar_pole()
	{


		// Buscar poleman
		$sql = "SELECT id_piloto FROM resultados_pilotos_2011 WHERE id_gp = ? AND poleman = 1";

		// Id poleman
		$Q = $this->db->query($sql,array($this->id_gp));
		$id_poleman = $Q->row()->id_piloto;

		// Recoger usuarios
		$sql_usuarios = "SELECT id FROM usuarios";
		$usuarios = $this->db->query($sql_usuarios)->result();

		// Contador
		$i = 0;

		// Recorrer usuarios
		foreach( $usuarios as $usuario)
		{

			// Recorrer pilotos activos  de cada usuario
			//$sql_pilotos = "SELECT id_piloto FROM usuarios_pilotos WHERE id_usuario = ? AND activo = 1";

			$sql_usu_pilotos   = "SELECT usuarios_pilotos.id_piloto
								  FROM usuarios_pilotos, boxes
								  WHERE boxes.id_circuito ={$this->id_gp}
								  AND usuarios_pilotos.activo =1
								  AND usuarios_pilotos.fecha_fichaje < boxes.fecha_cerrar
								  AND usuarios_pilotos.id_usuario = ?
								  order by id_usuario ASC";

			$pilotos = $this->db->query($sql_usu_pilotos, array($usuario->id))->result();

			foreach( $pilotos as $piloto)
			{
				// es el poleman?
				if($piloto->id_piloto == $id_poleman)
				{

					// Guadar dinero y puntos Manager
					$sql_premio_poleman = "INSERT INTO resultados_usuarios_desglose(id_piloto,id_gp,dinero,puntos,id_usuario,tipo)
										   VALUES ('$piloto->id_piloto',
										   			'$this->id_gp',
										   			'$this->dinero_pole',
										   			'$this->puntos_manager',
										   			'$usuario->id',
													'poleman' )";
					$this->db->query($sql_premio_poleman);

					$i++;


				}
			}

		}

		$tot_usuarios = $this->estadisticas_model->usuarios_registrados();
		echo "Script de poleman ejecutado con EXITO, numero de polemans:".$i;
		echo "<br>";
		echo anchor('scripts/gestionar_gp/0/'.$tot_usuarios,'SIGUIENTE --> Procesar usuarios del 0 al 300 ');
	}
}


