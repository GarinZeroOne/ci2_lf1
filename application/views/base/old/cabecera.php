<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title> Participa en la mejor liga manager de formula 1 - Ligaformula1.com</title>
	<meta name="description" content="<?php echo $this->lang->line('meta_description');?>">
	<meta name="author" content="Liga Formula 1">

	<meta name="viewport" content="width=device-width">

	<title>Liga Formula 1</title>
	<base href="<?echo base_url()?>" />
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
	<link rel="stylesheet" href="<?php echo base_url();?>/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/css/bootstrap-responsive.css">

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



</head>