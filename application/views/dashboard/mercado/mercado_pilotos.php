
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
        <div class="row">
            <div class="col-md-8">
                <section class="panel">
                    
                    <div class="panel-body">   
                        <p>Información mercado pilotos:</p>
                            <ul class="ulpilotos">
                                <li>El precio  de los pilotos <strong>varia a diario</strong> en función de las <strong>compras/ventas o inactividad</strong>  que haya recibido el dia anterior.</li>
                                <li>El precio de los pilotos variará despues  de cada Gran Premio en base a sus resultados.</li>
                                <li>Los <strong style="color:#60C8FF">pilotos alquilados</strong> correrán para ti el siguiente Gran Premio, conseguirás el dinero y los puntos que ganen.Una vez terminado el Gran Premio,el piloto ya no te pertenecerá. A los pilotos alquilados no se les puede poner ninguna clase  de STIKI ni se aprobecharán de las mejoras que tengas.</li>
                                <li>Los <strong style="color:#77AA3B">pilotos fichados</strong>, formarán parte continua de tu plantilla hasta que <strong>tú</strong> decidás venderlos.A estos se les puede añadir cualquier tipo de STIKI y podrán beneficiarse de tus mejoras</li>
                            </ul>
                        
                    </div>
                </section>    
            </div>

            <div class="col-md-4 hidden-sm">
                               
                <!--Ultimos fichajes start-->
                <section class="panel">
                    <header class="panel-heading">
                        Publicidad
                        
                    </header>
                    <div class="panel-body">
                        Contenido publicidad
                    </div>
                </section>
                <!--Ultimos fichajes end-->
                
            </div>

        </div>

        <?php if (isset($msgFichaje['codigoOperacion'])): ?>

            <div class="row">
                <div class="col-sm-12">
                <section class="panel">
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
                </section>
                </div>
            </div>
        <?php endif; ?>


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
                                                            <td style="text-align: center;"><img class="round-pilots" alt="" src="<?= base_url() ?>img/pilotos/<?php echo $piloto->getFoto() ?>.jpg"></td>
                                                            <td><a href="<?php echo site_url() . 'mercado/fichaPiloto/' . $piloto->getIdPiloto(); ?>"><?php echo $piloto->getNombre() . " " . $piloto->getApellido(); ?></a> <span class="team-subtit"><?php echo $piloto->getEquipo()->getEscuderia(); ?></span></td>
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
