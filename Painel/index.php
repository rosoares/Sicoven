
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Administrador</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>

        <style type="text/css">
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #eee;
            }

            .form-signin {
                max-width: 330px;
                padding: 15px;
                margin: 0 auto;
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
            }
            .form-signin .checkbox {
                font-weight: normal;
            }
            .form-signin .form-control {
                position: relative;
                height: auto;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding: 10px;
                font-size: 16px;
            }
            .form-signin .form-control:focus {
                z-index: 2;
            }
            .form-signin input[type="email"] {
                margin-bottom: -1px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }
            .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
            }
        </style>
    </head>

    <body>
        <script>
            $(document).ready(function () {
                //Esconde o elemento com id errolog
                $('#form-login').submit(function () {   //Ao submeter formulário
                    var usuario = $('#Usuario').val();
                    var senha = $('#Senha').val();  //Pega valor do campo senha
                    $.ajax({//Função AJAX
                        url: "Validando.php", //Arquivo php
                        type: "post", //Método de envio
                        data: "&user=" + usuario + "&senha=" + senha, //Dados
                        success: function (result) {     //Sucesso no AJAX
                            if (result == 1) {
                                location.href = 'EntregasPendentes.php' //Redireciona
                            }

                            else {
                                alert("Usuario ou Senha incorretos");   //Informa o erro
                            }
                        }
                    })
                    return false; //Evita que a página seja atualizada
                })
            })
        </script>
        <div class="container">

            <form id="form-login" class="form-signin" action="Validando.php" method="post">
                <h2 class="form-signin-heading">Fazer Login</h2>
                <input type="text" id="Usuario" class="form-control" placeholder="Usuario" required autofocus>
                <input type="password" id="Senha" class="form-control" placeholder="Senha" required>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Logar</button>
            </form>

        </div> <!-- /container -->


        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
