<?php 
require_once("classes/clientes.class.php");
	$cliente = new clientes();

	// $cliente->setValor('nome','Lucas');
	// $cliente->setValor('sobrenome','Rodrix');
	$cliente->valorpk = 5;
	// $cliente->delCampo('nome');
	// $cliente->inserir($cliente);
	// $cliente->atualizar($cliente);
	// $cliente->deletar($cliente);
	// $cliente->extras_select = "order by id DESC";
	// $cliente->selecionaTudo($cliente);
	$cliente->selecionaCampos($cliente);
	while($res = $cliente->retornaDados()):
		echo $res->id .' / '. $res->nome .' / '. $res->sobrenome .'<br />';
	endwhile;




	echo '<hr />';
	echo '<pre>';
	print_r($cliente);
	echo '</pre>';
 ?>