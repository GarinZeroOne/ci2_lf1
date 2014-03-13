<?

class Usuarios_model extends CI_Model {

    private $ci;

    function Usuarios_model() {
        parent::__construct();
        $this->ci = & get_instance();
        // 2013 - Logear usuario en foro para PHPBB
        // Cargar funciones phpbb para CI
        $this->load->helper('phpbb_helper');
    }

    function altaNueva($datos) {

        // Guardar usuario en BD
        $sql = "INSERT INTO usuarios VALUES('',?,?,?,?,?,?,?,?,?,?,?)";
        $this->db->query($sql, array($datos['comunidad'],
            $datos['usuario'],
            $datos['passwd'],
            date('Y-m-d'),
            $datos['email'],
            '',
            '',
            '',
            '',
            '',
            ''
                /* $datos['nombre'], 
                  $datos['apellido'],
                  $datos['ubicacion'],
                  $datos['ano_nacimiento'],'' */
        ));

        $id_usuario = $this->db->insert_id();

        $fondos_alta_nueva = 250000;
        $numeroGps = $this->db->query("SELECT *	FROM `circuitos` WHERE fecha < '" . date('Y-m-d') . "'")->num_rows();
        $dinero_por_GP_pasado = 50000 * $numeroGps;
        // Ingresarle al usuario los 200.000€ de alta nueva + 50.000€ por GP pasado.
        $fondos = $fondos_alta_nueva + $dinero_por_GP_pasado;

        // Meterle los fondos por defecto al usuario en el banco
        $sql_banco = "INSERT INTO usuarios_banco VALUES('',?,{$fondos})";
        $this->db->query($sql_banco, array($id_usuario));

        // Crearle el avatar
        $avatar = "http://www.ligaformula1.com/imgs/avatares/no_avatar.gif";
        $this->db->query("INSERT INTO usuarios_avatar VALUES('',?,'no_avatar.jpg',?)", array($id_usuario, $avatar));


        // 2014 - Ingresar al usuario en el grupo de su comunidad
        $id_grupo = $this->db->select('id_grupo')->from('comunidades')->where('id', $datos['comunidad'])->get()->row()->id_grupo;
        $data_insert = array(
            'id' => '',
            'id_usuario' => $id_usuario,
            'id_grupo' => $id_grupo
        );
        $this->db->insert('grupos_miembros', $data_insert);

        // 2013 - Crear usuario de foro para PHPBB
        // Registramos al usuario en el foro PHPBB integrado
        reg_from_ci_to_phpbb($datos['usuario'], $datos['email'], 'l1g4formul41r4nd0mp455');
    }

    function checkUser($datos) {
        // Codificar el passwd introducido a md5
        // para compararlo con el de la base de datos

        $pass_encriptado = md5($datos['passwd']);

        $sql = "SELECT * FROM usuarios WHERE nick = ? AND password = ?";
        $query = $this->db->query($sql, array($datos['usuario'], $pass_encriptado));

        // Login OK
        if ($query->num_rows()) {
            //Actualizar fecha login
            $id_usuario = $query->row()->id;
            $data = array('fecha_ultimo_login' => date('Y-m-d H:i:s'));
            $this->db->where('id', $id_usuario);
            $this->db->update('usuarios', $data);

            return $query;
        } else {
            return $query;   // Login MAL
        }
    }

    function checkMail($datos) {

        // Codificar el passwd introducido a md5
        // para compararlo con el de la base de datos
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $query = $this->db->query($sql, array($datos['correo']));

        if ($query->num_rows()) {
            return $query;   // Login OK
        } else {
            return $query;   // Login MAL
        }
    }

    function generar_password() {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $cad = "";
        for ($i = 0; $i < 10; $i++) {
            $cad .= substr($str, rand(0, 62), 1);
        }

        return $cad;
    }

    // Le pone al usuario un pass aleatorio
    function resetear_password($pass, $id_usuario) {
        $nuevo_pass = md5($pass);
        $sql = "UPDATE usuarios SET password = ? WHERE id = ?";

        $this->db->query($sql, array($nuevo_pass, $id_usuario));
    }

    function mandar_mail_nuevo_password($correo, $passwd) {

        $this->load->library('email');

        $mensaje = "Se ha reseteado la contraseña a peticion tuya. Tu nueva contraseña es:  <b>{$passwd}</b>
					Recuerda que puedes modificar tu contraseña desde tu perfil.

					Saludos,
					http://www.ligaformula1.com ";

        $this->email->from('ligaformula1@ligaformula1.com', 'Ligaformula1.com');
        $this->email->to($correo);
        $this->email->subject('Liga formula 1 - Tu nueva contraseña');
        $this->email->message($mensaje);

        $this->email->send();
    }

