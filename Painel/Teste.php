<?php 
	date_default_timezone_set('America/Sao_Paulo');
	$data_atual = new DateTime("today");
	$data_proxima = new DateTime("tomorrow");

	$data_atual = $data_atual->format('Y-m-d H:i:s');

?>