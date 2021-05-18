<?php 
	$acao = 'recuperar';
	require 'tarefa_controller.php';
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<script>
			$(document).on('click','.editar', (e)=>{
				var id_tarefa = $(e.target).attr('data-id-tarefa');

				//Criando formulario
				var form = $('<form></form>').addClass('row').attr({'id': 'form', 'action': 'tarefa_controller.php?acao=atualizar', 'method': 'post'});
				// criando inputs para entrada e envio de formulario
				var inputTarefa = $('<input></input>').addClass('col-md-9 form-control').attr({'type': 'text', 'name': 'tarefa', 'id': 'tarefaInput'});
				var inputSubmit = $('<input></input>').addClass('col-md-2 btn btn-info').attr({'type': 'submit', 'value': 'Atualizar'});
				//criar input oculto com o id da tarefa
				var inputId = $('<input></input>').attr({'type': 'hidden', 'name': 'id', 'id': 'tarefaInput'});
				inputId.val(id_tarefa);
				form.append(inputId,inputTarefa,inputSubmit);

				//selecionar a div tarefa
				var tarefa = $('#tarefa_'+id_tarefa);

				//limpar o texto da tarefa para inclusão do form 
				tarefa.html('');
				
				//incluir form na pagina
				$(tarefa).html(form);

				//atruindo valores aos inputs
				inputTarefa.val($(e.target).attr('data-tarefa'));

			})
			$(document).on('click', '.marcar-feita', (e)=>{
				location.href = 'todas_tarefas.php?acao=marcar-feita&id='+$(e.target).attr('data-id-tarefa');
			})
			$(document).on('click', '.excluir', (e)=>{
				location.href = 'todas_tarefas.php?acao=remover&id='+$(e.target).attr('data-id-tarefa');
			})
		</script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>
		<?php if(isset($_GET['exclusao']) && isset($_GET['exclusao']) == 1 ){ ?>
			<div class="bg-success pt-2 text-white d-flex justify-content-center">
				<h5> Tarefa removida com sucesso</h5>
			</div>
		<?php } ?>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />
								<?php foreach ($tarefas as $indice => $tarefa) { ?>
							
								<div class="row mb-3 d-flex align-items-center tarefa">
									<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>"><?= $tarefa->tarefa ?> (<?= $tarefa->status ?>)</div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger excluir" data-id-tarefa="<?= $tarefa->id ?>"></i>
										<?php if($tarefa->status == 'pendente'){ ?>
										<i class="fas fa-edit fa-lg text-info editar" data-id-tarefa="<?= $tarefa->id ?>" data-tarefa="<?= $tarefa->tarefa ?>"></i>
										<i class="fas fa-check-square fa-lg text-success marcar-feita" data-id-tarefa="<?= $tarefa->id ?>"></i>
										<?php } ?>
									</div>
								</div>

								<?php } ?>	

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>