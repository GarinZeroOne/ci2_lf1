

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
              
              Tu último paso para convertirte en un Manager <br><br>
             
            </h2>

            <p class="regtextb">
              Completa el formulario para crear tu cuenta de usuario,  con la que podrás participar en la Liga Formula 1 y competir contra todos  los demás usuarios.
            </p>
            <p class="regtextb">
              Automaticámente te introduciremos en el grupo de tu comunidad, para que nunca te sientas solo. Quizás no logres ser le mejor manager en la general, pero siempre podrás intentarlo contra los usuarios de tu zona!
            </p>

            <p class="regtextb">Bienvenido y  buena suerte!</p>

            
            
          </div>
          <!-- FIN Izquierda -->

          <!-- DERECHA -->
          <div class="col-xs-12 col-sm-6">
              
            <div id="login">

              <h2><span class="fontawesome-lock"></span>Crea tu cuenta Manager</h2>
              <?php 
              if(validation_errors()):
              ?>
              <span class="error-acceso">
                <?php echo validation_errors(); ?>
              </span>
              <?php 
              endif;
              ?>
              <form action="<?php echo site_url(); ?>inicio/alta_nuevo_usuario" method="POST">

                <fieldset>

                  <p><label for="email">Nick:</label></p>
                  <p><input type="text" id="usuario" name="usuario" placeholder="Tu usuario" required></p> 
                  <!--onBlur="if(this.value=='')this.value='Tu usuario'" onFocus="if(this.value=='Tu usuario')this.value=''" -->
                  <!-- JS because of IE support; better: placeholder="mail@address.com" -->

                  <p><label for="password">Contraseña:</label></p>
                  <p><input type="password" id="passwd" name="passwd" placeholder="Contraseña" required></p> <!-- JS because of IE support; better: placeholder="password" -->

                  <p><label for="password">Confirmar contraseña: </label></p>
                  <p><input type="password" id="passconf" name="passconf" placeholder="Confirma tu contraseña" required></p>

                  <p><label for="mail">Email: </label></p>
                  <p><input type="text" id="email" name="email" placeholder="Introduce tu email" required></p>

                  <p><label for="provincia">Comunidad autonoma<br><i style="font-size:10px">(selecciona 'internacional' si resides fuera de españa)</i> </label></p>
                  <p>
                        <select name="comunidad" id="comunidad" required>
                          <option value="">Selecciona una  opción</option>
                          <option value="1">Andalucía</option>
                          <option value="2">Aragón</option>
                          <option value="3">Principado de Asturias</option>
                          <option value="4">Islas Baleares</option>
                          <option value="5">País Vasco</option>
                          <option value="6">Canarias</option>
                          <option value="7">Cantabria</option>
                          <option value="8">Castilla-La Mancha</option>
                          <option value="9">Castilla y León</option>
                          <option value="10">Cataluña</option>
                          <option value="11">Extremadura</option>
                          <option value="12">Galicia</option>
                          <option value="13">Comunidad de Madrid</option>
                          <option value="14">Región de Murcia</option>
                          <option value="15">Comunidad Foral de Navarra</option>
                          <option value="16">La Rioja</option>
                          <option value="17">Comunidad Valenciana</option>
                          <option value="18">Ceuta</option>
                          <option value="19">Melilla</option>
                          <option value="20"><i>Internacional</i></option>
                        </select>
                  </p>


                  <p><input type="submit" value="Crear cuenta"></p>

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
  
 
