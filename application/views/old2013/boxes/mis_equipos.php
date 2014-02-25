

<div class="row">

    <div class="span12">

        <div class="migas">
            <?php
            echo anchor('boxes', $this->lang->line('equipo_lbl_boxes'))
            . ' <span>></span> ' . $this->lang->line('equipo_lbl_mis_equipos');
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

    </div>

</div>


<div class="row">


    <div class="span3">

        <h3 class="boxcab"><? echo $this->lang->line('equipo_lbl_mis_equipos') ?></h3>

        <p><? echo $this->lang->line('equipo_prf1') ?></p>
        <p><? echo $this->lang->line('equipo_prf2') ?></p>

    </div>

    <div class="span9">

        <h3 class="boxcab">Equipos fichados</h3>


        <div class="carteraEquipos">

            <form method="post" action="<?= site_url() ?>/boxes/mis_equipos">

                <?php if($info_equipos): ?>

                <div class="botoncompra">
                     <input type="submit" value="<? echo $this->lang->line('equipo_btn_vender') ?>" class="btn btn-primary">
                </div>


                    <?php
                    foreach ($info_equipos as $equipo):
                        // color precio
                        $color = ' style="color:#008080;"';
                        ?>


                            <!--
                                <img src="<?= base_url() ?>img/equipos/<?= $equipo->foto; ?>.jpg" />
                                <span><input <?= $permitir ?> type=checkbox name=equipo[] value="<?= $equipo->id_equipo ?>"  ></span>
                                <span><? echo $equipo->escuderia; ?></span>
                                <span> <strong><? echo $this->lang->line('equipo_lbl_precio_venta') ?></strong>
                                    <? echo number_format($equipo->precio_venta, 0, ",", ".") ?> €</span>
                                <span> <strong><? echo $this->lang->line('equipo_lbl_dinero_ganado') ?></strong>
                                    <? echo number_format($equipo->puntos, 0, ",", ".") ?> €</span>
                            -->

                            <div class="equipobox">
                                <img src="<?=base_url()?>img/equipos/<?=$equipo->foto;?>.jpg" /> <br>
                                <span class="cComprar">
                                    <input class="checkCompra" type="checkbox" name="equipo[]" value="<?=$equipo->id_equipo?>"   >
                                </span>

                                <?echo $equipo->escuderia;?>
                                <span class="precioVenT"> <strong><? echo $this->lang->line('equipo_lbl_precio_venta') ?></strong>
                                    <? echo number_format($equipo->precio_venta, 0, ",", ".") ?> €</span>
                                <span> <strong><? echo $this->lang->line('equipo_lbl_dinero_ganado') ?></strong>
                                    <? echo number_format($equipo->puntos, 0, ",", ".") ?> €</span>

                            </div>


                    <?php endforeach ?>





            </form>

            <?php else: ?>

             <i>No dispones de ningún equipo en estos momentos. Visita la <a href="<?php echo site_url();?>boxes/fichar_equipos">cartera de equipos</a> para fichar alguno antes del siguiente gran premio.</i>

            <?php endif; ?>

        </div>

         <?php echo $ventaTxt;
        ?>

    </div>

</div>


