<?php
//arquivo para testar o metodo read()

	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Conexao.php';
	include_once '../../models/Post.php';

	$db = new Conexao();
	$conexao = $db->getConexao();

	$cat = new Post($conexao);

	$resultado = $cat->read();

	$qtde_cats = sizeof($resultado);

	if($qtde_cats>0){

		echo json_encode($resultado);
	}else{
		echo json_encode(
			array('mensagem'=>'Nenhum post encontrado')
		);
	}