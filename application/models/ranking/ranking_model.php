<?

class Ranking_model extends CI_Model {

    const LINEAS_PANTALLA = 25;

    function Ranking_model() {
        parent::__construct();
    }

    function obtenerNombreGP($idGP=false) {
        if (!$idGP) {
            $sql = "SELECT id,circuito,pais FROM circuitos WHERE fecha <= ?
			 order by fecha desc limit 0,1 ";
            $GP = $this->db->query($sql, array(date('Y-m-d')))->row();
        } else {
            $sql = "SELECT id,circuito,pais FROM circuitos WHERE id = ?";
            $GP = $this->db->query($sql, array($idGP))->row();
        }

        return $GP;
    }

    function obtenerPuntosPiloto($idGP=false) {
        $sql = "SELECT * FROM resultados_pilotos_2011 WHERE id_circuito = ?";
        $resultadoPiloto = $this->db->query($sql, array($idGP))->row();

        //			** CONFIGURACION DE PUNTOS **
        //           PUNTUACION ESPECIAL MALASIA
        if ($idGP == 2) {
            $primero = 25;
            $segundo = 18;
            $tercero = 15;
            $cuarto = 12;
            $quinto = 10;
            $sexto = 8;
            $septimo = 6;
            $octavo = 4;
            $noveno = 2;
            $decimo = 1;
        } else {
            $primero = 25;
            $segundo = 18;
            $tercero = 15;
            $cuarto = 12;
            $quinto = 10;
            $sexto = 8;
            $septimo = 6;
            $octavo = 4;
            $noveno = 2;
            $decimo = 1;
        }


        $sql = "SELECT * FROM pilotos";
        $pilotos = $this->db->query($sql)->result();
        $i = 1;
        foreach ($pilotos as $linea) {
            if ($linea->id == $resultadoPiloto->id_primero) {
                $pilotosGP [$i] [idPiloto] = $linea->id;
                $pilotosGP [$i] [nombrePiloto] = $linea->nombre . " " . $linea->apellido;
                $pilotosGP [$i] [puestoPiloto] = 1;
                $pilotosGP [$i] [puntosPiloto] = $primero;
            }
            if ($linea->id == $resultadoPiloto->id_segundo) {
                $pilotosGP [$i] [idPiloto] = $linea->id;
                $pilotosGP [$i] [nombrePiloto] = $linea->nombre . " " . $linea->apellido;
                $pilotosGP [$i] [puestoPiloto] = 2;
                $pilotosGP [$i] [puntosPiloto] = $segundo;
            }
            if ($linea->id == $resultadoPiloto->id_tercero) {
                $pilotosGP [$i] [idPiloto] = $linea->id;
                $pilotosGP [$i] [nombrePiloto] = $linea->nombre . " " . $linea->apellido;
                $pilotosGP [$i] [puestoPiloto] = 3;
                $pilotosGP [$i] [puntosPiloto] = $tercero;
            }
            if ($linea->id == $resultadoPiloto->id_cuarto) {
                $pilotosGP [$i] [idPiloto] = $linea->id;
                $pilotosGP [$i] [nombrePiloto] = $linea->nombre . " " . $linea->apellido;
                $pilotosGP [$i] [puestoPiloto] = 4;
                $pilotosGP [$i] [puntosPiloto] = $cuarto;
            }
            if ($linea->id == $resultadoPiloto->id_quinto) {
                $pilotosGP [$i] [idPiloto] = $linea->id;
                $pilotosGP [$i] [nombrePiloto] = $linea->nombre . " " . $linea->apellido;
                $pilotosGP [$i] [puestoPiloto] = 5;
                $pilotosGP [$i] [puntosPiloto] = $quinto;
            }
            if ($linea->id == $resultadoPiloto->id_sexto) {
                $pilotosGP [$i] [idPiloto] = $linea->id;
                $pilotosGP [$i] [nombrePiloto] = $linea->nombre . " " . $linea->apellido;
                $pilotosGP [$i] [puestoPiloto] = 6;
                $pilotosGP [$i] [puntosPiloto] = $sexto;
            }
            if ($linea->id == $resultadoPiloto->id_septimo) {
                $pilotosGP [$i] [idPiloto] = $linea->id;
                $pilotosGP [$i] [nombrePiloto] = $linea->nombre . " " . $linea->apellido;
                $pilotosGP [$i] [puestoPiloto] = 7;
                $pilotosGP [$i] [puntosPiloto] = $septimo;
            }
            if ($linea->id == $resultadoPiloto->id_octavo) {
                $pilotosGP [$i] [idPiloto] = $linea->id;
                $pilotosGP [$i] [nombrePiloto] = $linea->nombre . " " . $linea->apellido;
                $pilotosGP [$i] [puestoPiloto] = 8;
                $pilotosGP [$i] [puntosPiloto] = $octavo;
            }
            if ($linea->id == $resultadoPiloto->id_noveno) {
                $pilotosGP [$i] [idPiloto] = $linea->id;
                $pilotosGP [$i] [nombrePiloto] = $linea->nombre . " " . $linea->apellido;
                $pilotosGP [$i] [puestoPiloto] = 9;
                $pilotosGP [$i] [puntosPiloto] = $noveno;
            }
            if ($linea->id == $resultadoPiloto->id_decimo) {
                $pilotosGP [$i] [idPiloto] = $linea->id;
                $pilotosGP [$i] [nombrePiloto] = $linea->nombre . " " . $linea->apellido;
                $pilotosGP [$i] [puestoPiloto] = 10;
                $pilotosGP [$i] [puntosPiloto] = $decimo;
            }
            $i = $i + 1;
        }
        foreach ($pilotosGP as $llave => $fila) {
            $idPiloto[$llave] = $fila ['idPiloto'];
            $nombrePiloto[$llave] = $fila ['nombrePiloto'];
            $puestoPiloto[$llave] = $fila ['puestoPiloto'];
            $puntosPiloto[$llave] = $fila ['puntosPiloto'];
        }
        array_multisort($puestoPiloto, SORT_ASC, $puntosPiloto, SORT_DESC,
                $nombrePiloto, SORT_STRING, $idPiloto, SORT_ASC, $pilotosGP);
        return $pilotosGP;
    }

