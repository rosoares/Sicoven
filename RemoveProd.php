<?php
    include_once './Classes/Produtos.php';
    include_once './Classes/Carrinho.php';
    
    session_start();
    
    $pos = $_POST['id'];
    $_SESSION['carrinho']->Remove($pos-1);
    $totitems = $_SESSION['carrinho']->TotalItems();
    echo '<a type="button" data-toggle="modal" data-target=".modal-carrinho" class="btn btn-success navbar-btn"> <span class="glyphicon glyphicon-shopping-cart"></span> Carrinho <span class="badge">'.$totitems.'</span> </a>';
?>