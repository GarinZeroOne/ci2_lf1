
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">

            

            <div class="col-sm-12">
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
                        Crear grupo
                        
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                                <form role="form" method="post" action="<?php echo site_url(); ?>grupos/crear_grupo" enctype="multipart/form-data" >
                                <div class="form-group">
                                    <label for="nombre">* Nombre</label>
                                    <input type="text" placeholder="introduce un nombre para el grupo" id="nombre_grupo" name="nombre_grupo" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <textarea class="form-control" rows="4" name="descripcion_grupo"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="imagen">Imagen para el grupo  <i  style="font-weight:normal;font-size:10px">(max 200kb)</i></label>
                                    <input type="file" id="userfile" name="userfile">
                                    
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="privacidad"  id="privacidad"> Grupo privado <i style="font-size:10px;">(Marcando esta opción solo se podrá acceder a tu grupo por invitación.)</i>
                                    </label>
                                </div>
                                <button class="btn btn-info" type="submit">Submit</button>
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