    function getRanking($tipo, $idGP=false) {

        switch ($tipo) {

            case 'general':
                // recoger valores a mostrar en el ranking general
                $sql = "SELECT sum(pun.puntos) puntosPiloto,res.id_piloto
											   FROM
											   		resultados res,puntuacion pun
											   WHERE
											   		res.id_puesto = pun.puesto GROUP BY id_piloto";

                $puntosPiloto = $this->db->query($sql)->result();

                $sql = "SELECT * FROM apuesta";

                $apuestas = $this->db->query($sql)->result();

                $i = 0;

                foreach ($apuestas as $linea) {
                    foreach ($puntosPiloto as $row) {
                        if ($row->id_piloto == $linea->id_piloto1) {
                            $puntos = $puntos + $row->puntosPiloto;
                        }
                        if ($row->id_piloto == $linea->id_piloto2) {
                            $puntos = $puntos + $row->puntosPiloto;
                        }
                    }
                    $sql = "SELECT nick FROM usuarios WHERE id = ?";
                    $nick = $this->db->query($sql, array($linea->id_usuario))->row()->nick;

                    $ranking [$i]['puntos'] = $puntos;
                    $ranking [$i]['id_usuario'] = $linea->id_usuario;
                    $ranking [$i]['nick'] = $nick;
                    $i = $i + 1;
                    $puntos = 0;
                }

                break;

            case 'gp':

                $sql = "SELECT clas.*,usr.nick,avt.avatar_path
						FROM clasificacion_gp clas,usuarios usr,usuarios_avatar avt
						WHERE clas.id_usuario = usr.id
						AND clas.id_usuario = avt.id_usuario
						AND id_gp = ?
						ORDER BY clas.posicion";

                $clasificacion = $this->db->query($sql, $idGP);

                return $clasificacion;
        }
    }

