
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-3">
                <section class="panel">
                    <div class="panel-body">
                        <?php /*
                        <a href="#"  class="btn btn-compose">
                            Enviar Mensaje
                        </a>
                        */ ?>
                        <ul class="nav nav-pills nav-stacked mail-nav">
                            
                            <li><a href="<?php echo site_url();?>mensajes/notificaciones"> <i class="fa fa-tasks"></i> Notificaciones <span class="label label-danger pull-right inbox-notification">4</span></a></li>
                            <li  class="active"><a href="#"> <i class="fa fa-bell-o"></i> Alertas <span class="label label-warning pull-right inbox-notification"><?php echo mensajes_model::contador_alertas_no_leidas($_SESSION['id_usuario']); ?></span></a> </li>
                            
                        </ul>
                    </div>
                </section>

                
            </div>
            <div class="col-sm-9">
                <section class="panel">
                    <header class="panel-heading wht-bg">
                       <h4 class="gen-case">Alertas
                        
                       </h4>
                    </header>
                    <div class="panel-body minimal">
                        
                        <div class="table-inbox-wrap ">
                            <table class="table table-inbox table-hover">
                        <tbody>

                        <?php foreach($alertas as $alerta): ?>    
                        <tr <?php if($alerta->leida==0): ?>class="unread" <?php endif; ?>>
                            <td class="inbox-small-cells">
                                <?php /*<input type="checkbox" class="mail-checkbox"> */ ?>
                            </td>
                            <td class="inbox-small-cells"><i class="fa fa-bullhorn"></i></td>
                            <td class="view-message  dont-show"><?php echo $alerta->tipo_alerta; ?></td>
                            <td class="view-message "><?php echo $alerta->texto; ?></td>
                            
                            <td class="view-message  text-right"><?php echo timeago(strtotime($alerta->fecha_modificada)); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        
                        </tbody>
                        </table>

                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- page end-->
        </section>
    </section>
