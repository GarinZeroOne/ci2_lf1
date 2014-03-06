<?php

class Admin_model extends CI_Model {

    const stikis = 'stikis';
    const poleman = 'poleman';
    const ingenieros = 'ingenieros';
    const publicistas = 'publicistas';
    const banco = 'banco';
    const pilotos = 'pilotos';
    const equipos = 'equipos';
    const stikiPuntos = 'stiki_puntos';
    const stikiDinero = 'stiki_dinero';
    const puntosPole = 10;
    const dineroPole = 100000;
    const dineroNomina = 100000;

    private $ingenieros = array(
        '1' => 0.05,
        '2' => 0.10,
        '3' => 0.15,
        '4' => 0.20,
        '5' => 0.25,
        '6' => 0.30,
        '7' => 0.35,
        '8' => 0.40,
        '9' => 0.45,
        '10' => 0.50
    );
    private $publicistas = array(
        '1' => 0.05,
        '2' => 0.10,
        '3' => 0.15,
        '4' => 0.20,
        '5' => 0.25,
        '6' => 0.30,
        '7' => 0.35,
        '8' => 0.40,
        '9' => 0.45,
        '10' => 0.50
    );

    function Admin_model() {
        parent::__construct();
    }

    function insertarCirtuito($cicuito, $pais, $fecha) {
        $sql = "INSERT INTO circuitos (circuito,pais,fecha,procesado)"
                . "VALUES (?,?,?,?)";
        $this->db->query($sql, array($cicuito, $pais, $fecha, 0));

        $idCircuito = $this->db->insert_id();

        $sql = "INSERT INTO boxes (id_circuito,fecha_abrir,fecha_cerrar)"
                . "VALUES (?,?,?)";

        $fechaAbrir = strtotime('+1 day', strtotime($fecha));
        $fechaAbrir = date('Y-m-d', $fechaAbrir);

        $fechaCerrar = strtotime('-2 day', strtotime($fecha));
        $fechaCerrar = date('Y-m-d', $fechaCerrar);

        $this->db->query($sql, array($idCircuito, $fechaAbrir, $fechaCerrar));
    }

    function vaciarCircuitos() {
        $sql = "TRUNCATE TABLE circuitos";
        $this->db->query($sql);

        $sql = "TRUNCATE TABLE boxes";
        $this->db->query($sql);
    }

    function insertarPosicionPiloto($idPiloto, $idGp, $posicion) {
        $sql = "INSERT INTO resultados_pilotos (id_piloto,id_gp,posicion,poleman)"
                . "VALUES (?,?,?,?)";
        $this->db->query($sql, array($idPiloto, $idGp, $posicion, 0));
    }

    function obtenerPilotoCodigo($code) {
        $sql = "SELECT * FROM pilotos WHERE code = ?";

        $result = $this->db->query($sql, array($code));

        return $result;
    }

    function obtenerPilotoDriverId($driverId) {
        $sql = "SELECT * FROM pilotos WHERE driverId = ?";

        $result = $this->db->query($sql, array($driverId));

        return $result;
    }

    function asignarPoleman($idPiloto, $idGp) {
        $sql = "UPDATE resultados_pilotos "
                . " SET poleman = ?"
                . " WHERE id_piloto = ?"
                . " AND id_gp = ?";

        $this->db->query($sql, array(1, $idPiloto, $idGp));
    }

    function obtenerOrdenEquiposGp($idGp) {
        $sql = "SELECT p.id_equipo, sum(pp.puntos) puntos
                FROM resultados_pilotos rp,pilotos p, puntos_posicion pp
                WHERE rp.id_piloto = p.id
                AND pp.posicion = rp.posicion
                AND rp.id_gp = ?
                GROUP BY p.id_equipo
                ORDER BY puntos desc , min(rp.posicion) asc";

        $result = $this->db->query($sql, array($idGp));

        return $result;
    }

