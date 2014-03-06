
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
        
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
