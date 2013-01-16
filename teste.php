<?php 
require_once("classes/clientes.class.php");
	$cliente = new clientes();

	$cliente->setValor('nome','Lucas');
	$cliente->setValor('sobrenome','Rodrix');
	$cliente->valorpk = 5;
	// $cliente->inserir($cliente);
	// $cliente->atualizar($cliente);
	$cliente->deletar($cliente);





	echo '<pre>';
	print_r($cliente);
	echo '</pre>';
	echo $cliente->linhasafetadas.' registro(s) incluido(s) com sucesso';
 ?>