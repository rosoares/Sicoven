<?php

include_once 'Conexao.php';
include_once 'Produtos.php';

class Carrinho {

    public $produtos; //array de produtos;

    public function Adiciona(Produtos $produto) {
        $this->produtos[] = $produto;
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
