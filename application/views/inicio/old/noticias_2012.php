


      <div class="hero-unit" style="background-image:url('<?php echo base_url(); ?>img/header4.png');">

          <img src="<?php echo base_url(); ?>/img/logolf1w.png" />




          <div class="lastchamp">
            <img src="<?php echo  base_url();?>img/2012/champ2012.png" alt="Campeón Liga Formula 1 2012 con 5561.5 puntos manager." title="Julian - Campeón Liga Formula 1 2012 con 5561.5 puntos manager.">
          </div>
      </div>


      <div class="row">
        <div class="span12">

          <div id="contgold" align="center">

            <span class="lblgold">Gold Managers LF1:</span>
              <?php $i= 0; foreach($ricos as $rank): ++$i; if($i>12) break;?>

              <div class="toph-box" title="<?php echo $rank->nick." | ".$rank->ubicacion." | ".number_format($rank->fondos, 0, ",", "."); ?> € ">

                <span class="avatar">
                    <?php if($rank->avatar  != ''): ?>
                      <img  src="<?php echo base_url().'img/avatares/'.$rank->avatar; ?>" width="80" />
                    <?php else: ?>
                      <img  src="<?php echo base_url().'img/avatares/no_avatar.gif'?>" />
                    <?php endif; ?>
                </span>

                <span class="usnick">

                  <b>  <a href="<?php echo site_url(); ?>usuarios/perfil/<?php echo $rank->nick; ?>"> <?php echo substr(ucfirst(strtolower($rank->nick)), 0,10) ?> </a></b>

                </span>

                <span class="uspuntos">
                    <?php echo number_format($rank->fondos, 0, ",", ".") ; ?> €
                </span>

                <span class="usubi">
                    <?php echo substr(ucfirst(strtolower($rank->ubicacion)), 0,10); ?>
                </span>

              </div>

            <?php endforeach; ?>
          </div>



        </div>
      </div>
      <!-- Example row of columns -->
      <div class="row">
        <!--<div class='tweet'></div>-->



        <div class="span6">

          <div id="lf1_info">


            <div id="panelTiempoGph">

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
             document.getElementById('hora').innerHTML ="<div id='countDown'> <span class='digito'>" +  Math.floor(DD) + "</span> <span class='digito'>" + Math.floor(hh) + "</span> <span class='digito'>" + Math.floor(mm) + "</span> <span class='digito'> " + Math.floor(ss) + "</span>"+
                                                          "<span class='letra'><?php echo $this->lang->line('dias'); ?></span>"+
                                                          "<span class='letra'><?php echo $this->lang->line('horas'); ?></span>"+
                                                          "<span class='letra'><?php echo $this->lang->line('minutos'); ?></span>"+
                                                          "<span class='letra'><?php echo $this->lang->line('segundos'); ?></span>"+

                                                          "</div>";
             if (hasta < hoy)

             {
              document.getElementById('hora').innerHTML = "<?php echo $this->lang->line('fin_de_semana_gp'); ?>";
              //document.getElementById('msgInfo').innerHTML = "<img src='<?php echo base_url();?>/img/boxclosed.png' />";
              cleartimeout(tictac);
             }
             else
             {
              tictac = setTimeout("calcula("+anio+","+mes+","+dia+")",1000)
              //document.getElementById('msgInfo').innerHTML = "<img src='<?php echo base_url();?>/img/boxopen.png' />";
             }
            }
          </script>

          
          <span id="hora"><script>calcula("<?=$anioGP?>","<?=$mesGP?>","<?=$diaGP?>")</script></span>

          <span id="msgInfo">

            <?php if($estadoBoxes): ?>
              <!--<img src='<?php echo base_url();?>/img/boxopen.png' />-->
              <div class="boxopen">BOXES <div>Abiertos</div></div>
            <?php else: ?>
              <!--img src='<?php echo base_url();?>/img/boxclosed.png' />-->
              <div class="boxclosed">BOXES <div>Cerrados</div></div>
            <?php  endif;?>
          </span>
          
          <div class="nextgptxt"><?php echo $this->lang->line('proximo_gp'); ?> <?php echo $paisGP;?></div>

          <?php if($_SESSION['id_usuario']): ?>

            <div class="intro_splash_lf1">

              <?php foreach($noticias_lf1 as $lf1news): ?>

                <h3><?php echo $lf1news->titulo;?></h3>
                <?php echo $lf1news->texto;?>

              <?php endforeach; ?>

            </div>

          <?php else: ?>

          <div class="intro_splash">

        <?php /* comentado por promocion paf, reponer cuando se kite  la promocion

            <h3>¿Quieres ser piloto de rally?</h3>

            <p>Betmedia en colaboración con la casa de apuestas Paf, organiza un proceso de selección



que determinará quiénes serán los 34 aspirantes que competirán en la prueba final. De



entre ellos se escogerá a uno para participar como piloto en el Rally de Madrid.</p>

<div align="center">
  <a href="http://www.sebuscapilotoderallyes.com/">
  <img src="<?php echo base_url(); ?>img/2013/se-busca-piloto-de-rally.jpg" />
</a>
</div>


<p>El ganador de la selección disputará en Madrid del 23 al 24 de noviembre, una prueba



correspondiente al Campeonato de España de Rally con un Peugeot 208 R2.</p>

<p>Mas información:</p>
<a href="http://www.sebuscapilotoderallyes.com/">http://www.sebuscapilotoderallyes.com/</a>
*/?>

              <h3><?php echo $this->lang->line('inicio_titulo');?></h3>
                <p><?php echo $this->lang->line('inicio_prf1');?></p>
                <p><?php echo $this->lang->line('inicio_prf2');?></p>

                  <div class="indent"><a class="minimal-indent" href="<?php echo site_url() ?>alta"><?php echo $this->lang->line('inicio_btn_reg');?></a></div>
                  <span align="center"><p>* Registros abiertos durante todo el año.</p></span>

                  <div style="margin-top:30px;">

                    <img src="<?php echo base_url(); ?>img/logincar.jpg" width="99%" />
                  </div>


                  
          </div>


        <?php endif; ?>






        </div>

        </div> <!--div #l1_info-->

        </div> <!-- div span6 -->


        <div class="span6">







          <div id="panelInfo">

            <!-- AddThis Button BEGIN -->
            <!--
            <div class="addthis_toolbox addthis_default_style ">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_tweet"></a>
            <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
            <a class="addthis_counter addthis_pill_style"></a>
            </div>
            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f88768440e4572a"></script>
          -->
            <!-- AddThis Button END -->

