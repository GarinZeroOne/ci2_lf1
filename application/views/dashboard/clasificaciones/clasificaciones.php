
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-6">
                <section class="panel">
                    <header class="panel-heading">
                        Clasificacion general
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
                                    <th class="numeric">Posicion</th>
                                    <th>Foto</th>
                                    <th>Usuario</th>
                                    <th class="numeric">Puntos</th>
                                    <th class="numeric">Cambio posicion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $miClasificacionGeneral->getPosicion(); ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <img style="border-radius: 50%; width: 50%; height: 32px;" alt="" src="<?= base_url() ?>img/avatares/<?php echo $miClasificacionGeneral->getUsuario()->getAvatar()->getAvatar() ?>">
                                    </td>
                                    <td>
                                        <?php echo $miClasificacionGeneral->getUsuario()->getNick(); ?>
                                    </td>
                                    <td>
                                        <?php echo $miClasificacionGeneral->getPuntos(); ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($miClasificacionGeneral->getCambioPosicion() > 0):
                                            ?>
                                            <i class="fa fa-angle-double-up" style="color: rgb(90, 157, 29); font-size: 16px;"></i>
                                            <span style="color: rgb(90, 157, 29);">
                                            <?php elseif ($miClasificacionGeneral->getCambioPosicion() < 0) : ?>
                                                <i class="fa fa-angle-double-down" style="color: rgb(255, 0, 0); font-size: 16px;"></i>
                                                <span style="color: rgb(255, 0, 0);">
                                                    <?php
                                                else:
                                                    ?>
                                                    <i class="fa fa-angle-double-right" style="color: rgb(0, 96, 174); font-size: 16px;"></i>
                                                    <span style="color: rgb(0, 96, 174);">
                                                    <?php
                                                    endif;
                                                    echo $miClasificacionGeneral->getCambioPosicion();
                                                    ?>
                                                </span>
                                                </td>
                                                </tr>

                                                <?php foreach ($clasificacionGeneral as $clasificacionUsuario): ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $clasificacionUsuario->getPosicion(); ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <img style="border-radius: 50%; width: 50%; height: 32px;" alt="" src="<?= base_url() ?>img/avatares/<?php echo $clasificacionUsuario->getUsuario()->getAvatar()->getAvatar() ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo $clasificacionUsuario->getUsuario()->getNick(); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $clasificacionUsuario->getPuntos(); ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($clasificacionUsuario->getCambioPosicion() > 0):
                                                                ?>
                                                                <i class="fa fa-angle-double-up" style="color: rgb(90, 157, 29); font-size: 16px;"></i>
                                                                <span style="color: rgb(90, 157, 29);">
                                                                <?php elseif ($clasificacionUsuario->getCambioPosicion() < 0) : ?>
                                                                    <i class="fa fa-angle-double-down" style="color: rgb(255, 0, 0); font-size: 16px;"></i>
                                                                    <span style="color: rgb(255, 0, 0);">
                                                                        <?php
                                                                    else:
                                                                        ?>
                                                                        <i class="fa fa-angle-double-right" style="color: rgb(0, 96, 174); font-size: 16px;"></i>
                                                                        <span style="color: rgb(0, 96, 174);">
                                                                        <?php
                                                                        endif;
                                                                        echo $clasificacionUsuario->getCambioPosicion();
                                                                        ?>
                                                                    </span>
                                                                    </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                                </tbody>
                                                                </table>
                                                                </div>
                                                                </section>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <section class="panel">
                                                                        <header class="panel-heading">
                                                                            Clasificacion Gp <?php echo $clasificacionGp->getCircuito()->getCircuito() . " ( " . $clasificacionGp->getCircuito()->getPais() . " )"; ?>
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
                                                                                        <th class="numeric">Posicion</th>
                                                                                        <th>Foto</th>
                                                                                        <th>Usuario</th>
                                                                                        <th class="numeric">Puntos</th>                                                                        
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <?php echo $miClasificacionGp->getPosicion(); ?>
                                                                                        </td>
                                                                                        <td style="text-align: center;">
                                                                                            <img style="border-radius: 50%; width: 50%; height: 32px;" alt="" src="<?= base_url() ?>img/avatares/<?php echo $miClasificacionGp->getUsuario()->getAvatar()->getAvatar(); ?>">
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $miClasificacionGp->getUsuario()->getNick(); ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $miClasificacionGp->getPuntos(); ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php foreach ($clasificacionGp->getClasificacionUsuarios() as $clasificacionUsuario): ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <?php echo $clasificacionUsuario->getPosicion(); ?>
                                                                                            </td>
                                                                                            <td style="text-align: center;">
                                                                                                <img style="border-radius: 50%; width: 50%; height: 32px;" alt="" src="<?= base_url() ?>img/avatares/<?php echo $clasificacionUsuario->getUsuario()->getAvatar()->getAvatar() ?>">
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php echo $clasificacionUsuario->getUsuario()->getNick(); ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php echo $clasificacionUsuario->getPuntos(); ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                    <?php endforeach; ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </section>
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <section class="panel">
                                                                            <header class="panel-heading">
                                                                                Clasificacion Mundial
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
                                                                                            <th class="numeric">Posicion</th>
                                                                                            <th>Foto</th>
                                                                                            <th>Piloto</th>
                                                                                            <th class="numeric">Puntos</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php foreach ($clasificacionMundial as $piloto): ?>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <?php echo $piloto->getPosicionMundial(); ?>
                                                                                                </td>
                                                                                                <td style="text-align: center;">
                                                                                                    <img style="border-radius: 50%; width: 50%; height: 32px;" alt="" src="<?= base_url() ?>img/pilotos/<?php echo $piloto->getFoto() . ".jpg" ?>">
                                                                                                </td>
                                                                                                <td>
                                                                                                    <?php echo $piloto->getNombre() . " " . $piloto->getApellido(); ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <?php echo $piloto->getPuntosMundial(); ?>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php endforeach; ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </section>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <section class="panel">
                                                                            <header class="panel-heading">                                                                
                                                                                Clasificacion Gp Pilotos <?php echo $clasificaionGpPiloto->getCircuito()->getCircuito() . " ( " . $clasificaionGpPiloto->getCircuito()->getPais() . " )"; ?>
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
                                                                                            <th class="numeric">Posicion</th>
                                                                                            <th>Foto</th>
                                                                                            <th>Usuario</th>
                                                                                            <th class="numeric">Puntos</th>                                                                        
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php
                                                                                        foreach ($clasificaionGpPiloto->getClasificacionPilotos() as $clasificacionPiloto):
                                                                                            if ($clasificacionPiloto->getPosicionGp() != 0):
                                                                                                ?>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <?php echo $clasificacionPiloto->getPosicionGp(); ?>
                                                                                                    </td>
                                                                                                    <td style="text-align: center;">
                                                                                                        <img style="border-radius: 50%; width: 50%; height: 32px;" alt="" src="<?= base_url() ?>img/pilotos/<?php echo $clasificacionPiloto->getFoto() . ".jpg"; ?>">
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php echo $clasificacionPiloto->getNombre() . " " . $clasificacionPiloto->getApellido(); ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php echo $clasificacionPiloto->getPuntosGp(); ?>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <?php
                                                                                            endif;
                                                                                        endforeach;
                                                                                        ?>
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
