<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ValorMercado {

    public $precio;
    public $fecha;

    public function ValorMercado() {
        
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

}
