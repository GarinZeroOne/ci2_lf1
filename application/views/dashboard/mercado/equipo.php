
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <!-- Migas -->
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo site_url(); ?>mercado/equipos"><i class="fa fa-home"></i> Mercado equipos</a></li>
                    <li class="active"><a href="#"> Ficha <?php echo $equipo->getEscuderia(); ?></a></li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Ficha equipo
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">                       
                        <div class="row">

                            <!-- Cabecera grupo -->
                            <div class="col-md-5">
                                <section class="panel">
                                    <div class="panel-body profile-information">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="img-thumbnail">
                                                <img alt="" src="<?= base_url() ?>img/equipos/<?php echo $equipo->getFoto() ?>.jpg">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <div class="profile-desk">
                                                <h1><?php echo $equipo->getEscuderia(); ?></h1>
                                                <ul>
                                                    <span class="text-muted"><?php
                                                        foreach ($equipo->getPilotos() as $piloto) {
                                                            echo "<li>" . $piloto->getNombre() . " " . $piloto->getApellido() . "</li>";
                                                        }
                                                        ?></span>                                                                                                   
                                                    <li>Posicion mundial : <?php echo $equipo->getPosicionMundial() ?></li>
                                                    <li>Puntos mundial : <?php echo $equipo->getPuntosMundial() ?></li>
                                                </ul>

                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <div>
                                                <h4 class="text-center">Datos LF1</h4>
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li><a href="javascript:;"><i class="fa fa-credit-card" style="margin-right: 4px"></i> Valor actual : <span style="margin: 0 0 0;" class="badge  pull-right r-activity"><?php echo $equipo->getValorActual(true); ?></span></a></li>
                                                    <li><a href="javascript:;"><i class="fa fa-credit-card" style="margin-right: 4px"></i> Valor anterior : <span style="margin: 0 0 0;" class="badge  pull-right r-activity"><?php echo $equipo->getValorAnterior(true); ?></span></a></li>
                                                    <li><a href="javascript:;"><i class="fa fa-tachometer" style="margin-right: 4px"></i> Cambio valor : <?php if ($equipo->getCambioValor() > 0):
                                                            ?>
                                                                <span style="margin: 0 0 0;" class="badge label-success2 pull-right r-activity">
                                                                    <i class="fa fa-angle-double-up" style="color: rgb(90, 157, 29);"></i>                                                            
                                                                <?php elseif ($equipo->getCambioValor() < 0) : ?>
                                                                    <span style="margin: 0 0 0;" class="badge label-danger pull-right r-activity">
                                                                        <i class="fa fa-angle-double-down" style="color: rgb(255, 0, 0);"></i>                                                                
                                                                        <?php
                                                                    else:
                                                                        ?>
                                                                        <span style="margin: 0 0 0;" class="badge  pull-right r-activity">
                                                                            <i class="fa fa-angle-double-right" ></i>
                                                                        <?php
                                                                        endif;
                                                                        echo $equipo->getCambioValor(true) . "( " . $equipo->getCambioPorcentaje(true) . " )";
                                                                        ?>
                                                                        </a>
                                                                    </span>

                                                                    </li>                                                    
                                                                    <li><a href="javascript:;"><i class="fa fa-credit-card" style="margin-right: 4px"></i> Valor maximo : <span style="margin: 0 0 0;" class="badge  pull-right r-activity"><?php echo $equipo->getValorMax(true); ?></span></a></li>
                                                                    <li><a href="javascript:;"><i class="fa fa-credit-card" style="margin-right: 4px"></i> Valor minimo : <span style="margin: 0 0 0;" class="badge  pull-right r-activity"><?php echo $equipo->getValorMin(true); ?></span></a></li>
                                                                    <li><a href="javascript:;"><i class="fa fa-trophy" style="margin-right: 4px"></i> Puntos manager conseguidos : <span style="margin: 0 0 0;" class="badge label-warning pull-right r-activity"><?php echo $equipo->getPuntosConseguidos(); ?></span></a></li>
                                                                    <li><a href="javascript:;"><i class="fa fa-eur" style="margin-right: 4px"></i> Dinero ganado : <span style="margin: 0 0 0;" class="badge  pull-right r-activity"><?php echo $equipo->getDineroConseguido(true); ?></span></a></li>
                                                                    </ul>
                                                                    </div>
                                                                    <div class="btn-group-justified">                                                 
                                                                        <a class="btn btn-primary" href="<?php echo site_url() . 'mercado/comprarEquipo/' . $equipo->getIdEquipo(); ?>">Fichar</a>                                                
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    </section>
                                                                    </div>

                                                                    <div class="col-md-7">
                                                                        <section class="panel">                                    
                                                                            <div class="col-md-12" id='grafica' data='<?php echo $equipo->getIdEquipo(); ?>'>
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
