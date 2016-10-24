<?php
include_once './Classes/Carrinho.php';
include_once './Classes/Produtos.php';
session_start();
/*if(empty($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = new Carrinho();
} */
if(empty($_SESSION['usuario'])){
    $_SESSION['usuario'] = "";
}

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
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        
    </head>
    <body>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <nav class="navbar navbar-fixed-top navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                    <div class="text-right" id="btn-carrinho">   
                        <?php 
                        if(!empty($_SESSION['usuario'])){
                        ?>
                        <span style="position: absolute; top: 5pt; right: 15px;">
                            <ul class="nav nav-pills">
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="Logout.php" role="button" aria-haspopup="true" aria-expanded="false">Olá <?php echo $_SESSION['usuario'] ?></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">One more separated link</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </span>
                        <div style="position: relative; right: 18pt; top: 1pt;"><a id="link-carrinho" href="GetCarrinho.php"><button type="button" class="btn btn-success navbar-btn"> <span class="glyphicon glyphicon-shopping-cart"></span> Carrinho <span class="badge"><?php echo $_SESSION['carrinho']->TotalItems(); ?></span> </button></a></div>
                        <?php
                        }
                        else{
                        ?>
                        <a href="Login.php"><button class="btn btn-success navbar-btn">Login</button></a>
                        <a href="Cadastro.php"><button class="btn btn-success navbar-btn">Cadastre-se</button></a>
                  <?php }?>
                    </div> 
                </div>
                <!-- /.nav-collapse -->
            </div><!-- /.container -->
        </nav><!-- /.navbar -->
        