<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clasificacionGp
 *
 * @author mikel
 */
class clasificacionGpPilotos {

    private $circuito;
    private $clasificacionPilotos = array();

    public function getCircuito() {
        return $this->circuito;
    }

    public function getClasificacionPilotos() {
        return $this->clasificacionPilotos;
    }

    public function setCircuito($circuito) {
        $this->circuito = $circuito;
    }

    public function setClasificacionPilotos($clasificacionPilotos) {
        $this->clasificacionPilotos = $clasificacionPilotos;
    }

    public function __construct($idGp) {
        /*
         * Si se recibe un 0 como paramentro se obtiene el ultimo Gp
         */
        $CI = &get_instance();
        $CI->load->model('ranking/clasificacion_model');
        $CI->load->model('pilotos/pilotos_model');
        
        if ($idGp == 0) {
            $idGp = $CI->clasificacion_model->getUltimoGpConClasificacion();
        }

        $this->circuito = new Circuito($idGp);

        $this->clasificacionPilotos = $CI->pilotos_model->
                getPilotosClasificacionGpObject($idGp);
    }

}
