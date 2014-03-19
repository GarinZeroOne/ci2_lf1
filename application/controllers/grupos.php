<?php

class Grupos extends CI_Controller {

	/**
	 * Idiomas soportados /*DEPRECATED!*/
	/* 
	private $languages	= array ('spanish','english');
	*/

	function Grupos()
	{
		parent::__construct();

		// Configurar idioma
		//$this->_set_language();

		$this->load->helper('url');
		$this->load->database();
		$this->load->model('sesiones/control_session');
		$this->load->model('calendario/calendario_model');
		 $this->load->model('grupos/grupos_model');
		$this->load->model('noticias/noticias_model');
		$this->load->model('estadisticas/estadisticas_model');
		$this->load->model('menudata/menudata_model');
		$this->load->model('banco/banco_model');
		$this->load->model('foro/forophpbb_model');
		$this->load->model('usuarios/usuarios_model');
		$this->load->helper('timeago');

		// controlar session
		$this->control_session->comprobar_sesion();

	}

	
	/**
	 * Clasificaciones
	 *
	 * @return void
	 * @author 
	 **/
	function index()
	{

		// Menu Izquierda
		$sidebarleft 		  = array();
		$sidebarleft['m_act'] = 5;

		
		// Obtener todos los grupos donde esta metido el usuario
		$datos['gruposUsuario'] = $this->grupos_model->obtenerGruposUsuario($_SESSION['id_usuario'])->result();
		//dump($datos['gruposUsuario']);

		// Obtener grupos publicos
		$datos['grupos_publicos'] = $this->grupos_model->obtener_grupos_publicos();

        //  Ejemplo GASTOS /INGRESOS
		// Se ha  echo un gasto/ingreso ,se guarda lo ke tenia antes del gasto/ingreso
		//$this->session->set_flashdata('banco_desde', '1300000');

		// Header
		$header['estilos'] 	  = array('dashboard.css');
		$header['titulo' ]	  = 'Grupos - LigaFormula1.com';
		

		// Javascript
		$bottom['javascript'] = array('dashboard/grupos.js','dashboard/texto_tabla_es.js');

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/grupos/grupos'  ,$datos);

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php',$sidebarright);		
		$this->load->view('dashboard/base/bottom.php',$bottom);
		
	}


