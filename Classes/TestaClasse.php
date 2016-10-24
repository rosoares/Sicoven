<?php 

    include './Carrinho.php';
    include_once './Produtos.php';
    
    $carrinho = new Carrinho();
    
    $obj_prod1 = new Produtos();
    $obj_prod1->setId(1);
    $obj_prod1->setNome("Pão");
    $obj_prod1->setQuantidade(5);
    $obj_prod1->setPreco(10.52);
    $obj_prod1->setDescricao('');
    
    $obj_prod2 = new Produtos();
    $obj_prod2->setId(1);
    $obj_prod2->setNome("Pão");
    $obj_prod2->setQuantidade(2);
    $obj_prod2->setPreco(10.50);
    $obj_prod2->setDescricao('');
    
    $obj_prod3 = new Produtos();
    $obj_prod3->setId(2);
    $obj_prod3->setNome("Pão F");
    $obj_prod3->setQuantidade(20);
    $obj_prod3->setPreco(10.01);
    $obj_prod3->setDescricao('');

    $obj_prod4 = new Produtos();
    $obj_prod4->setId(2);
    $obj_prod4->setNome("Pão F");
    $obj_prod4->setQuantidade(10);
    $obj_prod4->setPreco(10.01);
    $obj_prod4->setDescricao('');

    $obj_prod5 = new Produtos();
    $obj_prod5->setId(3);
    $obj_prod5->setNome("Bolo de Limão");
    $obj_prod5->setQuantidade(2);
    $obj_prod5->setPreco(25);
    $obj_prod5->setDescricao('');

    $obj_prod6 = new Produtos();
    $obj_prod6->setId(4);
    $obj_prod6->setNome("Bolo de Limão");
    $obj_prod6->setQuantidade(1);
    $obj_prod6->setPreco(25);
    $obj_prod6->setDescricao('');
    
    
    $carrinho->Adiciona($obj_prod1);
    $carrinho->Adiciona($obj_prod2);
    $carrinho->Adiciona($obj_prod3);
    $carrinho->Adiciona($obj_prod4);
    $carrinho->Adiciona($obj_prod5);
    $carrinho->Adiciona($obj_prod6);


    var_dump($carrinho);
    
    exit();
    
    
     
    
    
?>