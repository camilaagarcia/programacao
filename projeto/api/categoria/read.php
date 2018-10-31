<?php
//arquivo para testar o metodo read()

	//headers
	header('Acces-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header("Access-Control-Allow-Origin: *");
	
	include_once '../../config/Conexao.php';
	include_once '../../models/Categoria.php';

	$db = new Conexao();
	$conexao = $db->getConexao();

	$cat = new Categoria($conexao);

	$resultado = $cat->read();

	$qtde_cats = sizeof($resultado);

	if($qtde_cats>0){

		echo json_encode($resultado);
	}else{
		echo json_encode(
			array('mensagem'=>'Nenhuma categorua encontrada')
		);
	}
