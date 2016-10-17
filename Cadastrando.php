<?php
//Informações do usuario
include_once './Classes/Cliente.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

//Endereço
$cep = $_POST['cep'];
$bairro = $_POST['bairro'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
if(empty($_POST['complemento'])){
	$complemento = null;
}
else{
	$complemento = $_POST['complemento'];
}

if(empty($_POST['referencias'])){
	$referencias = null;
}
else{
	$referencias = $_POST['referencias'];
}


$obj_cliente = new Cliente();
$obj_cliente->setNome($nome);
$obj_cliente->setSenha($senha);
$obj_cliente->setEmail($email);
$obj_cliente->setCep($cep);
$obj_cliente->setBairro($bairro);
$obj_cliente->setRua($rua);
$obj_cliente->setNumero($numero);
$obj_cliente->setReferencias($referencias);
$obj_cliente->setComplemento($complemento);

if($obj_cliente->Cadastra()){
    echo '<script> alert("Cadastro efetuado com sucesso !"); location.href = "index.php" </script>';
}

session_start();
$_SESSION['usuario'] = $nome;
$_SESSION['id'] = $obj_cliente->RetornaUltimoId();
echo $_SESSION['id'];
exit();
?>