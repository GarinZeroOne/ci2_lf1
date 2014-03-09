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

                            "<span class='digitot'> " +  Math.floor(DD) + "</span>"+"<span class='letrat'> d </span>"+
                            "<span class='digitot'> " + Math.floor(hh) + "</span>"+"<span class='letrat'> h</span>"+
                            "<span class='digitot'> " + Math.floor(mm) + "</span>"+"<span class='letrat'> m</span>"+
                            "<span class='digitot'> " + Math.floor(ss) + "</span>"+"<span class='letrat'> s</span>"+




                          "</div>";
             if (hasta < hoy)
             {
              document.getElementById('horat').innerHTML = "<?php echo $this->lang->line('fin_de_semana_gp'); ?>";
              /*document.getElementById('msgInfo').innerHTML = "<img src='<?php echo base_url();?>/img/boxclosed.png' />";*/
              cleartimeout(tictac);
             }
             else
             {

              tictac = setTimeout("calcula("+anio+","+mes+","+dia+")",1000)
              /*document.getElementById('msgInfo').innerHTML = "<img src='<?php echo base_url();?>/img/boxopen.png' />";*/
             }
            }
</script>



    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
        
        
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-aviso fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Información!</strong> Faltan algunas caracteristicas por terminar (mensajes,textos,...), pero lo básico ya funciona.Iremos solucionando y añadiendo las caracteristicas que faltan durante estos dias. Para cualquier duda utilizar el foro o el Hall of fame. Queda inaugurada la temporada 2014!
                </div>

                                
            </div>
        </div>

        <!--mini statistics start-->
        <div class="row">

            <div class="col-md-3">
                <section class="panel">
                    <div class="panel-body">
                        <div id="grafica" >
                            
                        </div>
                    </div>
                </section>
            </div>

            
            
            
            <div class="col-md-3">
                <section class="panel">
                    <div class="panel-body">
                        <div id="grafica2" >
                            
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-3">
                <section class="panel">
                    <div class="panel-body">
                        <div id="grafica3" >
                            
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-3">
                <section class="panel">
                    <div class="panel-body">
                        
                        
                            <div class="temporizador">
                                <h4 class="widget-h">PRÓXIMO GRAN PREMIO</h4>

                                <span id="horat"><script>calcula("<?=$anioGP?>","<?=$mesGP?>","<?=$diaGP?>")</script></span>

                                <div class="nextGP"><?php  echo $paisGP; ?></div>
                            </div>
                        
                    </div>
                </section>
            </div>
            
        </div>
        <!--mini statistics end-->

        <div class="row">
            
            <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        Actualidad Formula 1
                        <span class="tools pull-right">
                            
                         </span>
                    </header>
                    <div class="panel-body">
                        <table class="table  table-hover general-table">
                            
                            <tbody>
                        <?php foreach($noticiasfeed->item  as $noticia):?>
                                <?php if($i<8):?>
                                <tr>
                                    
                                    <td><a target="_blank" href="<?php echo $noticia->link;?>"> <?php echo $noticia->title; ?> </a></td>
                                </tr>
                                <?php ++$i; endif;?>

                        <?php endforeach;?>

                            

                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <div class="col-md-5">
                
                <!-- OPINIONES start-->
                <section class="panel">
                    <header class="panel-heading">
                       HALL OF FAME - <?php echo $hof_pregunta->pregunta; ?>
                        <span class="tools pull-right">
                            
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="input-group m-bot15">
                                <input type="text" id="hall-text" class="form-control" maxlength="150" placeholder="Tu mensaje (max 150 caracteres)">
                                              <span class="input-group-btn">
                                                <button id="submit-comment" type="button" data-hof="<?php echo $hof_pregunta->id;?>" class="btn btn-success">Enviar!</button>
                                              </span>
                        </div>
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 360px;">
                            <ul id="conversation-list" class="conversation-list" style="overflow: hidden; width: auto; height: 360px;">

                                <?php  foreach($hof_respuestas as $respuesta): ?>
                                    <li>
                                        <div class="alert alert-hall-msg clearfix">
                                            <span class="hall-avatar">
                                                <img class="round-pilots-big" src="<?php echo base_url();?>img/avatares/<?php echo $respuesta->avatar;?>" alt="">
                                                
                                            </span>
                                            <div class="notification-info">
                                                <ul class="clearfix notification-meta">
                                                    <li class="pull-left notification-sender"><span><a href="<?php echo site_url();?>perfil/ver/<?php echo $respuesta->nick; ?>"> <?php echo $respuesta->nick ?></a></span> </li>
                                                    <li class="pull-right notification-time"><?php echo timeago(strtotime($respuesta->fecha)); ?></li>
                                                </ul>
                                                <p>
                                                    <?php echo $respuesta->respuesta; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>

                                
                                                        
                            </ul>
                        </div>

                        
                        

                        

                        
                    </div>
                </section>
                <!-- OPINIONES end -->
                
            </div>
            
            <div class="col-md-3">
                               
                <!--Ultimos fichajes start-->
                <section class="panel">
                    <header class="panel-heading">
                        Publicidad
                        <span class="tools pull-right">
                            
                            
                         </span>
                    </header>
                    <div class="panel-body">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- Cuadrado2014display -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:300px;height:250px"
                             data-ad-client="ca-pub-2361705659034560"
                             data-ad-slot="9275287139"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>

                    </div>
                </section>
                <!--Ultimos fichajes end-->
                
            </div>
            <?php /* MODULO ULTIMOS FICHAJES
            <div class="col-md-3">
                
                
                
                <!--Ultimos fichajes start-->
                <section class="panel">
                    <header class="panel-heading">
                        ULTIMOS FICHAJES EN LF1
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            
                         </span>
                    </header>
                    <div class="panel-body">
                        <?php foreach($ultimos_pilotos_comprados as $piloto): ?>

                          <div class="driver-box tooltips"  data-toggle="tooltip " data-placement="top" title="" data-original-title="<?php echo strtoupper($piloto->nombre_completo); ?>
                            | Fichado por el <?php echo $piloto->por_fichaje ?>%
                            | Vendido por el <?php echo  $piloto->por_venta; ?>% " >
                            <img src="<?php echo base_url() ?>img/pilotos/<?php echo $piloto->imagen;?>" alt="<?php echo $piloto->nombre_completo; ?>" />
                          </div>


                        <?php endforeach; ?>
                    </div>
                </section>
                <!--Ultimos fichajes end-->
                
                
                
            </div>
            */
            ?>

        </div>
        
        

       

        <!-- page end-->
        </section>
    </section>
    <!--main content end-->





