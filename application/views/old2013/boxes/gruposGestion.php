<div id="gestionGrupos">
    <h3><? echo $this->lang->line('grupos_titulo_crear_grupo')?></h3>
    <div id="formularioCrear" class="formularioGestionGrupos" >	        
        <h4><? echo $this->lang->line('grupos_txt_form_crear_grupo')?></h4>
        <form id="form_crear_grupo" method="post" action="<? echo site_url() . "grupos/nuevoGrupo" ?>">
            <table>
                <tr>
                    <td class="nombreCampos"><? echo $this->lang->line('grupos_lbl_nombre')?></td>
                    <td class="inputCampos">
                        <input id="nombreFormulario" type="text" name="nombre">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="<? echo $this->lang->line('grupos_bot_crear_grupo')?>" class="btn btn-primary" />
                    </td>
                </tr>
            </table>
        </form> 
    </div>
    <?
    if (!count($gruposPropios) == 0):
        ?>
        <h3><? echo $this->lang->line('grupos_titulo_gestion_miembros')?></h3>
        <div id="menuGruposPropios" class="menuRanking">
            <div id="seleccionaGrupoPropio" class="seleccionaGrupo">
                <?
                echo $this->lang->line('grupos_titulo_grupos');
                ?>
            </div>
            <div id="listaGruposPropios" class="listaGrupos">		
                <?php
                //for($i = 0; $i < $numGruposPropios; $i++ ){
                foreach ($gruposPropios as $grupo) {
                    echo "<div id=\"menuPropio" . $grupo->id_grupo . "\" class=\"listaGruposDesplegada\">";
                    echo "<b>";
                    echo "<a href=\"" . base_url() . "grupos/gestionGrupos/"
                    . $grupo->id . "\"> " . $grupo->nombre . "</a>";
                    echo "</b>";
                    echo "</div>";
                }
                ?>
            </div>
            <div id="grupoSeleccionado" class="grupoSeleccionado">
                <?php
                echo $nombreGrupo;
                ?>
            </div>
        </div>
        <div id="gestionMiembrosGrupo" class="formularioGestionGrupos">                        
            <h4><? echo $this->lang->line('grupos_txt_form_borrar_usuario')?></h4>
            <form id="formBorrarUsuario" method="post">
                <table>
                    <tr> 
                        <td>
                            <input id="idGrupoFormulario" type = "hidden" name = "idGrupo" value = "<? echo $idGrupo; ?>">
                        </td>
                    </tr> 
                    <tr> 

                        <td class="nombreCampos">Nick</td>
                        <td class="inputCampos">
                            <select name="idUsuario" id="selectUsuario">
                                <?
                                foreach ($miembrosGrupo as $linea) {
                                    if ($linea->id != $_SESSION['id_usuario']) {
                                        echo "<option value=\"$linea->id\">$linea->nick</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="button" value="<? echo $this->lang->line('grupos_bot_borrar_usuario_grupo')?>" class="btn btn-primary" 
                            <?php
                            echo "onclick=\"enviarFormulario('" . $sitio
                            . "grupos/borrarUsuarioGrupo','formBorrarUsuario','optionUsuarioGrupo',1)\"";
                            ?>
                                   />
                        </td>
                    </tr>
                </table>
            </form>
            <?
            echo "<a href=\"" . base_url() . "grupos/borrarGrupo/"
            . $idGrupo . "\">".$this->lang->line('grupos_txt_borrar_grupo') . $nombreGrupo . "</a>";
            ?>
        </div>
        <?
    endif;
    ?>
    <div id="mensajeAccion" class="formularioGestionGrupos">
        <span id="mensajeSpan" ><? echo $msg ?></span>
    </div>
</div>
