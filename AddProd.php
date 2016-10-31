<?php
    include_once './Classes/Produtos.php';
    include './Classes/Carrinho.php';
    $produto = new Produtos();
    $id = $_POST['id'];
    $qt = $_POST['qt'];
    $info_produto = mysqli_fetch_array($produto->ListaProduto($id));

    $produto->setId($id);
    $produto->setNome($info_produto['nome']);
    $produto->setPreco($info_produto['preco']);
    $produto->setQuantidade($qt);
    $produto->setDescricao($info_produto['descricao']);

    session_start();
    if($_SESSION['carrinho']->Adiciona($produto)){
        echo 1;
    }
    else {
        echo 0;
    }
?>