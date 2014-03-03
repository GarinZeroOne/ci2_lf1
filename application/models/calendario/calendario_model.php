<?php

class Calendario_model extends CI_Model {

    private $ci;

    function Calendario_model() {
        parent::__construct();
        $this->ci = & get_instance();
    }

    function obtenerCircuitos() {

        // Obtener los datos de los circuitos
        $sql = "SELECT * FROM circuitos";
        $resultado = $this->db->query($sql)->result();

        return $resultado;
    }
    
    function obtenerCircuitosObject() {

        // Obtener los datos de los circuitos
        $sql = "SELECT * FROM circuitos";
        $resultado = $this->db->query($sql)->result();

        $circuitos = array();
        
        foreach($resultado as $row){
            $circuitos[] = new Circuito($row->id);
        }
        
        return $circuitos;
    }

    function obtenerPaisDelSiguienteGp() {

        $hoy = date('Y-m-d');

        $sql = "SELECT pais,fecha FROM circuitos WHERE fecha > '{$hoy}' ORDER BY fecha ASC LIMIT 0,1";
        return $this->db->query($sql)->row();
    }

    function obtenerCircuitoAProcesar() {
        $noProcesado = 0;

        $sql = "SELECT * FROM circuitos
                WHERE procesado = ?
                ORDER BY id LIMIT 0,1";

        return $this->db->query($sql, array($noProcesado));
    }

    function obtenerCircuitosSinProcesar() {
        $noProcesado = 0;

        $sql = "SELECT * FROM circuitos
				WHERE procesado = ?
                                ORDER BY id";
        $Q = $this->db->query($sql, array($noProcesado));

        return $Q->result();
    }

    function getNextGP() {

        $hoy = date('Y-m-d');

        $sql = "SELECT * FROM circuitos WHERE fecha > '{$hoy}'
                        ORDER BY fecha ASC LIMIT 0,1";

        return $this->db->query($sql)->row();
    }

    function setCircuitoProcesado($idCircuito) {
        $sql = "UPDATE circuitos
                SET procesado = ?
                WHERE id = ?";

        $this->db->query($sql, array(1, $idCircuito));
    }

}

?>