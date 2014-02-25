
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
                                                <ul>
                                                    <li>Valor actual : <?php echo $equipo->getValorActual(true); ?></li>
                                                    <li>Valor anterior : <?php echo $equipo->getValorAnterior(true); ?></li>
                                                    <li>Cambio valor : <?php if ($equipo->getCambioValor() > 0):
                                                            ?>
                                                            <i class="fa fa-angle-double-up" style="color: rgb(90, 157, 29); font-size: 16px;"></i>
                                                            <span style="color: rgb(90, 157, 29);">
                                                            <?php elseif ($equipo->getCambioValor() < 0) : ?>
                                                                <i class="fa fa-angle-double-down" style="color: rgb(255, 0, 0); font-size: 16px;"></i>
                                                                <span style="color: rgb(255, 0, 0);">
                                                                    <?php
                                                                else:
                                                                    ?>
                                                                    <i class="fa fa-minus" font-size: 16px;></i>
                                                                <?php
                                                                endif;
                                                                echo $equipo->getCambioValor(true) . "( " . $equipo->getCambioPorcentaje(true) . " )";
                                                                ?>
                                                            </span>

                                                    </li>                                                    
                                                    <li>Valor maximo : <?php echo $equipo->getValorMax(true); ?></li>
                                                    <li>Valor minimo : <?php echo $equipo->getValorMin(true); ?></li>
                                                    <li>Puntos manager conseguidos : <?php echo $equipo->getPuntosConseguidos(); ?></li>
                                                    <li>Dinero ganado : <?php echo $equipo->getDineroConseguido(true); ?></li>
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
