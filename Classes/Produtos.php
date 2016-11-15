<?php
include_once 'Conexao.php';

class Produtos {
    private $id;
    private $nome;
    private $preco;
    private $quantidade;
    private $descricao;
    
    function __construct() {
        
    }

    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getPreco() {
        return $this->preco;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    function getSubtotal() {
        $preco = str_replace(',', '.', $this->preco);
        $quantidade = str_replace(',', '.', $this->quantidade);
        $subtot = $preco*$quantidade;
        $subtot = str_replace('.', ',', $subtot);
        return $subtot;
    }
    
    public function ListaProduto($id){
        $sql = "SELECT * FROM produtos WHERE id = $id";
        $obj_con = new Conexao();
        $link = $obj_con->Conecta();
        $result = mysqli_query($link, $sql);
        return $result;
    }

    public function ListaCategorias()
    {
        $sql = "SELECT * FROM categorias";
        $conexao = new Conexao();
        $link = $conexao->Conecta();
        $result = mysqli_query($link, $sql);
        return $result;
    }

    
    public function ListaProdutos(){
        $sql = "SELECT * FROM produtos ORDER BY nome";
        $obj_con = new Conexao();
        $link = $obj_con->Conecta();
        if(!$result = mysqli_query($link, $sql)){
            echo "Erro ".  mysqli_error($link);
            return 0;
        }
 else {
        return $result;
    }}
    
    public function ListaProdutoCategoria($categoria) {
        $sql = "SELECT * FROM produtos WHERE id_categoria = ".$categoria."";
        $conexao = new Conexao();
        $link = $conexao->Conecta();
        $result = mysqli_query($link, $sql);
        return $result;
    }

    public function PesquisaProdutos($expressao)
    {
        $sql = "SELECT * FROM produtos WHERE nome LIKE '%".$expressao."%' ";
        $conexao = new Conexao();
        $link = $conexao->Conecta();
        $result = mysqli_query($link,$sql);
        return $result;
    }
    
    public function CadastrarProduto($nome, $estoque, $preco, $descricao, $diretorio, $id_categoria) {
        $conexao = new Conexao();
        $link = $conexao->Conecta();
        $sql = "INSERT INTO produtos (nome, estoque, preco, descricao, img, id_categoria)
        VALUES ('$nome', $estoque, '$preco', '$descricao', '$diretorio', $id_categoria)";
        if(mysqli_query($link, $sql)){
            return true;
        }
        else{
            echo mysqli_error($link);
            return false;
        }
    }

    public function AlterarProduto($id,$nome, $estoque, $preco, $descricao, $diretorio, $id_categoria) {
        $conexao = new Conexao();
        $link = $conexao->Conecta();
        $sql = "UPDATE produtos SET nome = '$nome', estoque = $estoque, preco = '$preco', 
        descricao = '$descricao', img = '$diretorio', id_categoria = $id_categoria WHERE id = $id";
        if(mysqli_query($link, $sql)){
            return true;
        }
        else{
            echo mysqli_error($link);
            echo '<br>'.$sql;
            return false;
        }
    }
}
