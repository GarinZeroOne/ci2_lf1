<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller {

    function data_get() {
        $data = array('respuesta: ' . $this->get('id'));
        //echo $this->get('id');
        //echo $this->get('password');
        $users = array(
			array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
			array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
		);     
        
        $this->response($users);
    }

    function data_post() {
        $data = array('respuesta: ' . $this->post('id'));
        $this->response($data);
    }

}
