<?php
error_reporting(0);
include './Cabecalho.php';
?>
<br><br><br><br>
<div class="container">
    <div class="row">

        <div class="col-xs-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-xs-2">#</th>
                        <th class="col-xs-3">Nome</th>
                        <th class="col-xs-2">Quantidade</th>
                        <th class="col-xs-3">Preço</th>
                        <th class="col-xs-3">Sub-Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $prod_no_carrinho = $_SESSION['carrinho']->RetornaProdutos();
                    foreach ($prod_no_carrinho as $row) {
                        ?>
                        <tr>
                            <td><img src="..."></td>
                            <td><?php echo $row->getNome()?></td>
                            <td><?php echo $row->getQuantidade()?></td>
                            <td><?php echo $row->getPreco()?></td>
                            <td><?php echo $row->getQuantidade()*$row->getPreco()?></td>
                        </tr>
                        <?php
                    }
                    ?>
                        <tr class="col-xs-offset-5"> 
                            <td>Total = <?php echo $_SESSION['carrinho']->PrecoTotal(); ?></td>
                        </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
</body>
</html>
