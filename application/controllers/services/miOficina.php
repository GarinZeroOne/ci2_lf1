<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class MiOficina extends REST_Controller {

    function MiOficina() {
        parent::REST_Controller();
        //$this->load->helper('url');
        $this->load->database();
    }

    function data_get() {

        $idUser = $this->get('idUser');

        $this->load->model('boxes/mejoras_model');
        $this->load->model('pilotos/pilotos_model');
        $this->load->model('equipos/equipos_model');
        $this->load->model('banco/banco_model');

        // Resumen ultimo GP
        $resultado = $this->mejoras_model->getResumenGp($idUser);

        // Mejoras del usuario
        $ojeadores = $this->mejoras_model->getMejoraUsuario(1, $idUser);
        $mecanicos = $this->mejoras_model->getMejoraUsuario(2, $idUser);
        $ingenieros = $this->mejoras_model->getMejoraUsuario(3, $idUser);
        $publicistas = $this->mejoras_model->getMejoraUsuario(4, $idUser);

        $i = 0;
        $datosRes = array();
        foreach ($resultado as $res) {
            //Si los puntos son de pilotos se obtiene el piloto
            if ($res->id_piloto != 0) {
                $piloto = $this->pilotos_model->get_nombre_piloto_por_id($res->id_piloto);
                $resUser = array('dinero' => $res->dinero
                    , 'puntos' => $res->puntos
                    , 'tipo' => $res->tipo
                    , 'piloto_equipo' => $piloto);
            } elseif ($res->id_equipo != 0) {
                $equipo = $this->equipos_model->getInfoEquipo($res->id_equipo)->esquderia;
                $resUser = array('dinero' => $res->dinero
                    , 'puntos' => $res->puntos
                    , 'tipo' => $res->tipo
                    , 'piloto_equipo' => $equipo);
            } else {
                $resUser = array('dinero' => $res->dinero
                    , 'puntos' => $res->puntos
                    , 'tipo' => $res->tipo
                    , 'piloto_equipo' => '');
            }

            $datosRes[$i] = $resUser;
            $i++;
        }

        //Nivel ojeadores
        $maxNivelOje = false;
        if (is_null($ojeadores->nivel)) {
            $nivelOje = 0;
            $precSigNivelOje = $this->mejoras_model->get_mejora(1)->nivel_1;
        } else {
            $nivelOje = $ojeadores->nivel;
            $sigNivelOje = "nivel_" . ($ojeadores->nivel + 1);
            $precSigNivelOje = $ojeadores->$sigNivelOje;
            if ($nivelOje == 10){
                $maxNivelOje = true;
            }
        }

        //Nivel mecanicos
        $maxNivelMec = false;
        if (is_null($mecanicos->nivel)) {
            $nivelMec = 0;
            $precSigNivelMec = $this->mejoras_model->get_mejora(2)->nivel_1;
        } else {
            $nivelMec = $mecanicos->nivel;
            $sigNivelMec = "nivel_" . ($mecanicos->nivel + 1);
            $precSigNivelMec = $mecanicos->$sigNivelMec;
            if ($nivelMec == 10){
                $maxNivelMec = true;
            }
        }

        //Nivel ingenieros
        $maxNivelIng = false;
        if (is_null($ingenieros->nivel)) {
            $nivelIng = 0;
            $precSigNivelIng = $this->mejoras_model->get_mejora(3)->nivel_1;
        } else {
            $nivelIng = $ingenieros->nivel;
            $sigNivelIng = "nivel_" . ($ingenieros->nivel + 1);
            $precSigNivelIng = $ingenieros->$sigNivelIng;
            if ($nivelIng == 10){
                $maxNivelIng = true;
            }
        }

        //Nivel publicistas
        $maxNivelPub = false;
        if (is_null($publicistas->nivel)) {
            $nivelPub = 0;
            $precSigNivelPub = $this->mejoras_model->get_mejora(4)->nivel_1;
        } else {
            $nivelPub = $publicistas->nivel;
            $sigNivelPub = "nivel_" . ($publicistas->nivel + 1);
            $precSigNivelPub = $publicistas->$sigNivelPub;
            if ($nivelPub == 10){
                $maxNivelPub = true;
            }
        }

        //Se obtiene el saldo del usuario
        $saldo = $this->banco_model->getSaldoUsuario($idUser);


        $data = array(
            'saldo' => $saldo,
            'resultados' => $datosRes,
            'ojeadores' => array('nivel' => $nivelOje,
                'precioSigNivel' => $precSigNivelOje,
                'nivelMax' => $maxNivelOje),
            'mecanicos' => array('nivel' => $nivelMec,
                'precioSigNivel' => $precSigNivelMec,
                'nivelMax' => $maxNivelMec),
            'ingenieros' => array('nivel' => $nivelIng,
                'precioSigNivel' => $precSigNivelIng,
                'nivelMax' => $maxNivelIng),
            'publicistas' => array('nivel' => $nivelPub,
                'precioSigNivel' => $precSigNivelPub,
                'nivelMax' => $maxNivelPub)
        );


        $this->response($data);
    }

}