    //Funcion que devuelve el ranking general
    function getRankingGeneral($idGp=false) {
        if (!$idGp) {
            $idGp = 0;
        }
        //if ($numEnlace < 0){
        /* $sql = "SELECT avt.avatar ,sum(clas.puntos)+sum(clas.puntos_stiki) as puntos,usr.id,usr.nick
          FROM clasificacion_gp clas,usuarios usr,usuarios_avatar avt
          WHERE clas.id_usuario = usr.id
          AND clas.id_usuario = avt.id_usuario
          AND clas.id_gp >= ?
          GROUP BY usr.id
          ORDER BY puntos desc
          LIMIT 0,?";

          $clasificacion = $this->db->query($sql, array($idGp, $kLineaPantalla)); */

		/*ESTO HAY KE MIRARLO ; NO CREO KE ESTE BIEN; HE CAMBIADO EL ORDER BY puesto_general por ORDER BY puntos DESC*/

		/*
        $sql = "SELECT avt.avatar ,sum(res.puntos_manager_gp) as puntos,usr.id,usr.nick,puesto_general
				FROM resultados_usuarios_2011 res,usuarios usr,usuarios_avatar avt
				WHERE res.id_usuario = usr.id
				AND res.id_usuario = avt.id_usuario
				GROUP BY usr.id
				ORDER BY puntos DESC
                                LIMIT 0,?";
		*/


		$sql_id_gp = "SELECT * FROM circuitos where procesado = 1 order by id DESC limit 0,1";

		$id_gp = $this->db->query($sql_id_gp)->row()->id;


		$sql = "SELECT avt.avatar, res.puntos_manager_total_gp AS puntos, usr.id, usr.nick, puesto_general
				FROM resultados_usuarios_2011 res, usuarios usr, usuarios_avatar avt
				WHERE res.id_usuario = usr.id
				AND res.id_usuario = avt.id_usuario
				AND res.id_gp = ?
				GROUP BY usr.id
				ORDER BY puesto_general
				LIMIT 0 , ?";




        $clasificacion = $this->db->query($sql, array($id_gp,  self::LINEAS_PANTALLA));

        //}
        /* else{

          $limiteInferior = $numEnlace * $kLineaPantalla;
          $limiteSuperior = $kLineaPantalla ;

          $sql = "SELECT avt.avatar_path ,sum(clas.puntos)+sum(clas.puntos_stiki) as puntos,usr.id,usr.nick
          FROM clasificacion_gp clas,usuarios usr,usuarios_avatar avt
          WHERE clas.id_usuario = usr.id
          AND clas.id_usuario = avt.id_usuario
          AND clas.id_gp >= ?
          GROUP BY usr.id
          ORDER BY puntos desc
          LIMIT ?,?";

          $clasificacion = $this->db->query($sql,array($idGp,$limiteInferior,$limiteSuperior));
          } */

        return $clasificacion;
    }

    function getRankingGp($idGP) {
        $kLineaPantalla = 25;

        $sql = "SELECT res.puntos_manager_gp,res.puesto_gp,res.id_usuario
                       ,usr.nick,usr.id id_user,avt.avatar
		FROM resultados_usuarios_2011 res,usuarios usr,usuarios_avatar avt
		WHERE res.id_usuario = usr.id
		AND res.id_usuario = avt.id_usuario
		AND res.id_gp = ?
		ORDER BY res.puesto_gp
                LIMIT 0,?";

        $clasificacion = $this->db->query($sql, array($idGP, $kLineaPantalla));

        return $clasificacion;
    }

