<?php

class Ranking extends Controller {

	/**
	 * Idiomas soportados
	 */
	private $languages	= array ('spanish','english');

	function Ranking()
	{
		parent::Controller();

		// Configurar idioma
		$this->_set_language();


		$this->load->helper(array('form', 'url'));
		$this->load->library('validation');
		$this->load->database();
		$this->load->model('sesiones/control_session');
		$this->load->model('ranking/ranking_model');
		$this->load->model('estadisticas/estadisticas_model');
		$this->load->model('calendario/calendario_model');
		$this->load->model('menudata/menudata_model');
		$this->load->model('banco/banco_model');

		$this->control_session->comprobar_sesion();
	}

	// Te he creado los controladores y las vistas,
	// solo para organizar,te lo pongo en seudocodigo :)

	function general(){

		$kLineasPantalla = 25;
		$datos = $this->menudata_model->get_menu_data();

		//Se controla la pagina que se quiere
		/*if($_POST){
			$numEnlace = $_POST['numEnlace'];
		}
		else{
			$numEnlace = 0;
		}*/

		// Llamas al modelo ranking_model para
		// que te devuelva el ranking general
		$ranking['ranking'] = $this->ranking_model->getRankingGeneral()->result();

		//Se obtiene mi posicion
		$ranking['miPosicion'] = $this->ranking_model->getMiPosicionGeneral();

		//Se obtiene el numero de enlaces
		//$numUsuarios = $this->ranking_model->getRankingGeneral(-1)->num_rows();
		//$numEnlaces = floor($numUsuarios/$kLineasPantalla);
		//$datos['numEnlaces'] = $numEnlaces;
		//$datos['enlaceActual'] = $numEnlace;

		// Preparar la vista
		$header['estilos'] = array('ranking2013.css');
		$header['javascript'] = array('miajaxlib','ranking','jquery');

		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');

		// Menu activo
		$menu['m_act'] = 5;

		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);

		$this->load->view('ranking/ranking_general',$ranking);
		$this->load->view('base/page_bottom');

	}

	function gp(){

		$kLineasPantalla = 25;

		$datos = $this->menudata_model->get_menu_data();

		//Recoger parametros de URI
		$idGP = $this->uri->segment(3);

		$datosGP = $this->ranking_model->obtenerNombreGP($idGP);

		//En el caso de estar logueado devuelvo mi posicion
		if($_SESSION){
			$miPosicion = $this->ranking_model->getMiPosicionGp($datosGP->id)->row();
		}


		// Llamas al modelo ranking_model para
		// que te devuelva el ranking general
		$rankingGP = $this->ranking_model->getRankingGp($datosGP->id)->result();

		//Se obtienen los puntos de los pilotos en el GP
		//$pilotos = $this->ranking_model->obtenerPuntosPiloto($datosGP->id);

		$datos['rankingGp'] = $rankingGP;
		$datos['datosGP'] = $datosGP;
		$datos['pilotos'] = $pilotos;
		$datos['miPosicion'] = $miPosicion;

		// Preparar la vista
		$header['estilos'] = array('ranking2013.css');
		$header['javascript'] = array('miajaxlib','ranking','jquery');

		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');

		// Menu activo
		$menu['m_act'] = 6;

		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);

		$this->load->view('ranking/ranking_gp',$datos);
		$this->load->view('base/page_bottom');

	}

	/**
	 * Configurar el idioma que debe cargar
	 *
	 * @access	private
	 * @author	Gorka Garin
	 * @return	void
	 */
	private function _set_language()
	{



		// Mirar si el idioma esta soportado
		if (in_array($this->session->userdata('language'), $this->languages))
		{

			// Si esta soportado, lo seteamos
			$this->config->set_item('language', $this->session->userdata('language'));
		}

		// Cargar el archivo de idioma de la pagina que se ha solicitado
		$lang_file = $this->config->item('language') . '/' . $this->router->class . '_lang';


		// si el archivo fisico existe, cargamos su  contenido
		if (is_file(realpath(dirname(__FILE__) . '/../language/' . $lang_file . EXT)))
		{
			$this->lang->load($this->router->class);
		}

		// Cargar variables genericas de idioma
		$this->lang->load('global');

	}

}