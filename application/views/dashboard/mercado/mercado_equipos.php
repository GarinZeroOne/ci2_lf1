
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
                    <header class="panel-heading">
                        Compra  equipos
                        
                    </header>
                    <div class="panel-body">   
                        <p>Texto compra equipos</p>
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
                        Mercado equipos
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        
                        <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>Equipo</th>
                                        <th class="numeric">Precio  Anterior</th>
                                        <th class="numeric">Cambio</th>
                                        <th class="numeric">Cambio %</th>
                                        <th class="numeric">Precio actual</th>
                                        <th class="numeric">Precio más alto</th>
                                        <th class="numeric">Precio mas bajo</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($equipos as $equipo): ?>   
                                        <tr>
                                            <td><a href="<?php echo site_url() . 'mercado/fichaEquipo/' . $equipo->getIdEquipo(); ?>"><?php echo $equipo->getEscuderia(); ?></a></td>
                                            <td class="numeric"><?php echo $equipo->getValorAnterior(true); ?></td>
                                            <td class="numeric"><?php
                                                if ($equipo->getCambioValor() > 0):
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
                                                        echo $equipo->getCambioValor(true);
                                                        ?>
                                                    </span>
                                            </td>
                                            <td class="numeric"><?php
                                                if ($equipo->getCambioValor() > 0):
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
                                                        echo $equipo->getCambioPorcentaje(true);
                                                        ?>
                                                    </span>
                                            </td>
                                            <td class="numeric"><a href="<?php echo site_url() . 'mercado/comprarEquipo/' . $equipo->getIdEquipo(); ?>" class="btn btn-success btn-xs confirm">
                                                <i class="fa fa-shopping-cart"></i>
                                                <?php echo $equipo->getValorActual(true); ?></a></td>
                                            <td class="numeric"><?php echo $equipo->getValorMax(true); ?></td>
                                            <td class="numeric"><?php echo $equipo->getValorMin(true); ?></td>                                                                                                                        
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