    function userAvatar($idu) {
        $sql = "SELECT avatar FROM usuarios_avatar WHERE id_usuario = ?";
        return $this->db->query($sql, array($idu))->row()->avatar;
    }

    function userAvatarSave($idu, $archivo) {
        $sql = "UPDATE usuarios_avatar SET
										avatar = '" . $archivo . "',
										avatar_path = 'http://www.ligaformula1.com/imgs/avatares/" . $archivo . "'
									   WHERE
									    id_usuario='" . $idu . "'";

        $this->db->query($sql);
    }

    //Funcion que devuelve los datos de un usuario
    function userData($id_usuario) {
        $sql = "SELECT * FROM usuarios where id = ?";
        return $this->db->query($sql, array($id_usuario))->row();
    }

    //Funcion que devuelve los datos de un usuario por su nick y suma la visita al perfil
    function userDataNick($nick) {



        $sql = "SELECT * FROM usuarios WHERE nick = ?";

        $q = $this->db->query($sql, array($nick));


        // SI existe le sumamos la visita
        if ($q->num_rows()) {

            // Datos a guardar
            $id_visitante = ($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;
            $id_visitado = $q->row()->id;
            $direccion_ip = ip2long($this->input->ip_address());
            $fecha_visita = date('Y-m-d H:i:s');



            //Las visitas del propio usuario sobre su perfil no se cuentan so...
            if ($id_vivistante != $id_visitado) {

                $res = $this->db->select('id,fecha_visita,id_visitante')->from('perfil_visitas')
                        ->where('id_visitado', $id_visitado)
                        ->where('ip', $direccion_ip)
                        ->order_by('id', 'desc')
                        ->limit(1)
                        ->get();

                // Ya has visitado antes este perfil, sumaremos la visita solo si  han pasado 24h desde tu ultima visita
                // o si su primera  visita la hizo sin logearse y ahora logeado
                if ($res->num_rows()) {
                    $fecha_proxima_visita_posible = strtotime($res->row()->fecha_visita) + 86400;
                    $hoy = strtotime($fecha_visita);

                    // Ha pasado un  dia desde su ultima visita?
                    if ($hoy > $fecha_proxima_visita_posible || ($res->row()->id_visitante != $id_visitante)) {

                        // Pasa todos los filtros , guardamos visita.
                        $data_insert = array(
                            'id' => '',
                            'id_visitado' => $id_visitado,
                            'id_visitante' => $id_visitante,
                            'fecha_visita' => $fecha_visita,
                            'ip' => $direccion_ip,
                        );


                        $this->db->insert('perfil_visitas', $data_insert);
                    }
                }

                // Primera  vez  que visita el perfil de este usuario
                else {
                    // Pasa todos los filtros , guardamos visita.
                    $data_insert = array(
                        'id' => '',
                        'id_visitado' => $id_visitado,
                        'id_visitante' => $id_visitante,
                        'fecha_visita' => $fecha_visita,
                        'ip' => $direccion_ip,
                    );


                    $this->db->insert('perfil_visitas', $data_insert);
                }
            }

            return $q->row();
        }
        else
        {
            return false;
        }

        
    }

    function alterUserData($datos) {
        $sql = "UPDATE usuarios SET nombre = ?, apellido = ?,
                ubicacion = ? , ano_nacimiento = ? , info_perfil = ? WHERE id = ?";

        return $this->db->query($sql, array($datos['nombre'], $datos['apellido'],
                    $datos['ubicacion'], $datos['ano_nacimiento'],$datos['texto_perfil'], $_SESSION['id_usuario']));
    }

    function localizacion_usuario() {
        $sql_loc = "SELECT ubicacion FROM usuarios where id = ?";
        $ubicacion = $this->db->query($sql_loc, array($_SESSION['id_usuario']))->row()->ubicacion;

        // Si no tiene ubicacion metida , le geolocalizamos
        if ($ubicacion == '') {
            $this->load->library('ip2location');

            $this->ip2location->setKey('3294cf413fb8df13e57b6bfa2700bcb94a4f349bc94e11b2d3d65cf11ee2e037');
            $locations = $this->ip2location->getCity($_SERVER['REMOTE_ADDR']);

            //Guardamos en ubicacion, el city y el pais que nos devuelve
            if (!empty($locations) && is_array($locations)) {
                $ubicacion = $locations['cityName'] . " ( " . $locations['countryCode'] . " ) ";

                $sql_update = "UPDATE usuarios SET ubicacion = ? WHERE id = ?";
                $this->db->query($sql_update, array($ubicacion, $_SESSION['id_usuario']));
            }
        }
    }

    function modificar_pass($pass_viejo, $pass_nuevo) {
        //Pequeñas validaciones
        if ($pass_viejo != '' && $pass_nuevo != '') {
            $pass_viejo = md5($pass_viejo);

            $q = $this->db->select('id')
                    ->from('usuarios')
                    ->where('password', $pass_viejo)
                    ->where('nick', $_SESSION['usuario'])
                    ->get();

            if ($q->num_rows()) {
                $pass_nuevo = md5($pass_nuevo);

                $data_update = array('password' => $pass_nuevo);

                $this->db->where('id', $_SESSION['id_usuario']);
                $this->db->update('usuarios', $data_update);

                $this->session->set_flashdata('msg_ok', 'Se ha cambiado la contraseña satisfactoriamente.');

                redirect_lf1('perfil/editar_perfil');
            } else {
                $this->session->set_flashdata('msg_error', 'La contraseña actual no es correcta');
                redirect_lf1('perfil/editar_perfil');
            }
        }
        else
        {
            $this->session->set_flashdata('msg_error', 'La contraseña no puede estar vacia');
            redirect_lf1('perfil/editar_perfil');
        }
    }

    /**
     * Devuelve datos de visitantes del  perfil
     *
     * @return void
     * @author
     * */
    function get_visitas_perfil($id_perfil) {
        // Registros de visitas
        $res = $this->db->select('*')->from('perfil_visitas')
                ->where('id_visitado', $id_perfil)
                ->order_by('id', 'desc')
                ->get();

        $num_visitas = $res->num_rows();

        return $num_visitas;
    }

    /**
     * Obtiene nick y fotos de las ultimas visitas
     *
     * @return void
     * @author
     * */
    function get_ultimas_visitas_perfil($id_perfil, $limit = 7) {

        $q = $this->db->select('usuarios_avatar.avatar,usuarios.nick,perfil_visitas.fecha_visita')->from('perfil_visitas')
                ->join('usuarios_avatar', 'usuarios_avatar.id_usuario = perfil_visitas.id_visitante')
                ->join('usuarios', 'usuarios.id = perfil_visitas.id_visitante')
                ->where('id_visitado', $id_perfil)
                ->where('id_visitante !=', $id_perfil)
                ->order_by('fecha_visita', 'desc')
                ->limit($limit)
                ->get();


        return $q->result();
    }

    /**
     * Guarda el mensaje enviado al muro del perfil
     *
     * @return void
     * @author
     * */
    function guardar_firma($mensaje) {


        // Datos que guardaremos
        $id_from = $_SESSION['id_usuario'];
        $id_to = $mensaje['idperfil'];
        $loc = $mensaje['loc'];
        $mensaje = $mensaje['mensaje'];

        // Comprobamos que la sesion no haya expirado
        if (!$id_from)
            redirect_lf1('inicio');

        // Guardar en bd
        $data_insert = array(
            'id' => '',
            'id_to' => $id_to,
            'id_from' => $id_from,
            'texto' => $mensaje,
            'fecha' => date('Y-m-d H:i:s')
        );
        $this->db->insert('perfil_muro', $data_insert);

        // Preparar mensaje "enviado"
        $this->load->library('session');
        $this->session->set_flashdata('msgOK', 'Comentario enviado!');

        // Volver a la pagina del perfil
        $nick = $this->db->select('nick')->from('usuarios')->where('id', $id_to)->get()->row()->nick;

        if ($loc == 'boxes') {
            redirect_lf1('boxes');
        } else {
            redirect_lf1('usuarios/perfil/' . $nick);
        }
    }

    /**
     * Devuelve los mensajes  del muro
     *
     * @return void
     * @author
     * */
    function get_mensajes_muro($id_usuario, $max = 10) {
        $q = $this->db->select('perfil_muro.*,usuarios.nick')->from('perfil_muro')
                ->join('usuarios', 'usuarios.id = perfil_muro.id_from')
                ->where('id_to', $id_usuario)
                ->order_by('fecha', 'desc')
                ->limit($max)
                ->get();

        return $q->result();
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     * */
    function guardar_info_perfil($texto_informacion_perfil) {

        $id_usuario = $_SESSION['id_usuario'];
        $data_update = array(
            'info_perfil' => $texto_informacion_perfil
        );

        if (!$id_usuario)
            redirect_lf1('boxes/mi_perfil');

        $this->db->where('id', $id_usuario);
        $this->db->update('usuarios', $data_update);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     * */
    function get_posicion_ranking($id_perfil) {
        $sql = "SELECT
					avt.avatar ,res.puntos_manager_total_gp as puntos,
					usr.id,usr.nick,res.puesto_general as puesto_general
				FROM
					resultados_usuarios_2011 res,usuarios usr,usuarios_avatar avt
				WHERE
					res.id_usuario = usr.id
				AND
					res.id_usuario = avt.id_usuario
				AND
					res.id_usuario = ?
				ORDER BY
					id_gp DESC
				LIMIT
					0,1";
        $miClasificacion = $this->db->query($sql, array($id_perfil))->row()->puesto_general;
        return $miClasificacion;
    }

    /**
     * Devuelve ultimos usuarios logeados
     *
     * @return void
     * @author 
     * */
    function get_ultimos_usuarios_logeados($cuantos = 5, $html = true) {
        $this->db = $this->load->database('local', TRUE);

        $q = $this->db->select('*')
                ->from('usuarios')
                ->join('usuarios_avatar', 'usuarios_avatar.id_usuario = usuarios.id')
                ->order_by('fecha_ultimo_login', 'desc')
                ->limit(5)
                ->get();

        if ($html) {
            $usuarios = $q->result();

            foreach ($usuarios as $usuario) {

                $html = $html . '<div class="prog-row">
					                <div class="user-thumb">
					                    <a href="#"><img src="' . base_url() . 'img/avatares/thumbs/' . $usuario->avatar . '" alt=""></a>
					                </div>
					                <div class="user-details">
					                    <h4><a href="' . site_url() . 'perfil/ver/' . $usuario->nick . '">' . $usuario->nick . '</a></h4>
					                    <p>
					                        ' . timeago(strtotime($usuario->fecha_ultimo_login)) . '
					                    </p>
					                </div>
					                <div class="user-status text-danger">
					                    <i class="fa fa-comments-o"></i>
					                </div>
					            </div>';
            }

            return $html;
        } else {
            return $q;
        }
    }

    //Funcion que devuelve los datos de una comunidad
    function obtenerComunidad($idComunidad) {
        $sql = "SELECT * FROM comunidades where id = ?";
        return $this->db->query($sql, array($idComunidad))->row();
    }

    function obtenerAvatar($idUsuario) {
        $sql = "SELECT * FROM usuarios_avatar where id_usuario = ?";
        return $this->db->query($sql, array($idUsuario));
    }

    /**
     * Comprobar  que este en el grupo de su comunidad autonoma
     *
     * @return void
     * @author 
     **/
    function check_comunidad_autonoma($id_usuario)
    {
        $id_comunidad = $this->db->select('id_comunidad')->from('usuarios')->where('id',$id_usuario)->get()->row()->id_comunidad;

        if($id_comunidad == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    function completar_registro($id_comunidad)
    {

        $id_grupo = $this->db->select('id_grupo')->from('comunidades')->where('id',$id_comunidad)->get()->row()->id_grupo;

        // Añadir el id comunidad al usuario        
        $data_update = array('id_comunidad' => $id_comunidad);

        $this->db->where('id',$_SESSION['id_usuario']);
        $this->db->update('usuarios',$data_update);

        // Agregar al usuario al grupo de miemrbros
        $data_insert = array( 'id'          => '',
                              'id_usuario'  => $_SESSION['id_usuario'],
                              'id_grupo'    => $id_grupo
                            );
        $this->db->insert('grupos_miembros',$data_insert);

        redirect_lf1('dashboard');
    }


    /**
     * Generar codigo Manager
     *
     * @return void
     * @author 
     **/
    function get_codigo_manager( $id_usuario )
    {
        $q = $this->db->select('codigo_manager')
                      ->from('usuarios_codigo_manager')
                      ->where('id_usuario',$id_usuario)
                      ->get();

        if( $q->num_rows() )
        {
            return $q->row()->codigo_manager;
        }
        else
        {
            // No tiene codigo manager, hay que generarle uno unico

            // Generaremos codigos, hasta que sea unico
            // normalmente a la primera sera unico, pero hay
            // una remota posibilidad de  que se genere un codigo
            // que ya existe en base de datos.En tal caso generaremos uno nuevo
            // hasta  asegurarnos de que sea unico.
            $no_unico = true;

            do{
                $codigo_manager = generar_codigo();
                $q = $this->db->select('id')
                      ->from('usuarios_codigo_manager')
                      ->where('codigo_manager',$codigo_manager)
                      ->get();
                
                if(!$q->num_rows())
                {
                    $data_insert = array(
                                            'id'                =>              '',
                                            'id_usuario'        =>              $id_usuario,
                                            'codigo_manager'    =>              $codigo_manager
                                            );

                    $this->db->insert('usuarios_codigo_manager',$data_insert);
                    $no_unico = false;
                }

                    
            }while($no_unico);

            
            return $codigo_manager;
        }
    }

    /**
     * Devuelve toda la info de un usuario
     *
     * @return void
     * @author 
     **/
    function get_info_usuario( $id_usuario )
    {
        $this->load->model('estadisticas/estadisticas_model');

        // Info basica
        $datos['info_usuario'     ] = $this->db->select('*')->from('usuarios')->where('id',$id_usuario)->get()->row();
        // Comunidad
        $datos['comunidad_usuario'] = $this->db->select('nombre')->from('comunidades')->where('id',$datos['info_usuario']->id_comunidad)->get()->row()->nombre;
        // Ultimas visitas
        $datos['ultimas_visitas'  ] = $this->get_ultimas_visitas_perfil($id_usuario);
        // Muro usuario
        $datos['muro'             ] = $this->get_mensajes_muro($id_usuario);
        // Posicion ranking general del usuario
        $datos['posicionRanking'  ] = $this->get_posicion_ranking($id_usuario);
        // Estadisticas del usuario y el visitante del perfil (si logeado)
        $datos['full_stats'       ] = $this->estadisticas_model->get_full_stats($id_usuario);
        // Obtener avatar usuario
        $datos['avatar'           ] = $this->userAvatar($id_usuario);
        // Obtener inversion ultimos dias
        $datos['inversion'        ] = $this->estadisticas_model->get_inversion_compras(7,$id_usuario);
        // Obtener inversion ultimos dias
        $datos['ganancias'        ] = $this->estadisticas_model->get_ganancias_ventas(7,$id_usuario);
        // Obtener numero de mensjes en Hall of fame
        $datos['hof_num_mensajes' ] = $this->estadisticas_model->get_hof_num_mensajes($id_usuario);



        return $datos;
    }

    /**
     * HALL OF FAME - Obtener preguntas
     *
     * @return void
     * @author 
     **/
    function get_hof_pregunta($id_hof=false)
    {
        if(!$id_hof)
        {

            $pregunta = $this->db->select('id,pregunta')
                          ->from('hof_preguntas')
                          ->where('activa',1)
                          ->get()
                          ->row();
                          
        }
        else
        {
            $pregunta = $this->db->select('id,pregunta')
                          ->from('hof_preguntas')
                          ->where('id',$id_hof)
                          ->get()
                          ->row();
                          
        }

        return $pregunta;
    }

    /**
     * HALL OF FAME - Obtener respuestas
     *
     * @return void
     * @author 
     **/
    function get_hof_respuestas( $id_hof = false)
    {
        if(!$id_hof)
        {

            $id_hof = $this->db->select('id')
                          ->from('hof_preguntas')
                          ->where('activa',1)
                          ->get()
                          ->row()
                          ->id;
        }

        $respuestas = $this->db->select('hof_respuestas.respuesta,hof_respuestas.fecha,hof_respuestas.id_hof,usuarios.id,usuarios.nick,usuarios_avatar.avatar')
                               ->from('hof_respuestas')
                               ->join('usuarios','usuarios.id = hof_respuestas.id_usuario')
                               ->join('usuarios_avatar','usuarios_avatar.id_usuario = usuarios.id')
                               ->where('id_hof',$id_hof)
                               ->order_by('hof_respuestas.id','desc')
                               ->limit(25)
                               ->get()
                               ->result();

        return $respuestas;


    }

    /**
     * Inserta la respuesta de hall of fame
     *
     * @return void
     * @author 
     **/
    function add_hof_respuesta($id_hof,$respuesta,$id_usuario, $return = false)
    {
        $data_insert = array(
                            'id'          =>          '',
                            'id_usuario'  =>         $id_usuario,
                            'id_hof'      =>         $id_hof,
                            'respuesta'   =>         $respuesta,
                            'fecha'       =>        date('Y-m-d H:i:s')
                            );
        $this->db->insert('hof_respuestas',$data_insert);

        if($return)
        {
            $id_hof_respuesta = $this->db->insert_id();

            $q = $this->db->select('hof_respuestas.respuesta,hof_respuestas.fecha,hof_respuestas.id_hof,usuarios.id,usuarios.nick,usuarios_avatar.avatar')
                               ->from('hof_respuestas')
                               ->join('usuarios','usuarios.id = hof_respuestas.id_usuario')
                               ->join('usuarios_avatar','usuarios_avatar.id_usuario = usuarios.id')
                               ->where('hof_respuestas.id',$id_hof_respuesta)
                               ->get()
                               ->row();
            return $q;
        }
    }

}
