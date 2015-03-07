
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!-- page start-->

		<?php /*         * ****** MENSAJE MERCADO ABIERTO / CERRADO *************** */ ?>
		<?php if ($this->session->flashdata('msg_boxes')): ?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-block alert-danger fade in">
					<button type="button" class="close close-sm" data-dismiss="alert">
						<i class="fa fa-times"></i>
					</button>
					<strong>Mercado cerrado!</strong>
					<?php echo $this->session->flashdata('msg_boxes'); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php /*         * ****** MENSAJE MERCADO ABIERTO / CERRADO *************** */ ?>

		<div class="row">
			<div class="col-md-8">
				<section class="panel">

					<div class="panel-body">
						<p>Información mercado equipos:</p>
						<ul class="ulpilotos">
							<li>El precio de los equipos <strong>varia a diario</strong> en
								función de las <strong>compras/ventas o inactividad</strong>
								que haya recibido el dia anterior.
							</li>
							<li>El precio de los equipos variará despues de cada Gran
								Premio, en base a sus resultados.</li>
							<li>Los <strong>equipos este año generan dinero y puntos</strong>
								dependiendo de sus resultados. La posición final de un equipo
								en el GP se medirá con la suma de la actuación de sus dos
								pilotos (clasificación de constructores del GP).
							</li>

						</ul>
					</div>
				</section>
			</div>

			<div class="col-md-4 hidden-sm">

				<!--Ultimos fichajes start-->
				<section class="panel">
					<header class="panel-heading"> Publicidad </header>
					<div class="panel-body">

						<div align="center">
							<script async
								src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<!-- Cuadrado2014display -->
							<ins class="adsbygoogle"
								style="display: inline-block; width: 300px; height: 250px"
								data-ad-client="ca-pub-2361705659034560"
								data-ad-slot="9275287139"></ins>
							<script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
						</div>

					</div>
				</section>
				<!--Ultimos fichajes end-->

			</div>

		</div>

		<?php if (isset($msgFichaje['codigoOperacion'])): ?>

		<div class="row">
			<div class="col-sm-12">
				<section class="panel">
					<?php if ($msgFichaje['codigoOperacion']): ?>
					<div class="alert alert-block alert-success fade in">
						<button type="button" class="close close-sm" data-dismiss="alert">
							<i class="fa fa-times"></i>
						</button>
						<?php echo $msgFichaje['mensaje']; ?>
					</div>
					<?php else: ?>
					<div class="alert alert-block alert-danger fade in">
						<button type="button" class="close close-sm" data-dismiss="alert">
							<i class="fa fa-times"></i>
						</button>
						<strong>Opps!</strong>
						<?php echo $msgFichaje['mensaje']; ?>
					</div>
					<?php endif; ?>
				</section>
			</div>
		</div>
		<?php endif; ?>

		<div class="row">
			<div class="col-sm-12">
				<section class="panel">
					<header class="panel-heading"> Mercado equipos </header>
					<div class="panel-body">
						<?php print_r($misEquipos);?>
						<section id="unseen">
							<table class="table table-bordered table-striped table-condensed">
								<thead>
									<tr>
										<th>Equipo</th>
										<th class="numeric">Precio Anterior</th>
										<th class="numeric">Cambio</th>
										<th class="numeric">Cambio %</th>
										<th class="numeric">Precio actual</th>
										<th class="numeric">Precio más alto</th>
										<th class="numeric">Precio mas bajo</th>
									</tr>
								</thead>
								<tbody>

									<?php foreach ($equipos as $equipo): ?>
									<tr>
										<td><a
											href="<?php echo site_url() . 'mercado/fichaEquipo/' . $equipo->getIdEquipo(); ?>"><?php echo $equipo->getEscuderia(); ?>
										</a></td>
										<td class="numeric"
											style="background-color: rgb(255, 249, 239); color: rgb(188, 164, 108);"><?php echo $equipo->getValorAnterior(true); ?>
										</td>
										<td class="numeric"><?php
										if ($equipo->getCambioValor() > 0):
										?> <i class="fa fa-angle-double-up"
											style="color: rgb(90, 157, 29); font-size: 16px;"></i> <span
											style="color: rgb(90, 157, 29);"> <?php elseif ($equipo->getCambioValor() < 0) : ?>
												<i class="fa fa-angle-double-down"
												style="color: rgb(255, 0, 0); font-size: 16px;"></i> <span
												style="color: rgb(255, 0, 0);"> <?php
												else:
												?> <i class="fa fa-minus"font-size: 16px;></i> <?php
												endif;
												echo $equipo->getCambioValor(true);
												?>
											</span>
										
										</td>
										<td class="numeric"><?php
										if ($equipo->getCambioValor() > 0):
										?> <i class="fa fa-angle-double-up"
											style="color: rgb(90, 157, 29); font-size: 16px;"></i> <span
											style="color: rgb(90, 157, 29);"> <?php elseif ($equipo->getCambioValor() < 0) : ?>
												<i class="fa fa-angle-double-down"
												style="color: rgb(255, 0, 0); font-size: 16px;"></i> <span
												style="color: rgb(255, 0, 0);"> <?php
												else:
												?> <i class="fa fa-minus"font-size: 16px;></i> <?php
												endif;
												echo $equipo->getCambioPorcentaje(true);
												?>
											</span>
										
										</td>
										<td class="numeric"><a
											href="<?php echo site_url() . 'mercado/comprarEquipo/' . $equipo->getIdEquipo(); ?>"
											class="btn btn-success btn-xs confirm"> <i
												class="fa fa-shopping-cart"></i> <?php echo $equipo->getValorActual(true); ?>
										</a></td>
										<td class="numeric"
											style="background-color: rgb(253, 242, 255); color: rgb(162, 122, 170);"><?php echo $equipo->getValorMax(true); ?>
										</td>
										<td class="numeric"
											style="background-color: rgb(255, 237, 237); color: rgb(191, 120, 120);"><?php echo $equipo->getValorMin(true); ?>
										</td>
									</tr>
									<?php endforeach; ?>

								</tbody>
							</table>
						</section>
					</div>
				</section>
			</div>
		</div>
		<!-- page end-->
	</section>
</section>
<!--main content end-->
