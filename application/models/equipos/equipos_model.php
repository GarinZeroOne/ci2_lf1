<?php

class Equipos_model extends CI_Model {

    private $iduser;

    const codigoRetorno = 'codigoOperacion';
    const mensaje = 'mensaje';
    const codigoOk = 1;
    const codigoKo = 0;

    function Equipos_model() {
        parent::__construct();
        $this->load->model('boxes/mejoras_model');
        $this->iduser = $_SESSION['id_usuario'];
    }

    function getInfoEquipos() {
        $sql = "SELECT * FROM equipos";
        return $this->db->query($sql)->result();
    }

    function getInfoEquipo($idEquipo) {
        $sql = "SELECT * FROM equipos WHERE id = ?";
        return $this->db->query($sql, array($idEquipo))->row();
    }

    function getMisEquipos() {
        $sql = "SELECT equipos.*,usuarios_equipos.*
								FROM
								equipos,usuarios_equipos
								WHERE
									usuarios_equipos.id_usuario = ?
								AND
									usuarios_equipos.id_equipo = equipos.id
								AND
									usuarios_equipos.activo = 1";
        return $this->db->query($sql, array($this->iduser))->result();
    }

    /*
     * Funcion que devuelve los equipos de un usuario (Servicio)
     */

    function getMisEquiposUsuario($idUser) {
        $sql = "SELECT equipos.*,usuarios_equipos.*
                FROM equipos,usuarios_equipos
                WHERE usuarios_equipos.id_usuario = ?
                AND usuarios_equipos.id_equipo = equipos.id
                AND usuarios_equipos.activo = 1";
        return $this->db->query($sql, array($idUser))->result();
    }

    function fichar($datos) {
        $error = array();
        $pilotos = array();

        $error[0] = '<div class="msgErr">' . $this->lang->line('fich_equipo_txt_equipo_existe') . '</div>';
        $error[1] = '<div class="msgErr">' . $this->lang->line('fich_equipo_txt_no_dinero') . '</div>';
        $error[2] = '<div class="msgErr">' . $this->lang->line('fich_equipo_txt_max_equipo') . '</div>';

        // Numero de equipos que ha selecciona comprar
        $num_comprar = count($datos['equipo']);

        // Numero de equipos que posee el usuario		
        $sql = "SELECT id FROM usuarios_equipos WHERE id_usuario = ? AND activo = 1";
        $num_equipos = $this->db->query($sql, array($this->iduser))->num_rows();

        // Numero de equipos con los que se quedara despues de la compra
        $num_futuros_equipos = $num_equipos + $num_comprar;

        if ($num_equipos == 5 || $num_futuros_equipos > 5) {
            return $error[2];
        }

        // Mejoras Ojeadores
        $valor_mejora = $this->mejoras_model->get_valor_mejora(1);

        foreach ($datos['equipo'] as $id_equipo) {
            // Comprobar que no lo tenga ya comprao
            $sql_check_equipo = "SELECT id FROM usuarios_equipos WHERE id_usuario = ? AND id_equipo = ? AND activo = 1";
            $query = $this->db->query($sql_check_equipo, array($this->iduser, $id_equipo));

            if (!$query->num_rows()) {
                // Guardar el precio del equipo en una variable
                // para luego comparar precio total con pasta que tiene
                $precio_equipo = $this->db->query("SELECT precio_compra 
														  FROM equipos WHERE id = ?", array($id_equipo)
                        )->row()->precio_compra;



                //die("llego");

                if ($valor_mejora > 0) {
                    $precio_equipo = $precio_equipo - ($precio_equipo * $valor_mejora);
                    $precio_total = $precio_total + $precio_equipo;
                } else {
                    $precio_total = $precio_total + $precio_equipo;
                }


                // Guardo todos los ids de equipos que pasen para las insert

                $equipos[] = $id_equipo;
            } else {
                return $error[0];
            }
        }

        $saldo = $this->db->query("SELECT fondos FROM usuarios_banco WHERE id_usuario = ?", array($this->iduser))->row()->fondos;

        // GUARDAR EQUIPO \\
        /*         * ************************************** */
        //echo $precio_total." > ".$saldo;
        $saldo_despues_de_compra = $saldo - $precio_total;

        if ($saldo_despues_de_compra < -200000) {
            return $error[1];
        } else {
            // Guardar pilotos en BD
            foreach ($equipos as $equipo) {

                // Comprobar si se trata de un equipo vendido,UPDATE
                $sql_equipo = "SELECT id FROM usuarios_equipos WHERE id_usuario = ? AND id_equipo = ? AND activo = 0";
                $existe = $this->db->query($sql_equipo, array($this->iduser, $equipo))->num_rows();

                if ($existe) {

                    $sql_update = "UPDATE usuarios_equipos SET 
														  activo = 1 ,
														  fecha_compra = ?
														  WHERE id_usuario = ? AND id_equipo = ?";
                    $this->db->query($sql_update, array(date('Y-m-d'), $this->iduser, $equipo));
                } else {
                    // Piloto nuevo, INSERT
                    $sql_insert = "INSERT INTO usuarios_equipos VALUES('',?,?,?,'',1,0)";
                    $this->db->query($sql_insert, array($this->iduser, $equipo, date('Y-m-d')));
                }
            }

            // Restarle la pasta del banco
            $resto = $saldo - $precio_total;

            $sql_cobrar = "UPDATE usuarios_banco SET fondos = ? 
												 WHERE id_usuario = ?";
            $this->db->query($sql_cobrar, array($resto, $this->iduser));

            // TODO OK
            return '<div class="msgOk">' . $this->lang->line('fich_equipo_txt_ok') . '</div>';
        }
    }

