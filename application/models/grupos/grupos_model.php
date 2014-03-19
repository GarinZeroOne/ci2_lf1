<?php

class Grupos_model extends CI_Model {

    function Grupos_model() {
        parent::__construct();

        $this->db->query("SET OPTION SQL_BIG_SELECTS=1");
    }

    function insertGrupo($datos) {

        // Configuracion privacidad
        $privacidad = 0;

        if($datos['privacidad']=='on')
        {
            $privacidad = 1;
        }


        $sql = "INSERT INTO usuarios_grupos VALUES (?,?,?,?,?,?,?)";
        $query = $this->db->query($sql, array('', $_SESSION['id_usuario'], strip_tags($datos['nombre_grupo']),$datos['descripcion_grupo'],'',date('Y-m-d H:i:s'),$privacidad));

        return $this->db->insert_id();
    }

    function obtenerGrupoPropietario() {
        $sql = "SELECT * FROM usuarios_grupos WHERE id_usuario_creador = ? ";
        $grupos = $this->db->query($sql, array($_SESSION['id_usuario']));

        return $grupos;
    }

    function comprobarUsuarioGrupo($idUsuario, $idGrupo) {
        $sql = "SELECT * FROM grupos_miembros WHERE id_usuario = ?
            AND id_grupo = ?";
        $grupos = $this->db->query($sql, array($idUsuario, $idGrupo));

        return $grupos;
    }

    function insertGrupoUsuario($idGrupo, $idUsuario) {
        //Se inserta el usuario creador en grupos_miembros
        $sql = "INSERT INTO grupos_miembros VALUES (?,?,?,?)";
        $query = $this->db->query($sql, array('', $idUsuario, $idGrupo,date('Y-m-d h:i:s')));

        //Se inserta la invitacion en usuarios_invitaciones
        //$sql = "INSERT INTO usuarios_invitaciones VALUES (?,?,?,?,?)";
        //$query = $this->db->query($sql, array('', $idGrupo, $idUsuario, $idUsuario, 'A'));
    }

    function guardar_imagen_grupo($idGrupo,$imagen_grupo)
    {
        $data_update = array('imagen' => $imagen_grupo);
        $this->db->where('id',$idGrupo);
        $this->db->update('usuarios_grupos',$data_update);
    }

    function insertInvitacion($idGrupo, $idUsuarioCreador, $idUsuario) {
        $sql = "INSERT INTO usuarios_invitaciones VALUES (?,?,?,?,?)";
        $query = $this->db->query($sql, array('', $idGrupo, $idUsuarioCreador, $idUsuario, 'P'));
    }

    //Funcion que obtiene las invitaciones realizadas por el usuario creador
    function obtenerInvitacionesRealizadas($estadoInvitacion) {
        $sql = "SELECT usuarios_invitaciones.*,usuarios.nick
				FROM usuarios_invitaciones,usuarios
		 		WHERE usuarios_invitaciones.id_usuario = usuarios.id
				AND usuarios_invitaciones.id_usuario_creador = ?
				AND usuarios_invitaciones.estado = ?";
        $invitaciones = $this->db->query($sql, array($_SESSION['id_usuario'], $estadoInvitacion));

        return $invitaciones;
    }

    function obtenerUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $usarios = $this->db->query($sql)->result();

