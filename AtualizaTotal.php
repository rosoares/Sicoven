<?php
	include './Classes/Carrinho.php';
	session_start();
	$produto = $_SESSION['carrinho']->RetornaProdutos();
	$preco = $_POST['preco'];
	$quantidade = $_POST['quantidade'];
	$id = $_POST['id'];
	foreach ($produto as $row) {
		if($row->getId() == $id){
			$row->setPreco($preco);
			$row->setQuantidade($quantidade);
		}
	}
	$total = $_SESSION['carrinho']->PrecoTotal();
	echo $total;
?>