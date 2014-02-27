<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MovimientoEquipo extends MovimientosEquipos {

    private $movimientosEquipo;
    private $ventasEquipo;
    private $comprasEquipo;

    public function getMovimientosEquipo() {
        return $this->movimientosEquipo;
    }

    public function getVentasEquipo() {
        return $this->ventasEquipo;
    }

    public function getComprasEquipo() {
        return $this->comprasEquipo;
    }

    public function setMovimientosEquipo($movimientosEquipo) {
        $this->movimientosEquipo = $movimientosEquipo;
    }

    public function setVentasEquipo($ventasEquipo) {
        $this->ventasEquipo = $ventasEquipo;
    }

    public function setComprasEquipo($comprasEquipo) {
        $this->comprasEquipo = $comprasEquipo;
    }

    
    public function __construct($fecha,  $idEquipo) {
        parent::__construct($fecha);
        $CI = &get_instance();
        $CI->load->model('admin/movimientos_mercado_model');

        $this->ventasEquipo = $CI->movimientos_mercado_model->
                        getDatosVentasEquipo($fecha, $idEquipo)->num_rows();
        $this->comprasEquipo = $CI->movimientos_mercado_model->
                        getDatosComprasEquipo($fecha, $idEquipo)->num_rows();
        $this->movimientosEquipo = $this->ventasEquipo + $this->comprasEquipo;
    }

    public function getPorcentajeMovimientosEquipo() {
        if ($this->movimientosEquipo != 0) {
            $porcentaje = round($this->movimientosEquipo * 100 / $this->getMovimientosTotales(), 2);
            return $porcentaje;
        }
        return 0;
    }

    /*
     * return
     * 0 -> No modificar
     * 1 -> Aumentar
     * 2 -> Disminuir
     * 3 -> Disminuir no movimientos
     */

    public function getModificarPrecio() {
        if ($this->ventasEquipo > $this->comprasEquipo) {
            return 2;
        } elseif ($this->ventasEquipo < $this->comprasEquipo) {
            return 1;
        }

        if ($this->movimientosEquipo == 0) {
            return 3;
        }
        return 0;
    }

    public function getPorcentajeCompra() {
        if ($this->comprasEquipo != 0) {
            return round($this->comprasEquipo * 100 / $this->movimientosEquipo);
        }
        return 0;
    }

    public function getPorcentajeVenta() {
        if ($this->ventasEquipo != 0) {
            return round($this->ventasEquipo * 100 / $this->movimientosEquipo);
        }
        return 0;
    }

}
