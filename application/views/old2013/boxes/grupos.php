
<div id="formulario_grupo">
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
        <div id="grupoSeleccionado" class="grupoSeleccionado">
            <?php
            echo $nombreGrupo;
            ?>
        </div>
    </div>
    <div id="contenidoRankingGP" >
        <div id="clasificacionGrupo" class="centrado">
            <h3>
                <? echo $this->lang->line(grupos_titulo_clasificacion_gp) . ' '
                . $datosGP->circuito . ' (' . $datosGP->pais . ')';
                ?>
            </h3>
            <table>
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
                            <td class="nick"><b style="color:#ff0000;"><? echo $linea->nick; ?></b></td>
                            <td class="puntos"><b style="color:#ff0000;"><? echo $linea->puntos_manager_gp ?></b></td>
                        </tr>
    <? else: ?>
                        <tr>
                            <td class="posicion"><? echo $i; ?>º</td>
                            <td><img class="avatar" src="<?= base_url() ?>img/avatares/<? echo $linea->avatar; ?>" /></td>
                            <td class="nick"><?= $linea->nick ?></td>
                            <td class="puntos"><?= $linea->puntos_manager_gp ?></td>
                        </tr>
                    <?
                    endif;
                endforeach;
                ?>
            </table>	
        </div>	

    </div>
    <div id="contenidoRankingGen" >
        <div id="clasificacionGrupo" class="centrado">
            <h3>
                <? echo $this->lang->line('grupos_titulo_clasificacion_general')?>
            </h3>
            <table>
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
                            <td class="nick"><b style="color:#ff0000;"><? echo $linea->nick; ?></b></td>
                            <td class="puntos"><b style="color:#ff0000;"><? echo $linea->puntos; ?></b></td>
                        </tr>
    <? else: ?>
                        <tr>
                            <td class="posicion"><?= $j ?>º</td>
                            <td><img src="<?= base_url() ?>img/avatares/<? echo $linea->avatar; ?>" class="avatar" /></td>
                            <td class="nick"><? echo $linea->nick; ?></td>
                            <td class="puntos"><? echo $linea->puntos; ?></td>
                        </tr>
                    <?
                    endif;
                }
                ?>
            </table>	
        </div>	
    </div>
</div>
<div id="mensajes">
    <br>
    <br>
    <fieldset>
        <legend><? echo $this->lang->line(grupos_titulo_mensajes_grupo)?></legend>
        <table>
            <?
            foreach ($ultMensajes as $linea) {
                echo "<tr>";
                echo "<td>";
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
<!--
<div id="contenidoGruposPropios" class="centrado">
<?php
//Si se pueden crear grupos se muestra el formulario en el contenido
if ($crearGrupo):
    echo "<div id=\"formularioCrear\" >";
    ?>	
                                                            <table>
                                                                <form id="form_crear_grupo" method="post"  >
                                                                    <tr>
                                                                        <td  width="47">Nombre</td>
                                                                        <td  width="46">
                                                                            <input id="nombreFormulario" type="text" name="nombre" maxlength=20>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="51" colspan="2" align="center">
                                                                            <input type="button" value="Crear nuevo grupo" class="btn btn-primary" onclick=  
    <?php
    echo "\"enviarFormulario('" . site_url() . "grupos/nuevoGrupo','form_crear_grupo','crearGrupo',1)\"";
    ?> 
                                                                                   />
                                                                        </td>
                                                                    </tr>
                                                                </form> 
                                                            </table>
    <?php
    echo "</div>";
    echo "<div id=\"grupoPropio\">";
    echo "</div>";
else:
    //Se genera el formulario pero oculto
    echo "<div id=\"formularioCrear\" class=\"formularioOcultar\">";
    echo "<br>";
    echo "<br>";
    ?>	
                                                            <table>
                                                                <form id="form_crear_grupo" method="post" >
                                                                    <tr>
                                                                        <td  width="47">Nombre</td>
                                                                        <td  width="46">
                                                                            <input type="text" name="nombre" maxlength=20>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="51" colspan="2" align="center">
                                                                            <input type="button" value="Crear" onclick=
    <?php
    echo "\"enviarFormulario('" . site_url() . "grupos/nuevoGrupo','form_crear_grupo','crearGrupo',1)\"";
    ?> 
                                                                                   />
                                                                        </td>
                                                                    </tr>
                                                                </form> 
                                                            </table>
    <?php
    echo "</div>";
    //Si no se pueden crear mas grupos se muestra el primer grupo del usuario.
    echo "<div id=\"grupoPropio\">";
    echo '<span class="titNombreGrupo">';
    echo $nombreGrupoPropio[0];
    echo '</span>';
    echo '<br>';


    echo "<span class='titMiembros'>Miembros del grupo:</span>";
    echo "<table class=\"tabla\">";
    echo "<th>#</th><th>Usuario</th>";

    $j = 1;
    foreach ($miembrosGrupo [0] as $linea) {
        echo "<tr>";
        echo "<td>";
        echo $j;
        echo "</td>";
        echo "<td>";
        echo $linea->nick;
        echo "</td>";
        echo "</tr>";
        $j++;
    }
    echo "</table>";
    echo "<br>";
    echo "<a onclick=\"doAjax('" . site_url() . "grupos/borrarGrupo','idGrupo=" . $idGrupoPropio[0] . "',
												  'borrarGrupo','post',1)\">Borrar grupo</a>";
    //echo anchor('/grupos/borrarGrupo/'.$idGrupoPropio[$i],'Borrar Grupo');
    echo "</div>";
