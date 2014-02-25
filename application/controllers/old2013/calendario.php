<?php

class Calendario extends Controller {

    /**
    * Idiomas soportados
    */
    private $languages      = array ('spanish','english');

    function Calendario() {
        parent::Controller();

        // Configurar idioma
        $this->_set_language();

        session_start();
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('sesiones/control_session');
        $this->load->model('calendario/calendario_model');
        $this->load->model('estadisticas/estadisticas_model');
        $this->load->model('menudata/menudata_model');
        $this->load->model('banco/banco_model');
        // Controlar que tenga session abierta
        // y no este caducada. Esto hay que hacerlo
        // en todos los metodos de los controladores
        // que sean privados
        $this->control_session->comprobar_sesion();
    }

    function index() {

        // Datos del menu estadisticas,posts y countdown
        $datos = $this->menudata_model->get_menu_data();

        $var['circuitos'] = $this->calendario_model->obtenerCircuitos();

        $header['estilos'] = array('calendario.css');

        // Menu activo
        $menu['m_act'] = 8;
        $menu['saldo'       ] = $this->banco_model->getSaldo('formateado');

        //Se prepara la vista
        $this->load->view('base/cabecera', $header);
        $this->load->view('base/page_top',$menu);
        //$this->load->view('base/menu_vertical_inicio', $datos);
        $this->load->view('calendario/calendario', $var);
        $this->load->view('base/page_bottom');
    }

    /**
         * Configurar el idioma que debe cargar
         *
         * @access      private
         * @author      Gorka Garin
         * @return      void
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