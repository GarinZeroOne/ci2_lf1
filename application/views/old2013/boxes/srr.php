
<div class="row">
	<div class="span12">

       <div id="msg">
		<?php echo $msgInfo;	?>
		</div>

	</div>

</div>

<div class="row">

	<div class="span6">

		<h3 class="boxcab">
			Tabla de  recompensas
		</h3>

		<table class="table table-striped table-bordered">
	<tr>
		<td> <span class="srrf"></span> </td>
		<td> 45.000 € </td>

	</tr>

	<tr>
		<td>
			<span class="srrf"></span>
			<span class="srrf"></span>

		</td>
		<td> 60.000 € </td>

	</tr>

	<tr>
		<td>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>

		</td>
		<td> 100.000 € </td>

	</tr>

	<tr>
		<td>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>

		</td>
		<td> 170.000 € </td>

	</tr>

	<tr>
		<td>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>

		</td>
		<td> 290.000 € </td>

	</tr>

	<tr>
		<td>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>

		</td>
		<td> 400.000 €</td>

	</tr>

	<tr>
		<td>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>

		</td>
		<td> 520.000 € </td>

	</tr>

	<tr>
		<td>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
		</td>
		<td> 660.000 € </td>

	</tr>

	<tr>
		<td>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>

		</td>
		<td> 790.000 € </td>

	</tr>

	<tr>
		<td>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>
			<span class="srrf"></span>

		</td>
		<td> 1.000.000 € </td>

	</tr>
</table>

	</div>

	<div class="span6">

		<h3 class="boxcab">Canjear mis estrellas</h3>
		<p>Cada vez que finalice un gran premio, tu S.R.R aumentará en 1.Para poder canjear tus estrellas por dinero, necesitas un S.R.R de 3 o más. Cuando decidás canjear tus estrellas, estas desaparecerán junto con tus S.R.R acumulados y se te ingresará el dinero  indicado. Podrás volver a canjear más  estrellas una vez vuelvas a tener un S.R.R mínimo de 3.</p>


		<?php if($srr<3): ?>
		<div class="boxSrr"> Tu valor S.R.R <span class="valSrr"> <?php echo $srr; ?> </span> </div>

		<div class="boxCan">

			<button href="" class="btn" disabled="disabled"> Canjear mis estrellas </button>
		</div>

		<?php else: ?>

		<div class="boxSrrAct"> Tu valor S.R.R <span class="valSrr"> <?php echo $srr; ?> </span> </div>

		<div class="boxCan">

			<form action="<?php echo site_url(); ?>boxes/srr" method="post" accept-charset="utf-8">
				<input name="srrval" value="<?php echo $srr; ?>" type="hidden" />
				<input type="submit" class="btn btn-success" value="Canjear mis estrellas">
			</form>
		</div>


		<?php endif; ?>
	</div>

</div>

<div class="row">

	<div class="span12">

		<h3 class="boxcab">
			Histórico de S.R.R
		</h3>

		<table class="table table-striped table-bordered">
			<th>Gran Premio</th> <th> Numero de estrellas</th> <th>Fecha canjeadas</th>
			<?php if($historico): ?>

				<?php foreach($historico as $h): ?>
					<tr>
						<td> <?php echo $h->circuito; ?> </td>
						<td> <?php echo ($h->num_estrellas/2); ?> </td>
						<td> <?php echo $h->fecha_utilizacion; ?> </td>
					</tr>
				<?php endforeach; ?>

			<?php else: ?>

			<?php endif; ?>


		</table>

	</div>

</div>
