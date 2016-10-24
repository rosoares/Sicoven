<?php 

    include_once './Classes/Produtos.php';
    include_once './Classes/Carrinho.php';
    session_start();
    if(empty($_SESSION)){
        header("Location: Foi.php");
    }
        
    
    $obj_prod = new Produtos();
    $id = $_POST['id'];
    $qt = $_POST['qt'];
    $result = $obj_prod->ListaProduto($id);
    $produto = mysqli_fetch_array($result);
    
    $obj_prod->setId($id);
    $obj_prod->setNome($produto['nome']);
    $obj_prod->setQuantidade($qt);
    $obj_prod->setPreco($produto['preco']);
    $obj_prod->setDescricao($produto['descricao']);

    if($_SESSION['carrinho']->Adiciona($obj_prod)){
        echo 1;
    }
    else
        echo 0;
    
?>