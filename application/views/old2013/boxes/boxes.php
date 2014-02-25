<div class="hero-unit">

	<div id="menuOp">

        <div class="saldoDisponible">

        </div>

		<div class="boxoption">

			<img src="<?php echo base_url() ?>img/boxes/mi_oficina.png" height="100" alt="" />
			<span> <a href="<?php echo base_url();?>mi_oficina"> Mi oficina</a> </span>
		</div>
		<!-- -->
		<div class="boxoption">
			<img src="<?php echo base_url() ?>img/boxes/fichar_pilotos.png" height="100" alt="" />
			<span> <a href="<?php echo base_url();?>boxes/fichar_pilotos"> Comprar  pilotos</a></span>
		</div>
		<!-- -->
		<div class="boxoption">
			<img src="<?php echo base_url() ?>img/boxes/fichar_equipos.png" alt="" />
			<span> <a href="<?php echo base_url();?>boxes/fichar_equipos"> Comprar equipos</a></span>
		</div>
		<!-- -->
		<div class="boxoption">
			<img src="<?php echo base_url() ?>img/boxes/stikis.png" height="100" alt="" />
			<span> <a href="<?php echo base_url();?>boxes/stikis"> Stikis</a></span>
		</div>
		<!-- -->
		<div class="boxoption">
			<img src="<?php echo base_url() ?>img/boxes/grupos.png" alt="" />
			<span> <a href="<?php echo base_url();?>grupos"> Grupos</a></span>
		</div>

		<!-- -->
		<div class="boxoption">
			<img src="<?php echo base_url() ?>img/boxes/mis_pilotos.png" height="100" alt="" />
			<span> <a href="<?php echo base_url();?>boxes/mis_pilotos"> Mis pilotos</a></span>
		</div>
		<!-- -->
		<div class="boxoption">
			<img src="<?php echo base_url() ?>img/boxes/mis_equipos.png" height="100" alt="" />
			<span> <a href="<?php echo base_url();?>boxes/mis_equipos"> Mis equipos</a></span>
		</div>

        <!-- -->
        <div class="boxoption">
            <img src="<?php echo base_url() ?>img/boxes/perfil.png" alt="" />
            <span> <a href="<?php echo base_url();?>boxes/mi_perfil"> Mi perfil</a></span>
        </div>

         <!-- -->
        <div class="boxoption">
            <img src="<?php echo base_url() ?>img/boxes/playthegurub.png" alt="Gana premios con PLAYtheGURU" style="margin-top: -4px; margin-left: 7px;" />
            <span> <a href="http://www.playtheguru.com/beta911/es/circuit.php?id_circuit=5" title="Demuestra tus conocimientos de Formula 1 y gana premios concursando en PLAYtheGURU"> PLAYtheGURU</a></span>
        </div>

	</div>



		<div id="panelTiempoGp">

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
             document.getElementById('hora').innerHTML ="<div id='countDown'> <span class='digito'>" +  Math.floor(DD) + "</span> <span class='digito'>" + Math.floor(hh) + "</span> <span class='digito'>" + Math.floor(mm) + "</span> <span class='digito'> " + Math.floor(ss) + "</span>"+
                                                          "<span class='letra'><?php echo $this->lang->line('dias'); ?></span>"+
                                                          "<span class='letra'><?php echo $this->lang->line('horas'); ?></span>"+
                                                          "<span class='letra'><?php echo $this->lang->line('minutos'); ?></span>"+
                                                          "<span class='letra'><?php echo $this->lang->line('segundos'); ?></span>"+

                                                          "</div>";
             if (hasta < hoy)
             {
              document.getElementById('hora').innerHTML = "<?php echo $this->lang->line('fin_de_semana_gp'); ?>";
              document.getElementById('msgInfo').innerHTML = "<img src='<?php echo base_url();?>/img/boxclosed.png' />";
              cleartimeout(tictac);
             }
             else
             {
              tictac = setTimeout("calcula("+anio+","+mes+","+dia+")",1000)
              document.getElementById('msgInfo').innerHTML = "<img src='<?php echo base_url();?>/img/boxopen.png' />";
             }
            }
          </script>

          <span><?php echo $this->lang->line('proximo_gp'); ?> <?php echo $paisGP;?></span>
          <span id="hora"><script>calcula("<?=$anioGP?>","<?=$mesGP?>","<?=$diaGP?>")</script></span>
          <span id="msgInfo"> </span>


        </div>




