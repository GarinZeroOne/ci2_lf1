<?php
require_once APPPATH . 'classes/varios/circuito.php';

class Dashboard extends CI_Controller {

	/**
	 * Idiomas soportados /*DEPRECATED!*/
	/* 
	private $languages	= array ('spanish','english');
	*/

	function Dashboard()
	{
		parent::__construct();

		// Configurar idioma
		//$this->_set_language();

		$this->load->helper('url');
		$this->load->database();
		$this->load->model('sesiones/control_session');
		$this->load->model('calendario/calendario_model');
		$this->load->model('noticias/noticias_model');
		$this->load->model('estadisticas/estadisticas_model');
		$this->load->model('menudata/menudata_model');
		$this->load->model('banco/banco_model');
		$this->load->model('foro/forophpbb_model');
		$this->load->model('usuarios/usuarios_model');
		$this->load->model('pilotos/pilotos_model');

		// controlar session
		$this->control_session->comprobar_sesion();

	}

	/**
	 * Dashboard
	 *
	 * @return void
	 * @author 
	 **/
	function index()
	{
		
		// Datos al contenido
		$datos = array();

		// Cuenta atras
		// Datos del menu estadisticas,posts y countdown
		// Datos para la cuenta atras al GP
		$next_GP  = $this->calendario_model->obtenerPaisDelSiguienteGp();



		$fecha_gp = explode("-",$next_GP->fecha);
		
		$datos['anioGP']  = $fecha_gp[0];
		$datos['mesGP' ]  = $fecha_gp[1];
		$datos['diaGP' ]  = $fecha_gp[2];
		$datos['paisGP']  = $next_GP->pais;

		// noticias de feed rss
		$datos['noticiasfeed'			  ] = $this->noticias_model->get_feed_news()->channel;
		// Ultimos pilotos comprados
		$datos['ultimos_pilotos_comprados'] = $this->estadisticas_model->get_ultimos_comprados();

		// Variaciones mercado pilotos
		$datos['info_mercado_pilotos'     ] = $this->pilotos_model->getInfoPilotos();

		// Datos STIKIS
		$datos['stikis_puntos'] = $this->estadisticas_model->stikisComprados('puntos');
		$datos['stikis_dinero'] = $this->estadisticas_model->stikisComprados('dinero');

		// Box estadisticas
		$datos['estadisticas'] = $this->estadisticas_model->get_estadisticas_box();




		// Subidones y Bajones del dia
		$datos['subidones'] = $this->estadisticas_model->get_subidones();
		$datos['bajones'  ] = $this->estadisticas_model->get_bajones();
		$datos['subidas_bajadas_texto_dia'] = $this->estadisticas_model->get_texto_dia_subidas_bajadas();


		// Grafica Movimiento dinero Fichajes/Ventas
		$chart_data = $this->estadisticas_model->get_info_fichajes_ventas();
		$data_to_js['series_data'] = json_encode($chart_data);

		// Grafica Valor total mercado Pilotos
		$chart_data2 = $this->estadisticas_model->get_info_valor_mercado_pilotos();
		$data_to_js2['valores_dinero'] = json_encode($chart_data2['totales_dinero']);
		$data_to_js2['fechas_valores'] = $chart_data2['totales_dia'];

		// Grafica Valor total mercado Equipos
		$chart_data3 = $this->estadisticas_model->get_info_valor_mercado_equipos();
		$data_to_js3['valores_dinero'] = json_encode($chart_data3['totales_dinero']);
		$data_to_js3['fechas_valores'] = $chart_data3['totales_dia'];

		// Grafica Estadisticas comunidades mas ricas
		$chart_data4 = $this->estadisticas_model->get_ranking_comunidades_dinero();
		//$data_to_js4['comunidades_dinero'] = json_encode($chart_data4['totales_comunidades']);
		$data_to_js4['comunidades_dinero'] = $chart_data4['totales_comunidades'];
		//dump($data_to_js4);die;

		// Hall of Fame
		$datos['hof_pregunta'  ] = $this->usuarios_model->get_hof_pregunta();
		$datos['hof_respuestas'] = $this->usuarios_model->get_hof_respuestas();

		
		// Podium AÑO anterior
		$idGp = $this->uri->segment(3);

        $datos['circuito'] = $this->calendario_model->getNextGpObject();

        //Se obtienen los datos de la api

        $anoAnterior = date('Y') - 1;

        if ($datos['circuito']->getIdApi() != 0) {

            $url = "http://ergast.com/api/f1/" . $anoAnterior . "/" . $datos['circuito']->getIdApi() . "/results/1.json";            
            $json = json_decode(file_get_contents($url));
            $datos['ultimoGanador'] = $json->MRData;

            

            $url = "http://ergast.com/api/f1/" . $anoAnterior . "/" . $datos['circuito']->getIdApi() . "/results/2.json";
            $json = json_decode(file_get_contents($url));
            $datos['segundo'] = $json->MRData;

            $url = "http://ergast.com/api/f1/" . $anoAnterior . "/" . $datos['circuito']->getIdApi() . "/results/3.json";
            $json = json_decode(file_get_contents($url));
            $datos['tercero'] = $json->MRData;
            
        } else {
            $datos['ultimoGanador'] = "sin información";
            $datos['segundo'] = "sin información";
            $datos['tercero'] = "sin información";
        }
		// FIN PODIUM AÑO ANTERIOR
		
		// Hall of fame - Mas votada /*DEPRECATED 2015- se ha puesto el podium del año anterior*/
		// $datos['hof_winner'] = $this->usuarios_model->get_hof_winner();

		//dump($datos['hof_winner']);die;

//dump($datos['hof_respuestas']);die;
		// Header
		$header['estilos'] 	  = array('dashboard.css','hof.css');
		$header['titulo' ]	  = 'Dashboard - LigaFormula1.com';
		$header['avatar' ]    = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);
		//$header['saldo'  ]    = $this->banco_model->getSaldo('formateado');

