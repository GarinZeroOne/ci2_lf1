<?php

class gestionApuestas extends CI_Model {

    function GestionApuestas() {
        parent::__construct();
        $this->load->model(array('apuestas/apuestas_model', 'banco/banco_model'));
    }

    function procesarApuestas($idGp) {

        //Se obtienen todas las apuestas del GP
        $sql = "SELECT * FROM apuesta WHERE id_gp = ? AND estado = ?";

        $query = $this->db->query($sql, array($idGp, 'A'))->result();

        foreach ($query as $linea) {

            //Se obtiene el modo apuesta
            $modoApuesta = $this->apuestas_model->getUnModoApuesta($linea->id_modo_apuesta);

            //Se comprueba el tipo de apuesta
            switch ($linea->tipo_apuesta) {
                case 0:

                    //Se obtiene la posicion del piloto
                    $posicion = $this->getPosicionPiloto($linea->id_campo1);



                    //Se comprueba que usuario ha ganado la apuesta
                    switch ($linea->id_operador) {
                        case 1:
                            if ($posicion < $linea->id_campo2) {
                                $idGanador = $linea->id_usuario_emisor;
                                $idPerdedor = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } else {
                                $idGanador = $linea->id_usuario_receptor;
                                $idPerdedor = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
                            break;

                        case 2:
                            if ($posicion > $linea->id_campo2) {
                                $idGanador = $linea->id_usuario_emisor;
                                $idPerdedor = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } else {
                                $idGanador = $linea->id_usuario_receptor;
                                $idPerdedor = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
                            break;

                        //case 3;
                        case 3:
                            if ($posicion == $linea->id_campo2) {
                                $idGanador = $linea->id_usuario_emisor;
                                $idPerdedor = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } else {
                                $idGanador = $linea->id_usuario_receptor;
                                $idPerdedor = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
                            break;
                    }
                    break;

                case 1:
                    //Se obtiene la posicion del piloto 1
                    $posicionPiloto1 = $this->getPosicionPiloto($linea->id_campo1);

                    //Se obtiene la posicion del piloto 2
                    $posicionPiloto2 = $this->getPosicionPiloto($linea->id_campo2);

                    //Se comprueba que usuario ha ganado la apuesta
                    switch ($linea->id_operador) {
                        case 1:
                            if ($posicionPiloto1 < $posicionPiloto2) {
                                $idGanador = $linea->id_usuario_emisor;
                                $idPerdedor = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } else {
                                $idGanador = $linea->id_usuario_receptor;
                                $idPerdedor = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
                            break;
                        case 2:
                            if ($posicionPiloto1 > $posicionPiloto2) {
                                $idGanador = $linea->id_usuario_emisor;
                                $idPerdedor = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } else {
                                $idGanador = $linea->id_usuario_receptor;
                                $idPerdedor = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
                            break;
                    }
                    break;
                    break;
                case 2:
                    //Se el numero de abandonos
                    $numAbandonos = $this->getNumAbandonos();

                    //Se comprueba que usuario ha ganado la apuesta
                    switch ($linea->id_operador) {
                        case 1:
                            if ($linea->campo1 < $numAbandonos) {
                                $idGanador = $linea->id_usuario_emisor;
                                $idPerdedor = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } else {
                                $idGanador = $linea->id_usuario_receptor;
                                $idPerdedor = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
                            break;
                        case 2:
                            if ($linea->campo1 > $numAbandonos) {
                                $idGanador = $linea->id_usuario_emisor;
                                $idPerdedor = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } else {
                                $idGanador = $linea->id_usuario_receptor;
                                $idPerdedor = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
                            break;
                        case 3:
                            if ($linea->campo1 == $numAbandonos) {
                                $idGanador = $linea->id_usuario_emisor;
                                $idPerdedor = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } else {
                                $idGanador = $linea->id_usuario_receptor;
                                $idPerdedor = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
                            break;
                    }
                    break;
                    break;
                case 3:
                    //Se el numero de abandonos
                    $idPoleman = $this->getPoleman($idGp);

                    //Se comprueba que usuario ha ganado la apuesta
                    if ($linea->campo1 == $idPoleman) {
                        $idGanador = $linea->id_usuario_emisor;
                        $idPerdedor = $linea->id_usuario_receptor;
                        $usuarioGanador = "emisor";
                    } else {
                        $idGanador = $linea->id_usuario_receptor;
                        $idPerdedor = $linea->id_usuario_emisor;
                        $usuarioGanador = "receptor";
                    }

                    break;
                default;
                    break;
            }

            //echo "Ganador:".$idGanador;echo "<br>";
            //echo "Perdedor:".$idPerdedor;
            $ganancia = 0;
            $perdida = 0;
            $gananciaApuesta = 0;
            /*
              if( $idPerdedor == 619)
              {
              if ($usuarioGanador == "emisor") {
              $ganancia = $linea->cantidad + ($linea->cantidad * $modoApuesta->operacion_receptor );
              $perdida = $linea->cantidad * ($modoApuesta->operacion_receptor * -1);
              } else {
              $ganancia = $linea->cantidad + ($linea->cantidad * $modoApuesta->operacion_receptor );
              $perdida = $linea->cantidad * -1;
              }

              echo "gana:".$ganancia;
              echo "perdi:".$perdida;
              echo "cantidad:".$linea->cantidad;
              //die;
              } */

            //Se pagan las apuestas
            //Se obtiene la cantidad a pagar
            if ($usuarioGanador == "emisor") {
                $ganancia = $linea->cantidad + ($linea->cantidad * $modoApuesta->operacion_receptor );
                $perdida = $linea->cantidad * $modoApuesta->operacion_receptor * -1;
                $gananciaApuesta = $linea->cantidad * $modoApuesta->operacion_receptor;
            } else {
                $ganancia = $linea->cantidad + ($linea->cantidad * $modoApuesta->operacion );
                $perdida = $linea->cantidad * -1;
                $gananciaApuesta = $linea->cantidad * $modoApuesta->operacion;
            }
/*

              if ($linea->id_usuario_emisor == 37 or $linea->id_usuario_receptor == 37){
              echo $idGanador."ganador<br>";
              echo $linea->id_modo_apuesta;
              echo "<br>";
              echo "ope".$modoApuesta->operacion;
              echo "<br>";
              echo "operecep".$modoApuesta->operacion_receptor;
              echo "<br>".$ganancia."<br>";
              echo $gananciaApuesta."<br>";
              echo $usuarioGanador;
              echo $posicionPiloto1."-piloto1<br>";
              echo $posicionPiloto2."-piloto2<br>";
              echo $perdida."<br>";
              }*/
             
            //Se modifica el dinero del banco
            $this->banco_model->sumarDinero($ganancia, $idGanador);

            //Se comprueba si ya tiene alguna linea en la tabla resultado_usuarios_desglose del ganador
            $registroDesglose = $this->getResultadoDesglose($idGp, $idGanador, 'apuestas');

            //Si no existe ningun registro se crea uno nuevo si existe se actualizan
            if ($registroDesglose) {
                //Se acutaliza el registro
                $this->modificarResultadoDesglose($gananciaApuesta, $idGp, $idGanador, 'apuestas');
            } else {
                //Se inserta el registro
                $this->insertResultadoDesglose($gananciaApuesta, $idGp, $idGanador, 'apuestas');
            }

            //Se comprueba si ya tiene alguna linea en la tabla resultado_usuarios_desglose del perdedor
            $registroDesglose = $this->getResultadoDesglose($idGp, $idPerdedor, 'apuestas');

            //Si no existe ningun registro se crea uno nuevo si existe se actualizan
            if ($registroDesglose) {
                //Se acutaliza el registro
                $this->modificarResultadoDesglose($perdida, $idGp, $idPerdedor, 'apuestas');
            } else {
                //Se inserta el registro
                $this->insertResultadoDesglose($perdida, $idGp, $idPerdedor, 'apuestas');
            }
        }
        return "Proceso terminado correctamente!";
    }

    //Obtener puesto piloto
    function getPosicionPiloto($id_piloto) {
        $sql = "SELECT * FROM resultados_pilotos_2011 WHERE id_piloto = ?";

        $posicion = $this->db->query($sql, array($id_piloto))->row()->posicion;

        return $posicion;
    }

    //Obtener numero de abandonos
    function getNumAbandonos($idPiloto) {
        $sql = "SELECT * FROM resultados_pilotos_2011 WHERE posicion = ?";

        $numRows = $this->db->query($sql, array('23'))->num_rows();

        return $numRows;
    }
	
	//Obtener numero de abandonos GARIN
    function getNumAbandonos_garin( $idGp ) {
        $sql = "SELECT * FROM resultados_pilotos_2011 WHERE posicion = ? and id_gp = ?";

        $numRows = $this->db->query($sql, array('25', $idGp))->num_rows();

        return $numRows;
    }

    //Funcion que devuelve el poleman
    function getPoleman($idGp) {
        $sql = "SELECT * FROM resultados_pilotos_2011 WHERE id_gp = ? AND poleman = ?";

        $idPoleman = $this->db->query($sql, array($idGp, '1'))->row()->id_piloto;

        return $idPoleman;
    }

    //Funcion que devuelve si el usuario ya tiene registro en la tabla resultado_usuarios_desglose
    function getResultadoDesglose($idGp, $idUsuario, $tipoRegistro) {
        $sql = "SELECT * FROM resultados_usuarios_desglose WHERE id_gp = ?
                AND id_usuario = ? AND tipo = ?";

        $resultUsuarioDes = $this->db->query($sql, array($idGp, $idUsuario, $tipoRegistro))->row();

        return $resultUsuarioDes;
    }

    //Funcion modificar resultadoDesglose
    function modificarResultadoDesglose($cantidad, $idGp, $idUsuario, $tipoRegistro) {
        $sql = "UPDATE resultados_usuarios_desglose SET dinero = dinero + ?
                WHERE id_gp = ? AND id_usuario = ? AND tipo = ?";

        $this->db->query($sql, array($cantidad, $idGp, $idUsuario, $tipoRegistro));
    }

    //Funcion que inserta un registro en la tabla resultado_usuarios_desglose
    function insertResultadoDesglose($cantidad, $idGp, $idUsuario, $tipoRegistro) {
        $sql = "INSERT INTO resultados_usuarios_desglose (id,id_piloto,id_gp,dinero,puntos,id_usuario,tipo)
                VALUES ('',?,?,?,?,?,?)";

        $this->db->query($sql, array('0', $idGp, $cantidad, '0', $idUsuario, $tipoRegistro));
    }
	
	
	// --------------------------------------------------------------------------------------------
	// PRUEBAS GARIN : creo otra funcion para no modificar la tuya, y asi pruebo a ver si encuentro
	// el fallo.
	// --------------------------------------------------------------------------------------------
	
	function procesarApuestas_garin($idGp) {

        //Se obtienen todas las apuestas del GP
        $sql = "SELECT * FROM apuesta WHERE id_gp = ? AND estado = ?";

        $query = $this->db->query($sql, array($idGp, 'A'))->result();

        foreach ($query as $linea) 
		{

            //Se obtiene el modo apuesta
            $modoApuesta = $this->apuestas_model->getUnModoApuesta($linea->id_modo_apuesta);

            //Se comprueba el tipo de apuesta
            switch ($linea->tipo_apuesta) 
			{
            	
				// --------------------------------------------------------------------------------------------
				// APUESTAS POR POSICION
				// --------------------------------------------------------------------------------------------
                case 0:

                    //Se obtiene la posicion del piloto
                    $posicion = $this->getPosicionPiloto($linea->id_campo1);


                    //Se comprueba que usuario ha ganado la apuesta
                    switch ($linea->id_operador) {
                        case 1:
                            if ($posicion < $linea->id_campo2) {
                                $idGanador = $linea->id_usuario_emisor;
                                $idPerdedor = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } else {
                                $idGanador = $linea->id_usuario_receptor;
                                $idPerdedor = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
                            break;

                        case 2:
                            if ($posicion > $linea->id_campo2) {
                                $idGanador = $linea->id_usuario_emisor;
                                $idPerdedor = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } else {
                                $idGanador = $linea->id_usuario_receptor;
                                $idPerdedor = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
                            break;

                        //case 3;
                        case 3:
                            if ($posicion == $linea->id_campo2) {
                                $idGanador = $linea->id_usuario_emisor;
                                $idPerdedor = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } else {
                                $idGanador = $linea->id_usuario_receptor;
                                $idPerdedor = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
                            break;
                    }
                
				break;
				
				// --------------------------------------------------------------------------------------------
				// APUESTAS MEJOR QUE OTRO PILOTO [TODO OK] [sobraba un break]
				// --------------------------------------------------------------------------------------------
                case 1:
				
				
                    //Se obtiene la posicion del piloto 1
                    $posicionPiloto1 = $this->getPosicionPiloto($linea->id_campo1);

                    //Se obtiene la posicion del piloto 2
                    $posicionPiloto2 = $this->getPosicionPiloto($linea->id_campo2);

                    //Se comprueba que usuario ha ganado la apuesta
                    switch ($linea->id_operador) 
					{
                        case 1:
						
                            if ($posicionPiloto1 < $posicionPiloto2) 
							{
                                $idGanador      = $linea->id_usuario_emisor;
                                $idPerdedor     = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } 
							else 
							{
                                $idGanador      = $linea->id_usuario_receptor;
                                $idPerdedor     = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
							
                        break;
						
                        case 2:
                            if ($posicionPiloto1 > $posicionPiloto2) 
							{
                                $idGanador      = $linea->id_usuario_emisor;
                                $idPerdedor     = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } 
							else 
							{
                                $idGanador      = $linea->id_usuario_receptor;
                                $idPerdedor     = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
							
                        break;
                    }
               
			    break;
				//****************************** UN break sobraba	
               //break;
				
					
			  	// --------------------------------------------------------------------------------------------
				// ABANDONOS [TODO OK] Sobraba otro break, y no se obtenia bien el numero de abandonos,
				// hay que pasarle el id del gp y tiene que buscar por el puesto 25=abandonos
				// --------------------------------------------------------------------------------------------		
                case 2:
				
				
                    //Se el numero de abandonos
                    $numAbandonos = $this->getNumAbandonos_garin( $idGp );
                    
					//Se comprueba que usuario ha ganado la apuesta
                    switch ($linea->id_operador) 
					{
                        case 1:
                            if ($linea->campo1 < $numAbandonos) 
							{
                                $idGanador 		= $linea->id_usuario_emisor;
                                $idPerdedor 	= $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } 
							else 
							{
                                $idGanador 		= $linea->id_usuario_receptor;
                                $idPerdedor 	= $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
                        break;
						
                        case 2:
                            if ($linea->campo1 > $numAbandonos) 
							{
                                $idGanador      = $linea->id_usuario_emisor;
                                $idPerdedor     = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } 
							else 
							{
                                $idGanador      = $linea->id_usuario_receptor;
                                $idPerdedor     = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
						break;
						
                        case 3:
                            if ($linea->campo1 == $numAbandonos) 
							{
                                $idGanador      = $linea->id_usuario_emisor;
                                $idPerdedor     = $linea->id_usuario_receptor;
                                $usuarioGanador = "emisor";
                            } else 
							{
                                $idGanador      = $linea->id_usuario_receptor;
                                $idPerdedor     = $linea->id_usuario_emisor;
                                $usuarioGanador = "receptor";
                            }
                        break;
                    }
					
					
                break;
                //break; //Sobra este break
                
				
				// --------------------------------------------------------------------------------------------
				// POLEMAN []
				// --------------------------------------------------------------------------------------------		
				case 3:
                    //Se el numero de abandonos
                    $idPoleman = $this->getPoleman($idGp);

                    //Se comprueba que usuario ha ganado la apuesta
                    if ($linea->campo1 == $idPoleman) {
                        $idGanador = $linea->id_usuario_emisor;
                        $idPerdedor = $linea->id_usuario_receptor;
                        $usuarioGanador = "emisor";
                    } else {
                        $idGanador = $linea->id_usuario_receptor;
                        $idPerdedor = $linea->id_usuario_emisor;
                        $usuarioGanador = "receptor";
                    }

                    break;
                default;
                    break;
            }

            //echo "Ganador:".$idGanador;echo "<br>";
            //echo "Perdedor:".$idPerdedor;
            $ganancia = 0;
            $perdida = 0;
            $gananciaApuesta = 0;
            /*
              if( $idPerdedor == 619)
              {
              if ($usuarioGanador == "emisor") {
              $ganancia = $linea->cantidad + ($linea->cantidad * $modoApuesta->operacion_receptor );
              $perdida = $linea->cantidad * ($modoApuesta->operacion_receptor * -1);
              } else {
              $ganancia = $linea->cantidad + ($linea->cantidad * $modoApuesta->operacion_receptor );
              $perdida = $linea->cantidad * -1;
              }

              echo "gana:".$ganancia;
              echo "perdi:".$perdida;
              echo "cantidad:".$linea->cantidad;
              //die;
              } */

            //Se pagan las apuestas
            //Se obtiene la cantidad a pagar
            if ($usuarioGanador == "emisor") 
			{
                $ganancia = $linea->cantidad + ($linea->cantidad * $modoApuesta->operacion_receptor );
                $perdida = $linea->cantidad * $modoApuesta->operacion_receptor * -1;
                $gananciaApuesta = $linea->cantidad * $modoApuesta->operacion_receptor;
            } 
			else 
			{
                $ganancia = $linea->cantidad + ($linea->cantidad * $modoApuesta->operacion );
                $perdida = $linea->cantidad * -1;
                $gananciaApuesta = $linea->cantidad * $modoApuesta->operacion;
				
            }
			
			/*echo $ganancia;echo "<br>";
				echo $perdida;echo "<br>";
				echo $gananciaApuesta;echo "<br>";
				die;*/
/*

              if ($linea->id_usuario_emisor == 37 or $linea->id_usuario_receptor == 37){
              echo $idGanador."ganador<br>";
              echo $linea->id_modo_apuesta;
              echo "<br>";
              echo "ope".$modoApuesta->operacion;
              echo "<br>";
              echo "operecep".$modoApuesta->operacion_receptor;
              echo "<br>".$ganancia."<br>";
              echo $gananciaApuesta."<br>";
              echo $usuarioGanador;
              echo $posicionPiloto1."-piloto1<br>";
              echo $posicionPiloto2."-piloto2<br>";
              echo $perdida."<br>";
              }*/
             
            //Se modifica el dinero del banco
            $this->banco_model->sumarDinero($ganancia, $idGanador);
			
			// UN REGISTRO POR CADA APUESTA!! EN EL DESGLOSE SE MOSTRARAN TANTAS ENTRADAS COMO APUESTAS TENGA
			// EN LAS APUESTAS QUE NO HA GANADO SE LE PONDRA 0 EN LAS QUE HA GANADO SE LE PONDRA LA GANANCIA
			// LO QUE SE INGRESA.
			
			
            //Se comprueba si ya tiene alguna linea en la tabla resultado_usuarios_desglose del ganador
            $registroDesglose = $this->getResultadoDesglose($idGp, $idGanador, 'apuestas');

            
			// Desglose Ganador y Perdedor
			$this->insertResultadoDesglose($ganancia, $idGp, $idGanador, 'apuestas');

            $this->insertResultadoDesglose(0, $idGp, $idPerdedor, 'apuestas');
            
			
			
        }
        return "Proceso terminado correctamente!";
    }
	

}
