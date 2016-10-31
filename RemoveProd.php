<?php
    include_once './Classes/Produtos.php';
    include_once './Classes/Carrinho.php';
    
    session_start();
    $id = $_POST['id'];
    $prod_no_carrinho = $_SESSION['carrinho']->RetornaProdutos();
    $cont = 0;
    echo $cont;
    foreach ($prod_no_carrinho as $row) {
    	$cont++;
    	if($row->getId() == $id){
    		$_SESSION['carrinho']->Remove($cont);
            echo 1;
    		break;
    	}
    }
?>