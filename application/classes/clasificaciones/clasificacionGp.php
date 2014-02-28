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
class clasificacionGp {

    private $circuito;
    private $clasificacionUsuarios = array();

    public function getCircuito() {
        return $this->circuito;
    }

    public function getClasificacionUsuarios() {
        return $this->clasificacionUsuarios;
    }

    public function setCircuito($circuito) {
        $this->circuito = $circuito;
    }

    public function setClasificacionUsuarios($clasificacionUsuarios) {
        $this->clasificacionUsuarios = $clasificacionUsuarios;
    }

    public function __construct($idGp) {
        /*
         * Si se recibe un 0 como paramentro se obtiene el ultimo Gp
         */
        $CI = &get_instance();
        $CI->load->model('ranking/clasificacion_model');

        if ($idGp == 0) {
            $idGp = $CI->clasificacion_model->getUltimoGpConClasificacion();
        }

        $this->circuito = new Circuito($idGp);

        $this->clasificacionUsuarios = $CI->clasificacion_model->
                getClasificacionGpObject($idGp);
    }

}