endif;
?>
</div>
</div>
<!--<div id="invitaciones" class="oculto">
        <div id="realizarInvitacion" class="mitadizq">
                <div id="menuGruposInvitaciones" class="menuInvitacionesClass">
                        <div id="seleccionaGruposInvitaciones" class="seleccionaGrupo">
<?
echo "Grupos";
$numeroGruposPosibles = 5;
?>
                        </div>
                        <div id="listaGruposInvitaciones" class="listaGrupos">		
<?php
for ($i = 0; $i < $numGruposPropios; $i++) {
    echo "<div id=\"menuInvitaciones" . $i . "\" class=\"mitadRanking\">";
    echo "<b>";
    echo $nombreGrupoPropio[$i];
    echo "</b>";
    echo "</div>";
}
?>
                        </div>
                        <div id="grupoSeleccionadoInvitaciones" class="grupoSeleccionado">
                        </div>
                </div>
                <div id="contenidoInvitaciones" class="contenidoInvitacionesClass" >
<?php
for ($i = 0; $i < $numGruposPropios; $i++) {
    echo "<div id=\"crearInvitacion" . $i . "\" >";
    echo "<br>";
    echo $msgText;
    echo "<br>";
    echo "Introduce el nick del usuario a invitar:";
    echo "<table>";
    ?>
                                                                                                <form method="post" action="<?= site_url() ?>/grupos/nuevaInvitacion/" >
                                                                                                <tr>
                                                                                                        <td  width="47">nick</td>
                                                                                                        <td  width="46">
                                                                                                                <input type="text" name="nick" maxlength=50>
                                                                                                                <input type = "hidden" name = "grupo" value = "<? echo $idGrupoPropio[$i]; ?>">
                                                                                                        </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                        <td width="51" colspan="2" align="center"><input type="submit" value="Invitar" /></td>
                                                                                                        </tr>
                                                                                                </form> 
    <?
    echo "</table>";
    echo "<br><b>";
    echo "Listado de invitaciones No aceptadas:";
    echo "</b><table class=\"tabla\">";
    echo "<th>#</th><th>Usuario</th>";
    echo "<tr>";
    $j = 1;
    foreach ($invitacionesNoAceptadas [$i] as $linea) {
        echo "<td>";
        echo $j;
        echo "</td>";
        echo "<td>";
        echo $linea->nick;
        echo "</td>";
        echo "</tr>";
        $j++;
    }


    echo "</table>";
    echo "</div>";
}

