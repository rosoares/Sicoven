<?php
include 'Cabecalho.html';
include 'Menu.php';
include '../Classes/Administrador.php';
$administrador = new Administrador();
$result = $administrador->ListaSeparacoesPendentes();
?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Pedidos que Estouraram o Prazo de Busca</h1>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nº Pedido</th>
                    <th>Total</th>
                    <th>Produtos</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                date_default_timezone_set('America/Sao_Paulo');
                $timezone = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
                while ($pedido = mysqli_fetch_array($result)) {
                    $data_pedido = new DateTime($pedido['data_hora']);
                    $data_atual = new DateTime("now");
                    $dateInterval = $data_pedido->diff($data_atual);
                    if ($dateInterval->h >= 2) {
                        ?>
                        <tr>
                            <td><?php echo $pedido['id'] ?></td>
                            <td><?php echo 'R$ ' . $pedido['valor_total'] ?></td>
                            <td><a href="Pedido.php?ped=<?php echo $pedido['id'] ?>&cli=<?php echo $pedido['id_cliente'] ?>">+ Detalhes</a></td>
                            <td>
                            </td>
                        </tr>	
                        <?php
                    }
                }
                ?>	
            </tbody>
        </table>
    </div>
</div>

