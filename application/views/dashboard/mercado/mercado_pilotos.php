
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <!-- Migas -->
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">                    
                    <li class="active"><a href="#"><i class="fa fa-home"></i> Mercado pilotos</a></li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <div class="panel-body">   
                        <p>Desde aquí podras fichar o alquilar a tus pilotos. El  precio de los pilotos puede variar todos los dias en función de la actividad que reciba un piloto, se tienen en  cuenta las ventas, compras y e inactividad (no compras/no ventas) de cada piloto.</p> 
                        <p>Los resultados de cada  gran premio también  harán variar el precio de los  pilotos.</p>
                    </div>
                </section>    
            </div>

        </div>

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Mercado Pilotos

                    </header>
                    <div class="panel-body">                       
                        <!-- Pilotos -->
                        <div class="row">

                            <div class="col-sm-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <?php if (isset($msgFichaje['codigoOperacion'])): ?>
                                            <?php if ($msgFichaje['codigoOperacion']): ?>
                                                <div class="alert alert-block alert-success fade in">                                            
                                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <?php echo $msgFichaje['mensaje']; ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="alert alert-block alert-danger fade in">                                            
                                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <strong>Opps!</strong> <?php echo $msgFichaje['mensaje']; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <section id="unseen">
                                            <table class="table table-bordered table-striped table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>Foto</th>
                                                        <th>Piloto</th>
                                                        <th class="numeric">Precio  Anterior</th>
                                                        <th class="numeric">Cambio</th>
                                                        <th class="numeric">Cambio %</th>
                                                        <th class="numeric">Precio actual</th>
                                                        <th class="numeric">Precio más alto</th>
                                                        <th class="numeric">Precio mas bajo</th>
                                                        <th class="numeric">Precio alquiler</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php foreach ($pilotos as $piloto): ?>   
                                                        <tr>
                                                            <td style="text-align: center;"><img style="border-radius: 50%; width: 50%; height: 32px;" alt="" src="<?= base_url() ?>img/pilotos/<?php echo $piloto->getFoto() ?>.jpg"></td>
                                                            <td><a href="<?php echo site_url() . 'mercado/fichaPiloto/' . $piloto->getIdPiloto(); ?>"><?php echo $piloto->getNombre() . " " . $piloto->getApellido(); ?></a></td>
                                                            <td class="numeric" style="background-color: rgb(255, 249, 239); color: rgb(188, 164, 108);"><?php echo $piloto->getValorAnterior(true); ?></td>
                                                            <td class="numeric"><?php
                                                                if ($piloto->getCambioValor() > 0):
                                                                    ?>
                                                                    <i class="fa fa-angle-double-up" style="color: rgb(90, 157, 29); font-size: 16px;"></i>
                                                                    <span style="color: rgb(90, 157, 29);">
                                                                    <?php elseif ($piloto->getCambioValor() < 0) : ?>
                                                                        <i class="fa fa-angle-double-down" style="color: rgb(255, 0, 0); font-size: 16px;"></i>
                                                                        <span style="color: rgb(255, 0, 0);">
                                                                            <?php
                                                                        else:
                                                                            ?>
                                                                            <i class="fa fa-angle-double-right" style="color: rgb(0, 96, 174); font-size: 16px;"></i>
                                                                            <span style="color: rgb(0, 96, 174);">
                                                                            <?php
                                                                            endif;
                                                                            echo $piloto->getCambioValor(true);
                                                                            ?>
                                                                        </span>
                                                                        </td>
                                                                        <td class="numeric"><?php
                                                                            if ($piloto->getCambioValor() > 0):
                                                                                ?>
                                                                                <i class="fa fa-angle-double-up" style="color: rgb(90, 157, 29); font-size: 16px;"></i>
                                                                                <span style="color: rgb(90, 157, 29);">
                                                                                <?php elseif ($piloto->getCambioValor() < 0) : ?>
                                                                                    <i class="fa fa-angle-double-down" style="color: rgb(255, 0, 0); font-size: 16px;"></i>
                                                                                    <span style="color: rgb(255, 0, 0);">
                                                                                        <?php
                                                                                    else:
                                                                                        ?>
                                                                                        <i class="fa fa-angle-double-right" style="color: rgb(0, 96, 174); font-size: 16px;"></i>
                                                                                        <span style="color: rgb(0, 96, 174);">
                                                                                        <?php
                                                                                        endif;
                                                                                        echo $piloto->getCambioPorcentaje(true);
                                                                                        ?>
                                                                                    </span>
                                                                                    </td>
                                                                                    <td class="numeric"><a href="<?php echo site_url() . 'mercado/ficharPiloto/' . $piloto->getIdPiloto(); ?>" class="btn btn-success btn-xs confirm"> <i class="fa fa-shopping-cart"></i> <?php echo $piloto->getValorActual(true); ?></a></td>
                                                                                    <td class="numeric" style="background-color: rgb(253, 242, 255); color: rgb(162, 122, 170);"><?php echo $piloto->getValorMax(true); ?></td>
                                                                                    <td class="numeric" style="background-color: rgb(255, 237, 237); color: rgb(191, 120, 120);"><?php echo $piloto->getValorMin(true); ?></td>
                                                                                    <td class="numeric"><a href="<?php echo site_url() . 'mercado/alquilarPiloto/' . $piloto->getIdPiloto(); ?> " class="btn btn-info btn-xs confirm"><i class="fa fa-flag-checkered"></i> <?php echo $piloto->getPrecioAlquiler(true); ?></a></td>                                                            
                                                                                    </tr>
                                                                                <?php endforeach; ?>

                                                                                </tbody>
                                                                                </table>
                                                                                </section>
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
