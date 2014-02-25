
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




				<?php if($_SESSION['id_usuario']): ?>
					<span>

					<?=anchor('foro/responder/'.$id_tema_padre,'Responder');?>
				</span>

				<?php else:?>


						<span class="noLogTip"><i>Logeate para publicar o responder mensajes.</i></span>
				<?php endif;?>

				<br>


				<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="table table-striped">
				<? foreach($temas as $tema):?>


					<tr bgcolor="<?=$color?>">
						<td  valign="top" style="width: 15%;">
						<b><a name="<?=$tema->id?>"><?php echo anchor('usuarios/perfil/'.$tema->autor,$tema->autor);?></a></b><br>
						<font size="-2"><?php echo timeago(strtotime($tema->enviado)); ?></font>
						<span class="f_avatar">
							<img src="<?php echo base_url(); ?>img/avatares/<?php echo $tema->avatar; ?>" />
						</span>
						</td>
						<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="innermsj">
						<tr>
						<td class="tit"><strong><font size="-1">
						<?=$tema->titulo?>
						</font></strong> </td>
						<td width="10%" align="right" class="tit"> <a href="<?=site_url()?>foro/responder/<?=$id_tema_padre?>/<?=$tema->id?>">CITAR</a></td>
						</tr>
						</table>
					<!--<hr align="center" width="100%" size="2" noshade>-->
					<? echo $tema->mensaje;?>


				</td>
					</tr>



				<? endforeach;?>
				</table>

			</div>


	</div>

</div>


