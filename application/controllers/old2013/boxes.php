<?php
class Boxes extends Controller{

	/**
	 * Idiomas soportados
	 */
	private $languages	= array ('spanish','english');

	function Boxes()
	{
		parent::Controller();

		// Configurar idioma
		$this->_set_language();

		$this->load->helper(array('form', 'url'));
		$this->load->library('validation');
		$this->load->database();
		$this->load->model(array('sesiones/control_session',
								 'banco/banco_model',
								 'pilotos/pilotos_model',
								 'equipos/equipos_model',
								 'boxes/boxes_model',
								 'usuarios/usuarios_model',
								 'calendario/calendario_model',
								 'boxes/mejoras_model'
								 ));
	}

	function index()
	{
		// controlar session
		$this->control_session->comprobar_sesion();

		// Cargar helper timeago
        $this->load->helper('timeago');


		// Recoger saldo usuario
		$menu['saldo'			] = $this->banco_model->getSaldo('formateado');
		$menu['estadisticas'	] = false;

		// Datos para la cuenta atras al GP
		$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$fecha_gp = explode("-",$next_GP->fecha);

		$menu['anioGP']  = $fecha_gp[0];
		$menu['mesGP' ]  = $fecha_gp[1];
		$menu['diaGP' ]  = $fecha_gp[2];
		$menu['paisGP']  = $next_GP->pais;

		// Preparar la vista
		$header['estilos'] = array('boxes.css','usuarios.css','jquery-te-1.3.2.2.css');
		$header['javascript'] = array('perfil');

		// Menu activo
		$menu['m_act'] = 7;

		// Mi muro
		$var['ultimas_visitas'] = $this->usuarios_model->get_ultimas_visitas_perfil($_SESSION['id_usuario']);
        $var['muro'   ] = $this->usuarios_model->get_mensajes_muro($_SESSION['id_usuario']);

		// S.R.R (estrellas)
		$var['num_estrellas'] = $this->boxes_model->get_num_estrellas();
		$var['srr'] = $this->boxes_model->get_srr();

		// Nuevos post en el foro¿?
		$this->load->model('foro/foro_model');

		if($_SESSION['id_usuario'])
    			$var['notificaciones'] = $this->foro_model->notify_new_posts();


    	$var['notificaciones_grupos'] = $this->boxes_model->notify_actividad_grupos();

		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);

		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/boxtopbar',$var);
		$this->load->view('boxes/boxes2013',$var);
		$this->load->view('base/page_bottom');

	}

	function fichar_pilotos()
	{
		// controlar session
		$this->control_session->comprobar_sesion();

		// Control boxes
		$estadoBoxes = $this->boxes_model->estado();

		if ($_POST){
			$datos['fichajeTxt'] = $this->pilotos_model->fichar($_POST);
		}

		// Recoger saldo usuario
		$menu['saldo'	 	] = $this->banco_model->getSaldo('formateado');
		$menu['estadisticas'] = false;
		$datos['saldoNum'] = $this->banco_model->getSaldo();

		// Obtener listado de pilotos

		$datos['info_pilotos'] = $this->pilotos_model->getInfoPilotos();

		// Info ojeadores
		$datos['ojeadores'  ] = $this->mejoras_model->get_valor_mejora(1);
		// abrir cerrar box
		$datos['boxes'       ] = $estadoBoxes;

		// S.R.R (estrellas)
		$var['num_estrellas'] = $this->boxes_model->get_num_estrellas();
		$var['srr'] = $this->boxes_model->get_srr();

		// Datos para la cuenta atras al GP
		$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$fecha_gp = explode("-",$next_GP->fecha);

		$menu['anioGP']  = $fecha_gp[0];
		$menu['mesGP' ]  = $fecha_gp[1];
		$menu['diaGP' ]  = $fecha_gp[2];
		$menu['paisGP']  = $next_GP->pais;

		// Preparar la vista
		$header['estilos'] = array('boxes.css');

		// Menu activo
		$menu['m_act'] = 7;

		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		$this->load->view('boxes/boxtopbar',$var);
		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/fichar_pilotos',$datos);
		$this->load->view('base/page_bottom');
	}

	function mis_pilotos()
	{
		// controlar session
		$this->control_session->comprobar_sesion();

		// Vender piloto?
		if ($_POST){
			$datos['ventaTxt'] = $this->pilotos_model->vender($_POST);
		}

		// Obtener listado de pilotos
		$datos['info_pilotos'] = $this->pilotos_model->getMisPilotos();

		// Recoger saldo usuario
		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');
		$menu['estadisticas'] = false;

		// Datos para la cuenta atras al GP
		$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$fecha_gp = explode("-",$next_GP->fecha);

		$menu['anioGP']  = $fecha_gp[0];
		$menu['mesGP' ]  = $fecha_gp[1];
		$menu['diaGP' ]  = $fecha_gp[2];
		$menu['paisGP']  = $next_GP->pais;


		// S.R.R (estrellas)
		$var['num_estrellas'] = $this->boxes_model->get_num_estrellas();
		$var['srr'] = $this->boxes_model->get_srr();

		// Preparar la vista
		$header['estilos'] = array('boxes.css');

		// Menu activo
		$menu['m_act'] = 7;

		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		$this->load->view('boxes/boxtopbar',$var);
		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/mis_pilotos',$datos);
		$this->load->view('base/page_bottom');
	}

	function fichar_equipos()
	{
		// controlar session
		$this->control_session->comprobar_sesion();

		// Control boxes
		$estadoBoxes = $this->boxes_model->estado();

		if ($_POST){
			$datos['fichajeTxt'] = $this->equipos_model->fichar($_POST);
		}

		// Obtener listado de pilotos

		$datos['info_equipos'] = $this->equipos_model->getInfoEquipos();

		// Info ojeadores
		$datos['ojeadores'  ] = $this->mejoras_model->get_valor_mejora(1);

		// Recoger saldo usuario
		$menu['saldo'	 	] = $this->banco_model->getSaldo('formateado');
		$menu['estadisticas'] = false;
		$datos['saldoNum'] = $this->banco_model->getSaldo();

		// Datos para la cuenta atras al GP
		$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$fecha_gp = explode("-",$next_GP->fecha);

		// S.R.R (estrellas)
		$var['num_estrellas'] = $this->boxes_model->get_num_estrellas();
		$var['srr'] = $this->boxes_model->get_srr();

		// Menu activo
		$menu['m_act'] = 7;

		$menu['anioGP']  = $fecha_gp[0];
		$menu['mesGP' ]  = $fecha_gp[1];
		$menu['diaGP' ]  = $fecha_gp[2];
		$menu['paisGP']  = $next_GP->pais;


		// abrir cerrar box
		$datos['boxes'   ] = $estadoBoxes;
		// Preparar la vista
		$header['estilos'] = array('boxes.css');

		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		$this->load->view('boxes/boxtopbar',$var);
		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/fichar_equipos',$datos);
		$this->load->view('base/page_bottom');


	}

	function mis_equipos()
	{
		// controlar session
		$this->control_session->comprobar_sesion();

		if ($_POST){
			$datos['ventaTxt'] = $this->equipos_model->vender($_POST);
		}

		// Obtener listado de pilotos
		$datos['info_equipos'] = $this->equipos_model->getMisEquipos();

		// Recoger saldo usuario
		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');
		$menu['estadisticas'] = false;

		// Datos para la cuenta atras al GP
		$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$fecha_gp = explode("-",$next_GP->fecha);

		$menu['anioGP']  = $fecha_gp[0];
		$menu['mesGP' ]  = $fecha_gp[1];
		$menu['diaGP' ]  = $fecha_gp[2];
		$menu['paisGP']  = $next_GP->pais;


		// Preparar la vista
		$header['estilos'] = array('boxes.css');

		// Menu activo
		$menu['m_act'] = 7;

		// S.R.R (estrellas)
		$var['num_estrellas'] = $this->boxes_model->get_num_estrellas();
		$var['srr'] = $this->boxes_model->get_srr();

		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		$this->load->view('boxes/boxtopbar',$var);
		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/mis_equipos',$datos);
		$this->load->view('base/page_bottom');
	}

	/*
	function quiniela()
	{

		$this->load->model('quiniela/quiniela_model');
		$this->load->model('calendario/calendario_model');

		// controlar session
		$this->control_session->comprobar_sesion();

		// Recoger saldo usuario
		$menu['saldo'   	] = $this->banco_model->getSaldo('formateado');
		$menu['estadisticas'] = false;
		$datos['saldoNum'] 	= $this->banco_model->getSaldo();

		// Control boxes
		$estadoBoxes = $this->boxes_model->estado();
		// abrir cerrar box
		$datos['boxes'   ] = $estadoBoxes;

		$datos['mis_quinielas' ] = $this->quiniela_model->getQuinielasActivas();

		$datos['granPremio']	 = $this->calendario_model->obtenerPaisDelSiguienteGp();

		// Datos para la cuenta atras al GP
		$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$fecha_gp = explode("-",$next_GP->fecha);

		$menu['anioGP']  = $fecha_gp[0];
		$menu['mesGP' ]  = $fecha_gp[1];
		$menu['diaGP' ]  = $fecha_gp[2];
		$menu['paisGP']  = $next_GP->pais;


		// Preparar la vista
		$header['estilos'] = array('boxes.css');
		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/quiniela',$datos);
		$this->load->view('base/page_bottom');

	}
	*/
	/*function quiniela_comprar()
	{
		// controlar session
		$this->control_session->comprobar_sesion();

		// Recoger saldo usuario
		$datos['saldo'] = $this->banco_model->getSaldo('formateado');

		// Control boxes
		$estadoBoxes = $this->boxes_model->estado();
		// abrir cerrar box
		$datos['boxes'   ] = $estadoBoxes;

		// Preparar la vista
		$header['estilos'] = array('boxes.css');
		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		$this->load->view('base/menu_vertical_inicio');
		$this->load->view('boxes/quiniela_comprar',$datos);
		$this->load->view('base/page_bottom');


	}*/

	/*
	function apuestas()
	{
		// controlar session
		$this->control_session->comprobar_sesion();

		// Recoger saldo usuario
		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');
		$menu['estadisticas'] = false;

		// Preparar la vista
		$header['estilos'] = array('boxes.css');
		$this->load->view('base/cabecera',$header);
		$this->load->view('base/menu1');
		$this->load->view('boxes/apuestas',$datos);
		$this->load->view('base/pie');
	}
	*/


	function stikis()
	{
		// controlar session
		$this->control_session->comprobar_sesion();

		// Control boxes
		$estadoBoxes = $this->boxes_model->estado();
		// abrir cerrar box
		$datos['boxes'   ] = $estadoBoxes;

		// Recoger saldo usuario
		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');
		$menu['estadisticas'] = false;

		// Obtener listado de pilotos
		$datos['info_pilotos'] = $this->pilotos_model->getMisPilotos();

		// Siguiente GP
		$this->load->model('calendario/calendario_model');
		$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$datos['paisGP'] = $next_GP->pais;

		// Info ojeadores
		$datos['mecanicos'  ] = $this->mejoras_model->get_valor_mejora(2);

		// Cargar modelo stikis
		$this->load->model('stikis/stikis_model');

		$datos['info_stikis'] = $this->stikis_model->getInfoStikis();

		// Datos para la cuenta atras al GP
		$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$fecha_gp = explode("-",$next_GP->fecha);

		$menu['anioGP']  = $fecha_gp[0];
		$menu['mesGP' ]  = $fecha_gp[1];
		$menu['diaGP' ]  = $fecha_gp[2];
		$menu['paisGP']  = $next_GP->pais;


		// S.R.R (estrellas)
		$var['num_estrellas'] = $this->boxes_model->get_num_estrellas();
		$var['srr'] = $this->boxes_model->get_srr();

		// Preparar la vista
		$header['estilos'] = array('boxes.css');

		// Menu activo
		$menu['m_act'] = 7;

		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		$this->load->view('boxes/boxtopbar',$var);
		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/stikis',$datos);
		$this->load->view('base/page_bottom');
	}

	function stikis_comprar()
	{
		if($_POST['selPiloto']){

			// controlar session
			$this->control_session->comprobar_sesion();

			// Control boxes
			$estadoBoxes = $this->boxes_model->estado();
			// abrir cerrar box
			$datos['boxes'   ] = $estadoBoxes;

			// Obtener listado de pilotos
			$datos['info_pilotos'] = $this->pilotos_model->getMisPilotos();

			// Siguiente GP
			$this->load->model('calendario/calendario_model');
			$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

			$datos['paisGP'] = $next_GP->pais;

			// Cargar modelo stikis
			$this->load->model('stikis/stikis_model');

			// Guardar stikis
			$datos['info_txt'] = $this->stikis_model->guardarStiki($_POST);

			$datos['info_stikis'] = $this->stikis_model->getInfoStikis();

			// Recoger saldo usuario
			$menu['saldo'		] = $this->banco_model->getSaldo('formateado');
			$menu['estadisticas'] = false;

			// Info ojeadores
			$datos['mecanicos'  ] = $this->mejoras_model->get_valor_mejora(2);

			// Datos para la cuenta atras al GP
			$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

			$fecha_gp = explode("-",$next_GP->fecha);

			$menu['anioGP']  = $fecha_gp[0];
			$menu['mesGP' ]  = $fecha_gp[1];
			$menu['diaGP' ]  = $fecha_gp[2];
			$menu['paisGP']  = $next_GP->pais;

			// Menu activo
			$menu['m_act'] = 7;

			// S.R.R (estrellas)
			$var['num_estrellas'] = $this->boxes_model->get_num_estrellas();
			$var['srr'] = $this->boxes_model->get_srr();

			// Preparar la vista
			$header['estilos'] = array('boxes.css');
			$this->load->view('base/cabecera',$header);
			$this->load->view('base/page_top',$menu);
			$this->load->view('boxes/boxtopbar',$var);
			//$this->load->view('base/menu_vertical_boxes',$menu);
			$this->load->view('boxes/stikis',$datos);
			$this->load->view('base/page_bottom');
		}
		else{
			$this->session->set_flashdata('login_error', true);
				$this->session->set_flashdata('login_error_message', 'Debes seleccionar un piloto al que asignar el Stiki.');
			redirect_lf1('boxes/stikis','location');
		}
	}


	function cancelar_stiki( $id_piloto )
	{
		if( is_numeric($id_piloto) )
		{
			// Cargar modelo stikis
			$this->load->model('stikis/stikis_model');

			$this->stikis_model->cancelar_stiki( $id_piloto );
		}
		else
		{
			redirect_lf1('boxes/stikis');
		}

	}


	/*
	function loteria()
	{
		// controlar session
		$this->control_session->comprobar_sesion();

		// Recoger saldo usuario
		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');
		$menu['estadisticas'] = false;

		// Control boxes
		$estadoBoxes = $this->boxes_model->estado();
		// abrir cerrar box
		$datos['boxes'   ] = $estadoBoxes;

		echo "GANADOR: ".rand(1,200);

		$this->load->model('loteria/loteria_model');

		$datos['bote'		] = $this->loteria_model->getBote('formateado');
		$datos['mis_numeros'] = $this->loteria_model->getMisNumeros();

		// Datos para la cuenta atras al GP
		$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$fecha_gp = explode("-",$next_GP->fecha);

		$menu['anioGP']  = $fecha_gp[0];
		$menu['mesGP' ]  = $fecha_gp[1];
		$menu['diaGP' ]  = $fecha_gp[2];
		$menu['paisGP']  = $next_GP->pais;


		// Preparar la vista
		$header['estilos'] = array('boxes.css');
		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/loteria',$datos);
		$this->load->view('base/page_bottom');
	}

	function loteria_comprar()
	{
		// controlar session
		$this->control_session->comprobar_sesion();

		// Recoger saldo usuario
		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');
		$menu['estadisticas'] = false;
		// Control boxes
		$estadoBoxes = $this->boxes_model->estado();
		// abrir cerrar box
		$datos['boxes'   ] = $estadoBoxes;

		// Datos para la cuenta atras al GP
		$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$fecha_gp = explode("-",$next_GP->fecha);

		$menu['anioGP']  = $fecha_gp[0];
		$menu['mesGP' ]  = $fecha_gp[1];
		$menu['diaGP' ]  = $fecha_gp[2];
		$menu['paisGP']  = $next_GP->pais;


		// Preparar la vista
		$header['estilos'   ] = array('boxes.css');
		$header['javascript'] =array('jquery','loteria');
		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/loteria_comprar',$datos);
		$this->load->view('base/page_bottom');
	}

	function loteria_guardar()
	{
		// Control boxes
		$estadoBoxes = $this->boxes_model->estado();
		// abrir cerrar box
		$datos['boxes'   ] = $estadoBoxes;

		// comprobar que venimos del formulario
		if($_POST)
		{
			$this->load->model('loteria/loteria_model');
			$datos['loteriaMsg'] = $this->loteria_model->guardar_loteria($_POST);

			// Recoger saldo usuario
			$menu['saldo'		] = $this->banco_model->getSaldo('formateado');
			$menu['estadisticas'] = false;

			$datos['bote'		] = $this->loteria_model->getBote('formateado');
			$datos['mis_numeros'] = $this->loteria_model->getMisNumeros();

			// Datos para la cuenta atras al GP
			$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

			$fecha_gp = explode("-",$next_GP->fecha);

			$menu['anioGP']  = $fecha_gp[0];
			$menu['mesGP' ]  = $fecha_gp[1];
			$menu['diaGP' ]  = $fecha_gp[2];
			$menu['paisGP']  = $next_GP->pais;


			// Preparar la vista
			$header['estilos'] = array('boxes.css');
			$this->load->view('base/cabecera',$header);
			$this->load->view('base/page_top',$menu);
			//$this->load->view('base/menu_vertical_boxes',$menu);
			$this->load->view('boxes/loteria',$datos);
			$this->load->view('base/page_bottom');

		}
		else{
			redirect_lf1('boxes/loteria_comprar');
		}
	}
	*/
	function mi_perfil()
	{
		// controlar session
		$this->control_session->comprobar_sesion();

		// Recoger saldo usuario
		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');
		$menu['estadisticas'] = false;

		// Controlar la subida
		if($this->uri->segment(3) == 'subir'){

			$config['upload_path'] = ROOT.'/img/avatares/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '200';
			$config['max_width']  = '1280';
			$config['max_height']  = '1024';

			$this->load->library('upload', $config);

			// GUARDAR IMAGEN
			if ( ! $this->upload->do_upload())
			{
				$datos['error'] = $this->upload->display_errors();
				$cargar_vista   = 'UPLOAD_ERROR';
				// $this->load->view('upload_form', $error);
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$cargar_vista = 'UPLOAD_OK';

				foreach($this->upload->data() as $item => $value){

					// Guardar nombre archivo subido
					if($item == 'file_name'){
						$nombre_archivo = $value;
					}

				}

				// CREAR THUMBMAIL
				$config['image_library' ] = 'gd2';
				$config['source_image'  ] = ROOT.'/img/avatares/'.$nombre_archivo;
				$config['new_image'		] = ROOT.'/img/avatares/thumbs/'.$nombre_archivo;
				$config['create_thumb'  ] = TRUE;
				$config['maintain_ratio'] = FALSE;
				$config['width' 		] = 50;
				$config['height'		] = 50;
				$config['thumb_marker'  ] = '';

				$this->load->library('image_lib', $config);

				if ( ! $this->image_lib->resize())
				{
				    echo $this->image_lib->display_errors();
				}

				// Guardar nuevo avatar en BBDD
				$this->usuarios_model->userAvatarSave($_SESSION['id_usuario'],$nombre_archivo);
			}
		}


		// Obtener avatar usuario
		$datos['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

                //Obtener los datos del usuario
		$datos['usuario'] = $this->usuarios_model->userData($_SESSION['id_usuario']);

		// Datos para la cuenta atras al GP
		$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$fecha_gp = explode("-",$next_GP->fecha);

		$menu['anioGP']  = $fecha_gp[0];
		$menu['mesGP' ]  = $fecha_gp[1];
		$menu['diaGP' ]  = $fecha_gp[2];
		$menu['paisGP']  = $next_GP->pais;

		// S.R.R (estrellas)
		$var['num_estrellas'] = $this->boxes_model->get_num_estrellas();
		$var['srr'] = $this->boxes_model->get_srr();

		// Preparar la vista

		if($cargar_vista == 'UPLOAD_OK'){
			$header['estilos'] = array('boxes.css','jquery-te-1.3.2.2.css');

			// Menu activo
			$menu['m_act'] = 7;

			$this->load->view('base/cabecera',$header);
			$this->load->view('base/page_top',$menu);
			$this->load->view('boxes/boxtopbar',$var);
			//$this->load->view('base/menu_vertical_boxes',$menu);
			$this->load->view('boxes/mi_perfil_upload_ok',$datos);
			$this->load->view('base/page_bottom');
		}
		else{
			$header['estilos'] = array('boxes.css','jquery-te-1.3.2.2.css');

			// Menu activo
			$menu['m_act'] = 7;

			$this->load->view('base/cabecera',$header);
			$this->load->view('base/page_top',$menu);
			$this->load->view('boxes/boxtopbar',$var);
			//$this->load->view('base/menu_vertical_boxes',$menu);
			$this->load->view('boxes/mi_perfil',$datos);
			$this->load->view('base/page_bottom');
		}

	}


	//Funcion que modifica los datos personales
    function modificarDatos() {

    	if(!$_POST)
    		redirect_lf1('boxes/mi_perfil');

    	// controlar session
		$this->control_session->comprobar_sesion();


        $rules['ano_nacimiento'] = "trim|numeric";
        $rules['ubicacion'] = "trim|max_length[299]";
        $rules['nombre'] = "trim|max_length[299]";
        $rules['apellido'] = "trim|max_length[299]";

        $this->validation->set_rules($rules);

        $fields['ano_nacimiento'] = 'Año nacimiento';
        $fields['ubicacion'] = 'Ubicacion';
        $fields['nombre'] = 'Nombre';
        $fields['apellido'] = 'Apellidos';

        $this->validation->set_fields($fields);

        //Cargamos el modelo de usuarios
        $this->load->model('usuarios/usuarios_model');

        // Obtener avatar usuario
        $datos['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

        // Datos para la cuenta atras al GP
        $next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

        $fecha_gp = explode("-", $next_GP->fecha);

        $menu['anioGP'] = $fecha_gp[0];
        $menu['mesGP'] = $fecha_gp[1];
        $menu['diaGP'] = $fecha_gp[2];
        $menu['paisGP'] = $next_GP->pais;


        if ($this->validation->run() == FALSE) {
            //$datos['mensaje'] = "Error modificando datos";
            $this->session->set_flashdata('mensajeForm', 'Error modificando datos');
        } else {
            $this->usuarios_model->alterUserData($_POST);
            //$datos['mensaje'] = "Datos modificados correctamente";
            $this->session->set_flashdata('mensajeForm', 'Datos modificados correctamente.');
        }


        redirect_lf1('boxes/mi_perfil');
        /*
        //Obtener los datos del usuario
        $datos['usuario'] = $this->usuarios_model->userData($_SESSION['id_usuario']);

        //Cargamos los estilos de los boxes
        $header['estilos'] = array('boxes.css');


        // Menu activo
        $menu['m_act'] = 7;


        // Preparar la vista
        $this->load->view('base/cabecera', $header);
        $this->load->view('base/page_top',$menu);
        //$this->load->view('base/menu_vertical_boxes', $menu);
        $this->load->view('boxes/mi_perfil', $datos);
        $this->load->view('base/page_bottom');
        */
    }


    function mi_perfil_cpass()
    {

    	if(!$_POST)
    		redirect_lf1('boxes/mi_perfil');

    	// controlar session
		$this->control_session->comprobar_sesion();

		$this->usuarios_model->modificar_pass( $_POST['Oldpass'], $_POST['Newpass']);

    }


    function mi_perfil_informacion()
    {
    	if(!$_POST['infoperfil'])
    		redirect_lf1('boxes/mi_perfil');

    	$this->usuarios_model->guardar_info_perfil($_POST['infoperfil']);

    	redirect_lf1('boxes/mi_perfil');


    }

    /**
     * Sistema de Recompensa a la regularidad
     *
     * @return void
     * @author
     **/
    function srr()
    {

    	// controlar session
		$this->control_session->comprobar_sesion();


		if($_POST)
		{
			$var['msgInfo'] = $this->boxes_model->canjear_estrellas();
		}

		// Recoger saldo usuario
		$menu['saldo'			] = $this->banco_model->getSaldo('formateado');
		$menu['estadisticas'	] = false;

		// Datos para la cuenta atras al GP
		$next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

		$fecha_gp = explode("-",$next_GP->fecha);

		$menu['anioGP']  = $fecha_gp[0];
		$menu['mesGP' ]  = $fecha_gp[1];
		$menu['diaGP' ]  = $fecha_gp[2];
		$menu['paisGP']  = $next_GP->pais;

		// Preparar la vista
		$header['estilos'] = array('boxes.css');

		// Menu activo
		$menu['m_act'] = 7;

		// S.R.R (estrellas)
		$var['num_estrellas'] = $this->boxes_model->get_num_estrellas();
		$var['srr'] = $this->boxes_model->get_srr();

		$var['historico'] = $this->boxes_model->historico_estrellas();


		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);

		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/boxtopbar',$var);
		$this->load->view('boxes/srr',$var);
		$this->load->view('base/page_bottom');



    }

	/**
	 * Configurar el idioma que debe cargar
	 *
	 * @access	private
	 * @author	Gorka Garin
	 * @return	void
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

/*
	function mandarMails( $desde ){


		if(!$desde){
			$desde = 0;
		}

		$this->load->library('email');

		$usuarios = $this->db->query("SELECT * FROM usuarios limit {$desde},250")->result();

		//$usuarios = $this->db->query("SELECT * FROM usuarios limit 0,1")->result();

		$i = 0;
		foreach($usuarios as $usuario){

			$data['titulo'] = "Hola {$usuario->nick} !! ";


			$data['mensaje'] = "

			<p>Queremos recordarte que este fin de semana se disputa el Gran Premio de Hungria y quedan escasas horas para el cierre de boxes. Como siempre  a las 12:00 PM se cerrarán los boxes y no podrás fichar nada hasta terminado el gran premio.</p>

			

			<p> Un saludo y suerte en el GP de Hungria!</p>


			<p>www.ligaformula1.com</p>

			";




			$mensaje = $this->load->view('mail_template',$data,TRUE);

			$this->email->from('ligaformula1@ligaformula1.com', 'Ligaformula1.com');
			$this->email->to($usuario->email);
			$this->email->subject('Liga formula 1 - GP Hungria');
			$this->email->message($mensaje);

			$this->email->send();
			$i++;

		}

		echo $i." Emails enviado OK desde el {$desde}";
	}
*/

	// GESTIONES: ejectuar solo 1 vez por GP, metiendo antes los datos
	// en base de datos
	// DESCOMENTAR Y SUBIR PARA EJECUTARLO



	/*
	function gestion_pole(){
		$this->load->model('scripts/dinero_pole');
		$this->dinero_pole->procesar_pole();
	}


	function gestion_gp(){

		$this->load->model('scripts/puntuar_usuarios');
		$this->puntuar_usuarios->procesar_puntos_gp();

	}

	function gestionar_stikis(){
		$this->load->model('scripts/gestion_stikis');
		$this->gestion_stikis->gestionar();
	}


	function gestion_loteria()
	{
		$this->load->model('scripts/loteria_usuarios');
		$this->loteria_usuarios->procesar_loteria();
	}


	// PARCHES

	function arreglar_dinero_equipos(){

		$this->load->model('scripts/parches/fix_dinero_equipos');
		$this->fix_dinero_equipos->error_calculo_equipos();
	}

	function llenar_tabla_avatares()
	{
		$sql = " SELECT id FROM usuarios";
		$query = $this->db->query($sql);

		$avatar = "http://www.ligaformula1.com/imgs/avatares/no_avatar.gif";
		$i = 0;
		foreach($query->result() as $user){
			$this->db->query("INSERT INTO usuarios_avatar VALUES('',?,'no_avatar.gif',?)",array($user->id,$avatar));
			$i++;
		}

		echo $i." registros introducidos";
	}

	*/



	/**
	 * Arreglar cagada al actualizar sin backup! GP BELGICA 2013
	 *
	 * @return void
	 * @author 
	 **/
	/*
	function fixer()
	{
		$this->load->model('scripts/fixer');

		$this->fixer->corregir_banco();
	}
	*/
}
