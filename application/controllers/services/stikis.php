<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class Stikis extends REST_Controller {

    const ID_MEJORA_MECANICOS = 2;
    const PRECIO_STK_DINERO = 30000;
    const PRECIO_STK_PUNTOS = 400000;

    function Stikis() {
        parent::REST_Controller();
        $this->load->helper('url');
        $this->load->database();
    }

    function data_get() {
        $this->load->model('pilotos/pilotos_model');
        $this->load->model('boxes/mejoras_model');
        $this->load->model('banco/banco_model');
        $this->load->model('stikis/stikis_model');

        $idUser = $this->get('idUser');

        // Obtener listado de pilotos
        $infoPilotos = $this->pilotos_model->getMisPilotosUsuario($idUser);

        $datosPilotos = array();
        $i = 0;
        foreach ($infoPilotos as $piloto) {
            $datosPiloto = array(
                'piloto' => $piloto->nombre . " " . $piloto->apellido,
                'equipo' => $piloto->escuderia,
                'id' => $piloto->id);
            $datosPilotos[$i] = $datosPiloto;
            $i++;
        }

        //Se obtiene el saldo del usuario
        $saldo = $this->banco_model->getSaldoUsuario($idUser);

        // Info mecanicos
        $mecanicos = $this->mejoras_model->getValorMejora($idUser, self::ID_MEJORA_MECANICOS);

        //Se obtienen los stikis comprados para el siguiente GP
        $stikisComprados = $this->stikis_model->getInfoStikisUsuario($idUser);

        $datosStikis = array();
        $i = 0;
        foreach ($stikisComprados as $stiki) {
            $datosStiki = array(
                'piloto' => $stiki->nombre . " " . $stiki->apellido,
                'tipo' => $stiki->stiki);
            $datosStikis[$i] = $datosStiki;
            $i++;
        }

        $data = array('saldo' => $saldo,
            'misPilotos' => $datosPilotos,
            'mejoraMecanicos' => $mecanicos,
            'stikisComprados' => $datosStikis,
            'precioStkDinero' => self::PRECIO_STK_DINERO,
            'precioStkPuntos' => self::PRECIO_STK_PUNTOS);

        $this->response($data);
    }

    function data_put() {
        $this->load->model('stikis/stikis_model');
        $this->load->model('boxes/mejoras_model');
        $this->load->model('boxes/boxes_model');
        $this->load->model('banco/banco_model');

        $idUser = $this->put('idUser');
        $idPiloto = $this->put('idPiloto');
        $tipoStiki = $this->put('tipoStiki');

        //Se comprueba el estado de los boxes
        $boxesAbiertos = $this->boxes_model->estado();

        if ($boxesAbiertos) {
            $infoCompra = $this->stikis_model->comprarStiki($idUser, $idPiloto, $tipoStiki);
        } else {
            $infoCompra = "Boxes cerrados, no se pueden realizar operaciones.";
        }

        $saldo = $this->banco_model->getSaldoUsuario($idUser);

        //Se obtienen los stikis comprados para el siguiente GP
        $stikisComprados = $this->stikis_model->getInfoStikisUsuario($idUser);

        $datosStikis = array();
        $i = 0;
        foreach ($stikisComprados as $stiki) {
            $datosStiki = array(
                'piloto' => $stiki->nombre . " " . $stiki->apellido,
                'tipo' => $stiki->stiki);
            $datosStikis[$i] = $datosStiki;
            $i++;
        }

        $data = array(
            'infoCompra' => $infoCompra,
            'saldo' => $saldo,
            'stikisComprados' => $datosStikis);

        $this->response($data);
    }

}
