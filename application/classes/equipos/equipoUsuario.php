<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class EquipoFicha extends Equipo {

    private $puntosConseguidos;
    private $dineroConseguido;

    public function Equipo() {
        
    }

    public function getPuntosConseguidos() {
        return $this->puntosConseguidos;
    }

    public function getDineroConseguido($formateado = false) {
        if ($formateado) {
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

    public static function getById($idEquipo) {
        $CI;
        $CI = & get_instance();
        $CI->load->model('equipos/equipos_model');

        $parent = Equipo::getById($idEquipo);
        $instance = new self();        
        
        $instance->setConstructorId($parent->getConstructorId());
        $instance->setIdEquipo($parent->getIdEquipo());
        $instance->setEscuderia($parent->getEscuderia());
        $instance->setFoto($parent->getFoto());
        $instance->setPrecioMax($parent->getPrecioMax());
        $instance->setPrecioMin($parent->getPrecioMin());
        $instance->setValorActual($parent->getValorActual());
        $instance->setValorAnterior($parent->getValorAnterior());
        $instance->setValoresMercado($parent->getValoresMercado());
        $instance->setValorMax($parent->getValorMax());
        $instance->setValorMin($parent->getValorMin());
        $instance->setPosicionMundial($parent->getPosicionMundial());
        $instance->setPuntosMundial($parent->getPuntosMundial());

        $instance->setPuntosConseguidos($CI->equipos_model->getPuntosEquipo($idEquipo));
        $instance->setDineroConseguido($CI->equipos_model->getDineroGanadoEquipo($idEquipo));

        return $instance;
    }

}
