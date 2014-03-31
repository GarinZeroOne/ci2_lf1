<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Ligaformula1">
    <link rel="shortcut icon" href="<?= base_url();?>/img/favicon.ico">

    <title><?php echo $titulo; ?></title>

    <!--Core CSS -->
    <link href="<?= base_url();?>/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url();?>/css/dashboard/bootstrap-reset.css" rel="stylesheet">
    <link href="<?= base_url();?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?= base_url();?>assets/data-tables/DT_bootstrap.css" rel="stylesheet" />
    

    <!-- Custom styles for this template -->
    <link href="<?= base_url();?>/css/dashboard/style.css" rel="stylesheet">
    <link href="<?= base_url();?>/css/dashboard/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="js/ie8/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <?php
    foreach($estilos as $estilo){
      echo '<link rel="stylesheet" href="'.base_url().'/css/dashboard/'.$estilo.'" type="text/css" />';
    }
    
    ?>



  <script type="text/javascript">
    base_url = '<?= base_url();?>';
    site_url = '<?= site_url();?>';
  </script>
  
  <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-1135501-5', 'ligaformula1.com');
      ga('send', 'pageview');

    </script>
    
</head>

<body>

<section id="container" >
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="<?php echo site_url(); ?>" class="logo">
        <img  src="<?= base_url();?>/images/logo.png" alt="">
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-tasks"></i>
                <span class="badge bg-important"><?php echo mensajes_model::notificaciones_contador(); ?></span>
            </a>
            <ul class="dropdown-menu extended tasks-bar">
                <?php echo mensajes_model::notificaciones_activas(); ?>
                

                <li class="external">
                    <a href="#">Ver todas las notificaciones</a>
                </li>
            </ul>
        </li>
        <!-- settings end -->
        <!-- inbox dropdown start-->
        <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-success">1</span>
            </a>
            <ul class="dropdown-menu extended inbox">
                <li>
                    <p class="red">Tienes 1 mensajes</p>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="<?= base_url();?>/img/avatares/thumbs/admin_icon1.jpg"></span>
                                <span class="subject">
                                <span class="from">LF1admin</span>
                                <span class="time">deshabilitado</span>
                                </span>
                                <span class="message">
                                    Hola! Quería informate que  los mensajes estan deshabilitados de momento.
                                </span>
                    </a>
                </li>
                
                <li>
                    <a href="#">Ver todos los mensajes</a>
                </li>
            </ul>
        </li>
        <!-- inbox dropdown end -->
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning"><?php echo mensajes_model::contador_alertas_no_leidas($_SESSION['id_usuario']); ?></span>
            </a>
            <ul class="dropdown-menu extended notification">
                <li>
                    <p>Alertas</p>
                </li>
                <?php echo mensajes_model::mostrar_mis_alertas($_SESSION['id_usuario']); ?>
                <li><a class="btn btn-warning noti-menu" href="<?php echo site_url();?>mensajes/alertas">Ver todas</a></li>
                <!--
                <li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> JoseManuelF1 te ha mencionado en el grupo Bizkaia #340</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-danger clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Tu economia esta por debajo de la media.</a>
                        </div>
                    </div>
                </li>
                -->

            </ul>
        </li>
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div>

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <span id="saldo" class="saldo"><?php echo banco_model::getSaldo('formateado'); ?> </span> <span id="euroicon" class="saldo euro">€</span>
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="<?php  echo base_url();?>/img/avatares/thumbs/<?php echo usuarios_model::userAvatar($_SESSION['id_usuario']); ?>">
                <span class="username"><?php echo $_SESSION['usuario']; ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="<?php echo site_url(); ?>perfil"><i class=" fa fa-suitcase"></i>Perfil</a></li>
                <?php /*<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> */ ?>
                <li><a href="<?php echo site_url(); ?>inicio/logout"><i class="fa fa-key"></i> Salir</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
        <li>
            <div class="toggle-right-box">
                <div class="fa fa-bars"></div>
            </div>
        </li>
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->