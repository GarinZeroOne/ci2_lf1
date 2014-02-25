<div id="mensajes">
    <br>
    <br>
    <fieldset>
        <legend>Mensajes del grupo</legend>
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
                echo wordwrap($linea->contenido,80, "\n", true);
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
            'formMensaje','mostrarMensajes',1)\">Enviar</a>";
            ?>
        </form>

</div>
