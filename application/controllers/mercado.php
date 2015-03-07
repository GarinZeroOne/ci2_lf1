<?php

require_once APPPATH . 'classes/pilotos/piloto.php';
require_once APPPATH . 'classes/pilotos/pilotoFicha.php';
require_once APPPATH . 'classes/pilotos/pilotoUsuario.php';
require_once APPPATH . 'classes/equipos/equipo.php';
require_once APPPATH . 'classes/equipos/equipoFicha.php';
require_once APPPATH . 'classes/equipos/equipoUsuario.php';
require_once APPPATH . 'classes/pilotos/valorMercado.php';
require_once APPPATH . 'classes/usuarios/usuario.php';

class Mercado extends CI_Controller {

	const msgFichaje = "msgFichaje";

	/**
	 * Idiomas soportados /*DEPRECATED! */
	/*
	 private $languages	= array ('spanish','english');
	*/

	function Mercado() {
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
		$this->load->model('equipos/equipos_model');
		$this->load->model('pilotos/pilotos_model');
		$this->load->model('boxes/boxes_model');

		// controlar session
		$this->control_session->comprobar_sesion();
	}

	function index() {
		redirect_lf1('mercado/pilotos');
	}

	/**
	 * Mercado - Pilotos
	 *
	 * @return void
	 * @author
	 * */
	function pilotos() {

		$datos[Mercado::msgFichaje] = $this->session->flashdata(Mercado::msgFichaje);

		// Menu Izquierda
		$sidebarleft = array();
		$sidebarleft['m_act'] = 3;

		// Header
		$header['estilos'] = array('dashboard.css');
		$header['titulo'] = 'Mercado - LigaFormula1.com';
		$header['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

		$datos['pilotos'] = $this->pilotos_model->getPilotosFichaObject();
		//dump($datos['pilotos']);

		//Obtengo los pilotos del usuario
		$datos['misPilotos'] =
		$this->pilotos_model->getMisPilotosObject($_SESSION['id_usuario']);
		// Javascript
		$bottom['javascript'] = array('dashboard/confirmar.js');

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php', $header);
		$this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/mercado/mercado_pilotos', $datos);

		$sidebarright = "";

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php', $sidebarright);
		$this->load->view('dashboard/base/bottom.php', $bottom);
	}

	function ficharPiloto() {

		// *************************************************
		//      CONTROL APERTURA CIERRA MERCADO/BOXES
		// Si esta cerrado el mercado redirigimos con mensaje
		// **************************************************
		if($this->boxes_model->estado())
		{
			$this->session->set_flashdata('msg_boxes','Los sentimos el mercado esta cerrado, no se permiten transacciones de ningun tipo. </br>Por norma general el mercado se cierra a las 12:00PM del viernes en fin de semana de Gran Premio.');
			redirect_lf1('mercado/pilotos');
		}
		// **************************************************

		if (!is_numeric($this->uri->segment(3))) {
			$msg = "Piloto NO fichado";
			$retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoKo
					, Pilotos_model::mensaje => $msg);


			$this->session->set_flashdata(Mercado::msgFichaje, $retorno);

			redirect_lf1('mercado/pilotos', 'refresh');
		}
		$idPiloto = $this->uri->segment(3);

		$piloto = Piloto::getById($idPiloto);

		$usuario = Usuario::getById($_SESSION['id_usuario']);
		$pilotosUsuario = $this->pilotos_model->getPilotosUsuarioObject($_SESSION['id_usuario']);
		$usuario->setPilotos($pilotosUsuario);

		$msg = $this->pilotos_model->fichar($piloto, $usuario);

		$this->session->set_flashdata(Mercado::msgFichaje, $msg);

		redirect_lf1('mercado/pilotos', 'refresh');
	}

	function comprarEquipo() {

		// *************************************************
		//      CONTROL APERTURA CIERRA MERCADO/BOXES
		// Si esta cerrado el mercado redirigimos con mensaje
		// **************************************************
		if($this->boxes_model->estado())
		{
			$this->session->set_flashdata('msg_boxes','Los sentimos el mercado esta cerrado, no se permiten transacciones de ningun tipo. </br>Por norma general el mercado se cierra a las 12:00PM del viernes en fin de semana de Gran Premio.');
			redirect_lf1('mercado/equipos');
		}
		// **************************************************

		if (!is_numeric($this->uri->segment(3))) {
			$msg = "Equipo NO comprado";

			$retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoKo
					, Pilotos_model::mensaje => $msg);
			$this->session->set_flashdata(Mercado::msgFichaje, $retorno);

			redirect_lf1('mercado/equipos', 'refresh');
		}

