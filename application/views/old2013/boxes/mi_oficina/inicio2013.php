


<div class="row">
  <div class="span12">

      <div class="migas">
          <?php
          echo anchor('boxes', $this->lang->line('oficina_lbl_boxes')) . ' <span>></span> '
          . $this->lang->line('oficina_lbl_mi_oficina');
          ?>
      </div>

      <div class="ads">

        <script type="text/javascript"><!--
        google_ad_client = "ca-pub-2361705659034560";
        /* Box_horizontal */
        google_ad_slot = "1297942735";
        google_ad_width = 728;
        google_ad_height = 90;
        //-->
        </script>
        <script type="text/javascript"
        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>

      </div>

      <?php if ($info_msg): ?>
                    <div id="infoPanel"> <?php echo $info_msg; ?></div>
      <?php endif; ?>

  </div>
</div>


<?php  // Si estan abiertos los boxes
if($boxes):
?>




<div class="row">

    <div class="span6">

      <h3 class="boxcab"> <? echo $this->lang->line('oficina_lbl_panel_mejoras') ?> </h3>
      <p>
          <? echo $this->lang->line('oficina_prf_inicio') ?>
      </p>

    </div>

    <div class="span6">
      <h3 class="boxcab"> <? echo $this->lang->line('oficina_lbl_mis_mejoras') ?> </h3>

      <div id="tmejoras">

          <?= $panel_mejoras; ?>

      </div>

    </div>



</div>


<div class="row">

  <div class="span12">

      <h3 class="boxcab"><? echo $this->lang->line('oficina_ttl_resumen') ?></h3>


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

                                        case "poleman":
                                            echo "Poleman";
                                            break;
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

</div>



<?php else: ?>

<div align="center">
      <img  src="<?php echo base_url().'img/boxes_cerrados.jpg'; ?>" border="0" ></img>
    </div>
<?php endif; ?>
