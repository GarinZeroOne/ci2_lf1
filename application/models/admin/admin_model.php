<?php

class Admin_model extends CI_Model {

    function Admin_model() {
        parent::__construct();
    }

    function insertarCirtuito($cicuito, $pais, $fecha) {
        $sql = "INSERT INTO circuitos (circuito,pais,fecha,procesado)"
                . "VALUES (?,?,?,?)";
        $this->db->query($sql, array($cicuito, $pais, $fecha, 0));

        $idCircuito = $this->db->insert_id();

        $sql = "INSERT INTO boxes (id_circuito,fecha_abrir,fecha_cerrar)"
                . "VALUES (?,?,?)";

        $fechaAbrir = strtotime('+1 day', strtotime($fecha));
        $fechaAbrir = date('Y-m-d', $fechaAbrir);

        $fechaCerrar = strtotime('-2 day', strtotime($fecha));
        $fechaCerrar = date('Y-m-d', $fechaCerrar);

        $this->db->query($sql, array($idCircuito, $fechaAbrir, $fechaCerrar));
    }

    function vaciarCircuitos() {
        $sql = "TRUNCATE TABLE circuitos";
        $this->db->query($sql);

        $sql = "TRUNCATE TABLE boxes";
        $this->db->query($sql);
    }

    function insertarPosicionPiloto($idPiloto, $idGp, $posicion) {
        $sql = "INSERT INTO resultados_pilotos (id_piloto,id_gp,posicion,poleman)"
                . "VALUES (?,?,?,?)";
        $this->db->query($sql, array($idPiloto, $idGp, $posicion, 0));
    }

    function obtenerPilotoCodigo($code) {
        $sql = "SELECT * FROM pilotos WHERE code = ?";

        $result = $this->db->query($sql, array($code));

        return $result;
    }

    function obtenerPilotoDriverId($driverId) {
        $sql = "SELECT * FROM pilotos WHERE driverId = ?";

        $result = $this->db->query($sql, array($driverId));

        return $result;
    }

    function asignarPoleman($idPiloto, $idGp) {
        $sql = "UPDATE resultados_pilotos "
                . " SET poleman = ?"
                . " WHERE id_piloto = ?"
                . " AND id_gp = ?";

        $this->db->query($sql, array(1, $idPiloto, $idGp));
    }

    function obtenerOrdenEquiposGp($idGp) {
        $sql = "SELECT p.id_equipo, sum(pp.puntos) puntos
                FROM resultados_pilotos rp,pilotos p, puntos_posicion pp
                WHERE rp.id_piloto = p.id
                AND pp.posicion = rp.posicion
                AND rp.id_gp = ?
                GROUP BY p.id_equipo
                ORDER BY puntos desc , min(rp.posicion) asc";

        $result = $this->db->query($sql, array($idGp));

        return $result;
    }

    function insertarPosicionEquipo($idEquipo, $idGp, $posicion) {
        $sql = "INSERT INTO resultados_equipos (id_equipo,id_gp,posicion)"
                . "VALUES (?,?,?)";
        $this->db->query($sql, array($idEquipo, $idGp, $posicion));
    }

    function comprobarResultadosProcesados($idGp) {
        $sql = "SELECT * 
                FROM resultados_pilotos 
                WHERE id_gp = ?";

        return $this->db->query($sql, array($idGp));
    }

    function insertarClasificacionMundialPilotos($idPiloto, $puntos, $posicion) {
        $sql = "INSERT INTO clasificacion_mundial_pilotos (id_piloto,puntos,posicion)"
                . "VALUES (?,?,?)";
        $this->db->query($sql, array($idPiloto, $puntos, $posicion));
    }

    function borrarClasificacionMundialPilotos() {
        $sql = "TRUNCATE TABLE clasificacion_mundial_pilotos ";
        $this->db->query($sql);
    }
    
    function insertarClasificacionMundialEquipos($idEquipo, $puntos, $posicion) {
        $sql = "INSERT INTO clasificacion_mundial_equipos (id_equipo,puntos,posicion)"
                . "VALUES (?,?,?)";
        $this->db->query($sql, array($idEquipo, $puntos, $posicion));
    }

    function borrarClasificacionMundialEquipos() {
        $sql = "TRUNCATE TABLE clasificacion_mundial_equipos ";
        $this->db->query($sql);
    }
    
    function obtenerEquipoConstructorId($constructorId) {
        $sql = "SELECT * FROM equipos WHERE constructorId = ?";

        $result = $this->db->query($sql, array($constructorId));

        return $result;
    }

}
