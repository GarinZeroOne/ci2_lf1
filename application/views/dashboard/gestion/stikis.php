
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <?php if (isset($msg['codigoOperacion'])): ?>
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <?php if ($msg['codigoOperacion']): ?>
                            <div class="alert alert-block alert-success fade in">                                            
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <?php echo $msg['mensaje']; ?>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-block alert-danger fade in">                                            
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Opps!</strong> <?php echo $msg['mensaje']; ?>
                            </div>
                        <?php endif; ?>
                    </section>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-sm-5">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Comprar stiki
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Tipo Stiki</th>
                                    <th>Descripcion</th>
                                    <th class="numeric">Precio</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="<?php echo base_url() ?>img/stikidinero.png">
                                    </td>
                                    <td>
                                        Stiki multiplicador de dinero
                                    </td>
                                    <td>
                                        <?php
                                        if ($valorMejoraMecanicos > 0) {
                                            $coste = 30000;
                                            $coste_con_mejora = $coste - ($coste * $valorMejoraMecanicos);
                                        } else {
                                            $coste_con_mejora = $coste;
                                        }
                                        echo number_format($coste, 0, ',', '.') . " €<br><small style=\"color:#298A08\">" . number_format($coste_con_mejora, 0, ',', '.') . " € </small>";
                                        ?>
                                    </td>                                        
                                </tr>
                                <tr>
                                    <td>
                                        <img src="<?php echo base_url() ?>img/stikipuntos.png">
                                    </td>
                                    <td>
                                        Stiki multiplicador de puntos
                                    </td>
                                    <td>
                                        <?php
                                        if ($valorMejoraMecanicos > 0) {
                                            $coste = 400000;
                                            $coste_con_mejora = $coste - ($coste * $valorMejoraMecanicos);
                                        } else {
                                            $coste_con_mejora = $coste;
                                        }
                                        echo number_format($coste, 0, ',', '.') . " €<br><small style=\"color:#298A08\">" . number_format($coste_con_mejora, 0, ',', '.') . " € </small>";
                                        ?>
                                    </td>                                        
                                </tr>
                            </tbody>
                        </table>          
                        <div class="col-sm-12">
                            <aside class="profile-nav alt">
                                <section class="panel">                        
                                    <section class="panel">
                                        <div class="user-heading alt gray-bg">
                                            <a href="#">
                                                <img alt="" src="<?= base_url() ?>img/circuitos/banderas/<?php echo $circuito->getBandera() ?>">
                                            </a>
                                            <a style="border: none; color: #8B8B8B;" href="<?php echo site_url(); ?>calendario/circuito/<?php echo $circuito->getIdCircuito(); ?>">
                                                <h1><?php echo $circuito->getCircuito(); ?></h1>
                                            </a>                                            
                                            <p><?php echo $circuito->getPais(); ?></p>
                                        </div>
                                    </section>
                            </aside>
                        </div>
                        <div class="col-sm-12 img-thumbnail">
                            <form   method="post" action="<?= site_url() ?>gestion/comprarStiki" class="form-horizontal">
                                <input type="hidden" name="idGp" value="<?php echo $circuito->getIdCircuito() ?>">
                                <div class="col-sm-12" >
                                    <h4 style="display:block;">Selecciona el tipo de Stiki </h4>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="tipoStiki" value="dinero" checked>
                                            <img src="<?php echo base_url(); ?>img/stikidinero.png"> Stiki dinero
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="tipoStiki" value="puntos">
                                            <img src="<?php echo base_url(); ?>img/stikipuntos.png"> Stiki puntos
                                        </label>
                                    </div>

                                </div>

                                <div class="col-sm-12" style="margin-top: 20px;">
                                    <h4 style="display:block;">Selecciona el piloto </h4>

                                    <?php if (!$misPilotos) : ?>
                                        <span>No tienes pilotos</span>
                                    <?php endif; ?>

                                    <?php foreach ($misPilotos as $piloto): ?>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="piloto" value="<?php echo $piloto->getIdPiloto(); ?>">
                                                <div class="row">
                                                    <div class="col-sm-3" style="text-align: center">
                                                        <img style="border-radius: 50%; width: 60%;" src="<?php echo base_url(); ?>img/pilotos/<?php echo $piloto->getFoto(); ?>.jpg"> 
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <?php echo $piloto->getNombre() . " " . $piloto->getApellido() . "<br><small> " . $piloto->getEquipo()->getEscuderia() . " </small>"; ?>

                                                    </div>
                                                </div> 


                                            </label>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                                <div class="col-sm-12" style="margin-top: 20px; text-align: center;">
                                    <input type="submit" value="Comprar stiki seleccionado" class="btn btn-large btn-primary">
                                </div>


                            </form>
                        </div>
                    </div>
                </section>
            </div>    
        </div>
        <div class="col-sm-7">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Stikis <?php echo $circuito->getCircuito() . " ( " . $circuito->getPais() . " )"; ?>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Tipo Stiki</th>
                                    <th>Piloto</th>
                                    <th class="numeric">Precio venta</th>                                    
                                    <th>Fecha compra</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stikisGp as $stiki): ?>
                                    <tr>
                                        <td>
                                            <?php if ($stiki->getTipoStiki() == 'puntos'): ?>
                                                <img src="<?php echo base_url() ?>img/stikipuntos.png">
                                            <?php else: ?>
                                                <img src="<?php echo base_url() ?>img/stikidinero.png">
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-3" style="text-align: center">
                                                    <img style="border-radius: 50%; width: 100%; height: 20%;" src="<?php echo base_url(); ?>img/pilotos/<?php echo $stiki->getPiloto()->getFoto(); ?>.jpg"> 
                                                </div>
                                                <div class="col-sm-9">
                                                    <?php echo $stiki->getPiloto()->getNombre() . " " . $stiki->getPiloto()->getApellido() . "<br><small>" . $stiki->getPiloto()->getEquipo()->getEscuderia() . "</small>"; ?>

                                                </div>
                                            </div>                                                                                        
                                        </td>
                                        <td style="vertical-align: middle">
                                            <a href="<?php echo site_url() . 'gestion/venderStiki/' . $stiki->getIdStiki(); ?>" class="btn btn-success btn-xs confirm"> <i class="fa fa-sign-out"></i> <?php echo $stiki->getPrecioCompra(true); ?></a>
                                        </td>            
                                        <td style="vertical-align: middle">
                                            <?php echo $stiki->getFechaCompra(); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>  
                            </tbody>
                        </table>                        
                    </div>
                </section>
            </div>
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Historial stikis
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Tipo Stiki</th>
                                    <th>Piloto</th>
                                    <th class="numeric">Precio compra</th>                                    
                                    <th>Fecha compra</th>
                                    <th style="text-align: center">Circuito</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($historialStikis as $stiki): ?>
                                    <?php if ($stiki->getCircuito()->getIdCircuito() != $circuito->getIdCircuito()): ?>
                                        <tr>
                                            <td>
                                                <?php if ($stiki->getTipoStiki() == 'puntos'): ?>
                                                    <img src="<?php echo base_url() ?>img/stikipuntos.png">
                                                <?php else: ?>
                                                    <img src="<?php echo base_url() ?>img/stikidinero.png">
                                                <?php endif; ?>
                                            </td>
                                            <td>     
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <img style="border-radius: 50%; width: 95%; height: 40%;" src="<?php echo base_url(); ?>img/pilotos/<?php echo $stiki->getPiloto()->getFoto(); ?>.jpg"> 
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <?php echo $stiki->getPiloto()->getNombre() . " " . $stiki->getPiloto()->getApellido() . "<br><small>" . $stiki->getPiloto()->getEquipo()->getEscuderia() . "</small>"; ?>

                                                    </div>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle">
                                                <?php echo $stiki->getPrecioCompra(true); ?>
                                            </td>            
                                            <td style="vertical-align: middle">
                                                <?php echo $stiki->getFechaCompra(); ?>
                                            </td>
                                            <td style="vertical-align: middle; text-align: center">
                                                <img style="border-radius: 50%; width: 30%; height: 20%;" 
                                                     src="<?php echo base_url() ?>img/circuitos/banderas/<?php echo $stiki->getCircuito()->getBandera(); ?>"
                                                     title="<?php echo $stiki->getCircuito()->getCircuito() . " ( " . $stiki->getCircuito()->getPais() . " )"; ?>">
                                            </td>
                                        </tr>
                                    <?php endif; ?>  
                                <?php endforeach; ?>  
                            </tbody>
                        </table>                        
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
