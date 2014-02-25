<?php

class Pilotos_model extends CI_Model {

    private $iduser;

    const fichado = 'fichado';
    const alquilado = 'alquilado';
    const codigoRetorno = 'codigoOperacion';
    const mensaje = 'mensaje';
    const codigoOk = 1;
    const codigoKo = 0;

    function Pilotos_model() {
        parent::__construct();
        $this->load->model('boxes/mejoras_model');
        $this->iduser = $_SESSION['id_usuario'];
    }

    function getInfoPilotos() {
        $sql = "SELECT pilotos.*,equipos.escuderia
								FROM 
									equipos_rel_pilotos, pilotos , equipos
								WHERE 
									pilotos.id = equipos_rel_pilotos.id_piloto
								AND 
									equipos.id = equipos_rel_pilotos.id_equipo";
        return $this->db->query($sql)->result();
    }

    function getInfoPilotosEquipos() {
        $sql = "SELECT pilotos.*,equipos.escuderia, equipos.id as id_equipo
								FROM 
									equipos_rel_pilotos, pilotos , equipos
								WHERE 
									pilotos.id = equipos_rel_pilotos.id_piloto
								AND 
									equipos.id = equipos_rel_pilotos.id_equipo";
        return $this->db->query($sql)->result();
    }

    function getMisPilotos() {
        $sql = "SELECT pilotos.*,equipos.escuderia,usuarios_pilotos.puntos
						 FROM 
						   usuarios_pilotos,pilotos,equipos,equipos_rel_pilotos
						 WHERE
						   usuarios_pilotos.id_piloto = pilotos.id
					     AND
						   pilotos.id = equipos_rel_pilotos.id_piloto
						 AND
						   equipos.id = equipos_rel_pilotos.id_equipo
						 AND
						   usuarios_pilotos.id_usuario = ? 
						 AND 
						   usuarios_pilotos.activo = 1";
        return $this->db->query($sql, array($this->iduser))->result();
    }

    /*
     * Funcion que devuelve los pilotos fichados por un usuario (servicio)
     */

    function getMisPilotosUsuario($idUser) {
        $sql = "SELECT pilotos.*,equipos.escuderia,usuarios_pilotos.puntos
						 FROM 
						   usuarios_pilotos,pilotos,equipos,equipos_rel_pilotos
						 WHERE
						   usuarios_pilotos.id_piloto = pilotos.id
					     AND
						   pilotos.id = equipos_rel_pilotos.id_piloto
						 AND
						   equipos.id = equipos_rel_pilotos.id_equipo
						 AND
						   usuarios_pilotos.id_usuario = ? 
						 AND 
						   usuarios_pilotos.activo = 1";
        return $this->db->query($sql, array($idUser))->result();
    }

    // Esta funcion se usa solo para el resumen semanal del desglose
    function get_nombre_piloto_por_id($id_piloto) {

        if ($id_piloto != 0) {

            $sql = "SELECT * FROM pilotos WHERE id = ? ";
            $q = $this->db->query($sql, array($id_piloto));

            return $q->row()->nombre . " " . $q->row()->apellido;
        }
    }

    function get_nombre_equipo_por_id($id_equipo) {
        if ($id_equipo != 0) {
            $sql = "SELECT * FROM equipos WHERE id = ? ";
            $q = $this->db->query($sql, array($id_equipo));

            return $q->row()->escuderia;
        }
    }

    function fichar(Piloto $piloto, Usuario $usuario) {

        $error = array();

        $error[0] = '<div class="msgErr">Has seleccionado un piloto que ya posees actualmente!</div>';
        $error[1] = '<div class="msgErr">No dispones del dinero suficiente para permitirte el piloto</div>';
        $error[2] = '<div class="msgErr">Solo puedes disponer de un maximo de 7 pilotos!</div>';

        if (count($usuario->getPilotos()) == 7) {
            $retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoKo,
                Pilotos_model::mensaje => $error[2]);
            return $retorno;
        }

        $pilotoYaFichado = false;
        foreach ($usuario->getPilotos() as $pilotoUsuario) {
            if ($pilotoUsuario->getIdPiloto() == $piloto->getIdPiloto()) {
                $pilotoYaFichado = true;
                break;
            }
        }

