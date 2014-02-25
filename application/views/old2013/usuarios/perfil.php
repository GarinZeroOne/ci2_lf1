<?php
/*
<div class="row">

    <div class="span12">

        <div class="ads">

        <script type="text/javascript"><!--
        google_ad_client = "ca-pub-2361705659034560";

        google_ad_slot = "1297942735";
        google_ad_width = 728;
        google_ad_height = 90;
        //-->
        </script>
        <script type="text/javascript"
        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>

      </div>

    </div>
</div>
*/
?>
<div class="row">

    <div class="span6">

        <div class="mp_datos">

            <img id="imgAvatar" src="<?php echo  base_url() ?>img/avatares/<?= $avatar ?>" alt="Foto avatar">

            <span class="infousuario">
                <p class="nick"><?php echo $usuario->nick; ?></p>
                <p class="info"><?php echo $usuario->nombre." ".$usuario->apellido; ?></p>
                <p class="info"><?php echo $usuario->ubicacion; ?> <?php echo $usuario->ano_nacimiento; ?></p>
                <p class="info2"><?php echo $full_stats['total_visitas'] ?> visitas | <?php echo $full_stats['total_firmas'] ?> firmas | <?php echo $full_stats['total_posts'] ?> Posts</p>
            </span>

            <span class="ranking" title="Posición en el ranking general">

                    <?php echo $posicionRanking; ?>

            </span>


            <div class="myinfo">

                <?php if($usuario->info_perfil){
                    echo $usuario->info_perfil;
                }
                else{
                    echo "<i>Parece que ".$usuario->nick." no  ha completado la información de su  perfil :<</i>";
                }
                ?>


            </div>

        </div>

        <div class="mp_progreso">

            <h4>Progreso de <?php echo $usuario->nick; ?></h4>

               <b>Pilotos activos</b>:<span><?php echo $full_stats['num_pilotos_fichados'] ?></span>
               <progress id="progressbar" value="<?php echo $full_stats['num_pilotos_fichados'] ?>" max="7" title="Max:7"></progress>
               <?php if($_SESSION['id_usuario']):?>
               <progress id="progressbaru" value="<?php echo $full_stats_usuario['num_pilotos_fichados'] ?>" max="7" title="Max:7"></progress>
               <?php endif; ?>



               <b>Equipos activos</b>:<span><?php echo $full_stats['num_equipos_fichados'] ?></span>
                <progress id="progressbar" value="<?php echo $full_stats['num_equipos_fichados'] ?>" max="4" title="Max:4"></progress>
                <?php if($_SESSION['id_usuario']):?>
                <progress id="progressbaru" value="<?php echo $full_stats_usuario['num_equipos_fichados'] ?>" max="4" title="Max:4"></progress>
               <?php endif; ?>


                <b>Inversion mejoras</b>:<span><?php echo number_format($full_stats['dinero_invertido_mejoras'], 0, ",", ".") ?> €</span>
                <progress id="progressbar" value="<?php echo $full_stats['dinero_invertido_mejoras'] ?>" max="<?php echo $full_stats['maximo_posible_mejoras']; ?>" title="Max:<?php echo number_format($full_stats['maximo_posible_mejoras'],0,',','.'); ?> €"></progress>
                <?php if($_SESSION['id_usuario']):?>
               <progress id="progressbaru" value="<?php echo $full_stats_usuario['dinero_invertido_mejoras'] ?>" max="<?php echo $full_stats_usuario['maximo_posible_mejoras']; ?>" title="Max:<?php echo number_format($full_stats_usuario['maximo_posible_mejoras'],0,',','.'); ?> €"></progress>
               <?php endif; ?>



                <b>Estrellas canjeadas</b>:<span><?php echo $full_stats['estrellas_computadas'] ?></span>
                <progress id="progressbar" value="<?php echo $full_stats['estrellas_computadas'] ?>" max="50" title="Max:50"></progress>
                <?php if($_SESSION['id_usuario']):?>
                <progress id="progressbaru" value="<?php echo $full_stats_usuario['estrellas_computadas'] ?>" max="50" title="Max:50"></progress>
               <?php endif; ?>



                <b>Stikis  dinero comprados</b>: <span><?php echo $full_stats['total_stikis_dinero'] ?></span>
                <progress id="progressbar" value="<?php echo $full_stats['total_stikis_dinero'] ?>" max="38" title="Max:38"></progress>
                <?php if($_SESSION['id_usuario']):?>
                <progress id="progressbaru" value="<?php echo $full_stats_usuario['total_stikis_dinero'] ?>" max="38" title="Max:38"></progress>
               <?php endif; ?>



                <b>Stikis  puntos comprados</b>: <span><?php echo $full_stats['total_stikis_puntos'] ?></span>
                <progress id="progressbar" value="<?php echo $full_stats['total_stikis_puntos'] ?>" max="38" title="Max:38"></progress>
                <?php if($_SESSION['id_usuario']):?>
                <progress id="progressbaru" value="<?php echo $full_stats_usuario['total_stikis_puntos'] ?>" max="38" title="Max:38"></progress>
               <?php endif; ?>


                <b>Total ingresos</b>: <span><?php echo number_format($full_stats['total_ingresos'], 0, ",", ".") ?> €</span>
                <progress id="progressbar" value="<?php echo $full_stats['total_ingresos'] ?>" max="<?php echo $full_stats['total_maximo_ingresos'] ?>" title="Max: <?php echo number_format($full_stats['total_maximo_ingresos'], 0, ",", ".") ?> €"></progress>
                <?php if($_SESSION['id_usuario']):?>
                <progress id="progressbaru" value="<?php echo $full_stats_usuario['total_ingresos'] ?>" max="<?php echo $full_stats['total_maximo_ingresos'] ?>" title="Max: <?php echo number_format($full_stats['total_maximo_ingresos'], 0, ",", ".") ?> €"></progress>
               <?php endif; ?>

               <?php if($_SESSION['id_usuario']): ?>

                   <div style="margin-top:20px;">

                   </div>
                    <span class="leyenda1">Progreso de <?php echo $usuario->nick; ?></span>
                    <span class="leyenda2">Tu progreso</span>
               <?php endif; ?>

               <p>* El total de ingresos, no tiene en cuenta nominas LF1, ni canjeo de estrellas</p>
        </div>




    </div>

    <div class="span6">

        <div class="mp_muro">
            <h4>Muro de <?php echo $usuario->nick; ?></h4>

            <div class="mensaje">


                <?php
                $i=0;
                foreach($muro as $msg): ?>

                    <?php if($i==3):
                        $ocultos = 1;
                    ?>
                        <span id="ver-mas">Ver más</span>
                        <div class="ocultos-muro">

                    <?php endif; ?>

                    <span class="usuario">
                        <a href="<?php echo site_url(); ?>usuarios/perfil/<?php echo $msg->nick; ?>"><?php echo $msg->nick ?></a>

                    </span>

                    <span class="msgusuario">

                        <?php echo $msg->texto; ?>

                        <i><?php echo timeago(strtotime($msg->fecha)); ?></i>

                    </span>



                <?php
                $i++;

                endforeach; ?>

                <?php if($ocultos): ?>
                    </div>  <!-- Cerrar  capa Ocultos -->
                <?php endif; ?>



            </div>

            <?php if($this->session->flashdata('msgOK')) echo "<span class='msgOK'>".$this->session->flashdata('msgOK')."</span>"; ?>

            <?php if($_SESSION['id_usuario']): ?>

            <div class="form-muro">

                <form action="<?php echo site_url(); ?>usuarios/nueva_firma" method="post" accept-charset="utf-8">
                    <input type="hidden" name="idperfil" value="<?php echo $usuario->id; ?>">
                    <textarea name="mensaje" class="editor" maxlength="300" > Escribe un mensaje en el muro de <?php echo $usuario->nick; ?> </textarea>

                    <div class="boton-submit">
                         <input type="submit" name="Submit" class="btn btn-primary" value="Enviar Mensaje" >
                    </div>

                </form>

            </div>
            <?php endif; ?>


            <div class="homeads">

            <script type="text/javascript"><!--
            google_ad_client = "ca-pub-2361705659034560";
            /* home_left */
            google_ad_slot = "1864849131";
            google_ad_width = 468;
            google_ad_height = 60;
            //-->
            </script>
            <script type="text/javascript"
            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
            </script>

          </div>

            <h4>Últimas visitas</h4>

            <div class="ultima-visita">

                <?php foreach($ultimas_visitas as $visita): ?>

                <span class="user-visita" title="<?php echo timeago(strtotime($visita->fecha_visita)); ?>">

                    <img src="<?php echo base_url(); ?>/img/avatares/<?php echo $visita->avatar; ?>" />
                    <a href="<?php echo site_url(); ?>usuarios/perfil/<?php echo $visita->nick; ?>"> <?php echo $visita->nick; ?></a>

                </span>

                <?php endforeach; ?>



            </div>

        </div>

    </div>



