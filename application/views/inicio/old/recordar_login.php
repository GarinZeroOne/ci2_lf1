
<div id="loginform" class="text-box-gris">
	<h3>Recordar Login</h3>
	<div id="login" align="left">
		
		<div id="infomsg" align="center"><?php echo $msgError;?> </div>
		
		<div id="form" class="centrar">
		<p>Si has olvidado tu contraseña, introduce el correo electronico con el que te registraste y te enviaremos una nueva contraseña. 
		Una vez la recibas, podrás volver a cambiarla desde tu perfil.</p>
			<form method="post" class="form-vertical"  action="<?php echo site_url()?>/inicio/recordar_login/">
						
							<img src="<?=site_url();?>/img/login.png" />
						
							
							<label>Introduce tu correo:</label>
						
						
							<input type=text name="correo">
						
							<div id="control-enviar">
								<input class="btn btn-mini btn-primary" type="submit" value="Enviarme una nueva contraseña" />
							</div>
					
			</form>
		
		</div>
	</div>
</div>
	

<div class="modal hide fade" id="myModal">

              <form class="form-vertical" method="post" action="<?php echo site_url()?>/inicio/login/">
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
                <input type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('login_btn_entrar'); ?>" />
              </div>
               </form> 
      </div>