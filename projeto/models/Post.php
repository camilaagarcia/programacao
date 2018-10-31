<?php

/**
 * 
 */
class Post
{
	//atributos correspondentes aos da tabela categoria
	public $id;
	public $titulo;
	public $texto;
	public $id_categoria;
	public $autor;
	public $dt_criacao;
	//variável para a conexão
	private $conexao;

	//sempre que um objeto é instanciado, já recebe a conexão
	public function __construct($con)
	{
		$this->conexao = $con;
	}

	//faz uma consulta e retorna o resultado
	public function read($id=null){

		if(isset($id)){ //id tem valor
			$query = "select id, titulo, texto, id_categoria, autor, dt_criacao from post where id=:id";
			//prepara a execução
			$stmt = $this->conexao->prepare($query);
			$stmt->bindParam('id', $id);
		}else{ //id não tem valor
			$query = "select id, titulo, texto, id_categoria, autor, dt_criacao from post order by titulo";
			//prepara a execução
			$stmt = $this->conexao->prepare($query);
		}
		
		//executa a consulta
		$stmt->execute();
		//transforma o resultado em um Array
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//retorna o resultado
		return $resultado;
	}

	public function create(){
		$query = 'insert into post (titulo, texto, id_categoria, autor) values (:titulo, :texto, :id_categoria, :autor)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindParam('titulo', $this->titulo);
		$stmt->bindParam('texto', $this->texto);
		$stmt->bindParam('id_categoria', $this->id_categoria);
		$stmt->bindParam('autor', $this->autor);
		try {
			$stmt->execute();
			return true;
		}catch(PDOException $e){
			echo "erro: ".$e->getMessage();
		}


/*

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		*/
	}

	public function update(){
		$query = 'update post set titulo = :titulo, texto = :texto, id_categoria = :id_categoria, autor = :autor WHERE id=:id';
		$stmt= $this->conexao->prepare($query);
		$stmt->bindParam('id', $this->id);
		$stmt->bindParam('titulo', $this->titulo);
		$stmt->bindParam('texto', $this->texto);
		$stmt->bindParam('id_categoria', $this->id_categoria);
		$stmt->bindParam('autor', $this->autor);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function delete(){
		$query = 'delete from post WHERE id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindParam('id', $this->id);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}