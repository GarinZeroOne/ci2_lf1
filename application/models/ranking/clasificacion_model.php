<?php

class Clasificacion_model extends CI_Model {

    function Clasificacion_model() {
        parent::__construct();
    }

    function getClasificacionGeneralObject() {
        $idGp = $this->getUltimoGpConClasificacion();

        $sql = "SELECT * FROM resultados_usuarios_2011 
                WHERE id_gp = ?
                ORDER BY puesto_general
                LIMIT 25";

        $result = $this->db->query($sql, array($idGp))->result();

        $usuariosClasificacion = array();

        foreach ($result as $row) {
            $usuario = Usuario::getById($row->id_usuario);
            $usuarioClasificacion = new ClasificacionGeneralUsuario();
            $usuarioClasificacion->setUsuario($usuario);
            $usuarioClasificacion->setPosicion($row->puesto_general);
            $usuarioClasificacion->setPuntos($row->puntos_manager_total_gp);
            if ($idGp != 0) {
                $idGpAnterior = $this->getGpAnterior();                                
                $usuarioClasificacion->setPosicionAnterior
                        ($this->getDatosClasificacionUsuario($usuario->getIdUsuario(), $idGpAnterior)->row()->puesto_general);
            }
            
            $usuariosClasificacion[] = $usuarioClasificacion;
        }
        
        return $usuariosClasificacion;
    }

    function getUltimoGpConClasificacion() {
        $sql = "select max(id_gp) idGp from resultados_usuarios_2011 ";

        $result = $this->db->query($sql);

        if ($result->num_rows() > 0) {
            return $result->row()->idGp;
        }

        return 0;
    }

    function getGpAnterior() {
        $sql = "select max(id_gp) idGp from resultados_usuarios_2011 ";

        $result = $this->db->query($sql);

        if ($result->num_rows() > 0) {
            return $result->row()->idGp - 1;
        }

        return 0;
    }

    function getDatosClasificacionUsuario($idUsuario, $idGp) {

        if ($idGp == 0) {
            $idGp = $this->getUltimoGpConClasificacion();
        }

        $sql = "SELECT * FROM resultados_usuarios_2011 
                WHERE id_gp = ?
                AND id_usuario = ?";

        $result = $this->db->query($sql, array($idGp, $idUsuario));

        return $result;
    }

}
