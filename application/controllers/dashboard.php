<?php

class Dashboard extends CI_Controller {

	/**
	 * Idiomas soportados /*DEPRECATED!*/
	/* 
	private $languages	= array ('spanish','english');
	*/

	function Dashboard()
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
		$this->load->model('pilotos/pilotos_model');

		// controlar session
		$this->control_session->comprobar_sesion();

	}

	/**
	 * Dashboard
	 *
	 * @return void
	 * @author 
	 **/
	function index()
	{
		
		
		// Datos al contenido
		$datos = array();

		// Cuenta atras
		// Datos del menu estadisticas,posts y countdown
		// Datos para la cuenta atras al GP
		$next_GP  = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$fecha_gp = explode("-",$next_GP->fecha);
		
		$datos['anioGP']  = $fecha_gp[0];
		$datos['mesGP' ]  = $fecha_gp[1];
		$datos['diaGP' ]  = $fecha_gp[2];
		$datos['paisGP']  = $next_GP->pais;

		// noticias de feed rss
		$datos['noticiasfeed'			  ] = $this->noticias_model->get_feed_news()->channel;
		// Ultimos pilotos comprados
		$datos['ultimos_pilotos_comprados'] = $this->estadisticas_model->get_ultimos_comprados();
		// Variaciones mercado pilotos
		$datos['info_mercado_pilotos'     ] = $this->pilotos_model->getInfoPilotos();

		// Header
		$header['estilos'] 	  = array('dashboard.css');
		$header['titulo' ]	  = 'Dashboard - LigaFormula1.com';
		$header['avatar' ]    = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);
		//$header['saldo'  ]    = $this->banco_model->getSaldo('formateado');

		// Javascript
		$bottom['javascript'] = array('highcharts.js','dashboard/ejemplo_dash.js');

		// Menu Izquierda
		$sidebarleft 		  = array();
		$sidebarleft['m_act'] = 1;

		// Menu Derecha
		$sidebarright = array();

		// Ultimos post  del FORO PHPBB
		$sidebarright['last_topics'] = $this->forophpbb_model->get_last_topics();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/home'  ,$datos);

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
		$header['estilos'] 		= array();

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