<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MovimientoPiloto extends MovimientosPilotos {

    private $movimientosPiloto;
    private $ventasPiloto;
    private $comprasPiloto;

    public function getMovimientosPiloto() {
        return $this->movimientosPiloto;
    }

    public function getVentasPiloto() {
        return $this->ventasPiloto;
    }

    public function getComprasPiloto() {
        return $this->comprasPiloto;
    }

    public function setMovimientosPiloto($movimientosPiloto) {
        $this->movimientosPiloto = $movimientosPiloto;
    }

    public function setVentasPiloto($ventasPiloto) {
        $this->ventasPiloto = $ventasPiloto;
    }

    public function setComprasPiloto($comprasPiloto) {
        $this->comprasPiloto = $comprasPiloto;
    }

    public function __construct($fecha,  $idPiloto) {
        parent::__construct($fecha);
        $CI = &get_instance();
        $CI->load->model('admin/movimientos_mercado_model');

        $this->ventasPiloto = $CI->movimientos_mercado_model->
                        getDatosVentasPiloto($fecha, $idPiloto)->num_rows();
        $this->comprasPiloto = $CI->movimientos_mercado_model->
                        getDatosFichajesPiloto($fecha, $idPiloto)->num_rows();
        $this->movimientosPiloto = $this->ventasPiloto + $this->comprasPiloto;
    }

    public function getPorcentajeMovimientosPiloto() {
        if ($this->movimientosPiloto != 0) {
            $porcentaje = round($this->movimientosPiloto * 100 / $this->getMovimientosTotales(), 2);
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
        if ($this->ventasPiloto > $this->comprasPiloto) {
            return 2;
        } elseif ($this->ventasPiloto < $this->comprasPiloto) {
            return 1;
        }

        if ($this->movimientosPiloto == 0) {
            return 3;
        }
        return 0;
    }

    public function getPorcentajeCompra() {
        if ($this->comprasPiloto != 0) {
            return round($this->comprasPiloto * 100 / $this->movimientosPiloto);
        }
        return 0;
    }

    public function getPorcentajeVenta() {
        if ($this->ventasPiloto != 0) {
            return round($this->ventasPiloto * 100 / $this->movimientosPiloto);
        }
        return 0;
    }

}