//Si no tiene grupos creados se muestra un mensaje
if ($numGruposPropios == 0) {
    echo "<div id=\"crearInvitacion0\" >";
    echo "<br>";
    echo "No puedes realizar invitaciones, no tienes ningun grupo creado.";
    echo "</div>";
}

echo "<br>";
?>
                </div>		
        </div>
        <div id="listaInvitacionesRecibidas" class="mitaddch">
<?
echo "<br><b>";
echo "Invitaciones recibidas :";
echo "</b><br>";
if (count($invitacionesRecibidas) == 0) {
    echo "No tienes nuevas invitaciones";
} else {
    echo "<ol>";
    foreach ($invitacionesRecibidas as $linea) {
        echo "<li>";
        echo $linea->nick .
        " te invita a su grupo " . $linea->nombre . "<br>"
        . anchor('/grupos/aceptaInvitacion/' . $linea->id, 'Aceptar') .
        " - "
        . anchor('/grupos/rechazaInvitacion/' . $linea->id, 'Rechazar');
        echo "</li>";
    }
    echo "</ol>";
}
?>
        </div>
</div>
<div id="peticiones" class="oculto">
        <div id="listaGruposPeticiones" class="mitadizq">
                <div id="tablaGrupos" class="tablacentrada">
<?
echo "Desde aqui puedes realizar peticiones para ingresar en otros grupos";
echo "<table class=\"tabla\">";
echo "<th>#</th><th>Grupo</th><th>Propietario</th><th>Peticion</th>";
echo "<tr>";
$j = 1;
foreach ($listaGruposNoPropios as $linea) {
    echo "<td>";
    echo $j;
    echo "</td>";
    echo "<td>";
    echo $linea->nombre;
    echo "</td>";
    echo "<td>";
    echo $linea->nick;
    echo "</td>";
    echo "<td>";
    echo anchor('/grupos/nuevaPeticion/' . $linea->id, 'Realizar peticion');
    echo "</td>";
    echo "</tr>";
    $j++;
}
echo "</table>";
?>
                </div>
        </div>
        <div id="peticionesRecibidas" class="mitaddch">
<?
echo "</table>";
echo "<br><b>";
echo "Peticiones realizadas :";
echo "</b><table class=\"tabla\">";
echo "<th>#</th><th>Grupo</th>";
echo "<tr>";
$j = 1;
foreach ($listaPeticionesRealizadas as $linea) {
    echo "<td>";
    echo $j;
    echo "</td>";
    echo "<td>";
    echo $linea->nombre;
    echo "</td>";
    echo "</tr>";
    $j++;
}


echo "</table>";

echo "<br><b>";
echo "Peticiones recibidas :";
echo "</b><br>";
if (count($listaPeticionesRecibidas) == 0) {
    echo "No tienes nuevas peticiones";
} else {
    echo "<ol>";
    foreach ($listaPeticionesRecibidas as $linea) {
        echo "<li>";
        echo $linea->nick .
        " quiere entrar en tu grupo " . $linea->nombre . "<br>"
        . anchor('/grupos/aceptaPeticion/' . $linea->id, 'Aceptar') .
        " - "
        . anchor('/grupos/rechazaPeticion/' . $linea->id, 'Rechazar');
        echo "</li>";
    }
    echo "</ol>";
}
?>
        </div>
</div>
<div id="clasgp" class="oculto">
        <div id="menuRankingGP" class="menuRanking">
                <div id="seleccionaGrupo" class="seleccionaGrupo">
<? echo "Grupos"; ?>
                </div>
                <div id="listaGrupos" class="listaGrupos">		
<?php
for ($i = 0; $i < $numGrupos; $i++) {
    echo "<div id=\"rankingGP" . $i . "\" class=\"mitadRanking\">";
    echo "<b>";
    echo "$grupo[$i]";
    echo "</b>";
    echo "</div>";
}
?>
                </div>
                <div id="grupoSeleccionado" class="grupoSeleccionado">
                </div>
        </div>
        <div id="contenidoRankingGP" >
