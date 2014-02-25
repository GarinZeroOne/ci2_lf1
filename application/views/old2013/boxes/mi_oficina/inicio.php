
<script>
            function calcula(anio,mes,dia)
            {
            var montharray=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")
             hoy = new Date()
             hasta = new Date(montharray[mes-1]+" "+ (dia-1) +","+anio+" 00:00") // Cambiar aquí el valor de la fecha y hora elegida.
             DD = (hasta - hoy) / 86400000

             hh = (DD - Math.floor(DD)) * 24
             mm = (hh - Math.floor(hh)) * 60
             ss = (mm - Math.floor(mm)) * 60
             document.getElementById('horat').innerHTML ="<div id='countDownt'>"+

                            "<span class='digitot'> " +  Math.floor(DD) + "</span>"+"<span class='letrat'> <?php echo $this->lang->line('dias'); ?></span>"+
                            "<span class='digitot'> " + Math.floor(hh) + "</span>"+"<span class='letrat'> <?php echo $this->lang->line('horas'); ?></span>"+
                            "<span class='digitot'> " + Math.floor(mm) + "</span>"+"<span class='letrat'> <?php echo $this->lang->line('minutos'); ?></span>"+
                            "<span class='digitot'> " + Math.floor(ss) + "</span>"+"<span class='letrat'> <?php echo $this->lang->line('segundos'); ?></span>"+




                          "</div>";
             if (hasta < hoy)
             {
              document.getElementById('horat').innerHTML = "<?php echo $this->lang->line('fin_de_semana_gp'); ?>";
              /*document.getElementById('msgInfo').innerHTML = "<img src='<?php echo base_url();?>/img/boxclosed.png' />";*/
              cleartimeout(tictac);
             }
             else
             {

              tictac = setTimeout("calcula("+anio+","+mes+","+dia+")",100000)
              /*document.getElementById('msgInfo').innerHTML = "<img src='<?php echo base_url();?>/img/boxopen.png' />";*/
             }
            }
</script>


<div class="row">

    <div class="span12">

        <div class="barinfo">
            <span class="srr">S.R.R : <i>2</i></span>
            <span class="srrf">  </span>
            <span class="srrf">  </span>
            <span class="srrm">  </span>
            <span class="srro">  </span>
            <span class="srro">  </span>
            <span class="srro">  </span>
            <span class="srro">  </span>
            <span class="srro">  </span>

            <span class="temporizador">

                <span id="horat"><script>calcula("<?=$anioGP?>","<?=$mesGP?>","<?=$diaGP?>")</script></span>

            </span>

        </div>

    </div>

</div>


<div class="row">
    <div class="span12">

        <!-- CONTROL DE APERTURA Y CIERRE DE BOXES -->
        <?php if ($boxes): ?>
            <div class="migas">
                <?php
                echo anchor('boxes', $this->lang->line('oficina_lbl_boxes')) . ' <span>></span> '
                . $this->lang->line('oficina_lbl_mi_oficina');
                ?>
            </div>

            <?php
            /*
            <!--  ADVERTISEMENT TAG 728 x 90, DO NOT MODIFY THIS CODE -->
            <script type="text/javascript" src="http://performance-by.simply.com/simply.js?code=25639;3;0&amp;v=2"></script>
            <script type="text/javascript">
                <!--
                document.write('<iframe marginheight="0px" marginwidth="0px" frameborder="0" scrolling="no" width="728" height="90" src="http://optimized-by.simply.com/play.html?code=119589;25503;26987;0&from='+escape(document.referrer)+'"></iframe>');
                // -->
            </script>
            */
             ?>

             <div class="ads"></div>


            <div id="contenBox">

                <!--
                <div class="msgErr">

                </div>
                -->
                <p>
                    <? echo $this->lang->line('oficina_prf_inicio') ?>
                </p>


                <?php if ($info_msg): ?>
                    <div id="infoPanel"> <?php echo $info_msg; ?></div>
                <?php endif; ?>


                <h3 class="boxcab">Mis mejoras</h3>
                <div id="tmejoras">

                    <?= $panel_mejoras; ?>

                </div>


                <h3><? echo $this->lang->line('oficina_ttl_resumen') ?></h3>


                <div id="resumengp" align="center">
                    <table>

                        <th><? echo $this->lang->line('oficina_lbl_concepto') ?></th>
                        <th><? echo $this->lang->line('oficina_lbl_piloto') ?></th>
                        <th><? echo $this->lang->line('oficina_lbl_equipo') ?></th>
                        <th><? echo $this->lang->line('oficina_lbl_ingresos') ?></th>
                        <th><? echo $this->lang->line('oficina_lbl_puntos_man') ?></th>

                        <?
                        $cont_puntos;
                        $cont_dinero;
                        $i = 0;
                        foreach ($resultados as $resultado):
                            ?>

                            <tr>
                                <td class="concepto">
                                    <?
                                    switch ($resultado->tipo) {
                                        case "stiki_puntos":
                                            echo $this->lang->line('oficina_lbl_stk_puntos');
                                            break;
                                        case "ingenieros":
                                            echo $this->lang->line('oficina_lbl_ingeniero');
                                            break;
                                        case "pilotos":
                                            echo $this->lang->line('oficina_lbl_piloto');
                                            break;
                                        case "equipos":
                                            echo $this->lang->line('oficina_lbl_equipos');
                                            break;
                                        case "stiki_dinero":
                                            echo $this->lang->line('oficina_lbl_stk_dinero');
                                            break;
                                        case "banco":
                                            echo $this->lang->line('oficina_lbl_banco');
                                            break;
                                        case "publicistas":
                                            echo $this->lang->line('oficina_lbl_publicista');
                                            break;
                                    }
                                    ?>
                                </td>
                                <td> <?= $this->pilotos_model->get_nombre_piloto_por_id($resultado->id_piloto); ?></td>
                                <td> <?= $this->pilotos_model->get_nombre_equipo_por_id($resultado->id_equipo); ?>  </td>
                                <td> <?= es_dinero($resultado->dinero); ?> €</td>
                                <td class="pm"> <?= $resultado->puntos; ?></td> </tr>
                            <?
                            $cont_puntos = $cont_puntos + $resultado->puntos;
                            $cont_dinero = $cont_dinero + $resultado->dinero;
                            $i++;
                            ?>



                        <? endforeach; ?>

                        <tr><td class="concepto"><? echo $this->lang->line('oficina_lbl_nomina') ?></td><td></td> <td></td><td>100.000 €</td> <td>0</td></tr>
                        <tr id="totales">
                            <td><? echo $this->lang->line('oficina_lbl_total') ?></td> <td></td> <td></td>    <td> <?= es_dinero($cont_dinero + 100000); ?> €</td><td><?= $cont_puntos; ?></td>
                        </tr>
                    </table>
                </div>



            </div>
            <!-- BOXES CERRADOS -->
        <?php else: ?>

            <div align="center">
                <img  src="<?php echo base_url() . 'img/boxes_cerrados.jpg'; ?>" border="0" ></img>
            </div>

        <?php endif; ?>

    </div>
    <!--span12-->
</div>
<!-- row -->