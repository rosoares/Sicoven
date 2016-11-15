<?php 
    session_start();
    if (empty($_SESSION['admin'])) {
        header("Location: index.php");
    }
    var_dump($_SESSION['admin']);
?>
<div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <!--<li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>-->
            <li><a href="ProdutosCadastrados.php">Alterar Produtos</a></li>
            <li><a href="CadastrarProd.php">Cadastro de Produtos</a></li>
            <li><a href="EstornarEstoque.php">Estorno de Estoque</a></li>
            <li><a href="EntregasPendentes.php">Entregas Pendentes</a></li>
            <li><a href="SeparacoesPendentes.php">Pedidos para Separação</a></li>
            <li><a href="Relatorios.php">Relatórios </a></li>
          </ul>
        </div>