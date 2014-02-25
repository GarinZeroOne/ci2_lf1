


<div class="row">

	<div class="span12">

		<div class="migas">
	    <?php echo anchor('boxes',$this->lang->line('piloto_lbl_boxes')).' <span>></span> '.
	            $this->lang->line('piloto_lbl_mis_pilotos'); ?>
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



<div class="row">

	<div class="span6">

		<h3 class="boxcab"><? echo $this->lang->line('piloto_lbl_mis_pilotos')?></h3>

		<p><? echo $this->lang->line('piloto_prf1')?></p>





	</div> <!-- /span6 -->

	<div class="span6">

		<h3 class="boxcab">Pilotos fichados</h3>

		<div id="pilotosFichados" align="center">


		<form method="post" action="<?=site_url()?>/boxes/mis_pilotos">

			<?php if($info_pilotos): ?>

			<div class="botoncompra">

				<input type="submit" value="<? echo $this->lang->line('piloto_btn_vender')?>" class="btn btn-primary">
			</div>

			<?php

			$i=0;
			foreach($info_pilotos as $piloto):
				// color precio
				$color = ' style="color:#008080;"';


			?>


						<!--
						<img src="<?=base_url()?>img/pilotos/<?=$piloto->foto;?>.jpg" />

						<span <?=$color;?>><?echo number_format($piloto->dinero_venta, 0, ",", ".")?> €</span>

						<span><?echo $piloto->nombre." ".$piloto->apellido;?>  </span>

						<span><?echo $piloto->pais?> </span>

						<span><?echo $piloto->escuderia?> </span>
						<span><input <?=$permitir?> type=checkbox name=piloto[] value="<?=$piloto->id?>"  ></span>

						<span><?echo $piloto->puntos?></span>

					-->

					<div class="pilotobox">
						<img src="<?=base_url()?>img/pilotos/<?=$piloto->foto;?>.jpg" />

						<span class="precioBase"><?echo number_format($piloto->dinero_venta, 0, ",", ".")?> €</span>






						<span class="nombrePiloto"><?echo $piloto->nombre." ".$piloto->apellido;?>  </span>

						<span class="paisPiloto"><?echo $piloto->pais?> </span>

						<span class="escuderia"><?echo $piloto->escuderia?> </span>
						<span class="cComprar"><input class="checkCompra"  type="checkbox" name=piloto[] value="<?=$piloto->id?>"  > </span>
						<span class="puntosCon" title="Puntos que este piloto te ha conseguido"> <?echo $piloto->puntos?> </span>


					</div>






			<?php
			$i++;
			endforeach;	?>

			</form>

			<?php else:	?>

			 <i>No dispones de ningún piloto en estos momentos. Visita la <a href="<?php echo site_url();?>boxes/fichar_pilotos">cartera de pilotos</a> para fichar alguno antes del siguiente gran premio.</i>

			<?php endif; ?>






		<?php echo $ventaTxt;
		?>
	</div>

	</div> <!-- /span6 -->

</div>


