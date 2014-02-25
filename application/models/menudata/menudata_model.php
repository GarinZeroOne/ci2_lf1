<?php
class Menudata_model extends CI_model
{
	function Menudata_model()
	{
		parent::__construct();
		$this->load->model(array('calendario/calendario_model',
								 'estadisticas/estadisticas_model',
								 'foro/foro_model',
								 'stikis/stikis_model') );
	}

	// Devuelve un array con los datos para
	// mostrar las estadisticas y la cuenta atras.
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
	function get_menu_data()
	{
		// Estadisticas
		$datos['pilotosComprados'	  ] = $this->estadisticas_model->totalPilotosComprados();
		$datos['pilotosVendidos' 	  ] = $this->estadisticas_model->totalPilotosVendidos();
		$datos['equiposComprados'	  ] = $this->estadisticas_model->totalEquiposComprados();
		$datos['equiposVendidos' 	  ] = $this->estadisticas_model->totalEquiposVendidos();
		$datos['stikisPuntosComprados'] = $this->estadisticas_model->stikisComprados('puntos');
		$datos['stikisDineroComprados'] = $this->estadisticas_model->stikisComprados('dinero');
		$datos['estadisticas'		  ] = true;


		// Datos para la cuenta atras al GP
		$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$fecha_gp = explode("-",$next_GP->fecha);

		$datos['anioGP']  = $fecha_gp[0];
		$datos['mesGP' ]  = $fecha_gp[1];
		$datos['diaGP' ]  = $fecha_gp[2];
		$datos['paisGP']  = $next_GP->pais;

		// Ultimos posts del foro
		$datos['lastPost'] = $this->foro_model->get_ultimos_posts();

		$datos['stikisDineroComprados'] = $this->stikis_model->getStikisEstadisticas("dinero");
		$datos['stikisPuntosComprados'] = $this->stikis_model->getStikisEstadisticas("puntos");

		return $datos;
	}


}
