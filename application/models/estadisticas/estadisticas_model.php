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
		$idGp = $this->db->query("SELECT id_gp
							  FROM stikis_gp
							  WHERE procesado = 0
							  ORDER BY id ASC
							  LIMIT 0,1"
							 )->row()->id_gp;

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
		$f1 = $this->db->select('id')->from('foro')->where('id_usuario',$id_perfil)->get()->num_rows();
		$f2 = $this->db->select('id')->from('foroayuda')->where('id_usuario',$id_perfil)->get()->num_rows();
		$f3 = $this->db->select('id')->from('foroformula1')->where('id_usuario',$id_perfil)->get()->num_rows();
		$f4 = $this->db->select('id')->from('foroofftopic')->where('id_usuario',$id_perfil)->get()->num_rows();

		$stats['total_posts'] = $f1+$f2+$f3+$f4;

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

		$fecha_estadisticas = '2014-02-19';//date('Y-m-d');
		$fichajes = $this->db->select('*')->from('usuarios_pilotos')
										  
										  ->where('fecha_fichaje',$fecha_estadisticas)
										  ->get()
										  ->result();


		$ventas = $this->db->select('*')->from('usuarios_pilotos')->where('fecha_venta',$fecha_estadisticas)->get()->result();

		// Recorremos pilotos fichados en esa fecha
		foreach($fichajes as $fi)
		{
			 $suma_fichados = $suma_fichados + intval($fi->precio_fichaje);
		}
		$fichados[] = intval($suma_fichados);
		// Recorremos pilotos fichados en esa fecha
		foreach($ventas as $ve)
		{
			$suma_vendidos = $suma_vendidos + intval($ve->precio_venta);
		}

		$vendidos[] = intval($suma_vendidos);

		$series_data[] = array('name' => 'Fichajes $','data'=>$fichados);
		$series_data[] = array('name' => 'Ventas $','data'=>$vendidos);

		return $series_data;
		
	}
}
