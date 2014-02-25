<?php

class Scripts extends Controller
{
	function Scripts()
	{
		parent::Controller();
		$this->load->database();
		$this->load->model('sesiones/control_session');
		$this->load->model(array('scripts/gestion_pole_2011' ,
								'scripts/gestion_gp_2011',
								'scripts/resultados_usuarios_2011',
								'estadisticas/estadisticas_model',
								'scripts/gestion_apuestas',
								'apuestas/apuestas_model'));
		//$this->output->enable_profiler();
		$this->control_session->comprobar_sesion();

		// SOLO PUEDE ENTRAR EL ADMIN
		if( $_SESSION['id_usuario'] != '177')
			die("Acceso denegado !");

	}

	function index()
	{

		if( $_POST )
		{
			$this->gestion_gp_2011->guardar_resultados_gp( $_POST );
		}
		$this->load->model('pilotos/pilotos_model');

		$listado_pilotos = $this->pilotos_model->getInfoPilotosEquipos();

		$data['info_apuestas'			] = $this->apuestas_model->admin_check_apuestas_fraude();
		$data['formulario_resultados'	] = $this->gestion_gp_2011->get_formulario_resultados( $listado_pilotos );
		$data['resultados_metidos'      ] = $this->gestion_gp_2011->check_resultados_metidos();

		$data['usuarios_registrados'	] = $this->estadisticas_model->usuarios_registrados();
		$data['gp'						] = $this->estadisticas_model->gp_a_procesar();
		$data['link_pole'				] = anchor('scripts/gestionar_pole','EJECUTAR EL SCRIPT!!');

		$this->load->view('admin/panel', $data);

	}

	// PRIMERO SE GESTIONA LA POLE
	function gestionar_pole()
	{
		//die("a");
		$this->gestion_pole_2011->procesar_pole();

		//print_r($resultado);
	}

	// SEGUNDO SE GESTIONA EL GP POR TRAMOS de 300 usuarios :
	// MAX 2000~ usuarios!!! : Controlar esto, si el numero de usuarios es superior a 2000 habra ke poner mas
	// cases.

	function gestionar_gp( $limite ,$tot_usuarios)
	{
		//$tot_usuarios = $this->estadisticas_model->usuarios_registrados();

		switch ($limite)
		{
			case '0':
				$this->gestion_gp_2011->procesar_gp(0 , $tot_usuarios);
			break;

			case '300':
				$this->gestion_gp_2011->procesar_gp(300, $tot_usuarios);
			break;

			case '600':
				$this->gestion_gp_2011->procesar_gp(600 , $tot_usuarios);
			break;

			case '900':
				$this->gestion_gp_2011->procesar_gp(900, $tot_usuarios);
			break;

			case '1200':
				$this->gestion_gp_2011->procesar_gp(1200, $tot_usuarios);
			break;

			case '1500':
				$this->gestion_gp_2011->procesar_gp(1500, $tot_usuarios);
			break;

			case '1800':
				$this->gestion_gp_2011->procesar_gp(1800, $tot_usuarios);
			break;

			case '2100':
				$this->gestion_gp_2011->procesar_gp(2100, $tot_usuarios);
			break;

		}


	}

	// TERCERO
	function desglose_banco()
	{
		$this->resultados_usuarios_2011->procesar_desglose_banco();
	}

	// CUARTO
	function desglose_publicistas()
	{
		$this->resultados_usuarios_2011->procesar_desglose_publicistas();
	}

	/*
	 * QUINTO
	 */
	function procesar_resultados_2011()
	{
		//echo  "si";die;
		$this->resultados_usuarios_2011->procesar_resultados_usuarios();
	}

	// SEXTO
	function procesar_puntos_totales()
	{
		$this->resultados_usuarios_2011->puntos_manager_totales();
	}

	// SEPTIMO
	function procesar_apuestas()
	{
		$this->resultados_usuarios_2011->procesar_desglose_ingreso_apuestas();
                //$datos = $this->gestion_apuestas->procesarApuestas('2');

        //echo $datos;
	}

	// OCTAVO
	function procesar_cerrar_gp()
	{
		$this->resultados_usuarios_2011->cerrar_gp();

		//echo "TODOS LOS DATOS ACTUALIZADOS";
	}

	// ULTIMO 2013
	function procesar_estrellas()
	{
		$this->resultados_usuarios_2011->estrellas_usuarios();
	}
}

