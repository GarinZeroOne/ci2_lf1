<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ClasificacionUsuario {

    private $usuario;
    private $posicion;
    private $puntos;

    public function getUsuario() {
        return $this->usuario;
    }

    public function getPosicion() {
        return $this->posicion;
    }

    public function getPuntos() {
        return $this->puntos;
    }

    public function setUsuario(Usuario $usuario) {
        $this->usuario = $usuario;
    }

    public function setPosicion($posicion) {
        $this->posicion = $posicion;
    }

    public function setPuntos($puntos) {
        $this->puntos = $puntos;
    }

    public function __construct() {
        
    }

}
