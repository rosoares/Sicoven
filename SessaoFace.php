<?php 
    $usuario = $_POST['user'];
    $id = $_POST['id'];
    session_start();
    $_SESSION['usuario'] = $usuario;
    $_SESSION['id'] = $id;
    $_SESSION['facebook'] = 1;
    echo $_SESSION['usuario'];
?>