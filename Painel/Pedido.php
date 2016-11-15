<?php include './Cabecalho.html'; ?>
<?php include './Menu.php'; ?>
<?php
include_once '../Classes/Administrador.php';
include_once '../Classes/Cliente.php';
$administrador = new Administrador();
$cliente = new Cliente();
$id_cliente = $_GET['cli'];
$id_pedido = $_GET['ped'];
$result = $administrador->ListaProdutosPedido($id_pedido);
$result_pedido = $administrador->DadosPedido($id_pedido);
$pedido = mysqli_fetch_array($result_pedido); // Retorna dados do pedidos
$cli = $cliente->RetornaDados($id_cliente); // Retorna Dados do cliente
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Pedido <?php echo $id_pedido ?></h1>
    <?php 
    if($pedido['tipo_entrega'] == 2 || $pedido['tipo_entrega'] == 3){
    ?>
    <div class="row">
        <div class="col-xs-5">
            <h3><strong>Nome do cliente: </strong><?php echo $cli['nome']; ?></h3>
        </div>
    </div>
    <hr>
    <h3><strong>Endereço da Entrega</strong></h3>
    <div class="row">
        <div class="col-xs-4">
            <strong>Rua: </strong> <?php echo $pedido['rua'] ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <strong>Bairro: </strong> <?php echo $pedido['bairro'] ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <strong>Nº: </strong> <?php echo $pedido['numero'] ?>
        </div>
    </div>
    <?php if(!empty($pedido['referencias'])){ ?>
    <div class="row">
        <div class="col-xs-4">
            <strong>Referências: </strong> <?php echo $pedido['referencias'] ?>
        </div>
    </div>
    <?php } ?>
    <?php if(!empty($pedido['complemento'])){ ?>
    <div class="row">
        <div class="col-xs-4">
            <strong>Complemento: </strong> <?php echo $pedido['complemento'] ?>
        </div>
    </div>
    <?php } ?>
    <hr>
    <?php 
    }
    ?>
    <h3><strong>Produtos do Pedido</strong></h3>
    <div class="row">
        <div class="col-xs-8">
            <table class="table">    
                <tr>
                    <th>Nome</th>
                    <th>Quantidade</th> 
                    <th>Sub-Total</th>
                </tr>
                <?php while ($produtos_pedido = mysqli_fetch_array($result)): ?>
                <tr>
                    <td><?php echo $produtos_pedido['nome'] ?></td>
                    <td><?php echo $produtos_pedido['quantidade'] ?></td>
                    <td><?php echo $produtos_pedido['sub_total'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <br><br>
    </div>
    <hr>
    <h3><strong>Dados Complementares</strong></h3>
    <div class="row">
        <div class="col-xs-8">
            <h4><strong>Valor Total: </strong> <?php echo $pedido['valor_total'] ?></h4>
            
            <h4><strong>Troco para: </strong> <?php echo $pedido['troco'] ?></h4>
        </div>
    </div>
    <hr>
    <form class="text-right" action="" method="post">
        <button class="btn btn-danger" name="Cancela">Cancelar Pedido</button>
        <button class="btn btn-success" name="Confirmar">Confirmar Entrega</button>
        <?php 
        if($pedido['tipo_entrega'] == 2 || $pedido['tipo_entrega'] == 3){
        ?>
        <button class="btn btn-primary" name="Entrega">Sair para entrega</button>
        <?php 
        }
        ?>
    </form>
</div>

<?php 
    if(isset($_POST['Entrega'])){
        $administrador->AtualizaStatusPedido($id_pedido, 2);
        echo "<script>alert('Atualizado ! Saiu para entrega.');</script>";
    }
    else if(isset ($_POST['Confirmar'])){
        $administrador->AtualizaStatusPedido($id_pedido, 1);
        echo "<script>alert('Atualizado ! Entregue.');</script>";
    }
    else if(isset($_POST['Cancela'])){
        $administrador->AtualizaStatusPedido($id_pedido,3);
        echo "<script>alert('Cancelado !');
               location.href = 'EntregasPendentes.php';              
        </script>";
    }
?>