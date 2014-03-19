
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->

        

        
        <?php /******** MENSAJE MERCADO ABIERTO / CERRADO ****************/ ?>
        <?php if($this->session->flashdata('msg_boxes')): ?>
        <div class="row">
            <div class="col-md-12">
                    <div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Mercado cerrado!</strong> <?php echo $this->session->flashdata('msg_boxes'); ?>
                    </div>
            </div>
        </div>
        <?php endif; ?>

        

        <?php /******** MENSAJE MERCADO ABIERTO / CERRADO ****************/ ?>

        <!-- -->
        <div class="row"> 
            <div class="col-sm-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li class="active"><a href="#"><i class="fa fa-home"></i> Mis pilotos</a></li>

                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>
        <!-- publi row -->
        <div class="row">
            <div class="col-lg-12 hidden-md">
                <section class="panel-pub">
                    <div class="panel-body">
                        <div class="pub-cont">
                            
                            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- HorizontalGrande2014 -->
                                <ins class="adsbygoogle"
                                     style="display:inline-block;width:970px;height:90px"
                                     data-ad-client="ca-pub-2361705659034560"
                                     data-ad-slot="7256510330"></ins>
                                <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- publi row -->

        <!-- ROW -->
        <?php if (isset($msgVenta['codigoOperacion'])): ?>
            <?php if ($msgVenta['codigoOperacion']): ?>
                <div class="alert alert-block alert-success fade in">                                            
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <?php echo $msgVenta['mensaje']; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-block alert-danger fade in">                                            
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Opps!</strong> <?php echo $msgVenta['mensaje']; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="row">            
            <?php
            $contador = 0;
            $segundoDiv = false;
            foreach ($pilotos as $piloto):
                if ($contador > 3 && !$segundoDiv):
                    $segundoDiv = true;
                    ?>
                </div>
                <div class="row">            
                    <?php
                endif;
                $contador++;
                ?>
                <div class="col-lg-3">
                    <!--widget start-->
                    <aside class="profile-nav alt">
                        <section class="panel">
                            <div class="corner-ribon black-ribon">
                                <a class="confirm" title="Vender este piloto" href="<?php echo site_url() . 'gestion/venderPiloto/' . $piloto->getIdPiloto(); ?>"><i class="fa fa-sign-out"></i></a>
                            </div>
                            <div class="user-heading alt gray-bg">

                                <a href="#">
                                    <img alt="" src="<?= base_url() ?>img/pilotos/<?php echo $piloto->getFoto() ?>.jpg">
                                </a>
                                <h1><?php echo $piloto->getNombre() . " " . $piloto->getApellido(); ?></h1>
                                <p>Piloto <?php echo $piloto->getTipoCompra(); ?></p>
                            </div>

                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="javascript:;"> <i class="fa fa-credit-card"></i> 
                                        <?php if ($piloto->getTipoCompra() == 'fichado'): ?> Precio Compra <?php else: ?> Alquiler pagado <?php endif; ?>
                                        <span class="badge  pull-right r-activity">
                                            <?php
                                            if ($piloto->getTipoCompra() == 'fichado'): echo $piloto->getPrecioFichaje(true);
                                            else: echo $piloto->getPrecioFichaje(true);
                                            endif;
                                            ?>
                                        </span></a></li>
                                <li><a href="javascript:;"> <i class="fa fa-sign-out"></i> Precio actual <span class="badge  pull-right r-activity"><?php echo $piloto->getValorActual(true); ?></span></a></li>
                                <?php if ($piloto->getTipoCompra() == 'alquilado'): ?>
                                    <li><a href="javascript:;"> <i class="fa fa-credit-card"></i> 
                                            Precio alquiler actual
                                            <span class="badge  pull-right r-activity">                                                
                                                <?php
                                                echo $piloto->getPrecioAlquiler(true);
                                                ?>
                                            </span></a></li>
                                    <?php
                                endif;
                                ?>
                                <?php if ($piloto->getTipoCompra() == 'fichado'): ?>
                                    <li><a href="javascript:;"> <i class="fa fa-tachometer"></i> Ganancia/Perdida     
                                            <?php if ($piloto->getGananciaPerdida() > 0): ?>
                                                <span class="badge label-success2 pull-right r-activity">
                                                    <i class="fa fa-angle-double-up" style="color: rgb(90, 157, 29); font-size: 16px;"></i>

                                                <?php else: ?>
                                                    <span class="badge label-danger pull-right r-activity">
                                                        <i class="fa fa-angle-double-right" style="color: rgb(0, 96, 174); font-size: 16px;"></i>

                                                    <?php endif; ?>
                                                    <?php
                                                    echo $piloto->getGananciaPerdida(true);
                                                    ?>
                                                <?php else: ?>
                                                    <li><a href="javascript:;"> <i class="fa fa-tachometer"></i> Ganancia/Perdida     
                                                            <?php if ($piloto->getGananciaPerdidaAlquiler() > 0): ?>
                                                                <span class="badge label-success2 pull-right r-activity">
                                                                    <i class="fa fa-angle-double-up" style="color: rgb(90, 157, 29); font-size: 16px;"></i>

                                                                <?php else: ?>
                                                                    <span class="badge label-danger pull-right r-activity">
                                                                        <i class="fa fa-angle-double-down" style="color: rgb(255, 0, 0); font-size: 16px;"></i>

                                                                    <?php endif; ?>
                                                                    <?php
                                                                    echo $piloto->getGananciaPerdidaAlquiler(true);
                                                                    ?>
                                                                <?php endif; ?>

                                                            </span></a></li>                                                
                                                <li><a href="javascript:;"> <i class="fa fa-trophy"></i> Puntos  <span class="badge label-warning pull-right r-activity"><?php echo $piloto->getPuntosConseguidos(true); ?></span></a></li>
                                                <li><a href="javascript:;"> <i class="fa fa-eur"></i> Dinero <span class="badge label-warning pull-right r-activity"><?php echo $piloto->getDineroConseguido(true); ?></span></a></li>
                                                </ul>

                                                </section>
                                                </aside>
                                                <!--widget end-->

                                                </div>

                                                <?php
                                            endforeach;
                                            if (count($pilotos) < 7):
                                                for ($i = count($pilotos); $i < 7; $i++):

                                                    if ($contador > 3 && !$segundoDiv):
                                                        $segundoDiv = true;
                                                        ?>
                                                        </div>
                                                        <div class="row">            
                                                            <?php
                                                        endif;
                                                        $contador++;
                                                        ?>
                                                        <div class="col-lg-3">
                                                            <!--widget start-->
                                                            <aside class="profile-nav alt">
                                                                <section class="panel">
                                                                    <div class="corner-ribon black-ribon">
                                                                        <a title="Fichar/alquilar piloto" href="<?php echo site_url() . 'mercado/pilotos/'; ?>"><i class="fa fa-shopping-cart"></i></a>
                                                                    </div>
                                                                    <div class="user-heading alt" style="background-color: darkgrey">
                                                                        <div class="col-sm-4">
                                                                            <i class="fa fa-question-circle" style="font-size: 75px"></i>
                                                                        </div>

                                                                        <h1 class="col-sm-8">Plaza libre</h1>
                                                                    </div>
                                                                </section>
                                                            </aside>
                                                        </div>
                                                        <?php
                                                    endfor;
                                                endif;
                                                ?>
                                            </div><!-- FIN ROW -->


                                            <!-- page end-->
                                            </section>
                                            </section>
                                            <!--main content end-->
