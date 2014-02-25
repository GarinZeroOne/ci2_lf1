<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . '/classes/usuarios/comunidad.php';

class Avatar {

    private $idAvatar;
    private $path;
    private $avatar;

    public function Avatar() {
    }

    public function getIdAvatar() {
        return $this->idAvatar;
    }

    public function getPath() {
        return $this->path;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function setIdAvatar($idAvatar) {
        $this->idAvatar = $idAvatar;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }

        
    public static function getById($idUsuario) {
        $CI;
        $CI = & get_instance();
        $CI->load->model('usuarios/usuarios_model');
        $datosAvatar = $CI->usuarios_model->obtenerAvatar($idUsuario)->row();

        $instance = new self();

        $instance->setAvatar($datosAvatar->avatar);
        $instance->setIdAvatar($datosAvatar->id);
        $instance->setPath($datosAvatar->avatar_path);
        
        return $instance;
    }

}
