
<div class="row">

    <div class="span12">

        <div id="menuGruposPropios" class="menuRanking">

            <div id="seleccionaGrupoPropio" class="seleccionaGrupo">
                <?
                echo $this->lang->line('grupos_titulo_grupos');
                ?>
            </div>

            <div id="listaGruposPropios" class="listaGrupos">
                <?php
                //for($i = 0; $i < $numGruposPropios; $i++ ){
                foreach ($gruposUsuario as $grupo) {
                    echo "<div id=\"menuPropio" . $grupo->id_grupo . "\" class=\"listaGruposDesplegada\">";
                    echo "<b>";
                    echo "<a href=\"" . base_url() . "grupos/grupos_general/"
                    . $grupo->id_grupo . "\"> " . $grupo->nombre . "</a>";
                    echo "</b>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
            <div id="grupoSeleccionado" class="grupoSeleccionado">
                <?php
                echo $nombreGrupo;
                ?>
            </div>

    </div> <!-- /span12 -->

</div> <!-- /row -->

<div class="row">

    <div class="span6">

        <div id="contenidoRankingGP" >
        <div id="clasificacionGrupo" class="centrado">
            <h3>
                <? echo $this->lang->line(grupos_titulo_clasificacion_gp) . ' '
                . $datosGP->circuito . ' (' . $datosGP->pais . ')';
                ?>
            </h3>
            <table class="table">
                <th>#</th><th>
                    <? echo $this->lang->line('grupos_lbl_avatar')?>
                </th><th>
                    <? echo $this->lang->line('grupos_lbl_usuario')?>
                </th><th>
                    <? echo $this->lang->line('grupos_lbl_puntos')?>
                </th>
                <?php
                $i = 0;
                foreach ($rankingGP as $linea):
                    $i++;
                    if (strtolower($_SESSION['usuario']) == strtolower($linea->nick)):
                        ?>
                        <tr>
                            <td class="posicion"><b style="color:#ff0000;"><? echo $i; ?>º</b></td>
                            <td><img class="avatar" src= "<?= base_url() ?>img/avatares/<? echo $linea->avatar; ?>" /></td>
                            <td class="nick"><b style="color:#ff0000;"><? echo anchor('usuarios/perfil/'.$linea->nick,$linea->nick);  ?></b></td>
                            <td class="puntos"><b style="color:#ff0000;"><? echo $linea->puntos_manager_gp ?></b></td>
                        </tr>
            <? else: ?>
                                <tr>
                                    <td class="posicion"><? echo $i; ?>º</td>
                                    <td><img class="avatar" src="<?= base_url() ?>img/avatares/<? echo $linea->avatar; ?>" /></td>
                                    <td class="nick"><? echo anchor('usuarios/perfil/'.$linea->nick,$linea->nick);  ?></td>
                                    <td class="puntos"><?= $linea->puntos_manager_gp ?></td>
                                </tr>
                            <?
                            endif;
                        endforeach;
                        ?>
                    </table>
                </div>

            </div>

    </div> <!-- /span6-->

    <div class="span6">

        <div id="contenidoRankingGen" >
        <div id="clasificacionGrupo" class="centrado">
            <h3>
                <? echo $this->lang->line('grupos_titulo_clasificacion_general')?>
            </h3>
            <table class="table">
                <th>#</th><th>
                    <? echo $this->lang->line('grupos_lbl_avatar')?>
                </th><th>
                    <? echo $this->lang->line('grupos_lbl_usuario')?>
                </th><th>
                    <? echo $this->lang->line('grupos_lbl_puntos')?>
                </th>
                <?php
                $j = 0;
                foreach ($rankingGeneral as $linea) {
                    $j++;
                    if (strtolower($_SESSION['usuario']) == strtolower($linea->nick)):
                        ?>
                        <tr>
                            <td class="posicion"><b style="color:#ff0000;"><? echo $j ?>º</b></td>
                            <td><img src="<?= base_url() ?>img/avatares/<? echo $linea->avatar; ?>" class="avatar" /></td>
                            <td class="nick"><b style="color:#ff0000;"><? echo anchor('usuarios/perfil/'.$linea->nick,$linea->nick);  ?></b></td>
                            <td class="puntos"><b style="color:#ff0000;"><? echo $linea->puntos; ?></b></td>
                        </tr>
            <? else: ?>
                                <tr>
                                    <td class="posicion"><?= $j ?>º</td>
                                    <td><img src="<?= base_url() ?>img/avatares/<? echo $linea->avatar; ?>" class="avatar" /></td>
                                    <td class="nick"><? echo anchor('usuarios/perfil/'.$linea->nick,$linea->nick);  ?></td>
                                    <td class="puntos"><? echo $linea->puntos; ?></td>
                                </tr>
                            <?
                            endif;
                        }
                        ?>
                    </table>
                </div>
            </div>

    </div> <!-- /span6-->


</div> <!-- /row -->



<div class="row">

    <div class="span12">

        <div id="mensajes">

            <fieldset>
                <legend><? echo $this->lang->line(grupos_titulo_mensajes_grupo)?></legend>
                <table class="table table-striped">
                    <?
                    foreach ($ultMensajes as $linea) {
                        echo "<tr>";
                        echo "<td width='10'>";
                        echo "<img class=\"avatar\" src= " . base_url() . "img/avatares/" . $linea->avatar . ">";
                        echo "</td>";
                        echo "<td>";
                        echo "<span>" . $linea->nick . "</span> - ";
                        echo $linea->fecha_mensaje;
                        echo "<br> ";
                        echo wordwrap($linea->contenido, 80, "\n", true);
                        echo "<br>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </fieldset>

            <form id="formMensaje">
                <textarea name="mensaje" onkeyPress="return maximaLongitud(this, 200)"
                          rows="2" cols="70" > </textarea>

                <?php
                echo "<input type=hidden name=\"idGrupo\" value=" . $idGrupo . ">";
                echo "<a class='btn btn-success' onclick=\"enviarFormulario('" . $sitio . "grupos/enviarMensajes',
                    'formMensaje','mostrarMensajes',1)\">".$this->lang->line(grupos_lbl_enviar)."</a>";
                ?>
            </form>

        </div>

    </div><!-- /span12 -->

</div><!-- /row -->



