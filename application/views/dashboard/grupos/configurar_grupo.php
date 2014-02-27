
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">

            

            <div class="col-sm-6">
                <?php if($this->session->flashdata('msg_error')): ?>
                    <div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Opps!</strong> <?php echo $this->session->flashdata('msg_error'); ?>
                    </div>
                <?php endif; ?>

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

            <div class="col-sm-6">

                <?php if($this->session->flashdata('msg_ok')): ?>
                <div class="alert alert-success fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Hecho!</strong> <?php echo $this->session->flashdata('msg_ok'); ?>
                </div>
                <?php endif; ?>


                <section class="panel">
                    <header class="panel-heading">
                        Usuarios Grupo
                        
                    </header>
                    <div class="panel-body">
                        
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
