

<?php if ($notificaciones): ?>
    <div class="row">
        <div class="span12">
            <span class="notify">
                <img src="<?php echo base_url(); ?>img/2013/alert.png" />
                <? echo $this->lang->line('boxes_mov_foros'); ?>
            </span>
        </div>
    </div>

<?php endif; ?>

<?php if($notificaciones_grupos): ?>
    <div class="row">
        <div class="span12">
            <span class="notify-grupos">
                <img src="<?php echo base_url(); ?>img/2013/gruposn.png" />
                <?php echo $notificaciones_grupos; ?>
            </span>
        </div>
    </div>
<?php endif; ?>



<div class="row">

    <div class="span6">


        <h3 class="boxcab"><? echo $this->lang->line('boxes_ttl_panel_manager'); ?></h3>

        <div class="boxoption">

            <img src="<?php echo base_url() ?>img/2013/oficina.png"  alt="Oficina" />
            <span> <a href="<?php echo base_url(); ?>mi_oficina">
                    <? echo $this->lang->line('boxes_lbl_mi_oficina'); ?></a> </span>
        </div>
        <!-- -->
        <div class="boxoption">
            <img src="<?php echo base_url() ?>img/2013/ficharpilotos.png"  alt="Comprar pilotos" />
            <span> <a href="<?php echo base_url(); ?>boxes/fichar_pilotos">
                    <? echo $this->lang->line('boxes_lbl_comprar_pilotos'); ?></a></span>
        </div>
        <!-- -->
        <div class="boxoption">
            <img src="<?php echo base_url() ?>img/2013/ficharequipos.png" alt="Comprar equipos" />
            <span> <a href="<?php echo base_url(); ?>boxes/fichar_equipos">
                    <? echo $this->lang->line('boxes_lbl_comprar_equipos'); ?></a></span>
        </div>
        <!-- -->
        <div class="boxoption">
            <img src="<?php echo base_url() ?>img/2013/stikis.png" height="100" alt="Comprar skitis" />
            <span> <a href="<?php echo base_url(); ?>boxes/stikis">
                    <? echo $this->lang->line('boxes_lbl_stikis'); ?></a></span>
        </div>
        <!-- -->
        <div class="boxoption">
            <img src="<?php echo base_url() ?>img/2013/grupos.png" alt="Grupos" />
            <span> <a href="<?php echo base_url(); ?>grupos">
                    <? echo $this->lang->line('boxes_lbl_grupos'); ?></a></span>
        </div>

        <!-- -->
        <div class="boxoption">
            <img src="<?php echo base_url() ?>img/2013/mispilotos.png"  alt="Mis pilotos" />
            <span> <a href="<?php echo base_url(); ?>boxes/mis_pilotos">
                    <? echo $this->lang->line('boxes_lbl_mis_pilotos'); ?></a></span>
        </div>
        <!-- -->
        <div class="boxoption">
            <img src="<?php echo base_url() ?>img/2013/misequipos.png"  alt="Mis equipos" />
            <span> <a href="<?php echo base_url(); ?>boxes/mis_equipos">
                    <? echo $this->lang->line('boxes_lbl_mis_equipos'); ?></a></span>
        </div>

        <!-- -->
        <div class="boxoption">
            <img src="<?php echo base_url() ?>img/boxes/perfil.png" alt="" />
            <span> <a href="<?php echo base_url(); ?>boxes/mi_perfil">
                    <? echo $this->lang->line('boxes_lbl_mis_perfil'); ?></a></span>
        </div>

        <!--
       <div class="boxoption"> -->
         <!--   <img src="<?php echo base_url() ?>img/boxes/playthegurub.png" alt="Gana premios con PLAYtheGURU" style="margin-top: -4px; margin-left: 7px;" />-->
        <!--
          <span> <a href="http://www.playtheguru.com/beta911/es/circuit.php?id_circuit=5" title="Demuestra tus conocimientos de Formula 1 y gana premios concursando en PLAYtheGURU"> PLAYtheGURU</a></span>
      </div>
        -->

        <div class="homeads" align="center">


            <script type="text/javascript"><!--
                google_ad_client = "ca-pub-2361705659034560";
                /* home_right */
                google_ad_slot = "1725248337";
                google_ad_width = 468;
                google_ad_height = 60;
                //-->
            </script>
            <script type="text/javascript"
                    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
            </script>

        </div>

    </div>


    <div class="span6">

        <div class="mp_muro">
            <h3 class="boxcab">Mi muro</h3>

            <div class="btn-mi-perfil"> <a href="<?php echo site_url();?>usuarios/perfil/<?php echo $_SESSION['usuario']; ?>">Ir a mi perfil</a></div>

            <div class="mensaje">


                <?php

                if(!$muro){
                    echo '<span class="nofirmas">Nadie ha escrito en tu muro aún, tú fama como manager no debe de ser muy alta. Prueba a actualizar tu perfil, mejorar tus resultados, participar en el foro,...</span>';
                }

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
                    <input type="hidden" name="idperfil" value="<?php echo $_SESSION['id_usuario']; ?>">
                    <input type="hidden" name="loc" value="boxes" />
                    <textarea name="mensaje" class="editor" maxlength="300" > Escribe un mensaje en el muro tu muro  </textarea>

                    <div class="boton-submit">
                         <input type="submit" name="Submit" class="btn btn-primary" value="Enviar Mensaje" >
                    </div>

                </form>

            </div>
            <?php endif; ?>




            <h4 class="box">Últimas visitas a tu perfil</h4>

            <div class="ultima-visita">

                <?php

                 if(!$ultimas_visitas){
                    echo '<span class="nofirmas">Sin visitas recientemente</span>';
                }

                foreach($ultimas_visitas as $visita): ?>

                <span class="user-visita" title="<?php echo timeago(strtotime($visita->fecha_visita)); ?>">

                    <img src="<?php echo base_url(); ?>/img/avatares/<?php echo $visita->avatar; ?>" />
                    <a href="<?php echo site_url(); ?>usuarios/perfil/<?php echo $visita->nick; ?>"> <?php echo $visita->nick; ?></a>

                </span>

                <?php endforeach; ?>



            </div>

        </div>

    </div>




</div>

<div class="row">

    <div class="span12">


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


        <h3 class="boxcab"><? echo $this->lang->line('boxes_ttl_zona_boxes'); ?></h3>


        <p><? echo $this->lang->line('boxes_prf_prf1'); ?></p>
        <p><? echo $this->lang->line('boxes_prf_prf2'); ?></p>

        <p><? echo $this->lang->line('boxes_prf_prf3'); ?></p>


        <br />
        <? echo $this->lang->line('boxes_prf_prf4'); ?>

        <ul>
            <li><? echo $this->lang->line('boxes_lst_lst1'); ?></li>
            <li><? echo $this->lang->line('boxes_lst_lst2'); ?></li>
            <li><? echo $this->lang->line('boxes_lst_lst3'); ?></li>
            <li><? echo $this->lang->line('boxes_lst_lst4'); ?></li>
            <li><? echo $this->lang->line('boxes_lst_lst5'); ?></li>
            <li><? echo $this->lang->line('boxes_lst_lst6'); ?></li>
            <li><? echo $this->lang->line('boxes_lst_lst7'); ?></li>

        </ul>


    </div>

</div>