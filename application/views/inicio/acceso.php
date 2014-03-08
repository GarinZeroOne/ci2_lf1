

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
            
          <!-- IZQUIERDA -->
          <div class="col-xs-12 col-sm-6 ">
            <h2 class="facts">
              
              ¿Estás preparado para ser un magnate de la Formula 1? <br><br>
             
            </h2>

            <p class="regtext">
              Compite contra  tus amigos en la mejor liga  manager de Formula 1. Resultados basados en la Formula 1 real. Registrate  ya!
            </p>

            <div align="center" style="margin-top:21px;">
              <a class="regbutton" href="<?php echo site_url(); ?>inicio/alta">Registrate ahora</a>
              <!--<img src="http://placehold.it/240x70" class="img-rounded">-->
            </div>
            
          </div>
          <!-- FIN Izquierda -->

          <!-- DERECHA -->
          <div class="col-xs-12 col-sm-6">
              
            <div id="login">

              <h2><span class="fontawesome-lock"></span>Acceso Managers</h2>
              <?php 
              if($this->session->flashdata('login_error')):
              ?>
              <span class="error-acceso">## Usuario o contraseña incorrecta ##</span>
              <?php 
              endif;
              ?>

              <?php 
              if($this->session->flashdata('alta_ok')):
              ?>
              <span class="alta-ok"> Tu cuenta ha sido  creada! </span>
              <?php 
              endif;
              ?>

              <form action="<?php echo site_url(); ?>inicio/login" method="POST">

                <fieldset>

                  <p><label for="email">Identificador@</label></p>
                  <p><input type="text" id="usuario" name="usuario" placeholder="Tu usuario" required></p> 
                  <!--onBlur="if(this.value=='')this.value='Tu usuario'" onFocus="if(this.value=='Tu usuario')this.value=''" -->
                  <!-- JS because of IE support; better: placeholder="mail@address.com" -->

                  <p><label for="password">Password</label></p>
                  <p><input type="password" id="passwd" name="passwd" placeholder="Tu contraseña" required></p> <!-- JS because of IE support; better: placeholder="password" -->

                  <p><input type="submit" value="Entrar"></p>

                </fieldset>

              </form>

            </div> <!-- end login -->

          </div>
          <!-- FIN Derecha -->

          

          

        </div>

        <div class="row">
          
          <div class="patrocinadores hidden-xs">

            <div class="col-xs-12 ">

              <div class="box-patrocinador">
                <img class="desaturada" width="80" src="<?php echo base_url(); ?>img/logolf1w.png" alt="patrocinador-lf1" title="¿Quieres ver tu logo aqui? Ponte en contacto con nosotros para apoyar a LF1 como patrocinador">
              </div>
              
              <div class="box-patrocinador">
                
              </div>

              <div class="box-patrocinador">
                
              </div>

              <div class="box-patrocinador">
                
              </div>
              
              <div class="box-patrocinador">
                
              </div>

              <div class="box-patrocinador">
                
              </div>

            </div>
            

          </div> <!-- Patrocinadores fin -->
          
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
  
 
