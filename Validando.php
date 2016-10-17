<?php
    include './Classes/Cliente.php';
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $obj_cliente = new Cliente();
    $result_login = $obj_cliente->Login($email, $senha);
    
    if($result_login == false){
        echo 0;
    }
    else{
        echo 1;
        session_start();
        $_SESSION['usuario'] = $result_login['nome'];
        $_SESSION['id'] = $result_login['id'];
        exit();
    }
?>