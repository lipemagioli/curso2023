<?php
session_start();

class Dbconnect {
    /**
 * Função conectar com o banco de dados
 * @package dao
 */
    public function connect(){
         $host = 'localhost';
         $user = 'root';
         $pass = 'aluno123';
         $db = 'controleestoque';
         $connection = mysqli_connect($host,$user,$pass,$db); 
         return $connection;
     }
}