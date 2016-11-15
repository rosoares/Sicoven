<?php 
include 'Cabecalho.html';
include 'Menu.php';
include '../Classes/Administrador.php';
$administrador = new Administrador();
$result = $administrador->MaisVendidos();
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Produtos Mais Vendidos</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Qtd Vendida</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while ($prod = mysqli_fetch_array($result)):
                ?>
                <tr>
                    <td><?php echo $prod['nome'] ?></td>
                    <td><?php echo $prod['Qtd Vendida'] ?></td>
                </tr>
                <?php
                    endwhile; 
                 ?>
            </tbody>
        </table>
    </div>
</div>