	/**
	 * Vista principal de un grupo
	 *
	 * @return void
	 * @author 
	 **/
	function ver( $id_grupo = false )
	{

		
		// Si lo que llega no es un ID -> GTFO!!
		if(!is_numeric($id_grupo)){ redirect_lf1('grupos');}

		// Si el id del grupo no existe ->GTFO!!
		if(!$this->grupos_model->existe_grupo($id_grupo)){redirect_lf1('grupos');}

		// Menu Izquierda
		$sidebarleft 		  = array();
		$sidebarleft['m_act'] = 5;

        

        // NEW 2013! Poner como notificados todos los mensajes de este grupo
        // de manera que no te vuelva a notificar hasta ke haya nuevos
        $this->grupos_model->set_notificados($id_grupo,$_SESSION['id_usuario']);

        $datos['idGrupo'] = $id_grupo;

        //Se añade el model de los rankings
        $this->load->model('ranking/ranking_model');

        $datos['nombreGrupo'	] = $this->grupos_model->obtenerNombreGrupo($id_grupo)->nombre;

        $datos['grupo_info'     ] = $this->grupos_model->obtener_info_grupo($id_grupo);

        $datos['num_usuarios'   ]  = $this->grupos_model->get_num_usuarios_grupo($id_grupo);

        $datos['soy_miembro'    ] = $this->grupos_model->get_soy_miembro($id_grupo);

        $datos['rankingGP'		] = $this->grupos_model->gruposRankingGP($id_grupo)->result();

        $datos['rankingGeneral' ] = $this->grupos_model->gruposRankingGeneral($id_grupo)->result();

        $datos['ultMensajes'	] =  $this->grupos_model->obtener_mensajes($id_grupo)->result();
                //dump($datos['ultMensajes']);

        $datos['datosGP'		] = $this->ranking_model->obtenerNombreGP($idGP);

        //dump($datos);

        // Animacion Dinero
        /*
        if( $this->session->flashdata('banco_desde') )
        {
        	$data_to_js['banco_desde'] = $this->session->flashdata('banco_desde');
        	$data_to_js['banco_hasta'] = $this->banco_model->getSaldo();

        	$bottom['javascript_php'] = array('ruletadinero' => $this->load->view('dashboard/_head/js/ruletadinero',$data_to_js,TRUE));
    	}
    	*/
		// Header
		$header['estilos'] 	  = array('dashboard.css');
		$header['titulo' ]	  = 'Grupos - LigaFormula1.com';

		// Javascript
		$bottom['javascript'    ] = array('dashboard/comentarios.js','dashboard/confirmar.js');
		

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/grupos/vista_grupo'  ,$datos);

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
	function ajax_chat()
	{
		// Evitar entradas por url
		if(!$_POST){die;}

		$id_grupo = $_POST['gi'];
		$contenido = strip_tags($_POST['comment']);

		$mensaje = $this->grupos_model->insertMensajes($id_grupo,$contenido,true);
		$texto = '<li class="clearfix odd">
                                <div class="chat-avatar">
                                    <img alt="female" width="40" src="http://localhost/lf12014//img/avatares/thumbs/'.$mensaje->avatar.'">
                                    <i>'.timeago(strtotime(date('Y-m-d H:i:s'))).'</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i><a class="num-msg-grp-g" onclick="citar(this)" data-msg-internal="'.$mensaje->id_mensaje_grupo.'" src="#">#'.$mensaje->id_mensaje_grupo.'</a> '.$mensaje->nick.'</i>
                                        <p>
                                            '.$contenido.'
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
	function ajax_load_more()
	{
		// Evitar entradas por url
		if(!$_POST){die;}
		
		$texto = $this->grupos_model->obtener_mensajes_anteriores($_POST["dataid"]);

		

		echo $texto;
	}


	/**
	 * Creacion de grupos
	 *
	 * @return void
	 * @author 
	 **/
	function crear_grupo()
	{

		if($_POST['nombre_grupo'])
		{

			// Comprobar que no exista
			$existeGrupo = $this->grupos_model->existeGrupo(strip_tags($_POST['nombre_grupo']));

	        if ($existeGrupo) 
	        {
	        	$this->session->set_flashdata('msg_error', 'El grupo ya existe, prueba con otro nombre.');
	            redirect_lf1('grupos/crear_grupo');
	        } 
	        else 
	        {
	            //Se inserta el grupo en la tabla usuarios_grupos
	            $idGrupo = $this->grupos_model->insertGrupo($_POST);

	            //Se inserta en la tabla grupos_miembros el usuario creador
	            $this->grupos_model->insertGrupoUsuario($idGrupo, $_SESSION['id_usuario']);

	            $this->session->set_flashdata('msg_ok', 'El grupo se ha creado satisfactoriamente! Ya puedes añadir miembros desde el panel de configuración.');
	        }

	        /*IMAGEN DEL GRUPO*/
	        if($_FILES['userfile']['name'] && $idGrupo)
	        {
				$config['upload_path'] = ROOT.'/img/grupos/';
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
					
					
					$this->session->set_flashdata('msg_error', 'No se ha  podido guardar la imagen del grupo.'.$cad_errores.' <br> El grupo aparecerá sin imagen hasta que subas una valida.');
					redirect_lf1('grupos');
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
					$config['source_image'  ] = ROOT.'/img/grupos/'.$nombre_archivo;
					$config['new_image'		] = ROOT.'/img/grupos/thumbs/'.$nombre_archivo;
					$config['create_thumb'  ] = TRUE;
					$config['maintain_ratio'] = FALSE;
					$config['width' 		] = 80;
					$config['height'		] = 80;
					$config['thumb_marker'  ] = '';

					$this->load->library('image_lib', $config);

					if ( ! $this->image_lib->resize())
					{
					    echo $this->image_lib->display_errors();
					}

					// Guardar imagen del grupo
					$this->grupos_model->guardar_imagen_grupo($idGrupo,$nombre_archivo);

					redirect_lf1('grupos');
				}
			}

		}

		// Header
		$header['estilos'] 	  = array('dashboard.css');
		$header['titulo' ]	  = 'Crear nuevo grupo - LigaFormula1.com';

		// Javascript
		$bottom['javascript'] = array();

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/grupos/crear_grupo'  ,$datos);

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php',$sidebarright);		
		$this->load->view('dashboard/base/bottom.php',$bottom);
		
	}


	/**
	 * Configuracion de grupo
	 *
	 * @return void
	 * @author 
	 **/
	function configurar_grupo($id_grupo = false)
	{


		// Si no llega un id de grupo -> GTFO!!
		if(!is_numeric($id_grupo)){redirect_lf1('grupos');}

		// Si no es el administrador -> GTFO!!
		if(!$this->grupos_model->get_soy_admin($id_grupo)){redirect_lf1('grupos');}

		/*
		$this->load->helper('generar_codigo');
		echo generar_codigo(8);die;
		*/

		if($_POST)
		{
			//dump($_POST);die;
			if($_POST['codigo_manager'])
			{
				$this->grupos_model->agregar_usuario_grupo($id_grupo,$_POST['codigo_manager']);
			}
			else
			{
				$this->grupos_model->actualizar_datos_grupo($_POST,$_FILES);	
			}
			

			
		}


		$datos['info_grupo'		] = $this->grupos_model->obtener_info_grupo($id_grupo);
		$datos['usuarios_grupo'	] = $this->grupos_model->obtener_usuarios_grupo($id_grupo);

		//dump($datos['info_grupo']);die;
		// Header
		$header['estilos'] 	  = array('dashboard.css');
		$header['titulo' ]	  = 'Crear nuevo grupo - LigaFormula1.com';

		// Javascript
		$bottom['javascript'    ] = array('dashboard/confirmar.js');

		// Vistas base | Header | Menu Principal
		$this->load->view('dashboard/base/header.php',$header);
		$this->load->view('dashboard/base/sidebarleft.php',$sidebarleft);

		// Vista contenido
		$this->load->view('dashboard/grupos/configurar_grupo'  ,$datos);

		// Vistas base | Menu derecha | Bottom end
		$this->load->view('dashboard/base/sidebarright.php',$sidebarright);		
		$this->load->view('dashboard/base/bottom.php',$bottom);
	}



	/**
	 * Eliminar usuario de un grupo. Se recibe el id del registro de grupos_miembros
	 *
	 * @return void
	 * @author 
	 **/
	function eliminar_usuario_grupo($id_registro_miembro)
	{
		// Si no llega un id de grupo -> GTFO!!
		if(!is_numeric($id_registro_miembro)){redirect_lf1('grupos');}

		$this->grupos_model->eliminar_usuario_grupo($id_registro_miembro);
	}

	/**
	 * Ingresar a un grupo publico
	 *
	 * @return void
	 * @author 
	 **/
	function ingresar(  $id_grupo = false )
	{
		// Si no llega un id de grupo -> GTFO!!
		if(!is_numeric($id_grupo)){redirect_lf1('grupos');}

		$this->grupos_model->ingresar_grupo_publico($id_grupo);
	}


	/**
	 * Abandonar  un grupo
	 *
	 * @return void
	 * @author 
	 **/
	function abandonar( $id_grupo = false )
	{
		// Si no llega un id de grupo -> GTFO!!
		if(!is_numeric($id_grupo)){redirect_lf1('grupos');}

		$this->grupos_model->abandonar_grupo($id_grupo);
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
		$header['estilos'] 	  = array();

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