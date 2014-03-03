
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <?php print_r($MRData); ?>
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Circuito
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
                                        <div class="col-md-6 col-xs-6">
                                            <div class="img-circle">
                                                <img alt="" src="<?= base_url() ?>img/circuitos/banderas/<?php echo $circuito->getBandera() ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <div class="profile-desk">
                                                <h1><?php echo $circuito->getCircuito(); ?></h1>
                                                <span class="text-muted"><?php echo $circuito->getPais(); ?>
                                                    <br>                                                    
                                                    <?php echo $circuito->getFechaGp(); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">   
                                            <h4 class="text-center">Resultado <?php echo $ultimoGanador->RaceTable->season; ?></h4>
                                            <ul>
                                                <li>Podium :</li>
                                                <ol>
                                                    <li style="list-style: decimal"> <?php
                                                        $datosPiloto = $ultimoGanador->RaceTable->Races[0]->Results[0];
                                                        $datosSegundo = $segundo->RaceTable->Races[0]->Results[0];
                                                        $datosTercero = $tercero->RaceTable->Races[0]->Results[0];
                                                        echo $datosPiloto->Driver->givenName . " "
                                                        . $datosPiloto->Driver->familyName
                                                        . " (" . $datosPiloto->Constructor->name . " )";
                                                        ?>
                                                    </li>
                                                    <li style="list-style: decimal"> <?php
                                                        echo $datosSegundo->Driver->givenName . " "
                                                        . $datosSegundo->Driver->familyName
                                                        . " (" . $datosSegundo->Constructor->name . " )";
                                                        ?>
                                                    </li>
                                                    <li style="list-style: decimal"> <?php
                                                        echo $datosTercero->Driver->givenName . " "
                                                        . $datosTercero->Driver->familyName
                                                        . " (" . $datosTercero->Constructor->name . " )";
                                                        ?>
                                                    </li>
                                                </ol>
                                                <li>Tiempo : <?php echo $datosPiloto->Time->time; ?>
                                                </li>
                                                <li>Vuelta rápida : 
                                                    <?php
                                                    echo $datosPiloto->FastestLap->Time->time . " ( "
                                                    . $pilotoVueltaRapida->DriverTable->Drivers[0]->givenName
                                                    . " " . $pilotoVueltaRapida->DriverTable->Drivers[0]->familyName
                                                    . " )";
                                                    ?>
                                                </li>
                                                <li>Pole : 
                                                    <?php
                                                    echo $poleman->Driver->givenName .
                                                    " " . $poleman->Driver->familyName . " ( "
                                                    . $poleman->Q1
                                                    . " )";
                                                    ?>
                                                </li>
                                                <li><a href="<?php echo $ultimoGanador->RaceTable->Races[0]->url; ?>">Wikipedia</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </section>
                            </div>
                            <div class="col-md-7">                                                              
                                <div class="col-md-12">
                                    <img alt="" src="<?= base_url() ?>img/circuitos/trazados/<?php echo $circuito->getTrazado() ?>">
                                </div>                                
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