        if ($pilotoYaFichado) {
            $retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoKo,
                Pilotos_model::mensaje => $error[0]);
            return $retorno;
        }

        // Comprobar que con la compra no se quede en mas de -200.000
        if ($usuario->getFondos() - $piloto->getValorActual() < -200000) {
            $retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoKo,
                Pilotos_model::mensaje => $error[1]);
            return $retorno;
        } else {
            // Comprobar si se trata de un piloto vendido,UPDATE
            $sql_piloto = "SELECT id FROM usuarios_pilotos WHERE id_usuario = ? AND id_piloto = ? AND activo = 0";
            $existe = $this->db->query($sql_piloto, array($usuario->getIdUsuario(), $piloto->getIdPiloto()))->num_rows();

            if ($existe) {

                $sql_update = "UPDATE usuarios_pilotos 
                                SET activo = 1 ,fecha_fichaje = ?, tipo_compra = ?,
                                    precio_fichaje = ?
                                WHERE id_usuario = ? 
                                AND id_piloto = ?";
                $this->db->query($sql_update, array(date('Y-m-d')
                    , Pilotos_model::fichado, $piloto->getValorActual()
                    , $usuario->getIdUsuario()
                    , $piloto->getIdPiloto()));
            } else {
                // Piloto nuevo, INSERT
                $sql_insert = "INSERT INTO usuarios_pilotos (id_usuario, id_piloto, fecha_fichaje,"
                        . " fecha_venta, activo, puntos, tipo_compra, precio_fichaje, dinero)" . " VALUES(?,?,?,'',1,0,?,?,0)";
                $this->db->query($sql_insert, array($usuario->getIdUsuario()
                    , $piloto->getIdPiloto(), date('Y-m-d')
                    , Pilotos_model::fichado, $piloto->getValorActual()));
            }

            //Se registra el fichaje
            $this->insertFichajePiloto($piloto, $usuario);

            // Restarle la pasta del banco
            $resto = $usuario->getFondos() - $piloto->getValorActual();

            $usuario->setFondos($resto);

            $CI = &get_instance();
            $CI->load->Model('banco/banco_model');
            $CI->banco_model->guardarSaldoUsuario($usuario);
            
            //Registrar movimiento banco
            $CI->banco_model->registrarMovimiento($piloto->getIdPiloto(), $piloto->getValorActual()
                    , $usuario->getIdUsuario(), Banco_model::compraPiloto
                    , 0, Banco_model::gasto);

            $retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoOk,
                Pilotos_model::mensaje => "Piloto fichado correctamente");

            // TODO OK
            return $retorno;
        }
    }

    function alquilar(Piloto $piloto, Usuario $usuario) {

        $error = array();

        $error[0] = '<div class="msgErr">Has seleccionado un piloto que ya posees actualmente!</div>';
        $error[1] = '<div class="msgErr">No dispones del dinero suficiente para permitirte el piloto</div>';
        $error[2] = '<div class="msgErr">Solo puedes disponer de un maximo de 7 pilotos!</div>';

        if (count($usuario->getPilotos()) == 7) {
            $retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoKo,
                Pilotos_model::mensaje => $error[2]);
            return $retorno;
        }

        $pilotoYaFichado = false;
        foreach ($usuario->getPilotos() as $pilotoUsuario) {
            if ($pilotoUsuario->getIdPiloto() == $piloto->getIdPiloto()) {
                $pilotoYaFichado = true;
                break;
            }
        }

        if ($pilotoYaFichado) {
            $retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoKo,
                Pilotos_model::mensaje => $error[0]);
            return $retorno;
        }

        // Comprobar que con la compra no se quede en mas de -200.000
        if ($usuario->getFondos() - $piloto->getPrecioAlquiler() < -200000) {
            $retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoKo,
                Pilotos_model::mensaje => $error[1]);
            return $retorno;
        } else {
            // Comprobar si se trata de un piloto vendido,UPDATE
            $sql_piloto = "SELECT id FROM usuarios_pilotos WHERE id_usuario = ? AND id_piloto = ? AND activo = 0";
            $existe = $this->db->query($sql_piloto, array($usuario->getIdUsuario(), $piloto->getIdPiloto()))->num_rows();

            if ($existe) {

                $sql_update = "UPDATE usuarios_pilotos 
                                SET activo = 1 ,fecha_fichaje = ?, tipo_compra = ?,
                                    precio_fichaje = ?
                                WHERE id_usuario = ? 
                                AND id_piloto = ?";
                $this->db->query($sql_update, array(date('Y-m-d')
                    , Pilotos_model::alquilado, $piloto->getPrecioAlquiler()
                    , $usuario->getIdUsuario()
                    , $piloto->getIdPiloto()));
            } else {
                // Piloto nuevo, INSERT
                $sql_insert = "INSERT INTO usuarios_pilotos (id_usuario, id_piloto, fecha_fichaje,"
                        . " fecha_venta, activo, puntos, tipo_compra, precio_fichaje, dinero)" . " VALUES(?,?,?,'',1,0,?,?,0)";
                $this->db->query($sql_insert, array($usuario->getIdUsuario()
                    , $piloto->getIdPiloto(), date('Y-m-d')
                    , Pilotos_model::alquilado, $piloto->getPrecioAlquiler()));
            }

            //Se registra el fichaje            
            $this->insertFichajePiloto($piloto, $usuario);

            // Restarle la pasta del banco
            $resto = $usuario->getFondos() - $piloto->getPrecioAlquiler();

            $usuario->setFondos($resto);

            $CI = &get_instance();
            $CI->load->Model('banco/banco_model');
            $CI->banco_model->
                    guardarSaldoUsuario($usuario);

            //Registrar movimiento banco
            $CI->banco_model->registrarMovimiento($piloto->getIdPiloto(), $piloto->getPrecioAlquiler()
                    , $usuario->getIdUsuario(), Banco_model::alquilerPiloto
                    , 0, Banco_model::gasto);

            $retorno = array(Pilotos_model::codigoRetorno => Pilotos_model::codigoOk,
                Pilotos_model::mensaje => "Piloto alquilado correctamente");
            return $retorno;
        }
    }

    /*function vender($datos) {

        /**  BUG SERIO.SI VENDES UN PILOTO Y SEGUIDO ACTUALIZAS LA PAGINA, SE VUELVE A ENVIAR EL POST Y SE VUELVE A INGRESAR LA PASTA
         *  Hay que comprobar primero que se este vendiendo un piloto ACTIVO!! 
         *
        foreach ($datos['piloto'] as $id_piloto) {

            // Comprobar que el piloto este activo
            $piloto_activo = $this->db->query("SELECT activo FROM usuarios_pilotos WHERE id_usuario = ? AND id_piloto = ? ", array($this->iduser, $id_piloto))
                            ->row()
                    ->activo;

            // Si no tiene el piloto activo, devolvemos mensaje de error
            if ($piloto_activo == 0) {
                // ---------------------------------------------------------------------
                // Algun  listo intenta hacer la trampa del año pasao, guardamos en bd un log con sus datos
                // ---------------------------------------------------------------------		
                $data = array(
                    'id' => '',
                    'id_usuario' => $this->iduser,
                    'fecha' => date('Y-m-d h:i:s'), //datetime
                    'comentario' => 'Alguien ha vendido un piloto y le ha dado al F5 para hacer el trapi! CAZADO!',
                );


                $this->db->insert('sospechosos', $data);

                return '<div class="msgErr">Ya has vendido este piloto.</div>';
            }


            // Poner inactivo el piloto
            $sql_inactivo = "UPDATE usuarios_pilotos SET 
														activo = 0,
														fecha_venta = ?
													 WHERE 
													 	id_usuario = ?
													 AND 
													 	id_piloto = ?";
            $this->db->query($sql_inactivo, array(date('Y-m-d'), $this->iduser, $id_piloto));

            // Sumarle la pasta de la venta al banco
            $pasta_venta_piloto = $this->db->query("SELECT dinero_venta 
														   FROM pilotos 
														   WHERE id = ?", array($id_piloto))->row()->dinero_venta;
            $sql_ingreso = "UPDATE usuarios_banco SET fondos = fondos + ? WHERE id_usuario = ?";
            $this->db->query($sql_ingreso, array($pasta_venta_piloto, $this->iduser));
        }

        // TODO OK
        return '<div class="msgOk">' . $this->lang->line('piloto_txt_vendido_ok') . '</div>';
    }*/

    function venderPiloto(Usuario $usuario, PilotoUsuario $piloto) {

        // Poner inactivo el piloto
        $sql_inactivo = "UPDATE usuarios_pilotos SET activo = 0,fecha_venta = ?
                        WHERE id_usuario = ?
                        AND id_piloto = ?";
        $this->db->query($sql_inactivo, array(date('Y-m-d'), $usuario->getIdUsuario(), $piloto->getIdPiloto()));        

        $CI = &get_instance();
        $CI->load->Model('banco/banco_model');
        
        if ($piloto->getTipoCompra() == 'fichado') {
            $ingreso = $piloto->getValorActual();
            $concepto = Banco_model::ventaPiloto;
            $fondos = $usuario->getFondos() + $piloto->getValorActual();
        } else {
            $ingreso = $piloto->getPrecioAlquiler();
            $concepto = Banco_model::ventaAlquilerPiloto;
            $fondos = $usuario->getFondos() + $piloto->getPrecioAlquiler();
        }

        $this->insertVentaPiloto($piloto, $usuario);

        $usuario->setFondos($fondos);

        
        $CI->banco_model->guardarSaldoUsuario($usuario);

        //Registrar movimiento banco
        $CI->banco_model->registrarMovimiento($piloto->getIdPiloto(), $ingreso
                , $usuario->getIdUsuario(), $concepto
                , 0, Banco_model::ingreso);        
        
        return "Piloto vendido correctamente!";
    }

    function insertFichajePiloto(Piloto $piloto, Usuario $usuario) {
        $sqlFichaje = "INSERT INTO fichajes_pilotos "
                . "( id_piloto, id_usuario, fecha) values (?,?,?)";

        $this->db->query($sqlFichaje, array($piloto->getIdPiloto(), $usuario->getIdUsuario(), date('Y-m-d')));
    }

    function insertVentaPiloto(Piloto $piloto, Usuario $usuario) {
        $sqlFichaje = "INSERT INTO ventas_pilotos "
                . "( id_piloto, id_usuario, fecha) values (?,?,?)";

        $this->db->query($sqlFichaje, array($piloto->getIdPiloto(), $usuario->getIdUsuario(), date('Y-m-d')));
    }

    //Funcion que devuelve todos los pilotos de la parrilla
    function getPilotos() {
        $sql = "SELECT * FROM pilotos";

        return $this->db->query($sql)->result();
    }

    function get_pilotos_buenos() {

        $sql = "SELECT * FROM pilotos order by dinero_compra DESC limit 0,10";

        return $this->db->query($sql)->result();
    }

    function getPiloto(
    $idPiloto) {
        $sql = "SELECT * FROM pilotos WHERE id = ?";

        return $this->db->query($sql, array($idPiloto))->row();
    }

    function getValorPiloto($idPiloto) {
        $sql = "SELECT *
                FROM valor_piloto
                WHERE id_piloto = ?
                ORDER BY fecha DESC
                LIMIT 0,1";

        return $this->db->query($sql, array($idPiloto))->row();
    }

    function getPilotosObject() {
        $sql = "SELECT * FROM pilotos";

        $result = $this->db->query($sql)->result();

        $pilotos = array();

        foreach ($result as $row) {
            $piloto = Piloto::getById($row->id);
            $equipo = Equipo::getById(
                            $row->id_equipo);
            $piloto->setEquipo($equipo);

            $pilotos[] = $piloto;
        }

        return $pilotos;
    }

    function getPilotosFichaObject() {
        $sql = "SELECT * FROM pilotos";

        $result = $this->db->query($sql)->result();

        $pilotos = array();

        foreach ($result as $row) {
            $pilotoFicha = PilotoFicha::getById($row->id);
            $equipo = Equipo::getById($row->
                            id_equipo);
            $pilotoFicha->setEquipo($equipo);

            $pilotos[] = $pilotoFicha;
        }

        return $pilotos;
    }

    function getPosicionPilotoMundial($idPiloto) {
        $sql = "SELECT * FROM clasificacion_mundial_pilotos "
                . "WHERE id_piloto = ?";

        $result = $this->db->query($sql, array(
            $idPiloto));

        return $result;
    }

    function getPosicionPilotoGp($idPiloto, $idGp) {
        $sql = "SELECT * FROM resultados_pilotos " . "WHERE id_piloto = ? "
                . "AND id_gp = ?";

        $result = $this->db->query($sql, array(
            $idPiloto, $idGp));

        return $result;
    }

    function getPorcentajeMejora($numPuestos) {
        $sql = "SELECT * FROM mejora_piloto "
                . "WHERE num_puestos = ?";

        $result = $this->db->query($sql, array(
            $numPuestos));

        return $result;
    }

    function guardarValorPiloto(Piloto $piloto) {
        $sql = "INSERT INTO valor_piloto " . "( valor_actual, valor_anterior, fecha, id_piloto) "
                . "VALUES (?,?,?,?)";

        $this->db->query($sql, array(
            $piloto->getValorActual()
            , $piloto->getValorAnterior()
            , date('Y-m-d H:i:s'), $piloto->getIdPiloto()));
    }

    function getPuntosPiloto($idPiloto) {
        $sql = "SELECT * FROM resultados_pilotos "
                . "WHERE id_piloto = ? ";

        $result = $this->db->query($sql, array($idPiloto))->result();

        $sqlPuntos = "SELECT * FROM premios_manager_pilotos WHERE posicion = ?";

        $puntos = 0;

        foreach ($result as $row) {

            $puntos += $this->db->query($sqlPuntos, array(
                        $row->posicion))->row()->puntos_manager;
        }

        return $puntos;
    }

    function getDatosPilotoUsuario($idPiloto, $idUsuario) {
        $sql = "SELECT * FROM usuarios_pilotos " . "WHERE id_piloto = ? "
                . "AND id_usuario = ? ";

        $result = $this->db->query($sql, array(
            $idPiloto, $idUsuario));

        return $result;
    }

    function getDineroGanadoPiloto($idPiloto) {
        $sql = "SELECT * FROM resultados_pilotos "
                . "WHERE id_piloto = ? ";

        $result = $this->db->query($sql, array($idPiloto))->result();

        $sqlDinero = "SELECT * FROM premios_manager_pilotos WHERE posicion = ?";

        $dinero = 0;

        foreach ($result as $row) {

            $dinero += $this->db->query($sqlDinero, array(
                                $row->posicion))
                            ->row()->dinero;
        }

        return $dinero;
    }

    function getValoresMercadoPilotoObject($idPiloto) {
        $sql = "SELECT * FROM valor_piloto "
                . "WHERE id_piloto = ? ";

        $result = $this->db->query($sql, array($idPiloto))->result();

        $valoresMercado = array();

        foreach ($result as $row) {
            $valorMercado = new ValorMercado();
            $valorMercado->setFecha($row->fecha);


            $valorMercado->setPrecio($row->valor_actual);

            $valoresMercado[] = $valorMercado;
        }

        return $valoresMercado;
    }

    function getValorMaximoPiloto($idPiloto) {
        $sql = "SELECT max(valor_actual) valorMaximo FROM valor_piloto "
                . "WHERE id_piloto = ? ";

        $result = $this->db->query($sql, array(
            $idPiloto));

        return $result->row()->valorMaximo;
    }

    function getValorMinimoPiloto($idPiloto) {
        $sql = "SELECT min(valor_actual) valorMinimo FROM valor_piloto "
                . "WHERE id_piloto = ? ";

        $result = $this->db->query($sql, array(
            $idPiloto));

        return $result->row()->valorMinimo;
    }

    function getPilotosUsuarioObject($idUsuario) {
        $sql = "SELECT pilotos.*
                FROM usuarios_pilotos,pilotos
                WHERE usuarios_pilotos.id_piloto = pilotos.id            
                AND usuarios_pilotos.id_usuario = ? 
                AND usuarios_pilotos.activo = 1";
        $result = $this->db->query($sql, array($idUsuario))->result();

        $pilotos = array();

        foreach ($result as $row) {
            $piloto = PilotoUsuario::getById($row->id, $idUsuario);
            $equipo = Equipo::getById($row->id_equipo);
            $piloto->setEquipo($equipo);

            $pilotos[] = $piloto;
        }

        return $pilotos;
    }

}
