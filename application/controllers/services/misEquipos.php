<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class MisEquipos extends REST_Controller {

    const ID_MEJORA_OJEADORES = 1;

    function MisEquipos() {
        parent::REST_Controller();
        $this->load->helper('url');
        $this->load->database();
    }

    function data_get() {
        $this->load->model('equipos/equipos_model');
        $this->load->model('banco/banco_model');

        $idUser = $this->get('idUser');

        // Obtener listado de los equipos del usuario
        $infoEquipos = $this->equipos_model->getMisEquiposUsuario($idUser);

        $datosEquipos = array();
        $i = 0;
        foreach ($infoEquipos as $equipo) {
            $datosEquipo = array(
                'equipo' => $equipo->escuderia,
                'precioVenta' => $equipo->precio_venta,
                'id' => $equipo->id_equipo,
                'dineroGanado' => $equipo->puntos);
            $datosEquipos[$i] = $datosEquipo;
            $i++;
        }
        
        //Se obtiene el saldo del usuario
        $saldo = $this->banco_model->getSaldoUsuario($idUser);

        $data = array(
            'saldo' => $saldo,
            'misEquipos' => $datosEquipos);
        
        $this->response($data);
    }

    function data_put() {
        $this->load->model('equipos/equipos_model');
        $this->load->model('banco/banco_model');
        $this->load->model('boxes/boxes_model');

        $idUser = $this->put('idUser');
        $idEquipo = $this->put('idEquipo');

        //Se comprueba el estado de los boxes
        $boxesAbiertos = $this->boxes_model->estado();

        if ($boxesAbiertos) {
            $infoVenta = $this->equipos_model->venderEquipo($idUser, $idEquipo);
        } else {
            $infoVenta = "Boxes cerrados, no se pueden realizar operaciones.";
        }
        
        
        $saldo = $this->banco_model->getSaldoUsuario($idUser);

        // Obtener listado de los equipos del usuario
        $infoEquipos = $this->equipos_model->getMisEquiposUsuario($idUser);

        $datosEquipos = array();
        $i = 0;
        foreach ($infoEquipos as $equipo) {
            $datosEquipo = array(
                'equipo' => $equipo->escuderia,
                'precioVenta' => $equipo->precio_venta,
                'id' => $equipo->id_equipo,
                'dineroGanado' => $equipo->puntos);
            $datosEquipos[$i] = $datosEquipo;
            $i++;
        }

        $data = array(
            'infoVenta' => $infoVenta,
            'saldo' => $saldo,
            'misEquipos' => $datosEquipos);

        $this->response($data);
    }

}
