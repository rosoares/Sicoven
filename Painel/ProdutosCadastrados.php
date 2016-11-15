<?php
include 'Cabecalho.html';
include 'Menu.php';
include '../Classes/Produtos.php';
$produtos  = new Produtos();
$result = $produtos->ListaProdutos();
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Produtos Cadastrados</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Estoque</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while ($prod = mysqli_fetch_array($result)):
                ?>
                <tr>
                    <td></td>
                    <td><a href="Produtos.php?id=<?php echo $prod['id'] ?>"><?php echo $prod['nome'] ?></a></td>
                    <td><?php echo $prod['estoque'] ?></td>
                    <td> R$ <?php echo $prod['preco'] ?></td>
                </tr>
                <?php
                    endwhile; 
                 ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>