    function insertarPosicionEquipo($idEquipo, $idGp, $posicion) {
        $sql = "INSERT INTO resultados_equipos (id_equipo,id_gp,posicion)"
                . "VALUES (?,?,?)";
        $this->db->query($sql, array($idEquipo, $idGp, $posicion));
    }

    function comprobarResultadosProcesados($idGp) {
        $sql = "SELECT * 
                FROM resultados_pilotos 
                WHERE id_gp = ?";

        return $this->db->query($sql, array($idGp));
    }

    function insertarClasificacionMundialPilotos($idPiloto, $puntos, $posicion) {
        $sql = "INSERT INTO clasificacion_mundial_pilotos (id_piloto,puntos,posicion)"
                . "VALUES (?,?,?)";
        $this->db->query($sql, array($idPiloto, $puntos, $posicion));
    }

    function borrarClasificacionMundialPilotos() {
        $sql = "TRUNCATE TABLE clasificacion_mundial_pilotos ";
        $this->db->query($sql);
    }

    function insertarClasificacionMundialEquipos($idEquipo, $puntos, $posicion) {
        $sql = "INSERT INTO clasificacion_mundial_equipos (id_equipo,puntos,posicion)"
                . "VALUES (?,?,?)";
        $this->db->query($sql, array($idEquipo, $puntos, $posicion));
    }

    function borrarClasificacionMundialEquipos() {
        $sql = "TRUNCATE TABLE clasificacion_mundial_equipos ";
        $this->db->query($sql);
    }

    function obtenerEquipoConstructorId($constructorId) {
        $sql = "SELECT * FROM equipos WHERE constructorId = ?";

        $result = $this->db->query($sql, array($constructorId));

        return $result;
    }

    function getUsuariosObject($primerUsuario, $cuantosUsuarios) {
        $sql = "SELECT * FROM usuarios LIMIT ?,?";

        $result = $this->db->query($sql, array($primerUsuario, $cuantosUsuarios))->result();

        $usuarios = array();

        foreach ($result as $row) {
            $usuario = Usuario::getById($row->id);
            $equipos = $this->getEquiposUsuarioObject($row->id);
            $usuario->setEquipos($equipos);
            $pilotos = $this->getPilotosUsuarioObject($row->id);
            $usuario->setPilotos($pilotos);
            $usuarios[] = $usuario;
        }

        return $usuarios;
    }

    function getEquiposUsuarioObject($idUsuario) {
        $sql = "SELECT * FROM usuarios_equipos WHERE id_usuario = ? AND activo = ?";

        $result = $this->db->query($sql, array($idUsuario, 1))->result();

        $equipos = array();

        foreach ($result as $row) {
            $equipos[] = Equipo::getById($row->id_equipo);
        }

        return $equipos;
    }

    function getPilotosUsuarioObject($idUsuario) {
        $sql = "SELECT * FROM usuarios_pilotos WHERE id_usuario = ? AND activo = ?";

        $result = $this->db->query($sql, array($idUsuario, 1))->result();

        $pilotos = array();

        foreach ($result as $row) {
            //$pilotos[] = Piloto::getById($row->id_piloto);
            $pilotos[] = PilotoUsuario::getById($row->id_piloto, $idUsuario);
        }

        return $pilotos;
    }

