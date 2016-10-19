<?php
include_once 'Conexao.php';

class Produtos {
    private $id;
    private $nome;
    private $preco;
    private $estoque;
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

    function getEstoque() {
        return $this->estoque;
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

    function setEstoque($estoque) {
        $this->estoque = $estoque;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    function getSubtotal() {
        $subtot = $this->quantidade*$this->preco;
        return 'R$ '.$subtot;
    }
    
    public function ListaProduto($id){
        $sql = "SELECT * FROM produtos WHERE id = $id";
        $obj_con = new Conexao();
        $link = $obj_con->Conecta();
        $result = mysqli_query($link, $sql);
        return $result;
    }
    
    public function ListaProdutos(){
        $sql = "SELECT * FROM produtos";
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
        $sql = "SELECT * FROM produtos ";
        #terminar essa função
    }
}