<!--
 <div class="span6">

    <h3><?php echo $usuario->nick; ?></h3>
        <div id="datos">
            <fieldset>
                <legend><b>Datos</b></legend>
                <table id="userData" width="100%" class="table">
                    <tr>
                        <td class="titulo">Nombre:</td>
                        <td><?php echo $usuario->nombre; ?></td>
                        <td rowspan="4">
                            <span id="avatar">

                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Apellidos:</td>
                        <td><?php echo $usuario->apellido; ?></td>
                    </tr>
                    <tr>
                        <td>Ubicacion:</td>
                        <td><?php echo $usuario->ubicacion; ?></td>
                    </tr>
                    <tr>
                        <td>Año nacimiento:</td>
                        <td><?php echo $usuario->ano_nacimiento; ?></td>
                    </tr>
                </table>



            </fieldset>
        </div>

 </div>

 <div class="span6">
    <div class="avatar">
        <img id="imgAvatar"  src="<?= base_url() ?>img/avatares/<?= $avatar ?>" align="right"/>
    </div>
 </div>

-->

</div>

<div class="row">

    <div class="span12" >

        <h3>Gráfica rendimiento</h3>
        <?php echo InsertChart ( "charts_library/charts.swf", "charts_library", "usuarios/rendimiento_pm/".$usuario->nick, 1100, 300 ); ?>

        <h3>Gráfica ingresos</h3>
        <?php echo InsertChart ( "charts_library/charts.swf", "charts_library", "usuarios/ingresos_chart/".$usuario->nick, 1100, 300 ); ?>

    </div>

</div>





