<?php

class Foro extends CI_Controller {

	/**
	 * Idiomas soportados /*DEPRECATED!*/
	/* 
	private $languages	= array ('spanish','english');
	*/

	function Foro()
	{
		parent::__construct();

		// Configurar idioma
		//$this->_set_language();

		session_start();
		$this->load->helper( 'url');
		$this->load->database();
		$this->load->model('sesiones/control_session');
		$this->load->model('calendario/calendario_model');
		$this->load->model('estadisticas/estadisticas_model');
		$this->load->model('usuarios/usuarios_model');
		$this->load->model('foro/foro_model');
		$this->load->model('menudata/menudata_model');
		$this->load->library('form_validation');
		$this->load->model('banco/banco_model');
		$this->load->model('foro/forophpbb_model');

		// Cargar helper timeago
        $this->load->helper('timeago');

	}

	function index(){$this->indice();}
	/**
	 * Clasificaciones
	 *
	 * @return void
	 * @author 
	 **/
	function indice($topic_id = false)
	{

		if($topic_id && !is_numeric($topic_id)){
    		redirect_lf1('foro');
    	}

		// Menu Izquierda
		$sidebarleft 		  = array();
		$sidebarleft['m_act'] = 8;
		
		// Header
		$header['estilos'] 	  = array('dashboard.css');
		$header['titulo' ]	  = 'Foros - LigaFormula1.com';
		$header['avatar' ]    = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

		// Datos
		$datos['topic'   ]  = $topic_id;

		// Javascript
		$bottom['javascript'] = array();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/foros/foro'  ,$datos);

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php',$sidebarright);		
		$this->load->view('dashboard/base/bottom.php',$bottom);
		
	}


	/**
	 * Plantilla seccion
	 *
	 * @return void
	 * @author 
	 **/
	function _plantilla_seccion()
	{


		// Estilos
		$header['estilos'] 	  = array();

		// Javascript
		$bottom['javascript'] = array();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/pagina-vacia'  ,$datos);

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php',$sidebarright);		
		$this->load->view('dashboard/base/bottom.php',$bottom);
		
	}

}