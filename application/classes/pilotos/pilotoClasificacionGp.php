<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pilotoClasificacionGp
 *
 * @author mikel
 */
class PilotoClasificacionGp extends Piloto {

    private $posicionGp;
    private $puntosGp;

    public function getPosicionGp() {
        return $this->posicionGp;
    }

    public function getPuntosGp() {
        return $this->puntosGp;
    }

    public function setPosicionGp($posicionGp) {
        $this->posicionGp = $posicionGp;
    }

    public function setPuntosGp($puntosGp) {
        $this->puntosGp = $puntosGp;
    }

    public function __construct($idPiloto, $idGp) {

        $piloto = Piloto::getById($idPiloto);

        $this->setIdPiloto($idPiloto);
        $this->setNombre($piloto->getNombre());
        $this->setApellido($piloto->getApellido());
        $this->setPais($piloto->getPais());
        $this->setFoto($piloto->getFoto());
        $this->setCode($piloto->getCode());
        $this->setDriverId($piloto->getDriverId());
        $this->setPrecioMax($piloto->getPrecioMax());
        $this->setPrecioMin($piloto->getPrecioMin());
        $this->setValorActual($piloto->getValorActual());
        $this->setValorAnterior($piloto->getValorAnterior());
        $this->setValoresMercado($piloto->getValoresMercado());
        $this->setValorMin($piloto->getValorMin());
        $this->setValorMax($piloto->getValorMax());
        $this->setPosicionMundial($piloto->getPosicionMundial());
        $this->setPuntosMundial($piloto->getPuntosMundial());

        $CI = &get_instance();
        $CI->load->model('pilotos/pilotos_model');
        $datosGpPiloto = $CI->pilotos_model->getDatosPilotoGp($idPiloto, $idGp);
        if ($datosGpPiloto->num_rows()) {
            $this->puntosGp = $datosGpPiloto->row()->puntos;
            $this->posicionGp = $datosGpPiloto->row()->posicion;
        } else {
            $this->puntosGp = "-";
            $this->posicionGp = 0;
        }
    }

    static function comparaPosicionGp(PilotoClasificacionGp $a, PilotoClasificacionGp $b) {
        return $a->getPosicionGp() - $b->getPosicionGp();
    }

}
