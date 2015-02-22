<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Circuito
 *
 * @author mikel
 */
class Stiki {

    private $idStiki;
    private $piloto;
    private $circuito;
    private $tipoStiki;
    private $precioCompra;
    private $fechaCompra;
    private $porcentaje;

    public function getIdStiki() {
        return $this->idStiki;
    }

    public function getPiloto() {
        return $this->piloto;
    }

    public function getCircuito() {
        return $this->circuito;
    }

    public function getTipoStiki() {
        return $this->tipoStiki;
    }

    public function getPrecioCompra($formateado = false) {
        if ($formateado) {
            return number_format($this->precioCompra, 0, ',', '.') . " €";
        }
        return $this->precioCompra;
    }

    public function getFechaCompra() {
        return $this->fechaCompra;
    }
    
    public function getPorcentaje() {
    	return $this->porcentaje;
    }

    public function setIdStiki($idStiki) {
        $this->idStiki = $idStiki;
    }

    public function setPiloto(Piloto $piloto) {
        $this->piloto = $piloto;
    }

    public function setCircuito(Circuito $circuito) {
        $this->circuito = $circuito;
    }

    public function setTipoStiki($tipoStiki) {
        $this->tipoStiki = $tipoStiki;
    }

    public function setPrecioCompra($precioCompra) {
        $this->precioCompra = $precioCompra;
    }

    public function setFechaCompra($fechaCompra) {
        $this->fechaCompra = $fechaCompra;
    }
    
    public function setPorcentaje($porcentaje) {
    	$this->porcentaje = $porcentaje;
    }
    

    public function __construct() {
        
    }

    public static function getById($idStiki) {

        $CI = &get_instance();
        $CI->load->model('stikis/stikis_model');
        $CI->load->model('equipos/equipos_model');
        $instance = new self();
        $instance->setIdStiki($idStiki);

        $datosStiki = $CI->stikis_model->getStikiData($idStiki)->row();
        $instance->setCircuito(new Circuito($datosStiki->id_gp));
        $piloto = Piloto::getById($datosStiki->id_piloto);
        $equipo = $CI->equipos_model->getEquipoPilotoObject($datosStiki->id_piloto);
        $piloto->setEquipo($equipo);
        $instance->setPiloto($piloto);
        $instance->setTipoStiki($datosStiki->stiki);
        $instance->setPrecioCompra($datosStiki->precio_compra);
        $instance->setFechaCompra($datosStiki->fecha_compra);
        $instance->setPorcentaje($datosStiki->porcentaje);

        return $instance;
    }

}
