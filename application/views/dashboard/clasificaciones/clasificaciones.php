
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Grandes premios

                    </header>
                    <div class="panel-body"> 
                        <table class="table table-bordered table-striped table-condensed"><tbody>
                                <tr>
                                    <?php foreach ($circuitos as $circuito): ?>
                                        <td style="text-align: center">
                                            <?php if ($circuito->getFechaGp() < date('Y-m-d')): ?>
                                                <a  title="Ver clasificacion <?php echo $circuito->getCircuito() . " ( " . $circuito->getPais() . " )"; ?>" href="<?php echo site_url() . 'clasificaciones/clasificacionGp/' . $circuito->getIdCircuito(); ?>">
                                                    <img class="round-pilots" alt="" src="<?= base_url() ?>img/circuitos/banderas/<?php echo $circuito->getBandera() ?>">
                                                </a>
                                            <?php else: ?>
                                                <img class="desaturada round-pilots" 
                                                     alt="" src="<?= base_url() ?>img/circuitos/banderas/<?php echo $circuito->getBandera() ?>"
                                                     title="Gp <?php echo $circuito->getCircuito() . " ( " . $circuito->getPais() . " )"; ?> no disputado">
                                                 <?php endif; ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                        </table>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <section class="panel">
                    <header class="panel-heading">
                        Clasificacion general

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
                                <tr class="mi-posicion">
                                    <td class="rank-posicion">
                                        <?php echo $miClasificacionGeneral->getPosicion(); ?>º
                                    </td>
                                    <td style="text-align: center;">
                                        <img class="round-pilots"  alt="" src="<?= base_url() ?>img/avatares/<?php echo $miClasificacionGeneral->getUsuario()->getAvatar()->getAvatar() ?>">
                                    </td>
                                    <td>                                        
                                        <a href="<?php echo site_url(); ?>perfil/ver/<?php echo $miClasificacionGeneral->getUsuario()->getNick(); ?>"><?php echo $miClasificacionGeneral->getUsuario()->getNick(); ?></a>
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
                                                        <td class="rank-posicion">
                                                            <?php echo $clasificacionUsuario->getPosicion(); ?>º
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <img class="round-pilots"  alt="" src="<?= base_url() ?>img/avatares/<?php echo $clasificacionUsuario->getUsuario()->getAvatar()->getAvatar() ?>">
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo site_url(); ?>perfil/ver/<?php echo $clasificacionUsuario->getUsuario()->getNick(); ?>"><?php echo $clasificacionUsuario->getUsuario()->getNick(); ?></a>
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
                                                                <div class="col-sm-4">
                                                                    <section class="panel">
                                                                        <header class="panel-heading">
                                                                            Clasificacion Mundial pilotos

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
                                                                                            <td class="rank-posicion">
                                                                                                <?php echo $piloto->getPosicionMundial(); ?>º
                                                                                            </td>
                                                                                            <td style="text-align: center;">
                                                                                                <img class="round-pilots"  alt="" src="<?= base_url() ?>img/pilotos/<?php echo $piloto->getFoto() . ".jpg" ?>">
                                                                                            </td>
                                                                                            <td>
                                                                                                <a href="<?php echo site_url() . 'mercado/fichaPiloto/' . $piloto->getIdPiloto(); ?>"><?php echo $piloto->getNombre() . " " . $piloto->getApellido(); ?></a>
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
                                                                <div class="col-sm-3">
                                                                    <section class="panel">
                                                                        <header style="text-align: center;" class="panel-heading">
                                                                            Clasificacion Mundial constructores

                                                                        </header>
                                                                        <div class="panel-body">
                                                                            <table class="table table-bordered table-striped table-condensed">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="numeric">Posicion</th>
                                                                                        <th>Equipo</th>
                                                                                        <th class="numeric">Puntos</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php foreach ($clasificacionMundialEquipos as $equipo): ?>
                                                                                        <tr>
                                                                                            <td class="rank-posicion">
                                                                                                <?php echo $equipo->getPosicionMundial(); ?>º
                                                                                            </td>
                                                                                            <td>
                                                                                                <a href="<?php echo site_url() . 'mercado/fichaEquipo/' . $equipo->getIdEquipo(); ?>"><?php echo $equipo->getEscuderia(); ?></a>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php echo $equipo->getPuntosMundial(); ?>
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
                                                                    <div class="col-sm-5">
                                                                        <section class="panel">
                                                                            <header class="panel-heading">
                                                                                Clasificacion Gp <?php echo $clasificacionGp->getCircuito()->getCircuito() . " ( " . $clasificacionGp->getCircuito()->getPais() . " )"; ?>
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
                                                                                        <tr class="mi-posicion">
                                                                                            <td class="rank-posicion">
                                                                                                <?php echo $miClasificacionGp->getPosicion(); ?>º
                                                                                            </td>
                                                                                            <td style="text-align: center;">
                                                                                                <img class="round-pilots" alt="" src="<?= base_url() ?>img/avatares/<?php echo $miClasificacionGp->getUsuario()->getAvatar()->getAvatar(); ?>">
                                                                                            </td>
                                                                                            <td>                                                                                            
                                                                                                <a href="<?php echo site_url(); ?>perfil/ver/<?php echo $miClasificacionGp->getUsuario()->getNick(); ?>"><?php echo $miClasificacionGp->getUsuario()->getNick(); ?></a>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?php echo $miClasificacionGp->getPuntos(); ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php foreach ($clasificacionGp->getClasificacionUsuarios() as $clasificacionUsuario): ?>
                                                                                            <tr>
                                                                                                <td class="rank-posicion">
                                                                                                    <?php echo $clasificacionUsuario->getPosicion(); ?>º
                                                                                                </td>
                                                                                                <td style="text-align: center;">
                                                                                                    <img class="round-pilots" alt="" src="<?= base_url() ?>img/avatares/<?php echo $clasificacionUsuario->getUsuario()->getAvatar()->getAvatar() ?>">
                                                                                                </td>
                                                                                                <td>
                                                                                                    <a href="<?php echo site_url(); ?>perfil/ver/<?php echo $clasificacionUsuario->getUsuario()->getNick(); ?>"><?php echo $clasificacionUsuario->getUsuario()->getNick(); ?></a>
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
                                                                    <div class="col-sm-4">
                                                                        <section class="panel">
                                                                            <header class="panel-heading">                                                                
                                                                                Clasificacion Gp Pilotos <?php echo $clasificaionGpPiloto->getCircuito()->getCircuito() . " ( " . $clasificaionGpPiloto->getCircuito()->getPais() . " )"; ?>

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
                                                                                        <?php
                                                                                        foreach ($clasificaionGpPiloto->getClasificacionPilotos() as $clasificacionPiloto):
                                                                                            if ($clasificacionPiloto->getPosicionGp() != 0):
                                                                                                ?>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <?php echo $clasificacionPiloto->getPosicionGp(); ?>
                                                                                                    </td>
                                                                                                    <td style="text-align: center;">
                                                                                                        <img class="round-pilots" alt="" src="<?= base_url() ?>img/pilotos/<?php echo $clasificacionPiloto->getFoto() . ".jpg"; ?>">
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <a href="<?php echo site_url() . 'mercado/fichaPiloto/' . $clasificacionPiloto->getIdPiloto(); ?>"><?php echo $clasificacionPiloto->getNombre() . " " . $clasificacionPiloto->getApellido(); ?></a>
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
                                                                    <div class="col-sm-3">
                                                                        <section class="panel">
                                                                            <header style="text-align: center;" class="panel-heading">                                                                
                                                                                Clasificacion Gp Constructores <?php echo $clasificaionGpPiloto->getCircuito()->getCircuito() . " <br>( " . $clasificaionGpPiloto->getCircuito()->getPais() . " )"; ?>

                                                                            </header>
                                                                            <div class="panel-body">
                                                                                <table class="table table-bordered table-striped table-condensed">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="numeric">Posicion</th>
                                                                                            <th>Piloto</th>
                                                                                            <th class="numeric">Puntos</th>                                                                        
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php
                                                                                        foreach ($clasificaionGpEquipos as $constructor):
                                                                                            foreach ($constructor->ConstructorStandings as $standings):
                                                                                                ?>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <?php echo $standings->positionText; ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php echo $standings->Constructor->name; ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php echo $standings->points; ?>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <?php
                                                                                            endforeach;
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
