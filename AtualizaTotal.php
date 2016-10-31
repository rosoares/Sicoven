<?php
	include './Classes/Carrinho.php';
	session_start();
	$total = $_SESSION['carrinho']->PrecoTotal();
	$preco = $_POST['preco'];
	$quantidade = $_POST['quantidade'];
	$subtot = $preco 
	echo $total;
?>