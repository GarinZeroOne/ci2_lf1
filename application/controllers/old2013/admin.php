<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();
		session_start();
		$this->load->helper( 'url');
		$this->load->database();
		$this->load->model('sesiones/control_session');			
		$this->load->model('estadisticas/estadisticas_model');
		$this->load->model('menudata/menudata_model');
		$this->load->model('pilotos/pilotos_model')		;
		$this->load->model('calendario/calendario_model');
		// controlar session
		$this->control_session->comprobar_sesion();	
	}
	
	function index( )
	{
		// Es el admin???
		if( $_SESSION['id_usuario'  ] == 177){
			
			// Datos del menu estadisticas,posts y countdown
			$datos = $this->menudata_model->get_menu_data();
			
			$datos['circuitos'   ] = $this->calendario_model->obtenerCircuitosSinProcesar();
			$datos['pilotos'     ] = $this->pilotos_model->getInfoPilotos();
					
					
			$header['estilos' ] = array('admin.css');
			
			//Se prepara la vista				
			$this->load->view('base/cabecera',$header);
			$this->load->view('base/page_top');
			$this->load->view('base/menu_vertical_inicio',$datos);
			$this->load->view('admin/inicio',$var);
			$this->load->view('base/page_bottom');	
		}
		
		else {
			// Si no es el admin le mandamos a inicio
			redirect_lf1('inicio');
		}
		
		
	}
	
	function guardar_datos_gp()
	{
		if( $_POST ){
			
			$this->guardar_en_bd( $_POST );
		}
		
	}
	
	function guardar_en_bd( $datos )
	{
		$insert_data = array( 
							'id'				=>				'',
							'id_circuito'		=>				$datos['circuito'],
							'id_primero'		=>				$datos['primero'],
							'id_segundo'		=>				$datos['segundo'],
							'id_tercero'		=>				$datos['tercero'],
							'id_cuarto'			=>				$datos['cuarto'],
							'id_quinto'			=>				$datos['quinto'],
							'id_sexto'			=>				$datos['sexto'],
							'id_septimo'		=>				$datos['septimo'],
							'id_octavo'			=>				$datos['octavo'],
							'id_noveno'			=>				$datos['noveno'],
							'id_decimo'			=>				$datos['decimo'],
							'id_poleman'		=>				$datos['poleman'],
							'fecha'				=>				date('Y-m-d'),
							'procesado'			=>				0,
							
							);
	}
	
	
	
}