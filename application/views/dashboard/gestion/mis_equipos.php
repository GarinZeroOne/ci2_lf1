
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Mis equipos
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="row">            
                            <?php
                            $contador = 0;
                            $segundoDiv = false;
                            foreach ($equipos as $equipo):
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
                                                <a title="Vender este piloto" href="<?php echo site_url() . 'gestion/venderEquipo/' . $equipo->getIdEquipo(); ?>"><i class="fa fa-sign-out"></i></a>
                                            </div>
                                            <div class="user-heading alt gray-bg ">
                                                <div class="col-sm-12">
                                                    <a href="#">
                                                        <img alt="" src="<?= base_url() ?>img/equipos/<?php echo $equipo->getFoto() ?>.jpg">
                                                    </a>
                                                </div>
                                                <h1><?php echo $equipo->getEscuderia(); ?></h1>
                                                <p>
                                                    <?php
                                                    foreach ($equipo->getPilotos() as $piloto) {
                                                        echo $piloto->getNombre() . " " . $piloto->getApellido() . "<br>";
                                                    }
                                                    ?>
                                                </p>
                                            </div>

                                            <ul class="nav nav-pills nav-stacked">
                                                <li><a href="javascript:;"> <i class="fa fa-credit-card"></i> 
                                                        Precio Compra 
                                                        <span class="badge  pull-right r-activity">
                                                            <?php
                                                            echo $equipo->getPrecioCompra(true);
                                                            ?>
                                                        </span>
                                                    </a>
                                                </li>     
                                                <li><a href="javascript:;"> <i class="fa fa-credit-card"></i> 
                                                        Precio Actual 
                                                        <span class="badge  pull-right r-activity">
                                                            <?php
                                                            echo $equipo->getValorActual(true);
                                                            ?>
                                                        </span>
                                                    </a>
                                                </li>  
                                                <li>
                                                    <a href="javascript:;"> <i class="fa fa-tachometer"></i> Ganancia/Perdida     
                                                        <?php if ($equipo->getGananciaPerdida() > 0): ?>
                                                            <span class="badge label-success2 pull-right r-activity">
                                                                <i class="fa fa-angle-double-up" style="color: rgb(90, 157, 29); font-size: 16px;"></i>

                                                            <?php else: ?>
                                                                <span class="badge label-danger pull-right r-activity">
                                                                    <i class="fa fa-angle-double-right" style="color: rgb(0, 96, 174); font-size: 16px;"></i>

                                                                <?php endif; ?>
                                                                <?php
                                                                echo $equipo->getGananciaPerdida(true);
                                                                ?>
                                                            </span>
                                                    </a>
                                                </li>                                                
                                                <li>
                                                    <a href="javascript:;"> <i class="fa fa-trophy"></i> 
                                                        Puntos  <span class="badge label-warning pull-right r-activity"><?php echo $equipo->getPuntosConseguidos(true); ?></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"> <i class="fa fa-eur"></i> 
                                                        Dinero <span class="badge label-warning pull-right r-activity"><?php echo $equipo->getDineroConseguido(true); ?></span>
                                                    </a>
                                                </li>
                                            </ul>

                                        </section>
                                    </aside>
                                    <!--widget end-->

                                </div>

                                <?php
                            endforeach;
                            if (count($equipos) < 5):
                                for ($i = count($equipos); $i < 5; $i++):

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
                                                    <a title="Comprar equipo" href="<?php echo site_url() . 'mercado/equipos/'; ?>"><i class="fa fa-shopping-cart"></i></a>
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

                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
