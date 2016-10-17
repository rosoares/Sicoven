

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Exemplo</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <link href="css/docs.css" rel="stylesheet" >
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-social.css" rel="stylesheet">
        <link href="css/style.css">
    </head>
    <body>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
                $(document).ready(function(){
                $('#errolog').hide(); //Esconde o elemento com id errolog
                $('#form-login').submit(function(){ 	//Ao submeter formulário
		var email=$('#Email').val();
		var senha=$('#Senha').val();	//Pega valor do campo senha
		$.ajax({			//Função AJAX
			url:"Validando.php",			//Arquivo php
			type:"post",				//Método de envio
			data: "&email="+email+"&senha="+senha,	//Dados
   			success: function (result){			//Sucesso no AJAX
                		if(result==1 ){						
                                    location.href='index.php'	//Redireciona
                		}
                      
                       else{
                			$('#errolog').show();		//Informa o erro
                		}
            		}
		})
		return false;	//Evita que a página seja atualizada
	})
}) 
        </script>

        <script>
             /* function statusChangeCallback(response) {
                console.log('statusChangeCallback');
                console.log(response);
                if (response.status === 'connected') {
                    location.href = "Foi.php";
                } else if (response.status === 'not_authorized') {
                
                document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
                } else {
                    document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
                }
             } */       

            function checkLoginState() {
                FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
                });
            } 

            window.fbAsyncInit = function() {
            FB.init({
            appId      : '549732731880522',
            xfbml      : true,
            version    : 'v2.7'
                });
             
                    FB.getLoginStatus(function(response){
                    statusChangeCallback(response);
                    });
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/en_US/sdk.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
                
            function login(){
                FB.login(function(response){
                    if(response.status === 'connected'){
                        FB.api('/me', 'GET', {fields: 'first_name, id'}, function(response){
                        var nome = response.first_name;
                        $.ajax({
                            url: 'SessaoFace.php',
                            type: "post",
                            data: "&user="+nome,
                            success: function(result){
                            location.href = "index.php";
                            }
                        })
                    })
                    }
                    else if(response === 'not authorized'){
                        alert("NÃ£o autorizado");
                    }
                    else{
                        alert("VocÃª nÃ£o estÃ¡ logado ao facebook");
                    }
                }, {scope: 'email'});
            }

        </script>
        <div id="main" class="cotainer-fluid">
            <div id="errolog" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" style="position: absolute; top: 25%; left: 24%;">
                    <div class="modal-content" style="width: 120%;" >
                        <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                             <h4 class="modal-title"> Erro </h4>
                        </div>
                        <div class="modal-body">
                            <p>Usuario ou Senha incorretos !.</p>
                        </div>
                        <div class="modal-footer">
                            <a href="Login.php"><button id="fecha" type="button" class="btn btn-default" data-dimiss="modal">Voltar</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="container">

        <form action="Validando.php" id="form-login" class="form-signin" method="post" style="width: 35%; position: absolute; left:32%; top:10%;">
        <h2 class="form-signin-heading">Faça seu Login</h2>
        <label for="inputEmail" class="sr-only">Email</label>
        <input name="email" type="email" id="Email" class="form-control" placeholder="Email" required autofocus>
        <br>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input name="senha" type="password" id="Senha" class="form-control" placeholder="Senha" required>
        <br>
        <button class="btn btn-lg btn-warning btn-block" type="submit">Login</button>
        <br>
         <button id="fb" class="btn btn-block btn-social btn-facebook" onclick="login()">
            <span class="fa fa-facebook"></span> Login com Facebook
        </button>
        <br>
        <a href="Cadastro.php">Cadastre-se</a>
        </br>
         <a href="#">Esqueci a senha</a>

        
      </form>

    </div> <!-- /container -->

    </body>
</html>