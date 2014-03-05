<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . '/classes/usuarios/comunidad.php';
require_once APPPATH . '/classes/usuarios/avatar.php';

class Usuario {

    private $idUsuario;
    private $comunidad;
    private $nick;
    private $email;
    private $nombre;
    private $apellido;
    private $ubicacion;
    private $anoNacimiento;
    private $infoPerfil;
    private $fechaUltimoLogin;
    private $avatar;
    private $fondos;
    private $equipos;
    private $pilotos;

    public function Usuario() {
        
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getComunidad() {
        return $this->comunidad;
    }

    public function getNick() {
        return $this->nick;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getUbicacion() {
        return $this->ubicacion;
    }

    public function getAnoNacimiento() {
        return $this->anoNacimiento;
    }

    public function getInfoPerfil() {
        return $this->infoPerfil;
    }

    public function getFechaUltimoLogin() {
        return $this->fechaUltimoLogin;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function getFondos() {
        return $this->fondos;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setComunidad(Comunidad $comunidad = null) {
        $this->comunidad = $comunidad;
    }

    public function setNick($nick) {
        $this->nick = $nick;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    public function setAnoNacimiento($anoNacimiento) {
        $this->anoNacimiento = $anoNacimiento;
    }

    public function setInfoPerfil($infoPerfil) {
        $this->infoPerfil = $infoPerfil;
    }

    public function setFechaUltimoLogin($fechaUltimoLogin) {
        $this->fechaUltimoLogin = $fechaUltimoLogin;
    }

    public function setAvatar(Avatar $avatar) {
        $this->avatar = $avatar;
    }

    public function setFondos($fondos) {
        $this->fondos = $fondos;
    }
    
    public function getEquipos() {
        return $this->equipos;
    }

    public function getPilotos() {
        return $this->pilotos;
    }

    public function setEquipos($equipos) {
        $this->equipos = $equipos;
    }

    public function setPilotos($pilotos) {
        $this->pilotos = $pilotos;
    }

    
    public static function getById($idUsuario) {
        $CI;
        $CI = & get_instance();
        $CI->load->model('usuarios/usuarios_model');
        $CI->load->model('banco/banco_model');
        $datosUsuario = $CI->usuarios_model->userData($idUsuario);

        $comunidad = Comunidad::getById($datosUsuario->id_comunidad);

        $avatar = Avatar::getById($idUsuario);

        $fondos = $CI->banco_model->getSaldoUsuario($idUsuario);

        $instance = new self();

        $instance->setAnoNacimiento($datosUsuario->ano_nacimiento);
        $instance->setNick($datosUsuario->nick);
        $instance->setEmail($datosUsuario->email);
        $instance->setComunidad($comunidad);
        $instance->setIdUsuario($datosUsuario->id);
        $instance->setNombre($datosUsuario->nombre);
        $instance->setApellido($datosUsuario->apellido);
        $instance->setUbicacion($datosUsuario->ubicacion);
        $instance->setInfoPerfil($datosUsuario->info_perfil);
        $instance->setFechaUltimoLogin($datosUsuario->fecha_ultimo_login);
        $instance->setAvatar($avatar);
        $instance->setFondos($fondos);

        return $instance;
    }

}
