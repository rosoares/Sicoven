<?php
include_once './Classes/Carrinho.php';
include_once './Classes/Produtos.php';
include_once './Classes/Cliente.php';
$conexao = new Conexao();
$link = $conexao->Conecta();
session_start();

$pagamento = $_POST['Pagamento'];
if ($pagamento == 1) {
    $_SESSION['carrinho']->FinalizarPedido($_SESSION['id'], $pagamento, '', '', '', '', '','');
    $sql_id_pedido = "SELECT MAX(id) AS id_pedido FROM pedidos WHERE id_cliente = " . $_SESSION['id'] . "";
    $result = mysqli_query($link, $sql_id_pedido);
    $row = mysqli_fetch_array($result);
    $id_pedido = $row[0];
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>Exemplo</title>
            <link href="css/bootstrap.css" rel="stylesheet">
            <link href="css/font-awesome.css" rel="stylesheet">
            <link href="css/docs.css" rel="stylesheet" >
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/bootstrap-social.css" rel="stylesheet">
            <link href="css/style.css">
            <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
            <script src="js/jquery-3.1.1.min.js"></script>
            <script type="text/javascript">	
            function Imprimir() {
            	var conteudo = document.getElementById('ModalComprovante').innerHTML,
           		tela_impressao = window.open('about:blank');
            	tela_impressao.document.write(conteudo);
            	tela_impressao.window.print();
            	tela_impressao.window.close();
        	};
            </script>

        </head>
        <body>
            <script type="text/javascript" src="js/bootstrap.js"></script>
            <script type="text/javascript" src="js/jquery.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <div class="cotainer-fluid">
                <div class="panel panel-warning">
                    <div class="panel-heading"><h3 class="text-center">Pedido Finalizado !</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <h5 class="text-center">Seu pedido está sendo separado</h5>
                        </div>
                        <div class="row">
                        <?php 
                        	date_default_timezone_set('America/Sao_Paulo');
                        	$hora_atual = date('H');
                        	$min_atual = date('i');
                        	$hora_busca = mktime($hora_atual+2);
                        ?>
                            <h5 class="text-center">Você tem até às <strong><?php echo date('H:i', $hora_busca) ?></strong> de hoje para buscá-lo</h5>
                        </div>
                        <div class="row">
                            <h5 class="text-center">Leve o comprovante até a loja para receber a sua compra</h5>
                        </div>
                        <br><br>
                        <div class="row">
                            <p class="text-center">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#ModalComprovante" id="Comprovante">Imprimir Comprovante</button>
                            </p>
                            <div id="ModalComprovante" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="ModalComprovante">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="text-center modal-title">Pedido</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    Nº do Pedido: <?php echo $id_pedido; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <br>
                                                <div class="col-xs-4">
                                                    Nome do Cliente: <?php echo $_SESSION['usuario']; ?> 
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row">
                                                <h4 class="text-center">Produtos</h4>
                                            </div>
                                            <?php
                                            $prod_no_carrinho = $_SESSION['carrinho']->RetornaProdutos();

                                            foreach ($prod_no_carrinho as $row) {
                                                ?>	
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        Nome do Produto: <?php echo $row->getNome(); ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        Quantidade: <?php echo $row->getQuantidade(); ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        Sub-Total: <?php echo $row->getSubTotal(); ?>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <h5><strong>Total: <?php echo $_SESSION['carrinho']->PrecoTotal(); ?> </strong></h5> 
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" onclick="Imprimir()" class="btn btn-warning">Imprimir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>


<?php
} else if ($pagamento == 2) {
	$troco = $_POST['troco'];
    $obj_cliente = new Cliente();
    $cliente = $obj_cliente->RetornaDados($_SESSION['id']);
    $_SESSION['carrinho']->FinalizarPedido($_SESSION['id'], $pagamento, $cliente['rua'], $cliente['bairro'], $cliente['numero'], $cliente['referencias'], $cliente['complemento'], $troco);
    $sql_id_pedido = "SELECT MAX(id) AS id_pedido FROM pedidos WHERE id_cliente = " . $_SESSION['id'] . "";
    $result = mysqli_query($link, $sql_id_pedido);
    $row = mysqli_fetch_array($result);
    $id_pedido = $row[0];
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>Exemplo</title>
            <link href="css/bootstrap.css" rel="stylesheet">
            <link href="css/font-awesome.css" rel="stylesheet">
            <link href="css/docs.css" rel="stylesheet" >
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/bootstrap-social.css" rel="stylesheet">
            <link href="css/style.css">
            <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
            <script src="js/jquery-3.1.1.min.js"></script>
            <script type="text/javascript">	
            function Imprimir() {
            	var conteudo = document.getElementById('ModalComprovante').innerHTML,
           		tela_impressao = window.open('about:blank');
            	tela_impressao.document.write(conteudo);
            	tela_impressao.window.print();
            	tela_impressao.window.close();
        	};
            </script>

        </head>
        <body>
            <script type="text/javascript" src="js/bootstrap.js"></script>
            <script type="text/javascript" src="js/jquery.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <div class="cotainer-fluid">
                <div class="panel panel-warning">
                    <div class="panel-heading"><h3 class="text-center">Pedido Finalizado !</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <h5 class="text-center">Seu pedido será entregue no endereço cadastrado</h5>
                        </div>
                        <div class="row">
                            <h5 class="text-center">Para sua garantia imprima o comprovante</h5>
                        </div>
                        <br><br>
                        <div class="row">
                            <p class="text-center">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#ModalComprovante" id="Comprovante">Imprimir Comprovante</button>
                            </p>
                            <div id="ModalComprovante" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="ModalComprovante">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="text-center modal-title">Pedido</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    Nº do Pedido: <?php echo $id_pedido; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <br>
                                                <div class="col-xs-4">
                                                    Nome do Cliente: <?php echo $_SESSION['usuario']; ?> 
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row">
                                                <h4 class="text-center">Produtos</h4>
                                            </div>
                                            <?php
                                            $prod_no_carrinho = $_SESSION['carrinho']->RetornaProdutos();

                                            foreach ($prod_no_carrinho as $row) {
                                                ?>	
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        Nome do Produto: <?php echo $row->getNome(); ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        Quantidade: <?php echo $row->getQuantidade(); ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        Sub-Total: <?php echo $row->getSubTotal(); ?>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <h5><strong>Total: <?php echo $_SESSION['carrinho']->PrecoTotal(); ?> </strong></h5> 
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" onclick="Imprimir()" class="btn btn-warning">Imprimir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>

<?php

} else if ($pagamento == 3) {
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $referencias = $_POST['referencias'];
    $troco = $_POST['troco'];
    $_SESSION['carrinho']->FinalizarPedido($_SESSION['id'], $pagamento, $rua, $bairro, $numero, $referencias, $complemento, $troco);
    $sql_id_pedido = "SELECT MAX(id) AS id_pedido FROM pedidos WHERE id_cliente = " . $_SESSION['id'] . "";
    $result = mysqli_query($link, $sql_id_pedido);
    $row = mysqli_fetch_array($result);
    $id_pedido = $row[0];
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>Exemplo</title>
            <link href="css/bootstrap.css" rel="stylesheet">
            <link href="css/font-awesome.css" rel="stylesheet">
            <link href="css/docs.css" rel="stylesheet" >
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/bootstrap-social.css" rel="stylesheet">
            <link href="css/style.css">
            <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
            <script src="js/jquery-3.1.1.min.js"></script>
            <script type="text/javascript">	
            function Imprimir() {
            	var conteudo = document.getElementById('ModalComprovante').innerHTML,
           		tela_impressao = window.open('about:blank');
            	tela_impressao.document.write(conteudo);
            	tela_impressao.window.print();
            	tela_impressao.window.close();
        	};
            </script>

        </head>
        <body>
            <script type="text/javascript" src="js/bootstrap.js"></script>
            <script type="text/javascript" src="js/jquery.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <div class="cotainer-fluid">
                <div class="panel panel-warning">
                    <div class="panel-heading"><h3 class="text-center">Pedido Finalizado !</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <h5 class="text-center">Seu pedido será entregue no endereço inserido</h5>
                        </div>
                        <div class="row">
                            <h5 class="text-center">Para sua garantia imprima o comprovante</h5>
                        </div>
                        <br><br>
                        <div class="row">
                            <p class="text-center">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#ModalComprovante" id="Comprovante">Imprimir Comprovante</button>
                            </p>
                            <div id="ModalComprovante" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="ModalComprovante">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="text-center modal-title">Pedido</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    Nº do Pedido: <?php echo $id_pedido; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <br>
                                                <div class="col-xs-4">
                                                    Nome do Cliente: <?php echo $_SESSION['usuario']; ?> 
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row">
                                                <h4 class="text-center">Produtos</h4>
                                            </div>
                                            <?php
                                            $prod_no_carrinho = $_SESSION['carrinho']->RetornaProdutos();

                                            foreach ($prod_no_carrinho as $row) {
                                                ?>	
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        Nome do Produto: <?php echo $row->getNome(); ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        Quantidade: <?php echo $row->getQuantidade(); ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        Sub-Total: <?php echo $row->getSubTotal(); ?>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <h5><strong>Total: <?php echo $_SESSION['carrinho']->PrecoTotal(); ?> </strong></h5> 
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" onclick="Imprimir()" class="btn btn-warning">Imprimir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>
    <?php
}
?>