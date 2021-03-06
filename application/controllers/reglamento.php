<?php

class Reglamento extends CI_Controller {

	/**
	 * Idiomas soportados /*DEPRECATED!*/
	/* 
	private $languages	= array ('spanish','english');
	*/

	function Reglamento()
	{
		parent::__construct();

		// Configurar idioma
		//$this->_set_language();

		$this->load->helper('url');
		$this->load->database();
		$this->load->model('sesiones/control_session');
		$this->load->model('calendario/calendario_model');
		$this->load->model('noticias/noticias_model');
		$this->load->model('estadisticas/estadisticas_model');
		$this->load->model('menudata/menudata_model');
		$this->load->model('banco/banco_model');
		$this->load->model('foro/forophpbb_model');
		$this->load->model('usuarios/usuarios_model');

		// controlar session
		$this->control_session->comprobar_sesion();

	}

	
	/**
	 * Clasificaciones
	 *
	 * @return void
	 * @author 
	 **/
	function index()
	{
		$this->load->model('estadisticas/estadisticas_model');
		$this->lang->load('inicio','spanish');

		$datos['premios_pilotos'] = $this->estadisticas_model->get_premios_pilotos();
		$datos['premios_equipos'] = $this->estadisticas_model->get_premios_equipos();

		$datos['mejora_pilotos'] = $this->estadisticas_model->get_mejora_pilotos_gp();
		$datos['mejora_equipos'] = $this->estadisticas_model->get_mejora_equipos_gp();

		// Menu Izquierda
		$sidebarleft 		  = array();
		$sidebarleft['m_act'] = 9;
		
		// Header
		$header['estilos'] 	  = array('dashboard.css');
		$header['titulo' ]	  = 'Calendario - LigaFormula1.com';
		$header['avatar' ]    = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

		// Javascript
		$bottom['javascript'] = array();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/reglamento/reglamento'  ,$datos);

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