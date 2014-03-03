
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-3">
                <section class="panel">
                    <div class="panel-body">
                        <a href="#"  class="btn btn-compose">
                            Enviar Mensaje
                        </a>
                        <ul class="nav nav-pills nav-stacked mail-nav">
                            <li class="active"><a href="#"> <i class="fa fa-envelope-o"></i> Mensajes  <span class="label label-success pull-right inbox-notification">8</span></a></li>
                            <li><a href="<?php echo site_url();?>mensajes/notificaciones"> <i class="fa fa-tasks"></i> Notificaciones <span class="label label-danger pull-right inbox-notification">4</span></a></li>
                            <li><a href="<?php echo site_url();?>mensajes/alertas"> <i class="fa fa-bell-o"></i> Alertas <span class="label label-warning pull-right inbox-notification"><?php echo mensajes_model::contador_alertas_no_leidas($_SESSION['id_usuario']); ?></span></a> </li>
                            
                        </ul>
                    </div>
                </section>

                
            </div>
            <div class="col-sm-9">
                <section class="panel">
                    <header class="panel-heading wht-bg">
                       <h4 class="gen-case">Mensajes
                        
                       </h4>
                    </header>
                    <div class="panel-body minimal">
                        
                        <div class="table-inbox-wrap ">
                            <table class="table table-inbox table-hover">
                        <tbody>
                        <tr class="unread">
                            <td class="inbox-small-cells">
                                <input type="checkbox" class="mail-checkbox">
                            </td>
                            <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                            <td class="view-message  dont-show">Nickusuario</td>
                            <td class="view-message ">Lorem ipsum dolor imit set.</td>
                            <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                            <td class="view-message  text-right">12:10 AM</td>
                        </tr>
                        <tr class="unread">
                            <td class="inbox-small-cells">
                                <input type="checkbox" class="mail-checkbox">
                            </td>
                            <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                            <td class="view-message dont-show">Fulanito</td>
                            <td class="view-message">Hi Bro, Lorem ipsum dolor imit</td>
                            <td class="view-message inbox-small-cells"></td>
                            <td class="view-message text-right">Hace 3 dias</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">
                                <input type="checkbox" class="mail-checkbox">
                            </td>
                            <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                            <td class="view-message dont-show">Gogari</td>
                            <td class="view-message">Lorem ipsum dolor sit amet</td>
                            <td class="view-message inbox-small-cells"></td>
                            <td class="view-message text-right">Marzo 15</td>
                        </tr>
                        
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
