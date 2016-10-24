<?php

include_once 'Conexao.php';
include_once 'Produtos.php';

class Carrinho {

    public $produtos; //array de produtos;
    public static $cont = 0;

    public function Adiciona(Produtos $produto) {

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
        return true;
    }

    public function RetornaCont()
    {
        return self::$cont;
    }

    public function Remove($posicao) {
        $tot = count($this->produtos);
        unset($this->produtos[$posicao]);
        for ($i = $posicao; $i < $tot - 1; $i++) {
            $this->produtos[$i] = $this->produtos[$i + 1];
            unset($this->produtos[$i + 1]);
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
                $total+= $produto->getQuantidade() * $produto->getPreco();
            }
            return $total;
        }
    }

}
