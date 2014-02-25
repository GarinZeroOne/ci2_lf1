<?php

$sitio = site_url();
$i = 0;
//Miposicion
echo "<mi_Posicion>";
echo "<miPosicion>";
echo $miPosicion->posicion;
echo "</miPosicion>";
echo "<miAvatarPath>";
echo $miPosicion->avatar_path;
echo "</miAvatarPath>";
echo "<miNick>";
echo $miPosicion->nick;
echo "</miNick>";
echo"<miPuntos>";
echo $miPosicion->puntos;
echo"</miPuntos>";
echo"<miPuntosStiki>";
echo $miPosicion->puntos_stiki;
echo"</miPuntosStiki>";
echo "</mi_Posicion>";
//Circuito
echo "<circuito>";
echo $datosGP->circuito;
echo "</circuito>";
echo "<pais>";
echo $datosGP->pais;
echo "</pais>";
//Ranking
echo "<rankingGp>";

foreach ($rankingGp as $linea) {
    echo "<posicion>";
    echo $linea['posicion'];
    echo "</posicion>";
    echo "<avatarPath>";
    echo $linea['avatar_path'];
    echo "</avatarPath>";
    echo "<nick>";
    echo $linea['nick'];
    echo "</nick>";
    echo"<puntos>";
    echo $linea['puntos'];
    echo"</puntos>";
    echo"<puntosStiki>";
    echo $linea['puntos_stiki'];
    echo"</puntosStiki>";
}
echo "</rankingGp>";
?>