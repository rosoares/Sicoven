<?php 

    include_once './Classes/Produtos.php';
    include_once './Classes/Carrinho.php';
    if(empty($_SESSION)){
        header("Locarion: Foi.php");
    }
        
    session_start();
    
    $obj_prod = new Produtos();
    $id = $_POST['id'];
    $qt = $_POST['qt'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = '';
    
    $obj_prod->setId($id);
    $obj_prod->setQuantidade($qt);
    $obj_prod->setNome($nome);
    $obj_prod->setPreco($preco);
    
    $_SESSION['carrinho']->Adiciona($obj_prod);
    $totitems = $_SESSION['carrinho']->TotalItems();
    $totpreco = $_SESSION['carrinho']->PrecoTotal();
    echo '<a id="link-carrinho" href="GetCarrinho.php"><button type="button" class="btn btn-success navbar-btn"> <span class="glyphicon glyphicon-shopping-cart"></span> Carrinho <span class="badge">'.$totitems.'</span> </button></a>';
?>