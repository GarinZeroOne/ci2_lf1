<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ClasificacionGeneralUsuario extends ClasificacionUsuario {

    private $posicionAnterior = "-";

    public function getPosicionAnterior() {
        return $this->posicionAnterior;
    }

    public function setPosicionAnterior($posicionAnterior) {
        $this->posicionAnterior = $posicionAnterior;
    }

    public function __construct() {
        
    }

    public static function getById(Usuario $usuario) {
        $CI;
        $CI = &get_instance();
        $CI->load->model('ranking/clasificacion_model');
        $datosClasificacion = $CI->clasificacion_model->getDatosClasificacionUsuario
                ($usuario->getIdUsuario(), 0)->row();
        $instance = new ClasificacionGeneralUsuario();
        
        $instance->setUsuario($usuario);

        $instance->setPosicion($datosClasificacion->puesto_general);
        $instance->setPuntos($datosClasificacion->puntos_manager_total_gp);

        $idGp = $CI->clasificacion_model->getGpAnterior();

        if ($idGp != 0) {
            $instance->posicionAnterior = $CI->clasificacion_model->getDatosClasificacionUsuario
                    ($usuario->getIdUsuario(), $idGp)->row()->puesto_general;
        }

        return $instance;
    }

    public function getCambioPosicion() {
        if (is_numeric($this->posicionAnterior)) {
            return $this->posicionAnterior - $this->getPosicion();
        }
        return "-";
    }

}
