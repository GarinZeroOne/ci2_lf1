<?php

class Perfil extends CI_Controller {

	/**
	 * Idiomas soportados /*DEPRECATED!*/
	/* 
	private $languages	= array ('spanish','english');
	*/

	function Perfil()
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
		$this->load->library('form_validation');

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

		//
		$this->load->helper('generar_codigo');

		// Menu Izquierda
		$sidebarleft 		  = array();
		$sidebarleft['m_act'] = 0;
		
		$datos['codigo_manager'] = $this->usuarios_model->get_codigo_manager($_SESSION['id_usuario']);
		$datos['info_usuario'  ] = $this->usuarios_model->get_info_usuario($_SESSION['id_usuario']);
		$datos['full_stats'    ] = $this->estadisticas_model->get_full_stats($_SESSION['id_usuario']);
		

		//dump($datos['info_usuario'  ]);

		// Header
		$header['estilos'] 	  = array('perfil.css','dashboard.css');
		$header['titulo' ]	  = 'Perfil de usuario - LigaFormula1.com';
		$header['avatar' ]    = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

		// Javascript
		$bottom['javascript'] = array();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/perfil/perfil.php'  ,$datos);

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php',$sidebarright);		
		$this->load->view('dashboard/base/bottom.php',$bottom);
		
	}


	/**
	 * Ver perfil de un manager
	 *
	 * @return void
	 * @author 
	 **/
	function ver()
	{
		//se recoge el nick del usuario
        $nickname = $this->uri->segment(3);
        // Eliminar %20 de espacios en nick, para que no fallen las queries
        $nickname = urldecode($nickname);

        // No hay nick?? GTFO
        if(!$nickname)
        {
            redirect_lf1('dashboard');
        }

		//
		$this->load->helper('generar_codigo');

		// Menu Izquierda
		$sidebarleft 		  = array();
		$sidebarleft['m_act'] = 0;

		// Id del usuario
		$data_user = $this->usuarios_model->userDataNick($nickname);

		// Si no hay info dle user por lo que sea! GTFO!!
		if(!$data_user){redirect_lf1('dashboard');}
		//dump($data_user);die;
		
		$datos['codigo_manager'] = $this->usuarios_model->get_codigo_manager($data_user->id);
		$datos['info_usuario'  ] = $this->usuarios_model->get_info_usuario($data_user->id);
		$datos['full_stats'    ] = $this->estadisticas_model->get_full_stats($data_user->id);
		//dump($datos['full_stats'    ]);
		//dump($datos['info_usuario'  ]);

		// Header
		$header['estilos'] 	  = array('perfil.css','dashboard.css');
		$header['titulo' ]	  = 'Perfil de usuario - LigaFormula1.com';
		$header['avatar' ]    = $this->usuarios_model->userAvatar($data_user->id);

		// Javascript
		$bottom['javascript'] = array();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/perfil/perfil.php'  ,$datos);

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php',$sidebarright);		
		$this->load->view('dashboard/base/bottom.php',$bottom);
		
	}

	/**
	 * Editar Perfil
	 *
	 * @return void
	 * @author 
	 **/
	function editar_perfil()
	{

		//Obtener los datos del usuario
		$datos['usuario'] = $this->usuarios_model->userData($_SESSION['id_usuario']);

		// Obtener avatar usuario
        $datos['avatar'] = $this->usuarios_model->userAvatar($_SESSION['id_usuario']);

		// Header
		$header['estilos'] 	  = array('perfil.css','dashboard.css');
		$header['titulo' ]	  = 'Perfil de usuario - LigaFormula1.com';

		// Javascript
		$bottom['javascript'] = array();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/perfil/editar_perfil'  ,$datos);

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
	function modificar_datos()
	{
		if(!$_POST)
    		redirect_lf1('perfil/editar_perfil');


    	

        

        $this->form_validation->set_rules('ano_nacimiento','Año nacimiento','trim|numeric|max_length[4]|min_length[4]');
        $this->form_validation->set_rules('ubicacion','Población','trim|max_length[299]');
        $this->form_validation->set_rules('nombre','Nombre','trim|max_length[299]');
        $this->form_validation->set_rules('apellido','Apellido','trim|max_length[299]');

        

        //Cargamos el modelo de usuarios
        $this->load->model('usuarios/usuarios_model');

        if ($this->form_validation->run() == FALSE) {
            //$datos['mensaje'] = "Error modificando datos";
            $this->session->set_flashdata('msg_error', validation_errors() );
        } else {
            $this->usuarios_model->alterUserData($_POST);
            //$datos['mensaje'] = "Datos modificados correctamente";
            $this->session->set_flashdata('msg_ok', 'La información personal de tu perfil se ha actualizado.');
        }


        redirect_lf1('perfil/editar_perfil');
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function mi_perfil_cpass()
	{

		if(!$_POST)
    		redirect_lf1('boxes/mi_perfil');

		$this->usuarios_model->modificar_pass( $_POST['Oldpass'], $_POST['Newpass']);
	}


	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	function subir_avatar()
	{
		// Controlar la subida
		if($_FILES['userfile']['name'])
		{

			$config['upload_path'] = ROOT.'/img/avatares/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '200';
			$config['max_width']  = '1280';
			$config['max_height']  = '1024';
			$config['file_name'] = strtotime(date('Y-m-d H:i:s'));

			$this->load->library('upload', $config);

			// GUARDAR IMAGEN
			if ( ! $this->upload->do_upload())
			{
				$errores = $this->upload->display_errors();
					
				if(is_array($errores)){
					foreach($errores as $error){
						$cad_errores .=  $error.' | ';
					}	
				}
				else
				{
					$cad_errores = $errores;
				}
				
				
				$this->session->set_flashdata('msg_error', 'Error al subir la imagen seleccionada:.'.$cad_errores.' .');
				redirect_lf1('perfil/editar_perfil');
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

				$this->session->set_flashdata('msg_ok', 'La imagen se ha subido satisfactoriamente.');
				redirect_lf1('perfil/editar_perfil');
			}
		}
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