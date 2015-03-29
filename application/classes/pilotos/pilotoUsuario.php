<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'classes/pilotos/piloto.php';

class PilotoUsuario extends Piloto {

    private $puntosConseguidos;
    private $dineroConseguido;
    private $precioFichaje;
    private $tipoCompra;

    public function PilotoUsuario() {
        
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

    public function getPrecioFichaje($formateado = false) {
        if ($formateado) {
            return number_format($this->precioFichaje, 0, ',', '.') . " €";
        }
        return $this->precioFichaje;
    }

    public function setPrecioFichaje($precioFichaje) {
        $this->precioFichaje = $precioFichaje;
    }

    public function setPuntosConseguidos($puntosConseguidos) {
        $this->puntosConseguidos = $puntosConseguidos;
    }

    public function setDineroConseguido($dineroConseguido) {
        $this->dineroConseguido = $dineroConseguido;
    }
    
    public function getTipoCompra() {
        return $this->tipoCompra;
    }

    public function setTipoCompra($tipoCompra) {
        $this->tipoCompra = $tipoCompra;
    }

    
    public static function getById($idPiloto, $idUsuario) {
        $CI;
        $CI = & get_instance();
        $CI->load->model('pilotos/pilotos_model');

        $parent = Piloto::getById($idPiloto,false);

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

        $datosPilotoUsuario = $CI->pilotos_model->getDatosPilotoUsuario($idPiloto, $idUsuario)->row();

        $instance->setPuntosConseguidos(
                $datosPilotoUsuario->puntos);

        $instance->setDineroConseguido(
                $datosPilotoUsuario->dinero);

        $instance->setPrecioFichaje($datosPilotoUsuario->precio_fichaje);

        $instance->setTipoCompra($datosPilotoUsuario->tipo_compra);

        return $instance;
    }

    public function getGananciaPerdida($formateado = false) {
        $valor = $this->getValorActual() - $this->getPrecioFichaje();
        if ($formateado) {
            return number_format($valor, 0, ',', '.') . " €";
        }
        return $valor;
    }
    
    public function getGananciaPerdidaAlquiler($formateado = false) {
        $valor = $this->getPrecioAlquiler() - $this->getPrecioFichaje();
        if ($formateado) {
            return number_format($valor, 0, ',', '.') . " €";
        }
        return $valor;
    }

}
