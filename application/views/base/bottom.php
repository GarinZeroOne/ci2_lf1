

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/js/modernizr.custom.86080.js"></script>
    <!--<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->
    <?php 
    if($javascript){
      foreach($javascript as $js){
        echo '<script type="text/javascript" src="'.base_url().'/js/'.$js.'"></script>';
      }  
    }
    
    ?>
    
  </body>
</html>