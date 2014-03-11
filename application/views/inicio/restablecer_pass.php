

        <ul class="cb-slideshow">
            <li><span>Image 01</span><div><h3><?php echo  $managers['0']['nick']; ?></h3></div></li>
            <li><span>Image 02</span><div><h3><?php echo  $managers['1']['nick']; ?></h3></div></li>
            <li><span>Image 03</span><div><h3><?php echo  $managers['2']['nick']; ?></h3></div></li>
            <li><span>Image 04</span><div><h3><?php echo  $managers['3']['nick']; ?></h3></div></li>
            <li><span>Image 05</span><div><h3><?php echo  $managers['4']['nick']; ?></h3></div></li>
            <li><span>Image 06</span><div><h3><?php echo  $managers['5']['nick']; ?></h3></div></li>
        </ul>
    <!-- Wrap all page content here -->
    <div id="wrap">

      

      <!-- Begin page content -->
      <div class="container">
        
        <div class="row">
            <div class="col-lg-12 hidden-xs">

              
              <div class="cab">
                <h1 class="login-header">  LIGAFORMULA1</h1> 
                <div class="anio"><b>2014</b></div>
              </div>
              

            </div>
            <div class="col-lg-12">
              <p class="legend">Lo fácil es pilotar, solo los valientes se atreven a gestionar su propio equipo</p>
            </div>
            
        </div>

        <div class="row">
            
            <div class="col-md-4 col-md-offset-4">
            <!-- Div formulario -->
            <div id="login">

              <h2><span ></span>Introduce tu email y te enviaremos una nueva contraseña:</h2>
              
              <?php if($this->session->flashdata('msg_ok')): ?>
                <span class="alta-ok">
                  <?php echo $this->session->flashdata('msg_ok'); ?> </br> <a href="<?php echo site_url();?>inicio/">Volver al login</a>
                </span>
              <?php endif; ?>

              <?php if($this->session->flashdata('msg_error')): ?>
                <span class="error-acceso">
                  <?php echo $this->session->flashdata('msg_error'); ?>
                </span>
              <?php endif; ?>
              
              
              
              <form action="<?php echo site_url(); ?>inicio/restablecer_pass_envio" method="POST">

                <fieldset>

                  <p><label for="provincia">Introduce tu email: </label></p>
                  <p>
                        <input type="text" name="correo" required placeholder="Email">
                  </p>


                  <p><input type="submit" value="Continuar"></p>

                </fieldset>

              </form>

            </div> <!-- FIN Div formulario -->
          
          </div>
          

          

        </div>

        
    

    <!--
        <div id="vcontrols">
          <a href="#" onclick="mutevid()" title="Audio ON/OFF"> <img id="audioicon" src="<?php echo base_url(); ?>img/icons/mute.png" /></a>
        </div>
    -->  
        
       
      </div>
  
    <!-- Wrap end -->
    </div>

    <div id="footer">
        
        <div class="container">
          
            <ul class="nav-footer">
              <li>LigaFormula1.com © 2009 - 2014</li>
              <?php 
              /*
              <li><a href="#">Reglamento</a></li>
              <li><a href="#">Foro</a></li>
              */
               ?>
              <li><a href="mailto:gestionlf1@gmail.com">Contacto</a></li>
            </ul>
          
        </div>
        
      
    </div>
  
 
