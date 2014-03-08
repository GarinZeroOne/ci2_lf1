<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
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

    

  </head>


  <body>