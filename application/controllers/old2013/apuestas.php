<?php

class Apuestas extends Controller {

    var $maximoApuesta = 30000;
    var $maximoNegativo = -200000;

    function Apuestas() {
        parent::Controller();
        $this->load->helper(array('form', 'url'));
        $this->load->library('validation');
        $this->load->database();
        $this->load->model(array('sesiones/control_session',
            'banco/banco_model',
            'pilotos/pilotos_model',
            'equipos/equipos_model',
            'boxes/boxes_model',
            'usuarios/usuarios_model',
            'calendario/calendario_model',
            'apuestas/apuestas_model'
        ));
    }

    function index() {
        // Control boxes
        $estadoBoxes = $this->boxes_model->estado();

        // controlar session
        $this->control_session->comprobar_sesion();

        //Se recogen el posible mensaje
        $datos['msg'] = "<div class='msgErr'>" . $this->session->flashdata('msg') . "</div>";

        //Se recogen el posible mensaje
        $datos['msgOk'] = "<div class='msgOk'>" . $this->session->flashdata('msgOk') . "</div>";

        // Recoger saldo usuario
        $menu['saldo'] = $this->banco_model->getSaldo('formateado');
        $menu['estadisticas'] = false;

        // Datos para la cuenta atras al GP
        $next_GP = $this->calendario_model->obtenerPaisDelSiguienteGp();

        $fecha_gp = explode("-", $next_GP->fecha);

        $menu['anioGP'] = $fecha_gp[0];
        $menu['mesGP'] = $fecha_gp[1];
        $menu['diaGP'] = $fecha_gp[2];
        $menu['paisGP'] = $next_GP->pais;

        //Se obtiene la fecha del siguiente GP.
        $datos['GP'] = $this->calendario_model->getNextGP();

        //Se obtienen los pilotos
        $datos['pilotos'] = $this->pilotos_model->get_pilotos_buenos();

        //Se obtienen los operadores
        $datos['operadores'] = $this->apuestas_model->getOperadores();
        /* echo "<pre>";
          print_r($datos['operadores']);
          echo "</pre>";
          die; */
        //Se obtienen los operadores
        $datos['modosApuesta'] = $this->apuestas_model->getModoApuesta();

        //Se obtienen mis apuestas
        $datos['misApuestasEmitidas'] = $this->apuestas_model->getMisApuestasEmitidas($datos['GP']->id);

        //Se obtienen mis apuesta aceptadas
        $datos['misApuestasAceptadas'] = $this->apuestas_model->getMisApuestasAceptadas($datos['GP']->id);

        //Se obtienen las apuestas pendientes
        $datos['apuestasPendientes'] = $this->apuestas_model->getApuestasPendientes($datos['GP']->id);

        // abrir cerrar box
        $datos['boxes'] = $estadoBoxes;

        // Preparar la vista
        $header['estilos'] = array('boxes.css');

        $this->load->view('base/cabecera', $header);
        $this->load->view('base/page_top');
        $this->load->view('base/menu_vertical_boxes', $menu);
        $this->load->view('boxes/apuestas', $datos);
        $this->load->view('base/page_bottom');
    }

