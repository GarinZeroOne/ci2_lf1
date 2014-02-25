<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="Title" CONTENT="Liga Formula 1 Online">
<META NAME="Author" CONTENT="Liga Formula 1">
<META NAME="Subject" CONTENT="Deportes Formula 1">
<META NAME="Description" CONTENT="Liga formula 1 es un portal donde podras jugar en una liga con otros usuarios. Deberas comprar y vender pilotos y equipos para llevar a tu plantilla hasta los cajones mas altos del podium. Una liga gratuita y sencilla.">
<META NAME="Keywords" CONTENT="liga, formula 1, formula,1,coches,carreras,porra,competicion,campeonatos,gratis,premios,podium,podio,boxes,velocidad,campeonato,ranking,asfalto,juego online,juego">
<META NAME="Generator" CONTENT="Aptana Studio">
<META NAME="Language" CONTENT="Spanish">
<META NAME="Revisit" CONTENT="1 day">
<META NAME="Distribution" CONTENT="Global">
<META NAME="Robots" CONTENT="All">
<title>Liga Formula 1</title>
<base href="<?echo base_url()?>" />
<link rel="stylesheet" href="css/inicio.css" type="text/css" />
<link rel="stylesheet" href="css/basemenu.css" type="text/css" />
<?
foreach($estilos as $estilo){
	echo '<link rel="stylesheet" href="css/'.$estilo.'" type="text/css" />';
}
foreach($javascript as $js){
	echo '<script type="text/javascript" src="js/'.$js.'.js"></script>';
}
?>
<script type="text/javascript">
	base_url = '<?= base_url();?>';
	site_url = '<?= site_url();?>';
</script>
</head>