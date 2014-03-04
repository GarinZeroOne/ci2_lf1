<?php

class Stikis_model extends CI_model {

    const codigoRetorno = 'codigoOperacion';
    const mensaje = 'mensaje';
    const codigoOk = 1;
    const codigoKo = 0;
    const stikiPuntos = 'puntos';
    const stikiDinero = 'dinero';

    private $idGp;

    function Stikis_model() {
        parent::__construct();
        $this->load->model('boxes/mejoras_model');
        // Obtener id del GP
        $hoy = date('Y-m-d');

        $sql = "SELECT id FROM circuitos WHERE fecha > '{$hoy}' ORDER BY fecha ASC LIMIT 0,1";
        $this->idGp = $this->db->query($sql)->row()->id;
    }

    //--------------------------------------------------------
    //					OPERACIONES
    //--------------------------------------------------------
    function guardarStiki($datos) {
        $sql = "SELECT * FROM stikis_usuarios WHERE id_usuario = ? AND id_gp = ?";

        $query_check = $this->db->query($sql, array($_SESSION['id_usuario'], $this->idGp));

        // Comprobamos que no tenga ya 2 stikis para el GP
        if ($query_check->num_rows() < 2) {

            // Obtener fondos del usuario
            $fondos_usuario = $this->db->query("SELECT fondos FROM usuarios_banco WHERE id_usuario = ?", array($_SESSION['id_usuario']))->row()->fondos;

            // Comprobar que tipo stiki ha comprado
            // para comparar precio con sus fondos
            // y saber si le llega
            if ($datos['tipoStiki'] == 'puntos') {

                $coste = 400000;
            } else {
                $coste = 30000;
            }

            // MODIFICACION 2011!!! *** Con las mejoras los precios de los stikis se modifican!
            // Mejoras Mecanicos
            $valor_mejora = $this->mejoras_model->get_valor_mejora(2);

            if ($valor_mejora > 0) {
                $coste_con_mejora = $coste - ($coste * $valor_mejora);
            } else {
                $coste_con_mejora = $coste;
            }


            // MODIFICACION 2011!! ** Pueden quedarse en numeros negativos hasta -200.000

            $fondos_despues_de_compra = $fondos_usuario - $coste_con_mejora;


            //Comprobar si le llega
            if ($fondos_despues_de_compra >= -200000) {

                // Comprobar que el piloto seleccionado no tenga ya un stiki
                $sql_check2 = "SELECT id FROM stikis_usuarios 
										WHERE 
											id_usuario = ? 
										AND
											id_gp = ?
										AND 
											id_piloto = ?";
                $query_check2 = $this->db->query($sql_check2, array(
                    $_SESSION['id_usuario'],
                    $this->idGp,
                    $datos['selPiloto']
                        )
                );
                if ($query_check2->num_rows() == 0) {

                    // Guardar stiki
                    $sql = "INSERT INTO stikis_usuarios VALUES('',?,?,?,?,?,?)";

                    $this->db->query($sql, array(
                        $_SESSION['id_usuario'],
                        $this->idGp,
                        $datos['selPiloto'],
                        $datos['tipoStiki'],
                        date('Y-m-d'),
                        'sin procesar'
                            )
                    );

                    // Actualizamos sus datos bancarios, le cobramos vaya...

                    $this->db->query("UPDATE usuarios_banco 
							 SET fondos=fondos - {$coste_con_mejora}
							 WHERE id_usuario = {$_SESSION['id_usuario']}");


                    // devolver msg OK	
                    return "<div class='msgOk'>" . $this->lang->line('stiki_txt_compr_ok') . "</div>";
                } else {
                    // el piloto ya tiene un STIKI para ese GP devolver msg
                    return "<div class='msgErr'>" . $this->lang->line('stiki_txt_piloto_stiki') . "</div>";
                }
            } else {

                // Devolver msg NO TIENES PASTA SUFICIENTE
                return "<div class='msgErr'>" . $this->lang->line('stiki_txt_no_dinero') . "</div>";
            }
        } else {
            // Devolver msg Ya tienes 2 stikis comprados
            return "<div class='msgErr'>" . $this->lang->line('stiki_txt_2_stiki') . "</div>";
        }
    }

    function comprarStiki(Usuario $usuario, $idPiloto, $tipoStiki, $idGp) {


        $stikisGp = $this->getUserGpStikisObject($usuario->getIdUsuario(), $idGp);

        // Comprobamos que no tenga ya 2 stikis para el GP
        if (count($stikisGp) < 2) {
            // Comprobar que tipo stiki ha comprado
            // para comparar precio con sus fondos
            // y saber si le llega
            if ($tipoStiki == Stikis_model::stikiPuntos) {

                $coste = 400000;
            } else {
                $coste = 30000;
            }

            // Mejoras Mecanicos
            $valor_mejora = $this->mejoras_model->getValorMejora($usuario->getIdUsuario(), 2);

            if ($valor_mejora > 0) {
                $coste_con_mejora = $coste - ($coste * $valor_mejora);
            } else {
                $coste_con_mejora = $coste;
            }

            //Comprobar si le llega
            if ($usuario->getFondos() >= -200000) {

                $pilotoConStiki = false;
                foreach ($stikisGp as $stiki) {
                    if ($stiki->getPiloto()->getIdPiloto() == $idPiloto) {
                        $pilotoConStiki = true;
                        break;
                    }
                }

                if (!$pilotoConStiki) {

                    // Guardar stiki
                    $sql = "INSERT INTO stikis_usuarios (id_usuario, id_gp, "
                            . "id_piloto, stiki, fecha_compra, estado, precio_compra)"
                            . "VALUES(?,?,?,?,?,?,?)";

                    $this->db->query($sql, array(
                        $usuario->getIdUsuario(), $idGp, $idPiloto, $tipoStiki, date('Y-m-d'),
                        'sin procesar', $coste_con_mejora)
                    );

                    // Restarle la pasta del banco
                    $resto = $usuario->getFondos() - $coste_con_mejora;

                    $usuario->setFondos($resto);

                    $CI = &get_instance();
                    $CI->load->Model('banco/banco_model');
                    $CI->banco_model->
                            guardarSaldoUsuario($usuario);

                    $concepto = Banco_model::compraStikiDinero;
                    if ($tipoStiki == Stikis_model::stikiPuntos) {
                        $concepto = Banco_model::compraStikiPuntos;
                    }

                    //Registrar movimiento banco
                    $CI->banco_model->registrarMovimiento($idPiloto, $coste_con_mejora
                            , $usuario->getIdUsuario(), $concepto
                            , 0, Banco_model::gasto);
                    // devolver msg OK	

                    $retorno = array(Stikis_model::codigoRetorno => Stikis_model::codigoOk,
                        Stikis_model::mensaje => "Stiki comprado correctamente!");
                    return $retorno;
                } else {
                    // el piloto ya tiene un STIKI para ese GP devolver msg
                    $retorno = array(Stikis_model::codigoRetorno => Stikis_model::codigoKo,
                        Stikis_model::mensaje => "El piloto seleccionado ya tiene un Stiki para este GP");
                    return $retorno;
                }
            } else {

                // Devolver msg NO TIENES PASTA SUFICIENTE
                $retorno = array(Stikis_model::codigoRetorno => Stikis_model::codigoKo,
                    Stikis_model::mensaje => "No tienes suficiente dinero para comprar el Stiki");
                return $retorno;
            }
        } else {
            // Devolver msg Ya tienes 2 stikis comprados
            $retorno = array(Stikis_model::codigoRetorno => Stikis_model::codigoKo,
                Stikis_model::mensaje => "Solo se pueden comprar 2 Stikis por GP");
            return $retorno;
        }
    }

    //--------------------------------------------------------
    //					GETS
    //--------------------------------------------------------

    function getInfoStikis() {

        $sql = "SELECT * FROM 
							stikis_usuarios,pilotos 
						 WHERE 
						 	id_usuario = ? 
						 AND 
						 	id_gp = ?
						 AND 
						 	id_piloto = pilotos.id";

        return $this->db->query($sql, array($_SESSION['id_usuario'], $this->idGp))->result();
    }

    function getStikiData($idStiki) {
        $sql = "SELECT * FROM stikis_usuarios WHERE id = ?";

        return $this->db->query($sql, array($idStiki));
    }

    function getUserGpStikisObject($idUsuario, $idGp) {
        $sql = "SELECT * FROM stikis_usuarios "
                . "WHERE id_usuario = ? "
                . "AND id_gp = ?";

        $result = $this->db->query($sql, array($idUsuario, $idGp))->result();

        $stikis = array();

        foreach ($result as $row) {
            $stikis[] = Stiki::getById($row->id);
        }

        return $stikis;
    }

    /*
     * Funcion que devuelve los stikis comprados para el siguiente Gp por 
     * un usuario (Servicio)
     */

    function getInfoStikisUsuario($idUser) {

        $sql = "SELECT * FROM stikis_usuarios,pilotos 
                        WHERE id_usuario = ? 
                        AND id_gp = ? 
                        AND id_piloto = pilotos.id";

        return $this->db->query($sql, array($idUser, $this->idGp))->result();
    }

    function getStikisEstadisticas($tipo) {
        $query = $this->db->get_where('stikis_usuarios', array("stiki" => $tipo, "id_gp" => $this->idGp));

        return $query->num_rows();
    }

    function cancelar_stiki($id_piloto) {

        $sql_check = "SELECT * FROM stikis_usuarios WHERE id_usuario = ? AND id_gp = ? AND id_piloto = ?";

        $Q = $this->db->query($sql_check, array($_SESSION['id_usuario'], $this->idGp, $id_piloto));

        // Tiene el stiki?
        if ($Q->num_rows() == 1) {
            // Eliminar
            $sql_eliminar = "DELETE FROM stikis_usuarios WHERE id = ?";
            $this->db->query($sql_eliminar, array($Q->row()->id));

            $this->load->model('banco/banco_model');
            // Devolverle el 50% del dinero ke invertio
            if ($Q->row()->stiki == 'puntos') {
                $this->banco_model->sumarDinero(200000, $_SESSION['id_usuario']);
            } else {
                $this->banco_model->sumarDinero(15000, $_SESSION['id_usuario']);
            }

            redirect_lf1('boxes/stikis');
        } else {
            redirect_lf1('boxes/stikis');
        }
    }

    function venderStiki(Stiki $stiki, Usuario $usuario) {
        $sql_eliminar = "DELETE FROM stikis_usuarios WHERE id = ?";
        $this->db->query($sql_eliminar, array($stiki->getIdStiki()));

        $saldo = $usuario->getFondos() + $stiki->getPrecioCompra();

        $usuario->setFondos($saldo);

        $CI = &get_instance();
        $CI->load->Model('banco/banco_model');
        $CI->banco_model->
                guardarSaldoUsuario($usuario);

        $concepto = Banco_model::ventaStikiDinero;
        if ($tipoStiki == Stikis_model::stikiPuntos) {
            $concepto = Banco_model::ventaStikiPuntos;
        }

        //Registrar movimiento banco
        $CI->banco_model->registrarMovimiento($stiki->getPiloto()->getIdPiloto(), $saldo
                , $usuario->getIdUsuario(), $concepto
                , 0, Banco_model::ingreso);

        $retorno = array(Stikis_model::codigoRetorno => Stikis_model::codigoOk,
            Stikis_model::mensaje => "Stiki vendido correctamente");
        return $retorno;
    }
    
    function getStikisUsuarioObject($idUser) {

        $sql = "SELECT * FROM stikis_usuarios
                        WHERE id_usuario = ? ";

        $result = $this->db->query($sql, array($idUser))->result();
        
        $stikis = array();
        
        foreach ($result as $row) {
            $stikis[] = Stiki::getById($row->id);
        }
        
        return $stikis;
    }

}
