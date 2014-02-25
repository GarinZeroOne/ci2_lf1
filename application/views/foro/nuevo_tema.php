<div class="row">
	<div class="span12">

		<div class="adszone">
		</div>

		<div class="menuforos">
			<ul>

				<li><a href="<?php echo site_url(); ?>/foro/indice" > Indice Foros</a></li>
				<li <?php if($this->session->userdata('foroactivo')=='lf1ayuda'):?> class="menactivo" <? endif; ?> ><a href="<?php echo site_url(); ?>/foro/sel/lf1ayuda" class="<?php echo $foro_notify['foroayuda']; ?>"  > LF1 Ayuda</a></li>
				<li <?php if($this->session->userdata('foroactivo')=='lf1general'):?> class="menactivo" <? endif; ?> ><a href="<?php echo site_url(); ?>/foro/sel/lf1general" class="<?php echo $foro_notify['foro']; ?>" > LF1 General</a></li>
				<li <?php if($this->session->userdata('foroactivo')=='lf1formula1'):?> class="menactivo" <? endif; ?>><a href="<?php echo site_url(); ?>/foro/sel/lf1formula1" class="<?php echo $foro_notify['foroformula1']; ?>"> Mundo Formula 1</a></li>
				<li <?php if($this->session->userdata('foroactivo')=='lf1offtopic'):?> class="menactivo" <? endif; ?>><a href="<?php echo site_url(); ?>/foro/sel/lf1offtopic" class="<?php echo $foro_notify['foroofftopic']; ?>"> Offtopic</a></li>
			</ul>
		</div>

		<h1 class="forocab"> <?php echo $this->session->userdata('tituloforo'); ?> </h1>


		<div id="mainForo">

			<? if($id):?>
			<!-- <h3>Responder a <?=$titulo;?></h3> -->
			<legend> Responder a <? echo $titulo;?></legend>
			<? else: ?>
			<!-- <h3>Escribir nuevo tema</h3> -->
			<legend>Escribir nuevo  tema</legend>

			<? endif; ?>
			<? echo validation_errors('<div class="msgErr">','</div>'); ?>

			<form name="f" action="<?=site_url()?>foro/nuevo_tema" method="post">

			    <input type="hidden" name="identificador" value="<?=$id?>">


			      <label>Escribe el titulo </label>

			      <input type="text" name="titulo" MAXLENGTH="200"  value="<?=$titulo?>" class="input-large">


			      <label> Mensaje</label>

			      <textarea name="mensaje" class="editor" ><?=$mensaje?></textarea>



			      <input type="submit" name="Submit" class="btn btn-primary" value="Enviar Mensaje" >

			  </form>


		</div>

	</div>
</div>