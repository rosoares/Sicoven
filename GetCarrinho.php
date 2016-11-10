<?php
include './Cabecalho.php';
error_reporting(0);
?>

<script>
    function MudaSubTotal(quant, preco, id){
        var qt = $("#"+quant).val();
        preco = preco.replace(',','.');
        $.ajax({
            data: "&preco="+preco+"&quantidade="+qt+"&id="+id,
            url: "AtualizaTotal.php",
            type: "post",
            success: 
                function(result){
                    location.reload();
                }
        })
} 

    function RemoveProd(id){
        $.ajax({
            data: "&id="+id,
            type: "post",
            url: "RemoveProd.php",
            success:
                function(result){
                    alert("Removido");
                    location.reload();
                }
        })
    }
</script>

<br><br><br><br>
<div class="container">
    <div class="row">

        <div class="col-xs-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-xs-2"></th>
                        <th class="col-xs-3">Nome</th>
                        <th class="col-xs-1">Quantidade</th>
                        <th class="col-xs-1"></th>
                        <th class="col-xs-4">Preço Unitário</th>
                        <th class="col-xs-3">Sub-Total</th>
                        <th class="col-xs-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $prod_no_carrinho = $_SESSION['carrinho']->RetornaProdutos();
                    $totalvetor = count($prod_no_carrinho); //numero de itens no carrinho 
                    foreach ($prod_no_carrinho as $row) {
                        $info_prod = mysqli_fetch_array($row->ListaProduto($row->getId()));
                        // Muda o preço do carrinho pelo preço do banco para evitar fraude
                        $row->setPreco($info_prod['preco']); 
                        ?>
                        <tr>
                            <td><img src="..."></td>
                            <td><?php echo $row->getNome()?></td>
                            <!-- Campo de quantidade -->
                            <td><input id="quant<?php echo $row->getId() ?>" class="form-control" type="number" name="Quantidade" min="1" max="<?php echo $info_prod['estoque'] ?>" value="<?php echo $row->getQuantidade()?>" onchange="MudaSubTotal('quant<?php echo $row->getId() ?>', '<?php echo $row->getPreco() ?>', '<?php echo $row->getId() ?>');"></td>
                            <td></td>
                            <!-- Campo e Preço --> 
                            <td><?php echo $row->getPreco()?></td>
                            <td id="SubTotal<?php echo $row->getId() ?>"><?php
                                if(strlen($row->getSubtotal())==2){
                                    echo 'R$ '.$row->getSubtotal().',00';     
                                }
                                else if(strlen($row->getSubtotal())==1){
                                    echo 'R$ '.$row->getSubtotal().',00'; 
                                }
                                else{
                                    echo 'R$ '.$row->getSubtotal();
                                }   
                            ?>
                            </td>
                            </div>
                            <td><button class="btn btn-danger" onclick="RemoveProd(<?php echo $row->getId() ?>)">Remover</button></td>
                        </tr>
                        <?php
                    }
                    ?>    
                </tbody>
            </table>
                <hr>
                <div style="font-size: 180%;" align="right">
                    <strong>Total = <?php echo 'R$ '.$_SESSION['carrinho']->PrecoTotal() ?></strong>
                </div>
            <a href="FinalizarCompra.php"><button class="btn btn-success">Finalizar Compra</button></a>
        </div> 
    </div>
</div>
</body>
</html>