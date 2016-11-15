<?php  
include 'Cabecalho.html';
include 'Menu.php';
include '../Classes/Administrador.php';
$administrador = new Administrador();
$result = $administrador->PedidosdoDia();
$total = mysqli_fetch_array($result);
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Total de Pedidos do Dia</h1>
    <div class="row">
        <h3>Total de Pedidos do dia = <?php echo $total['Total Pedidos do Dia'] ?>
    </div>
</div>
?>