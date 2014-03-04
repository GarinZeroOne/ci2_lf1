<?php

require_once APPPATH . 'classes/pilotos/pilotoUsuario.php';
require_once APPPATH . 'classes/pilotos/piloto.php';
require_once APPPATH . 'classes/pilotos/valorMercado.php';
require_once APPPATH . 'classes/equipos/equipo.php';
require_once APPPATH . 'classes/equipos/equipoUsuario.php';
require_once APPPATH . 'classes/usuarios/usuario.php';
require_once APPPATH . 'classes/varios/circuito.php';
require_once APPPATH . 'classes/varios/stiki.php';

class Gestion extends CI_Controller {

    const msgVenta = "msgVenta";
    const msg = "msg";

    /**
     * Idiomas soportados /*DEPRECATED! */
    /*
      private $languages	= array ('spanish','english');
     */

    function Gestion() {
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

    function index() {
        redirect_lf1('gestion/mi_oficina');
    }

    /**
     * Gestion - Mis Oficina
     *
     * @return void
     * @author 
     * */
    function mi_oficina() {

        // Menu Izquierda
        $sidebarleft = array();
        $sidebarleft['m_act'] = 2;

        // Header
        $header['estilos'] = array('dashboard.css');
        $header['titulo'] = 'Gestión Manager - LigaFormula1.com';
        $header['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

        // Javascript
        $bottom['javascript'] = array();

        // Vistas base | Header | Menu Principal
        $this->load->view('dashboard/base/header.php', $header);
        $this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

        // Vista contenido
        $this->load->view('dashboard/gestion/mi_oficina', $datos);

        // Vistas base | Menu derecha | Bottom end
        $this->load->view('dashboard/base/sidebarright.php', $sidebarright);
        $this->load->view('dashboard/base/bottom.php', $bottom);
    }

    /**
     * Gestion - Mis pilotos
     *
     * @return void
     * @author 
     * */
    function mis_pilotos() {

        $datos[Gestion::msgVenta] = $this->session->flashdata(Gestion::msgVenta);

        // Menu Izquierda
        $sidebarleft = array();
        $sidebarleft['m_act'] = 2;

        // Header
        $header['estilos'] = array('dashboard.css');
        $header['titulo'] = 'Gestión Manager - LigaFormula1.com';
        $header['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

        // Javascript
        $bottom['javascript'] = array('dashboard/confirmar.js');

        $this->load->model('pilotos/pilotos_model');

        $datos['pilotos'] = $this->pilotos_model->
                getPilotosUsuarioObject($_SESSION['id_usuario']);

        // Vistas base | Header | Menu Principal
        $this->load->view('dashboard/base/header.php', $header);
        $this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

        // Vista contenido
        $this->load->view('dashboard/gestion/mis_pilotos', $datos);

        $sidebarright = "";

        // Vistas base | Menu derecha | Bottom end
        $this->load->view('dashboard/base/sidebarright.php', $sidebarright);
        $this->load->view('dashboard/base/bottom.php', $bottom);
    }

    function venderPiloto() {

        $this->load->model('pilotos/pilotos_model');

        if (!is_numeric($this->uri->segment(3))) {
            $msg = "Piloto NO vendido";
            $retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoKo
                , Pilotos_model::mensaje => $msg);

            $this->session->set_flashdata(Gestion::msgVenta, $retorno);

            redirect_lf1('gestion/mis_pilotos', 'refresh');
        }
        $idPiloto = $this->uri->segment(3);

        $piloto = PilotoUsuario::getById($idPiloto, $_SESSION['id_usuario']);

        $usuario = Usuario::getById($_SESSION['id_usuario']);

        $msg = $this->pilotos_model->venderPiloto($usuario, $piloto);

        $retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoOk
            , Pilotos_model::mensaje => $msg);

        $this->session->set_flashdata(Gestion::msgVenta, $retorno);

        redirect_lf1('gestion/mis_pilotos', 'refresh');
    }

    function mis_equipos() {

        $datos[Gestion::msgVenta] = $this->session->flashdata(Gestion::msgVenta);

        // Menu Izquierda
        $sidebarleft = array();
        $sidebarleft['m_act'] = 2;

        // Header
        $header['estilos'] = array('dashboard.css');
        $header['titulo'] = 'Gestión Manager - LigaFormula1.com';
        $header['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

        // Javascript
        $bottom['javascript'] = array('dashboard/confirmar.js');

        $this->load->model('equipos/equipos_model');

        $datos['equipos'] = $this->equipos_model->
                getEquiposUsuarioObject($_SESSION['id_usuario']);

        // Vistas base | Header | Menu Principal
        $this->load->view('dashboard/base/header.php', $header);
        $this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

        // Vista contenido
        $this->load->view('dashboard/gestion/mis_equipos', $datos);

        $sidebarright = "";

        // Vistas base | Menu derecha | Bottom end
        $this->load->view('dashboard/base/sidebarright.php', $sidebarright);
        $this->load->view('dashboard/base/bottom.php', $bottom);
    }

    function venderEquipo() {

        $this->load->model('equipos/equipos_model');

        if (!is_numeric($this->uri->segment(3))) {
            $msg = "Piloto NO vendido";
            $retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoKo
                , Pilotos_model::mensaje => $msg);

            $this->session->set_flashdata(Gestion::msgVenta, $retorno);

            redirect_lf1('gestion/mis_equipos', 'refresh');
        }
        $idEquipo = $this->uri->segment(3);

        $equipo = EquipoUsuario::getById($idEquipo, $_SESSION['id_usuario']);

        $usuario = Usuario::getById($_SESSION['id_usuario']);

        $msg = $this->equipos_model->venderEquipo($usuario, $equipo);

        $retorno = array(Equipos_model::codigoRetorno => Equipos_model::codigoOk
            , Equipos_model::mensaje => $msg);

        $this->session->set_flashdata(Gestion::msgVenta, $retorno);

        redirect_lf1('gestion/mis_equipos', 'refresh');
    }

    function stikis() {

        $datos[Gestion::msg] = $this->session->flashdata(Gestion::msg);

        // Menu Izquierda
        $sidebarleft = array();
        $sidebarleft['m_act'] = 2;

        // Header
        $header['estilos'] = array('dashboard.css');
        $header['titulo'] = 'Gestión Manager - LigaFormula1.com';
        $header['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

        // Javascript
        $bottom['javascript'] = array('dashboard/confirmar.js');

        $this->load->model('calendario/calendario_model');

        $circuito = $this->calendario_model->getNextGpObject();

        $datos['circuito'] = $circuito;

        $this->load->model('pilotos/pilotos_model');

        $datos['misPilotos'] = $this->pilotos_model->getPilotosUsuarioObject($_SESSION['id_usuario']);

        $this->load->model('stikis/stikis_model');
        
        $datos['historialStikis'] = $this->stikis_model->getStikisUsuarioObject($_SESSION['id_usuario']);

        $datos['stikisGp'] = $this->stikis_model->
                getUserGpStikisObject($_SESSION['id_usuario'], $circuito->getIdCircuito());
        
        $this->load->model('boxes/mejoras_model');
        $datos['valorMejoraMecanicos'] = $this->mejoras_model->getValorMejora($_SESSION['id_usuario'], 2);

        // Vistas base | Header | Menu Principal
        $this->load->view('dashboard/base/header.php', $header);
        $this->load->view('dashboard/base/sidebarleft.php', $sidebarleft);

        // Vista contenido
        $this->load->view('dashboard/gestion/stikis', $datos);

        $sidebarright = "";

        // Vistas base | Menu derecha | Bottom end
        $this->load->view('dashboard/base/sidebarright.php', $sidebarright);
        $this->load->view('dashboard/base/bottom.php', $bottom);
    }

    function comprarStiki() {
        $this->load->model('stikis/stikis_model');


        $idPiloto = $_POST['piloto'];
        if (!is_numeric($idPiloto) || !is_numeric($_POST['idGp'])) {
            $msg = "Stiki NO comprado";
            $retorno = array(Stikis_model::codigoRetorno => Stikis_model::codigoKo
                , Stikis_model::mensaje => $msg);

            $this->session->set_flashdata(Gestion::msg, $retorno);

            redirect_lf1('gestion/stikis', 'refresh');
        }

        $tipoStiki = $_POST['tipoStiki'];
        $idGp = $_POST['idGp'];

        $usuario = Usuario::getById($_SESSION['id_usuario']);

        $msg = $this->stikis_model->comprarStiki($usuario, $idPiloto, $tipoStiki, $idGp);

        $retorno = array(Stikis_model::codigoRetorno => Stikis_model::codigoOk
            , Stikis_model::mensaje => $msg);

        $this->session->set_flashdata(Gestion::msg, $msg);

        redirect_lf1('gestion/stikis', 'refresh');
    }
    
    function venderStiki() {
        $this->load->model('stikis/stikis_model');

        if (!is_numeric($this->uri->segment(3)) ) {
            $msg = "Stiki NO vendido";
            $retorno = array(Stikis_model::codigoRetorno => Stikis_model::codigoKo
                , Stikis_model::mensaje => $msg);

            $this->session->set_flashdata(Gestion::msg, $retorno);

            redirect_lf1('gestion/stikis', 'refresh');
        }

        $idStiki = $this->uri->segment(3);
        
        $stiki = Stiki::getById($idStiki);

        $usuario = Usuario::getById($_SESSION['id_usuario']);

        $msg = $this->stikis_model->venderStiki($stiki,$usuario );

        $retorno = array(Stikis_model::codigoRetorno => Stikis_model::codigoOk
            , Stikis_model::mensaje => $msg);

        $this->session->set_flashdata(Gestion::msg, $msg);

        redirect_lf1('gestion/stikis', 'refresh');
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
