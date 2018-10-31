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


//testar se o GET traz um id de post. Se trouxer, chama read($id)
//se nao vir id no GET, faz o read para todos read()
//se em vez de mandar id do post, vier o od de categoria, listar todos os posts daquela categoria

	if (isset($_GET['id'])){
		$resultado = $cat->read($_GET['id']);
	}elseif(isset($_GET['idcategoria'])){
		$resultado = $cat->readByCat($_GET['idcategoria']);
	}else{
		$resultado = $cat->read();
	}



	$qtde_cats = sizeof($resultado);

	if($qtde_cats>0){

		echo json_encode($resultado);
	}else{
		echo json_encode(
			array('mensagem'=>'Nenhum post encontrado')
		);
	}