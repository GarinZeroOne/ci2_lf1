
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Calendario
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
                                    <th style="text-align: center"></th>
                                    <th style="text-align: center">Circuito</th>
                                    <th>Pais</th>
                                    <th>Fecha</th>                                                                        
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($circuitos as $circuito): ?>
                                    <tr>
                                        <td style="text-align: center">
                                            <img style="border-radius: 50%; width: 10%; height: 10%;" alt="" src="<?= base_url() ?>img/circuitos/banderas/<?php echo $circuito->getBandera(); ?>">
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="<?php echo site_url(); ?>calendario/circuito/<?php echo $circuito->getIdCircuito();?>"><?php echo $circuito->getCircuito();?></a>
                                        </td>
                                        <td>
                                            <?php echo $circuito->getPais(); ?>
                                        </td>
                                        <td>
                                            <?php echo $circuito->getFechaGp(); ?>
                                        </td>
                                    </tr>
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
