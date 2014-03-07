
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
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li style="vertical-align: middle;"><a href="javascript:;"><i class="fa fa-credit-card" style="margin-right: 4px"></i> Valor actual : <span style="margin: 0 0 0;" class="badge  pull-right r-activity"><?php echo $piloto->getValorActual(true); ?></span></a></li>
                                                    <li style="vertical-align: middle;"><a href="javascript:;"><i class="fa fa-credit-card" style="margin-right: 4px"></i> Valor anterior : <span style="margin: 0 0 0;" class="badge  pull-right r-activity"><?php echo $piloto->getValorAnterior(true); ?></span></a></li>
                                                    <li style="vertical-align: middle;"><a href="javascript:;"><i class="fa fa-tachometer" style="margin-right: 4px"></i> Cambio valor : <?php if ($piloto->getCambioValor() > 0): ?>
                                                        <span class="badge label-success2 pull-right r-activity" style="margin: 0 0 0;">
                                                            <i class="fa fa-angle-double-up" style="color: rgb(90, 157, 29);"></i>

                                                            <?php elseif ($piloto->getCambioValor() < 0) : ?>
                                                                <span class="badge label-danger pull-right r-activity" style="margin: 0 0 0;">
                                                                    <i class="fa fa-angle-double-down" style="color: rgb(255, 0, 0);"></i>                                                                
                                                                    <?php
                                                                else:
                                                                    ?>
                                                                    <span class="badge  pull-right r-activity" style="margin: 0 0 0;">
                                                                        <i class="fa fa-angle-double-right" ></i>
                                                                    <?php
                                                                    endif;
                                                                    echo $piloto->getCambioValor(true) . "( " . $piloto->getCambioPorcentaje(true) . " )";
                                                                    ?>
                                                                        </a>
                                                                </span>

                                                                </li>
                                                                <li style="vertical-align: middle;"><a href="javascript:;"><i class="fa fa-credit-card" style="margin-right: 4px"></i> Precio alquiler : <span style="margin: 0 0 0;" class="badge  pull-right r-activity"><?php echo $piloto->getPrecioAlquiler(true); ?></span></a></li>
                                                                <li style="vertical-align: middle;"><a href="javascript:;"><i class="fa fa-eur" style="margin-right: 4px"></i> Valor maximo : <span style="margin: 0 0 0;" class="badge  pull-right r-activity"><?php echo $piloto->getValorMax(true); ?></span></a></li>
                                                                <li style="vertical-align: middle;"><a href="javascript:;"><i class="fa fa-eur" style="margin-right: 4px"></i> Valor minimo : <span style="margin: 0 0 0;" class="badge  pull-right r-activity"><?php echo $piloto->getValorMin(true); ?></span></a></li>
                                                                <li style="vertical-align: middle;"><a href="javascript:;"><i class="fa fa-trophy" style="margin-right: 4px"></i> Puntos manager conseguidos : <span style="margin: 0 0 0;" class="badge label-warning pull-right r-activity"><?php echo $piloto->getPuntosConseguidos(); ?></span></a></li>
                                                                <li style="vertical-align: middle;"><a href="javascript:;"> <i class="fa fa-eur" style="margin-right: 4px"></i> Dinero ganado : <span style="margin: 0 0 0;" class="badge  pull-right r-activity"><?php echo $piloto->getDineroConseguido(true); ?></span></a></li>
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