    function procesarGp(Usuario $usuario, $idGp) {

        /*
         * Variable que se utiliza para guardar los puntos q hace un usuario en el gp
         */
        $puntos = 0;
        /*
         * Variable q se utiliza para guardar el dinero ganado en el gp
         */
        $dinero = 0;

        //Se carga el modelo del banco
        $CI = &get_instance();
        $CI->load->model('banco/banco_model');
        $CI->load->model('stikis/stikis_model');

        //Se obtienen las mejoras del usuario
        $sql_mejoras = "SELECT * FROM usuarios_mejoras WHERE id_usuario = ?";

        $mejoras = $this->db->query($sql_mejoras, array($usuario->getIdUsuario()));

        $usuarioIngenierosLvl = 0;
        $usuarioPublicistasLvl = 0;

        if ($mejoras->num_rows()) {
            foreach ($mejoras->result() as $mejora) {
                if ($mejora->id_mejora == 3) {
                    $usuarioIngenierosLvl = $mejora->nivel;
                    continue;
                }

                if ($mejora->id_mejora == 4) {
                    $usuarioPublicistasLvl = $mejora->nivel;
                    continue;
                }
            }
        }


        //Se procesa los fondos acutales (Banco)
        if ($usuario->getFondos() < -150000) {
            $puntosBanco = -8;
        } elseif ($usuario->getFondos() >= -150000 AND $usuario->getFondos() < -100000) {
            $puntosBanco = -6;
        } elseif ($usuario->getFondos() >= -100000 AND $usuario->getFondos() < -50000) {
            $puntosBanco = -4;
        } elseif ($usuario->getFondos() >= -50000 AND $usuario->getFondos() < 0) {

            $puntosBanco = -2;
        } elseif ($usuario->getFondos() >= 0 AND $usuario->getFondos() < 50000) {

            $puntosBanco = 1;
        } elseif ($usuario->getFondos() >= 50000 AND $usuario->getFondos() < 200000) {

            $puntosBanco = 2;
        } elseif ($usuario->getFondos() >= 200000 AND $usuario->getFondos() < 400000) {

            $puntosBanco = 4;
        } elseif ($usuario->getFondos() >= 400000 AND $usuario->getFondos() < 600000) {

            $puntosBanco = 5;
        } elseif ($usuario->getFondos() >= 600000 AND $usuario->getFondos() < 800000) {
            $puntosBanco = 7;
        } elseif ($usuario->getFondos() >= 800000 AND $usuario->getFondos() < 1000000) {
            $puntosBanco = 10;
        } elseif ($usuario->getFondos() >= 1000000 AND $usuario->getFondos() < 2000000) {
            $puntosBanco = 12;
        } elseif ($usuario->getFondos() >= 2000000 AND $usuario->getFondos() < 3000000) {
            $puntosBanco = 15;
        } elseif ($usuario->getFondos() >= 3000000 AND $usuario->getFondos() < 4000000) {
            $puntosBanco = 18;
        } elseif ($usuario->getFondos() >= 4000000 AND $usuario->getFondos() < 5000000) {

            $puntosBanco = 22;
        } elseif ($usuario->getFondos() >= 5000000) {
            $puntosBanco = 25;
        }

        $puntos += $puntosBanco;

        //Registrar resultado en resultados_usuario_desglose
        $this->insertarUsuariosDesglose(0, $idGp, 0
                , $puntosBanco, $usuario->getIdUsuario()
                , Admin_model::banco, 0);

        //Se procesan los pilotos
        //Se recorren los pilotos del usuario asignando                 
        foreach ($usuario->getPilotos() as $piloto) {
            //Se obtienen los puntos y el dinero ganado por el piloto
            $sql = "SELECT * FROM resultados_pilotos rp, premios_manager_pilotos pmp 
                    WHERE rp.posicion = pmp.posicion
                    AND rp.id_piloto = ?
                    AND rp.id_gp = ?";

            $row = $this->db->query($sql, array($piloto->getIdPiloto(), $idGp))->row();

            $fondos = $usuario->getFondos() + $row->dinero;
            $puntos += $row->puntos_manager;

            if ($piloto->getTipoCompra() == 'fichado') {
                $dinero += $row->dinero;
            }

            $usuario->setFondos($fondos);

            //Registrar movimiento banco
            $CI->banco_model->registrarMovimiento($piloto->getIdPiloto(), $row->dinero
                    , $usuario->getIdUsuario(), Banco_model::puestoPiloto
                    , 0, Banco_model::ingreso);

            //Registrar resultado en resultados_usuario_desglose
            $this->insertarUsuariosDesglose($piloto->getIdPiloto(), $idGp, $row->dinero
                    , $row->puntos_manager, $usuario->getIdUsuario()
                    , Admin_model::pilotos, 0);

            //Actualizar los puntos y dinero ganado por el piloto para el usuario
            $this->actualizarDatosUsuarioPiloto
                    ($row->puntos_manager, $row->dinero, $usuario->getIdUsuario()
                    , $piloto->getIdPiloto());

            //Se comprueba si el piloto ha hecho la pole
            if ($row->poleman) {
                $fondos = $usuario->getFondos() + Admin_model::dineroPole;
                $puntos += Admin_model::puntosPole;

                if ($piloto->getTipoCompra() == 'fichado') {
                    $dinero += Admin_model::dineroPole;
                }

                $usuario->setFondos($fondos);

                //Registrar pole en resultados_usuario_desglose
                $this->insertarUsuariosDesglose($piloto->getIdPiloto(), $idGp, Admin_model::dineroPole
                        , Admin_model::puntosPole, $usuario->getIdUsuario()
                        , Admin_model::poleman, 0);

                //Actualizar los puntos y dinero ganado por el piloto para el usuario
                $this->actualizarDatosUsuarioPiloto
                        (Admin_model::puntosPole, Admin_model::dineroPole, $usuario->getIdUsuario()
                        , $piloto->getIdPiloto());

                //Registrar movimiento banco
                $CI->banco_model->registrarMovimiento($piloto->getIdPiloto(), Admin_model::dineroPole
                        , $usuario->getIdUsuario(), Banco_model::polePiloto
                        , 0, Banco_model::ingreso);
            }

            //Los stikis solo se aplican si el piloto esta fichado
            if ($piloto->getTipoCompra() == 'fichado') {

                //Se comprueba si el piloto tiene stiki
                $sql_stikis = "SELECT * FROM stikis_usuarios "
                        . "WHERE id_usuario = ? "
                        . "AND id_gp = ? "
                        . "AND id_piloto = ?";

                $stiki = $this->db->query($sql_stikis, array($usuario->getIdUsuario()
                    , $idGp, $piloto->getIdPiloto()));                               

                if ($stiki->num_rows()) {
                    //Si el stiki es de puntos se suman
                    if ($stiki->row()->stiki == Stikis_model::stikiPuntos) {
                        $puntos += $row->puntos_manager;

                        //Registrar stiki en resultados_usuario_desglose
                        $this->insertarUsuariosDesglose($piloto->getIdPiloto(), $idGp, 0
                                , $row->puntos_manager, $usuario->getIdUsuario()
                                , Admin_model::stikiPuntos, 0);

                        //Si tiene mejoras de ingenieros se aplican
                        if ($usuarioIngenierosLvl) {
                            $puntosIngenieros = $this->ingenieros[$usuarioIngenierosLvl] * $row->puntos_manager;
                            $puntos+= $puntosIngenieros;

                            //Registrar ingenieros en resultados_usuario_desglose
                            $this->insertarUsuariosDesglose($piloto->getIdPiloto(), $idGp, 0
                                    , $puntosIngenieros, $usuario->getIdUsuario()
                                    , Admin_model::ingenieros, 0);
                        }
                    } else {
                        //Stiki dinero, se añade a los fondos del usuario
                        $fondos = $usuario->getFondos() + $row->dinero;
                        $usuario->setFondos($fondos);
                        $dinero += $row->dinero;

                        //Registrar stiki en resultados_usuario_desglose
                        $this->insertarUsuariosDesglose($piloto->getIdPiloto(), $idGp
                                , $row->dinero
                                , 0, $usuario->getIdUsuario()
                                , Admin_model::stikiPuntos, 0);

                        //Registrar movimiento banco
                        $CI->banco_model->registrarMovimiento($piloto->getIdPiloto(), $row->dinero
                                , $usuario->getIdUsuario(), Banco_model::stikiDinero
                                , 0, Banco_model::ingreso);

                        //Si tiene mejoras de ingenieros se aplican
                        if ($usuarioIngenierosLvl) {
                            $dineroIngenieros = $this->ingenieros[$usuarioIngenierosLvl] * $row->dinero;
                            $fondos = $usuario->getFondos() + $dineroIngenieros;
                            $usuario->setFondos($fondos);
                            $dinero += $dineroIngenieros;

                            //Registrar ingenieros en resultados_usuario_desglose
                            $this->insertarUsuariosDesglose($piloto->getIdPiloto(), $idGp, $dineroIngenieros
                                    , 0, $usuario->getIdUsuario()
                                    , Admin_model::ingenieros, 0);

                            //Registrar movimiento banco
                            $CI->banco_model->registrarMovimiento($piloto->getIdPiloto(), $dineroIngenieros
                                    , $usuario->getIdUsuario(), Banco_model::mejoraIngenieros
                                    , 0, Banco_model::ingreso);
                        }
                    }
                }
            }
        }

        //Se procesan los equipos
        //Se recorren los equipos del usuario asignando                 
        foreach ($usuario->getEquipos() as $equipo) {
            //Se obtienen los puntos y el dinero ganado por el equipo
            $sql = "SELECT * FROM resultados_equipos re, premios_manager_equipos pme 
                    WHERE re.posicion = pme.posicion
                    AND re.id_equipo = ?
                    AND re.id_gp = ?";

            $row = $this->db->query($sql, array($equipo->getIdEquipo(), $idGp))->row();

            $fondos = $usuario->getFondos() + $row->dinero;
            $puntos += $row->puntos_manager;
            $dinero += $row->dinero;

            $usuario->setFondos($fondos);

            //Registrar movimiento banco
            $CI->banco_model->registrarMovimiento(0, $row->dinero
                    , $usuario->getIdUsuario(), Banco_model::puestoEquipo
                    , $equipo->getIdEquipo(), Banco_model::ingreso);

            //Registrar resultado en resultados_usuario_desglose
            $this->insertarUsuariosDesglose(0, $idGp, $row->dinero
                    , $row->puntos_manager, $usuario->getIdUsuario()
                    , Admin_model::equipos, $equipo->getIdEquipo());

            //Actualizar los puntos y dinero ganado por el piloto para el usuario
            $this->actualizarDatosUsuarioEquipo
                    ($row->puntos_manager, $row->dinero, $usuario->getIdUsuario()
                    , $equipo->getIdEquipo());
        }

        //Se procesan los publicistas
        $dineroPublicistas = $dinero * $this->publicistas[$usuarioPublicistasLvl];
        $fondos = $usuario->getFondos() + $dineroPublicistas;
        $usuario->setFondos($fondos);

        //Registrar movimiento banco
        $CI->banco_model->registrarMovimiento(0, $dineroPublicistas
                , $usuario->getIdUsuario(), Banco_model::mejoraPublicistas
                , 0, Banco_model::ingreso);

        //Registrar resultado en resultados_usuario_desglose
        $this->insertarUsuariosDesglose(0, $idGp, $dineroPublicistas
                , 0, $usuario->getIdUsuario()
                , Admin_model::publicistas, 0);

        //Se suma la nomina
        $fondos = $usuario->getFondos() + Admin_model::dineroNomina;
        $usuario->setFondos($fondos);

        //Registrar movimiento banco
        $CI->banco_model->registrarMovimiento(0, Admin_model::dineroNomina
                , $usuario->getIdUsuario(), Banco_model::nomina
                , 0, Banco_model::ingreso);

        //Guardar los fondos del usuario
        $CI->banco_model->guardarSaldoUsuario($usuario);
    }