        return $usuarios;
    }

    function comprobarUsuario($nick) {
        $sql = "SELECT * FROM usuarios WHERE nick = ?";
        $usuario = $this->db->query($sql, array($nick));

        return $usuario;
    }

    //Funcion que devuelve las invitaciones recibidas
    function obtenerInvitacionesRecibidas($estadoInvitacion) {
        $sql = "SELECT usuarios.nick, usuarios_grupos.nombre,usuarios_invitaciones.id
		 		FROM usuarios_invitaciones,usuarios,usuarios_grupos
		 		WHERE usuarios_invitaciones.id_usuario_creador = usuarios.id
				AND usuarios_invitaciones.id_grupo = usuarios_grupos.id
				AND usuarios_invitaciones.id_usuario = ? AND usuarios_invitaciones.estado = ?";
        $invitacionesRecibidas = $this->db->query($sql, array($_SESSION['id_usuario'], $estadoInvitacion))->result();

        return $invitacionesRecibidas;
    }

    function obtenerInvitacionUsuarioGrupo($idUsuario, $estado, $idGrupo) {
        $sql = "SELECT * FROM usuarios_invitaciones
                WHERE id_usuario = ?
                AND estado = ?
                AND id_grupo = ? ";

        $invitacionesUsuarioGrupo = $this->db->query($sql, array($idUsuario, $estado, $idGrupo));

        return $invitacionesUsuarioGrupo;
    }

    //Funcion que obtiene los miembros del grupo del creador
    function obtenerMiembros($idGrupo) {
        $sql = "SELECT usuarios.nick,usuarios.id FROM grupos_miembros,usuarios_grupos,usuarios
				WHERE grupos_miembros.id_grupo = usuarios_grupos.id
				AND grupos_miembros.id_usuario = usuarios.id
				AND usuarios_grupos.id_usuario_creador = ?
				AND grupos_miembros.id_grupo = ?";
        $miembrosGrupo = $this->db->query($sql, array($_SESSION['id_usuario'], $idGrupo))->result();

        return $miembrosGrupo;
    }

    //Funcion que devuelve el numero de grupos de los que es miembro un usuario
    function obtenerGrupos($idUsuario) {
        $sql = "SELECT * FROM grupos_miembros WHERE id_usuario = ? ORDER BY id_grupo";
        $gruposMiembro = $this->db->query($sql, array($idUsuario));

        return $gruposMiembro;
    }

    //Funcion que acepta la invitacion
    function aceptaInvitacion($idInvitacion) {
        //Se obtienen los datos de las invitaciones
        $sql = "SELECT * FROM usuarios_invitaciones WHERE id = ?";
        $invitacion = $this->db->query($sql, array($idInvitacion))->row();

        //Se inserta el usuario en el grupo
        $sql = "INSERT INTO grupos_miembros VALUES (?,?,?)";
        $this->db->query($sql, array('', $invitacion->id_usuario, $invitacion->id_grupo));

        //Se modifica el estado de la peticion
        $sql = "UPDATE usuarios_invitaciones SET estado = 'A' WHERE id = ?";
        $this->db->query($sql, array($idInvitacion));
    }

    function datosInvitacion($idInvitacion) {
        //Se obtienen los datos de las invitaciones
        $sql = "SELECT * FROM usuarios_invitaciones WHERE id = ?";
        $invitacion = $this->db->query($sql, array($idInvitacion))->row();
        return $invitacion;
    }

    //Funcion que rechaza la invitacion
    function rechazaInvitacion($idInvitacion) {

        //Se modifica el estado de la peticion
        $sql = "UPDATE usuarios_invitaciones SET estado = 'R' WHERE id = ?";
        $this->db->query($sql, array($idInvitacion));
    }

    function gruposRankingGP($idGrupo) {
        // Se obtiene el id del GP
        $sql = "SELECT id,fecha FROM circuitos WHERE fecha <= ?
		 		order by fecha desc limit 0,1 ";
        $idGP = $this->db->query($sql, array(date('Y-m-d')))->row()->id;

        $sql = "SELECT res.*,usr.nick,avt.avatar
			FROM resultados_usuarios_2011 res,usuarios usr,usuarios_avatar avt,grupos_miembros grm
			WHERE res.id_usuario = usr.id
			AND res.id_usuario = avt.id_usuario
			AND usr.id = grm.id_usuario
			AND res.id_gp = ?
			AND grm.id_grupo = ?
			GROUP BY res.id_usuario
			ORDER BY res.puesto_gp";


        $clasificacion = $this->db->query($sql, array($idGP, $idGrupo));

        return $clasificacion;
    }

    function gruposRankingGeneral($idGrupo) {

        $sql_id_gp = "SELECT * FROM circuitos where procesado = 1 order by id DESC limit 0,1";

        $idGp = $this->db->query($sql_id_gp)->row()->id;

        $sql = "SELECT avt.avatar ,res.puntos_manager_total_gp as puntos,usr.id,usr.nick,
                                res.puesto_general
			FROM resultados_usuarios_2011 res,usuarios usr,usuarios_avatar avt,grupos_miembros grm
			WHERE res.id_usuario = usr.id
			AND res.id_usuario = avt.id_usuario
			AND usr.id = grm.id_usuario
			AND grm.id_grupo = ?
                        AND res.id_gp = ?
			GROUP BY usr.id
			ORDER BY puesto_general ";

        $clasificacion = $this->db->query($sql, array($idGrupo, $idGp));

        return $clasificacion;
    }

    //Funcion que devuelve el nombre del grupo
    function obtenerNombreGrupo($idGrupo) {
        $sql = "SELECT * FROM usuarios_grupos WHERE id = ?";
        $grupo = $this->db->query($sql, array($idGrupo))->row();

        return $grupo;
    }

    //Funcion que borra un grupo de todas las tablas
    function borraGrupo($idGrupo) {
        $sql = "DELETE FROM usuarios_grupos WHERE id = ?";
        $this->db->query($sql, array($idGrupo));

        $sql = "DELETE FROM usuarios_invitaciones WHERE id_grupo = ?";
        $this->db->query($sql, array($idGrupo));

        $sql = "DELETE FROM grupos_miembros WHERE id_grupo = ?";
        $this->db->query($sql, array($idGrupo));
    }

    //Funcion que borra un grupo de todas las tablas
    function borrarUsuarioGrupo($idGrupo, $idUsuario) {
        $sql = "DELETE FROM grupos_miembros WHERE id_grupo = ?
            AND id_usuario = ?";
        $this->db->query($sql, array($idGrupo, $idUsuario));
    }

    //PETICIONES//
    //Funcion que obtiene la lista de los grupos menos los del usuario
    function obtenerListaGruposNoPropios() {
        $sql = "SELECT usuarios_grupos.id , usuarios_grupos.nombre, usuarios.nick
			FROM usuarios_grupos,usuarios
			WHERE usuarios_grupos.id_usuario_creador = usuarios.id
			AND id_usuario_creador <> ?
                        ORDER BY usuarios_grupos.nombre";
        $listaGrupos = $this->db->query($sql, array($_SESSION['id_usuario']))->result();

        return $listaGrupos;
    }

    //Funcion que inserta una nueva peticion
    function insertaPeticion($idGrupo) {
        //Se comprueba si ya tiene alguna peticion realizada para ese grupo
        $sql = "SELECT * FROM usuarios_peticiones WHERE id_grupo = ?
					AND id_usuario = ? AND estado <> ? ";

        $tienePeticion = $this->db->query($sql, array($idGrupo, $_SESSION['id_usuario'], 'R'))->num_rows();

        if ($tienePeticion == 0) {
            //Si no tiene peticion se inserta
            $sql = "INSERT INTO usuarios_peticiones VALUES (?,?,?,?);";
            $this->db->query($sql, array('', $idGrupo, $_SESSION['id_usuario'], 'P'));
        }
    }

    //Funcion que devuelve el listado de peticiones en espera
    function obtenerPeticionesRealizadas() {
        $sql = "SELECT usuarios_peticiones.id,usuarios_grupos.nombre FROM usuarios_peticiones,usuarios_grupos
			WHERE usuarios_peticiones.id_grupo = usuarios_grupos.id
			AND usuarios_peticiones.id_usuario = ? AND usuarios_peticiones.estado = ?";

        $listaPeticiones = $this->db->query($sql, array($_SESSION['id_usuario'], 'P'))->result();

        return $listaPeticiones;
    }

    //Funcion que devuelve el listado de peticiones recibidas
    function obtenerPeticionesRecibidas() {
        $sql = "SELECT usuarios_peticiones.id, usuarios_grupos.nombre, usuarios.nick
			FROM usuarios_peticiones,usuarios,usuarios_grupos
			WHERE usuarios_peticiones.id_usuario = usuarios.id
			AND usuarios_peticiones.estado = ?
			AND usuarios_grupos.id = usuarios_peticiones.id_grupo
			AND usuarios_peticiones.id_grupo IN
			(SELECT id FROM usuarios_grupos WHERE id_usuario_creador = ?)";

        $listaPeticiones = $this->db->query($sql, array('P', $_SESSION['id_usuario']))->result();

        return $listaPeticiones;
    }

    //Funcion que acepta una peticion
    function aceptaPeticion($idPeticion) {
        //Se obtienen los datos de la peticion
        $sql = "SELECT * FROM usuarios_peticiones WHERE id = ?";
        $peticion = $this->db->query($sql, array($idPeticion))->row();

        //Se inserta el usuario en el grupo
        $sql = "INSERT INTO grupos_miembros VALUES (?,?,?)";
        $this->db->query($sql, array('', $peticion->id_usuario, $peticion->id_grupo));

        //Se inserta una invitacion para controlar el numero de grupos de los que se es miembro
        $sql = "SELECT id_usuario_creador FROM usuarios_grupos WHERE id = ?";
        $idUsuarioCreador = $this->db->query($sql, array($peticion->id_grupo))->row();

        $sql = "INSERT INTO usuarios_invitaciones VALUES (?,?,?,?,?)";
        $this->db->query($sql, array('', $peticion->id_grupo, $idUsuarioCreador->id_usuario_creador, $peticion->id_usuario, 'A'));

        //Se actualiza el estado de la peticion
        $sql = "UPDATE usuarios_peticiones SET estado = ? WHERE id = ?";
        $this->db->query($sql, array('A', $idPeticion));
    }

    //Funcion que rechaza una petcion
    function rechazaPeticion($idPeticion) {
        //Se modifica el estado de la peticion
        $sql = "UPDATE usuarios_peticiones SET estado = 'R' WHERE id = ?";
        $this->db->query($sql, array($idPeticion));
    }

    //Funcion que comprueba si existe un grupo
    function existeGrupo($nombreGrupo) {
        //Se modifica el estado de la peticion
        $sql = "SELECT * FROM usuarios_grupos WHERE nombre = ?";
        $numeroGrupos = $this->db->query($sql, array($nombreGrupo))->num_rows();
        if ($numeroGrupos > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Funcion que inserta mensajes en los grupos.
    // 2014 - Notificaciones - Menciones
    function insertMensajes($idGrupo, $contenido, $return = false) {

        // Si no llega el idGrupo ->GTFO!!
        if(!is_numeric($idGrupo)){return 'No se ha podido enviar el mensaje';}

        // Creamos el identificador del mensaje en el grupo #1 #2 #3...
        $q = $this->db->select('id_mensaje')
                                     ->from('grupos_mensajes')
                                     ->where('id_grupo',$idGrupo)
                                     ->get();
        $id_mensaje_grupo = $q->num_rows() + 1;

        // Insertar registro
        $sql = "INSERT INTO grupos_mensajes VALUES (?,?,?,?,?,?)";
        $this->db->query($sql, array('', $idGrupo,$id_mensaje_grupo, $_SESSION['id_usuario'], $contenido, date('Y-m-d H:i:s')));

        // Guardo el id para devolver los datos en caso de return=true
        $id_mensaje_nuevo = $this->db->insert_id();

        //Nombre del grupo
        $nombre_grupo = $this->db->select('nombre')->from('usuarios_grupos')->where('id',$idGrupo)->get()->row()->nombre;

        // ALERTA: Notificamos a los usuarios cuando ha habido mensajes nuevos
        $miembros = $this->db->select('id_usuario')
                             ->from('grupos_miembros')
                             ->where('id_grupo',$idGrupo)
                             ->where('id_usuario  !=', $_SESSION['id_usuario'] )
                             ->get()->result();

        foreach($miembros as $miembro)
        {
            $existe = $this->db->select('id')->from('usuarios_alertas')->where('id_grupo',$idGrupo)->where('id_usuario',$miembro->id_usuario)->get()->row()->id;


            if($existe){
                $data_update = array('leida' => 0,'fecha_modificada' => date('Y-m-d H:i:s'));

                $this->db->where('id_grupo',$idGrupo)->where('id_usuario',$miembro->id_usuario);
                $this->db->update('usuarios_alertas',$data_update);
            }
            else
            {
                $data_insert = array(
                                        'id'            =>          '',
                                        'id_usuario'    =>          $miembro->id_usuario,
                                        'id_grupo'      =>          $idGrupo,
                                        'tipo_alerta'   =>          'grupo',
                                        'texto'         =>          'Hay mensajes nuevos en el grupo '.$nombre_grupo,
                                        'leida'         =>          0,
                                        'fecha_creada'  =>          date('Y-m-d H:i:s'),
                                        'fecha_modificada'  =>          date('Y-m-d H:i:s')
                                        );

                $this->db->insert('usuarios_alertas',$data_insert);
            }

        }

        // Menciones
        // Buscamos #xxx en la cadena
        if (preg_match_all('/#\d+/', $contenido,$coincidencias)) 
        {    
            foreach($coincidencias[0] as $c)
            {
                $id_mensaje_mencion = substr($c, 1);

                // Buscar que usuario escribio ese mensaje
                $id_usuario_mencion = $this->db->select('id_usuario')
                                               ->from('grupos_mensajes')
                                               ->where('id_mensaje_grupo',$id_mensaje_mencion)
                                               ->where('id_grupo',$idGrupo)
                                               ->get()
                                               ->row()
                                               ->id_usuario;

                // Crear alerta al usuario mencionado
                $mencion_insert = array(
                                        'id'            =>          '',
                                        'id_usuario'    =>          $id_usuario_mencion,
                                        'id_grupo'      =>          $idGrupo,
                                        'tipo_alerta'   =>          'mencion',
                                        'texto'         =>          'El usuario '.$_SESSION['usuario'].' te ha mencionado en el grupo '.$nombre_grupo.'. Mensaje #'.$id_mensaje_mencion.' => #'.$id_mensaje_grupo,
                                        'leida'         =>          0,
                                        'fecha_creada'  =>          date('Y-m-d H:i:s'),
                                        'fecha_modificada'  =>          date('Y-m-d H:i:s')
                                        );

                $this->db->insert('usuarios_alertas',$mencion_insert);                                      
            }

            
        }

        if($return)
        {
            $sql = "SELECT gm.*,u.nick,ug.nombre, ua.avatar
                FROM grupos_mensajes gm, usuarios u , usuarios_grupos ug ,usuarios_avatar ua
                WHERE gm.id_grupo = ug.id
                AND gm.id_usuario = u.id
                AND gm.id_usuario = ua.id_usuario
                AND gm.id_mensaje = ?
                ";

            $q = $this->db->query($sql, array($id_mensaje_nuevo))->row();

            return $q;
        }


    }

    function obtenerMensajes($idGrupo) {

        $sql = "SELECT gm.*,u.nick,ug.nombre, ua.avatar
                FROM grupos_mensajes gm, usuarios u , usuarios_grupos ug ,usuarios_avatar ua
                WHERE gm.id_grupo = ug.id
                AND gm.id_usuario = u.id
                AND gm.id_usuario = ua.id_usuario
                AND gm.id_grupo = ?
                ORDER BY gm.id_mensaje DESC
                LIMIT 0,10";
        $mensajes = $this->db->query($sql, array($idGrupo));

        return $mensajes;
    }

    /**
     * Obtiene mensajes con orden desc/asc
     *
     * @return void
     * @author 
     **/
    function obtener_mensajes($idGrupo, $modo = 'asc',$num_mensajes_mostrar = 15) {

        // Total mensajes
        $num_mensajes_totales = $this->db->select('id_mensaje')->from('grupos_mensajes')->where('id_grupo',$idGrupo)->get()->num_rows();

        // Mostrar desde
        $limit_from = $num_mensajes_totales - $num_mensajes_mostrar;
        // Asegurarnos de que nunca sea negativo
        if($limit_from<0)  $limit_from = 0;

        $sql = "SELECT gm.*,u.nick,ug.nombre, ua.avatar
                FROM grupos_mensajes gm, usuarios u , usuarios_grupos ug ,usuarios_avatar ua
                WHERE gm.id_grupo = ug.id
                AND gm.id_usuario = u.id
                AND gm.id_usuario = ua.id_usuario
                AND gm.id_grupo = ?
                ORDER BY gm.id_mensaje ".$modo."
                LIMIT ".$limit_from.",".$num_mensajes_mostrar."";

        $mensajes = $this->db->query($sql, array($idGrupo));

        return $mensajes;
    }

    ////////////////////////////////////////////////////////////////////////////
    //Funcion que devuelve el numero de grupos de los que es miembro un usuario
    function obtenerGruposUsuario($idUsuario) {
        /*
        $sql = "SELECT ug.*,gm.* FROM usuarios_grupos ug,grupos_miembros gm
            WHERE ug.id = gm.id_grupo
            AND gm.id_usuario = ? ORDER BY ug.id";
        */

        $id_grupos = $this->db->select('id_grupo')->from('grupos_miembros')->where('id_usuario',$idUsuario)->get()->result();

        $cadena = false;
        foreach($id_grupos as $id_grupo){
            
            if($cadena)
            {
                $cadena  .= ','.$id_grupo->id_grupo;   
            }
            else
            {
                $cadena .= $id_grupo->id_grupo;
            }
            
        }    

        $sql ="select count(gm.id) as cantidad,ug.* 
                from grupos_miembros gm ,usuarios_grupos ug
                where gm.id_grupo = ug.id
                AND id_grupo in ($cadena) 
                group by id_grupo ";

        $gruposUsuario = $this->db->query($sql);

        return $gruposUsuario;
    }

    /**
     * Devuelve los ultimos grupos publicos
     *
     * @return void
     * @author 
     **/
    function obtener_grupos_publicos()
    {
        $grupos = $this->db->select('usuarios_grupos.*,usuarios.nick')
                           ->from('usuarios_grupos')
                           ->join('usuarios','usuarios.id = usuarios_grupos.id_usuario_creador')
                           ->where('privado',0)
                           ->order_by('usuarios_grupos.fecha_creacion','DESC')
                           ->get()
                           ->result();
                           
        return $grupos;
    }

    /**
     * Setear como notificados todos los mensajes de este grupo
     *
     * @return void
     * @author
     **/
    function set_notificados($id_grupo, $id_usuario)
    {

        $estado = $this->db->select('id')->from('grupos_notificaciones')->where('id_usuario',$id_usuario)->where('id_grupo',$id_grupo)->where('aldia',0)->get();

        if($estado->num_rows())
        {
            $id_notificacion = $estado->row()->id;

            $data_update = array( 'aldia' => 1 );

            $this->db->where('id',$id_notificacion);
            $this->db->update('grupos_notificaciones',$data_update);
        }

    }


    /**
     * Obtiene 10 mensajes mas a partir del  id recibido
     *
     * @return void
     * @author 
     **/
    function obtener_mensajes_anteriores($id_ultimo_mensaje,$modo = 'asc',$num_mensajes_mostrar = 15)
    {

        // Id grupo
        $id_grupo = $this->db->select('id_grupo')->from('grupos_mensajes')->where('id_mensaje',$id_ultimo_mensaje)->get()->row()->id_grupo;

        // Total mensajes
        $num_mensajes_totales = $this->db->select('id_mensaje')->from('grupos_mensajes')->where('id_grupo',$id_grupo)->get()->num_rows();

        // Total ya mostrados
        $num_mostrados = $this->db->select('id_mensaje')->from('grupos_mensajes')
                                                        ->where('id_grupo',$id_grupo)
                                                        ->where('id_mensaje >',$id_ultimo_mensaje)
                                                        ->get()
                                                        ->num_rows();
        

        //
        $hueco_limit =  $num_mensajes_mostrar+$num_mostrados;

        
        // Mostrar desde
        $limit_from = $num_mensajes_totales - $hueco_limit;

        // Asegurarnos de que nunca sea negativo
        if($limit_from<0)  $limit_from = 0;
        

        $sql = "SELECT gm.*,u.nick,ug.nombre, ua.avatar
                FROM grupos_mensajes gm, usuarios u , usuarios_grupos ug ,usuarios_avatar ua
                WHERE gm.id_grupo = ug.id
                AND gm.id_usuario = u.id
                AND gm.id_usuario = ua.id_usuario
                AND gm.id_grupo = ?
                AND gm.id_mensaje < ?
                ORDER BY gm.id_mensaje ASC
                LIMIT ".$limit_from.",15";

        $mensajes = $this->db->query($sql, array($id_grupo,$id_ultimo_mensaje))->result();


        $mostrar_mas = true;

        foreach($mensajes as $mensaje)
        {
            if($mostrar_mas)
            {
                $texto .='<li><button onclick="ldp_mensajes()" class="btn btn-success btn-block" data-internal="'.$mensaje->id_mensaje.'" id="cargar-anteriores-btn"> Cargar mensajes anteriores </button></li>';
                $mostrar_mas = false;
            }
            

            if($mensaje->id_usuario == $_SESSION['id_usuario'])
            {
                $texto .='<li class="clearfix odd2">
                                <div class="chat-avatar">
                                    <img alt="female" width="40" src="'.base_url().'/img/avatares/thumbs/'.$mensaje->avatar.'">
                                    <i>'.timeago(strtotime($mensaje->fecha_mensaje)).'</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i><a class="num-msg-grp" onclick="citar(this)" data-msg-internal="'.$mensaje->id_mensaje_grupo.'" src="#">#'.$mensaje->id_mensaje_grupo.'</a> '.$mensaje->nick.'</i>
                                        <p>
                                            '.$mensaje->contenido.'
                                        </p>
                                    </div>
                                </div>
                            </li>';    
            }
            else
            {
                $texto .='<li class="clearfix">
                                <div class="chat-avatar">
                                    <img alt="female" width="40" src="'.base_url().'/img/avatares/thumbs/'.$mensaje->avatar.'">
                                    <i>'.timeago(strtotime($mensaje->fecha_mensaje)).'</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i><a class="num-msg-grp-b" onclick="citar(this)" data-msg-internal="'.$mensaje->id_mensaje_grupo.'" src="#">#'.$mensaje->id_mensaje_grupo.'</a> '.$mensaje->nick.'</i>
                                        <p>
                                            '.$mensaje->contenido.'
                                        </p>
                                    </div>
                                </div>
                            </li>';       
            }
            
        }

        return $texto;
    }


    /**
     * Existe le grupo?
     *
     * @return void
     * @author 
     **/
    function existe_grupo($id_grupo)
    {
        $q = $this->db->select('id')->from('usuarios_grupos')->where('id',$id_grupo)->get();

        if($q->num_rows())
            return true;
        else
            return false;
    }


    /**
     * Devuelve la informacion del grupo
     *
     * @return void
     * @author 
     **/
    function obtener_info_grupo($id_grupo)
    {
        $q = $this->db->select('usuarios_grupos.*,usuarios.nick')->from('usuarios_grupos')
                                    ->join('usuarios','usuarios.id = usuarios_grupos.id_usuario_creador')

                                    ->where('usuarios_grupos.id',$id_grupo)->get()->row();

        return $q;
    }

    /**
     * Devuelve el numero de usuarios
     *
     * @return void
     * @author 
     **/
    function get_num_usuarios_grupo($id_grupo)
    {
        $q = $this->db->select("id")->from('grupos_miembros')->where('id_grupo',$id_grupo)->get()->num_rows();

        return $q;
    }

    /**
     * Devuelve  true / false si esta o no en el grupo
     *
     * @return void
     * @author 
     **/
    function get_soy_miembro($id_grupo)
    {
        $q = $this->db->select('id')->from('grupos_miembros')->where('id_usuario',$_SESSION['id_usuario'])->where('id_grupo',$id_grupo)->get();

        if($q->num_rows())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Devuelve  true / false si es el admin
     *
     * @return void
     * @author 
     **/
    function get_soy_admin($id_grupo)
    {
        $q = $this->db->select('id')->from('usuarios_grupos')->where('id_usuario_creador',$_SESSION['id_usuario'])->where('id',$id_grupo)->get();

        if($q->num_rows())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }


    /**
     * Ingresar a un grupo publico
     *
     * @return void
     * @author 
     **/
    function ingresar_grupo_publico($id_grupo)
    {
        // Comprobar que no exista ya en  el grupo
        $miembro = $this->get_soy_miembro($id_grupo);

        // Comprobar privacidad del grupo
        $privado = $this->db->select('privado')->from('usuarios_grupos')->where('id',$id_grupo)->get()->row()->privado;

        if(!$miembro && !$privado)
        {
            $data_insert = array(
                                'id'            =>      '',
                                'id_usuario'    =>      $_SESSION['id_usuario'],
                                'id_grupo'      =>      $id_grupo,
                                'fecha_ingreso' =>      date('Y-m-d H:s:i')

                                    );

            $this->db->insert('grupos_miembros',$data_insert);


            $this->session->set_flashdata('msg_bienvenida','Bienvenido al grupo,suerte!');
            redirect_lf1('grupos/ver/'.$id_grupo);

        }
        else
        {
            redirect_lf1('grupos');
        }


    }

    /**
     * Abandonar un grupo
     *
     * @return void
     * @author 
     **/
    function abandonar_grupo($id_grupo)
    {

        // Comprobar que exista en el grupo
        $miembro = $this->get_soy_miembro($id_grupo);

        if($miembro)
        {
            // Comprobar  que no sea el grupo de su comunidad
            // No esta permitido abandonar grupo de comunidad
            $comunidad  = $this->db->select('id_grupo')->from('comunidades')->where('id_grupo',$id_grupo)->get()->num_rows();
            if($comunidad)
            {
                $this->session->set_flashdata('error_msg','No puedes abandonar el grupo de tu comunidad');
                redirect_lf1('grupos');
            }
            
            $this->db->where('id_grupo',$id_grupo);
            $this->db->where('id_usuario',$_SESSION['id_usuario']);
            $this->db->delete('grupos_miembros');
            //dump($this->db->queries());die;
        }
        
        redirect_lf1('grupos');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    function actualizar_datos_grupo($datos,$file)
    {
        if($datos['privacidad'])
        {
            $privacidad = 1;
        }
        else
        {
            $privacidad = 0;
        }

        $data_update = array(
                                'descripcion'       =>      $datos['descripcion_grupo'],
                                'privado'           =>      $privacidad
                                );
        $this->db->where('id',$datos['gid']);
        $this->db->update('usuarios_grupos',$data_update);

        /*IMAGEN DEL GRUPO*/
        if($file['userfile']['name'])
        {
            $config['upload_path'] = ROOT.'/img/grupos/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '200';
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
                redirect_lf1('grupos/configurar_grupo/'.$datos['gid']);
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
                $config['new_image'     ] = ROOT.'/img/grupos/thumbs/'.$nombre_archivo;
                $config['create_thumb'  ] = TRUE;
                $config['maintain_ratio'] = FALSE;
                $config['width'         ] = 80;
                $config['height'        ] = 80;
                $config['thumb_marker'  ] = '';

                $this->load->library('image_lib', $config);

                if ( ! $this->image_lib->resize())
                {
                    echo $this->image_lib->display_errors();
                }

                // Guardar imagen del grupo
                $this->grupos_model->guardar_imagen_grupo($datos['gid'],$nombre_archivo);

                redirect_lf1('grupos/configurar_grupo/'.$datos['gid']);
            }
        }
    }


    /**
     * Devuelve  todos los usuarios de un grupo + su info
     *
     * @return void
     * @author 
     **/
    function obtener_usuarios_grupo($id_grupo)
    {
        $q = $this->db->select('grupos_miembros.id,usuarios.nick,usuarios_avatar.avatar')
                                   ->from('grupos_miembros')
                                   ->join('usuarios','usuarios.id = grupos_miembros.id_usuario')
                                   ->join('usuarios_avatar','usuarios_avatar.id_usuario = usuarios.id')
                                   ->where('grupos_miembros.id_grupo',$id_grupo)
                                   ->where('grupos_miembros.id_usuario !=',$_SESSION['id_usuario'])
                                   ->get()
                                   ->result();
                                   //dump($this->db->queries);die;
        return $q;
        
    }


    /**
     * Eliminar a un usuario del grupo
     *
     * @return void
     * @author 
     **/
    function eliminar_usuario_grupo($id_registro_miembro)
    {

        $id_grupo = $this->db->select('id_grupo')->from('grupos_miembros')->where('id',$id_registro_miembro)->get()->row()->id_grupo;

        // Asegurarnos de que sea el admin del grupo
        $id_admin = $this->db->select('id_usuario_creador')->from('usuarios_grupos')->where('id',$id_grupo)->get()->row()->id_usuario_creador;

        // No es el admin?? GTFO!
        if($id_admin!=$_SESSION['id_usuario'])
        {
            redirect_lf1('grupos');
        }


        // Eliminar usuario del grupo
        $this->db->where('id',$id_registro_miembro);
        $this->db->delete('grupos_miembros');

        $this->session->set_flashdata('msg_ok','Usuario eliminado del grupo.');

        redirect_lf1('grupos/configurar_grupo/'.$id_grupo);
    }


    /**
     * Agrega  a un usuario a un grupo
     *
     * @return void
     * @author 
     **/
    function agregar_usuario_grupo($id_grupo,$codigo_manager)
    {
        $q = $this->db->select('id_usuario')->from('usuarios_codigo_manager')->where('codigo_manager',$codigo_manager)->get();

        if($q->num_rows())
        {
            $id_usuario = $q->row()->id_usuario;

            // Comprobar que no exista ya dentro del grupo
            $existe = $this->db->select('id')->from('grupos_miembros')->where('id_grupo',$id_grupo)->where('id_usuario',$id_usuario)->get()->num_rows();
            if($existe)
            {
                // No existe el codigo manager!
                $this->session->set_flashdata('msg_error','El usuario que has intentado introducir ya se encuentra dentro del grupo.');
                redirect_lf1('grupos/configurar_grupo/'.$id_grupo);
            }
            else
            {
                $data_insert = array(
                                    'id'            =>              '',
                                    'id_usuario'    =>              $id_usuario,
                                    'id_grupo'      =>              $id_grupo,
                                    'fecha_ingreso' =>              date('Y-m-d  H:i:s')
                                    );

                $this->db->insert('grupos_miembros',$data_insert);
                $this->session->set_flashdata('msg_ok','El usuario ha sido añadido.');

                redirect_lf1('grupos/configurar_grupo/'.$id_grupo);    
            }

            

        }
        else
        {
            // No existe el codigo manager!
            $this->session->set_flashdata('msg_error','El código introducido no es válido.Asegurate de haber introducido el código de manager y <b>no</b> el nick de usuario .');
            redirect_lf1('grupos/configurar_grupo/'.$id_grupo);
        }
    }
}

