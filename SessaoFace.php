<?php 
    $usuario = $_POST['user'];
    session_start();
    $_SESSION['usuario'] = $usuario;
    echo $_SESSION['usuario'];
?>