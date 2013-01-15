<?php 
require_once("classes/clientes.class.php");
	$cliente = new clientes();

	$cliente->setValor('nome','Djalma');
	$cliente->setValor('sobrenome','Toledo');

	$cliente->inserir($cliente);

	echo '<pre>';
	print_r($cliente);
	echo '</pre>';
	echo $cliente->linhasafetadas.' registro(s) incluido(s) com sucesso';
 ?>