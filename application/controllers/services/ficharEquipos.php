<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class FicharEquipos extends REST_Controller {

    const ID_MEJORA_OJEADORES = 1;

    function FicharEquipos() {
        parent::REST_Controller();
        $this->load->helper('url');
        $this->load->database();
    }

    function data_get() {
        $this->load->model('equipos/equipos_model');
        $this->load->model('boxes/mejoras_model');
        $this->load->model('banco/banco_model');

        $idUser = $this->get('idUser');

        // Obtener listado de equipos
        $infoEquipos = $this->equipos_model->getInfoEquipos();

        $datosEquipos = array();
        $i = 0;
        foreach ($infoEquipos as $equipo) {
            $datosEquipo = array(
                'equipo' => $equipo->escuderia,
                'precio' => $equipo->precio_compra,
                'id' => $equipo->id);
            $datosEquipos[$i] = $datosEquipo;
            $i++;
        }

        // Info ojeadores
        $mejoraOjeadores = $this->mejoras_model->getValorMejora($idUser
                , self::ID_MEJORA_OJEADORES);

        //Se obtiene el saldo del usuario
        $saldo = $this->banco_model->getSaldoUsuario($idUser);

        $data = array(
            'saldo' => $saldo,
            'datosEquipos' => $datosEquipos,
            'mejoraOjeadores' => $mejoraOjeadores);

        $this->response($data);
    }

    function data_put() {
        $this->load->model('equipos/equipos_model');
        $this->load->model('boxes/mejoras_model');
        $this->load->model('boxes/boxes_model');
        $this->load->model('banco/banco_model');

        $idUser = $this->put('idUser');
        $idEquipo = $this->put('idEquipo');

        //Se comprueba el estado de los boxes
        $boxesAbiertos = $this->boxes_model->estado();
        
        if ($boxesAbiertos){
            $infoFichaje = $this->equipos_model->ficharEquipo($idUser, $idEquipo);
        }else{
            $infoFichaje = "Boxes cerrados, no se pueden realizar operaciones.";
        }
        
        $saldo = $this->banco_model->getSaldoUsuario($idUser);

        $data = array(
            'infoFichaje' => $infoFichaje,
            'saldo' => $saldo);

        $this->response($data);
    }

}
