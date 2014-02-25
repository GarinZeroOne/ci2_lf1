<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class Grupos extends REST_Controller {

    function Grupos() {
        parent::REST_Controller();
        $this->load->helper('url');
        $this->load->database();
    }

    function data_get() {
        $this->load->model('grupos/grupos_model');
        $this->load->model('banco/banco_model');

        $idUser = $this->get('idUser');

        // Obtener listado de grupos del usuario
        $gruposUsuario =
                $this->grupos_model->obtenerGruposUsuario($idUser)->result();

        $datosGrupos = array();
        $i = 0;
        foreach ($gruposUsuario as $grupo) {
            $datosGrupo = array(
                'grupo' => $grupo->nombre,
                'id' => $grupo->id_grupo);
            $datosGrupos[$i] = $datosGrupo;
            $i++;
        }
        
        //Se obtiene el saldo del usuario
        $saldo = $this->banco_model->getSaldoUsuario($idUser);
        
        $data = array(
            'saldo' => $saldo,
            'datosGrupos' => $datosGrupos);

        $this->response($data);
    }

    function clasificacionGp_get() {
        $this->load->model('grupos/grupos_model');
        $this->load->model('ranking/ranking_model');

        $idGrupo = $this->get('idGrupo');
        
        // Obtener listado de grupos del usuario
        $clasificacionGp =
                $this->grupos_model->gruposRankingGP($idGrupo)->result();

        //Se obtiene el nombre del grupo
        $nombreGrupo = $this->grupos_model->obtenerNombreGrupo($idGrupo)->nombre;

        //Se obtienen los datos del gp
        $datosGp = $this->ranking_model->obtenerNombreGP($idGP);

        $datosClasificacion = array();
        $i = 0;
        foreach ($clasificacionGp as $linea) {
            $datosMiembro = array(
                'id' => $linea->id_usuario,
                'nick' => $linea->nick,
                'puntos' => $linea->puntos_manager_gp);
            $datosClasificacion[$i] = $datosMiembro;
            $i++;
        }

        $data = array(
            'datosClasificacion' => $datosClasificacion,
            'nombreGp' => $datosGp->circuito . "(" . $datosGp->pais . ")",
            'nombreGrupo' => $nombreGrupo
        );

        $this->response($data);
    }
    
    function clasificacionGeneral_get() {
        $this->load->model('grupos/grupos_model');
        $this->load->model('ranking/ranking_model');

        $idGrupo = $this->get('idGrupo');
        
        // Obtener listado de grupos del usuario
        $clasificacionGeneral =
                $this->grupos_model->gruposRankingGeneral($idGrupo)->result();

        //Se obtiene el nombre del grupo
        $nombreGrupo = $this->grupos_model->obtenerNombreGrupo($idGrupo)->nombre;

        $datosClasificacion = array();
        $i = 0;
        foreach ($clasificacionGeneral as $linea) {
            $datosMiembro = array(
                'id' => $linea->id,
                'nick' => $linea->nick,
                'puntos' => $linea->puntos);
            $datosClasificacion[$i] = $datosMiembro;
            $i++;
        }

        $data = array(
            'datosClasificacion' => $datosClasificacion,
            'nombreGrupo' => $nombreGrupo
        );

        $this->response($data);
    }

}
