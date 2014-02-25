<?php

require_once APPPATH . 'classes/pilotos/piloto.php';
require_once APPPATH . 'classes/pilotos/pilotoFicha.php';
require_once APPPATH . 'classes/pilotos/pilotoUsuario.php';
require_once APPPATH . 'classes/equipos/equipo.php';
require_once APPPATH . 'classes/equipos/equipoFicha.php';
require_once APPPATH . 'classes/equipos/equipoUsuario.php';
require_once APPPATH . 'classes/pilotos/valorMercado.php';
require_once APPPATH . 'classes/usuarios/usuario.php';

class Mercado extends Controller {

    const msgFichaje = "msgFichaje";

    /**
     * Idiomas soportados /*DEPRECATED! */
    /*
      private $languages	= array ('spanish','english');
     */

    function Mercado() {
        parent::Controller();

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

        // Javascript
        $bottom['javascript'] = array();

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

        if ($this->uri->segment(3) === FALSE) {
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
        if ($this->uri->segment(3) === FALSE) {
            $msg = "Equipo NO comprado";

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
        if ($this->uri->segment(3) === FALSE) {
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

        // Javascript
        $bottom['javascript'] = array();

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
    function procesarPreciosPostGp() {

        /*
         * Se obtiene el primer circuito sin procesar
         */
        $idGp = $this->calendario_model->obtenerCircuitoAProcesar()->row()->id;

        //Pilotos
        $this->_procesarPrecioPilotos($idGp);

        //Equipos
        $this->_procesarPrecioEquipos($idGp);
    }

    private function _procesarPrecioEquipos($idGp) {
        //Equipos
        $equipos = $this->equipos_model->getEquiposObject();

        foreach ($equipos as $equipo) {
            echo $equipo->getEscuderia();
            echo "<br>";
            echo "valor actual " . $equipo->getValorActual();
            echo "<br>";
            echo "valor anterior " . $equipo->getValorAnterior();
            echo "<br>";
            $posicionMundial = $this->equipos_model->
                            getPosicionEquipoMundial($equipo->getIdEquipo())->row()->posicion;

            echo "posicion mundial " . $posicionMundial;
            echo "<br>";

            $posicionGp = $this->equipos_model->
                            getPosicionEquipoGp($equipo->getIdEquipo(), $idGp)->row()->posicion;

            echo "posicion Gp " . $posicionGp;
            echo "<br>";

            $diferencia = $posicionMundial - $posicionGp;

            echo "diferencia " . $diferencia;
            echo "<br>";

            if ($diferencia != 0) {
                $porcentaje = $this->equipos_model->
                                getPorcentajeMejora(abs($diferencia))
                                ->row()->porcentaje;

                //Se comprueba si hay que aumentar o decrementar el valor del piloto
                if ($diferencia < 0) {
                    //Decrementar
                    echo "disminuir " . $porcentaje;
                    echo "<br>";
                    $equipo->disminuirValor($porcentaje);
                } elseif ($diferencia > 0) {
                    //Aumentar
                    echo "aumentar " . $porcentaje;
                    echo "<br>";
                    $equipo->aumentarValor($porcentaje);
                }
            } else {
                $equipo->mismoValor();
            }


            echo "valor actual " . $equipo->getValorActual();
            echo "<br>";
            echo "valor anterior " . $equipo->getValorAnterior();
            echo "<br>";
            echo "<br>";

            $this->equipos_model->guardarValorEquipo($equipo);
        }
    }

    private function _procesarPrecioPilotos($idGp) {
        //Pilotos
        $pilotos = $this->pilotos_model->getPilotosObject();

        foreach ($pilotos as $piloto) {
            $posicionMundial = $this->pilotos_model->
                            getPosicionPilotoMundial($piloto->getIdPiloto())->row()->posicion;

            $datosGp = $this->pilotos_model->
                    getPosicionPilotoGp($piloto->getIdPiloto(), $idGp);

            $posicionGp;
            if ($datosGp->num_rows()) {
                $posicionGp = $datosGp->row()->posicion;
            }

            echo $posicionGp;
            echo $piloto->getNombre();
            echo "<br>";
            echo "Valor actual " . $piloto->getValorActual();
            echo "<br>";
            echo "Valor anterior " . $piloto->getValorAnterior();
            echo "<br>";
            echo "posicion mundial " . $posicionMundial;
            echo "<br>";
            echo "posicion gp " . $posicionGp;
            echo "<br>";
            if (isset($posicionGp)) {
                echo " ha corrido";

                echo "<br>";

                $diferencia = $posicionMundial - $posicionGp;
                echo "diferencia " . $diferencia . "<br>";
                //Se obtiene el porcentaje a decrementar
                if ($diferencia != 0) {
                    $porcentaje = $this->pilotos_model->
                                    getPorcentajeMejora(abs($diferencia))
                                    ->row()->porcentaje;

                    //Se comprueba si hay que aumentar o decrementar el valor del piloto
                    if ($diferencia < 0) {
                        //Decrementar
                        echo "disminuir " . $porcentaje;
                        echo "<br>";
                        $piloto->disminuirValor($porcentaje);
                    } elseif ($diferencia > 0) {
                        //Aumentar
                        echo "aumentar " . $porcentaje;
                        echo "<br>";
                        $piloto->aumentarValor($porcentaje);
                    }
                } else {
                    //Se ejecuta la funcion que deja el valor anterior con el de ahora
                    $piloto->mismoValor();
                }

                echo "Valor actual " . $piloto->getValorActual();
                echo "<br>";
                echo "Valor anterior " . $piloto->getValorAnterior();
                echo "<br>";
                echo "<br>";
            } else {
                //Se ejecuta la funcion que deja el valor anterior con el de ahora
                $piloto->mismoValor();
            }

            $this->pilotos_model->guardarValorPiloto($piloto);
        }
    }

}
