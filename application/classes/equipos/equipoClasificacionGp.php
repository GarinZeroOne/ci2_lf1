<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pilotoClasificacionGp
 *
 * @author mikel
 */
class EquipoClasificacionGp extends Equipo {

    private $posicionGp;
    private $puntosGp;

    public function getPosicionGp() {
        return $this->posicionGp;
    }

    public function getPuntosGp() {
        return $this->puntosGp;
    }

    public function setPosicionGp($posicionGp) {
        $this->posicionGp = $posicionGp;
    }

    public function setPuntosGp($puntosGp) {
        $this->puntosGp = $puntosGp;
    }

    public function __construct($idEquipo, $idGp) {

        $equipo = Equipo::getById($idEquipo);

        $this->setConstructorId($equipo->getConstructorId());
        $this->setIdEquipo($idEquipo);
        $this->setEscuderia($equipo->getEscuderia());
        $this->setFoto($equipo->getFoto());
        $this->setPrecioMax($equipo->getPrecioMax());
        $this->setPrecioMin($equipo->getPrecioMin());
        $this->setValorActual($equipo->getValorActual());
        $this->setValorAnterior($equipo->getValorAnterior());        
        $this->setValoresMercado($equipo->getValoresMercado());
        $this->setValorMax($equipo->getValorMax());
        $this->setValorMin($equipo->getValorMin());                
        $this->setPosicionMundial($equipo->getPosicionMundial());
        $this->setPuntosMundial($equipo->getPuntosMundial());

        $CI = &get_instance();
        $CI->load->model('equipos/equipos_model');
        $datosClasGp = $CI->equipos_model->getResultadosEquipos($idEquipo, $idGp);
        if ($datosClasGp->num_rows()) {
            $this->puntosGp = $datosClasGp->row()->puntos;
            $this->posicionGp = $datosClasGp->row()->posicion;
        } else {
            $this->puntosGp = "-";
            $this->posicionGp = 0;
        }
    }

    static function comparaPosicionGp(EquipoClasificacionGp $a, EquipoClasificacionGp $b) {
        return $a->getPosicionGp() - $b->getPosicionGp();
    }

}
