<?php

require_once APPPATH . 'classes/varios/circuito.php';

class Calendario extends CI_Controller {

    /**
     * Idiomas soportados /*DEPRECATED! */
    /*
      private $languages	= array ('spanish','english');
     */

    function Calendario() {
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
     * */
    function index() {

        // Menu Izquierda
        $sidebarleft = array();
        $sidebarleft['m_act'] = 6;

        // Header
        $header['estilos'] = array('dashboard.css');
        $header['titulo'] = 'Calendario - LigaFormula1.com';
        $header['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

        //Se obtienen todos los circuitos
        $datos['circuitos'] = $this->calendario_model->obtenerCircuitosObject();

        // Javascript
        $bottom['javascript'] = array();

        // Vistas base | Header | Menu Principal
        $this->load->view('dashboard/base/header.php', $header);
        $this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

        // Vista contenido
        $this->load->view('dashboard/calendario/calendario', $datos);

        // Vistas base | Menu derecha | Bottom end
        $this->load->view('dashboard/base/sidebarright.php', $sidebarright);
        $this->load->view('dashboard/base/bottom.php', $bottom);
    }

    function circuito() {

        if (!is_numeric($this->uri->segment(3))) {
            redirect_lf1('calendario', 'refresh');
        }

        $idGp = $this->uri->segment(3);

        // Menu Izquierda
        $sidebarleft = array();
        $sidebarleft['m_act'] = 6;

        // Header
        $header['estilos'] = array('dashboard.css');
        $header['titulo'] = 'Calendario - LigaFormula1.com';
        $header['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

        //Se obtienen todos los circuitos
        $datos['circuito'] = New Circuito($idGp);

        //Se obtienen los datos de la api
        $anoAnterior = date('Y') - 1;

        $url = "http://ergast.com/api/f1/" . $anoAnterior . "/" . $datos['circuito']->getIdCircuito() . "/results/1.json";
        echo $datos['circuito']->getIdApi();
        echo $datos['circuito']->getIdCircuito();
        $json = json_decode(file_get_contents($url));
        $datos['ultimoGanador'] = $json->MRData;
        
        $url = "http://ergast.com/api/f1/" . $anoAnterior . "/" . $datos['circuito']->getIdCircuito() . "/results/2.json";
        $json = json_decode(file_get_contents($url));
        $datos['segundo'] = $json->MRData;
        
        $url = "http://ergast.com/api/f1/" . $anoAnterior . "/" . $datos['circuito']->getIdCircuito() . "/results/3.json";
        $json = json_decode(file_get_contents($url));
        $datos['tercero'] = $json->MRData;

        $url = "http://ergast.com/api/f1/" . $anoAnterior . "/" . $datos['circuito']->getIdCircuito() . "/fastest/1/drivers.json";
        $json = json_decode(file_get_contents($url));
        $datos['pilotoVueltaRapida'] = $json->MRData;

        $url = "http://ergast.com/api/f1/" . $anoAnterior . "/" . $datos['circuito']->getIdCircuito() . "/qualifying.json";
        $json = json_decode(file_get_contents($url));
        $datos['poleman'] = $json->MRData->RaceTable->Races[0]->QualifyingResults[0];
        
        // Javascript
        $bottom['javascript'] = array();

        // Vistas base | Header | Menu Principal
        $this->load->view('dashboard/base/header.php', $header);
        $this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

        // Vista contenido
        $this->load->view('dashboard/calendario/circuito', $datos);

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
