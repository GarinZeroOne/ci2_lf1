<?php

class Inicio extends CI_Controller {

	/**
	 * Idiomas soportados
	 */
	private $languages	= array ('spanish','english');

	function Inicio()
	{
		
		parent::__construct();


		// Configurar idioma
		$this->_set_language();

		$this->load->helper('url');
		$this->load->database();
		$this->load->model('sesiones/control_session');
		$this->load->model('calendario/calendario_model');
		$this->load->model('noticias/noticias_model');
		$this->load->model('estadisticas/estadisticas_model');
		$this->load->model('menudata/menudata_model');
		$this->load->model('banco/banco_model');
		$this->load->model('foro/forophpbb_model');
		$this->load->library('form_validation');



	}

	/* DEPRECATED */
	function index()
	{

		redirect_lf1('inicio/acceso');

		$this->control_session->comprobar_sesion();

		
		//redirect_lf1('inicio/portada');

		// Datos del menu estadisticas,posts y countdown
		$datos = $this->menudata_model->get_menu_data();

		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');

		// Ultimas noticias
		$datos['noticias'] = $this->noticias_model->getNews();

		if($_SESSION['id_usuario'])
			$datos['noticias_lf1']  = $this->noticias_model->get_lf1news();


		// Preparar la vista
		$header['estilos'] = array('login.css','portada.css','jquery.tweet.query.css','jquery.tweet.css');
		$header['javascript'] = array('jquery','jquery.tweet','tweet_desdeboxes');

		$this->load->view('base/cab',$header);
		$this->load->view('base/page_top',$menu);
		$this->load->view('base/menu_vertical_inicio',$datos);
		$this->load->view('inicio/noticias',$datos);
		$this->load->view('base/page_bottom');

		//$this->load->view('vistas_2009/inicio',$datos);
		//$this->load->view('vistas_2009/base/pie');
	}

	/*DEPRECATED*/
	/*
	function portada(){

		

		//echo $this->session->userdata('language');
		// Datos del menu estadisticas,posts y countdown
		$datos = $this->menudata_model->get_menu_data();

		// Ultimas noticias
		$datos['noticias'] = $this->noticias_model->getNews();

		// Ultimos pilotos comprados
		$datos['ultimos_pilotos_comprados'] = $this->estadisticas_model->get_ultimos_comprados();

		// noticias de feed rss
		$datos['noticiasfeed'] = $this->noticias_model->get_feed_news()->channel;

		if($_SESSION['id_usuario'])
			$datos['noticias_lf1']  = $this->noticias_model->get_lf1news();

		$this->load->model('boxes/boxes_model');

		$datos['estadoBoxes'] = $this->boxes_model->estado();

		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');

		//2013: Mostrar ranking general/ricos en portada de manera  horizontal
		$this->load->model('ranking/ranking_model');
		//$datos['ranking'] = $this->ranking_model->getRankingGeneral()->result();
		$datos['ricos'] = $this->ranking_model->get_gold_managers(12);
		//dump($datos['ricos'] );die;

		// Menu activo
		$menu['m_act'] = 1;

		// Ultimos post  del FORO PHPBB
		$datos['last_topics'] = $this->forophpbb_model->get_last_topics();

		//dump($datos['noticiasfeed']);

		// En la portada no se comprueba session
		// para no entrar en bucle infinito.
		// Preparar la vista
		//$header['estilos'] = array('login.css','portada.css','jquery.tweet.query.css','jquery.tweet.css');
		//$header['javascript'] = array('jquery','jquery.tweet','tweet_desdeboxes');

		$header['estilos'] =array('jquery.tweet.query.css','jquery.tweet.css') ;

		// Siempre en este orden:
		// cabecera , page_top , menu_vertical , [tu vista], page_bottom
		$this->load->view('base/cab',$header);
		$this->load->view('base/top',$menu);
		$this->load->view('inicio/noticias_2012',$datos);
		$this->load->view('base/bottom');

		//$this->load->view('vistas_2009/inicio',$datos);
		//$this->load->view('vistas_2009/base/pie');

	}
	*/

