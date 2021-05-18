<?php


//CRUD
class TarefaService {

	private $conexao;
	private $tarefa;

	public function __construct(Conexao $conexao, Tarefa $tarefa) {
		$this->conexao = $conexao->conectar();
		$this->tarefa = $tarefa;
	}

	public function inserir() { //create
		$query = "insert into tb_tarefas(tarefa)values(:tarefa)";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':tarefa',$this->tarefa->__get('tarefa'));	
		$stmt->execute();
	}

	public function recuperar() { //read
		$query = "select t.id, s.status, t.tarefa from tb_tarefas as t left join tb_status as s on (t.id_status = s.id);";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar(){ //update
		$query = "update tb_tarefas tarefa set tarefa = :tarefa where id = :id";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
		$stmt->bindValue(':id', $this->tarefa->__get('id'));
		return $stmt->execute();
	}

	public function remover() { //delete
		$query = "delete from tb_tarefas where id = :id";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id',$this->tarefa->__get('id'));
		return $stmt->execute();
	}
	public function marcarFeita() { //marcar Feita
		$query = "update tb_tarefas tarefa set id_status = :id_status where id = :id";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
		$stmt->bindValue(':id', $this->tarefa->__get('id'));
		return $stmt->execute();
	}
	public function recuperaTarefasPendentes() { //marcar Feita
		$query = "select t.id, s.status, t.tarefa from tb_tarefas as t left join tb_status as s on (t.id_status = s.id) where s.status = 'pendente'";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
}

?>