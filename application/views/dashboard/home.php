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
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            
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
                       HALL OF FAME - ¿Qué piensan los managers?
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                           
                            <a class="fa fa-times" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="input-group m-bot15">
                                <input type="text" class="form-control">
                                              <span class="input-group-btn">
                                                <button type="button" class="btn btn-success">Enviar!</button>
                                              </span>
                            </div>
                        <div class="alert alert-hall-msg clearfix">
                            <span class="hall-avatar">
                                <img src="http://localhost/lf12014//img/avatares/thumbs/i212981_th1.jpg" alt="">
                                
                            </span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender"><span>#87<a href="#"> Gogari</a></span> </li>
                                    <li class="pull-right notification-time">Hace 1 min</li>
                                </ul>
                                <p>
                                    Vaya carreron de Hamilton! Una pena ese  safety car...Han penalizado al equipo Lotus, 2 horas despues de arruinarme comprandolo.
                                </p>
                            </div>
                        </div>
                        <div class="alert alert-hall-msg">
                            <span class="hall-avatar">
                                <img src="http://localhost/lf12014//img/avatares/thumbs/i212981_th1.jpg" alt="">
                                
                            </span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender"><span><a href="#">Kniom</a></span> </li>
                                    <li class="pull-right notification-time">Hace 7 Horas</li>
                                </ul>
                                <p>
                                    Ojito con massa este año
                                </p>
                            </div>
                        </div>
                        <div class="alert alert-hall-msg ">
                            <span class="hall-avatar">
                                <img src="http://localhost/lf12014//img/avatares/thumbs/i212981_th1.jpg" alt="">
                                
                            </span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender"><span><a href="#">Filippo</a></span></li>
                                    <li class="pull-right notification-time">Hace 12 horas</li>
                                </ul>
                                <p>
                                    Voy a copiar la estrategia de <a href="#">Gogari</a> jurjurjur
                                </p>
                            </div>
                        </div>
                        <div class="alert alert-hall-msg ">
                            <span class="hall-avatar">
                                <img src="http://localhost/lf12014//img/avatares/thumbs/i212981_th1.jpg" alt="">
                                
                            </span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender"><span><a href="#">John Doe</a></span></li>
                                    <li class="pull-right notification-time">Ayer</li>
                                </ul>
                                <p>
                                    Han penalizado al equipo Lotus, 2 horas despues de arruinarme comprandolo.
                                </p>
                            </div>
                        </div>

                        <div class="alert alert-hall-msg ">
                            <span class="hall-avatar">
                                <img src="http://localhost/lf12014//img/avatares/thumbs/i212981_th1.jpg" alt="">
                                
                            </span>
                            <div class="notification-info">
                                <ul class="clearfix notification-meta">
                                    <li class="pull-left notification-sender"><span><a href="#">John Doe</a></span></li>
                                    <li class="pull-right notification-time">Ayer</li>
                                </ul>
                                <p>
                                    Han penalizado al equipo Lotus, 2 horas despues de arruinarme comprandolo.
                                </p>
                            </div>
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
                        Contenido publicidad
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
        
        <!-- Variaciones mercado -->
        <div class="row">
            
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Variaciones mercado pilotos
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            
                            
                         </span>
                    </header>
                    <div class="panel-body">
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th>COD</th>
                                    <th>Piloto</th>
                                    <th class="numeric">Precio  Ayer</th>
                                    <th class="numeric">Cambio</th>
                                    <th class="numeric">Cambio %</th>
                                    <th class="numeric">Precio actual</th>
                                    <th class="numeric">Precio más alto</th>
                                    <th class="numeric">Precio mas bajo</th>
                                    <th class="numeric">Fichajes</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach($info_mercado_pilotos as $iPiloto):?>   
                                    <tr>
                                        <td><?php echo $iPiloto->code;?></td>
                                        <td><?php echo $iPiloto->nombre." ".$iPiloto->apellido;?></td>
                                        <td class="numeric">$5.000.000</td>
                                        <td class="numeric"> +$340.901 <i class="fa fa-angle-double-up" style="color: rgb(90, 157, 29); font-size: 16px;"></i></td>
                                        <td class="numeric">+6,8% <i class="fa fa-angle-double-down" style="color: rgb(255, 0, 0); font-size: 16px;"></i></td>
                                        <td class="numeric">$5.340.901</td>
                                        <td class="numeric">$6.100.920</td>
                                        <td class="numeric">$3.710.200</td>
                                        <td class="numeric">214</td>
                                    </tr>
                                <?php endforeach;?>
                                
                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
               
                
            </div>

        </div>
        <!-- Fin variaciones mercado-->

       

        <!-- page end-->
        </section>
    </section>
    <!--main content end-->





