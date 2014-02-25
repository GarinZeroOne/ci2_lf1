



<div class="row">

	<div class="span12">

		<div class="migas">
		    <?php echo anchor('boxes',$this->lang->line('fich_piloto_lbl_boxes')).' <span>></span> '
                            .$this->lang->line('fich_piloto_lbl_fich_pilotos'); ?>
		</div>

		<div class="ads">

        <script type="text/javascript"><!--
        google_ad_client = "ca-pub-2361705659034560";
        /* Box_horizontal */
        google_ad_slot = "1297942735";
        google_ad_width = 728;
        google_ad_height = 90;
        //-->
        </script>
        <script type="text/javascript"
        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>

      </div>

	</div>

</div>

<!-- CONTROL DE APERTURA Y CIERRE DE BOXES -->
<?php if($boxes):?>


<div class="row">
	<div class="span12">

       <div id="msg">
		<?php echo $fichajeTxt;	?>
		</div>

	</div>

</div>


<div class="row">

	<div class="span12">
		<h3 class="boxcab"><? echo $this->lang->line('fich_piloto_lbl_fich_pilotos')?></h3>
		<p><? echo $this->lang->line('fich_piloto_prf1')?></p>
                <p><? echo $this->lang->line('fich_piloto_prf2')?></p>
		<p><? echo $this->lang->line('fich_piloto_prf3')?></p>

	</div>



</div> <!-- /row -->

<div class="row">

	<div class="span12">





	<h3 class="boxcab"><? echo $this->lang->line('fich_piloto_lbl_cartera_pilotos')?></h3>




		<div class="carteraPilotos">

			<form method=post action="<?=site_url()?>/boxes/fichar_pilotos">

			<div class="botoncompra">
				<input type="submit" value="<? echo $this->lang->line('fich_piloto_btn_comprar')?>" class="btn btn-primary">
			</div>

			<?php
			 $color_ojeador = 'style="color:#ff8000;"' ;
			 $i=0;
			 foreach($info_pilotos as $piloto):

				// Desactivar casillas de pilotos  que no podemos pagar
				/*
				if($saldoNum < $piloto->dinero_compra):
					$permitir = 'disabled=disabled';
					$color = ' style="color:#ff0000;"';
				else:
					$permitir = ' ';
					$color = ' style="color:#008080;"';
				endif;
				*/
				$color = ' style="color:#008080;"';


			?>


					<div class="pilotobox">
						<img src="<?=base_url()?>img/pilotos/<?=$piloto->foto;?>.jpg" />

						<span class="precioBase"><?echo number_format($piloto->dinero_compra, 0, ",", ".")?> € </span>


						<span class="precioOjeadores"> <b <?=$color_ojeador;?>  > ( <? echo number_format(($piloto->dinero_compra - ($piloto->dinero_compra* $ojeadores)), 0, ",", ".");?> € )</b> </span>



						<span class="nombrePiloto"><?echo $piloto->nombre." ".$piloto->apellido;?>  </span>

						<span class="paisPiloto"><?echo $piloto->pais?> </span>

						<span class="escuderia"><?echo $piloto->escuderia?> </span>
						<span class="cComprar"><input class="checkCompra"  type=checkbox name=piloto[] value="<?=$piloto->id?>"  > </span>


					</div>




			<?php

				$i++;
			endforeach?>




		</div> <!-- cartera pilotos -->






		</form>






	<!-- BOXES CERRADOS -->
	<?php else: ?>
	<div align="center">
		<img  src="<?php echo base_url().'img/boxes_cerrados.jpg'; ?>" border="0" ></img>
	</div>

	<?php endif;?>

	<?php /*
	<!--  ADVERTISEMENT TAG 728 x 90, DO NOT MODIFY THIS CODE -->
	<script type="text/javascript" src="http://performance-by.simply.com/simply.js?code=25639;3;0&amp;v=2"></script>
	<script type="text/javascript">
	<!--
	document.write('<iframe marginheight="0px" marginwidth="0px" frameborder="0" scrolling="no" width="728" height="90" src="http://optimized-by.simply.com/play.html?code=119589;25503;26987;0&from='+escape(document.referrer)+'"></iframe>');
	// -->
	</script>
	*/
	?>





	</div> <!-- /span12 -->

</div>







