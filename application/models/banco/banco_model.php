<?php

class Banco_model extends CI_Model {

    private $iduser;
    public $db_fix;

    const ingreso = 'ingreso';
    const gasto = 'gasto';
    const compraStikiDinero = 'compra_stiki_dinero';
    const compraStikiPuntos = 'compra_stiki_puntos';
    const mejoraIngenieros = 'ingenieros';
    const mejoraPublicistas = 'publicistas';
    const ventaPiloto = 'venta_piloto';
    const ventaEquipo = 'venta_equipo';
    const compraPiloto = 'compra_piloto';
    const compraEquipo = 'compra_equipo';
    const alquilerPiloto = 'alquiler_piloto';
    const ventaAlquilerPiloto = 'venta_alquiler_piloto';
    const ventaStikiDinero = 'venta_stiki_dinero';
    const ventaStikiPuntos = 'venta_stiki_puntos';
    const stikiDinero = 'stiki_dinero';
    const puestoPiloto = 'puesto_piloto';
    const puestoEquipo = 'puesto_equipo';
    const nomina = 'nomina';
    const polePiloto = 'pole_piloto';

    function Banco_model() {
        parent::__construct();
        $this->iduser = $_SESSION['id_usuario'];
    }

    function getSaldo($modo = '') {


        $this->db_fix = $this->load->database('local', TRUE);

        $sql = "SELECT fondos FROM usuarios_banco WHERE id_usuario = ?";
        $query = $this->db->query($sql, array($_SESSION['id_usuario']));

        $saldo = $query->row()->fondos;

        if ($modo == 'formateado') {
            return number_format($saldo, 0, ",", ".");
        } else {
            return $saldo;
        }
    }

    function restarDinero($cantidad) {
        $sql = "UPDATE usuarios_banco SET fondos = fondos - ? WHERE id_usuario = ?";
        $this->db->query($sql, array($cantidad, $_SESSION['id_usuario']));
    }

    function sumarDinero($cantidad, $idUsuario) {
        $sql = "UPDATE usuarios_banco SET fondos = fondos + ? WHERE id_usuario = ?";
        $this->db->query($sql, array($cantidad, $idUsuario));
    }

    function restarDineroUsuario($cantidad, $idUsuario) {
        $sql = "UPDATE usuarios_banco SET fondos = fondos - ? WHERE id_usuario = ?";
        $this->db->query($sql, array($cantidad, $idUsuario));
    }

    function getSaldoUsuario($idUsuario) {
                        
        $sql = "SELECT fondos FROM usuarios_banco WHERE id_usuario = ?";
        $query = $this->db->query($sql, array($idUsuario));
                
        $saldo = $query->row()->fondos;

        return $saldo;
    }

    function guardarSaldoUsuario(Usuario $usuario) {
        $sql = "UPDATE usuarios_banco SET fondos =  ? WHERE id_usuario = ?";
        $this->db->query($sql, array($usuario->getFondos(), $usuario->getIdUsuario()));
    }

    function registrarMovimiento($idPiloto, $dinero, $idUsuario, $conepto
    , $idEquipo, $tipoMovimiento, $texto_concepto = false ) {

        if($texto_concepto)
        {
            $sql = "INSERT INTO movimientos_banco "
                . "(id_piloto, dinero, id_usuario"
                . ", concepto, id_equipo, tipo_movimiento,fecha,texto_concepto) "
                . "VALUES (?,?,?,?,?,?,?,?)";

            $this->db->query($sql, array($idPiloto, $dinero, $idUsuario, $conepto, $idEquipo, $tipoMovimiento, date('Y-m-d H:i:s'),$texto_concepto));
        }
        else
        {

            $sql = "INSERT INTO movimientos_banco "
                . "(id_piloto, dinero, id_usuario"
                . ", concepto, id_equipo, tipo_movimiento,fecha) "
                . "VALUES (?,?,?,?,?,?,?)";

            $this->db->query($sql, array($idPiloto, $dinero, $idUsuario, $conepto
                , $idEquipo, $tipoMovimiento, date('Y-m-d H:i:s')));

        }
        
    }

    /**
     * Devuelve los movimientos de dinero de un usuario
     *
     * @return void
     * @author 
     **/
    function get_movimientos_banco($id_usuario)
    {
        $q = $this->db->select('*')
                      ->from('movimientos_banco')
                      ->where('id_usuario',$id_usuario)
                      ->order_by('fecha','desc')
                      ->limit(25)
                      ->get();
        //dump($q->result());die;
        return $q->result();

    }

}