    /*
     * Fichar equipo (servicio)
     */

    function comprar(Usuario $usuario, Equipo $equipo) {
        $error = array();

        $error[0] = 'Ya tienes comprado este equipo';
        $error[1] = 'No tienes suficiente dinero para comprar este equipo';
        $error[2] = 'No se pueden tener mas de 5 equipos';
        $error[3] = 'Compra realizada correctamente!';

        if (count($usuario->getEquipos()) == 5) {
            $retorno = array(Equipos_model::codigoRetorno => Equipos_model::codigoKo,
                Equipos_model::mensaje => $error[2]);
            return $retorno;
        }

        $equipoYaFichado = false;
        foreach ($usuario->getEquipos() as $equipoUsuario) {
            if ($equipoUsuario->getIdEquipo() == $equipo->getIdEquipo()) {
                $equipoYaFichado = true;
                break;
            }
        }

        if ($equipoYaFichado) {
            $retorno = array(Equipos_model::codigoRetorno => Equipos_model::codigoKo,
                Equipos_model::mensaje => $error[0]);
            return $retorno;
        }


        // GUARDAR EQUIPO \\
        $saldo_despues_de_compra = $usuario->getFondos() - $equipo->getValorActual();

        if ($saldo_despues_de_compra < -200000) {
            $retorno = array(Equipos_model::codigoRetorno => Equipos_model::codigoKo,
                Equipos_model::mensaje => $error[1]);
            return $retorno;
        } else {
            // Comprobar si se trata de un equipo vendido,UPDATE
            $sql_equipo = "SELECT id FROM usuarios_equipos WHERE id_usuario = ? AND id_equipo = ? AND activo = 0";
            $existe = $this->db->query($sql_equipo, array($usuario->getIdUsuario(), $equipo->getIdEquipo()))->num_rows();

            if ($existe) {

                $sql_update = "UPDATE usuarios_equipos SET activo = 1 ,fecha_compra = ?
                                , precio_compra = ?
                                WHERE id_usuario = ? AND id_equipo = ?";
                $this->db->query($sql_update, array(date('Y-m-d'), $equipo->getValorActual()
                    , $usuario->getIdUsuario(), $equipo->getIdEquipo()));
            } else {
                // Equipo nuevo, INSERT
                $sql_insert = "INSERT INTO usuarios_equipos (id_usuario, id_equipo,"
                        . " fecha_compra, fecha_venta, activo, puntos, precio_compra, dinero)"
                        . " VALUES(?,?,?,'',1,0,?,0)";
                $this->db->query($sql_insert, array($usuario->getIdUsuario()
                    , $equipo->getIdEquipo(), date('Y-m-d')
                    , $equipo->getValorActual()));
            }

            $this->insertCompraEquipo($equipo, $usuario);

            $textoGarin = "Has comprado la escuderia "
                    . $equipo->getEscuderia();

            //Registrar movimiento banco
            $CI->banco_model->registrarMovimiento(0, $equipo->getValorActual()
                    , $usuario->getIdUsuario(), Banco_model::compraEquipo
                    , $equipo->getIdEquipo(), Banco_model::gasto, $textoGarin);

            $usuario->setFondos($saldo_despues_de_compra);

            $CI = &get_instance();
            $CI->load->Model('banco/banco_model');
            $CI->banco_model->guardarSaldoUsuario($usuario);
            // TODO OK

            $retorno = array(Equipos_model::codigoRetorno => Equipos_model::codigoOk,
                Equipos_model::mensaje => $error[3]);
            return $retorno;
        }
    }