    //Funcion que devuelve mi posicion en el GP
    function getMiPosicionGp($idGP) {

        $sql = "SELECT res.puntos_manager_gp,res.puesto_gp,res.id_usuario,usr.nick,avt.avatar
		FROM resultados_usuarios_2011 res,usuarios usr,usuarios_avatar avt
		WHERE res.id_usuario = usr.id
                AND res.id_usuario = avt.id_usuario
		AND res.id_gp = ?
		AND usr.id = ?
		ORDER BY res.puesto_gp";

        $clasificacion = $this->db->query($sql, array($idGP, $_SESSION['id_usuario']));

        return $clasificacion;
    }

    function getPosicionGpUsuario($idGP,$idUser) {

        $sql = "SELECT res.puntos_manager_gp,res.puesto_gp,res.id_usuario,usr.nick,avt.avatar
		FROM resultados_usuarios_2011 res,usuarios usr,usuarios_avatar avt
		WHERE res.id_usuario = usr.id
                AND res.id_usuario = avt.id_usuario
		AND res.id_gp = ?
		AND usr.id = ?
		ORDER BY res.puesto_gp";

        $clasificacion = $this->db->query($sql, array($idGP, $idUser));

        return $clasificacion;
    }

    //Funcion que devuelve mi posicion en el GP
    function getMiPosicionGeneral() {


		/*
        $sql = "SELECT avt.avatar ,sum(res.puntos_manager_gp) as puntos,
				usr.id,usr.nick,max(res.puesto_general) as puesto_general
				FROM resultados_usuarios_2011 res,usuarios usr,usuarios_avatar avt
				WHERE res.id_usuario = usr.id
				AND res.id_usuario = avt.id_usuario
                                AND res.id_usuario = ?
				ORDER BY puntos desc";
		*/
		$sql = "SELECT
					avt.avatar ,res.puntos_manager_total_gp as puntos,
					usr.id,usr.nick,res.puesto_general as puesto_general
				FROM
					resultados_usuarios_2011 res,usuarios usr,usuarios_avatar avt
				WHERE
					res.id_usuario = usr.id
				AND
					res.id_usuario = avt.id_usuario
				AND
					res.id_usuario = ?
				ORDER BY
					id_gp DESC
				LIMIT
					0,1";
        $miClasificacion = $this->db->query($sql, array($_SESSION['id_usuario']))->row();
        return $miClasificacion;
    }

    //Funcion que devuelve mi posicion en el GP
    function getPosicionGeneralUsuario($idUser) {


		/*
        $sql = "SELECT avt.avatar ,sum(res.puntos_manager_gp) as puntos,
				usr.id,usr.nick,max(res.puesto_general) as puesto_general
				FROM resultados_usuarios_2011 res,usuarios usr,usuarios_avatar avt
				WHERE res.id_usuario = usr.id
				AND res.id_usuario = avt.id_usuario
                                AND res.id_usuario = ?
				ORDER BY puntos desc";
		*/
		$sql = "SELECT avt.avatar ,res.puntos_manager_total_gp as puntos,
                        usr.id,usr.nick,res.puesto_general as puesto_general
                        FROM resultados_usuarios_2011 res,usuarios usr,usuarios_avatar avt
                        WHERE res.id_usuario = usr.id
                        AND res.id_usuario = avt.id_usuario
                        AND res.id_usuario = ?
                        ORDER BY id_gp DESC
                        LIMIT 0,1";
        $miClasificacion = $this->db->query($sql, array($idUser))->row();
        return $miClasificacion;
    }

    function getUsuario($id_Usuario) {
        $sql = "SELECT nick FROM usuarios WHERE id = ?";

        return $this->db->query($sql, array($id_usuario))->result();
    }


    /**
     * Obtiene un listado de los usuarios que mas dinero tienen en el banco.
     *
     * @return void
     * @author
     **/
    function get_gold_managers($limit = 12)
    {


        $ricos = $this->db->select('*')
                 ->from('usuarios_banco')
                 ->join('usuarios','usuarios.id = usuarios_banco.id_usuario')
                 ->join('usuarios_avatar','usuarios_avatar.id_usuario = usuarios_banco.id_usuario')
                 ->order_by('fondos','desc')
                 ->limit($limit)
                 ->get()->result();

        return $ricos;

    }
}