    function insertarUsuariosDesglose($idPiloto, $idGp, $dinero, $puntos, $idUsuario, $tipo, $idEquipo) {
        $sql = "INSERT INTO resultados_usuarios_desglose "
                . "(id_piloto, id_gp, dinero, puntos, id_usuario, tipo, id_equipo) "
                . "VALUES (?,?,?,?,?,?,?)";

        $this->db->query($sql, array($idPiloto, $idGp, $dinero, $puntos, $idUsuario, $tipo, $idEquipo));
    }

    function actualizarDatosUsuarioPiloto($puntos, $dinero, $idUsuario, $idPiloto) {
        $sql = "UPDATE usuarios_pilotos
                SET puntos=puntos + ?, dinero = dinero + ?
                WHERE id_usuario = ?
                AND id_piloto = ? ";

        $this->db->query($sql, array($puntos, $dinero, $idUsuario, $idPiloto));
    }

    function actualizarDatosUsuarioEquipo($puntos, $dinero, $idUsuario, $idEquipo) {
        $sql = "UPDATE usuarios_equipos
                SET puntos=puntos + ?, dinero = dinero + ?
                WHERE id_usuario = ?
                AND id_equipo = ? ";

        $this->db->query($sql, array($puntos, $dinero, $idUsuario, $idEquipo));
    }

