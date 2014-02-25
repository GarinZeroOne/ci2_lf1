<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class MisPilotos extends REST_Controller {

    const ID_MEJORA_OJEADORES = 1;

    function MisPilotos() {
        parent::REST_Controller();
        $this->load->helper('url');
        $this->load->database();
    }

    function data_get() {
        $this->load->model('pilotos/pilotos_model');
        $this->load->model('boxes/mejoras_model');
        $this->load->model('banco/banco_model');

        $idUser = $this->get('idUser');

        // Obtener listado de pilotos
        $infoPilotos = $this->pilotos_model->getMisPilotosUsuario($idUser);

        $datosPilotos = array();
        $i = 0;
        foreach ($infoPilotos as $piloto) {
            $datosPiloto = array(
                'piloto' => $piloto->nombre . " " . $piloto->apellido,
                'equipo' => $piloto->escuderia,
                'precioVenta' => $piloto->dinero_venta,
                'id' => $piloto->id,
                'puntos' => $piloto->puntos);
            $datosPilotos[$i] = $datosPiloto;
            $i++;
        }

        $saldo = $this->banco_model->getSaldoUsuario($idUser);

        $data = array('saldo' => $saldo,
            'misPilotos' => $datosPilotos);

        $this->response($data);
    }

    function data_put() {
        $this->load->model('pilotos/pilotos_model');
        $this->load->model('boxes/mejoras_model');
        $this->load->model('banco/banco_model');
        $this->load->model('boxes/boxes_model');

        $idUser = $this->put('idUser');
        $idPiloto = $this->put('idPiloto');

        //Se comprueba el estado de los boxes
        $boxesAbiertos = $this->boxes_model->estado();

        if ($boxesAbiertos) {
            $infoFichaje = $this->pilotos_model->venderPiloto($idUser, $idPiloto);
        } else {
            $infoFichaje = "Boxes cerrados, no se pueden realizar operaciones.";
        }

        $saldo = $this->banco_model->getSaldoUsuario($idUser);

        // Obtener listado de pilotos
        $infoPilotos = $this->pilotos_model->getMisPilotosUsuario($idUser);

        $datosPilotos = array();
        $i = 0;
        foreach ($infoPilotos as $piloto) {
            $datosPiloto = array(
                'piloto' => $piloto->nombre . " " . $piloto->apellido,
                'equipo' => $piloto->escuderia,
                'precioVenta' => $piloto->dinero_venta,
                'id' => $piloto->id,
                'puntos' => $piloto->puntos);
            $datosPilotos[$i] = $datosPiloto;
            $i++;
        }

        $data = array(
            'infoVenta' => $infoFichaje,
            'saldo' => $saldo,
            'misPilotos' => $datosPilotos);

        $this->response($data);
    }

}
