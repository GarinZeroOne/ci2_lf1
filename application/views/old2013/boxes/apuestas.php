<div id=contenBox>
    <?php if($boxes):?>
    <div id=textinfo>
        <div id=texto>
            <h3>Apuestas <?php echo $GP->circuito . " (" . $GP->pais . ")"; ?></h3>

            <?php
            if ($this->session->flashdata('msg') != '') {
                echo $msg;
            }
            ?>
            <?php
            if ($this->session->flashdata('msgOk') != '') {
                echo $msgOk;
            }
            ?>
            <p>Desde aqui podras poner una apuesta en el tablon de apuestas o apostar directamente contra otro usuario.</p>
            <p>En la parte izquierda se eligira el tipo de apuesta. Si no se elige ningun rival
            la apuesta se dejará en el tablon de apuestas para que otro usuario la pueda aceptar.</p>
            <p>En la parte derecha se elige el modo de apuesta, 1 a 1
            (se gana el mismo dinero que se apuesta) 1 a 2 (se gana el doble del dinero apostado) y 2 a 1
            (se gana la mitad del dinero apostado).</p>
            <p> No se puede apostar mas de 30000 € por GP.  El dinero apostado se resta cuando la apuesta es
            aceptada.

            </p>
        </div>
    </div>

    <div id="misApuestas">
        <h3>Mis apuestas</h3>
            <?php
            $i = 0;
            echo "<table>";
            foreach ($misApuestasEmitidas as $linea) {
                if ($i == 0) {
                    echo "Retador";
                }
                echo "<tr>";
                echo "<td class='txtapuesta' colspan=4>";
                echo $linea['textoApuesta'];
                echo "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>";
                echo "Cantidad : " . $linea ['cantidad'];
                echo "</td>";
                echo "<td>";
                echo " Rival : " . $linea['nickReceptor'];
                echo "</td>";
                echo "<td>";
                echo "Ganancia :" . $linea['ganancia'];
                echo "</td>";
                echo "<td>";
                if ($linea['estado'] == "P") {
                    echo " Pendiente";
                } elseif ($linea['estado'] == "A") {
                    echo " Aceptada";
                } else {
                    echo " Rechazada";
                }
                echo "</td>";
                echo "</tr>";
				echo "<tr><td class='separador' colspan='4'></td></tr>";
                $i = $i + 1;
            }
            echo "</table>";
            ?>
            <?php
            $i = 0;
            echo "<table>";
            foreach ($misApuestasAceptadas as $linea) {
                if ($i == 0) {
                    echo "Retado";
                }
                echo "<tr>";
                echo "<td class='txtapuesta' colspan=4>";
                echo $linea['textoApuesta'];
                echo "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>";
                echo "Cantidad : " . $linea ['cantidad'];
                echo "</td>";
                echo "<td>";
                echo " Rival : " . $linea['nickEmisor'];
                echo "</td>";
                echo "<td>";
                echo "Ganancia :" . $linea['ganancia'];
                echo "</td>";
                echo "<td>";
                if ($linea['estado'] == "P") {
                    echo anchor('/apuestas/aceptarApuesta/' . $linea['id_apuesta'], Aceptar) . "-" .
                    anchor('/apuestas/rechazarApuesta/' . $linea['id_apuesta'], Rechazar);
                } elseif ($linea['estado'] == "A") {
                    echo " Aceptada";
                } else {
                    echo " Rechazada";
                }
                echo "</td>";
                echo "</tr>";
				echo "<tr><td class='separador' colspan='4'></td></tr>";
                $i = $i + 1;
            }
            echo "</table>";
            ?>
        
    </div>

    <div id="crearApuestas">
        <h3>Realizar apuestas</h3>
            <table class="allSize">
                <form action="<?= site_url() ?>/apuestas/nuevaApuesta" method="post" enctype="multipart/form-data">
                    <!-- Apuesta 0-->
                    <tr>
                        <td class="buttSize"><input class="allSize" type="radio" name="apuesta" value="0" checked></td>
                        <td class="textSize">Piloto</td>
                        <td class="textSize">
                            <select name="piloto1" class="allSize">
                                <?php
                                foreach ($pilotos as $linea) {
                                    echo "<option value='" . $linea->id . "'>" . $linea->nombre . " " . $linea->apellido . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td class="opeSize">
                            <select name="operador1" class="allSize">
                                <?php
                                foreach ($operadores as $operador) {
                                    echo "<option value='" . $operador->id_operador . "'>" . $operador->valor . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td class="textSize">posicion</td>
                        <td class="textSize">
                            <select name="posicion1" class="allSize">
                                
                                    <?php
                                    for ($i = 1; $i < 11; $i++) {
                                        echo "<option value='" . $i . "'>" . $i . "</option>";
                                    }
                                    ?>
                            </select>
                        </td>
                        <td class="modoSize">
                            <select name="modoApuesta1" class="allSize">
                                <?php
                                    foreach ($modosApuesta as $modoApuesta) {
                                        echo "<option value='" . $modoApuesta->id_modo_apuesta . "'>" . $modoApuesta->valor . "</option>";
                                    }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <!-- Apuesta 1-->
                        <tr>
                            <td class="buttSize"><input class="allSize" type="radio" name="apuesta" value="1"></td>
                            <td class="textSize">Piloto</td>
                            <td class="textSize">
                                <select name="piloto2_1" class="allSize">
                                <?php
                                    foreach ($pilotos as $linea) {
                                        echo "<option value='" . $linea->id . "'>" . $linea->nombre . " " . $linea->apellido . "</option>";
                                    }
                                ?>
                                </select>
                            </td>
                            <td class="opeSize">
                                <select name="operador2" class="allSize">
                                <?php
                                    foreach ($operadores as $operador) {
                                        if ($operador->operador != '=') {
                                            echo "<option value='" . $operador->id_operador . "'>" . $operador->valor . "</option>";
                                        }
                                    }
                                ?>
                                </select>
                            </td>
                            <td class="textSize">Piloto</td>
                            <td class="textSize">
                                <select name="piloto2_2" class="allSize">
                                <?php
                                    foreach ($pilotos as $linea) {
                                        echo "<option value='" . $linea->id . "'>" . $linea->nombre . " " . $linea->apellido . "</option>";
                                    }
                                ?>
                                </select>
                            </td>
                            <td class="modoSize">
                                <select name="modoApuesta2" class="allSize">
                                <?php
                                    foreach ($modosApuesta as $modoApuesta) {
                                        echo "<option value='" . $modoApuesta->id_modo_apuesta . "'>" . $modoApuesta->valor . "</option>";
                                    }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="buttSize"><input class="allSize" type="radio" name="apuesta" value="2"></td>
                            <td class="textSize">Nº abandonos</td>
                            <td class="textSize"></td>
                            <td class="opeSize">
                                <select name="operador3" class="allSize">
                                <?php
                                    foreach ($operadores as $operador) {
                                        echo "<option value='" . $operador->id_operador . "'>" . $operador->operador . "</option>";
                                    }
                                ?>
                                </select>
                            </td>
                            <td class="textSize"></td>
                            <td class="textSize">
                                <select name="posicion3" class="allSize">
                                <?php
                                    for ($i = 1; $i < 6; $i++) {
                                        echo "<option value='" . $i . "'>" . $i . "</option>";
                                    }
                                ?>
                                </select>
                            </td>
                            <td class="modoSize">
                                <select name="modoApuesta3" class="allSize">
                                <?php
                                    foreach ($modosApuesta as $modoApuesta) {
                                        echo "<option value='" . $modoApuesta->id_modo_apuesta . "'>" . $modoApuesta->valor . "</option>";
                                    }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="buttSize"><input class="allSize" type="radio" name="apuesta" value="3"></td>
                            <td class="textSize">Pole</td>
                            <td class="textSize">
                                <select name="piloto4" class="allSize">
                                <?php
                                    foreach ($pilotos as $linea) {
                                        echo "<option value='" . $linea->id . "'>" . $linea->nombre . " " . $linea->apellido;
                                    }
                                ?>
                                </select>
                            </td>
                            <td class="opeSize"></td>
                            <td class="textSize"></td>
                            <td class="textSize"></td>
                            <td class="modoSize">
                                <select name="modoApuesta4" class="allSize">
                                <?php
                                    foreach ($modosApuesta as $modoApuesta) {
                                        echo "<option value='" . $modoApuesta->id_modo_apuesta . "'>" . $modoApuesta->valor . "</option>";
                                    }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="buttSize"></td>
                            <td class="textSize">Apostar contra:</td>
                            <td class="textSize"><input class="allSize" type="text" name="usuario"/></td>
                            <td class="buttSize"></td>
                            <td class="textSize">cantidad</td>
                            <td class="textSize">
                            	
                            	<!--<input class="allSize" maxlength="5" type="text" name="cantidad" value="0"/>-->
								<select class="allSize" name="cantidad">
									
									<option value="">dinero apuesta</option>
									<option value="5000">5.000 €</option>
									<option value="7500">7.500 €</option>
									<option value="10000">10.000 €</option>
									<option value="12500">12.500 €</option>
									<option value="15000">15.000 €</option>
									<option value="17500">17.500 €</option>
									<option value="20000">20.000 €</option>
									<option value="22500">22.500 €</option>
									<option value="25000">25.000 €</option>
									<option value="27500">27.500 €</option>
									<option value="30000">30.000 €</option>
									
								</select>
								
							</td>
                        </tr>
                        <tr>
                            <td class="buttSize"></td>
                            <td class="textSize"></td>
                            <td class="textSize"><input class="allSize" type="submit" value="Apostar" /></td>
                        </tr>
                    </form>
                </table>
                <span></span>

        </div>
        <div id="tablonApuestas">
            <h3>Tablon apuestas</h3>
            <?php
                                    echo "<table>";
                                    foreach ($apuestasPendientes as $linea) {
                                        echo "<tr>";
                                        echo "<td class='txtapuesta' colspan=2>";
                                        echo $linea['textoApuesta'];
                                        echo "</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td>";
                                        echo "Cantidad : " . es_dinero($linea ['cantidad']) ." €";
                                        echo "</td>";
                                        echo "<td>";
                                        echo "Ganancia :" . es_dinero($linea['ganancia']) ." €";
                                        echo "</td>";
                                        echo "<td>";
                                        echo anchor('/apuestas/aceptarApuesta/' . $linea['id_apuesta'], Aceptar);
                                        echo "</td>";
                                        echo "</tr>";
										echo "<tr><td class='separador' colspan='2'></td></tr>";
                                    }
                                    echo "</table>";
            ?>
        </fieldset>
    </div>
<!-- BOXES CERRADOS -->
	<?php else: ?>
	<div align="center">
		<img  src="<?php echo base_url().'img/boxes_cerrados.jpg'; ?>" border="0" ></img>
	</div>	

	<?php endif;?>
</div>