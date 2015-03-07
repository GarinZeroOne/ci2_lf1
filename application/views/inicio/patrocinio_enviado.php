

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
          <div class="col-xs-12 col-sm-6 hidden-xs">
            <h2 class="facts">
              
              Formulario de contacto enviado! <br><br>
             
            </h2>

            
            <p class="regtextb">Gracias por ponerte en contacto con nosotros, te responderemos lo antes posible!</p>
            <p class="regtextb">Un saludo.</p>

            
            
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

                  <p><input type="submit" value="Entrar"> </p>
                  <div class="recordar"><a href="<?php echo site_url();?>inicio/restablecer_pass">¿Olvidaste tu contraseña?</a></div>

                </fieldset>

              </form>

            </div> <!-- end login -->

          </div>
          <!-- FIN Derecha -->

          

          

        </div>

        
    

    <!--
        <div id="vcontrols">
          <a href="#" onclick="mutevid()" title="Audio ON/OFF"> <img id="audioicon" src="<?php echo base_url(); ?>img/icons/mute.png" /></a>
        </div>
    -->  

    <!-- Google Code for Registros Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 975837071;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "I_VsCJnluQkQj6-o0QM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/975837071/?label=I_VsCJnluQkQj6-o0QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

        
       
      </div>
  
    <!-- Wrap end -->
    </div>

    <div id="footer">
        
        <div class="container">
          
            <ul class="nav-footer">
              <li>LigaFormula1.com © 2009 - 2015</li>
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
  
 
