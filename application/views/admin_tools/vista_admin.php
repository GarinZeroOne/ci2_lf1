<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>:: ADMIN LF1 ::</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
</head>
<body>
	<h1>Panel de gestion</h1>
	<div class="notificaciones">
		<h2>Notificaciones</h2>
		
		

		<form action="<?php echo site_url(); ?>admin_tools/nueva_notificacion" method="post">
		  <div class="form-group" >
		    <label for="tipo">Tipo</label>
		    <input type="text"  class="form-control" name="tipo" value="info_gp">
		  </div>
		  <div class="form-group">
		    <label for="titulo">titulo notificacion</label>
		    <input type="text"  class="form-control" name="titulo" value="info_gp">
		  </div>
		  <div class="form-group">
		    <label for="texto">Texto</label>
		    <textarea class="form-control" name="texto" > </textarea>
		  </div>

		  <button type="submit" class="btn btn-default">Submit</button>
		</form>

	</div>
</body>
</html>