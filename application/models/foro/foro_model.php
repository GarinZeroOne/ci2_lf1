<?php
class Foro_model extends CI_model{

	private $_tabla;
	private $_foro;
	private $foros = array(
						'lf1general'   =>  'foro',
						'lf1ayuda'		=> 'foroayuda',
						'lf1formula1'	=> 'foroformula1',
						'lf1offtopic'	=> 'foroofftopic'
						);

	function Foro_model()
	{

		parent::__construct();

		$this->_tabla = 'foro';

		array ('lf1ayuda','lf1general','lf1formula1','lf1offtopic');



		if($this->session->userdata('foroactivo') != '')
		{
			$this->_foro = $this->foros[$this->session->userdata('foroactivo')];
		}
		else
		{
			$this->_foro = $this->foros['lf1general'];
		}



	}
	// Pedimos todos los temas iniciales (identificador==0)
	// y los ordenamos por ult_respuesta.
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
	function get_temas_iniciales($limit,$max = 21)
	{
		$sql = "SELECT id, autor, titulo, fecha, respuestas, ult_respuesta ";
		$sql.= "FROM {$this->_foro} WHERE identificador=0 ORDER BY ult_respuesta DESC LIMIT {$limit},{$max}";

		$resultados = $this->db->query($sql)->result();

		return $resultados;

	}


	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	function get_ultimos_posts()
	{
		//  LF1GENERAL - foro
		$sqlforo = "SELECT id, autor, titulo, fecha, respuestas, ult_respuesta ";
		$sqlforo.= "FROM foro WHERE identificador=0 ORDER BY ult_respuesta DESC LIMIT 0,1";

		//  LF1AYUDa - foroayuda
		$sqlforoayuda = "SELECT id, autor, titulo, fecha, respuestas, ult_respuesta ";
		$sqlforoayuda.= "FROM foroayuda WHERE identificador=0 ORDER BY ult_respuesta DESC LIMIT 0,1";

		//  LF1FORMULA1 - foroformula1
		$sqlforoformula1 = "SELECT id, autor, titulo, fecha, respuestas, ult_respuesta ";
		$sqlforoformula1.= "FROM foroformula1 WHERE identificador=0 ORDER BY ult_respuesta DESC LIMIT 0,1";

		//  LF1OFFTOPIC - forooftopic
		$sqlforoofftopic = "SELECT id, autor, titulo, fecha, respuestas, ult_respuesta ";
		$sqlforoofftopic.= "FROM foroofftopic WHERE identificador=0 ORDER BY ult_respuesta DESC LIMIT 0,1";



		$resforo[] = $this->db->query($sqlforo)->row();

		$resforo[] = $this->db->query($sqlforoayuda)->row();

		$resforo[] = $this->db->query($sqlforoformula1)->row();

		$resforo[] = $this->db->query($sqlforoofftopic)->row();

		return $resforo;
		//dump($resforo);

	}

	// Guardar nuevo tema
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
	function guardar_tema($datos)
	{
		// Datos
		$autor   = $_SESSION['usuario'];
		$id_usuario = $_SESSION['id_usuario'];
		$titulo  = $datos["titulo"];
		$mensaje = $datos["mensaje"];
		$ident   = $datos["identificador"];

		//Evitamos que el usuario ingrese HTML
		//$mensaje = htmlentities($mensaje);

		// Convertimos urls en links clicables
		//$mensaje = $this->makeClickableLinks($mensaje);

		// Parsear tags como [citar] [youtube]
		$mensaje = $this->parsearTags($mensaje);

		// Grabamos el mensaje en la base.
		$sql = "INSERT INTO {$this->_foro} (id_usuario,autor, titulo, mensaje, identificador, fecha, ult_respuesta) ";
		$sql.= "VALUES (?,?,?,?,?,NOW(),NOW())";

		$this->db->query($sql,array($id_usuario,$autor,$titulo,$mensaje,$ident));

		// si es un mensaje en respuesta a otro
  		// actualizamos los datos
		$ult_id = $this->db->insert_id();

		if(!empty($ident))
		{
		    $sql = "UPDATE {$this->_foro} SET respuestas=respuestas+1, ult_respuesta=NOW()";
		    $sql.= " WHERE id = '$ident'";
		    $this->db->query($sql);
		}


	}

