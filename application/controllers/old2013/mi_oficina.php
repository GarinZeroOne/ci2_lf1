<?php
/**
 * NOVEDAD 2011: Desde este controlador se gestionaran todas las operaciones del manager:
 *
 * - Ojeadores ( 10 niveles de ojeador, por cada nivel los pilotos y equipos valdran menos %)
   - Mecanicos ( 10 niveles , rebajan el precio de los STIKIS)
   - Ingenieros (10 niveles , potencian tus STIKIS un %)
   - Publicistas ( 10 niveles , aumentan tus beneficios totales por GP un %)
 * - Prestamos
 *
 * @return
 */
class Mi_oficina extends Controller
{
	/**
	 * Idiomas soportados
	 */
	private $languages	= array ('spanish','english');

	function Mi_oficina()
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
		$this->load->model('menudata/menudata_model');

		// controlar session
		$this->control_session->comprobar_sesion();
	}


	/* Home de la Oficina
	 * ----------------------------------------------------------------------------------
	 * Muestra todas las opciones de la oficina
	 * ----------------------------------------------------------------------------------
	 */
	function index()
	{
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

		// Control boxes
		$estadoBoxes = $this->boxes_model->estado();

		// Datos del menu estadisticas,posts y countdown
		$datos = $this->menudata_model->get_menu_data();

		// Resumen ultimo GP
		$datos['resultados'		] = $this->mejoras_model->get_resumen_gp();

		// Mejoras del usuario
		$datos['panel_mejoras'	] = $this->mejoras_model->panel_mejoras_usuario();

		$datos['info_msg'		] = $this->session->flashdata('infomsg');
		// Preparar la vista
		$header['estilos'		] = array('boxes.css','mioficina.css');


		// S.R.R (estrellas)
		$datos['num_estrellas'] = $this->boxes_model->get_num_estrellas();
		$datos['srr'] = $this->boxes_model->get_srr();

		// abrir cerrar box
		$datos['boxes'   ] = $estadoBoxes;

		// Menu activo
		$menu['m_act'] = 7;

		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		$this->load->view('boxes/boxtopbar',$datos);
		////$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/mi_oficina/inicio2013',$datos);
		$this->load->view('base/page_bottom');
	}


	function ampliar()
	{

		$id_mejora = $this->uri->segment(3);

		$this->mejoras_model->aumentar_mejora($id_mejora);


		redirect('mi_oficina/');

	}

	/*
	 * Fichas ojeadores
	 */
	function ojeadores()
	{
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
		$header['estilos'		] = array('boxes.css','mioficina.css');

		// Menu activo
		$menu['m_act'] = 7;

		// S.R.R (estrellas)
		$datos['num_estrellas'] = $this->boxes_model->get_num_estrellas();
		$datos['srr'] = $this->boxes_model->get_srr();

		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		$this->load->view('boxes/boxtopbar',$datos);
		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/mi_oficina/ojeadores',$datos);
		$this->load->view('base/page_bottom');
	}

	/*
	 * Fichas mecanicos
	 */
	function mecanicos()
	{
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
		$header['estilos'		] = array('boxes.css','mioficina.css');

		// Menu activo
		$menu['m_act'] = 7;

		// S.R.R (estrellas)
		$datos['num_estrellas'] = $this->boxes_model->get_num_estrellas();
		$datos['srr'] = $this->boxes_model->get_srr();

		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		$this->load->view('boxes/boxtopbar',$datos);
		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/mi_oficina/mecanicos',$datos);
		$this->load->view('base/page_bottom');
	}

	/*
	 * fichas ingenieros
	 */
	function ingenieros()
	{
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
		$header['estilos'		] = array('boxes.css','mioficina.css');

		// Menu activo
		$menu['m_act'] = 7;

		// S.R.R (estrellas)
		$datos['num_estrellas'] = $this->boxes_model->get_num_estrellas();
		$datos['srr'] = $this->boxes_model->get_srr();

		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		$this->load->view('boxes/boxtopbar',$datos);
		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/mi_oficina/ingenieros',$datos);
		$this->load->view('base/page_bottom');
	}

	/*
	 * Ficha publicistas
	 */
	function publicistas()
	{
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
		$header['estilos'		] = array('boxes.css','mioficina.css');

		// Menu activo
		$menu['m_act'] = 7;

		// S.R.R (estrellas)
		$datos['num_estrellas'] = $this->boxes_model->get_num_estrellas();
		$datos['srr'] = $this->boxes_model->get_srr();

		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		$this->load->view('boxes/boxtopbar',$datos);
		//$this->load->view('base/menu_vertical_boxes',$menu);
		$this->load->view('boxes/mi_oficina/publicistas',$datos);
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
}
