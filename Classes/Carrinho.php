<?php

include_once 'Conexao.php';
include_once 'Produtos.php';

class Carrinho {

    public $produtos = array(); //array de produtos;
    public static $cont = 0;
    
    function __construct() {
        if (!isset($_SESSION['carrinho'])) {
            $produtos = array();
            self::$cont=0;
        }
    } 

    
    /*public function Adiciona(Produtos $produto) {

        if (self::$cont == 0) {
            $this->produtos[self::$cont] = $produto;
            self::$cont++;
        }
        else{
            for($i=0; $i<self::$cont; $i++){
                if($this->produtos[$i]->getId() == $produto->getId()){
                    $this->produtos[$i] = $produto;
                    break;
                }
                if($i == self::$cont-1){
                    $this->produtos[self::$cont] = $produto;
                    self::$cont++;
                    break;
                }
            }
        }
        echo 'cont carrinho: '.self::$cont.'<br>';
        return true;
    } */

    public function Adiciona($produto)
    {
        if (empty($this->produtos)) {
            $this->produtos[0] = $produto;
        }
        else{
            for($i=0; $i<count($this->produtos); $i++){
                if($this->produtos[$i]->getId() == $produto->getId()){
                    $this->produtos[$i] = $produto;
                    break;
                }
                if($i == count($this->produtos)-1){
                    $this->produtos[] = $produto;
                    break;
                }
            }
        }
        return true;
    }

    public function RetornaCont()
    {
        return self::$cont;
    }

    public function Remove($posicao) {
        $tot = count($this->produtos);
        if($tot == $posicao){
            unset($this->produtos[$tot-1]);
        }
        else if($posicao == 0){
            unset($this->produtos[0]); 
            sort($this->produtos);
        }
        else{
            unset($this->produtos[$posicao-1]);
            sort($this->produtos);
        } 
    }

    public function RetornaProdutos() {
        return $this->produtos;
    }

    public function TotalItems() {
        $qt = 0;
        if (count($this->produtos) == 0) {
            return 0;
        } else {
            foreach ($this->produtos as $produto) {
                $qt += $produto->getQuantidade();
            }
            return $qt;
        }
    }

    public function isEmpty() {
        if (empty($this->produtos)) {
            return true;
        } else {
            return false;
        }
    }

    public function PrecoTotal() {
        $total = 0;
        if (count($this->produtos) == 0) {
            return 0;
        } else {
            foreach ($this->produtos as $produto) {
                $quantidade = $produto->getQuantidade();
                $preco = $produto->getPreco();
                $preco = str_replace(',', '.', $preco);
                $total += $preco * $quantidade;
            }
            return str_replace('.', ',', $total);
        }
    }

}
