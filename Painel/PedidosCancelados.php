<?php 
include 'Cabecalho.html';
include 'Menu.php';
include '../Classes/Administrador.php';
$administrador = new Administrador();
$result = $administrador->PedidosCanceladosdoDia();
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Pedidos Cancelados do Dia</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nº do Pedido</th>
                    <th>Valor Total</th>
                    <th>Tipo de Entrega</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while ($prod = mysqli_fetch_array($result)):
                    	if($prod['tipo_entrega'] == 1){
                    		$entrega = "Buscar na Loja";
                    	}
                    	else{
                    		$entrega = "Entrega";
                    	}
                ?>
                <tr>
                    <td><?php echo $prod['id'] ?></td>
                    <td><?php echo $prod['valor_total'] ?></td>
                    <td><?php echo $entrega ?></td>
                    <td>
                    	<form action="" method="post">
                    		<input type="hidden" name="id" value="<?php echo $prod['id'] ?>">
                    		<button class="btn btn-danger" type="submit" name="Excluir">Excluir</button>
                    	</form>
                    </td>
                </tr>
                <?php
                    endwhile; 
                 ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
	if(isset($_POST['Excluir'])){
		if($administrador->ApagaPedido($_POST['id'])){
			echo "<script>
				alert('Excluído!');
			</script>";
		}
	}
?>