<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Participa en la mejor liga manager de formula 1 - Ligaformula1.com</title>
    <meta name="description" content="<?php echo $this->lang->line('meta_description');?>">
    <meta name="author" content="Liga Formula 1">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Faster+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>/css/bootstrap.css">
    <style>
    body {
      padding-top: 60px;
      padding-bottom: 40px;
    }
    </style>


    <link rel="stylesheet" href="<?php echo base_url();?>/js/jquery_notification/css/jquery_notification.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/css/loginscreen.css">

    <link rel="stylesheet" href="<?php echo base_url();?>/css/bootstrap-responsive.css">

    <link rel="shortcut icon" type="image/x-icon" href="<?php base_url(); ?>/img/favicon.ico">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>


    <?
    foreach($estilos as $estilo){
        echo '<link rel="stylesheet" href="'.base_url().'/css/'.$estilo.'" type="text/css" />';
    }
    foreach($javascript as $js){
        echo '<script type="text/javascript" src="'.base_url().'/js/'.$js.'.js"></script>';
    }
    ?>



    <script type="text/javascript">
        base_url = '<?= base_url();?>';
        site_url = '<?= site_url();?>';
    </script>

<style>
    
#video_background{
    position: absolute;
    bottom: 0px;
    right: 0px;
    min-width: 100%;
    min-height: 100%;
    max-width: 4000%;
    max-height:4000%;
    width: auto;
    height: auto;
    z-index: -1000;
    overflow: hidden;
} 

body{
    height: 100%;
}

div.filter{
    
    position:absolute;
    top:0;
    right: 0;
    bottom: 0;
    left: 0;
    background-repeat:no-repeat;
    background-position: right top;
    /*font:14px/150% "Segoe UI",Arial,Helvetica,sans-serif;*/
    background: url(../img/2013/bg/patronBg.png) no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
} 

</style>
</head>

<body>
    

    <div class="row-fluid">
        
        <div class="span6">
            
                <img src="<?php echo base_url(); ?>/img/logolf1w.png" />
                <h1 class="logincab">Liga Formula 1</h1>


        </div>

        <div class="span6">

            <div class="loginform">

                <form method="post" action="index.html" class="login">
                    <p>
                      <label for="login">Manager-id:</label>
                      <input type="text" name="login" id="login" value="name@example.com">
                    </p>

                    <p>
                      <label for="password">Password:</label>
                      <input type="password" name="password" id="password" value="4815162342">
                    </p>

                    <p class="login-submit">
                      <button type="submit" class="login-button">Login</button>
                    </p>

                    <p class="forgot-password"><a href="index.html">Forgot your password?</a></p>
                  </form>

            </div>
            
        </div>

    </div>

    

    


        <div class="wrapvideo">
   
            <video  class="fillWidth" id="video_background" preload="auto" autoplay="true" loop="loop">
            <source src="<?php echo base_url();?>img/lf1op.mp4" type="video/mp4"/>
            <source src="<?php echo base_url();?>img/lf1op.ogg" type="video/ogg"/>
            <source src="<?php echo base_url();?>img/lf1op.webm" type="video/webm"/>
            Your browser does not support the video tag. I suggest you upgrade your browser.
            </video>
        </div>
        <!--<div class="filter"></div>-->


</body>
</html>