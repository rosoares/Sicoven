<?php 
include 'Cabecalho.html';
include 'Menu.php';
include '../Classes/Administrador.php';
$administrador = new Administrador();
$result = $administrador->MaisCompram();
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Clientes que mais Compram</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Nº Compras Realizadas</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while ($prod = mysqli_fetch_array($result)):
                ?>
                <tr>
                    <td><?php echo $prod['nome'] ?></td>
                    <td><?php echo $prod['Nº Compras Realizadas'] ?></td>
                </tr>
                <?php
                    endwhile; 
                 ?>
            </tbody>
        </table>
    </div>
</div>