    function nuevaApuesta() {
        //Se comprueva el valor de cantidad
        $rules['cantidad'] = "trim|numeric";

        $this->validation->set_rules($rules);

        $fields['cantidad'] = 'Cantidad';

        $this->validation->set_fields($fields);

        if ($this->validation->run() == FALSE) {
            $this->session->set_flashdata('msg', $this->validation->error_string);
            redirect_lf1('apuestas');
        }

        if ($_POST['cantidad'] <= 0) {
            $this->session->set_flashdata('msg', 'La cantidad apostada tiene que ser mayor que 0!');
            redirect_lf1('apuestas');
        }

        //Se comprueba si el usuario tiene saldo suficiente
        $saldoUsuario = $this->banco_model->getSaldo();

        if ($saldoUsuario - $_POST['cantidad'] < $this->maximoNegativo) {
            $this->session->set_flashdata('msg', 'El banco solo permite una deuda de ' . $this->maximoNegativo . ' €!');
            redirect_lf1('apuestas');
        }


        //Se comprueba si hay usuario receptor
        if (trim($_POST['usuario']) == "") {
            $idUsuarioReceptor = -1;
        } else {
            //Se comprueba si existe el usuario recpetor
            $idUsuarioReceptor = $this->usuarios_model->userDataNick($_POST['usuario'])->id;

            if (!$idUsuarioReceptor) {
                $this->session->set_flashdata('msg', 'No existe el usuario receptor!');
                redirect_lf1('apuestas');
            }

            //Se comprueba si el usuario emisor y el receptor es el mismo

            if ($idUsuarioReceptor == $_SESSION['id_usuario']) {
                $this->session->set_flashdata('msg', 'El usuario emisor no puede ser el mismo que el receptor!');
                redirect_lf1('apuestas');
            }
        }
        //Se obtiene la fecha del siguiente GP.
        $idGp = $this->calendario_model->getNextGP()->id;

        //Se comprueba el dinero apostado por el usuriario
        $dineroApostado = $this->apuestas_model->getDineroApostado($_SESSION['id_usuario'], $idGp);


        if ($dineroApostado > $this->maximoApuesta) {
            $this->session->set_flashdata('msg', "No se puede apostar mas de " . $this->maximoApuesta);
            redirect_lf1('apuestas');
        }

        //Se comprueba que tipo de apuesta se hace
        switch ($_POST['apuesta']) {
            case 0:

                //Se comprueba que no se dan casos imposibles
                if ($_POST['posicion1'] == 23) {
                    if ($_POST['operador1'] == 2) {
                        $this->session->set_flashdata('msg', 'No hay peor posicion que el abandono!');
                        redirect_lf1('apuestas');
                    }
                }

                //Se comprueba que no se dan casos imposibles
                if ($_POST['posicion1'] == 1) {
                    if ($_POST['operador1'] == 1) {
                        $this->session->set_flashdata('msg', 'No hay mejor posicion que el 1ª!');
                        redirect_lf1('apuestas');
                    }
                }


                //Se inserta el registro en BBDD
                $this->apuestas_model->insertApuesta($_POST['apuesta'], $_SESSION['id_usuario'], $idUsuarioReceptor,
                        $_POST['piloto1'], $_POST['posicion1'], $_POST['operador1'],
                        $idGp, $_POST['cantidad'], $_POST['modoApuesta1']);
                $this->session->set_flashdata('msgOk', 'Apuesta insertada correctamente!');
                redirect_lf1('apuestas');
                break;
            case 1:
                if ($_POST['piloto2_1'] == $_POST['piloto2_2']) {
                    $this->session->set_flashdata('msg', 'El piloto no puede ser el mismo!');
                    redirect_lf1('apuestas');
                }
                //Se inserta el registro en BBDD
                $this->apuestas_model->insertApuesta($_POST['apuesta'], $_SESSION['id_usuario'], $idUsuarioReceptor,
                        $_POST['piloto2_1'], $_POST['piloto2_2'], $_POST['operador2'],
                        $idGp, $_POST['cantidad'], $_POST['modoApuesta2']);
                $this->session->set_flashdata('msgOk', 'Apuesta insertada correctamente!');
                redirect_lf1('apuestas');
                break;
            case 2:
                //Se comprueba que no se dan casos imposibles
                if ($_POST['posicion3'] == 22) {
                    if ($_POST['operador1'] == 1) {
                        $this->session->set_flashdata('msg', 'No puede haber mas de 22 abandonos!');
                        redirect_lf1('apuestas');
                    }
                }

                //Se inserta el registro en BBDD
                $this->apuestas_model->insertApuesta($_POST['apuesta'], $_SESSION['id_usuario'], $idUsuarioReceptor,
                        $_POST['posicion3'], '', $_POST['operador3'],
                        $idGp, $_POST['cantidad'], $_POST['modoApuesta3']);
                $this->session->set_flashdata('msgOk', 'Apuesta insertada correctamente!');
                redirect_lf1('apuestas');
                break;
            case 3:
                //Se inserta el registro en BBDD
                $this->apuestas_model->insertApuesta($_POST['apuesta'], $_SESSION['id_usuario'], $idUsuarioReceptor,
                        $_POST['piloto4'], '', 0,
                        $idGp, $_POST['cantidad'], $_POST['modoApuesta4']);
                $this->session->set_flashdata('msgOk', 'Apuesta insertada correctamente!');
                redirect_lf1('apuestas');
                break;
            default:
                redirect_lf1('apuestas');
                break;
        }
    }

    //Funcion que acepta una apuesta
    function aceptarApuesta() {
        //Se comprueba el dinero apostado en el GP
        //Se obtiene la fecha del siguiente GP.
        $idGp = $this->calendario_model->getNextGP()->id;

        $dineroApostado = $this->apuestas_model->getDineroApostado($_SESSION['id_usuario'], $idGp);


        if ($dineroApostado > $this->maximoApuesta) {
            $this->session->set_flashdata('msg', "No se puede apostar mas de " . $this->maximoApuesta);
            redirect_lf1('apuestas');
        }

        //Se comprueba si el usuario tiene saldo suficiente
        $saldoUsuario = $this->banco_model->getSaldo();

        if ($saldoUsuario - $dineroApostado < $this->maximoNegativo) {
            $this->session->set_flashdata('msg', 'Estas en numeros rojos, no puedes deber mas de !' . $this->maximoNegativo);
            redirect_lf1('apuestas');
        }

        //Recoger parametros de URI
        $idApuesta = $this->uri->segment(3);

        //Se cambia el estado de la apuesta
        $this->apuestas_model->cambiarEstadoApuesta("A", $idApuesta, $_SESSION['id_usuario']);

        //Se quita el dinero apostado
        $this->apuestas_model->restarDineroApostado($idApuesta);

        $this->session->set_flashdata('msgOk', 'Apuesta aceptada!');
        redirect_lf1('apuestas');
    }

    //Funcion que rechaza una apuesta
    function rechazarApuesta() {
        //Recoger parametros de URI
        $idApuesta = $this->uri->segment(3);

        $this->apuestas_model->cambiarEstadoApuesta("R", $idApuesta, $_SESSION['id_usuario']);
        $this->session->set_flashdata('msgOk', 'Apuesta rechazada!');
        redirect_lf1('apuestas');
    }

}
