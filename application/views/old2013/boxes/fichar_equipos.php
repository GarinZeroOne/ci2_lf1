



<div class="row">

	<div class="span12">

		<div class="migas">
		    <?php echo anchor('boxes',$this->lang->line('fich_equipo_lbl_boxes'))
                            .' <span>></span> '.$this->lang->line('fich_equipo_lbl_com_equipos'); ?>
		</div>


	</div>

</div>


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

	<div class="span3">
		<h3 class="boxcab"><? echo $this->lang->line('fich_equipo_lbl_com_equipos')?></h3>
		<p><? echo $this->lang->line('fich_equipo_prf1')?></p>
		<p><? echo $this->lang->line('fich_equipo_prf2')?></p>

		<div class="ads" style="margin-top:20px;">

        <script type="text/javascript"><!--
			google_ad_client = "ca-pub-2361705659034560";
			/* box_Vertical */
			google_ad_slot = "9879140339";
			google_ad_width = 120;
			google_ad_height = 600;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>

      	</div>


	</div>


	<div class="span9">
		<h3 class="boxcab"><? echo $this->lang->line('fich_equipo_lbl_cartera_equipos')?></h3>

		<div class="carteraEquipos">



			<form method=post action="<?=site_url()?>/boxes/fichar_equipos">

			<div class="botoncompra">
				<input type="submit" value="<? echo $this->lang->line('fich_equipo_btn_comprar')?>" class="btn btn-primary">
			</div>

			<?php
			$color_ojeador = 'style="color:#ff8000;"' ;
			$color = ' style="color:#00FFEA;"';
			$i=0;
			foreach($info_equipos as $equipo):
			?>


					<div class="equipobox">
						<img src="<?=base_url()?>img/equipos/<?=$equipo->foto;?>.jpg" /> <br>
						<span class="cComprar">
							<input class="checkCompra" type="checkbox" name="equipo[]" value="<?=$equipo->id?>"   >
						</span>

						<?echo $equipo->escuderia;?>
						<span
						<?=$color;?>><?echo number_format($equipo->precio_compra, 0, ",", ".")?> €  <br>
						<b <?=$color_ojeador;?>  > ( <? echo number_format(($equipo->precio_compra - ($equipo->precio_compra * $ojeadores)), 0, ",", ".");?> € )</b>
						</span>
					</div>



			<?php
			++$i;
			endforeach;?>

			</form>

		</div> <!-- cartera equipos -->

	</div>
</div>












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



</div>