</div>



<div id="contenBox">

    <?php
    /*
    <!--  ADVERTISEMENT TAG 728 x 90, DO NOT MODIFY THIS CODE -->
	<script type="text/javascript" src="http://performance-by.simply.com/simply.js?code=25639;3;0&amp;v=2"></script>
	<script type="text/javascript">
	<!--
	document.write('<iframe marginheight="0px" marginwidth="0px" frameborder="0" scrolling="no" width="728" height="90" src="http://optimized-by.simply.com/play.html?code=119589;25503;26987;0&from='+escape(document.referrer)+'"></iframe>');
	// -->
	</script>
	*/
	?>
	<a href="http://www.playtheguru.com/beta911/es/circuit.php?id_circuit=5" title="Demuestra tus conocimientos de Formula 1 en PlaytheGuru.com">
	  <img src="<?php echo base_url();?>/img/banners/playtheguru_a.png" alt="Gana premios con PlaytheGuru.com"/>
	</a>

	<h3>Boxes</h3>
	<p>Esta es tu zona de Boxes. Desde aquí podrás gestionar tus pilotos y tus equipos.</p>
	<p>Si no tienes pilotos, tendrás que comprarlos. El sistema proporciona a todos los usuarios nuevos una cantidad de <b>250.000 €</b>(+100.000 € por GP)
	para poder empezar a fichar pilotos o equipos.</p>

	<p>Como manager del equipo podrás realizar algunas acciones para tratar de obtener los mejores beneficios posibles en cada gran premio. Desde tu  oficina
	podrás comprar una serie de mejoras, el orden y grado en que las compres ya depende de tu olfato como manager.</p>


	<br />
	Tu <b>objetivo</b> es escalar en el ranking hasta el primer puesto, para esto necesitas Puntos Manager.La siguiente lista te aclarará algunos conceptos:



	<ul>
		<li><b>Ganas dinero y puntos</b> con <strong>tus pilotos</strong> siempre que terminen la carrera.Puedes ver la tabla de puntos y dinero en las <?=anchor('inicio/reglas','reglas','style="color:#FF0000"')?>.</li>
		<li><b>Ganas dinero</b> si un equipo tuyo entra entre los <strong>5 primeros</strong></li>
		<li>Puedes vender algún piloto o equipo si no te esta dando buenos resultados. La venta de un piloto o equipo al sistema, hará que pierdas un 50% de su valor inicial.
		</li>
		<li>Cada semana recibirás 100.000 € , independientemente de los resultados.</li>
		<li>Puedes tener un máximo de <b>7 pilotos</b> y <b>5 equipos</b>.</li>
		<li> Puedes quedarte en números rojos, es decir tener en el banco saldo negativo. El máximo permito de saldo negativo es de <b>-200.000 €</b> . El saldo negativo <b>PENALIZA</b> , si empiezas un fin de semana con saldo negativo
		 los Puntos Manager que consigas en ese GP se verán reducidos dependiendo de cuanto te acerques a los -200.000 €. De igual manera el saldo positivo te otorgara Puntos Manager <b>EXTRA</b> dependiendo de la cantidad que tengas, cuanta más cantidad más Puntos Manager.En las reglas podrás encontrar una tabla más especifica.</li>
		<li>Léete bien las <?=anchor('inicio/reglas','reglas','style="color:#FF0000"')?> antes de empezar a comprar! Para unos buenos resultados es importante saberse bien las normas de puntuación
		 así como las opciones de cada piloto y cada equipo en un circuito determinado.
		</li>

	</ul>




</div>