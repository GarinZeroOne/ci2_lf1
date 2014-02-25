<?php

class Apuestas_model extends CI_Model {

    private $iduser;
	private $id_gp;

    function Apuestas_model() {
        parent::__construct();
        $this->iduser = $_SESSION['id_usuario'];
    }

    //Funcion que devuelve los operadores
    function getOperadores() {

        $sql = "SELECT * FROM operadores";
        $query = $this->db->query($sql)->result();

        return $query;
    }

    //Funcion que devuelve los datos de un operador
    function getOperador($idOperador) {

        $sql = "SELECT * FROM operadores WHERE id_operador = ?";
        $query = $this->db->query($sql, array($idOperador))->row();

        return $query;
    }

    //Funcion que devuelve los modos de apuesta
    function getModoApuesta() {
        $sql = "SELECT * FROM modo_apuesta";
        $query = $this->db->query($sql)->result();

        return $query;
    }

    //Funcion que devuelve los modos de apuesta
    function getUnModoApuesta($idModoApuesta) {
        $sql = "SELECT * FROM modo_apuesta WHERE id_modo_apuesta = ?";
        $query = $this->db->query($sql, array($idModoApuesta))->row();

        return $query;
    }

    //Funcion que inserta una apuesta en la BBDD
    function insertApuesta($tipoApuesta, $idUsuarioEmisor, $idUsuarioReceptor, $idCampo1, $idCampo2
    , $idOperador, $idGp, $cantidad, $idModoApuesta) {
        $hoy = date('Y-m-d');
        $sql = "INSERT INTO apuesta (id_apuesta,tipo_apuesta,id_usuario_emisor,
                                     id_usuario_receptor,id_campo1,id_campo2,
                                     id_operador,id_gp,cantidad,id_modo_apuesta,fecha_apuesta,estado,ip_emisor)
                             VALUES ('',?,?,?,?,?,?,?,?,?,?,?,?)";
        $this->db->query($sql, array($tipoApuesta, $idUsuarioEmisor, $idUsuarioReceptor, $idCampo1,
            $idCampo2, $idOperador, $idGp, $cantidad, $idModoApuesta, $hoy, 'P',$_SESSION['direccion_ip']));
    }

    //Funcion que devuelve mis apuestas del GP
    function getMisApuestasEmitidas($idGP) {
        $i = 0;
        $sql = "SELECT a.*,u.nick FROM apuesta a, usuarios u WHERE a.id_usuario_emisor = u.id
                AND id_usuario_emisor = ? 
                AND id_gp = ?";
        $query = $this->db->query($sql, array($_SESSION['id_usuario'], $idGP))->result();

        foreach ($query as $linea) {
            //Se obtine el nick del receptor
            if ($linea->id_usuario_receptor != -1) {
                $nickReceptor = $this->usuarios_model->userData($linea->id_usuario_receptor)->nick;
            } else {
                $nickReceptor = "";
            }

            //Se obtiene el texto del operador.
            $operador = $this->apuestas_model->getOperador($linea->id_operador);
            $textoOperador = $operador->valor;

            //Se obtiene los datos del modo apuesta
            $modoApuesta = $this->apuestas_model->getUnModoApuesta($linea->id_modo_apuesta);

            //Se obtiene la ganancia
            $ganancia = $linea->cantidad * $modoApuesta->operacion_receptor + $linea->cantidad;

            //Se crea el texto a mostrar
            $textoApuesta = "Apuesto que ";
            switch ($linea->tipo_apuesta) {
                case 0:
                    //Se obtiene el nombre del piloto
                    $piloto = $this->pilotos_model->getPiloto($linea->id_campo1);

                    $textoApuesta = $textoApuesta . $piloto->nombre . " " . $piloto->apellido;
                    $textoApuesta = $textoApuesta . " termina ";
                    $textoApuesta = $textoApuesta . $textoOperador . " la posicion " . $linea->id_campo2;

                    break;
                case 1:
                    //Se obtiene el nombre del piloto
                    $piloto = $this->pilotos_model->getPiloto($linea->id_campo1);
                    $piloto2 = $this->pilotos_model->getPiloto($linea->id_campo2);

                    $textoApuesta = $textoApuesta . $piloto->nombre . " " . $piloto->apellido;
                    $textoApuesta = $textoApuesta . " termina ";
                    $textoApuesta = $textoApuesta . $textoOperador . " " . $piloto2->nombre . " " . $piloto2->apellido;
                    break;
                case 2:
                    if ($linea->id_operador == 1) {
                        $textoOperador = "hay mas de ";
                    } elseif ($linea->id_operador == 2) {
                        $textoOperador = "hay menos de ";
                    } else {
                        $textoOperador = "hay ";
                    }
                    $textoApuesta = $textoApuesta . $textoOperador . $linea->id_campo1;
                    if ($linea->id_campo1 == 1) {
                        $textoApuesta = $textoApuesta . " abandono";
                    } else {
                        $textoApuesta = $textoApuesta . " abandonos";
                    }
                    break;
                case 3:
                    //Se obtiene el nombre del piloto
                    $piloto = $this->pilotos_model->getPiloto($linea->id_campo1);
                    $textoApuesta = $textoApuesta . $piloto->nombre . " " . $piloto->apellido . " sale desde la pole.";

                    break;
                default;
                    break;
            }
            $misApuestas [$i] = array("id_apuesta" => $linea->id_apuesta
                , "miNick" => $linea->nick
                , "nickReceptor" => $nickReceptor
                , "cantidad" => $linea->cantidad
                , "estado" => $linea->estado
                , "textoApuesta" => $textoApuesta
                , "modoApuesta" => $linea->id_modo_apuesta
                , "ganancia" => $ganancia);
            $i = $i + 1;
        }

        return $misApuestas;
    }

    function getMisApuestasAceptadas($idGP) {
        $i = 0;

        $sql = "SELECT a.*,u.nick FROM apuesta a, usuarios u WHERE a.id_usuario_emisor = u.id
                AND id_usuario_receptor = ?
                AND id_gp = ?";
        $query = $this->db->query($sql, array($_SESSION['id_usuario'], $idGP))->result();

        $miNick = $this->usuarios_model->userData($_SESSION['id_usuario'])->nick;

        foreach ($query as $linea) {

            //Se obtiene el texto del operador.
            $operador = $this->apuestas_model->getOperador($linea->id_operador);
            $textoOperador = $operador->valor;

            //Se obtiene los datos del modo apuesta
            $modoApuesta = $this->apuestas_model->getUnModoApuesta($linea->id_modo_apuesta);

            //Se obtiene la ganancia
            $ganancia = $linea->cantidad * $modoApuesta->operacion_receptor + $linea->cantidad;

            //Se crea el texto a mostrar
            $textoApuesta = "Apuesto que ";
            switch ($linea->tipo_apuesta) {
                case 0:
                    //Se obtiene el nombre del piloto
                    $piloto = $this->pilotos_model->getPiloto($linea->id_campo1);

                    $textoApuesta = $textoApuesta . $piloto->nombre . " " . $piloto->apellido;
                    $textoApuesta = $textoApuesta . " no termina ";
                    $textoApuesta = $textoApuesta . $textoOperador . " la posicion " . $linea->id_campo2;

                    break;
                case 1:
                    //Se obtiene el nombre del piloto
                    $piloto = $this->pilotos_model->getPiloto($linea->id_campo1);
                    $piloto2 = $this->pilotos_model->getPiloto($linea->id_campo2);

                    $textoApuesta = $textoApuesta . $piloto->nombre . " " . $piloto->apellido;
                    $textoApuesta = $textoApuesta . " no termina ";
                    $textoApuesta = $textoApuesta . $textoOperador . " " . $piloto2->nombre . " " . $piloto2->apellido;
                    break;
                case 2:
                    if ($linea->id_operador == 1) {
                        $textoOperador = "no hay mas de ";
                    } elseif ($linea->id_operador == 2) {
                        $textoOperador = "no hay menos de ";
                    } else {
                        $textoOperador = "no hay ";
                    }
                    $textoApuesta = $textoApuesta . $textoOperador . $linea->id_campo1;
                    if ($linea->id_campo1 == 1) {
                        $textoApuesta = $textoApuesta . " abandono";
                    } else {
                        $textoApuesta = $textoApuesta . " abandonos";
                    }
                    break;
                case 3:
                    //Se obtiene el nombre del piloto
                    $piloto = $this->pilotos_model->getPiloto($linea->id_campo1);
                    $textoApuesta = $textoApuesta . $piloto->nombre . " " . $piloto->apellido . " no sale desde la pole.";

                    break;
                default;
                    break;
            }
            $misApuestas [$i] = array("id_apuesta" => $linea->id_apuesta
                , "miNick" => $miNick
                , "nickEmisor" => $linea->nick
                , "cantidad" => $linea->cantidad * $modoApuesta->operacion_receptor 
                , "estado" => $linea->estado
                , "textoApuesta" => $textoApuesta
                , "modoApuesta" => $linea->id_modo_apuesta
                , "ganancia" => $ganancia);
            $i = $i + 1;
        }

        return $misApuestas;
    }

    //Funcion que devuelve las apuestas pendientes.
    function getApuestasPendientes($idGP) {
        $i = 0;

        $sql = "SELECT a.*,u.nick FROM apuesta a, usuarios u WHERE a.id_usuario_emisor = u.id
                AND id_usuario_emisor <> ?
                AND id_usuario_receptor = ?
                AND id_gp = ?
                AND estado = ?";
        $query = $this->db->query($sql, array($_SESSION['id_usuario'],'-1', $idGP, 'P'))->result();

        foreach ($query as $linea) {
            //Se obtiene el texto del operador.
            $operador = $this->apuestas_model->getOperador($linea->id_operador);
            $textoOperador = $operador->valor;

            //Se obtiene los datos del modo apuesta
            $modoApuesta = $this->apuestas_model->getUnModoApuesta($linea->id_modo_apuesta);

            //Se obtiene la ganancia
            $ganancia = $linea->cantidad * $modoApuesta->operacion_receptor + $linea->cantidad;

            //Se crea el texto a mostrar
            $textoApuesta = $linea->nick . " apuesta que ";
            switch ($linea->tipo_apuesta) {
                case 0:
                    //Se obtiene el nombre del piloto
                    $piloto = $this->pilotos_model->getPiloto($linea->id_campo1);

                    $textoApuesta = $textoApuesta . $piloto->nombre . " " . $piloto->apellido;
                    $textoApuesta = $textoApuesta . " termina ";
                    $textoApuesta = $textoApuesta . $textoOperador . " la posicion " . $linea->id_campo2;

                    break;
                case 1:
                    //Se obtiene el nombre del piloto
                    $piloto = $this->pilotos_model->getPiloto($linea->id_campo1);
                    $piloto2 = $this->pilotos_model->getPiloto($linea->id_campo2);

                    $textoApuesta = $textoApuesta . $piloto->nombre . " " . $piloto->apellido;
                    $textoApuesta = $textoApuesta . " termina ";
                    $textoApuesta = $textoApuesta . $textoOperador . " " . $piloto2->nombre . " " . $piloto2->apellido;
                    break;
                case 2:
                    if ($linea->id_operador == 1) {
                        $textoOperador = "hay mas de ";
                    } elseif ($linea->id_operador == 2) {
                        $textoOperador = "hay menos de ";
                    } else {
                        $textoOperador = "hay ";
                    }
                    $textoApuesta = $textoApuesta . $textoOperador . $linea->id_campo1;
                    if ($linea->id_campo1 == 1) {
                        $textoApuesta = $textoApuesta . " abandono";
                    } else {
                        $textoApuesta = $textoApuesta . " abandonos";
                    }
                    break;
                case 3:
                    //Se obtiene el nombre del piloto
                    $piloto = $this->pilotos_model->getPiloto($linea->id_campo1);
                    $textoApuesta = $textoApuesta . $piloto->nombre . " " . $piloto->apellido . " sale desde la pole.";

                    break;
                default;
                    break;
            }

            $apuestasPendientes [$i] = array("id_apuesta" => $linea->id_apuesta
                , "nickEmisor" => $linea->nick
                , "cantidad" => $linea->cantidad * $modoApuesta->operacion_receptor
                , "estado" => $linea->estado
                , "textoApuesta" => $textoApuesta
                , "modoApuesta" => $linea->id_modo_apuesta
                , "ganancia" => $ganancia);
            $i = $i + 1;
        }

        return $apuestasPendientes;
    }

    //Funcion que cambia el estado a una apuesta
    function cambiarEstadoApuesta($estado, $idApuesta, $idUsuario) {
        $sql = "UPDATE  apuesta SET estado = ? , id_usuario_receptor = ? , ip_receptor = ? WHERE id_apuesta = ?";
        $query = $this->db->query($sql, array($estado, $idUsuario, $_SESSION['direccion_ip'] ,$idApuesta));
    }

    //funcion que comprueba obtiene el dinero apostado en un GP
    function getDineroApostado($idUsuario,$idGP) {
        $sql = "SELECT sum(cantidad) apostado FROM apuesta a WHERE ( a.id_usuario_emisor = ?
                OR id_usuario_receptor = ? )
                AND id_gp = ?
                AND estado = ?";

        $apostado = $this->db->query($sql, array($idUsuario,
                    $idUsuario, $idGP, 'A'))->row()->apostado;

        $sql = "SELECT sum(cantidad) apostado FROM apuesta a WHERE  a.id_usuario_emisor = ?
                AND id_gp = ?";
        $apostado2 = $this->db->query($sql, array($idUsuario,
                     $idGP))->row()->apostado;


        return $apostado + $apostado2;
    }

    //Funcion que quita el dinero de las apuestas
    function restarDineroApostado($idApuesta){
        $sql = "SELECT * FROM apuesta WHERE id_apuesta = ?";

        $apuesta = $this->db->query($sql, array($idApuesta))->row();

        //Se obtiene los datos del modo apuesta
        $modoApuesta = $this->apuestas_model->getUnModoApuesta($apuesta->id_modo_apuesta);

        //Dinero apostado por el receptor
        $dineroReceptor = $apuesta->cantidad * $modoApuesta->operacion_receptor;

        //Se resta el dinero del usuario receptor
        $this->banco_model-> restarDineroUsuario($dineroReceptor,$apuesta->id_usuario_receptor);

        //Se resta el dinero del usuario emisor
        $this->banco_model-> restarDineroUsuario($apuesta->cantidad,$apuesta->id_usuario_emisor);
    }
	
	// ------------------------------------------------------------------
	// Funcion para mirar si hay alguna apuesta sospechosa
	// Desde el panel de Administracion
	// ------------------------------------------------------------------
	// Obtener el GP a procesar
	function set_gp_a_procesar()
	{
		
		$sql = "SELECT * FROM circuitos WHERE procesado = 0 ORDER BY id ASC limit 0,1";
		$query = $this->db->query($sql);
		
		if( $query->num_rows == 1)
		{
			$this->id_gp = $query->row()->id;
		}
	}
	
	function admin_check_apuestas_fraude()
	{
		// Setear el id de gp
		$this->set_gp_a_procesar();
		$i = 0;

        $sql = "SELECT a.*,u.nick FROM apuesta a, usuarios u WHERE a.id_usuario_emisor = u.id

                AND id_gp = ?
                AND estado = 'A'";
        $query = $this->db->query($sql, array($this->id_gp))->result();

        foreach ($query as $linea) {
            //Se obtiene el texto del operador.
            $operador = $this->apuestas_model->getOperador($linea->id_operador);
            $textoOperador = $operador->valor;

            //Se obtiene los datos del modo apuesta
            $modoApuesta = $this->apuestas_model->getUnModoApuesta($linea->id_modo_apuesta);

            //Se obtiene la ganancia
            $ganancia = $linea->cantidad * $modoApuesta->operacion_receptor + $linea->cantidad;

            //Se crea el texto a mostrar
            $textoApuesta = "<b>".$linea->nick . "</b> apuesta que ";
            switch ($linea->tipo_apuesta) {
                case 0:
                    //Se obtiene el nombre del piloto
                    $piloto = $this->pilotos_model->getPiloto($linea->id_campo1);

                    $textoApuesta = $textoApuesta . $piloto->nombre . " " . $piloto->apellido;
                    $textoApuesta = $textoApuesta . " termina ";
                    $textoApuesta = $textoApuesta . $textoOperador . " la posicion " . $linea->id_campo2;

                    break;
                case 1:
                    //Se obtiene el nombre del piloto
                    $piloto = $this->pilotos_model->getPiloto($linea->id_campo1);
                    $piloto2 = $this->pilotos_model->getPiloto($linea->id_campo2);

                    $textoApuesta = $textoApuesta . $piloto->nombre . " " . $piloto->apellido;
                    $textoApuesta = $textoApuesta . " termina ";
                    $textoApuesta = $textoApuesta . $textoOperador . " " . $piloto2->nombre . " " . $piloto2->apellido;
                    break;
                case 2:
                    if ($linea->id_operador == 1) {
                        $textoOperador = "hay mas de ";
                    } elseif ($linea->id_operador == 2) {
                        $textoOperador = "hay menos de ";
                    } else {
                        $textoOperador = "hay ";
                    }
                    $textoApuesta = $textoApuesta . $textoOperador . $linea->id_campo1;
                    if ($linea->id_campo1 == 1) {
                        $textoApuesta = $textoApuesta . " abandono";
                    } else {
                        $textoApuesta = $textoApuesta . " abandonos";
                    }
                    break;
                case 3:
                    //Se obtiene el nombre del piloto
                    $piloto = $this->pilotos_model->getPiloto($linea->id_campo1);
                    $textoApuesta = $textoApuesta . $piloto->nombre . " " . $piloto->apellido . " sale desde la pole.";

                    break;
                default;
                    break;
            }

			$emisor = $this->db->query("SELECT nick,fecha_alta,ubicacion FROM usuarios WHERE id = ?",array($linea->id_usuario_emisor))->row();
			$receptor = $this->db->query("SELECT nick,fecha_alta,ubicacion FROM usuarios WHERE id = ?",array($linea->id_usuario_receptor))->row();
			
            $apuestasPendientes [$i] = array("id_apuesta" => $linea->id_apuesta
                , "nickEmisor" => $emisor->nick
				, "alta_emisor" => $emisor->fecha_alta
				, "ubicacion_emisor" => $emisor->ubicacion
				, "nickReceptor" => $receptor->nick
				, "alta_receptor" => $receptor->fecha_alta
				, "ubicacion_receptor" => $receptor->ubicacion
                , "cantidad" => $linea->cantidad * $modoApuesta->operacion_receptor
                , "estado" => $linea->estado
                , "textoApuesta" => $textoApuesta
                , "modoApuesta" => $linea->id_modo_apuesta
                , "ganancia" => $ganancia
				, "ip_emisor" => $linea->ip_emisor
				, "ip_receptor" => $linea->ip_receptor);
            $i = $i + 1;
        }

        return $apuestasPendientes;
	}

}
