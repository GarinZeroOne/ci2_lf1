<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class Login extends REST_Controller {

    function Login() {
        parent::REST_Controller();
        //$this->load->helper('url');
        $this->load->database();
    }

    function data_get() {

        $datos = array(
            'usuario' => $this->get('user'),
            'passwd' => $this->get('password')
        );    

        $this->load->model('usuarios/usuarios_model');

        $existe = $this->usuarios_model->checkUser($datos);

        if ($existe->num_rows() > 0) {
            //Login ok
            $data = array('codigo' => 0,
                'id' => $existe->row()->id,
                'nick' => $existe->row()->nick);
        } else {
            //Login ko
            $data = array('codigo' => 1);
        }

        $this->response($data);
    }

}
