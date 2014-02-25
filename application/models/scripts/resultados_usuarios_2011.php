<?php
class Resultados_usuarios_2011 extends CI_Model
{
	private $id_gp;

	private $nomina_lf1 = 100000;

	private $publicistas = array(
								'1'		=>		0.05,
								'2'		=>		0.10,
								'3'		=>		0.15,
								'4'		=>		0.20,
								'5'		=>		0.25,
								'6'		=>		0.30,
								'7'		=>		0.35,
								'8'		=>		0.40,
								'9'		=>		0.45,
								'10'	=>		0.50
								);


	function Resultados_usuarios_2011()
	{
		parent::__construct();
		$this->load->model('banco/banco_model');
                $this->load->model('scripts/gestion_apuestas');
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


	function procesar_desglose_banco()
	{
		$this->_puntos_banco();
		echo anchor('scripts/desglose_publicistas','SIGUIENTE--> Procesar desglose Publicistas');
	}

	function procesar_desglose_publicistas()
	{
		$this->_desglose_publicistas();
		echo anchor('scripts/procesar_resultados_2011','SIGUIENTE--> Procesar Resultados Usuarios e ingresos de ganancias en Banco(excepto apuestas)');
	}

	function procesar_desglose_ingreso_apuestas()
	{
		$this->load->model(array('apuestas/apuestas_model', 'banco/banco_model'));
                $this->gestion_apuestas->procesarApuestas_garin($this->id_gp);

		echo anchor('scripts/procesar_cerrar_gp','SIGUIENTE--> Procesar nominas 100.000€ ');
	}


	function cerrar_gp()
	{
		$sql  = "UPDATE usuarios_banco set fondos = fondos + ?";
		$this->db->query($sql, array( $this->nomina_lf1));

		// NEW 2013!
		// Ya no cerramos GP AKI. Primero hay que gestionar las estrellas
		//$sql_cerrar_gp = "UPDATE circuitos set procesado = 1 WHERE id = ?";
		//$this->db->query($sql_cerrar_gp,array($this->id_gp));

		echo anchor('scripts/procesar_estrellas','SIGUIENTE y ULTIMO --> Procesar ESTRELLAS y CERRAR GP');
	}


	function estrellas_usuarios()
	{
		$sql = "SELECT res.puntos_manager_gp,res.puesto_gp,res.id_usuario
                       ,usr.nick,usr.id id_user,avt.avatar
		FROM resultados_usuarios_2011 res,usuarios usr,usuarios_avatar avt
		WHERE res.id_usuario = usr.id
		AND res.id_usuario = avt.id_usuario
		AND res.id_gp = ?
		ORDER BY res.puesto_gp
                LIMIT 0,?";

        $max = 25;

        $clasificacion = $this->db->query($sql, array($this->id_gp, $max ))->result();

        //
        $puntos_anterior = 0;
        $i = 0;
        $num_estrellas = array(8,6,4,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2);

        foreach($clasificacion as $puesto)
        {
        	// Si es la primera vez inicializamos
        	if($puntos_anterior == 0)
        		$puntos_anterior = $puesto->puntos_manager_gp;

        	if($puesto->puntos_manager_gp < $puntos_anterior)
        	{
        		++$i;
        		$puntos_anterior = $puesto->puntos_manager_gp;
        	}

        	// Insertar estrellas
        	$data_insert = array(
        								'id_recompensa'			=>				'',
        								'id_usuario'			=>				$puesto->id_usuario,
        								'num_estrellas'			=>				$num_estrellas[$i],
        								'estado'				=>				'P',
        								'id_gp'					=>				$this->id_gp,
        								'fecha_creacion'		=>				date('Y-m-d H:i:s')

        							);
       		$this->db->insert('recompensa',$data_insert);

       		// Guardamos puntos de la posicion 25
       		// para darle a todos los que haya logrado los mismos puntos
       		// media estrella (estarian empatados al25º aunque no se ven en el top)
       		if($puesto->puesto_gp == '25')
       		{
       			$puntos_ultimo_top = $puesto->puntos_manager_gp;
       		}




        	/*
        	// PRIMERO
        	if($puesto->puesto_gp == '1')
        	{
        		$data_insert = array(
        								'id_recompensa'			=>				'',
        								'id_usuario'			=>				$puesto->id_usuario,
        								'num_estrellas'			=>				6,
        								'estado'				=>				'P',
        								'id_gp'					=>				$this->id_gp,
        								'fecha_creacion'		=>				date('Y-m-d H:i:s')

        							);
        		$this->db->insert('recompensa',$data_insert);

        		continue;
        	}


            // SEGUNDO
        	if($puesto->puesto_gp == '2')
        	{
        		$data_insert = array(
        								'id_recompensa'			=>				'',
        								'id_usuario'			=>				$puesto->id_usuario,
        								'num_estrellas'			=>				4,
        								'estado'				=>				'P',
        								'id_gp'					=>				$this->id_gp,
        								'fecha_creacion'		=>				date('Y-m-d H:i:s')

        							);
        		$this->db->insert('recompensa',$data_insert);

        		continue;
        	}

        	// TERCERO
        	if($puesto->puesto_gp == '3')
        	{
        		$data_insert = array(
        								'id_recompensa'			=>				'',
        								'id_usuario'			=>				$puesto->id_usuario,
        								'num_estrellas'			=>				2,
        								'estado'				=>				'P',
        								'id_gp'					=>				$this->id_gp,
        								'fecha_creacion'		=>				date('Y-m-d H:i:s')

        							);
        		$this->db->insert('recompensa',$data_insert);

        		continue;
        	}


        	// 4-24
        	if($puesto->puesto_gp > 3 && $puesto->puesto_gp < 25 )
        	{
        		$data_insert = array(
        								'id_recompensa'			=>				'',
        								'id_usuario'			=>				$puesto->id_usuario,
        								'num_estrellas'			=>				1,
        								'estado'				=>				'P',
        								'id_gp'					=>				$this->id_gp,
        								'fecha_creacion'		=>				date('Y-m-d H:i:s')

        							);
        		$this->db->insert('recompensa',$data_insert);

        		continue;
        	}


        	// 25 .Miraremos sus puntos y otorgaremos a todos los ke hayan sacado esos puntos media estrellas
        	if( $puesto->puesto_gp == '25' )
        	{
        			$puntos_posicion = $puesto->puntos_manager_gp;

        			$ultimos = $this->db->select('id_usuario')
        								->from('resultados_usuarios_2011')
        								->where('id_gp',$this->id_gp)
        								->where('puntos_manager_gp',$puntos_posicion)
        								->get()->result();

        			foreach($ultimos as $ult){

        				$data_insert = array(
        								'id_recompensa'			=>				'',
        								'id_usuario'			=>				$ult->id_usuario,
        								'num_estrellas'			=>				1,
        								'estado'				=>				'P',
        								'id_gp'					=>				$this->id_gp,
        								'fecha_creacion'		=>				date('Y-m-d H:i:s')

        							);

		        		$this->db->insert('recompensa',$data_insert);

        			}
        	}

        	*/
        }

        // Recogemos todos los usuarios con la misma puntuacion que el top25, excepto al propio top25 para abajo
        // que ya los hemos tramitado antes
        $ultimos = $this->db->select('id_usuario')
        								->from('resultados_usuarios_2011')
        								->where('id_gp',$this->id_gp)
        								->where('puntos_manager_gp',$puntos_ultimo_top)
        								->where('puesto_gp >',25)
        								->get()->result();

		foreach($ultimos as $ult){

			$data_insert = array(
							'id_recompensa'			=>				'',
							'id_usuario'			=>				$ult->id_usuario,
							'num_estrellas'			=>				2,
							'estado'				=>				'P',
							'id_gp'					=>				$this->id_gp,
							'fecha_creacion'		=>				date('Y-m-d H:i:s')

						);

    		$this->db->insert('recompensa',$data_insert);

		}

		// ACTUALIZADO : Ahora daremos a todos los usuarios que queden por debajo del TOP25 media estrella, simplemente por participar
		// de este modo ,en  algun momento podra realizar canjeos.
		$restantes = $this->db->select('id_usuario,puntos_manager_gp')
								->from('resultados_usuarios_2011')
								->where('id_gp', $this->id_gp)
								->where('puntos_manager_gp <', $puntos_ultimo_top)
								->where('puesto_gp >', 25)
								->get()->result();

		foreach($restantes as $res){

			$data_insert = array(
							'id_recompensa'			=>				'',
							'id_usuario'			=>				$res->id_usuario,
							'num_estrellas'			=>				1,
							'estado'				=>				'P',
							'id_gp'					=>				$this->id_gp,
							'fecha_creacion'		=>				date('Y-m-d H:i:s')

						);

    		$this->db->insert('recompensa',$data_insert);

		}

        // Poner GP como PROCESADO
        $sql_cerrar_gp = "UPDATE circuitos set procesado = 1 WHERE id = ?";
		$this->db->query($sql_cerrar_gp,array($this->id_gp));

		echo "TODOS LOS DATOS ACTUALIZADOS!";

	}

	// ----------------------------------------------------------------------------------
	// Llenar tabla resultados usuarios con los resultados del GP e Ingresar
	// dinero ganado en el BANCO
	// ----------------------------------------------------------------------------------
	function procesar_resultados_usuarios()
	{


		// ----------------------------------------------------------------------------------
		// Obtener datos de la tabla desgloses ordenado de Mas puntos conseguidos a menos
		// ----------------------------------------------------------------------------------
		$sql = "SELECT sum(dinero) as dinero,sum(puntos) as puntos ,id_usuario  FROM resultados_usuarios_desglose
				WHERE id_gp = ?
				group by id_usuario
				order by puntos desc";
		$Q = $this->db->query($sql,array($this->id_gp));
		// ----------------------------------------------------------------------------------
		//Contador posicion GP
		// ----------------------------------------------------------------------------------
		$i =  1;

		// ----------------------------------------------------------------------------------
		// Recorremos los resultados, de primero a ultimo
		// ----------------------------------------------------------------------------------
		foreach( $Q->result() as $pu)
		{

		  // ----------------------------------------------------------------------------------
		  // Ingresar en resultados_usuarios_2011 los puntos y la posicion en este GP
		  // ----------------------------------------------------------------------------------
		   $sql_insert_resultados = "INSERT INTO resultados_usuarios_2011
		   				  VALUES('',{$this->id_gp},{$pu->id_usuario},{$i},{$pu->puntos},0,0)";

		   $this->db->query($sql_insert_resultados);

		   // ----------------------------------------------------------------------------------
		   // Ingresar en el banco sus ganancias
		   // ----------------------------------------------------------------------------------
		   $this->banco_model->sumarDinero( $pu->dinero , $pu->id_usuario);

		   $i++;
		}


		echo "Resultados de usuario procesados !! Vamos ya queda poco :D";
		echo "<br>";
		echo anchor('scripts/procesar_puntos_totales','SIGUIENTE--> Procesar Puntos Manager totales de todos los GPs');

	}


	function puntos_manager_totales()
	{
		// ----------------------------------------------------------------------------------
		// Obtener datos de la tabla desgloses ordenado de Mas puntos
		// conseguidos a menos en todos los GP´s
		// ----------------------------------------------------------------------------------
		$sql = "SELECT sum(puntos) as puntos ,id_usuario  FROM resultados_usuarios_desglose
				group by id_usuario
				order by puntos desc";
		$Q = $this->db->query($sql,array($this->id_gp));

		$i = 1;

		/**
		 * MODIFICACION(10/04/2011): Guardo en un campo los puntos totales para luego poder
		 * mostrar el ranking general de cada gp. Agregar campo puntos_manager_total_gp a la tabla
		 */
		foreach($Q->result() as $pu)
		{
			$sql_update = "UPDATE
							resultados_usuarios_2011
						   SET
						   	puesto_general= ?,
							puntos_manager_total_gp = ?

						   WHERE
						    id_gp = ? AND id_usuario = ?";

			$this->db->query($sql_update, array( $i , $pu->puntos ,$this->id_gp, $pu->id_usuario));

			$i++;
		}

		echo anchor('scripts/procesar_apuestas','SIGUIENTE--> Procesar Apuestas y hacer ingresos de ganancias');
	}


	function insertar_en_desglose( $datos )
	{

		$sql_dinero_puntos = "INSERT INTO
								resultados_usuarios_desglose(id_piloto,id_gp,dinero,puntos,id_usuario,tipo,id_equipo)
							  VALUES
							  	(	'{$datos['id_piloto']}',
									'{$datos['id_gp']}',
									'{$datos['dinero']}',
									'{$datos['puntos']}',
									'{$datos['id_usuario']}',
									'{$datos['tipo']}',
									'{$datos['id_equipo']}'
								)";
		$this->db->query($sql_dinero_puntos);
	}

	function _puntos_banco()
	{

	// ----------------------------------------------------------------------------------
		// Puntos Banco
		// ----------------------------------------------------------------------------------
		$sql_banco = "SELECT usuarios.id,usuarios_banco.fondos
						FROM usuarios,usuarios_banco
						WHERE usuarios.id = usuarios_banco.id_usuario
						ORDER BY fondos ASC";
		$q_banco = $this->db->query($sql_banco)->result();



		foreach($q_banco as $ub)
		{
			// Comprobar dinero en el banco
			// y gestionar penalizaciones
			$fondos_actuales = $this->banco_model->getSaldoUsuario( $ub->id);

			if( $fondos_actuales < -150000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = -8;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );

				continue;

			}

			elseif( $fondos_actuales >= -150000 AND $fondos_actuales < -100000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = -6;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

			elseif( $fondos_actuales >= -100000 AND $fondos_actuales < -50000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = -4;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

			elseif( $fondos_actuales >= -50000 AND $fondos_actuales < 0)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = -2;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

		    elseif( $fondos_actuales >= 0 AND $fondos_actuales < 50000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = 1;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

			elseif( $fondos_actuales >= 50000 AND $fondos_actuales < 200000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = 2;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

			elseif( $fondos_actuales >= 200000 AND $fondos_actuales < 400000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = 4;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

			elseif( $fondos_actuales >= 400000 AND $fondos_actuales < 600000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = 5;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

		elseif( $fondos_actuales >= 600000 AND $fondos_actuales < 800000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = 7;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

		elseif( $fondos_actuales >= 800000 AND $fondos_actuales < 1000000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = 10;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

			elseif( $fondos_actuales >= 1000000 AND $fondos_actuales < 2000000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = 12;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

			elseif( $fondos_actuales >= 2000000 AND $fondos_actuales < 3000000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = 15;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

			elseif( $fondos_actuales >= 3000000 AND $fondos_actuales < 4000000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = 18;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

			elseif( $fondos_actuales >= 4000000 AND $fondos_actuales < 5000000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = 22;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

			elseif( $fondos_actuales >= 5000000)
			{
				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = 25;
				$datos['id_usuario'	] = $ub->id;
				$datos['tipo'		] = 'banco';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );
				continue;
			}

			else
			{
				continue;
			}

		}


	}

	function _desglose_publicistas()
	{
		$sql = "SELECT id FROM usuarios";

		$usuarios = $this->db->query($sql)->result();

		foreach($usuarios as $usuario)
		{

			// --------------------------------------------------------------------------------
			// Obtener mejoras del usuario
			// --------------------------------------------------------------------------------
			$sql_mejoras = "SELECT * FROM usuarios_mejoras WHERE id_usuario = ? and id_mejora = ?";

			$mejoras = $this->db->query( $sql_mejoras , array($usuario->id ,4));

			if( $mejoras->num_rows() )
			{

				$usuario_publicistas_lvl = $mejoras->row()->nivel;

				$sql_ganancias = "SELECT sum(dinero) as dinero FROM resultados_usuarios_desglose where id_usuario=? and id_gp=?";
				$ganancias = $this->db->query($sql_ganancias,array($usuario->id,$this->id_gp))->row()->dinero;

				$datos['id_piloto'	] = 0;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = $ganancias * $this->publicistas[$usuario_publicistas_lvl];
				$datos['puntos'		] = 0;
				$datos['id_usuario'	] = $usuario->id;
				$datos['tipo'		] = 'publicistas';
				$datos['id_equipo'  ] = 0;

				$this->insertar_en_desglose( $datos );

			}
			else
			{
				continue;
			}





		}
	}
}

?>