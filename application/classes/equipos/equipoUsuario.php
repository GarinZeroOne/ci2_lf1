<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class EquipoUsuario extends Equipo {

    private $puntosConseguidos;
    private $dineroConseguido;
    private $precioCompra;

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
    public function getPrecioCompra($formateado = false) {
        if ($formateado) {
            return number_format($this->precioCompra, 0, ',', '.') . " €";
        }
        return $this->precioCompra;
    }

    public function setPrecioCompra($precioCompra) {
        $this->precioCompra = $precioCompra;
    }

    
    public static function getById($idEquipo, $idUsuario) {
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

        $datosEquipoUsuario = $CI->equipos_model->
                        getDatosEquipoUsuario($idEquipo, $idUsuario)->row();

        $instance->setPuntosConseguidos($datosEquipoUsuario->puntos);
        $instance->setDineroConseguido($datosEquipoUsuario->dinero);
        $instance->setPrecioCompra($datosEquipoUsuario->precio_compra);

        return $instance;
    }
    
    public function getGananciaPerdida($formateado = false) {
        $valor = $this->getValorActual() - $this->getPrecioCompra();
        if ($formateado) {
            return number_format($valor, 0, ',', '.') . " €";
        }
        return $valor;
    }

}
