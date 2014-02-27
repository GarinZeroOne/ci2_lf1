
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
                                                            Clasificaciones
                                                            <span class="tools pull-right">
                                                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                                                <a href="javascript:;" class="fa fa-cog"></a>
                                                                <a href="javascript:;" class="fa fa-times"></a>
                                                            </span>
                                                        </header>
                                                        <div class="panel-body">
                                                        </div>
                                                    </section>
                                                </div>
                                                </div>
                                                <!-- page end-->
                                                </section>
                                                </section>
                                                <!--main content end-->
