<?php 
include_once '../Classes/Conexao.php';

class Administrador{
	private $id;
	private $nome;
        
        function __construct() {
            
        }

public function ListaPedidosPendentes()
{
	$conexao = new Conexao();
	$link = $conexao->Conecta();
	$sql = "SELECT * FROM pedidos WHERE (tipo_entrega = 2 OR tipo_entrega = 3) AND (status = 0 OR status = 2)";
	$result = mysqli_query($link, $sql);
	return $result;
}

public function ListaProdutosPedido($id){
	$conexao = new Conexao();
	$link = $conexao->Conecta();
	$sql = "SELECT pp.id_produto,prod.nome,pp.quantidade,pp.sub_total FROM (pedidos AS ped, produtos AS prod) JOIN produtos_pedido AS pp ON (ped.id = pp.id_pedido AND prod.id = pp.id_produto) WHERE pp.id_pedido = ".$id." ";
	$result = mysqli_query($link, $sql);
	return $result;

}

public function DadosPedido($id) {
    $conexao = new Conexao();
    $link = $conexao->Conecta();
    $sql = "SELECT * FROM pedidos WHERE id = $id ";
    $result = mysqli_query($link, $sql);
    return $result;
}

public function AtualizaStatusPedido($id_pedido, $tipo) {
    $conexao = new Conexao();
    $link = $conexao->Conecta();
    /* 
        status = 1 Confirmado
        status = 2 Saiu pra entrega
        status = 3 Cancelado
        status = 0 Pendente
    */
    if($tipo == 1){
        $sql = "UPDATE pedidos SET status = 1 WHERE id = $id_pedido";
    }
    else if($tipo == 2){
        $sql = "UPDATE pedidos SET status = 2 WHERE id = $id_pedido";
    }
    else if($tipo == 3){
        $sql = "UPDATE pedidos SET status = 3 WHERE id = $id_pedido";
        $result_prod = $this->ListaProdutosPedido($id_pedido);
        while($produtos = mysqli_fetch_array($result_prod)){
            $id_prod = $produtos['id_produto'];
            $quant = $produtos['quantidade'];
            $sql_estorno = "UPDATE produtos SET estoque  = estoque + $quant WHERE id = $id_prod";
            if(!$result = mysqli_query($link, $sql_estorno)){
                echo mysqli_error($link);
            }
        }
    }
    
    if($result = mysqli_query($link, $sql)){
        return true;
    }
    else{
        echo mysqli_error($link);
        return false;
    }
}

public function ListaSeparacoesPendentes()
{
    $conexao = new Conexao();
    $link = $conexao->Conecta();
    $sql = "SELECT * FROM pedidos WHERE tipo_entrega = 1 AND status = 0";
    $result = mysqli_query($link, $sql);
    return $result;
}

public function MaisVendidos()
{
    $conexao = new Conexao();
    $link = $conexao->Conecta();
    $sql = "SELECT * FROM mais_vendidos";
    $result = mysqli_query($link, $sql);
    return $result;
}

public function MaisCompram()
{
    $conexao = new Conexao();
    $link = $conexao->Conecta();
    $sql = "SELECT * FROM mais_compram";
    $result = mysqli_query($link, $sql);
    return $result;
}

public function PedidosdoDia()
{
    date_default_timezone_set('America/Sao_Paulo');
    $data_hoje = new DateTime("today");
    $data_amanha = new DateTime("tomorrow");
    $data_hoje = $data_hoje->format('Y-m-d H:i:s');
    $data_amanha = $data_amanha->format('Y-m-d H:i:s');
    $conexao = new Conexao();
    $link = $conexao->Conecta();
    $sql = "SELECT COUNT(id) AS 'Total Pedidos do Dia' FROM pedidos WHERE data_hora BETWEEN '$data_hoje' AND '$data_amanha' ";
    $result = mysqli_query($link, $sql);
    return $result; 
}

public function PedidosCanceladosdoDia()
{
    date_default_timezone_set('America/Sao_Paulo');
    $data_hoje = new DateTime("today");
    $data_amanha = new DateTime("tomorrow");
    $data_hoje = $data_hoje->format('Y-m-d H:i:s');
    $data_amanha = $data_amanha->format('Y-m-d H:i:s');
    $conexao = new Conexao();
    $link = $conexao->Conecta();
    $sql = "SELECT * FROM pedidos WHERE status = 3 AND (data_hora BETWEEN '$data_hoje' AND '$data_amanha') ";
    $result = mysqli_query($link, $sql);
    return $result; 
}

public function ApagaPedido($id)
{
    $conexao = new Conexao();
    $link = $conexao->Conecta();
    $sql = "DELETE FROM pedidos WHERE id = $id ";
    if(!mysqli_query($link, $sql)){
        echo mysqli_error($link);
        return false;
    }
    else
    {
        return true;
    }
}

public function TotalVendasdoDia()
{
    date_default_timezone_set('America/Sao_Paulo');
    $data_hoje = new DateTime("today");
    $data_amanha = new DateTime("tomorrow");
    $data_hoje = $data_hoje->format('Y-m-d H:i:s');
    $data_amanha = $data_amanha->format('Y-m-d H:i:s');
    $conexao = new Conexao();
    $link = $conexao->Conecta();
    $sql = "SELECT valor_total FROM pedidos WHERE (data_hora BETWEEN '$data_hoje' AND '$data_amanha') AND status = 1";
    $result = mysqli_query($link, $sql);
    return $result;
}

}
?>