
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
        
        <div class="row">

            

            <div class="col-md-12">
                   
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

                <?php if(validation_errors()):?>
                  <div class="alert alert-block alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Opps!</strong> <?php echo validation_errors(); ?>
                    </div>
                    
                  
                <?php endif;?>
                
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    
                    <div class="panel-body"><!-- Panel body-->
                        <div class="form">

                                <form action="<?php echo site_url();?>perfil/modificar_datos" method="post" id="signupForm" class="cmxform form-horizontal " novalidate="novalidate">

                                     <div class="col-lg-3"></div>
                                     <dic class="col-lg6">
                                         <div class="prf-contacts sttng">
                                        <h2>Información Personal</h2>
                                    </div>
                                     </dic>
                                    <div class="form-group ">
                                        <label class="control-label col-lg-3" for="nombre">Nombre</label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="nombre"  value="<?php echo $usuario->nombre; ?>"/>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label class="control-label col-lg-3" for="apellido">Apellido</label>
                                        <div class="col-lg-6">
                                             <input class="form-control" type="text" name="apellido" value="<?php echo $usuario->apellido; ?>"/>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label class="control-label col-lg-3" for="poblacion">Población</label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="ubicacion" value="<?php echo $usuario->ubicacion; ?>"/>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group ">
                                        <label class="control-label col-lg-3" for="anonac">Año nacimiento</label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="ano_nacimiento" value="<?php echo $usuario->ano_nacimiento; ?>"/>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label class="control-label col-lg-3" for="anonac">Texto Perfil</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control"  name="texto_perfil"/><?php echo $usuario->info_perfil;?></textarea>
                                        </div>
                                    </div>

                                    

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                            
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </section>

                <section class="panel">
                    <div class="panel-body"><!-- Panel body-->
                        <!-- Cambiar contraseña -->
                        <div class="form">
                            <form action="<?php echo site_url();?>perfil/mi_perfil_cpass" method="post" id="cpassForm" class="cmxform form-horizontal " novalidate="novalidate">

                                     <div class="col-lg-3"></div>
                                     <dic class="col-lg6">
                                         <div class="prf-contacts sttng">
                                            <h2>Cambiar  contraseña</h2>
                                        </div>
                                     </dic>
                                    <div class="
                                    form-group ">
                                        <label class="control-label col-lg-3" for="nombre">Contraseña actual</label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="password" id="inputOldpass" name="Oldpass" required>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label class="control-label col-lg-3" for="nombre">Nueva contraseña</label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="password" id="inputNewpass" name="Newpass" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button type="submit" class="btn btn-primary">Modificar contraseña</button>
                                            
                                        </div>
                                    </div>

                            </form>

                        </div>
                        <!-- Fin Cambiar contraseña -->

                    </div><!-- div.panel-body -->
                </section><!-- Panel body -->
                
                <section class="panel">
                    <div class="panel-body"><!-- Panel body-->
                        <!-- Cambiar contraseña -->
                        <div class="form">
                            <form action="<?php echo site_url();?>perfil/subir_avatar" method="post" id="avatarForm" enctype="multipart/form-data" class="cmxform form-horizontal " novalidate="novalidate">

                                     <div class="col-lg-3">
                                         
                                     </div>
                                     <dic class="col-lg6">
                                         <div class="prf-contacts sttng">
                                            <h2>Mi avatar</h2>
                                        </div>
                                     </dic>
                                     

                                    <div class="form-group ">
                                        <label class="control-label col-lg-3" for="nombre">Subir  imagen </label>
                                        <div class="col-lg-6">
                                            <img src="<?php echo base_url();?>img/avatares/<?php echo $avatar; ?>" width="100"/> </br>
                                            <input  type="file" name="userfile" id="userfile" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button type="submit" class="btn btn-primary">Subir imagen</button>
                                            
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </section>

               
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
