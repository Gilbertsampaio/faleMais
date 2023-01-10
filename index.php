<?php
ini_set('default_charset', 'UTF-8');
include "conexao.php";
session_start();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

	<?php include 'inc/ceo.php'; ?>

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Simule o custo de sua ligação - Fale Mais</title>
	<style>
		.carregando {
			color: #666;
			display: none;
		}

		.erro {
			background-color: #de1010;
			color: #fff;
			padding: 10px;
			margin-bottom: 20px;
			border-radius: .25rem;
		}

		.erro>div {
			position: absolute;
			right: 10px;
			top: -10px;
			background: #444;
			border-radius: 50%;
			padding: 1px 8px;
			cursor: pointer;
			transition: all .3s ease;
		}

		.erro>div:hover {
			background: #000;
			transition: all .3s ease;
		}

		#reset {
			display: none;
		}
	</style>
</head>

<body class="stretched">
	<div id="wrapper" class="clearfix">
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
					<div class="row clearfix">
						<div class="col-md-12">
							<div class="heading-block border-0">
								<h3>Simular Custo de Ligação</h3>
								<span>Você está simulando o custo de uma ligação.</span>
							</div>
							<div class="clear"></div>
							<div class="row clearfix">
								<div class="col-lg-12">
									<div id="container" class="ps"></div>
									<form class="row">
										<div class="col-lg-3 form-group">
											<label id="label-origem">Origem <span></span></label>
											<select class="form-control" name="origem" id="origem">
												<?php
												$sql = mysqli_query($connect, "SELECT id, origem FROM tabela GROUP BY origem ORDER BY origem ASC");
												echo '<option value="">Escolha a Origem</option>';
												while ($ln = mysqli_fetch_object($sql)) {
													echo '<option value="' . $ln->origem . '">' . $ln->origem . '</option>';
												}
												?>
											</select>
										</div>
										<div class="col-lg-3 form-group">
											<label id="label-destino">Destino <span></span></label>
											<span class="carregando">Aguarde, carregando...</span>
											<select class="form-control" name="destino" id="destino">
												<option value="">Escolha a Origem</option>
											</select>
										</div>
										<div class="col-lg-3 form-group">
											<div class="form-group">
												<label id="label-tempo">Tempo <span></span></label>
												<input name="tempo" id="tempo" class="form-control"></input>
											</div>
										</div>
										<div class="col-lg-3 form-group">
											<label id="label-plano">Plano</label>
											<select class="form-control" name="plano" id="plano">
												<?php
												$sql = mysqli_query($connect, "SELECT id, tempo, plano FROM plano ORDER BY id ASC");
												echo '<option value="">Escolha o Plano</option>';
												while ($ln = mysqli_fetch_object($sql)) {
													echo '<option value="' . $ln->id . '">' . $ln->plano . '</option>';
												}
												?>
											</select>
										</div>

										<div class="col-lg-3">
											<div id="simular" style="margin-left: 0; width:100%;" class="button button-blue button-small"><i class="icon-check"></i> Simular</div>
										</div>
										<div class="col-lg-3">
											<button id="reset" style="margin-left: 0; width:100%;" type="reset" class="button button-green button-small"><i class="icon-sync"></i> Refazer</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<script src="js/jquery.js"></script>
	<script src="js/valida.js"></script>

</body>
</html>