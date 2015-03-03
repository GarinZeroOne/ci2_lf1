<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>:: ADMIN LF1 ::</title>
	<link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://getbootstrap.com/examples/dashboard/dashboard.css">
	
</head>


<body>

    
	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Panel Administrador  LF1</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url(); ?>">Volver al Dashboard</a></li>
            
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Buscar...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Notificaciones</a></li>
            <li><a href="#">Envio Mails</a></li>
            <li><a href="#">Generar passwords</a></li>
          </ul>
          
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          

          <div class="row">

          		<?php if($this->session->flashdata('ok_msg')): ?>
					<p class="bg-success"><?php echo $this->session->flashdata('ok_msg'); ?></p>
          		<?php endif; ?>

				<div class="col-lg-6">
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

					  <button type="submit" class="btn btn-default">Crear</button>
					</form>
				</div>
			</div>

          <h2 class="sub-header">Section title</h2>
          
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo  base_url(); ?>js/bootstrap.min.js"></script>
    
  </body>

</html>