<?php

/**
 *  resultados_equipos_2011 , resultados_pilotos_2011 , estas dos tablas tienen ke tener los datos, y no se si alguna mas tambien...:S
 */
class Gestion_gp_2011 extends CI_Model
{
	private $id_gp;

	// --------------------------------------------------------------------------------
	// Porcentajes de mejora por nivel
	// --------------------------------------------------------------------------------
	private $ingenieros = array(
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

	// --------------------------------------------------------------------------------
	// Dinero y Puntos por posicion PILOTOS
	// --------------------------------------------------------------------------------
	private $dinero = array(
								'1'		=>		270000,
								'2'		=>		230000,
								'3'		=>		200000,
								'4'		=>		180000,
								'5'		=>		155000,
								'6'		=>		135000,
								'7'		=>		115000,
								'8'		=>		95000,
								'9'		=>		86000,
								'10'	=>		75000,
								'11'		=>		65000,
								'12'		=>		55000,
								'13'		=>		47000,
								'14'		=>		40000,
								'15'		=>		35000,
								'16'		=>		28000,
								'17'		=>		24000,
								'18'		=>		21000,
								'19'		=>		18000,
								'20'		=>		16000,
								'21'		=>		14000,
								'22'		=>		12000,
								'23'		=>		8000,
								'24'		=>		5000

							);

	private $puntos = array(
								'1'		=>		50,
								'2'		=>		43,
								'3'		=>		40,
								'4'		=>		37,
								'5'		=>		35,
								'6'		=>		33,
								'7'		=>		31,
								'8'		=>		29,
								'9'		=>		27,
								'10'	=>		25,
								'11'		=>		23,
								'12'		=>		20,
								'13'		=>		17,
								'14'		=>		14,
								'15'		=>		11,
								'16'		=>		8,
								'17'		=>		5,
								'18'		=>		3,
								'19'		=>		2,
								'20'		=>		1,
								'21'		=>		1,
								'22'		=>		1,
								'23'		=>		1,
								'24'		=>		1


							);

	// --------------------------------------------------------------------------------
	// Dinero EQUIPOS
	// --------------------------------------------------------------------------------
	private $dinero_equipos = array(

									'1'		=>	100000,
									'2'		=>	75000,
									'3'		=>  50000,
									'4'		=>  40000,
									'5'		=>  20000
									);

	function Gestion_gp_2011()
	{
		parent::__construct();
		$this->set_gp_a_procesar();
		$this->load->model('pilotos/pilotos_model');

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


	// Procesar GP
	function procesar_gp( $limite , $tot_usuarios)
	{
		// --------------------------------------------------------------------------------
		// Recoger usuarios por oleadas de 300
		// --------------------------------------------------------------------------------
		$sql_usuarios = "SELECT id FROM usuarios limit {$limite},300";
		$usuarios = $this->db->query($sql_usuarios)->result();

		// --------------------------------------------------------------------------------
		// Resultados GP : Pilotos.Obtenemos listado ordenado por puesto de los resultados ASC
		// --------------------------------------------------------------------------------
		$sql = "SELECT id_piloto,posicion FROM resultados_pilotos_2011 WHERE id_gp = ? ORDER BY posicion ASC";

		$Q = $this->db->query($sql,array($this->id_gp));
		$resultado_gp = $Q->result_array();

		// --------------------------------------------------------------------------------
		// Resultados GP : Equipos
		// --------------------------------------------------------------------------------
		$equipos_ganadores = $this->db->query("SELECT * FROM resultados_equipos_2011 WHERE id_gp = ?",array($this->id_gp))->row();



		// --------------------------------------------------------------------------------
		// Recorrer usuarios buscando pilotos premiados
		// --------------------------------------------------------------------------------

		foreach( $usuarios as $usuario)
		{

			/*BUG 2011 CORREGIDO*/
			/* No se estaba reiniciando el valor de los ingenieros ni publicistas por cada usuario, por lo que si el usuario anterior
			   Tiene una mejora que el actual no tiene, al actual tb se le otorga, hasta encontrar un  user que tb tengo y lo machaque
			*/
			$usuario_ingenieros_lvl = false;
			$usuario_publicistas_lvl = false;

			// Pilotos activos del usuario
			$sql_usu_pilotos   = "SELECT *
								  FROM usuarios_pilotos, boxes
								  WHERE boxes.id_circuito ={$this->id_gp}
								  AND usuarios_pilotos.activo =1
								  AND usuarios_pilotos.fecha_fichaje < boxes.fecha_cerrar
								  AND usuarios_pilotos.id_usuario = ?
								  order by id_usuario ASC";
			$pilotos_usuario   =  $this->db->query($sql_usu_pilotos,array($usuario->id));




			// --------------------------------------------------------------------------------
			// Obtener mejoras del usuario
			// --------------------------------------------------------------------------------
			$sql_mejoras = "SELECT * FROM usuarios_mejoras WHERE id_usuario = ?";

			$mejoras = $this->db->query( $sql_mejoras , array($usuario->id));

			if( $mejoras->num_rows() )
			{
				foreach( $mejoras->result() as $mejora)
				{
					if( $mejora->id_mejora == 3 )
					{
						$usuario_ingenieros_lvl = $mejora->nivel;
						continue;
					}

					if( $mejora->id_mejora == 4)
					{
						$usuario_publicistas_lvl = $mejora->nivel;
						continue;
					}
				}
			}



			// Si no tiene pilotos,nos saltamos este tramo
			if($pilotos_usuario->num_rows() > 0)
			{
				// --------------------------------------------------------------------------------
				// Recorremos pilotos del usuario
				// --------------------------------------------------------------------------------
				foreach( $pilotos_usuario->result() as $pu)
				{
					################ PRIMER PUESTO ######################
					if ( $pu->id_piloto == $resultado_gp[0]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'1',$usuario_ingenieros_lvl);
						continue;
					}
					################ SEGUNDO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[1]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'2',$usuario_ingenieros_lvl);
						continue;
					}
					################ TERCER PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[2]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'3',$usuario_ingenieros_lvl);
						continue;
					}
					################ CUARTO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[3]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'4',$usuario_ingenieros_lvl);
						continue;
					}
					################ QUINTO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[4]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'5',$usuario_ingenieros_lvl);
						continue;
					}
					################ SEXTO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[5]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'6',$usuario_ingenieros_lvl);
						continue;
					}
					################ SEPTIMO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[6]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'7',$usuario_ingenieros_lvl);
						continue;
					}
					################ OCTAVO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[7]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'8',$usuario_ingenieros_lvl);
						continue;
					}
					################ NOVENO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[8]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'9',$usuario_ingenieros_lvl);
						continue;
					}
					################ DECIMO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[9]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'10',$usuario_ingenieros_lvl);
						continue;
					}

					/********* NOVEDAD 2012, TODOS LOS PILOTOS PUNTUAN! *********/

					################ DECIMO PRIMER PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[10]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'11',$usuario_ingenieros_lvl);
						continue;
					}
					################ DECIMO SEGUNDO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[11]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'12',$usuario_ingenieros_lvl);
						continue;
					}
					################ DECIMO TERCER PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[12]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'13',$usuario_ingenieros_lvl);
						continue;
					}
					################ DECIMO CUARTO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[13]['id_piloto'])
					{
						$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'14',$usuario_ingenieros_lvl);
						continue;
					}
					################ DECIMO QUINTO PUESTO ######################
					/*A PARTIR DEL 15 se comprueba que no haya sido abandono*/
					elseif( $pu->id_piloto == $resultado_gp[14]['id_piloto'])
					{
						if($resultado_gp[14]['posicion'] != 25)
						{
							$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'15',$usuario_ingenieros_lvl);
							continue;
						}
						else
						{
							continue;
						}

					}
					################ DECIMO SEXTO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[15]['id_piloto'])
					{
						if($resultado_gp[15]['posicion'] != 25)
						{
							$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'16',$usuario_ingenieros_lvl);
							continue;
						}
						else
						{
							continue;
						}
					}
					################ DECIMO SEPTIMO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[16]['id_piloto'])
					{
						if($resultado_gp[16]['posicion'] != 25)
						{
							$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'17',$usuario_ingenieros_lvl);
							continue;
						}
						else
						{
							continue;
						}
					}
					################ DECIMO OCTAVO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[17]['id_piloto'])
					{
						if($resultado_gp[17]['posicion'] != 25)
						{
							$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'18',$usuario_ingenieros_lvl);
							continue;
						}
						else
						{
							continue;
						}
					}
					################ DECIMO NOVENO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[18]['id_piloto'])
					{
						if($resultado_gp[18]['posicion'] != 25)
						{
							$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'19',$usuario_ingenieros_lvl);
							continue;
						}
						else
						{
							continue;
						}
					}
					################ VIGESIMO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[19]['id_piloto'])
					{
						if($resultado_gp[19]['posicion'] != 25)
						{
							$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'20',$usuario_ingenieros_lvl);
							continue;
						}
						else
						{
							continue;
						}
					}
					################ VIGESIMO PRIMERO  ######################
					elseif( $pu->id_piloto == $resultado_gp[20]['id_piloto'])
					{
						if($resultado_gp[20]['posicion'] != 25)
						{
							$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'21',$usuario_ingenieros_lvl);
							continue;
						}
						else
						{
							continue;
						}
					}
					################ VIGESIMO SEGUNDO ######################
					elseif( $pu->id_piloto == $resultado_gp[21]['id_piloto'])
					{
						if($resultado_gp[21]['posicion'] != 25)
						{
							$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'22',$usuario_ingenieros_lvl);
							continue;
						}
						else
						{
							continue;
						}
					}
					################ VIGESIMO TERCERO ######################
					elseif( $pu->id_piloto == $resultado_gp[22]['id_piloto'])
					{
						if($resultado_gp[22]['posicion'] != 25)
						{
							$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'23',$usuario_ingenieros_lvl);
							continue;
						}
						else
						{
							continue;
						}
					}
					################ VIGESIMO PUESTO ######################
					elseif( $pu->id_piloto == $resultado_gp[23]['id_piloto'])
					{
						if($resultado_gp[23]['posicion'] != 25)
						{
							$this->procesamiento_por_posicion( $pu->id_piloto , $usuario->id ,'24',$usuario_ingenieros_lvl);
							continue;
						}
						else
						{
							continue;
						}
					}

					################ FUERA DE PUESTOS: SIN PREMIOS ######################
					else
					{
						continue;
					}

				}//FIN FOREACH PILOTOS USUARIO

			} // Fin IF  tiene pilotos

			// --------------------------------------------------------------------------------
			// Recogemos equipos activos del usuario
			// --------------------------------------------------------------------------------
			$sql_usu_equipos   = "SELECT *
								  FROM usuarios_equipos, boxes
								  WHERE boxes.id_circuito ={$this->id_gp}
								  AND usuarios_equipos.activo =1
								  AND usuarios_equipos.fecha_compra < boxes.fecha_cerrar
								  AND usuarios_equipos.id_usuario = ?
								  order by id_usuario ASC";

			$equipos_usuario = $this->db->query( $sql_usu_equipos ,array($usuario->id));

			if( $equipos_usuario->num_rows() > 0 )
			{

				foreach( $equipos_usuario->result() as $eu )
				{

					if($eu->id_equipo == $equipos_ganadores->id_primero)
					{
						$this->procesamiento_por_posicion_equipos( $eu->id_equipo ,$usuario->id,'1');
						//continue;
					}

					if($eu->id_equipo == $equipos_ganadores->id_segundo)
					{
						$this->procesamiento_por_posicion_equipos( $eu->id_equipo ,$usuario->id,'2');
						//continue;
					}

					if($eu->id_equipo == $equipos_ganadores->id_tercero)
					{
						$this->procesamiento_por_posicion_equipos( $eu->id_equipo ,$usuario->id,'3');
						//continue;
					}

					if($eu->id_equipo == $equipos_ganadores->id_cuarto)
					{
						$this->procesamiento_por_posicion_equipos( $eu->id_equipo ,$usuario->id,'4');
						//continue;
					}

					if($eu->id_equipo == $equipos_ganadores->id_quinto)
					{
						$this->procesamiento_por_posicion_equipos( $eu->id_equipo ,$usuario->id,'5');
						//continue;
					}

				}

			}

		}//FIN FOREACH USUARIOS


		if( $limite < $tot_usuarios )
		{

			switch ($limite)
			{
				case '0':
					echo anchor('scripts/gestionar_gp/300/'.$tot_usuarios,'SIGUIENTE --> Procesar usuarios del 300 al 600 ');
				break;

				case '300':
					echo anchor('scripts/gestionar_gp/600/'.$tot_usuarios,'SIGUIENTE --> Procesar usuarios del 600 al 900 ');
				break;

				case '600':
					echo anchor('scripts/gestionar_gp/900/'.$tot_usuarios,'SIGUIENTE --> Procesar usuarios del 900 al 1200 ');
				break;

				case '900':
					echo anchor('scripts/gestionar_gp/1200/'.$tot_usuarios,'SIGUIENTE --> Procesar usuarios del 1200 al 1500 ');
				break;

				case '1200':
					echo anchor('scripts/gestionar_gp/1500/'.$tot_usuarios,'SIGUIENTE --> Procesar usuarios del 1500 al 1800 ');
				break;

				case '1500':
					echo anchor('scripts/gestionar_gp/1800/'.$tot_usuarios,'SIGUIENTE --> Procesar usuarios del 1800 al 2100 ');
				break;

				case '1800':
					echo anchor('scripts/gestionar_gp/2100/'.$tot_usuarios,'SIGUIENTE --> Procesar usuarios del 2100 al 2400 ');
				break;

				case '2100':
					echo anchor('scripts/gestionar_gp/2400/'.$tot_usuarios,'SIGUIENTE --> Procesar usuarios del 2400 al 2700 ');
				break;

			}
		}
		else
		{
			echo anchor('scripts/desglose_banco','SIGUIENTE --> Insertar puntos por desglose BANCO');
		}


		// --------------------------------------------------------------------------------
		// Desglose publicistas (hay ke hacerlo al final con los totales)
		// --------------------------------------------------------------------------------



	}

	/**
	 *
	 * @return
	 * @param $datos Object
	 */
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

	/**
	 * Procesamiento por posicion
	 * ===========================================================================================
	 * Se encarga de procesar todas las posiciones. Recive el id del piloto, el id del usuario,
	 * la posicion que tiene que procesar y el nivel de los ingenieros de ese usuario.
	 *
	 * Llena la tabla de resultados_usuarios_desglose , metiendo los premios obtenidos en cada seccion
	 *
	 * @return
	 * @param $id_piloto Object
	 * @param $id_usuario Object
	 * @param $pos Object
	 * @param $usuarios_ingenieros_lvl Object
	 */
	function procesamiento_por_posicion( $id_piloto , $id_usuario , $pos , $usuario_ingenieros_lvl)
	{
		// --------------------------------------------------------------------------------
		// Desglose pilotos
		// --------------------------------------------------------------------------------
		$datos['id_piloto'	] = $id_piloto;
		$datos['id_gp'		] = $this->id_gp;
		$datos['dinero'		] = $this->dinero[$pos];
		$datos['puntos'		] = $this->puntos[$pos];
		$datos['id_usuario'	] = $id_usuario;
		$datos['tipo'		] = 'pilotos';

		$this->insertar_en_desglose( $datos );

		// Actualizamos tabla de pilotos con los puntos
		// conseguidos para mostrar en su ficha
		$this->db->query("UPDATE usuarios_pilotos
						  SET puntos=puntos + {$this->puntos[$pos]}
						  WHERE id_usuario = {$id_usuario}
						  AND id_piloto = {$id_piloto} ");


		// --------------------------------------------------------------------------------
		// Desglose STIKIS ( dentro desglose ingenieros tb)
		// --------------------------------------------------------------------------------

		$sql_stikis = "SELECT * FROM stikis_usuarios WHERE id_usuario = ? AND id_gp = ? AND id_piloto = ?";
		$stiki = $this->db->query( $sql_stikis , array($id_usuario,$this->id_gp,$id_piloto));

		// tiene Stikis?
		if($stiki->num_rows())
		{

			// --------------------------------------------------------------------------------
			// Desglose STIKIS PUNTOS
			// --------------------------------------------------------------------------------
			if( $stiki->row()->stiki == 'puntos')
			{
				$datos['id_piloto'	] = $id_piloto;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = 0;
				$datos['puntos'		] = $this->puntos[$pos];
				$datos['id_usuario'	] = $id_usuario;
				$datos['tipo'		] = 'stiki_puntos';

				$this->insertar_en_desglose( $datos );
			}
			// --------------------------------------------------------------------------------
			// Desglose STIKIS DINERO
			// --------------------------------------------------------------------------------
			if( $stiki->row()->stiki == 'dinero')
			{
				$datos['id_piloto'	] = $id_piloto;
				$datos['id_gp'		] = $this->id_gp;
				$datos['dinero'		] = $this->dinero[$pos];
				$datos['puntos'		] = 0;
				$datos['id_usuario'	] = $id_usuario;
				$datos['tipo'		] = 'stiki_dinero';

				$this->insertar_en_desglose( $datos );
			}
			// --------------------------------------------------------------------------------
			// Desglose INGENIEROS
			// --------------------------------------------------------------------------------
			if( $usuario_ingenieros_lvl)
			{
				if( $stiki->row()->stiki == 'dinero')
				{
					$datos['id_piloto'	] = $id_piloto;
					$datos['id_gp'		] = $this->id_gp;
					$datos['dinero'		] = $this->dinero[$pos] * $this->ingenieros[$usuario_ingenieros_lvl];
					$datos['puntos'		] = 0;
					$datos['id_usuario'	] = $id_usuario;
					$datos['tipo'		] = 'ingenieros';


					$this->insertar_en_desglose( $datos );
				}

				if( $stiki->row()->stiki == 'puntos')
				{
					$datos['id_piloto'	] = $id_piloto;
					$datos['id_gp'		] = $this->id_gp;
					$datos['dinero'		] = 0;
					$datos['puntos'		] = $this->puntos[$pos] * $this->ingenieros[$usuario_ingenieros_lvl];
					$datos['id_usuario'	] = $id_usuario;
					$datos['tipo'		] = 'ingenieros';

					$this->insertar_en_desglose( $datos );
				}

			}
		}
	}


	function procesamiento_por_posicion_equipos( $id_equipo , $id_usuario , $pos)
	{
		$datos['id_piloto'	] = 0;
		$datos['id_gp'		] = $this->id_gp;
		$datos['dinero'		] = $this->dinero_equipos[$pos];
		$datos['puntos'		] = 0;
		$datos['id_usuario'	] = $id_usuario;
		$datos['tipo'		] = 'equipos';
		$datos['id_equipo'  ] = $id_equipo;

		$this->insertar_en_desglose( $datos );

		// Actualizamos tabla de equipos con el dinero
		// conseguido para mostrar en su ficha
		$this->db->query("UPDATE usuarios_equipos SET puntos = puntos + {$this->dinero_equipos[$pos]}
															  WHERE id_usuario = {$id_usuario}
															  AND id_equipo = {$id_equipo} ");
	}


	function get_formulario_resultados( $listado )
	{
		$i = 0; //
		$p = 0; //

		$color = '#e6ccff;';
		$html = '<form method="post" action ="'.site_url().'scripts" >';

		$html .= '<table><th>Piloto</th><th >Posicion</th><th>Poleman</th>';

		foreach( $listado as $li)
		{
			if($li->id%2 == 0)
			{
				$color = 'style="background-color:#400080;color:#ffffff;"';
			}
			else
			{
				$color = 'style="background-color:#008040;color:#000000;"';
			}
			$html .= '<tr '.$color.'><td>'.$li->nombre.' '.$li->apellido.'</td><td>';
			$html .= '<select name="'.$li->id.'">';

			for($p=1;$p<26;$p++)
			{
				if($p == 25)
				{
					$html .= '<option value="'.$p.'"> Abandono </option>';
					continue;
				}

				$html .= '<option value="'.$p.'"> '.$p.'º </option>';


			}

			$html .= '</select></td><td>  Si<input type="radio" name="poleman'.$li->id.'" value="1"> | No <input type="radio" name="poleman'.$li->id.'" value="0" checked> </td></tr>';
		}

		$html .= '<tr><td colspan="4" align="center"> <input type="submit" value="Guardar"></td></tr>';

		$html .= '</table>';

		$html .= '</form>';

		return $html;
	}


	// Guardar en base de datos los resultados del GP que se han metido en el formulario
	//
	function guardar_resultados_gp( $datos )
	{

		$pilotos = $this->pilotos_model->getInfoPilotosEquipos();

		foreach( $pilotos as $piloto)
		{
			// Guardar piloto  resultado y poleman
			$sql = "INSERT INTO resultados_pilotos_2011 VALUES('',?,?,?,?)";
			$this->db->query( $sql , array($piloto->id,$this->id_gp,$datos[$piloto->id],$datos['poleman'.$piloto->id]));

			// Guardar Equipos ganadores
			if( $datos[$piloto->id] < 6)
			{
				// seleccionar el equipo del piloto
				$sql_sel_equipo = "SELECT equipos.id as id_equipo
								FROM
									equipos_rel_pilotos, pilotos , equipos
								WHERE
									pilotos.id = equipos_rel_pilotos.id_piloto
								AND
									equipos.id = equipos_rel_pilotos.id_equipo
				                AND
				                  pilotos.id = ?";

				$id_equipo = $this->db->query($sql_sel_equipo,array($piloto->id))->row()->id_equipo;

				// Comprobar si ya se ha creado el registor del gp en resultados_equipos
				$sql_check = "select id FROM resultados_equipos_2011 WHERE id_gp = ?";
				$Q = $this->db->query($sql_check,array($this->id_gp));

				if( $Q->num_rows() )
				{

					switch ($datos[$piloto->id])
					{
						case 1:
							$sql_equipos = "UPDATE resultados_equipos_2011 SET id_primero = ? where id_gp = ?";
							$this->db->query($sql_equipos,array($id_equipo, $this->id_gp));
						break;

						case 2:
							$sql_equipos = "UPDATE resultados_equipos_2011 SET id_segundo = ? where id_gp = ?";
							$this->db->query($sql_equipos,array($id_equipo, $this->id_gp));
						break;

						case 3:
							$sql_equipos = "UPDATE resultados_equipos_2011 SET id_tercero = ? where id_gp = ?";
							$this->db->query($sql_equipos,array($id_equipo, $this->id_gp));
						break;

						case 4:
							$sql_equipos = "UPDATE resultados_equipos_2011 SET id_cuarto = ? where id_gp = ?";
							$this->db->query($sql_equipos,array($id_equipo, $this->id_gp));
						break;

						case 5:
							$sql_equipos = "UPDATE resultados_equipos_2011 SET id_quinto = ? where id_gp = ?";
							$this->db->query($sql_equipos,array($id_equipo, $this->id_gp));
						break;

					}
				}
				else
				{
					$sql_equipos = "INSERT INTO resultados_equipos_2011 VALUES('',?,?,?,?,?,?)";

					switch ($datos[$piloto->id])
					{
						case 1:
							$this->db->query($sql_equipos,array($this->id_gp,$id_equipo,0,0,0,0));
						break;

						case 2:
							$this->db->query($sql_equipos,array($this->id_gp,0,$id_equipo,0,0,0));
						break;

						case 3:
							$this->db->query($sql_equipos,array($this->id_gp,0,0,$id_equipo,0,0));
						break;

						case 4:
							$this->db->query($sql_equipos,array($this->id_gp,0,0,0,$id_equipo,0));
						break;

						case 5:
							$this->db->query($sql_equipos,array($this->id_gp,0,0,0,0,$id_equipo));
						break;

					}


				}


			}
		}

		echo "datos guardados.";
	}

	function check_resultados_metidos()
	{
		$sql = "SELECT id FROM resultados_pilotos_2011 WHERE id_gp=?";
		$Q = $this->db->query($sql,array($this->id_gp));


		if( $Q->num_rows() )
		{

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
