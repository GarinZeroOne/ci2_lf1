<?php

class Prueba extends Controller {

    function Prueba() {
        parent::Controller();
        $this->load->helper(array('form', 'url'));
        $this->load->library('validation');
        $this->load->database();
        $this->load->model(array('sesiones/control_session', 'estadisticas/estadisticas_model'));
        $this->load->model('scripts/gestionApuestas');
        $this->load->model('menudata/menudata_model');
		
		reciredt('inicio');
    }
	
	/*
    function index() {

        // Hay que pasar el id_gp como parametro
        $datos = $this->gestionApuestas->procesarApuestas_garin('2');

        echo $datos;

        die;

        // Preparar la vista
        $header['estilos'] = array('alta.css');
        $this->load->view('base/cabecera', $header);
        $this->load->view('base/page_top');
        $this->load->view('base/menu_vertical_inicio', $datos);
        $this->load->view('alta/alta');
        $this->load->view('base/page_bottom');
    }
	*/
   

}