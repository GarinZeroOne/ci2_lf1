<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Participa en la mejor liga manager  de Formula 1 basada en resultados reales. Registrate gratis y comienza tu carrera manager!">
    <meta name="author" content="LigaFormula1.com">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/img/favicon.ico">

    <title><?php echo $titulo; ?></title>
  
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Coda:400,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Share+Tech' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Varela+Round">
    
    <!-- Fuente iconos -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

  

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/css/bootstrap-theme.min.css" rel="stylesheet">

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-1135501-5', 'ligaformula1.com');
      ga('send', 'pageview');

    </script>
    

    

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="/assets/js/html5shiv.js"></script>
      <script src="/assets/js/respond.min.js"></script>
    <![endif]-->

    <?php
    foreach($estilos as $estilo){
      echo '<link rel="stylesheet" href="'.base_url().'/css/'.$estilo.'" type="text/css" />';
    }
    
    ?>



  <script type="text/javascript">
    base_url = '<?= base_url();?>';
    site_url = '<?= site_url();?>';
  </script>
  
 <script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "bcb23888-9982-4008-9511-fea162e4b237", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>




    
    

  </head>


  <body>