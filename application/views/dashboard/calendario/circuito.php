
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->

        <!-- publi row -->
        <div class="row">
            <div class="col-lg-12 hidden-md">
                <section class="panel-pub">
                    <div class="panel-body">
                        <div class="pub-cont">

                            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- HorizontalGrande2014 -->
                            <ins class="adsbygoogle"
                                 style="display:inline-block;width:970px;height:90px"
                                 data-ad-client="ca-pub-2361705659034560"
                                 data-ad-slot="7256510330"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>

                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- publi row -->

        <?php print_r($MRData); ?>

        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo site_url(); ?>calendario"><i class="fa fa-home"></i> Calendario</a></li>
                    <li class="active"><a href="#"> <?php echo $circuito->getCircuito(); ?></a></li>

                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Circuito

                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <!-- Cabecera grupo -->
                            <div class="col-md-5">
                                <section class="panel">
                                    <div class="panel-body profile-information">
                                        <div class="col-md-6 col-xs-6">
                                            <div class="img-circle">
                                                <img  alt="" src="<?= base_url() ?>img/circuitos/banderas/<?php echo $circuito->getBandera() ?>">
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
                                            <section class="panel">
                                                <header class="panel-heading-circuito">
                                                    Resultado <?php echo $ultimoGanador->RaceTable->season; ?>

                                                </header>
                                                <div class="panel-body-circuito">   

                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Piloto</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1º</td>
                                                                <td><?php
                                                                    $datosPiloto = $ultimoGanador->RaceTable->Races[0]->Results[0];
                                                                    $datosSegundo = $segundo->RaceTable->Races[0]->Results[0];
                                                                    $datosTercero = $tercero->RaceTable->Races[0]->Results[0];
                                                                    if (isset($datosPiloto->Driver)) {
                                                                        echo $datosPiloto->Driver->givenName . " "
                                                                        . $datosPiloto->Driver->familyName
                                                                        . " (" . $datosPiloto->Constructor->name . " )";
                                                                    }
                                                                    ?></td>

                                                            </tr>
                                                            <tr>
                                                                <td>2º</td>
                                                                <td><?php
                                                                    if (isset($datosPiloto->Driver)) {
                                                                        echo $datosSegundo->Driver->givenName . " "
                                                                        . $datosSegundo->Driver->familyName
                                                                        . " (" . $datosSegundo->Constructor->name . " )";
                                                                    }
                                                                    ?></td>

                                                            </tr>
                                                            <tr>
                                                                <td>3º</td>
                                                                <td><?php
                                                                    if (isset($datosPiloto->Driver)) {
                                                                        echo $datosTercero->Driver->givenName . " "
                                                                        . $datosTercero->Driver->familyName
                                                                        . " (" . $datosTercero->Constructor->name . " )";
                                                                    }
                                                                    ?></td>

                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <ul>


                                                        <li><strong>Tiempo :</strong> <?php echo $datosPiloto->Time->time; ?>
                                                        </li>
                                                        <li><strong>Vuelta rápida :</strong> 
                                                            <?php
                                                            if (isset($datosPiloto->Driver)) {
                                                                echo $datosPiloto->FastestLap->Time->time . " ( "
                                                                . $pilotoVueltaRapida->DriverTable->Drivers[0]->givenName
                                                                . " " . $pilotoVueltaRapida->DriverTable->Drivers[0]->familyName
                                                                . " )";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li><strong>Pole : </strong>
                                                            <?php
                                                            if (isset($datosPiloto->Driver)) {
                                                                echo $poleman->Driver->givenName .
                                                                " " . $poleman->Driver->familyName . " ( "
                                                                . $poleman->Q1
                                                                . " )";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>                                                            
                                                            <?php
                                                            if (isset($datosPiloto->Driver)) :
                                                                ?>
                                                                <a href = "<?php echo $ultimoGanador->RaceTable->Races[0]->url; ?>">Wikipedia</a></li>
                                                            <?php
                                                        endif;
                                                        ?>
                                                    </ul>
                                                </div>
                                            </section>

                                        </div>

                                    </div>
                                </section>
                            </div>
                            <div class="col-md-7">                                                              
                                <div class="col-md-12">
                                    <img   class="img-trazado" alt="Trazado del circuito" src="<?= base_url() ?>img/circuitos/trazados/<?php echo $circuito->getTrazado() ?>">
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
