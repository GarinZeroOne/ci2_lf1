<?php

class Foro extends Controller {

	/**
    * Idiomas soportados
    */
    private $languages      = array ('spanish','english');

    /**
    * Idiomas soportados
    */
    private $foros      = array ('lf1ayuda','lf1general','lf1formula1','lf1offtopic');

    /**
    * Titulo Foros
    */

    private $titulo_foro = array(
						'lf1general'   =>  'LF1 General',
						'lf1ayuda'		=> 'LF1 Ayuda / Incidencias',
						'lf1formula1'	=> 'Mundo Formula 1',
						'lf1offtopic'	=> 'OFFTOPIC'
						);



	function Foro()
	{
		parent::Controller();

		// Configurar idioma
        $this->_set_language();

        // Set foro
        //$this->_set_foro();

		session_start();
		$this->load->helper( 'url');
		$this->load->database();
		$this->load->model('sesiones/control_session');
		$this->load->model('calendario/calendario_model');
		$this->load->model('estadisticas/estadisticas_model');
		$this->load->model('foro/foro_model');
		$this->load->model('menudata/menudata_model');
		$this->load->library('form_validation');
		$this->load->model('banco/banco_model');

		// Cargar helper timeago
        $this->load->helper('timeago');

        //$this->indice();

		// controlar session
		//$this->control_session->comprobar_sesion();
	}


	/**
	 * Generar los usuarios del foro
	 *
	 * @return void
	 * @author 
	 **/
	/*
	function script()
	{

		// Cargar libreria phpbb para CI
    	$this->load->library('phpbb');

    	$usuarios = $this->db->select('*')->from('usuarios')->order_by('id','asc')->get()->result();

    	$i = 0;
    	foreach($usuarios as $user){
    		//echo $user->id." - ".$user->nick." </br>";
    		$this->phpbb->reg_from_ci_to_phpbb($user->nick,$user->email,'l1g4formul41r4nd0mp455');

    		++$i;
    	}	

    	echo $i." usuarios migrados al foro";

	}
	*/

	/**
     * Indice de los foros
     *
     * @return void
     * @author
     **/
    function indice()
    {
    	//die("ok");

    	
    	/*
    	// Testeo  creando usuario desde codeigniter a phpbb
    	$usuario = $this->phpbb->reg_from_ci_to_phpbb('Gorka','emailprueba@test.es','1234qwer');

    	echo "usuario creado";
    	dump($usuario);
    	die;
    	*/

    	// Testeo logeando a un usuario
    	//$this->phpbb->login('gorka', '1234qwer');

    	//die("LOGEADO!");

    	/*
    	if($_SESSION['id_usuario'])
    		$data['foro_notify'] = $this->foro_model->notify_new_posts();
		*/
    	//dump($data['foro_notify']);

    	// Menu activo
		$menu['m_act'] = 9;
		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');

    	$header['estilos' ] = array('foro.css','jquery-te-1.3.2.2.css');

    	//Se prepara la vista
		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);

