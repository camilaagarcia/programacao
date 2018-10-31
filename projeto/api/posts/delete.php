<?php
header ('Content-type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){

	require_once '../../config/Conexao.php';
	require_once '../../models/Post.php';

	$dados = json_decode(file_get_contents('php://input'));

	$db = new Conexao();
	$conexao = $db->getConexao();

	$cat = new Post($conexao);
	$cat->id = $dados->id;

	if($cat->delete()){
		$dados = ['mensagem' => 'Post excluído'];
	}else{
		$dados = ['mensagem' => 'Post não excluído'];
	}
	echo json_encode($dados);
}else{
	echo json_encode(['mensagem' => 'Método não suportado']);
}