    // ALGO PETA AKI; OJEAR
    function vender($datos) {
        //print_r($datos);
        foreach ($datos['equipo'] as $equipo) {

            /* En 2011 se jugo toda la temporada con  el BUG de vender un equipo y darle F5, como
              no se comprueba si ya esta vendindo podias  tener dinero infinito! */
            // Comprobar que el piloto este activo
            $equipo_activo = $this->db->query("SELECT activo FROM usuarios_equipos WHERE id_usuario = ? AND id_equipo = ? ", array($this->iduser, $equipo))
                            ->row()
                    ->activo;

            // Si no tiene el piloto activo, devolvemos mensaje de error
            if ($equipo_activo == 0) {


                // ---------------------------------------------------------------------
                // Algun  listo intenta hacer la trampa del año pasao, guardamos en bd un log con sus datos
                // ---------------------------------------------------------------------		
                $data = array(
                    'id' => '',
                    'id_usuario' => $this->iduser,
                    'fecha' => date('Y-m-d h:i:s'), //datetime
                    'comentario' => 'Alguien ha vendido un equipo y le ha dado al F5 para hacer el trapi! CAZADO!',
                );

                $this->db->insert('sospechosos', $data);


                return '<div class="msgErr">Ya has vendido este equipo.</div>';
            }


            //echo "entra".$equipo;
            // Poner inactivo el piloto
            $sql_inactivo = "UPDATE usuarios_equipos SET activo = 0,
														fecha_venta = ?
													 WHERE id_usuario = ?
													 AND id_equipo = ?";
            $this->db->query($sql_inactivo, array(date('Y-m-d'), $this->iduser, $equipo));

            // Sumarle la pasta de la venta al banco
            $pasta_venta_piloto = $this->db->query("SELECT precio_venta 
														   FROM equipos 
														   WHERE id = ?", array($equipo))->row()->precio_venta;

            $sql_ingreso = "UPDATE usuarios_banco SET fondos = fondos + ? WHERE id_usuario = ?";
            $this->db->query($sql_ingreso, array($pasta_venta_piloto, $this->iduser));
        }
        // TODO OK
        return '<div class="msgOk">' . $this->lang->line('equipo_txt_vendido_ok') . '</div>';
    }

    /*
     * Función utilizada para vender equipos (Servicio)
     */

    function venderEquipo(Usuario $usuario, Equipo $equipo) {

        // Poner inactivo el equipo
        $sql_inactivo = "UPDATE usuarios_equipos 
                            SET activo = 0,fecha_venta = ?
                            WHERE id_usuario = ?
                            AND id_equipo = ?";
        $this->db->query($sql_inactivo, array(date('Y-m-d')
            , $usuario->getIdUsuario(), $equipo->getIdEquipo()));

        $CI = &get_instance();
        $CI->load->Model('banco/banco_model');

        $fondos = $usuario->getFondos() + $equipo->getValorActual();
        $usuario->setFondos($fondos);

        $CI->banco_model->guardarSaldoUsuario($usuario);

        $textoGarin = "Has recibido ingresos por la venta de la escuderia "
                . $equipo->getEscuderia();

        //Registrar movimiento banco
        $CI->banco_model->registrarMovimiento(0, $equipo->getValorActual()
                , $usuario->getIdUsuario(), Banco_model::ventaEquipo
                , $equipo->getIdEquipo(), Banco_model::ingreso, $textoGarin);

        $this->insertVentaEquipo($equipo, $usuario);

        // TODO OK
        return 'Operación realizada correctamente!';
    }

    function getValorEquipo($idEquipo) {
        $sql = "SELECT *
                FROM valor_equipo
                WHERE id_equipo = ?
                ORDER BY fecha DESC
                LIMIT 0,1";

        return $this->db->query($sql, array($idEquipo))->row();
    }

    function getEquiposObject() {
        $sql = "SELECT * FROM equipos";

        $result = $this->db->query($sql)->result();

        $equipos = array();

        $this->load->model('pilotos/pilotos_model');

        foreach ($result as $row) {
            $equipo = Equipo::getById($row->id);
            $pilotos = $this->getPilotosEquipoObject($row->id);
            $equipo->setPilotos($pilotos);
            $equipos[] = $equipo;
        }

        return $equipos;
    }

    function getPilotosEquipoObject($idEquipo) {
        $sql = "SELECT * FROM pilotos "
                . "WHERE id_equipo = ?";

        $result = $this->db->query($sql, array($idEquipo))->result();

        $pilotos = array();

        foreach ($result as $row) {
            $piloto = Piloto::getById($row->id);

            $pilotos[] = $piloto;
        }

        return $pilotos;
    }

    function getPosicionEquipoMundial($idEquipo) {
        $sql = "SELECT * FROM clasificacion_mundial_equipos "
                . "WHERE id_equipo = ?";

        $result = $this->db->query($sql, array($idEquipo));

        return $result;
    }

    function getPosicionEquipoGp($idEquipo, $idGp) {
        $sql = "SELECT * FROM resultados_equipos "
                . "WHERE id_equipo = ? "
                . "AND id_gp = ?";

        $result = $this->db->query($sql, array($idEquipo, $idGp));

        return $result;
    }

    function getPorcentajeMejora($numPuestos) {
        $sql = "SELECT * FROM mejora_equipo "
                . "WHERE num_puestos = ?";

        $result = $this->db->query($sql, array($numPuestos));

        return $result;
    }

    function guardarValorEquipo(Equipo $equipo) {
        /*
         * Se comprueba si existe valor para el equipo en el dia,
         * si existe se modifica, si no se inserta nuevo.
         */
        $sql = "SELECT * FROM valor_equipo "
                . "WHERE id_equipo = ? "
                . "AND fecha = ?";

        $existeValor = $this->db->query($sql, array($equipo->getIdEquipo(),
                    date('Y-m-d')))->num_rows();


        if ($existeValor) {
            $sql = "UPDATE valor_equipo SET valor_actual = ? , "
                    . "valor_anterior = ? "
                    . "WHERE id_equipo = ? "
                    . "AND fecha = ? ";

            $this->db->query($sql, array($equipo->getValorActual()
                , $equipo->getValorAnterior()
                , $equipo->getIdEquipo(), date('Y-m-d')));
        } else {
            $sql = "INSERT INTO valor_equipo "
                    . "( valor_actual, valor_anterior, fecha, id_equipo) "
                    . "VALUES (?,?,?,?)";

            $this->db->query($sql, array($equipo->getValorActual()
                , $equipo->getValorAnterior()
                , date('Y-m-d'), $equipo->getIdEquipo()));
        }
    }

    function getPuntosEquipo($idEquipo) {
        $sql = "SELECT * FROM resultados_equipos "
                . "WHERE id_equipo = ? ";

        $result = $this->db->query($sql, array($idEquipo))->result();

        $sqlPuntos = "SELECT * FROM premios_manager_equipos WHERE posicion = ?";

        $puntos = 0;

        foreach ($result as $row) {

            $puntos += $this->db->query($sqlPuntos, array($row->posicion))
                            ->row()->puntos_manager;
        }

        return $puntos;
    }

    function getDineroGanadoEquipo($idEquipo) {
        $sql = "SELECT * FROM resultados_equipos "
                . "WHERE id_equipo = ? ";

        $result = $this->db->query($sql, array($idEquipo))->result();

        $sqlDinero = "SELECT * FROM premios_manager_equipos WHERE posicion = ?";

        $dinero = 0;

        foreach ($result as $row) {

            $dinero += $this->db->query($sqlDinero, array($row->posicion))
                            ->row()->dinero;
        }

        return $dinero;
    }

    function getValoresMercadoEquipoObject($idEquipo) {
        $sql = "SELECT * FROM valor_equipo "
                . "WHERE id_equipo = ? ";

        $result = $this->db->query($sql, array($idEquipo))->result();

        $valoresMercado = array();

        foreach ($result as $row) {
            $valorMercado = new ValorMercado();
            $valorMercado->setFecha($row->fecha);
            $valorMercado->setPrecio($row->valor_actual);

            $valoresMercado[] = $valorMercado;
        }

        return $valoresMercado;
    }

    function getValorMaximoEquipo($idEquipo) {
        $sql = "SELECT max(valor_actual) valorMaximo FROM valor_equipo "
                . "WHERE id_equipo = ? ";

        $result = $this->db->query($sql, array($idEquipo));

        return $result->row()->valorMaximo;
    }

    function getValorMinimoEquipo($idEquipo) {
        $sql = "SELECT min(valor_actual) valorMinimo FROM valor_equipo "
                . "WHERE id_equipo = ? ";

        $result = $this->db->query($sql, array($idEquipo));

        return $result->row()->valorMinimo;
    }

    function getEquiposFichaObject() {
        $sql = "SELECT * FROM equipos";
        $result = $this->db->query($sql)->result();

        $equipos = array();
        foreach ($result as $row) {
            $equipo = EquipoFicha::getById($row->id);
            $pilotos = $this->getPilotosEquipoObject($row->id);
            $equipo->setPilotos($pilotos);
            $equipos[] = $equipo;
        }

        return $equipos;
    }

    function getEquipoPilotoObject($idPiloto) {
        $sql = "SELECT * FROM pilotos WHERE id = ?";
        $row = $this->db->query($sql, array($idPiloto))->row();

        $equipo = Equipo::getById($row->id_equipo);

        return $equipo;
    }

    /* function getEquiposUsuarioObject($idUsuario) {
      $sql = "SELECT equipos.*
      FROM equipos,usuarios_equipos
      WHERE usuarios_equipos.id_usuario = ?
      AND usuarios_equipos.id_equipo = equipos.id
      AND usuarios_equipos.activo = 1";
      $result = $this->db->query($sql, array($idUsuario))->result();

      $equipos = array();
      foreach ($result as $row) {
      $equipo = EquipoFicha::getById($row->id);
      $pilotos = $this->getPilotosEquipoObject($row->id);
      $equipo->setPilotos($pilotos);
      $equipos[] = $equipo;
      }

      return $equipos;
      } */

    function getEquiposUsuarioObject($idUsuario) {
        $sql = "SELECT *
                FROM usuarios_equipos
                WHERE usuarios_equipos.id_usuario = ?                
                AND usuarios_equipos.activo = 1";
        $result = $this->db->query($sql, array($idUsuario))->result();

        $equipos = array();
        foreach ($result as $row) {
            $equipo = EquipoUsuario::getById($row->id_equipo, $idUsuario);
            $pilotos = $this->getPilotosEquipoObject($row->id_equipo);
            $equipo->setPilotos($pilotos);
            $equipos[] = $equipo;
        }

        return $equipos;
    }

    function getDatosEquipoUsuario($idEquipo, $idUsuario) {
        $sql = "SELECT * FROM usuarios_equipos " . "WHERE id_equipo = ? "
                . "AND id_usuario = ? ";

        $result = $this->db->query($sql, array(
            $idEquipo, $idUsuario));

        return $result;
    }

    function insertCompraEquipo(Equipo $equipo, Usuario $usuario) {
        $sqlFichaje = "INSERT INTO compras_equipos "
                . "( id_equipo, id_usuario, fecha) values (?,?,?)";

        $this->db->query($sqlFichaje, array($equipo->getIdEquipo(), $usuario->getIdUsuario(), date('Y-m-d')));
    }

    function insertVentaEquipo(Equipo $equipo, Usuario $usuario) {
        $sqlFichaje = "INSERT INTO ventas_equipos "
                . "( id_equipo, id_usuario, fecha) values (?,?,?)";

        $this->db->query($sqlFichaje, array($equipo->getIdEquipo(), $usuario->getIdUsuario(), date('Y-m-d')));
    }

}
