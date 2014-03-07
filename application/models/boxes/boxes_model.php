<?php

class Boxes_model extends CI_Model {

    function Boxes_model() {
        parent::__construct();
    }

    function estado() {
        $hoy = date('Y-m-d');
        $sql = "SELECT * FROM boxes
						 WHERE
						 	? >= fecha_cerrar
						 AND
						 	? < fecha_abrir";
        $query = $this->db->query($sql, array($hoy, $hoy));

        if ($query->num_rows()) {
            return TRUE; // Boxes cerrados
        } else {
            return FALSE;  // Boxes abiertos
        }
    }

    function estadoFecha($fecha) {
        $sql = "SELECT * FROM boxes
                WHERE ? >= fecha_cerrar
                AND ? < fecha_abrir";
        
        $query = $this->db->query($sql, array($fecha, $fecha));

        if ($query->num_rows()) {
            return FALSE; // Boxes cerrados
        } else {
            return TRUE;  // Boxes abiertos
        }
    }

    /**
     * Devuelve el numero de estrelllas
     *
     * @return void
     * @author GorkaG
     * */
    function get_num_estrellas() {
        $query = $this->db->select_sum('num_estrellas')
                ->from('recompensa')
                ->where('estado', 'P')
                ->where('id_usuario', $_SESSION['id_usuario'])
                ->get();

        if ($query->num_rows()) {
            return $query->row()->num_estrellas;
        } else {
            return 0;
        }
    }

    /**
     * Devuelve el SRR de un usuario (veces que ha quedado top25)
     *
     * @return void
     * @author
     * */
    function get_srr() {
        $query = $this->db->select('id_recompensa')
                ->from('recompensa')
                ->where('id_usuario', $_SESSION['id_usuario'])
                ->where('estado', 'P')
                ->get();

        return $query->num_rows();
    }

    /**
     * Canjear estrellas
     *
     * @return void
     * @author
     * */
    function canjear_estrellas() {


        // Obtener SRR del usuario
        $srr = $this->get_srr();

        // GTFO
        if ($srr < 3)
            return 'Tu S.R.R no es lo suficientemente alto como para canjear tus estrellas, necesitas un S.R.R superior o igual a 3.';

        // El numero de estrellas va de 1-20 , siendo 1 media estrella
        // y 20 -> 10
        $num_estrellas = $this->get_num_estrellas();

        // Redondeamos abajo, porque solo valen las estrellas completas
        $estrellas_completas = floor($num_estrellas / 2);


        if ($estrellas_completas > 0) {

            $re = array(
                '1' => 45000,
                '2' => 60000,
                '3' => 100000,
                '4' => 170000,
                '5' => 290000,
                '6' => 400000,
                '7' => 520000,
                '8' => 660000,
                '9' => 790000,
                '10' => 1000000,
            );

            // Fix a posibles errores si el numero de estrellas es mayor a 10
            // Nunca deberia pasar pero como se esta haciendo primero esta parte a saber..:_)
            if ($estrellas_completas > 9) {
                $indice = 10;
            } else {
                $indice = $estrellas_completas;
            }

            // Ingresar dinero
            $sql = "UPDATE usuarios_banco SET fondos=fondos+? WHERE id_usuario=?";
            $this->db->query($sql, array($re[$indice], $_SESSION['id_usuario']));

            // Actualizar estado estrellas
            $data_update_estrellas = array('estado' => 'u',
                'fecha_utilizacion' => date('Y-m-d H:i:s')
            );

            $this->db->where('id_usuario', $_SESSION['id_usuario']);
            $this->db->where('estado', 'p');
            $this->db->update('recompensa', $data_update_estrellas);


            return "Estrellas canjeadas satisfactoriamente.";
        }
    }

    /**
     * Historico canjeadas
     *
     * @return void
     * @author
     * */
    function historico_estrellas() {
        $q = $this->db->select('*')->from('recompensa')
                ->join('circuitos', 'circuitos.id = recompensa.id_gp')
                ->where('id_usuario', $_SESSION['id_usuario'])
                ->where('estado', 'u')
                ->order_by('id_gp', 'desc')
                ->get();

        if ($q->num_rows()) {
            return $q->result();
        } else {
            return false;
        }
    }

    /**
     * Busca si el usuario tiene mensajes sin leer en algun grupo
     *
     * @return void
     * @author
     * */
    function notify_actividad_grupos() {

        $grupos = $this->db->where('id_usuario', $_SESSION['id_usuario'])->where('aldia', '0')->get('grupos_notificaciones');

        // Tiene grupos?
        if ($grupos->num_rows()) {

            if ($grupos->num_rows() == 1) {


                $nombre_grupo = $this->db->where('id', $grupos->row()->id_grupo)->get('usuarios_grupos')->row()->nombre;

                return "Tienes mensajes sin leer en el grupo " . $nombre_grupo;
            } else {
                return "Tienes mensajes sin leer en varios de tus grupos.";
            }
        } else {
            return false;
        }
    }

}
