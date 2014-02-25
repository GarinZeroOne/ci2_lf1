
<div class="text-box-gris">
<?php echo $this->lang->line('alta_intro_text');?>
</div>

<div class="modal hide fade" id="myModal">

              <form class="form-vertical" method="post" id="formlogin" name="formlogin" action="<?php echo site_url()?>/inicio/login/">
              <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3><?php echo $this->lang->line('login_titulo'); ?></h3>
              </div>


              <div class="modal-body">
                
                <div style="text-align: center">
                    
                         <label> <?php echo $this->lang->line('login_usuario'); ?></label>
                        
                          <input type=text name=usuario>
                        
                        <label><?php echo $this->lang->line('login_passwd'); ?></label>
                        <input type=password name=passwd>
                      
                       <label> <?=anchor('inicio/recordar_login',$this->lang->line('login_recordar_passwd'))?></label>
                  
                </div>


              </div>

              <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal"><?php echo $this->lang->line('login_btn_cerrar'); ?></a>
                <input type="submit" class="btn btn-primary" name="login_action" value="<?php echo $this->lang->line('login_btn_entrar'); ?>" />
              </div>
               </form> 
      </div>

<div id="formulario_alta">
    <div align="center" id="formulario">
        
        <span>
            <?php echo $this->validation->error_string; ?>
        </span>
            
            <form class="form-vertical" method="post" id="formalta" name="formalta" action="<?= site_url() ?>/alta/nuevo_usuario">
                
                <label>*<?php echo $this->lang->line('alta_nick');?>:</label>
                    <input type="text" name="usuario" />

                <label>*<?php echo $this->lang->line('alta_password');?>:</label>
                    <input type="password" name="passwd"/>

                <label>*<?php echo $this->lang->line('alta_confirmar_password');?>:</label>
                    <input type="password" name="passconf"/>

                <label>*<?php echo $this->lang->line('alta_email');?>:</label>
                    <input type="text" name="email"/>

                <label><?php echo $this->lang->line('alta_nombre');?>:</label>
                    <input type="text" name="nombre" />

                <label><?php echo $this->lang->line('alta_apellidos');?>:</label>
                    <input type="text" name="apellido" />

                <label><?php echo $this->lang->line('alta_ubicacion');?>:</label>
                <input type="text" name="ubicacion" />

               <label> <?php echo $this->lang->line('alta_ano_nacimiento');?>:</label>
                    <input type="text" name="ano_nacimiento" maxlength="4" />
                

                        <div id="control-enviar">
                            <input class="btn btn-mini btn-primary" type="submit" name="nuevo_usuario" value="<?php echo $this->lang->line('alta_btn_crear_usuario');?>" />
                        </div>

                 
        * <?php echo $this->lang->line('alta_campos_obligatorios');?>
    </div>
</div>


