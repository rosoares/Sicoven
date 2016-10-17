<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexao
 *
 * @author Rodrigo
 */
class Conexao {
   var $host = "localhost";
   var $user = "root";
   var $senha = "";
   var $bd = "sicoven";
   var $con = "";
   
   function __construct() {
       
   }
   
   function Conecta() {
        if($this->con = mysqli_connect($this->host,  $this->user, $this->senha, $this->bd)){
            mysqli_set_charset($this->con, "utf8");
            return $this->con;
        }
        else{
            
          echo "Nao conectou".mysql_error();return false;

        }
}
}
?>
