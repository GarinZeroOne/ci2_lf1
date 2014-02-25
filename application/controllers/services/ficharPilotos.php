<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class FicharPilotos extends REST_Controller {

    const ID_MEJORA_OJEADORES = 1;

    function FicharPilotos() {
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
        $infoPilotos = $this->pilotos_model->getInfoPilotos();

        $datosPilotos = array();
        $i = 0;
        foreach ($infoPilotos as $piloto) {
            $datosPiloto = array(
                'piloto' => $piloto->nombre . " " . $piloto->apellido,
                'equipo' => $piloto->escuderia,
                'precio' => $piloto->dinero_compra,
                'id' => $piloto->id);
            $datosPilotos[$i] = $datosPiloto;
            $i++;
        }

        // Info ojeadores
        $mejoraOjeadores = $this->mejoras_model->getValorMejora($idUser
                , self::ID_MEJORA_OJEADORES);

        //Se obtiene el saldo del usuario
        $saldo = $this->banco_model->getSaldoUsuario($idUser);


        $data = array(
            'saldo' => $saldo,
            'datosPilotos' => $datosPilotos,
            'mejoraOjeadores' => $mejoraOjeadores);

        $this->response($data);
    }

    function data_put() {
        $this->load->model('pilotos/pilotos_model');
        $this->load->model('boxes/mejoras_model');
        $this->load->model('boxes/boxes_model');
        $this->load->model('banco/banco_model');

        $idUser = $this->put('idUser');
        $idPiloto = $this->put('idPiloto');

        //Se comprueba el estado de los boxes
        $boxesAbiertos = $this->boxes_model->estado();

        if ($boxesAbiertos) {
            $infoFichaje = $this->pilotos_model->ficharPiloto($idUser, $idPiloto);
        } else {
            $infoFichaje = "Boxes cerrados, no se pueden realizar operaciones.";
        }
        $saldo = $this->banco_model->getSaldoUsuario($idUser);

        $data = array(
            'infoFichaje' => $infoFichaje,
            'saldo' => $saldo);

        $this->response($data);
    }

}
