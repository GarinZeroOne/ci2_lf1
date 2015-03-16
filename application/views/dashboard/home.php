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
              document.getElementById('horat').innerHTML = "<span style='color:#ff0000;'>MERCADO CERRADO</span> </br> FIN DE SEMANA DE GP";
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

<!--
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=383497631760784";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
-->




    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
        
        
        <?php /* ALERTAS Y MENSAJES IMPORTANTES */
        /*
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
        */
        ?>

        <!--mini statistics start-->
        <div class="row">

            <div class="col-md-9">
                <section class="panel">
                    <div class="panel-body">
                        <?php if($ultimos_pilotos_comprados): ?>
                        <div id="demo4" class="scroll-img" title="Últimos fichades del dia">

                            
                            <ul>
                            <?php foreach($ultimos_pilotos_comprados as $upf): ?>
                                <li>
                                    <div class="piloto-marq">
                                    <a href="<?php echo site_url(); ?>mercado/fichaPiloto/<?php echo $upf->id_piloto; ?>">
                                        <img src="<?php echo base_url();?>img/pilotos/<?php echo $upf->imagen; ?>" alt="<?php echo $upf->nombre_completo;?>">
                                    </a>

                                    <div class="stats">
                                        <div title="Porcentaje total de usuarios que alguna vez ficharon a <?php echo $upf->nombre_completo; ?>"><i class="fa fa-thumbs-up" style="color:#7ABC2B"></i> <?php echo $upf->por_fichaje; ?>%</div>
                                        <div title="Porcentaje total de usuarios que han vendido a <?php echo $upf->nombre_completo; ?>"><i class="fa fa-thumbs-down" style="color:#ff0000"></i><?php echo $upf->por_venta; ?>%</div>
                                        <div style="text-align:center;color:#ccc"><?php echo $upf->nombre_completo; ?></div>
                                    </div>
                                    </div>
                                    
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        
                        </div>

                        <?php else: ?>
                        <span class="mercado-triste">Fichajes del dia: <i>No se han realizado fichajes</i></span>
                        <?php endif; ?>
                    
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
            
            <div class="col-md-5">
                <section class="panel">
                    <div class="panel-body">
                        <div id="grafica4" >
                            
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-4">
                <section class="panel">
                    <div class="panel-body">

                        <div class="row"><!-- row inside -->
                    <div class="col-lg-6 col-md-12">

                        
                                <table id="subidash" class="table">
                                    <thead>
                                        <th colspan="3"> <span class="tit_subidon">TOP Subidas de <?php echo $subidas_bajadas_texto_dia; ?></span></th>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach($subidones as $piloto):?>
                                        <?php if($piloto->diferencia>0): ?>
                                        <tr style="background: rgba(204, 255, 169, <?php echo $i; ?>)">
                                            <td width="40"> <img class="round-pilots" src="<?php echo base_url();?>img/pilotos/<?php echo $piloto->foto;?>.jpg" alt="<?php echo $piloto->apellido; ?>"> </td>
                                            <td> 
                                                    <span class="lbl-nombre-piloto"> <a href="<?php echo site_url();?>/mercado/fichaPiloto/<?php echo $piloto->id_piloto; ?>"><?php echo $piloto->nombre."</br>".$piloto->apellido; ?></a><span>

                                            </td>
                                            <td>
                                                <div class="vactual">
                                                    <span style="font-weight: 600; color: rgb(41, 85, 0);">
                                                    <?php echo es_dinero($piloto->valor_actual); ?>
                                                    </span>
                                                </div>
                                                <div class="diferencia">
                                                    <i style="color: rgb(90, 157, 29); font-size: 13px;" class="fa fa-angle-double-up"></i>
                                                    <span style="color: rgb(90, 157, 29); font-size: 12px;"><?php echo es_dinero($piloto->diferencia); ?></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php $i = $i-0.2; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                           
                        
                    </div>

                    <div class="col-lg-6 col-md-12">
                        
                                <table id="bajadash" class="table">
                                    <thead>
                                        <th colspan="3"> <span class="tit_bajon">TOP Bajadas de <?php echo $subidas_bajadas_texto_dia; ?></span></th>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach($bajones as $piloto):?>
                                        <?php if($piloto->diferencia<0): ?>
                                        <tr style="background: rgba(255, 186, 186, <?php echo $i; ?>)">
                                            <td width="40"> <img class="round-pilots" src="<?php echo base_url();?>img/pilotos/<?php echo $piloto->foto;?>.jpg" alt="<?php echo $piloto->apellido; ?>"> </td>
                                            <td> 
                                                    <span class="lbl-nombre-piloto"> <a href="<?php echo site_url();?>/mercado/fichaPiloto/<?php echo $piloto->id_piloto; ?>"><?php echo $piloto->nombre."</br>".$piloto->apellido; ?></a><span>

                                            </td>
                                            <td>
                                                <div class="vactual">
                                                    <span style="font-weight: 600; color: rgb(41, 85, 0);">
                                                    <?php echo es_dinero($piloto->valor_actual); ?>
                                                    </span>
                                                </div>
                                                <div class="diferencia">
                                                    <i style="color: rgb(255, 0, 0); font-size: 12px;" class="fa fa-angle-double-down"></i>
                                                    <span style="color: rgb(255, 3, 3); font-size: 11px;"><?php echo es_dinero($piloto->diferencia); ?></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php $i = $i-0.2; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                         
                    </div>
                    
                </div> <!-- row inside -->

                    </div>
                </section>
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

                
                
            
                
                
            </div>

        </div>

        <div class="row">
            <div class="col-md-5">
                
                <!-- OPINIONES start-->
                <section class="panel">
                    <header class="panel-heading">
                       HALL OF FAME - <span style="font-weight: bold; color: rgb(255, 89, 48);"><?php echo $hof_pregunta->pregunta; ?></span>
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
                                                    <li class="pull-left notification-sender"><span><a href="<?php echo site_url();?>perfil/ver/<?php echo $respuesta->nick; ?>"> <?php echo $respuesta->nick ?></a> 
                                                        <span id="numvotos"><?php if($respuesta->votos): ?>+<?php echo $respuesta->votos; ?><?php endif; ?></span> 
                                                        <i data-hofid="<?php echo $respuesta->id_respuesta; ?>"  class="fa fa-thumbs-up voto-manager" title="Me gusta este comentario"></i> </span> </li>
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
            

            <div class="col-md-7">

                <div class="row"> <!-- inside row-->
                    
                    <div class="col-md-6">
                        <section class="panel">
                            <div class="panel-body">
                                <div id="grafica" >
                                    
                                </div>
                            </div>
                        </section>
                    </div>
                    

                    <div class="col-md-6">
                        <section class="panel">
                            <div class="panel-body">
                                <div id="grafica3" >
                                    
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <section class="panel">
                            <div class="panel-body" style="border-radius: 4px; background-color: rgb(176, 186, 137);">
                                <div class="tit-mas-votada">Podium <?php echo $paisGP; ?> <?php echo date('Y') - 1; ?></div>
                                <div class="podium">
                                    <ol style="margin: 5px -25px;">
                                        <li style="font-size: 18px; margin: 10px 0px 0px 10px; text-shadow: 1px 1px 1px rgb(255, 186, 0); color: rgb(255, 241, 150);"><?php
                                        $datosPiloto = $ultimoGanador->RaceTable->Races[0]->Results[0];
                                        $datosSegundo = $segundo->RaceTable->Races[0]->Results[0];
                                        $datosTercero = $tercero->RaceTable->Races[0]->Results[0];
                                        if (isset($datosPiloto->Driver)) {
                                            echo $datosPiloto->Driver->givenName . " "
                                            . $datosPiloto->Driver->familyName
                                            . " (" . $datosPiloto->Constructor->name . " )";
                                        }
                                    ?></li>
                                    <li style="font-size: 18px; margin: 10px 0px 0px 10px; color: rgb(66, 91, 33);">
                                        <?php
                                        if (isset($datosPiloto->Driver)) {
                                            echo $datosSegundo->Driver->givenName . " "
                                            . $datosSegundo->Driver->familyName
                                            . " (" . $datosSegundo->Constructor->name . " )";
                                        }
                                    ?>
                                    </li>
                                    <li style="font-size: 18px; margin: 10px 0px 0px 10px; color: rgb(76, 82, 43);"><?php
                                        if (isset($datosPiloto->Driver)) {
                                            echo $datosTercero->Driver->givenName . " "
                                            . $datosTercero->Driver->familyName
                                            . " (" . $datosTercero->Constructor->name . " )";
                                        }
                                    ?></li>
                                    </ol>
                                    
                                    <div style="text-align:right"> <a style="color: rgb(255, 255, 255); text-shadow: 0px 1px 1px rgb(0, 0, 0);" href="<?php echo site_url();?>mercado/simulador"> <i class="fa fa-flag-checkered"></i> Simulador GP <?php echo $paisGP. " ".date('Y'); ?> </a></div>

                                    
                                </div>
                                
                                

                                
                                
                            </div>
                        </section>    
                    </div>
                    
                    <div class="col-md-6">
                        <section class="panel">
                            <div class="panel-body">
                                <div id="grafica2" >
                                    
                                </div>
                            </div>
                        </section>
                    </div>
                    


                </div> <!-- inside row -->


            </div>


            

            
            
            
            

            
            
            


            
            
            
            
        </div>

        

        <div class="row">

            <div class="col-md-9">
                

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


            
            
            
            
            <?php /*
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
            */?>
            
            
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

               <section class="panel">
                    <div class="panel-body">
                        <table id="estadisticas" class="table table-bordered table-striped table-condensed cf">
                            <tr>
                                <td> <span class="textm">Fichajes  pilotos:</span></td>
                                <td><?php echo es_dinero($estadisticas['total_fichajes']); ?></td>

                            
                                <td><span class="textm">Ventas pilotos:</span></td>
                                <td><?php echo es_dinero($estadisticas['total_ventas']); ?></td>
                            </tr>
                            <tr>
                                <td><span class="textm">Compra equipos:</span></td>
                                <td><?php echo es_dinero($estadisticas['total_compras_equipos']); ?></td>

                            
                                <td><span class="textm">Ventas equipos:</span></td>
                                <td><?php echo es_dinero($estadisticas['total_ventas_equipos']); ?></td>
                            </tr>
                            <tr>
                                <td><span class="textm">Stikis dinero <?php echo $paisGP; ?></span></td>
                                <td><?php echo $stikis_dinero; ?></td>
                            
                                <td><span class="textm">Stikis puntos <?php echo $paisGP; ?></span></td>
                                <td><?php echo $stikis_puntos; ?></td>
                            </tr>
                        </table>
                        <!--
                        <h4 class="widget-h">STIKIS <?php  echo $paisGP; ?></h4>
                        <div>
                            <img width="50%" src="<?php echo base_url();?>img/stikidinero.png" alt="Stiki Dinero"><span class="cont-stiki"><?php echo $stikis_dinero; ?></span>
                        </div>
                        <div  style="margin-top:2px;">
                            <img width="50%" src="<?php echo base_url();?>img/stikipuntos.png" alt="Stiki Puntos"><span class="cont-stiki"><?php echo $stikis_puntos; ?></span>
                        </div>
                    -->
                    </div>
                </section>    
                
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





