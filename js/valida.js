// $(document).on('change', '#origem', function () {

// 	let origem = $(this).val();

// 	if (origem) {
// 		$('#destino').hide();
// 		$('.carregando').show();
// 		$.ajax({
// 			url: "destino.php",
// 			type: "post",
// 			data: "origem=" + origem,
// 			success: function (j) {
// 				// var options = '<option value=""></option>';
// 				// for (var i = 0; i < j.length; i++) {
// 				// 	options += '<option value="' + j[i].id + '">' + j[i].destino + '</option>';
// 				// }
// 				console.log(j)
// 				// $('#destino').html(options).show();
// 				// $('.carregando').hide();
// 			}
// 		})
// 	} else {
// 		$('#destino').html('<option value="">Escolha a Origem</option>');
// 	}
// })

$(function () {
	$(document).on('change', '#origem', function () {

		let origemID = $(this).val();

		console.log(origemID)

		if (origemID) {
			$('.carregando').show();
			$.getJSON('destino.php?search=', { origem: origemID, ajax: 'true' }, function (j) {
				var options = '<option value="">Escolha o Destino</option>';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + '">' + j[i].destino + '</option>';
				}
				$('#destino').html(options);
				$('.carregando').hide();
			});
		} else {
			$('#destino').html('<option value="">Escolha a Origem</option>');
		}
	});

	$(document).on('click', '#reset', function () {
		$('#container').html('');
		$('#reset').hide();
	})

	$(document).on('click', '#close', function () {
		$('#container').html('');
	})

	$(document).on('click', '#simular', function () {

		let origem = $('#origem').val();
		let destino = $('#destino').val();
		let planoID = $('#plano').val();
		let tempo = $('#tempo').val();
		let planoPlano = $('#plano').attr('data-plano');

		if(validarCampos(origem, destino, planoID, tempo) == false) {
			return false;
		}

		$.getJSON('simula.php?search=', { origem: origem, destino: destino, planoID: planoID, tempo: tempo, planoPlano: planoPlano, ajax: 'true' }, function (result) {

			$('#reset').show();
			$('#container').html(`<table class="table table-bordered table-striped center">
									<thead>
										<tr>
											<th>Origem</th>
											<th>Destino</th>
											<th>Tempo (min.)</th>
											<th>Plano</th>
											<th>Com Falemais</th>
											<th>Sem Falemais</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>${result[0].origem}</td>
											<td>${result[0].destino}</td>
											<td>${result[0].tempo}</td>
											<td>${result[0].plano}</td>
											<td>${result[0].comFaleMais}</td>
											<td>${result[0].semFaleMais}</td>
										</tr>
									</tbody>
        						</table>`);
		});

	})

	function validarCampos(origem, destino, planoID, tempo) {
		if(origem == '' || destino == '' || planoID == '' || tempo == '') {
			var segundos = 5; setTimeout(function(){ $('.erro').fadeOut();}, segundos*1000)
			$('#container').html(`<div class='erro'><span style='font-weight:bold'> Erro!</span> Você precisa preencher todos os campos. <div id="close"><i class="icon-times"></i></div></div>`)
			return false;
		}
	}
});