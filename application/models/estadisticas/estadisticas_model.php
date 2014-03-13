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

	function stikisComprados($tipo = 'puntos')
	{
		/*DEPRECATED*/
		/*
		$idGp = $this->db->query("SELECT id_gp
							  FROM stikis_gp
							  WHERE procesado = 0
							  ORDER BY id ASC
							  LIMIT 0,1"
							 )->row()->id_gp;
		*/
		$sql_id_gp = "select * from circuitos
							where procesado=0
							order by fecha asc
							limit 1";
		$idGp = $this->db->query($sql_id_gp)->row()->id_gp;

		if( $tipo == 'puntos'){

			$sql = "SELECT id FROM stikis_usuarios WHERE id_gp = ? AND stiki = 'puntos'";
			return $this->db->query($sql,array($idGp))->num_rows();
		}
		else{

			$sql2 = "SELECT id FROM stikis_usuarios WHERE id_gp = ? AND stiki = 'dinero'";
			return $this->db->query($sql2,array($idGp))->num_rows();
		}
	}

	function usuarios_registrados()
	{
		$sql = "SELECT id FROM usuarios";
		$Q = $this->db->query($sql);

		return $Q->num_rows();
	}

	function gp_a_procesar()
	{
		$sql = "SELECT * FROM circuitos WHERE procesado = 0 ORDER BY id ASC limit 0,1";
		$query = $this->db->query($sql);

		$gp = $query->row()->circuito."( ".$query->row()->pais." )";

		return $gp;
	}



	/**
	 * Ultimos pilotos comprados
	 *
	 * @return void
	 * @author
	 **/
	function  get_ultimos_comprados ( $max  = 12)
	{

		$query  = $this->db->select('pilotos.id,nombre,apellido,foto')
						   ->from('usuarios_pilotos')
						   ->join('pilotos','pilotos.id = usuarios_pilotos.id_piloto')
						   ->order_by('fecha_fichaje','desc')
						   ->limit($max)
						   /*->distinct()*/
						   ->get();


		$ultimos = $query->result();

		// Total usuarios que han fichado alguna  vez
		$tot = $this->db->select('id')->from('usuarios_pilotos')->group_by('id_usuario')->get()->num_rows();
		//dump($tot);die;


		$ultimos_fichajes = array();

		foreach($ultimos as $piloto)
		{
			$info_pilotos = new stdClass();

			$info_pilotos->nombre_completo = $piloto->nombre." ".$piloto->apellido;
			$info_pilotos->imagen = $piloto->foto.".jpg";

			// Total fichajes de este piloto por usuarios
			$tot_fichajes = $this->db->select('id')
									 ->from('usuarios_pilotos')
									 ->where('id_piloto',$piloto->id)
									 ->get()
									 ->num_rows();
			$numerof = $tot_fichajes*100 / $tot;

			// Total ventas de este piloto por usuarios
			$tot_vendido = $this->db->select('id')
									 ->from('usuarios_pilotos')
									 ->where('id_piloto',$piloto->id)
									 ->where('activo',0)
									 ->get()
									 ->num_rows();

			$numerov = $tot_vendido*100 / $tot;

			$info_pilotos->por_fichaje = number_format($numerof, 2, ",", ".");
			$info_pilotos->por_venta = number_format($numerov, 2, ",", ".");



			$ultimos_fichajes[] = $info_pilotos;

		}


		//return $query->result();
		return $ultimos_fichajes;


	}


	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	function get_full_stats($id_perfil)
	{
		$stats = array();

		$id_visitante = $_SESSION['id_usuario'];

		// Pilotos activos
		$stats['num_pilotos_fichados'] = $this->db->select('id')->from('usuarios_pilotos')->where('id_usuario',$id_perfil)->where('activo','1')->get()->num_rows();
		

		// Equipos activos
		$stats['num_equipos_fichados'] = $this->db->select('id')->from('usuarios_equipos')->where('id_usuario',$id_perfil)->where('activo','1')->get()->num_rows();

		// Mejoras
		$q_mejoras = $this->db->select('*')->from('usuarios_mejoras')->where('id_usuario',$id_perfil)->get();

		$stats['dinero_invertido_mejoras'] = $this->_get_gasto_mejoras($q_mejoras);
		$stats['maximo_posible_mejoras'] = 4860000;

		// Estrellas computadas
		$stats['estrellas_computadas'] = $this->db->select('id_recompensa')->from('recompensa')->where('id_usuario',$id_perfil)->where('estado','u')->get()->num_rows();

		// Posts en foros
		/*DEPRECATED*/
		/* ABRI KE MIRAR LOS POST KE LLEVA EN EL FORO PHPBB
		$f1 = $this->db->select('id')->from('foro')->where('id_usuario',$id_perfil)->get()->num_rows();
		$f2 = $this->db->select('id')->from('foroayuda')->where('id_usuario',$id_perfil)->get()->num_rows();
		$f3 = $this->db->select('id')->from('foroformula1')->where('id_usuario',$id_perfil)->get()->num_rows();
		$f4 = $this->db->select('id')->from('foroofftopic')->where('id_usuario',$id_perfil)->get()->num_rows();
		
		$stats['total_posts'] = $f1+$f2+$f3+$f4;
		*/
		$this->load->model('usuarios/usuarios_model');
		$this->load->model('foro/forophpbb_model');
		$nick_usuario = $this->usuarios_model->userData($id_perfil)->nick;
		$stats['total_posts'] = $this->forophpbb_model->get_num_post($nick_usuario);

		// Reconnecar a la bd default -no se porke a veces se txina
		$this->db = $this->load->database('default',TRUE);
		// stikis
		$stats['total_stikis_dinero'] = $this->db->select('id')->from('stikis_usuarios')->where('id_usuario',$id_perfil)->where('stiki','dinero')->get()->num_rows();
		$stats['total_stikis_puntos'] = $this->db->select('id')->from('stikis_usuarios')->where('id_usuario',$id_perfil)->where('stiki','puntos')->get()->num_rows();
		// total ingresos
		$stats['total_ingresos'] = $this->db->select_sum('dinero')->from('resultados_usuarios_desglose')->where('id_usuario',$id_perfil)->get()->row()->dinero;

		$sql = 'select max(sal) as pastaza from (select sum(dinero) as sal from resultados_usuarios_desglose group by id_usuario) as pastaza ';
		$stats['total_maximo_ingresos'] = $this->db->query($sql)->row()->pastaza;


		// Firmas
		$stats['total_firmas'] = $this->db->select('id')->from('perfil_muro')->where('id_to',$id_perfil)->get()->num_rows();

		// Visitas
		$stats['total_visitas'] = $this->db->select('id')->from('perfil_visitas')->where('id_visitado',$id_perfil)->get()->num_rows();


		//dump($stats);die;
		return $stats;

	}



	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	function _get_gasto_mejoras($mejoras)
	{
		if(!$mejoras)
			return 0;

		// Array valores x mejora
		$r = $this->db->select('*')->from('mejoras')->get()->result();

		foreach($r as $result)
		{
			for($i=1;$i<11;$i++)
			{
				$nivel = 'nivel_'.$i;
				$x = $i - 1;

				/*echo $nivel;
				echo $nivel_anterior;
				echo "<br>";*/

				if($i==1)
				{
					$datos[$result->id][$i] = $result->$nivel;
				}
				else
				{
					$datos[$result->id][$i] = ($result->$nivel + $datos[$result->id][$x]);
				}

			}


		}

		//dump($datos);die;

		foreach($mejoras->result() as  $mejora)
		{

			$gastos = $gastos + $datos[$mejora->id_mejora][$mejora->nivel];

		}

		return $gastos;

	}


	/**
	 * Devuelve los fichajes y las ventas del dia anterior
	 *
	 * @return void
	 * @author 
	 **/
	function get_info_fichajes_ventas()
	{
		//$fecha = date('Y-m-d');
		//$ayer = date('Y-m-d',strtotime('-1 day',strtotime($fecha)));
		$ayer = date('Y-m-d');

		//$fecha_estadisticas = date('Y-m-d');//'2014-02-19';//date('Y-m-d');

		$fichajes = $this->db->select('*')->from('usuarios_pilotos')
										  
										  ->where('fecha_fichaje',$ayer)
										  ->get()
										  ->result();


		$ventas = $this->db->select('*')->from('usuarios_pilotos')->where('fecha_venta',$ayer)->get()->result();

		// Recorremos pilotos fichados en esa fecha
		foreach($fichajes as $fi)
		{
			 $suma_fichados = $suma_fichados + intval($fi->precio_fichaje);
		}

		// Si no ha habido fichajes le pasamos 0
		if(!$fichajes)
		{
			$fichados[] = intval(0);
		}
		else
		{
			$fichados[] = intval($suma_fichados);	
		}
		
		// Recorremos pilotos fichados en esa fecha
		foreach($ventas as $ve)
		{
			$suma_vendidos = $suma_vendidos + intval($ve->precio_venta);
		}
		// Si no ha habido ventas le pasamos 0
		if(!$ventas)
		{
			$vendidos[] = intval(0);
		}
		else
		{
			$vendidos[] = intval($suma_vendidos);	
		}
		

		$series_data[] = array('name' => 'Fichajes: ','data'=>$fichados);
		$series_data[] = array('name' => 'Ventas: ','data'=>$vendidos);

		return $series_data;
		
	}

	/**
	 * Devuelve el valor de mercado de todos los pilotos por dia
	 *
	 * @return void
	 * @author 
	 **/
	function get_info_valor_mercado_pilotos()
	{
		// Array con los meses para generar fecha legible
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

		$query = 'select sum(valor_actual) tot,DATE_FORMAT(fecha,"%Y-%m-%d") fec from valor_piloto group by DATE_FORMAT(fecha,"%Y-%m-%d")  order by fecha desc';

		$q = $this->db->query($query)->result();

		foreach($q as $total_dia)
		{
			$total[] = intval($total_dia->tot);

			// Generamos la fecha legible
			$fecha = explode('-', $total_dia->fec);
			$dia = $fecha[2];
			$mes = $fecha[1];
			$anio = $fecha[0];
			$dias[] = intval($dia).' de '.$meses[intval($mes)];
			//$dias[] =  date("l F jS, Y", strtotime($total_dia->fec));
		}

		$series_data['totales_dinero'] = array('name'=>'Valor','data'=>$total);
		$series_data['totales_dia'] = $dias;

		//dump($series_data);die;
		return $series_data;
	}

	/**
	 * Devuelve el valor de mercado de todos los pilotos por dia
	 *
	 * @return void
	 * @author 
	 **/
	function get_info_valor_mercado_equipos()
	{
		// Array con los meses para generar fecha legible
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

		$query = 'select sum(valor_actual) tot,DATE_FORMAT(fecha,"%Y-%m-%d") fec from valor_equipo group by DATE_FORMAT(fecha,"%Y-%m-%d")  order by fecha desc';

		$q = $this->db->query($query)->result();

		foreach($q as $total_dia)
		{
			$total[] = intval($total_dia->tot);

			// Generamos la fecha legible
			$fecha = explode('-', $total_dia->fec);
			$dia = $fecha[2];
			$mes = $fecha[1];
			$anio = $fecha[0];
			$dias[] = intval($dia).' de '.$meses[intval($mes-1)];
			//$dias[] =  date("l F jS, Y", strtotime($total_dia->fec));
		}

		$series_data['totales_dinero'] = array('name'=>'Valor','data'=>$total);
		$series_data['totales_dia'] = $dias;

		//dump($series_data);die;
		return $series_data;
	}


	/**
	 * Devuelve el dinero invertido los ultimos X dias
	 *
	 * @return void
	 * @author 
	 **/
	function get_inversion_compras($dias = 7,$id_usuario)
	{

		// Dinero en fichaje de pilotos
		//
		$query_fichaje_pilotos = "select * from fichajes_pilotos where id_usuario=? and fecha >= ( CURDATE() - INTERVAL ".$dias." DAY )";

		$qfp = $this->db->query($query_fichaje_pilotos,array($id_usuario));

		if($qfp->num_rows())
		{
			//dump($qfp->result());die;
			$fichajes = $qfp->result();

			foreach($fichajes as $fichaje)
			{

				// Valor piloto en esa fecha?
				$valor_piloto = $this->db->select('valor_actual')
										 ->from('valor_piloto')
										 ->where('id_piloto',$fichaje->id_piloto)
										 ->where('DATE_FORMAT(fecha,"%Y-%m-%d")',$fichaje->fecha)
										 ->get()
										 ->row()
										 ->valor_actual;

				/*Fichado o alquilado?*/
				if( $fichaje->tipo_compra == 'alquilado')
				{

					$valor_piloto = $valor_piloto * 0.10;
				}
				
				
				


				$dinero_fichajes = $dinero_fichajes + $valor_piloto;
			}

			$total_dinero_fichajes_pilotos =  $dinero_fichajes;
			
		}
		else
		{
			$total_dinero_fichajes_pilotos = 0;
		}

		// Dinero en fichaje de equipos
		//
		$query_fichaje_equipos = "select * from compras_equipos where id_usuario=? and fecha >= ( CURDATE() - INTERVAL ".$dias." DAY )";

		$qfe = $this->db->query($query_fichaje_equipos,array($id_usuario));

		if($qfe->num_rows())
		{
			//dump($qfp->result());die;
			$compras = $qfe->result();

			foreach($compras as $compra)
			{

				$valor_equipo = $this->db->select('valor_actual')
										 ->from('valor_equipo')
										 ->where('id_equipo',$compra->id_equipo)
										 ->where('DATE_FORMAT(fecha,"%Y-%m-%d")',$compra->fecha)
										 ->get()
										 ->row()
										 ->valor_actual;

				$dinero_compras = $dinero_compras + $valor_equipo;
			}

			$total_dinero_fichajes_equipos =  $dinero_compras;

			
		}
		else
		{
			$total_dinero_fichajes_equipos = 0;
		}

		$total_absoluto_inversiones = $total_dinero_fichajes_pilotos + $total_dinero_fichajes_equipos;

		return $total_absoluto_inversiones;
	}


	/**
	 * Devuelve el dinero ganado los ultimos X dias por ventas
	 *
	 * @return void
	 * @author 
	 **/
	function get_ganancias_ventas($dias = 7,$id_usuario)
	{

		// Dinero en venta de pilotos
		//
		$query_venta_pilotos = "select * from ventas_pilotos where id_usuario=? and fecha >= ( CURDATE() - INTERVAL ".$dias." DAY )";

		$qvp = $this->db->query($query_venta_pilotos,array($id_usuario));

		if($qvp->num_rows())
		{
			//dump($qfp->result());die;
			$ventas = $qvp->result();

			foreach($ventas as $venta)
			{

				$valor_piloto = $this->db->select('valor_actual')
										 ->from('valor_piloto')
										 ->where('id_piloto',$venta->id_piloto)
										 ->where('DATE_FORMAT(fecha,"%Y-%m-%d")',$venta->fecha)
										 ->get()
										 ->row()
										 ->valor_actual;

				// Lo compre o lo alquile?
				// Busca este piloto en la tabla de fichajes, y mirando la fecha de venta, cogemos el primer resultado descendente
				// con fecha menor a la venta, para fijarnos si se ficho o alquilo.
				$sql_tipo_compra = "select * from fichajes_pilotos  where id_usuario = ? and id_piloto = ? and fecha  <= ? order by id_fichaje_piloto limit 1";
				$res = $this->db->query($sql_tipo_compra,array($id_usuario,$venta->id_piloto,$venta->fecha));
				
				if($res->num_rows())
				{
					$tipo_compra = $res->row()->tipo_compra;

					if($tipo_compra == 'alquilado')
					{
						$valor_piloto = $valor_piloto * 0.10;
					}
				}

				$dinero_ventas = $dinero_ventas + $valor_piloto;
			}

			$total_dinero_ventas_pilotos =  $dinero_ventas;
			
		}
		else
		{
			$total_dinero_ventas_pilotos = 0;
		}

		// Dinero en venta de equipos
		//
		$query_venta_equipos = "select * from ventas_equipos where id_usuario=? and fecha >= ( CURDATE() - INTERVAL ".$dias." DAY )";

		$qve = $this->db->query($query_venta_equipos,array($id_usuario));

		if($qve->num_rows())
		{
			//dump($qfp->result());die;
			$ventas = $qve->result();

			foreach($ventas as $venta)
			{

				$valor_equipo = $this->db->select('valor_actual')
										 ->from('valor_equipo')
										 ->where('id_equipo',$venta->id_equipo)
										 ->where('DATE_FORMAT(fecha,"%Y-%m-%d")',$venta->fecha)
										 ->get()
										 ->row()
										 ->valor_actual;

				$dinero_ventas = $dinero_ventas + $valor_equipo;
			}

			$total_dinero_ventas_equipos =  $dinero_ventas;

			
		}
		else
		{
			$total_dinero_ventas_equipos = 0;
		}

		$total_absoluto_ventas = $total_dinero_ventas_pilotos + $total_dinero_ventas_equipos;
		
		return $total_absoluto_ventas;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function get_premios_pilotos()
	{
		$q = $this->db->select('*')->from('premios_manager_pilotos')->order_by('posicion','asc')->get()->result();
		return $q;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function get_premios_equipos()
	{
		$q = $this->db->select('*')->from('premios_manager_equipos')->order_by('posicion','asc')->get()->result();
		return $q;

	}
}
