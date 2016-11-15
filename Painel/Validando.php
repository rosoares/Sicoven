<?php 
	$usuario = $_POST['user'];
	$senha = $_POST['senha'];

	$usr_padrao = 'superadmin';
	$senha_padrao = 'adminSU#123';

	if ($usuario == $usr_padrao && $senha == $senha_padrao){
		session_start();
		$_SESSION['admin'] = "admin";
		echo 1;
	}
	else{
		echo 0;
	}
?>