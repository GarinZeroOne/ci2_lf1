<?php

require_once APPPATH . 'classes/pilotos/piloto.php';
require_once APPPATH . 'classes/pilotos/valorMercado.php';
require_once APPPATH . 'classes/equipos/equipo.php';
require_once APPPATH . 'classes/movimientos/movimientosPilotos.php';
require_once APPPATH . 'classes/movimientos/movimientoPiloto.php';
require_once APPPATH . 'classes/movimientos/movimientosEquipos.php';
require_once APPPATH . 'classes/movimientos/movimientoEquipo.php';

class Admin extends CI_Controller {

    function Admin() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->database();
        $this->load->model('sesiones/control_session');
        $this->load->model('calendario/calendario_model');
        $this->load->model('usuarios/usuarios_model');
        $this->load->model('admin/admin_model');
    }

    function index() {

        $msgResultados = $this->session->flashdata('msgResultados');
        $msgClasificacion = $this->session->flashdata('msgClasificacionMundial');

        /* Es el admin???
          $msgResultados = $this->session->flashdata('msgResultados');msgClasificacionMundial

          /* Es el admin???
          if ($_SESSION['id_usuario'] == 177) { */

        //Se pasan los circuitos no procesados
        $datos['circuitos'] = $this->calendario_model->obtenerCircuitosSinProcesar();

        $datos['msgResultados'] = $msgResultados;
        $datos['msgClasificacion'] = $msgClasificacion;

        //Se prepara la vista				
        $this->load->view('admin/inicio', $datos);

        /* } else {
          // Si no es el admin le mandamos a inicio
          redirect_lf1('inicio');
          } */
    }

    function guardar_datos_gp() {
        if ($_POST) {

            $this->guardar_en_bd($_POST);
        }
    }

    function guardar_en_bd($datos) {
        $insert_data = array(
            'id' => '',
            'id_circuito' => $datos['circuito'],
            'id_primero' => $datos['primero'],
            'id_segundo' => $datos['segundo'],
            'id_tercero' => $datos['tercero'],
            'id_cuarto' => $datos['cuarto'],
            'id_quinto' => $datos['quinto'],
            'id_sexto' => $datos['sexto'],
            'id_septimo' => $datos['septimo'],
            'id_octavo' => $datos['octavo'],
            'id_noveno' => $datos['noveno'],
            'id_decimo' => $datos['decimo'],
            'id_poleman' => $datos['poleman'],
            'fecha' => date('Y-m-d'),
            'procesado' => 0,
        );
    }

    function guardarCircuitos() {
        if (isset($_POST['season'])) {
            $this->guardarCircuitosBd($_POST['season']);
        }

        redirect_lf1('admin');
    }

    function guardarCircuitosBd($season) {
        $url = 'http://ergast.com/api/f1/' . $season . '.json';

        $json = json_decode(file_get_contents($url));

        $MRData = $json->MRData;

        //Se vacian los circuitos
        $this->admin_model->vaciarCircuitos();

        foreach ($MRData->RaceTable as $raceTable) {
            foreach ($raceTable as $race) {
                $pais = "";
                $circuito = htmlentities($race->Circuit->circuitName);

                foreach ($race->Circuit as $circuit) {
                    $pais = $circuit->country;
                }

                $this->admin_model->insertarCirtuito($circuito, $pais, $race->date);
                $round++;
            }
        }
    }

    function guardarResultados() {

        $msg = "Resultados NO generados";

        if (isset($_POST['season']) && isset($_POST['gpNumber'])) {
            $msg = $this->_guardarResultadosBd($_POST['season'], $_POST['gpNumber']);
        }

        $this->session->set_flashdata('msgResultados', $msg);

        redirect_lf1('admin', 'refresh');
    }

    private function _guardarResultadosBd($season, $gpNumber) {

        $url = 'http://ergast.com/api/f1/' . $season . '/' . $gpNumber
                . '/results.json';

        $json = json_decode(file_get_contents($url));

        $MRData = $json->MRData;

        $idGp = $MRData->RaceTable->round;

        //Se comprueba si estan procesados los resultados del gp
        $resultadosGenerados = $this->admin_model->comprobarResultadosProcesados($idGp)->num_rows();

        if (!$resultadosGenerados) {

            foreach ($MRData->RaceTable as $raceTable) {

                foreach ($raceTable as $race) {

                    foreach ($race->Results as $result) {
                        $piloto = $this->admin_model->obtenerPilotoCodigo($result->Driver->code)->row();

                        $this->admin_model->insertarPosicionPiloto($piloto->id
                                , $idGp, $result->position);
                    }
                }
            }


            //Se obtienen los resultados de clasificacion para obtener el poleman
            $url = 'http://ergast.com/api/f1/' . $season . '/' . $gpNumber
                    . '/qualifying.json';

            $json = json_decode(file_get_contents($url));

            $MRData = $json->MRData;

            foreach ($MRData->RaceTable->Races as $race) {
                foreach ($race->QualifyingResults as $result) {

                    $piloto = $this->admin_model->obtenerPilotoDriverId($result->Driver->driverId)->row();


                    $this->admin_model->asignarPoleman($piloto->id, $idGp);
                    break;
                }
            }

            //Se insertan los resultados de los equipos
            $ordenEquipos = $this->admin_model->obtenerOrdenEquiposGp($idGp)->result();

            $contador = 1;
            foreach ($ordenEquipos as $equipo) {
                echo $equipo->id_equipo . "<br>";
                $this->admin_model->insertarPosicionEquipo
                        ($equipo->id_equipo, $idGp, $contador);

                $contador++;
            }

            $this->calendario_model->setCircuitoProcesado($idGp);

            return "Resultados generados correctamente";
        } else {
            return "Los resultados del GP " . $idGp . " ya están generados";
        }
    }

    function guardarClasificacionMundial() {
        $msg = "Clasificacion NO guardada";


        $msg = $this->_guardarClasificacionMundialBd();


        $this->session->set_flashdata('msgClasificacionMundial', $msg);

        redirect_lf1('admin', 'refresh');
    }

    private function _guardarClasificacionMundialBd() {

        $url = 'http://ergast.com/api/f1/current/driverStandings.json';

        $json = json_decode(file_get_contents($url));

        $MRData = $json->MRData;

        $this->admin_model->borrarClasificacionMundialPilotos();

        foreach ($MRData->StandingsTable->StandingsLists as $standing) {
            foreach ($standing->DriverStandings as $driverStanding) {

                $piloto = $this->admin_model->obtenerPilotoDriverId
                                ($driverStanding->Driver->driverId)->row();

                $this->admin_model->insertarClasificacionMundialPilotos
                        ($piloto->id
                        , $driverStanding->points
                        , $driverStanding->position);
            }
        }

        $url = 'http://ergast.com/api/f1/current/constructorStandings.json';

        $json = json_decode(file_get_contents($url));

        $MRData = $json->MRData;

        $this->admin_model->borrarClasificacionMundialEquipos();

        foreach ($MRData->StandingsTable->StandingsLists as $standing) {
            foreach ($standing->ConstructorStandings as $constructorStanding) {

                $equipo = $this->admin_model->obtenerEquipoConstructorId
                                ($constructorStanding->Constructor->constructorId)->row();

                $this->admin_model->insertarClasificacionMundialEquipos
                        ($equipo->id
                        , $constructorStanding->points
                        , $constructorStanding->position);
            }
        }

        return "Datos guardados correctamente";
    }

    function cambioValorMovimientos() {
        $this->_cambiarValoresMovimientosPilotos();
        $this->_cambiarValoresMovimientosEquipos();
    }

    private function _cambiarValoresMovimientosPilotos() {
        $this->load->model('admin/movimientos_mercado_model');
        $this->load->model('pilotos/pilotos_model');
        $this->load->model('boxes/boxes_model');

        $pilotos = $this->pilotos_model->getPilotosObject();

        $fecha = date('Y-m-d');
        $fechaAyer = date("Y-m-d", strtotime($fecha . " -1 day"));
        echo $fechaAyer;
        echo "<br>";

        foreach ($pilotos as $piloto) {

            $boxesAbiertos = $this->boxes_model->estadoFecha($fechaAyer);

            if ($boxesAbiertos) {

                $movimientoPiloto = new MovimientoPiloto($fechaAyer, $piloto->getIdPiloto());

                echo $piloto->getNombre();
                echo "<br>";
                echo "Ventas :" . $movimientoPiloto->getVentasPiloto();
                echo "<br>";
                echo "Porcentaje Ventas :" . $movimientoPiloto->getPorcentajeVenta();
                echo "<br>";
                echo "Compras :" . $movimientoPiloto->getComprasPiloto();
                echo "<br>";
                echo "Porcentaje Compras :" . $movimientoPiloto->getPorcentajeCompra();
                echo "<br>";
                echo "Movimientos piloto :" . $movimientoPiloto->getMovimientosPiloto();
                echo "<br>";
                echo "Porcentaje Movimientos piloto :" . $movimientoPiloto->getPorcentajeMovimientosPiloto();
                echo "<br>";
                echo "Movimientos totales :" . $movimientoPiloto->getMovimientosTotales();
                echo "<br>";


                if ($movimientoPiloto->getModificarPrecio() == 0) {
                    echo "no cambiar precio";
                } elseif ($movimientoPiloto->getModificarPrecio() == 1) {
                    $porcentajeSubir = $this->movimientos_mercado_model->
                                    getPorcentajeCambioValorMovimientos
                                            ($movimientoPiloto->getPorcentajeMovimientosPiloto()
                                            , $movimientoPiloto->getPorcentajeCompra())->row()->porcentaje_cambio;
                    echo "Subir " . $porcentajeSubir;
                    echo "<br>";
                    echo "valor antes : " . $piloto->getValorActual();
                    echo "<br>";
                    $piloto->aumentarValor($porcentajeSubir);
                    echo "valor despues : " . $piloto->getValorActual();
                } elseif ($movimientoPiloto->getModificarPrecio() == 2) {
                    $porcentajeBajar = $this->movimientos_mercado_model->
                                    getPorcentajeCambioValorMovimientos
                                            ($movimientoPiloto->getPorcentajeMovimientosPiloto()
                                            , $movimientoPiloto->getPorcentajeVenta())->row()->porcentaje_cambio;
                    echo "Bajar " . $porcentajeBajar;
                    echo "<br>";
                    echo "valor antes : " . $piloto->getValorActual();
                    echo "<br>";
                    $piloto->disminuirValor($porcentajeBajar);
                    echo "valor despues : " . $piloto->getValorActual();
                } elseif ($movimientoPiloto->getModificarPrecio() == 3) {
                    echo "Bajar por no movimientos";
                    $porcentajeBajar = $this->movimientos_mercado_model->
                                    getPorcentajeCambioValorMovimientos
                                            (0
                                            , 0)->row()->porcentaje_cambio;
                    echo "<br>";
                    echo "Bajar " . $porcentajeBajar;
                    echo "<br>";
                    echo "valor antes : " . $piloto->getValorActual();
                    echo "<br>";
                    $piloto->disminuirValor($porcentajeBajar);
                    echo "valor despues : " . $piloto->getValorActual();
                }

                echo "<br>";
                echo "<br>";
            }
            $this->pilotos_model->guardarValorPiloto($piloto);
        }
    }

    
    private function _cambiarValoresMovimientosEquipos() {
        $this->load->model('admin/movimientos_mercado_model');
        $this->load->model('equipos/equipos_model');
        $this->load->model('boxes/boxes_model');

        $equipos = $this->equipos_model->getEquiposObject();

        $fecha = date('Y-m-d');
        $fechaAyer = date("Y-m-d", strtotime($fecha . " -1 day"));
        echo $fechaAyer;
        echo "<br>";

        foreach ($equipos as $equipo) {

            $boxesAbiertos = $this->boxes_model->estadoFecha($fechaAyer);

            if ($boxesAbiertos) {

                $movimientoEquipo = new MovimientoEquipo($fechaAyer, $equipo->getIdEquipo());

                echo $equipo->getEscuderia();
                echo "<br>";
                echo "Ventas :" . $movimientoEquipo->getVentasEquipo();
                echo "<br>";
                echo "Porcentaje Ventas :" . $movimientoEquipo->getPorcentajeVenta();
                echo "<br>";
                echo "Compras :" . $movimientoEquipo->getComprasEquipo();
                echo "<br>";
                echo "Porcentaje Compras :" . $movimientoEquipo->getPorcentajeCompra();
                echo "<br>";
                echo "Movimientos piloto :" . $movimientoEquipo->getMovimientosEquipo();
                echo "<br>";
                echo "Porcentaje Movimientos piloto :" . $movimientoEquipo->getPorcentajeMovimientosEquipo();
                echo "<br>";
                echo "Movimientos totales :" . $movimientoEquipo->getMovimientosTotales();
                echo "<br>";


                if ($movimientoEquipo->getModificarPrecio() == 0) {
                    echo "no cambiar precio";
                } elseif ($movimientoEquipo->getModificarPrecio() == 1) {
                    $porcentajeSubir = $this->movimientos_mercado_model->
                                    getPorcentajeCambioValorMovimientos
                                            ($movimientoEquipo->getPorcentajeMovimientosEquipo()
                                            , $movimientoEquipo->getPorcentajeCompra())->row()->porcentaje_cambio;
                    echo "Subir " . $porcentajeSubir;
                    echo "<br>";
                    echo "valor antes : " . $equipo->getValorActual();
                    echo "<br>";
                    $equipo->aumentarValor($porcentajeSubir);
                    echo "valor despues : " . $equipo->getValorActual();
                } elseif ($movimientoEquipo->getModificarPrecio() == 2) {
                    $porcentajeBajar = $this->movimientos_mercado_model->
                                    getPorcentajeCambioValorMovimientos
                                            ($movimientoEquipo->getPorcentajeMovimientosEquipo()
                                            , $movimientoEquipo->getPorcentajeVenta())->row()->porcentaje_cambio;
                    echo "Bajar " . $porcentajeBajar;
                    echo "<br>";
                    echo "valor antes : " . $equipo->getValorActual();
                    echo "<br>";
                    $equipo->disminuirValor($porcentajeBajar);
                    echo "valor despues : " . $equipo->getValorActual();
                } elseif ($movimientoEquipo->getModificarPrecio() == 3) {
                    echo "Bajar por no movimientos";
                    $porcentajeBajar = $this->movimientos_mercado_model->
                                    getPorcentajeCambioValorMovimientos
                                            (0
                                            , 0)->row()->porcentaje_cambio;
                    echo "<br>";
                    echo "Bajar " . $porcentajeBajar;
                    echo "<br>";
                    echo "valor antes : " . $equipo->getValorActual();
                    echo "<br>";
                    $equipo->disminuirValor($porcentajeBajar);
                    echo "valor despues : " . $equipo->getValorActual();
                }

                echo "<br>";
                echo "<br>";
            }
            $this->equipos_model->guardarValorEquipo($equipo);
        }
    }

}
