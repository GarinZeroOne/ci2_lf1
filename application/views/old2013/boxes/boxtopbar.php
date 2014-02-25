
<script>
            function calcula(anio,mes,dia)
            {
            var montharray=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")
             hoy = new Date()
             hasta = new Date(montharray[mes-1]+" "+ (dia-1) +","+anio+" 00:00") // Cambiar aquí el valor de la fecha y hora elegida.
             DD = (hasta - hoy) / 86400000

             hh = (DD - Math.floor(DD)) * 24
             mm = (hh - Math.floor(hh)) * 60
             ss = (mm - Math.floor(mm)) * 60
             document.getElementById('horat').innerHTML ="<div id='countDownt'>"+

             				"<span class='digitot'> " +  Math.floor(DD) + "</span>"+"<span class='letrat'> <?php echo $this->lang->line('dias'); ?></span>"+
             				"<span class='digitot'> " + Math.floor(hh) + "</span>"+"<span class='letrat'> <?php echo $this->lang->line('horas'); ?></span>"+
             				"<span class='digitot'> " + Math.floor(mm) + "</span>"+"<span class='letrat'> <?php echo $this->lang->line('minutos'); ?></span>"+
             				"<span class='digitot'> " + Math.floor(ss) + "</span>"+"<span class='letrat'> <?php echo $this->lang->line('segundos'); ?></span>"+




                          "</div>";
             if (hasta < hoy)
             {
              document.getElementById('horat').innerHTML = "<?php echo $this->lang->line('fin_de_semana_gp'); ?>";
              /*document.getElementById('msgInfo').innerHTML = "<img src='<?php echo base_url();?>/img/boxclosed.png' />";*/
              cleartimeout(tictac);
             }
             else
             {

              tictac = setTimeout("calcula("+anio+","+mes+","+dia+")",1000)
              /*document.getElementById('msgInfo').innerHTML = "<img src='<?php echo base_url();?>/img/boxopen.png' />";*/
             }
            }
</script>


<div class="row">

	<div class="span12">

		<div class="barinfo">
			<span class="srr" title="Sistema de recompensa a la regularidad">S.R.R : <i><?php echo $srr; ?></i></span>
      <a class="btncanjear" href="<?php echo site_url(); ?>boxes/srr"> Canjear estrellas </a>


      <?php



      switch ($num_estrellas) {

        case 0:
          #code
          ?>
          <span class="srrmo">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 1:
          # code...
          ?>
          <span class="srrm">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 2:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 3:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrm">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 4:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 5:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrm">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 6:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 7:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrm">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 8:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 9:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrm">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 10:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 11:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrm">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 12:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 13:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrm">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 14:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 15:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrm">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 16:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srro">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 17:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrm">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 18:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srro">  </span>
          <?php
        break;

        case 19:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrm">  </span>
          <?php
        break;


        case 20:
          # code...
        ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <?php
        break;

        default:
          # code...
        break;
      } ?>


      <?php if($num_estrellas>20): ?>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
          <span class="srrf">  </span>
      <?php endif;?>





			<span class="temporizador">

				<span id="horat"><script>calcula("<?=$anioGP?>","<?=$mesGP?>","<?=$diaGP?>")</script></span>

			</span>

		</div>

	</div>

</div>