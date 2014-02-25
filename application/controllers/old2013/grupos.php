<?php

class Grupos extends Controller {

    /**
     * Idiomas soportados
     */
    private $languages = array('spanish', 'english');

    function Grupos() {
        parent :: Controller();

        // Configurar idioma
        $this->_set_language();

        $this->load->database();
        $this->load->model('grupos/grupos_model');
        $this->load->model('banco/banco_model');
        $this->load->model('boxes/boxes_model');
        $this->load->model('sesiones/control_session');
        $this->load->model('calendario/calendario_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('validation');
    }

    function index() {
        redirect_lf1('grupos/grupos_general');
    }

    function grupos_general() {

        // controlar session
        $this->control_session->comprobar_sesion();

        // Recoger saldo usuario
        $menu['saldo'] = $this->banco_model->getSaldo('formateado');
        $menu['estadisticas'] = false;

        $datos['gruposUsuario'] =
                $this->grupos_model->obtenerGruposUsuario($_SESSION['id_usuario'])->result();

        if (count($datos['gruposUsuario']) == 0) {
            $msg = "No eres miembro de ningun grupo";
            redirect_lf1('grupos/gestionGrupos/0/' . $msg, 'location');
        }

        if ($this->uri->segment(3) === FALSE) {
            $idGrupo = $datos['gruposUsuario'][0]->id_grupo;
        } else {
            $idGrupo = $this->uri->segment(3);
        }

        // NEW 2013! Poner como notificados todos los mensajes de este grupo
        // de manera que no te vuelva a notificar hasta ke haya nuevos
        $this->grupos_model->set_notificados($idGrupo,$_SESSION['id_usuario']);

        $datos['idGrupo'] = $idGrupo;

        //Se añade el model de los rankings
        $this->load->model('ranking/ranking_model');

        $datos['nombreGrupo'] =
                $this->grupos_model->obtenerNombreGrupo($idGrupo)->nombre;

        $datos['rankingGP'] =
                $this->grupos_model->gruposRankingGP($idGrupo)->result();

        $datos['rankingGeneral'] =
                $this->grupos_model->gruposRankingGeneral($idGrupo)->result();

        $datos['ultMensajes'] =
                $this->grupos_model->obtenerMensajes($idGrupo)->result();

        $datos['datosGP'] = $this->ranking_model->obtenerNombreGP($idGP);

        // Datos para la cuenta atras al GP
        $next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

        $fecha_gp = explode("-", $next_GP->fecha);

        $menu['anioGP'] = $fecha_gp[0];
        $menu['mesGP'] = $fecha_gp[1];
        $menu['diaGP'] = $fecha_gp[2];
        $menu['paisGP'] = $next_GP->pais;

        // Menu activo
        $menu['m_act'] = 7;

        // S.R.R (estrellas)
        $var['num_estrellas'] = $this->boxes_model->get_num_estrellas();
        $var['srr'] = $this->boxes_model->get_srr();

        // Preparar la vista
        $header['estilos'] = array('boxes.css', 'grupos.css');
        $header['javascript'] = array('jquery', 'grupos', 'miajaxlib');

        $this->load->view('base/cabecera', $header);
        $this->load->view('base/page_top', $menu);
        $this->load->view('boxes/boxtopbar',$var);
        //$this->load->view('base/menu_vertical_boxes', $menu);
        $this->load->view('boxes/gruposCabecera2013');
        $this->load->view('boxes/grupos2013', $datos);
        //$this->load->view('boxes/gruposMensajes', $mensaje);
        //$this->load->view('boxes/gruposFin');
        $this->load->view('base/page_bottom');
    }

    function gruposInvitacionesPeticiones() {

        // controlar session
        $this->control_session->comprobar_sesion();

        // Recoger saldo usuario
        $menu['saldo'] = $this->banco_model->getSaldo('formateado');
        $menu['estadisticas'] = false;

        //Se obtienen las invitaciones recibidas
        $datos['invitacionesRecibidas'] = $this->grupos_model->obtenerInvitacionesRecibidas('P');

        //Se obtienen las invitaciones recibidas
        $datos['invitacionesNoAceptadas'] =
                $this->grupos_model->obtenerInvitacionesRealizadas('P')->result();

        //Se obtienen los grupos de los cual el usuario es el creador
        $datos['gruposPropios'] = $this->grupos_model->obtenerGrupoPropietario()->result();

        //Se obtiene el listado de grupos para poder realizar peticiones
        $datos['listaGruposNoPropios'] = $this->grupos_model->obtenerListaGruposNoPropios();

        //Se obtienen las peticiones en espera del usuario
        $datos['listaPeticionesRealizadas'] = $this->grupos_model->obtenerPeticionesRealizadas();

        //Se obtienen la lista de las peticiones recibidas
        $datos['listaPeticionesRecibidas'] = $this->grupos_model->obtenerPeticionesRecibidas();

        // Datos para la cuenta atras al GP
        $next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

        $fecha_gp = explode("-", $next_GP->fecha);

        $menu['anioGP'] = $fecha_gp[0];
        $menu['mesGP'] = $fecha_gp[1];
        $menu['diaGP'] = $fecha_gp[2];
        $menu['paisGP'] = $next_GP->pais;

        // Menu activo
        $menu['m_act'] = 7;

        // S.R.R (estrellas)
        $var['num_estrellas'] = $this->boxes_model->get_num_estrellas();
        $var['srr'] = $this->boxes_model->get_srr();

        // Preparar la vista
        $header['estilos'] = array('boxes.css', 'grupos.css');
        $header['javascript'] = array('jquery', 'grupos', 'miajaxlib');

        $this->load->view('base/cabecera', $header);
        $this->load->view('base/page_top', $menu);
        $this->load->view('boxes/boxtopbar',$var);
        //$this->load->view('base/menu_vertical_boxes', $menu);
        $this->load->view('boxes/gruposCabecera2013');
        $this->load->view('boxes/gruposInvitacionesPeticiones2013', $datos);
        //$this->load->view('boxes/gruposFin');
        $this->load->view('base/page_bottom');
    }

    function gestionGrupos() {

        if ($this->uri->segment(4) === FALSE) {
            $datos['msg'] = "";
        } else {
            $datos['msg'] = $this->uri->segment(4);
        }

        // controlar session
        $this->control_session->comprobar_sesion();

        // Recoger saldo usuario
        $menu['saldo'] = $this->banco_model->getSaldo('formateado');
        $menu['estadisticas'] = false;

        //Se obtienen los grupos de los cual el usuario es el creador
        $datos['gruposPropios'] = $this->grupos_model->obtenerGrupoPropietario()->result();

        if (count($datos['gruposPropios']) > 0) {

            if ($this->uri->segment(3) === FALSE || $this->uri->segment(3) == 0) {
                $idGrupo = $datos['gruposPropios'][0]->id;
            } else {
                $idGrupo = $this->uri->segment(3);
            }

            $datos['nombreGrupo'] =
                    $this->grupos_model->obtenerNombreGrupo($idGrupo)->nombre;

            $datos['idGrupo'] = $idGrupo;

            $datos['miembrosGrupo'] =
                    $this->grupos_model->obtenerMiembros($idGrupo);
        }

        // Datos para la cuenta atras al GP
        $next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

        $fecha_gp = explode("-", $next_GP->fecha);

        $menu['anioGP'] = $fecha_gp[0];
        $menu['mesGP'] = $fecha_gp[1];
        $menu['diaGP'] = $fecha_gp[2];
        $menu['paisGP'] = $next_GP->pais;

        // Menu activo
        $menu['m_act'] = 7;

        // S.R.R (estrellas)
        $var['num_estrellas'] = $this->boxes_model->get_num_estrellas();
        $var['srr'] = $this->boxes_model->get_srr();

        // Preparar la vista
        $header['estilos'] = array('boxes.css', 'grupos.css');
        $header['javascript'] = array('jquery', 'grupos', 'miajaxlib');

        $this->load->view('base/cabecera', $header);
        $this->load->view('base/page_top', $menu);
        $this->load->view('boxes/boxtopbar',$var);
        //$this->load->view('base/menu_vertical_boxes', $menu);
        $this->load->view('boxes/gruposCabecera2013');
        $this->load->view('boxes/gruposGestion2013', $datos);
        //$this->load->view('boxes/gruposFin');
        $this->load->view('base/page_bottom');
    }

    function miembrosGrupo() {
        //Se recibe por post el id del grupo
        $idGrupo = $this->uri->segment(3);
        $datos['msg'] = $this->uri->segment(4);

        //Se obtienen los miembros del grupo
        $datos['miembrosGrupo'] = $this->grupos_model->obtenerMiembros($idGrupo);

        // Menu activo
        $menu['m_act'] = 7;

        //Se llama la vista que genera el xml
        $this->load->view('xml/cabecera');
        $this->load->view('boxes/xml/miembrosGrupoXml', $datos);
        $this->load->view('xml/final');
    }

    //Funcion que obtiene los datos cuando se crea una nueva invitacion
    function nuevaInvitacion() {
        //Se obtienen los datos pasados por post
        $idGrupo = $_POST['idGrupo'];

        //Se comprueba el usuario
        $usuario = $this->grupos_model->comprobarUsuario($_POST['nick']);

        //si existe el usuario se inserta la invitacion
        if ($usuario->num_rows() > 0) {
            $idUsuario = $usuario->row()->id;

            //Se comprueba si el invitado ya es miembro del grupo
            $esMiembro = $this->grupos_model->comprobarUsuarioGrupo($idUsuario, $idGrupo)->num_rows();

            if ($esMiembro > 0) {
                $msgText = "El usuario invitado ya es miembro del grupo.";
            } else {
                //Se comprueba si el invitado ya tiene invitacion
                $tieneInvitacion =
                        $this->grupos_model->obtenerInvitacionUsuarioGrupo($idUsuario, 'P', $idGrupo)->num_rows();
                if ($tieneInvitacion > 0) {
                    $msgText = "El usuario ya tiene invitación, pendiente de aceptar.";
                } else {
                    // Se inserta la invitacion en la BBDD
                    $this->grupos_model->insertInvitacion($idGrupo, $_SESSION['id_usuario'], $idUsuario);
                    $msgText = "Invitacion generada correctamente.";
                }
            }
        } else {
            $msgText = "El usuario no existe";
        }

        //Se obtienen las invitaciones no aceptadas
        $datos['invitacionesNoAceptadas'] =
                $this->grupos_model->obtenerInvitacionesRealizadas('P')->result();

        //Se guarda el mensaje a mostrar
        $datos['msg'] = $msgText;

        // Menu activo
        $menu['m_act'] = 7;

        //Se llama la vista que genera el xml
        $this->load->view('xml/cabecera');
        $this->load->view('boxes/xml/nuevaInvitacionXml', $datos);
        $this->load->view('xml/final');
    }

    function nuevoGrupo() {

        //Si no hay session iniciada no se pueden crear grupos
        if (!isset($_SESSION['id_usuario'])) {
            redirect_lf1('inicio');
        }

        $idGrupo = 0;
        //Se comprueba si existe el grupo
        $existeGrupo = $this->grupos_model->existeGrupo($_POST['nombre']);

        if ($existeGrupo) {
            $msg = "El grupo ya existe";
        } else {
            //Se inserta el grupo en la tabla usuarios_grupos
            $idGrupo = $this->grupos_model->insertGrupo($_POST['nombre']);

            //Se inserta en la tabla grupos_miembros el usuario creador
            $this->grupos_model->insertGrupoUsuario($idGrupo, $_SESSION['id_usuario']);

            $msg = "Grupo creado correctamente";
        }

        redirect_lf1('grupos/gestionGrupos/' . $idGrupo . "/" . $msg, 'location');
    }

    function aceptaInvitacion() {
        //Se guarda el id de la invitacion
        $idInvitacion = $_POST['idInvitacion'];

        //Se llama a la funcion que acepta la invitacion
        $this->grupos_model->aceptaInvitacion($idInvitacion);

        //Se obtienen las invitaciones recibidas
        $datos['invitacionesRecibidas'] = $this->grupos_model->obtenerInvitacionesRecibidas('P');

        // Menu activo
        $menu['m_act'] = 7;

        //Se llama la vista que genera el xml
        $this->load->view('xml/cabecera');
        $this->load->view('boxes/xml/listaInvitacionesRecibidasXml', $datos);
        $this->load->view('xml/final');
    }

    function rechazaInvitacion() {
        //Se guarda el id de la invitacion
        $idInvitacion = $_POST['idInvitacion'];

        //Se comprueba si el usuario que rechaza la invitación es el que la ha recibido
        $idUsuarioReceptor = $this->grupos_model->datosInvitacion($idInvitacion)->id_usuario;

        if ($idUsuarioReceptor != $_SESSION['id_usuario']) {
            redirect_lf1('inicio');
        }

        //Se llama a la funcion que acepta la invitacion
        $this->grupos_model->rechazaInvitacion($idInvitacion);

        //Se obtienen las invitaciones recibidas
        $datos['invitacionesRecibidas'] = $this->grupos_model->obtenerInvitacionesRecibidas('P');

        // Menu activo
        $menu['m_act'] = 7;

        //Se llama la vista que genera el xml
        $this->load->view('xml/cabecera');
        $this->load->view('boxes/xml/listaInvitacionesRecibidasXml', $datos);
        $this->load->view('xml/final');
    }

    function borrarUsuarioGrupo() {
        //Se guarda el id del grupo
        $idGrupo = $_POST['idGrupo'];
        $idUsuario = $_POST['idUsuario'];

        //Se comprueba si el usuario que intenta borrar el miembro del grupo es el creador
        $idUsuarioCreador = $this->grupos_model->obtenerNombreGrupo($idGrupo)->id_usuario_creador;

        if ($idUsuarioCreador != $_SESSION['id_usuario']) {
            redirect_lf1('inicio');
        }

        $this->grupos_model->borrarUsuarioGrupo($idGrupo, $idUsuario);

        $msg = "Usuario borrado correctamente";

        redirect_lf1('grupos/miembrosGrupo/' . $idGrupo . '/' . $msg, 'location');
    }

    function borrarGrupo() {
        //Se guarda el id del grupo
        $idGrupo = $this->uri->segment(3);

        //Se comprueba si el usuarios que intenta borrar el grupo es el creador
        $idUsuarioCreador = $this->grupos_model->obtenerNombreGrupo($idGrupo)->id_usuario_creador;

        if ($idUsuarioCreador != $_SESSION['id_usuario']) {
            redirect_lf1('inicio');
        }

        //Se llama a la funcion que borra grupo
        $this->grupos_model->borraGrupo($idGrupo);

        $msg = "Grupo borrado correctamente";

        redirect_lf1('grupos/gestionGrupos/0/' . $msg, 'location');
    }

    function nuevaPeticion() {
        //Se guarda el id del grupo
        $idGrupo = $_POST['idGrupo'];

        //Se inserta la peticion
        $this->grupos_model->insertaPeticion($idGrupo);

        //Se obtienen las peticiones en espera del usuario
        $datos['listaPeticionesRealizadas'] = $this->grupos_model->obtenerPeticionesRealizadas();

        // Menu activo
        $menu['m_act'] = 7;

        //Se llama la vista que genera el xml
        $this->load->view('xml/cabecera');
        $this->load->view('boxes/xml/listaPeticionesRealizadasXml', $datos);
        $this->load->view('xml/final');
    }

    function aceptaPeticion() {
        //Se guarda el id de la peticion
        $idPeticion = $_POST['idPeticion'];

        //Se llama a la funcion que acepta la invitacion
        $this->grupos_model->aceptaPeticion($idPeticion);

        //Se obtienen la lista de las peticiones recibidas
        $datos['listaPeticionesRecibidas'] = $this->grupos_model->obtenerPeticionesRecibidas();

        // Menu activo
        $menu['m_act'] = 7;

        //Se llama la vista que genera el xml
        $this->load->view('xml/cabecera');
        $this->load->view('boxes/xml/listaPeticionesRecibidasXml', $datos);
        $this->load->view('xml/final');
    }

    function rechazaPeticion() {
        //Se guarda el id de la peticion
        $idPeticion = $_POST['idPeticion'];

        //Se llama a la funcion que acepta la invitacion
        $this->grupos_model->rechazaPeticion($idPeticion);

        //Se obtienen la lista de las peticiones recibidas
        $datos['listaPeticionesRecibidas'] = $this->grupos_model->obtenerPeticionesRecibidas();

        // Menu activo
        $menu['m_act'] = 7;

        //Se llama la vista que genera el xml
        $this->load->view('xml/cabecera');
        $this->load->view('boxes/xml/listaPeticionesRecibidasXml', $datos);
        $this->load->view('xml/final');
    }

    function enviarMensajes() {
        //Se recoge el Grupos
        $contenido = $_POST['mensaje'];
        $idGrupo = $_POST['idGrupo'];

        //Se inserta el mensaje recibido
        $this->grupos_model->insertMensajes($idGrupo, $contenido);
        $mensaje['idGrupo'] = $idGrupo;

        //Se obtienen los ultimos 10 mensajes.
        $mensaje['ultMensajes'] = $this->grupos_model->obtenerMensajes($idGrupo)->result();

        //Se llama la vista que genera el xml
        $this->load->view('xml/cabecera');
        $this->load->view('ranking/mensajesXml', $mensaje);
        $this->load->view('xml/final');
    }

    /**
     * Configurar el idioma que debe cargar
     *
     * @access  private
     * @author  Gorka Garin
     * @return  void
     */
    private function _set_language() {



        // Mirar si el idioma esta soportado
        if (in_array($this->session->userdata('language'), $this->languages)) {

            // Si esta soportado, lo seteamos
            $this->config->set_item('language', $this->session->userdata('language'));
        }

        // Cargar el archivo de idioma de la pagina que se ha solicitado
        $lang_file = $this->config->item('language') . '/' . $this->router->class . '_lang';


        // si el archivo fisico existe, cargamos su  contenido
        if (is_file(realpath(dirname(__FILE__) . '/../language/' . $lang_file . EXT))) {
            $this->lang->load($this->router->class);
        }

        // Cargar variables genericas de idioma
        $this->lang->load('global');
    }

}