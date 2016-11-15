<?php
include_once './Cabecalho.php';

?>
<script type="text/javascript">
    function MudaPreco(quant, preco, tot) {
        quantidade = $("#" + quant).val();
        valorunit = $("#" + preco).val();
        valorunit = valorunit.replace(',', '.');
        total = quantidade * valorunit;
        total = total.toFixed(2);
        total = total.toString(total);
        total = total.replace('.', ',');
        $("#" + tot).val(total);
    }

    function AddProd(id, quant, nome) {
        var Id = id;
        var Qt = $("#" + quant).val();
        $.ajax({
            data: "&id=" + Id + "&qt=" + Qt,
            type: "post",
            url: "AddProd.php",
            success:
                    function (result) {
                        alert(nome + ' Adicionado ao carrinho');
                        location.reload();
                    }
        })
    }
</script>

<div class="container">

    <nav class="navbar navbar-default">
        <div class="container">  
        </div>
    </nav>
    <div class="row">
        <?php
        $obj_prod = new Produtos();

        if(!empty($_GET['Pesquisa'])){
            $result = $obj_prod->PesquisaProdutos($_GET['Pesquisa']);
        }
        else if(empty($_GET['cat']) && empty($_GET['Pesquisa'])){
            $result = $obj_prod->ListaProdutos();
        }
        else{
            $result = $obj_prod->ListaProdutoCategoria($_GET['cat']);
        }
        while ($row = mysqli_fetch_array($result)) {
            ?>

            <div id="prod" class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="<?php echo $row['img']; ?>" alt="..." width="200" height="242">
                    <div class="caption">
                        <h3><?php echo $row['nome'] ?></h3>
                        <p></p>
                        <div class="row">
                            <div>
                                <!-- <button id="add"><span class="glyphicon glyphicon-plus-sign"></span></button> -->
                                <div class="col-md-3">
                                    <input id="quant<?php echo $row['id'] ?>" type="number" value="1" class="form-control" name="quant<?php echo $row['id'] ?>" min="1" max="<?php echo $row['estoque'] ?>" onchange="MudaPreco('quant<?php echo $row['id'] ?>', 'precoconst<?php echo $row['id'] ?>', 'total<?php echo $row['id'] ?>')">
                                </div>
                                <!-- <button id="rem"><span class="glyphicon glyphicon-minus-sign"></span></button> -->
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" id="precoconst<?php echo $row['id'] ?>" value="<?php echo $row['preco'] ?>">
                                <label>Total (R$)</label>
                                <input id="total<?php echo $row['id'] ?>" class="form-control" type="text" name="total" value= "<?php echo $row['preco'] ?>" readonly="">
                                <br>
                                <?php if (!empty($_SESSION['usuario'])) { ?>
                                    <button type="button" class="btn btn-warning" onclick="AddProd('<?php echo $row['id'] ?>', 'quant<?php echo $row['id'] ?>', '<?php echo $row['nome'] ?>')">
                                        <span class="glyphicon glyphicon-shopping-cart"></span> Adicionar
                                    </button> 
                                    <?php
                                } else {
                                    ?>
                                    <a href="Login.php"><button type="button" class="btn btn-warning" >
                                            <span class="glyphicon glyphicon-shopping-cart"></span> Adicionar
                                        </button> 
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>