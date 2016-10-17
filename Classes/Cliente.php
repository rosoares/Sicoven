<?php 

include_once './Conexao.php';

    class Cliente {
        private $id;
        private $Nome;
        private $Senha;
        private $Email;
        private $Cep;
        private $Rua;
        private $Bairro;
        private $Numero;
        private $Referencias;
        private $Complemento;
        
        function __construct() {
            
        }
        
        function getNome() {
            return $this->Nome;
        }

        function getSenha() {
            return $this->Senha;
        }

        function getEmail() {
            return $this->Email;
        }

        function getCep() {
            return $this->Cep;
        }

        function getRua() {
            return $this->Rua;
        }

        function getBairro() {
            return $this->Bairro;
        }

        function getNumero() {
            return $this->Numero;
        }

        function getReferencias() {
            return $this->Referencias;
        }

        function getComplemento() {
            return $this->Complemento;
        }

        function setNome($Nome) {
            $this->Nome = $Nome;
        }

        function setSenha($Senha) {
            $this->Senha = $Senha;
        }

        function setEmail($Email) {
            $this->Email = $Email;
        }

        function setCep($Cep) {
            $this->Cep = $Cep;
        }

        function setRua($Rua) {
            $this->Rua = $Rua;
        }

        function setBairro($Bairro) {
            $this->Bairro = $Bairro;
        }

        function setNumero($Numero) {
            $this->Numero = $Numero;
        }

        function setReferencias($Referencias) {
            $this->Referencias = $Referencias;
        }

        function setComplemento($Complemento) {
            $this->Complemento = $Complemento;
        }

                
        
        public function Cadastra() {
            $obj_con = new Conexao();
            $link = $obj_con->Conecta();
            $this->Senha = md5($this->Senha);
            if(empty($this->Referencias)){
                $this->Referencias = null;
            }
            if(empty($this->Complemento)){
                $this->Complemento = null;
            }
            
            $query = "INSERT INTO clientes  (nome, email, senha, cep, rua, bairro, numero, referencias, complemento)"
                    . " VALUES ('$this->Nome', '$this->Email', '$this->Senha', '$this->Cep', '$this->Rua', '$this->Bairro', $this->Numero, '$this->Referencias', '$this->Complemento')";
            
            if(mysqli_query($link, $query)){
                return true;
            }
            else{
                echo "Erro ".mysqli_error($link).'<br>'.$query;
                return false;
            }
        }

        public function Login($email, $senha){
            $senha = md5($senha);
            $obj_con = new Conexao();
            $link = $obj_con->Conecta();
            $sql = "SELECT id,nome, email, senha FROM clientes WHERE senha = '".$senha."' AND email = '".$email."'";
            if($result = mysqli_query($link,$sql)){
                return mysqli_fetch_array($result);
            }
            else {
                return false;
            }
        }

        public function RetornaUltimoId(){
            $obj_con = new Conexao();
            $link = $obj_con->Conecta();
            $sql = "SELECT MAX(id) AS id FROM clientes LIMIT 1";
            if(!$result = mysqli_query($link, $sql)){
                echo mysqli_error($link); 
            }
            while($row = mysqli_fetch_array($result)){
                $id = $row['id'];
            }
            return $id;
        }

    }
?>