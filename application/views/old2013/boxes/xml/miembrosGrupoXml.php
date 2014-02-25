<?php
echo "<mensaje>";
echo $msg;
echo "</mensaje>";
echo "<datosMiembros>";
foreach ($miembrosGrupo as $linea) {
    if ($linea->id != $_SESSION['id_usuario']) {
        echo "<miembroGrupo>";
        echo htmlentities($linea->nick);
        echo "</miembroGrupo>";
        echo "<idUsuario>";
        echo htmlentities($linea->id);
        echo "</idUsuario>";
    }
}
echo "</datosMiembros>";
?>