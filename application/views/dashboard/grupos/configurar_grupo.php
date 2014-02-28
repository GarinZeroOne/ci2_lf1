
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
    
        <div class="row">
        
            <?php if($this->session->flashdata('msg_ok')): ?>

                <div class="col-md-12">
                <div class="alert alert-success fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Hecho!</strong> <?php echo $this->session->flashdata('msg_ok'); ?>
                </div>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('msg_error')): ?>
                <div class="col-md-12">
                    <div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Opps!</strong> <?php echo $this->session->flashdata('msg_error'); ?>
                    </div>
                </div>
            <?php endif; ?>
            

            <div class="col-md-6">
                

                <section class="panel">
                    <header class="panel-heading">
                        Modificar  datos
                        
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                                <form role="form" method="post" action="<?php echo site_url(); ?>grupos/configurar_grupo/<?php echo $info_grupo->id; ?>" enctype="multipart/form-data" >
                                    <input type="hidden" name="gid" value="<?php echo $info_grupo->id; ?>">
                                <div class="form-group">
                                    <label for="nombre">* Nombre</label>
                                    <input type="text" value="<?php echo $info_grupo->nombre; ?>" placeholder="introduce un nombre para el grupo" id="nombre_grupo" name="nombre_grupo" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <textarea class="form-control" rows="4" name="descripcion_grupo"> <?php echo $info_grupo->descripcion; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="imagen">Imagen para el grupo  <i  style="font-weight:normal;font-size:10px">(max 200kb)</i></label>
                                    <input type="file" id="userfile" name="userfile">
                                    <div style="margin-top:10px">
                                        <img width="100px" src="<?php echo base_url(); ?>img/grupos/<?php echo $info_grupo->imagen; ?>" />
                                    </div>
                                    
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="privacidad"  id="privacidad" <?php if($info_grupo->privado):?> checked <?php endif;?> > Grupo privado <i style="font-size:10px;">(Marcando esta opción solo se podrá acceder a tu grupo por invitación.)</i>
                                    </label>
                                </div>
                                <button class="btn btn-info" type="submit">Actualizar datos</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-6">

                

                


                <section class="panel">
                    <header class="panel-heading">
                       Usuarios del Grupo
                        
                    </header>
                    <div class="panel-body">
                        <p><strong>Añadir usuario al grupo</strong></p>
                        <p>Puedes agregar usuarios a tu grupo introduciendo su <i>código de manager</i>. Todos los usuarios tienen un <i>código de manager</i> al que  pueden acceder desde su perfil.</p>

                        
                        <form action="<?php echo site_url();?>grupos/configurar_grupo/<?php echo $info_grupo->id; ?>" method="post">
                            <div class="input-group m-bot15">
                                <span class="input-group-addon btn-white"><i class="fa fa-barcode"></i></span>
                                <input type="text" placeholder="Introduce el codigo de manager" class="form-control" name="codigo_manager">
                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-success" value="Añadir usuario" />
                                  </span>
                            </div>
                        </form>

                        <p><strong>Eliminar usuarios del grupo</strong></p>
                        
                        <?php foreach($usuarios_grupo  as $ug): ?>
                        <div class="box-usuario">
                            <div class="box-image">
                                <img src="<?php echo base_url();?>img/avatares/<?php echo $ug->avatar ?>"  />
                            </div>
                            <div class="box-nick">
                                <?php echo $ug->nick; ?>
                                
                            </div>
                            <a title="Eliminar usuario del grupo" class="box-delete confirm" href="<?php echo site_url();?>grupos/eliminar_usuario_grupo/<?php echo $ug->id ?>" > X </a>
                        </div>

                        <?php endforeach; ?>


                    </div>
                </section>

            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
