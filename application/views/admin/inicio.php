<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
        <link rel="shortcut icon" href="<?= base_url(); ?>/images/favicon.html">

        <title><?php echo $titulo; ?></title>

        <!--Core CSS -->
        <link href="<?= base_url(); ?>/bs3/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>/css/dashboard/bootstrap-reset.css" rel="stylesheet">
        <link href="<?= base_url(); ?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="<?= base_url(); ?>/css/dashboard/style.css" rel="stylesheet">
        <link href="<?= base_url(); ?>/css/dashboard/style-responsive.css" rel="stylesheet" />

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="js/ie8/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <?php
        foreach($estilos as $estilo){
        echo '<link rel="stylesheet" href="'.base_url().'/css/dashboard/'.$estilo.'" type="text/css" />';
        }
        ?>



        <script type="text/javascript">
            base_url = '<?= base_url(); ?>';
            site_url = '<?= site_url(); ?>';
        </script>

    </head>

    <body>

        <section id="container" >
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Carga los circuitos del año (Solo ejecutar al inicio del mundial, una vez)
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-cog"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                        </header>
                        <div class="panel-body"> 
                            <form method="post" action="<?= site_url() ?>admin/guardarCircuitos">

                                <table>
                                    <tr>
                                        <td>Temporada:</td>
                                        <td>
                                            <select name="season">
                                                <?php
                                                for ($i = 2013;
                                                $i <= 2025;
                                                $i++):
                                                ?>
                                                <option value="<?= $i ?>"> <?= $i; ?></option>
                                                <?php endfor; ?>

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center"> <input type="submit" value="Guardar Circuitos"></td>
                                    </tr>
                                </table>

                            </form>
                        </div>
                    </section>
                </div>                
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Guarda los resultados del Gp
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-cog"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                        </header>
                        <div class="panel-body"> 
                            <form method="post" action="<?= site_url() ?>admin/guardarResultados">

                                <table>
                                    <tr>
                                        <td>Temporada:</td>
                                        <td>
                                            <select name="season">
                                                <?php
                                                for ($i = 2013;
                                                $i <= 2025;
                                                $i++):
                                                ?>
                                                <option value="<?= $i ?>"> <?= $i; ?></option>
                                                <?php endfor; ?>

                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Sel.Circuito:</td>
                                        <td>
                                            <select name="gpNumber">
                                                <?php
                                                foreach ($circuitos as $gp):
                                                ?>
                                                <option value="<?= $gp->id ?>"> <?= $gp->circuito . " (" . $gp->pais . ")"; ?></option>
                                                <?
                                                endforeach;
                                                ?>

                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" align="center"> <input type="submit" value="Guardar Resultado Gp"></td>
                                    </tr>
                                </table>

                                <?php
                                echo $msgResultados;
                                ?>
                            </form>
                        </div>
                    </section>
                </div>                
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Modifica los precios con los resultados del Gp
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-cog"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                        </header>
                        <div class="panel-body"> 
                            <form method="post" action="<?= site_url() ?>admin/procesarPreciosPostGp">

                                <table>

                                    <tr>
                                        <td colspan="2" align="center"> <input type="submit" value="Procesar valor pilotos"></td>
                                    </tr>
                                </table>
                                <?php
                                echo $msgClasificacion;
                                ?>
                            </form>
                        </div>
                    </section>
                </div>                
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Genera los resultados de los usuarios
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-cog"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                        </header>
                        <div class="panel-body"> 
                            <?php
                            $usuariosXejec = 300;
                            $contador = 0;
                            echo "<br>".$msgProcesadoUsuario;
                            while($contador <= $numeroUsuarios):
                            ?>

                            <form method="post" action="<?= site_url() ?>admin/procesarResultadosUsuarios/<?php echo $contador; ?>/<?php echo $usuariosXejec; ?>">

                                <table>

                                    <tr>
                                        <td colspan="2" align="center"> <input type="submit" value="Procesar resultados usuario <?php echo $contador + $usuariosXejec; ?>"></td>
                                    </tr>
                                </table>

                            </form>

                            <?php
                            $contador += $usuariosXejec;
                            endwhile;
                            ?>
                        </div>
                    </section>
                </div>                
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Generar clasificaciones de usuarios (Desactiva alquilados - Marca Gp procesado)
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-cog"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                        </header>
                        <div class="panel-body"> 
                            <?php echo $msgProcesarClas;?>
                            <form method="post" action="<?= site_url() ?>admin/procesarClasificacion">

                                <table>
                                    <tr>
                                        <td colspan="2" align="center"> <input type="submit" value="Generar clasificaciones"></td>
                                    </tr>
                                </table>
                            </form>                                 
                        </div>
                    </section>
                </div>                
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Guarda Clasificacion Mundial
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-cog"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                        </header>
                        <div class="panel-body"> 
                            <form method="post" action="<?= site_url() ?>admin/guardarClasificacionMundial">
                                <table>
                                    <tr>
                                        <td colspan="2" align="center"> <input type="submit" value="Guardar Clasificacion mundial"></td>
                                    </tr>
                                </table>
                                <?php
                                echo $msgClasificacion;
                                ?>
                            </form>
                        </div>
                    </section>
                </div>                
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Guarda el valor de los pilotos/equipos en base a su movimientos (ventas/compras)
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-cog"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                        </header>
                        <div class="panel-body"> 
                            <form method="post" action="<?= site_url() ?>admin/cambioValorMovimientos">

                                <table>

                                    <tr>
                                        <td colspan="2" align="center"> <input type="submit" value="Cambio valor por movimientos de mercado"></td>
                                    </tr>
                                </table>        

                            </form>
                        </div>
                    </section>
                </div>                
            </div>                          
        </section>

        <!-- Placed js at the end of the document so the pages load faster -->

        <!--Core js-->
        <script src="<?= base_url(); ?>js/dashboard/lib/jquery.js"></script>
        <script src="<?= base_url(); ?>assets/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
        <script src="<?= base_url(); ?>bs3/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="<?= base_url(); ?>js/dashboard/accordion-menu/jquery.dcjqaccordion.2.7.js"></script>


        <script src="<?= base_url(); ?>js/dashboard/scrollTo/jquery.scrollTo.min.js"></script>
        <script src="<?= base_url(); ?>js/dashboard/nicescroll/jquery.nicescroll.js" type="text/javascript"></script>
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
        <script src="<?= base_url(); ?>assets/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
        <?php /*
          <script src="<?= base_url();?>assets/skycons/skycons.js"></script>
          <script src="<?= base_url();?>assets/jquery.scrollTo/jquery.scrollTo.js"></script>
          <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
          <script src="<?= base_url();?>assets/calendar/clndr.js"></script>
          <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
          <script src="<?= base_url();?>assets/calendar/moment-2.2.1.js"></script>
          <script src="<?= base_url();?>js/dashboard/calendar/evnt.calendar.init.js"></script>
          <script src="<?= base_url();?>assets/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
          <script src="<?= base_url();?>assets/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
          <script src="<?= base_url();?>assets/gauge/gauge.js"></script>
          <!--clock init-->
          <script src="<?= base_url();?>assets/css3clock/js/script.js"></script>

          <!--Easy Pie Chart-->
          <script src="<?= base_url();?>assets/easypiechart/jquery.easypiechart.js"></script>
          <!--Sparkline Chart-->
          <script src="<?= base_url();?>assets/sparkline/jquery.sparkline.js"></script>
          <!--Morris Chart-->
          <script src="<?= base_url();?>assets/morris-chart/morris.js"></script>
          <script src="<?= base_url();?>assets/morris-chart/raphael-min.js"></script>
          <!--jQuery Flot Chart-->
          <script src="<?= base_url();?>assets/flot-chart/jquery.flot.js"></script>
          <script src="<?= base_url();?>assets/flot-chart/jquery.flot.tooltip.min.js"></script>
          <script src="<?= base_url();?>assets/flot-chart/jquery.flot.resize.js"></script>
          <script src="<?= base_url();?>assets/flot-chart/jquery.flot.pie.resize.js"></script>
          <script src="<?= base_url();?>assets/flot-chart/jquery.flot.animator.min.js"></script>
          <script src="<?= base_url();?>assets/flot-chart/jquery.flot.growraf.js"></script>
         */ ?>
        <script src="<?= base_url(); ?>js/dashboard/custom-select/jquery.customSelect.min.js" ></script>
        <script src="<?= base_url(); ?>js/dashboard/prettynumber/jquery.prettynumber.js" ></script>
        <script src="<?= base_url(); ?>js/dashboard/jquery-confirm/jquery.confirm.min.js" ></script>


        <!--common script init for all pages-->
        <script src="<?= base_url(); ?>js/dashboard/scripts.js"></script>
        <script src="<?= base_url(); ?>js/dashboard/dashboard.js"></script>
        <?php
        if($javascript){
        foreach($javascript as $js){
        echo '<script type="text/javascript" src="'.base_url().'/js/'.$js.'"></script>';
        }
        }
        ?>

        <?php
        if($javascript_php){
        foreach($javascript_php as $jsp)
        {
        echo $jsp;
        }
        }
        ?>

    </body>
</html>