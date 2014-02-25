<?php

class Escuderia extends Controller {

	function Escuderia()
	{
		parent::Controller();
		$this->load->helper(array('form', 'url'));
		$this->load->library('validation');
		$this->load->database();
		$this->load->model('sesiones/control_session');			
		$this->load->model('escuderia/escuderia_model');
	}
	
	function index()
	{
		$escuderia = $this->escuderia_model->comprobarEscuderia();
		if ($escuderia == 0){
			$var['pilotos'] = $this->escuderia_model->obtenerPilotos();
			$var['alta'] = false;
			$var['msgtxt'] = "Rellene el siguiente formulario para participar en la liga.";
			if ($_POST){
				$this->escuderia_model->insertarEscuderia();
				$var['msgtxt'] = "Escuderia creada correctamente";
				$var['alta'] = true;
			}
		}
		else{
			$var['msgtxt'] = "Ya tienes una escuderia creada.";
			$var['alta'] = true;
		}
		
		// Preparar la vista
		$header['estilos'] = array('escuderia.css');
		$this->load->view('base/cabecera',$header);
		$this->load->view('base/menu1');
		$this->load->view('escuderia',$var);
		$this->load->view('base/pie');
	}
	
}