<?php

class Mensajes extends CI_Controller {

	/**
	 * Idiomas soportados /*DEPRECATED!*/
	/* 
	private $languages	= array ('spanish','english');
	*/

	function Mensajes()
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
		$this->load->helper('timeago_helper');

		// controlar session
		$this->control_session->comprobar_sesion();

	}

	
	/**
	 * 
	 *
	 * @return void
	 * @author 
	 **/
	function index()
	{
		redirect_lf1('mensajes/notificaciones');
		/*
		// Menu Izquierda
		$sidebarleft 		  = array();
		$sidebarleft['m_act'] = 7;
		
		// Header
		$header['estilos'] 	  = array('dashboard.css');
		$header['titulo' ]	  = 'Mensajes - LigaFormula1.com';
		$header['avatar' ]    = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

		// Javascript
		$bottom['javascript'] = array();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/mensajes/mensajes'  ,$datos);

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php',$sidebarright);		
		$this->load->view('dashboard/base/bottom.php',$bottom);
		*/
	}

	/**
	 * 
	 *
	 * @return void
	 * @author 
	 **/
	function alertas()
	{

		$datos['alertas'   ] = $this->mensajes_model->get_alertas_usuario($_SESSION['id_usuario']);

		// Menu Izquierda
		$sidebarleft 		  = array();
		$sidebarleft['m_act'] = 7;
		
		// Header
		$header['estilos'] 	  = array('dashboard.css');
		$header['titulo' ]	  = 'Mensajes - LigaFormula1.com';
		$header['avatar' ]    = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

		// Javascript
		$bottom['javascript'] = array();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/mensajes/alertas'  ,$datos);

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php',$sidebarright);		
		$this->load->view('dashboard/base/bottom.php',$bottom);
		
	}

	/**
	 * 
	 *
	 * @return void
	 * @author 
	 **/
	function notificaciones()
	{

		$datos['notificaciones'   ] = $this->mensajes_model->get_notificaciones_usuario($_SESSION['id_usuario']);

		// Menu Izquierda
		$sidebarleft 		  = array();
		$sidebarleft['m_act'] = 7;
		
		// Header
		$header['estilos'] 	  = array('dashboard.css');
		$header['titulo' ]	  = 'Mensajes - LigaFormula1.com';
		$header['avatar' ]    = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

		// Javascript
		$bottom['javascript'] = array();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/mensajes/notificaciones'  ,$datos);

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