		// Javascript
		$bottom['javascript'	] = array('highcharts.js','dashboard/hall_of_fame.js');
		$bottom['javascript_php'] = array('grafica1_dash' => $this->load->view('dashboard/_head/js/grafica1_dash',$data_to_js,TRUE),
 										  'grafica2_dash' => $this->load->view('dashboard/_head/js/grafica2_dash',$data_to_js2,TRUE),
 										  'grafica3_dash' => $this->load->view('dashboard/_head/js/grafica3_dash',$data_to_js3,TRUE),
 										  'grafica4_dash' => $this->load->view('dashboard/_head/js/grafica4_dash',$data_to_js4,TRUE)
										 );

		// Menu Izquierda
		$sidebarleft 		  = array();
		$sidebarleft['m_act'] = 1;

		// Menu Derecha
		$sidebarright = array();

		// Ultimos post  del FORO PHPBB
		$sidebarright['last_topics'] = $this->forophpbb_model->get_last_topics();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/home'  ,$datos);

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php',$sidebarright);		
		$this->load->view('dashboard/base/bottom.php',$bottom);
		
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function ajax_hall()
	{
		// Evitar entradas por url
		if(!$_POST){die;}

		$this->load->helper('timeago');
		$id_hof = $_POST['hofi'];
		$contenido = strip_tags($_POST['comment']);

		$mensaje = $this->usuarios_model->add_hof_respuesta($id_hof,$contenido,$_SESSION['id_usuario'],true);

		$texto = '<li>
                                        <div class="alert alert-hall-msg clearfix">
                                            <span class="hall-avatar">
                                                <img class="round-pilots-big" src="'.base_url().'img/avatares/'.$mensaje->avatar.'" alt="">
                                                
                                            </span>
                                            <div class="notification-info">
                                                <ul class="clearfix notification-meta">
                                                    <li class="pull-left notification-sender"><span><a href="'.site_url().'perfil/ver/'.$mensaje->nick.'">'.$mensaje->nick.'</a></span> </li>
                                                    <li class="pull-right notification-time">'.timeago(strtotime($mensaje->fecha)).'</li>
                                                </ul>
                                                <p>
                                                    '.$mensaje->respuesta.'
                                                </p>
                                            </div>
                                        </div>
                                    </li>';

        echo $texto;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function ajax_hall_voto_manager()
	{
		if(!$_POST){die;}

		
		$id_respuesta = $_POST['hofiddata'];

		// Guardar voto
		$total_votos = $this->usuarios_model->hof_respuesta_voto($_SESSION['id_usuario'],$id_respuesta);

		echo "+".$total_votos;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function ajax_notificacionleida()
	{
		$this->load->model('mensajes_model');
		$this->mensajes_model->set_notificacion_leida($_POST['idn']);
		//echo "OK".$_POST['idn'];
	}

	/**
	 * Plantilla seccion
	 *
	 * @return void
	 * @author 
	 **/
	function _plantilla_seccion()
	{


		// Estilos
		$header['estilos'] 		= array();

		// Javascript
		$bottom['javascript'] = array();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/pagina-vacia'  ,$datos);

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php',$sidebarright);		
		$this->load->view('dashboard/base/bottom.php',$bottom);

		
		
		
		
	}

}