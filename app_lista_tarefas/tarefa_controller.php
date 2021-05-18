<?php

	require "../../app_lista_tarefas/tarefa.model.php";
	require "../../app_lista_tarefas/tarefa.service.php";
	require "../../app_lista_tarefas/conexao.php";

	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	if($acao == 'inserir'){

		$tarefa = new Tarefa();
		$tarefa->__set('tarefa', $_POST['tarefa']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->inserir();	

		header('Location: nova_tarefa.php?inclusao=1');
	}else if($acao == 'recuperar'){
		$tarefa = new Tarefa();
		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefas = $tarefaService->recuperar();

	}else if($acao == 'atualizar'){
		$tarefa = new Tarefa();
		$tarefa->__set('id', $_POST['id'])->__set('tarefa', $_POST['tarefa']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa); 
		if($tarefaService->atualizar()){
			if(isset($_GET['pag']) && $_GET['pag']=='index'){
				header('location: index.php');
			}else{
				header('location: todas_tarefas.php');
			}
			
		}

	}else if($acao == 'remover'){
		$tarefa = new Tarefa();
		$tarefa->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa); 
		if($tarefaService->remover()){

			if(isset($_GET['pag']) && $_GET['pag']=='index'){
				header('location: index.php?exclusao=1');
			}else{
				header('location: todas_tarefas.php?exclusao=1');
			}
			
		}

	}else if($acao == 'marcar-feita'){
		$tarefa = new Tarefa();
		$tarefa->__set('id', $_GET['id'])->__set('id_status', 2);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa); 
		
		if($tarefaService->marcarFeita()){
			if(isset($_GET['pag']) && $_GET['pag']=='index'){
				header('location: index.php?marcado=1');
			}else{
				header('location: todas_tarefas.php?marcado=1');
			}
			
		}

	}else if($acao == 'recuperar-pendentes'){
		$tarefa = new Tarefa();
		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefas = $tarefaService->recuperaTarefasPendentes();
	}
?>