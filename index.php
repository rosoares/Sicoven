<?php 
    include_once './Cabecalho.php';
?>
        <script type="text/javascript">
           function MudaPreco(quant, preco, tot){
               quantidade = $("#"+quant).val();
               valorunit = $("#"+preco).val();
               total = quantidade*valorunit;
               
               $("#"+tot).val();
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
                    $result = $obj_prod->ListaProdutos();
                    while($row = mysqli_fetch_array($result)){
                ?>

                    <div id="prod" class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="..." alt="..." width="200" height="242">
                            <div class="caption">
                                <h3><?php echo $row['nome'] ?></h3>
                                <p></p>
                                <div class="row">
                                    <div>
                                        <!-- <button id="add"><span class="glyphicon glyphicon-plus-sign"></span></button> -->
                                        <div class="col-md-3">
                                            <input id="quant<?php echo $row['id'] ?>" type="number" value="1" class="form-control" name="quant<?php echo $row['id'] ?>" min="1" max="<?php echo $row['quantidade'] ?>" onchange="MudaPreco('quant<?php echo $row['id'] ?>', 'precoconst<?php echo $row['id'] ?>', 'total<?php echo $row['id'] ?>')">
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
                                        <button type="button" class="btn btn-warning"onclick="">
                                            <span class="glyphicon glyphicon-shopping-cart"></span> Adicionar
                                        </button> 

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
