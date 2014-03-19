
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
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
        
        <!-- page start-->
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li class="active"><a href="#"><i class="fa fa-home"></i> Calendario</a></li>
                        
                    </ul>
                    <!--breadcrumbs end -->
            </div>
        </div>

        <div class="row">
        <?php foreach ($circuitos as $circuito): ?>
            <div class="col-lg-4 col-md-4">
                <div class="mini-stat clearfix">
                    <span class="col-lg-3 col-md-4">
                        <img class="round-pilots-big"  alt="" src="<?= base_url() ?>img/circuitos/banderas/<?php echo $circuito->getBandera(); ?>"></span>
                    <div class="col-lg-9 col-md-12">
                        <div><a href="<?php echo site_url(); ?>calendario/circuito/<?php echo $circuito->getIdCircuito();?>"><?php echo $circuito->getCircuito();?></a></div>
                        <span class="cal-pais-txt"><?php echo $circuito->getPais(); ?></span><span class="cal-fecha"> <?php echo $circuito->getFechaGp(); ?></span>
                    </div>
                </div>
            </div>
            
            
            
            
        <?php endforeach; ?>
        </div>
    
    <!--
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
    -->
        <!-- page end-->
    </section>
</section>
<!--main content end-->
