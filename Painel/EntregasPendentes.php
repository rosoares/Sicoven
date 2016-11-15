<?php
include '../Classes/Administrador.php';

$administrador = new Administrador();
$result = $administrador->ListaPedidosPendentes();
?>

        <?php include './Cabecalho.html'; ?>
    
        <div class="container-fluid">
            <div class="row">
                <?php include 'Menu.php'; ?>
                
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">Entregas Pendentes</h1>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nº Pedido</th>
                                    <th>Total</th>
                                    <th>Produtos</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($pedidos = mysqli_fetch_array($result)){ ?>
                                <tr>
                                    <td><?php echo $pedidos['id'] ?></td>
                                    <td><?php echo 'R$ '.$pedidos['valor_total'] ?></td>
                                    <td><a href="Pedido.php?ped=<?php echo $pedidos['id'] ?>&cli=<?php echo $pedidos['id_cliente'] ?>">+ Detalhes</a></td>
                                    <td>
                                        <?php if($pedidos['status'] == 0){ ?>
                                        <p class="text-danger">Pendente</p>
                                        <?php
                                              }
                                              else if($pedidos['status'] == 2){
                                        ?>
                                        <p class="text-success">Saiu para entrega</p>
                                        <?php }?>
                                    </td>
                                </tr>
                                <tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="../../assets/js/vendor/holder.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
