<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class Mejoras extends REST_Controller {

    const ID_MEJORA_OJEADORES = 1;
    const ID_MEJORA_MECANICOS = 2;
    const ID_MEJORA_INGENIEROS = 3;
    const ID_MEJORA_PUBLICISTAS = 4;

    function Mejoras() {
        parent::REST_Controller();
        $this->load->helper('url');
        $this->load->database();
    }

    function data_put() {
        $this->load->model('boxes/mejoras_model');
        $this->load->model('boxes/boxes_model');
        $this->load->model('banco/banco_model');

        $idUser = $this->put('idUser');
        $idMejora = $this->put('idMejora');

        //Se comprueba el estado de los boxes
        $boxesAbiertos = $this->boxes_model->estado();

        if ($boxesAbiertos) {
            //Se realiza la mejora
            $error = $this->mejoras_model->aumentarMejora($idMejora, $idUser);
        } else {
            $error['texto'] = "Boxes cerrados, no se pueden realizar operaciones.";
            $error['codigo'] = 1;
        }



        //Se inicializan las variables que se envian
        $nivel = "";
        $precSigNivel = "";

        switch ($idMejora) {
            case self::ID_MEJORA_OJEADORES:
                $datos = $this->mejoras_model->getMejoraUsuario
                        (self::ID_MEJORA_OJEADORES, $idUser);
                break;
            case self::ID_MEJORA_MECANICOS:
                $datos = $this->mejoras_model->getMejoraUsuario
                        (self::ID_MEJORA_MECANICOS, $idUser);
                break;
            case self::ID_MEJORA_INGENIEROS:
                $datos = $this->mejoras_model->getMejoraUsuario
                        (self::ID_MEJORA_INGENIEROS, $idUser);
                break;
            case self::ID_MEJORA_PUBLICISTAS:
                $datos = $this->mejoras_model->getMejoraUsuario
                        (self::ID_MEJORA_PUBLICISTAS, $idUser);
                break;
        }

        $maxNivel = false;
        if (is_null($datos->nivel)) {
            $nivel = 0;
            $precSigNivel = $this->mejoras_model->get_mejora($idMejora)->nivel_1;
        } else {
            $nivel = $datos->nivel;
            $sigNivel = "nivel_" . ($datos->nivel + 1);
            $precSigNivel = $datos->$sigNivel;
            if ($nivel == 10) {
                $maxNivel = true;
            }
        }

        //Se obtiene el saldo del usuario
        $saldo = $this->banco_model->getSaldoUsuario($idUser);


        $data = array(
            'saldo' => $saldo,
            'texto' => $error['texto'],
            'idMejora' => $idMejora,
            'nivel' => $nivel,
            'precioSigNivel' => $precSigNivel,
            'nivelMax' => $maxNivel);

        $this->response($data);
    }

    function data_get() {
        $this->load->model('boxes/mejoras_model');
        $this->load->model('banco/banco_model');

        $idUser = $this->get('idUser');
        $idMejora = $this->get('idMejora');

        //Se realiza la mejora
        $error = $this->mejoras_model->aumentarMejora($idMejora, $idUser);

        //Se inicializan las variables que se envian
        $nivel = "";
        $precSigNivel = "";

        switch ($idMejora) {
            case self::ID_MEJORA_OJEADORES:
                $datos = $this->mejoras_model->getMejoraUsuario
                        (self::ID_MEJORA_OJEADORES, $idUser);
                break;
            case self::ID_MEJORA_MECANICOS:
                $datos = $this->mejoras_model->getMejoraUsuario
                        (self::ID_MEJORA_MECANICOS, $idUser);
                break;
            case self::ID_MEJORA_INGENIEROS:
                $datos = $this->mejoras_model->getMejoraUsuario
                        (self::ID_MEJORA_INGENIEROS, $idUser);
                break;
            case self::ID_MEJORA_PUBLICISTAS:
                $datos = $this->mejoras_model->getMejoraUsuario
                        (self::ID_MEJORA_PUBLICISTAS, $idUser);
                break;
        }

        $maxNivel = false;
        if (is_null($datos->nivel)) {
            $nivel = 0;
            $precSigNivel = $this->mejoras_model->get_mejora($idMejora)->nivel_1;
        } else {
            $nivel = $datos->nivel;
            $sigNivel = "nivel_" . ($datos->nivel + 1);
            $precSigNivel = $datos->$sigNivel;
            if ($nivel == 10) {
                $maxNivel = true;
            }
        }

        //Se obtiene el saldo del usuario
        $saldo = $this->banco_model->getSaldoUsuario($idUser);

        $data = array(
            'saldo' => $saldo,
            'texto' => $error['texto'],
            'idMejora' => $idMejora,
            'nivel' => $nivel,
            'precioSigNivel' => $precSigNivel,
            'nivelMax' => $maxNivel);

        $this->response($data);
    }

}
