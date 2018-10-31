<?php

	header('Content-Type: application/json');

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		require_once '../../config/Conexao.php';
		require_once '../../models/Post.php';
		$db = new Conexao();
		$conexao = $db->getConexao();
		$cat = new Post($conexao);
		$dados = file_get_contents("php://input");
		$dados = json_decode($dados);
		//var_dump($dados);
		$cat->titulo = $dados->titulo;
		$cat->texto = $dados->texto;
		$cat->id_categoria = $dados->id_categoria;
		$cat->autor = $dados->autor;

		if($cat->create()){
			$res = array('mensagem', 'Post criado');
		}else{
			$res = array('mensagem', 'Erro na criação do post');
		}
		echo json_encode($res);
	}else{
		echo json_encode(['mensagem' => 'Método não suportado']);
	}