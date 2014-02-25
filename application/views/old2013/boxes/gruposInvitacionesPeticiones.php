<div id="invitaciones">
    <h3>
        <?
        echo $this->lang->line('grupos_titulo_invitaciones');
        ?>
    </h3>
    <div id="realizarInvitacion" class="mitadizq">
        <div id="contenidoInvitaciones">
            <?php
            if (!count($gruposPropios) == 0):

                echo "<div id=\"crearInvitacion\">";
                echo $msgText;
                echo "<br>";
                echo "<b>" . $this->lang->line('grupos_txt_form_inv') . "</b>";
                ?>
                <form id="formNuevaInvitacion" method="post">
                    <table id ="tablaPeticiones">
                        <tr>
                            <td>Nick</td>
                            <td>
                                <input id="nombreGrupo" type="text" name="nick" maxlength=50 value="">
                            </td>
                        </tr>
                        <tr>
                            <td>Grupo</td>
                            <td>
                                <select name="idGrupo">
                                    <?
                                    foreach ($gruposPropios as $linea) {
                                        echo "<option value=\"$linea->id\">$linea->nombre</option>";
                                    }
                                    ?>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td width="51" colspan="2" align="center">
                                <?php
                                echo "<input type=\"button\" value=\"" . $this->lang->line('grupos_bot_inv')
                                . "\" class=\"btn btn-primary\" onclick=\"enviarFormulario('" . $sitio
                                . "grupos/nuevaInvitacion','formNuevaInvitacion','nuevaInvitacion',1)\"/>";
                                ?>
                            </td>
                        </tr>
                    </table>
                </form>
                <?
                echo "</div>";
            else:
                //Si no tiene grupos creados se muestra un mensaje
                echo "<div id=\"crearInvitacion0\" >";
                echo "<br>";
                echo $this->lang->line('grupos_txt_no grupos');
                echo "</div>";
            endif;
            ?>
        </div>
        <div id="listaInvitacionesNoAceptadas" class="contenidoInvitacionesClass" >	 
            <?
            echo "<br><b>";
            echo $this->lang->line('grupos_txt_inv_realizadas') . "</b>";
            if (!count($invitacionesNoAceptadas) == 0) {
                echo "<ol>";
                foreach ($invitacionesNoAceptadas as $linea) {
                    echo "<li>";
                    echo $linea->nick;
                    echo "</li>";
                }
                echo "</ol>";
                echo "<br>";
            } else {
                echo "<br>" . $this->lang->line('grupos_txt_no_inv_realizadas');
            }
            ?>
        </div>		
    </div>
    <div id="listaInvitacionesRecibidas" class="mitaddch">
        <?
        echo "<br><b>";
        echo $this->lang->line('grupos_txt_inv_recibidas');
        echo "</b><br>";
        if (count($invitacionesRecibidas) == 0) {
            echo $this->lang->line('grupos_txt_no_inv_recibidas');
        } else {
            echo "<ol>";
            foreach ($invitacionesRecibidas as $linea) {
                echo "<li>";
                echo $linea->nick . $this->lang->line('grupos_txt_inv_grupo') . $linea->nombre
                . "<br><a onclick=\"doAjax('" . $sitio . "grupos/aceptaInvitacion','idInvitacion="
                . $linea->id . "','aceptaInvitacion','post',1)\">" . $this->lang->line('grupos_lbl_aceptar') . "</a>  
						  - 
		<a onclick=\"doAjax('" . $sitio . "grupos/rechazaInvitacion','idInvitacion="
                . $linea->id . "','aceptaInvitacion','post',1)\">" . $this->lang->line('grupos_lbl_rechazar') . "</a>";
                echo "</li>";
            }
            echo "</ol>";
        }
        ?>
    </div>
</div>
<div id="peticiones">
    <h3><? echo $this->lang->line('grupos_titulo_peticiones'); ?></h3>
    <div id="listaGruposPeticiones" class="mitadizq">
        <? echo "<br><b>" . $this->lang->line('grupos_txt_form_pet') . "</b>"; ?>
        <form id="formNuevaPeticion" method="post">
            <table id ="tablaInvitaciones">
                <tr>
                    <td><? echo $this->lang->line('grupos_lbl_grupo'); ?></td>
                    <td>
                        <select name="idGrupo">
                            <?
                            foreach ($listaGruposNoPropios as $linea) {
                                echo "<option value=\"$linea->id\">$linea->nombre</option>";
                            }
                            ?>
                        </select>
                    </td>

                </tr>
                <tr>
                    <td width="51" colspan="2" align="center">
                        <?php
                        echo "<input type=\"button\" value=\"" . $this->lang->line('grupos_bot_pet')
                        . "\" class=\"btn btn-primary\" onclick=\"enviarFormulario('" . $sitio
                        . "grupos/nuevaPeticion','formNuevaPeticion','nuevaPeticion',1)\"/>";
                        ?>
                    </td>
                </tr>
            </table>
        </form>
        <div id="peticionesRealizadas">
            <?
            echo "<b>" . $this->lang->line('grupos_txt_pet_realizadas') . "</b>";
            if (count($listaPeticionesRealizadas) == 0) {
                echo "<br>" . $this->lang->line('grupos_txt_no_pet_realizadas');
            } else {
                echo "<ol>";
                $j = 1;
                foreach ($listaPeticionesRealizadas as $linea) {
                    echo "<li>";
                    echo $linea->nombre;
                    echo "</li>";
                    $j++;
                }
                echo "</ol>";
            }
            ?>
        </div>
    </div> 
    <?
    echo "<div id=\"peticionesRecibidas\" class=\"mitaddch\">";
    echo "<br><b>";
    echo $this->lang->line('grupos_txt_pet_recibidas');
    echo "</b><br>";
    if (count($listaPeticionesRecibidas) == 0) {
        echo $this->lang->line('grupos_txt_no_pet_recibidas');
    } else {
        echo "<ol>";
        foreach ($listaPeticionesRecibidas as $linea) {
            echo "<li>";
            echo $linea->nick .
            $this->lang->line('grupos_txt_pet_recibidas_otros') . $linea->nombre . "<br>
							 <a onclick=\"doAjax('" . $sitio . "grupos/aceptaPeticion','idPeticion=" . $linea->id . "',
													  'aceptaPeticion','post',1)\">Aceptar</a>
							  - 
							 <a onclick=\"doAjax('" . $sitio . "grupos/rechazaPeticion','idPeticion=" . $linea->id . "',
													  'aceptaPeticion','post',1)\">Rechazar</a>";
            echo "</li>";
        }
        echo "</ol>";
    }
    echo "</div>"
    ?>
</div>
</div>

