<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Circuito
 *
 * @author mikel
 */
class Circuito {
    private $idCircuito;
    private $pais;
    private $circuito;
    private $fechaGp;
    private $bandera;
    private $trazado;
    
    public function getIdCircuito() {
        return $this->idCircuito;
    }

    public function getPais() {
        return $this->pais;
    }

    public function getCircuito() {
        return $this->circuito;
    }

    public function getFechaGp() {
        return $this->fechaGp;
    }

    public function getBandera() {
        return $this->bandera;
    }
    
    public function getTrazado() {
        return $this->trazado;
    }

    public function setTrazado($trazado) {
        $this->trazado = $trazado;
    }
    
    public function setIdCircuito($idCircuito) {
        $this->idCircuito = $idCircuito;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

    public function setCircuito($circuito) {
        $this->circuito = $circuito;
    }

    public function setFechaGp($fechaGp) {
        $this->fechaGp = $fechaGp;
    }

    public function setBandera($bandera) {
        $this->bandera = $bandera;
    }
    
    public function __construct($idGp) {
        $this->idCircuito = $idGp;
        $CI = &get_instance();
        $CI->load->model('ranking/clasificacion_model');
        $datosCircuito = $CI->clasificacion_model->getDatosGp($idGp)->row();
        $this->circuito = $datosCircuito->circuito;
        $this->fechaGp = $datosCircuito->fecha;
        $this->pais = $datosCircuito->pais;
        $this->bandera = $datosCircuito->bandera;
        $this->trazado = $datosCircuito->trazado;
    }


}
