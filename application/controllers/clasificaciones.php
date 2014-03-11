<?php

require_once APPPATH . 'classes/usuarios/usuario.php';
require_once APPPATH . 'classes/clasificaciones/clasificacionUsuario.php';
require_once APPPATH . 'classes/clasificaciones/clasificacionGeneralUsuario.php';
require_once APPPATH . 'classes/varios/circuito.php';
require_once APPPATH . 'classes/clasificaciones/clasificacionGp.php';
require_once APPPATH . 'classes/clasificaciones/clasificacionGpPilotos.php';
require_once APPPATH . 'classes/pilotos/piloto.php';
require_once APPPATH . 'classes/pilotos/pilotoClasificacionGp.php';
require_once APPPATH . 'classes/pilotos/valorMercado.php';
require_once APPPATH . 'classes/equipos/equipo.php';

class Clasificaciones extends CI_Controller {

    /**
     * Idiomas soportados /*DEPRECATED! */
    /*
      private $languages	= array ('spanish','english');
     */

    function Clasificaciones() {
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
        $this->load->model('ranking/clasificacion_model');

        // controlar session
        $this->control_session->comprobar_sesion();
    }

    /**
     * Clasificaciones
     *
     * @return void
     * @author 
     * */
    function index() {

        // Menu Izquierda
        $sidebarleft = array();
        $sidebarleft['m_act'] = 4;

        // Header
        $header['estilos'] = array('dashboard.css');
        $header['titulo'] = 'Clasificaciones - LigaFormula1.com';
        $header['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

        $datos['clasificacionGeneral'] = $this->clasificacion_model->
                getClasificacionGeneralObject();

        $usuario = Usuario::getById($_SESSION['id_usuario']);

        $datos['miClasificacionGeneral'] = ClasificacionGeneralUsuario::getById($usuario);

        $datos['clasificacionGp'] = new clasificacionGp(0);

        $datos['miClasificacionGp'] = $this->clasificacion_model->getClasificacionGpUsuarioObject(0
                , $_SESSION['id_usuario']);

        $this->load->model('pilotos/pilotos_model');

        $datos['clasificacionMundial'] = $this->pilotos_model->getPilotosClasificacionMundial();

        $datos['clasificaionGpPiloto'] = new clasificacionGpPilotos(0);

        $this->load->model('equipos/equipos_model');

        $datos['clasificacionMundialEquipos'] = $this->equipos_model->getEquiposClasificacionMundial();

        $idGp = $this->clasificacion_model->getUltimoGpConClasificacion();
        $season = date('Y');        

        //Se obtienen la clasificacion de equipos del gp 
        $url = 'http://ergast.com/api/f1/' . $season . '/' . $idGp
                . '/constructorStandings.json';

        $json = json_decode(file_get_contents($url));

        $MRData = $json->MRData->StandingsTable->StandingsLists;

        $datos['clasificaionGpEquipos'] = $MRData;

        //Se carga el model de calendario
        $this->load->model('calendario/calendario_model');

        //Se obtienen todos los circuitos
        $datos['circuitos'] = $this->calendario_model->obtenerCircuitosObject();

        // Javascript
        $bottom['javascript'] = array();

        // Vistas base | Header | Menu Principal
        $this->load->view('dashboard/base/header.php', $header);
        $this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

        // Vista contenido
        $this->load->view('dashboard/clasificaciones/clasificaciones', $datos);

        $sidebarright = "";

        // Vistas base | Menu derecha | Bottom end
        $this->load->view('dashboard/base/sidebarright.php', $sidebarright);
        $this->load->view('dashboard/base/bottom.php', $bottom);
    }

    function clasificacionGp() {

        if (!is_numeric($this->uri->segment(3))) {
            redirect_lf1('clasificaciones', 'refresh');
        }

        $idGp = $this->uri->segment(3);

        // Menu Izquierda
        $sidebarleft = array();
        $sidebarleft['m_act'] = 4;

        // Header
        $header['estilos'] = array('dashboard.css');
        $header['titulo'] = 'Clasificacion Gp - LigaFormula1.com';
        $header['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

        $datos['clasificacionGeneral'] = $this->clasificacion_model->
                getClasificacionGeneralObject();

        $usuario = Usuario::getById($_SESSION['id_usuario']);

        $datos['miClasificacionGeneral'] = ClasificacionGeneralUsuario::getById($usuario, $idGp);

        $datos['clasificacionGp'] = new clasificacionGp($idGp);

        $datos['miClasificacionGp'] = $this->clasificacion_model->getClasificacionGpUsuarioObject($idGp
                , $_SESSION['id_usuario']);

        $this->load->model('pilotos/pilotos_model');

        $datos['clasificaionGpPiloto'] = new clasificacionGpPilotos($idGp);

        //Se carga el model de calendario
        $this->load->model('calendario/calendario_model');

        //Se obtienen todos los circuitos
        $datos['circuitos'] = $this->calendario_model->obtenerCircuitosObject();

        $datos['circuitoClasificacion'] = new Circuito($idGp);

        // Javascript
        $bottom['javascript'] = array();

        // Vistas base | Header | Menu Principal
        $this->load->view('dashboard/base/header.php', $header);
        $this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

        // Vista contenido
        $this->load->view('dashboard/clasificaciones/clasificacionGp', $datos);

        $sidebarright = "";

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

}
