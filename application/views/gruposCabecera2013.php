
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

              tictac = setTimeout("calcula("+anio+","+mes+","+dia+")",10000)
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

        <div class="migas">
            <?php echo anchor('boxes','Boxes').' <span>> Grupos </span> '; ?>
        </div>

        <div class="ads">
            <?php /*
            <!--  ADVERTISEMENT TAG 728 x 90, DO NOT MODIFY THIS CODE -->
            <script type="text/javascript" src="http://performance-by.simply.com/simply.js?code=25639;3;0&amp;v=2"></script>
            <script type="text/javascript">
            <!--
            document.write('<iframe marginheight="0px" marginwidth="0px" frameborder="0" scrolling="no" width="728" height="90" src="http://optimized-by.simply.com/play.html?code=119589;25503;26987;0&from='+escape(document.referrer)+'"></iframe>');
            // -->
            </script>

            */  ?>
        </div>

    </div>

</div>


<div class="row">

    <div class="span12">


         <div id="textinfo">
        <h3 class="boxcab"><? echo $this->lang->line('grupos_titulo_principal') ?></h3>
        <? echo $this->lang->line('grupos_texto_inicio') ?>
        </div>

        <div id="menu_grupo" class="menuGrupo">
            <div id="clasficaciones" class="menu">
                <?php echo anchor('grupos/grupos_general', $this->lang->line('grupos_lbl_clasificaciones')) ?>
            </div>
            <div id="invitacionPeticion" class="menu">
                <?php echo anchor('grupos/gruposInvitacionesPeticiones', $this->lang->line('grupos_lbl_inv_pet')) ?>
            </div>
            <div id="gestionGrupos" class="menu">
                <?php echo anchor('grupos/gestionGrupos', $this->lang->line('grupos_lbl_gestion_grupos')) ?>
            </div>
        </div>



    </div>

</div>