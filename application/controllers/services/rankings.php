<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class Rankings extends REST_Controller {

    function Rankings() {
        parent::REST_Controller();
        $this->load->helper('url');
        $this->load->database();
    }

    function clasificacionGeneral_get() {
        $this->load->model('ranking/ranking_model');

        $idUser = $this->get('idUser');

        // Se obtiene la clasificación general
        $clasificacion = $this->ranking_model->getRankingGeneral()->result();

        //Se obtiene mi posicion
        $miPosicion = $this->ranking_model->getPosicionGeneralUsuario($idUser);

        $datosClasificacion = array();
        $i = 0;
        foreach ($clasificacion as $linea) {
            $datosUsuario = array(
                'nick' => $linea->nick,
                'puntos' => $linea->puntos);
            $datosClasificacion[$i] = $datosUsuario;
            $i++;
        }

        if ($miPosicion->puntos == null) {
            $this->load->model('usuarios/usuarios_model');
            //Se obtienen los datos del usuario
            $nick = $this->usuarios_model->userData($idUser)->nick;

            $misDatos = array('puntos' => 0
                , 'nick' => $nick
                , 'puesto' => 0);
        } else {
            $misDatos = array('puntos' => $miPosicion->puntos
                , 'nick' => $miPosicion->nick
                , 'puesto' => $miPosicion->puesto_general);
        }
        
        $data = array(
            'datosClasificacion' => $datosClasificacion,
            'miPosicion' => $misDatos
        );
        $this->response($data);
    }

    function clasificacionGp_get() {
        $this->load->model('ranking/ranking_model');        

        $idUser = $this->get('idUser');

        //Se obtienen los datos del GP
        $datosGp = $this->ranking_model->obtenerNombreGP();

        // Obtener clasificacion del gp
        $rankingGP = $this->ranking_model->getRankingGp($datosGp->id)->result();

        //Posicion del usuario en el gp
        $miPosicion = $this->ranking_model->getPosicionGpUsuario($datosGp->id
                        , $idUser)->row();

        $datosClasificacion = array();
        $i = 0;
        foreach ($rankingGP as $linea) {
            $datosMiembro = array(
                'nick' => $linea->nick,
                'puntos' => $linea->puntos_manager_gp);
            $datosClasificacion[$i] = $datosMiembro;
            $i++;
        }

        if ($miPosicion->puntos_manager_gp == null) {
            $this->load->model('usuarios/usuarios_model');
            //Se obtienen los datos del usuario
            $nick = $this->usuarios_model->userData($idUser)->nick;

            $misDatos = array('puntos' => 0
                , 'nick' => $nick
                , 'puesto' => 0);
        } else {

            $misDatos = array('puntos' => $miPosicion->puntos_manager_gp
                , 'nick' => $miPosicion->nick
                , 'puesto' => $miPosicion->puesto_gp);
        }

        $data = array(
            'datosClasificacion' => $datosClasificacion,
            'nombreGp' => $datosGp->circuito . "(" . $datosGp->pais . ")",
            'miPosicion' => $misDatos
        );

        $this->response($data);
    }

}