	/*DEPRECATED*/
	/*
	function reglas(){

		// Datos del menu estadisticas,posts y countdown
		$datos = $this->menudata_model->get_menu_data();

		$header['estilos'] = array('reglas.css');

		// Menu activo
		$menu['m_act'] = 3;
		$menu['saldo'		] = $this->banco_model->getSaldo('formateado');

		// Preparar la vista
		$this->load->view('base/cab',$header);
		$this->load->view('base/top',$menu);
		$this->load->view('inicio/reglas');
		$this->load->view('base/bottom');

	}
	*/

	function login(){



		// Datos del menu estadisticas,posts y countdown
		//$datos = $this->menudata_model->get_menu_data();

		if($_POST){


			$this->load->model('usuarios/usuarios_model');
			$existe = $this->usuarios_model->checkUser($_POST);

			if($existe->num_rows()){

				// Iniciar session de usuario
				// Preconfigurar la vista para que cargue la portada
				$this->control_session->iniciar($_POST['usuario'],$existe->row()->id);

				/*DEPRECATED!*/
				// 2011 - Comprobar si tiene metido en su perfil la localizacion
				// Si no la tiene, se la metemos por geoposicionamiento
				//$this->usuarios_model->localizacion_usuario();

				// 2014- Comprobar que el usuario pertenezca  a alguna  comunidad autonoma
				// Ningun usuario anterior estara, asi que hay que mostrarles el form para seleccionarla
				$comunidad = $this->usuarios_model->check_comunidad_autonoma($existe->row()->id);
				if($comunidad)
				{
					redirect_lf1('dashboard');
				}
				else
				{
					redirect_lf1('inicio/sel_comunidad');
				}

				
				
			}
			else
			{

				// Mensaje de error en el login
				$this->session->set_flashdata('login_error', true);
				$this->session->set_flashdata('login_error_message', $this->lang->line('login_error'));
				redirect_lf1('inicio/acceso');

			}


		}

		else
		{


			redirect_lf1('inicio/acceso');

		}




	}


	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function sel_comunidad()
	{
		// Sin session GTFO!
		if(!$_SESSION){redirect_lf1('inicio/acceso');}

		// Llevar esto a un modelo!
		$res = $this->db->query("select * from usuarios order by rand() limit 6")->result_array();
		
		// Nick managers aleatorios
		$datos['managers'] = $res;

		/***********
		DATOS VISTA - Header
		************/

		// Titulo/desc
		$header['titulo'] 		= 'LigaFormula1.com - Introduce tu comunidad autónoma';
		$header['descripcion']  = 'Registrate gratis en la mejor liga manager de Formula 1. Estás a un paso de convertirte en un autentico manager y demostrar a la comunidad LF1 quien es el mejor manager!';

		// Estilos
		$header['estilos'] 		= array('loginbg.css','style.css');

		// Javascript
		//$bottom['javascript'] = array('');

		// Cargar vistas
		$this->load->view('base/header',$header);
		$this->load->view('inicio/sel_comunidad'  ,$datos);
		$this->load->view('base/bottom',$bottom);
	}

