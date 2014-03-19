
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
        

        <div class="row">
            <?php if($resultados): ?>
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Resumen ganacias último Gran Premio
                        
                    </header>
                    <div class="panel-body">
                        
                        <!-- RESUMEN GP -->
                        <div id="resumengp" align="center">
                    <table class="table table-bordered ">
                        <thead class="resumen-gp">
                            <tr>
                                <th>Concepto</th>
                                <th>Piloto</th>
                                <th>Equipo</th>
                                <th>Ingresos</th>
                                <th>Puntos</th>        
                            </tr>
                        </thead>

                        
                        <tbody>
                        <?php
                        $cont_puntos;
                        $cont_dinero;
                        $i = 0;


                        foreach ($resultados as $resultado):
                            ?>

                            <tr>
                                <td class="concepto">
                                    <?
                                    switch ($resultado->tipo) {

                                        case "poleman":
                                            echo "Poleman";
                                            break;
                                        case "stiki_puntos":
                                            echo $this->lang->line('oficina_lbl_stk_puntos');
                                            break;
                                        case "ingenieros":
                                            echo $this->lang->line('oficina_lbl_ingeniero');
                                            break;
                                        case "pilotos":
                                            echo $this->lang->line('oficina_lbl_piloto');
                                            break;
                                        case "equipos":
                                            echo $this->lang->line('oficina_lbl_equipos');
                                            break;
                                        case "stiki_dinero":
                                            echo $this->lang->line('oficina_lbl_stk_dinero');
                                            break;
                                        case "banco":
                                            echo $this->lang->line('oficina_lbl_banco');
                                            break;
                                        case "publicistas":
                                            echo $this->lang->line('oficina_lbl_publicista');
                                            break;
                                    }
                                    ?>
                                </td>
                                <td> <?= $this->pilotos_model->get_nombre_piloto_por_id($resultado->id_piloto); ?></td>
                                <td> <?= $this->pilotos_model->get_nombre_equipo_por_id($resultado->id_equipo); ?>  </td>
                                <td> <?= es_dinero($resultado->dinero); ?> €</td>
                                <td class="pm"> <?= $resultado->puntos; ?></td> </tr>
                            <?
                            $cont_puntos = $cont_puntos + $resultado->puntos;
                            $cont_dinero = $cont_dinero + $resultado->dinero;
                            $i++;
                            ?>



                        <? endforeach; ?>

                        <tr><td class="concepto"><? echo $this->lang->line('oficina_lbl_nomina') ?></td><td></td> <td></td><td>100.000 €</td> <td>0</td></tr>
                        <tr id="totales">
                            <td><? echo $this->lang->line('oficina_lbl_total') ?></td> <td></td> <td></td>    <td> <?= es_dinero($cont_dinero + 100000); ?> €</td><td><?= $cont_puntos; ?></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                        <!-- FIN RESUMEN GP-->

                    </div>
                </section>
            </div>
            <?php endif; ?>
        </div>

        
        
        <div class="row">
           
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Movimientos Banco
                        
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Cantidad €</th>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($movimientos_banco as $movimiento): ?>
                        <tr class="gradeX">
                            <td><?php echo $movimiento->concepto; ?></td>
                            <td><?php echo $movimiento->tipo_movimiento; ?></td>
                            <td>
                                <?php if($movimiento->tipo_movimiento=='ingreso'): ?>
                                    <span style="color:rgb(90, 157, 29);"><i style="color: rgb(90, 157, 29); font-size: 16px;" class="fa fa-angle-double-up"></i> <?php echo es_dinero($movimiento->dinero);  ?> €</span>
                                <?php else: ?>
                                    <span style="color:#ff0000;"><i style="color: rgb(255, 0, 0); font-size: 16px;" class="fa fa-angle-double-down"></i> <?php echo es_dinero($movimiento->dinero);  ?> €</span>
                                <?php endif; ?>
                                

                                 </td>
                            <td><?php echo $movimiento->texto_concepto; ?></td>
                            <td><?php echo $movimiento->fecha; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Cantidad €</th>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                    </tr>
                    </tfoot>
                    </table>
                    </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