		/*Controlar que el numero este dentro de un id de equipo
		 Evitar numeros menores de 1 y mayores de 12
		*/
		if ($this->uri->segment(3)<1 || $this->uri->segment(3)>12) {
			$msg = "El equipo seleccionado no es valido.";

			$retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoKo
					, Pilotos_model::mensaje => $msg);
			$this->session->set_flashdata(Mercado::msgFichaje, $retorno);

			redirect_lf1('mercado/equipos', 'refresh');
		}

		$idEquipo = $this->uri->segment(3);

		$usuario = Usuario::getById($_SESSION['id_usuario']);
		$equiposUsuario = $this->equipos_model->getEquiposUsuarioObject($_SESSION['id_usuario']);
		$usuario->setEquipos($equiposUsuario);

		$equipo = Equipo::getById($idEquipo);

		$msg = $this->equipos_model->comprar($usuario, $equipo);

		$this->session->set_flashdata(Mercado::msgFichaje, $msg);

		redirect_lf1('mercado/equipos', 'refresh');
	}

	function alquilarPiloto() {

		// *************************************************
		//      CONTROL APERTURA CIERRA MERCADO/BOXES
		// Si esta cerrado el mercado redirigimos con mensaje
		// **************************************************
		if($this->boxes_model->estado())
		{
			$this->session->set_flashdata('msg_boxes','Los sentimos el mercado esta cerrado, no se permiten transacciones de ningun tipo. </br>Por norma general el mercado se cierra a las 12:00PM del viernes en fin de semana de Gran Premio.');
			redirect_lf1('mercado/pilotos');
		}
		// **************************************************

		if (!is_numeric($this->uri->segment(3))) {
			$msg = "Piloto NO alquilado";
			$retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoKo
					, Pilotos_model::mensaje => $msg);
			$this->session->set_flashdata(Mercado::msgFichaje, $retorno);

			redirect_lf1('pilotos', 'refresh');
		}
		$idPiloto = $this->uri->segment(3);

		$piloto = Piloto::getById($idPiloto);

		$usuario = Usuario::getById($_SESSION['id_usuario']);
		$pilotosUsuario = $this->pilotos_model->getPilotosUsuarioObject($_SESSION['id_usuario']);
		$usuario->setPilotos($pilotosUsuario);

		$msg = $this->pilotos_model->alquilar($piloto, $usuario);

		$this->session->set_flashdata(Mercado::msgFichaje, $msg);

		redirect_lf1('mercado/pilotos', 'refresh');
	}

	function equipos() {

		$datos[Mercado::msgFichaje] = $this->session->flashdata(Mercado::msgFichaje);

		// Menu Izquierda
		$sidebarleft = array();
		$sidebarleft['m_act'] = 3;

		// Header
		$header['estilos'] = array('dashboard.css');
		$header['titulo'] = 'Mercado - LigaFormula1.com';
		$header['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

		$datos['equipos'] = $this->equipos_model->getEquiposFichaObject();
		
		$datos['misEquipos'] = $this->equipos_model->getMisEquiposObject($_SESSION['id_usuario']);

		// Javascript
		$bottom['javascript'] = array('dashboard/confirmar.js');

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php', $header);
		$this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/mercado/mercado_equipos', $datos);

		$sidebarright = "";

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php', $sidebarright);
		$this->load->view('dashboard/base/bottom.php', $bottom);
	}

	function fichaPiloto() {

		if (!is_numeric($this->uri->segment(3))) {
			redirect_lf1('pilotos', 'refresh');
		}

		// Menu Izquierda
		$sidebarleft = array();
		$sidebarleft['m_act'] = 3;

		// Header
		$header['estilos'] = array('dashboard.css');
		$header['titulo'] = 'Mercado - LigaFormula1.com';
		$header['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

		$idPiloto = $this->uri->segment(3);

		$piloto = PilotoFicha::getById($idPiloto);
		$equipo = $this->equipos_model->getEquipoPilotoObject($idPiloto);
		$piloto->setEquipo($equipo);

		//Se obtienen los datos del piloto (API)
		/* $url = 'http://ergast.com/api/f1/drivers/' . $piloto->getDriverId() . '.json';

		$json = json_decode(file_get_contents($url));

		foreach ($json->MRData->DriverTable as $data) {
		$datos['datosPiloto'] = $data;
		} */

		$datos['piloto'] = $piloto;

		// Javascript
		$bottom['javascript'] = array('piloto.js', 'highcharts.js');

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php', $header);
		$this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/mercado/piloto', $datos);

		$sidebarright = "";

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php', $sidebarright);
		$this->load->view('dashboard/base/bottom.php', $bottom);
	}

	function fichaEquipo() {

		if (!is_numeric($this->uri->segment(3))) {
			redirect_lf1('equipos', 'refresh');
		}

		// Menu Izquierda
		$sidebarleft = array();
		$sidebarleft['m_act'] = 3;

		// Header
		$header['estilos'] = array('dashboard.css');
		$header['titulo'] = 'Mercado - LigaFormula1.com';
		$header['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

		$idEquipo = $this->uri->segment(3);

		$equipo = EquipoFicha::getById($idEquipo);
		$pilotos = $this->equipos_model->getPilotosEquipoObject($idEquipo);
		$equipo->setPilotos($pilotos);

		$datos['equipo'] = $equipo;

		// Javascript
		$bottom['javascript'] = array('equipo.js', 'highcharts.js');

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php', $header);
		$this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/mercado/equipo', $datos);

		$sidebarright = "";

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php', $sidebarright);
		$this->load->view('dashboard/base/bottom.php', $bottom);
	}

	function valoresMercadoPiloto() {
		$idPiloto = $this->uri->segment(3);

		$piloto = PilotoFicha::getById($idPiloto);

		$params = array('etiqueta' => 'valorMercado');
		$this->load->library('arraytoxml', $params);

		$var['xml'] = $this->arraytoxml->convertArrayToXml($piloto->getValoresMercado(), 'xml');

		//Se carga la vista que genera el xml
		$this->load->view('xml/generarXML', $var);
	}

	function valoresMercadoEquipo() {
		$idEquipo = $this->uri->segment(3);

		$equipo = EquipoFicha::getById($idEquipo);

		$params = array('etiqueta' => 'valorMercado');
		$this->load->library('arraytoxml', $params);

		$var['xml'] = $this->arraytoxml->convertArrayToXml($equipo->getValoresMercado(), 'xml');

		//Se carga la vista que genera el xml
		$this->load->view('xml/generarXML', $var);
	}

	/**
	 * Plantilla seccion
	 *
	 * @return void
	 * @author
	 * */
	function simulador() {

		// Info del GP
		$gp_info  = $this->calendario_model->getNextGP();

		$datos['next_gp'] = $gp_info->pais;

		// Info pilotos
		$res_pilotos = $this->pilotos_model->getInfoPilotos();

		//dump($res_pilotos);die;
		foreach($res_pilotos as $piloto){
			$pilotos[] = $piloto->driverId;
		}

		/*
		 $pilotos = array(
		 		'hamilton',
		 		'rosberg',
		 		'ricciardo',
		 		'kvyat',
		 		'massa',
		 		'bottas',
		 		'vettel',
		 		'raikkonen',
		 		'alonso',
		 		'button',
		 		'perez',
		 		'hulkenberg',
		 		'sainz',
		 		'verstappen',
		 		'grosjean',
		 		'maldonado',
		 		'ericsson',
		 		'nasr'

		 );
		*/

		$cont = 0;

		for($i=2010;$i<2015;$i++)
		{


			$resultados = json_decode(file_get_contents('http://ergast.com/api/f1/'.$i.'/'.$gp_info->id_api.'/results.json'));
			//echo "<pre>";
			//var_dump($resultados->MRData->RaceTable->Races[0]->Results);
			//echo "</pre>";
			foreach($resultados->MRData->RaceTable->Races[0]->Results as $res)
			{
				if(in_array($res->Driver->driverId,$pilotos))
				{
					if($cont > 0 && !$valor[$res->Driver->driverId])
					{

						$valor[$res->Driver->driverId] = ($cont-1) * 50;

						//echo $res->Driver->driverId.": ".$valor[$res->Driver->driverId]."<br>";die;
					}

					if($res->position > 0)
					{
						$valor[$res->Driver->driverId] = $valor[$res->Driver->driverId] + ($res->position *2);
					}
					else
					{
						$valor[$res->Driver->driverId] = $valor[$res->Driver->driverId] + 50;
					}




				}

				//echo $res->position." - ".$res->Driver->driverId;
			}

			$cont++;
		}

		foreach ($pilotos as $piloto)
		{
			if(!$valor[$piloto]){
				$valor[$piloto] = 200;
			}
		}


		$datos['pilotos'] = $pilotos;
		$datos['valor'] = $valor;

		// Menu Izquierda
		$sidebarleft = array();
		$sidebarleft['m_act'] = 3;

		// Estilos
		$header['estilos'] = array('dashboard.css');

		// Javascript
		$bottom['javascript'] = array();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php', $header);
		$this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/mercado/simulador', $datos);

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php', $sidebarright);
		$this->load->view('dashboard/base/bottom.php', $bottom);
	}


	/**
	 * Plantilla seccion
	 *
	 * @return void
	 * @author
	 * */
	function _plantilla_seccion() {


		// Estilos
		$header['estilos'] = array();

		// Javascript
		$bottom['javascript'] = array();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php', $header);
		$this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/pagina-vacia', $datos);

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php', $sidebarright);
		$this->load->view('dashboard/base/bottom.php', $bottom);
	}

	/**
	 * Procesar precios post Gp
	 *
	 * @return void
	 * @author
	 * */


}