	/**
	 * Completar registro
	 *
	 * @return void
	 * @author 
	 **/
	function completar_registro()
	{
		// Si no viene del form ->GTFO!!
		if(!$_POST){redirect_lf1('inicio/acceso');}
		
		// Si justo se le ha caducado la session-> GTFO!!
		if(!$_SESSION['id_usuario']){redirect_lf1('inicio/acceso');}

		$this->load->model('usuarios/usuarios_model');
		$this->usuarios_model->completar_registro($_POST['comunidad']);

	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function restablecer_pass()
	{
		
		// Llevar esto a un modelo!
		$res = $this->db->query("select * from usuarios order by rand() limit 6")->result_array();
		
		// Nick managers aleatorios
		$datos['managers'] = $res;

		/***********
		DATOS VISTA - Header
		************/

		// Titulo/desc
		$header['titulo'] 		= 'LigaFormula1.com - ¿Has olvidado tu contraseña?';
		$header['descripcion']  = 'Registrate gratis en la mejor liga manager de Formula 1. Estás a un paso de convertirte en un autentico manager y demostrar a la comunidad LF1 quien es el mejor manager!';

		// Estilos
		$header['estilos'] 		= array('loginbg.css','style.css');

		// Javascript
		//$bottom['javascript'] = array('');

		// Cargar vistas
		$this->load->view('base/header',$header);
		$this->load->view('inicio/restablecer_pass'  ,$datos);
		$this->load->view('base/bottom',$bottom);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function restablecer_pass_envio()
	{
		if($_POST['correo'] != "")
		{
			// Comprobar si existe el correo
			$this->load->model('usuarios/usuarios_model');
			$existe = $this->usuarios_model->checkMail($_POST);

			if($existe->num_rows())
			{
				// Guardar id usuario y generar pass nueva
				$id_usuario = $existe->row()->id;
				$pass = $this->usuarios_model->generar_password();

				// Actualiza la nueva pass encriptandola
				$this->usuarios_model->resetear_password( $pass , $id_usuario);


				// Mandar correo con su nueva pass
				// $this->usuarios_model->mandar_mail_nuevo_password($existe->row()->email , $pass);
				$this->load->library('email');


				$mensaje_mail = "Se ha reseteado la contraseña a peticion tuya. Tu nueva contraseña es:  {$pass}
							Recuerda que puedes modificar tu contraseña desde tu perfil.

							Saludos,
							http://www.ligaformula1.com ";

				$this->email->from('ligaformula1@ligaformula1.com', 'Ligaformula1.com');
				$this->email->to($existe->row()->email);
				$this->email->subject('Liga formula 1 - Tu nueva contraseña');
				$this->email->message($mensaje_mail);

				if(!$this->email->send())
				{
					$this->session->set_flashdata('msg_error','No se ha podido enviar el email...');
					redirect_lf1('inicio/restablecer_pass');
				}
				else
				{
					$this->session->set_flashdata('msg_ok','Hemos enviado un email a tu cuenta  de correo con la nueva contraseña.');
					redirect_lf1('inicio/restablecer_pass');
				}

				//mail("{$existe->row()->email}","Liga Formula 1 - Nueva contraseña ","Tu nueva contraseña es {$pass}") ;



			}
			else
			{
				$this->session->set_flashdata('msg_error','El email introducido no existe');
				redirect_lf1('inicio/restablecer_pass');
			}

		}
		else
		{

			redirect_lf1('inicio/restablecer_pass');
		}
	}


	/**
	 * Nuevo Login
	 *
	 * @return void
	 * @author 
	 **/
	function acceso()
	{

		// Loged?
		$this->control_session->comprobar_sesion();

		
		
		// Llevar esto a un modelo!
		$res = $this->db->query("select * from usuarios order by rand() limit 6")->result_array();
		
		// Nick managers aleatorios
		$datos['managers'] = $res;

		/***********
		DATOS VISTA - Header
		************/

		// Titulo/desc
		$header['titulo'] 		= 'LigaFormula1.com - Manager Formula 1 basado en resultados reales de la temporada F1 2014';
		$header['descripcion']  = 'Juega al mejor manager Formula 1 online  basado en resultados de la F1 real. Compite contra tus amigos y contra  	todos  los  demás managers.';

		// Estilos
		$header['estilos'] 		= array('loginbg.css','style.css');

		// Javascript
		//$bottom['javascript'] = array('');

		// Cargar vistas
		$this->load->view('base/header.php',$header);
		$this->load->view('inicio/acceso'  ,$datos);
		$this->load->view('base/bottom.php',$bottom);
	}

	/**
	 * Nuevo Login
	 *
	 * @return void
	 * @author 
	 **/
	function alta()
	{

		// Loged?
		$this->control_session->comprobar_sesion();

		
		
		// Llevar esto a un modelo!
		$res = $this->db->query("select * from usuarios order by rand() limit 6")->result_array();
		
		// Nick managers aleatorios
		$datos['managers'] = $res;

		/***********
		DATOS VISTA - Header
		************/

		// Titulo/desc
		$header['titulo'] 		= 'LigaFormula1.com - Registrate gratis en ligaformula1.com';
		$header['descripcion']  = 'Registrate gratis en la mejor liga manager de Formula 1. Estás a un paso de convertirte en un autentico manager y demostrar a la comunidad LF1 quien es el mejor manager!';

		// Estilos
		$header['estilos'] 		= array('loginbg.css','style.css');

		// Javascript
		//$bottom['javascript'] = array('');

		// Cargar vistas
		$this->load->view('base/header',$header);
		$this->load->view('inicio/alta'  ,$datos);
		$this->load->view('base/bottom',$bottom);
	}

	function alta_nuevo_usuario()
	{
		
		//dump($_POST);
		// Campos a validar, se le quitan espacios, el passwd se codifica en md5
		/*DEPRECATED CI.1.7!*/
		/*
        $rules['usuario'] = "trim|required|min_length[4]|max_length[20]|xss_clean|callback_username_check";
        $rules['passwd'] = "trim|required|matches[passconf]|md5";
        $rules['passconf'] = "trim|required";
        $rules['email'] = "trim|required|valid_email|callback_email_check";
        */
        /*$rules['ano_nacimiento'] = "trim|numeric";
        $rules['ubicacion'] = "trim|max_length[299]";
        $rules['nombre'] = "trim|max_length[299]";
        $rules['apellido'] = "trim|max_length[299]";
		
		$rules['comunidad'] = "required";

		$fields['usuario'] = 'Nick';
        $fields['passwd'] = 'Contraseña';
        $fields['passconf'] = 'Confirmar contraseña';
        $fields['email'] = 'Email';
        $fields['comunidad'] = 'Comunidad';
		*
        $fields['ano_nacimiento'] = $this->lang->line('alta_ano_nacimiento');
        $fields['ubicacion'] = $this->lang->line('alta_ubicacion');
        $fields['nombre'] = $this->lang->line('alta_nombre');
        $fields['apellido'] = $this->lang->line('alta_apellidos');
        
		$this->validation->set_fields($fields);
        */
        

        

        $this->form_validation->set_rules("usuario","Nick","trim|required|min_length[4]|max_length[20]|xss_clean|callback_username_check");
        $this->form_validation->set_rules("passwd","Contraseña","trim|required|matches[passconf]|md5");
        $this->form_validation->set_rules("passconf","Confirmar contraseña","trim|required");
        $this->form_validation->set_rules("email","Email","trim|required|valid_email|callback_email_check");
        $this->form_validation->set_rules("comunidad","Comunidad","required");

        
        

        // Datos del menu estadisticas,posts y countdown
        $datos = $this->menudata_model->get_menu_data();

        if ($this->form_validation->run() == FALSE) {
            
            // Llevar esto a un modelo!
			$res = $this->db->query("select * from usuarios order by rand() limit 6")->result_array();
			
			// Nick managers aleatorios
			$datos['managers'] = $res;

			/***********
			DATOS VISTA - Header
			************/

			// Titulo/desc
			$header['titulo'] 		= 'LigaFormula1.com - Registrate gratis en ligaformula1.com';
			$header['descripcion']  = 'Registrate gratis en la mejor liga manager de Formula 1. Estás a un paso de convertirte en un autentico manager y demostrar a la comunidad LF1 quien es el mejor manager!';

			// Estilos
			$header['estilos'] 		= array('loginbg.css','style.css');

			// Javascript
			//$bottom['javascript'] = array('');

			// Cargar vistas
			$this->load->view('base/header',$header);
			$this->load->view('inicio/alta'  ,$datos);
			$this->load->view('base/bottom',$bottom);

        } else {
        	
            // Guardar usuario en BD
            $this->load->model('usuarios/usuarios_model');
            $this->usuarios_model->altaNueva($_POST);
            $this->usuarios_model->checkUser($_POST);

            // Mensaje de error en el login
            $this->session->set_flashdata('alta_ok', true);             
            //$this->session->set_flashdata('usuario_nuevo_mensaje', $this->lang->line('alta_ok_mensaje'));             
            redirect_lf1('inicio/acceso');
        }
	}

	function recordar_login()
	{
		// Datos del menu estadisticas,posts y countdown
		$datos = $this->menudata_model->get_menu_data();

		if($_POST['correo'] != "")
		{
			// Comprobar si existe el correo
			$this->load->model('usuarios/usuarios_model');
			$existe = $this->usuarios_model->checkMail($_POST);

			if($existe->num_rows())
			{
				// Guardar id usuario y generar pass nueva
				$id_usuario = $existe->row()->id;
				$pass = $this->usuarios_model->generar_password();

				// Actualiza la nueva pass encriptandola
				$this->usuarios_model->resetear_password( $pass , $id_usuario);


				// Mandar correo con su nueva pass
				// $this->usuarios_model->mandar_mail_nuevo_password($existe->row()->email , $pass);
				$this->load->library('email');


				$mensaje_mail = "Se ha reseteado la contraseña a peticion tuya. Tu nueva contraseña es:  {$pass}
							Recuerda que puedes modificar tu contraseña desde tu perfil.

							Saludos,
							http://www.ligaformula1.com ";

				$this->email->from('ligaformula1@ligaformula1.com', 'Ligaformula1.com');
				$this->email->to($existe->row()->email);
				$this->email->subject('Liga formula 1 - Tu nueva contraseña');
				$this->email->message($mensaje_mail);

				if(!$this->email->send())
				{
					$mensaje['msgOk'] = '<p>No se ha podido enviar el email.</p>';
				}
				else
				{
					$mensaje['msgOk'] = '<p>Recibiras un mail en tu dirección de correo con tu nueva contraseña.</p>';
				}

				//mail("{$existe->row()->email}","Liga Formula 1 - Nueva contraseña ","Tu nueva contraseña es {$pass}") ;



				// Preparar la vista
				$header['estilos'] = array('login.css');

				//Se prepara la vista
				$this->load->view('base/cabecera',$header);
				$this->load->view('base/page_top');
				//$this->load->view('base/menu_vertical_inicio',$datos);
				$this->load->view('inicio/recordar_login_ok',$mensaje);
				$this->load->view('base/page_bottom');

			}
			else
			{
				// Mensaje de error en el login
				// Preconfigurar la vista para que cargue
				// el login denuevo
				$mensaje['msgError'] = '<span>Correo electrónico incorrecto.</span>';
				// Preparar la vista
				$header['estilos'] = array('login.css');

				//Se prepara la vista
				$this->load->view('base/cabecera',$header);
				$this->load->view('base/page_top');
				//$this->load->view('base/menu_vertical_inicio',$datos);
				$this->load->view('inicio/recordar_login',$mensaje);
				$this->load->view('base/page_bottom');
			}

		}
		else
		{

			// Preparar la vista
			$header['estilos'] = array('alta.css');

			// Menu activo
			$menu['m_act'] = 1;

			$this->load->view('base/cab',$header);
			$this->load->view('base/top',$menu);
			$this->load->view('inicio/recordar_login',$mensaje);
			$this->load->view('base/bottom');
		}
	}



	function logout(){

		$this->control_session->destruir_sesion();


	}

	// funcion callback para la validacion
    function username_check($str) {

        $query = $this->db->query("SELECT * FROM usuarios WHERE nick = ?", array($str));

        if ($query->num_rows()) {
            $this->form_validation->set_message('username_check', 'Ese nombre de usuario ya existe');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // funcion callback para la validacion
    function email_check($str) {

        $query = $this->db->query("SELECT * FROM usuarios WHERE email = ?", array($str));

        if ($query->num_rows()) {
            $this->form_validation->set_message('email_check', 'Ese email ya existe');
            return FALSE;
        } else {
            return TRUE;
        }
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

	/**
	 * Changes the active language
	 *
	 * @access	public
	 * @author	Gorka Garin
	 * @param	string $language
	 * @return	void
	 */
	public function change($language)
	{
		if (in_array($language, $this->languages))
		{
			$this->session->set_userdata('language', $language);
		}

		redirect_lf1('inicio');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */