<?php

class Mejoras_model extends CI_Model {

    private $iduser;
    private $id_gp_anterior;

    function Mejoras_model() {
        parent::__construct();
        $this->iduser = $_SESSION['id_usuario'];

        $this->set_id_gp_anterior();
    }

    function set_id_gp_anterior() {
        $sql = "SELECT * FROM circuitos WHERE procesado = 1 ORDER BY id DESC limit 0,1";
        $query = $this->db->query($sql);

        if ($query->num_rows == 1) {
            $this->id_gp_anterior = $query->row()->id;
        }
    }

    /**
     * Devuelve un listado con las mejoras del usuario
     * @return
     */
    function get_mejora($id_mejora) {
        $sql = "SELECT * FROM mejoras WHERE id = ?";

        return $this->db->query($sql, array($id_mejora))->row();
    }

    function get_mejoras_usuario() {
        $sql = "SELECT *
				FROM
					usuarios_mejoras um, mejoras m
				WHERE
					um.id_mejora = m.id
				AND
					um.id_usuario =?";

        return $this->db->query($sql, array($this->iduser))->result();
    }

    function get_mejora_usuario($id_mejora) {

        if(!$this->iduser){redirect_lf1('dashboard');}

        $sql = "SELECT *
				FROM
					usuarios_mejoras um, mejoras m
				WHERE
					um.id_mejora = m.id
				AND
					id_usuario = ?
				AND
					id_mejora = ?";
        return $this->db->query($sql, array($this->iduser, $id_mejora))->row();
    }

    function getMejoraUsuario($id_mejora, $idUser) {
        $sql = "SELECT *
                FROM usuarios_mejoras um, mejoras m
                WHERE um.id_mejora = m.id
                AND id_usuario = ?
                AND id_mejora = ?";
        return $this->db->query($sql, array($idUser, $id_mejora))->row();
    }