<!-- PANEL INFO START

            <div class="estadisticas">
              <h3><?php echo $this->lang->line('pan_estadisticas'); ?></h3>
              <ul>
                 <li><?php echo $this->lang->line('pan_pilotos_comprados'); ?>: <span><?=$pilotosComprados;?></span> </li>
                 <li><?php echo $this->lang->line('pan_pilotos_vendidos'); ?>:  <span><?=$pilotosVendidos;?> </span></li>
                 <li><?php echo $this->lang->line('pan_equipos_comprados'); ?>:<span> <?=$equiposComprados;?></span></li>
                 <li><?php echo $this->lang->line('pan_equipos_vendidos'); ?>:<span> <?=$equiposVendidos;?></span></li>
                 <li><?php echo $this->lang->line('pan_numero_stikis'); ?>: <?=$paisGP?> </li>
                 <li><?php echo $this->lang->line('pan_stiki_dinero'); ?>: <span> <?=$stikisDineroComprados;?> </span></li>
                 <li><?php echo $this->lang->line('pan_stiki_puntos'); ?>: <span> <?=$stikisPuntosComprados;?> </span></li>
              </ul>
          </div>

          <div class="actividadForo">
            <h3><?php echo $this->lang->line('pan_ultimos_posts'); ?></h3>
            <ul>
              <? foreach($lastPost as $post):?>
              <li><?=anchor(site_url()."/foro/ver/".$post->id, substr($post->titulo,0,25),array("title"=>$post->titulo) )."... <span>".$this->lang->line('pan_escrito_por')." ".$post->autor."</span>";?></li>
            <? endforeach;?>
            </ul>
          </div>

          <div class="linksRelated">
            <h3>Links</h3>


            <ul>
              <li><a href="http://www.playtheguru.com" title="Juegos de conocimiento para que demuestres cuánto sabes. Juega gratis, acumula puntos y gana premios. Podrás compartirlos con tus amigos o donarlos a una ONG.">PLAYtheGURU</a></li>
              <li><a href="http://www.formula1.com" title="Oficial Formula 1 site">Formula1.com</a></li>
              <li><a href="http://www.f1aldia.com" title="Toda la actualidad de la Formula 1">F1aldia</a></li>
              <li><a href="http://www.desdeboxespodcast.com/" title="El mejor programa de radio en formato podcast">Desde boxes</a></li>
              <li><a href="http://www.planetf1.com" title="Latest formula 1 news">Planet F1</a></li>
              <li><a href="http://www.webcodex.es/web_design.php" title="Traducción y soporte a cargo de Webcodex">Webcodex<a></li>
            </ul>

          </div>

          <div class="adbox">
            <h3>PLAYtheGURU</h3>

            <a href="http://www.playtheguru.com/beta911/es/circuit.php?id_circuit=5">
              <img src="<?php echo base_url();?>/img/banners/playtheguru_p.png" alt="Gana premios con PlaytheGuru.com"/>
            </a>


          </div>





          <div class="twittbox">
             <img src="<?php echo base_url() ?>img/twitter.png" width="46" style="float: left; margin-top: -11px;" />
             <a href="https://twitter.com/LigaFormula1" title="Comentamos la actualidad de la formula 1, con un toque picantón!">
                ¡Siguenos en Twitter,@LigaFormula1!
              </a>
          </div>

        </div>

         PANEL INFO ENDS -->

         <!-- 2013 Updates -->
         <h3 class="h3panel">Últimos pilotos fichados</h3>
         <?php foreach($ultimos_pilotos_comprados as $piloto): ?>

          <div class="driver-box" title="<?php echo strtoupper($piloto->nombre_completo); ?>
            | Fichado por el <?php echo $piloto->por_fichaje ?>%
            | Vendido por el <?php echo  $piloto->por_venta; ?>% ">
            <img src="<?php echo base_url() ?>img/pilotos/<?php echo $piloto->imagen;?>" alt="<?php echo $piloto->nombre_completo; ?>" />
          </div>


        <?php endforeach; ?>

        <h3 class="h3panel2">Estadísticas LF1 2013</h3>

          <div id="statsbox">
            <span class="statslab"><?php echo $this->lang->line('pan_pilotos_comprados'); ?>: <span class="statsval"><?=$pilotosComprados;?></span></span>
            <span class="statslab"><?php echo $this->lang->line('pan_pilotos_vendidos'); ?>:  <span class="statsval"><?=$pilotosVendidos;?> </span></span>
            <span class="statslab"><?php echo $this->lang->line('pan_equipos_comprados'); ?>:<span class="statsval"> <?=$equiposComprados;?></span></span>
            <span class="statslab"><?php echo $this->lang->line('pan_equipos_vendidos'); ?>:<span class="statsval"> <?=$equiposVendidos;?></span></span>
            <span class="statslab"><?php echo $this->lang->line('pan_stiki_dinero'); ?> <?=$paisGP?>: <span class="statsval"> <?=$stikisDineroComprados;?> </span></span>
            <span class="statslab"><?php echo $this->lang->line('pan_stiki_puntos'); ?> <?=$paisGP?>: <span class="statsval"> <?=$stikisPuntosComprados;?> </span></span>
          </div>

          <div class="socialbox">
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style ">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_tweet"></a>
            <a class="addthis_button_pinterest_pinit"></a>
            <a class="addthis_counter addthis_pill_style"></a>
            </div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5119d3da680495a0"></script>
            <!-- AddThis Button END -->
          </div>

          <h3 class="h3panel2"> Actividad Foros </h3>

          <ul class="actforo">
            
            <li><?php echo $last_topics; ?></li>
          <?php
          /*
          $i = 0;
          foreach($lastPost as $foro):?>
           <li> <?php

                  switch($i){

                    case '0':
                    echo anchor('foro/sel/lf1general',$foro->titulo);
                    break;

                    case '1':
                    echo anchor('foro/sel/lf1ayuda',$foro->titulo);
                    break;

                    case '2':
                    echo anchor('foro/sel/lf1formula1',$foro->titulo);
                    break;

                    case '3':
                    echo anchor('foro/sel/lf1offtopic',$foro->titulo);
                    break;

                    default:
                    break;
                  }
                  ++$i;
                ?>
            </li>
          <?php endforeach; 
*/
          ?>

          </ul>
  
          <?php /*GRUPO LINE- No ha funcionado la idea*/
          /*
          <span class="linelf1">


            <a  href="<?php echo site_url() ?>foro/selline">
              <img src="<?php echo base_url(); ?>img/linelf1.jpg" width="35"/> <strong>Grupo LINE de ligaformula1.com</strong>

            </a>

          </span>
          */
          ?>

        </div>







      </div> <!-- div  span6 -->

    </div> <!-- div  ROW -->

      <div class="row">

        <div class="span6">

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


          <h1><?php echo $this->lang->line('noticias_titulo');?></h1>

          <?php 
          $i= 0;
          foreach($noticiasfeed->item  as $new): ?>


            <?php if($i<14):?>

            



            <article class="lf1newfeed">

                <h2> <a href="<?php echo $new->link;?>"> <?php echo $new->title; ?> </a> </h2>
                <?php
                  if($this->config->item('language') != 'spanish')
                  {
                    echo '<div class="imgnc">';
                    echo '<img width="105" src="'.$new->enclosure.'" />';
                    echo '</div>';
                    echo '<p>'.$new->description.'</p><br><br><br>';

                  }
                  else
                  {
                    echo $new->description;
                  }
                  ++$i;
                ?>

            </article>
            <?php endif;?>

          <?php endforeach;?>

       </div>

       <div class="span6">

          <div class="homeads">

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


          <div class='tweet'>

            <?php if($this->session->userdata('language') == 'english'): ?>

            <a class="twitter-timeline"  href="https://twitter.com/F1"  data-widget-id="309259911966105600">Tweets por @F1</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


            <?php else: ?>

                          <a class="twitter-timeline"  href="https://twitter.com/a3formula1"  data-widget-id="297732091150475264">Tweets por @a3formula1</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


            <?php endif; ?>


           </div>

           <div class="afiliados">
            <h2>Afiliados:</h2>


            <a title="Liga rFactor, simulador virtual de Fórmula 1  F1RSTOP" href="http://www.f1rstop.com/" class="blockaff"><img src="<?php echo base_url(); ?>img/banners/f1rstopbaner.png" /></a>
            <a title="Podcast sobre el mundo de la Fórmula 1" href="http://www.desdeboxespodcast.com/" class="blockaff"><img src="<?php echo base_url(); ?>img/banners/desdeboxes.png" /></a>

           </div>

        <h2><?php echo $this->lang->line('actualizaciones_lf1'); ?>:</h2>
          <?php
          foreach($noticias as $noticia):
          ?>
            <article class="lf1new">

              <h2><?=$noticia->titulo;?></h2>
              <span class="fechaPub"> <?=$noticia->fecha?> </span>
              <?=$noticia->cuerpo?>

            </article>

          <? endforeach;?>




        </div>

      </div>


      <div class="modal hide fade" id="myModal">

              <form class="form-vertical" method="post" action="<?php echo site_url()?>/inicio/login/">
              <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3><?php echo $this->lang->line('login_titulo'); ?></h3>
              </div>


              <div class="modal-body">

                <div style="text-align: center">

                         <label> <?php echo $this->lang->line('login_usuario'); ?></label>

                          <input type=text name=usuario>

                        <label><?php echo $this->lang->line('login_passwd'); ?></label>
                        <input type=password name=passwd>

                       <label> <?=anchor('inicio/recordar_login',$this->lang->line('login_recordar_passwd'))?></label>

                </div>


              </div>

              <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal"><?php echo $this->lang->line('login_btn_cerrar'); ?></a>
                <input type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('login_btn_entrar'); ?>" />
              </div>
               </form>
      </div>



      <hr>