<?php
for ($i = 0; $i < $numGrupos; $i++) {
    echo "<div id=\"grupo" . $i . "\" class=\"centrado\">";
    echo "<table class=\"tabla\">";
    echo "<th>#</th><th>Usuario</th><th>Puntos</th>";
    $j = 1;
    foreach ($rankingGP[$i] as $linea) {
        if (strtolower($_SESSION['usuario']) == strtolower($linea['usuario'])):
            ?>
                                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                                        <td><? echo $j; ?>º</td>
                                                                                                                                                                                                                                                        <td><b style="color:#ff0000;"><? echo $linea['usuario'] ?></b></td>
                                                                                                                                                                                                                                                        <td><? echo $linea['puntosPiloto'] ?></td>
            <?php $j++; ?>
                                                                                                                                                                                                                                                </tr>
        <? else: ?>
                                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                                        <td><?= $j; ?>º</td>
                                                                                                                                                                                                                                                        <td><?= $linea['usuario'] ?></td>
                                                                                                                                                                                                                                                        <td><?= $linea['puntosPiloto'] ?><?
            if ($linea['puntosStikis']) {
                echo "+" . $linea['puntosStikis'];
            }
            ?></td>
            <?php $j++; ?>
                                                                                                                                                                                                                                                </tr>
        <?
        endif;
    }
    echo "</table>";
    echo "</div>";
}
?>
        </div>	 
</div>
<div id="clasgen" class="oculto">
        <div id="menuRankingGen" class="menuRanking">
                <div id="seleccionaGrupoGen" class="seleccionaGrupo">
<? echo "Grupos"; ?>
                </div>
                <div id="listaGruposGen" class="listaGrupos">		
<?php
for ($i = 0; $i < $numGrupos; $i++) {
    echo "<div id=\"rankingGen" . $i . "\" class=\"mitadRanking\">";
    echo "<b>";
    echo "$grupo[$i]";
    echo "</b>";
    echo "</div>";
}
?>
                </div>
                <div id="grupoSeleccionadoGen" class="grupoSeleccionado">
                </div>
        </div>
        <div id="contenidoRankingGen" >
<?php
for ($i = 0; $i < $numGrupos; $i++) {
    echo "<div id=\"rankingGenGrupo" . $i . "\" class=\"centrado\">";
    echo "<table class=\"tabla\">";
    echo "<th>#</th><th>Avatar</th><th>Usuario</th><th>Puntos</th>";
    $j = 1;
    foreach ($rankingGen[$i] as $linea) {
        if (strtolower($_SESSION['usuario']) == strtolower($linea->nick)):
            ?>
                                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                                        <td class="posicion"><? echo $j ?>º</td>
                                                                                                                                                                                                                                                        <td><img src="http://www.ligaformula1.com/imgs/avatares/thumbs/<? echo $linea->avatar ?>" /></td>
                                                                                                                                                                                                                                                        <td class="nick"><b style="color:#ff0000;"><? echo $linea->nick ?></b></td>
                                                                                                                                                                                                                                                        <td class="puntos"><? echo $linea->puntos ?></td>
            <?php $j++; ?>
                                                                                                                                                                                                                                                </tr>
        <? else: ?>
                                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                                        <td class="posicion"><?= $j ?>º</td>
                                                                                                                                                                                                                                                        <td><img src="http://www.ligaformula1.com/imgs/avatares/thumbs/<?= $linea->avatar ?>" /></td>
                                                                                                                                                                                                                                                        <td class="nick"><?= $linea->nick ?></td>
                                                                                                                                                                                                                                                        <td class="puntos"><?= $linea->puntos ?></td>
            <?php $j++; ?>
                                                                                                                                                                                                                                                </tr>
        <?
        endif;
    }
    echo "</table>";
    echo "</div>";
}
?>
        </div>
</div>-->



