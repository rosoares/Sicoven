<?php 

    include './Cliente.php';
    
    $nome = "Rodrigo";
    $email = "rodrigosoares8899@gmail.com";
    $senha = "123";
    $cep = "39403-209";
    $rua = "Jos?Catulino";
    $bairro = "Major Prates";
    $rua = "José Catulino";
    $numero = 235;
    $referencias = "Referencias";
    $complemento = "Complemento";
    
    $obj_cliente = new Cliente();
    $obj_cliente->setNome($nome);
    $obj_cliente->setEmail($email);
    $obj_cliente->setSenha($senha);
    $obj_cliente->setCep($cep);
    $obj_cliente->setRua($rua);
    $obj_cliente->setBairro($bairro);
    $obj_cliente->setNumero($numero);
    $obj_cliente->setReferencias($referencias);
    $obj_cliente->setComplemento($complemento);

    $obj_cliente->Cadastra();
    $id = $obj_cliente->RetornaUltimoId();
    echo $id;
    exit();
?>