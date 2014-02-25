
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <!-- Migas -->
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo site_url(); ?>mercado/pilotos"><i class="fa fa-home"></i> Mercado pilotos</a></li>
                    <li class="active"><a href="#"> Ficha <?php echo $piloto->getNombre() . " " . $piloto->getApellido(); ?></a></li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Ficha piloto
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">                       
                        <div class="row">

                            <!-- Cabecera grupo -->
                            <div class="col-md-4">
                                <section class="panel">
                                    <div class="panel-body profile-information">
                                        <div class="col-md-6 col-xs-6">
                                            <div class="img-thumbnail">
                                                <img alt="" src="<?= base_url() ?>img/pilotos/<?php echo $piloto->getFoto() ?>.jpg">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <div class="profile-desk">
                                                <h1><?php echo $piloto->getNombre() . " " . $piloto->getApellido(); ?></h1>
                                                <span class="text-muted"><?php echo $piloto->getEquipo()->getEscuderia(); ?></span>
                                                <ul>
                                                    <li>Pais : <?php echo $piloto->getPais() ?></li>
                                                    <li>Posicion mundial : <?php echo $piloto->getPosicionMundial() ?></li>
                                                    <li>Puntos mundial : <?php echo $piloto->getPuntosMundial() ?></li>
                                                </ul>

                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <div>
                                                <h4 class="text-center">Datos LF1</h4>
                                                <ul>
                                                    <li>Valor actual : <?php echo $piloto->getValorActual(true); ?></li>
                                                    <li>Valor anterior : <?php echo $piloto->getValorAnterior(true); ?></li>
                                                    <li>Cambio valor : <?php if ($piloto->getCambioValor() > 0):
   ?>
                                                        <i class="fa fa-angle-double-up" style="color: rgb(90, 157, 29); font-size: 16px;"></i>
                                                        <span style="color: rgb(90, 157, 29);">
                                                            <?php elseif ($piloto->getCambioValor() < 0) : ?>
                                                                <i class="fa fa-angle-double-down" style="color: rgb(255, 0, 0); font-size: 16px;"></i>
                                                                <span style="color: rgb(255, 0, 0);">
                                                                    <?php
                                                                else:
                                                                    ?>
                                                                    <i class="fa fa-minus" font-size: 16px;></i>
                                                                <?php
                                                                endif;
                                                                echo $piloto->getCambioValor(true) . "( " . $piloto->getCambioPorcentaje(true) . " )";
                                                                ?>
                                                            </span>

                                                    </li>
                                                    <li>Precio alquiler : <?php echo $piloto->getPrecioAlquiler(true); ?></li>
                                                    <li>Valor maximo : <?php echo $piloto->getValorMax(true); ?></li>
                                                    <li>Valor minimo : <?php echo $piloto->getValorMin(true); ?></li>
                                                    <li>Puntos manager conseguidos : <?php echo $piloto->getPuntosConseguidos(); ?></li>
                                                    <li>Dinero ganado : <?php echo $piloto->getDineroConseguido(true); ?></li>
                                                </ul>
                                            </div>
                                            <div class="btn-group-justified">                                                 
                                                <a class="btn btn-primary" href="<?php echo site_url() . 'mercado/ficharPiloto/' . $piloto->getIdPiloto(); ?>">Fichar</a>
                                                <a class="btn btn-primary" href="<?php echo site_url() . 'mercado/alquilarPiloto/' . $piloto->getIdPiloto(); ?>">Alquilar</a>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <div class="col-md-8">
                                <section class="panel">                                    
                                    <div class="col-md-12" id='grafica' data='<?php echo $piloto->getIdPiloto(); ?>'>
                                    </div>
                                </section>
                            </div>

                        </div>

                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
