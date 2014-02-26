<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MovimientosPilotos {

    private $movimientosTotales;
    private $ventasTotales;
    private $comprasTotales;

    public function getMovimientosTotales() {
        return $this->movimientosTotales;
    }

    public function getVentasTotales() {
        return $this->ventasTotales;
    }

    public function getComprasTotales() {
        return $this->comprasTotales;
    }

    public function setMovimientosTotales($movimientosTotales) {
        $this->movimientosTotales = $movimientosTotales;
    }

    public function setVentasTotales($ventasTotales) {
        $this->ventasTotales = $ventasTotales;
    }

    public function setComprasTotales($comprasTotales) {
        $this->comprasTotales = $comprasTotales;
    }

    public function __construct($fecha) {
        $CI = &get_instance();
        $CI->load->model('admin/movimientos_mercado_model');

        $this->ventasTotales = $CI->movimientos_mercado_model->
                        getDatosVentasPilotos($fecha)->num_rows();
        $this->comprasTotales = $CI->movimientos_mercado_model->
                        getDatosFichajesPilotos($fecha)->num_rows();
        $this->movimientosTotales = $this->ventasTotales + $this->comprasTotales;
    }

}
