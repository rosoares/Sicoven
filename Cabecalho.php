<?php
include_once './Classes/Carrinho.php';
include_once './Classes/Produtos.php';
session_start();
if (empty($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = new Carrinho();
}
if (empty($_SESSION['usuario'])) {
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
        <script src="js/jquery-3.1.1.min.js"></script>

    </head>
    <body>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <nav class="navbar navbar-fixed-top navbar-default " style="background-color:yellow">
            <div class="container">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        
                        <a class="navbar-brand" href="index.php">
                            logo
                        </a>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <?php if(!empty($_SESSION['usuario'])){ ?>
                        <p style="position: relative; left: 40%" class="navbar-text">
                        Logado como <?php echo $_SESSION['usuario'] ?></p>
                        <?php  } ?>
                        <div class="text-right" id="btn-carrinho">  
                            
                            <?php
                            if (!empty($_SESSION['usuario'])) {
                                ?>
                                <span style="position: absolute; top: 5pt; right: 15px;">
                                    <ul class="nav nav-pills">
                                        <li class="dropdown">
                                            <a href="Logout.php">Sair</a>
                                        </li>
                                    </ul>
                                </span>
                                <div style="position: absolute; right: 8%; top: 1pt;"><a id="link-carrinho" href="GetCarrinho.php"><button type="button" class="btn btn-success navbar-btn"> <span class="glyphicon glyphicon-shopping-cart"></span> Carrinho <span class="badge"><?php echo $_SESSION['carrinho']->TotalItems(); ?></span> </button></a></div>
                                <?php
                            } else {
                                ?>
                                <a href="Login.php"><button class="btn btn-success navbar-btn"style="background-color:black">Login</button></a>
                                <a href="Cadastro.php"><button class="btn btn-success navbar-btn"style="background-color:black">Cadastre-se</button></a>
<?php } ?>
                        </div> 
                    </div>
                    <!-- /.nav-collapse -->
                </div><!-- /.container -->
                <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#"><strong>Padaria</strong></a></li>
        </ul>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Mercearia</a></li>
        <li><a href="#">Bomboniere</a></li>
        <li><a href="#">Confeitaria</a></li>
        <li><a href="#">Lanchonete</a></li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Pesquisar">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
      </form>
      
        
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
        </nav><!-- /.navbar -->

<br><br><br><br><br><br>

  
