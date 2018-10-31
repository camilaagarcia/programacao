<?php
header('Content-type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'PUT'){

	require_once '../../config/Conexao.php';
	require_once '../../models/Post.php';

	$dados = json_decode(file_get_contents('php://input'));

	$db = new Conexao();
	$conexao = $db->getConexao();

	$cat = new Post($conexao);

	$cat->id = $dados->id;
	$cat->titulo = $dados->titulo;
	$cat->texto = $dados->texto;
	$cat->id_categoria = $dados->id_categoria;
	$cat->autor = $dados->autor;

	if($cat->update()){
		$dados = ['mensagem' => 'Post alterado'];
	}else{
		$dados = ['mensagem' => 'Post não criado'.$e->getMesage()];
	}
	echo json_encode($dados);
}else{
	echo json_encode(['mensagem' => 'Método não suportado']);
}