	// Devuelve el tema y sus respuestas
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
	function ver_tema($id_tema)
	{
		$sql = "SELECT {$this->_foro}.id, {$this->_foro}.id_usuario, {$this->_foro}.autor, {$this->_foro}.titulo, {$this->_foro}.mensaje, ";
		//$sql.= "DATE_FORMAT(fecha, '%d/%m/%Y %H:%i:%s') as enviado,usuarios_avatar.avatar FROM {$this->_foro},usuarios_avatar ";
		$sql.= "{$this->_foro}.fecha as enviado,usuarios_avatar.avatar FROM {$this->_foro},usuarios_avatar ";
		$sql.= "WHERE {$this->_foro}.id_usuario=usuarios_avatar.id_usuario AND ({$this->_foro}.id='$id_tema' OR {$this->_foro}.identificador='$id_tema') ORDER BY fecha ASC";
		//echo $sql;

		$query = $this->db->query($sql);

		return $query->result();

	}

	// Devuelve el tema solo
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
	function ver_tema_simple($id_tema)
	{
		$sql = "SELECT id, autor, titulo, mensaje, ";
		$sql.= "DATE_FORMAT(fecha, '%d/%m/%Y %H:%i:%s') as enviado FROM {$this->_foro} ";
		$sql.= "WHERE id='$id_tema'  ORDER BY fecha ASC";

		$query = $this->db->query($sql);

		return $query->row();
	}

	// Devuelve el numero total de temas para la paginacion
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
	function get_num_temas()
	{
		$this->db->select('id');
		$Q = $this->db->get_where($this->_foro,array('identificador'=>'0'));

		return $Q->num_rows();
	}

	// Convierto URLs en links
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --  -- -- --
	function makeClickableLinks($text) {

	  	$text = eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)',

