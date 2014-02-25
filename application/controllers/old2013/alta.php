<?php

class Alta extends Controller {

    /**
     * Idiomas soportados
     */
    private $languages  = array ('spanish','english');

    function Alta() {
        parent::Controller();

        // Configurar idioma
        $this->_set_language();

        $this->load->helper(array('form', 'url'));
        $this->load->library('validation');
        $this->load->database();
        $this->load->model(array('sesiones/control_session', 'estadisticas/estadisticas_model'));
        $this->load->model('calendario/calendario_model');
        $this->load->model('menudata/menudata_model');
    }

    function index() {

        // Trazas
        /*
        if(file_exists('./comunidad/includes/functions_user.php')){
            echo "ok";
        }
        else
        {
            echo "n";
        }
        die;
        echo base_url().'/comunidad/includes/functions_user.php';die;
        */

        // Datos del menu estadisticas,posts y countdown
        $datos = $this->menudata_model->get_menu_data();

        // Datos del menu estadisticas,posts y countdown
        $datos = $this->menudata_model->get_menu_data();

        // Preparar la vista
        $header['estilos'] = array('alta.css');

        // Menu activo
        $menu['m_act'] = 2;

        $this->load->view('base/cab',$header);
        $this->load->view('base/top',$menu);
        ////$this->load->view('base/menu_vertical_inicio',$datos);
        $this->load->view('alta/alta',$datos);
        $this->load->view('base/bottom');
    }

    function nuevo_usuario() {
        // Campos a validar, se le quitan espacios, el passwd se codifica en md5
        $rules['usuario'] = "trim|required|min_length[4]|callback_username_check";
        $rules['passwd'] = "trim|required|matches[passconf]|md5";
        $rules['passconf'] = "trim|required";
        $rules['email'] = "trim|required|valid_email|callback_email_check";
        $rules['ano_nacimiento'] = "trim|numeric";
        $rules['ubicacion'] = "trim|max_length[299]";
        $rules['nombre'] = "trim|max_length[299]";
        $rules['apellido'] = "trim|max_length[299]";

        $this->validation->set_rules($rules);

        $fields['usuario'] = $this->lang->line('alta_nick');
        $fields['passwd'] = $this->lang->line('alta_password');
        $fields['passconf'] = $this->lang->line('alta_confirmar_password');
        $fields['email'] = $this->lang->line('alta_email');
        $fields['ano_nacimiento'] = $this->lang->line('alta_ano_nacimiento');
        $fields['ubicacion'] = $this->lang->line('alta_ubicacion');
        $fields['nombre'] = $this->lang->line('alta_nombre');
        $fields['apellido'] = $this->lang->line('alta_apellidos');

        $this->validation->set_fields($fields);

        // Datos del menu estadisticas,posts y countdown
        $datos = $this->menudata_model->get_menu_data();

        if ($this->validation->run() == FALSE) {
            
            // Preparar la vista
            $header['estilos'] = array('alta.css');
            
            
            // Menu activo
            $menu['m_act'] = 2;

            $this->load->view('base/cab',$header);
            $this->load->view('base/top',$menu);
            
            $this->load->view('alta/alta',$datos);
            $this->load->view('base/bottom');

        } else {
            // Guardar usuario en BD
            $this->load->model('usuarios/usuarios_model');
            $this->usuarios_model->altaNueva($_POST);
            $this->usuarios_model->checkUser($_POST);

            // Mensaje de error en el login
            $this->session->set_flashdata('usuario_nuevo', true);             
            $this->session->set_flashdata('usuario_nuevo_mensaje', $this->lang->line('alta_ok_mensaje'));             
            redirect_lf1('inicio/portada');
        }
    }

    // funcion callback para la validacion
    function username_check($str) {

        $query = $this->db->query("SELECT * FROM usuarios WHERE nick = ?", array($str));

        if ($query->num_rows()) {
            $this->validation->set_message('username_check', 'Ese nombre de usuario ya existe');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // funcion callback para la validacion
    function email_check($str) {

        $query = $this->db->query("SELECT * FROM usuarios WHERE email = ?", array($str));

        if ($query->num_rows()) {
            $this->validation->set_message('email_check', 'Ese email ya existe');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // Se le pasan por URL el usuario y la pass nueva
    function cambiar_usuario_pass($usuario, $pass_nueva) {

        // Es el admin???
        if ($_SESSION['id_usuario'] == 177) {

            $pass = md5($pass_nueva);

            $update_data = array(
                "password" => $pass
            );

            $this->db->where("nick", $usuario);
            $this->db->update("usuarios", $update_data);

            echo "Se ha cambiado la contraseña al usuario " . $usuario . ", la nueva contraseña es " . $pass_nueva;
        }
    }

    //Funcion que modifica los datos personales
    function modificarDatos() {
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
            $datos['mensaje'] = "Error modificando datos";
        } else {
            $this->usuarios_model->alterUserData($_POST);
            $datos['mensaje'] = "Datos modificados correctamente";
        }

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
    }

    /**
     * Configurar el idioma que debe cargar
     *
     * @access  private
     * @author  Gorka Garin
     * @return  void
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