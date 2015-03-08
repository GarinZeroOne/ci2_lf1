
<!--main content start-->
<section id="main-content">
	<section class="wrapper">

		<!-- publi row -->
		<div class="row">
			<div class="col-lg-12 hidden-md">
				<section class="panel-pub">
					<div class="panel-body">
						<div class="pub-cont">

							<script async
								src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<!-- HorizontalGrande2014 -->
							<ins class="adsbygoogle"
								style="display: inline-block; width: 970px; height: 90px"
								data-ad-client="ca-pub-2361705659034560"
								data-ad-slot="7256510330"></ins>
							<script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>

						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- publi row -->

		<?php /******** MENSAJE MERCADO ABIERTO / CERRADO ****************/ ?>
		<?php if($this->session->flashdata('msg_boxes')): ?>
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
		<?php /******** MENSAJE MERCADO ABIERTO / CERRADO ****************/ ?>


		<?php if (isset($msg['codigoOperacion'])): ?>
		<div class="row">
			<div class="col-sm-12">
				<section class="panel">
					<?php if ($msg['codigoOperacion']): ?>
					<div class="alert alert-block alert-success fade in">
						<button type="button" class="close close-sm" data-dismiss="alert">
							<i class="fa fa-times"></i>
						</button>
						<?php echo $msg['mensaje']; ?>
					</div>
					<?php else: ?>
					<div class="alert alert-block alert-danger fade in">
						<button type="button" class="close close-sm" data-dismiss="alert">
							<i class="fa fa-times"></i>
						</button>
						<strong>Opps!</strong>
						<?php echo $msg['mensaje']; ?>
					</div>
					<?php endif; ?>
				</section>
			</div>
		</div>
		<?php endif; ?>

		<!-- page start-->
		<div class="row">
			<div class="col-md-4">
				<section class="panel">
					<header class="panel-heading-stiki"> ¿Que son los STIKIS? </header>
					<div class="panel-body-stiki">
						<p>Los STIKIS aumentan tus posibilidades aumentando los puntos y
							el dinero de tus pilotos estrella!</p>
						<p>Este año los STIKIS son un poco diferentes, tu decides que porcentaje de STIKI darle a cada piloto hasta llegar al 100%. Este es tu límite, podrás comprar STIKIS de puntos o dinero hasta llegar a un 100%, o dicho de otra manera, entre la suma de los porcentajes de tus STIKIS de dinero y puntos no puedes superar el 100%. El como repartas ese porcentaje depende de tí!  </p>
						<ul>
							<li style="list-style: inside;"><strong style="color: #358C00">STIKI
									DE DINERO:</strong> Aumenta las ganancias del piloto que lo
								lleve. Al 100% las duplica.</li>
							<li style="list-style: inside;"><strong style="color: #DE0000">STIKI
									DE PUNTOS:</strong> Aumenta los puntos conseguidos por el
								piloto que lo lleve.Al 100% los duplica.</li>

						</ul>
						<p>Los STIKIS estan sujetos a las siguientes normas:</p>
						<ul>
							<li style="list-style: inside;">Solo los pilotos fichados pueden
								llevar stiki</li>
							<li style="list-style: inside;">La suma de todos los STIKIS no puede superar el 100%.</li>
							<li style="list-style: inside;">Un piloto solo puede llevar un tipo de
								STIKI.</li>
							<li style="list-style: inside;">El máximo de STIKIS posibles es de 10 (10% cada uno).</li>	
							<li style="list-style: inside;">.</li>	
						</ul>
					</div>
				</section>
			</div>

			<div class="col-md-8">
				<section class="panel">
					<header class="panel-heading"> Precios STIKIS </header>
					<div class="panel-body">
						<span class="badge bg-inverse">Precio base</span> <span
							class="badge bg-success" style="color: #298A08">Precio mejora
							ingenieros</span>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Tipo Stiki</th>
									<th>Descripcion</th>
									<th class="numeric">Precio al 100%</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="<?php echo base_url() ?>img/stikidinero.png">
									</td>
									<td>Stiki  de dinero</td>
									<td><?php
									$coste = 50000;
									if ($valorMejoraMecanicos > 0) {

                                            $coste_con_mejora = $coste - ($coste * $valorMejoraMecanicos);
                                        } else {
                                            $coste_con_mejora = $coste;
                                        }
                                        echo "<div style='margin-bottom:5px;' class='badge bg-inverse'>".number_format($coste, 0, ',', '.') . " €</div><br><div  class='badge bg-success' style=\"color:#298A08\"> <span  id='mj-dinero' data-val='".$coste_con_mejora."'>" . number_format($coste_con_mejora, 0, ',', '.') . "</span> € </div>";
                                        ?>
									</td>
								</tr>
								<tr>
									<td><img src="<?php echo base_url() ?>img/stikipuntos.png">
									</td>
									<td>Stiki  de puntos</td>
									<td><?php
									$coste = 500000;
									if ($valorMejoraMecanicos > 0) {

                                            $coste_con_mejora = $coste - ($coste * $valorMejoraMecanicos);
                                        } else {
                                            $coste_con_mejora = $coste;
                                        }
                                        echo "<div style='margin-bottom:5px;' class='badge bg-inverse'>".number_format($coste, 0, ',', '.') . " € </div><br><div  class='badge bg-success' style=\"color:#298A08\"> <span  id='mj-puntos' data-val='".$coste_con_mejora."'>" . number_format($coste_con_mejora, 0, ',', '.') . "</span> € </div>";
                                        ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</section>
			</div>

		</div>

		<!-- FILA -->
		<div class="row">

			<div class="col-md-4">
				<section class="panel">
					<div class="panel-body">



						<aside class="profile-nav alt">

							<section class="panel">
								<div class="user-heading alt gray-bg">
									<a href="#"> <img alt=""
										src="<?= base_url() ?>img/circuitos/banderas/<?php echo $circuito->getBandera() ?>">
									</a> <a style="border: none; color: #8B8B8B;"
										href="<?php echo site_url(); ?>calendario/circuito/<?php echo $circuito->getIdCircuito(); ?>">
										<h1>
											<?php echo $circuito->getCircuito(); ?>
											<p>
												<?php echo $circuito->getPais(); ?>
											</p>
										</h1>
									</a>

								</div>
							</section>
						</aside>


						<form method="post" action="<?= site_url() ?>gestion/comprarStiki"
							class="form-horizontal">
							<input type="hidden" name="idGp"
								value="<?php echo $circuito->getIdCircuito() ?>">
							<div class="col-sm-12">
								<h4 style="display: block;">Selecciona el tipo de Stiki</h4>
								<div class="radio">
									<label> <input type="radio" name="tipoStiki" value="dinero"
										checked> <img
										src="<?php echo base_url(); ?>img/stikidinero.png"> Stiki
										dinero <span class='mny' id="calc-dinero-sd"> </span>
									</label>
								</div>
								<div class="radio">
									<label> <input type="radio" name="tipoStiki" value="puntos"> <img
										src="<?php echo base_url(); ?>img/stikipuntos.png"> Stiki
										puntos <span class='mny' id="calc-dinero-sp"> </span>
									</label>
								</div>

							</div>
							<input id="porcentajeField" type="hidden" name="porcentaje"
								value="10">
							<div class="col-md-12" style="margin-top: 20px;">
								<h4 style="display: block;">Porcentaje stiki</h4>								
								<div class="col-md-3">
									<h4>
										<span class="label label-default " id="valorPorcentaje">10%</span>
									</h4>
								</div>
								<div class="col-md-9" id="inputRange">
									<input type="range" min="0" max="100" step="10" value="10"
										name="porcentaje" id="porcentaje"
										onchange="<?php echo "modificarPorcentaje()";?>">
								</div>
							</div>

							<div class="col-sm-12" style="margin-top: 20px;">
								<h4 style="display: block;">Selecciona el piloto</h4>

								<?php if (!$misPilotos) : ?>
								<span>No tienes pilotos</span>
								<?php endif; ?>

								<?php foreach ($misPilotos as $piloto): ?>
								<?php if ($piloto->getTipoCompra() == 'fichado'):?>
								<div class="radio">
									<label> <input type="radio" name="piloto"
										value="<?php echo $piloto->getIdPiloto(); ?>">
										<div class="row">
											<div class="col-sm-3" style="text-align: center">
												<img class="round-pilots-big"
													src="<?php echo base_url(); ?>img/pilotos/<?php echo $piloto->getFoto(); ?>.jpg">
											</div>
											<div class="col-sm-9">
												<?php echo $piloto->getNombre() . " " . $piloto->getApellido() . "<br><small> " . $piloto->getEquipo()->getEscuderia() . " </small>"; ?>

											</div>
										</div>


									</label>
								</div>
								<?php endif; ?>
								<?php endforeach; ?>

							</div>
							<div class="col-sm-12"
								style="margin-top: 20px; text-align: center;">
								<input type="submit" value="Comprar stiki seleccionado"
									class="btn btn-large btn-primary">
							</div>


						</form>



					</div>
					<!-- div panel body-->
				</section>
			</div>
			<!-- FIN COL 5 -->

			<div class="col-md-8">
				<!-- COL 7-->

				<section class="panel">
					<header class="panel-heading">
						Stikis
						<?php echo $circuito->getCircuito() . " ( " . $circuito->getPais() . " )"; ?>

					</header>
					<div class="panel-body">
						<table class="table table-bordered table-striped table-condensed">
							<thead>
								<tr>
									<th>Tipo Stiki</th>
									<th>Piloto</th>
									<th class="numeric">Precio venta</th>
									<th>Fecha compra</th>
									<th>Porcentaje</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($stikisGp as $stiki): ?>
								<tr>
									<td><?php if ($stiki->getTipoStiki() == 'puntos'): ?> <img
										src="<?php echo base_url() ?>img/stikipuntos.png" class="stiki-small"> <?php else: ?>
										<img src="<?php echo base_url() ?>img/stikidinero.png" class="stiki-small"> <?php endif; ?>
									</td>
									<td>
										<div class="row">
											<div class="col-md-3" style="text-align: center">
												<img class="round-pilots"
													src="<?php echo base_url(); ?>img/pilotos/<?php echo $stiki->getPiloto()->getFoto(); ?>.jpg">
											</div>
											<div class="col-md-9">
												<?php echo $stiki->getPiloto()->getNombre() . " " . $stiki->getPiloto()->getApellido() . "<br><small>" . $stiki->getPiloto()->getEquipo()->getEscuderia() . "</small>"; ?>

											</div>
										</div>
									</td>
									<td style="vertical-align: middle"><a
										href="<?php echo site_url() . 'gestion/venderStiki/' . $stiki->getIdStiki(); ?>"
										class="btn btn-success btn-xs confirm"> <i
											class="fa fa-sign-out"></i> <?php echo $stiki->getPrecioCompra(true); ?>
									</a>
									</td>
									<td style="vertical-align: middle"><?php echo $stiki->getFechaCompra(); ?>
									</td>
									<td style="vertical-align: middle"><?php echo $stiki->getPorcentaje(); ?>%
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</section>

				<section class="panel">
					<header class="panel-heading"> Historial stikis </header>
					<div class="panel-body">
						<table class="table table-bordered table-striped table-condensed">
							<thead>
								<tr>
									<th>Tipo Stiki</th>
									<th>Piloto</th>
									<th class="numeric">Precio compra</th>
									<th>Fecha compra</th>
									<th>Porcentaje</th>
									<th style="text-align: center">Circuito</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($historialStikis as $stiki): ?>
								<?php if ($stiki->getCircuito()->getIdCircuito() != $circuito->getIdCircuito()): ?>
								<tr>
									<td><?php if ($stiki->getTipoStiki() == 'puntos'): ?> <img
										src="<?php echo base_url() ?>img/stikipuntos.png" class="stiki-small"> <?php else: ?>
										<img src="<?php echo base_url() ?>img/stikidinero.png" class="stiki-small"> <?php endif; ?>
									</td>
									<td>
										<div class="row">
											<div class="col-md-4">
												<img class="round-pilots"
													src="<?php echo base_url(); ?>img/pilotos/<?php echo $stiki->getPiloto()->getFoto(); ?>.jpg">
											</div>
											<div class="col-md-8">
												<?php echo $stiki->getPiloto()->getNombre() . " " . $stiki->getPiloto()->getApellido() . "<br><small>" . $stiki->getPiloto()->getEquipo()->getEscuderia() . "</small>"; ?>

											</div>
										</div>
									</td>
									<td style="vertical-align: middle"><?php echo $stiki->getPrecioCompra(true); ?>
									</td>
									<td style="vertical-align: middle"><?php echo $stiki->getFechaCompra(); ?>
									</td>
									<td style="vertical-align: middle"><?php echo $stiki->getPorcentaje(); ?>%
									</td>
									<td style="vertical-align: middle; text-align: center"><img
										class="round-pilots"
										src="<?php echo base_url() ?>img/circuitos/banderas/<?php echo $stiki->getCircuito()->getBandera(); ?>"
										title="<?php echo $stiki->getCircuito()->getCircuito() . " ( " . $stiki->getCircuito()->getPais() . " )"; ?>">
									</td>
								</tr>
								<?php endif; ?>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</section>


			</div>
			<!-- FIN COL 7-->


		</div>
		<!-- FIN ROW -->


		<!-- page end-->
	</section>
</section>
<!--main content end-->
