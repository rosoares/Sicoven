<?php  
include 'Cabecalho.html';
include 'Menu.php';
include '../Classes/Administrador.php';
$administrador = new Administrador();
$result = $administrador->TotalVendasdoDia();
$total = 0;
while ($row = mysqli_fetch_array($result)) {
	$val = str_replace(',', '.', $row['valor_total']);
	$total += $val;	
}
$total = str_replace('.', ',', $total);

?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Total de Pedidos do Dia</h1>
    <div class="row">
        <h3>Valor Total Vendido = <?php echo 'R$ '.$total; ?>
    </div>
</div>
?>