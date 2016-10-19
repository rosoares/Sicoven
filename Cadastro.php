<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cadastre-se</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/qunit/qunit-1.11.0.js"></script>
    
    <script type="text/javascript" src="js/jquery.mask.js"></script>  
    <script type="text/javascript" src="js/jquery.mask.test.js"></script>
    
    <script type="text/javascript">
        function MudaCor(){
            var senha = $('#senha').val();
            var conf_senha = $('#conf_senha').val();
            if(conf_senha == senha && senha != ""){
                $("#divsenha").removeClass('has-error');
                $('#divsenha').addClass('has-success');
             }
            else{
                $('#divsenha').addClass('has-error');
                
            }
        }
        
        function ValidaSenhas(form){
            if(form.senha.value != form.conf_senha.value){
                alert("As senhas não batem");
                return false;
            }
            else{
                form.submit();
            }
        }
       
    </script>
    
    <script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulario_cep() {
                // Limpa valores do formulÃ¡rio de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variÃ¡vel "cep" somente com dÃ­gitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //ExpressÃ£o regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                            } //end if.
                            else {
                                //CEP pesquisado nÃ£o foi encontrado.
                                limpa_formulario_cep();
                                alert("CEP nÃ£o encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep Ã© invÃ¡lido.
                        limpa_formulario_cep();
                        alert("Formato de CEP invÃ¡lido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulÃ¡rio.
                    limpa_formulario_cep();
                }
            });
        });

    </script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <script type="text/javascript" src="js/bootstrap.js"></script>
      <script type="text/javascript" src="js/jquery.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
      <script src="http://localhost/listaja/includes/js/jquery.maskedinput.js"></script>
      <script>
      </script>
      <nav class="navbar navbar-inverse">
        ...
      </nav>
    <h1 class="text-center">Cadastro de Usuário</h1>
    <div id="main" class="container-fluid">
 
        <form name="Cadastro" onSubmit="ValidaSenhas(this); return false; this.Cadastrar.disabled=true;" action="Cadastrando.php" method="post">
            <div class="text-center"><h3 class="page-header">Informações do Usuário</h3></div>
    <div class="row">
        <div class="form-group col-md-offset-3">
            <div class="form-group col-md-4">
              <label for="campo1">Nome :</label>
              <input type="text" name="nome" class="form-control" id="nome" required="" placeholder="Ex.: José Silva">
              <br />
              <label for="campo1">E-mail :</label>
              <input type="email" name="email" class="form-control" id="email" required="" placeholder="Ex.: 123@456.com">
            </div>

            <div id="divsenha" class="form-group col-md-4">
                <label for="campo1">Senha :</label>
                <input type="password" name="senha" class="form-control" id="senha" maxlength="16"required="" onblur="MudaCor()">
                <br />
                <label for="campo1">Confirmar senha :</label>
                <input type="password" name="conf_senha" class="form-control" id="conf_senha" maxlength="16" required="" onblur="MudaCor()">
            </div>
        </div>
    </div>
    
            <div class="text-center"><h3 class="page-header">Informações de Endereço do Usuário</h3></div>
    <div class="row">
        <div class="form-group col-md-offset-3">
            <div class="form-group col-md-4">
              <label for="campo1">CEP :</label>
              <input type="text" name="cep" class="form-control" id="cep" maxlength="9" required="" placeholder="Ex.: 39400-000">
              <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/buscaCepEndereco.cfm"  target="_blank">Não sei meu CEP </a>
              <br />
              <label for="campo1">Bairro :</label>
              <input type="text" name="bairro" class="form-control" id="bairro" required="" placeholder="Ex.: Centro">
            </div>
            
            <div class="form-group col-md-4">
              <label for="campo1">Rua :</label>
              <input type="text" name="rua" class="form-control" id="rua" required="" placeholder="Ex.: Dr. Santos">
              <br />
              <label for="campo1">Número :</label>
              <input type="text" name="numero" class="form-control" id="numero" required="" placeholder="Ex.: 1234">
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-md-offset-3">
            <div class="form-group col-md-4">
              <label for="campo1">Cidade :</label>
              <input type="text" name="cidade" class="form-control" id="cidade" required="" value="Montes Claros">
              <br />
            </div>

            <div class="form-group col-md-4">
              <label for="campo1">Estado :</label>
              <input type="text" name="estado" class="form-control" id="estado" required="" value="Minas Gerais">
              <br />
            </div>

        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-offset-3">
            <div class="form-group col-md-4">
              <label for="campo1">Complemento :</label>
              <input type="text" name="complemento" class="form-control" id="complemento" placeholder="Ex.: Apartamento...">
              <br />
            </div>

            <div class="form-group col-md-4">
                <label for="campo1">Referência :</label>
                <textarea class="form-control" name="referencia" id="referencia" placeholder="..."></textarea>
                <br />
            </div>
        </div>
    </div>

    <div class="row">
      <div class="text-center">
        <p>Obs.: Os serviços oferecidos por este site, atendem somente a região de Montes Claros.</p>
      </div>
    </div>

  <hr />
  <div class="text-center">
    <div id="actions" class="row">
      <div class="col-md-12">
          <button type="submit" name="Cadastrar" class="btn btn-primary">Cadastrar</button>
        <a href="index.php" class="btn btn-default">Cancelar</a>
      </div>
    </div>
   </div>
</form>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <div>
      .
    </div>
  </body>
</html>
