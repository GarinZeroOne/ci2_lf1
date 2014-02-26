<?php

class Movimientos_mercado_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getDatosFichajesPilotos($fecha) {
        $sql = "SELECT * FROM fichajes_pilotos WHERE fecha = ?";

        $result = $this->db->query($sql, array($fecha));

        return $result;
    }

    function getDatosFichajesPiloto($fecha, $idPiloto) {
        $sql = "SELECT * FROM fichajes_pilotos "
                . "WHERE fecha = ? "
                . "AND id_piloto = ?";

        $result = $this->db->query($sql, array($fecha, $idPiloto));

        return $result;
    }

    function getDatosVentasPilotos($fecha) {
        $sql = "SELECT * FROM ventas_pilotos WHERE fecha = ?";

        $result = $this->db->query($sql, array($fecha));

        return $result;
    }

    function getDatosVentasPiloto($fecha, $idPiloto) {
        $sql = "SELECT * FROM ventas_pilotos "
                . "WHERE fecha = ? "
                . "AND id_piloto = ?";

        $result = $this->db->query($sql, array($fecha, $idPiloto));

        return $result;
    }

    function getPorcentajeCambioValorMovimientosPilotos($porcentajeTotal, $porcentajePropio) {
        $sql = "SELECT * FROM cambio_valor_movimientos_pilotos 
                WHERE porcentaje_movimientos_totales <= ?
                AND porcentaje_movimientos_propios <= ?
                ORDER BY porcentaje_movimientos_totales DESC, 
                porcentaje_movimientos_propios DESC
                LIMIT 1";
        
        $result = $this->db->query($sql, array($porcentajeTotal, $porcentajePropio));

        return $result;
    }

}