    function get_valor_mejora($id_mejora) {
        $valor_nivel = array(
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

        $sql = "SELECT * FROM usuarios_mejoras WHERE id_usuario = ? AND id_mejora = ?";

        $Q = $this->db->query($sql, array($this->iduser, $id_mejora));

        if ($Q->num_rows()) {
            return $valor_nivel[$Q->row()->nivel];
        } else {
            return FALSE;
        }
    }

    /*
     * Obtener valor mejora (servicio)
     */
    function getValorMejora($idUser,$idMejora) {
        $valor_nivel = array(
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

        $sql = "SELECT * FROM usuarios_mejoras WHERE id_usuario = ? AND id_mejora = ?";

        $Q = $this->db->query($sql, array($idUser, $idMejora));

        if ($Q->num_rows()) {
            return $valor_nivel[$Q->row()->nivel];
        } else {
            return 0;
        }
    }
    
    
    /**
     *  Aumentar una mejora
     */
    function aumentar_mejora($id_mejora) {
        // Obtener datos de la mejora del usuario
        $usuario_mejora = $this->get_mejora_usuario($id_mejora);
        $concepto_mejora = 'mejora_'.strtolower($usuario_mejora->nombre);

        if ($usuario_mejora) 
        {
            $nivel_actual = $usuario_mejora->nivel;
            $siguiente_nivel = ($nivel_actual + 1);

            // Siempre que sea un nivel menor a 11 seguimos
            if ($siguiente_nivel < 11) {
                $nivel_nuevo = "nivel_" . $siguiente_nivel;
                $precio_nivel = $usuario_mejora->$nivel_nuevo;

                $this->load->model('banco_model');
                $saldo = $this->banco_model->getSaldo();

                $saldo_final = $saldo - $precio_nivel;

                // Le llega el dinero?
                if ($saldo_final >= -200000) 
                {
                    $Q = $this->db->query("SELECT id FROM usuarios_mejoras WHERE id_usuario = ? AND id_mejora = ?", array($this->iduser, $id_mejora));

                    // Buscamos el ID para el update
                    if ($Q->num_rows()) 
                    {
                        $id_usuario_mejora = $Q->row()->id;

                        $sql = "UPDATE usuarios_mejoras set nivel = ?
							WHERE id= ?
							";

                        $this->db->query($sql, array($siguiente_nivel, $id_usuario_mejora));

                        // RESTARLE EL DINERO
                        $this->banco_model->restarDinero($precio_nivel);

                        // Guardar el movimiento de dinero
                        $idPiloto  = 0;
                        $dinero    = $precio_nivel;
                        $idUsuario = $this->iduser;
                        $conepto   = $concepto_mejora;// falta buscar el nombre  de la mejora
                        $idEquipo = 0;
                        $tipoMovimiento = 'gasto';
                        $texto_concepto = 'Se ha mejorado el nivel de '.$usuario_mejora->nombre.' a '.$siguiente_nivel;
                        $this->banco_model->registrarMovimiento($idPiloto, $dinero, $idUsuario, $conepto, $idEquipo, $tipoMovimiento,$texto_concepto);

                        $this->session->set_flashdata('msg_ok', 'Se ha aumentado el nivel de '.$usuario_mejora->nombre);
                    }
                } 
                else 
                {
                    $this->session->set_flashdata('msg_error', 'No tienes dinero suficiente');
                }

                /*  TRAZA
                  echo "Ampliacion a nivel:" .$nivel_nuevo;
                  echo "<br>Precio nivel:".$precio_nivel;
                  echo "<br>Saldo:".$saldo;die;
                 */
            } else {
                $mejora = "";
                switch ($id_mejora) {
                    case 1:
                        $mejora = $this->lang->line('oficina_lbl_ojeador');
                        break;
                    case 2:
                        $mejora = $this->lang->line('oficina_lbl_mecanico');
                        break;
                    case 3:
                        $mejora = $this->lang->line('oficina_lbl_ingeniero');
                        break;
                    case 4:
                        $mejora = $this->lang->line('oficina_lbl_publicista');
                        break;
                }
                // Ya esta al maximo, mostramos mensaje
                $this->session->set_flashdata('msg_error', 'La mejora ya esta al máximo nivel');
            }
        }
        // No tiene ningun nivel de esta mejora todavia. Le creamos la primera
        else {
            $this->load->model('banco_model');
            $saldo = $this->banco_model->getSaldo();

            //obtener precio mejora nivel 1
            $sql = "SELECT * FROM mejoras WHERE id = ?";

            $mejora = $this->db->query($sql, array($id_mejora))->row();

            $saldo_final = $saldo - $mejora->nivel_1;

            if ($saldo_final >= -200000) {

                // INSERT
                $sql = "INSERT INTO usuarios_mejoras values(?,?,?,?)";

                $this->db->query($sql, array('', $this->iduser, $id_mejora, 1));

                // RESTARLE EL DINERO
                $this->banco_model->restarDinero($mejora->nivel_1);

                // Guardar el movimiento de dinero
                $idPiloto  = 0;
                $dinero    = $mejora->nivel_1;
                $idUsuario = $this->iduser;
                $conepto   = 'mejora_'.strtolower($mejora->nombre);
                $idEquipo = 0;
                $tipoMovimiento = 'gasto';
                $this->banco_model->registrarMovimiento($idPiloto, $dinero, $idUsuario, $conepto, $idEquipo, $tipoMovimiento);

                $this->session->set_flashdata('msg_ok', 'Se ha aumentado el nivel de '.$mejora->nombre);
            } else {
                $this->session->set_flashdata('msg_error', 'No tienes dinero suficiente');
            }
        }
    }

    /**
     *  Aumentar una mejora para utilizar desde servicio
     */
    function aumentarMejora($idMejora, $idUser) {
        // Obtener datos de la mejora del usuario
        $usuario_mejora = $this->getMejoraUsuario($idMejora, $idUser);

        $CI = & get_instance();
        $CI->load->model('banco/banco_model');

        if ($usuario_mejora) {
            $nivel_actual = $usuario_mejora->nivel;
            $siguiente_nivel = ($nivel_actual + 1);

            // Siempre que sea un nivel menor a 11 seguimos
            if ($siguiente_nivel < 11) {

                $nivel_nuevo = "nivel_" . $siguiente_nivel;

                $precio_nivel = $usuario_mejora->$nivel_nuevo;

                $saldo = $CI->banco_model->getSaldoUsuario($idUser);

                $saldo_final = $saldo - $precio_nivel;

                // Le llega el dinero?
                if ($saldo_final >= -200000) {
                    $Q = $this->db->query("SELECT id FROM usuarios_mejoras WHERE id_usuario = ? AND id_mejora = ?"
                            , array($idUser, $idMejora));

                    // Buscamos el ID para el update
                    if ($Q->num_rows()) {
                        $id_usuario_mejora = $Q->row()->id;

                        $sql = "UPDATE usuarios_mejoras set nivel = ?
							WHERE id= ?
							";

                        $this->db->query($sql, array($siguiente_nivel, $id_usuario_mejora));

                        // RESTARLE EL DINERO
                        $CI->banco_model->restarDineroUsuario($precio_nivel, $idUser);

                        return array('codigo' => 0, 'texto' => "Ampliación realizada correctamente");
                    }
                } else {
                    return array('codigo' => 1, 'texto' => "No tienes suficiente dinero para realizar la ampliación");
                }

                /*  TRAZA
                  echo "Ampliacion a nivel:" .$nivel_nuevo;
                  echo "<br>Precio nivel:".$precio_nivel;
                  echo "<br>Saldo:".$saldo;die;
                 */
            } else {
                // Ya esta al maximo, mostramos mensaje
                return array('codigo' => 1, 'texto' => "Maximo nivel alcanzado");
            }
        }
        // No tiene ningun nivel de esta mejora todavia. Le creamos la primera
        else {
            $saldo = $CI->banco_model->getSaldoUsuario($idUser);

            //obtener precio mejora nivel 1
            $sql = "SELECT * FROM mejoras WHERE id = ?";

            $mejora = $this->db->query($sql, array($idMejora))->row();

            $saldo_final = $saldo - $mejora->nivel_1;

            if ($saldo_final >= -200000) {

                // INSERT
                $sql = "INSERT INTO usuarios_mejoras values(?,?,?,?)";

                $this->db->query($sql, array('', $idUser, $idMejora, 1));

                // RESTARLE EL DINERO
                $CI->banco_model->restarDineroUsuario($mejora->nivel_1, $idUser);

                return array('codigo' => 0, 'texto' => "Ampliación realizada correctamente");
            } else {
                return array('codigo' => 1, 'texto' => "No tienes suficiente dinero para realizar la ampliación");
            }
        }
    }

    /*
     * Comprar  una mejora
     */

    function comprar_mejora($id_mejora, $nivel_mejora) {
        $this->load->model('banco_model');
        $saldo = $this->banco_model->getSaldo();
    }

    /**
     * Construir panel usuario mejoras. Dibuja el panel con las mejoras que tiene cada usuario compradas.
     */
    function panel_mejoras_usuario() {

        $usuario_ojeadores = $this->get_mejora_usuario(1);
        $usuario_mecanicos = $this->get_mejora_usuario(2);
        $usuario_ingenieros = $this->get_mejora_usuario(3);
        $usuario_publicistas = $this->get_mejora_usuario(4);

        $mejora_ojeadores = $this->get_mejora(1);
        $mejora_mecanicos = $this->get_mejora(2);
        $mejora_ingenieros = $this->get_mejora(3);
        $mejora_publicistas = $this->get_mejora(4);


        $html = '<table><tr><td title="' . $this->lang->line('oficina_txt_desc_corta_oje')
                . '">' . anchor('mi_oficina/ojeadores', $this->lang->line('oficina_lbl_ojeador'), array('class' => 'button')) . '</td>';

        // Completar tabla marcando casillas activas o inactivas
        //////////////////////////////////////////////////
        ///  OJEADORES
        //////////////////////////////////////////////////
        if ($usuario_ojeadores) {
            $nivel = $usuario_ojeadores->nivel;

            for ($i = 1; $i <= 10; $i++) {
                $nombre = "nivel_" . $i;

                if ($i <= $nivel) {
                    $html .= '<td><img title="' . es_dinero($usuario_ojeadores->$nombre) . ' €" src="' . base_url() . 'img/mi_oficina/' . $i . 'on.jpg"></td>';
                } else {
                    $html .= '<td><img title="' . es_dinero($usuario_ojeadores->$nombre) . ' €" src="' . base_url() . 'img/mi_oficina/' . $i . 'off.jpg"></td>';
                }
            }
        } else {
            for ($i = 1; $i <= 10; $i++) {
                $nombre = "nivel_" . $i;

                $html .= '<td><img title="' . es_dinero($mejora_ojeadores->$nombre) . ' €" src="' . base_url() . 'img/mi_oficina/' . $i . 'off.jpg"></td>';
            }
        }



        //////////////////////////////////////////////////
        ///  MECANICOS
        //////////////////////////////////////////////////
        $html .= '<td >' . anchor('mi_oficina/ampliar/1', '+', array('class' => 'btn')) . '</td></tr><tr><td title="' . $this->lang->line('oficina_txt_desc_corta_mec')
                . '">' . anchor('mi_oficina/mecanicos', $this->lang->line('oficina_lbl_mecanico'), array('class' => 'button')) . '</td>';

        if ($usuario_mecanicos) {
            $nivel = $usuario_mecanicos->nivel;

            for ($i = 1; $i <= 10; $i++) {
                $nombre = "nivel_" . $i;

                if ($i <= $nivel) {
                    $html .= '<td><img title="' . es_dinero($usuario_mecanicos->$nombre) . ' €" src="' . base_url() . 'img/mi_oficina/' . $i . 'on.jpg"></td>';
                } else {
                    $html .= '<td><img title="' . es_dinero($usuario_mecanicos->$nombre) . ' €" src="' . base_url() . 'img/mi_oficina/' . $i . 'off.jpg"></td>';
                }
            }
        } else {
            for ($i = 1; $i <= 10; $i++) {
                $nombre = "nivel_" . $i;

                $html .= '<td><img title="' . es_dinero($mejora_mecanicos->$nombre) . ' €" src="' . base_url() . 'img/mi_oficina/' . $i . 'off.jpg"></td>';
            }
        }


        //////////////////////////////////////////////////
        ///  INGENIEROS
        //////////////////////////////////////////////////
        $html .= '<td class="plus">' . anchor('mi_oficina/ampliar/2', '+', array('class' => 'btn')) . '</td></tr><tr><td title="' .
                $this->lang->line('oficina_txt_desc_corta_ing') . '">' . anchor('mi_oficina/ingenieros', $this->lang->line('oficina_lbl_ingeniero'), array('class' => 'button')) . '</td>';

        if ($usuario_ingenieros) {
            $nivel = $usuario_ingenieros->nivel;

            for ($i = 1; $i <= 10; $i++) {
                $nombre = "nivel_" . $i;
                if ($i <= $nivel) {
                    $html .= '<td><img title="' . es_dinero($usuario_ingenieros->$nombre) . ' €" src="' . base_url() . 'img/mi_oficina/' . $i . 'on.jpg"></td>';
                } else {
                    $html .= '<td><img title="' . es_dinero($usuario_ingenieros->$nombre) . ' €" src="' . base_url() . 'img/mi_oficina/' . $i . 'off.jpg"></td>';
                }
            }
        } else {
            for ($i = 1; $i <= 10; $i++) {
                $nombre = "nivel_" . $i;

                $html .= '<td><img title="' . es_dinero($mejora_ingenieros->$nombre) . ' €" src="' . base_url() . 'img/mi_oficina/' . $i . 'off.jpg"></td>';
            }
        }
        //////////////////////////////////////////////////
        ///  PUBLICISTAS
        //////////////////////////////////////////////////
        $html .= '<td class="plus">' . anchor('mi_oficina/ampliar/3', '+', array('class' => 'btn')) . '</td></tr><tr><td title="' .
                $this->lang->line('oficina_txt_desc_corta_pub') . '">' . anchor('mi_oficina/publicistas', $this->lang->line('oficina_lbl_publicista'), array('class' => 'button')) . '</td>';

        if ($usuario_publicistas) {
            $nivel = $usuario_publicistas->nivel;

            for ($i = 1; $i <= 10; $i++) {
                $nombre = "nivel_" . $i;

                if ($i <= $nivel) {

                    $html .= '<td><img title="' . es_dinero($usuario_publicistas->$nombre) . ' €" src="' . base_url() . 'img/mi_oficina/' . $i . 'on.jpg"></td>';
                } else {
                    $html .= '<td><img title="' . es_dinero($usuario_publicistas->$nombre) . ' €" src="' . base_url() . 'img/mi_oficina/' . $i . 'off.jpg"></td>';
                }
            }
        } else {
            for ($i = 1; $i <= 10; $i++) {
                $nombre = "nivel_" . $i;
                $html .= '<td><img title="' . es_dinero($mejora_publicistas->$nombre) . ' €" src="' . base_url() . 'img/mi_oficina/' . $i . 'off.jpg"></td>';
            }
        }


        $html .= '<td class="plus">' . anchor('mi_oficina/ampliar/4', '+', array('class' => 'btn')) . '</td></tr></table>';


        return $html;
    }

    function get_resumen_gp() {
        $sql = "SELECT * FROM resultados_usuarios_desglose WHERE id_usuario = ? AND id_gp = ?";

        $Q = $this->db->query($sql, array($this->iduser, $this->id_gp_anterior));

        return $Q->result();
    }

    function getResumenGp($idUser) {
        $sql = "SELECT * FROM resultados_usuarios_desglose WHERE id_usuario = ? AND id_gp = ?";

        $Q = $this->db->query($sql, array($idUser, $this->id_gp_anterior));

        return $Q->result();
    }

}
