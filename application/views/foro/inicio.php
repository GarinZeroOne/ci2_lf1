<div class="row">
	<div class="span12">

		<div class="adszone">


			<script type="text/javascript"><!--
			google_ad_client = "ca-pub-2361705659034560";
			/* foro_indice */
			google_ad_slot = "2643578333";
			google_ad_width = 728;
			google_ad_height = 90;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>


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



	</div>

</div>


<div class="row">

	<div class="span12">

		<div id="mainForo">



				<div id="controlesForo">

					<?php if($_SESSION['id_usuario']): ?>
						<a href="<?php echo base_url()?>foro/nuevo_tema" class="btn btn-primary"> <i class="icon-comment icon-white"></i> Nuevo tema </a>
					<?php else:?>

						<!-- simply -->


			            <!-- -->

						<span class="noLogTip"><i>Logeate para publicar o responder mensajes.</i></span>



					<?php endif;?>
				</div>

				<div id="contForo">

				<table class="table table-striped table-bordered">
					<th>Tema</th><th>Respuestas</th><th>Ultimo</th><th>Autor</th>

					<?
					$i = 0;
					foreach($temas as $tema):
					$i++;
					if($i%2 == 0){
						$class = 'color1';
					}
					else{
						$class = 'color2';
					}
					?>
					<tr class="<?=$class?>">
						<td class="tema"><?=anchor('foro/ver/'.$tema->id,$tema->titulo);?></td>
						<td class="respuestas"><?=$tema->respuestas;?></td>
						<td class="fec"><?php echo timeago(strtotime($tema->ult_respuesta)); ?></td>
						<td class="autor"><?=$tema->autor?></td>
					</tr>
					<? endforeach; ?>

				</table>
				</div>

				<div id="paginador">
					<?php echo $this->pagination->create_links();?>
				</div>

			</div>



	</div>

</div>


