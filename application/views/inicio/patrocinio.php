

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
              
              ¿Estás interesado en patrocinar a LigaFormula1? <br><br>
             
            </h2>

            <p class="regtextb">
              En 2009 emprendimos la aventura de crear la primera página dedicada a gestionar una liga del campeonato mundial de Formula 1. Gracias a la respuesta positiva de nuestros usuarios, cada año hemos ido mejorando el formato e introduciendo características únicas que nos diferencian de otras ligas y del formato clasico.
            </p>
            <p class="regtextb">
              El reto de mantener año tras año el nivel cada vez es más díficil, dado los gastos que conlleva gestionar un servicio de este tipo, y que cada año con la crecida del número de usuarios se acentúa aún más.
            </p>

            <p class="regtextb">
              Pero ningúno de esos impedimentos ha conseguido frenar nuestra ilusión de seguir desarrollando y preparando cada temporada con las mismas ganas que el primer día. Somos amantes de la Formula 1 y la tecnología, que son los principales pilares de ligaformula1.com y mientras podamos y la comunidad nos apoye seguiremos con el proyecto.
            </p>

            <p class="regtextb">
              Si te gusta nuestro proyecto y quieres ayudarnos a crecer más y mejorar, vendes un producto que pueda interesar a nuestros usuarios, quieres promocionar tu marca, tienes ideas para LF1 o quieres colaborar con nosotros, no dudes en ponerte en contacto!
            </p>

            <p class="regtextb">:></p>

            
            
          </div>
          <!-- FIN Izquierda -->

          <!-- DERECHA -->
          <div class="col-xs-12 col-sm-6">
              
            <div id="login">

              <h2><span class="fontawesome-lock"></span>¡Cuentanos tu propuesta!</h2>
              <?php 
              if($this->session->flashdata('msg_error')):
              ?>
              <span class="error-acceso">
                <?php echo $this->session->flashdata('msg_error'); ?>
              </span>
              <?php 
              endif;
              ?>
              <form action="<?php echo site_url(); ?>inicio/patrocinio" method="POST">

                <fieldset>

                  <p><label for="nombre">Nombre:</label></p>
                  <p><input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required></p> 
                  <!--onBlur="if(this.value=='')this.value='Tu usuario'" onFocus="if(this.value=='Tu usuario')this.value=''" -->
                  <!-- JS because of IE support; better: placeholder="mail@address.com" -->

                  <p><label for="empresa">Empresa:</label></p>
                  <p><input type="text" id="empresa" name="empresa" placeholder="Empresa" ></p> <!-- JS because of IE support; better: placeholder="password" -->

                  <p><label for="web">Pagina web: </label></p>
                  <p><input type="text" id="web" name="web" placeholder="Pagina web" ></p>

                  <p><label for="mail">Email: </label></p>
                  <p><input type="text" id="email" name="email" placeholder="Introduce tu email" required></p>

                  <p><label for="provincia">Comentarios </label></p>
                  <p>
                        <textarea name="comentarios" id="" cols="30" rows="10"></textarea>
                  </p>


                  <p><input type="submit" value="Enviar"></p>

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
  
 
