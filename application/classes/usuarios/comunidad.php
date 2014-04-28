<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comunidad {

    private $idComunidad;
    private $nombre;
    private $bandera;

    public function Comunidad() {
    }

    public function getIdComunidad() {
        return $this->idComunidad;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setIdComunidad($idComunidad) {
        $this->idComunidad = $idComunidad;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getBandera() {
        return $this->bandera;
    }

    public function setBandera($bandera) {
        $this->bandera = $bandera;
    }

            
    public static function getById($idComunidad) {
        $CI;
        $CI = & get_instance();
        $CI->load->model('usuarios/usuarios_model');
        $datosComunidad = $CI->usuarios_model->obtenerComunidad($idComunidad);

        $instance = null;
        if (is_object($datosComunidad)) {

            $instance = new self();
            
            $instance->setIdComunidad($datosComunidad->id);
            $instance->setNombre($datosComunidad->nombre);
            $instance->setBandera($datosComunidad->bandera);
        }

        return $instance;
    }

}
