


<div class="row">

    <div class="span12">

        <div class="migas">
            <?php echo anchor('boxes',$this->lang->line('perfil_lbl_boxes')).
                    ' <span>></span> '.$this->lang->line('perfil_lbl_mi_perfil'); ?>
        </div>

        <div class="ads">

        <script type="text/javascript"><!--
        google_ad_client = "ca-pub-2361705659034560";
        /* Box_horizontal */
        google_ad_slot = "1297942735";
        google_ad_width = 728;
        google_ad_height = 90;
        //-->
        </script>
        <script type="text/javascript"
        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>

      </div>

    </div>

</div>

<div class="row">

    <div class="span6">

        <h3 class="boxcab"><? echo $this->lang->line('perfil_ttl_mis_datos')?></h3>
        <?php echo $error; ?>
        <?php
                if ($this->session->flashdata('mensajeForm')) {
                    echo "<div class='msgOk'>";
                    echo $this->session->flashdata('mensajeForm');
                    echo "<br>";
                    echo $this->validation->error_string;
                    echo "</div>";
                }

                if ($this->session->flashdata('mensajeFormErr')) {

                    echo "<div class='msgErr'>";
                    echo $this->session->flashdata('mensajeFormErr');
                    echo "</div>";
                }
        ?>



            <form class="form-horizontal" action="<?= site_url() ?>/boxes/modificarDatos" method="post" enctype="multipart/form-data">
                <div class="control-group">
                    <label class="control-label" for="inputName"><? echo $this->lang->line('perfil_lbl_nombre')?></label>
                    <div class="controls">
                        <input type="text" name="nombre"  value="<?php echo $usuario->nombre; ?>"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputLastname"><? echo $this->lang->line('perfil_lbl_apellidos')?></label>
                    <div class="controls">
                        <input type="text" name="apellido" value="<?php echo $usuario->apellido; ?>"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputCity"><? echo $this->lang->line('perfil_lbl_poblacion')?></label>
                    <div class="controls">
                        <input type="text" name="ubicacion" value="<?php echo $usuario->ubicacion; ?>"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputBornyear"><? echo $this->lang->line('perfil_lbl_ano_nac')?></label>
                    <div class="controls">
                        <input type="text" name="ano_nacimiento" value="<?php echo $usuario->ano_nacimiento; ?>"/>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">

                        <input type="submit" value="<? echo $this->lang->line('perfil_btn_modificar')?>" class="btn btn-primary" />
                    </div>
                </div>
            </form>

            <h4>Modificar contraseña</h4>

                <form class="form-horizontal" method="post" action="<?php echo site_url(); ?>boxes/mi_perfil_cpass">
                    <div class="control-group">
                    <label class="control-label" for="inputOldpass">Contraseña actual</label>
                        <div class="controls">
                            <input type="password" id="inputOldpass" name="Oldpass" required="required">
                        </div>
                    </div>

                    <div class="control-group">
                         <label class="control-label" for="inputNewpass">Nueva contraseña</label>
                        <div class="controls">
                            <input type="password" id="inputNewpass" name="Newpass" required="required">
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">

                            <input type="submit" class="btn btn-primary" value="Modificar contraseña">
                        </div>
                    </div>
                </form>

            <h4>Introduce información adicional:</h4>

            <div class="form-muro">

                <form action="<?php echo site_url(); ?>boxes/mi_perfil_informacion" method="post" accept-charset="utf-8">

                    <textarea name="infoperfil" class="editor" maxlength="300" > <?php echo $usuario->info_perfil; ?> </textarea>

                    <div class="boton-submit">
                         <input type="submit" name="Submit" class="btn btn-primary" value="Guardar información perfil" >
                    </div>

                </form>

            </div>


    </div> <!-- /span6 -->

    <div class="span6">

        <h3 class="boxcab"><? echo $this->lang->line('perfil_ttl_avatar')?></h3>

        <div id="avatar">

            <div id="imgAvatar">
                <span>
                    <img width="90" class="avatar" src= "<?=base_url()?>img/avatares/<? echo $avatar; ?>" />
                </span>
            </div>
            <div id="frmAvatar">
    <?php echo $error; ?>

                <fieldset>
                    <legend><b><? echo $this->lang->line('perfil_ttl_subir_imagen')?></b></legend>
                    <table>
                        <form action="<?= site_url() ?>/boxes/mi_perfil/subir" method="post" enctype="multipart/form-data">
                            <tr>
                                <td  width="47"><? echo $this->lang->line('perfil_lbl_imagen')?></td>
                                <td  width="47"><input type="file" name="userfile" id="userfile" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" value="<? echo $this->lang->line('perfil_ttl_subir_imagen')?>" class="btn btn-primary"  /></td>
                            </tr>
                        </form>
                    </table>
                </fieldset>
            </div>
        </div>

    </div> <!-- /span6 -->

</div>





