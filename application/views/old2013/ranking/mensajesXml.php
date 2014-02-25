<?php

$sitio = site_url();
$i = 0;
echo "<idGrupo>";
echo $idGrupo;
echo "</idGrupo>";
echo "<mensajes>";
foreach ($ultMensajes as $linea) {
    echo "<mensaje>";
    echo "<nick>";
    echo $linea->nick;
    echo "</nick>";
    echo "<fechaMensaje>";
    echo $linea->fecha_mensaje;
    echo "</fechaMensaje>";
    echo "<contenido>";
    echo wordwrap(htmlspecialchars($linea->contenido),80, "\n", true);
    echo "</contenido>";
    echo"<avatar>";
    echo $linea->avatar;
    echo"</avatar>";
    echo "</mensaje>";
    $i = 1;
}
echo "</mensajes>";
?>