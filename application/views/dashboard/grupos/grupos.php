
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
        
        

        <!-- Migas -->
        <div class="row">

            

            <div class="col-md-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li class="active"><a href="#"><i class="fa fa-home"></i> Grupos</a></li>
                        
                    </ul>
                    <!--breadcrumbs end -->
                    <?php if($this->session->flashdata('msg_ok')): ?>
                <div class="alert alert-success fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Fantástico!</strong> <?php echo $this->session->flashdata('msg_ok'); ?>
                </div>
                <?php endif; ?>

                <?php if($this->session->flashdata('msg_error')): ?>
                    <div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Opps!</strong> <?php echo $this->session->flashdata('msg_error'); ?>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>

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
            <div class="col-sm-9">
                


                <section class="panel">
                    
                    <div class="panel-body">
                        Debajo encontrarás los grupos en los  que te encuentras actualmente. Puedes crear  tus propios grupos e invitar a tus amigos a que se unan  a el. Por defecto estaras dentro del grupo de tu comunidad autonoma ( o en el grupo <i>internacional</i> si resides fuera de españa)
                        

                    </div>
                </section>
            </div>

            <div class="col-sm-3">
                <div style="text-align:right;margin-bottom:10px;">
                    <a class="btn btn-success" href="<?php echo site_url();?>grupos/crear_grupo"><i class="fa fa-plus"></i> Crear grupo </a>    
                </div>
                
            </div>
        </div>


        <div class="row">
    
            <?php foreach($gruposUsuario as $grupo): ?>
            <!--BOX GRUPO USUARIO-->
            <div class="col-md-3 col-lg-2">
                <div class="profile-nav alt">
                    <section class="panel text-center">
                        <div class="user-heading alt wdgt-row terques-bg" <?php if($grupo->imagen):?> style="background-image:url('<?php echo base_url();?>img/grupos/<?php echo $grupo->imagen;?>');background-position:center top;background-size:100% auto;" <?php endif;?> >
                            <a title="Entrar al grupo" class="group-join-btn" href="<?php echo site_url();?>grupos/ver/<?php echo $grupo->id; ?>"><i class="fa fa-group"></i></a>
                        </div>

                        <div class="panel-body">
                            <div class="wdgt-value">
                                <h1 class="count"><?php echo $grupo->cantidad; ?></h1>
                                <p><?php echo $grupo->nombre; ?></p>
                            </div>
                        </div>

                    </section>
                </div>
            </div>
            <!-- FIN BOX GRUPO USUARIO -->
            <?php  endforeach; ?>

        </div>

        <div class="row">
           
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Grupos publicos
                        
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>Nombre Grupo</th>
                        <th>Administrador</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Fecha</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($grupos_publicos as $gp): ?>
                        <tr class="gradeX">
                            <td><a href="<?php echo site_url();?>grupos/ver/<?php echo $gp->id; ?>"><?php echo $gp->nombre; ?></a></td>
                            <td><a href="<?php echo site_url();?>perfil/ver/<?php echo $gp->nick; ?>"><?php echo $gp->nick; ?></a></td>
                            <td><?php echo $gp->descripcion; ?> </td>
                            <td>
                                <?php if($gp->imagen): ?>
                                    <img class="round-pilots" src="<?php echo base_url();?>img/grupos/<?php echo $gp->imagen;?>" />    
                                <?php else: ?>
                                    <i class="fa fa-group" style="font-size:25px"></i>
                                <?php endif; ?>
                                
                            </td>
                            <td><?php echo timeago(strtotime($gp->fecha_creacion)); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nombre Grupo</th>
                        <th>Administrador</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
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