    // ----------------------------------------------------------------------------------
    // Llenar tabla resultados usuarios con los resultados del GP e Ingresar
    // dinero ganado en el BANCO
    // ----------------------------------------------------------------------------------
    function generarClasificacionUsuarios($idGp) {


        // ----------------------------------------------------------------------------------
        // Obtener datos de la tabla desgloses ordenado de Mas puntos conseguidos a menos
        // ----------------------------------------------------------------------------------
        $sql = "SELECT sum(dinero) as dinero,sum(puntos) as puntos ,id_usuario  FROM resultados_usuarios_desglose
				WHERE id_gp = ?
				group by id_usuario
				order by puntos desc";
        $Q = $this->db->query($sql, array($idGp));
        // ----------------------------------------------------------------------------------
        //Contador posicion GP
        // ----------------------------------------------------------------------------------
        $i = 1;

        // ----------------------------------------------------------------------------------
        // Recorremos los resultados, de primero a ultimo
        // ----------------------------------------------------------------------------------
        foreach ($Q->result() as $pu) {

            // ----------------------------------------------------------------------------------
            // Ingresar en resultados_usuarios_2011 los puntos y la posicion en este GP
            // ----------------------------------------------------------------------------------
            $sql_insert_resultados = "INSERT INTO resultados_usuarios_2011
		   				  VALUES('',{$idGp},{$pu->id_usuario},{$i},{$pu->puntos},0,0)";

            $this->db->query($sql_insert_resultados);

            $i++;
        }
    }

    function guardarPuntosManagerTotales($idGp) {
        // ----------------------------------------------------------------------------------
        // Obtener datos de la tabla desgloses ordenado de Mas puntos
        // conseguidos a menos en todos los GP´s
        // ----------------------------------------------------------------------------------
        $sql = "SELECT sum(puntos) as puntos ,id_usuario  FROM resultados_usuarios_desglose
				group by id_usuario
				order by puntos desc";
        $Q = $this->db->query($sql, array($this->id_gp));

        $i = 1;

        /**
         * MODIFICACION(10/04/2011): Guardo en un campo los puntos totales para luego poder
         * mostrar el ranking general de cada gp. Agregar campo puntos_manager_total_gp a la tabla
         */
        foreach ($Q->result() as $pu) {
            $sql_update = "UPDATE
                                resultados_usuarios_2011
                           SET
                                puesto_general= ?,
                                puntos_manager_total_gp = ?
                           WHERE
                            id_gp = ? AND id_usuario = ?";

            $this->db->query($sql_update, array($i, $pu->puntos, $idGp, $pu->id_usuario));

            $i++;
        }
    }   

}