		$this->load->view('foro/indice_foros',$data);
		$this->load->view('base/page_bottom');
    }


    function index()
    {
    	// Menu activo
		$menu['m_act'] = 9;
		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');

    	$header['estilos' ] = array('foro.css','jquery-te-1.3.2.2.css');

    	//Se prepara la vista
		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);

		$this->load->view('foro/indice_foros',$data);
		$this->load->view('base/page_bottom');
    }

    /*
	function index( $page='page', $limit = '0')
	{

		//echo "Foro:".$this->session->userdata('foroactivo');

		// Datos del menu estadisticas,posts y countdown
		// 2013! : No se porque se llama aqui a esto, lo comento.
		//$datos = $this->menudata_model->get_menu_data();

		$this->load->library('pagination');

		if($_SESSION['id_usuario'])
    		$var['foro_notify'] = $this->foro_model->notify_new_posts();

		$config['base_url'  ] = site_url().'/foro/index/page/';
		$config['total_rows'] = $this->foro_model->get_num_temas();
		$config['uri_segment'] = 4;
		$config['per_page'  ] = 21;

		$this->pagination->initialize($config);




		// Datos vista
		$var   ['temas'   ] = $this->foro_model->get_temas_iniciales($limit);

		$header['estilos' ] = array('foro.css','jquery-te-1.3.2.2.css');

		// Menu activo
		$menu['m_act'] = 9;
		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');

		//Se prepara la vista
		$this->load->view('base/cabecera',$header);
		$this->load->view('base/page_top',$menu);
		//$this->load->view('base/menu_vertical_inicio',$datos);
		$this->load->view('foro/inicio',$var);
		$this->load->view('base/page_bottom');

	}

	function nuevo_tema()
	{

		$this->control_session->comprobar_sesion();


		// Datos del menu estadisticas y countdown
		$datos = $this->menudata_model->get_menu_data();

		if($_SESSION['id_usuario'])
    		$var['foro_notify'] = $this->foro_model->notify_new_posts();

		$header['estilos'] = array('foro.css','jquery-te-1.3.2.2.css');

		$this->form_validation->set_rules('titulo','titulo','required');
		$this->form_validation->set_rules('mensaje','mensaje','required');

		if( $this->form_validation->run()==FALSE ){

			// Menu activo
			$menu['m_act'] = 9;
			$menu['saldo'		] = $this->banco_model->getSaldo('formateado');

			//Se prepara la vista
			$this->load->view('base/cabecera',$header);
			$this->load->view('base/page_top',$menu);
			//$this->load->view('base/menu_vertical_inicio',$datos);
			$this->load->view('foro/nuevo_tema',$var);
			$this->load->view('base/page_bottom');
		}
		else{

			// Guardar tema
			$this->foro_model->guardar_tema($_POST);

			// Menu activo
			$menu['m_act'] = 9;
			$menu['saldo'		] = $this->banco_model->getSaldo('formateado');

			//Se prepara la vista
			$this->load->view('base/cabecera',$header);
			$this->load->view('base/page_top',$menu);
			//$this->load->view('base/menu_vertical_inicio',$datos);
			$this->load->view('foro/tema_enviado',$var);
			$this->load->view('base/page_bottom');
		}


	}

	function ver()
	{
		// ha llegado id en la uri?
		if( is_numeric($this->uri->segment(3)) ){

			if($_SESSION['id_usuario'])
    			$var['foro_notify'] = $this->foro_model->notify_new_posts();

			// Datos del menu estadisticas y countdown
			$datos = $this->menudata_model->get_menu_data();

			$var['temas'	 	] = $this->foro_model->ver_tema($this->uri->segment(3));
			$var['id_tema_padre'] = $this->uri->segment(3);

			$header['estilos'] = array('foro.css','jquery-te-1.3.2.2.css');

			// Menu activo
			$menu['m_act'] = 9;
			$menu['saldo'		] = $this->banco_model->getSaldo('formateado');

			//Se prepara la vista
			$this->load->view('base/cabecera',$header);
			$this->load->view('base/page_top',$menu);
			//$this->load->view('base/menu_vertical_inicio',$datos);
			$this->load->view('foro/ver_tema',$var);
			$this->load->view('base/page_bottom');


		}
	}


	function responder( $id_tema = '' , $id_cita = '')
	{
		$this->control_session->comprobar_sesion();

		// Llega el id del tema??
		if($id_tema != ''){


			if($_SESSION['id_usuario'])
    			$var['foro_notify'] = $this->foro_model->notify_new_posts();

			$datos_tema = $this->foro_model->ver_tema_simple($id_tema);

			// Ha citado alguna respuesta??
			if($id_cita != ''){

				$datos_cita = $this->foro_model->ver_tema_simple($id_cita);

				$var['id'		] = $datos_tema->id;
				$var['titulo'	] = "Re:".$datos_tema->titulo;
				$var['mensaje'	] = "[citar]".$datos_cita->mensaje ."[/citar]";
			}
			else{

				$var['id'		] = $datos_tema->id;
				$var['titulo'	] = "Re:".$datos_tema->titulo;
			}

			// DATOS VISTA
			// Datos del menu estadisticas y countdown
			$datos = $this->menudata_model->get_menu_data();

			$header['estilos'] = array('foro.css','jquery-te-1.3.2.2.css');

			// Menu activo
			$menu['m_act'] = 9;
			$menu['saldo'		] = $this->banco_model->getSaldo('formateado');

			//Se prepara la vista
			$this->load->view('base/cabecera',$header);
			$this->load->view('base/page_top',$menu);
			//$this->load->view('base/menu_vertical_inicio',$datos);
			$this->load->view('foro/nuevo_tema',$var);
			$this->load->view('base/page_bottom');

		}
		else{

			// No llega el tema por url,redireccionamos al indice
			redirect_lf1('foro');
		}


	}



	function sel( $target )
	{
		if( in_array($target,$this->foros) )
		{
			$this->session->set_userdata('foroactivo',$target);


			if($_SESSION['id_usuario'])
				$this->foro_model->set_ultima_visita($target);
		}

		redirect_lf1('foro');
	}


	
	function selline()
	{

		$this->session->set_userdata('foroactivo','lf1offtopic');


			if($_SESSION['id_usuario'])
				$this->foro_model->set_ultima_visita('lf1offtopic');

		// Post del line
		redirect_lf1('foro/ver/33');
	}


	
        


        
        private function _set_foro()
        {

        	// Si no hay ninguno seteado, ponemos por defecto el general
        	if(!in_array($this->session->userdata('foroactivo'),$this->foros))
        	{
        		$this->session->set_userdata('foroactivo','lf1general');
        		$this->session->set_userdata('tituloforo',$this->titulo_foro[$this->session->userdata('foroactivo')]);
        		redirect_lf1('foro');
        	}

        	$this->session->set_userdata('tituloforo',$this->titulo_foro[$this->session->userdata('foroactivo')]);

        }



       
        function fix_foro($foro)
        {

        	// SOLO PUEDE ENTRAR EL ADMIN
			if( $_SESSION['id_usuario'] == '177')
				$this->foro_model->fix($foro);
			else
				die('acceso denegado >:');

        }
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