	    '<a href="\\1">\\1</a>', $text);

	  	$text = eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)',

	    '\\1<a href="http://\\2">\\2</a>', $text);

	  	$text = eregi_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})',

	    '<a href="mailto:\\1">\\1</a>', $text);

	    return $text;

	}

	// Convierto URLs en links
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --  -- -- --
	function parsearTags($mensaje)
	{
		// citar
    	$mensaje = str_replace("[citar]", "<blockquote><hr width='100%' size='2'>", $mensaje);
   	 	$mensaje = str_replace("[/citar]", "<hr width='100%' size='2'></blockquote>", $mensaje);


   	 	// youtube
   	 	//$mensaje = str_replace("[youtube]", '<iframe width="560" height="315" src="', $mensaje);
   	 	//$mensaje = str_replace("[/youtube]", '" frameborder="0" allowfullscreen></iframe>', $mensaje);


    	return $mensaje;
	}


	/**
	 * Guarda en BD la ultima visita a el foro seleccionado
	 *
	 * @return void
	 * @author
	 **/
	function set_ultima_visita( $foro )
	{


		// Comprobar que ya exista registro (no es la primera  vez que entra)
		$q = $this->db->select('id,id_ultimo_post,notificar')
					  ->from('usuarios_foros')
					  ->where('id_usuario',$_SESSION['id_usuario'])
					  ->where('foro',$this->foros[$foro])
					  ->get();


		// id ultimo post del foro
		$q_ultimo = $this->db->select('id')
						 ->from($this->foros[$foro])
						 ->order_by('id','desc')
						 ->limit(1)
						 ->get();

		if( $q_ultimo->num_rows() )
		{
			$id_post = $q_ultimo->row()->id;

		}

		// Ha entrado el user en este foro antes?
		if( $q->num_rows() )
		{

			if($q->row()->notificar)
			{


				$data_update = array('id_ultimo_post' => $id_post);

				// Solo actualizamos si hay post nuevos
				if($id_post > $q->row()->id_ultimo_post)
				{
					$this->db->where('id_usuario',$_SESSION['id_usuario']);
					$this->db->where('foro',$this->foros[$foro]);
					$this->db->update('usuarios_foros',$data_update);
				}


			}
		}

		// Primera  vez que entra?
		else
		{

			$data_insert = array(
									'id'				=>			'',
									'id_usuario'		=>			$_SESSION['id_usuario'],
									'foro'				=>			$this->foros[$foro],
									'primera_visita' 	=>			date('Y-m-d H:i:s'),
									'ultima_visita'		=>			date('Y-m-d H:i:s'),
									'id_ultimo_post'	=>			$id_post,
									'notificar'			=>			1

								);
			$this->db->insert('usuarios_foros', $data_insert);

		}

		// Actualizar fecha ultima visita
		$data_visita  = array('ultima_visita'=> date('Y-m-d H:i:s') );

		$this->db->where('id_usuario',$_SESSION['id_usuario']);
		$this->db->where('foro',$this->foros[$foro]);
		$this->db->update('usuarios_foros',$data_visita);

	}


	/**
	 * Indicar si hay post nuevos
	 *
	 * @return void
	 * @author
	 **/
	function notify_new_posts()
	{
		// Recoger ids ultimos post de cada foro de las sus ultimas visitas
		$foroayuda = $this->db->select('id_ultimo_post')
							  ->from('usuarios_foros')
							  ->where('id_usuario',$_SESSION['id_usuario'])
							  ->where('foro','foroayuda')
							  ->get()->row()->id_ultimo_post;

		$foroofftopic = $this->db->select('id_ultimo_post')
							  ->from('usuarios_foros')
							  ->where('id_usuario',$_SESSION['id_usuario'])
							  ->where('foro','foroofftopic')
							  ->get()->row()->id_ultimo_post;

		$foroformula1 = $this->db->select('id_ultimo_post')
							  ->from('usuarios_foros')
							  ->where('id_usuario',$_SESSION['id_usuario'])
							  ->where('foro','foroformula1')
							  ->get()->row()->id_ultimo_post;

		$foro = $this->db->select('id_ultimo_post')
							  ->from('usuarios_foros')
							  ->where('id_usuario',$_SESSION['id_usuario'])
							  ->where('foro','foro')
							  ->get()->row()->id_ultimo_post;


		// Ultimos post de los foros
		$foroayudaLast    = $this->db->select('id')->from('foroayuda')->order_by('id','desc')->limit(1)->get()->row()->id;
		$foroofftopicLast = $this->db->select('id')->from('foroofftopic')->order_by('id','desc')->limit(1)->get()->row()->id;
		$foroformula1Last = $this->db->select('id')->from('foroformula1')->order_by('id','desc')->limit(1)->get()->row()->id;
		$foroLast         = $this->db->select('id')->from('foro')->order_by('id','desc')->limit(1)->get()->row()->id;



		// Comprobar en que foros esta outdated

		if( $foroayuda < $foroayudaLast )
			$datos['foroayuda'] = 'outdated';

		if( $foroofftopic < $foroofftopicLast )
			$datos['foroofftopic'] = 'outdated';

		if( $foroformula1 < $foroformula1Last )
			$datos['foroformula1'] = 'outdated';

		if( $foro < $foroLast )
			$datos['foro'] = 'outdated';


		return $datos;

	}



	public function  fix($foro)
	{
		$query = $this->db->select('id,autor')->from($foro)->get();

		foreach($query->result() as $post)
		{
			$id_usuario = $this->db->select('id')->from('usuarios')->where('nick',$post->autor)->get()->row()->id;

			$data_update = array('id_usuario' => $id_usuario);

			$this->db->where('id',$post->id);
			$this->db->update($foro,$data_update);
		}

		echo $foro." fixeado.";
	}

}
