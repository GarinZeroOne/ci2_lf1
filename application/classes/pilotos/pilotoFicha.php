<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PilotoFicha extends Piloto {

    private $puntosConseguidos;
    private $dineroConseguido;

    public function PilotoFicha() {
        
    }

    public function getPuntosConseguidos() {
        return $this->puntosConseguidos;
    }

    public function getDineroConseguido($formateado = false) {
        if ($formateado){
            return number_format($this->dineroConseguido, 0, ',', '.') . " €";
        }
        return $this->dineroConseguido;
    }

    public function setPuntosConseguidos($puntosConseguidos) {
        $this->puntosConseguidos = $puntosConseguidos;
    }

    public function setDineroConseguido($dineroConseguido) {
        $this->dineroConseguido = $dineroConseguido;
    }     
    
    public static function getById($idPiloto) {
        $CI;
        $CI = & get_instance();
        $CI->load->model('pilotos/pilotos_model');        

        $parent = Piloto::getById($idPiloto);

        $instance = new self();
        $instance->setIdPiloto($parent->getIdPiloto());
        $instance->setNombre($parent->getNombre());
        $instance->setApellido($parent->getApellido());
        $instance->setPais($parent->getPais());
        $instance->setFoto($parent->getFoto());
        $instance->setCode($parent->getCode());
        $instance->setDriverId($parent->getDriverId());
        $instance->setPrecioMax($parent->getPrecioMax());
        $instance->setPrecioMin($parent->getPrecioMin());
        $instance->setValorActual($parent->getValorActual());
        $instance->setValorAnterior($parent->getValorAnterior());
        $instance->setValoresMercado($parent->getValoresMercado());
        $instance->setValorMin($parent->getValorMin());
        $instance->setValorMax($parent->getValorMax());
        $instance->setPosicionMundial($parent->getPosicionMundial());
        $instance->setPuntosMundial($parent->getPuntosMundial());

        $instance->setPuntosConseguidos(
                $CI->pilotos_model->getPuntosPiloto($idPiloto));

        $instance->setDineroConseguido(
                $CI->pilotos_model->getDineroGanadoPiloto($idPiloto));       

        return $instance;
    }

}
