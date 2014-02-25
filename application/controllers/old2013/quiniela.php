<?php

class Quiniela extends Controller {

	function Quiniela(){
		parent :: Controller();
		$this->load->database();
		$this->load->model('quiniela/quiniela_model');
		$this->load->model('boxes/boxes_model');
		$this->load->model('banco/banco_model');
		$this->load->model('sesiones/control_session');
		$this->load->model('calendario/calendario_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('validation');
	}
	
	function comprarQuiniela()
	{
		
		// controlar session
		$this->control_session->comprobar_sesion();	
		
		// Recoger saldo usuario
		$menu['saldo'	 	] = $this->banco_model->getSaldo('formateado');
		$menu['estadisticas'] = false;
		$datos['saldoNum'] = $this->banco_model->getSaldo();
		
		
		// Control boxes
		$estadoBoxes = $this->boxes_model->estado();
		
		// abrir cerrar box
		$datos['boxes'			] = $estadoBoxes;
		$datos['mis_quinielas' 	] = $this->quiniela_model->getQuinielasActivas();
		
		// Se obtiene la lista de pilots para rellenar los combos
		$pilotos = $this->quiniela_model->obtenerPilotos();
		$datos ['pilotos'		] = $pilotos;
		
		
		// Preparar la vista
		$header['estilos'] = array('boxes.css');
		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top');
		$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/quiniela_comprar',$datos);
		$this->load->view('base/page_bottom');
	}
	
	function nueva_quiniela()
	{
		// controlar session
		$this->control_session->comprobar_sesion();	
		
		// Control boxes
		$estadoBoxes = $this->boxes_model->estado();
		
		// Control quiniela (Para que no pueda entrar aqui si ya tiene una quiniela comprada)
		$checkQuiniela = $this->quiniela_model->getQuinielasActivas();
		
		if( !$checkQuiniela)
		{
				// abrir cerrar box
			$datos['boxes'			] = $estadoBoxes;
			
			//Pais del siguiente Gran premio
			$datos['granPremio']	 = $this->calendario_model->obtenerPaisDelSiguienteGp();	
			
			// Campos a validar, se le quitan espacios, el passwd se codifica en md5
			$rules['uno']  	= "required";
			$rules['dos']   = "required";
			$rules['tres'] 	= "required";
			$rules['cuatro']= "required";
			$rules['cinco']	= "required";
				
			$this->validation->set_rules($rules);
			
			$fields['uno']  	= '1º puesto';
			$fields['dos']   	= '2º puesto';
			$fields['tres'] 	= '3º puesto';
			$fields['cuatro']   = '4º puesto';
			$fields['cinco']    = '5º puesto';
					
			$this->validation->set_fields($fields);	
			
			if ($this->validation->run() == FALSE)
			{
				// Se obtiene la lista de pilots para rellenar los combos
				$pilotos = $this->quiniela_model->obtenerPilotos();
				$datos ['pilotos'		] = $pilotos;
				
				// Recoger saldo usuario
				$datos['saldo'	 ] = $this->banco_model->getSaldo('formateado');
				$datos['saldoNum'] = $this->banco_model->getSaldo();
				
				// Preparar la vista
				$header['estilos'] = array('boxes.css');
				$this->load->view('base/cabecera',$header);
				$this->load->view('base/page_top');
				$this->load->view('base/menu_vertical_boxes',$menu);
				$this->load->view('boxes/quiniela_comprar',$datos);
				$this->load->view('base/page_bottom');
			}
			else
			{
				//Se inserta la quiniela
				$this->quiniela_model->insertQuiniela($_POST);
				//Se comprueba si ya hay alguna quiniela creada
				$datos['mis_quinielas' 	] = $this->quiniela_model->getQuinielasActivas();
				//se resta la pasta
				$this->banco_model->restarDinero(10000);
				// Recoger saldo usuario
				$datos['saldo'	 ] = $this->banco_model->getSaldo('formateado');
				$datos['saldoNum'] = $this->banco_model->getSaldo();
				// Preparar la vista
				$header['estilos'] = array('boxes.css');
				$this->load->view('base/cabecera',$header);
				$this->load->view('base/page_top');
				$this->load->view('base/menu_vertical_boxes',$menu);
				$this->load->view('boxes/quiniela',$datos);
				$this->load->view('base/page_bottom');
			}
		}
		else
		{
			redirect_lf1('boxes/quiniela','location');
		}
		
		
		
	}
	// funcion callback para la validacion
	

}